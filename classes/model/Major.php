<?php

class Major {
    private $majorID;
    private $majorName;
    public function getMajorID() {
        return $this->majorID;
    }

    public function getMajorName() {
        return $this->majorName;
    }

    public function setMajorID($majorID) {
        $this->majorID = $majorID;
    }

    public function setMajorName($majorName) {
        $this->majorName = $majorName;
    }


}
