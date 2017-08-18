<?php 
	header('Content-Type: application/json'); 

	if ($input->urlSegment1) {
		$tranasctionid = $input->urlSegment2;
		switch ($input->urlSegment1) {
			case 'accountstatus':
				if (file_exists($config->jsonfilepath.$tranasctionid."-whiacctstat.json")) {
					$json = file_get_contents($config->jsonfilepath.$tranasctionid."-whiacctstat.json");
					echo $json;
				} else {
					http_response_code(200);
					
				}
				break;
			case 'stockcheck':
				if (file_exists($config->jsonfilepath.$tranasctionid."-whistockcheck.json")) {
					$json = file_get_contents($config->jsonfilepath.$tranasctionid."-whistockcheck.json");
					echo $json;
				} else {
					http_response_code(200);
					
				}
				break;
			case 'partsearch':
				if (file_exists($config->jsonfilepath.$tranasctionid."-whistockcheck.json")) {
					$json = file_get_contents($config->jsonfilepath.$tranasctionid."-whistockcheck.json");
					echo $json;
				} else {
					http_response_code(200);
					
				}
				break;
			case 'order':
				if (file_exists($config->jsonfilepath.$tranasctionid."-whiorder.json")) {
					$json = file_get_contents($config->jsonfilepath.$tranasctionid."-whiorder.json");
					echo $json;
				} else {
					http_response_code(200);
					
				}
				break;
			case 'orderstatsum': // was orderstatus
				if (file_exists($config->jsonfilepath.$tranasctionid."-whiorderstatsum.json")) {
					$json = file_get_contents($config->jsonfilepath.$tranasctionid."-whiorderstatsum.json");
					echo $json;
				} else {
					http_response_code(200);
					
				}
			case 'orderstatdet': //WAS orderstatusdetail
				if (file_exists($config->jsonfilepath.$tranasctionid."-whiorderstatdet.json")) {
					$json = file_get_contents($config->jsonfilepath.$tranasctionid."-whiorderstatdet.json");
					echo $json;
				} else {
					http_response_code(200);
					
				}
				
		}
	} else {
		throw new Wire404Exception();
	}
?>