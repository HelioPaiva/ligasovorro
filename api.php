<?php
require_once('config.php');
require_once(DBAPI);



$curl_handle=curl_init();
//curl_setopt($curl_handle, CURLOPT_URL,'https://api.cartolafc.globo.com/atletas/mercado');
//curl_setopt($curl_handle, CURLOPT_URL,'https://api.cartolafc.globo.com/time/id/7875271/1');
curl_setopt($curl_handle, CURLOPT_URL,'https://api.cartolafc.globo.com/atletas/pontuados');
curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($curl_handle, CURLOPT_USERAGENT, 'Your application name');
$query = json_decode(curl_exec($curl_handle),true);
curl_close($curl_handle);

/*
$id_time = array('7875271'
	'102912',
	'327259',
	'422412',
	'659081',
	'1057418',
	'1069861',
	'1571824',
	'1757781',
	'2013858',
	'2053459',
	'2282378',
	'2282450',
	'2386095',
	'2522508',
	'2811655',
	'2856742',
	'3242927',
	'3479484',
	'4837060',
	'4871757',
	'7880646',
	'8552587',
	'8959812',
	'11564425',
	'13226524',
	'13928343',
	'14014661',
	'14217029',
	'14390263',
	'15787510',
	'18215723',
	'23965873',
	'26036080',
	'26164039',
	'26308499',
);
*/


/*
for ($i=0; $i < count($query->atletas) ; $i++) { 
		//echo $query->atletas[$i]->nome.' | '.$query->atletas[$i]->foto.' | '.$query->atletas[$i]->clube_id.'</br>';
		$sql = "insert into api_mercado(atleta_id,nome,slug,apelido,foto,rodada_id,clube_id,posicao_id,status_id,pontos_num,preco_num,variacao_num,media_num,jogos_num) values ('".$query->atletas[$i]->atleta_id."','".$query->atletas[$i]->nome."','".$query->atletas[$i]->slug."','".$query->atletas[$i]->apelido."','".$query->atletas[$i]->foto."','".$query->atletas[$i]->rodada_id."','".$query->atletas[$i]->clube_id."','".$query->atletas[$i]->posicao_id."','".$query->atletas[$i]->status_id."','".$query->atletas[$i]->pontos_num."','".$query->atletas[$i]->preco_num."','".$query->atletas[$i]->variacao_num."','".$query->atletas[$i]->media_num."','".$query->atletas[$i]->jogos_num."')";
		//echo $sql;
		mercado($sql);
}
*/

/*
for ($j=0; $j < count($id_time) ; $j++) {
	echo $id_time[$j];

	for ($i=0; $i < count($query->atletas) ; $i++) {
		
		$sql = "insert into api_time_escalado(rodada, id_time,nome,slug,apelido,foto,atleta_id,rodada_id,clube_id,posicao_id,status_id,pontos_num,preco_num,variacao_num,media_num,jogos_num,scout) values ('1','".$id_time[$j]."','".$query->atletas[$i]->nome."','".$query->atletas[$i]->slug."','".$query->atletas[$i]->apelido."','".$query->atletas[$i]->foto."','".$query->atletas[$i]->atleta_id."','".$query->atletas[$i]->rodada_id."','".$query->atletas[$i]->clube_id."','".$query->atletas[$i]->posicao_id."','".$query->atletas[$i]->status_id."','".$query->atletas[$i]->pontos_num."','".$query->atletas[$i]->preco_num."','".$query->atletas[$i]->variacao_num."','".$query->atletas[$i]->media_num."','".$query->atletas[$i]->jogos_num."','".$query->atletas[$i]->scout."');";
		//echo $sql.'</br>'.'</br>'.'</br>';
		add($sql);
	}

};
*/


//Consultar id jogadores


$sql = "SELECT atleta_id FROM api_time_escalado Where id_time = 7875271 and atleta_id = 72372";
$id_jogadores = consulta_todos($sql);

foreach ($id_jogadores as $jogador) {
	$id_atleta =  $jogador['atleta_id'];
	if (isset($id_atleta)) {
		$size = count($query["atletas"]);

		//for ($i=0; $i < $size ; $i++) {
		//if (isset($id_atleta)) {
			echo $query["atletas"][$id_atleta]['pontuacao'];
		 //} 
		//}	
	}
	
	

	//foreach ($query->atletas as $value) {
	//	echo $query->atletas->{$id_atleta}->apelido.'</br>';
	//	echo $query->atletas->{$id_atleta}->pontuacao.'</br>';
	//}

}


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

echo '<pre>';
print_r($query);


?>