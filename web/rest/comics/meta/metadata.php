<?php
require('dataConn.php');

if (!function_exists("GetSQLValueString")) {
	function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") { 
	$theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue; 
    $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue); 
    switch ($theType) {
		case "text":
			$theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL"; 
        break;
		case "long":
		case "int":
			$theValue = ($theValue != "") ? intval($theValue) : "NULL"; 
        break;
		case "double":
			$theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL"; 
        break;
		case "date":
			$theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL"; 
        break;
		case "defined":
			$theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue; 
        break; 
      } 
      return $theValue; 
    } 
  }

class table {
	public $orden;
	public $regs=array();
}

class MetaData extends dataConn {	
	function getMeta(){
		$res = new stdClass();
		
		$editorial = new table();
		$editorial->orden="ideditorial, nombre, estado, cover";
		$format="0,1,0,1";
		$query = sprintf("select %s from editorial where estado=1",$editorial->orden);
		$editorial->regs = $this->getRSformat($query,$format);
		$res->editorial =$editorial;
		
		$coleccion = new table();
		$coleccion->orden="idcoleccion, nombre, numeros, cover,editorial_ideditorial,tags";
		$format="0,1,0,1,0,1";
		$query = sprintf("select %s from coleccion where estado=1",$coleccion->orden);
		$coleccion->regs = $this->getRSformat($query,$format);
		$res->coleccion =$coleccion;
		
		$comic = new table();
		$comic->orden="idcomic, numero, descripcion, notas,tags,cover,published,precio,ean,coleccion_idcoleccion";
		$format="0,0,1,1,1,1,1,0,1,0";
		$query = sprintf("select %s from comic",$comic->orden);
		$comic->regs = $this->getRSformat($query,$format);
		$res->comic =$comic;
		
		return $res;
	}
}

?>