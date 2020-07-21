<?php 
/*+---------------------------------------------------------------------------------------------------+
  | $Web Service Template$                                                         					  |
  | Author                  : -                                                         			  |
  | Template Created Date	: 22-Des-2014                                                             |
  | Template Version        : 1.0                                                                     |
  |---------------------------------------------------------------------------------------------------|
  | $Template Modification History$                                                                   |
  |---------------------------------------------------------------------------------------------------|
  | Modification                                Date                                  Modification By |
  |---------------------------------------------------------------------------------------------------|
  */

//======= SQL Collection ========// 
function getAllQuery ($modul,$start,$end,&$result)
{
		if($modul=="PTP_KAPAL")
		{		
					$result["modul"] = "PTP KAPAL";
				
					$result["query_log"] = "select to_char(log_date, 'yyyy/mm/dd hh24:mi:ss') as log_date2, ac_parameter_log.* from ac_parameter_log 
					WHERE log_date BETWEEN TO_DATE ('".trim($start)."', 'DD/MM/YYYY HH24:MI:SS') and TO_DATE ('".trim($end)."', 'DD/MM/YYYY HH24:MI:SS') 
				order by log_date desc";
				
		}
		else if($modul=="ILCS_HOST2HOST_LOG")
		{		
					$result["modul"] = "ILCS HOST2HOST LOG";
				
					$result["query_log"] = "select to_char(created_date, 'yyyy/mm/dd hh24:mi:ss') as log_date2, a.* from recondb.t_log_payment a 
					WHERE created_date BETWEEN TO_DATE ('".trim($start)."', 'DD/MM/YYYY HH24:MI:SS') and TO_DATE ('".trim($end)."', 'DD/MM/YYYY HH24:MI:SS') 
				order by created_date desc";
				
		}		
}
?>