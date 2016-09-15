<?php defined('SYSPATH') OR die('No direct access allowed.');
class Media_Model extends Model_Core {

    private $path;
    private $thumbpath;

    /**
     *
     * @return unknown_type
     */
    public function __construct() {
        parent::__construct();
        $this->db = Database::instance();
        $this->path = news_helper::BIG_PATH;
        $this->thumbpath = news_helper::SMALL_PATH;
    }


    public function GetAllMedia($limit = null, $offset = null) {
        try {
		$medias_orderby = 'id_media';
		$kind = 'ASC';
		if(!empty($_GET['medias_orderby']) && $_GET['medias_orderby']==1 ) {$medias_orderby='id_media'; $kind='ASC';}
		else if(!empty($_GET['medias_orderby']) && $_GET['medias_orderby']==2 ) {$medias_orderby='id_media'; $kind='DESC';}
		
		else if(!empty($_GET['medias_orderby']) && $_GET['medias_orderby']==3 ) {$medias_orderby='mime_type_id'; $kind='ASC';}
		else if(!empty($_GET['medias_orderby']) && $_GET['medias_orderby']==4 ) {$medias_orderby='mime_type_id'; $kind='DESC';}
		
		else if(!empty($_GET['medias_orderby']) && $_GET['medias_orderby']==3 ) {$medias_orderby='type'; $kind='ASC';}
		else if(!empty($_GET['medias_orderby']) && $_GET['medias_orderby']==4 ) {$medias_orderby='type'; $kind='DESC';}
		
            $result = $this->db->from(table::MEDIAS);
            if(isset($limit) && isset($offset)){
                $result = $result
						->orderby($medias_orderby, $kind)
                        ->join(table::MEDIAS_MIME_TYPES, table::MEDIAS_MIME_TYPES.'.id_mime_type', table::MEDIAS.'.mime_type_id', 'LEFT')
                        ->limit($limit, $offset);
            }
            
            $result = $result
                    //->join(table::MEDIAS_MIME_TYPES, table::MEDIAS_MIME_TYPES.'.id_mime_type', table::MEDIAS.'.mime_type_id', 'LEFT')
                    ->get();

            return new ErrorReporting(ErrorReporting::SUCCESS, $result, Kohana::lang('media.success_GetAllMedia'));
        }
        catch(Exception $ex) {
            //var_dump($ex->getMessage());
            Kohana::log('error', __FILE__.__LINE__.$ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('media.error_GetAllMedia'));
        }
    }
    public function AddMedia($_FILES) {
        try {
            $mime_type = ($_FILES['media']['type']);
            $iLastDot = strrpos($_FILES['media']['name'], '.');
            $sFileNameTemp = substr($_FILES['media']['name'], 0, $iLastDot);
            $iLangth = mb_strlen($_FILES['media']['name']);
            $sExt = substr($_FILES['media']['name'], $iLastDot, $iLangth);
            $file_name = string::prepareURL($sFileNameTemp).$sExt;			

            $result = $this->db->from(table::MEDIAS_MIME_TYPES)
                    ->where(array('mime_type'=>$mime_type))
                    ->get();

            if(!empty($result[0]->mime_type)) {
                $media = array();
                $media['mime_type_id'] = $result[0]->id_mime_type;
                $media['file_name'] = ''; // $file_name;

                $insert = $this->db->insert(table::MEDIAS, $media);
                $iInsertId = $insert->insert_id();
                $file_name = $iInsertId . '-' . $file_name;
                $this->db->from(table::MEDIAS)->set(array('file_name' => $file_name))->where(array('id_media' => $iInsertId))->update();
                
                
            }
            else {

                $query = $this->db->insert(table::MEDIAS_MIME_TYPES, array('mime_type' => $mime_type, 'type' => 'others'));

                $this->db->insert(table::MEDIAS, array('file_name' => $file_name, 'mime_type_id' => $query->insert_id()));

            }
            
            if($mime_type == 'image/jpeg' || $mime_type == 'image/png' || $mime_type == 'image/gif') {

                $big_path = media_helper::IMAGE_BIG_PATH.$file_name;
                $medium_path = media_helper::IMAGE_MEDIUM_PATH.$file_name;
                $small_path = media_helper::IMAGE_SMALL_PATH.$file_name;

                $img = upload::save('media', $file_name, media_helper::IMAGE_ORGINAL_PATH);

                $image = new Image($img);

                if($image->width <= media_helper::IMAGE_BIG_WIDTH && $image->height <= media_helper::IMAGE_BIG_HEIGHT) {
                    $image->save($big_path);
                }
                else {
                    $image->resize(media_helper::IMAGE_BIG_WIDTH, media_helper::IMAGE_BIG_HEIGHT, Image::AUTO)
                            ->save($big_path);
                }

                if($image->width <= media_helper::IMAGE_MEDIUM_WIDTH && $image->height <= media_helper::IMAGE_MEDIUM_HEIGHT) {
                    $image->save($medium_path);
                }
                else {
                    $image->resize(media_helper::IMAGE_MEDIUM_WIDTH, media_helper::IMAGE_MEDIUM_HEIGHT, Image::AUTO)
                            ->save($medium_path);
                }

                if($image->width <= media_helper::IMAGE_SMALL_WIDTH && $image->height <= media_helper::IMAGE_SMALL_HEIGHT) {
                    $image->save($small_path);
                }
                else {
                    $image->resize(media_helper::IMAGE_SMALL_WIDTH, media_helper::IMAGE_SMALL_HEIGHT, Image::AUTO)
                            ->save($small_path);
                }

            }

//            else if($mime_type == 'application/x-zip' || $mime_type == 'application/zip' || $mime_type == 'application/x-zip-compressed' || $mime_type ==  'application/rar' || $mime_type == 'application/x-7z-compressed') {
//                $archive = upload::save('media', $file_name, media_helper::ARCHIVES_PATH);
//            }

            else {
                $others = upload::save('media', $file_name, media_helper::OTHERS_PATH);
            }



            return new ErrorReporting(ErrorReporting::SUCCESS, true, Kohana::lang('media.success_insert_media'));

        } catch(Exception $ex) {
            $this->db->query('ROLLBACK');
            Kohana::log('error', __FILE__.__LINE__.$ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('media.error_insert_media')." - ".$ex);
        }
    }


