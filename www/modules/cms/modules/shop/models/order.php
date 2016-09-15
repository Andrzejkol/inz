<?php

defined('SYSPATH') OR die('No direct access allowed.');

/**
 * Klasa Order_Model służąca do zarządzania zamówieniami.
 *
 * @author Filip Górczyński <filip.gorczynski@gmail.com>
 *
 */
class Order_Model extends Model_Core {

    private $_rDb = null;
    public $_iOrderId = null;
    private $_sOrderNumber = null;
    private $_sCurrentNumber = null;
    private $_iCurrentNumberYear = null;
    private $_iCurrentNumberMonth = null;
    private $_iCurrentNumberDay = null;
    private $_aCustomer = array();
    // przechowuje szczegóły dostawy - ID oraz nazwę opisową
    public $_aDelivery = array();
    // przechowuje szczegóły płatności - ID oraz nazwę opisową
    public $_aPayment = array();
    // lista zakupionych produktów
    public $_aProducts = array();
    public $_aStatus = array();
    public $_sClientsNote = '';
    private $_fAdditionalCost = 0.00;
    private $_eConfirmation = '';
    private $_sConfirmationDate = '';
    private $_ePaid = '';
    private $_eClosed = '';
    private $_sSellerNote = '';
    private $_eConfirmed;
    public $_sConfirmString;
    private $_sConfirmEmail;
    public $oConfig;
    public $eCurrency;
    public $eFactor;

    /**
     * Konstruktor obiektu klasy User_Model
     */
    public function __construct($iOrderId = null) {
        parent::__construct();
        $lang = Kohana::config('locale.language');
        $this->_rDb = new Database();
        $this->_oAttribute = new Attribute_Model();
        $this->_oProduct = new Product_Model();
        $this->_oDeliveryType = new Delivery_Type_Model();
        if (!empty($iOrderId) && $iOrderId + 0 > 0) {
            $this->_iOrderId = $iOrderId;

            $_oOrder = $this->_rDb
                    ->limit(1)
                    ->getwhere(table::SHOP_ORDERS, array('id_order' => $iOrderId));
            $_oCustomer = $this->_rDb
                    ->limit(1)
                    ->join(table::SHOP_CUSTOMERS . ' AS c', 'c.id_customer', 'o.client_id', 'INNER')
                    ->getwhere(table::SHOP_ORDERS . ' AS o', array('id_order' => $iOrderId));
            $_oOrderCustomer = $this->_rDb
                    ->select('*, c.invoice AS customer_invoice, c.delivery AS customer_delivery')
                    ->limit(1)
                    ->join(table::SHOP_ORDERS_CUSTOMERS . ' AS c', 'c.order_id', 'o.id_order', 'INNER')
                    ->getwhere(table::SHOP_ORDERS . ' AS o', array('id_order' => $iOrderId));
            $_oProducts = $this->_rDb
                    ->join(table::SHOP_ORDERS_PRODUCTS . ' AS op', 'op.product_id', 'p.id_product', 'INNER')
                    ->join(table::SHOP_PRODUCTS_DESCRIPTION . ' AS pd', 'pd.product_id', 'p.id_product', 'INNER')
                    ->getwhere(table::SHOP_PRODUCTS . ' AS p', array('op.order_id' => $iOrderId, 'pd.product_language' => $lang));
            $_oDelivery = $this->_rDb
                    ->join(table::SHOP_DELIVERY_TYPES_DESCRIPTION . ' AS dtd', 'dtd.delivery_type_id', 'dt.id_delivery_type', 'INNER')
                    ->getwhere(table::SHOP_DELIVERY_TYPES . ' AS dt', array('dt.id_delivery_type' => $_oOrder[0]->delivery_type));
            $_oPayment = $this->_rDb
                    ->join(table::SHOP_PAYMENT_TYPES_DESCRIPTION . ' AS ptd', 'ptd.payment_type_id', 'pt.id_payment_type', 'INNER')
                    ->getwhere(table::SHOP_PAYMENT_TYPES . ' AS pt', array('pt.id_payment_type' => $_oOrder[0]->payment_type));
            $_oStatus = $this->_rDb
                    ->getwhere(table::SHOP_ORDERS_STATUSES, array('id_order_status' => $_oOrder[0]->status_id));
            if ($_oCustomer->count() > 0) {
                $_oCustomer = $_oCustomer->result_array(false);
                $_oCustomer = $_oCustomer[0];
                foreach ($_oCustomer as $key => $value) {
                    $this->_aCustomer[$key] = $value;
                }
            }
            if ($_oOrderCustomer->count() > 0) {
                $_oOrderCustomer = $_oOrderCustomer->result_array(false);
                $_oOrderCustomer = $_oOrderCustomer[0];
                foreach ($_oOrderCustomer as $key => $value) {
                    $this->_aOrderCustomer[$key] = $value;
                }
            }

            $summary = 0.00;
            if ($_oProducts->count() > 0) {
                $this->_aProducts['items'] = array();
                foreach ($_oProducts as $p) {
                    if (!empty($p->product_rebate)) {
                        $Total = ($p->product_price - ($p->product_price * ($p->product_rebate / 100))) * $p->product_count;
                    } else {
                        $Total = $p->product_price * $p->product_count;
                    }

                    $this->_aProducts['items'][] = array(
                        'id_product' => $p->product_id,
                        'name' => $p->product_name,
                        'count' => $p->product_count,
                        'price' => $p->product_price,
                        'product_rebate' => $p->product_rebate,
                        'total' => $Total,
                        'attributes' => $p->product_attributes,
                    );
                    $summary += $Total * $p->product_count;
                }
                $this->_aProducts['total_products'] = $summary;
            } else {
                $this->_aProducts['items'] = array();
                $this->_aProducts['total_products'] = 0.00;
            }

            if ($_oDelivery->count() > 0) {
                $this->_aDelivery['ID'] = $_oDelivery[0]->id_delivery_type;
                $this->_aDelivery['delivery_type'] = $_oDelivery[0]->delivery_type;
                $this->_aDelivery['delivery_cost'] = $_oOrder[0]->delivery_cost;
            }

            if ($_oPayment->count() > 0) {
                $this->_aPayment['ID'] = $_oPayment[0]->id_payment_type;
                $this->_aPayment['payment_type'] = $_oPayment[0]->payment_type_name;
                $this->_aPayment['payment_cost'] = $_oOrder[0]->payment_cost;
                $this->_aPayment['payment_type_info'] = $_oPayment[0]->payment_type_info;
            }

            if ($_oStatus->count() > 0) {
                $this->_aStatus['ID'] = $_oStatus[0]->id_order_status;
                $this->_aStatus['status'] = $_oStatus[0]->order_status_name;
            }

            if ($_oOrder->count() > 0) {
                $this->_sOrderNumber = $_oOrder[0]->order_number;
                $this->_sCurrentNumber = $_oOrder[0]->current_number;
                $this->_iCurrentNumberYear = $_oOrder[0]->current_number_year;
                $this->_iCurrentNumberMonth = $_oOrder[0]->current_number_month;
                $this->_iCurrentNumberDay = $_oOrder[0]->current_number_day;
                $this->_iCustomerId = $_oOrder[0]->client_id;
                $this->_iOrderDate = $_oOrder[0]->order_date;
                $this->_iStatusId = $_oOrder[0]->status_id;
                $this->_iPaymentType = $_oOrder[0]->payment_type;
                $this->_dPaymentCost = $_oOrder[0]->payment_cost;
                $this->_iDeliveryType = $_oOrder[0]->delivery_type;
                $this->_dDeliveryCost = $_oOrder[0]->delivery_cost;
                $this->_dProductsCost = $_oOrder[0]->products_cost;
                $this->_dOrderCost = $_oOrder[0]->order_cost;
                $this->_sClientsNote = $_oOrder[0]->customer_note;
                $this->_eInvoice = $_oOrder[0]->invoice;
                $this->_sCustomerIP = $_oOrder[0]->client_ip;
                $this->_fAdditionalCost = $_oOrder[0]->additional_cost;
                $this->_eConfirmation = $_oOrder[0]->confirmation;
                $this->_sConfirmationDate = $_oOrder[0]->confirmation_date;
                $this->_ePaid = $_oOrder[0]->paid;
                $this->_eClosed = $_oOrder[0]->closed;
                $this->_sSellerNote = $_oOrder[0]->seller_note;
                $this->_sConfirmString = $_oOrder[0]->confirm_string;
                $this->_sConfirmEmail = $_oOrder[0]->confirm_email;
                $this->_eConfirmed = $_oOrder[0]->confirmed;
                $this->_sCurrency = $_oOrder[0]->currency;
                $this->_dFactor = $_oOrder[0]->factor;
                $this->_iProtection = $_oOrder[0]->protection;
//                Kohana::log('error', '<pre>' . print_r($this, true) . '</pre>');
            }
            //Kohana::log('error', '<pre>' . print_r($this, true) . '</pre>');
        }
        $this->oConfig = $this->_rDb->from(table::CONFIGURATION)->get();
        $this->lang = Kohana::config('locale.language');
    }

