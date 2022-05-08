<?php

require_once ('Database.php');
require_once ('FriendsData.php');
require_once ('UsersData.php');

class Friends
{
    protected $_dbHandle, $_dbInstance;

    public function __construct()
    {
        $this->_dbInstance = Database::getInstance();
        $this->_dbHandle = $this->_dbInstance->getdbConnection();
    }

    public function Add($myID, $friendID) {
        $sqlQuery = "INSERT INTO Users_Relations (F_ID, STATUS, ID) VALUES ('$friendID' , 'PENDING', '$myID')";
        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute();
    }

    public function Accept($myID, $friendID) {
        $sqlQuery = "UPDATE Users_Relations SET STATUS = 'ACCEPTED' WHERE F_ID = '$myID' AND ID = '$friendID'";
        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute();

        $sqlQuery = "INSERT INTO Users_Relations (F_ID, STATUS, ID) VALUES ('$friendID', 'ACCEPTED', '$myID')";
        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute();
    }

    public function displayPending ($userid) {
        $sqlQuery = "SELECT * FROM Users_Relations WHERE ID = '$userid' AND STATUS = 'PENDING'";
        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute();

        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new FriendsData($row);
        }

        $dataSet2 = [];

        foreach($dataSet as $user) {
            $id = $user->getFID();
            $sqlQuery2 = "SELECT * FROM Users WHERE ID = '$id'";
            $statement2 = $this->_dbHandle->prepare($sqlQuery2);
            $statement2->execute();
            $row = $statement2->fetch();
            $dataSet2[] = new UsersData($row);
        }
        return $dataSet2;
    }

    public function displayIncoming ($userid) {
        $sqlQuery = "SELECT * FROM Users_Relations WHERE F_ID = '$userid' AND STATUS = 'PENDING'";
        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute();

        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new FriendsData($row);
        }

        $dataSet2 = [];

        foreach($dataSet as $user) {
            $id = $user->getID();
            $sqlQuery2 = "SELECT * FROM Users WHERE ID = '$id'";
            $statement2 = $this->_dbHandle->prepare($sqlQuery2);
            $statement2->execute();
            $row = $statement2->fetch();
            $dataSet2[] = new UsersData($row);
        }
            return $dataSet2;
    }

    public function displayFriends ($userid) {
        $sqlQuery = "SELECT * FROM Users_Relations WHERE ID = '$userid' AND STATUS = 'ACCEPTED'";
        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute();

        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new FriendsData($row);
        }

        $dataSet2 = [];

        foreach($dataSet as $user) {
            $id = $user->getFID();
            $sqlQuery2 = "SELECT * FROM Users WHERE ID = '$id'";
            $statement2 = $this->_dbHandle->prepare($sqlQuery2);
            $statement2->execute();
            $row = $statement2->fetch();
            $dataSet2[] = new UsersData($row);
        }
        return $dataSet2;
    }

    public function checkFriend ($myID, $friendID) {
        $sqlQuery = "SELECT * FROM Users_Relations WHERE ID = '$myID' AND F_ID = '$friendID' AND STATUS = 'ACCEPTED'";
        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute();

        if ($statement->rowCount() > 0)
            return true;
        else
            return false;
    }
}
