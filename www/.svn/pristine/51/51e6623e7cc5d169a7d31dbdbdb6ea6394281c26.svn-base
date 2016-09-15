<?php

defined('SYSPATH') or die('No direct script access.');

class layer {

    const PER_PAGE = 25;
    const ADMIN_PER_PAGE = 25;

    public static function Log(Layer $type, $message, $time = null) {
        $db = new Database();
        return $db->insert('logs', array('type' => $type, 'message' => $message, 'time' => empty($time) ? time() : $time))->insert_id();
    }

    public static function MakeSeed() {
        list($usec, $sec) = explode(' ', microtime());
        return ((float) $sec + (float) $usec) * 100000;
    }

    public static function GetPagination($iCount, $sPaginationType = '', $iPerPage = null) {
        $sPaginationType = empty($sPaginationType) ? 'admin_digg' : $sPaginationType;
        $iPerPage = isset($iPerPage) ? $iPerPage : self::PER_PAGE;

        return new Pagination(
                array(
            'query_string' => 'page',
            'style' => $sPaginationType,
            'total_items' => $iCount,
            'items_per_page' => $iPerPage,
            'auto_hide' => true,
            'base_url' => url::current(),
                )
        );
    }

    /*
     * Sortowanie na widokach z tabelkami
     * Parameters: $orderby, $n, $m, $url
     * Return image link
     */

    public static function GetSort($orderby, $n, $m, $url) {
        if ((!empty($_GET[$orderby])) && (($_GET[$orderby]) == $n)) {
            echo html::anchor($url . '?' . $orderby . '=' . $m, html::image('img/admin_default/sort-asc-2.png'));
        } elseif ((!empty($_GET[$orderby])) && (($_GET[$orderby]) == $m)) {
            echo html::anchor($url . '?' . $orderby . '=' . $n, html::image('img/admin_default/sort-desc-2.png'));
        } else {
            echo html::anchor($url . '?' . $orderby . '=' . $n, html::image('img/admin_default/sort-2.png'));
        }
    }

    /*
     *  Dla formatu daty DD-MM-YYYY
     */

    public static function DateToInt($sDate) {
        $date_temp = explode('-', $sDate);
        $date_new = mktime(0, 0, 0, $date_temp[1], $date_temp[0], $date_temp[2]);
        return $date_new;
    }

    public static function Clean($post) {
        $clean = array();
        foreach ($_POST as $key => $value) {
            $clean[$key] = urldecode($value);
        }
        return $clean;
    }

    public static function MakeDecimal($sString) {
        $dDecimal = trim($sString);
        $dDecimal = str_replace(' ', '', $dDecimal);
        $dDecimal = str_replace(',', '.', $dDecimal);
        return $dDecimal;
    }

    public static function SendMessage($sSubject, $sMessage, $aRecipents = NULL, $sEmail = null, $aAttachment = null) {
        try {
            $mailer = email::connect();
            $swift = Swift_Message::newInstance();

            if (!empty($sEmail)) {
                $swift->setFrom(array($sEmail => config::getConfig('administrator_name')));
            } else {
                $swift->setFrom(array(config::getConfig('administrator_email') => config::getConfig('administrator_name')));

                //throw new Exception('NO EMAIL');                
            }
            $recipients = array();
            if (!empty($aRecipents)) {
                foreach ($aRecipents as $r) {
                    array_push($recipients, $r);
                }
            } else {
                array_push($recipients, config::getConfig('administrator_email'));
            }
            $swift->setTo($recipients);
            $swift->setSubject($sSubject);
            $swift->setBody($sMessage);
            $swift->setContentType("text/html");
            //Wysyłanie załączników

            if (!empty($aAttachment)) {

                //  $message->attach(new Swift_Message_Part('Załączniki'));
                foreach ($aAttachment as $att) {
                    $swift->attach(Swift_Attachment::fromPath($att));
                }
            }
            //  if ($swift->send($message, $recipients, $from)) {
            if ($mailer->send($swift)) {
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

    public static function ValidateMail($email) {
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

    public static function GetStates() {
        try {
            $db = new Database();
            $aStates = array();
            $result = $db->get(table::DICT_STATES);
            foreach ($result as $r) {
                $aStates[$r->id_states_dict] = $r->state_name;
            }
            return new ErrorReporting(ErrorReporting::SUCCESS, $aStates);
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('app.error_send_message'));
        }
    }

    public static function GetState($iStateId) {
        try {
            $db = new Database();
            $iStateId += 0;
            $result = $db->limit(1)->getwhere(table::DICT_STATES, array('id_states_dict' => $iStateId));
            return new ErrorReporting(ErrorReporting::SUCCESS, $result[0]->state_name);
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('app.cant_get_state'));
        }
    }

    public static function ClientIp() {
        $ip = '';
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }

    public static function CreateProductFbOgTags($prodDet = null, $prodImg = null) {
        $ogarray = array();
        if (!empty($prodDet)) {
            $ogarray['type'] = 'product';
            $ogarray['url'] = url::base(true, 'http') . shop::ProductUrl($prodDet);
            $ogarray['title'] = $prodDet->product_name;
            $ogarray['price'] = $prodDet->price;
            $ogarray['currency'] = 'zł';
        }
        if (!empty($prodImg) && $prodImg->count() > 0) {
            foreach ($prodImg as $image) {
                if ($image->mainimage == 'Y') {
                    $ogarray['image'] = url::base(true, 'http') . Product_Model::PRODUCT_IMG_BIG . $image->filename;
                }
            }
        }
        return $ogarray;
    }

    public static function FbOgTags($vars) {
        if (!empty($vars) && count($vars) > 0) {
            $html = '';
            if (!empty($vars['type'])) {
                $html .= "<meta property=\"og:type\" content=\"" . $vars['type'] . "\" />\r\n";
            }
            if (!empty($vars['url'])) {
                $html .= "<meta property=\"og:url\" content=\"" . $vars['url'] . "\" />\r\n";
            }
            if (!empty($vars['title'])) {
                $html .= "<meta property=\"og:title\" content=\"" . $vars['title'] . "\" />\r\n";
            }
            if (!empty($vars['price'])) {
                $html .= "<meta property=\"product:price:amount\" content=\"" . $vars['price'] . "\" />\r\n";
            }
            if (!empty($vars['currency'])) {
                $html .= "<meta property=\"product:price:currency\" content=\"" . $vars['currency'] . "\" />\r\n";
            }
            if (!empty($vars['image'])) {
                $html .= "<meta property=\"og:image\" content=\"" . $vars['image'] . "\" />\r\n";
            }
            return $html;
        }
    }

    public static function GoogleAnalytics() {
        $google_tracking_code = html::specialchars(config::getConfig('google_tracking_code'));
        $sHtml = '';
        if (!empty($google_tracking_code)) {

            $sHtml = "
                <script>
                (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
                })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

                ga('create', '$google_tracking_code', 'auto');
                ga('send', 'pageview');

              </script>";
        }
        return $sHtml;
    }

}

?>