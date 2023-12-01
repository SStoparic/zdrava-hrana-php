<?php
  error_reporting(E_ALL | E_STRICT);
  ini_set("display_errors", true);
  ini_set("log_errors", true);


  $conn = new MySqli('localhost', 'root','','zdravahranaphp');
  $conn->set_charset("utf8");
 ?>
 