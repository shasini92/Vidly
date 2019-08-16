<?php
// show error reporting
error_reporting(E_ALL);

// set your default time-zone
date_default_timezone_set('Europe/Belgrade');

// variables used for jwt
$key = "Vidly Application";
$iss = "http://vidly.com";
$aud = "http://vidly.com";
$iat = time();
$nbf = time();
