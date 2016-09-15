<?php

defined('SYSPATH') OR die('No direct access allowed.');

class Users_Controller extends Admin_Controller {
    const ALLOW_PRODUCTION = TRUE;

    public function __construct() {
        parent::__construct();
        $this->_oTemplate->header->hover = 'users';
    }

    /**
     * @author Filip Górczyński <a href="mailto:filip.gorczynski@gmail.com">filip.gorczynski@gmail.com</a>
     */
    public function index() {
        $this->authorize('users', 'index');

        $count = $this->_oUser->Count()->Value;
        $oPagination = layer::GetPagination($count, '', layer::ADMIN_PER_PAGE);
        $limit = $oPagination->items_per_page;
        $offset = $oPagination->sql_offset;

        $this->_oTemplate->content->main_content = new View('admin_users_index');
        $this->_oTemplate->content->main_content->users = $this->_oUser->FindAll($limit, $offset)->Value;
        $this->_oTemplate->content->main_content->aRoles = $this->_oUser->FindAllRolesAsArray()->Value;
        $this->_oTemplate->content->main_content->oPagination = $oPagination;
        $this->_oTemplate->title = Kohana::lang('user.users_index');
        $this->_oTemplate->render(true);
    }

    /**
     *
     */
    public function user_add() {
        $this->authorize('users', 'add');

        if (!empty($_POST['submit']) || !empty($_POST['submit_back'])) {
            if ($this->_oUser->ValidateUserAdd($_POST)) {
                $result = $this->_oUser->Insert($_POST, $_FILES);
                $this->_oSession->set('message', $result->__toString());
                switch ($result->Type) {
                    case ErrorReporting::ERROR:
                    case ErrorReporting::WARNING:
                        url::redirect('4dminix/dodaj_uzytkownika');
                        break;
                    default:
                        if (isset($_POST['submit_back'])) {
                            url::redirect('4dminix/uzytkownicy');
                        } else {
                            url::redirect('4dminix/edytuj_uzytkownika/' . $result->Value);
                        }
                }
            }

            url::redirect('4dminix/uzytkownicy');
        }

        $this->_oTemplate->content->main_content = new View('admin_user_add');
        $this->_oTemplate->content->main_content->roles = $this->_oUser->FindAllRoles()->Value;
        $this->_oTemplate->title = Kohana::lang('user.add_user');
        $this->_oTemplate->render(true);
    }

    /**
     *
     * @param <type> $id
     */
    public function user_edit($id) {
        $this->authorize('users', 'edit');

        $id += 0;

        if (!empty($_POST['submit']) || !empty($_POST['submit_back'])) {
            if ($this->_oUser->ValidateUserEdit($_POST)) {
            	// @TODO Log action
            	// 
                // Kohana::log('error', print_r($_POST, true));
                $result = $this->_oUser->Update($id, $_POST, $_FILES);
                $this->_oSession->set('message', $result->__toString());
                switch ($result->Type) {
                    case ErrorReporting::ERROR:
                    case ErrorReporting::WARNING:
                        url::redirect('4dminix/edytuj_uzytkownika/' . $id);
                        break;
                    default:
                        if (isset($_POST['submit_back'])) {
                            url::redirect('4dminix/uzytkownicy');
                        } else {
                            url::redirect('4dminix/edytuj_uzytkownika/' . $id);
                        }
                }
            }
        }

        $this->_oTemplate->content->main_content = new View('admin_user_edit');
        $this->_oTemplate->content->main_content->userDetails = $this->_oUser->Find($id)->Value;
        $this->_oTemplate->content->main_content->roles = $this->_oUser->FindAllRoles()->Value;
        $this->_oTemplate->title = Kohana::lang('user.edit_user');
        $this->_oTemplate->render(true);
    }

