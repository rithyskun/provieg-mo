<?php
/**
* A class that takes the pain out of the $_FILES array
* @author Christiaan Baartse <christiaan@baartse.nl>
*/
class UploadedFiles extends ArrayObject
{
    public function current() {
        return $this->_normalize(parent::current());
    }

    public function offsetGet($offset) {
        return $this->_normalize(parent::offsetGet($offset));
    }

    protected function _normalize($entry) {
        if(isset($entry['name']) && is_array($entry['name'])) {
            $files = array();
            foreach($entry['name'] as $k => $name) {
                $files[$k] = array(
                    'name' => $name,
                    'tmp_name' => $entry['tmp_name'][$k],
                    'size' => $entry['size'][$k],
                    'type' => $entry['type'][$k],
                    'error' => $entry['error'][$k]
                );
            }
            return new self($files);
        }
        return $entry;
    }
}
?>