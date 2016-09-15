<?php

class Olishop_Model extends Model_Core {

    private $_rDb = null;

    public function __construct() {

        $lang = Kohana::config('locale.language');
        $this->_rDb = new Database();
    }

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
            $this->_rDb->from(table::SHOP_ORDERS)->select('order_id, order_date, confirm_email, order_cost')
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

    public function GetAllProductListing($active = null, $sLanguage = 'pl_PL', $bCount = null, $aOrderby = null) {
        try {
            if (!empty($bCount)) {
                $select = ' COUNT(*) AS count ';
            } else {
                $select = ' * ';
            }
            $query = "SELECT " . $select . " FROM (" . table::SHOP_PRODUCTS . " AS `p`)
            LEFT JOIN ( SELECT * FROM " . table::SHOP_PRODUCTS_IMAGES . " WHERE mainimage='Y' GROUP BY product_id) AS `pi` ON (`pi`.`product_id` = `p`.`id_product`)
            INNER JOIN " . table::SHOP_PRODUCTS_DESCRIPTION . " AS `pd` ON (`pd`.`product_id` = `p`.`id_product`)
            JOIN ( SELECT * FROM " . table::SHOP_PRODUCTS_TO_CATEGORIES . " GROUP BY product_id) AS `ptc` ON (`ptc`.`product_id` = `p`.`id_product`)
            LEFT JOIN " . table::SHOP_PRODUCTS_TAGS . " AS `pt` ON (`pt`.`product_id` = `p`.`id_product`)
            LEFT JOIN " . table::SHOP_PRODUCTS_TAGS_DICT . " AS `ptd` ON (`ptd`.`id_tag_dict` = `pt`.`tag_dict_id`)";
            if (!empty($active)) {
                $query .= " WHERE p.active = '" . $active . "'";
            }
            $query .= " AND pd.product_language = '" . $sLanguage . "' ";

            if (empty($bCount)) {
                $query .= " GROUP BY `pi`.`product_id` ";
            }
            if (!empty($aOrderby)) {
                $query .= " ORDER BY ";
                foreach ($aOrderby as $key => $order) {
                    $query .= " " . $key . " " . $order . " ";
                }
            } else {
                $query .= " ORDER BY `pd`.`product_name` ASC";
            }
//            if (!empty($iLimit) && isset($iOffset)) {
//                $query .= " LIMIT " . $iOffset . " ," . $iLimit . " ";
//            }
            //var_dump($query);
            $results = $this->_rDb->query($query);
            return new ErrorReporting(
                    ErrorReporting::SUCCESS, $results, '');
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, $ex->getMessage());
        }
    }
    public function GetOrderDetails($aWhere) {
        try {
            $result = $this->_rDb->from(table::SHOP_ORDERS . ' AS so')
                    ->join(table::SHOP_PAYMENT_TYPES_DESCRIPTION, 'payment_type_id', 'so.payment_type')
                    ->join(table::SHOP_PAYMENT_TYPES, 'id_payment_type', 'so.payment_type')
                    ->join(table::SHOP_DELIVERY_TYPES_DESCRIPTION, 'delivery_type_id', 'so.delivery_type')
                    ->join(table::SHOP_DELIVERY_TYPES, 'id_delivery_type', 'so.delivery_type')
                    ->join(table::SHOP_ORDERS_STATUSES, 'id_order_status', 'so.status_id')
                    ->join(table::SHOP_ORDERS_CUSTOMERS, 'order_id', 'so.id_order')
                    ->where(array('id_order'=>$aWhere))
                    ->get();
            return new ErrorReporting(ErrorReporting::SUCCESS, $result, '');
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . ': ' . __LINE__ . ': ' . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('order.FindOrder_error'));
        }
    }

}
