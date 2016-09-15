<?php

defined('SYSPATH') OR die('No direct access allowed.');

/**
 *
 */
class Newsletter_Model extends Model_Core {

    /**
     *
     */
    public function __construct() {
        parent::__construct();
        $this->_oSession = Session::instance();
    }

    /**
     *
     * @example <code>
     * if($this->ValidateMail($email)) {
     *           $cfgSmtpHost = $this->GetConfig('smtp_server');
     *           $cfgEmail = $this->GetConfig('email');
     *           $verifyString = substr(md5(sha1(sha1(strrev($email)))), 0, 16);
     *           $this->db->insert('newsletter_emails', array('email' => $email, 'verify_string' => $verifyString, 'verified' => 0));
     *           $confirmUrl = 'http://'.$_SERVER['HTTP_HOST'].url::base().'application/confirm_subscribe/?email='.$email.'&verify_string='.$verifyString;
     *           $mailContent =<<<EOM
      Witaj, <br />
      Proszę kliknąć lub wkleić w przeglądarce poniższy link aby aktywować subskrypcję: <br />
      <a href="{$confirmUrl}">{$confirmUrl}</a><br /><br />
      Pozdrawiamy,<br />
      Moto1<br />
      EOM;
     *           $swift = email::connect();
     *           $from = 'Moto1 - Sklep Internetowy';
     *           $subject = 'Potwierdzenie subskcypcji';
     *           // Build recipient lists
     *           $message = new Swift_Message($subject, $mailContent, "text/html");
     *           if ($swift->send($message, $email, $cfgEmail)) {
     *           $returnValue = true;
     *           } else {
     *               $returnValue = false;
     *           }
     *           $swift->disconnect();
     *           return $returnValue;
     *       } else {
     *               return 'Proszę wprowadzić prawidłowy adres email.';
     *      }
     * </code>
     * @param string $email
     * @return ErrorReporting
     *
     */
    public function NewsletterAddUser() {
        try {
            if (!empty($_POST['submit'])) {
                if (!empty($_POST['subscription']) && !empty($_POST['newsletter_email'])) {
                    if ($_POST['subscription'] == 'add_subscription') {
                        return $this->Subscribe($_POST['newsletter_email']);
                        //$alert = 'Zostałeś poprawnie dopisany do listy subskrybentów.';
                    } else {
                        return $this->Unsubscribe($_POST['newsletter_email']);
                        //$alert = 'Zostałeś poprawnie wypisany z listy subskrybentów.';
                    }
                } else {
                    //$alert = 'Proszę poprawnie wypełnić pola formularza';
                }
            }
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('newsletter.error_newsletter_add_user'));
        }
    }

    public function _EmailExistCheck($sEmail, $iEmailId = null) {
        try {
            $this->db->from(table::NEWSLETTER_EMAILS)->select('COUNT(*) AS count')->where(array('email' => $sEmail, 'verified' => 1));
            if (!empty($iEmailId)) {
                $this->db->where(array('id_email !=' => $iEmailId));
            }
            $result = $this->db->get();

            if (!empty($result) && $result[0]->count > 0) { // istnieją
                return new ErrorReporting(ErrorReporting::WARNING, false, Kohana::lang('newsletter.email_exist'));
            } else {
                return new ErrorReporting(ErrorReporting::SUCCESS, true);
            }
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('newsletter.error_email_exist_check'));
        }
    }

    /**
     * Zapisywanie nowego uzytkownika
     * @param String $sEmail
     * @return ErrorReporting
     */
    public function Subscribe($sEmail) {
        try {
            if ($this->_validateMail($sEmail)) {
                $this->db->query('SET AUTOCOMMIT = 0');
                $this->db->query('BEGIN');

                // sprawdzamy czy user jest juz zapisany
                $oEmailExistCheck = $this->db->from(table::NEWSLETTER_EMAILS)->where(array('email' => $sEmail, 'verified' => 1))->get();

                if (!empty($oEmailExistCheck) && $oEmailExistCheck->count() > 0) {
                    return new ErrorReporting(ErrorReporting::WARNING, false, Kohana::lang('newsletter.validation.newsletter_user_exist'));
                } else { // uzytkownik nie jest zapisany do newslettera
                    $oUserVerified = $this->db->from(table::NEWSLETTER_EMAILS)->where(array('email' => $sEmail))->get();
                    if (!empty($oUserVerified) && $oUserVerified->count() > 0) { // uzytkownik istnieje w bazie ale nie zweryfikowal konta
                        $this->_SendConfirmation($sEmail, $oUserVerified[0]->verify_string);
                    } else { // nie ma takiego maila w bazie, wiec dodajemy
                        $aData['email'] = $sEmail;
                        $aData['verify_string'] = $this->CreateString(8);
                        $aData['verified'] = 0;
                        $oEmailInsert = $this->db->insert(table::NEWSLETTER_EMAILS, $aData);

                        //utwórz domyślną grupę, jeśli nie ma:
                        $this->createDefaulGroupIfNotExists();

                        // dodajemy email do domyślnej grupy
                        $group = $this->db->from(table::NEWSLETTER_GROUPS)->where(array('default_group' => 1, 'lang' => Kohana::config('locale.language')))->limit(1)->get();

                        $aEmailGroups = array();
                        $aEmailGroups['newsletter_group_id'] = $group[0]->id_newsletter_group; // index 0 istnieje zawsze 
                        $aEmailGroups['newsletter_email_id'] = $oEmailInsert->insert_id();

                        $this->db->insert(table::NEWSLETTER_EMAIL_GROUPS, $aEmailGroups);

                        $this->_SendConfirmation($aData['email'], $aData['verify_string']);
                    }
                }
                $this->db->query('COMMIT');
                return new ErrorReporting(ErrorReporting::SUCCESS, true, Kohana::lang('newsletter.validation.subscribe_success'));
            } else {
                return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('newsletter.wrong_email_format'));
            }
        } catch (Exception $ex) {
            $this->db->query('ROLLBACK');
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('newsletter.validation.subscribe_error'));
        }
    }

    public function SubscribeApp() {
        try {
            if (!empty($_POST['newsletter_email'])) {
                if (!empty($_POST['subscription'])) {
                    switch ($_POST['subscription']) {
                        case 'delete_subscription':
                            $unsubscribe = $this->Unsubscribe($_POST['newsletter_email']);
                            $this->_oSession->set('msg', $unsubscribe->__toString());
                            if ($unsubscribe->Value) {
                                unset($_POST);
                            }
                            break;
                        default:
                            $subscribe = $this->Subscribe($_POST['newsletter_email']);
                            $this->_oSession->set('msg', $subscribe->__toString());
                            if ($subscribe->Value) {
                                unset($_POST);
                            }
                            break;
                    }
                } else {
                    $subscribe = $this->Subscribe($_POST['newsletter_email']);
                    $this->_oSession->set('msg', $subscribe->__toString());
                    if ($subscribe->Value) {
                        unset($_POST);
                    }
                }
            }

            return new ErrorReporting(ErrorReporting::SUCCESS, TRUE);
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('newsletter.validation.subscribe_error'));
        }
    }

    public function CreateString($count) {
        $string = "abcdefghijklmnoprstuqwyz1234567890";
        $password = '';
        for ($i = 1; $i <= $count; $i++) {
            $random = rand(0, strlen($string) - 1);
            $password .= $string{$random};
        }
        return $password;
    }

    private function _SendConfirmation($email, $verifyString) {
        try {
            $swift = email::connect();
            $sending_email = config::getConfig('sending_email');
            $sending_name = config::getConfig('sending_name');
            if (empty($sending_email) || empty($sending_name)) {
                $from = newsletter::SENDING_EMAIL;
            } else {
                $from = new Swift_Address($sending_email, $sending_name);
            }
            $subject = Kohana::lang('newsletter.app_email.confirm_subscribe_title');
            $vBody = new View('emails/default_email_template');
            $vBody->sContent = new View('emails/newsletter_confirm_register');
            $vBody->sContent->email = $email;
            $vBody->sContent->verifyString = $verifyString;
            $recipients = new Swift_RecipientList;
            $recipients->addTo($email);
            $vBody = new Swift_Message($subject, $vBody, "text/html");
            if ($swift->send($vBody, $recipients, $from)) {
                return new ErrorReporting(ErrorReporting::SUCCESS, true, Kohana::lang('app.success_send_message'));
            } else {
                return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('app.error_send_message'));
            }
            $swift->disconnect();
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('app.error_send_message'));
        }
    }

    /**
     * Email wysylany podczas wypisywania sie z newslettera
     * @param String $sEmail
     * @param String $sVerifyString
     * @return ErrorReporting 
     */
    private function _SendUnsubscribeConfirmation($sEmail, $sVerifyString) {
        try {
            $swift = email::connect();
            $email = config::getConfig('sending_email');
            $name = config::getConfig('sending_name');
            if (empty($email) || empty($name)) {
                $from = newsletter::SENDING_EMAIL;
            } else {
                $from = new Swift_Address($email, $name);
            }
            $subject = Kohana::lang('newsletter.app_email.confirm_unsubscribe_title');
            $message = new View('emails/newsletter_unsubscribe_confirmation');
            $message->email = $sEmail;
            $message->verifyString = $sVerifyString;

            $recipients = new Swift_RecipientList;
            $recipients->addTo($sEmail);

            $message = new Swift_Message($subject, $message, "text/html");
            if ($swift->send($message, $recipients, $from)) {

                return new ErrorReporting(ErrorReporting::SUCCESS, true, Kohana::lang('app.success_send_message'));
            } else {
                return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('app.error_send_message'));
            }
            $swift->disconnect();
        } catch (Exception $ex) {
            //var_dump($ex->getMessage());
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('app.error_send_message'));
        }
    }

    /**
     *
     * @param array $args
     * @return ErrorReporting
     */
    public function ConfirmSubscribe($args) {
        try {
            $this->db->query('SET AUTOCOMMIT = 0');
            $this->db->query('BEGIN');
            //
            $oEmailExistCheck = $this->db->from(table::NEWSLETTER_EMAILS)->where($_GET)->get();
            if (!empty($oEmailExistCheck) && $oEmailExistCheck->count() > 0) { // istnieje taki user
                $oEmailInsert = $this->db->update(table::NEWSLETTER_EMAILS, array('verified' => 1), $_GET);
            } else { // nie ma takiego maila w bazie, wiec warning
                $this->db->query('ROLLBACK');
                return new ErrorReporting(ErrorReporting::WARNING, false, Kohana::lang('newsletter.validation.no_user_to_confirm'));
            }

            $this->db->query('COMMIT');
            return new ErrorReporting(ErrorReporting::SUCCESS, true, Kohana::lang('newsletter.validation.confirm_subscribe_success'));
        } catch (Exception $ex) {
            $this->db->query('ROLLBACK');
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('newsletter.validation.confirm_subscribe_error'));
        }
    }

    /**
     * Wypisanie się z newslettera
     * @param string $email
     * @return ErrorReporting
     */
    public function Unsubscribe($sEmail) {
        try {
            if ($this->_validateMail($sEmail)) {
                $this->db->query('SET AUTOCOMMIT = 0');
                $this->db->query('BEGIN');

                // sprawdzamy czy user jest zapisany
                $oEmailExistCheck = $this->db->from(table::NEWSLETTER_EMAILS)->where(array('email' => $sEmail))->get();
                if (!empty($oEmailExistCheck) && $oEmailExistCheck->count() > 0) { // jest zapisany więc mozemy usuwac
                    $aData['verify_string'] = $this->CreateString(8);
                    $oEmailInsert = $this->db->update(table::NEWSLETTER_EMAILS, $aData, array('email' => $sEmail));
                    $this->_SendUnsubscribeConfirmation($sEmail, $aData['verify_string']);
                } else { // nie ma takiego maila w bazie, wiec warning
                    return new ErrorReporting(ErrorReporting::WARNING, false, Kohana::lang('newsletter.validation.newsletter_user_doesnt_exist'));
                }

                $this->db->query('COMMIT');
                return new ErrorReporting(ErrorReporting::SUCCESS, true, Kohana::lang('newsletter.validation.subscribe_success'));
            } else {
                return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('newsletter.wrong_email_format'));
            }


//            $this->db->query('SET AUTOCOMMIT = 0');
//            $this->db->query('BEGIN');
//            $result = $this->db->delete(table::NEWSLETTER_EMAILS, array('email' => $email));
//            $this->db->query('COMMIT');
            return new ErrorReporting(ErrorReporting::SUCCESS, $result, Kohana::lang('newsletter.unsubscribe_success'));
        } catch (Exception $ex) {
            $this->db->query('ROLLBACK');
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('newsletter.unsubscribe_error'));
        }
    }

    /**
     *
     * @param array $args
     * @return ErrorReporting
     */
    public function ConfirmUnsubscribe($args) {
        try {

            $oEmailExistCheck = $this->db->from(table::NEWSLETTER_EMAILS)->where(array('email' => $args['email']))->get();
            if (!empty($oEmailExistCheck) && $oEmailExistCheck->count() > 0) {
                if ($oEmailExistCheck[0]->verify_string !== $args['verify_string']) {
                    return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('newsletter.no_user_to_confirm'));
                } else {
                    $this->db->query('SET AUTOCOMMIT = 0');
                    $this->db->query('BEGIN');
                    //$this->db->delete(table::NEWSLETTER_EMAIL_GROUPS, array('newsletter_email_id' => $oEmailExistCheck[0]->id_email));
                    //$result = $this->db->delete(table::NEWSLETTER_EMAILS, $_GET);
                    // zmienia status na nie potwierdzony, a mail zostaje w bazie
                    $result = $this->db->update(table::NEWSLETTER_EMAILS, array('verified' => 0), array('id_email' => $oEmailExistCheck[0]->id_email));


                    $this->db->query('COMMIT');
                    return new ErrorReporting(ErrorReporting::SUCCESS, $result, Kohana::lang('newsletter.unsubscribe_success'));
                }
            } else {
                return new ErrorReporting(ErrorReporting::WARNING, false, Kohana::lang('newsletter.validation.newsletter_user_doesnt_exist'));
            }
        } catch (Exception $ex) {
            $this->db->query('ROLLBACK');
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('newsletter.unsubscribe_error'));
        }
    }

    /**
     *
     * @param string $email
     * @return Boolean
     */
    public static function _validateMail($email) {

        return valid::email($email);


        // koniec metody;
        // First, we check that there's one @ symbol, and that the lengths are right
        if (!ereg("^[^@]{1,64}@[^@]{1,255}$", $email)) {
            // Email invalid because wrong number of characters in one section, or wrong number of @ symbols.
            return false;
        }
        // Split it into sections to make life easier
        $email_array = explode("@", $email);
        $local_array = explode(".", $email_array[0]);
        for ($i = 0; $i < sizeof($local_array); $i++) {
            if (!ereg("^(([A-Za-z0-9!#$%&'*+/=?^_`{|}~-][A-Za-z0-9!#$%&'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$", $local_array[$i])) {
                return false;
            }
        }
        if (!ereg("^\[?[0-9\.]+\]?$", $email_array[1])) { // Check if domain is IP. If not, it should be valid domain name
            $domain_array = explode(".", $email_array[1]);
            if (sizeof($domain_array) < 2) {
                return false; // Not enough parts to domain
            }
            for ($i = 0; $i < sizeof($domain_array); $i++) {
                if (!ereg("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$", $domain_array[$i])) {
                    return false;
                }
            }
        }
        return true;
    }

    /**
     *
     * @param array $data
     * @return ErrorReporting
     */
    public function Insert($data, $aFiles = null) {
        try {
            $this->db->query('SET AUTOCOMMIT = 0');
            $this->db->query('BEGIN');
            $data['date_added'] = TIME;
            $newsletterGroups = $data['newsletter_group'];
            unset($data['submit'], $data['submit_back'], $data['cancel'], $data['newsletter_group']);
            $data['interval'] = $data['interval'] * 60 * 1000;

            $results = $this->db->insert(table::NEWSLETTERS, $data);
            $iInsertId = $results->insert_id();
            foreach ($newsletterGroups as $iKey => $sValue) {
                $this->db->insert(table::NEWSLETTERS_NEWSLETTER_GROUPS, array('newsletter_id' => $iInsertId, 'newsletter_group_id' => $iKey));
            }

            $this->uploadNewsletterImages($iInsertId, $aFiles);

            $this->db->query('COMMIT');
            return new ErrorReporting(ErrorReporting::SUCCESS, $results->insert_id(), Kohana::lang('newsletter.add_newsletter_success'));
        } catch (Exception $ex) {
            $this->db->query('ROLLBACK');
            Kohana::log('error', $this->db->last_query() . '<br />' . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('newsletter.add_newsletter_error'));
        }
    }

    private function uploadNewsletterImages($iNewsletterId, $aFiles = null) {
        if (!empty($aFiles)) {
            for ($i = 1; $i <= 10; $i++) {
                if ($aFiles['file' . $i]['error'] == 0) {

                    $mime_type = ($aFiles['file' . $i]['type']);
                    $iLastDot = strrpos($aFiles['file' . $i]['name'], '.');
                    $sFileNameTemp = substr($aFiles['file' . $i]['name'], 0, $iLastDot);
                    $iLangth = mb_strlen($aFiles['file' . $i]['name']);
                    $sExt = substr($aFiles['file' . $i]['name'], $iLastDot, $iLangth);

                    $file_name = string::prepareURL($sFileNameTemp) . $sExt;

                    if (strpos($mime_type, 'image') !== false) {
                        $result = $this->db->insert(table::NEWSLETTER_IMAGES, array('filename' => '', 'newsletter_id' => $iNewsletterId));
                        $file_name = $result->insert_id() . '-' . $file_name;
                        $this->db->update(table::NEWSLETTER_IMAGES, array('filename' => $file_name), array('id_image' => $result->insert_id()));
                        upload::save($aFiles['file' . $i], $file_name, newsletter::IMAGE_NEWSLETTER_PATH);

                        //$resizedImg = New Image(newsletter::IMAGE_NEWSLETTER_PATH . $file_name);
                        //$resizedImg->resize(342, null);
                        //$resizedImg->save();
                    }
                }
            }
        }
    }

    /**
     *
     * @param integer $id
     * @param array $data
     * @return ErrorReporting
     */
    public function Update($id, $data, $aFiles = null) {
        try {
            $this->db->query('SET AUTOCOMMIT = 0');
            $this->db->query('BEGIN');
            $id += 0;
            $newsletterGroups = $data['newsletter_group'];
            unset($data['submit'], $data['submit_back'], $data['cancel'], $data['newsletter_group'], $data['newsletter_edit_id']);
            $data['interval'] = $data['interval'] * 60 * 1000;
            $results = $this->db->update(table::NEWSLETTERS, $data, array('id_newsletter' => $id));
            $this->db->delete(table::NEWSLETTERS_NEWSLETTER_GROUPS, array('newsletter_id' => $id));
            foreach ($newsletterGroups as $iKey => $sValue) {
                $this->db->insert(table::NEWSLETTERS_NEWSLETTER_GROUPS, array('newsletter_id' => $id, 'newsletter_group_id' => $iKey));
            }

            $this->uploadNewsletterImages($id, $aFiles);

            $this->db->query('COMMIT');
            return new ErrorReporting(ErrorReporting::SUCCESS, $results, Kohana::lang('newsletter.edit_newsletter_success'));
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('newsletter.edit_newsletter_error'));
        }
    }

    /**
     *
     * @param integer $id
     * @return ErrorReporting
     */
    public function AllowDelete($id) {
        try {
            $id += 0;
            $result = new ErrorReporting(ErrorReporting::SUCCESS, $this->db->delete(table::NEWSLETTERS, array('id_newsletter' => $id)), Kohana::lang('newsletter.delete_newsletter_success'));
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('newsletter.delete_newsletter_error'));
        }
    }

    /**
     * Usuwanie newsletterów z listy poprzez oznaczenie checkboxami
     * @param Array $aNewsletterIds
     * @return ErrorReporting
     */
    public function DeleteNewsletterArray($aNewsletterIds) {
        try {
            if (is_array($aNewsletterIds)) {
                foreach ($aNewsletterIds as $iNI) {
                    $this->DeleteNewsletter($iNI);
                }
                return new ErrorReporting(ErrorReporting::SUCCESS, true, Kohana::lang('newsletter.delete_newsletter_success'));
            } else {
                $aNewsletterIds+=0;
                return $this->DeleteNewsletter($aNewsletterIds);
            }
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('newsletter.delete_newsletter_error'));
        }
    }

    /**
     *
     * @param integer $id
     * @return ErrorReporting
     */
    public function DeleteNewsletter($id) {
        try {
            $this->db->query('SET AUTOCOMMIT = 0');
            $this->db->query('BEGIN');
            $id += 0;

            // usuwanie obrazków newslettera
            $images = $this->db->getwhere(table::NEWSLETTER_IMAGES, array('newsletter_id' => $id));
            foreach ($images as $img) {
                unlink(newsletter::IMAGE_NEWSLETTER_PATH . $img->filename);
            }
            $this->db->delete(table::NEWSLETTER_IMAGES, array('newsletter_id' => $id));


            $this->db->delete(table::NEWSLETTERS_NEWSLETTER_GROUPS, array('newsletter_id' => $id));
            $results = $this->db->delete(table::NEWSLETTERS, array('id_newsletter' => $id));
            $this->db->query('COMMIT');
            return new ErrorReporting(ErrorReporting::SUCCESS, true, Kohana::lang('newsletter.delete_newsletter_success'));
        } catch (Exception $ex) {
            $this->db->query('ROLLBACK');
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('newsletter.delete_newsletter_error'));
        }
    }

    /**
     *
     * @param integer $id
     * @return ErrorReporting
     */
    public function Find($id) {
        try {
            $id += 0;
            return new ErrorReporting(ErrorReporting::SUCCESS, $this->db->getwhere(table::NEWSLETTERS, array('id_newsletter' => $id)), Kohana::lang('newsletter.find_success'));
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('newsletter.find_error'));
        }
    }

    /**
     *
     * @param integer $limit
     * @param integer $offset
     * @return ErrorReporting
     */
    public function FindAll($limit, $offset) {
        try {
            $result = $this->db->from(table::NEWSLETTERS);

            if (isset($limit) && isset($offset)) {
                $result = $result
                        ->limit($limit, $offset);
            }

            if (!empty($_GET['newsletters_orderby'])) {
                switch ($_GET['newsletters_orderby']) {
                    case 1:
                        $result = $result->orderby(array('title' => 'ASC'))->get();
                        break;
                    case 2:
                        $result = $result->orderby(array('title' => 'DESC'))->get();
                        break;
                    case 3:
                        $result = $result->orderby(array('language' => 'ASC'))->get();
                        break;
                    case 4:
                        $result = $result->orderby(array('language' => 'DESC'))->get();
                        break;
                    case 5:
                        $result = $result->orderby(array('date_added' => 'ASC'))->get();
                        break;
                    case 6:
                        $result = $result->orderby(array('date_added' => 'DESC'))->get();
                        break;
                    case 7:
                        $result = $result->orderby(array('date_sent' => 'ASC'))->get();
                        break;
                    case 8:
                        $result = $result->orderby(array('date_sent' => 'DESC'))->get();
                        break;
                }
            } else {
                $result = $result->orderby(array('date_added' => 'DESC'))->get();
            }

            return new ErrorReporting(ErrorReporting::SUCCESS, $result, Kohana::lang('newsletter.find_all_success'));
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('newsletter.find_all_error'));
        }
    }

    /**
     *
     * @return ErrorReporting
     */
    public function Count() {
        try {
            return new ErrorReporting(ErrorReporting::SUCCESS, $this->db->count_records(table::NEWSLETTERS), Kohana::lang('newsletter.count_success'));
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('newsletter.count_error'));
        }
    }

    /**
     *
     * @param integer $data
     * @return ErrorReporting
     */
    public function InsertGroup($data) {
        try {
            unset($data['submit'], $data['submit_back']);
            if (empty($data['lang'])) {
                $data['lang'] = Kohana::config('locale.language');
            }
            if ($data['default_group'] == 1) {
                $this->db->update(table::NEWSLETTER_GROUPS, array('default_group' => 0), array('lang' => $data['lang']));
            } else {
                $data['default_group'] = 0;
                $res = $this->db->from(table::NEWSLETTER_GROUPS)->where(array('default_group' => 1, /* 'id_newsletter_group !=' => $id, */ 'lang' => $data['lang']))->get();
                if ($res->count() == 0) {
                    $data['default_group'] = 1;
                }
            }
            $result = $this->db->insert(table::NEWSLETTER_GROUPS, $data);
            return new ErrorReporting(ErrorReporting::SUCCESS, $result->insert_id(), Kohana::lang('newsletter.add_group_success'));
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('newsletter.add_group_error'));
        }
    }

    /**
     *
     * @param integer $id
     * @param array $data
     * @return ErrorReporting
     */
    public function UpdateGroup($id, $data) {
//        if(empty($data['name'])){
//            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('newsletter.update_page_error'));
//        }

        try {
            $id += 0;
            unset($data['submit'], $data['submit_back']);
            if ($data['default_group'] == 1) {
                $this->db->update(table::NEWSLETTER_GROUPS, array('default_group' => 0), array('lang' => $data['lang']));
            } else {
                $data['default_group'] = 0;
                $res = $this->db->from(table::NEWSLETTER_GROUPS)->where(array('default_group' => 1, /* 'id_newsletter_group !=' => $id, */ 'lang' => $data['lang']))->get();
                if ($res->count() == 0) {
                    $data['default_group'] = 1; // jeśli nie ma grupy domyślnej, to ustaw aktualnie edytowaną
                }
            }
            $result = $this->db->update(table::NEWSLETTER_GROUPS, $data, array('id_newsletter_group' => $id));

            return new ErrorReporting(ErrorReporting::SUCCESS, $result, Kohana::lang('newsletter.update_newsletter_group_success'));
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('newsletter.update_page_error'));
        }
    }

    /**
     *
     * @param integer $id
     * @return ErrorReporting
     */
    public function AllowDeleteGroup($id) {
        try {
            $id += 0;
            $result = $this->db->count_records(table::NEWSLETTER_EMAIL_GROUPS, array('newsletter_group_id' => $id));
            return new ErrorReporting(ErrorReporting::SUCCESS, ($result > 0 ? false : true), Kohana::lang('newsletter.delete_newsletter_success'));
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('newsletter.delete_newsletter_error'));
        }
    }

    /**
     * Usuwanie grupy dla newsletterów dla listy przez checkboxy
     * @param Array $iNewsletterGroupsIds
     * @return ErrorReporting
     */
    public function DeleteNewsletterGroupArray($aNewsletterGroupsIds) {
        try {
            if (is_array($aNewsletterGroupsIds)) {
                foreach ($aNewsletterGroupsIds as $iNGI) {
                    $this->DeleteNewsletterGroup($iNGI);
                }
                return new ErrorReporting(ErrorReporting::SUCCESS, true, Kohana::lang('newsletter.delete_newsletter_group_success'));
            } else {
                $aNewsletterGroupsIds+=0;
                return $this->DeleteNewsletterGroup($aNewsletterGroupsIds);
            }
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('newsletter.delete_newsletter_group_error'));
        }
    }

    /**
     * Usuwanie grupy dla newsletterow
     * @param integer $id
     * @return ErrorReporting
     */
    public function DeleteNewsletterGroup($id) {
        try {
            $id += 0;
            $oNewsletter = $this->db->from(table::NEWSLETTER_GROUPS)->where(array('id_newsletter_group' => $id))->get();
            if ($oNewsletter[0]->default_group == 1) {
                return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('newsletter.cant_delete_default_group'));
            } else {
                $result = $this->db->delete(table::NEWSLETTER_GROUPS, array('id_newsletter_group' => $id, 'default_group != ' => 1)); //zablokowanie usuwania domyślnej grupy
                if (count($result) > 0) {
                    $this->db->delete(table::NEWSLETTER_EMAIL_GROUPS, array('newsletter_group_id' => $id));
                    return new ErrorReporting(ErrorReporting::SUCCESS, true, Kohana::lang('newsletter.delete_newsletter_group_success'));
                }
            }

            /*
              $res = $this->db->from(table::NEWSLETTER_GROUPS)->where('default_group', 1)->get();
              if ($res->count() == 0) {
              $this->db->query('update ' . table::NEWSLETTER_GROUPS . ' set default_group =1 limit 1');
              }

             */

            return new ErrorReporting(ErrorReporting::WARNING, false, Kohana::lang('newsletter.delete_newsletter_group_error'));
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('newsletter.delete_newsletter_group_error'));
        }
    }

    /**
     *
     * @param integer $id
     * @return ErrorReporting
     */
    public function FindGroup($id) {
        try {
            $id += 0;
            return new ErrorReporting(ErrorReporting::SUCCESS, $this->db->getwhere(table::NEWSLETTER_GROUPS, array('id_newsletter_group' => $id)), Kohana::lang('newsletter.get_newsletters_groups_success'));
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('newsletter.get_newsletters_groups_error'));
        }
    }

    /**
     * Pobiera grupy dla newsletterów
     * @param integer $limit
     * @param integer $offset
     * @return ErrorReporting
     */
    public function FindAllGroups($limit = null, $offset = null, $aWhere = null) {
        try {
			$newsletter_groups_orderby = 'default_group';
			$kind = 'DESC';
			if(!empty($_GET['newsletter_groups_orderby']) && $_GET['newsletter_groups_orderby']==1 ) {$newsletter_groups_orderby='default_group'; $kind='DESC';}
			else if(!empty($_GET['newsletter_groups_orderby']) && $_GET['newsletter_groups_orderby']==2 ) {$newsletter_groups_orderby='default_group'; $kind='ASC';}
			
			else if(!empty($_GET['newsletter_groups_orderby']) && $_GET['newsletter_groups_orderby']==3 ) {$newsletter_groups_orderby='lang'; $kind='ASC';}
			else if(!empty($_GET['newsletter_groups_orderby']) && $_GET['newsletter_groups_orderby']==4 ) {$newsletter_groups_orderby='lang'; $kind='DESC';}
			
			else if(!empty($_GET['newsletter_groups_orderby']) && $_GET['newsletter_groups_orderby']==5 ) {$newsletter_groups_orderby='name'; $kind='ASC';}
			else if(!empty($_GET['newsletter_groups_orderby']) && $_GET['newsletter_groups_orderby']==6 ) {$newsletter_groups_orderby='name'; $kind='DESC';}
		
		
            if (!empty($aWhere)) {
                return new ErrorReporting(ErrorReporting::SUCCESS, $this->db->orderby('name')->where($aWhere)->get(table::NEWSLETTER_GROUPS), Kohana::lang('newsletter.get_newsletter_groups_success'));
            } else if (empty($limit) && empty($offset)) {
                return new ErrorReporting(ErrorReporting::SUCCESS, $this->db->get(table::NEWSLETTER_GROUPS), Kohana::lang('newsletter.get_newsletter_groups_success'));
            } else {
                return new ErrorReporting(ErrorReporting::SUCCESS, $this->db->orderby($newsletter_groups_orderby, $kind)->limit($limit, $offset)->get(table::NEWSLETTER_GROUPS), Kohana::lang('newsletter.get_newsletter_groups_success'));
            }
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('newsletter.get_newsletter_groups_error'));
        }
    }

    /**
     *
     * @return ErrorReporting
     */
    public function CountGroups() {
        try {
            return new ErrorReporting(ErrorReporting::SUCCESS, $this->db->count_records(table::NEWSLETTER_GROUPS), Kohana::lang('newsletter.count_groups_success'));
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('newsletter.count_groups_error'));
        }
    }

    /**
     *
     * @param array $data
     * @return ErrorReporting
     */
    public function InsertEmail($data) {
        try {
            //utwórz domyślną grupę, jeśli nie ma:
            $this->createDefaulGroupIfNotExists();

            $this->db->query('SET AUTOCOMMIT = 0');
            $this->db->query('BEGIN');

            if (!isset($data['newsletter_group'])) {
                // dodajemy email do domyślnej grupy
                $group = $this->db->query('select id_newsletter_group from ' . table::NEWSLETTER_GROUPS . ' where default_group=1 limit 1');
                $data['newsletter_group'] = array($group[0]->id_newsletter_group);
            }

            $aNewsletterGroups = $data['newsletter_group'];
            unset($data['submit'], $data['submit_back'], $data['newsletter_group']);

            $data['name'] = trim($data['name']);
            $data['email'] = trim($data['email']);
            $data['verify_string'] = $this->CreateString(8);
            $data['verified'] = 1;

            $result = $this->db->insert(table::NEWSLETTER_EMAILS, $data);
            $insertId = $result->insert_id();
            foreach ($aNewsletterGroups as $ngKey => $ngValue) {
                $this->db->insert(table::NEWSLETTER_EMAIL_GROUPS, array('newsletter_email_id' => $insertId, 'newsletter_group_id' => $ngKey));
            }
            $this->db->query('COMMIT');
            //return new ErrorReporting(ErrorReporting::SUCCESS, $insertId, Kohana::lang('newsletter.insert_email_success'));
            return new ErrorReporting(ErrorReporting::SUCCESS, $insertId, 'OK');
        } catch (Exception $ex) {
            $this->db->query('ROLLBACK');
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('newsletter.insert_email_error'));
        }
    }

    /**
     *
     * @param integer $id
     * @param array $data
     * @return ErrorReporting
     */
    public function UpdateEmail($id, $data) {
        try {
            $id += 0;
            $this->db->query('SET AUTOCOMMIT = 0');
            $this->db->query('BEGIN');
            if (empty($data['newsletter_email_active'])) {
                $data['newsletter_email_active'] = 'Y';
            }
            $aNewsletterGroups = $data['newsletter_group'];
            unset($data['submit'], $data['submit_back'], $data['newsletter_group']);
            $this->db->delete(table::NEWSLETTER_EMAIL_GROUPS, array('newsletter_email_id' => $id));
            foreach ($aNewsletterGroups as $ngKey => $ngValue) {
                $this->db->insert(table::NEWSLETTER_EMAIL_GROUPS, array('newsletter_email_id' => $id, 'newsletter_group_id' => $ngKey));
            }
            $result = $this->db->update(table::NEWSLETTER_EMAILS, $data, array('id_email' => $id));
            $this->db->query('COMMIT');
            return new ErrorReporting(ErrorReporting::SUCCESS, $result, Kohana::lang('newsletter.newsletter_update_email_success'));
        } catch (Exception $ex) {
            $this->db->query('ROLLBACK');
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('newsletter.newsletter_update_email_error'));
        }
    }

    /**
     *
     * @param integer $id
     * @return ErrorReporting
     */
    public function AllowDeleteEmail($id) {
        try {
            $id += 0;
            return new ErrorReporting(ErrorReporting::SUCCESS, $this->db->delete(table::NEWSLETTER_EMAILS, array('id_email' => $id)), Kohana::lang('newsletter.delete_page_success'));
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('newsletter.delete_page_error'));
        }
    }

    /**
     * Usuwa emaile dla newsletterow wybrane przez checkboxy
     * @param Array $aEmailsIds
     * @return ErrorReporting
     */
    public function DeleteEmailArray($aEmailsIds) {
        try {
            if (is_array($aEmailsIds)) {
                foreach ($aEmailsIds as $iEI) {
                    $this->DeleteEmail($iEI);
                }
                return new ErrorReporting(ErrorReporting::SUCCESS, true, Kohana::lang('newsletter.newsletter_delete_email_success'));
            } else {
                $aEmailsIds+=0;
                return $this->DeleteEmail($aEmailsIds);
            }
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('newsletter.newsletter_delete_email_error'));
        }
    }

    /**
     * Usuwa emaile dla newsletterow
     * @param integer $id
     * @return ErrorReporting
     */
    public function DeleteEmail($id) {
        try {
            $id += 0;
            $this->db->query('SET AUTOCOMMIT = 0');
            $this->db->query('BEGIN');
            $this->db->delete(table::NEWSLETTER_EMAIL_GROUPS, array('newsletter_email_id' => $id));
            $result = $this->db->delete(table::NEWSLETTER_EMAILS, array('id_email' => $id));
            $this->db->query('COMMIT');
            return new ErrorReporting(ErrorReporting::SUCCESS, true, Kohana::lang('newsletter.newsletter_delete_email_success'));
        } catch (Exception $ex) {
            $this->db->query('ROLLBACK');
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('newsletter.newsletter_delete_email_error'));
        }
    }

    /**
     *
     * @param integer $id
     * @return ErrorReporting
     */
    public function FindEmail($id) {
        try {
            $id += 0;
            return new ErrorReporting(ErrorReporting::SUCCESS, $this->db->getwhere(table::NEWSLETTER_EMAILS, array('id_email' => $id)), Kohana::lang('newsletter.find_email_success'));
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('newsletter.find_email_error'));
        }
    }

    /**
     *
     * @param integer $limit
     * @param integer $offset
     * @return ErrorReporting
     */
    public function FindAllEmails($iLimit, $iOffset, $aArgs = array()) {
        try {
		
		$newsletter_emails_orderby = 'name';
		$kind = 'ASC';
		if(!empty($_GET['newsletter_emails_orderby']) && $_GET['newsletter_emails_orderby']==1 ) {$newsletter_emails_orderby='name'; $kind='ASC';}
		else if(!empty($_GET['newsletter_emails_orderby']) && $_GET['newsletter_emails_orderby']==2 ) {$newsletter_emails_orderby='name'; $kind='DESC';}
		
		else if(!empty($_GET['newsletter_emails_orderby']) && $_GET['newsletter_emails_orderby']==3 ) {$newsletter_emails_orderby='email'; $kind='ASC';}
		else if(!empty($_GET['newsletter_emails_orderby']) && $_GET['newsletter_emails_orderby']==4 ) {$newsletter_emails_orderby='email'; $kind='DESC';}
		
		/*else if(!empty($_GET['newsletter_emails_orderby']) && $_GET['newsletter_emails_orderby']==5 ) {$newsletter_emails_orderby='name'; $kind='ASC';}
		else if(!empty($_GET['newsletter_emails_orderby']) && $_GET['newsletter_emails_orderby']==6 ) {$newsletter_emails_orderby='name'; $kind='DESC';}*/
		
		else if(!empty($_GET['newsletter_emails_orderby']) && $_GET['newsletter_emails_orderby']==7 ) {$newsletter_emails_orderby='verified'; $kind='ASC';}
		else if(!empty($_GET['newsletter_emails_orderby']) && $_GET['newsletter_emails_orderby']==8 ) {$newsletter_emails_orderby='verified'; $kind='DESC';}
		
		else if(!empty($_GET['newsletter_emails_orderby']) && $_GET['newsletter_emails_orderby']==9 ) {$newsletter_emails_orderby='newsletter_email_active'; $kind='ASC';}
		else if(!empty($_GET['newsletter_emails_orderby']) && $_GET['newsletter_emails_orderby']==10 ) {$newsletter_emails_orderby='newsletter_email_active'; $kind='DESC';}
		
			
            if (!empty($aArgs['email'])) {
                $aArgs['email'] = str_replace(array('%', '_'), array('', ''), $aArgs['email']);
                $this->db->like(array('email' => $aArgs['email']));
            }
            if (!empty($aArgs['group']) && $aArgs['group'] + 0 > 0) {
                $this->db->join(table::NEWSLETTER_EMAIL_GROUPS, 'newsletter_email_id', 'id_email', 'INNER');
                $this->db->in('newsletter_group_id', array($aArgs['group']));
            }
            if (isset($aArgs['status']) && $aArgs['status'] != '-' && $aArgs['status'] + 0 == 1) {
                $this->db->where(array('newsletter_email_active' => 'Y'));
            } elseif (isset($aArgs['status']) && $aArgs['status'] != '-' && $aArgs['status'] + 0 == 0) {
                $this->db->where(array('newsletter_email_active' => 'N'));
            }
            if (isset($aArgs['verified']) && $aArgs['verified'] != '-' && $aArgs['verified'] + 0 == 1) {
                $this->db->where(array('verified' => 1));
            } elseif (isset($aArgs['verified']) && $aArgs['verified'] != '-' && $aArgs['verified'] + 0 == 0) {
                $this->db->where(array('verified' => 0));
            }
            if (!empty($iLimit) && !empty($iOffset)) {
                $this->db->limit($iLimit, $iOffset);
            }
            //$this->db->orderby('name');
            $result = $this->db->orderby($newsletter_emails_orderby, $kind)->get(table::NEWSLETTER_EMAILS . ' AS ne');

            return new ErrorReporting(ErrorReporting::SUCCESS, $result, Kohana::lang('newsletter.find_all_emails_success'));
        } catch (Exception $ex) {
            echo $ex->getMessage();
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('newsletter.find_all_emails_error'));
        }
    }

    /**
     * Pobiera adresy email dla grupy - potrzebne do wysylania newslettera
     * @param Integer $limit
     * @param Integer $offset
     * @param String $sGroupIds (grupy po przecinku)
     * @return ErrorReporting
     */
    public function FindAllEmailsForGroups($limit, $offset, $sGroupIds, $iNewsletterId = null) {
        try {
            $aGroupId = explode(',', $sGroupIds);
            
            $sql = "SELECT *
            FROM (".table::NEWSLETTER_EMAILS." AS `ne`)
            INNER JOIN ".table::NEWSLETTER_EMAIL_GROUPS." AS `neg` ON (`neg`.`newsletter_email_id` = `ne`.`id_email`)
            LEFT OUTER JOIN (SELECT * FROM ".table::NEWSLETTER_EMAIL_SEND." WHERE `newsletter_id`= ".$iNewsletterId.") AS `nes` ON (`nes`.`email_id` = `ne`.`id_email`)
            WHERE `newsletter_group_id` IN (" . $sGroupIds . ")
            AND `newsletter_email_active` = 'Y' AND ne.verified = 1 
            AND newsletter_id IS NULL
            LIMIT 0, ".$limit." ";
            $result = $this->db->query($sql);

            return new ErrorReporting(ErrorReporting::SUCCESS, $result, Kohana::lang('newsletter.find_all_emails_4group_success'));
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('newsletter.find_all_emails_4group_error'));
        }
    }

    /**
     *
     * @param integer $emailId
     * @return ErrorReporting
     */
    public function FindAllEmailGroups($emailId) {
        try {
            $result = $this->db
                    ->from(table::NEWSLETTER_GROUPS . ' as g')
                    ->join(table::NEWSLETTER_EMAIL_GROUPS . ' as eg', 'eg.newsletter_group_id', 'g.id_newsletter_group')
                    ->where('eg.newsletter_email_id', $emailId)
                    ->get();


            return new ErrorReporting(ErrorReporting::SUCCESS, $result, Kohana::lang('newsletter.find_all_email_groups_success'));
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('newsletter.find_all_email_groups_error'));
        }
    }

    /**
     *
     * @return ErrorReporting
     */
    public function CountEmails($aArgs = array()) {
        try {
            if (!empty($aArgs['email'])) {
                $aArgs['email'] = str_replace(array('%', '_'), array('', ''), $aArgs['email']);
                $this->db->like(array('email' => $aArgs['email']));
            }
            if (!empty($aArgs['group']) && $aArgs['group'] + 0 > 0) {
                $this->db->join(table::NEWSLETTER_EMAIL_GROUPS, 'newsletter_email_id', 'id_email', 'INNER');
                $this->db->in('newsletter_group_id', array($aArgs['group']));
            }
            if (isset($aArgs['status']) && $aArgs['status'] != '-' && $aArgs['status'] + 0 == 1) {
                $this->db->where(array('newsletter_email_active' => 'Y'));
            } elseif (isset($aArgs['status']) && $aArgs['status'] != '-' && $aArgs['status'] + 0 == 0) {
                $this->db->where(array('newsletter_email_active' => 'N'));
            }
            if (isset($aArgs['verified']) && $aArgs['verified'] != '-' && $aArgs['verified'] + 0 == 1) {
                $this->db->where(array('verified' => 1));
            } elseif (isset($aArgs['verified']) && $aArgs['verified'] != '-' && $aArgs['verified'] + 0 == 0) {
                $this->db->where(array('verified' => 0));
            }
            $result = $this->db->count_records(table::NEWSLETTER_EMAILS);
            return new ErrorReporting(ErrorReporting::SUCCESS, $result, Kohana::lang('newsletter.count_emails_success'));
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('newsletter.count_emails_error'));
        }
    }

    /**
     *
     * @return ErrorReporting
     */
    public function Send() {
        try {
            return new ErrorReporting(ErrorReporting::SUCCESS, $this->db->count_records(table::NEWSLETTERS), Kohana::lang('newsletter.count_pages_success'));
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('newsletter.count_pages_error'));
        }
    }

    /**
     *
     * @param integer $id
     * @return ErrorReporting
     */
    public function FindNewsletterGroupsAsArray($id) {
        try {
            return new ErrorReporting(
                    ErrorReporting::SUCCESS, $this->db->getwhere(table::NEWSLETTERS_NEWSLETTER_GROUPS), Kohana::lang('newsletter.get_all_newsletter_groups_success'));
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('newsletter.get_all_newsletter_groups_error'));
        }
    }

    /**
     *
     * @param integer $id
     * @return ErrorReporting
     */
    public function FindAllNewsletterGroups($id) {
        try {
            return new ErrorReporting(
                    ErrorReporting::SUCCESS, $this->db->getwhere(table::NEWSLETTERS_NEWSLETTER_GROUPS, array('newsletter_id' => $id)), Kohana::lang('newsletter.get_all_newsletter_groups_success'));
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('newsletter.get_all_newsletter_groups_error'));
        }
    }

    /**
     *
     * @param integer $post
     * @return ErrorReporting
     */
    public function validateAdd($post) {
        try {
            $alert = '';
            if (empty($post['title']) || $post['title'] == '') {
                $alert .= '<li>' . Kohana::lang('newsletter.validation.title_empty') . '</li>';
            }
            if (empty($post['content']) || $post['content'] == '') {
                $alert .= '<li>' . Kohana::lang('newsletter.validation.content_empty') . '</li>';
            }
            if (empty($post['interval']) || $post['interval'] == '') {
                $alert .= '<li>' . Kohana::lang('newsletter.validation.interval_empty') . '</li>';
            } else if (!valid::digit($post['interval'])) {
                $alert .= '<li>' . Kohana::lang('newsletter.validation.interval_digit') . '</li>';
            }
            if (empty($post['bulk']) || $post['bulk'] == '') {
                $alert .= '<li>' . Kohana::lang('newsletter.validation.bulk_empty') . '</li>';
            } else if (!valid::digit($post['bulk'])) {
                $alert .= '<li>' . Kohana::lang('newsletter.validation.bulk_digit') . '</li>';
            }
            if (empty($post['newsletter_group']) || (!empty($post['newsletter_group']) && count($post['newsletter_group']) == 0)) {
                $alert .= '<li>' . Kohana::lang('newsletter.validation.newsletter_group_empty') . '</li>';
            }

            if (!empty($alert)) {
                $alert = '<strong>' . Kohana::lang('newsletter.following_errors') . '</strong>: <ul>' . $alert . '</ul>';
                return new ErrorReporting(ErrorReporting::ERROR, false, $alert);
            } else {
                return new ErrorReporting(ErrorReporting::SUCCESS, true, '');
            }
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('newsletter.error.validate_add'));
        }
    }

    public function FindAllEmailsByGroups($iNewsletterId, $sGroups, $iLimit, $iOffset) {
        try {
            // SELECT * FROM emails ORDER BY email LIMIT %s OFFSET %s ", $_POST['limit'], $_POST['offset']
        } catch (Exception $e) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, array(), Kohana::lang('newsletter.validate_add_error'));
        }
    }

    /**
     * Walidacja dla dodawania i edycji emaila dla newsletterów (email musibyc unikalny i nie mozebyć pusty)
     * @param Array $aPost
     * @param Integer $iEmailId
     * @return ErrorReporting
     */
    public function ValidateEmailAdd($aPost, $iEmailId = null) {

//        try {
        $alert = '';
        if (empty($aPost['email'])) { // email nie mozebyc pusty
            $alert .= 'Musisz podać adres e-mail.';
        } else if ($this->_validateMail($aPost['email']) === false) { // email musi miec prawidlowy format
            $alert .= 'Nieprawidłowy format adresu e-mail.';
        } else if ($this->_EmailExistCheck($aPost['email'], $iEmailId)->Type !== 4) { // czy istnieje juz taki adres w bazie
            $alert .= 'Podany adres już istnieje w bazie.';
        } else if (empty($aPost['newsletter_group'])) {
            $alert .= 'Zaznacz grupę.';
        }

        if (!empty($alert)) {
            //$alert = '<strong>Wystąpiły następujące błędy</strong>: <ul>' . $alert . '</ul>';
            return new ErrorReporting(ErrorReporting::ERROR, false, strip_tags($alert));
        } else {
            return new ErrorReporting(ErrorReporting::SUCCESS, true, '');
        }
//        } catch (Exception $ex) {
//            Kohana::log('error', $ex->getMessage());
//            return new ErrorReporting(ErrorReporting::ERROR, array(), Kohana::lang('newsletter.validate_email_add_error'));
//        }
    }

    /**
     *
     * @param integer $emailId
     * @return ErrorReporting
     */
    public function FindGroupsByEmail($emailId) {
        try {
            return new ErrorReporting(ErrorReporting::SUCCESS, $this->db->getwhere(table::NEWSLETTER_EMAIL_GROUPS, array('newsletter_email_id' => $emailId)), Kohana::lang('newsletter.get_email_groups_success'));
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('newsletter.get_email_groups_error'));
        }
    }

    private function createDefaulGroupIfNotExists() {
        try {
            //utwórz domyślną grupę, jeśli nie ma:
            $res = $this->db->from(table::NEWSLETTER_GROUPS)->where(array('default_group' => 1, 'lang' => Kohana::config('locale.language')))->get();
            if ($res->count() == 0) {
                $data = array(
                    'default_group' => 1
                );
                switch (Kohana::config('locale.language')) {
                    case 'en_US':
                        $result = $this->db->from(table::NEWSLETTER_GROUPS)->where(array('name' => 'Grupa domyślna EN'))->get();
                        if (!empty($result) && $result->count() > 0) {
                            $this->db->update(table::NEWSLETTER_GROUPS, array('default_group' => 1), array('id_newsletter_group' => $result[0]->id_newsletter_group));
                            return $result[0]->id_newsletter_group;
                        } else {
                            $data['name'] = 'Grupa domyślna EN';
                            $data['description'] = 'Domyslna grupa dla osób zapisanych do newslettera z angielskiej wersji językowej witryny.';
                            $this->InsertGroup($data);
                        }
                        break;
                    case 'de_DE':
                        $result = $this->db->from(table::NEWSLETTER_GROUPS)->where(array('name' => 'Grupa domyślna DE'))->get();
                        if (!empty($result) && $result->count() > 0) {
                            $this->db->update(table::NEWSLETTER_GROUPS, array('default_group' => 1), array('id_newsletter_group' => $result[0]->id_newsletter_group));
                            return $result[0]->id_newsletter_group;
                        } else {
                            $data['name'] = 'Grupa domyślna DE';
                            $data['description'] = 'Domyslna grupa dla osób zapisanych do newslettera z niemieckiej wersji językowej witryny.';
                            $this->InsertGroup($data);
                        }
                        break;
                    case 'ru_RU':
                        $result = $this->db->from(table::NEWSLETTER_GROUPS)->where(array('name' => 'Grupa domyślna RU'))->get();
                        if (!empty($result) && $result->count() > 0) {
                            $this->db->update(table::NEWSLETTER_GROUPS, array('default_group' => 1), array('id_newsletter_group' => $result[0]->id_newsletter_group));
                            return $result[0]->id_newsletter_group;
                        } else {
                            $data['name'] = 'Grupa domyślna RU';
                            $data['description'] = 'Domyslna grupa dla osób zapisanych do newslettera z rosyjskiej wersji językowej witryny.';
                            $this->InsertGroup($data);
                        }
                        break;
                    default:
                        $result = $this->db->from(table::NEWSLETTER_GROUPS)->where(array('name' => 'Grupa domyślna PL'))->get();
                        if (!empty($result) && $result->count() > 0) {
                            $this->db->update(table::NEWSLETTER_GROUPS, array('default_group' => 1), array('id_newsletter_group' => $result[0]->id_newsletter_group));

                            return $result[0]->id_newsletter_group;
                        } else {
                            $data['name'] = 'Grupa domyślna PL';
                            $data['description'] = 'Domyslna grupa dla osób zapisanych do newslettera z polskiej wersji językowej witryny.';
                            $this->InsertGroup($data);
                        }
                        break;
                }
            }
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, '');
        }
    }

    /**
     * Pobiera obrazki biuletynu
     * @param integer $iNewsletterId
     * @return ErrorReporting
     */
    public function getImages($iNewsletterId) {
        try {
            $iNewsletterId += 0;
            return new ErrorReporting(ErrorReporting::SUCCESS, $this->db->getwhere(table::NEWSLETTER_IMAGES, array('newsletter_id' => $iNewsletterId)), '');
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, '');
        }
    }

    public function exportEmailsToCsv($dialect = 'excel') {
        try {
            require_once Kohana::find_file('vendor/php-csv-utils-0.3/Csv', 'Writer', TRUE);
            require_once Kohana::find_file('vendor/php-csv-utils-0.3/Csv', 'Dialect', TRUE);
            require_once Kohana::find_file('vendor/php-csv-utils-0.3/Csv/Dialect', 'Excel', TRUE);
            if (empty($dialect) || $dialect == 'excel') {
                $dialect = new Csv_Dialect_Excel();
            }
            $filename = 'files/' . date('Y-m-d') . '-emails.csv';
            $writer = new Csv_Writer($filename, $dialect);
            $writer->writeRow(array('First Name', 'E-mail Address', 'Categories'));
            $oEmails = $this->FindAllEmails(null, null, array())->Value;
            if (!empty($oEmails) && $oEmails->count() > 0) {
                foreach ($oEmails as $email) {
                    $sCategories = '';
                    $oGroups = $this->FindGroupsByEmail($email->id_email)->Value;
                    if (!empty($oGroups) && $oGroups->count() > 0) {
                        foreach ($oGroups as $group) {
                            $sGroupName = $this->FindGroup($group->newsletter_group_id)->Value[0]->name;
                            if (!empty($sGroupName)) {
                                if (!empty($sCategories)) {
                                    $sCategories .= ';';
                                }
                                $sCategories .= $sGroupName;
                            }
                        }
                    }
                    $writer->writeRow(array($email->name, $email->email, $sCategories));
                }
                return new ErrorReporting(ErrorReporting::SUCCESS, $filename, Kohana::lang('newsletter.export_success'));
            } else {
                return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('newsletter.no_emials_to_export'));
            }
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getFile() . $ex->getLine() . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('newsletter.export_failed'));
        }
    }

    public function SaveSent($iNewsletterId, $iEmailId) {
        try {
            $this->db->insert(table::NEWSLETTER_EMAIL_SEND, array('newsletter_id' => $iNewsletterId, 'email_id' => $iEmailId, 'send_date'=>date('Y-m-d H:i:s')));
            return new ErrorReporting(ErrorReporting::SUCCESS, true);
        } catch (Exception $e) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('newsletter.validate_add_error'));
        }
    }

}
