<?php
	header('Content-Type: application/json'); 
	if ($input->get->debug) {
		$transactiontype = $input->urlSegment1;
		include $config->paths->content."logic/post-debug-logic.php"; 
	} else {
		$json = json_decode(file_get_contents("php://input"), true);
		$transactiontype = $json["transaction_type"];
	}

	switch ($transactiontype) {
		case 'accountstatus':
			$data = array("TYPE" => strtoupper($json['transaction_type']), "CUSTID" => $json['header']['account'], "SHIPID" => $json['header']['branch'], "TRANSACTIONID" => $json['transaction_id']);
			$filename = $json['transaction_id'];
			writedplusfile($data, $filename);
			$session->loc = $config->pages->get."accountstatus/".$json['transaction_id']."/";
			$jsonfile = $config->jsonfilepath.$json['transaction_id']."-whiacctstat.json";
			break;
		case 'stockcheck':
			if (isset($json['parts'])) {
				$items = '';
				foreach ($json['parts'] as $item) {
					if ($item == $json['parts'][0]) {
						$itemid = str_pad($item['partno'], 32);
						$qty = str_pad("QTY=".$item['qtyreq'], 11);
						$items .= $itemid . $qty."GRUP=".$item['linecode'];
					} else {
						$itemid = str_pad("ITEMID=".$item['partno'], 39);
						$qty = str_pad("QTY=".$item['qtyreq'], 11);
						$items .= "\n". $itemid. $qty."GRUP=".$item['linecode'];

					}

				}
				$data = array("TYPE" => strtoupper($json['transaction_type']), "TRANSACTIONID" => $json['transaction_id'], "CUSTID" => $json['header']['account'], "SHIPID" => $json['header']['branch'], "SUPPLIER" => $json['header']['routing']['supplier'], "RID" => $json['header']['routing']['rid'], "ITEMID" => $items);
				$session->loc = $config->pages->get."stockcheck/".$json['transaction_id']."/";
				
			} else { //IF not parts array then assume it's a query
				$data = array("TYPE" => "STOCKSEARCH", "TRANSACTIONID" => $json['transaction_id'], "CUSTID" => $json['header']['account'], "SHIPID" => $json['header']['branch'], "SUPPLIER" => $json['header']['routing']['supplier'], "RID" => $json['header']['routing']['rid'], "QUERYTYPE" => $json['header']['querytype'], 'QUERYTEXT' => $json['header']['querytext']);
				$session->loc = $config->pages->get."stocksearch/".$json['transaction_id']."/";
			}
			
			
			$filename = $json['transaction_id'];
			$jsonfile = $config->jsonfilepath.$json['transaction_id']."-whistockcheck.json";
			writedplusfile($data, $filename);
			
			break;
		case 'partsearch': // THE SAME AS STOCKCHECK  // WAS STOCKSEARCH
			$data = array("TYPE" => "STOCKSEARCH", "TRANSACTIONID" => $json['transaction_id'], "CUSTID" => $json['header']['account'], "SHIPID" => $json['header']['branch'], "SUPPLIER" => $json['header']['routing']['supplier'], "RID" => $json['header']['routing']['rid'], "QUERYTYPE" => $json['header']['querytype'], 'QUERYTEXT' => $json['header']['querytext']);
			$filename = $json['transaction_id'];
			writedplusfile($data, $filename);
			$session->loc = $config->pages->get."partsearch/".$json['transaction_id']."/";
			$jsonfile = $config->jsonfilepath.$json['transaction_id']."-whistockcheck.json";
			break;
		case 'order':
			$items = '';
			foreach ($json['parts'] as $item) {
				if ($item == $json['parts'][0]) {
					$itemid = str_pad($item['partno'], 32);
					$qty = str_pad("QTY=".$item['qtyreq'], 11);
					$items .= $itemid . $qty . "LINE=".str_pad($item['lineno'], 4)."GRUP=".$item['linecode'];
				} else {
					$itemid = str_pad("ITEMID=".$item['partno'], 39);
					$qty = str_pad("QTY=".$item['qtyreq'], 11);
					$items .= "\n". $itemid . $qty . "LINE=".str_pad($item['lineno'], 4)."GRUP=".$item['linecode'];
					
				}
				
			}
			$data = array("TYPE" => strtoupper($json['transaction_type']), "TRANSACTIONID" => $json['transaction_id'], "CUSTID" => $json['header']['account'], "SHIPID" => $json['header']['branch'], "CUSTPO" => $json['header']['ponumber'], "SUPPLIER" => $json['header']['routing']['supplier'], "RID" => $json['header']['routing']['rid'], "ITEMID" => $items);
			$filename = $json['transaction_id'];
			writedplusfile($data, $filename);
			$session->loc = $config->pages->get."order/".$json['transaction_id']."/";
			$jsonfile = $config->jsonfilepath.$json['transaction_id']."-whiorder.json";
			break;
		case 'orderstatsum': // WAS orderstatus
			$data = array("TYPE" => strtoupper($json['transaction_type']), "TRANSACTIONID" => $json['transaction_id'], "CUSTID" => $json['header']['account'], "SHIPID" => $json['header']['branch'], "CUSTPO" => $json['header']['ponumber'], "SUPPLIER" => $json['header']['routing']['supplier'], "RID" => $json['header']['routing']['rid'], "NBROFORD" => $json['header']['reqrecs'], "ORDTYPE" => $json['header']['type'], "ORDER" => $json['header']['orderno'], "INVOICE" => $json['header']['invoice']);
			$filename = $json['transaction_id'];
			writedplusfile($data, $filename);
			$session->loc = $config->pages->get."orderstatus/".$json['transaction_id']."/";
			$jsonfile = $config->jsonfilepath.$json['transaction_id']."-whiorderstatsum.json";
			break;
		case 'orderstatdet': //WAS orderstatusdetail
			$data = array("TYPE" => strtoupper($json['transaction_type']), "TRANSACTIONID" => $json['transaction_id'], "CUSTID" => $json['header']['account'], "SHIPID" => $json['header']['branch'], "CUSTPO" => $json['header']['ponumber'], "SUPPLIER" => $json['header']['routing']['supplier'], "RID" => $json['header']['routing']['rid'], "NBROFORD" => $json['header']['reqrecs'], "ORDTYPE" => $json['header']['type'], "ORDER" => $json['header']['orderno'], "INVOICE" => $json['header']['invoice']);
			$filename = $json['transaction_id'];
			writedplusfile($data, $filename);
			$session->loc = $config->pages->get."orderstatdet/".$json['transaction_id']."/";
			$jsonfile = $config->jsonfilepath.$json['transaction_id']."-whiorderstatdet.json";
			break;
			
	}

	$curl = curl_init();
	curl_setopt_array($curl, array(
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_URL => "127.0.0.1/cgi-bin/" . $config->cgi . "?fname=" . $filename,
		CURLOPT_FOLLOWLOCATION => true
	));
	sleep(2);
	$result = curl_exec($curl);

	if (file_exists($jsonfile)) {
		$json = file_get_contents($jsonfile);
		echo $json;
	} else {
		http_response_code(200);

	}


	exit;

?>