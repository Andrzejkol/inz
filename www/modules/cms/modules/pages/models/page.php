<?php

defined('SYSPATH') OR die('No direct access allowed.');

class Page_Model extends Model_Core {

    private $thumbpath;
    private $path;
    private $thumbwidth;
    private $thumbheight;
    private $page_content_thumbpath;
    private $page_content_thumbwidth;
    private $page_content_thumbheight;
    private $page_contents = array();

    /**
     *
     */
    public function __construct() {
        parent::__construct();
        $this->db = Database::instance();
        $this->language = new Language_Model();
        $this->page_content = new Page_content_Model();
        $this->contact_form = new Contact_Form_Model();
        $this->news = new News_Model();
        $this->gallery = new Gallery_Model();
        $this->boxes = new Boxes_Model();
        $this->thumbpath = pages_helper::SMALL_PATH;
        $this->path = pages_helper::BIG_PATH;
        $this->thumbwidth = pages_helper::THUMBWIDTH;
        $this->thumbheight = pages_helper::THUMBHEIGHT;
        $this->page_content_thumbpath = page_content_helper::SMALL_PATH;
        $this->page_content_thumbwidth = page_content_helper::THUMBWIDTH;
        $this->page_content_thumbheight = page_content_helper::THUMBHEIGHT;

        if (config::CheckIfModuleEnabled('shop') === TRUE) {
            $this->product_category = new Product_Category_Model();
        }
    }

    /**
     * Dodawanie nowej strony.
     * @param Array $data
     * @return ErrorReporting (Bool true || Bool false)
     */
    public function InsertPage(Array $data, Array $files) {
        try {
            $this->db->query('SET AUTOCOMMIT = 0');
            $this->db->query('BEGIN');
            $aElements = $data;
            unset($data['back'], $data['add_pages'], $data['page_content'], $data['news'], $data['gallery'], $data['submit'], $data['submit_back']);

            $data['date_added'] = time();
            $data['modified_date'] = '';

            // url  dla strony
            if (!empty($data['url'])) {
                $data['url'] = string::prepareURL($data['url']);
            } else {
                $data['url'] = string::prepareURL($data['name_page']);
            }

            // sprawdzamy czy url istnieje
            if ($this->_URLExist($data['url'])->Value === true) {
                // pobieramy increment
                $query = "SHOW TABLE STATUS LIKE '" . table::PAGES . "' ";
                $oTableData = $this->db->query($query);
                $iNextId = $oTableData[0]->Auto_increment;
                $data['url'] = $data['url'] . '-' . $iNextId; // dodajemy go do urla
            }

            //ustawiamy stronę główną
            $ret = $this->db->from(table::PAGES)->where(array('lang' => $data['lang'], 'homepage' => 1))->get();
            if (empty($ret) || $ret->count() <= 0) {
                $data['homepage'] = 1;
            }

            $aUploadedFile = array();
            if (!empty($files) && is_array($files) && !empty($files['image']['tmp_name'])) {
                $aUploadArgs = array(
                    'path' => pages_helper::TOP_PATH,
                    'thumbpath' => pages_helper::THUMB_PATH,
                    'width' => pages_helper::TOPWIDTH,
                    'height' => pages_helper::TOPHEIGHT,
                    'thumbwidth' => pages_helper::THUMBWIDTH,
                    'thumbheight' => pages_helper::THUMBHEIGHT
                );
                $aUploadedFile = file::upload($files['image'], $aUploadArgs);
                $data['filename'] = $aUploadedFile->Value['filename'];
            }


            $pageInsert = $this->db->insert(table::PAGES, $data);

            // jesli wybrano jakies elementy:
            if (!empty($aElements['page_content']) && $aElements['page_content'] == 'Y') { // dodajemy zawartosc strony
                $aPageContent['title'] = $aElements['name_page'];
                $aPageContent['content'] = '';
                $aPageContent['lang'] = $aElements['lang'];
                $aPageContent['page_id'] = $pageInsert->insert_id();

                $this->page_content->Insert($aPageContent);
            }
            if (!empty($aElements['news']) && $aElements['news'] == 'Y') { // dodajemy kategorie newsow
                $aNews['title'] = $aElements['name_page'];
                $aNews['lang'] = $aElements['lang'];
                $aNews['page_id'] = $pageInsert->insert_id();

                $this->news->InsertNewsCategory($aNews);
            }
            if (!empty($aElements['gallery']) && $aElements['gallery'] == 'Y') { // dodajemy galerie
                $aGallery['name'] = $aElements['name_page'];
                $aGallery['lang'] = $aElements['lang'];
                $aGallery['page_id'] = $pageInsert->insert_id();
                $aGallery['description'] = '';

                $this->gallery->InsertGallery($aGallery);
            }





            $this->db->query('COMMIT');
            return new ErrorReporting(ErrorReporting::SUCCESS, $pageInsert->insert_id(), Kohana::lang('pages.success_insert_pages'));
        } catch (Exception $ex) {
            $this->db->query('ROLLBACK');
            Kohana::log('error', __FILE__ . ':' . __LINE__ . ':' . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('pages.error_insert_pages'));
        }
    }

