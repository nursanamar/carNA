<?php
	require_once __DIR__."/autoload.php";

	use lib\MVC\router;
	$kernel = new router($_GET);
	$controler = $kernel->getcontroler();
	$controler->executeaction($kernel->action,$kernel->urlparams);
?>
