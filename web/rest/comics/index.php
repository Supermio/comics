<?php
require_once 'vendor/restler.php';
use Luracast\Restler\Restler;
use Luracast\Restler\Defaults;

Defaults::$throttle = 20;
$r = new Restler(true);
$r->setSupportedFormats('JsonFormat');
$r->addAPIClass('Comics');
$r->addAPIClass('Resources');
$r->addFilterClass('RateLimit');
$r->handle();
