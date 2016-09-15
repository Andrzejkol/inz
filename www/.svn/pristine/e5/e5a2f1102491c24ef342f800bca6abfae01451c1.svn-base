<?php
class ErrorReporting {
    const INFO = 0;
    const WARNING = 1;
    const ERROR = 2;
    const SUCCESS = 4;
    const NONE = 8;
    
    private $_message = '';
    private $_class = '';
    private $_type;
    private $_value = null;

    /**
     *
     * @param ErrorReportingType $type
     * @param mixed $value
     * @param String $message
     */
    public function __construct($type, $value, $message = '') {
        $this->_type = $type;
        $this->_value = $value;
        $this->_message = $message;
        switch($this->_type) {
            case ErrorReporting::ERROR:
                $this->_class = 'error';
                break;
            case ErrorReporting::WARNING:
                $this->_class = 'warning';
                break;
            case ErrorReporting::INFO:
                $this->_class = 'info';
                break;
            case ErrorReporting::SUCCESS:
                $this->_class = 'success';
                break;
        }
    }

    /**
     *
     * @param String $key
     * @return mixed
     */
    public function __get($key) {
        switch($key) {
            case 'Message':
                return $this->_message;
                break;
            case 'Class':
                return $this->_class;
                break;
            case 'Type':
                return $this->_type;
                break;
            case 'Value':
                return $this->_value;
                break;
        }
    }

    /**
     *
     * @param String $key
     * @param mixed $value
     * @return mixed
     */
    public function __set($key, $value) {        
        switch($key) {
            case 'Message':
                return $this->_message = $value;
                break;
            case 'Class':
                return $this->_class = $value;
                break;
            case 'Type':
                return $this->_type = $value;
                break;
            case 'Value':
                return $this->_value = $value;
                break;
        }
    }

    public function __toString() {
        return '<div class="'.$this->_class.'">'.$this->_message.'</div>';
    }


}
