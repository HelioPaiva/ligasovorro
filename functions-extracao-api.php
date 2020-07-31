<?php 
$curl_handle=curl_init();
curl_setopt($curl_handle, CURLOPT_URL,'https://api.cartolafc.globo.com/atletas/mercado');
curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($curl_handle, CURLOPT_USERAGENT, 'Your application name');
$query = json_decode(curl_exec($curl_handle));
curl_close($curl_handle);

	echo '<pre>';
	print_r($query);

$i = 0;
for ($i=0; $i < count($query->atletas) ; $i++) { 
	echo $query->atletas[$i]->nome.' | '.$query->atletas[$i]->foto.' | '.$query->atletas[$i]->clube_id.'</br>';
	$i++;
}
echo $i;

/*
function add() {
	if (!empty($_POST['aluno'])) {
		$today = date_create('now', new DateTimeZone('America/Sao_Paulo'));
		$aluno = $_POST['aluno'];
		$aluno['dataCadastro'] = $today->format("Y-m-d H:i:s");
		$aluno['dataModificacao'] = $today->format("Y-m-d H:i:s");
		$aluno['status']='Ativo';
		$aluno['idUnidade']= $_SESSION['unidade'];
		$aluno['fase']= NULL;
		$aluno['dataFase']= NULL;

		$columns = null;
		$values = null;
		foreach ($aluno as $key => $value) {
			$columns .= trim($key, "'") . ",";
			$values .= "'$value',";
		}
		$columns = rtrim($columns, ',');
		$values = rtrim($values, ',');
		$sql = "INSERT INTO aluno " . "($columns)" . " VALUES " . "($values);";
		cadastro($sql);
		header('Location: cadastro-aluno.php?r=1');
	}
}
*/