<?php

class import_CSV_Controller extends App_Shop_Controller {

    const ALLOW_PRODUCTION = TRUE;

    public function __construct() {
        parent::__construct();
    }
    

    public function import() {
        ini_set('max_execution_time', 100000000000);

        $this->oImport = new Import_Model();
        $this->profile = new Profiler_Core();
        try {
            $oDb = Database::instance();
            $input = fopen("cennik-last3.csv", 'r');

            while ($row = fgetcsv($input, 0, ';')) {
                // pola:
                // 0:marka
                // 1:katalog
                // 2: 
                // 3: kategoria
                // 4: podkategoria
                // 5: kod produktu
                // 6: zdjęcie
                // 7: płeć
                // 8: kolor
                // 9: opakowanie
                // 10: nazwa
                // 11: cena detaliczna brutto
                // 12: cena od 1 szt.
                // 13: cena od 3 szt.
                // 14: cena od 5 szt.
                // 15: cena od 10 szt.
                // 16: cena od 25 szt.
                // 17: cena od 50 szt.
                // 18: cena od 100 szt.
                // 19: cena od 250 szt.
                // 20: cena od 500 szt.
                // 21: cena od 1000 szt.
                // 22: wymiary
                // 23: waga
                // 24: Materiał 1
                // 25: Materiał 2
                // 26: Kolor wkładu
                // 27: Materiał podszewki
                // 28: Mechanizm
                // 29: Wodoszczelność
                // 30: Liczba kieszeni na banknoty
                // 31: Kieszeń na monety
                // 32: Liczba kieszeni na karty	
                // 33: Kieszeń na paszport
                // 34: Liczba przegródek
                // 35: Kieszeń na komputer
                // 36: Rodzaj zamknięcia
                // 37: Kieszeń na długopis
                // 38: Ochrona UV
                // 39: Pojemność
                // 40: Marka kości pamięci
                // 41: Liczba kartek
                // 42: Mechanizm otwierania
                // 
                // 43: produkt zapakowany w eleganckie etui upominkowe
                // 44: produkt zapakowany w elegancki woreczek nylonowy
                // 45: certyfikat oryginalności marki
                // 46: 24 miesiące gwarancji
                // 47: Nadruk logo (tampondruk)	
                // 48: Nadruk na opakowaniu	
                // 49: Grawer laserowy	
                // 50: Grawer na klipsie	
                // 51: Blaszka z logo	
                // 52: Blaszka na opakowaniu	
                // 53: Bilecik okazjonalny	
                // 54: Obwoluta z nadrukiem full color	
                // 55: Tłoczenie na gorąco	
                // 56: Dowieszka na łańcuszku kulkowym






                $aCategoryMap = Import_Model::CategoryMap();
                $aProducerMap = Import_Model::ProducerMap();
//                var_dump($row[0]);
//                if(empty($row[0])) {
//                    $row[0] = 'U';
//                }
                $prod = $oDb->from(table::SHOP_PRODUCTS_DESCRIPTION . ' as spd')
                        ->join(table::SHOP_PRODUCTS . ' as sp', 'sp.id_product', 'spd.product_id', 'left')
                        ->where(array('product_code' => $row[5]))
                        ->count_records();

                // jesli nie bylo jeszcze takiego produktu
//                if (empty($prod[0]) || (!empty($prod) && $prod->count() == 0)) {

                $aDesc = array();
                $sDesc = '';
                if ($row[43] == 'x') {
                    $sDesc .= '<li>Produkt zapakowany w eleganckie etui upominkowe</li>';
                }
                if ($row[44] == 'x') {
                    $sDesc .= '<li>Produkt zapakowany w elegancki woreczek nylonowy</li>';
                }
                if ($row[45] == 'x') {
                    $sDesc .= '<li>Certyfikat oryginalności marki</li>';
                }
                if ($row[46] == 'x') {
                    $sDesc .= '<li>24 miesiące gwarnacji</li>';
                }
                if ($row[47] == 'x') {
                    $sDesc .= '<li>Nadruk logo (tampondruk)</li>';
                }
                if ($row[48] == 'x') {
                    $sDesc .= '<li>Nadruk na opakowaniu</li>';
                }
                if ($row[49] == 'x') {
                    $sDesc .= '<li>Grawer laserowy</li>';
                }
                if ($row[50] == 'x') {
                    $sDesc .= '<li>Grawer na klipsie</li>';
                }
                if ($row[51] == 'x') {
                    $sDesc .= '<li>Blaszka z logo</li>';
                }
                if ($row[52] == 'x') {
                    $sDesc .= '<li>Blaszka na opakowaniu</li>';
                }
                if ($row[53] == 'x') {
                    $sDesc .= '<li>Bilecik okazjonalny</li>';
                }
                if ($row[54] == 'x') {
                    $sDesc .= '<li>Obwoluta z nadrukiem full color</li>';
                }
                if ($row[55] == 'x') {
                    $sDesc .= '<li>Tłoczenie na gorąco</li>';
                }
                if ($row[56] == 'x') {
                    $sDesc .= '<li>Dowieszka na łańcuszku kulkowym</li>';
                }
                $sDesc2 = '';
                if (!empty($sDesc)) {
                    $sDesc2 = '<ul>' . $sDesc . '</ul>';
                }

                if (empty($prod[0])) {
                    $oProduct = $oDb->insert(table::SHOP_PRODUCTS, array(// ok
                        'code' => $row[5],
                        'price' => $row[11],
                        'weight' => $row[23],
                        'size' => $row[22],
                        'gender' => $row[7],
                        'color' => $row[8],
                        'producer_id' => $aProducerMap[trim($row[0])],
                        'etui' => ($row[24] == 'x') ? '1' : '0',
                        'woreczek' => ($row[25] == 'x') ? '1' : '0',
                        'certyfikat' => ($row[26] == 'x') ? '1' : '0',
                        'gwarancja' => ($row[27] == 'x') ? '1' : '0',
                    ));
                    $oProductDesc = $oDb->insert(table::SHOP_PRODUCTS_DESCRIPTION, array(// ok
                        'product_id' => $oProduct->insert_id(),
                        'product_name' => $row[10],
                        'product_box' => $row[9],
                        'product_code' => $row[5],
                        'product_brand' => $row[0],
                        'product_description' => $sDesc2,
                    ));
                    $oProductDesc = $oDb->insert(table::SHOP_PRODUCTS_PRICES, array(// ok
                        'product_id' => $oProduct->insert_id(),
                        'od_1' => $row[12],
                        'od_3' => $row[13],
                        'od_5' => $row[14],
                        'od_10' => $row[15],
                        'od_25' => $row[16],
                        'od_50' => $row[17],
                        'od_100' => $row[18],
                        'od_250' => $row[19],
                        'od_500' => $row[20],
                        'od_1000' => $row[21],
                    ));
                }

                $row[4] = trim($row[4]);
                $row[3] = trim($row[3]);
                $oProduct_insert_id = $oProduct->insert_id();

                // podkategorie jako tablica
                $aSubCats = explode(';', $row[4]);
                if (count($aSubCats) > 1) {
                    $row[4] = $aSubCats;
                }

                $sCat = trim($row[3]);
                $idCat = $this->oImport->AddCategory($sCat, $aCategoryMap)->Value;
                $this->oImport->AddProductToCategory($oProduct_insert_id, $idCat);

//                var_dump($idCat);
                // jesli podkategorie sa tablica
                if (is_array($row[4])) {
                    foreach ($row[4] as $sSubCat) {
                        $sSubCat = trim($sSubCat);
                        $idSubCat = $this->oImport->AddCategory($sSubCat, $aCategoryMap, $idCat)->Value;
                        $this->oImport->AddProductToCategory($oProduct_insert_id, $idSubCat);
                    }
                } else {
                    $sSubCat = trim($row[4]);
                    $idSubCat = $this->oImport->AddCategory($sSubCat, $aCategoryMap, $idCat)->Value;
                    $this->oImport->AddProductToCategory($oProduct_insert_id, $idSubCat);
                }

//                if ($oProduct_insert_id != 0 && !empty($row[6]) && ($row[6] != 'Jpg')) {
//                    file_put_contents(shop::SMALL_PATH . $row[6] . '.jpg', file_get_contents('http://brands-images-distribution.s3-eu-west-1.amazonaws.com/static/images/white/100/' . $row[6] . '.jpg', ' '));
//                    file_put_contents(shop::XSMALL_PATH . $row[6] . '.jpg', file_get_contents('http://brands-images-distribution.s3-eu-west-1.amazonaws.com/static/images/white/60/' . $row[6] . '.jpg', ' '));
//                    file_put_contents(shop::MEDIUM_PATH . $row[6] . '.jpg', file_get_contents('http://brands-images-distribution.s3-eu-west-1.amazonaws.com/static/images/white/1000/' . $row[6] . '.jpg', ' '));
//                    if (file_exists('http://brands-images-distribution.s3-eu-west-1.amazonaws.com/static/images/white/220/' . $row[6] . '.jpg')) {
//                        file_put_contents(shop::XMEDIUM_PATH . $row[6] . '.jpg', file_get_contents('http://brands-images-distribution.s3-eu-west-1.amazonaws.com/static/images/white/220/' . $row[6] . '.jpg', ' '));
//                    } else {
//                        file_put_contents(shop::XMEDIUM_PATH . $row[6] . '.jpg', file_get_contents('http://brands-images-distribution.s3-eu-west-1.amazonaws.com/static/images/white/200/' . $row[6] . '.jpg', ' '));
//                    }
//                    file_put_contents(shop::XXMEDIUM_PATH . $row[6] . '.jpg', file_get_contents('http://brands-images-distribution.s3-eu-west-1.amazonaws.com/static/images/white/140/' . $row[6] . '.jpg', ' '));
//                    file_put_contents(shop::BIG_PATH . $row[6] . '.jpg', file_get_contents('http://brands-images-distribution.s3-eu-west-1.amazonaws.com/static/images/white/1000/' . $row[6] . '.jpg', ' '));
//
//                    $oDb->insert(
//                            table::SHOP_PRODUCTS_IMAGES, array(
//                        'product_id' => $oProduct_insert_id,
//                        'mainimage' => 'Y',
//                        'filename' => $row[6] . '.jpg',
//                        'realfilename' => $row[6] . '.jpg'
//                            )
//                    );
//                }
            }
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, null, $ex->getMessage());
        }
    }

    public function import_zdjec() {
        ini_set('max_execution_time', 100000000000);

        $this->oImport = new Import_Model();
        $this->profile = new Profiler_Core();
        try {
            $oDb = Database::instance();


            $prods = $oDb->from(table::SHOP_PRODUCTS . ' as sp')
                    ->get();

            foreach ($prods as $oP) {
                $sFile = 'http://brands-images-distribution.s3-eu-west-1.amazonaws.com/static/images/white/1000/' . $oP->code . '.jpg';
                $file_headers = @get_headers($sFile);
                if ($file_headers[0] != 'HTTP/1.1 404 Not Found' && $file_headers[0] != 'HTTP/1.1 403 Forbidden') {
                    if (!file_exists(shop::BIG_PATH . $oP->code . '.jpg')) {
                        file_put_contents(shop::BIG_PATH . $oP->code . '.jpg', file_get_contents($sFile, ' '));


                        $imageSmall = new Image(shop::BIG_PATH . $oP->code . '.jpg');
                        $imageXSmall = new Image(shop::BIG_PATH . $oP->code . '.jpg');
                        $imageMedium = new Image(shop::BIG_PATH . $oP->code . '.jpg');
                        $imageXMedium = new Image(shop::BIG_PATH . $oP->code . '.jpg');
                        $imageXXMedium = new Image(shop::BIG_PATH . $oP->code . '.jpg');

                        $imageSmall->resize(100, 100, Image::AUTO);
                        $imageSmall->save(shop::SMALL_PATH . $oP->code . '.jpg');

                        $imageXSmall->resize(60, 60, Image::AUTO);
                        $imageXSmall->save(shop::XSMALL_PATH . $oP->code . '.jpg');

                        $imageMedium->resize(1000, 1000, Image::AUTO);
                        $imageMedium->save(shop::MEDIUM_PATH . $oP->code . '.jpg');

                        $imageXMedium->resize(200, 200, Image::AUTO);
                        $imageXMedium->save(shop::XMEDIUM_PATH . $oP->code . '.jpg');

                        $imageXXMedium->resize(140, 140, Image::AUTO);
                        $imageXXMedium->save(shop::XXMEDIUM_PATH . $oP->code . '.jpg');
                        //}
//                    file_put_contents(shop::SMALL_PATH . $oP->code . '.jpg', file_get_contents('http://brands-images-distribution.s3-eu-west-1.amazonaws.com/static/images/white/100/' . $oP->code . '.jpg', ' '));
//                    file_put_contents(shop::XSMALL_PATH . $oP->code . '.jpg', file_get_contents('http://brands-images-distribution.s3-eu-west-1.amazonaws.com/static/images/white/60/' . $oP->code . '.jpg', ' '));
//                    file_put_contents(shop::MEDIUM_PATH . $oP->code . '.jpg', file_get_contents('http://brands-images-distribution.s3-eu-west-1.amazonaws.com/static/images/white/1000/' . $oP->code . '.jpg', ' '));
//                    if (file_exists('http://brands-images-distribution.s3-eu-west-1.amazonaws.com/static/images/white/220/' . $oP->code . '.jpg')) {
//                        file_put_contents(shop::XMEDIUM_PATH . $oP->code . '.jpg', file_get_contents('http://brands-images-distribution.s3-eu-west-1.amazonaws.com/static/images/white/220/' . $oP->code . '.jpg', ' '));
//                    } else {
//                        file_put_contents(shop::XMEDIUM_PATH . $oP->code . '.jpg', file_get_contents('http://brands-images-distribution.s3-eu-west-1.amazonaws.com/static/images/white/200/' . $oP->code . '.jpg', ' '));
//                    }
//                    file_put_contents(shop::XXMEDIUM_PATH . $oP->code . '.jpg', file_get_contents('http://brands-images-distribution.s3-eu-west-1.amazonaws.com/static/images/white/140/' . $oP->code . '.jpg', ' '));
                    }
                    //echo '11';
                    $oInsert = $oDb->insert(
                            table::SHOP_PRODUCTS_IMAGES, array(
                        'product_id' => $oP->id_product,
                        'mainimage' => 'Y',
                        'filename' => $oP->code . '.jpg',
                        'realfilename' => $oP->code . '.jpg'
                            )
                    );
                    //var_dump($oInsert);
                    //exit;
                }
                //exit;
            }
            echo 'koniec';
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, null, $ex->getMessage());
        }
    }

}

?>