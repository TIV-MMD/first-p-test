<?php
include "bootstrap/init.php";

#connect to db and get tasks
$tasks = getTask();
include "tpl/tpl-auth.php"; 

//php -S localhost:8000