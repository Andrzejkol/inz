<?php

defined('SYSPATH') OR die('No direct access allowed.');

class Contact_forms_ajax_Controller extends Controller_Core {

    // Do not allow to run in production
    const ALLOW_PRODUCTION = TRUE;

    public function __construct() {
        parent::__construct();
    }

    public function validate_contact_form() {
        $clean = array();
        foreach ($_POST as $key => $value) {
            $clean[$key] = urldecode($value);
        }
        Kohana::log('debug', print_r($clean, true));
        header('Content-type: text/xml; charset=utf-8');
        $counter = 0;
        $defString = '<?xml version="1.0" encoding="UTF-8"?><validation></validation>';
        $xml = new SimpleXMLElement($defString);

        if (empty($clean['title']) || $clean['title'] == '') {
            $element = $xml->addChild('error', Kohana::lang('contact_form.title_required'));
            $element->addAttribute('id', 'title');
            $element->addAttribute('class', 'error');
            $counter++;
        }
        if (empty($_POST['page_id']) || $_POST['page_id'] == '' || $_POST['page_id'] == 'null') {
            $element = $xml->addChild('error', Kohana::lang('contact_form.page_id_required'));
            $element->addAttribute('id', 'page_id');
            $element->addAttribute('class', 'error');
            $counter++;
        }

        if (empty($clean['sender_email']) || $clean['sender_email'] == '' || !valid::email($clean['sender_email'])) {
            $element = $xml->addChild('error', Kohana::lang('contact_form.sender_email_error'));
            $element->addAttribute('id', 'sender_email');
            $element->addAttribute('class', 'error');
            $counter++;
        }
        if (empty($clean['receiver_email']) || $clean['receiver_email'] == '') {
            $element = $xml->addChild('error', Kohana::lang('contact_form.receiver_email_error'));
            $element->addAttribute('id', 'receiver_email');
            $element->addAttribute('class', 'error');
            $counter++;
        } else {
            $aEmails = explode(',', $clean['receiver_email']);
            foreach ($aEmails as $Email) {
                if (!valid::email($Email)) {
                    $element = $xml->addChild('error', Kohana::lang('contact_form.receiver_email_error'));
                    $element->addAttribute('id', 'receiver_email');
                    $element->addAttribute('class', 'error');
                    $counter++;
                }
            }
        }



        $xml->addAttribute('counter', $counter);
        echo $xml->asXML();
    }

}
