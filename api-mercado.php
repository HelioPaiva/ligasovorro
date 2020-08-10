<?php
require_once('config.php');
require_once(DBAPI);



$curl_handle=curl_init();
curl_setopt($curl_handle, CURLOPT_URL,'https://api.cartolafc.globo.com/atletas/mercado');
curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($curl_handle, CURLOPT_USERAGENT, 'Your application name');
$query = json_decode(curl_exec($curl_handle));
curl_close($curl_handle);



for ($i=0; $i < count($query->atletas) ; $i++) { 
		//echo $query->atletas[$i]->nome.' | '.$query->atletas[$i]->foto.' | '.$query->atletas[$i]->clube_id.'</br>';
		$sql = "insert into api_mercado(atleta_id,nome,slug,apelido,foto,rodada_id,clube_id,posicao_id,status_id,pontos_num,preco_num,variacao_num,media_num,jogos_num) values ('".$query->atletas[$i]->atleta_id."','".$query->atletas[$i]->nome."','".$query->atletas[$i]->slug."','".$query->atletas[$i]->apelido."','".$query->atletas[$i]->foto."','".$query->atletas[$i]->rodada_id."','".$query->atletas[$i]->clube_id."','".$query->atletas[$i]->posicao_id."','".$query->atletas[$i]->status_id."','".$query->atletas[$i]->pontos_num."','".$query->atletas[$i]->preco_num."','".$query->atletas[$i]->variacao_num."','".$query->atletas[$i]->media_num."','".$query->atletas[$i]->jogos_num."')";
		//echo $sql;
		add($sql);
}

echo "Finalizado";

?>