<?php

class Voucher_Model extends Model_Core {

    private $_rDb;

    public function __construct() {
        $this->_rDb = Database::instance();
    }

    public function Find($id) {
        try {
            $result = $this->_rDb->from(table::VOUCHERS)
                    ->where(array('id_voucher' => $id))
                    ->get();
            return new ErrorReporting(ErrorReporting::SUCCESS, $result, '');
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, null, $ex->getMessage());
        }
    }

    /**
     *
     * @param [integer $limit]
     * @param [integer $offset]
     * @return ErrorReporting
     */
    public function FindAll($limit = null, $offset = null) {
        try {
            if (empty($limit) && empty($offset) && !isset($offset)) {
                return new ErrorReporting(ErrorReporting::SUCCESS, $this->_rDb->orderby('id_voucher', 'DESC')->get(table::VOUCHERS), '');
            } else {
                return new ErrorReporting(ErrorReporting::SUCCESS, $this->_rDb->limit($limit, $offset)->get(table::VOUCHERS), '');
            }
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, null, $ex->getMessage());
        }
    }

    public function ValidateInsert(array $aPost = array(), array $files = array()) {
        try {
            $alert = '';
            if (empty($aPost['voucher_code']) && !isset($aPost['automatically_generate'])) {
                $alert .= '<li>Musisz podać nazwę vouchera lub zaznaczyć automatyczną generację.</li>';
            } else if(strpos($aPost['voucher_code'],'-') === false && empty($aPost['automatically_generate'])) {
                $alert .= '<li>Kod vouchera musi zawierać myślnik.</li>';
            }
            if (empty($aPost['voucher_value'])) {
                $alert .= '<li>Musisz podać wartość vouchera.</li>';
            }
            if (!empty($alert)) {
                $alert = '<strong>' . Kohana::lang('poll.following_errors') . '</strong>: <ul>' . $alert . '</ul>';
                return new ErrorReporting(ErrorReporting::ERROR, false, $alert);
            } else {
                return new ErrorReporting(ErrorReporting::SUCCESS, true, '');
            }
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, null, $ex->getMessage());
        }
    }

    public function ValidateUpdate(array $aPost = array()) {
        try {
            $alert = '';
            if (empty($aPost['voucher_code'])) {
                $alert .= '<li>Musisz podać nazwę vouchera.</li>';
            } else if(strpos($aPost['voucher_code'],'-') === false && empty($aPost['automatically_generate'])) {
                $alert .= '<li>Kod vouchera musi zawierać myślnik.</li>';
            }
            if (empty($aPost['voucher_value'])) {
                $alert .= '<li>Musisz podać wartość vouchera.</li>';
            }
            if (!empty($alert)) {
                $alert = '<strong>' . Kohana::lang('poll.following_errors') . '</strong>: <ul>' . $alert . '</ul>';
                return new ErrorReporting(ErrorReporting::ERROR, false, $alert);
            } else {
                return new ErrorReporting(ErrorReporting::SUCCESS, true, '');
            }
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, null, $ex->getMessage());
        }
    }

    public static function GenerateCode(&$code) {
        $tablica_znakow = '1234567890ABCDEFGHIJKLMNOPQRSTUWXZ';
        $liczba_blokow = 4;
        $dlugosc_bloku = 4;
        for ($j = 0; $j < $liczba_blokow * $dlugosc_bloku; $j++) {
            $code .= $tablica_znakow[rand() % (strlen($tablica_znakow))];
            if (($j + 1) % $dlugosc_bloku == 0 && $j < ($liczba_blokow * $dlugosc_bloku - 1)) {
                $code .='-';
            }
        }
    }

    public static function isToken($token) {
        if (isset($token) && $token) {
            $_rDb = Database::instance();
            $iVoucher = $_rDb->from(table::VOUCHERS)
                    ->where(array('voucher_code' => $token))
                    ->count_records();
            if ($iVoucher > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public static function GenerateUniqueToken(&$sToken) {
        self::GenerateCode($sToken);

        if (self::isToken($sToken)) {
            $sToken = '';
            return self::GenerateUniqueToken($sToken);
        } else {
            return $sToken;
        }
    }

    /**
     *
     * @param array $data
     * @return ErrorReporting
     */
    public function Insert(array $data) {
        try {
            if (isset($data['automatically_generate'])) {
                $automatic = "on";
                unset($data['automatically_generate']);
            }
            if (isset($data['quantity_codes'])) {
                $number_of_codes = $data['quantity_codes'];
                unset($data['quantity_codes']);
            }

            if (!empty($automatic) && $automatic == "on" && $number_of_codes > 0) {
                $Adata = array();
                for ($i = 0; $i < $number_of_codes; $i++) {
                    $sVoucher = '';
                    self::GenerateUniqueToken($sVoucher);
                    $Adata['voucher_status'] = !empty($data['voucher_status']) ? $data['voucher_status'] : 1;
                    $Adata['voucher_create'] = date('Y-m-d H:i:s', time());
                    $Adata['voucher_value'] = $data['voucher_value'];
                    $Adata['voucher_code'] = $sVoucher;

                    $oInsert = $this->_rDb->insert(table::VOUCHERS, $Adata);
                }
                return new ErrorReporting(ErrorReporting::SUCCESS, $oInsert, 'Vouchery zostały dodane.');
            } else {
                unset($data['submit'], $data['products']);
                $data['voucher_status'] = !empty($data['voucher_status']) ? $data['voucher_status'] : 1;
                $data['voucher_create'] = date('Y-m-d H:i:s', time());
                $oInsert = $this->_rDb->insert(table::VOUCHERS, $data);

                return new ErrorReporting(ErrorReporting::SUCCESS, $oInsert, 'Voucher został dodany.');
            }
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, null, $ex->getMessage());
        }
    }

    public function Update($id, array $data) {
        try {
            unset($data['submit'], $data['products']);
            $data['voucher_status'] = !empty($data['voucher_status']) ? $data['voucher_status'] : 0;
            $data['voucher_modify'] = date('Y-m-d H:i:s', time());
            $oUpdate = $this->_rDb->update(table::VOUCHERS, $data, array('id_voucher' => $id));


            return new ErrorReporting(ErrorReporting::SUCCESS, $oUpdate, 'Voucher został zaktualizowany.');
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, null, $ex->getMessage());
        }
    }

    public function Delete($id) {
        try {
            return new ErrorReporting(ErrorReporting::SUCCESS, $this->_rDb->delete(table::VOUCHERS, array('id_voucher' => $id)), 'Usunięto voucher.');
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, null, $ex->getMessage());
        }
    }

    public static function VoucherInfo($iProductOrderId) {
        $oDb = Database::instance();
        $oVouchers = $oDb->from(table::VOUCHERS)
                ->where(array('order_product_id' => $iProductOrderId))
                ->get();
        if (!empty($oVouchers) && $oVouchers->count() > 0) {
            foreach ($oVouchers as $oV) {
                if ($oV->voucher_status == '1') {
                    echo '<br/>'.$oV->voucher_code;
                }
                if ($oV->voucher_status == '2') {
                    echo '<br/>'.$oV->voucher_code . ' (wykorzystany) ';
                }
            }
        }
    }

}
