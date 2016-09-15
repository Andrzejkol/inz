<?php

defined('SYSPATH') OR die('No direct access allowed.');

class Admin_Customers_Controller extends Admin_Shop_Controller {

    protected $_oCustomer;

    // Do not allow to run in production
    const ALLOW_PRODUCTION = TRUE;

    public function __construct() {
        parent::__construct();
        $this->_oCustomer = new Customer_Model();
    }

    public function index() {
        $this->authorize('customers', 'index');
        $this->_oTemplate->content->main_content = new View('admin/customers_index');
        $pagination = layer::GetPagination($this->_oCustomer->Count()->Value, '', 50);
        $this->_oTemplate->content->main_content->pagination = $pagination;
        $this->_oTemplate->content->main_content->oCustomers = $this->_oCustomer->FindAll(50, $pagination->sql_offset)->Value;
        $this->_oTemplate->title = Kohana::lang('customer.titles.customers_index');
        $this->_oTemplate->render(true);
    }

    /**
     *
     * @param integer $iCustomerId
     */
    public function delete($iCustomerId = null) {
        $this->authorize('customers', 'delete');
        if (!empty($_POST['customer_check'])) {
            $result = $this->_oCustomer->DeleteCustomerArray($_POST['customer_check']);
            $this->_oSession->set('message', $result->__toString());
        }
        if (!empty($iCustomerId)) {
            $result = $this->_oCustomer->DeleteCustomer($iCustomerId);
            $this->_oSession->set('message', $result->__toString());
        }
        url::redirect('4dminix/klienci');
    }

    /**
     *
     * @param integer $iCustomerId
     */
    public function edit($iCustomerId) {
        $this->authorize('customers', 'edit');
        $iCustomerId += 0;
        if (!empty($_POST)) {
            $valid = $this->_oCustomer->ValidateUpdateCustomer($iCustomerId, $_POST);
            if ($valid->Value === true) {
                $result = $this->_oCustomer->UpdateCustomer($iCustomerId, $_POST);
                $this->_oSession->set('message', $result->__toString());
                switch ($result->Type) {
                    case ErrorReporting::ERROR:
                    case ErrorReporting::WARNING:
                        url::redirect('4dminix/edytuj_klienta/' . $iCustomerId);
                        break;
                    default:
                        url::redirect('4dminix/klienci');
                }
            } else {
                $this->_oTemplate->content->msg = $valid->__toString();
            }
        }
        $this->_oTemplate->content->main_content = new View('admin/customer_edit');
        $this->_oTemplate->content->main_content->oCustomerDetails = $this->_oCustomer->FindCustomer(array('id_customer' => $iCustomerId))->Value[0];
        $this->_oTemplate->title = Kohana::lang('customer.titles.edit_customer');
        $this->_oTemplate->render(true);
    }

    /**
     *
     */
    public function add() {
        $this->authorize('customers', 'add');
        if (!empty($_POST)) {
            if ($this->_oCustomer->ValidateInsert($_POST, $_FILES)->Value === true) {
                $result = $this->_oCustomer->Insert($_POST, $_FILES);
                $this->_oSession->set('message', $result->__toString());
                switch ($result->Type) {
                    case ErrorReporting::ERROR:
                    case ErrorReporting::WARNING:
                        url::redirect('4dminix/dodaj_klienta');
                        break;
                    default:
                        url::redirect('4dminix/klienci');
                        break;
                }
            }
        }
        $this->_oTemplate->content->main_content = new View('admin_producer_add');
        $this->_oTemplate->title = Kohana::lang('producer.add_producer');
        $this->_oTemplate->render(true);
    }

    public function ajax_customer_search() {
        $_POST = layer::Clean($_POST);
        $this->template = new View('admin/customers_index');
        $this->template->oCustomers = $this->_oCustomer->FindAll(false, false, false, array('customer_last_name' => $_POST['last_name']))->Value;
        echo $this->template->render(true);
    }
	
	public function verify($iCustomerId) {
        $this->authorize('customers', 'edit');
        $iCustomerId += 0;

        $result = $this->_oCustomer->SendVerificationMail($iCustomerId);
        $this->_oSession->set('message', $result->__toString());
        url::redirect('4dminix/klienci');
    }

}
