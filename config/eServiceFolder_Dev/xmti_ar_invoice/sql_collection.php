<?php 
/*+---------------------------------------------------------------------------------------------------+
  | $Web Service Template$                                                         					  |
  | Author                  : -				                                                          |
  | Template Created Date	: 22-Des-2014                                                             |
  | Template Version        : 1.0                                                                     |
  |---------------------------------------------------------------------------------------------------|
  | $Template Modification History$                                                                   |
  |---------------------------------------------------------------------------------------------------|
  | Modification                                Date                                  Modification By | 
  |---------------------------------------------------------------------------------------------------|
  */
  
//======= SQL Collection ========// 
function getCountNotaHeader ($in_no_nota)
{
	return "SELECT COUNT(*) as JUMLAH FROM xmti.tth_nota_all2 where no_nota = '$in_no_nota'";
}

function getNotaHeader ($in_no_nota)
{
	return "SELECT * FROM xmti.tth_nota_all2 where no_nota = '$in_no_nota'";
}

function getCountNotaLines ($in_no_nota)
{
	return "SELECT COUNT(*) as JUMLAH FROM xmti.ttr_nota_all where kd_uper = '$in_no_nota'";
}

function getNotaLines ($in_no_nota)
{
	return "SELECT * FROM xmti.ttr_nota_all where kd_uper = '$in_no_nota'";
}
?>