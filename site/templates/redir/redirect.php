<?php

	if ($session->loc) {} else {$session->loc == ''; }

	$L = $session->loc;

	if ($L == "") {
		$L = $config->pages->root;
	} 

	header("location: " . $L);
	exit;

				
			
?>