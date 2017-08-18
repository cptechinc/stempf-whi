<?php

/**
 * Initialization file for template files 
 * 
 * This file is automatically included as a result of $config->prependTemplateFile
 * option specified in your /site/config.php. 
 * 
 * You can initialize anything you want to here. In the case of this beginner profile,
 * we are using it just to include another file with shared functions.
 *
 */

include_once("./_func.php"); // include our shared functions


if ($input->urlSegment2) {
	if ($input->urlSegment2 == 'test') {
		$config->debug = true;
	}
}

$config->styles->append($config->urls->templates.'styles/bootstrap.min.css');
$config->styles->append($config->urls->templates.'styles/styles.css');
	
$config->scripts->append($config->urls->templates.'scripts/jquery.js');
$config->scripts->append($config->urls->templates.'scripts/libraries.js');



