<?php

function is_service_up($url)
{
	$status = false;
	
	if(fopen($url, "r") != false)
	{
		$status = true;
		print "Yes";
	}
	else
	{
		$status = false;
		print "No";
	}
	
	return $status;
}
?>
