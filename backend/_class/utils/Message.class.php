<?php

class Message {
    
    const INFO  = 1;
    const AVERT = 2;
    const ERROR = 3;
    
    const CLASS_INFO  = 'info';
    const CLASS_AVERT = 'avert';
    const CLASS_ERROR = 'erreur';
    
    private $message;
    private $type;
    private $css;
    
    public function __construct($message, $type = self::INFO) {
        $this->message = $message;
        $this->type = $type;
        switch($type) {
            case self::INFO:
                $this->css = self::CLASS_INFO;
                break;
            case self::AVERT:
                $this->css = self::CLASS_AVERT;
                break;
            case self::ERROR:
                $this->css = self::CLASS_ERROR;
                break;
        }
    }
    
    public function getMessage() {
        return $this->message;
    }
    
    public function getClassMessage() {
        return $this->css;
    }
    
    public function __sleep() {
        $return[0] = 'message';
        $return[1] = 'type';
        $return[2] = 'css';
        return $return;
    }
    
}

?>