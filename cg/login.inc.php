<?php

session_start();

include 'db.inc.php';

if (isset($_POST['login_subm'])) {

  $uid = $_POST['uid'];
  $pwd = $_POST['pwd'];

  $stmnt = $conn->prepare("SELECT * FROM users WHERE uid=?");
  $stmnt->bind_param("s", $st_uid);

  $st_uid = $uid;

  $stmnt->execute();
  $results = $stmnt->get_result();

  $row = $results->fetch_assoc();

  $hash_pwd = $row['pwd'];

  $hash = password_verify($pwd, $hash_pwd);

  if ($hash == 0) {

    exit("Wrong password or username! <a href='index.php'>Back</a>");
  }

  else {

    $stmnt = $conn->prepare("SELECT * FROM users WHERE uid=? AND pwd=?");
    $stmnt->bind_param("ss", $st_uid, $st_pwd);

    $st_uid = $uid;
    $st_pwd = $hash_pwd;

    $stmnt->execute();
    $results = $stmnt->get_result();

    $numRows = $results->num_rows;
    $row = $results->fetch_assoc();

    if ($numRows == 0) {

      exit("No user like that exists in database!");
    }

    else {

      $_SESSION['uid'] = $row['uid'];
      header("Location: index.php?loggedin");
    }
  }
}
