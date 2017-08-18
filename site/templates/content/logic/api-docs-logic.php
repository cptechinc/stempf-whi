<?php 
	$apifunctions = array(
		'accountstatus' => array (
			'json' => array (
				'request' => $config->testjson."request/account-status.json",
				'response' => $config->testjson."response/account-status.json"
			),
			'url' => array(
				'request' => $config->pages->post."accountstatus/",
				'response' => $config->pages->get."accountstatus/",
			)
			
		),
		'stockcheck' => array(
			'json' => array(
				'request' => $config->testjson."request/stock-check.json",
				'response' => $config->testjson."response/stock-check.json"
			),
			'url' => array(
				'request' => $config->pages->post."stockcheck/",
				'response' => $config->pages->get."stockcheck/"
			)
		),
		'stocksearch' => array (
			'json' => array(
				'request' => $config->testjson."request/stock-search.json",
				'response' => $config->testjson."response/stock-search.json"
			),
			'url' => array(
				'request' => $config->pages->post."stocksearch/",
				'response' => $config->pages->get."stocksearch/"
			)
		),
		'order' => array (
			'json' => array(
				'request' => $config->testjson."request/order-create.json",
				'response' => $config->testjson."response/order-create.json"
			),
			'url' => array(
				'request' => $config->pages->post."order/",
				'response' => $config->pages->get."order/"
			)
		),
		'orderstatus' => array (
			'json' => array(
				'request' => $config->testjson."request/order-head.json",
				'response' => $config->testjson."response/order-head.json"
			),
			'url' => array(
				'request' => $config->pages->post."orderstatus/",
				'response' => $config->pages->get."orderstatus/"
			)
		),
		'orderstatusdetail' => array (
			'json' => array(
				'request' => $config->testjson."request/order-details.json",
				'response' => $config->testjson."response/order-details.json"
			),
			'url' => array(
				'request' => $config->pages->post."orderstatusdetail/",
				'response' => $config->pages->get."orderstatusdetail/"
			)
		)
	);