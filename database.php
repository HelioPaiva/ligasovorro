<?php
mysqli_report(MYSQLI_REPORT_STRICT);

function open_database() {
	try{
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    return $conn;
  }catch (Exception $e) {
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

function add($sql) {
  $database = open_database();
  try {
    //echo $sql;
    //exit();
    $database->query($sql);
  } catch (Exception $e) { 
    $_SESSION['message'] = 'Nao foi possivel realizar a operacao.';
    $_SESSION['type'] = 'danger';
  } 
  close_database($database);
}

function consulta_todos($sql = null) { 
    $database = open_database();
    $found = null;
    try {
        //echo $sql;
        //exit();
  $result = $database->query($sql);
  if ($result->num_rows > 0) {
            $found = $result->fetch_all(MYSQLI_ASSOC);
        }
  } catch (Exception $e) {
    $_SESSION['message'] = $e->GetMessage();
    $_SESSION['type'] = 'danger';
        }
  close_database($database);
  return $found;
}

function consulta_registro($sql) { 
    $database = open_database();
    $found = null;
    //echo $sql;
    try {
            $result = $database->query($sql);
      if ($result->num_rows > 0) {
        $found = $result->fetch_assoc();
      }  
  } catch (Exception $e) {
    $_SESSION['message'] = $e->GetMessage();
    $_SESSION['type'] = 'danger';
        }
  close_database($database);
  return $found;  
}



/********************************************************************************************/









