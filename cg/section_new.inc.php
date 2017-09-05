<?php

session_start();

include 'db.inc.php';

if (isset($_POST['section_new_subm']) && isset($_SESSION['uid'])) {

  $name = $_POST['name'];
  $opt_delete = $_POST['opt_delete'];
  $opt_edit = $_POST['opt_edit'];
  $opt_upload = $_POST['opt_upload'];
  $opt_title = $_POST['opt_title'];
  $opt_content = $_POST['opt_content'];

  if (empty($opt_delete)) {

    $opt_delete = "off";
  }

  if (empty($opt_edit)) {

    $opt_edit = "off";
  }

  if (empty($opt_upload)) {

    $opt_upload = "off";
  }

  if (empty($opt_title)) {

    $opt_title = "off";
  }

  if (empty($opt_content)) {

    $opt_content = "off";
  }

  $stmnt = $conn->prepare("INSERT INTO sections (name, opt_delete, opt_edit, opt_upload, opt_title, opt_content) VALUES (?, ?, ?, ?, ?, ?)");
  $stmnt->bind_param("ssssss", $st_name, $st_opt_delete, $st_opt_edit, $st_opt_upload, $st_opt_title, $st_opt_content);

  $st_name = $name;
  $st_opt_delete = $opt_delete;
  $st_opt_edit = $opt_edit;
  $st_opt_upload = $opt_upload;
  $st_opt_title = $opt_title;
  $st_opt_content = $opt_content;

  $stmnt->execute();

  header("Location: index.php?new_section");
}
