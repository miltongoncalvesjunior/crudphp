<?php
require_once('../config.php');
require_once(DBAPI);

$customers = null;
$customer = null;

/**

*/
function index(){
    global$customers;
    $customers = find_all('customers');
        
 }

 /** Cadastro de cliente*/
 function add(){

    if (!empty($_POST['customer'])){

        $today = date_create('now', new DateTimeZone('America/Sao_paulo'));

        $customer = $_POST['customer'];
        $customer['modified'] = $customer['created'] = $today->format("Y-m-d H:i:s");

        save('customers',$customer);

        header('location:');



}

 /**	 *	Atualizacao/Edicao de Cliente	 */	
function edit() {	
    $now = date_create('now', new DateTimeZone('America/Sao_Paulo'));	
    if (isset($_GET['id'])) {	
      $id = $_GET['id'];	
      if (isset($_POST['customer'])) {	
        $customer = $_POST['customer'];	      
        $customer['modified'] = $now->format("Y-m-d H:i:s");	
        update('customers', $id, $customer);	      
    header('location: index.php');	    } 
        else {	
        global $customer;	      
        $customer = find('customers', $id);	    } 	  
    } else {	    
    header('location: index.php');	  
    }
}
}

/**	 *  Visualização de um Cliente	 */	
function view($id = null) {	  
    global $customer;	  
    $customer = find('customers', $id);	
}
