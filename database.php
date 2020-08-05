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
    $database->query($sql);
  } catch (Exception $e) { 
    $_SESSION['message'] = 'Nao foi possivel realizar a operacao.';
    $_SESSION['type'] = 'danger';
  } 
  close_database($database);
}




/********************************************************************************************/









/**
 *  Pesquisa um Registro pelo ID em uma Tabela
 */
function find($sql = null, $codigo = null) { 
	$database = open_database();
	$found = null;
	try {
   if ($codigo) {
     $result = $database->query($sql);
     if ($result->num_rows > 0) {
       $found = $result->fetch_assoc();
     }
   }else {
    $result = $database->query($sql);
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()){
        $found[] = $row;
      }
     //$found = $result->fetch_all(MYSQLI_ASSOC);
   }
 }
} catch (Exception $e) {
 $_SESSION['message'] = $e->GetMessage();
 $_SESSION['type'] = 'danger';
}

close_database($database);
return $found;
}

function find_all($table) {
  return find($table);
}

/**
*  Insere um registro no BD
*/
function save($table = null, $data = null) {
  $database = open_database();
  $columns = null;
  $values = null;
  
  $colunas = null;
  $valores = null;
  
  foreach ($data as $key => $value) {
    $columns .= trim($key, "'") . ",";
    $values .= "'$value',";
  }

  // remove a ultima virgula
  $columns = rtrim($columns, ',');
  $values = rtrim($values, ',');
  
  $sql = "INSERT INTO " . $table . "($columns)" . " VALUES " . "($values);";

  try {
    $database->query($sql);
  } catch (Exception $e) { 
    $_SESSION['message'] = 'Nao foi possivel realizar a operacao.';
    $_SESSION['type'] = 'danger';
  } 
  close_database($database);
}

/**
 *  Atualiza um registro em uma tabela, por ID
 */
function update($table = null, $id = null, $data = null) {
  $database = open_database();
  $items = null;
  $items2 = null;
  $items3 = null;
  foreach ($data as $key => $value) {
    $items .= trim($key, "'") . "='$value',";
    if($table == "turma"){
      if($key === "'local'" || $key === "'modalidade'" || $key === "'fase'" || $key === "'dia'" || $key === "'inicio'"){
        $items2 .= trim($key, "'") . "='$value' AND ";
      }
      if($key == "'professor'"){
        $professor = ltrim(rtrim("'$value'","'"),"'");
      }
    }
    if($table == "pagamento"){
      $idPagamento = $id;
        //if($key == "'id'"){
        //    $idPagamento = ltrim(rtrim("'$value'","'"),"'");
        //}
      if($key === "'dataPagamento'" || $key === "'multa'" || $key === "'mora'" || $key === "'material'" || $key === "'valorMaterial'" || $key === "'valorLiquido'"){
        $items3 .= trim($key, "'") . "='$value' , ";
      }
    }
  }
  
  // remove a ultima virgula
  $items = rtrim($items, ',');
  $sql  = "UPDATE " . $table;
  $sql .= " SET $items";
  $sql .= " WHERE id=" . $id . ";";
  
  if($table == "turma"){   
    $sql2 = "";
    $items2 = rtrim($items2, ',');
    $items2 .= "status='Ativo'";
    $sql2 .= "UPDATE matricula ";
    $sql2 .= "SET professor = '" . $professor ."'";
    $sql2 .= " WHERE " . $items2 . ";";
    
    //print $sql2;
    
    try {
      $database->query($sql2);
      $_SESSION['message'] = 'Registro atualizado com sucesso.';
      $_SESSION['type'] = 'success';
    } catch (Exception $e) { 
      $_SESSION['message'] = 'Nao foi possivel realizar a operacao.';
      $_SESSION['type'] = 'danger';
    }
    
  }
  if($table == "pagamento"){   
    $sql3 = "";
    $items3 = rtrim($items3, ',');
    $items3 .= "status='Pago'";
    $sql3 .= "UPDATE pagamento ";
    $sql3 .= " SET $items3";
    $sql3 .= " WHERE id=" . /*substr($items2,0,-4)*/ $idPagamento . ";";

    //echo $sql3;
    
    try {
      $database->query($sql3);
    //$_SESSION['message'] = 'Registro atualizado com sucesso.';
    //$_SESSION['type'] = 'success';
      header('Location: cobranca_1.php?id=0&nome=""&r=1');
    } catch (Exception $e) { 
      $_SESSION['message'] = 'Nao foi possivel realizar a operacao.';
      $_SESSION['type'] = 'danger';
    }
    
  }
  try {
    $database->query($sql);
    //echo $sql;
    //$_SESSION['message'] = 'Registro atualizado com sucesso.';
    //$_SESSION['type'] = 'success';
    if($table == "usuario"){
      header('Location: editar-usuario.php?r=1');
    }else if($table == "aluno"){
      header('Location: editar-aluno.php?r=1');
    }else if($table == "matricula"){
      header('Location: editar-matricula.php?r=1');
    }
    else if($table == "experimental"){
      header('Location: editar-aula-experimental.php?r=1');
    }
    else if($table == "reposicao"){
      header('Location: editar-reposicao.php?r=1');
    }
  } catch (Exception $e) { 
    $_SESSION['message'] = 'Nao foi possivel realizar a operacao.';
    $_SESSION['type'] = 'danger';
  } 
  close_database($database);
}

