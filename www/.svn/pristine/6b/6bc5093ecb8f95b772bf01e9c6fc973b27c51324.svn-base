<?php

defined('SYSPATH') OR die('No direct access allowed.');

class Customer_Model extends Model_Core {

    public function __construct($id = null) {
        $this->_rDb = Database::instance();
        $this->_oSession = Session::instance();
        $this->_aLanguage = Kohana::config('locale.language');
    }

    /**
     * Logowanie użytkownika
     * @author Hubert Kulczak
     * @param Array $aPost
     * @return ErrorReporting (Array $aCustomerSession || Bool false)
     */
    public function AuthorizeCustomer($aPost) {
//        echo Kohana::debug($aPost);
//        exit;
        try {
            $password = $this->_rDb->query("SELECT PASSWORD('{$aPost['customer_password']}') AS `password`");
            $aPost['customer_password'] = $password[0]->password;
            //var_dump($aPost);
            $aPost['verified'] = 'Y';
            $aPost['active'] = 'Y';
            unset($aPost['login'], $aPost['fromorder']);
            if (isset($aPost['loginAttempt'])) {
                unset($aPost['loginAttempt']);
            }
            if ($this->_Exists($aPost)->Value === true) {
                // logujemy
                $aCustomerSession = array();
                $oCustomerData = $this->FindCustomer($aPost)->Value[0];
                $aCustomerSession['logged_in'] = true;
                foreach ($oCustomerData as $key => $data) {
                    //if (!empty($data)){
                    $aCustomerSession[$key] = $data;
                    //}
                }
                $aCustomerSession['first_name'] = $oCustomerData->customer_first_name;
                $aCustomerSession['last_name'] = $oCustomerData->customer_last_name;
                $aCustomerSession['email'] = $oCustomerData->customer_email;
                $aCustomerSession['customer_id'] = $oCustomerData->id_customer;

                unset($aCustomerSession['customer_password'], $aCustomerSession['verify_string']);
                // sprawdzenie wygaśnięcia abonamentów dla użytkownika
                $this->CheckCustomerSubscriptions($aCustomerSession['id_customer']);
                return new ErrorReporting(ErrorReporting::SUCCESS, $aCustomerSession, Kohana::lang('customer.validation.success_login'));
            } else {
                return new ErrorReporting(ErrorReporting::WARNING, false, Kohana::lang('customer.validation.wrong_email_or_password'));
            }
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . ': ' . __LINE__ . ': ' . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, $ex->getMessage());
        }
    }

    public function GetActiveCustomerSubscriptions($iCustomerId) {
        try {
            $result = $this->_rDb->from(table::SHOP_CUSTOMERS_SUBSCRIPTIONS)->where(array('customer_id' => $iCustomerId, 'active' => 'Y', 'confirmed' => 'Y'))->orderby('end_time', 'DESC')->get();
            if ($result->count() > 0 && !empty($result)) {
                return new ErrorReporting(ErrorReporting::SUCCESS, $result);
            } else {
                return new ErrorReporting(ErrorReporting::WARNING, false);
            }
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . ': ' . __LINE__ . ': ' . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, $ex->getMessage());
        }
    }

    public function GetAllSubscriptionsForCustomer($iCustomerId) {
        try {
            $result = $this->_rDb->from(table::SHOP_CUSTOMERS_SUBSCRIPTIONS)
                    ->where(array('customer_id' => $iCustomerId))
                    ->orderby('subscription_added', 'DESC')
                    ->get();
            if ($result->count() > 0 && !empty($result)) {
                return new ErrorReporting(ErrorReporting::SUCCESS, $result);
            } else {
                return new ErrorReporting(ErrorReporting::INFO, $result, 'Nie został jeszcze wykupiony żaden abonament.');
            }
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . ': ' . __LINE__ . ': ' . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, $ex->getMessage());
        }
    }

    public function CheckCustomerSubscriptions($iCustomerId) {
        try {
            $result = $this->_rDb->from(table::SHOP_CUSTOMERS_SUBSCRIPTIONS)->where(array('customer_id' => $iCustomerId, 'active' => 'Y'))->get();
            if (!empty($result) && $result->count() > 0) {
                foreach ($result as $res) {
                    $time = time() - $res->end_time;
                    if ($time >= 0) {
                        //użytkownikowi wygasła subskrypcja
                        $this->_rDb->update(table::SHOP_CUSTOMERS_SUBSCRIPTIONS, array('active' => 'N'), array('id_shop_customers_subscription' => $res->id_shop_customers_subscription));
//							unset($res);
                    }
                }
            }
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . ': ' . __LINE__ . ': ' . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, $ex->getMessage());
        }
    }

    public function GetSubscriptionsTypes($iSubscriptionValue = false) {
        try {
            $this->_rDb->from(table::DICT_SUBSCRIPTIONS);
            if (!empty($iSubscriptionValue) && $iSubscriptionValue > 0) {
                $this->_rDb->where(array('subscription_value' => $iSubscriptionValue));
            }
            $result = $this->_rDb->get();
//					echo '<pre>';
//					var_dump($result);
//					echo '</pre>';
//					exit;

            if (!empty($result) && $result->count() > 0) {
                return new ErrorReporting(ErrorReporting::SUCCESS, $result);
            } else {
                return new ErrorReporting(ErrorReporting::WARNING, false, 'Nie wprowadzono jeszcze żadnej kategorii subskrypcji');
            }
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . ': ' . __LINE__ . ': ' . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, $ex->getMessage());
        }
    }

    public function AddRequestToLog($aData) {
        try {
            if (!empty($aData)) {
                if (!empty($_SESSION['_customer']['customer_id'])) {
                    $customer = $_SESSION['_customer']['customer_id'];
                } else {
                    $customer = '';
                }
                $result = $this->_rDb->insert(table::LOGS, array(
                    'type' => 'request',
                    'created_at' => time(),
                    'customer_id' => $customer,
                    'content' => var_export($aData, TRUE),
                    'file' => __FILE__,
                    'line' => __LINE__));
            }
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . ': ' . __LINE__ . ': ' . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, $ex->getMessage());
        }
    }

    public function AddResponseToLog($aData, $iCustomerId) {
        try {
            if (!empty($aData) && !empty($iCustomerId)) {
                $result = $this->_rDb->insert(table::LOGS, array(
                    'type' => 'response',
                    'created_at' => time(),
                    'customer_id' => $iCustomerId,
                    'content' => var_export($aData, TRUE),
                    'file' => __FILE__,
                    'line' => __LINE__));
            }
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . ': ' . __LINE__ . ': ' . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, $ex->getMessage());
        }
    }

    /**
     * Zmiana hasła
     * @author Hubert Kulczak
     * @param Integer $iCustomerId
     * @param Array $aPost
     * @return ErrorReporting (MySQL Object $result || Bool false)
     */
    public function ChangePassword($iCustomerId, array $aPost) {
        try {
            $iCustomerId+=0;
            unset($aPost['submit']);
            $password = $this->_rDb->query("SELECT PASSWORD('" . $aPost['new_password'] . "') AS password");
            $aData = array();
            $aData['customer_password'] = $password[0]->password;
            $aData['id_customer'] = $iCustomerId;
            $oUpdate = $this->UpdateCustomer($iCustomerId, $aData);
            return $oUpdate;
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . ': ' . __LINE__ . ': ' . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, $ex->getMessage());
        }
    }

    /**
     * Ilość klientów
     * @author Hubert Kulczak
     * @return ErrorReporting (MySQL Object $result || Bool false)
     */
    public function Count() {
        try {
            $result = $this->FindAll(false, false, true)->Value;
            return new ErrorReporting(ErrorReporting::SUCCESS, $result[0]->count, '');
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . ': ' . __LINE__ . ': ' . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, $ex->getMessage());
        }
    }

    /**
     * Usuwanie klientów.
     * @author Hubert Kulczak
     * @param Integer $iCustomerId
     * @return ErrorReporting (Bool true || Bool false)
     */
    public function DeleteCustomer($iCustomerId) {
        try {
            $iCustomerId+=0;
            $this->_rDb->delete(table::SHOP_CUSTOMERS, array('id_customer' => $iCustomerId));
            return new ErrorReporting(ErrorReporting::SUCCESS, true, Kohana::lang('customer.delete_success'));
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . ': ' . __LINE__ . ': ' . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('customer.delete_error'));
        }
    }

    /**
     * Usuwanie klientów podanych w tablicy (checkboxy z listy klientów).
     * @author Hubert Kulczak
     * @param Array $aCustomersIds
     * @return ErrorReporting (Bool true || Bool false)
     */
    public function DeleteCustomerArray($aCustomersIds) {
        try {
            foreach ($aCustomersIds as $CI) {
                $this->DeleteCustomer($CI);
            }
            return new ErrorReporting(ErrorReporting::SUCCESS, true, Kohana::lang('customer.delete_success'));
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . ': ' . __LINE__ . ': ' . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('customer.delete_error'));
        }
    }

    /**
     * Sprawdzenie czy klient istnieje
     * @param Array $aData
     * @return ErrorReporting (Bool true || Bool false)
     */
    private function _Exists($aData) {
        try {
            //var_dump($aData);
            $aData['active'] = 'Y';
            $aData['verified'] = 'Y';
            $result = $this->_rDb->from(table::SHOP_CUSTOMERS)
                    ->where($aData)
                    ->select('COUNT(*) AS count')
                    ->get();
            //var_dump($result); exit;
            if ($result[0]->count > 0) {
                return new ErrorReporting(ErrorReporting::SUCCESS, true, Kohana::lang('customer.validation.customer_exists'));
            }
            return new ErrorReporting(ErrorReporting::INFO, false, Kohana::lang('customer.validation.customer_not_exists'));
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . ': ' . __LINE__ . ': ' . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('customer.validation.error_customer_exists'));
        }
    }

    /**
     * Pobiera dane klienta
     * @author Hubert Kulczak
     * @param Array $aWhere
     * @return ErrorReporting (MySQL Object $result || Bool false)
     */
    public function FindCustomer($aWhere) {
        try {
            $result = $this->_rDb->from(table::SHOP_CUSTOMERS)
                    ->where($aWhere)
                    ->limit(1)
                    ->get();
            return new ErrorReporting(ErrorReporting::SUCCESS, $result, '');
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . ': ' . __LINE__ . ': ' . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, $ex->getMessage());
        }
    }

    /**
     * Pobiera dane klientów.
     * @author Hubert Kulczak
     * @param Integer $limit
     * @param Integer $offset
     * @param Bool $bCount
     * @param Array $aLike
     * @return ErrorReporting (MySQL Object $result || Bool false)
     */
    public function FindAll($limit = null, $offset = null, $bCount = null, $aLike = null) {
        try {
            $customers_orderby = 'customer_last_name';
            $kind = 'ASC';

            if (!empty($_GET['customers_orderby']) && $_GET['customers_orderby'] == 1) {
                $customers_orderby = 'customer_last_name';
                $kind = 'ASC';
            } else if (!empty($_GET['customers_orderby']) && $_GET['customers_orderby'] == 2) {
                $customers_orderby = 'customer_last_name';
                $kind = 'DESC';
            }

            $this->_rDb->from(table::SHOP_CUSTOMERS);
            if (!empty($limit) && isset($offset)) {
                $this->_rDb->limit($limit, $offset);
            }
            if (!empty($bCount)) {
                $this->_rDb->select('COUNT(*) AS count');
            }
            if (!empty($aLike) && count($aLike) > 0) {
                $this->_rDb->like($aLike);
            }
            $result = $this->_rDb->orderby($customers_orderby, $kind)->get();
            return new ErrorReporting(ErrorReporting::SUCCESS, $result, '');
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . ': ' . __LINE__ . ': ' . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, $ex->getMessage());
        }
    }

    /**
     * Filip Górczyński <a href="mailto:filip.gorczynski@gmail.com">filip.gorczynski@gmail.com</a>
     *
     * @param Integer $length
     * @param Integer $strength
     * @return String
     */
    private function _generatePassword($length = 9, $strength = 0) {
        $vowels = 'aeuy';
        $consonants = 'bdghjmnpqrstvz';
        if ($strength & 1) {
            $consonants .= 'BDGHJLMNPQRSTVWXZ';
        }
        if ($strength & 2) {
            $vowels .= "AEUY";
        }
        if ($strength & 4) {
            $consonants .= '23456789';
        }
        if ($strength & 8) {
            $consonants .= '1xyz';
        }

        $password = '';
        $alt = time() % 2;
        for ($i = 0; $i < $length; $i++) {
            if ($alt == 1) {
                $password .= $consonants[(rand() % strlen($consonants))];
                $alt = 0;
            } else {
                $password .= $vowels[(rand() % strlen($vowels))];
                $alt = 1;
            }
        }
        return $password;
    }

    public static function GetLogedInfo() {
        if (Customer_Model::IsLogin()->Value === true) {
            if (!empty($_SESSION['_customer']['first_name']) || $_SESSION['_customer']['last_name']) {
                return $_SESSION['_customer']['first_name'] . ' ' . $_SESSION['_customer']['last_name'];
            } else {
                return $_SESSION['_customer']['email'];
            }
        }
    }

    /**
     * Rejestracja klienta
     * @author Hubert Kulczak
     * @param Array $aPost
     * @return ErrorReporting (Bool true || Bool false)
     */
    public function InsertCustomer(array $aPost) {
        try {
            unset($aPost['register'], $aPost['customer_password_repeat'], $aPost['customer_email_repeat'], $aPost['customer_inny_adres']);
            $real_password = $aPost['customer_password'];
            $password = $this->_rDb->query("SELECT PASSWORD('" . $aPost['customer_password'] . "') AS password");
            $aPost['customer_password'] = $password[0]->password;
            $aPost['verified'] = 'N'; //TODO: dorobic weryfikacje jesli bedzie potrzeba
            $aPost['verify_string'] = shop::genToken(32, true);
            $aPost['active'] = 'Y';

            if (!empty($aPost['customer_reg_accept']) && $aPost['customer_reg_accept'] == 'confirmed') {
                $aPost['accept_terms'] = 1;
                unset($aPost['customer_reg_accept']);
            }

            if (!empty($aPost['customer_reg_accept2']) && $aPost['customer_reg_accept2'] == 'confirmed') {
                $aPost['accept_terms2'] = 1;
                unset($aPost['customer_reg_accept2']);
            }

            if (!empty($aPost['customer_accept3']) && $aPost['customer_accept3'] == 'confirmed') {
                $aPost['accept_terms3'] = 1;
                unset($aPost['customer_accept3']);
            }




            $this->_rDb->insert(table::SHOP_CUSTOMERS, $aPost);


            $sTitle = Kohana::lang('emails.register.title');
//            $aMsg = array($aPost['customer_first_name'] . ', ' . $aPost['customer_last_name'] . ' (' . $aPost['customer_company_name'] . ')', $aPost['customer_email'], $real_password, $aPost['verify_string']);
//            $sMessage = Kohana::lang('emails.register.message', $aMsg);
            $aRecipents = array($aPost['customer_email']);
            $vEmailBody = new View('emails/email_template');
            $vEmailBody->vEmailContent = new View('emails/user_registered');
            $vEmailBody->vEmailContent->user = (!empty($aPost['customer_first_name']) && !empty($aPost['customer_last_name'])) ? ($aPost['customer_first_name'] . ' ' . $aPost['customer_last_name']) : ('użytkownika konta mailowego ' . $aPost['customer_email']);
            $vEmailBody->vEmailContent->user_password = $real_password;
            $vEmailBody->vEmailContent->user_login = $aPost['customer_email'];
            $vEmailBody->vEmailContent->verify_string = $aPost['verify_string'];

            layer::SendMessage($sTitle, $vEmailBody, $aRecipents);

            $sTitle = Kohana::lang('emails.new_customer_registered.title');
            $aRecipents = array(config::getConfig('administrator_email'));
            $vEmailBody = new View('emails/email_template');
            $vEmailBody->vEmailContent = new View('emails/admin_user_registered');
            $vEmailBody->vEmailContent->time = TIME;
            $vEmailBody->vEmailContent->user = (!empty($aPost['customer_first_name']) && !empty($aPost['customer_last_name'])) ? ($aPost['customer_first_name'] . ' ' . $aPost['customer_last_name'] . ' (' . $aPost['customer_email'] . ')') : ('użytkownik konta mailowego ' . $aPost['customer_email']);

            layer::SendMessage($sTitle, $vEmailBody, $aRecipents);

            return new ErrorReporting(ErrorReporting::SUCCESS, true, Kohana::lang('customer.insert_customer_success'));
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . ': ' . __LINE__ . ': ' . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('customer.insert_customer_error'));
        }
    }

    /**
     * 	Do wysyłania widomości z panelu do klienta z linkiem do weryfikacji konta
     *
     */
    public function SendVerificationMail($iCustomerId) {
        try {
            // pobieramy usera
            $oCustomer = $this->FindCustomer(array('id_customer' => $iCustomerId))->Value;

            $real_password = $this->_generatePassword();
            $password = $this->_rDb->query("SELECT PASSWORD('" . $real_password . "') AS password");
            $aArr = array();
            $aArr['customer_password'] = $password[0]->password;
            $this->_rDb->update(table::SHOP_CUSTOMERS, $aArr, array('id_customer' => $iCustomerId));

            $sTitle = Kohana::lang('emails.register.title');
            $aRecipents = array($oCustomer[0]->customer_email);
            $vEmailBody = new View('emails/email_template');
            $vEmailBody->vEmailContent = new View('emails/user_registered');
            $vEmailBody->vEmailContent->user = (!empty($oCustomer[0]->customer_first_name) && !empty($oCustomer[0]->customer_last_name)) ? ($oCustomer[0]->customer_first_name . ' ' . $oCustomer[0]->customer_last_name) : ('użytkownika konta mailowego ' . $oCustomer[0]->customer_email);
            $vEmailBody->vEmailContent->user_password = $real_password;
            $vEmailBody->vEmailContent->user_login = $oCustomer[0]->customer_email;
            $vEmailBody->vEmailContent->verify_string = $oCustomer[0]->verify_string;

            layer::SendMessage($sTitle, $vEmailBody, $aRecipents);
            return new ErrorReporting(ErrorReporting::SUCCESS, true, 'Wiadomość z linkiem do weryfikacji konta została wysłana.');
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . ': ' . __LINE__ . ': ' . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, 'Wystąpił błąd podczas wysyłania wiadomości.');
        }
    }

    public function InsertCustomerFromOrder(array $aPost) {
        try {

            //	var_dump($aPost);
            //	exit;

            unset($aPost['lang'], $aPost['currency'], $aPost['payment_type_id'], $aPost['payment_cost'], $aPost['payment_options'], $aPost['rebate_code'], $aPost['delivery_type_id'], $aPost['count'], $aPost['delivery_options'], $aPost['customer_password_repeat'], $aPost['delivery_cost'], $aPost['customer_register_inorder'], $aPost['customer_note'], $aPost['confirm_order']);
            $real_password = $aPost['customer_password'];
            $password = $this->_rDb->query("SELECT PASSWORD('" . $aPost['customer_password'] . "') AS password");
            $aPost['customer_password'] = $password[0]->password;
            $aPost['verified'] = 'N'; //TODO: dorobic weryfikacje jesli bedzie potrzeba
            $aPost['verify_string'] = shop::genToken(32, true);
            $aPost['active'] = 'Y';

            if (!empty($aPost['customer_reg_accept']) && $aPost['customer_reg_accept'] == 'confirmed') {
                $aPost['accept_terms'] = 1;
                unset($aPost['customer_reg_accept']);
            }

            if (!empty($aPost['customer_reg_accept2']) && $aPost['customer_reg_accept2'] == 'confirmed') {
                $aPost['accept_terms2'] = 1;
                unset($aPost['customer_reg_accept2']);
            }



            if (!empty($aPost['customer_accept3']) && $aPost['customer_accept3'] == 'confirmed') {
                $aPost['accept_terms3'] = 1;
                unset($aPost['customer_accept3']);
            }



            $result = $this->_rDb->insert(table::SHOP_CUSTOMERS, $aPost);


            $sTitle = Kohana::lang('emails.register.title');
//            $aMsg = array($aPost['customer_first_name'] . ', ' . $aPost['customer_last_name'] . ' (' . $aPost['customer_company_name'] . ')', $aPost['customer_email'], $real_password, $aPost['verify_string']);
//            $sMessage = Kohana::lang('emails.register.message', $aMsg);
            $aRecipents = array($aPost['customer_email']);
            $vEmailBody = new View('emails/email_template');
            $vEmailBody->vEmailContent = new View('emails/user_registered');
            $vEmailBody->vEmailContent->user = (!empty($aPost['customer_first_name']) && !empty($aPost['customer_last_name'])) ? ($aPost['customer_first_name'] . ' ' . $aPost['customer_last_name']) : ('użytkownika konta mailowego ' . $aPost['customer_email']);
            $vEmailBody->vEmailContent->user_password = $real_password;
            $vEmailBody->vEmailContent->user_login = $aPost['customer_email'];
            $vEmailBody->vEmailContent->verify_string = $aPost['verify_string'];

            layer::SendMessage($sTitle, $vEmailBody, $aRecipents);

            $sTitle = Kohana::lang('emails.new_customer_registered.title');
            $aRecipents = array(config::getConfig('administrator_email'));
            $vEmailBody = new View('emails/email_template');
            $vEmailBody->vEmailContent = new View('emails/admin_user_registered');
            $vEmailBody->vEmailContent->time = TIME;
            $vEmailBody->vEmailContent->user = (!empty($aPost['customer_first_name']) && !empty($aPost['customer_last_name'])) ? ($aPost['customer_first_name'] . ' ' . $aPost['customer_last_name'] . ' (' . $aPost['customer_email'] . ')') : ('użytkownik konta mailowego ' . $aPost['customer_email']);

            layer::SendMessage($sTitle, $vEmailBody, $aRecipents);

            return new ErrorReporting(ErrorReporting::SUCCESS, $result->insert_id(), Kohana::lang('customer.insert_customer_success'));
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . ': ' . __LINE__ . ': ' . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('customer.insert_customer_error'));
        }
    }

    /**
     *  Sprawdzanie czy klient jest zalogowany.
     * @return ErrorReporting (Bool true || Bool false)
     */
    public static function IsLogin() {
        try {
            if (!empty($_SESSION['_customer']['logged_in']) && $_SESSION['_customer']['logged_in'] === true) {
                return new ErrorReporting(ErrorReporting::SUCCESS, true, '');
            }
            return new ErrorReporting(ErrorReporting::WARNING, false, '');
        } catch (Exception $e) {
            Kohana::log('error', __FILE__ . ': ' . __LINE__ . ': ' . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, '');
        }
    }

    /**
     *  Wylogowywanie.
     * @return ErrorReporting (Bool true || Bool false)
     */
    public function Logout() {
        try {
            $_SESSION['_customer'] = array();
            return new ErrorReporting(ErrorReporting::SUCCESS, true, Kohana::lang('customer.validation.success_logout'));
        } catch (Exception $e) {
            Kohana::log('error', __FILE__ . ': ' . __LINE__ . ': ' . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('customer.validation.error_logout'));
        }
    }

    /**
     * Wysyłanie nowego hasła użytkownikowi.
     * @return ErrorReporting (Bool true || Bool false)
     */
    public function SendCustomerRecoveryPassword($_POST) {
        try {
            //sprawdzamy czy klient istnieje
            $oClientExist = $this->_Exists(array('customer_email' => $_POST['customer_email']));
            if ($oClientExist->Value === true) { // istnieje wiec mozemy wysylac powiadomienie
                $sNewPassword = $this->_generatePassword();
                //zapisujemy hasło do bazy
                //Kohana::log('error', $sNewPassword);
                $password = $this->_rDb->query("SELECT PASSWORD('{$sNewPassword}') AS password");
                $sNewPass = $password[0]->password;
                //Kohana::log('error', $sNewPass);
                $this->_rDb->update(table::SHOP_CUSTOMERS, array('customer_password' => $sNewPass), array('customer_email' => $_POST['customer_email']));

                $args = array($_POST['customer_email'], $sNewPassword);

                $sSubject = Kohana::lang('emails.password_recover.title');
                $aRecipents = array($_POST['customer_email']);
                //$sMessage = Kohana::lang('emails.password_recover.message', $args);
                //
                $vEmailBody = new View('emails/email_template');
                $vEmailBody->vEmailContent = new View('emails/password_recover');
                $vEmailBody->vEmailContent->email = $_POST['customer_email'];
                $vEmailBody->vEmailContent->new_password = $sNewPassword;
                //

                layer::SendMessage($sSubject, $vEmailBody, $aRecipents);
                return new ErrorReporting(ErrorReporting::SUCCESS, true, Kohana::lang('customer.validation.success_recover_password'));
            } else { // nie istnieje
                return new ErrorReporting(ErrorReporting::WARNING, false, Kohana::lang('customer.validation.customer_email_not_exist'));
            }
        } catch (Exception $e) {
            Kohana::log('error', __FILE__ . ': ' . __LINE__ . ': ' . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('customer.validation.error_recover_password'));
        }
    }

    /**
     * @author Hubert Kulczak
     * @param Integer $iCustomerId
     * @param Array $aPost
     * @return ErrorReporting (Bool true || Bool false
     */
    public function UpdateCustomer($iCustomerId, array $aPost) {
        try {
            $iCustomerId+=0;
            unset($aPost['back'], $aPost['submit']);
            $this->_rDb->update(table::SHOP_CUSTOMERS, $aPost, array('id_customer' => $iCustomerId));
            return new ErrorReporting(ErrorReporting::SUCCESS, true, Kohana::lang('customer.update_producer_success'));
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . ': ' . __LINE__ . ': ' . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('customer.update_producer_error'));
        }
    }

    /**
     * Walidacja przy zmianie hasła
     * @author Hubert Kulczak
     * @param Integer $iCustomerId
     * @param Array $aPost
     * @return ErrorReporting (Bool true || Bool false
     */
    public function ValidateChangePassword($iCustomerId, array $aPost) {
        try {
            $alert = '';
            $iCustomerId+=0;
            unset($aPost['back'], $aPost['submit']);
            // pola nie moga byc puste
            if (empty($aPost['password'])) {
                $alert .= '<li>' . Kohana::lang('customer.validation.error_old_password_empty') . '</li>';
            } else if (strlen($aPost['password']) < 6) {
                $alert .= '<li>' . Kohana::lang('customer.validation.error_customer_old_password_too_short') . '</li>';
            }
            if (empty($aPost['new_password'])) {
                $alert .= '<li>' . Kohana::lang('customer.validation.error_new_password_empty') . '</li>';
            } else if (strlen($aPost['new_password']) < 6) {
                $alert .= '<li>' . Kohana::lang('customer.validation.error_customer_new_password_too_short') . '</li>';
            }
            if (empty($aPost['new_password_repeat'])) {
                $alert .= '<li>' . Kohana::lang('customer.validation.error_new_password_repeat_empty') . '</li>';
            } else if (strlen($aPost['new_password_repeat']) < 6) {
                $alert .= '<li>' . Kohana::lang('customer.validation.error_customer_new_password_repeat_too_short') . '</li>';
            }
            if (!empty($aPost['new_password']) && !empty($aPost['new_password_repeat']) && $aPost['new_password'] != $aPost['new_password_repeat']) {
                $alert .= '<li>' . Kohana::lang('customer.validation.error_wrong_new_password_repeat') . '</li>';
            }
            // sprawdzenie czy haslo jest poprawne
            $aData = array();
            $password = $this->_rDb->query("SELECT PASSWORD('{$aPost['password']}') AS password");
            $aData['customer_password'] = $password[0]->password;
            $aData['id_customer'] = $iCustomerId;
            if ($this->_Exists($aData)->Value === false) {
                $alert .= '<li>' . Kohana::lang('customer.validation.error_wrong_password') . '</li>';
            }


            if (!empty($alert)) {
                $alert = Kohana::lang('customer.validation.following_errors') . ': <ul>' . $alert . '</ul>';
                return new ErrorReporting(ErrorReporting::ERROR, false, $alert);
            } else {
                return new ErrorReporting(ErrorReporting::SUCCESS, true, '');
            }
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . ': ' . __LINE__ . ': ' . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('customer.validation.change_password_error'));
        }
    }

    /**
     * Walidacja dla rejestracji klienta od strony aplikacji
     * @author Hubert Kulczak
     * @param Array $aPost
     * @return ErrorReporting
     */
    public function ValidateInsertCustomer($aPost) {
        try {
            $alert = '';
            //czy klient istnieje
            $aCheck = array('customer_email' => $aPost['customer_email']);
            $oExistCheck = $this->_Exists($aCheck);
            if ($oExistCheck->Value === true) {
                $alert .= '<li>' . $oExistCheck->Message . '</li>';
            } else if ($oExistCheck->Type != ErrorReporting::ERROR) {
                if (empty($aPost['customer_email'])) {
                    $alert .= '<li>' . Kohana::lang('customer.validation.error_customer_email_empty') . '</li>';
                } else if (!layer::ValidateMail($aPost['customer_email'])) {
                    $alert .= '<li>' . Kohana::lang('customer.validation.error_customer_email_format') . '</li>';
                }
//                if (empty($aPost['customer_email_repeat'])) {
//                    $alert .= '<li>' . Kohana::lang('customer.validation.error_customer_email_repeat_empty') . '</li>';
//                } else if (!layer::ValidateMail($aPost['customer_email_repeat'])) {
//                    $alert .= '<li>' . Kohana::lang('customer.validation.error_customer_email_repeat_format') . '</li>';
//                }
                if (!empty($aPost['customer_email']) && !empty($aPost['customer_email_repeat'])) {
                    if (layer::ValidateMail($aPost['customer_email']) && layer::ValidateMail($aPost['customer_email_repeat']) && $aPost['customer_email'] != $aPost['customer_email_repeat']) {
                        $alert .= '<li>' . Kohana::lang('customer.validation.error_wrong_customer_email_repeat') . '</li>';
                    }
                }
                if (empty($aPost['customer_password'])) {
                    $alert .= '<li>' . Kohana::lang('customer.validation.error_customer_password_empty') . '</li>';
                } else if (strlen($aPost['customer_password']) < 6) {
                    $alert .= '<li>' . Kohana::lang('customer.validation.error_customer_password_too_short') . '</li>';
                }
                if (empty($aPost['customer_password_repeat'])) {
                    $alert .= '<li>' . Kohana::lang('customer.validation.error_customer_password_repeat_empty') . '</li>';
                } else if (strlen($aPost['customer_password_repeat']) < 6) {
                    $alert .= '<li>' . Kohana::lang('customer.validation.error_customer_password_repeat_too_short') . '</li>';
                }

                if (!empty($aPost['customer_password']) && !empty($aPost['customer_password_repeat']) && $aPost['customer_password'] != $aPost['customer_password_repeat']) {
                    $alert .= '<li>' . Kohana::lang('customer.validation.error_wrong_customer_password_repeat') . '</li>';
                }
                if (empty($aPost['customer_reg_accept']) || $aPost['customer_reg_accept'] != 'confirmed') {
                    $alert .= '<li>' . Kohana::lang('customer.validation.error_reg_not_confirmed') . '</li>';
                }
                if (empty($aPost['customer_reg_accept2']) || $aPost['customer_reg_accept2'] != 'confirmed') {
                    $alert .= '<li>' . Kohana::lang('customer.validation.error_reg_not_confirmed2') . '</li>';
                }
                if (!empty($aPost['customer_register_inorder']) && $aPost['customer_register_inorder'] == 1) {
                    if ($aPost['customer_password'] != $aPost['customer_password_repeat']) {
                        $alert .= '<li>' . Kohana::lang('order.validation.error_password') . '</li>';
                    } elseif (empty($aPost['customer_password']) || empty($aPost['customer_password_repeat'])) {
                        $alert .= '<li>' . Kohana::lang('order.validation.error_password') . '</li>';
                    }
                }
            }

            if (!empty($alert)) {
                $alert = Kohana::lang('customer.validation.following_errors') . ': <ul>' . $alert . '</ul>';
                return new ErrorReporting(ErrorReporting::ERROR, false, $alert);
            } else {
                return new ErrorReporting(ErrorReporting::SUCCESS, true, '');
            }
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . ': ' . __LINE__ . ': ' . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, $ex->getMessage());
        }
    }

    /**
     * @author Hubert Kulczak
     * @param Integer $iCustomerId
     * @param Array $aPost
     * @return ErrorReporting (Bool true || Bool false)
     */
    public function ValidateUpdateCustomer($iCustomerId, array $aPost = array()) {
        try {
            $alert = '';
            //czy klient istnieje

            if (empty($aPost['customer_email'])) {
                $alert .= '<li>' . Kohana::lang('customer.validation.error_customer_email_empty') . '</li>';
            } else if (!layer::ValidateMail($aPost['customer_email'])) {
                $alert .= '<li>' . Kohana::lang('customer.validation.error_customer_email_format') . '</li>';
            } else {
                $aCheck = array('customer_email' => $aPost['customer_email'], 'id_customer!=' => $iCustomerId);
                $oExistCheck = $this->_Exists($aCheck);
                if ($oExistCheck->Value === true) {
                    $alert .= '<li>' . $oExistCheck->Message . '</li>';
                }
            }
            if (!empty($alert)) {
                $alert = Kohana::lang('customer.validation.following_errors') . ': <ul>' . $alert . '</ul>';
                return new ErrorReporting(ErrorReporting::ERROR, false, $alert);
            } else {
                return new ErrorReporting(ErrorReporting::SUCCESS, true, '');
            }
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . ': ' . __LINE__ . ': ' . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, $ex->getMessage());
        }
    }

    /**
     * Usuwanie z ulubionych
     * @author Hubert Kulczak
     * @param Integer $iCustomerId
     * @param Integer $iProductId
     * @return ErrorReporting (Bool true || Bool false)
     */
    public function DeleteFromFav($iCustomerId, $iProductId) {
        try {
            $iCustomerId+=0;
            $iProductId+=0;
            $this->_rDb->delete(table::SHOP_FAVOURITES_CUSTOMERS_PRODUCTS, array('customer_id' => $iCustomerId, 'product_id' => $iProductId));
            return new ErrorReporting(ErrorReporting::SUCCESS, true, Kohana::lang('customer.validation.delete_from_fav_success'));
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . ': ' . __LINE__ . ': ' . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('customer.validation.delete_from_fav_error'));
        }
    }

    /**
     * Walidacja dla usuwania konta przez klienta
     * @author Hubert Kulczak
     * @param Array $aPost
     * @param Integer $iCustomerId
     * @return ErrorReporting (Bool true || Bool false)
     */
    public function ValidateDeleteCustomer($aPost, $iCustomerId) {
        try {
            $alert = '';
            unset($aPost['back'], $aPost['submit']);
            // pola nie moga byc puste
            if (empty($aPost['password'])) {
                $alert .= '<li>' . Kohana::lang('customer.validation.error_customer_password_empty') . '</li>';
            } else if (strlen($aPost['password']) < 6) {
                $alert .= '<li>' . Kohana::lang('customer.validation.error_customer_password_too_short') . '</li>';
            }
            if (empty($aPost['password_repeat'])) {
                $alert .= '<li>' . Kohana::lang('customer.validation.error_customer_password_repeat_empty') . '</li>';
            } else if (strlen($aPost['password_repeat']) < 6) {
                $alert .= '<li>' . Kohana::lang('customer.validation.error_customer_password_repeat_too_short') . '</li>';
            }
            if (!empty($aPost['password']) && !empty($aPost['password_repeat']) && $aPost['password'] != $aPost['password_repeat']) {
                $alert .= '<li>' . Kohana::lang('customer.validation.error_wrong_customer_password_repeat') . '</li>';
            }
            // sprawdzenie czy haslo jest poprawne
            $aData = array();
            $password = $this->_rDb->query("SELECT PASSWORD('{$aPost['password']}') AS password");
            $aData['customer_password'] = $password[0]->password;
            $aData['id_customer'] = $iCustomerId;
            if (empty($alert) && $this->_Exists($aData)->Value === false) {
                $alert .= '<li>' . Kohana::lang('customer.validation.error_wrong_password') . '</li>';
            }
            if (!empty($alert)) {
                $alert = Kohana::lang('customer.validation.following_errors') . ': <ul>' . $alert . '</ul>';
                return new ErrorReporting(ErrorReporting::ERROR, false, $alert);
            } else {
                return new ErrorReporting(ErrorReporting::SUCCESS, true, '');
            }
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . ': ' . __LINE__ . ': ' . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('customer.validation.change_password_error'));
        }
    }

    /**
     * Usuwanie konta przez klienta
     * @author Hubert Kulczak
     * @param Integer $iCustomerId
     * @return ErrorReporting (Bool true || Bool false)
     */
    public function DeleteAccount($iCustomerId) {
        try {
            $iCustomerId+=0;
            $this->_rDb->query('SET AUTOCOMMIT = 0');
            $this->_rDb->query('BEGIN');
            // usuwamy ulubione
            $this->_rDb->delete(table::SHOP_FAVOURITES_CUSTOMERS_PRODUCTS, array('customer_id' => $iCustomerId));
            // zmieniamy konto na nieaktywne
            $this->_rDb->update(table::SHOP_CUSTOMERS, array('active' => 'N'), array('id_customer' => $iCustomerId));
            // wysłanie maila do klienta
            $this->_rDb->query('COMMIT');
            return new ErrorReporting(ErrorReporting::SUCCESS, true, Kohana::lang('customer.validation.delete_account_success'));
        } catch (Exception $ex) {
            $this->_rDb->query('ROLLBACK');
            Kohana::log('error', __FILE__ . ': ' . __LINE__ . ': ' . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('customer.validation.delete_account_error'));
        }
    }

    // TODO: Sprawdzic te ponizej czy potrzebne

    /**
     * @param integer $id
     * @param array $data
     * @param array $files
     * @return ErrorReporting
     */
    public function Update($id, array $data, array $files = array()) {
        try {
            $this->_rDb->query('SET AUTOCOMMIT = 0');
            $this->_rDb->query('BEGIN');
            unset($data['submit']);
            if (!empty($_FILES) && is_array($_FILES) && !empty($_FILES['producer_logo']['tmp_name'])) {
                $oProducerLogo = $this->_rDb->select('producer_logo')->getwhere(table::SHOP_PRODUCERS, array('id_producer' => $id));
                if (!empty($oProducerLogo[0]->producer_logo)) {
                    @unlink(self::PRODUCER_LOGO_THUMBSPATH . $oProducerLogo[0]->producer_logo);
                    @unlink(self::PRODUCER_LOGO_PATH . $oProducerLogo[0]->producer_logo);
                    $this->_rDb->update(table::SHOP_PRODUCERS, array('producer_logo' => ''), array('id_producer' => $id));
                }
                $aUploadArgs = array(
                    'path' => self::PRODUCER_LOGO_PATH,
                    'thumbpath' => self::PRODUCER_LOGO_THUMBSPATH,
                    'width' => 90,
                    'height' => 90,
                    'thumbwidth' => 50,
                    'thumbheight' => 50
                );
                $data['producer_logo'] = file::upload($files['producer_logo'], $aUploadArgs)->Value['filename'];
            }
            $data['active'] = !empty($data['active']) && $data['active'] == 'on' ? 'Y' : 'N';
            $results = $this->_rDb->update(table::SHOP_PRODUCERS, $data, array('id_producer' => $id));
            $this->_rDb->query('COMMIT');
            return new ErrorReporting(
                    ErrorReporting::SUCCESS, $results, Kohana::lang('producer.update_producer_success'));
        } catch (Exception $ex) {
            $this->_rDb->query('ROLLBACK');
            Kohana::log('error', __FILE__ . ': ' . __LINE__ . ': ' . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, $ex->getMessage());
        }
    }

    /**
     *
     * @return ErrorReporting
     */
    public function Save() {
        try {
            if (empty($this->_iId)) {
                throw new Exception(Kohana::lang('producer.cant_save_empty_producer'));
            }
            throw new Exception('Brak implementacji');
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . ': ' . __LINE__ . ': ' . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, $ex->getMessage());
        }
    }

    public function Register() {
        try {
            return new ErrorReporting(ErrorReporting::SUCCESS, true, Kohana::lang('producer.validate_update_success'));
            $errors = array();
            if (!empty($data) && is_array($data)) {
                
            }
            if (!empty($files) && is_array($files)) {
                
            }
            if (empty($data)) {
                if (empty($this->_sProducerName)) {
                    
                }
            }
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . ': ' . __LINE__ . ': ' . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, $ex->getMessage());
        }
    }

    /**
     *
     * @param integer $iCustomerId
     * @return ErrorReporting
     */
    public function GetCustomerOrdersHistory($iCustomerId) {
        try {
            
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . ': ' . __LINE__ . ': ' . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, $ex->getMessage());
        }
    }

    /**
     *
     * @param integer $iOrderid
     * @return ErrorReporting
     */
    public function GetOrderCustomer($iOrderid) {
        try {
            $result = $this->_rDb->limit(1)
                    ->from(table::SHOP_ORDERS_CUSTOMERS)
                    ->where(array('order_id' => $iOrderid))
                    ->get();
            return new ErrorReporting(ErrorReporting::SUCCESS, $result);
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . ': ' . __LINE__ . ': ' . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, $ex->getMessage());
        }
    }

    /**
     *
     * @param int $iProductId
     * @param int $iCustomerId
     * @return ErrorReporting
     */
    public function AddToClipboard($iProductId, $iCustomerId) {
        if (!empty($_SESSION['_customer']['customer_id'])) {
            $iCustomerId = $_SESSION['_customer']['customer_id'];
        }
        if (!empty($iCustomerId) && $iCustomerId + 0 > 0) {
            // sprawdzamy czy user juz ma w schowku ta oferte
            $iCheck = $this->_rDb->count_records(table::SHOP_CUSTOMERS_CLIPBOARD, array('customer_id' => $iCustomerId, 'product_id' => $iProductId));
            if (!empty($iCheck) && $iCheck > 0) {
                return new ErrorReporting(ErrorReporting::INFO, true, Kohana::lang('customer.info.project_add_to_clipboard'));
            } else { // nie ma tego w ulubionych mozemy dodawac do bazy
                $this->_rDb->insert(table::SHOP_CUSTOMERS_CLIPBOARD, array('customer_id' => $iCustomerId, 'product_id' => $iProductId));
            }
            return new ErrorReporting(ErrorReporting::SUCCESS, true, Kohana::lang('customer.success.project_add_to_clipboard'));
        } else {
            if (isset($_COOKIE['_clpbrd'])) {
                $clpbrd = unserialize($_COOKIE['_clpbrd']);
                if (array_search($iProductId, $clpbrd) === false) {
                    $clpbrd[] = $iProductId;
                    setcookie('_clpbrd', serialize($clpbrd), TIME + 2592000, '/');
                    //$_COOKIE['_clpbrd']=serialize($clpbrd);
                    return new ErrorReporting(ErrorReporting::SUCCESS, true, Kohana::lang('customer.success.project_add_to_clipboard'));
                } else {
                    return new ErrorReporting(ErrorReporting::INFO, true, 'Ten produkt został już umieszczony w schowku');
                }
            } else {
                $a = array($iProductId);
                setcookie('_clpbrd', serialize($a), TIME + 2592000, '/');
                //$_COOKIE['_clpbrd']=serialize($a);
                return new ErrorReporting(ErrorReporting::SUCCESS, true, Kohana::lang('customer.success.project_add_to_clipboard'));
            }
        }
    }

    /**
     *
     * @param int $iProductId
     * @param int $iCustomerId
     * @return ErrorReporting
     */
    public function RemoveFromClipboard($iProductId, $iCustomerId) {
        if (!empty($iCustomerId) && $iCustomerId + 0 > 0) {
            $this->_rDb->delete(table::SHOP_CUSTOMERS_CLIPBOARD, array('customer_id' => $iCustomerId, 'product_id' => $iProductId));
            $result = $this->_rDb->count_records(table::SHOP_CUSTOMERS_CLIPBOARD, array('customer_id' => $iCustomerId));
            return new ErrorReporting(ErrorReporting::SUCCESS, $result ? true : false, Kohana::lang('customer.success.project_removed_clipboard'));
        } else {
            $a = unserialize($_COOKIE['_clpbrd']);
            $b = array();
            foreach ($a as $product) {
                if (!in_array($product, $b) && $iProductId != $product) {
                    $b[] = $product;
                }
            }
            $a = $b;
            setcookie('_clpbrd', serialize($a), TIME + 2592000, '/');
            $_COOKIE['_clpbrd'] = serialize($a);
            return new ErrorReporting(ErrorReporting::SUCCESS, count($b) ? true : false, Kohana::lang('customer.success.project_removed_clipboard'));
        }
    }

    public function RemoveFromClipboard2($iProductId, $iCustomerId) {
        if (!empty($_SESSION['_customer']['customer_id'])) {
            $iCustomerId = $_SESSION['_customer']['customer_id'];
        }
        if (!empty($iCustomerId) && $iCustomerId + 0 > 0) {
            $result = $this->_rDb->delete(table::SHOP_CUSTOMERS_CLIPBOARD, array('customer_id' => $iCustomerId, 'product_id' => $iProductId));
//			echo '<pre>';
//			var_dump(count($result));
//			echo '</pre>';
//			exit;
            if (count($result) == 1) {
                $result = true;
            }
//            $result=$this->_rDb->count_records(table::SHOP_CUSTOMERS_CLIPBOARD,array('customer_id'=>$iCustomerId));
            return new ErrorReporting(ErrorReporting::SUCCESS, $result, Kohana::lang('customer.success.project_removed_clipboard'));
        } else {
            $a = unserialize($_COOKIE['_clpbrd']);
            $b = array();
            foreach ($a as $product) {
                if (!in_array($product, $b) && $iProductId != $product) {
                    $b[] = $product;
                }
            }
            $a = $b;
            if (count($a) > 0) {
                setcookie('_clpbrd', serialize($a), TIME + 2592000, '/');
            } else {
                cookie::delete('_clpbrd');
            }
            //$_COOKIE['_clpbrd']=serialize($a);
            return new ErrorReporting(ErrorReporting::SUCCESS, true, Kohana::lang('customer.success.project_removed_clipboard'));
        }
    }

    /**
     *
     * @param int $iCustomerId
     * @return ErrorReporting
     */
    public function GetClipboard($iCustomerId = 0) {
        if (!empty($_SESSION['_customer']['customer_id'])) {
            $iCustomerId = $_SESSION['_customer']['customer_id'];
        }
        if (!empty($iCustomerId) && $iCustomerId + 0 > 0) {
            $oClipboard = $this->_rDb->getwhere(table::SHOP_CUSTOMERS_CLIPBOARD, array('customer_id' => $iCustomerId));
            if (!empty($oClipboard) && $oClipboard->count() > 0) {
                $aClipboard = array();
                foreach ($oClipboard as $clpbrdItem) {
                    $aClipboard[] = $clpbrdItem->product_id;
                }
                $result = $this->_rDb
                                ->join(table::SHOP_PRODUCTS_DESCRIPTION . ' AS spd', 'spd.product_id', 'sp.id_product', 'INNER')
                                ->join(table::SHOP_PRODUCTS_IMAGES . ' AS spi', 'spi.product_id', 'sp.id_product', 'LEFT')
                                ->in('id_product', implode(',', $aClipboard))->getwhere(table::SHOP_PRODUCTS . ' AS sp', array('mainimage' => 'Y'));
                $aClipboard = array();
                foreach ($result as $r) {
                    $aClipboard[] = array('id_product' => $r->id_product, 'filename' => $r->filename, 'realfilename' => $r->realfilename, 'price' => $r->price, 'product_name' => $r->product_name, 'product_description' => $r->product_description, 'product_short_description' => $r->product_short_description);
                }
                return new ErrorReporting(ErrorReporting::SUCCESS, $aClipboard);
            } else {
                if (!empty($_COOKIE['_clpbrd'])) {
                    $a = unserialize($_COOKIE['_clpbrd']);
                    $result = $this->_rDb
                                    ->join(table::SHOP_PRODUCTS_DESCRIPTION . ' AS spd', 'spd.product_id', 'sp.id_product', 'INNER')
                                    ->join(table::SHOP_PRODUCTS_IMAGES . ' AS spi', 'spi.product_id', 'sp.id_product', 'LEFT')
                                    ->in('id_product', implode(',', $a))->getwhere(table::SHOP_PRODUCTS . ' AS sp', array('mainimage' => 'Y'));
                    $aClipboard = array();
                    foreach ($result as $r) {
                        $aClipboard[] = array('id_product' => $r->id_product, 'filename' => $r->filename, 'realfilename' => $r->realfilename, 'price' => $r->price, 'product_name' => $r->product_name, 'product_description' => $r->product_description, 'product_short_description' => $r->product_short_description);
                    }
                    foreach ($a as $prod) {
                        $this->AddToClipboard($prod, $iCustomerId);
                    }
                    cookie::delete('_clpbrd');
//						setcookie('_clpbrd', '');
                    return new ErrorReporting(ErrorReporting::SUCCESS, $aClipboard);
                } else {
                    return new ErrorReporting(ErrorReporting::INFO, false, 'Nie dodano jeszcze produktów do schowka.');
                }
            }
        } else {
            if (!empty($_COOKIE['_clpbrd'])) {
                $a = unserialize($_COOKIE['_clpbrd']);
                if (count($a) > 0) {
                    $result = $this->_rDb
                                    ->join(table::SHOP_PRODUCTS_DESCRIPTION . ' AS spd', 'spd.product_id', 'sp.id_product', 'INNER')
                                    ->join(table::SHOP_PRODUCTS_IMAGES . ' AS spi', 'spi.product_id', 'sp.id_product', 'LEFT')
                                    ->in('id_product', implode(',', $a))->getwhere(table::SHOP_PRODUCTS . ' AS sp', array('mainimage' => 'Y'));
                    $aClipboard = array();
                    foreach ($result as $r) {
                        $aClipboard[] = array('id_product' => $r->id_product, 'filename' => $r->filename, 'realfilename' => $r->realfilename, 'price' => $r->price, 'product_name' => $r->product_name, 'product_description' => $r->product_description, 'product_short_description' => $r->product_short_description);
                    }
                    return new ErrorReporting(ErrorReporting::SUCCESS, $aClipboard);
                } else {
                    return new ErrorReporting(ErrorReporting::INFO, false);
                }
            } else {
                return new ErrorReporting(ErrorReporting::INFO, false);
            }
        }
    }

    public function CountClipboard($iCustomerId = 0) {
        if (!empty($_SESSION['_customer']['customer_id'])) {
            $iCustomerId = $_SESSION['_customer']['customer_id'];
        }
        if (!empty($iCustomerId) && $iCustomerId + 0 > 0) { //zalogowany user
            $oClipboard = $this->_rDb->getwhere(table::SHOP_CUSTOMERS_CLIPBOARD, array('customer_id' => $iCustomerId));
            if (!empty($oClipboard) && $oClipboard->count() > 0) { // Jeśli są zapytania w bazie
                $result = $oClipboard->count();
                return new ErrorReporting(ErrorReporting::SUCCESS, $result);
            } else { //weź produkty z cookie
                if (!empty($_COOKIE['_clpbrd'])) {
                    $a = serialize($_COOKIE['_clpbrd']);
                    $result = count($a);
                    return new ErrorReporting(ErrorReporting::SUCCESS, $result);
                } else {
                    $result = 0;
                    return new ErrorReporting(ErrorReporting::SUCCESS, $result);
                }
            }
        } else { //niezalogowany user
            if (!empty($_COOKIE['_clpbrd'])) {
                $a = unserialize($_COOKIE['_clpbrd']);
                $result = count($a);
                return new ErrorReporting(ErrorReporting::SUCCESS, $result);
            } else {
                $result = 0;
                return new ErrorReporting(ErrorReporting::SUCCESS, $result);
            }
        }
    }

    public function CheckProductInClipboard($iProductId, $iCustomerId = NULL) {
        if (!empty($_SESSION['_customer']['customer_id'])) {
            $iCustomerId = $_SESSION['_customer']['customer_id'];
        }
        if (!empty($iProductId)) {
            if (!empty($_SESSION['_customer']['customer_id'])) { // zalogowany user
                $iCheck = $this->_rDb->count_records(table::SHOP_CUSTOMERS_CLIPBOARD, array('customer_id' => $iCustomerId, 'product_id' => $iProductId));
                if (!empty($iCheck) && $iCheck > 0) {
                    return true; // jest w schowku
                } else { // nie ma tego w ulubionych mozemy dodawac do bazy
                    return false; // nie ma w schowku
                }
            } else { // niezalogowany user
                if (!empty($_COOKIE['_clpbrd'])) {
                    $a = unserialize($_COOKIE['_clpbrd']);
                    if (in_array($iProductId, $a)) {
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            }
        }
    }

    public function AddSubscription($aData) {
        if (!empty($aData)) {
            $subscriptionAdded = time();
            $oSubscription = $this->GetSubscriptionsTypes($aData['kwota'])->Value[0];
            $oActiveSubscription = $this->GetActiveCustomerSubscriptions($_SESSION['_customer']['customer_id'])->Value[0];
            if (!empty($oActiveSubscription)) {
//			 var_dump($this->GetActiveCustomerSubscriptions($_SESSION['_customer']['customer_id']));
                $start_time = $oActiveSubscription->end_time;
                $end_time = $start_time + $oSubscription->subscription_time;
            }
            $result = $this->_rDb->insert(table::SHOP_CUSTOMERS_SUBSCRIPTIONS, array(
                'customer_id' => $_SESSION['_customer']['customer_id'],
                'subscription_id' => $oSubscription->id_subscription,
                'subscription_added' => $subscriptionAdded,
                'start_time' => (!empty($start_time)) ? $start_time : $subscriptionAdded,
                'subscription_duration' => $oSubscription->subscription_time,
                'end_time' => (!empty($end_time)) ? $end_time : ($subscriptionAdded + $oSubscription->subscription_time),
                'active' => 'N',
                'confirmed' => 'N',
                'token' => $aData['control']
            ));
            return new ErrorReporting(ErrorReporting::SUCCESS, true);
        } else {
            return new ErrorReporting(ErrorReporting::ERROR, false, 'Wystąpił błąd przy dodawaniu wpisu do bazy danych.');
        }
    }

    public function ConfirmSubscription($iToken) {
        try {
            if (!empty($iToken)) {
                $oCurrentSubscription = $this->GetSubscription($iToken)->Value[0];
                $oActiveSubscription = $this->GetActiveCustomerSubscriptions($oCurrentSubscription->customer_id)->Value[0];
                if ($oCurrentSubscription->confirmed == 'N') {
                    if (!empty($oActiveSubscription)) {
                        $start_time = $oActiveSubscription->end_time;
                        $end_time = $start_time + $oCurrentSubscription->subscription_duration;
                    } else {
                        $start_time = $oCurrentSubscription->start_time;
                        $end_time = $start_time + $oCurrentSubscription->subscription_duration;
                    }
                    $result = $this->_rDb->update(table::SHOP_CUSTOMERS_SUBSCRIPTIONS, array('start_time' => $start_time, 'end_time' => $end_time, 'active' => 'Y', 'confirmed' => 'Y'), array('token' => $iToken));
//					echo '<pre>';
//					var_dump($result->count());
//					echo '</pre>';
//					exit;
                    return new ErrorReporting(ErrorReporting::SUCCESS, $result, 'Dziękujemy za potwierdzenie transakcji.');
                } else {
                    return new ErrorReporting(ErrorReporting::SUCCESS, false, 'Weryfikacja dla tej płatności została już potwierdzona. Dziękujemy za dokonanie płatności.');
                }
            }
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . ': ' . __LINE__ . ': ' . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, $ex->getMessage());
        }
    }

    public function GetSubscription($iToken) {
        try {
            $result = $this->_rDb->from(table::SHOP_CUSTOMERS_SUBSCRIPTIONS)->where(array('token' => $iToken))->get();
//			echo '<pre>';
//			var_dump($result);
//			echo '</pre>';
//			exit;
            return new ErrorReporting(ErrorReporting::SUCCESS, $result);
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . ': ' . __LINE__ . ': ' . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, $ex->getMessage());
        }
    }

//    /**
//     *
//     * @param integer $iOrderid
//     * @return ErrorReporting
//     */
//    public function GetOrderCustomer($iOrderid) {
//        try {
//            $result = $this->_rDb->limit(1)->join(table::SHOP_CUSTOMERS . ' AS sc', 'soc.customer_id', 'sc.id_customer', 'INNER')
//                    ->getwhere(table::SHOP_ORDERS_CUSTOMERS . ' AS soc', array('soc.order_id' => $iOrderid));
//            return new ErrorReporting(ErrorReporting::SUCCESS, $result);
//        } catch (Exception $ex) {
//            Kohana::log('error', __FILE__ .': '. __LINE__ .': '. $ex->getMessage());
//            return new ErrorReporting(ErrorReporting::ERROR, false, $ex->getMessage());
//        }
//    }
}
