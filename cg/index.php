<?php
session_start();
error_reporting(0);
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Content Goblin</title>
    <link rel="shortcut icon" type="image/png" href="favicon.png">
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="richEditor/editor.css">

    <script src="https://use.fontawesome.com/bf2a2da1f0.js"></script>

  </head>
  <body>

    <div class="wrapper">

        <?php if (isset($_SESSION['uid'])): //Show admin interface

              include 'header.php';
              include 'db.inc.php';
              include 'sections.inc.php';
              include 'content.inc.php';

              ?>

              <?php if (isset($_GET['s'])): ?>

                <div class="container">

                <div class="section_div">
                  <?php
                    showSection($conn);
                  ?>
                </div>

                <div class="content_list_div">
                  <div class="section_header">
                    <h2 class="section_name_heading">Posts</h2>
                  </div>
                  <p class="no_content">No content in this section</p>
                  <?php
                    listContent($conn);
                  ?>
                </div>

              </div>

              <?php endif; ?>

              <?php if (isset($_GET['sectionDel'])): ?>

                <div class="container">
                  <div class="login_div">

                    <h3 style="color: red">
                      <?php
                        if (!empty($_GET['sectionDel']))
                          echo $_GET['sectionDel'];
                        else
                          echo '[Nameless section]';
                      ?>
                      has been deleted</h3>

                  </div>
                </div>

              <?php endif; ?>


              <div class="left_align">

                <style media="screen">

                  .container {

                    margin-left: 260px;
                  }

                </style>

                <div class="admin_div">

                  <div class='section_new_header'><h3>New section</h3></div>
                  <form class="" action="section_new.inc.php" method="POST" style="box-shadow: inset 0px 0px 3px #ccc;">
                    <ul>
                    <input type="text" name="name" class="section_input_name" placeholder="Name of section">
                      <li><label for="opt_title"><i class="fa fa-i-cursor"></i> Title </label>
                      <div><input type="checkbox" name="opt_title"></div></li>
                      <li><label for="opt_content"><i class="fa fa-book"></i> Content (text) </label>
                      <div><input type="checkbox" name="opt_content"></div></li>
                      <li><label for="opt_upload"><i class="fa fa-upload"></i> Upload </label>
                      <div><input type="checkbox" name="opt_upload"></div></li>
                      <li><label for="opt_delete"><i class="fa fa-trash"></i> Delete </label>
                      <div><input type="checkbox" name="opt_delete"></div></li>
                      <li><label for="opt_edit"><i class="fa fa-pencil"></i> Edit </label>
                      <div><input type="checkbox" name="opt_edit"></div></li>
                    <button type="submit" name="section_new_subm" class="section_new_subm"><i class="fa fa-plus"></i> Create</button>
                    </ul>
                  </form>

                  <div class='section_list_header'><h3>Sections</h3></div>
                  <div>
                    <ul class="section_list">
                    <?php

                    listSections($conn);

                    ?>
                    </ul>
                  </div>


                </div>

        <?php else : //Show login page ?>

          <div class="container">


              
              <div class="login_div">
                <div class="login_div_header">
                    <h3>Content Goblin - Login</h3>
                </div>
                <span class="login_div_main">
                  <form class="" action="login.inc.php" method="POST">
                    <div><i class="fa fa-user-o"></i><input type="text" name="uid" placeholder="Username"></div><br>
                    <div><i class="fa fa-lock"></i><input type="password" name="pwd" placeholder="Password"></div><br>
                    <button type="submit" name="login_subm">Login</button>
                  </form>
                </span>
              </div>

          </div>

      <?php endif; ?>

    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
  <script type="text/javascript" src="richEditor/editor.js"></script>
  <script type="text/javascript" src="edit.js"></script>
  <script type="text/javascript" src="ui.js"></script>

  </body>
</html>
