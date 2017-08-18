<?php
	$filename = session_id();
	$file = 'dsafdsafdsafdsa';
	$vard = "/usr/capsys/ecomm/" . $filename;
	$handle = fopen($vard, "w") or die("cant open file");

	fwrite($handle, $file);
	fclose($handle);