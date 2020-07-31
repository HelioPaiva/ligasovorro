<?php
/**Conexao LocalHosta
/**Acentuação*/
//header('Content-Type: text/html; charset=utf-8');
/** O nome do banco de dados*/
define('DB_NAME', 'ligaso42_cartola_homologacao');
/** Usuário do banco de dados MySQL */
define('DB_USER', 'ligaso42_car_hom');
/** Senha do banco de dados MySQL */
define('DB_PASSWORD', 'cartola@2020');
/** nome do host do MySQL */
define('DB_HOST', '108.179.193.195');
/** caminho absoluto para a pasta do sistema **/
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
	
/** caminho no server para o sistema **/
if ( !defined('BASEURL') )
	define('BASEURL', '/www/');
	
/** caminho do arquivo de banco de dados **/
if ( !defined('DBAPI') )
	define('DBAPI', ABSPATH . '/database.php');

                

