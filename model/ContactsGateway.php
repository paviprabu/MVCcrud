<?php
/**
 * Table data gateway.
 * 
 *  OK I'm using old MySQL driver, so kill me ...
 *  This will do for simple apps but for serious apps you should use PDO.
 */
class ContactsGateway {
    
    public function selectAll($order) {
        if ( !isset($order) ) {
            $order = "name";
        }
        $dbOrder =  mysqli_real_escape_string(mysqli_connect("localhost", "root", "","mvc-crud"),$order);
        $dbres = mysqli_query(mysqli_connect("localhost", "root", "","mvc-crud"),"SELECT * FROM contacts ORDER BY $dbOrder ASC");
        
        $contacts = array();
        
        if ($result = $dbres) {
            while ( ($obj = mysqli_fetch_object($result)) != NULL ) {
            $contacts[] = $obj;
            }
        }
        
        return $contacts;
    }
    
    public function selectById($id) {
        $dbId = mysqli_real_escape_string(mysqli_connect("localhost", "root", "","mvc-crud"),$id);
        
        $dbres = mysqli_query(mysqli_connect("localhost", "root", "","mvc-crud"),"SELECT * FROM contacts WHERE id=$dbId");
        
        return mysqli_fetch_object($dbres);
		
    }
    
    public function insert( $name, $phone, $email, $address ) {
        
        $dbName = ($name != NULL)?"'".mysqli_real_escape_string(mysqli_connect("localhost", "root", "","mvc-crud"),$name)."'":'NULL';
        $dbPhone = ($phone != NULL)?"'".mysqli_real_escape_string(mysqli_connect("localhost", "root", "","mvc-crud"),$phone)."'":'NULL';
        $dbEmail = ($email != NULL)?"'".mysqli_real_escape_string(mysqli_connect("localhost", "root", "","mvc-crud"),$email)."'":'NULL';
        $dbAddress = ($address != NULL)?"'".mysqli_real_escape_string(mysqli_connect("localhost", "root", "","mvc-crud"),$address)."'":'NULL';
        
        mysqli_query(mysqli_connect("localhost", "root", "","mvc-crud"),"INSERT INTO contacts (name, phone, email, address) VALUES ($dbName, $dbPhone, $dbEmail, $dbAddress)");
        return mysqli_insert_id();
    }
    
    public function delete($id) {
        $dbId = mysqli_real_escape_string(mysqli_connect("localhost", "root", "","mvc-crud"),$id);
        mysqli_query(mysqli_connect("localhost", "root", "","mvc-crud"),"DELETE FROM contacts WHERE id=$dbId");
    }

    public function update($id,$name,$phone,$email,$address) {
        $uname = $name;
        $uphone = $phone;
        $uemail = $email;
        $uaddr = $address;
       // $dbId = mysqli_real_escape_string(mysqli_connect("localhost", "root", "","mvc-crud"),$id);
 $update=mysqli_query(mysqli_connect("localhost", "root", "","mvc-crud"),"UPDATE contacts SET name ='$uname',phone ='$uphone',email='$uemail',address='$uaddr'WHERE id=$id");
    }
}

?>
