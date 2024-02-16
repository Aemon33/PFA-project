<?php
require 'config/constants.php';
// destroy all session and redirect user ro home page
session_destroy();
header('location:'.ROOT_URL);
die();