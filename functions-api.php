<?php
require_once('config.php');
require_once(DBAPI);

$url = "https://api.cartolafc.globo.com/times?q=FC Não Para";

$curl_handle=curl_init();
curl_setopt($curl_handle, CURLOPT_URL, $url);
curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($curl_handle, CURLOPT_USERAGENT, 'Your application name');
$query = json_decode(curl_exec($curl_handle));
curl_close($curl_handle);

//echo '<pre>';
//print_r($query);

//for ($i=0; $i < count($query) ; $i++) { 
	/*
	echo $query[0]->assinante.'</br>'.
	$query[0]->time_id.'</br>'.
	$query[0]->foto_perfil.'</br>'.
	$query[0]->nome.'</br>'.
	$query[0]->nome_cartola.'</br>'.
	$query[0]->slug.'</br>'.
	$query[0]->url_escudo_png.'</br>'.
	$query[0]->url_escudo_svg.'</br>'.
	$query[0]->facebook_id;
*/

	$assinante = null;

	if ($query[0]->assinante == "") {
		$assinante = 'false';
	}else{
		$assinante = 'true';
	}

	$sql = "insert into ligaso42_cartola_homologacao.cadastro (assinante,
	time_id,
	foto_perfil,
	nome,
	nome_cartola,
	slug,
	url_escudo_png,
	url_escudo_svg,
	facebook_id,
	pago,
	banco,
	agencia,
	conta) values ('".$assinante."','".$query[0]->time_id."','".$query[0]->foto_perfil."','".$query[0]->nome."','".$query[0]->nome_cartola."','".$query[0]->slug."','".$query[0]->url_escudo_png."','".$query[0]->url_escudo_svg."','".$query[0]->facebook_id."','".'1'."','".'0'."','".'0'."','".'0'."');";	 

	echo $sql.'</br>';

	//add($sql);

	//echo $sql;

//}
 
?>