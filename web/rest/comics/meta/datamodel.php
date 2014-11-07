<?php 
require_once('/metadata.php');

function getMeta(){
	require_once('/../Connections/comicsdb.php');
	$cn = new MetaData($hostname_comicsdb,$database_comicsdb,$username_comicsdb,$password_comicsdb);
	return $cn->getMeta();
}
?>