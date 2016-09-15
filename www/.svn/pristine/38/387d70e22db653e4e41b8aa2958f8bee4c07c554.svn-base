<?php
class file {
    const PUBLIC_DIR = 'files/public/';

    public static function upload($file, $args) {
        $image_name = '';
        $arr = array();
        try {
            $mimeTypes = array('image/gif', 'image/jpeg', 'image/png', 'image/pjpeg', 'image/x-png', 'image/bmp');
            $imgWidth = empty($args['width']) ? '' : $args['width'];
            $imgHeight = empty($args['height']) ? '' : $args['height'];
            $thumbWidth = empty($args['thumbwidth']) ? 128 : $args['thumbwidth'];
            $thumbHeight = empty($args['thumbheight']) ? 88 : $args['thumbheight'];
            $xthumbWidth = empty($args['xthumbwidth']) ? 128 : $args['xthumbwidth'];
            $xthumbHeight = empty($args['xthumbheight']) ? 88 : $args['xthumbheight'];
            $mediumWidth = empty($args['mediumwidth']) ? '' : $args['mediumwidth'];
            $mediumHeight = empty($args['mediumheight']) ? '' : $args['mediumheight'];
            $xmediumWidth = empty($args['xmediumwidth']) ? '' : $args['xmediumwidth'];
            $xmediumHeight = empty($args['xmediumheight']) ? '' : $args['xmediumheight'];
            $xxmediumWidth = empty($args['xxmediumwidth']) ? '' : $args['xxmediumwidth'];
            $xxmediumHeight = empty($args['xxmediumheight']) ? '' : $args['xxmediumheight'];

            $path = '';
            if(!empty($args['path'])) {
                $path = $args['path'];
            }
            $xmediumpath = '';
            if(!empty($args['xmediumpath'])) {
                $xmediumpath = $args['xmediumpath'];
            }
            $xxmediumpath = '';
            if(!empty($args['xxmediumpath'])) {
                $xxmediumpath = $args['xxmediumpath'];
            }
            $mediumpath = '';
            if(!empty($args['mediumpath'])) {
                $mediumpath = $args['mediumpath'];
            }
            $xthumbpath = '';
            if(!empty($args['xthumbpath'])) {
                $xthumbpath = $args['xthumbpath'];
            }
            $thumbpath = '';
            if(empty($args['thumbpath'])) {
                throw new Exception(Kohana::lang('helpers.thumbpath_is_required'));
            }
            $thumbpath = $args['thumbpath'];

            $filesTmp = array();
            $files = $filesTmp;
            if(!empty($file['tmp_name']) && is_uploaded_file($file['tmp_name']) && $file['size'] > 0 && $file['error'] == 0) {
                if($file['name'] != '' && in_array($file['type'], $mimeTypes)) {
                    $image_name = $file['name'];

                    if(!empty($args['unique']) && $args['unique'] === true) {
                        $ext = mb_strtolower(substr($file['name'], strrpos($file['name'], '.')+1));
                        $image_name = str_replace('.', '', time().uniqid(1,1));
                        $image_name .= ('.'.$ext);
                    }
                    $image = new Image($file['tmp_name']);

                    //$image->save($path.$image_name);

                    //if($image->width >= $image->height) {
                    //$image->resize(400, 120, Image::AUTO)->crop(180, 180)->save($thumbpath.$image_name);

                    //tylko jesli obrazek jest wiekszy to go resizujemy
                    if(!empty($imgHeight) && !empty($imgWidth) && !empty($path)) {
                        if($image->width<=$imgWidth && $image->height<=$imgHeight) {
                            //$image->watermark(new Image('img/amplant-watermark.png'));
                            $image->save($path.$image_name);
                        } else {
                            $image->resize($imgWidth, $imgHeight, Image::AUTO);
                            //$image->watermark(new Image('img/amplant-watermark.png'));
                            $image->save($path.$image_name);
                        }
                    }

                    elseif(!empty($path)) {
                        $image->save($path.$image_name);
                    }

                    if(!empty($mediumHeight) && !empty($mediumWidth) && !empty($mediumpath)) {
                        if($image->width<=$mediumWidth && $image->height<=$mediumHeight) {
                            $image->save($mediumpath.$image_name);
                        }
                        else {
                            $image->resize($mediumWidth, $mediumHeight, Image::AUTO)->save($mediumpath.$image_name);
                        }
                    }

                    if(!empty($xmediumHeight) && !empty($xmediumWidth) && !empty($xmediumpath)) {
                        if($image->width<=$xmediumWidth && $image->height<=$xmediumHeight) {
                            $image->save($xmediumpath.$image_name);
                        }
                        else {
                            $image->resize($xmediumWidth, $xmediumHeight, Image::AUTO)->save($xmediumpath.$image_name);
                        }
                    }
                    if(!empty($xxmediumHeight) && !empty($xxmediumWidth) && !empty($xxmediumpath)) {
                        if($image->width<=$xxmediumWidth && $image->height<=$xxmediumHeight) {
                            $image->save($xxmediumpath.$image_name);
                        }
                        else {
                            $image->resize($xxmediumWidth, $xxmediumHeight, Image::AUTO)->save($xxmediumpath.$image_name);
                        }
                    }

                    if($image->width<=$thumbWidth && $image->height<=$thumbHeight) {
                        $image->save($thumbpath.$image_name);
                    } else {
                        $image->resize($thumbWidth, $thumbHeight, Image::AUTO)->save($thumbpath.$image_name);
                    }

                    if(!empty($xthumbHeight) && !empty($xthumbWidth) && !empty($xthumbpath)) {
                        if($image->width<=$xthumbWidth && $image->height<=$xthumbHeight) {
                            $image->save($xthumbpath.$image_name);
                        }
                        else {
                            $image->resize($xthumbWidth, $xthumbHeight, Image::AUTO)->save($xthumbpath.$image_name);
                        }
                    }


                    $arr['filename'] = $image_name;
                    $arr['realfilename'] = $file['name'];
                } else {
                    throw new Exception('Błędna nazwa pliku, błąd przesyłania '.$file['error'].', rozmiar pliku równy 0 lub nie rozpoznawalny format pliku.<br />');
                }
            } else {
                throw new Exception('Nieprawidłowa nazwa pliku tymczasowego lub nie można wgrać pliku na serwer.<br />');
            }
            return new ErrorReporting(ErrorReporting::SUCCESS, $arr, $image_name);
        } catch(Exception $ex) {
            Kohana::log('error', __FILE__.':'.__LINE__.':'.$ex->getMessage());
            //throw new Exception(Kohana::lang('helpers.error'));
            //return new ErrorReporting(ErrorReporting::ERROR, false, $ex->getMessage());
        }
    }
}
