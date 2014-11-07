<?php
require_once('dataConn.php');

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
	public $order;
	public $regs = array();
}

class MetaData extends dataConn {
	function getMeta() {
		$res = new stdClass();
		$editorial = new table();
		$editorial->orden = "";
		$format ="";
		$query = sprintf("select %s from editorial where estado = 1");
		$parametro->regs = $this->getRSFormat($query,$format);
		$res->editorial = $editorial;		
	}
}
?>