/**Preenche Combo*/
function find_combo( $table = null, $tipo = null, $u = null) {
	$database = open_database();
	$found = null;
	//Código usado para preencher o campo de professor
  if($tipo == 'professor'){
    $sql = "SELECT * FROM usuario where perfil = 4 and idUnidade = '" . $u . "'";
    $result = $database->query($sql);
  }elseif($tipo == 'aluno'){
    $sql = "SELECT * FROM aluno ";
    $result = $database->query($sql);
  }elseif($tipo == 'local'){
    $sql = "SELECT distinct local FROM plano ";
    $result = $database->query($sql);
  }elseif($tipo == 'frequencia'){
    $sql = "SELECT distinct frequencia FROM plano ";
    $result = $database->query($sql);
  }elseif($tipo == 'modalidade'){
    $sql = "SELECT distinct modalidade FROM plano ";
    $result = $database->query($sql);
  }elseif($tipo == 'plano'){
    $sql = "SELECT distinct plano FROM plano ";
    $result = $database->query($sql);
  }elseif($tipo == 'dia'){
    $sql = "SELECT distinct s.id, a.dia FROM turma a, semana s where a.dia = s.dia order by s.id asc;";
    $result = $database->query($sql);
  }elseif($tipo == 'inicio'){
    $sql = "SELECT distinct inicio FROM turma ";
    $result = $database->query($sql);
  }elseif($tipo == 'fim'){
    $sql = "SELECT distinct fim FROM turma ";
    $result = $database->query($sql);
  }elseif($tipo == 'fase'){
    $sql = "SELECT distinct fase FROM turma ";
    $result = $database->query($sql);
  }
  elseif($tipo == 'local'){
    $sql = "SELECT distinct local FROM plano ";
    $result = $database->query($sql);
  }
  elseif($tipo == 'dia'){
    $sql = "SELECT * FROM turma ";
    $result = $database->query($sql);
  }
  if ($result->num_rows > 0) {
    $found = $result->fetch_all(MYSQLI_ASSOC);
  }
  close_database($database);
  return $found;
}
function findAjax($table = null, $l = null, $f = null, $m = null, $p = null, $u = null) {

	$database = open_database();
	$found = null;
	try {
   if ($l) {
     $sql = "SELECT * FROM " . $table . " WHERE local = '" . $l . "'" . " AND frequencia = '" . $f . "'" . " AND modalidade = '" . $m . "'" . " AND plano = '" . $p . "'" . " AND idUnidade = '".$u ."'";
     $result = $database->query($sql);
	    //echo $sql;
     if ($result->num_rows > 0) {
       $found = $result->fetch_assoc();
     }

   } 
 } catch (Exception $e) {
   $_SESSION['message'] = $e->GetMessage();
   $_SESSION['type'] = 'danger';
 }

 close_database($database);
 return $found;
}

function findAjaxTurma($table = null, $local = null, $modalidade = null, $fase = null, $dia = null, $inicio = null, $u = null) {

	$database = open_database();
	$found = null;
	try {
   if ($local) {
     $sql = "SELECT * FROM " . $table . " WHERE local = '" . $local . "'" . " AND modalidade = '" . $modalidade . "'" . " AND fase = '" . $fase . "'" . " AND dia = '" . $dia . "'" . " AND inicio = '" . $inicio . "'". " AND idUnidade = '".$u ."'";
     $result = $database->query($sql);
	    //echo $sql;
     if ($result->num_rows > 0) {
       $found = $result->fetch_assoc();
     }
   } 
 } catch (Exception $e) {
   $_SESSION['message'] = $e->GetMessage();
   $_SESSION['type'] = 'danger';
 }

 close_database($database);
 return $found;
}


function validarCPF($table = null, $cpf = null) {

	$database = open_database();
	$found = null;
	try {
   if ($cpf) {
     $sql = "SELECT * FROM " . $table . " WHERE cpf = '" . $cpf . "'";
            //echo '1' + $sql;
     $result = $database->query($sql);
     if ($result->num_rows > 0) {
       $found = $result->fetch_assoc();
     } 
   }
 } catch (Exception $e) {
   $_SESSION['message'] = $e->GetMessage();
   $_SESSION['type'] = 'danger';
 }

 close_database($database);
 return $found;
}

