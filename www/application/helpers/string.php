<?php
class string {
    /**
     *
     * @param string $sText
     * @return string
     */
    public static function clearDiacritics($sText) {
        $aReplacePL = array(
            'ą' => 'a', 'ę' => 'e', 'ś' => 's', 'ć' => 'c',
            'ó' => 'o', 'ń' => 'n', 'ż' => 'z', 'ź' => 'z', 'ł' => 'l',
            'Ą' => 'A', 'Ę' => 'E', 'Ś' => 'S', 'Ć' => 'C',
            'Ó' => 'O', 'Ń' => 'N', 'Ż' => 'Z', 'Ź' => 'Z', 'Ł' => 'L'
            );
        return str_replace(array_keys($aReplacePL), array_values($aReplacePL), $sText);
    }

    /**
     *
     * @param string $sText
     * @return string
     */
    public static function prepareURL($sText) {
        // pozbywamy się polskich znaków diakrytycznych
        $sText = self::clearDiacritics($sText);
        // dla przejrzystości wszystko z małych liter
        $sText = strtolower($sText);
        // wszystkie spacje zamieniamy na myślniki
        $sText = str_replace(' ', '-', $sText);
        // usuń wszytko co jest niedozwolonym znakiem
        $sText = preg_replace('/[^0-9a-z\-]+/', '', $sText);
        // zredukuj liczbę myślników do jednego obok siebie
        $sText = preg_replace('/[\-]+/', '-', $sText);
        // usuwamy możliwe myślniki na początku i końcu
        $sText = trim($sText, '-');
        return $sText;
    }

    public static function ucFirst($str) {
        switch($str[0]) {
            case 'ę':
                $str[0] = 'Ę';
                break;
            case 'ó':
                $str[0] = 'Ó';
                break;
            case 'ą':
                $str[0] = 'Ą';
                break;
            case 'ś':
                $str[0] = 'Ś';
                break;
            case 'ć':
                $str[0] = 'Ć';
                break;
            case 'ń':
                $str[0] = 'Ń';
                break;
            case 'ż':
                $str[0] = 'Ż';
                break;
            case 'ź':
                $str[0] = 'Ź';
                break;
            case 'ł':
                $str[0] = 'Ł';
                break;
            default:
                $str[0] = strtoupper($str[0]);
        }
        return $str;
    }

    public static function lcFirst($str) {
        switch($str[0]) {
            case 'Ę':
                $str[0] = 'ę';
                break;
            case 'Ó':
                $str[0] = 'ó';
                break;
            case 'Ą':
                $str[0] = 'ą';
                break;
            case 'Ś':
                $str[0] = 'ś';
                break;
            case 'Ć':
                $str[0] = 'ć';
                break;
            case 'Ń':
                $str[0] = 'ń';
                break;
            case 'Ż':
                $str[0] = 'ż';
                break;
            case 'Ź':
                $str[0] = 'ź';
                break;
            case 'Ł':
                $str[0] = 'ł';
                break;
            default:
                $str[0] = strtoupper($str[0]);
        }
        return $str;
    }
	
	      /**
     *
     * @param string $str
     * @return string
     */
    public static function uppercase($str) {
        return str_replace(
            array('ę','ó','ą','ś','ć','ń','ż','ź','ł','a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z'),
            array('Ę','Ó','Ą','Ś','Ć','Ń','Ż','Ź','Ł','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'),
            $str
        );
    }

    /**
     *
     * @param string $str
     * @return string
     */
    public static function lowercase($str) {
        return str_replace(
            array('Ę','Ó','Ą','Ś','Ć','Ń','Ż','Ź','Ł','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'),
            array('ę','ó','ą','ś','ć','ń','ż','ź','ł','a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z'),
            $str
        );
    }
}
?>