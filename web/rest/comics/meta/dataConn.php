<?php
class dataConn {
	private $hostname_data;
	private $database_data;
	private $username_data;
	private $password_data;
	protected $data;
	function __construct($host,$data,$user,$pass){
		$this->hostname_data = $host;
		$this->database_data = $data;
		$this->username_data = $user;
		$this->password_data = $pass;
		
		$mysqli = mysqli_init();
		$mysqli->options(MYSQLI_INIT_COMMAND,"SET NAMES utf8");
		mysqli_real_connect($mysqli,$this->hostname_data,$this->username_data,$this->password_data,$this->database_data) or die('<p>Unable to connect</p>');
		$this->data = $mysqli;
	}
	public function getCommand($sql){
	//mysql_select_db($this->database_data, $this->data);
	$query_rs = $sql;
	$rs = mysqli_query($this->data,$query_rs) or die(mysqli_error());
	$result = '';
	if ($rs){ 		
		$result = $rs;
	}
	else $result = mysql_error();
	return $result;	
   }
   public function getRS($sql){
	$query_rs = $sql;
	$rs = mysqli_query($this->data,$query_rs) or die(mysqli_error());
	$row_rs = mysqli_fetch_assoc($rs);
	$result = array();
	$totalRows_rs = mysqli_num_rows($rs);
	if ($totalRows_rs > 0){ 		
		$result[] = $row_rs;
		while ($row = mysqli_fetch_assoc($rs)) {
			$result[] = $row;
			}
	}
	mysqli_free_result($rs);
	return $result;	
   }
   public function getRSformat($sql,$format){
	$query_rs = $sql;
	$rs = mysqli_query($this->data,$query_rs) or die(mysql_error());
	$row_rs = mysqli_fetch_row($rs);
	$result = array();
	$totalRows_rs = mysqli_num_rows($rs);
	$formats = explode(",",$format);
	$fields = count($formats);
	if ($totalRows_rs > 0){ 		
		$temp1='';
		for ($i=0;$i< $fields;$i++) {		
			if (is_null($row_rs[$i])) {
				$temp1 = $temp1 .base64_encode('NULL').',';
			} else {
				$campo=base64_encode($row_rs[$i]);				
				if ($formats[$i]=='0') $temp1 = $temp1.$campo.',';
				else $temp1 = $temp1."'".$campo."',";
			}
		}
		$result[]= substr($temp1,0,-1);
		while ($row = mysqli_fetch_row($rs)) {
			$temp = '';
			for ($i=0;$i< $fields;$i++) {
				if (is_null($row[$i])) {
					$temp = $temp . base64_encode('NULL').',';
				} else {
					$campo=base64_encode($row[$i]);
					if ($formats[$i]=='0') $temp = $temp.$campo.',';
					else $temp = $temp."'".$campo."',";
				}
			}
			$result[] = substr($temp,0,-1);
		}		
	}
	mysqli_free_result($rs);
	return $result;	
   }
   public function getValue($sql){
	   $query_rs = $sql;
	   $rs = mysqli_query($this->data,$query_rs) or die(mysqli_error($this->data));
	   $row = mysqli_fetch_row($rs);
	   $totalRows = mysqli_num_rows($rs);
	   mysqli_free_result($rs);
	   $res='';
	   if ($totalRows > 0){
		   $res = $row[0];
	   } else $res = $sql;
	   return $res;
   }
}
?>