    /**
     * @author Filip Górczyński <a href="mailto:filip.gorczynski@gmail.com">filip.gorczynski@gmail.com</a>
     *
     * @param integer $id
     */
    public function user_delete($iUserId = null) {
        $this->authorize('users', 'delete');

        if (!empty($_POST['user_check'])) {
            $aUsers = $_POST['user_check'];
            $this->_oSession->set('message', $this->_oUser->DeleteUsersArray($aUsers)->__toString());
            url::redirect('4dminix/uzytkownicy');
        } else if (!empty($iUserId)) {
            $result = $this->_oUser->Delete($iUserId);
            $this->_oSession->set('message', $result->__toString());
            url::redirect('4dminix/uzytkownicy');
        } else {
            $this->_oSession->set('message', '<div class="warning">' . Kohana::lang('user.no_users_selected_to_delete') . '</div>');
            url::redirect('4dminix/uzytkownicy');
        }
    }

    /**
     * @author Filip Górczyński <a href="mailto:filip.gorczynski@gmail.com">filip.gorczynski@gmail.com</a>
     *
     */
    public function roles_index() {
        $this->authorize('roles', 'index');

        $count = $this->_oUser->CountRoles()->Value;
        $oPagination = layer::GetPagination($count, '', layer::ADMIN_PER_PAGE);
        $limit = $oPagination->items_per_page;
        $offset = $oPagination->sql_offset;

        $this->_oTemplate->content->main_content = new View('admin_roles_index');
        $this->_oTemplate->content->main_content->roles = $this->_oUser->FindAllRoles($limit, $offset)->Value;
        $this->_oTemplate->content->main_content->oPagination = $oPagination;
        $this->_oTemplate->title = Kohana::lang('user.roles_index');
        $this->_oTemplate->render(true);
    }

    /**
     * @author Filip Górczyński <a href="mailto:filip.gorczynski@gmail.com">filip.gorczynski@gmail.com</a>
     *
     */
    public function role_add() {
        $this->authorize('roles', 'add');

        if (!empty($_POST['submit']) || !empty($_POST['submit_back'])) {
            if ($this->_oUser->ValidateRoleAdd($_POST)) {
                $result = $this->_oUser->InsertRole($_POST);
                $this->_oSession->set('message', $result->__toString());
                switch ($result->Type) {
                    case ErrorReporting::ERROR:
                    case ErrorReporting::WARNING:
                        url::redirect('4dminix/dodaj_role');
                        break;
                    default:
                        if (isset($_POST['submit_back'])) {
                            url::redirect('4dminix/role');
                        } else {
                            url::redirect('4dminix/edytuj_role/' . $result->Value);
                        }
                }
            }
        }

        $this->_oTemplate->content->main_content = new View('admin_role_add');
        $this->_oTemplate->content->main_content->roles = $this->_oUser->FindAllRoles()->Value;
        $this->_oTemplate->content->main_content->permissions = $this->_oUser->FindAllPermissions()->Value;
        $this->_oTemplate->title = Kohana::lang('user.add_role');
        $this->_oTemplate->render(true);
    }

    /**
     *
     * @param integer $id
     */
    public function role_edit($id) {
        $this->authorize('roles', 'edit');

        $id += 0;

        if (!empty($_POST['submit']) || !empty($_POST['submit_back'])) {
            if ($this->_oUser->ValidateRoleEdit($_POST)) {
                $result = $this->_oUser->UpdateRole($id, $_POST);
                $this->_oSession->set('message', $result->__toString());
                switch ($result->Type) {
                    case ErrorReporting::ERROR:
                    case ErrorReporting::WARNING:
                        url::redirect('4dminix/edytuj_role/' . $id);
                    default:
                        if (isset($_POST['submit_back'])) {
                            url::redirect('4dminix/role');
                        } else {
                            url::redirect('4dminix/edytuj_role/' . $id);
                        }
                }
            }
        }

        $this->_oTemplate->content->main_content = new View('admin_role_edit');
        $this->_oTemplate->content->main_content->oRoleDetails = $this->_oUser->FindRole($id)->Value;
        $this->_oTemplate->content->main_content->oRoles = $this->_oUser->FindAllRoles()->Value;
        $this->_oTemplate->content->main_content->oPermissions = $this->_oUser->FindAllPermissions()->Value;
        $this->_oTemplate->content->main_content->aUserPermissions = $this->_oUser->GetUserPermissions($id)->Value;
        $this->_oTemplate->title = Kohana::lang('user.edit_role');
        $this->_oTemplate->render(true);
    }

