<?php

require_once('../app/bootstrap.php');

$app = new Router(Config::get('app.abspath') . '/app/controllers');