    /**
     * Zapisanie zmian po edycji strony.
     * @param Integer $iPageId
     * @param Array $aData
     * @return ErrorReporting (Bool true || Bool false)
     */
    public function UpdatePage($iPageId, Array $aData, Array $aFiles) {
        try {
            $iPageId+=0;
            $this->db->query('SET AUTOCOMMIT = 0');
            $this->db->query('BEGIN');

            unset($aData['back'], $aData['save_changes'], $aData['submit'], $aData['submit_back'], $aData['type_name']);

            $aData['modified_date'] = time();
            if ($aData['page_type'] != 'link') { // jesli to ma byc strona z linkiem na zewnatrz to nie usuwamy z niej /
                // url  dla strony
                if (!empty($aData['url'])) {
                    $aData['url'] = string::prepareURL($aData['url']);
                } else {
                    $aData['url'] = string::prepareURL($aData['name_page']);
                }
            }
            $aData['show_in_menu'] = (isset($aData['show_in_menu']) ? $aData['show_in_menu'] : 1);
            $aData['menu_link_off'] = (!empty($aData['menu_link_off']) ? $aData['menu_link_off'] : 0);
            $aData['page_type'] = (!empty($aData['page_type']) ? $aData['page_type'] : 'cms');

            // sprawdzamy czy url istnieje
            if ($this->_URLExist($aData['url'], $iPageId)->Value === true) {
                // tworzymi unikalny url
                $aData['url'] = $aData['url'] . '-' . $iPageId;
            }
            if (!empty($aData['homepage']) && $aData['homepage'] == 1) {
                $this->db->update(table::PAGES, array('homepage' => 0), array('lang' => $aData['lang']));
            }

            $aUploadedFile = array();
            if (!empty($aFiles) && is_array($aFiles) && !empty($aFiles['image']['tmp_name'])) {
                $aUploadArgs = array(
                    'path' => pages_helper::TOP_PATH,
                    'thumbpath' => pages_helper::THUMB_PATH,
                    'width' => pages_helper::TOPWIDTH,
                    'height' => pages_helper::TOPHEIGHT,
                    'thumbwidth' => pages_helper::THUMBWIDTH,
                    'thumbheight' => pages_helper::THUMBHEIGHT
                );
                $aUploadedFile = file::upload($aFiles['image'], $aUploadArgs);
                $aData['filename'] = $aUploadedFile->Value['filename'];
            }

            // update wiadomosci
            $result2 = $this->db->update(table::PAGES, $aData, array('id_page' => $iPageId));

            $this->db->query('COMMIT');
            return new ErrorReporting(ErrorReporting::SUCCESS, true, Kohana::lang('pages.success_update_pages'));
        } catch (Exception $ex) {
            $this->db->query('ROLLBACK');
            Kohana::log('error', __FILE__ . ':' . __LINE__ . ':' . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('pages.error_update_pages'));
        }
    }

