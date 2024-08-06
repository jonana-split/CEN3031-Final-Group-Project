#!/usr/local/bin/php

<!-- destroy the session and redirect user to index again -->
<?php
session_start();
session_destroy();

header("location:index.php");

?>