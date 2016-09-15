<?php

defined('SYSPATH') OR die('No direct access allowed.');

class Partner_Model extends Model_Core {

    public function __construct() {
        parent::__construct();
        $this->db = Database::instance();
        $this->language = new Language_Model();
        $this->path = partners_helper::BIG_PATH;
        $this->thumbpath = partners_helper::SMALL_PATH;
        $this->xthumbpath = partners_helper::XSMALL_PATH;
    }

    public function GetAllPartners() {
        try {
            $result = $this->db->from(table::PARTNERS)->get();
            return new ErrorReporting(ErrorReporting::SUCCESS, $result);
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('admin.partners.error_list_partners'));
        }
    }

    public function GetPartnersForHomepage($iLimit = null) {
        try {
            if (empty($iLimit)) {
                $iLimit = 9;
            }
            $result = $this->db->from(table::PARTNERS)
                    ->where(array('available' => 'Y'))
                    ->limit($iLimit)
                    ->orderby('id_partner', 'DESC')
                    ->get();
            return new ErrorReporting(ErrorReporting::SUCCESS, $result);
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('admin.partners.error_get_partner_for_homepage'));
        }
    }

    public function GetPartnerDetails($iPartnerId) {
        try {
            $result = $this->db->from(table::PARTNERS)->where(array('id_partner' => $iPartnerId))->get();
            return new ErrorReporting(ErrorReporting::SUCCESS, $result);
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('admin.partners.error_get_partner_details'));
        }
    }

    public function Insert($aData, $aFiles) {
        try {
            if ($aData['available'] == 0) {
                $aData['available'] = 'N';
            } else if ($aData['available'] == 1) {
                $aData['available'] = 'Y';
            }

            unset($aData['back'], $aData['add_partner']);
            $aData['date_added'] = TIME;
            $aData['modified_date'] = '';

            // dodawanie obrazkow
            $image = $aFiles['photo'];

            // tworzymy obrazki
            if (!empty($image) && is_array($image) && !empty($image['name'])) {
                $imageData = file::upload(
                                $image, array(
                            'unique' => true,
                            'width' => 800,
                            'height' => 800,
                            'thumbwidth' => 140,
                            'thumbheight' => 140,
                            'xthumbwidth' => partners_helper::XSMALL_WIDTH,
                            'xthumbheight' => partners_helper::XSMALL_HEIGHT,
                            'path' => $this->path,
                            'thumbpath' => $this->thumbpath,
                            'xthumbpath' => $this->xthumbpath
                                )
                );
            }

            $aData['photo'] = $imageData->Value['filename'];

            $oPartnersInsert = $this->db->insert(table::PARTNERS, $aData);
            return new ErrorReporting(ErrorReporting::SUCCESS, true, Kohana::lang('admin.partners.success_insert_partner'));
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('admin.partners.error_insert_partner'));
        }
    }

    public function Update($aData, $iPartnerId, $aFiles = null) {
        try {

            $this->db->query('SET AUTOCOMMIT = 0');
            $this->db->query('BEGIN');
            if ($aData['available'] == 0) {
                $aData['available'] = 'N';
            } else if ($aData['available'] == 1) {
                $aData['available'] = 'Y';
            }

            unset($aData['back'], $aData['edit_partner']);
            $aData['modified_date'] = TIME;

            // dodanie nowego zdjęcie i usunięcie starego
            if (!empty($aFiles) && !empty($aFiles['photo']['name']) && $aFiles['photo']['name'] != '') {
                $oPartner = $this->GetPartnerDetails($iPartnerId)->Value[0];
                if (!empty($oPartner)) {
                    if (file_exists($this->path . $oPartner->photo)) { //duże foto
                        unlink($this->path . $oPartner->photo);
                    }
                    if (file_exists($this->thumbpath . $oPartner->photo)) { // miniaturka
                        unlink($this->thumbpath . $oPartner->photo);
                    }
                    if (file_exists($this->xthumbpath . $oPartner->photo)) { // miniaturka
                        unlink($this->xthumbpath . $oPartner->photo);
                    }
                }

                $image = $aFiles['photo'];
                // tworzymy obrazki
                if (!empty($image) && is_array($image) && !empty($image['name'])) {
                    $imageData = file::upload(
                                    $image, array(
                                'unique' => true,
                                'width' => 800,
                                'height' => 800,
                                'thumbwidth' => 140,
                                'thumbheight' => 140,
                                'xthumbwidth' => partners_helper::XSMALL_WIDTH,
                                'xthumbheight' => partners_helper::XSMALL_HEIGHT,
                                'path' => $this->path,
                                'thumbpath' => $this->thumbpath,
                                'xthumbpath' => $this->xthumbpath
                                    )
                    );
                    $aData['photo'] = $imageData->Value['filename'];
                }
            }


            $oPartnersUpdate = $this->db->update(table::PARTNERS, $aData, array('id_partner' => $iPartnerId));
            $this->db->query('COMMIT');
            return new ErrorReporting(ErrorReporting::SUCCESS, true, Kohana::lang('admin.partners.success_update_partner'));
        } catch (Exception $ex) {
            $this->db->query('ROLLBACK');
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('admin.partners.error_update_partner'));
        }
    }

    public function DeletePartnerArray($iPartnerId) {
        try {
            if (is_array($iPartnerId)) {
                foreach ($iPartnerId as $p) {
                    $this->DeletePartner($p);
                }
                return new ErrorReporting(ErrorReporting::SUCCESS, true, Kohana::lang('admin.partners.success_delete_partner'));
            } else {
                $iPartnerId+=0;
                return $this->DeletePartner($iPartnerId);
            }
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('admin.partners.error_delete_partner'));
        }
    }

    public function DeletePartner($iPartnerId) {
        try {
            $iPartnerId += 0;
            $oPartner = $this->GetPartnerDetails($iPartnerId)->Value[0];
            if (!empty($oPartner)) {
                if (file_exists($this->path . $oPartner->photo)) { //duże foto
                    unlink($this->path . $oPartner->photo);
                }
                if (file_exists($this->thumbpath . $oPartner->photo)) { // miniaturka
                    unlink($this->thumbpath . $oPartner->photo);
                }
                if (file_exists($this->xthumbpath . $oPartner->photo)) { // miniaturka
                    unlink($this->xthumbpath . $oPartner->photo);
                }
            }

            $result = $this->db->delete(table::PARTNERS, array('id_partner' => $iPartnerId));

            return new ErrorReporting(ErrorReporting::SUCCESS, true, Kohana::lang('admin.partners.success_delete_partner'));
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('admin.partners.error_delete_partner'));
        }
    }

    public function UpdatePartner($iPartnerId) {
        try {
            $iPartnerId += 0;
            return new ErrorReporting(ErrorReporting::SUCCESS, true, Kohana::lang('admin.partners.success_edit_partner'));
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('admin.partners.error_edit_partner'));
        }
    }

    public function ValidateAddPartner($aData, $aFiles) {
        if (empty($aData['name'])) {
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('admin.partners.error_name_empty'));
        } else if (empty($aFiles)) {
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('admin.partners.error_photo_empty'));
        } else {
            return new ErrorReporting(ErrorReporting::SUCCESS, true, '');
        }
    }

    public function ValidateEditPartner($aData) {
        if (empty($aData['name'])) {
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('admin.partners.error_name_empty'));
        } else {
            return new ErrorReporting(ErrorReporting::SUCCESS, true, '');
        }
    }

}

?>
