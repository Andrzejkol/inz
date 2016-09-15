<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 *
 */
class Users_Ajax_Controller extends Controller_Core {


    // Do not allow to run in production
    const ALLOW_PRODUCTION = TRUE;

    /**
     *
     */
    public function __construct() {
        parent::__construct();
        $this->_oUser = new User_Model();
    }

    /**
     *
     */
    public function validate_user_add() {
        $clean = array();
        foreach($_POST as $key => $value) {
            $clean[$key] = urldecode($value);
        }
        Kohana::log('debug', print_r($clean, true));
        header('Content-type: text/xml; charset=utf-8');
        $counter = 0;
        $defString = '<?xml version="1.0" encoding="UTF-8"?><validation></validation>';
        $xml = new SimpleXMLElement($defString);

        if(empty($clean['first_name']) || $clean['first_name'] == '') {
            $element = $xml->addChild('error', Kohana::lang('user.first_name_empty'));
            $element->addAttribute('id', 'first_name');
            $element->addAttribute('class', 'error');
            $counter++;
        }
        if(empty($clean['last_name']) || $clean['last_name'] == '') {
            $element = $xml->addChild('error', Kohana::lang('user.last_name_empty'));
            $element->addAttribute('id', 'last_name');
            $element->addAttribute('class', 'error');
            $counter++;
        }
        $user = new User_Model();
        if(empty($clean['email']) || $clean['email'] == '') {
            $element = $xml->addChild('error', Kohana::lang('user.email_empty'));
            $element->addAttribute('id', 'email');
            $element->addAttribute('class', 'error');
            $counter++;
        } elseif(!empty($clean['email']) && !valid::email($clean['email'])) {
            $element = $xml->addChild('error', Kohana::lang('user.invalid_email_format'));
            $element->addAttribute('id', 'email');
            $element->addAttribute('class', 'error');
            $counter++;
        } elseif(!empty($clean['email']) && $user->UserExists($clean['email'])->Value > 0) {
            $element = $xml->addChild('error', Kohana::lang('user.user_exists', $clean['email']));
            $element->addAttribute('id', 'email');
            $element->addAttribute('class', 'error');
            $counter++;
        }

        if(empty($clean['password']) || $clean['password'] == '') {
            $element = $xml->addChild('error', Kohana::lang('user.password_required'));
            $element->addAttribute('id', 'password');
            $element->addAttribute('class', 'error');
            $counter++;
        }
        if(empty($clean['confirm_password']) || $clean['confirm_password'] == '') {
            $element = $xml->addChild('error', Kohana::lang('user.confirm_password_required'));
            $element->addAttribute('id', 'confirm_password');
            $element->addAttribute('class', 'error');
            $counter++;
        }

        if(!empty($clean['password']) && !empty($clean['confirm_password']) && $clean['password'] != $clean['confirm_password']) {
            $element = $xml->addChild('error', Kohana::lang('user.passwords_mismatch'));
            $element->addAttribute('id', 'confirm_password');
            $element->addAttribute('class', 'error');
            $counter++;
        }

        $xml->addAttribute('counter', $counter);
        echo $xml->asXML();
    }


    /**
     *
     */
    public function validate_user_edit() {
        $clean = array();
        foreach($_POST as $key => $value) {
            $clean[$key] = urldecode($value);
        }
        Kohana::log('debug', print_r($clean, true));
        header('Content-type: text/xml; charset=utf-8');
        $counter = 0;
        $defString = '<?xml version="1.0" encoding="UTF-8"?><validation></validation>';
        $xml = new SimpleXMLElement($defString);

        if(empty($clean['first_name']) || $clean['first_name'] == '') {
            $element = $xml->addChild('error', Kohana::lang('user.first_name_empty'));
            $element->addAttribute('id', 'first_name');
            $element->addAttribute('class', 'error');
            $counter++;
        }
        if(empty($clean['last_name']) || $clean['last_name'] == '') {
            $element = $xml->addChild('error', Kohana::lang('user.last_name_empty'));
            $element->addAttribute('id', 'last_name');
            $element->addAttribute('class', 'error');
            $counter++;
        }
        $user = new User_Model();
        if(empty($clean['email']) || $clean['email'] == '') {
            $element = $xml->addChild('error', Kohana::lang('user.email_empty'));
            $element->addAttribute('id', 'email');
            $element->addAttribute('class', 'error');
            $counter++;
        } elseif(!empty($clean['email']) && !valid::email($clean['email'])) {
            $element = $xml->addChild('error', Kohana::lang('user.invalid_email_format'));
            $element->addAttribute('id', 'email');
            $element->addAttribute('class', 'error');
            $counter++;
        }
//        elseif(!empty($clean['email']) && $user->UserExists($clean['email'])->Value > 0) {
//            $element = $xml->addChild('error', Kohana::lang('user.user_exists', $clean['email']));
//            $element->addAttribute('id', 'email');
//            $element->addAttribute('class', 'error');
//            $counter++;
//        }

        if(!empty($clean['change_password'])) {
            if(empty($clean['password']) || $clean['password'] == '') {
                $element = $xml->addChild('error', Kohana::lang('user.password_required'));
                $element->addAttribute('id', 'password');
                $element->addAttribute('class', 'error');
                $counter++;
            }
            if(empty($clean['confirm_password']) || $clean['confirm_password'] == '') {
                $element = $xml->addChild('error', Kohana::lang('user.confirm_password_required'));
                $element->addAttribute('id', 'confirm_password');
                $element->addAttribute('class', 'error');
                $counter++;
            }

            if(!empty($clean['password']) && !empty($clean['confirm_password']) && $clean['password'] != $clean['confirm_password']) {
                $element = $xml->addChild('error', Kohana::lang('user.passwords_mismatch'));
                $element->addAttribute('id', 'confirm_password');
                $element->addAttribute('class', 'error');
                $counter++;
            }
        }

        $xml->addAttribute('counter', $counter);
        echo $xml->asXML();
    }


    /**
     *
     */
    public function validate_role_add() {
        $clean = array();
        foreach($_POST as $key => $value) {
            $clean[$key] = urldecode($value);
        }
        header('Content-type: text/xml; charset=utf-8');
        $counter = 0;
        $defString = '<?xml version="1.0" encoding="UTF-8"?><validation></validation>';
        $xml = new SimpleXMLElement($defString);

        if(empty($clean['name']) || $clean['name'] == '') {
            $element = $xml->addChild('error', Kohana::lang('user.role_name_required'));
            $element->addAttribute('id', 'name');
            $element->addAttribute('class', 'error');
            $counter++;
        }
//        if(!isset($_POST['permission']) || empty($_POST['permission'])) {
//            $element = $xml->addChild('error', Kohana::lang('user.role_empty'));
//            $element->addAttribute('id', 'permission');
//            $element->addAttribute('class', 'error');
//            $counter++;
//        }

        $xml->addAttribute('counter', $counter);
        echo $xml->asXML();
    }

    public function user_search() {
        $_POST = layer::Clean($_POST);
        $this->_oTemplate = new View('admin_users_index');
        $this->_oTemplate->users = $this->_oUser->FindAllWhere($_POST)->Value;
        echo $this->_oTemplate->render(true);
    }
}