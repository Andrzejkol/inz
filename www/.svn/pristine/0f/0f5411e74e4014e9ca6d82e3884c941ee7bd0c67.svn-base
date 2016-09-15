<?php

defined('SYSPATH') OR die('No direct access allowed.');

class Backup_Model extends Model_Core {

    /**
     *
     * @return unknown_type
     */
    public function __construct() {
        parent::__construct();
        $this->db = Database::instance();
        $this->path = backup::BIG_PATH;
        $this->thumbpath = backup::SMALL_PATH;
    }

    /*
     *
     * funcka zwraca wszystkie boxy ze wszystkich zestawów
     *
     */

    public function getAllBackups($limit = null, $offset = null, $active = null, $sLang = NULL) {
        try {
            $result = $this->db->from(table::BACKUPS);

            if (isset($limit) && isset($offset)) {
                $result = $result
                        ->limit($limit, $offset);
            }

            if (!empty($_GET['backup_orderby'])) {
                switch ($_GET['backup_orderby']) {
                    case 1:
                        $result = $result->orderby(array('name' => 'ASC'))->get();
                        break;
                    case 2:
                        $result = $result->orderby(array('name' => 'DESC'))->get();
                        break;
                    case 3:
                        $result = $result->orderby(array('description' => 'ASC'))->get();
                        break;
                    case 4:
                        $result = $result->orderby(array('description' => 'DESC'))->get();
                        break;
                }
            } else {
                $result = $result->orderby(array('backup_id' => 'DESC'))->get();
            }

            return new ErrorReporting(ErrorReporting::SUCCESS, $result, Kohana::lang('backup.success_get'));
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('backup.error_get'));
        }
    }

    /*
     *
     * funkcja pobiera box'y z danego zestawu boxes
     * parametr - $box_id
     * @return ErrorReporting (MySQL Object $result || Bool false)
     */

    public function get($backup_id, $aWhere = array()) {
        $backup_id = intval($backup_id);
        try {
            $this->db->from(table::BACKUPS)                    
                    ->where('backup_id', $backup_id);

            if (!empty($_GET['backup_orderby'])) {
                switch ($_GET['backup_orderby']) {
                    case 1:
                        $this->db->orderby(array('name' => 'ASC'));
                        break;
                    case 2:
                        $this->db->orderby(array('name' => 'DESC'));
                        break;
                }
            } else {
                $this->db->orderby(array('position' => 'DESC'));
            }

            if(!empty($aWhere)) {
                $this->db->where($aWhere);
            }
            
            $result = $this->db->get();

            return new ErrorReporting(ErrorReporting::SUCCESS, $result, Kohana::lang('backup.success_get'));
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('backup.error_get'));
        }
    }

    
    /**
     * helper for frontend
     * @param type $name
     * @return type 
     */
    public static function getBackup($name) {
        $db = new Database();
        $result = $db
                ->select('title', 'link', 'contents')
                ->from(table::BOXES)
                ->where('name', $name)
                ->where('active', 1)
                ->get()
                ->current()
        ;
        return $result;
    }

    public function DeleteBackup($backup_id) {
        try {
            $this->db->query('SET AUTOCOMMIT = 0');
            $this->db->query('BEGIN');
            $backup = $this->get_file($backup_id);
            unlink($backup);
            
            $this->db->delete(table::BACKUPS, array('backup_id' => $backup_id));            

            $this->db->query('COMMIT');
            return new ErrorReporting(ErrorReporting::SUCCESS, true, Kohana::lang('backup.success_delete_backup'));
        } catch (Exception $ex) {
            $this->db->query('ROLLBACK');
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('backup.delete_backup'));
        }
    }
    
    public function create_backup($aPost) {
        //if the zip file already exists and overwrite is false, return false
        //$destination = 'backups/backup_'.date('YmdHis').'.zip';
        $destination = BACKPATH.'backup_'.date('YmdHis').'.zip';
        if(file_exists($destination)) { return false; }
        $dirs = array();
        foreach($aPost['elements'] as $element){
            $dirs[] = $element;
        }
        //var_dump($dirs);
        $dirsA = implode(';', $dirs);
        $aPost['dirs'] = $dirsA;
        if(count($dirs)) {
                $zip = new ZipArchive();
                $zfile = $destination;
                //var_dump($zfile);
                if($zip->open($zfile, ZIPARCHIVE::CREATE) !== true) {
                        return false;
                }
                foreach($dirs as $dir) {
                    $dirr = $dir."/"; 
                    $dirrr = $dirr;
                        $files = new RecursiveIteratorIterator(
                            new RecursiveDirectoryIterator($dirrr),
                            RecursiveIteratorIterator::LEAVES_ONLY
                        );
                    //foreach (glob($dirr) as $file) { 
                    foreach($files as $file) {
                        //$filePath = $file->getRealPath();
                        //$zip->addFile($filePath);                    
                        $zip->addFile($file);    
                    }
                }
                //echo 'The zip archive contains ',$zip->numFiles,' files with a status of ',$zip->status;

                $zip->close();

//                return $destination;
                $ret = $this->InsertBackup($aPost, $destination);
                return $ret;
        }
        else
        {
                return false;
        }
    }
    
    public function restore_backup($backup_id) {
         try {
            $backup = $this->get_file($backup_id);
            $zip = new ZipArchive;
            $res = $zip->open($backup);
            if ($res === TRUE) {                
                $dirsA = $this->get_dirs($backup_id);
                $dirs = explode(';',$dirsA);
                foreach($dirs as $dir) {
                    $dirr = $dir."/";  
                    $dirrr = $dirr;
                        $files = new RecursiveIteratorIterator(
                            new RecursiveDirectoryIterator($dirrr),
                            RecursiveIteratorIterator::LEAVES_ONLY
                        );
                    //foreach (glob($dirr) as $file) { 
                    exec('rd /s /q "'.$dirr.'"'); //winda lokalnie
                    //exec('rm -rf "'.$dirr.'"'); // linuch               
                }
                // extract it to the path we determined above
                $zip->extractTo('./');
                $zip->close();
                $this->set_restored($backup_id);
            }
              return new ErrorReporting(ErrorReporting::SUCCESS, true, Kohana::lang('backup.success_restore'));
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('backup.error_restore'));
        }
    }
    
    public function get_file($backup_id) {
        $backup_id = intval($backup_id);
        try {
            $this->db->from(table::BACKUPS)                    
                    ->where('backup_id', $backup_id);
            $result = $this->db->get();
                        

            return $result[0]->file;
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return false;
        }
    }
    
    public function get_dirs($backup_id) {
        $backup_id = intval($backup_id);
        try {
            $this->db->from(table::BACKUPS)                    
                    ->where('backup_id', $backup_id);
            $result = $this->db->get();
                        

            return $result[0]->dirs;
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return false;
        }
    }
    
    public function set_restored($backup_id) {
        $backup_id = intval($backup_id);
        try {
            $re = $this->db->update(table::BACKUPS, array('state' => 0), array('state' => 1));
            var_dump($re);
            $this->db->update(table::BACKUPS, array('state' => 1), array('backup_id' => $backup_id));

            return true;
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return false;
        }
    }

    public function InsertBackup($aPost, $back) {
        try {
            $this->db->query('SET AUTOCOMMIT = 0');
            $this->db->query('BEGIN');

            $table_backup['name'] = $aPost['name'];
            $table_backup['description'] = $aPost['description'];
            $table_backup['state'] = 0;
            $table_backup['backup_date'] = date('Y-m-d H:i:s');
            $table_backup['file'] = $back;
            $table_backup['dirs'] = $aPost['dirs'];
            $insert = $this->db->insert(table::BACKUPS, $table_backup);
            $this->db->query('COMMIT');
            return new ErrorReporting(ErrorReporting::SUCCESS, $back, Kohana::lang('backup.success_insert_backup'));
        } catch (Exception $ex) {
            $this->db->query('ROLLBACK');
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('backup.error_insert_backup'));
        }
    }

    private function _GetBoxesElementId($boxes_id) {
        try {
            $boxes_id+=0;
            $result = $this->db->from(table::BOXES_SET)->where(array('id_boxes_set' => $boxes_id))->get();
            return new ErrorReporting(ErrorReporting::ERROR, $result[0]->element_id, '');
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('gallery.error_exist_gallery'));
        }
    }

}

?>