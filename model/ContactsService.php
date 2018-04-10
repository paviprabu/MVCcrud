<?php

require_once 'model/ContactsGateway.php';
require_once 'controller/ContactsController.php';
require_once 'model/ValidationException.php';


class ContactsService {
    
    private $contactsGateway    = NULL;
    private function openDb() {
        if (!mysqli_connect("localhost", "root", "","mvc-crud")) {
            throw new Exception("Connection to the database server failed!");
        }
        if (!mysqli_select_db(mysqli_connect("localhost", "root", "","mvc-crud"),"mvc-crud")) {
            throw new Exception("No mvc-crud database found on database server.");
        }
    }
    
    private function closeDb() {
        mysqli_close(mysqli_connect("localhost", "root", "","mvc-crud"));
    }
  
    public function __construct() {
        $this->contactsGateway = new ContactsGateway();
    }
    
    public function getAllContacts($order) {
        try {
            $this->openDb();
            $res = $this->contactsGateway->selectAll($order);
            $this->closeDb();
            return $res;
        } catch (Exception $e) {
            $this->closeDb();
            throw $e;
        }
    }
    
    public function getContact($id) {
        try {
            $this->openDb();
            $res = $this->contactsGateway->selectById($id);
            $this->closeDb();
            return $res;
        } catch (Exception $e) {
            $this->closeDb();
            throw $e;
        }
        return $this->contactsGateway->find($id);
    }
    
    private function validateContactParams( $name, $phone, $email, $address ) {
        $errors = array();
        if ( !isset($name) || empty($name) ) {
            $errors[] = 'Name is required';
        }
        if ( empty($errors) ) {
            return;
        }
        throw new ValidationException($errors);
    }
    
    public function createNewContact( $name, $phone, $email, $address ) {
        try {
            $this->openDb();
            $this->validateContactParams($name, $phone, $email, $address);
            $res = $this->contactsGateway->insert($name, $phone, $email, $address);
            $this->closeDb();
            return $res;
        } catch (Exception $e) {
            $this->closeDb();
            throw $e;
        }
    }

    public function deleteContact( $id ) {
        try {
            $this->openDb();
            $res = $this->contactsGateway->delete($id);
            var_dump($res);
            $this->closeDb();
        } catch (Exception $e) {
            $this->closeDb();
            throw $e;
        }
    }

    public function updateContact($id,$name,$phone,$email,$address)
    {
        $na = $name;
        $ph = $phone;
        $em = $email;
        $add = $address;
        try {
            $this->openDb();
            $res = $this->contactsGateway->update($id,$na,$ph,$em,$add);
            $this->closeDb();
        } catch (Exception $e) {
            $this->closeDb();
            throw $e;
        }
    }
    
    
}

?>
