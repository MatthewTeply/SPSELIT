<?php

include 'db.inc.php';

if (isset($_POST['signup_subm'])) {

  $uid = $_POST['uid'];
  $pwd = $_POST['pwd'];
  $em = $_POST['em'];

  if (empty($uid) || empty($pwd) || empty($em) || strpos($em, '@') == false || strpos($em, '.') == false) {

    exit("Your signup informations do not meet the requirements! Try again : <a href='signup.php'>Back</a>");
  }

  else {

    $encr_pwd = password_hash($pwd, PASSWORD_DEFAULT);

    $stmnt = $conn->prepare("INSERT INTO users (uid, pwd, em) VALUES (?, ?, ?)");
    $stmnt->bind_param("sss", $st_uid, $st_pwd, $st_em);

    $st_uid = $uid;
    $st_pwd = $encr_pwd;
    $st_em = $em;

    $stmnt->execute();

    header("Location: index.php");
  }
}