    /**
     *
     * @param integer $id
     */
    public function role_delete($id) {
        $this->authorize('roles', 'delete');

        $id += 0;

        if ($this->_oUser->AllowDeleteRole($id)->Value == true) {
            $result = $this->_oUser->DeleteRole($id);
            $this->_oSession->set('message', $result->__toString());
        } else {
            $result = $this->_oUser->ChangeRoleState($id);
        }
        $this->_oSession->set('message', $result->__toString());
        url::redirect('4dminix/role');
    }

    /**
     *
     */
    public function register() {
        if (!empty($_POST['submit'])) {
            $result = null;
            $validate = $this->_oUser->validateRegister($_POST);
            if ($validate->Value !== false) {
                $result = $this->_oUser->RegisterUser($_POST);
                $this->_oSession->set('message', $result->__toString());
            } else {
                $this->_oSession->set('message', $validate->__toString());
            }
            url::redirect('/');
        } else {
            $this->_oTemplate->content->main_content = new View('admin_user_login');
            $this->_oTemplate->title = Kohana::lang('user.admin_user_login');
            $this->_oTemplate->render(true);
        }
    }

    /**
     *
     */
    public function login() {
        
    }

    /**
     *
     */
    public function logout() {
        unset($_SESSION['_acl']);
        url::redirect('/4dminix');
        $this->admin_logout();
    }

    /**
     *
     */
    public function admin_logout() {
        unset($_SESSION['_acl']);
        url::redirect('4dminix/admin_logowanie');
    }

    /**
     *
     */
    public function admin_login() {
        if (!empty($_POST['submit'])) {
            $user = array();
            $result = $this->_oUser->AuthorizeUser($_POST);
            if ($result->Value != false) {
                $this->_oSession->set('message', $result->__toString());
                $_SESSION['_acl'] = $result->Value;
                $redUrl = $this->_oSession->get('requested_url');
                if (!empty($redUrl) && strstr($redUrl, '4dminix') !== false) {
                    url::redirect($redUrl);
                } else {
                    url::redirect('4dminix/');
                }
            } else {
                $this->_oTemplate->content->msg = $result->__toString();
            }
        }
        $this->_oTemplate->content->content_class_main = 'login';
        $this->_oTemplate->content->main_content = new View('admin_user_login');
        $this->_oTemplate->content->main_left = null;
        $this->_oTemplate->title = Kohana::lang('user.admin_user_login');
        $this->_oTemplate->render(true);
    }

    public function no_access() {
        $this->_oTemplate->content->main_content = new View('no_access');
        $this->_oTemplate->title = Kohana::lang('user.no_access_page');
        $this->_oTemplate->render(true);
    }

    /**
     *
     * @param String $username
     */
    public function create_users($username) {
        $result = null;
        if ($username == 'administrator') {
            $result = $this->_oUser->CreateUser('administrator', 'administrator', '4dminix');
        }
        if (!empty($result) && $result->Type == ErrorReporting::SUCCESS) {
            echo 'Dodano ' . $username . "\n";
        } else {
            echo 'Problem podczas dodawania ' . $username . "\n";
        }
    }

    /**
     * Odzyskiwanie hasła
     */
    public function recover_password() {
        if (isset($_POST['submit'])) {
            $result = $this->_oUser->RecoverPassword($_POST);
            $this->_oTemplate->content->msg = $result->__toString();
            $this->_oSession->set('message', $result->__toString());
//            if($result->Value !== false){
//                url::redirect('4dminix');
//            }
        }
        $this->_oTemplate->content->content_class_main = 'login';
        $this->_oTemplate->content->main_content = new View('admin_recover_password');
        $this->_oTemplate->content->main_left = null;
        $this->_oTemplate->sTitle = Kohana::lang('user.title.recover_password');
        $this->_oTemplate->render(true);
    }

}