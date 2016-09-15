<?php

defined('SYSPATH') OR die('No direct access allowed.');

/**
 *
 */
class Site_Model extends Model_Core {

    /**
     *
     * @return Site_Model
     */
    public function __construct() {
        parent::__construct();
        $this->_rDb = Database::instance();
        $this->_oProductCategory = new Product_Category_Model();
		$this->_oCustomer = new Customer_Model();
    }

	public function GetAllTags(){
        try {            
			$result = $this->_rDb
							->from(table::SHOP_PRODUCTS_TAGS . ' AS t')
							->join(table::SHOP_PRODUCTS_TAGS_DICT . ' AS td', 'td.id_tag_dict', 't.tag_dict_id', 'INNER')
							->groupby('word')
							->get();
			return new ErrorReporting(ErrorReporting::SUCCESS, $result);
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, $ex->getMessage());
        }
    }


    public function ValidateMail($email) {
        if (!preg_match('/^[^@]{1,64}@[^@]{1,255}$/', $email)) {
            // Email invalid because wrong number of characters in one section, or wrong number of @ symbols.
            return false;
        }
        // Split it into sections to make life easier
        $email_array = explode("@", $email);
        $local_array = explode(".", $email_array[0]);
        for ($i = 0; $i < sizeof($local_array); $i++) {
            if (!preg_match('/^(([A-Za-z0-9!#$%&\'*+\/=?^_`{|}~-][A-Za-z0-9!#$%&\'*+\/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$/', $local_array[$i])) {
                return false;
            }
        }
        if (!preg_match('/^\[?[0-9\.]+\]?$/', $email_array[1])) { // Check if domain is IP. If not, it should be valid domain name
            $domain_array = explode(".", $email_array[1]);
            if (sizeof($domain_array) < 2) {
                return false; // Not enough parts to domain
            }
            for ($i = 0; $i < sizeof($domain_array); $i++) {
                if (!preg_match('/^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$/', $domain_array[$i])) {
                    return false;
                }
            }
        }
        return true;
    }

    public function ValidateForm($_POST) {
        $alert = '';
        if (empty($_POST['name'])) {
            $alert .= '<li>' . Kohana::lang('app.error_name_empty') . '</li>';
        }
        if (empty($_POST['email'])) {
            $alert .= '<li>' . Kohana::lang('app.error_email_empty') . '</li>';
        } else if (!empty($_POST['email'])) {
            if (!$this->ValidateMail($_POST['email'])) {
                $alert .= '<li>' . Kohana::lang('app.error_email_format') . '</li>';
            }
        }
        if (empty($_POST['message'])) {
            $alert .= '<li>' . Kohana::lang('app.error_message_empty') . '</li>';
        }
        if (empty($_POST['s3capcha'])) {
            $alert .= '<li>' . Kohana::lang('app.error_s3capcha_empty') . '</li>';
        } else if ($_POST['s3capcha'] != $_SESSION['s3capcha']) {
            $alert .= '<li>' . Kohana::lang('app.error_s3capcha_wrong_img') . '</li>';
        }
        if (!empty($alert)) {
            $alert = Kohana::lang('app.following_errors') . ': <ul>' . $alert . '</ul>';
            return new ErrorReporting(ErrorReporting::ERROR, false, $alert);
        } else {
            return new ErrorReporting(ErrorReporting::SUCCESS, true, '');
        }
    }

    public function ValidateContactForm($_POST) {
        $alert = '';
        if (empty($_POST['name'])) {
            $alert .= '<li>' . Kohana::lang('app.error_name_empty') . '</li>';
        }
        if (empty($_POST['email'])) {
            $alert .= '<li>' . Kohana::lang('app.error_email_empty') . '</li>';
        } else if (!empty($_POST['email'])) {
            if (!$this->ValidateMail($_POST['email'])) {
                $alert .= '<li>' . Kohana::lang('app.error_email_format') . '</li>';
            }
        }
        if (empty($_POST['phone'])) {
            $alert .= '<li>' . Kohana::lang('app.error_phone_empty') . '</li>';
        }
        if (empty($_POST['city'])) {
            $alert .= '<li>' . Kohana::lang('app.error_city_empty') . '</li>';
        }
        if (empty($_POST['message'])) {
            $alert .= '<li>' . Kohana::lang('app.error_message_empty') . '</li>';
        }
        if (empty($_POST['s3capcha'])) {
            $alert .= '<li>' . Kohana::lang('app.error_s3capcha_empty') . '</li>';
        } else if ($_POST['s3capcha'] != $_SESSION['s3capcha']) {
            $alert .= '<li>' . Kohana::lang('app.error_s3capcha_wrong_img') . '</li>';
        }
        if (!empty($alert)) {
            $alert = Kohana::lang('app.following_errors') . ': <ul>' . $alert . '</ul>';
            return new ErrorReporting(ErrorReporting::ERROR, false, $alert);
        } else {
            return new ErrorReporting(ErrorReporting::SUCCESS, true, '');
        }
    }

	public function ValidatePaymentForm($aData){
		$alert = '';
		if (empty ($aData['payment']) || $aData['payment']==0) {
			$alert .= 'Nie wybrano płatności.';
		}
		if (!empty ($alert)){
			$alert = Kohana::lang('app.following_errors') . '<ul>' . $alert . '</ul>';
			return new ErrorReporting(ErrorReporting::ERROR, false, $alert);
		} else {
			return new ErrorReporting(ErrorReporting::SUCCESS, true, '');
		}
	}

    public function ValidateOrderForm($_POST) {
        $alert = '';
        if (empty($_POST['name'])) {
            $alert .= '<li>' . Kohana::lang('app.error_name_empty') . '</li>';
        }
        if (empty($_POST['email'])) {
            $alert .= '<li>' . Kohana::lang('app.error_email_empty') . '</li>';
        } else if (!empty($_POST['email'])) {
            if (!$this->ValidateMail($_POST['email'])) {
                $alert .= '<li>' . Kohana::lang('app.error_email_format') . '</li>';
            }
        }
        if (empty($_POST['message'])) {
            $alert .= '<li>' . Kohana::lang('app.error_message_empty') . '</li>';
        }
        /*
          if(empty($_POST['captcha_code'])) {
          $alert .= '<li>'.Kohana::lang('app.error_captcha_empty').'</li>';
          } else if (!empty($_POST['captcha_code'])) {
          if(Captcha::valid($_POST['captcha_code']) == false) {
          $alert .= '<li>'.Kohana::lang('app.error_captcha_code').'</li>';
          }
          } */
        if (!empty($alert)) {
            $alert = Kohana::lang('app.following_errors') . ': <ul>' . $alert . '</ul>';
            return new ErrorReporting(ErrorReporting::ERROR, false, $alert);
        } else {
            return new ErrorReporting(ErrorReporting::SUCCESS, true, '');
        }
    }

	public function ValidateSubsctiptionForm($sData){
		try {
            if (!empty ($sData) || $sData!=0){
				$oValues = $this->_oCustomer->GetSubscriptionsTypes()->Value;
				foreach ($oValues as $val){
					if ($val->subscription_value == $sData){
						$valid = true;
					}
				}
				if ($valid){					
					return new ErrorReporting(ErrorReporting::SUCCESS, $valid);
				} else {
					return new ErrorReporting(ErrorReporting::WARNING, false, 'Wybrany sposób płatności jest nieprawidłowy.');
				}
			}
			else {
				return new ErrorReporting(ErrorReporting::WARNING, false, 'Nie wybrano sposobu płatności.');
			}
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . ': ' . __LINE__ . ': ' . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('app.error_send_message'));
        }
	}

    public function SendOrderForm($_POST) {
        try {
            $swift = email::connect();
            $from = config::getConfig('administrator_email');
            $subject = 'Zapytanie z dnia: ' . date("d/m/Y") . ' dotyczące produktu ' . $_POST['product_info'];
            $message = '<strong>Wiadomość od</strong>: ' . $_POST['name'];
            $message .= '<br /><strong>Adres email</strong>: ' . $_POST['email'];
            $message .= '<br /><strong>Telefon kontaktowy</strong>: ' . $_POST['phone'];
            $message .= '<br /><strong>Zapytanie dotyczące</strong>: ' . $_POST['product_info'];
            $message .= '<br /><strong>Ilość sztuk</strong>: ' . $_POST['quantity'];
            $message .= '<br /><strong>Treść wiadomości</strong>: ' . $_POST['message'];
            $recipients = new Swift_RecipientList;
            $message = new Swift_Message($subject, $message, "text/html");
            $questionModel = new Question_Model();
            $questionModel->Insert($_POST);
            if ($swift->send($message, $recipients, $from)) {
                return new ErrorReporting(ErrorReporting::SUCCESS, true, Kohana::lang('app.success_send_message'));
            } else {
                return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('app.error_send_message'));
            }
            $swift->disconnect();
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . ': ' . __LINE__ . ': ' . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('app.error_send_message'));
        }
    }

    public function SendMessage($_POST) {
        try {
            $swift = email::connect();
            $from = config::getConfig('administrator_email');
            $subject = 'Zapytanie z dnia: ' . date("d/m/Y");
            $message = '<strong>Wiadomość od</strong>: ' . $_POST['name'];
            $message .= '<br /><strong>Adres email</strong>: ' . $_POST['email'];
            $message .= '<br /><strong>Telefon kontaktowy</strong>:' . $_POST['phone'];
            $message .= '<br /><strong>Miasto:</strong>:' . $_POST['city'] . ', woj. ' . $_POST['customer_state'];

//            if (isset($_POST['product_info'])) {
//                $message .= '<br /><strong>Zapytanie dotyczące</strong>:' . $_POST['product_info'];
//            }
            $message .= '<br /><strong>Treść wiadomości</strong>: ' . $_POST['message'];

            $recipients = new Swift_RecipientList;
            $recipients->addTo(config::getConfig('administrator_email'));

            $message = new Swift_Message($subject, $message, "text/html");
            $questionModel = new Question_Model();
            $questionModel->Insert($_POST);
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
     * Tworzenie listy kategorii dla mapy strony
     * @author Hubert Kulczak
     * @return ErrorReporting (String $html || Bool false)
     */
    public function GenerateSiteMap() {
        try {
            $categories = $this->_rDb->from(table::SHOP_CATEGORIES)
                            ->join(table::SHOP_CATEGORIES_DESCRIPTION, 'category_id', 'id_category')
                            ->get();
            $html = $this->GetCategoriesAsListForAdmin(0, $categories);
            return new ErrorReporting(ErrorReporting::SUCCESS, $html);
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('app.error_generate_site_map'));
        }
    }

    /**
     *
     * @param iteger $catId
     * @param Reference to string $html
     * @param Reference to array $categories
     */
    public function GetCategoriesAsListForAdmin($catId, &$categories, $selectId = null) {
        $html = '';
        $tmpCat = array();
        foreach ($categories as $cat) {
            if ($cat->parent_category_id == $catId) {
                $tmpCat[] = $cat;
            }
        }
        if (!empty($tmpCat)) {
            $html .= '<ul>';
            foreach ($tmpCat as $cat) {
                $html .= '<li>';
                if ($cat->parent_category_id >= 0) {
                    if ($cat->id_category == $selectId) {
                        $html .= '<strong>' . $cat->name . '</strong>';
                        $html .= $this->GetCategoriesAsListForAdmin($cat->id_category, $categories, $selectId);
                    } else {
                        $html .= html::anchor('produkty/' . $cat->id_category . '/' . string::prepareURL($cat->category_name), $cat->category_name);

                        $html .= $this->GetCategoriesAsListForAdmin($cat->id_category, $categories, $selectId);
                    }
                }
                $html .= '</li>';
            }
            $html .= '</ul>';
        }
        return $html;
    }

    //const EMAIL_FROM = 'noreply@albathyment.com.pl';

    public function AddNewsletter($Post) {
        try {
            $sEmail = $Post['newsletter_email'];

            if (empty($sEmail) || $sEmail == 'Newsletter: Wpisz swój adres e-mail') {
                return new ErrorReporting(ErrorReporting::ERROR, false, 'Należy podać adres email.');
            } else {
                if (!$this->ValidateMail($sEmail)) {
                    return new ErrorReporting(ErrorReporting::ERROR, false, 'Podany email jest niepoprawny!');
                }
                if (!$this->Subscribe($sEmail)->Value) {
                    return new ErrorReporting(ErrorReporting::ERROR, false, 'Podany email jest już zapisany do newslettera!');
                }
            }
            return new ErrorReporting(ErrorReporting::SUCCESS, true, 'Na podany email została wysłana wiadomość weryfikująca.');
        } catch (Exception $ex) {
            //var_dump($ex->getMessage());
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
        }
    }

    public function Subscribe($email) {
        try {

            $oEmail = $this->db->from(table::NEWSLETTER_EMAILS)
                            ->where(array('email' => $email))
                            ->get();
            $iEmail = $oEmail->count();
            if (empty($iEmail)) {
                $table['verify_string'] = $this->CreateString(8);
                $table['verified'] = 0;
                $table['email'] = $email;
                $table['add_date'] = time();
                $results = $this->db->insert(table::NEWSLETTER_EMAILS, $table);

                $aNewsletterEmailGroups['newsletter_email_id'] = $results->insert_id();
                $aNewsletterEmailGroups['newsletter_group_id'] = 1;
                $this->db->insert(table::NEWSLETTER_EMAIL_GROUPS, $aNewsletterEmailGroups);

                $this->SendConfirmation($table['email'], $table['verify_string']);
            } else {
                return new ErrorReporting(ErrorReporting::ERROR, false, '');
            }
            return new ErrorReporting(ErrorReporting::SUCCESS, true, '');
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('newsletter.subscribe_error'));
        }
    }

    public function SendConfirmation($email, $verifyString) {
        try {
            $swift = email::connect();

            $from = config::getConfig('administrator_email');
            $subject = 'Potwierdzenie adresu email.';
            $message = '<strong>Witaj,</strong> <br /><br />';
            $message .= 'Aby dodać swój adres e-mail do listy adresowej:<br /><br />';
            $message .= 'Newsletter '.config::getConfig('page_name').'<br /><br />';
            $message .= 'wejdź na stronę:<br />';
            $message .= 'http://' . $_SERVER['HTTP_HOST'] . url::base() . '?email=' . $email . '&verify_string=' . $verifyString . '<br /><br />';
            $message .= 'Otrzymałeś/aś ten list, ponieważ Twój adres e-mail został wpisany na naszą listę. Jeśli nie wiesz o co chodzi,
                prawdopodobnie ktoś zrobił Ci kawał - w takim wypadku po prostu zignoruj tę wiadomość.<br />';


            $recipients = new Swift_RecipientList;
            $recipients->addTo($email);

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

    public function ConfirmSubscribe($email, $verify_string) {
        try {
            $result = $this->db->from(table::NEWSLETTER_EMAILS)
                            ->where(array('email' => $email))
                            ->get();
            if ($result->count() > 0) {
                if ($result[0]->verify_string == $verify_string) {
                    if ($result[0]->verified) {
                        return new ErrorReporting(ErrorReporting::WARNING, false, Kohana::lang('newsletter.email_verified_error'));
                    } else {
                        $this->db->update(table::NEWSLETTER_EMAILS, array('verified' => 1), array('email' => $email));
                    }
                } else {
                    return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('newsletter.wrong_verify_string_error'));
                }
            } else {
                return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('newsletter.wrong_link_error'));
            }
            return new ErrorReporting(ErrorReporting::SUCCESS, true, Kohana::lang('newsletter.confirm_subscribe_success'));
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('newsletter.subscribe_error'));
        }
    }

    public function SendingContactForm() {
        if (!empty($_POST['contact_form_submit'])) {
            $oCheck = $this->contactForm->ValidateSend($_POST);
            if ($oCheck->Value == true) {
                $result = $this->contactForm->SendMessage($_POST);
                $this->_oSession->set('message', $result->__toString());
            } else {
                $this->_oSession->set('message', $oCheck->__toString());
            }
        }
    }

    public function SendFormMessage() {
        try {
            $sSubject = 'Zapytanie z dnia: ' . date("d/m/Y");
            $sMessage = 'Wiadomość wysłana ze strony '.config::getConfig('page_name').'.';
            $sMessage .= '<br /><strong>Wiadomość od</strong>: ' . $_POST['name'];
            $sMessage .= '<br /><strong>Adres email</strong>: ' . $_POST['email'];
            $sMessage .= '<br /><strong>Telefon kontaktowy</strong>: ' . $_POST['phone'];
            $sMessage .= '<br /><strong>Miasto</strong>: ' . $_POST['city'] . ', woj. ' . $_POST['customer_state'];
            $sMessage .= '<br /><strong>Treść wiadomości</strong>: ' . $_POST['message'];
            $aRecipents = array(config::getConfig('administrator_email'));
            $sEmail = $_POST['email'];
            return layer::SendMessage($sSubject, $sMessage, $aRecipents, $sEmail);
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('app.error_send_message'));
        }
    }
        public function ValidateComplaintForm($_POST) {
        $alert = '';
        if (empty($_POST['name'])) {
            $alert .= '<li>' . Kohana::lang('app.error_name_empty') . '</li>';
        }
        if (empty($_POST['email'])) {
            $alert .= '<li>' . Kohana::lang('app.error_email_empty') . '</li>';
        } else if (!empty($_POST['email'])) {
            if (!$this->ValidateMail($_POST['email'])) {
                $alert .= '<li>' . Kohana::lang('app.error_email_format') . '</li>';
            }
        }
        if (empty($_POST['phone'])) {
            $alert .= '<li>' . Kohana::lang('app.error_phone_empty') . '</li>';
        }

        if (empty($_POST['message'])) {
            $alert .= '<li>' . Kohana::lang('app.error_message_empty') . '</li>';
        }        
        
        if (empty($_POST['s3capcha'])) {
            $alert .= '<li>' . Kohana::lang('app.error_s3capcha_empty') . '</li>';
        } else if ($_POST['s3capcha'] != $_SESSION['s3capcha']) {
            $alert .= '<li>' . Kohana::lang('app.error_s3capcha_wrong_img') . '</li>';
        }
        if (empty ($_POST['data_processing'])){
            $alert .= '<li>' . Kohana::lang('app.error_data_processing_not_checked') . '</li>';
        }
        if (!empty($alert)) {
            $alert = Kohana::lang('app.following_errors') . ': <ul>' . $alert . '</ul>';
            return new ErrorReporting(ErrorReporting::ERROR, false, $alert);
        } else {
            return new ErrorReporting(ErrorReporting::SUCCESS, true, '');
        }
    }
    public function SendComplaintMessage() {
        try {
            $sSubject = 'Reklamacja/skarga z dnia: ' . date("d/m/Y");
            $sMessage = 'Wiadomość wysłana ze strony '.config::getConfig('page_name').'.';
            $sMessage .= '<br /><strong>Wiadomość od</strong>: ' . $_POST['name'];
            $sMessage .= '<br /><strong>Adres email</strong>: ' . $_POST['email'];
            $sMessage .= '<br /><strong>Telefon kontaktowy</strong>: ' . $_POST['phone'];
            $sMessage .= '<br /><strong>Treść wiadomości</strong>: ' . $_POST['message'];
            $aRecipents = array(config::getConfig('administrator_email'));
            $sEmail = $_POST['email'];
            return layer::SendMessage($sSubject, $sMessage, $aRecipents, $sEmail);
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('app.error_send_message'));
        }
    }
	public function SendDetailedCostingMessage(){
		try {
            $sSubject = 'Wiadomość z dnia: ' . date("d/m/Y");
            $sMessage = 'Wiadomość wysłana ze strony '.config::getConfig('page_name').'.';
            $sMessage .= '<br /><strong>Wiadomość od</strong>: ' . $_POST['name'];
            $sMessage .= '<br /><strong>Adres email</strong>: ' . $_POST['email'];
            $sMessage .= '<br /><strong>Telefon kontaktowy</strong>: ' . $_POST['phone'];
            $sMessage .= '<br /><strong>Treść wiadomości</strong>: ' . $_POST['message'];
            $aRecipents = array(config::getConfig('administrator_email'));
            $sEmail = $_POST['email'];
			$aAttachment = array();
			for ($i=1; $i<=3; $i++){
				if (!empty($_FILES['file' . $i]['tmp_name'])){
					$aAttachment['file'.$i] = $_FILES['file' . $i];
				}
			}
            return layer::SendMessage($sSubject, $sMessage, $aRecipents, $sEmail, $aAttachment);
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('app.error_send_message'));
        }
	}

	public function ValidateDetailedCostForm($aData){
		$alert = '';
        if (empty($_POST['name'])) {
            $alert .= '<li>' . Kohana::lang('app.error_name_empty') . '</li>';
        }
        if (empty($_POST['email'])) {
            $alert .= '<li>' . Kohana::lang('app.error_email_empty') . '</li>';
        } else if (!empty($_POST['email'])) {
            if (!$this->ValidateMail($_POST['email'])) {
                $alert .= '<li>' . Kohana::lang('app.error_email_format') . '</li>';
            }
        }
        if (empty($_POST['phone'])) {
            $alert .= '<li>' . Kohana::lang('app.error_phone_empty') . '</li>';
        }
        if (empty($_POST['city'])) {
            $alert .= '<li>' . Kohana::lang('app.error_city_empty') . '</li>';
        }
        if (empty($_POST['message'])) {
            $alert .= '<li>' . Kohana::lang('app.error_message_empty') . '</li>';
        }
        if (empty($_POST['s3capcha'])) {
            $alert .= '<li>' . Kohana::lang('app.error_s3capcha_empty') . '</li>';
        } else if ($_POST['s3capcha'] != $_SESSION['s3capcha']) {
            $alert .= '<li>' . Kohana::lang('app.error_s3capcha_wrong_img') . '</li>';
        }
        if (!empty($alert)) {
            $alert = Kohana::lang('app.following_errors') . ': <ul>' . $alert . '</ul>';
            return new ErrorReporting(ErrorReporting::ERROR, false, $alert);
        } else {
            return new ErrorReporting(ErrorReporting::SUCCESS, true, '');
        }
	}

}