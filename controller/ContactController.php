<?php
require_once 'model/ContactModel.php';

class ContactController extends ContactModel{

    public $cnn = null;

    public function getAll(){
        $this->cnn = $this->connect();
        return $result = $this->getAllContact($this->cnn);
    }

    public function add($data){

        $this->cnn = $this->connect();
        $verify = $this->findEmail($data['email'], $this->cnn);
        if (!$verify) {
            $result = $this->addContact($data, $this->cnn);
            return array('status' => true, "message" => "Contacto registrado correctamente");
        }else{
            return array('status' => false, "message" => "El correo insertado se encuentra registrado");
        }
    }

    public function delete($id){
        $this->cnn = $this->connect();
        return $result = $this->deleteContact($id, $this->cnn);
    }

    public function update($id){
        $this->cnn = $this->connect();
        return $result = $this->updateContact($id, $this->cnn);
    }

    public function validateFields($data){

        $validate_data = array('validate_data' => true, 'errors' => null);
        if (!$data['firstname']) {$validate_data['errors'][] = "El nombre es requerido";}
        if (!$data['lastname']) {$validate_data['errors'][] = "El apellido es requerido";}
        if (!$data['number']) {$validate_data['errors'][] = "El número a registrar es requerido";}

        $validate_data = $this->validateEmail($data['email'], $validate_data);
        $validate_data['status'] = $validate_data['errors'] ? false : true;
        return $validate_data;
    }

    function validateEmail($email, $validate_data) {
        
        if ($email) {
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $validate_data['errors'][] = "El email es inválido";
            }
        }else{
            $validate_data['errors'][] = "El email es requerido";
        }
        
        return $validate_data;
    }

    public function getCreateContactRequest(){

        try {
            $contact_data = array(
                'firstname'   => ucwords(trim($_REQUEST['firstname'])),
                'lastname' => ucwords(trim($_REQUEST['lastname'])),
                'email'  => strtolower(trim($_REQUEST['email'])),             
                'number'  => trim($_REQUEST['number'])           
            );
            $validate = $this->validateFields($contact_data);
            $result = $validate['status'] ? $this->add($contact_data) : $validate['errors'];
            return $result;
            
        } catch (Exception $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function getDeleteContactRequest($id){

        $this->cnn = $this->connect();
        $result = $this->deleteContact($id, $this->cnn);

        if($result){ 
            return "Contacto eliminado correctamente.";
        }else{
            return "No se encontraron contactos con este ID.";
        }
    }
}

?>