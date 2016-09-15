<?php

defined('SYSPATH') OR die('No direct access allowed.');

/**
 * Klasa User_Model służąca do zarządzania rolami i użytkownikami.
 *
 * @author Filip Górczyński <filip.gorczynski@gmail.com>
 *
 */
class User_Model extends Model_Core {

    /**
     * Konstruktor obiektu klasy User_Model
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Metoda dodająca nowego użytkownika do pustej struktury bazy danych.
     * Do wykorzystania w plikach instalacyjnych
     *
     * @author Filip Górczyński <filip.gorczynski@gmail.com>
     *
     * @param String $role
     * @param String $username
     * @param String $password
     * @return ErrorReporting
     */
    public function CreateUser($role, $username, $password) {
        try {
            $this->db->query('SET AUTOCOMMIT = 0');
            $this->db->query('BEGIN');
            $db = new Database();
            if ($role == 'administrator') {
                $acl->addRole($adminRole);
                $acl->allow($adminRole);
                $password = $this->db->query("SELECT PASSWORD('" . $password . "') AS password");
                $password = $password[0]->password;
                $roleResult = $this->db->insert(table::ACL_ROLES, array('name' => $username, 'description' => '', 'parent_role_id' => 0, 'date_added' => TIME, 'available' => 'Y'));
                $result = $this->db->insert(table::ACL_USERS, array('username' => $username, 'password' => $password, 'email' => 'filip@olicom.pl', 'role_id' => $roleResult->insert_id()));
                $this->db->query('COMMIT');
                return new ErrorReporting(ErrorReporting::SUCCESS, $result, Kohana::lang('user.create_user_success'));
            }
            return new ErrorReporting(ErrorReporting::SUCCESS, false, Kohana::lang('user.create_user_error'));
        } catch (Exception $ex) {
            $this->db->query('ROLLBACK');
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('user.create_user_error'));
        }
    }

    /**
     *
     * @param array $data
     * @return ErrorReporting
     */
    public function Insert(Array $data, Array $aFiles = null) {
        try {
            $this->db->query('SET AUTOCOMMIT = 0');
            $this->db->query('BEGIN');
            $data['date_added'] = TIME;
            $data['status'] = 'Y';
            $body = Kohana::lang('user.add_user_email_body', $data['email'], $data['password']);
//            if(email::send($data['email'], config::getConfig('administrator_email'), config::getConfig('administrator_name'), $body, true) === false) {
//                throw new Exception(Kohana::lang('user.cant_send_user_register_message'));
//            }
            $password = $this->db->query("SELECT PASSWORD('{$data['password']}') AS `password`");
            $data['password'] = $password[0]->password;
            unset($data['confirm_password'], $data['submit'],  $data['submit_back']);
            
            
            // dodawanie obrazkow
            $aUserImage = array();
            //$aUserImage['news_id'] = $insert->insert_id();
            $image = $aFiles['photo'];

            // tworzymy obrazki
            if (!empty($image) && is_array($image) && !empty($image['name'])) {
                $imageData = file::upload(
                                $image, array(
                            'unique' => true,
                            'width' =>users::BIGWIDTH,
                            'height' => users::BIGHEIGHT,
                            'thumbwidth' => users::THUMBWIDTH,
                            'thumbheight' => users::THUMBHEIGHT,
                            'path' => users::BIG_PATH,
                            'thumbpath' => users::SMALL_PATH
                                )
                        )->Value;
                $imageData['alt'] = '';
                $imageData['mainimage'] = 0;

                $result = $this->db->insert(table::ACL_USERS_IMAGES, $imageData);
                $data['image_id'] = $result->insert_id(); 
            }
            
            //$dump = var_dump($imageData);
            //Kohana::log('error', $dump);
            //$data['image'] = $imageData;
            $insert = $this->db->insert(table::ACL_USERS, $data);

            // łaczymy fote z wiadomoscia tylko jesli jest fota!
            /*
            if (!empty($aUserImage['images_id']) && !empty($aUserImage['user_id'])) {
                $this->db->insert(table::ACL_USERS, $aUserImage);
            }
*/

            $result = new ErrorReporting(ErrorReporting::SUCCESS, $insert->insert_id(), Kohana::lang('user.insert_user_success'));
            $this->db->query('COMMIT');
            return $result;
        } catch (Exception $ex) {
            $this->db->query('ROLLBACK');
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('user.insert_user_error'));
        }
    }

    /**
     *
     * @param integer $id
     * @param array $data
     * @return ErrorReporting
     */
    public function Update($id, Array $data, Array $files = null) {
        try {
            $id += 0;
            $this->db->query('SET AUTOCOMMIT = 0');
            $this->db->query('BEGIN');
            
            //Kohana::log('debug', print_r($data, true));
            
            if (!empty($data['change_password'])) {
                $password = $this->db->query("SELECT PASSWORD('{$data['password']}') AS `password`");
                $data['password'] = $password[0]->password;
            } else {
                unset($data['password']);
            }
            unset($data['confirm_password'], $data['submit'], $data['submit_back'], $data['change_password']);
            
            // dodajemy i usuwamy obrazki jesli trzeba
            $image = $files['photo'];
            $user_image = array();

            // sprawdzamy czy jest foto dla tego usera
            $result = $this->db->from(table::ACL_USERS)->where(array('id_user' => $id))
                    ->join(table::ACL_USERS_IMAGES, table::ACL_USERS_IMAGES . '.id_image', table::ACL_USERS . '.image_id')
                    ->get();
                    
            //Kohana::log('debug', $this->db->last_query());
            //Kohana::log('debug', 'Olicom: '.var_dump($result));

            // tworzymy obrazki
            if (!empty($image) && is_array($image) && !empty($image['name'])) {
                $imageData = file::upload(
                                $image, array(
                            'unique' => true,
                            'width' =>users::BIGWIDTH,
                            'height' => users::BIGHEIGHT,
                            'thumbwidth' => users::THUMBWIDTH,
                            'thumbheight' => users::THUMBHEIGHT,
                            'path' => users::BIG_PATH,
                            'thumbpath' => users::SMALL_PATH
                                )
                        )->Value;
                $imageData['alt'] = '';
                $imageData['mainimage'] = 0;

                //jeśli jest foto to update
                if ($result->count() > 0) {
                    // update fotki w bazie
                    $result_image_update = $this->db->update(table::ACL_USERS_IMAGES, $imageData, array('id_image' => $result[0]->image_id));
                    $user_images['images_id'] = $result[0]->image_id;
                } else { 
                	// nie bylo foty to wrzucamy nowe
                	$result_image = $this->db->insert(table::ACL_USERS_IMAGES, $imageData);
                	$data['image_id'] = $result_image->insert_id();             
            		//$insert = $this->db->insert(table::ACL_USERS, $data);
                }
            }

            // jesli jest foto i wrzucamy nowe to usuwamy stare
            if ($result->count() > 0 && !empty($image['tmp_name']) && is_uploaded_file($image['tmp_name'])) {
                if (file_exists(users::BIG_PATH . $result[0]->filename)) { //duże foto
                    unlink(users::BIG_PATH . $result[0]->filename);
                }
                if (file_exists(users::SMALL_PATH . $result[0]->filename)) { // miniaturka
                    unlink(users::SMALL_PATH . $result[0]->filename);
                }
            }
            // Koniec fotek
            
            $result = $this->db->update(table::ACL_USERS, $data, array('id_user' => $id));
            $this->db->query('COMMIT');
            return new ErrorReporting(ErrorReporting::SUCCESS, $result, Kohana::lang('user.update_user_success'));
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('user.update_user_error'));
        }
    }

    /**
     * Usuwanie użytkowników przez checkboxy na liscie użytkowników.
     * @param Array $aUsers
     * @return ErrorReporting (Bool true || Bool false)
     */
    public function DeleteUsersArray($aUsers) {
        try {
            foreach ($aUsers as $aUser) {
                $this->Delete($aUser);
            }
            return new ErrorReporting(ErrorReporting::SUCCESS, true, Kohana::lang('user.delete_user_success'));
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('user.delete_user_error'));
        }
    }

    /**
     *
     * @param integer $id
     * @return ErrorReporting
     */
    public function Delete($id) {
        try {
        	$this->db->query('SET AUTOCOMMIT = 0');
            $this->db->query('BEGIN');
            $id+=0;
            
            //sprawdzamy czy byly foty
            $imagecheck = $this->db->from(table::ACL_USERS)
                    ->select('image_id')
                    ->where(array('id_user' => $id))->get();                
            
            //Kohana::log('error', 'Olicom: '.var_dump($imagecheck));
            
            if ($imagecheck->count() > 0) {
                $files = $this->db->from(table::ACL_USERS_IMAGES)->where(array('id_image' => $imagecheck[0]->image_id))->get();
                $this->db->delete(table::ACL_USERS_IMAGES, array('id_image' => $imagecheck[0]->image_id));
            }
            $this->db->query('COMMIT');
            
            // po wywaleniu wszystkiego z bazy usuwamy fote
            if (!empty($imagecheck->image_id) && $imagecheck->count() > 0) {
                if (file_exists(users::BIG_PATH . $files[0]->filename)) { //duże foto
                    unlink(users::BIG_PATH . $files[0]->filename);
                }
                if (file_exists(users::SMALL_PATH . $files[0]->filename)) { //miniaturka
                    unlink(users::SMALL_PATH . $files[0]->filename);
                }
            }
            
            $this->db->delete(table::ACL_USERS, array('id_user' => $id));
                        
            return new ErrorReporting(ErrorReporting::SUCCESS, '', Kohana::lang('user.delete_user_success'));
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('user.delete_user_error'));
        }
    }

    /**
     *
     * @param Integer $id
     * @return ErrorReporting
     */
    public function Find($id) {
        try {
            $id += 0;
            $result = $this->db->from(table::ACL_USERS)->where(array('id_user' => $id))
            		->join(table::ACL_USERS_IMAGES, table::ACL_USERS . '.image_id', table::ACL_USERS_IMAGES . '.id_image', 'LEFT')
                    ->groupby('id_user')
                    ->get();
                    
            return new ErrorReporting(ErrorReporting::SUCCESS, $result, Kohana::lang('user.find_user_success'));
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('user.find_user_error'));
        }
    }

    /**
     * @param Array $aWhere
     * @return ErrorReporting
     */
    public function FindAllWhere($aPost) {
        try {
            $this->db->from(table::ACL_USERS)
                    ->select('*, r.name AS role_name')
                    ->join(table::ACL_ROLES . ' AS r', 'role_id', 'id_role', 'INNER');

            if (!empty($aPost['email'])) {
                $this->db->like('email', $aPost['email']);
            }
            if (!empty($aPost['role_id'])) {
                $this->db->where('role_id', $aPost['role_id']);
            }
            $result = $this->db->get();
            return new ErrorReporting(ErrorReporting::SUCCESS, $result, Kohana::lang('user.get_users_success'));
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('user.get_users_error'));
        }
    }

    /**
     *
     * @param Integer $limit
     * @param Integer $offset
     * @return ErrorReporting
     */
    public function FindAll($limit, $offset) {
        try {
			
		$users_orderby = 'first_name';
		$kind = 'ASC';
		if(!empty($_GET['users_orderby']) && $_GET['users_orderby']==1 ) {$users_orderby='first_name'; $kind='ASC';}
		else if(!empty($_GET['users_orderby']) && $_GET['users_orderby']==2 ) {$users_orderby='first_name'; $kind='DESC';}
		
		else if(!empty($_GET['users_orderby']) && $_GET['users_orderby']==3 ) {$users_orderby='r.name'; $kind='ASC';}
		else if(!empty($_GET['users_orderby']) && $_GET['users_orderby']==4 ) {$users_orderby='r.name'; $kind='DESC';}
		
		else if(!empty($_GET['users_orderby']) && $_GET['users_orderby']==5 ) {$users_orderby='date_added'; $kind='ASC';}
		else if(!empty($_GET['users_orderby']) && $_GET['users_orderby']==6 ) {$users_orderby='date_added'; $kind='DESC';}
		
		else if(!empty($_GET['users_orderby']) && $_GET['users_orderby']==7 ) {$users_orderby='status'; $kind='ASC';}
		else if(!empty($_GET['users_orderby']) && $_GET['users_orderby']==8 ) {$users_orderby='status'; $kind='DESC';}
		
            return new ErrorReporting(ErrorReporting::SUCCESS, $this->db->orderby($users_orderby, $kind)->select(table::ACL_USERS . '.*, r.name AS role_name')->join(table::ACL_ROLES . ' AS r', 'role_id', 'id_role', 'INNER')->limit($limit, $offset)->getwhere(table::ACL_USERS, array('username <>' => 'administrator')), Kohana::lang('user.get_users_success'));
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('user.get_pages_error'));
        }
    }

    /**
     *
     * @return ErrorReporting
     */
    public function Count() {
        try {
            return new ErrorReporting(ErrorReporting::SUCCESS, $this->db->count_records(table::ACL_USERS), Kohana::lang('user.count_users_success'));
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('user.count_users_error'));
        }
    }

    /**
     *
     * @param array $data
     * @return ErrorReporting
     */
    public function InsertRole(array $data) {
        try {
            $this->db->query('SET AUTOCOMMIT = 0');
            $this->db->query('BEGIN');
            if(isset($data['permission'])){
                $aPermissions = $data['permission'];
            }
            else{
                $aPermissions = null;
            }
            unset($data['permission'], $data['submit'], $data['submit_back']);
            $roleResult = $this->db->insert(
                            table::ACL_ROLES, array(
                        'name' => $data['name'],
                        'description' => '',
                        'parent_role_id' => $data['parent_role_id'],
                        'date_added' => TIME
                            )
            );
            $iInsertId = $roleResult->insert_id();
            if (count($aPermissions)) {
                foreach ($aPermissions as $pK => $pV) {
                    $this->db->insert(table::ACL_ROLES_PERMISSIONS, array('role_id' => $iInsertId, 'permission_id' => $pK));
                }
            }
            $this->db->query('COMMIT');
            return new ErrorReporting(ErrorReporting::SUCCESS, $iInsertId, Kohana::lang('user.insert_role_success'));
        } catch (Exception $ex) {
            $this->db->query('ROLLBACK');
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('user.insert_role_error'));
        }
    }

    /**
     *
     * @param Integer $id
     * @param Array $data
     * @return ErrorReporting
     */
    public function UpdateRole($id, array $data) {
        try {
            $id += 0;
            $this->db->query('SET AUTOCOMMIT = 0');
            $this->db->query('BEGIN');
            if(isset($data['permission'])){
//                $aPermissions = $data['permission'];
				foreach ($data['permission'] as $key => $value) {
					$aPermissions[] = $key;
				}
            }
            else{
                $aPermissions = null;
            }
            
            unset($data['permission'], $data['submit'], $data['submit_back']);
            $result = $this->db->update(table::ACL_ROLES, $data, array('id_role' => $id));
            if (count($aPermissions)) {
                $oCurrentPermissions = $this
                        ->db
                        ->join(table::ACL_PERMISSIONS, table::ACL_PERMISSIONS . '.id_permission', table::ACL_ROLES_PERMISSIONS . '.permission_id', 'INNER')
                        ->getwhere(table::ACL_ROLES_PERMISSIONS, array('role_id' => $id));
                $aCurrentPermissions = array();
                foreach ($oCurrentPermissions as $cP) {
                    $aCurrentPermissions[] = $cP->id_permission;
                }
                $aDiff = array_diff($aCurrentPermissions, $aPermissions);
				if (!empty($aDiff) && count($aDiff) > 0) {
					foreach ($aDiff as $pK) {
						$this->db->delete(table::ACL_ROLES_PERMISSIONS, array('role_id' => $id, 'permission_id' => $pK));
					}					
				}
                foreach ($aPermissions as $pV) {
					if (!in_array($pV, $aCurrentPermissions)) {
						$this->db->insert(table::ACL_ROLES_PERMISSIONS, array('role_id' => $id, 'permission_id' => $pV));						
					}
                }
            }
            $this->db->query('COMMIT');
            return new ErrorReporting(ErrorReporting::SUCCESS, $result, Kohana::lang('user.update_role_success'));
        } catch (Exception $ex) {
			$this->db->query('ROLLBACK');
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('user.update_role_error'));
        }
    }

    /**
     *
     * @param integer $id
     * @return ErrorReporting
     */
    public function AllowDeleteRole($id) {
        try {
            return new ErrorReporting(ErrorReporting::SUCCESS, true, Kohana::lang('user.allow_delete_role'));
            $id += 0;
            return new ErrorReporting(ErrorReporting::WARNING, false, Kohana::lang('user.cant_delete_role'));
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, '');
        }
    }

    /**
     *
     * @param Integer $id
     * @return ErrorReporting
     */
    public function DeleteRole($id) {
        try {
            $id+=0;
            $this->db->query('SET AUTOCOMMIT = 0');
            $this->db->query('BEGIN');
            $this->db->delete(table::ACL_ROLES_PERMISSIONS, array('role_id' => $id));
            $result = $this->db->delete(table::ACL_ROLES, array('id_role' => $id));
            $this->db->query('COMMIT');
            return new ErrorReporting(ErrorReporting::SUCCESS, $result, Kohana::lang('user.delete_role_success'));
        } catch (Exception $ex) {
            $this->db->query('ROLLBACK');
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('user.delete_role_error', array($ex->getMessage)));
        }
    }

    /**
     * @param Integer $id
     * @return ErrorReporting
     */
    public function FindRole($id) {
        try {
            return new ErrorReporting(ErrorReporting::SUCCESS, $this->db->getwhere(table::ACL_ROLES, array('id_role' => $id)), Kohana::lang('user.get_role_success'));
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('user.get_role_error'));
        }
    }

    /**
     * @param Integer $limit
     * @param Integer $offset
     * @return ErrorReporting
     */
    public function FindAllRolesAsArray() {
        try {
            $result = $this->FindAllRoles()->Value;
            $aRoles = array('0' => Kohana::lang('user.check'));
            foreach ($result as $r) {
                $aRoles[$r->id_role] = $r->name;
            }
            return new ErrorReporting(ErrorReporting::SUCCESS, $aRoles, Kohana::lang('user.get_roles_success'));
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('user.get_roles_error'));
        }
    }

    /**
     * @param Integer $limit
     * @param Integer $offset
     * @return ErrorReporting
     */
    public function FindAllRoles($limit = null, $offset = null) {
        try {
			$roles_orderby = 'id_role';
			$kind = 'ASC';
			if(!empty($_GET['roles_orderby']) && $_GET['roles_orderby']==1 ) {$roles_orderby='id_role'; $kind='ASC';}
			else if(!empty($_GET['roles_orderby']) && $_GET['roles_orderby']==2 ) {$roles_orderby='id_role'; $kind='DESC';}
			
			else if(!empty($_GET['roles_orderby']) && $_GET['roles_orderby']==3 ) {$roles_orderby='name'; $kind='ASC';}
			else if(!empty($_GET['roles_orderby']) && $_GET['roles_orderby']==4 ) {$roles_orderby='name'; $kind='DESC';}
			
			else if(!empty($_GET['roles_orderby']) && $_GET['roles_orderby']==5 ) {$roles_orderby='date_added'; $kind='ASC';}
			else if(!empty($_GET['roles_orderby']) && $_GET['roles_orderby']==6 ) {$roles_orderby='date_added'; $kind='DESC';}
			
			else if(!empty($_GET['roles_orderby']) && $_GET['roles_orderby']==7 ) {$roles_orderby='status'; $kind='ASC';}
			else if(!empty($_GET['roles_orderby']) && $_GET['roles_orderby']==8 ) {$roles_orderby='status'; $kind='DESC';}
		
		
            if ($limit == null && $offset == null) {
                return new ErrorReporting(ErrorReporting::SUCCESS, $this->db->get(table::ACL_ROLES), Kohana::lang('user.get_roles_success'));
            }
            return new ErrorReporting(ErrorReporting::SUCCESS, $this->db->orderby($roles_orderby, $kind)->limit($limit, $offset)->get(table::ACL_ROLES), Kohana::lang('user.get_roles_success'));
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('user.get_roles_error'));
        }
    }

    /**
     *
     * @return ErrorReporting
     */
    public function CountRoles() {
        try {
            return new ErrorReporting(ErrorReporting::SUCCESS, $this->db->count_records(table::ACL_ROLES), Kohana::lang('user.count_roles_success'));
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('user.count_roles_error'));
        }
    }

    /**
     *
     * @param String $email
     * @param String $password
     * @return ErrorReporting
     */
    public function UserExists($email, $password = null) {
        try {
            if (empty($password)) {
                return new ErrorReporting(ErrorReporting::SUCCESS, $this->db->count_records(table::ACL_USERS, array('email' => $email)), Kohana::lang('user.exist_success'));
            }
            $password = $this->db->query("SELECT PASSWORD('{$password}') AS `password`");
            $password = $password[0]->password;
            return new ErrorReporting(ErrorReporting::SUCCESS, $this->db->count_records(table::ACL_USERS, array('email' => $email, 'password' => $password)), Kohana::lang('user.exist_success'));
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('user.exist_error'));
        }
    }

    /**
     * @param Array $post
     * @return ErrorReporting
     */
    public function AuthorizeUser(array $post) {
        try {
            $password = $this->db->query("SELECT PASSWORD('{$post['password']}') AS `password`");
            $password = $password[0]->password;
            if ($this->UserExists($post['email'], $post['password'])->Value === false) {
                return new ErrorReporting(ErrorReporting::INFO, false, Kohana::lang('user.invalid_email_or_password'));
            } else {
                $this->db->query("SET AUTOCOMMIT = 0");
                $this->db->query("BEGIN");
                $return = array();
                $oUserResults =
                                $this->db
                                ->from(table::ACL_USERS . ' AS u')
                                ->select('id_user, username, first_name, last_name, email, role_id, last_login_date, logged_times, r.name AS role_name, acl_users_images.filename')
                                ->join(table::ACL_ROLES . ' AS r', 'r.id_role', 'u.role_id', 'INNER')
                                ->join(table::ACL_USERS_IMAGES, 'u' . '.image_id', table::ACL_USERS_IMAGES . '.id_image', 'LEFT')
                                ->where(array('email' => $post['email'], 'password' => $password, 'u.status' => 'Y', 'r.status' => 'Y'))->get();                
                if ($oUserResults->count() == 0) {
                    return new ErrorReporting(ErrorReporting::WARNING, false, Kohana::lang('user.invalid_email_or_password'));
                }
                $return['logged_in'] = true;
                foreach ($oUserResults as $user) {
                    $return['id_user'] = $user->id_user;
                    $return['username'] = $user->username;
                    $return['email'] = $user->email;
                    $return['first_name'] = $user->first_name;
                    $return['last_name'] = $user->last_name;
                    $return['role_id'] = $user->role_id;
                    $return['role_admin'] = $user->role_name;
                    $return['last_login_date'] = $user->last_login_date;
                    if (isset($user->filename)) { $return['filename'] = $user->filename; } 
                }
                $this->db->query("UPDATE " . table::ACL_USERS . " SET last_login_date = " . TIME . ", logged_times = logged_times + 1 WHERE id_user = " . $return['id_user']);
                $aRolesPermissions = array();
                if ($oUserResults[0]->role_name == 'administrator') {
                    $oPermissions = $this->db->get(table::ACL_PERMISSIONS);
                    foreach ($oPermissions as $role) {
                        $aRolesPermissions[$role->name] = true;
                    }
                } else {
                    $oRolesPermissions =
                            $this->db
                            ->join(table::ACL_ROLES_PERMISSIONS . ' AS rp', 'rp.role_id', 'r.id_role', 'INNER')
                            ->join(table::ACL_PERMISSIONS . ' AS p', 'p.id_permission', 'rp.permission_id', 'INNER')
                            ->getwhere(table::ACL_ROLES . ' AS r', array('role_id' => $return['role_id']));
                    foreach ($oRolesPermissions as $role) {
                        if (!empty($role->id_role)) {
                            $aRolesPermissions[$role->name] = true;
                        }
                    }
                }
                $return['permissions'] = $aRolesPermissions;
                return new ErrorReporting(ErrorReporting::SUCCESS, $return, Kohana::lang('user.login_success'));
            }
            $this->db->query("ROLLBACK");
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('user.unknown_error'));
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('user.get_pages_error'));
        }
    }

    /**
     *
     * @param array $post
     */
    public function ValidateUserAdd(array $post) {
        //TODO: dodać walidację PHP
        return true;
        $errors = array();
        $clean = array();
        $clean['email'] = strip_tags($post['email']);
        $clean['email'] = trim($clean['email']);
        $clean['password'] = strip_tags($post['password']);
        $clean['password'] = trim($clean['password']);
        if (empty($clean['email'])) {
            $errors['email'] = Kohana::lang('user.email_can_not_be_empty');
        }
        if (empty($post['password'])) {
            $errors['password'] = Kohana::lang('user.password_can_not_be_empty');
        }
        if (!empty($post['email'])
                && !empty($clean['email'])
                && $this->UserExists($clean['email'], $clean['email'])) {
            $errors['email'] = Kohana::lang('user.email_exists');
        }
        return $errors;
    }

    /**
     *
     *
     * @return ErrorReporting
     */
    public function GetUserPermissions($iUserId) {
        try {
            $result = $this->db->from(table::ACL_ROLES_PERMISSIONS)
                            ->join(table::ACL_PERMISSIONS, table::ACL_ROLES_PERMISSIONS . '.permission_id', table::ACL_PERMISSIONS . '.id_permission')
                            ->where(array('role_id' => $iUserId))->get();

            $perms = array();
            foreach ($result as $r) {
                $perms[] = $r->name;
            }

            //var_dump($perms);exit();
            return new ErrorReporting(ErrorReporting::SUCCESS, $perms, Kohana::lang('user.success_GetUserPermissions'));
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('user.error_GetUserPermissions'));
        }
    }

    /**
     *
     * @param array $post
     */
    public function ValidateUserEdit(array $post) {
        //TODO: dodać walidację PHP
        return true;
        $errors = array();
        $clean = array();
        $clean['email'] = strip_tags($post['email']);
        $clean['email'] = trim($clean['email']);
        $clean['password'] = strip_tags($post['password']);
        $clean['password'] = trim($clean['password']);
        if (empty($clean['email'])) {
            $errors['email'] = Kohana::lang('user.email_can_not_be_empty');
        }
        if (empty($clean['role_id'])) {
            $errors['role_id'] = Kohana::lang('user.role_can_not_be_empty');
        }
        if (!empty($clean['email'])
                && !empty($clean['email'])
                && $this->UserExists($clean['email'], $clean['email'])) {
            $errors['email'] = Kohana::lang('user.email_exists');
        }
    }

    /**
     *
     * @param array $post
     */
    public function _validateUserRegister(array $post) {
        $errors = array();
        $clean = array();
        $clean['email'] = strip_tags($post['email']);
        $clean['email'] = trim($clean['email']);
        $clean['password'] = strip_tags($post['password']);
        $clean['password'] = trim($clean['password']);
        if (empty($clean['email'])) {
            $errors['email'] = Kohana::lang('user.email_can_not_be_empty');
        }
        if (empty($clean['password'])) {
            $errors['password'] = Kohana::lang('user.password_can_not_be_empty');
        }
        if (!empty($clean['email'])
                && !empty($clean['email'])
                && $this->UserExists($clean['email'], $clean['password'])) {
            $errors['email'] = Kohana::lang('user.email_exists');
        }
    }

    /**
     *
     * @param array $post
     */
    public function ValidateRoleAdd(array $post) {
        //TODO: Dodać walidację w PHP
        return true;
        $errors = array();
        $clean = array();
        $clean['name'] = strip_tags($post['name']);
        $clean['name'] = trim($clean['name']);
        if (empty($clean['email'])) {
            $errors['email'] = Kohana::lang('user.email_can_not_be_empty');
        }
        if (empty($post['password'])) {
            $errors['password'] = Kohana::lang('user.password_can_not_be_empty');
        }
        if (!empty($post['email'])
                && !empty($clean['email'])
                && $this->UserExists($clean['email'], $clean['email'])) {
            $errors['email'] = Kohana::lang('user.email_exists');
        }
        if (!isset($post['permission']) || empty($post['permission'])) {
            $errors['permission'] = Kohana::lang('user.role_empty');
        }
        return $errors;
    }

    /**
     *
     * @param array $post
     */
    public function ValidateRoleEdit(array $post) {
        //TODO: Dodać walidację w PHP
        return true;
        $errors = array();
        $clean = array();
        $clean['email'] = strip_tags($post['email']);
        $clean['email'] = trim($clean['email']);
        $clean['password'] = strip_tags($post['password']);
        $clean['password'] = trim($clean['password']);
        if (empty($clean['email'])) {
            $errors['email'] = Kohana::lang('user.email_can_not_be_empty');
        }
        if (empty($clean['role_id'])) {
            $errors['role_id'] = Kohana::lang('user.role_can_not_be_empty');
        }
        if (!empty($clean['email'])
                && !empty($clean['email'])
                && $this->UserExists($clean['email'], $clean['email'])) {
            $errors['email'] = Kohana::lang('user.email_exists');
        }
    }

    /**
     *
     * @param array $data
     * @return ErrorReporting
     */
    public function InsertPermission(array $data) {
        try {
            return new ErrorReporting(ErrorReporting::SUCCESS, $this->db->insert(table::ACL_PERMISSIONS, $data), Kohana::lang('user.insert_permission_success'));
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('user.insert_permission_error'));
        }
    }

    /**
     *
     * @param Integer $id
     * @param array $data
     * @return ErrorReporting
     */
    public function UpdatePermission($id, array $data) {
        try {
            $d += 0;
            $result = new ErrorReporting(ErrorReporting::SUCCESS, $this->db->update(table::ACL_PERMISSIONS, $data, array('id_permission' => $id)), Kohana::lang('user.update_permissions_success'));
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('user.update_permissions_error'));
        }
    }

    /**
     *
     * @param Integer $id
     * @return ErrorReporting
     */
    public function DeletePermission($id) {
        try {
            return new ErrorReporting(ErrorReporting::SUCCESS, $this->db->delete(table::ACL_PERMISSIONS), Kohana::lang('user.delete_permission_success'));
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('user.delete_permission_error'));
        }
    }

    /**
     *
     * @param Integer $id
     * @return ErrorReporting
     */
    public function FindPermission($id) {
        try {
            return new ErrorReporting(ErrorReporting::SUCCESS, $this->db->getwhere(table::ACL_PERMISSIONS, array('id_permission' => $id)), Kohana::lang('user.get_permission_success'));
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('user.get_permission_error'));
        }
    }

    /**
     *
     * @param Integer $limit
     * @param Integer $offset
     * @return ErrorReporting
     */
    public function FindAllPermissions($limit = null, $offset = null) {
        try {
            if ($limit == null && $offset == null) {
                return new ErrorReporting(ErrorReporting::SUCCESS, $this->db->orderby('resource')->get(table::ACL_PERMISSIONS), Kohana::lang('user.get_roles_success'));
            }
            return new ErrorReporting(ErrorReporting::SUCCESS, $this->db->limit($limit, $offset)->orderby('resource')->get(table::ACL_PERMISSIONS), Kohana::lang('user.get_roles_success'));
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('user.get_roles_error'));
        }
    }

    /**
     *
     * @return ErrorReporting
     */
    public function CountPermissions() {
        try {
            return new ErrorReporting(ErrorReporting::SUCCESS, $this->db->count_records(table::ACL_ROLES), Kohana::lang('user.count_roles_success'));
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('user.count_roles_error'));
        }
    }

    /**
     *  Sprawdzanie czy użytkownik ma dane uprawnienia.
     * @param String $role
     * @param String $resource
     * @param String $privilege
     * @return Bool
     */
    public static function IsAllowed($rolesPermissions, $resource, $privilege) {
        try {
            if (!empty($rolesPermissions['role_admin']) && $rolesPermissions['role_admin'] === 'administrator') {
                return new ErrorReporting(ErrorReporting::SUCCESS, true, '');
            }
            if (!empty($rolesPermissions['permissions'][$resource . '_' . $privilege])) {
                if ($rolesPermissions['permissions'][$resource . '_' . $privilege] == true) {
                    return new ErrorReporting(ErrorReporting::SUCCESS, true, '');
                } else {
                    return new ErrorReporting(ErrorReporting::WARNING, false, '');
                }
            }
            return new ErrorReporting(ErrorReporting::WARNING, false, '');
        } catch (Exception $e) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, '');
        }
    }

    /**
     *
     * @param Integer $roleId
     */
    public function ChangeRoleState($roleId) {
        
    }

    /**
     * Filip Górczyński <a href="mailto:filip.gorczynski@gmail.com">filip.gorczynski@gmail.com</a>
     *
     * @param Integer $length
     * @param Integer $strength
     * @return String
     */
    private function _generatePassword($length = 9, $strength = 0) {
        $vowels = 'aeuy';
        $consonants = 'bdghjmnpqrstvz';
        if ($strength & 1) {
            $consonants .= 'BDGHJLMNPQRSTVWXZ';
        }
        if ($strength & 2) {
            $vowels .= "AEUY";
        }
        if ($strength & 4) {
            $consonants .= '23456789';
        }
        if ($strength & 8) {
            $consonants .= '1xyz';
        }

        $password = '';
        $alt = time() % 2;
        for ($i = 0; $i < $length; $i++) {
            if ($alt == 1) {
                $password .= $consonants[(rand() % strlen($consonants))];
                $alt = 0;
            } else {
                $password .= $vowels[(rand() % strlen($vowels))];
                $alt = 1;
            }
        }
        return $password;
    }

    public static function ValidateMail($email) {
        if (!ereg("^[^@]{1,64}@[^@]{1,255}$", $email)) {
            // Email invalid because wrong number of characters in one section, or wrong number of @ symbols.
            return false;
        }
        // Split it into sections to make life easier
        $email_array = explode("@", $email);
        $local_array = explode(".", $email_array[0]);
        for ($i = 0; $i < sizeof($local_array); $i++) {
            if (!ereg("^(([A-Za-z0-9!#$%&'*+/=?^_`{|}~-][A-Za-z0-9!#$%&'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$", $local_array[$i])) {
                return false;
            }
        }
        if (!ereg("^\[?[0-9\.]+\]?$", $email_array[1])) { // Check if domain is IP. If not, it should be valid domain name
            $domain_array = explode(".", $email_array[1]);
            if (sizeof($domain_array) < 2) {
                return false; // Not enough parts to domain
            }
            for ($i = 0; $i < sizeof($domain_array); $i++) {
                if (!ereg("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$", $domain_array[$i])) {
                    return false;
                }
            }
        }
        return true;
    }

    /**
     * Metoda służąca do generowania nowego hasła oraz wysyłania użytkownikowi emailem nowego hasła
     * @param array $post
     * @return ErrorReporting
     */
    public function RecoverPassword(array $post) {
        if (!isset($post['email'])) {
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('user.validation.unknown_error'));
        }

        $post['email'] = trim($post['email']);

        if (!valid::email($post['email'])) {
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('user.validation.invalid_email_format'));
        }

        if ($this->UserExists($post['email'])->Value == 0) {
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('user.validation.email_not_exists'));
        }

        $verifyString = md5(uniqid($post['email'], true));
        $newPassword = $this->_generatePassword();
        $mailView = new View('emails/mail_admin_recovery_password');
        $mailView->email = $post['email'];
        $mailView->password = $newPassword;
        $result = $this->db->update(table::ACL_USERS, array('verify_string' => $verifyString, 'password' => new Database_Expression('PASSWORD("' . $newPassword . '")' )), array('email' => $post['email']));
        
        $send = email::send( $post['email'], config::getConfig('administrator_email'), Kohana::lang('user.new_password'), $mailView);
        if(!$send){
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('user.error.cant_send_user_register_message'));
        }

        return new ErrorReporting(ErrorReporting::SUCCESS, $result, Kohana::lang('user.success.new_password_has_been_sent'));
    }

}
