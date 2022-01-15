<?php

class FriendsData
{
    protected $_count, $_f_id, $_status, $_id;

    public function __construct($dbRow) {
        $this->_count = $dbRow['COUNT'];
        $this->_f_id = $dbRow['F_ID'];
        $this->_status = $dbRow['STATUS'];
        $this->_id = $dbRow['ID'];
    }

    public function getCount() {
        return $this->_count;
    }

    public function getFID() {
        return $this->_f_id;
    }

    public function getStatus() {
        return $this->_status;
    }

    public function getID() {
        return $this->_id;
    }
}
