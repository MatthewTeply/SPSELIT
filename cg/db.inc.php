<?php

$conn = mysqli_connect('localhost', 'root', '', 'cg');

if (!$conn) {

  exit('Could not establish connection to the database!');
}
