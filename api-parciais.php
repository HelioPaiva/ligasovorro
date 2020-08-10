<?php
require_once('config.php');
require_once(DBAPI);

$curl_handle=curl_init();
curl_setopt($curl_handle, CURLOPT_URL,'https://api.cartolafc.globo.com/atletas/pontuados');
curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($curl_handle, CURLOPT_USERAGENT, 'Your application name');
$query = json_decode(curl_exec($curl_handle),true);
curl_close($curl_handle);

//Limpa tabela
$sql = "delete from api_parciais";
add($sql);

//Consultar id dos atletas escalados pelo times da liga
$sql = "SELECT distinct atleta_id FROM api_time_escalado where rodada = 1";
$id_jogadores = consulta_todos($sql);

foreach ($id_jogadores as $jogador) {
	$id_atleta =  $jogador['atleta_id'];
	//echo $id_atleta.'</br>';
	$size = count($query["atletas"]);
	if (array_key_exists($id_atleta, $query["atletas"])) {
		//echo $id_atleta.'-'.$query["atletas"][$id_atleta]['pontuacao'].'</br>';
		$sql = "insert into api_parciais(rodada,atleta_id,pontos) values ('1','".$id_atleta."','".$query["atletas"][$id_atleta]['pontuacao']."');";
		echo $sql;
		//add($sql);
	}
}

echo 'OK';


	//foreach ($query->atletas as $value) {
	//	echo $query->atletas->{$id_atleta}->apelido.'</br>';
	//	echo $query->atletas->{$id_atleta}->pontuacao.'</br>';
	//}

/*
foreach ($query->atletas as $value) {
	echo $query->atletas->{'101201'}->apelido.'</br>';
	echo $query->atletas->{'101201'}->pontuacao.'</br>';
}
*/

/*
$size = count($query["atletas"]);

for ($i=0; $i < $size ; $i++) { 
	echo $query["atletas"]['101201']['apelido'];
}
*/

//echo '<pre>';
//print_r($query);


?>