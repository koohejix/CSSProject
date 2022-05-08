<?php

class UsersData {

    public $_id, $_firstName, $_lastName, $_username, $_password, $_email, $_profilePic, $_latitude, $_longitude;

    public function __construct($dbRow) {
        $this->_id = $dbRow['ID'];
        $this->_firstName = $dbRow['FIRST_NAME'];
        $this->_lastName = $dbRow['LAST_NAME'];
        $this->_username = $dbRow['USERNAME'];
        $this->_password = $dbRow['PASSWORD'];
        $this->_email = $dbRow['EMAIL'];
        $this->_profilePic = $dbRow['PROFILE_PIC'];
        $this->_latitude = $dbRow['LATITUDE'];
        $this->_longitude = $dbRow['LONGITUDE'];
    }

    public function getID() {
        return $this->_id;
    }

    public function getFirstName() {
        return $this->_firstName;
    }

    public function getLastName() {
        return $this->_lastName;
    }

    public function getUsername() {
        return $this->_username;
    }

    public function getPassword() {
        return $this->_password;
    }

    public function getEmail() {
        return $this->_email;
    }

    public function getProfilePic() {
        return $this->_profilePic;
    }

    public function getLatitude() {
        return $this->_latitude;
    }

    public function getLongitude() {
        return $this->_longitude;
    }
}
