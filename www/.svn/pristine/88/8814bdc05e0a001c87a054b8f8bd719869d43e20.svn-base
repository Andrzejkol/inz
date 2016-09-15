<?php
defined('SYSPATH') OR die('No direct access allowed.');
class config {
    const DATE_FORMAT = 'd-m-Y';
    const DATE_TIME_FORMAT = 'd-m-Y, H:i:s';
    const JQ_DATE_FORMAT = 'dd-mm-yy';

    const PREG_FROM = '/[^a-zęółśążźćńA-ZĘÓŁŚĄŻŹĆŃ0-9]+/';
    const PREG_TO = '-';
    

    public static function getConfig($key) {
        try {
            $db = new Database;
            $result = $db->limit(1)->getwhere(table::CONFIGURATION, array('key' => $key));            
            return $result[0]->value;            
        } catch(Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return false;
        }
    }
	
	/*
	* funkcja już nie używana
	*
	
	public static function getConfigOld($key) {
        try {
            $db = new Database;
            $result = $db->select($key)->limit(1)->get(table::CONFIGURATION);
            Kohana::log('error', $result[0]);
            return $result[0]->$key;            
        } catch(Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return false;
        }
    }
    */
    
    public static function CheckIfModuleEnabled($sModuleName)
	{
		try {
			$sModuleName = trim($sModuleName);
			if ( ! empty($sModuleName))
			{
				$aModules = Kohana::config('config.modules');
				if ( ! empty($aModules) AND count($aModules) > 0)
				{
					foreach ($aModules as $sModule)
					{
						if (strpos($sModule, $sModuleName) !== FALSE)
						{
							return TRUE;
						}
					}
					return FALSE;
				}
				else
				{
					throw new Exception;
				}
			}
			else {
				throw new Exception;
			}
        } catch(Exception $ex) {
            Kohana::log('error', $ex->getFile() . $ex->getLine() . $ex->getMessage());
            return FALSE;
        }
	}
}
?>
