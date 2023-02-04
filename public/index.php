<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/../boot.php';
require_once ROOT . '/core/Routing/Routes.php';

$app = new \ES\Application();
$app->run();
