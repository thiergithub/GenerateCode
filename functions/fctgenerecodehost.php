<?php 

	function fctGenereCode() 
	{
		$codeGenere = substr(number_format(time() * mt_rand(),0,'',''),0,15); 
		return $codeGenere;		
	}
?>