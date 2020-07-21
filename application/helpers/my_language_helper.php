<?php 
function get_content($model, $modul,$key)
{
	$content="Lost in Translation";
	$content=$model->get_content($modul,$key);
	return $content;
}
function injek($var)
{
	if ((strpos($var, ' OR ') !== false )||(strpos($var, ' AND ') !== false )||(strpos($var, ' WHERE ') !== false ) ) {
		
			header('Location: '.ROOT."mainpage");
		}
}
function checkcaptcha($securitycode, $mycaptcha)
{
	if($securitycode == $mycaptcha)
	{
		return "OK";
	}
	else
		return "NOK";
}
?>