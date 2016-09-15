<?php
defined('SYSPATH') OR die('No direct access allowed.');

class Configuration_Model extends Model_Core {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Zwraca konfiguracje
     * @return ErrorReporting
     */
    public function FindAll() {
        try {
            return new ErrorReporting(ErrorReporting::SUCCESS,
                    $this->db->get(table::CONFIGURATION), '');
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, '');
        }
    }
    
    /**
     * Funkcja aktualizuje pojedyńczy element konfiguracji
     * @author Kamil Kowalski
     *
     * @param integer $id
     * @param array $data
     * @return ErrorReporting
     */
    public function Update(array $data) {
        try {
            Kohana::log('error', print_r($data, true));
            foreach ($data as $key => $value) {
            	$result = $this->db->update(table::CONFIGURATION, array('value' => $value), array('key' => $key));
			}
            return new ErrorReporting(ErrorReporting::SUCCESS, $result, Kohana::lang('configuration.update_configuration_success'));
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('configuration.update_configuration_error')." MySQL:".$this->db->last_query());
        }
    }
}
