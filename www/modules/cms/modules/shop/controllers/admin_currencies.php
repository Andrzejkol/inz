<?php

defined('SYSPATH') OR die('No direct access allowed.');

class Admin_Currencies_Controller extends Admin_Shop_Controller {

    // Do not allow to run in production
    const ALLOW_PRODUCTION = TRUE;

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->authorize('currencies', 'index');
        $this->_oTemplate->content->main_content = new View('admin/currencies_index');
        $this->_oTemplate->content->main_content->oCurrencies = $this->_oCurrencies->FindAll()->Value;
        $this->_oTemplate->title = Kohana::lang('shop_admin.currencies.index_title');
        $this->_oTemplate->render(true);
    }

    public function add() {
        $this->authorize('currencies', 'add');
        $this->_oTemplate->content->main_content = new View('admin/currencies_add');
        if (!empty($_POST)) {
            $validate = $this->_oCurrencies->ValidateInsert($_POST);
            if ($validate->Value === true) {
                $result = $this->_oCurrencies->Insert($_POST);
                $this->_oSession->set('message', $result->__toString());
                switch ($result->Type) {
                    case ErrorReporting::ERROR:
                    case ErrorReporting::WARNING:
                        url::redirect('4dminix/dodaj_walute');
                        break;
                    default:
                        url::redirect('4dminix/waluty');
                        break;
                }
            } else {
                $this->_oTemplate->content->main_content->msg = $validate->__toString();
            }
        }
        $this->_oTemplate->title = Kohana::lang('shop_admin.currencies.add_currency');
        $this->_oTemplate->render(true);
    }

    public function edit($id) {
        $this->authorize('currencies', 'edit');
        $id += 0;
        if (!empty($_POST)) {
            $validate = $this->_oCurrencies->ValidateInsert($_POST);
            if ($validate->Value === true) {
                $result = $this->_oCurrencies->Update($id, $_POST);
                $this->_oSession->set('message', $result->__toString());
                switch ($result->Type) {
                    case ErrorReporting::ERROR:
                    case ErrorReporting::WARNING:
                        url::redirect('4dminix/edytuj_walute/' . $id);
                        break;
                    default:
                        url::redirect('4dminix/waluty');
                }
            }
        }

        $this->_oTemplate->content->main_content = new View('admin/currencies_edit');
        $this->_oTemplate->content->main_content->oCurrencyDetails = $this->_oCurrencies->Find($id)->Value;
        $this->_oTemplate->title = Kohana::lang('shop_admin.currencies.edit_currency');
        $this->_oTemplate->render(true);
    }

    /**
     *
     * @param integer $id
     */
    public function delete($id) {
        $this->authorize('currencies', 'delete');

        $result = $this->_oCurrencies->Delete($id);
        $this->_oSession->set('message', $result->__toString());
        url::redirect('4dminix/waluty');
    }

    public function change_status() {
        if (!isset($_GET['id_currency'])) {
            return;
        }
        $id_currency = intval($_GET['id_currency']);
        $db = new Database();
        $result = $db->select('currency_active')
                ->from(table::SHOP_CURRENCIES)
                ->where('id_currency', $id_currency)
                ->get();
        if (isset($result[0])) {
            if ($result[0]->currency_active == 'Y') {
                $status = 'N';
            } else {
                $status = 'Y';
            }
            $db->update(table::SHOP_CURRENCIES, array('currency_active' => $status), array('id_currency' => $id_currency));
            echo $status;
            return;
        } else {
            return;
        }
    }

}
