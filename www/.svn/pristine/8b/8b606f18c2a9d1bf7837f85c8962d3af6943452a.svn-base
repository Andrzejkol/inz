<?php

defined('SYSPATH') OR die('No direct access allowed.');

class shop {

    const SMALL_PATH = 'files/products/small/';
    const XSMALL_PATH = 'files/products/xsmall/';
    const MEDIUM_PATH = 'files/products/medium/';
    const XMEDIUM_PATH = 'files/products/xmedium/';
    const XXMEDIUM_PATH = 'files/products/xxmedium/';
    const BIG_PATH = 'files/products/big/';
    const BIG_WIDTH = 1024;
    const BIG_HEIGHT = 1024;
    const MEDIUM_WIDTH = 280; // ekran produktu
    const MEDIUM_HEIGHT = 300; // ekran produktu
    const XMEDIUM_WIDTH = 150; // produkty na kategorii
    const XMEDIUM_HEIGHT = 185; // produkty na kategorii
    const XXMEDIUM_WIDTH = 140; // top sellers
    const XXMEDIUM_HEIGHT = 140; // top sellers
    const SMALL_WIDTH = 100; // produkty na stronie glownej slider dolny
    const SMALL_HEIGHT = 100; // produkty na stronie glownej slider dolny
    const XSMALL_WIDTH = 70; // popup koszyka w headerze ->thumb, pager na produkcie
    const XSMALL_HEIGHT = 70; // popup koszyka w headerze ->thumb, pager na produkcie
    const PRODUCT_CATEGORY_BIG_PATH = 'files/products_categories/big/';
    const PRODUCT_CATEGORY_MEDIUM_PATH = 'files/products_categories/medium/';
    const PRODUCT_CATEGORY_SMALL_PATH = 'files/products_categories/small/';
    const PRODUCT_CATEGORY_SMALL_BANNER_PATH = 'files/products_categories/banner_small/';
    const PRODUCT_CATEGORY_BANNER_PATH = 'files/products_categories/banner/';
    const PRODUCT_CATEGORY_HOVER_SMALL_PATH = 'files/products_categories/hover/small/';
    const PRODUCT_CATEGORY_HOVER_MEDIUM_PATH = 'files/products_categories/hover/medium/';
    const PRODUCT_IMAGES_LIMIT = 1;
    const PRODUCTS_PER_PAGE = 6;
    const CATEGORIES_PER_PAGE = 6;
    const ATTR_BIG_PATH = 'files/attributes/big/';
    const ATTR_MEDIUM_PATH = 'files/attributes/medium/';
    const ATTR_SMALL_PATH = 'files/attributes/small/';
    const ATTR_BIG_WIDTH = 1024;
    const ATTR_BIG_HEIGHT = 1024;
    const ATTR_MEDIUM_WIDTH = 100;
    const ATTR_MEDIUM_HEIGHT = 100;
    const ATTR_SMALL_WIDTH = 16;
    const ATTR_SMALL_HEIGHT = 16;

    public static function AllowBuy($iStatusId) {
        $db = new Database();
        $iStatusId += 0;
        $result = $db->getwhere(table::SHOP_PRODUCTS_STATUSES, array('id_product_status' => $iStatusId));
        if ($result[0]->allow_buy == 'Y') {
            return true;
        }
        return false;
    }

