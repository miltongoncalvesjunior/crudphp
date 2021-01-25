<?php

mysqli_report(MYSQLI_REPORT_STRICT);
           


function open_database() {
    try {
        $conn = new mysqli($host = '127.0.0.1', $user = 'root', $password = '121513', $database = 'crud');
             return $conn;
    } catch (Exception $e) {
        echo $e->getMessage();
        return null;
    }
}
function close_database($conn) {
    try {
         mysqli_close($conn);
    } catch (Exception $e) {
        echo $e->getMessage();
        
    }
}

function find( $table = null, $id = null ) {
    $database = open_database();
    $found = null;
    try {
        if ($id) {
            $sql = "SELECT * FROM " . $table . " WHERE id = " . $id;
            $result = $database->query($sql);

            if ($result->num_rows > 0) {
                $found = $result->fetch_assoc();
            }
        }else{
            $sql = "SELECT * FROM " . $table;
            $result = $database->query($sql);

            if ($result->num_rows > 0) {
                $found = $result->fetch_all(MYSQLI_ASSOC);
        }
    }    
}catch (Exception $e) {
    $_SESSION['message'] = $e->GetMessage();
    $_SESSION['type'] = 'danger';
}
    close_database($database);
        return $found;
}
function find_all( $table ) {
    return find($table);
}



/**	*  Insere um registro no BD	*/	
function save($table = null, $data = null) {	
  $database = open_database();	
  $columns = null;	  
  $values = null;	
  
  //print_r($data);	
  
  foreach ($data as $key => $value) {	    
      $columns .= trim($key, "'") . ",";	    
      $values .= "'$value',";	  }	
  
      // remove a ultima virgula	  $columns = rtrim($columns, ',');	  $values = rtrim($values, ',');	  	  $sql = "INSERT INTO " . $table . "($columns)" . " VALUES " . "($values);";	
  
  try {	    
    $database->query($sql);	
    $_SESSION['message'] = 'Registro cadastrado com sucesso.';	    
    $_SESSION['type'] = 'success';	  	  
} catch (Exception $e) { 	  	    
    $_SESSION['message'] = 'Nao foi possiavel realizar  operacao.';	    
    $_SESSION['type'] = 'danger';	  } 	
  
    close_database($database);	
    }

    /**	 *  Atualiza um registro em uma tabela, por ID	 */

    function update($table = null, $id = 0, $data = null) {	
        $database = open_database();	
        $items = null;	
        foreach ($data as $key => $value) {	    
            $items .= trim($key, "'") . "='$value',";	  
        }

        // remove a ultima virgula	  $items = rtrim($items, ',');	
        
        $sql  = "UPDATE " . $table;	  
        $sql .= " SET $items";	  
        $sql .= " WHERE id=" . $id . ";";	
        try {	    $database->query($sql);	
          $_SESSION['message'] = 'Registro atualizado com sucesso.';	    
          $_SESSION['type'] = 'success';	
        } catch (Exception $e) { 	
          $_SESSION['message'] = 'Nao foi possivel realizar a operacao.';	    
          $_SESSION['type'] = 'danger';	  } 	
        close_database($database);	
    }
