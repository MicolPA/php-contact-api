<?php
require_once('controller/ContactController.php');

$method = mb_strtoupper($_SERVER['REQUEST_METHOD']);

$response = null;
$contactController = new ContactController();

if($method){
    
    switch ($method) {
        case 'GET':
            $response = $contactController->getAll();
            showMessage($response);
            break;

        case 'POST':
            $response = $contactController->getCreateContactRequest();
            showMessage($response);
            break;

        case 'DELETE':
            if (isset($_REQUEST['id'])) {
                $response = $contactController->getDeleteContactRequest($_REQUEST['id']);
                showMessage($response);
            }else{
                showMessage("Favor, insertar el id del contacto que desea eliminar.");
            }            
            break;

        default:
            header('HTTP/1.1 405 Method Not Allowed');
            header('Allow: GET, POST, DELETE');
            showMessage("No exite función para el método $method");
            break;
    }    

}else{
    showMessage("Métodos permitidos: GET, POST, DELETE");
}


function showMessage($mensaje){
    echo json_encode($mensaje);
}

?>