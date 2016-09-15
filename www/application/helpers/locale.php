<?php
defined('SYSPATH') or die('No direct script access.');
class Locale {
    public static function getLanguageBy($language) {
        switch($language) {
            case 'pl':
                return 'pl_PL';
                break;
            case 'ru':
                return 'ru_RU';
                break;
            case 'en':
                return 'en_EN';
                break;
            case 'de':
                return 'de_DE';
                break;
            case 'es':
                return 'es_ES';
                break;
            default:
                return 'pl_PL';
        }
    }
}