    public function DeleteMedia($IdMedia) {
        try {
            $results = $this->db->from(table::MEDIAS)
                    ->join(table::MEDIAS_MIME_TYPES, table::MEDIAS_MIME_TYPES.'.id_mime_type', table::MEDIAS.'.mime_type_id')
                    ->where(array('id_media' => $IdMedia))
                    ->get();

            $file_name = $results[0]->file_name;
            $type = $results[0]->type;

//            var_dump($type);
//            exit();
            if($type == 'images') {

                if(file_exists(media_helper::IMAGE_ORGINAL_PATH.$file_name)) {
                    unlink(media_helper::IMAGE_ORGINAL_PATH.$file_name);
                }
                if(file_exists(media_helper::IMAGE_BIG_PATH.$file_name)) {
                    unlink(media_helper::IMAGE_BIG_PATH.$file_name);
                }
                if(file_exists(media_helper::IMAGE_MEDIUM_PATH.$file_name)) {
                    unlink(media_helper::IMAGE_MEDIUM_PATH.$file_name);
                }
                if(file_exists(media_helper::IMAGE_SMALL_PATH.$file_name)) {
                    unlink(media_helper::IMAGE_SMALL_PATH.$file_name);
                }
            }
            else {
                if(file_exists(media_helper::OTHERS_PATH.$file_name)) {
                    unlink(media_helper::OTHERS_PATH.$file_name);
                }
            }
            $this->db->delete(table::MEDIAS, array('id_media'=>$IdMedia));



            return new ErrorReporting(ErrorReporting::SUCCESS, true, Kohana::lang('media.success_delete_media'));

        } catch(Exception $ex) {
            $this->db->query('ROLLBACK');
            Kohana::log('error', __FILE__.__LINE__.$ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('media.error_delete_media'));
        }
    }

    public function ValidateMedia($file) {
        if(empty($file['tmp_name'])) {
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('media.error_file_empty'));
        }
        else {
            return new ErrorReporting(ErrorReporting::SUCCESS, true, '');
        }
    }




}
