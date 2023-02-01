<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/../boot.php';

echo \ES\View\TemplateEngine::view('layout', [
	'title' => 'BITAUTO/AUTOBIT',
	'content' => 'content',
]);