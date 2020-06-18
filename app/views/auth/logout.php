<?php

require_once('includes/bootstrap/app.php');

$user = new Auth();
$user->logout();

Response::redirect('index.php');