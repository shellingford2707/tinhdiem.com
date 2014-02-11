<?php
class Clazz{
    private $classID;
    private $className;
    
    public function getClassID() {
        return $this->classID;
    }

    public function getClassName() {
        return $this->className;
    }

    public function setClassID($classID) {
        $this->classID = $classID;
    }

    public function setClassName($className) {
        $this->className = $className;
    }
}
