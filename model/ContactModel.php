<?php 

require_once 'config/Conexion.php';

class ContactModel extends Conexion {

    public function getAllContact($cnn){
        
        try {
            $query = 'SELECT * FROM contact order by id desc';
            $stmt = $cnn->prepare($query);
            $stmt->execute();
            return $result = $stmt->fetchAll(PDO::FETCH_OBJ);

        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
            die();
        }

    }

    public function getContactById($id,$cnn){
        
        try {
            $query = 'SELECT * FROM contact where id = :id order by id desc';
            $stmt = $cnn->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $result = $stmt->fetch(PDO::FETCH_OBJ);
        
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
            die();
        }

    }

    public function findEmail($email,$cnn){
        
        try {
            $query = 'SELECT * FROM contact where email =:email';
            $stmt = $cnn->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_OBJ);
            return $result ? true : false;
        
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
            die();
        }

    }

    public function addContact($contact,$cnn){
        
        try {

            $query = 'INSERT INTO contact(firstname, lastname, email, number, date) VALUES(:firstname,:lastname,:email,:number,:date)';
            $stmt = $cnn->prepare($query);
            $rs = $stmt->execute(array(
                ":firstname"   => $contact['firstname'],
                ":lastname" => $contact['lastname'],
                ":email"  => $contact['email'],
                ":number"  => $contact['number'],
                ":date" => date("Y-m-d H:i:s")
            ));
            return $rs;

        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
            die();
        }
    }

    public function deleteContact($id,$cnn){
        
        try {

            $query = 'DELETE FROM contact WHERE id =:id';
            $stmt = $cnn->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->rowCount() ? true : false;

        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
            die();
        }

    }

}

?>
