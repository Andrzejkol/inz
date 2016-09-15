<?php
defined('SYSPATH') OR die('No direct access allowed.');
class newsletter {
    
    const SENDING_EMAIL = 'olicom@olicom.pl';
    const IMAGE_NEWSLETTER_PATH = 'files/newsletter/';
   const NEWSLETTER_VIEW = 'emails/newsletter_layout_default';
   //   const NEWSLETTER_VIEW = 'emails/mauritis';
    public static function getConfig($key) {
        $db = new Database();
        $result = $db->select($key)->limit(1)->get('configuration');
        return $result[0]->$key;
    }
}
