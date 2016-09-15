<?php

class Popup_Model extends Model_Core {

    protected $db;

    public function __construct() {
        parent::__construct();
        $this->_oDb = new Database();
    }

    public function PopupGet($bCount = NULL, $iPopupId = NULL, $limit = null, $offset = null) {
        try {
            $this->_oDb->from(popup_helper::POPUP);
            
            if (!empty($iPopupId)) {
                $this->_oDb->where(array('id_popup' => $iPopupId));
            }

            if (!empty($limit) && isset($offset)) {
                $this->_oDb->limit($limit, $offset);
            }

            if (!empty($bCount) && $bCount === TRUE) {
                $result = $this->_oDb->count_records();
                return new ErrorReporting(ErrorReporting::SUCCESS, $result);
            } else {
                $this->_oDb->orderby('id_popup', 'asc');
                $result = $this->_oDb->get();
            }

            return new ErrorReporting(ErrorReporting::SUCCESS, $result);
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, 'Wystąpił błąd podczas pobierania elementów.');
        }
    }

    public function Add($aPost) {
        try {

            unset($aPost['submit'], $aPost['submit_back']);
            $insert = $this->db->insert(popup_helper::POPUP, $aPost);

            return new ErrorReporting(ErrorReporting::SUCCESS, $insert->insert_id(), 'Dodano nowy element.');
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, 'Wystąpił błąd podczas dodawania elementu');
        }
    }

    public function Update($iId, $aPost) {
        try {
            unset($aPost['submit'], $aPost['submit_back']);
            $insert = $this->db->Update(popup_helper::POPUP, $aPost, array('id_popup' => $iId));
            return new ErrorReporting(ErrorReporting::SUCCESS, $insert->insert_id(), 'Edytowano element.');
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, 'Wystąpił błąd podczas edycji elementu');
        }
    }

    public function Delete($iId) {
        try {
            $insert = $this->db->Delete(popup_helper::POPUP, array('id_popup' => $iId));
            return new ErrorReporting(ErrorReporting::SUCCESS, $insert->insert_id(), 'Usunięto element.');
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, 'Wystąpił błąd podczas usuwanie elementu');
        }
    }

    public function Validate_add(array $aPost) {
        $alert = '';
        if (empty($aPost['title'])) {
            $alert .= '<li>Musisz podać nazwę elementu</li>';
        }
        if (empty($aPost['content'])) {
            $alert .= '<li>Musisz wpisać zawartość elementu</li>';
        }

        if (!empty($alert)) {
            $alert = '<strong> Wystąpiły następujące błędy: </strong>: <ul>' . $alert . '</ul>';
            return new ErrorReporting(ErrorReporting::ERROR, false, $alert);
        } else {
            return new ErrorReporting(ErrorReporting::SUCCESS, true, '');
        }
    }

}

?>