    static public function CreateAddressForCategories($iCatId) {
        try {
            $oDb = new Database();

            //$result = $oDb->from(table::SHOP_CATEGORIES_DESCRIPTION)->where(array('category_id' => $iCatId))->get();
            //var_dump($result); exit;
            $url = self::_BuildUrl($iCatId);

            $sUrl = '/kategoria/' . $url . '/' . $iCatId;
            //var_dump($sUrl);
            return $sUrl;
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('site.error.create_address'));
        }
    }

    static private function _BuildUrl($iCatId) {
        //pobieramy dane kategorii
        $oDb = new Database();
        $result = $oDb->from(table::SHOP_CATEGORIES_DESCRIPTION)->where(array('category_id' => $iCatId))->get();

        $result = string::prepareURL($result[0]->category_name);
        //var_dump($url); exit;
//        if (!empty($result[0]->parent_id)) {
//            //pobieramy kategorie nadrzedna dla wybranej
//            return self::_BuildUrl($result[0]->parent_id, $url);
//        }
        return $result;
    }

    /**
     * @author Tomasz Drgas
     * @param array $aProducts */
    static public function ProductsCost($aProducts) {
        if (!empty($aProducts)) {
            $iProductCost = 0;
            foreach ($aProducts as $p) {
                $iProductCost += (double) $p['total'];
            }
            return $iProductCost;
        }
    }

    static public function ProductUrl($oProduct) {
        return Kohana::lang('links.lang') . 'produkt/' . $oProduct->id_product . '/' . string::prepareURL($oProduct->product_name);
    }

    public static function DeleteCartDoubles($cart_array) {
        return array_unique($cart_array, SORT_REGULAR);
    }

    public static function genToken($len = 32, $md5 = true) {

        # Seed random number generator
        # Only needed for PHP versions prior to 4.2
        mt_srand((double) microtime() * 1000000);

        # Array of characters, adjust as desired
        $chars = array(
            'Q', '@', '8', 'y', '%', '^', '5', 'Z', '(', 'G', '_', 'O', '`',
            'S', '-', 'N', '<', 'D', '{', '}', '[', ']', 'h', ';', 'W', '.',
            '/', '|', ':', '1', 'E', 'L', '4', '&', '6', '7', '#', '9', 'a',
            'A', 'b', 'B', '~', 'C', 'd', '>', 'e', '2', 'f', 'P', 'g', ')',
            '?', 'H', 'i', 'X', 'U', 'J', 'k', 'r', 'l', '3', 't', 'M', 'n',
            '=', 'o', '+', 'p', 'F', 'q', '!', 'K', 'R', 's', 'c', 'm', 'T',
            'v', 'j', 'u', 'V', 'w', ',', 'x', 'I', '$', 'Y', 'z', '*'
        );

        # Array indice friendly number of chars; empty token string
        $numChars = count($chars) - 1;
        $token = '';

        # Create random token at the specified length
        for ($i = 0; $i < $len; $i++)
            $token .= $chars[mt_rand(0, $numChars)];

        # Should token be run through md5?
        if ($md5) {

            # Number of 32 char chunks
            $chunks = ceil(strlen($token) / 32);
            $md5token = '';

            # Run each chunk through md5
            for ($i = 1; $i <= $chunks; $i++)
                $md5token .= md5(substr($token, $i * 32 - 32, 32));

            # Trim the token
            $token = substr($md5token, 0, $len);
        }

        return $token;
    }

    public function GetAttrGroupName($AttrValId) {
        $oDb = new Database();
        $result = $oDb->select('attribute_name')->from(table::SHOP_ATTRIBUTES_DESCRIPTION)->where(array('attribute_id' => $AttrValId))->get();

        return $result[0]->attribute_name;
    }

    public function ShowAlterCurrency($amount, $code = true) {
        $current = currency::GetCurrency();
        $oDb = new Database();
        $result = $oDb->from(table::SHOP_CURRENCIES)->where(array('currency_code' => $current))->get();
        if (!empty($result) && $result->count() > 0) {
            if ($result[0]->currency_default == 'Y') {
                return false;
            } else {
                $cur = '';
                if ($code == true) {
                    $cur = ' ' . $current;
                }
                return number_format($amount * $result[0]->currency_factor, 2, '.', ' ') . $cur;
            }
        } else {
            return false;
        }
    }

    public function ShowPriceBox($dPrice, $dOldPrice = null) {
        $oDb = new Database();
        $result = $oDb->from(table::SHOP_CURRENCIES)->where(array('currency_default' => 'Y'))->get();
        $default_code = $result[0]->currency_code;

        $rePrice = self::ShowAlterCurrency($dPrice);
        if (!empty($dOldPrice) && $dOldPrice > 0.00) {
            $reOldPrice = self::ShowAlterCurrency($dOldPrice);
        }
        $html = '<table class="box-price-cena">';
        $html .= '<tr><td><span class="price-lang">' . Kohana::lang('shop_app.product.price') . '</span></td>';
        if (!empty($rePrice) && $rePrice > 0) {
            $html .= '<td>' . $rePrice . '</td>';
            if (!empty($reOldPrice) && $reOldPrice > 0) {
                $html .= '<td style="text-decoration: line-through; font-size: 14px;">' . $reOldPrice . '</td>';
            }
            $html .= '</tr><tr><td></td>';
        }
        $html .= '<td>' . $dPrice . ' ' . $default_code . '</td>';
        if (!empty($dOldPrice) && $dOldPrice > 0) {
            $html .= '<td style="text-decoration: line-through; font-size: 14px;">' . $dOldPrice . ' ' . $default_code . '</td>';
        }
        $html .= '</tr></table>';

        return $html;
    }

    public static function Price($dPrice, $sCurrency = NULL) {
        $sPrice = number_format($dPrice, 2, '.', '');
        if (!empty($sCurrency)) {
            $sPrice .= ' ' . $sCurrency;
        } else {
            $sPrice .= ' ' . currency::GetCurrency();
        }
        return $sPrice;
    }
      public static function GetPrice($dPrice, $toNetto=false, $vat=null, $sCurrency = NULL) {
          if($toNetto){
              $vat=($vat/100)+1;
              $dPrice=$dPrice/$vat;
          }
         /* else{
              $vat=($vat/100)+1;
              $dPrice=$dPrice*$vat;
          } */
        $sPrice = number_format($dPrice, 2, '.', '');
      /*  if (!empty($sCurrency)) {
            $sPrice .= ' ' . $sCurrency;
        } else {
            $sPrice .= ' ' . currency::GetCurrency();
        }*/
        return $sPrice;
    }

    public static function ShowPriceWithCurrency($Price, $code = true) {
        $totalval = shop::ShowAlterCurrency($Price, $code);
        if (!empty($totalval)) {
            return number_format($totalval, 2, '.', '') . ' ' . $_SESSION['currency'] . ' (' . number_format($Price, 2, '.', '') . ') zł';
        } else {
            return number_format($Price, 2, '.', '') . ' zł';
        }
    }

    public function getFirstProductURL($iProductId) {
        $oDb = Database::instance();
        $oResult = $oDb->from(table::SHOP_PRODUCTS)
                ->join(table::SHOP_PRODUCTS_DESCRIPTION, table::SHOP_PRODUCTS_DESCRIPTION . '.product_id', table::SHOP_PRODUCTS . '.id_product', 'LEFT')
                ->join(table::SHOP_PRODUCTS_TO_CATEGORIES, table::SHOP_PRODUCTS_TO_CATEGORIES . '.product_id', table::SHOP_PRODUCTS . '.id_product', 'LEFT')
                ->where(array('product_language' => Kohana::config('locale.language')))
                ->get();
        if (!empty($oResult) && $oResult->count() > 0) {
//            if($oResult[0]->product_type!=0) {
            return Kohana::lang('links.lang') . $oResult[0]->id_product . string::prepareURL($oResult[0]->product_name);
//            }
        }
        return false;
    }

    public static function CatProductCount($catId) {
        $oProduct_Category = new Product_Category_Model();
        $result=$oProduct_Category->GetCategoryProductCount($catId)->Value;
        return $result;
    }

}

?>