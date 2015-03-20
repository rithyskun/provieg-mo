<?php
class Persistence {    
    static public function register($key, $object) {
        $_SESSION['_persistence_'][$key] = serialize($object);
    }
    static public function lookup($key) {
        if(!isset($_SESSION['_persistence_'][$key]))
            return false;
        return unserialize($_SESSION['_persistence_'][$key]);
    }
    static public function destroy($key) {
        if(!isset($_SESSION['_persistence_'][$key]))
            throw new Exception('Objet persistent introuvable');
        unset($_SESSION['_persistence_'][$key]);
    }
}
?>