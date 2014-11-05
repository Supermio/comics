<?php
use Luracas\Restler\RestExcepcion;
class Comics {
	function getDatos(){
		$datos = new stdClass();
		$datos->author='supermio';
		$datos->proyecto = 'comics';
		return $datos;
		}
	}