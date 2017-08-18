<?php 
	
	switch ($transactiontype) {
		case 'accountstatus':
			$json = json_decode(file_get_contents($config->testjsonpath."request/account-status.json"), true);
			break;
		case 'stockcheck':
			$json = json_decode(file_get_contents($config->testjsonpath."request/stock-check.json"), true);
			break;
		case 'partsearch': // THE SAME AS STOCKCHECK
			$json = json_decode(file_get_contents($config->testjsonpath."request/stock-search.json"), true);
			break;
		case 'order':
			$json = json_decode(file_get_contents($config->testjsonpath."request/order-create.json"), true);
			break;
		case 'orderstatsum':
			$json = json_decode(file_get_contents($config->testjsonpath."request/order-head.json"), true);
			break;
		case 'orderstatdet':
			$json = json_decode(file_get_contents($config->testjsonpath."request/order-details.json"), true);
			break;
			
	}
?>