function validarUsuario($login = null){
  $database = open_database();
  $found = null;
  try {
   if ($login) {
     $sql = "SELECT * FROM usuario WHERE login = '" . $login . "'";
     $result = $database->query($sql);
     if ($result->num_rows > 0) {
       $found = $result->fetch_assoc();
     }

   }
 } catch (Exception $e) {
   $_SESSION['message'] = $e->GetMessage();
   $_SESSION['type'] = 'danger';
 }

 close_database($database);
 return $found;
}
function atualizarSenha($id, $senha){
  $database = open_database();
  $sql  = "UPDATE usuario SET senha = '" . $senha . "' WHERE id = " . $id;
    //echo $sql;
  try {
    $database->query(utf8_decode($sql));
    $_SESSION['message'] = 'Registro atualizado com sucesso.';
    $_SESSION['type'] = 'success';
  } catch (Exception $e) { 
    $_SESSION['message'] = 'Nao foi possivel realizar a operacao.';
    $_SESSION['type'] = 'danger';
  } 
  close_database($database);
}

function gerarContrato($id = null){
  $database = open_database();
  $found = null;
  try {
   if ($id) {
     $sql  = "select a.nome, a.dataNascimento, a.rg, a.cpf, a.responsavel, m.modalidade, m.dataInicioPag,
     m.dataFimPag, m.plano, m.diaPagamento, m.mensalidade, m.valorDesc 
     from matricula m,
     aluno a
     where m.idAluno = a.id and m.id=" . $id;
            //echo '1' + $sql;
     $result = $database->query($sql);
     if ($result->num_rows > 0) {
       $found = $result->fetch_assoc();
     }
   }else {
     $sql  = "select a.nome, a.dataNascimento, a.rg, a.cpf, a.responsavel, m.modalidade, m.dataInicioPag,
     m.dataFimPag, m.plano, m.diaPagamento, m.mensalidade 
     from matricula m,
     aluno a
     where m.idAluno = a.id and m.id=" . $id;
	    //echo '3' + $sql;
     $result = $database->query($sql);
     if ($result->num_rows > 0) {
       $found = $result->fetch_all(MYSQLI_ASSOC);
     }
   }
 } catch (Exception $e) {
   $_SESSION['message'] = $e->GetMessage();
   $_SESSION['type'] = 'danger';
 }

 close_database($database);
 return $found;
}

function find_combo_frequencia_local($table = null, $id = null) {
  $database = open_database();
  $found = null;
	//Código usado para preencher o campo de professor
  if($table == 'turma'){
    $sql = "SELECT distinct local FROM turma";
            //echo $sql;
    $result = $database->query($sql);
  }
  if ($result->num_rows > 0) {
    $found = $result->fetch_all(MYSQLI_ASSOC);
  }
  close_database($database);
  return $found;
}

function find_combo_frequencia_fase($table = null, $id = null) {
  $database = open_database();
  $found = null;
	//Código usado para preencher o campo de professor
  if($table == 'turma'){
    $sql = "SELECT distinct fase FROM turma";
            //echo $sql;
    $result = $database->query($sql);
  }
  if ($result->num_rows > 0) {
    $found = $result->fetch_all(MYSQLI_ASSOC);
  }
  close_database($database);
  return $found;
}
function find_combo_frequencia_dia($table = null, $id = null) {
  $database = open_database();
  $found = null;
	//Código usado para preencher o campo de professor
  if($table == 'turma'){
    $sql = "SELECT distinct dia FROM turma";
            //echo $sql;
    $result = $database->query($sql);
  }
  if ($result->num_rows > 0) {
    $found = $result->fetch_all(MYSQLI_ASSOC);
  }
  close_database($database);
  return $found;
}
function find_combo_frequencia_inicio($table = null, $id = null) {
  $database = open_database();
  $found = null;
	//Código usado para preencher o campo de professor
  if($table == 'turma'){
    $sql = "SELECT distinct inicio FROM turma";
            //echo $sql;
    $result = $database->query($sql);
  }
  if ($result->num_rows > 0) {
    $found = $result->fetch_all(MYSQLI_ASSOC);
  }
  close_database($database);
  return $found;
}
function find_frequencia_aluno($table = null, $data = null){
  $database = open_database();
    //$columns = null;
    //$values = null;
    //foreach ($data as $key => $value) {
    //    $columns .= trim($key, "'") . ",";
    //    $values .= "'$value',";
    //}
  $sql = "SELECT * FROM " . $table . ";";
  print_r($data);   
}