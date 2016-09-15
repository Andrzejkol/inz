<?php

defined('SYSPATH') OR die('No direct access allowed.');

class Configurations_Controller extends Admin_Controller {

    private $_oConfiguration;

    const ALLOW_PRODUCTION = TRUE;

    public function __construct() {
        parent::__construct();
        $this->_oConfiguration = new Configuration_Model();
        $this->_oTemplate->header->hover = 'configurations';
    }

    public function index() {
        $this->authorize('configurations', 'index');
        if (!empty($_FILES['logo']['tmp_name'])) {
            $uploadedFiles = file::upload(
                            $_FILES['logo'], array(
                        'width' => 500,
                        'height' => 500,
                        'thumbwidth' => 150,
                        'thumbheight' => 150,
                        'path' => 'files/users/big/',
                        'thumbpath' => 'files/users/small/',
                            )
            );
            Kohana::log('alert', $uploadedFiles);
            /*   $uploadFile = $_FILES['logo']['tmp_name'];
              $uploadName = $_FILES['logo']['name'];
              $uploadSize = $_FILES['logo']['size'];
              $file = "files/users/big/$uploadName"; */
            //unlink($uploadFile);

            $_POST['logo'] = 'files/users/small/' . $uploadedFiles->Value['filename'];
        }

        if (!empty($_POST)) {
            $result = $this->_oConfiguration->Update($_POST);
            $this->_oSession->set('message', $result->__toString());
            url::redirect('4dminix/ustawienia');
        }

        $this->_oTemplate->content->main_content = new View('admin_configuration');
        $this->_oTemplate->content->main_content->oConfigurations = $this->_oConfiguration->FindAll()->Value;
        $this->_oTemplate->title = Kohana::lang('configuration.title.configuration_index');
        $this->_oTemplate->render(true);
    }

}
