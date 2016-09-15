<?php

defined('SYSPATH') OR die('No direct access allowed.');

class currency {
    
    public static function GetCurrency() {
        if (!empty($_SESSION['currency'])) {
            return $_SESSION['currency'];
        } else {
            return 'zł';
        }
    }
    
    public static function GetFactor() {
        if (!empty($_SESSION['factor'])) {
            return $_SESSION['factor'];
        } else {
            return 1;
        }
    }
    
    
}
?>