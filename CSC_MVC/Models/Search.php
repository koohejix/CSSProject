<?php
require_once ('Database.php');
require_once ('UsersData.php');

class Search
{
    protected $_dbHandle, $_dbInstance;

    public function __construct()
    {
        $this->_dbInstance = Database::getInstance();
        $this->_dbHandle = $this->_dbInstance->getdbConnection();
    }

    public function searchDatabase($content) {

        $search = explode(" ", $content);
        $dataSet = [];

        foreach($search as $s) {
            $sqlQuery = "SELECT * FROM Users WHERE FIRST_NAME LIKE '$s' OR 
                     LAST_NAME LIKE '$s' OR USERNAME LIKE '$s'";

            $statement = $this->_dbHandle->prepare($sqlQuery);
            $statement->execute();

            while ($row = $statement->fetch()) {
                $dataSet[] = new UsersData($row);
            }
        }
        return $dataSet;
    }
}