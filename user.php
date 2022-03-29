<?php

namespace classes\user;

use classes\connection\DatabaseConnection as DatabaseConnection;

const USER_INTERFACE = "interfaces/UserInterface.php";

require(USER_INTERFACE);

class User implements \interfaces\User\UserInterface
{
    private $_userEmail = "";

    private $_password  = "";

    public function setUserEmail($userEmail): void
    {
        $this->_userEmail = $userEmail;
    }

    public function setUserPassword($userPassword): void
    {
        $this->_password  = $userPassword;
    }

    public function sendUserInformation(): void
    {
        $email     = $this->_userEmail;

        $password  = $this->_password;

        $connect   = new DatabaseConnection();

        $query     = "INSERT INTO users (email, password) VALUES (?, ?)";

        ob_start();

        $statement = $connect->accessDatabase(true)->prepare($query);

        $statement->bind_param("ss", $email, $password);

        $statement->execute();

        ob_end_clean();

        $connect->accessDatabase(false);
    }

    public function getUserInformation($userKey): array
    {
        $connect   = new DatabaseConnection();

        ob_start();

        $statement = $connect->accessDatabase(true)->prepare("SELECT * FROM users WHERE email =?");

        $statement->bind_param("s", $userKey);

        $statement->execute();

        $results   = $statement->get_result();

        $userInformation = $results->fetch_assoc();

        ob_end_clean();

        if ($userInformation == NULL) {

            $userInformation = array("errorType" => "typeof() error: &nbsp;</b>", "errorMessage" => "Incorrect email address. Users information array contained NULL.");
        }
        return $userInformation;
    }
}
/*
ericadperkins.com
*/