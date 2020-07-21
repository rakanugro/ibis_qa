<?php

function ref_agama()
{
	$conn = mysql_connect ( HOST , USER, PASSWORD) or die( mysql_error() );
	$db = mysql_select_db ( DB ) or die( mysql_error() );

	$sql = "SELECT * FROM tref_agama";

	$result = mysql_query( $sql , $conn ) or die( mysql_error() );
	$count = mysql_num_rows( $result );

	if($count>0)
	{
		$return = '{"data_count":'.$count.',"data": [';
		$i = 1;
		while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {			
			$return .= '{"agama_id":"'.$row["agama_id"].'","agama_nama":"'.$row["agama_nama"].'"}';
			if($i==$count){$return .= "";}else{$return .= ",";}
			$i++;
		}
		$return .= ']}';
	}else{
		$return = '{"data_count": 0}';
	}	
	return base64_encode($return);	
}

?>
