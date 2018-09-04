<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$active_group = 'default';
$query_builder = TRUE;

if (defined('CONFIGPATH')) {
    if (file_exists(CONFIGPATH . "/database.php")) {
        include CONFIGPATH . "/database.php";
    }
}