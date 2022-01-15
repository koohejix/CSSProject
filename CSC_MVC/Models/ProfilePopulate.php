<?php
require_once ('Database.php');
require_once ('UsersData.php');

class ProfilePopulate {
    protected $_dbHandle, $_dbInstance;

    public function __construct() {
        $this->_dbInstance = Database::getInstance();
        $this->_dbHandle = $this->_dbInstance->getdbConnection();
    }

    public function fetchUser($id) {
        $sqlQuery = "SELECT * FROM Users WHERE ID = '$id'";

        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement

        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new UsersData($row);
        }
        return $dataSet;
    }
}
