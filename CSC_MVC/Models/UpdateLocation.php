<?php

require_once ('Database.php');

class UpdateLocation
{
    protected $_dbHandle, $_dbInstance;

    public function __construct()
    {
        $this->_dbInstance = Database::getInstance();
        $this->_dbHandle = $this->_dbInstance->getdbConnection();
    }

    public function updateLocation($myID, $lat, $long) {
        $sqlQuery = "UPDATE Users SET LATITUDE = '$lat' AND LONGITUDE = '$long' WHERE ID = '$myID'";
        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute();
    }
}