    /**
     * Usuwanie stron przez checkboxy na liscie stron.
     * @param Array $aPages
     * @return ErrorReporting (Bool true || Bool false)
     */
    public function DeletePagesArray($aPages) {
        try {
            foreach ($aPages as $aPage) {
                $this->DeletePage($aPage);
            }
            return new ErrorReporting(ErrorReporting::SUCCESS, true, Kohana::lang('pages.success_delete_pages'));
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('pages.error_delete_pages'));
        }
    }

    /**
     * Usuwa stronę.
     * @param Integer $iPageId
     * @return ErrorReporting (Bool true || Bool false)
     */
    public function DeletePage($iPageId) {
        try {
            $iPageId += 0;
            $this->db->update(table::PAGES, array('parent_id' => 0), array('parent_id' => $iPageId));
            $this->db->delete(table::PAGES, array('id_page' => $iPageId));

            $pages_elements = $this->db->from(table::PAGES_ELEMENTS)->where('page_id', $iPageId)->get();
            foreach ($pages_elements as $el) {

                // liczba danego elementu na wszystkich stronach
                $elements = $this->db->select('pe.*, e.type')
                                ->from(table::PAGES_ELEMENTS . ' as pe')
                                ->join(table::ELEMENTS . ' as e', 'e.id_element', 'pe.element_id')
                                ->where('element_id', $el->element_id)->get();

                // usuń z tabeli pośredniej
                $this->db->delete(table::PAGES_ELEMENTS, array('page_id' => $iPageId));

                if ($elements->count() == 1) { // element jest tylko na jednej stronie
                    // usuń element:
                    switch ($elements[0]->type) {
                        case 'page_content':
                            $pageContent = new Page_content_Model();
                            $pageContent->Delete($el->element_id);
                            break;

                        case 'news':
                            $news = new News_Model();
                            $news->DeleteNewsByElementId($el->element_id);
                            break;

                        case 'galleries':
                            $gallery = new Gallery_Model();
                            $gallery->DeleteGalleryByElementId($el->element_id);
                            break;

                        case 'contact_form':
                            $contact_form = new Contact_Form_Model();
                            $contact_form->DeleteContactFormByElementId($el->element_id);
                            break;

                        case 'polls':
                            $poll = new Poll_Model();
                            $poll->DeletePollByElementId($el->element_id);
                            break;
                    }
                }
            }



            return new ErrorReporting(ErrorReporting::SUCCESS, true, Kohana::lang('pages.success_delete_pages'));
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . ':' . __LINE__ . ':' . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('pages.error_delete_pages'));
        }
    }

    /**
     * Pobiera dane dla strony
     * @param Integer $iPageId
     * @return ErrorReporting (MySQL Object $results || Bool false)
     */
    public function GetPage($iPageId) {
        try {

            $result = $this->db->from(table::PAGES)->where(array('id_page' => $iPageId))->get();



            return new ErrorReporting(ErrorReporting::SUCCESS, $result, Kohana::lang('pages.success_get_page'));
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . ':' . __LINE__ . ':' . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('pages.error_get_page'));
        }
    }

    private function _URLExist($sUrl, $iPageId = null) {
        try {
            if (!empty($iPageId)) {
                $iPageId+=0;
                $oCountURL = $this->db->from(table::PAGES)->where(array('url' => $sUrl, 'id_page!=' => $iPageId))->select('COUNT(*) AS count')->get();
                if (!empty($oCountURL) && $oCountURL[0]->count > 0) {
                    return new ErrorReporting(ErrorReporting::SUCCESS, true);
                } else {
                    return new ErrorReporting(ErrorReporting::SUCCESS, false);
                }
            } else {
                $oCountURL = $this->db->from(table::PAGES)->where(array('url' => $sUrl))->select('COUNT(*) AS count')->get();
                if (!empty($oCountURL) && $oCountURL[0]->count > 0) {
                    return new ErrorReporting(ErrorReporting::SUCCESS, true);
                } else {
                    return new ErrorReporting(ErrorReporting::SUCCESS, false);
                }
            }
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . ':' . __LINE__ . ':' . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('pages.error.check_url_exist'));
        }
    }

    /**
     *  Zwraca Array z nazwami stron dla selecta (m.in. dla galerii)
     * @param Bool $bNoParent - określa czy w selekcie ma się znajdować opcja 'wybierz'
     * @param String $sLang
     * @return ErrorReporting (array dla selecta ze stronami)
     */
    public function GetPagesAsArray($bNoParent = null, $sLang = null) {
        try {
            $this->db->from(table::PAGES);

            if (!empty($sLang)) {
                $this->db->where(array('lang' => $sLang));
            }
            $results = $this->db->get();
            $pages = array();
            if (empty($bNoParent)) {
                $pages[0] = Kohana::lang('pages.check');
            }
            foreach ($results as $result) {
                $pages[$result->id_page] = $result->name_page;
            }

            return new ErrorReporting(ErrorReporting::SUCCESS, $pages, '');
        } catch (Exception $ex) {
            $this->db->query('ROLLBACK');
            Kohana::log('error', __FILE__ . ':' . __LINE__ . ':' . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('pages.error_get_pages_as_array'));
        }
    }

    /**
     *  Pobiera liste stron
     * @return ErrorReporting (mysql z danymi dla stron)
     */
    public function GetPages() {
        try {
            $results = $this->db->from(table::PAGES)
                    ->get();
            return new ErrorReporting(ErrorReporting::SUCCESS, $results, '');
        } catch (Exception $ex) {
            $this->db->query('ROLLBACK');
            Kohana::log('error', __FILE__ . ':' . __LINE__ . ':' . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('pages.error_GetPages'));
        }
    }

    /**
     * FIX: tu trzeba selecta ktory jest drzewkiem jak w kategoriach produktow
     * Pobiera strony dla selecta rodziców wybranej strony
     * @param Integer $iPageId
     * @return ErrorReporting (Array dla selecta ze stronami w danym jezyku || Bool false)
     */
    public function GetPageParents($iPageId) {
        try {
            // pobieramy jezyk strony
            $lang = $this->db->from(table::PAGES)->select('lang')->where(array('id_page' => $iPageId))
                    ->get();

            $results = $this->db->from(table::PAGES)
                    ->where(array('lang' => $lang[0]->lang, 'id_page!=' => $iPageId))
                    ->get();
            $aPages = array();
            $aPages[0] = Kohana::lang('pages.check');
            foreach ($results as $result) {
                $aPages[$result->id_page] = $result->name_page;
            }

            return new ErrorReporting(ErrorReporting::SUCCESS, $aPages, Kohana::lang('pages.success_get_page_pagents'));
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . ':' . __LINE__ . ':' . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('pages.error_get_page_pagents'));
        }
    }

    public function GetPagesWithParent($iPageId) {
        try {
            $iPageId+=0;


            $result = $this->db->from(table::PAGES)->where(array('id_page' => $iPageId))->get();


//            $results = $this->db->from(table::PAGES)
//                    ->where(array('parent_id' => $iPageId))
//                    ->get();

            return new ErrorReporting(ErrorReporting::SUCCESS, $result, '');
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . ':' . __LINE__ . ':' . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('news.error_insert_news'));
        }
    }

    public function GetPagesName() {
        try {
            $result = $this->db->from(table::PAGES)
                    ->orderby('name_page', 'ASC')
                    ->get();
            if (empty($result)) {
                $result = array();
            }
            return new ErrorReporting(ErrorReporting::SUCCESS, $result, '');
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . ':' . __LINE__ . ':' . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('news.error_insert_news'));
        }
    }

    /**
     *  TODO: ta funkcje mozna polaczyc z funkcja GetPageParents
     * @param String $lang (język format typu pl_PL)
     * @return ErrorReporting (array dla selecta ze stronami w danym jezyku)
     */
    public function GetPagesForLang($sLang, $bNoParent = null) {
        try {
            $results = $this->db->from(table::PAGES)
                    ->where(array('lang' => $sLang))
                    ->get();

            $html = '';
            if (empty($bNoParent)) {
                $html .= '<option value="0">' . Kohana::lang('pages.check') . '</option>';
            }
            foreach ($results as $result) {
                $html .= "<option value='" . $result->id_page . "'>" . $result->name_page . "</option>";
            }

            return new ErrorReporting(ErrorReporting::ERROR, $html, '');
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . ':' . __LINE__ . ':' . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, '');
        }
    }

    // TODO: to jest z levanta - sprawdzic czy teraz jest potrzebne!
    public function GetBrandsPagesForLang($lang, $pageId = null) {
        try {
            $results = $this->db->from(table::PAGES)
                    ->where(array('lang' => $lang))
                    ->in('parent_id', array(pages_helper::BRANDS_ID_PL, pages_helper::BRANDS_ID_EN))
                    ->get();
            //$html = '<option value="0">'.Kohana::lang('pages.check').'</option>';
            $html = '';
            foreach ($results as $result) {
                $html .= '<option value="' . $result->id_page . '" ' . ((!empty($pageId) && $pageId == $result->id_page) ? 'selected="selected"' : '') . '>' . $result->name_page . '</option>';
            }

            //echo $html;
            return new ErrorReporting(ErrorReporting::ERROR, $html, '');
        } catch (Exception $ex) {
            //var_dump($ex->getMessage());
            Kohana::log('error', __FILE__ . ':' . __LINE__ . ':' . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, '');
        }
    }

    /**
     * Pobiera wszystkie strony.
     * @return ErrorReporting (MySQL Object $result || Bool false)
     */
    public function GetAllPages($iLimit = null, $iOffset = null) {
        try {
            $this->db->from(table::PAGES)
                    ->join(table::LANGUAGES, table::LANGUAGES . '.name', table::PAGES . '.lang');

            if (!empty($_GET['pages_orderby'])) {
                switch ($_GET['pages_orderby']) {
                    case 1:
                        $this->db->orderby(table::PAGES . '.name_page', 'ASC');
                        break;
                    case 2:
                        $this->db->orderby(table::PAGES . '.name_page', 'DESC');
                        break;
                    case 3:
                        $this->db->orderby(table::PAGES . '.lang', 'ASC');
                        break;
                    case 4:
                        $this->db->orderby(table::PAGES . '.lang', 'DESC');
                        break;
                    case 5:
                        $this->db->orderby(table::PAGES . '.date_added', 'ASC');
                        break;
                    case 6:
                        $this->db->orderby(table::PAGES . '.date_added', 'DESC');
                        break;
                    case 7:
                        $this->db->orderby(table::PAGES . '.modified_date', 'ASC');
                        break;
                    case 8:
                        $this->db->orderby(table::PAGES . '.modified_date', 'DESC');
                        break;
                    case 9:
                        $this->db->orderby(table::PAGES . '.available', 'ASC');
                        break;
                    case 10:
                        $this->db->orderby(table::PAGES . '.available', 'DESC');
                        break;
                }
            } else {
                $this->db->orderby(array(table::PAGES . '.page_position' => 'DESC', 'name_page' => 'ASC'));
            }

            if (isset($iLimit) && isset($iOffset)) {
                $this->db->limit($iLimit, $iOffset);
            }

            $result = $this->db->get();

            return new ErrorReporting(ErrorReporting::SUCCESS, $result, '');
        } catch (Exception $ex) {
            //var_dump($ex->getMessage());
            Kohana::log('error', __FILE__ . ':' . __LINE__ . ':' . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('pages.error_get_all_pages'));
        }
    }

    /**
     * Do AJAXowego wyszukiwania stron po nazwie i jezyku
     * @param String $sPageName
     * @param String $sLanguage
     * @return ErrorReporting
     */
    public function GetPagesWithName($sPageName, $sLanguage = null) {
        try {
            $this->db
                    ->join(table::LANGUAGES, table::LANGUAGES . '.name', table::PAGES . '.lang')
                    ->like('name_page', $sPageName);
            if (!empty($sLanguage)) {
                $this->db->where(array('lang' => $sLanguage));
            }
            $result = $this->db->get(table::PAGES);
            return new ErrorReporting(ErrorReporting::SUCCESS, $result, '');
        } catch (Exception $ex) {
            //var_dump($ex->getMessage());
            Kohana::log('error', __FILE__ . ':' . __LINE__ . ':' . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('pages.error_insert_news'));
        }
    }

    /**
     * Walidacja dla dodawania i edycji stron - pole tytul (title) i tresc (description) nie moga byc puste
     * @param array $data
     * @return ErrorReporting
     */
    public function ValidatePages(array $aData, $iPageId = null) {
        if (empty($aData['name_page'])) {
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('pages.error_name_page_empty'));
        } else if (empty($aData['lang'])) {
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('pages.error_lang_empty'));
        } else {
            return new ErrorReporting(ErrorReporting::SUCCESS, true, '');
        }
    }

    /**
     * Sprawdza czy usuwana strona nie jest stroną główną
     * @param array $aData
     * @param type $iPageId
     * @return \ErrorReporting
     */
    public function ValidateDeletePages($aData = null, $iPageId = null) {
        if (!empty($aData['pages_check'])) {
            foreach ($aData['pages_check'] as $page) {
                $ret = $this->db->from(table::PAGES)->where(array('id_page' => $page, 'homepage' => 1))->get();
                if (!empty($ret) && $ret->count() > 0) {
                    return new ErrorReporting(ErrorReporting::ERROR, false, $page . ' ' . Kohana::lang('admin.pages.error_is_homepage'));
                }
            }
        } elseif (!empty($iPageId)) {
            $ret = $this->db->from(table::PAGES)->where(array('id_page' => $iPageId, 'homepage' => 1))->get();
            if (!empty($ret) && $ret->count() > 0) {
                return new ErrorReporting(ErrorReporting::ERROR, false, $iPageId . ' ' . Kohana::lang('admin.pages.error_is_homepage'));
            }
        }
        return new ErrorReporting(ErrorReporting::SUCCESS, true, '');
    }

    /**
     * Pobieranie całej zawartości dla treści
     * @param Integer $iPageId
     * @return ErrorReporting (MySQL Object $result || Bool false)
     */
    public function GetPageContents($iPageId) {
        try {

            if (!isset($this->page_contents['page_id'])) {
                $result = $this->db->from(table::PAGES_ELEMENTS)
                        ->join(table::ELEMENTS, table::ELEMENTS . '.id_element', table::PAGES_ELEMENTS . '.element_id')
                        ->where(array('page_id' => $iPageId))
                        ->get();

                $this->page_contents['page_id'] = $iPageId;
                $this->page_contents['oPage'] = $result;
            } else {
                $result = $this->page_contents['oPage'];
            }

            //echo $this->db->last_query();
            return new ErrorReporting(ErrorReporting::SUCCESS, $result, '');
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . ':' . __LINE__ . ':' . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('pages.error_get_page_contents'));
        }
    }

    /**
     * @todo Dodać sprawdzenie czy podany jezyk istnieje
     * Tworzenie drzewa stron. Funkcja pobiera język i dla każdego języka wykonuje metode - Pages::GetTreeAsList()
     * @param String $sLang
     * @return Array $aPages
     */
    public function GetPagesTree($sLang = null) {
        $aPages = array();
        if (empty($sLang)) {
            $languages = $this->db->from(table::LANGUAGES)->get();
            foreach ($languages as $lang) {
                $result = $this->db->from(table::PAGES)->where(array('lang' => $lang->name))->orderby(array('page_position' => pages_helper::PAGES_ORDER))->get();
                $aPages[$lang->name] = $this->GetTreeAsList(0, $result);
            }
        } else {
            $result = $this->db->from(table::PAGES)->where(array('lang' => $sLang))->orderby(array('page_position' => pages_helper::PAGES_ORDER))->get();
            $aPages[$sLang] = $this->GetTreeAsList(0, $result);
        }
        return $aPages;
    }

    /**
     * Pobieranie mata_title dla strony
     * @param int $pageId
     * @return ErrorReporting
     */
    public function GetPageTitle($pageId) {
        try {
            $result = $this->db->from(table::PAGES)->select('meta_title')->where(array('id_page' => $pageId))->get();
            return new ErrorReporting(ErrorReporting::SUCCESS, $result[0]->meta_title, '');
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . ':' . __LINE__ . ':' . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('pages.error_get_page_title'));
        }
    }

    /**
     * Tworzy htmlową listę dla podanego arraya
     * @param Integer $iParentId
     * @param Array $aIdsArray
     * @return String $html
     */
    public function GetTreeAsList($iParentId, &$aIdsArray) {
        try {
            $html = '';
            $tmpArray = array();
            foreach ($aIdsArray as $ar) {
                if ($ar->parent_id == $iParentId) {
                    $tmpArray[] = $ar;
                }
            }
            if (!empty($tmpArray)) {
                if ($iParentId > 0) {
                    $html .= '<span class="pagesParentId-' . $iParentId . '" style="margin-left:10px; color:blue; text-decoration:underline; cursor:pointer;">rozwiń</span>';
                }
                $html .= '<ul id="pagesTree-' . $iParentId . '" ' . (($iParentId > 0) ? 'style="display:none;"' : '') . '>';
                foreach ($tmpArray as $ar) {
                    $html .= '<li>' . html::anchor('4dminix/strona/' . $ar->id_page, $ar->name_page);
                    $html .= $this->GetTreeAsList($ar->id_page, $aIdsArray);
                    $html .= '</li>';
                }
                $html .= '</ul>';
            }
            return $html;
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . ':' . __LINE__ . ':' . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('pages.error_get_tree_as_list'));
        }
    }

    /**
     * Pobiera wszystkie elementy znajdujace sie na stronie (page content, galerie, aktualnosci)
     * @param Integer $iPageId
     * @return Array $views (Tablica
     */
    public function GetPageElements($iPageId) {
        $page_contents = $this->GetPageContents($iPageId)->Value;
        //Kohana::log('info', $page_contents);
        $views = array();
        foreach ($page_contents as $pc) {
            switch ($pc->type) {
                case 'page_content':
                    // chcemy pobrac tresc dla page content
                    $page_content = $this->page_content->GetPageContentByElementId($pc->id_element)->Value;
                    $views[$pc->id_element] = new stdClass();
                    $views[$pc->id_element] = $page_content;
                    break;
                case 'galleries':
                    $views[$pc->id_element] = new stdClass();
                    $views[$pc->id_element]->photos = $this->gallery->GetPhotosByElementId($pc->id_element)->Value;
                    break;
                case 'news':
                    $iPerPage = news_helper::PER_PAGE;
                    $iCount = $this->news->GetNewsForElement($pc->id_element, NULL, NULL)->Value->count();
                    $oPagination = layer::GetPagination($iCount, 'app_digg', $iPerPage);
                    $views[$pc->id_element] = new stdClass();
                    $views[$pc->id_element]->news = $this->news->GetNewsForElement($pc->id_element, $iPerPage, $oPagination->sql_offset)->Value;
                    $views[$pc->id_element]->pagination = $oPagination;
                    break;
                case 'contact_form':
                    $captcha = new Captcha();
                    //$views[$pc->id_element]->contact_form = $this->contact_form->GetContactFormByElementId($pc->id_element)->Value;
                    $oContactForm = $this->contact_form->FindByElementId($pc->id_element)->Value;
                    $views[$pc->id_element] = new stdClass();
                    $views[$pc->id_element]->contact_form = $oContactForm;
                    if (!empty($views[$pc->id_element]->contact_form) && $views[$pc->id_element]->contact_form->count() > 0) {
                        if ($iPageId == 56 || $iPageId == 67 || $iPageId == 76) {
                            $views[$pc->id_element]->contact_form->view = new View('app_reservation_form');
                        } else {
                            $views[$pc->id_element]->contact_form->view = new View('app_contact_form');
                        }
                        $views[$pc->id_element]->contact_form->view->iElementId = $pc->id_element;
                        $views[$pc->id_element]->contact_form->view->contact_form = $oContactForm;
                        $views[$pc->id_element]->contact_form->view->captcha = $captcha;
                    }
                    break;
                case 'boxes':
                    $boxes_set = $this->boxes->getBoxesSetByElement($pc->id_element)->Value;
                    $views[$pc->id_element] = new stdClass();
                    $views[$pc->id_element]->boxes = $this->boxes->get($boxes_set[0]->id_boxes_set, array('active' => 1))->Value;
                    break;
                case 'newsletter':
                    break;
            }
        }
        return $views;
    }

    /**
     * Pobiera strony do których przypisany jest element (np. galleries)
     * @param Integer $iElementId
     * @return ErrorReporting (Array $aPagesSelect || Bool false)
     */
    public function GetPagesForElementAsArray($iElementId) {
        try {
            $oPagesElements = $this->db->from(table::PAGES_ELEMENTS)->where(array('element_id' => $iElementId))->get();
            $aPagesSelect = array();
            foreach ($oPagesElements as $oPE) {
                $aPagesSelect[] = $oPE->page_id;
            }
            return new ErrorReporting(ErrorReporting::SUCCESS, $aPagesSelect, '');
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . ':' . __LINE__ . ':' . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('pages.error_get_pages_for_element_as_array'));
        }
    }

    /**
     * Zwraca liczbę aktywnych stron
     * @param int $iPageId
     * @return ErrorReporting
     */
    public static function PageIsActive($iPageId) {
        try {
            $db = new Database();
            $bActive = $db->count_records(table::PAGES, array('available' => 'Y', 'id_page' => $iPageId));
            return new ErrorReporting(ErrorReporting::SUCCESS, $bActive > 0 ? true : false);
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . ':' . __LINE__ . ':' . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('pages.error_get_pages_for_element_as_array'));
        }
    }

    /**
     * @todo Dodać sprawdzenie czy podany jezyk istnieje
     * Tworzenie drzewa stron od strony app. Funkcja pobiera język i dla każdego języka wykonuje metode - Pages::GetTreeAsList()
     * @param String $sLang
     * @return Array $aPages
     */
    public function GetPagesTreeForApp($sLang = null, $iactive = null, $menu = false) {
        $aPages = array();
        $url = '';
        $men = 0;
        if (!empty($menu) && $menu == true) {
            $men = 1;
        }
        if (empty($sLang)) {
            $languages = $this->db->from(table::LANGUAGES)->get();
            foreach ($languages as $lang) {
                $result = $this->db->from(table::PAGES)->where(array('lang' => $lang->name, 'available' => 'Y', 'show_in_menu' => $men))->orderby(array('page_position' => pages_helper::PAGES_ORDER, 'available' => 'Y'))->get();
                $aPages[$lang->name] = $this->GetTreeAsListForApp(0, $result, $url, $iactive, $sLang, true);
            }
        } else {
            $result = $this->db->from(table::PAGES)->where(array('lang' => $sLang, 'available' => 'Y', 'show_in_menu' => $men))->orderby(array('page_position' => pages_helper::PAGES_ORDER, 'available' => 'Y'))->get();
            $aPages[$sLang] = $this->GetTreeAsListForApp(0, $result, $url, $iactive, $sLang, true);
        }
        return $aPages;
    }

    /**
     * Tworzy htmlową listę dla podanego arraya, od strony app
     * @param Integer $iParentId
     * @param Array $aIdsArray
     * @return String $html
     */
    public function GetTreeAsListForApp($iParentId, &$aIdsArray, &$url, $iactive = null, $lang, $products = false) {

        try {
            $html = '';
            $tmpArray = array();
            foreach ($aIdsArray as $ar) {
                if ($ar->parent_id == $iParentId) {
                    $tmpArray[] = $ar;
                }
            }
            if (!empty($tmpArray)) {
                if ($iParentId > 0) {
                    
                }
                $html .= '<ul class="pagesTree-' . $iParentId . '">';
                foreach ($tmpArray as $ar) {
                    if ($ar->page_type != 'link') {
                        if ($ar->homepage == 1) {
                            $url .= ''; //url dla strony głównej
                        } else {
                            $url .= $ar->url . '/'; // dodajemy do adresu url danej strony
                        }
                    } else {
                        $url .= 'link/';
                    }
                    $cls = '';
                    if (!empty($iactive) && $iactive == $ar->id_page) {
                        $cls = ' class="active"';
                    }


                    //submenu z categoriami produktów
                    if ($products == true && ($ar->homepage == 0 && $ar->page_type == 'shop')) :
                        $html .= '<li' . $cls . '>' . html::anchor('#', $ar->name_page);
                        $html .= '<div class="sub-arrow"><div class="sarrow"></div><ul class="shop_sublist">' . $this->product_category->GetCategoriesTreeAppMenu($lang) . '</ul></div>';
                    elseif (isset($ar->menu_link_off) && ($ar->menu_link_off == 1)):
                        $html .= '<li' . $cls . '>' . html::anchor('#', $ar->name_page);
                    elseif ($ar->page_type == 'link'):
                        $html .= '<li' . $cls . '>' . html::anchor($ar->url, $ar->name_page, array('target' => '_blank'));
                    else:
                        $html .= '<li' . $cls . '>' . html::anchor(Kohana::lang('links.lang') . $url, $ar->name_page);
                    endif;

                    $html .= $this->GetTreeAsListForApp($ar->id_page, $aIdsArray, $url, null, $lang, false);
                    $html .= '</li>';
                }
                $html .= '</ul>';
            }
            $aUrl = explode('/', $url); // rozbijamy url
            $Count = count($aUrl) - 2; //liczymy z ilu elementów składa się adres i usuwamy jeden ostatni (2 dlatego, że w for iterujemy od 0)

            $url = ''; // czyścimy adres
            for ($i = 0; $i < $Count; $i++) { // budujemy adres
                $url .= $aUrl[$i] . '/'; // dodajemy do adresu wszystkie potrzebne składowe
            }
            return $html;
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . ':' . __LINE__ . ':' . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('pages.error_get_tree_as_list'));
        }
    }

    /**
     * Pobieranie danych potrzebnych do utworzenia breadcrumbs
     * @param Integer $iPageId
     * @param Bool $bSelect - Czy ostatnia strona jest zaznaczona
     * @param Bool $bLastLink - czy ostatnia strona jest linkiem
     * @return ErrorReporting
     */
    public function GetBreadcrumbs($iPageId, $bSelect = null) {
        try {
            $aData = array();

            $result = $this->db->from(table::PAGES)->where(array('id_page' => $iPageId))->get();



            $aData[0] = array(
                'page_name' => $result[0]->name_page,
                'page_id' => $result[0]->id_page,
                'select' => (!empty($bSelect) && $bSelect === true) ? true : false,
            );

            $this->GetParentsForPage($result[0]->parent_id, $aData);

            foreach ($aData as $key => $aD) {
                $aData[$key]['page_link'] = pages_helper::CreateAddress($aD['page_id'], true);
            }

            return new ErrorReporting(ErrorReporting::SUCCESS, array_reverse($aData));
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . ':' . __LINE__ . ':' . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('pages.error.get_breadcrumbs'));
        }
    }

    /**
     * Pobieranie gałąź stron nadrzędnych
     * @param Integer $iPageId
     * @param Array $aData - wynik
     * @return ErrorReporting
     */
    public function GetParentsForPage($iPageId, &$aData) {
        try {
            // pobieramy dane tej strony
            $result = $this->db->from(table::PAGES)->where(array('id_page' => $iPageId))->get();

            if (!empty($result) && $result->count() > 0) {
                $aData[] = array(
                    'page_name' => $result[0]->name_page,
                    'page_id' => $result[0]->id_page,
                );

                if (!empty($result[0]->parent_id) && $result[0]->parent_id > 0) {
                    $this->GetParentsForPage($result[0]->parent_id, $aData);
                }
            }

            return new ErrorReporting(ErrorReporting::SUCCESS, true);
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . ':' . __LINE__ . ':' . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('pages.error.get_parents_for_page'));
        }
    }

}

?>