    public function ChangePaid($iPaidStatus, $iOrderId) {
        try {
            $this->_rDb->update(table::SHOP_ORDERS, array('paid' => $iPaidStatus), array('id_order' => $iOrderId));
            return new ErrorReporting(ErrorReporting::SUCCESS, true, 'Status płatności został zapisany.');
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . ': ' . __LINE__ . ': ' . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, $ex->getMessage());
        }
    }

    /**
     * FIXME: Uwaga na email (należy dodać/pobrać z konfiguracji
     * Zmiana statusu dla zamównienia
     * @author Hubert Kulczak, Filip Górczyński
     * @param Integer $iStatusId
     * @param Integer $iOrderId
     * @return ErrorReporting (Bool true || Bool false)
     */
    public function ChangeStatus($iStatusId, $iOrderId) {
        try {
            $iOrderId += 0;
            $iStatusId += 0;
            $this->_rDb->update(TABLE::SHOP_ORDERS, array('status_id' => $iStatusId), array('id_order' => $iOrderId));
            $oOrder = new Order_Model($iOrderId);
            if (!empty($oOrder->_aOrderCustomer['lang'])) {
                Kohana::config_set('locale.language', $oOrder->_aOrderCustomer['lang']);
            }
//            var_dump($oOrder->_aPayment);exit;
//            echo '<pre>';
//            var_dump();
//            echo '</pre>';
//            exit;


            $dProductsCost = shop::ProductsCost($oOrder->_aProducts['items']);

            $vBody = new View('emails/email_template');
            $vBody->vEmailContent = new View('emails/customer_order');

            //kosz z rabatem
            $dProductsCost2 = $dProductsCost;
            if (!empty($oOrder->_aOrderCustomer['customer_rebate']) && $oOrder->_aOrderCustomer['customer_rebate'] != 0):
                $totaltmp = $dProductsCost * ($oOrder->_aOrderCustomer['customer_rebate'] / 100);
                $dCostPerRabate = $dProductsCost - $totaltmp;
                $dProductsCost2 = $dCostPerRabate;
                $vBody->vEmailContent->bCostPerRabate = $dCostPerRabate;
                $vBody->vEmailContent->rebate = $oOrder->_aOrderCustomer['customer_rebate'];
            endif;

            if ($oOrder->_sCurrency != 'zł' && $oOrder->_sCurrency != 'PLN') {
                $reTotalcost = number_format($oOrder->_dFactor * (number_format($dProductsCost2 + $oOrder->_aDelivery['delivery_cost'], 2, '.', '')), 2, '.', '') . ' ' . $oOrder->_sCurrency . ' (' . number_format($dProductsCost2 + $oOrder->_aDelivery['delivery_cost'], 2, '.', '') . ' PLN)';
                $reProductCost = number_format($oOrder->_dFactor * (number_format($dProductsCost, 2, '.', '')), 2, '.', '') . ' ' . $oOrder->_sCurrency . ' (' . number_format($dProductsCost, 2, '.', '') . ' PLN)';
                $reDeliveryCost = number_format($oOrder->_dFactor * ($oOrder->_aDelivery['delivery_cost']), 2, '.', '') . ' ' . $oOrder->_sCurrency . ' (' . $oOrder->_aDelivery['delivery_cost'] . ' PLN)';
            } else {
                $reTotalcost = number_format($dProductsCost2 + $oOrder->_aDelivery['delivery_cost'], 2, '.', '') . ' zł';
                $reProductCost = number_format($dProductsCost, 2, '.', '');
                $reDeliveryCost = $oOrder->_aDelivery['delivery_cost'];
            }

            $oOrder->fTotalCost = $reTotalcost;
            $oOrder->dProductsCost = $reProductCost;
            $oOrder->_aDelivery['delivery_cost'] = $reDeliveryCost;

            //Widok wiadomości email

            $vBody->vEmailContent->oOrder = $oOrder;
            $vBody->vEmailContent->bUserAddress = true;
            $vBody->vEmailContent->bDeliveryAddress = true;
            $vBody->vEmailContent->bInvoiceData = true;
            $vBody->vEmailContent->vOrderTable = new View('emails/elements/order_table');
            $vBody->vEmailContent->orderComments = $oOrder->_aOrderCustomer['delivery_comments'];

            $vBody->vEmailContent->vOrderTable->aProducts = $oOrder->_aProducts['items'];
            $vBody->vEmailContent->vOrderTable->sCurrency = $oOrder->_sCurrency;
            $vBody->vEmailContent->vOrderTable->dFactor = $oOrder->_dFactor;
            $vBody->vEmailContent->vOrderTable->iProtection = $oOrder->_iProtection;
            //var_dump($oOrder->_aProducts['items']); exit;
            $vBody->vEmailContent->vOrderTable->dProductsCost = $dProductsCost;
            $vBody->vEmailContent->vOrderTable->aProductAttr = $this->_oAttribute->GetAttributesAsArray()->Value;
            $vBody->vEmailContent->additionalText = '';

            if (in_array($oOrder->_aDelivery['ID'], array(1, 2))) { // wiadomosci o platnosci tylko jesli wybrano 
                $vBody->vEmailContent->additionalText = new View('emails/elements/payment');
                $vBody->vEmailContent->additionalText->orderTitle = $oOrder->_aOrderCustomer['order_number'];
            }


            //Adres nadawcy wiadomości
            $sEmail = config::getConfig('administrator_email');


            switch ($iStatusId) {
                case 1: // NOWE
                    $sSubject = Kohana::lang('emails.change_state_new.title', $oOrder->_aOrderCustomer['order_number']);

                    layer::SendMessage('Nowe zamówienie', $vBody, array($sEmail), $sEmail);

                    break;
                case 2: // ZAPŁACONO
                    $sSubject = Kohana::lang('emails.change_state_zaplacono.title');
                    $this->SetVoucherStatus($iOrderId, 1);
                    break;
                case 3: // W REALIZACJI
                    $sSubject = Kohana::lang('emails.change_state_w_realizacji.title', $oOrder->_aOrderCustomer['order_number']);

                    break;
                case 4: // ZREALIZOWANO
                    if ($oOrder->_aDelivery['ID'] == 3) {
                        $sSubject = Kohana::lang('emails.change_state_zrealizowano_odbior_osobisty.title', $oOrder->_aOrderCustomer['order_number']);
                    } else {
                        $sSubject = Kohana::lang('emails.change_state_zrealizowano_wysylka.title', $oOrder->_aOrderCustomer['order_number']);
                    }
                    break;
                case 5: // ZAMKNIĘTE
                    $sSubject = Kohana::lang('emails.change_state_zamkniete.title', $oOrder->_aOrderCustomer['order_number']);

                    break;
                default:
                    break;
            }
            //Wysyłanie wiadomości do klienta
            if (5 != $iStatusId) { // jeśli status oznacza zamknięcie zamówienia, to nie jest wysyłany email do klienta
                layer::SendMessage($sSubject, $vBody, array($oOrder->_aOrderCustomer['customer_email']), $sEmail);
            }
            //Kohana::config_set('locale.language', 'pl_PL');
            return new ErrorReporting(ErrorReporting::SUCCESS, true, Kohana::lang('order.status_has_been_changed_successfully'));
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . ': ' . __LINE__ . ': ' . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, $ex->getMessage());
        }
    }

    public function ChangeDelivieryComments($idOrder, $comments) {
        try {
            $result = $this->_rDb->update(TABLE::SHOP_ORDERS, array('delivery_comments' => $comments), array('id_order' => $idOrder));

            return new ErrorReporting(ErrorReporting::SUCCESS, $result, Kohana::lang('order.order_deleted_success'));
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, $ex->getMessage());
        }
    }

    public function SetStatus($iOrderId, $iStatusId, $sendEmail = false) {
        try {
            if (!empty($iOrderId) && !empty($iStatusId)) {
                $this->_rDb->update(table::SHOP_ORDERS, array('status_id' => $iStatusId), array('id_order' => $iOrderId));
            }
            if ($sendEmail) {
                $this->ChangeStatus($iStatusId, $iOrderId);
            }
            return new ErrorReporting(ErrorReporting::SUCCESS, $result, Kohana::lang('order.order_deleted_success'));
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, $ex->getMessage());
        }
    }

     public function SetVoucherStatus($iOrderId, $iStatus) {
        try {
            $result = $this->_rDb->from(table::SHOP_ORDERS_PRODUCTS)
                    ->join(table::SHOP_ORDERS, table::SHOP_ORDERS . '.id_order', table::SHOP_ORDERS_PRODUCTS . '.order_id', 'LEFT')
                    ->join(table::SHOP_ORDERS_CUSTOMERS, table::SHOP_ORDERS_CUSTOMERS . '.order_id', table::SHOP_ORDERS . '.id_order', 'LEFT')
                    ->join(table::VOUCHERS, table::VOUCHERS . '.order_product_id', table::SHOP_ORDERS_PRODUCTS . '.order_product_id', 'LEFT')
                    ->where(array('id_order' => $iOrderId))
                    ->get();
//var_dump($result);exit;
            // po wszystkich produktach
            if (!empty($result) && $result->count() > 0) {
                foreach ($result as $r) {
                    if (!empty($r->id_voucher) && $iStatus==1) {
                        // wysyłamy info do klienta
                        if (!empty($r->customer_email)) {
                            $vBody = new View('emails/email_template');
                            $vBody->vEmailContent = new View('emails/voucher_info');
                            $vBody->vEmailContent->oVoucher = $r;

                            layer::SendMessage('Voucher aktywny', $vBody, array($r->customer_email));
                        }
                    }
                    $this->_rDb->update(table::VOUCHERS, array('voucher_status' => $iStatus), array('id_voucher' => $r->id_voucher));
                }
            }
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, $ex->getMessage());
        }
    }

    /**
     * Usuwanie zamówienia
     * @author Hubert Kulczak
     * @param Integer $iOrderId
     * @return ErrorReporting
     */
    public function DeleteOrder($iOrderId) {
        try {
            $iOrderId += 0;
            $this->_rDb->query('SET AUTOCOMMIT = 0');
            $this->_rDb->query('BEGIN');
            $this->_rDb->delete(table::SHOP_ORDERS_PRODUCTS, array('order_id' => $iOrderId));
            $result = $this->_rDb->delete(table::SHOP_ORDERS, array('id_order' => $iOrderId));
            $this->_rDb->query('COMMIT');
            return new ErrorReporting(ErrorReporting::SUCCESS, $result, Kohana::lang('order.order_deleted_success'));
        } catch (Exception $ex) {
            $this->_rDb->query('ROLLBACK');
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, $ex->getMessage());
        }
    }

    public function DeleteOrdersArray($ordersIds) {
        if (is_array($ordersIds)) {
            foreach ($ordersIds as $id) {
                $this->DeleteOrder($id);
            }
        }
        return new ErrorReporting(ErrorReporting::SUCCESS, true, Kohana::lang('order.order_deleted_success'));
    }

    /**
     * Pobieranie zamówień - dla listy zamówien
     * @author Hubert Kulczak
     * @param Array $aWhere
     * @param Array $aLike
     * @param Integer $limit
     * @param Integer $offset
     * @return ErrorReporting
     */
    public function FindAllOrders($aWhere = null, $aLike = null, $limit = null, $offset = null, $args = null, $sort = null) {
        try {
            if (!empty($args) && is_array($args) && count($args)) {
                foreach ($args as $key => $value) {
                    switch ($key) {
                        case 'status_id';
                            $this->_rDb->where(array('status_id' => $value));
                            break;
                        case 'date_order_from':
                            $this->_rDb->where(array('order_date >=' => $value));
                            break;
                        case 'date_order_to':
                            $this->_rDb->where(array('order_date <=' => $value));
                            break;
                        case 'order_number':
                            $this->_rDb->where(array('order_number' => $value));
                            break;
                        case 'customer_first_name':
                            $this->_rDb->like(array('customer_first_name' => $value));
                            break;
                        case 'customer_last_name':
                            $this->_rDb->like(array('customer_last_name' => $value));
                            break;
                        case 'customer_email':
                            $this->_rDb->like(array('customer_email' => $value));
                            break;
                    }
                }
            }
            if (!empty($sort) && is_array($sort) && count($sort)) {
                $this->_rDb->orderby($sort);
            } else {
                $this->_rDb->orderby(array('order_date' => 'DESC'));
            }
            $this->_rDb->from(table::SHOP_ORDERS)
                    ->join(table::SHOP_ORDERS_STATUSES, 'id_order_status', 'status_id', 'LEFT')
                    ->join(table::SHOP_ORDERS_CUSTOMERS, 'order_id', 'id_order', 'LEFT');
            //->join(table::SHOP_PAYMENT_TYPES_DESCRIPTION, 'payment_type_id', 'payment_type');
            //->orderby('order_date', 'DESC');
            if (!empty($limit) && isset($offset)) {
                $this->_rDb->limit($limit, $offset);
            }
            if (!empty($aWhere)) {
                $this->_rDb->where($aWhere);
            }
            if (!empty($aLike)) {
                $this->_rDb->like($aLike);
            }
            $results = $this->_rDb->get();
            //echo '<pre>'.$this->_rDb->last_query().'</pre>';
            return new ErrorReporting(ErrorReporting::SUCCESS, $results, '');
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, '');
        }
    }

    /**
     * Pobiera dane zamówienia dla podanych parametrów $aData
     * @todo Dla jezykow trzeba bedzie tu cos zmienic!!
     * @author Hubert Kulczak
     * @param Array $aWhere
     * @return ErrorReporting (MySQL Object || false)
     */
    public function FindOrder($aWhere) {
        try {
            $result = $this->_rDb->from(table::SHOP_ORDERS . ' AS so')
                    ->join(table::SHOP_PAYMENT_TYPES_DESCRIPTION, 'payment_type_id', 'so.payment_type')
                    ->join(table::SHOP_PAYMENT_TYPES, 'id_payment_type', 'so.payment_type')
                    ->join(table::SHOP_DELIVERY_TYPES_DESCRIPTION, 'delivery_type_id', 'so.delivery_type')
                    ->join(table::SHOP_DELIVERY_TYPES, 'id_delivery_type', 'so.delivery_type')
                    ->join(table::SHOP_ORDERS_STATUSES, 'id_order_status', 'so.status_id')
                    ->join(table::SHOP_ORDERS_CUSTOMERS, 'order_id', 'so.id_order')
                    ->where($aWhere)
                    ->get();
            return new ErrorReporting(ErrorReporting::SUCCESS, $result, '');
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . ': ' . __LINE__ . ': ' . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('order.FindOrder_error'));
        }
    }

    /**
     * Pobiera dane zamówienia dla podanego numeru zamówienia AJAXowe wyszukiwanie
     * @author Hubert Kulczak
     * @param Array $aLike
     * @return ErrorReporting (MySQL Object || false)
     */
    public function FindOrderByOrderNumber($aLike) {
        try {
            $aSearch = array();
            $aWhere = array();
            if (!empty($aLike['order_number'])) {
                $aSearch['order_number'] = $aLike['order_number'];
            }
            if (!empty($aLike['status_id'])) {
                $aWhere['status_id'] = $aLike['status_id'];
            }
            $result = $this->FindAllOrders($aWhere, $aSearch)->Value;
            return new ErrorReporting(ErrorReporting::SUCCESS, $result, '');
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . ': ' . __LINE__ . ': ' . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('order.FindOrderByOrderNumber_error'));
        }
    }

    /**
     * Pobiera zamówione produkty
     * @author Hubert Kulczak
     * @param Integer $iOrderId
     * @return ErrorReporting (MySQL Object || Array || false)
     */
    public function GetOrdersProducts($iOrderId, $lang = 'pl_PL') {
        try {
            $query = "SELECT * FROM (" . table::SHOP_ORDERS_PRODUCTS . " AS `p`) 
                INNER JOIN " . table::SHOP_PRODUCTS_DESCRIPTION . " AS `pd` ON (`pd`.`product_id` = `p`.`product_id`) 
                LEFT JOIN (SELECT * FROM " . table::SHOP_PRODUCTS_IMAGES . " GROUP BY product_id) AS `pi` ON (`p`.`product_id` = `pi`.`product_id`) 
                WHERE `order_id` = " . $iOrderId . " AND `product_language` = '" . $lang . "' ";

            $result = $this->_rDb->query($query);


            return new ErrorReporting(ErrorReporting::SUCCESS, $result);
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('order.GetOrdersStatuses_error'));
        }
    }

    /**
     * Pobiera statusy zamówien, jesli (true) to jako array
     * @author Hubert Kulczak
     * @param Bool $bAsArray
     * @return ErrorReporting (MySQL Object || Array || false)
     */
    public function GetOrdersStatuses($bAsArray = null) {
        try {
            $result = $this->_rDb->from(table::SHOP_ORDERS_STATUSES)->get();
            if ($bAsArray === true) {
                $Statuses = array();
                $Statuses[0] = Kohana::lang('order.check');
                foreach ($result as $r) {
                    $Statuses[$r->id_order_status] = $r->order_status_name;
                }
            } else {
                $Statuses = $result;
            }
            return new ErrorReporting(ErrorReporting::SUCCESS, $Statuses, '');
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . ': ' . __LINE__ . ': ' . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('order.GetOrdersStatuses_error'));
        }
    }

    /**
     * @author Tomasz Drgas
     * 
     * @param array $data
     * @return ErrorReporting
     */
    public function InsertNew(array $data) {
        try {


            if (!empty($data)) {
                foreach ($_SESSION['__cart'] as $key => $Prod) {
                    $_SESSION['__cart'][$key]['count'] = $_POST['count'][$key];
                }

                $this->_rDb->query('SET AUTOCOMMIT = 0');
                $this->_rDb->query('BEGIN');

                if (!empty($_SESSION['_customer']['logged_in']) && $_SESSION['_customer']['logged_in'] == true) {
                    $iCustomerId = $_SESSION['_customer']['customer_id'];
                } elseif (!empty($data['customer_id'])) {
                    $iCustomerId = $data['customer_id'];
                } else {
                    $iCustomerId = '';
                }

                $totalCost = 0.0;
                $oDeliveryType = new Delivery_Type_Model($data['delivery_options']);
//				$oPaymentType = new Payment_Type_Model($data['__payment_type']);
                // liczymy sumarycznie koszt produktów
                $iCostSummary = $this->_oProduct->CountCartCost($_SESSION['__cart'], TRUE)->Value;
//                var_dump($iCostSummary);exit;
                // sprawdzamy koszt przesylki dla produktów
                $oDeliveryPrice = $this->_oDeliveryType->GetDeliveryTypes2($this->lang, $iCostSummary, $data['delivery_options'])->Value[0];

                $dDeliveryCost = $oDeliveryPrice->delivery_price;


                if (count($_SESSION['__cart'])) {
                    foreach ($_SESSION['__cart'] as $productKey => $productValue) {
                        if (!empty($_POST['count'][$productKey])) {
                            $productValue['count'] = $_POST['count'][$productKey];
                        }
                        //koszt z rabatem - kodem rabatowym
                        if (!empty($_SESSION['__rebate']['value']) && !empty($productValue['rebate'])) {
                            $productPrice = ($productValue['price'] - ($productValue['price'] * ($productValue['rebate'] / 100)));
                            $totalCost += ($productPrice * $productValue['count']);
                        } else {
                            $totalCost += ($productValue['price'] * $productValue['count']);
                        }
                    }
                }
                $iStatusId = 1;
                // koszt produktow
                $ProductCost = $totalCost;
//                var_dump($totalCost);exit;
                //koszt z rabatem - to inaczej jest teraz liczone
//                if (!empty($_SESSION['_customer']['customer_rebate']) && $_SESSION['_customer']['customer_rebate'] != 0):
//                    $totaltmp = $totalCost * ($_SESSION['_customer']['customer_rebate'] / 100);
//                    $totalCost = $totalCost - $totaltmp;
//                endif;
                //  laczny koszt
                $totalCost += ( $dDeliveryCost /* + $oPaymentType->PaymentCost */);
                //$newNumber = explode('/', $this->_getNextOrderNumber(date('Y'), date('m'), date('d')));
                $newNumber = $this->_getNextOrderNumber(date('Y'), date('m'), date('d'));
                $confirm_string = md5(TIME);
                $_SESSION['confirm_string'] = $confirm_string;
                $rOrderResult = $this->_rDb->insert(table::SHOP_ORDERS, array(
                    'client_id' => $iCustomerId,
                    'order_number' => $newNumber . '/' . date('Y') . '/' . date('m') . '/' . date('d'),
                    'current_number' => $newNumber,
                    'current_number_year' => date('Y'),
                    'current_number_month' => date('m'),
                    'current_number_day' => date('d'),
                    'order_date' => TIME,
                    'status_id' => $iStatusId,
                    'payment_type' => (!empty($data['payment_type_id']) ? $data['payment_type_id'] : NULL),
                    'delivery_type' => $data['delivery_options'],
                    'payment_cost' => (!empty($data['payment_cost']) && $data['payment_cost'] > 0 ? $data['payment_cost'] : '0.00'),
                    'delivery_cost' => $dDeliveryCost,
                    'products_cost' => $ProductCost,
                    'order_cost' => $totalCost,
                    'invoice' => !empty($data['invoice']) ? 'Y' : 'N',
                    'client_ip' => $_SERVER['REMOTE_ADDR'],
                    'customer_note' => !empty($data['customer_note']) ? $data['customer_note'] : '',
                    'confirm_email' => $data['customer_email'],
                    'confirm_string' => $confirm_string,
                    //'customer_rebate' => (!empty($_SESSION['_customer']['customer_rebate']) ? $_SESSION['_customer']['customer_rebate'] : ''),
                    'lang' => $this->lang,
                    'currency' => currency::GetCurrency(),
                    'factor' => currency::GetFactor(),
                    'rebate_code' => (!empty($_SESSION['__rebate']['name']) ? $_SESSION['__rebate']['name'] : NULL),
                    'rebate_value' => (!empty($_SESSION['__rebate']['value']) ? $_SESSION['__rebate']['value'] : NULL),
                    'rebate_cost' => (!empty($_SESSION['__rebate_cost_summary']) ? $_SESSION['__rebate_cost_summary'] : 0),
                    'protection' => (!empty($data['protection']) && $data['protection'] ? '1' : '0')
                        )
                );
                $iInsertOrder = $rOrderResult->insert_id();
                $aData = array();
                // DANE KLIENTA DODAJEMY DO ZAMÓWIENIA
                $aData['customer_first_name'] = $data['customer_first_name'];
                $aData['customer_last_name'] = $data['customer_last_name'];
                $aData['customer_email'] = $data['customer_email'];
                $aData['customer_city'] = $data['customer_city'];
                $aData['customer_zip'] = $data['customer_zip'];
                $aData['customer_address'] = $data['customer_address'];
                $aData['customer_country'] = $data['customer_country'];
                $aData['customer_type'] = $data['customer_type'];
                //$aData['customer_state'] = $data['customer_state'];
                $aData['customer_phoneno'] = $data['customer_phoneno'];
                if (!empty($data['is_delivery_address'])) {
                    $aData['delivery'] = 'Y';
                    $aData['delivery_first_name'] = $data['delivery_first_name'];
                    $aData['delivery_last_name'] = $data['delivery_last_name'];
                    $aData['delivery_email'] = $data['delivery_email'];
                    $aData['delivery_company_name'] = $data['delivery_company_name'];
                    //$aData['delivery_nip'] = $data['__customer']['delivery']['delivery_nip'];
                    $aData['delivery_city'] = $data['delivery_city'];
                    $aData['delivery_zip'] = $data['delivery_zip'];
                    $aData['delivery_address'] = $data['delivery_address'];
                    //$aData['delivery_state'] = $data['delivery_state'];
                    $aData['delivery_country'] = $data['delivery_country'];
                    $aData['delivery_phoneno'] = $data['delivery_phoneno'];
                    //$aData['delivery_faxno'] = $data['__customer']['delivery']['delivery_faxno'];
                    //$aData['delivery_mobileno'] = $data['__customer']['delivery']['delivery_mobileno'];
                }
                if (!empty($data['is_invoice_address'])) {
                    $aData['invoice'] = 'Y';
                    $aData['invoice_first_name'] = $data['invoice_first_name'];
                    $aData['invoice_last_name'] = $data['invoice_last_name'];
                    //$aData['invoice_email'] = $data['__customer']['invoice']['invoice_email'];
                    $aData['invoice_company_name'] = $data['invoice_company_name'];
                    $aData['invoice_nip'] = $data['invoice_nip'];
                    $aData['invoice_city'] = $data['invoice_city'];
                    $aData['invoice_zip'] = $data['invoice_zip'];
                    $aData['invoice_address'] = $data['invoice_address'];
                    //$aData['invoice_state'] = $data['invoice_state'];
                    $aData['invoice_country'] = $data['invoice_country'];
                    //'invoice_phoneno' => $data['__customer']['invoice_phoneno'],
                    //'invoice_faxno' => $data['__customer']['invoice_faxno'],
                    //'invoice_mobileno' => $data['__customer']['invoice_mobileno'],
                }

                $aData['customer_id'] = $iCustomerId;
                $aData['order_id'] = $iInsertOrder;
                unset($aData['accept_terms']);
                unset($aData['accept_terms2']);
//				$aData['accept_terms'] = 1;
//				$aData['accept_terms2'] = 1;
//				
//				if(!empty($data['customer_accept3']) && $data['customer_accept3'] == 'confirmed'){
//					$aData['accept_terms3'] = 1;
//				}



                $this->_rDb->insert(table::SHOP_ORDERS_CUSTOMERS, $aData);
                foreach ($_SESSION['__cart'] as $iProductKey => $c) {
                    // jesli produkt miał voucher
                    
                    $aAttr = array();
                    if (!empty($c['attributes']) && count($c['attributes']) > 0) {
                        foreach ($c['attributes'] as $key => $val) {
                            $aAttr[] = $key . ':' . $val;
                        }
                    }
                    
                    $quantity = (!empty($_POST['count'][$iProductKey]) ? $_POST['count'][$iProductKey] : $c['count']);
                    
                    $aAdd = array(
                        'product_id' => $c['id_product'],
                        'order_id' => $iInsertOrder,
                        'product_count' => $quantity,
                        'product_price' => $c['price'],
                        'product_attributes' => implode(';', $aAttr),
                        'product_rebate' => $c['rebate'],
                    );

                    $oProdInsert = $this->_rDb->insert(table::SHOP_ORDERS_PRODUCTS, $aAdd);
                    
                    
                    // jesli produkt miał voucher
                    if (!empty($c['voucher']) && $c['voucher'] == 1) {                        
                        for($i=0;$i<$quantity;$i++) {
                            $aVoucherAdd = array(
                                'voucher_code' => $this->_oProduct->GenerateVoucherCode()->Value,
                                'voucher_create' => date('Y-m-d H:i:s', time()),
                                'voucher_value' => $c['price'],
                                'order_product_id' => $oProdInsert->insert_id()
                            );
                            $this->_rDb->insert(table::VOUCHERS, $aVoucherAdd);
                        }
                    }
                    
                }
                $this->_rDb->query('COMMIT');
                $this->ChangeStatus(1, $iInsertOrder);
                // wysyłka maila do klienta i automatyczna zmiana statusu zamówienia
//				if ($oDeliveryType->ID == 3 || $oDeliveryType->ID == 4) { // jeśli PP pobranie lub UPS pobranie
//					$this->ChangeStatus(2, $iInsertOrder);
//				} else {
//					$this->ChangeStatus(1, $iInsertOrder);
//				}
//				if ($oDeliveryType->ID == 6) { // przedpłata
//					$this->ChangeStatus(1, $iInsertOrder);
//				} elseif ($oDeliveryType->ID == 7) { // pobranie
//					$this->ChangeStatus(2, $iInsertOrder);
//				}
//				unset($data['customer_note']);
//					echo '<pre>';
//					var_dump($rOrderResult);
//					echo '</pre>';
//					exit;
                return new ErrorReporting(ErrorReporting::SUCCESS, $rOrderResult, Kohana::lang('order.order_summary_ok'));
            } else {
                Kohana::log('error', __FILE__ . ': ' . __LINE__ . ': ' . $ex->getMessage());
                return new ErrorReporting(ErrorReporting::ERROR, false, 'Wystąpił błąd podczas składania zamówienia.');
            }
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . ': ' . __LINE__ . ': ' . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, 'Wystąpił błąd podczas składania zamówienia.');
        }
    }

    /**
     *
     * @param array $data
     * @return ErrorReporting
     */
    public function Insert(array $data) {
        try {
            $this->_rDb->query('SET AUTOCOMMIT = 0');
            $this->_rDb->query('BEGIN');
            if (!empty($data['_customer']['logged_in']) && $data['_customer']['logged_in'] == true) {
                $iCustomerId = $data['_customer']['customer_id'];
            } else { // jesli user nie zalogowany
                // DANE KLIENTA
                $aData['customer_first_name'] = $data['__customer']['customer']['first_name'];
                $aData['customer_last_name'] = $data['__customer']['customer']['last_name'];
                $aData['customer_email'] = $data['__customer']['customer']['customer_email'];
                $aData['customer_city'] = $data['__customer']['customer']['customer_city'];
                $aData['customer_zip'] = $data['__customer']['customer']['customer_zip'];
                $aData['customer_address'] = $data['__customer']['customer']['customer_address'];
                //'customer_country' => $data['__customer']['customer']['customer_country'],
                //$aData['customer_state'] = $data['__customer']['customer']['customer_state'];
                $aData['customer_phoneno'] = $data['__customer']['customer']['customer_phoneno'];
                if (!empty($data['__customer']['is_delivery_address'])) {
                    $aData['delivery_first_name'] = $data['__customer']['delivery']['delivery_first_name'];
                    $aData['delivery_last_name'] = $data['__customer']['delivery']['delivery_last_name'];
                    $aData['delivery_email'] = $data['__customer']['delivery']['delivery_email'];
                    $aData['delivery_company_name'] = $data['__customer']['delivery']['delivery_company_name'];
                    $aData['delivery_nip'] = $data['__customer']['delivery']['delivery_nip'];
                    $aData['delivery_city'] = $data['__customer']['delivery']['delivery_city'];
                    $aData['delivery_zip'] = $data['__customer']['delivery']['delivery_zip'];
                    $aData['delivery_address'] = $data['__customer']['delivery']['delivery_address'];
                    $aData['delivery_state'] = $data['__customer']['delivery']['delivery_state'];
                    $aData['delivery_country'] = $data['__customer']['delivery']['delivery_country'];
                    $aData['delivery_phoneno'] = $data['__customer']['delivery']['delivery_phoneno'];
                    $aData['delivery_faxno'] = $data['__customer']['delivery']['delivery_faxno'];
                    $aData['delivery_mobileno'] = $data['__customer']['delivery']['delivery_mobileno'];
                }
                if (!empty($data['__customer']['is_invoice_address'])) {
                    $aData['invoice_first_name'] = $data['__customer']['invoice']['invoice_first_name'];
                    $aData['invoice_last_name'] = $data['__customer']['invoice']['invoice_last_name'];
                    $aData['invoice_email'] = $data['__customer']['invoice']['invoice_email'];
                    $aData['invoice_company_name'] = $data['__customer']['invoice']['invoice_company_name'];
                    $aData['invoice_nip'] = $data['__customer']['invoice']['invoice_nip'];
                    $aData['invoice_city'] = $data['__customer']['invoice']['invoice_city'];
                    $aData['invoice_zip'] = $data['__customer']['invoice']['invoice_zip'];
                    $aData['invoice_address'] = $data['__customer']['invoice']['invoice_address'];
                    $aData['invoice_state'] = $data['__customer']['invoice']['invoice_state'];
                    $aData['invoice_country'] = $data['__customer']['invoice']['invoice_country'];
                }
                //DODAJEMy klienta
                $oCustomerResult = $this->_rDb->insert(table::SHOP_CUSTOMERS, $aData);
                $iCustomerId = $oCustomerResult->insert_id();
            }
            $totalCost = 0.0;
            $oDeliveryType = new Delivery_Type_Model($data['__delivery_type']);
            $oPaymentType = new Payment_Type_Model($data['__payment_type']);

            if (count($_SESSION['__cart'])) {
                foreach ($_SESSION['__cart'] as $productKey => $productValue) {
                    $totalCost += ( $productValue['price'] * $productValue['count']);
                }
            }
            // koszt produktow
            $ProductCost = $totalCost;
            //  laczny koszt
            $totalCost += ( $oDeliveryType->DeliveryCost + $oPaymentType->PaymentCost);
            //$newNumber = explode('/', $this->_getNextOrderNumber(date('Y'), date('m'), date('d')));
            $newNumber = $this->_getNextOrderNumber(date('Y'), date('m'), date('d'));

            $iStatusId = 1; // ustalamy status na oczekuje na wplate

            if ($oPaymentType->ID == 6) { // przedpłata
                $iStatusId = 1;
            } elseif ($oPaymentType->ID == 7) { // pobranie
                $iStatusId = 2;
            }
            $rOrderResult = $this->_rDb->insert(table::SHOP_ORDERS, array(
                'client_id' => $iCustomerId,
                'order_number' => $newNumber . '/' . date('Y') . '/' . date('m') . '/' . date('d'),
                'current_number' => $newNumber,
                'current_number_year' => date('Y'),
                'current_number_month' => date('m'),
                'current_number_day' => date('d'),
                'order_date' => TIME,
                'status_id' => $iStatusId,
                'payment_type' => $data['__payment_type'],
                'delivery_type' => $data['__delivery_type'],
                'payment_cost' => $oPaymentType->PaymentCost,
                'delivery_cost' => $oDeliveryType->DeliveryCost,
                'products_cost' => $ProductCost,
                'order_cost' => $totalCost,
                'invoice' => !empty($data['__customer']['invoice']) ? 'Y' : 'N',
                'client_ip' => $_SERVER['REMOTE_ADDR'],
                'customer_note' => !empty($data['__customer_note']) ? $data['__customer_note'] : '',
                'confirm_email' => $data['__customer']['customer']['customer_email'],
                'protection' => (!empty($data['protection']) && $data['protection'] ? '1' : '0'),
                'confirm_string' => md5(TIME)
                    )
            );
            $iInsertOrder = $rOrderResult->insert_id();
            $aData = array();
            // DANE KLIENTA DODAJEMY DO ZAMÓWIENIA
            $aData['customer_first_name'] = $data['__customer']['customer']['first_name'];
            $aData['customer_last_name'] = $data['__customer']['customer']['last_name'];
            $aData['customer_email'] = $data['__customer']['customer']['customer_email'];
            $aData['customer_city'] = $data['__customer']['customer']['customer_city'];
            $aData['customer_zip'] = $data['__customer']['customer']['customer_zip'];
            $aData['customer_address'] = $data['__customer']['customer']['customer_address'];
            $aData['customer_country'] = $data['__customer']['customer']['customer_country'];
            //$aData['customer_state'] = $data['__customer']['customer']['customer_state'];
            $aData['customer_phoneno'] = $data['__customer']['customer']['customer_phoneno'];
            $aData['customer_type'] = $data['__customer']['customer']['customer_type'];
            if (!empty($data['__customer']['is_delivery_address'])) {
                $aData['delivery'] = 'Y';
                $aData['delivery_first_name'] = $data['__customer']['delivery']['delivery_first_name'];
                $aData['delivery_last_name'] = $data['__customer']['delivery']['delivery_last_name'];
                $aData['delivery_email'] = $data['__customer']['delivery']['delivery_email'];
                $aData['delivery_company_name'] = $data['__customer']['delivery']['delivery_company_name'];
                //$aData['delivery_nip'] = $data['__customer']['delivery']['delivery_nip'];
                $aData['delivery_city'] = $data['__customer']['delivery']['delivery_city'];
                $aData['delivery_zip'] = $data['__customer']['delivery']['delivery_zip'];
                $aData['delivery_address'] = $data['__customer']['delivery']['delivery_address'];
                $aData['delivery_state'] = $data['__customer']['delivery']['delivery_state'];
                $aData['delivery_country'] = $data['__customer']['delivery']['delivery_country'];
                $aData['delivery_phoneno'] = $data['__customer']['delivery']['delivery_phoneno'];
                //$aData['delivery_faxno'] = $data['__customer']['delivery']['delivery_faxno'];
                //$aData['delivery_mobileno'] = $data['__customer']['delivery']['delivery_mobileno'];
            }
            if (!empty($data['__customer']['is_invoice_address'])) {
                $aData['invoice'] = 'Y';
                $aData['invoice_first_name'] = $data['__customer']['invoice']['invoice_first_name'];
                $aData['invoice_last_name'] = $data['__customer']['invoice']['invoice_last_name'];
                //$aData['invoice_email'] = $data['__customer']['invoice']['invoice_email'];
                $aData['invoice_company_name'] = $data['__customer']['invoice']['invoice_company_name'];
                $aData['invoice_nip'] = $data['__customer']['invoice']['invoice_nip'];
                $aData['invoice_city'] = $data['__customer']['invoice']['invoice_city'];
                $aData['invoice_zip'] = $data['__customer']['invoice']['invoice_zip'];
                $aData['invoice_address'] = $data['__customer']['invoice']['invoice_address'];
                $aData['invoice_state'] = $data['__customer']['invoice']['invoice_state'];
                $aData['invoice_country'] = $data['__customer']['invoice']['invoice_country'];
                //'invoice_phoneno' => $data['__customer']['invoice_phoneno'],
                //'invoice_faxno' => $data['__customer']['invoice_faxno'],
                //'invoice_mobileno' => $data['__customer']['invoice_mobileno'],
            }
            $aData['customer_id'] = $iCustomerId;
            $aData['order_id'] = $iInsertOrder;
            $this->_rDb->insert(table::SHOP_ORDERS_CUSTOMERS, $aData);
            foreach ($data['__cart'] as $c) {
                $this->_rDb->insert(table::SHOP_ORDERS_PRODUCTS, array(
                    'product_id' => $c['id_product'],
                    'order_id' => $iInsertOrder,
                    'product_count' => (!empty($_POST['count'][$iProductKey]) ? $_POST['count'][$iProductKey] : $c['count']),
                    'product_price' => $c['price'],
                    'product_attributes' => implode(';', $aAttr),
                    'product_rebate' => $c['rebate'],
                        )
                );
            }
            $this->_rDb->query('COMMIT');
            // wysyłka maila do klienta i automatyczna zmiana statusu zamówienia
            $this->ChangeStatus(1, $iInsertOrder);
//            if ($oPaymentType->ID == 6) { // przedpłata
//                $this->ChangeStatus(1, $iInsertOrder);
//            } elseif ($oPaymentType->ID == 7) { // pobranie
//                $this->ChangeStatus(2, $iInsertOrder);
//            }
            unset($_SESSION['__customer_note']);
            return new ErrorReporting(ErrorReporting::SUCCESS, $rOrderResult, Kohana::lang('order.order_summary_ok'));
        } catch (Exception $ex) {
            $this->_rDb->query('ROLLBACK');
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('order.order_summary_error'));
        }
    }

    /**
     * Zwraca kolejny numer dla zamowienia w formie int
     * @return ErrorReporting 
     */
    private function _getNextOrderNumber($year, $month, $day) {
        try {
            $iNumber = 0;
            $oMaxNumbers = $this->_rDb
                    ->limit(1)
                    ->select('MAX(current_number) AS max_number')
                    ->getwhere(table::SHOP_ORDERS, array('current_number_year' => $year, 'current_number_month' => $month, 'current_number_day' => $day));

            if ($oMaxNumbers[0]->max_number + 0 == 0) {
                $iNumber = 1;
            } else {
                $iNumber = $oMaxNumbers[0]->max_number + 1;
            }
            $date = '';
            //$newNumber = ($oMaxNumbers[0]->max_number . '/' . join('/', array($year, $month, $day)));
            return $iNumber;
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('order.get_next_order_number_error'));
        }
    }

    /**
     *
     * @param Integer $id
     * @param array $data
     * @param array $files
     * @return ErrorReporting
     */
    public function Update($id, array $data, array $files) {
        try {
            $id += 0;
            $updateId = -1;
            $result = null;
            $this->_rDb->query('SET AUTOCOMMIT = 0');
            $this->_rDb->query('BEGIN');
            $data['available'] = !empty($data['available']) && $data['available'] == 'yes' ? 'Y' : 'N';
            $data['description'] = preg_replace('/color: ?[^;]+;/', '', $data['description']);
            $data['short_description'] = preg_replace('/color: ?[^;]+;/', '', $data['short_description']);
            $delImages = !empty($data['delImage']) ? $data['delImage'] : array();
            unset($data['submit'], $data['cancel'], $data['delImage']);
            $result = $this->_rDb->update(table::SHOP_PRODUCTS, $data, array('id' => $id));
            if (!empty($files['images'])) {
                foreach ($files['images'] as $sFKey) {
                    if ($sFKey['error'] != UPLOAD_ERR_NO_FILE) {
                        $uploadedFiles = file::upload(
                                        $sFKey, array(
                                    'unique' => true,
                                    'width' => 800,
                                    'height' => 600,
                                    'thumbwidth' => 128,
                                    'thumbheight' => 88,
                                    'path' => shop::MEDIUM_PATH,
                                    'thumbpath' => shop::SMALL_PATH
                                        )
                        );
                        $this->_rDb->insert(
                                table::SHOP_PRODUCTS_IMAGES, array(
                            'product_id' => $insertId,
                            'filename' => $uploadedFiles->Value['filename'],
                            'realfilename' => $uploadedFiles->Value['realfilename']
                                )
                        );
                    }
                }
            }
            if (!empty($delImages)) {
                foreach ($delImages as $imgName => $delete) {
                    $filePath = APPPATH . 'files/images/products/' . $imgName;
                    if (file_exists($filePath) && is_file($filePath)) {
                        if (@unlink($filePath)) {
                            echo 'Usunięto plik: ' . $imgName;
                        } else {
                            echo 'Problem z usunięciem pliku: ' . $imgName;
                        }
                    }
                    $fileThumbPath = APPPATH . 'files/images/products/thumbs/' . $imgName;
                    if (file_exists($fileThumbPath) && is_file($fileThumbPath)) {
                        if (@unlink($fileThumbPath)) {
                            echo 'Usunięto plik: ' . $imgName;
                        } else {
                            echo 'Problem z usunięciem pliku: ' . $imgName;
                        }
                    }
                    $this->_rDb->delete(table::SHOP_PRODUCTS_IMAGES, array('filename' => $imgName, 'product_id' => $id));
                }
            }
            $this->_rDb->query('COMMIT');
            return new ErrorReporting(ErrorReporting::SUCCESS, $result, '');
        } catch (Exception $ex) {
            $this->_rDb->query('ROLLBACK');
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, $ex->getMessage());
        }
    }

    /**
     *
     * @param integer $iOrderId
     * @return ErrorReporting
     */
    public function GetOrderDetails($iOrderId) {
        try {
//			return new ErrorReporting(ErrorReporting::SUCCESS, $this->_rDb
//				->select(
//                        array(
//                            'p.*, p.name AS product_name',
//                            'o.*',
//
//                         )
//                )
//                ->join(table:: . ' AS p', '', '', 'INNER')
//                ->join(table::SHOP_PRODUCTS . ' AS p', '', '', 'INNER')
//                ->join(table::SHOP_PRODUCTS . ' AS p', '', '', 'INNER')
//                ->join(table::SHOP_PRODUCTS . ' AS p', '', '', 'INNER')
//                ->from(table::SHOP_ORDERS . ' AS o', '', '', 'INNER')
//				->orderby('p.product_name')
//				->getwhere('o.id_order'), '');
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, '');
        }
    }

    /**
     * @author Filip Górczyński <a href="mailto:filip.gorczynski@gmail.com">filip.gorczynski@gmail.com</a>
     *
     * @param Integer $id
     * @return ErrorReporting
     */
    public function GetProductImages($id) {
        try {
            $id += 0;
            return new ErrorReporting(ErrorReporting::SUCCESS, $this->_rDb->getwhere(table::SHOP_PRODUCTS_IMAGES, array('product_id' => $id)), '');
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, '');
        }
    }

    /**
     * @author Filip Górczyński <a href="mailto:filip.gorczynski@gmail.com">filip.gorczynski@gmail.com</a>
     *
     * @param Integer $id
     * @return ErrorReporting
     */
    public function GetProductCategory($id) {
        try {
            $id += 0;
            return new ErrorReporting(ErrorReporting::SUCCESS, $this->_rDb->select('product_category_id')->getwhere(table::SHOP_PRODUCTS, array('id_product' => $id)), '');
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, '');
        }
    }

    /**
     * @author Filip Górczyński <a href="mailto:filip.gorczynski@gmail.com">filip.gorczynski@gmail.com</a>
     *
     * @param Integer $id
     * @return ErrorReporting
     */
    public function GetCategoryProducts($id) {
        $id += 0;
        try {
            return new ErrorReporting(ErrorReporting::SUCCESS, $this->_rDb->getwhere(table::SHOP_PRODUCTS, array('product_category_id' => $id)), Kohana::lang('product.get_product_category_success'));
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('product.get_category_products_error'));
        }
    }

    /**
     * @author Filip Górczyński <a href="mailto:filip.gorczynski@gmail.com">filip.gorczynski@gmail.com</a>
     *
     * @return ErrorReporting
     */
    public function Count($args = null, $sort = null) {
        try {
            if (!empty($args) && is_array($args) && count($args)) {
                foreach ($args as $key => $value) {
                    switch ($key) {
                        case 'status_id';
                            $this->_rDb->where(array('status_id' => $value));
                            break;
                        case 'date_order_from':
                            $this->_rDb->where(array('order_date >=' => $value));
                            break;
                        case 'date_order_to':
                            $this->_rDb->where(array('order_date <=' => $value));
                            break;
                        case 'order_number':
                            $this->_rDb->where(array('order_number' => $value));
                            break;
                    }
                }
            }

            if (!empty($sort) && is_array($sort) && count($sort)) {
                $this->_rDb->orderby($sort);
            } else {
                $this->_rDb->orderby(array('order_date' => 'DESC'));
            }
            $result = $this->_rDb->join(table::SHOP_ORDERS_STATUSES, 'id_order_status', 'status_id')
                    //->join(table::SHOP_PAYMENT_TYPES_DESCRIPTION, 'payment_type_id', 'payment_type')
                    ->count_records(table::SHOP_ORDERS);

            return new ErrorReporting(ErrorReporting::SUCCESS, $result, Kohana::lang('product.count_order_success'));
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('product.count_products_error'));
        }
    }

    /**
     * @author Filip Górczyński <a href="mailto:filip.gorczynski@gmail.com">filip.gorczynski@gmail.com</a>
     * @todo Dodać walidację w PHP
     * @param array $post
     */
    public function ValidateProductAdd(array $post) {
        return true;
        $errors = array();
        $clean = array();
        $clean['name'] = strip_tags($post['name']);
        $clean['name'] = trim($clean['name']);
        if (empty($clean['email'])) {
            $errors['email'] = Kohana::lang('product.email_can_not_be_empty');
        }
        if (empty($post['password'])) {
            $errors['password'] = Kohana::lang('product.password_can_not_be_empty');
        }
        if (!empty($post['email']) && !empty($clean['email']) && $this->UserExists($clean['email'], $clean['email'])) {
            $errors['email'] = Kohana::lang('product.email_exists');
        }
        return $errors;
    }

    /**
     *
     * @todo Dodać walidację w PHP
     * @param array $post
     */
    public function ValidateProductEdit(array $post) {
        return true;
        $errors = array();
        $clean = array();
        $clean['email'] = strip_tags($post['email']);
        $clean['email'] = trim($clean['email']);
        $clean['password'] = strip_tags($post['password']);
        $clean['password'] = trim($clean['password']);
        if (empty($clean['email'])) {
            $errors['email'] = Kohana::lang('product.email_can_not_be_empty');
        }
        if (empty($clean['role_id'])) {
            $errors['role_id'] = Kohana::lang('product.role_can_not_be_empty');
        }
        if (!empty($clean['email']) && !empty($clean['email']) && $this->UserExists($clean['email'], $clean['email'])) {
            $errors['email'] = Kohana::lang('product.email_exists');
        }
    }

    /**
     * Dodawanie danych z koszyka do sesji
     * @param <type> $aPost
     */
    public function AddStepOneToSession($aPost) {
        try {
            if (!empty($aPost['count']) && !empty($_SESSION['__cart'])) {
                foreach ($aPost['count'] as $cKey => $cValue) {
                    for ($i = 0; $i < count($_SESSION['__cart']); ++$i) {
                        if (!empty($_SESSION['__cart'][$i]['id_product']) && $_SESSION['__cart'][$i]['id_product'] == $cKey) {
                            if ($cValue <= 0) {
                                unset($_SESSION['__cart'][$i]);
                            } else {
                                $_SESSION['__cart'][$i]['count'] = $cValue;
                            }
                        }
                    }
                }
            }
            if (!empty($aPost['delivery_type_id'])) {
                $_SESSION['__delivery_type'] = $aPost['delivery_type_id'] + 0;
                $_SESSION['__delivery_cost'] = $aPost['delivery_cost'] + 0;
            }
            if (!empty($aPost['payment_type_id'])) {
                $_SESSION['__payment_type'] = $aPost['payment_type_id'] + 0;
                $_SESSION['__payment_cost'] = $aPost['payment_cost'] + 0;
            }
            if (!empty($aPost['customer_note'])) {
                $_SESSION['__customer_note'] = $aPost['customer_note'];
            }
            return new ErrorReporting(ErrorReporting::SUCCESS, true);
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . ': ' . __LINE__ . ': ' . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('order.add_step_one_to_session_error'));
        }
    }

    public function ValidateOrderStepOne($aPost) {
        try {
            $alert = '';

            $ile = 0;
            // musi byc wybrany chociaz 1 produkt
            if (!empty($aPost['count'])) {
                foreach ($aPost['count'] as $count) {
                    $ile = $ile + $count;
                }
                if ($ile <= 0) {
                    $alert .= '<li>' . Kohana::lang('order.validation.error_product_empty') . '</li>';
                } else if ($ile > 99) {
                    $alert .= '<li>' . Kohana::lang('order.validation.error_product_more_than_99') . '</li>';
                }
            }


            // trzeba wybrac sposob dostawy
            if (!isset($aPost['delivery_cost']) || empty($aPost['delivery_type_id'])) {
                $alert .= '<li>' . Kohana::lang('order.validation.error_delivery_empty') . '</li>';
            }

            // trzeba wybrac sposob platnosci
            if (empty($aPost['payment_type_id']) && !isset($aPost['payment_cost'])) {
                $alert .= '<li>' . Kohana::lang('order.validation.error_payment_empty') . '</li>';
            }

            if (!empty($alert)) {
                $alert = Kohana::lang('order.validation.following_errors') . ': <ul>' . $alert . '</ul>';
                return new ErrorReporting(ErrorReporting::ERROR, false, $alert);
            } else {
                return new ErrorReporting(ErrorReporting::SUCCESS, true);
            }
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . ': ' . __LINE__ . ': ' . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('order.validate_step_one_error'));
        }
    }

    public function AddStepTwoToSession($aPost) {
        try {
            $_SESSION['__customer']['customer']['first_name'] = $aPost['customer_first_name'];
            $_SESSION['__customer']['customer']['last_name'] = $aPost['customer_last_name'];
            $_SESSION['__customer']['customer']['customer_email'] = $aPost['customer_email'];
            $_SESSION['__customer']['customer']['customer_city'] = $aPost['customer_city'];
            $_SESSION['__customer']['customer']['customer_zip'] = $aPost['customer_zip'];
            $_SESSION['__customer']['customer']['customer_address'] = $aPost['customer_address'];
            //$_SESSION['__customer']['customer']['customer_state'] = $aPost['customer_state'];
            $_SESSION['__customer']['customer']['customer_phoneno'] = $aPost['customer_phoneno'];
            $_SESSION['__customer']['customer']['customer_country'] = $aPost['customer_country'];

            if (!empty($aPost['is_delivery_address'])) {
                $_SESSION['__customer']['is_delivery_address'] = true;
                $_SESSION['__customer']['delivery']['delivery_first_name'] = $aPost['delivery_first_name'];
                $_SESSION['__customer']['delivery']['delivery_last_name'] = $aPost['delivery_last_name'];
                $_SESSION['__customer']['delivery']['delivery_email'] = $aPost['delivery_email'];
                $_SESSION['__customer']['delivery']['delivery_company_name'] = $aPost['delivery_company_name'];
                //$_SESSION['__customer']['delivery']['delivery_nip'] = $aPost['delivery_nip'];
                $_SESSION['__customer']['delivery']['delivery_city'] = $aPost['delivery_city'];
                $_SESSION['__customer']['delivery']['delivery_zip'] = $aPost['delivery_zip'];
                $_SESSION['__customer']['delivery']['delivery_address'] = $aPost['delivery_address'];
                $_SESSION['__customer']['delivery']['delivery_state'] = $aPost['delivery_state'];
                $_SESSION['__customer']['delivery']['delivery_country'] = $aPost['delivery_country'];
                $_SESSION['__customer']['delivery']['delivery_phoneno'] = $aPost['delivery_phoneno'];
                //$_SESSION['__customer']['delivery']['delivery_faxno'] = $aPost['delivery_faxno'];
                //$_SESSION['__customer']['delivery']['delivery_mobileno'] = $aPost['delivery_mobileno'];
            } else {
                $_SESSION['__customer']['is_delivery_address'] = false;
                unset($_SESSION['__customer']['delivery']);
            }
            if (!empty($aPost['is_invoice_address'])) {
                $_SESSION['__customer']['is_invoice_address'] = true;
                $_SESSION['__customer']['invoice']['invoice_first_name'] = $aPost['invoice_first_name'];
                $_SESSION['__customer']['invoice']['invoice_last_name'] = $aPost['invoice_last_name'];
                //$_SESSION['__customer']['invoice']['invoice_email'] = $aPost['invoice_email'];
                $_SESSION['__customer']['invoice']['invoice_company_name'] = $aPost['invoice_company_name'];
                $_SESSION['__customer']['invoice']['invoice_nip'] = $aPost['invoice_nip'];
                $_SESSION['__customer']['invoice']['invoice_city'] = $aPost['invoice_city'];
                $_SESSION['__customer']['invoice']['invoice_zip'] = $aPost['invoice_zip'];
                $_SESSION['__customer']['invoice']['invoice_address'] = $aPost['invoice_address'];
                $_SESSION['__customer']['invoice']['invoice_state'] = $aPost['invoice_state'];
                $_SESSION['__customer']['invoice']['invoice_country'] = $aPost['invoice_country'];
                //$_SESSION['__customer']['invoice']['invoice_phoneno'] = $aPost['invoice_phoneno'];
                //$_SESSION['__customer']['invoice']['invoice_faxno'] = $aPost['invoice_faxno'];
                //$_SESSION['__customer']['invoice']['invoice_mobileno'] = $aPost['invoice_mobileno'];
            } else {
                $_SESSION['__customer']['is_invoice_address'] = false;
                unset($_SESSION['__customer']['invoice']);
            }
            return new ErrorReporting(ErrorReporting::SUCCESS, true);
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . ': ' . __LINE__ . ': ' . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('order.add_step_two_to_session_error'));
        }
    }

    /**
     * Walidacja dla kroku drugiego (adres dostawy)
     * @todo Dodac walidacje dla kodu pocztowego i danych do faktury oraz innego adresu do wysylki
     * @param Array $aPost
     * @return ErrorReporting  (Bool true || Bool false)
     */
    public function ValidateOrderStepTwo($aPost) {
        try {
            $alert = '';

            //Imie nie mozebyc puste
            if (empty($aPost['customer_first_name'])) {
                $alert .= '<li>' . Kohana::lang('order.validation.error_customer_first_name_empty') . '</li>';
            }
            //Nazwisko nie mozebyc puste
            if (empty($aPost['customer_last_name'])) {
                $alert .= '<li>' . Kohana::lang('order.validation.error_customer_last_name_empty') . '</li>';
            }
            //Email nie mozebyc pusty
            if (empty($aPost['customer_email'])) {
                $alert .= '<li>' . Kohana::lang('order.validation.error_customer_email_empty') . '</li>';
            } else if (!layer::ValidateMail($aPost['customer_email'])) { // email musi miec prawidłowy format
                $alert .= '<li>' . Kohana::lang('order.validation.error_customer_email_format') . '</li>';
            }
            //Miasto nie mozebyc puste
            if (empty($aPost['customer_city'])) {
                $alert .= '<li>' . Kohana::lang('order.validation.error_customer_city_empty') . '</li>';
            }
            //Kod pocztowy nie mozebyc pusty
            if (empty($aPost['customer_zip'])) {
                $alert .= '<li>' . Kohana::lang('order.validation.error_customer_zip_empty') . '</li>';
            }
            //adres nie mozebyc pusty
            if (empty($aPost['customer_address'])) {
                $alert .= '<li>' . Kohana::lang('order.validation.error_customer_address_empty') . '</li>';
            }
            //nr telefonu nie mozebyc pusty
            if (empty($aPost['customer_phoneno'])) {
                $alert .= '<li>' . Kohana::lang('order.validation.error_customer_phoneno_empty') . '</li>';
            } else if (strlen($aPost['customer_phoneno']) > 18) { // nie moze byc dluzszy niz 18 znakow
                $alert .= '<li>' . Kohana::lang('order.validation.error_customer_phoneno_too_long') . '</li>';
            } else if (strlen($aPost['customer_phoneno']) < 9) { // nie mozebyc krotszy niz 9 znakow
                $alert .= '<li>' . Kohana::lang('order.validation.error_customer_phoneno_too_short') . '</li>';
            } else if (valid::phone($aPost['customer_phoneno']) != true) { // musi miec prawidłowy format
                $alert .= '<li>' . Kohana::lang('order.validation.error_customer_phoneno') . '</li>';
            }

            // walidacja innego adresu dostawy
            if (!empty($aPost['is_delivery_address'])) {
                //Imie nie mozebyc puste
                if (empty($aPost['delivery_first_name'])) {
                    $alert .= '<li>' . Kohana::lang('order.validation.error_delivery_first_name_empty') . '</li>';
                }
                //Nazwisko nie mozebyc puste
                if (empty($aPost['delivery_last_name'])) {
                    $alert .= '<li>' . Kohana::lang('order.validation.error_delivery_last_name_empty') . '</li>';
                }
                //Email nie mozebyc pusty
                if (empty($aPost['delivery_email'])) {
                    $alert .= '<li>' . Kohana::lang('order.validation.error_delivery_email_empty') . '</li>';
                } else if (!layer::ValidateMail($aPost['delivery_email'])) {
                    $alert .= '<li>' . Kohana::lang('order.validation.error_delivery_email_format') . '</li>';
                }
                //Miasto nie mozebyc puste
                if (empty($aPost['delivery_city'])) {
                    $alert .= '<li>' . Kohana::lang('order.validation.error_delivery_city_empty') . '</li>';
                }
                //Kod pocztowy nie mozebyc pusty
                if (empty($aPost['delivery_zip'])) {
                    $alert .= '<li>' . Kohana::lang('order.validation.error_delivery_zip_empty') . '</li>';
                }
                //adres nie mozebyc pusty
                if (empty($aPost['delivery_address'])) {
                    $alert .= '<li>' . Kohana::lang('order.validation.error_delivery_address_empty') . '</li>';
                }
                // Company name
//                if (empty($aPost['delivery_company_name'])) {
//                    $alert .= '<li>' . Kohana::lang('order.validation.error_delivery_company_name_empty') . '</li>';
//                }
                // Country
//                if (empty($aPost['delivery_country'])) {
//                    $alert .= '<li>' . Kohana::lang('order.validation.error_delivery_country_empty') . '</li>';
//                }
                // phone_no
                if (empty($aPost['delivery_phoneno'])) {
                    $alert .= '<li>' . Kohana::lang('order.validation.error_delivery_phoneno_empty') . '</li>';
                } else if (strlen($aPost['delivery_phoneno']) > 18) {
                    $alert .= '<li>' . Kohana::lang('order.validation.error_delivery_phoneno_too_long') . '</li>';
                } else if (strlen($aPost['delivery_phoneno']) < 9) {
                    $alert .= '<li>' . Kohana::lang('order.validation.error_delivery_phoneno_too_short') . '</li>';
                } else if (valid::phone($aPost['delivery_phoneno']) != true) {
                    $alert .= '<li>' . Kohana::lang('order.validation.error_delivery_phoneno') . '</li>';
                }
            }

            // walidacja danych do faktury
            if (!empty($aPost['is_invoice_address'])) {
                //Imie nie mozebyc puste
                if (empty($aPost['invoice_first_name'])) {
                    $alert .= '<li>' . Kohana::lang('order.validation.error_invoice_first_name_empty') . '</li>';
                }
                //Nazwisko nie mozebyc puste
                if (empty($aPost['invoice_last_name'])) {
                    $alert .= '<li>' . Kohana::lang('order.validation.error_invoice_last_name_empty') . '</li>';
                }
                //Email nie mozebyc pusty
//                if (empty($aPost['invoice_email'])) {
//                    $alert .= '<li>' . Kohana::lang('order.validation.error_invoice_email_empty') . '</li>';
//                } else if (!layer::ValidateMail($aPost['invoice_email'])) {
//                    $alert .= '<li>' . Kohana::lang('order.validation.error_invoice_email_format') . '</li>';
//                }
                //Miasto nie mozebyc puste
                if (empty($aPost['invoice_city'])) {
                    $alert .= '<li>' . Kohana::lang('order.validation.error_invoice_city_empty') . '</li>';
                }
                //Kod pocztowy nie mozebyc pusty
                if (empty($aPost['invoice_zip'])) {
                    $alert .= '<li>' . Kohana::lang('order.validation.error_invoice_zip_empty') . '</li>';
                }
                //adres nie mozebyc pusty
                if (empty($aPost['invoice_address'])) {
                    $alert .= '<li>' . Kohana::lang('order.validation.error_invoice_address_empty') . '</li>';
                }
                // NIP
                if (empty($aPost['invoice_nip'])) {
                    $alert .= '<li>' . Kohana::lang('order.validation.error_invoice_nip_empty') . '</li>';
                }
                // Company name
                if (empty($aPost['invoice_company_name'])) {
                    $alert .= '<li>' . Kohana::lang('order.validation.error_invoice_company_name_empty') . '</li>';
                }
                // Country
//                if (empty($aPost['invoice_country'])) {
//                    $alert .= '<li>' . Kohana::lang('order.validation.error_invoice_country_empty') . '</li>';
//                }
            }

            if (!empty($alert)) {
                $alert = Kohana::lang('order.validation.following_errors') . ': <ul>' . $alert . '</ul>';
                return new ErrorReporting(ErrorReporting::ERROR, false, $alert);
            } else {
                return new ErrorReporting(ErrorReporting::SUCCESS, true);
            }
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . ': ' . __LINE__ . ': ' . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('order.validate_step_one_error'));
        }
    }

    /**
     * Pobieranie produktow dla zamowienia
     * @param Array $aWhere
     * @return ErrorReporting (MySQL Result $result || Bool)
     */
    public function GetOrderProducts($aWhere) {
        try {
            $result = $this->_rDb->from(table::SHOP_ORDERS_PRODUCTS . ' AS sop')
                    ->join(table::SHOP_PRODUCTS_DESCRIPTION . ' AS spd', 'spd.product_id', 'sop.product_id')
                    ->join(table::SHOP_PRODUCTS_IMAGES . ' AS spi', 'spi.product_id', 'sop.product_id', 'LEFT')
                    ->where($aWhere)
                    ->groupby('sop.product_id')
                    ->get();
            return new ErrorReporting(ErrorReporting::SUCCESS, $result);
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . ': ' . __LINE__ . ': ' . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('order.get_order_products_error'));
        }
    }

    public function GetOrderProducts2($id) {
        try {
            $result = $this->_rDb->from(table::SHOP_ORDERS_PRODUCTS . ' AS sop')
                    ->join(table::SHOP_PRODUCTS_DESCRIPTION . ' AS spd', 'spd.product_id', 'sop.product_id')
                    ->join(table::SHOP_PRODUCTS_IMAGES . ' AS spi', 'spi.product_id', 'sop.product_id', 'LEFT')
                    ->where(array('order_id' => $id, 'spd.product_language' => Kohana::config('locale.language')))
                    //->groupby('sop.product_id')
                    ->get();
            return new ErrorReporting(ErrorReporting::SUCCESS, $result);
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . ': ' . __LINE__ . ': ' . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('order.get_order_products_error'));
        }
    }

    public function ConfirmOrder($sEmail, $sConfirmationString, $iOrderId) {
        try {
            $result = $this->_rDb->update(table::SHOP_ORDERS, array('confirmed' => 'Y', 'confirmation_date' => TIME), array('confirm_email' => $sEmail, 'confirm_string' => $sConfirmationString, 'id_order' => $iOrderId));
            if ($result->count() > 0) {
                return new ErrorReporting(ErrorReporting::SUCCESS, $result, Kohana::lang('order.order_confirmed'));
            } else {
                return new ErrorReporting(ErrorReporting::ERROR, $result, Kohana::lang('order.cant_confirm_order'));
            }
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . ':' . __LINE__ . ':' . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('order.get_order_products_error'));
        }
    }

    public function GetTransactionError($iErrorNo) {
        switch ($iErrorNo) {
            case App_Orders_Controller::ERR_STATUS_NO_OR_WRONG_POS_ID:
                return Kohana::lang('order.ERR_STATUS_NO_OR_WRONG_POS_ID');
                break;
            case App_Orders_Controller::ERR_STATUS_NO_SESS_ID:
                return Kohana::lang('order.ERR_STATUS_NO_SESS_ID');
                break;
            case App_Orders_Controller::ERR_STATUS_NO_TS:
                return Kohana::lang('order.ERR_STATUS_NO_TS');
                break;
            case App_Orders_Controller::ERR_STATUS_NO_OR_WRONG_SIG:
                return Kohana::lang('order.ERR_STATUS_NO_OR_WRONG_SIG');
                break;
            case App_Orders_Controller::ERR_STATUS_NO_DESC:
                return Kohana::lang('order.ERR_STATUS_NO_DESC');
                break;
            case App_Orders_Controller::ERR_STATUS_NO_CLIENT_IP:
                return Kohana::lang('order.ERR_STATUS_NO_CLIENT_IP');
                break;
            case App_Orders_Controller::ERR_STATUS_NO_FIRST_NAME:
                return Kohana::lang('order.ERR_STATUS_NO_FIRST_NAME');
                break;
            case App_Orders_Controller::ERR_STATUS_NO_LAST_NAME:
                return Kohana::lang('order.ERR_STATUS_NO_LAST_NAME');
                break;
            case App_Orders_Controller::ERR_STATUS_NO_STREET:
                return Kohana::lang('order.ERR_STATUS_NO_STREET');
                break;
            case App_Orders_Controller::ERR_STATUS_NO_CITY:
                return Kohana::lang('order.ERR_STATUS_NO_CITY');
                break;
            case App_Orders_Controller::ERR_STATUS_NO_POST_CODE:
                return Kohana::lang('order.ERR_STATUS_NO_POST_CODE');
                break;
            case App_Orders_Controller::ERR_STATUS_NO_AMOUNT:
                return Kohana::lang('order.ERR_STATUS_NO_AMOUNT');
                break;
            case App_Orders_Controller::ERR_STATUS_WRONG_ACC_NO:
                return Kohana::lang('order.ERR_STATUS_WRONG_ACC_NO');
                break;
            case App_Orders_Controller::ERR_STATUS_NO_EMAIL:
                return Kohana::lang('order.ERR_STATUS_NO_EMAIL');
                break;
            case App_Orders_Controller::ERR_STATUS_NO_PHONE_NO:
                return Kohana::lang('order.ERR_STATUS_NO_PHONE_NO');
                break;
            case App_Orders_Controller::ERR_STATUS_OTHER_ERR:
                return Kohana::lang('order.ERR_STATUS_OTHER_ERR');
                break;
            case App_Orders_Controller::ERR_STATUS_OTHER_DB_ERR:
                return Kohana::lang('order.ERR_STATUS_OTHER_DB_ERR');
                break;
            case App_Orders_Controller::ERR_STATUS_POS_BLOCKED:
                return Kohana::lang('order.ERR_STATUS_POS_BLOCKED');
                break;
            case App_Orders_Controller::ERR_STATUS_WRONG_PAY_TYPE:
                return Kohana::lang('order.ERR_STATUS_WRONG_PAY_TYPE');
                break;
            case App_Orders_Controller::ERR_STATUS_PAY_TYPE_BLOCKED:
                return Kohana::lang('order.ERR_STATUS_PAY_TYPE_BLOCKED');
                break;
            case App_Orders_Controller::ERR_STATUS_PAY_AMOUNT_LT_MIN:
                return Kohana::lang('order.ERR_STATUS_PAY_AMOUNT_LT_MIN');
                break;
            case App_Orders_Controller::ERR_STATUS_PAY_AMOUNT_GT_MAX:
                return Kohana::lang('order.ERR_STATUS_PAY_AMOUNT_GT_MAX');
                break;
            case App_Orders_Controller::ERR_STATUS_TOO_MUCH_TRANSACTION_PER_CLIENT:
                return Kohana::lang('order.ERR_STATUS_TOO_MUCH_TRANSACTION_PER_CLIENT');
                break;
            case App_Orders_Controller::ERR_STATUS_NEED_EXPRESS_PAYMENT:
                return Kohana::lang('order.ERR_STATUS_NEED_EXPRESS_PAYMENT');
                break;
            case App_Orders_Controller::ERR_STATUS_WRONG_POS_ID_OR_POS_AUTH_KEY:
                return Kohana::lang('order.ERR_STATUS_WRONG_POS_ID_OR_POS_AUTH_KEY');
                break;
            case App_Orders_Controller::ERR_STATUS_TRANSACT_DOES_NOT_EXISTS:
                return Kohana::lang('order.ERR_STATUS_TRANSACT_DOES_NOT_EXISTS');
                break;
            case App_Orders_Controller::ERR_STATUS_NO_AUTHORIZATION:
                return Kohana::lang('order.ERR_STATUS_NO_AUTHORIZATION');
                break;
            case App_Orders_Controller::ERR_STATUS_TRANSACTION_STARTED_EARLIER:
                return Kohana::lang('order.ERR_STATUS_TRANSACTION_STARTED_EARLIER');
                break;
            case App_Orders_Controller::ERR_STATUS_AUTHORIZATION_HAS_BEEN_MADE:
                return Kohana::lang('order.ERR_STATUS_AUTHORIZATION_HAS_BEEN_MADE');
                break;
            case App_Orders_Controller::ERR_STATUS_TRANSACTION_CANCELLED:
                return Kohana::lang('order.ERR_STATUS_TRANSACTION_CANCELLED');
                break;
            case App_Orders_Controller::ERR_STATUS_TRANSACTION_GET_OVER_TO_GET_EARLIER:
                return Kohana::lang('order.ERR_STATUS_TRANSACTION_GET_OVER_TO_GET_EARLIER');
                break;
            case App_Orders_Controller::ERR_STATUS_TRANSACTION_GETTED_OVER:
                return Kohana::lang('order.ERR_STATUS_TRANSACTION_GETTED_OVER');
                break;
            case App_Orders_Controller::ERR_STATUS_RETURNING_COSTS_TO_CLIENT:
                return Kohana::lang('order.ERR_STATUS_RETURNING_COSTS_TO_CLIENT');
                break;
            case App_Orders_Controller::ERR_STATUS_WRONG_STATE:
                return Kohana::lang('order.ERR_STATUS_WRONG_STATE');
                break;
            case App_Orders_Controller::ERR_STATUS_CRITICAL:
                return Kohana::lang('order.ERR_STATUS_CRITICAL');
                break;
            default:
                return Kohana::lang('order.transaction_error');
                break;
        }
    }

    /**
     *
     * @param string $sField
     * @return string
     */
    /* public function __get($sField) {
      $retValue = '';
      switch ($sField) {
      case 'ID':
      $retValue = $this->_iOrderId;
      break;
      case 'OrderNumber':
      $retValue = $this->_sOrderNumber;
      break;
      case 'CurrentNumber':
      $retValue = $this->_sCurrentNumber;
      break;
      case 'CurrentNumberYear':
      $retValue = $this->_iCurrentNumberYear;
      break;
      case 'CurrentNumberMonth':
      $retValue = $this->_iCurrentNumberMonth;
      break;
      case 'CurrentNumberDay':
      $retValue = $this->_iCurrentNumberDay;
      break;
      case 'OrderDate':
      $retValue = $this->_iOrderDate;
      break;
      case 'StatusID':
      $retValue = $this->_iStatusId;
      break;
      case 'PaymentTypeID':
      $retValue = $this->_iPaymentType;
      break;
      case 'PaymentCost':
      $retValue = $this->_dPaymentCost;
      break;
      case 'DeliveryTypeID':
      $retValue = $this->_iDeliveryType;
      break;
      case 'DeliveryCost':
      $retValue = $this->_dDeliveryCost;
      break;
      case 'OrderCost':
      $retValue = $this->_dOrderCost;
      break;
      case 'ProductsCost':
      $retValue = $this->_dProductsCost;
      break;
      case 'CustomersNote':
      $retValue = $this->_sClientsNote;
      break;
      case 'Invoice':
      $retValue = $this->_eInvoice;
      break;
      case 'CustomerIP':
      $retValue = $this->_sCustomerIP;
      break;
      case 'AdditionalCost':
      $retValue = $this->_fAdditionalCost;
      break;
      case 'Confirmation':
      $retValue = $this->_eConfirmation;
      break;
      case 'ConfirmationDate':
      $retValue = $this->_sConfirmationDate;
      break;
      case 'Paid':
      $retValue = $this->_ePaid;
      break;
      case 'Closed':
      $retValue = $this->_eClosed;
      break;
      case 'SellersNote':
      $retValue = $this->_sSellerNote;
      break;
      case 'Confirmed':
      $retValue = $this->_eConfirmed;
      break;
      case 'ConfirmString':
      $retValue = $this->_sConfirmString;
      break;
      case 'ConfirmEmail':
      $retValue = $this->_sConfirmEmail;
      break;
      case 'CustomerID':
      $retValue = $this->_iCustomerId;
      break;
      case 'CustomerFirstName':
      $retValue = $this->_aCustomer['customer_first_name'];
      break;
      case 'CustomerLastName':
      $retValue = $this->_aCustomer['customer_last_name'];
      break;
      case 'CustomerEmail':
      $retValue = $this->_aCustomer['customer_email'];
      break;
      case 'CustomerCompanyName':
      $retValue = $this->_aCustomer['customer_company_name'];
      break;
      case 'CustomerNIP':
      $retValue = $this->_aCustomer['customer_nip'];
      break;
      case 'CustomerCity':
      $retValue = $this->_aCustomer['customer_city'];
      break;
      case 'CustomerZip':
      $retValue = $this->_aCustomer['customer_zip'];
      break;
      case 'CustomerAddress':
      $retValue = $this->_aCustomer['customer_address'];
      break;
      case 'CustomerState':
      $retValue = $this->_aCustomer['customer_state'];
      break;
      case 'CustomerCountry':
      $retValue = $this->_aCustomer['customer_country'];
      break;
      case 'CustomerWWW':
      $retValue = $this->_aCustomer['customer_www'];
      break;
      case 'CustomerPhoneNo':
      $retValue = $this->_aCustomer['customer_phoneno'];
      break;
      case 'CustomerFaxNo':
      $retValue = $this->_aCustomer['customer_faxno'];
      break;
      case 'CustomerMobileNo':
      $retValue = $this->_aCustomer['customer_mobileno'];
      break;
      case 'CustomerDeliveryMail':
      $retValue = $this->_aCustomer['delivery_email'];
      break;
      case 'DeliveryFirstName':
      $retValue = $this->_aCustomer['delivery_first_name'];
      break;
      case 'DeliveryLastName':
      $retValue = $this->_aCustomer['delivery_last_name'];
      break;
      case 'DeliveryCompanyName':
      $retValue = $this->_aCustomer['delivery_company_name'];
      break;
      case 'DeliveryNIP':
      $retValue = $this->_aCustomer['delivery_nip'];
      break;
      case 'DeliveryCity':
      $retValue = $this->_aCustomer['delivery_city'];
      break;
      case 'DeliveryZip':
      $retValue = $this->_aCustomer['delivery_zip'];
      break;
      case 'DeliveryAddress':
      $retValue = $this->_aCustomer['delivery_address'];
      break;
      case 'DeliveryState':
      $retValue = $this->_aCustomer['delivery_state'];
      break;
      case 'DeliveryCountry':
      $retValue = $this->_aCustomer['delivery_country'];
      break;
      case 'DeliveryWWW':
      $retValue = $this->_aCustomer['delivery_www'];
      break;
      case 'DeliveryPhoneNo':
      $retValue = $this->_aCustomer['delivery_phoneno'];
      break;
      case 'DeliveryFaxNo':
      $retValue = $this->_aCustomer['delivery_faxno'];
      break;
      case 'DeliveryMobileNo':
      $retValue = $this->_aCustomer['delivery_mobileno'];
      break;
      case 'InvoiceEmail':
      $retValue = $this->_aCustomer['invoice_email'];
      break;
      case 'InvoiceFirstName':
      $retValue = $this->_aCustomer['invoice_first_name'];
      break;
      case 'InvoiceLastName':
      $retValue = $this->_aCustomer['invoice_last_name'];
      break;
      case 'InvoiceCompanyName':
      $retValue = $this->_aCustomer['invoice_company_name'];
      break;
      case 'InvoiceCity':
      $retValue = $this->_aCustomer['invoice_city'];
      break;
      case 'InvoiceZip':
      $retValue = $this->_aCustomer['invoice_zip'];
      break;
      case 'InvoiceAddress':
      $retValue = $this->_aCustomer['invoice_address'];
      break;
      case 'InvoiceState':
      $retValue = $this->_aCustomer['invoice_state'];
      break;
      case 'InvoiceCountry':
      $retValue = $this->_aCustomer['invoice_country'];
      break;
      case 'InvoiceWWW':
      $retValue = $this->_aCustomer['invoice_www'];
      break;
      case 'InvoicePhoneNo':
      $retValue = $this->_aCustomer['invoice_phoneno'];
      break;
      case 'InvoiceFaxNo':
      $retValue = $this->_aCustomer['invoice_faxno'];
      break;
      case 'InvoiceMobileNo':
      $retValue = $this->_aCustomer['invoice_mobileno'];
      break;
      case 'InvoiceRebate':
      $retValue = $this->_aCustomer['customer_rebate'];
      break;
      case 'DeliveryCost':
      $retValue = $this->_aDelivery['delivery_cost'];
      break;
      case 'PaymentCost':
      $retValue = $this->_aPayment['payment_cost'];
      break;
      case 'PaymentType':
      $retValue = $this->_aPayment['payment_type'];
      break;
      case 'Payment':
      $retValue = $this->_aPayment;
      break;
      default:
      $retValue = null;
      }
      return $retValue;
      }
     */

    /**
     *
     * @param string $sField
     * @param mixed $mValue
     * @return mixed
     */
    /* public function __set($sField, $mValue) {
      $retValue = null;
      switch ($sField) {
      case 'ID':
      $this->_iOrderId = $mValue;
      break;
      case 'CustomerID':
      $this->_aCustomer['id_customer'] = $mValue;
      break;
      case 'CustomerFirstName':
      $this->_aCustomer['customer_first_name'] = $mValue;
      break;
      case 'CustomerLastName':
      $this->_aCustomer['customer_last_name'] = $mValue;
      break;
      case 'CustomerEmail':
      $this->_aCustomer['customer_email'] = $mValue;
      break;
      case 'CustomerCompanyName':
      $this->_aCustomer['customer_company_name'] = $mValue;
      break;
      case 'CustomerNIP':
      $this->_aCustomer['customer_nip'] = $mValue;
      break;
      case 'CustomerCity':
      $this->_aCustomer['customer_city'] = $mValue;
      break;
      case 'CustomerZip':
      $this->_aCustomer['customer_zip'] = $mValue;
      break;
      case 'CustomerAddress':
      $this->_aCustomer['customer_address'] = $mValue;
      break;
      case 'CustomerState':
      $this->_aCustomer['customer_state'] = $mValue;
      break;
      case 'CustomerCountry':
      $this->_aCustomer['customer_country'] = $mValue;
      break;
      case 'CustomerWWW':
      $this->_aCustomer['customer_www'] = $mValue;
      break;
      case 'CustomerPhoneNo':
      $this->_aCustomer['customer_phoneno'] = $mValue;
      break;
      case 'CustomerFaxNo':
      $this->_aCustomer['customer_faxno'] = $mValue;
      break;
      case 'CustomerMobileNo':
      $this->_aCustomer['customer_mobileno'] = $mValue;
      break;
      case 'CustomerDeliveryMail':
      $this->_aCustomer['delivery_email'] = $mValue;
      break;
      case 'DeliveryFirstName':
      $this->_aCustomer['delivery_first_name'] = $mValue;
      break;
      case 'DeliveryLastName':
      $this->_aCustomer['delivery_last_name'] = $mValue;
      break;
      case 'DeliveryCompanyName':
      $this->_aCustomer['delivery_company_name'] = $mValue;
      break;
      case 'DeliveryNIP':
      $this->_aCustomer['delivery_nip'] = $mValue;
      break;
      case 'DeliveryCity':
      $this->_aCustomer['delivery_city'] = $mValue;
      break;
      case 'DeliveryZip':
      $this->_aCustomer['delivery_zip'] = $mValue;
      break;
      case 'DeliveryAddress':
      $this->_aCustomer['delivery_address'] = $mValue;
      break;
      case 'DeliveryState':
      $this->_aCustomer['delivery_state'] = $mValue;
      break;
      case 'DeliveryCountry':
      $this->_aCustomer['delivery_country'] = $mValue;
      break;
      case 'DeliveryWWW':
      $this->_aCustomer['delivery_www'] = $mValue;
      break;
      case 'DeliveryPhoneNo':
      $this->_aCustomer['delivery_phoneno'] = $mValue;
      break;
      case 'DeliveryFaxNo':
      $this->_aCustomer['delivery_faxno'] = $mValue;
      break;
      case 'DeliveryMobileNo':
      $this->_aCustomer['delivery_mobileno'] = $mValue;
      break;
      case 'InvoiceEmail':
      $this->_aCustomer['invoice_email'] = $mValue;
      break;
      case 'InvoiceFirstName':
      $this->_aCustomer['invoice_first_name'] = $mValue;
      break;
      case 'InvoiceLastName':
      $this->_aCustomer['invoice_last_name'] = $mValue;
      break;
      case 'InvoiceCompanyName':
      $this->_aCustomer['invoice_company_name'] = $mValue;
      break;
      case 'InvoiceCity':
      $this->_aCustomer['invoice_city'] = $mValue;
      break;
      case 'InvoiceZip':
      $this->_aCustomer['invoice_zip'] = $mValue;
      break;
      case 'InvoiceAddress':
      $this->_aCustomer['invoice_address'] = $mValue;
      break;
      case 'InvoiceState':
      $this->_aCustomer['invoice_state'] = $mValue;
      break;
      case 'InvoiceCountry':
      $this->_aCustomer['invoice_country'] = $mValue;
      break;
      case 'InvoiceWWW':
      $this->_aCustomer['invoice_www'] = $mValue;
      break;
      case 'InvoicePhoneNo':
      $this->_aCustomer['invoice_phoneno'] = $mValue;
      break;
      case 'InvoiceFaxNo':
      $this->_aCustomer['invoice_faxno'] = $mValue;
      break;
      case 'InvoiceMobileNo':
      $this->_aCustomer['invoice_mobileno'] = $mValue;
      break;
      case 'InvoiceRebate':
      $this->_aCustomer['customer_rebate'] = $mValue;
      break;
      case 'DeliveryCost':
      $this->_aDelivery['delivery_cost'] = $mValue;
      break;
      case 'PaymentCost':
      $this->_aPayment['payment_cost'] = $mValue;
      break;
      case 'PaymentType':
      $this->_aPayment['payment_type'] = $mValue;
      break;
      case 'ConfirmString':
      $this->_sConfirmString = $mValue;
      break;
      case 'ConfirmEmail':
      $this->_sConfirmEmail = $mValue;
      break;
      default:
      return $mValue;
      }
      return $mValue;
      }
     */

    /**
     *
     * @param array $aPost
     * @return ErrorReporting
     */
    public function ValidateOrder(array $aPost = array()) {
        try {
            $alert = '';
            $aCheck = array('customer_email' => $aPost['customer_email']);
            $oExistCheck = $this->_Exists($aCheck);

            if (empty($_POST['delivery_options'])) {
                $alert .= '<li>' . Kohana::lang('order.validation.error_delivery_empty') . '</li>';
            }
            //Imie nie mozebyc puste
            if (empty($aPost['customer_first_name']) || strlen(trim($_POST['customer_first_name'])) < 3) {
                $alert .= '<li>' . Kohana::lang('order.validation.error_customer_first_name_empty') . '</li>';
            }
            //Nazwisko nie mozebyc puste
            if (empty($aPost['customer_last_name']) || strlen(trim($_POST['customer_last_name'])) < 3) {
                $alert .= '<li>' . Kohana::lang('order.validation.error_customer_last_name_empty') . '</li>';
            }
            //Email nie mozebyc pusty
            if (empty($aPost['customer_email'])) {
                $alert .= '<li>' . Kohana::lang('order.validation.error_customer_email_empty') . '</li>';
            } else if (!layer::ValidateMail($aPost['customer_email'])) { // email musi miec prawidłowy format
                $alert .= '<li>' . Kohana::lang('order.validation.error_customer_email_format') . '</li>';
            }
            //Miasto nie mozebyc puste
            if (empty($aPost['customer_city']) || strlen(trim($_POST['customer_city'])) < 3) {
                $alert .= '<li>' . Kohana::lang('order.validation.error_customer_city_empty') . '</li>';
            }
            //Kod pocztowy nie mozebyc pusty
            if (empty($aPost['customer_zip']) || strlen(trim($_POST['customer_zip'])) < 3) {
                $alert .= '<li>' . Kohana::lang('order.validation.error_customer_zip_empty') . '</li>';
            }
            //adres nie mozebyc pusty
            if (empty($aPost['customer_address']) || strlen(trim($_POST['customer_address'])) < 3) {
                $alert .= '<li>' . Kohana::lang('order.validation.error_customer_address_empty') . '</li>';
            }

            //nr telefonu nie mozebyc pusty
            if (empty($aPost['customer_phoneno'])) {
                $alert .= '<li>' . Kohana::lang('order.validation.error_customer_phoneno_empty') . '</li>';
            } else if (strlen($aPost['customer_phoneno']) > 18) { // nie moze byc dluzszy niz 18 znakow
                $alert .= '<li>' . Kohana::lang('order.validation.error_customer_phoneno_too_long') . '</li>';
            } else if (valid::phone($aPost['customer_phoneno']) != true) { // musi miec prawidłowy format
                $alert .= '<li>' . Kohana::lang('order.validation.error_customer_phoneno') . '</li>';
            }
            if (empty($aPost['customer_reg_accept']) || $aPost['customer_reg_accept'] != 'confirmed') {
                $alert .= '<li>' . Kohana::lang('customer.validation.error_reg_not_confirmed') . '</li>';
            }
            if (empty($aPost['customer_reg_accept2']) || $aPost['customer_reg_accept2'] != 'confirmed') {
                $alert .= '<li>' . Kohana::lang('customer.validation.error_reg_not_confirmed2') . '</li>';
            }

            // walidacja innego adresu dostawy
            if (!empty($aPost['is_delivery_address'])) {
                //Imie nie mozebyc puste
                if (empty($aPost['delivery_first_name']) || strlen(trim($_POST['delivery_first_name'])) < 3) {
                    $alert .= '<li>' . Kohana::lang('order.validation.error_delivery_first_name_empty') . '</li>';
                }
                //Nazwisko nie mozebyc puste
                if (empty($aPost['delivery_last_name']) || strlen(trim($_POST['delivery_last_name'])) < 3) {
                    $alert .= '<li>' . Kohana::lang('order.validation.error_delivery_last_name_empty') . '</li>';
                }
                //Email nie mozebyc pusty
                if (empty($aPost['delivery_email'])) {
                    $alert .= '<li>' . Kohana::lang('order.validation.error_delivery_email_empty') . '</li>';
                } else if (!layer::ValidateMail($aPost['delivery_email'])) {
                    $alert .= '<li>' . Kohana::lang('order.validation.error_delivery_email_format') . '</li>';
                }
                //Miasto nie mozebyc puste
                if (empty($aPost['delivery_city']) || strlen(trim($_POST['delivery_city'])) < 3) {
                    $alert .= '<li>' . Kohana::lang('order.validation.error_delivery_city_empty') . '</li>';
                }
                //Kod pocztowy nie mozebyc pusty
                if (empty($aPost['delivery_zip']) || strlen(trim($_POST['delivery_zip'])) < 3) {
                    $alert .= '<li>' . Kohana::lang('order.validation.error_delivery_zip_empty') . '</li>';
                }
                //adres nie mozebyc pusty
                if (empty($aPost['delivery_address']) || strlen(trim($_POST['delivery_address'])) < 3) {
                    $alert .= '<li>' . Kohana::lang('order.validation.error_delivery_address_empty') . '</li>';
                }
                // Company name
//                if (empty($aPost['delivery_company_name'])) {
//                    $alert .= '<li>' . Kohana::lang('order.validation.error_delivery_company_name_empty') . '</li>';
//                }
                // Country
//                if (empty($aPost['delivery_country'])) {
//                    $alert .= '<li>' . Kohana::lang('order.validation.error_delivery_country_empty') . '</li>';
//                }
                // phone_no
                if (empty($aPost['delivery_phoneno'])) {
                    $alert .= '<li>' . Kohana::lang('order.validation.error_delivery_phoneno_empty') . '</li>';
                } else if (strlen($aPost['delivery_phoneno']) > 18) {
                    $alert .= '<li>' . Kohana::lang('order.validation.error_delivery_phoneno_too_long') . '</li>';
                } else if (strlen($aPost['delivery_phoneno']) < 9) {
                    $alert .= '<li>' . Kohana::lang('order.validation.error_delivery_phoneno_too_short') . '</li>';
                } else if (valid::phone($aPost['delivery_phoneno']) != true) {
                    $alert .= '<li>' . Kohana::lang('order.validation.error_delivery_phoneno') . '</li>';
                }
            }
            /*
              // walidacja danych do faktury
              if (!empty($aPost['is_invoice_address'])) {
              //Imie nie mozebyc puste
              if (empty($aPost['invoice_first_name']) || strlen(trim($_POST['invoice_first_name'])) < 3) {
              $alert .= '<li>' . Kohana::lang('order.validation.error_invoice_first_name_empty') . '</li>';
              }
              //Nazwisko nie mozebyc puste
              if (empty($aPost['invoice_last_name']) || strlen(trim($_POST['invoice_last_name'])) < 3) {
              $alert .= '<li>' . Kohana::lang('order.validation.error_invoice_last_name_empty') . '</li>';
              }
              //Email nie mozebyc pusty
              //                if (empty($aPost['invoice_email'])) {
              //                    $alert .= '<li>' . Kohana::lang('order.validation.error_invoice_email_empty') . '</li>';
              //                } else if (!layer::ValidateMail($aPost['invoice_email'])) {
              //                    $alert .= '<li>' . Kohana::lang('order.validation.error_invoice_email_format') . '</li>';
              //                }
              //Miasto nie mozebyc puste
              if (empty($aPost['invoice_city']) || strlen(trim($_POST['invoice_city'])) < 3) {
              $alert .= '<li>' . Kohana::lang('order.validation.error_invoice_city_empty') . '</li>';
              }
              //Kod pocztowy nie mozebyc pusty
              if (empty($aPost['invoice_zip']) || strlen(trim($_POST['invoice_zip'])) < 3) {
              $alert .= '<li>' . Kohana::lang('order.validation.error_invoice_zip_empty') . '</li>';
              }
              //adres nie mozebyc pusty
              if (empty($aPost['invoice_address']) || strlen(trim($_POST['invoice_address'])) < 3) {
              $alert .= '<li>' . Kohana::lang('order.validation.error_invoice_address_empty') . '</li>';
              }
              // NIP
              if (empty($aPost['invoice_nip'])) {
              $alert .= '<li>' . Kohana::lang('order.validation.error_invoice_nip_empty') . '</li>';
              }
              // Company name
              if (empty($aPost['invoice_company_name']) || strlen(trim($_POST['invoice_company_name'])) < 3) {
              $alert .= '<li>' . Kohana::lang('order.validation.error_invoice_company_name_empty') . '</li>';
              }
              // Country
              //                if (empty($aPost['invoice_country'])) {
              //                    $alert .= '<li>' . Kohana::lang('order.validation.error_invoice_country_empty') . '</li>';
              //                }
              } */

            //var_dump($aPost['customer_register_inorder']);
            //exit;
            /*
              if (!empty($aPost['customer_register_inorder']) && $aPost['customer_register_inorder'] == 1) {
              if ($aPost['customer_password'] != $aPost['customer_password_repeat']) {
              $alert .= '<li>' . Kohana::lang('order.validation.error_password') . '</li>';
              } elseif (empty($aPost['customer_password']) || empty($aPost['customer_password_repeat'])) {
              $alert .= '<li>' . Kohana::lang('order.validation.error_password') . '</li>';
              } elseif (strlen($aPost['customer_password']) < 6) {
              $alert .= '<li>' . Kohana::lang('customer.validation.error_customer_password_too_short') . '</li>';
              }
              if ($oExistCheck->Value === true) {
              $alert .= '<li>' . $oExistCheck->Message . '</li>';
              }
              } */


            if (!empty($alert)) {
                $alert = Kohana::lang('app.following_errors') . ': <ul>' . $alert . '</ul>';
                return new ErrorReporting(ErrorReporting::ERROR, false, $alert);
            } else {
                return new ErrorReporting(ErrorReporting::SUCCESS, true, '');
            }
        } catch (Exception $e) {
            Kohana::log('error', $e->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, $e->getMessage());
        }
    }

    private function _Exists($aData) {
        try {
            //var_dump($aData);
            $aData['active'] = 'Y';
            $aData['verified'] = 'Y';
            $result = $this->_rDb->from(table::SHOP_CUSTOMERS)
                    ->where($aData)
                    ->select('COUNT(*) AS count')
                    ->get();
            //var_dump($result); exit;
            if ($result[0]->count > 0) {
                return new ErrorReporting(ErrorReporting::SUCCESS, true, Kohana::lang('customer.validation.customer_exists'));
            }
            return new ErrorReporting(ErrorReporting::INFO, false, Kohana::lang('customer.validation.customer_not_exists'));
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . ': ' . __LINE__ . ': ' . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('customer.validation.error_customer_exists'));
        }
    }

    public function ValidateMail($email) {
        if (!preg_match('/^[^@]{1,64}@[^@]{1,255}$/', $email)) {
            // Email invalid because wrong number of characters in one section, or wrong number of @ symbols.
            return false;
        }
        // Split it into sections to make life easier
        $email_array = explode("@", $email);
        $local_array = explode(".", $email_array[0]);
        for ($i = 0; $i < sizeof($local_array); $i++) {
            if (!preg_match('/^(([A-Za-z0-9!#$%&\'*+\/=?^_`{|}~-][A-Za-z0-9!#$%&\'*+\/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$/', $local_array[$i])) {
                return false;
            }
        }
        if (!preg_match('/^\[?[0-9\.]+\]?$/', $email_array[1])) { // Check if domain is IP. If not, it should be valid domain name
            $domain_array = explode(".", $email_array[1]);
            if (sizeof($domain_array) < 2) {
                return false; // Not enough parts to domain
            }
            for ($i = 0; $i < sizeof($domain_array); $i++) {
                if (!preg_match('/^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$/', $domain_array[$i])) {
                    return false;
                }
            }
        }
        return true;
    }

    public function UpdateP24SessionId($iOrderId, $iConfirmString) {
        $this->_rDb->update(table::SHOP_ORDERS, array('session_id' => ($iOrderId . '|' . TIME)), array('id_order' => $iOrderId, 'confirm_string' => $iConfirmString));
    }

    public function UpdateP24OrderID($session_id, $p24OrderId) {
        $this->_rDb->update(table::SHOP_ORDERS, array('p24_order_id' => $p24OrderId), array('session_id' => $session_id));
    }

    public function UpdateP24Status($iOrderId, $msg) {
        $this->_rDb->update(table::SHOP_ORDERS, array('p24_return_status' => $msg), array('id_order' => $iOrderId));
    }

    public function GetCustomerDetailsByOrderId($iOrderId) {
        return $this->_rDb->getwhere(table::SHOP_ORDERS_CUSTOMERS, array('order_id' => $iOrderId));
    }

}
