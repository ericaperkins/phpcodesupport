<?php
namespace interfaces\user;

interface UserInterface
{
    public function setUserEmail($userEmail):       void;

    public function setUserPassword($userPassword): void;

    public function getUserInformation($userKey):   array;
/*
    public function getUserEmail():    string;

    public function getUserPassword(): string;

    ericadperkins.com
*/
}
?>