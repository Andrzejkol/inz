<?php
defined('SYSPATH') OR die('No direct access allowed.');
class Report_Model extends Model_Core {
    public function __construct() {
        parent::__construct();
    }

    public function CreateUser($role, $username, $password) {
        try {
            $path = Kohana::find_file('vendors', 'Zend/Loader');
            if (!empty($path)) {
                ini_set('include_path', ini_get('include_path').PATH_SEPARATOR.dirname(dirname($path)));
            }
            //require_once 'Zend/Loader.php';
            require_once Kohana::find_file('vendors', 'Zend/Acl');
            $this->db->query('SET AUTOCOMMIT = 0');
            $this->db->query('BEGIN');
            $acl = new Zend_Acl();
            switch($role) {
                case 'administrators':
                    $adminRole = new Zend_Acl_Role($role);
                    $acl->addRole($adminRole);
                    $acl->allow($adminRole);
                    break;
                case 'guests':
                    $gustRole = new Zend_Acl_Role($role);
                    $acl->addRole($huestRole);
                    $defaultPermissions = array('index', 'add', 'edit', 'delete');
                    $acl->allow($adminRole, 'pages', $defaultPermissions);
                    $acl->allow($adminRole, 'users', array_merge($defaultPermissions, array('register', 'login', 'logout')));
                    $acl->allow($adminRole, 'newsletters', array('subscribe', 'unsubsribe'));
                    break;
            }
            $password = $this->db->query("SELECT PASSWORD('{$password}') AS password");
            $password = $password[0]->password;
            $roleResult = $this->db->insert(table::ACL_ROLES, array('name' => $username, 'description' => '', 'parent_role_id' => 0, 'date_added' => TIME, 'available' => 1, 'acl' => serialize($acl)));
            $result = $this->db->insert(table::ACL_USERS, array('username' => $username, 'password' => $password, 'role_id' => $roleResult->insert_id()));
            $this->db->query('COMMIT');
            return new ErrorReporting(ErrorReporting::SUCCESS, $result, Kohana::lang('user.add_page_success'));
        } catch(Exception $ex) {
            $this->db->query('ROLLBACK');
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('user.add_newsletter_error'));
        }
    }

    public function Insert($data) {
        try {
            return new ErrorReporting(ErrorReporting::SUCCESS, $this->db->insert(table::ACL_USERS, $data), Kohana::lang('user.add_page_success'));
        } catch(Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('user.add_newsletter_error'));
        }
    }

    public function Update($id, $data) {
        try {
            $id += 0;
            return new ErrorReporting(ErrorReporting::SUCCESS, $this->db->update(table::ACL_USERS, $data, array('id' => $id)), Kohana::lang('user.update_page_success'));
        } catch(Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('user.update_page_error'));
        }
    }

    public function Delete($id) {
        try {
            $id += 0;
            $this->db->query('SET AUTOCOMMIT = 0');
            $this->db->query('BEGIN');
            $result = new ErrorReporting(ErrorReporting::SUCCESS, $this->db->delete(table::NEWSLETTERS, array('id' => $id)), Kohana::lang('user.delete_page_success'));
            $this->db->query('COMMIT');
        } catch(Exception $ex) {
            $this->db->query('ROLLBACK');
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('user.delete_newsletter_error'));
        }
    }

    public function Find($id) {
        try {
            $id += 0;
            return new ErrorReporting(ErrorReporting::SUCCESS, $this->db->getwhere(table::NEWSLETTERS, array('id' => $id)), Kohana::lang('user.get_page_success'));
        } catch(Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('user.get_page_error'));
        }
    }

    public function FindAll($limit, $offset) {
        try {
            return new ErrorReporting(ErrorReporting::SUCCESS, $this->db->limit($limit, $offset)->get(table::ACL_USERS), Kohana::lang('user.get_users_success'));
        } catch(Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('user.get_pages_error'));
        }
    }

    public function Count() {
        try {
            return new ErrorReporting(ErrorReporting::SUCCESS, $this->db->count_records(table::NEWSLETTERS), Kohana::lang('user.count_pages_success'));
        } catch(Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('user.count_pages_error'));
        }
    }

    public function InsertRole($data) {
        try {
            return new ErrorReporting(ErrorReporting::SUCCESS, $this->db->limit($limit, $offset)->get(table::ACL_ROLES), Kohana::lang('user.get_pages_success'));
        } catch(Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('user.get_pages_error'));
        }
    }

    public function UpdateRole($id, $data) {
        try {
            return new ErrorReporting(ErrorReporting::SUCCESS, $this->db->limit($limit, $offset)->get(table::ACL_ROLES), Kohana::lang('user.get_pages_success'));
        } catch(Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('user.get_pages_error'));
        }
    }

    public function DeleteRole($id) {
        try {
            return new ErrorReporting(ErrorReporting::SUCCESS, $this->db->limit($limit, $offset)->get(table::ACL_ROLES), Kohana::lang('user.get_pages_success'));
        } catch(Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('user.get_pages_error'));
        }
    }

    public function FindRole($id) {
        try {
            return new ErrorReporting(ErrorReporting::SUCCESS, $this->db->limit($limit, $offset)->get(table::ACL_ROLES), Kohana::lang('user.get_pages_success'));
        } catch(Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('user.get_pages_error'));
        }
    }

    public function FindAllRoles($limit, $offset) {
        try {
            return new ErrorReporting(ErrorReporting::SUCCESS, $this->db->limit($limit, $offset)->get(table::ACL_ROLES), Kohana::lang('user.get_pages_success'));
        } catch(Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('user.get_pages_error'));
        }
    }

    public function CountRoles() {
        try {
            return new ErrorReporting(ErrorReporting::SUCCESS, $this->db->count_records(table::ACL_ROLES), Kohana::lang('user.count_roles_success'));
        } catch(Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('user.get_pages_error'));
        }
    }


    public function InsertResource($data) {
        try {
            return new ErrorReporting(ErrorReporting::SUCCESS, $this->db->limit($limit, $offset)->get(table::ACL_ROLES), Kohana::lang('user.get_pages_success'));
        } catch(Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('user.get_pages_error'));
        }
    }

    public function UpdateResource($id, $data) {
        try {
            return new ErrorReporting(ErrorReporting::SUCCESS, $this->db->limit($limit, $offset)->get(table::ACL_ROLES), Kohana::lang('user.get_pages_success'));
        } catch(Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('user.get_pages_error'));
        }
    }

    public function DeleteResource($id) {
        try {
            return new ErrorReporting(ErrorReporting::SUCCESS, $this->db->limit($limit, $offset)->get(table::ACL_ROLES), Kohana::lang('user.get_pages_success'));
        } catch(Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('user.get_pages_error'));
        }
    }

    public function FindResource($id) {
        try {
            return new ErrorReporting(ErrorReporting::SUCCESS, $this->db->limit($limit, $offset)->get(table::ACL_ROLES), Kohana::lang('user.get_pages_success'));
        } catch(Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('user.get_pages_error'));
        }
    }

    public function FindAllResources($limit, $offset) {
        try {
            return new ErrorReporting(ErrorReporting::SUCCESS, $this->db->limit($limit, $offset)->get(table::ACL_ROLES), Kohana::lang('user.get_pages_success'));
        } catch(Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('user.get_pages_error'));
        }
    }

    public function CountResources() {
        try {
            return new ErrorReporting(ErrorReporting::SUCCESS, $this->db->count_records(table::ACL_RESOURCES), Kohana::lang('user.count_roles_success'));
        } catch(Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('user.get_pages_error'));
        }
    }
    public function AuthorizeAdminUser() {

    }
}
?>
