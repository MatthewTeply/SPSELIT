<?php

include 'db.inc.php';

function countContent($section_name, $conn) {

  $stmnt = $conn->prepare("SELECT COUNT(*) FROM sitecontent WHERE section_name=?");
  $stmnt->bind_param("s", $st_name);

  $st_name = $section_name;

  $stmnt->execute();

  $results = $stmnt->get_result();
  $row = $results->fetch_assoc();

  $no_content = implode(" ", $row);

  $stmnt = $conn->prepare("UPDATE sections SET no_content=? WHERE name=?");
  $stmnt->bind_param("ss", $st_no_content, $st_name);

  $st_no_content = $no_content;
  $st_name = $section_name;

  $stmnt->execute();
}

function listSections($conn) {

  $stmnt = $conn->prepare("SELECT * FROM sections");

  $stmnt->execute();
  $results = $stmnt->get_result();

  $numRows = $results->num_rows;

  if ($numRows > 0) {

    while ($row = $results->fetch_assoc()) {

      echo
      '
      <form class="sections_list_item"';

      if (isset($_GET['s']) && $_GET['s'] == $row['id'])
        echo 'id="content_active"';

      echo 'method="POST">
        <li>
        <a href="index.php?s='.$row['id'].'">';

        if (!empty($row['name']))
          echo '<b>'.$row['name'].'</b>';
        else
          echo '<b>[Nameless section]</b>';

      echo '
        </a>
        <i class="fa fa-cog sections_list_settings_bttn" value="'.$row['id'].'"></i>
        <i class="fa fa-info-circle sections_list_info_bttn" value="'.$row['id'].'"></i>
        </li>
      </form>';

      echo '
    <div class="sections_list_item_settings section_settings_id_'.$row['id'].'">
      <form class="sections_list_delete_form_'.$row['id'].'" action="'.deleteSections($conn).'" method="POST" style="border: none; padding: 0px">
        <input type="hidden" name="section_id" value='.$row['id'].'>
        <button type="submit" class="section_del_bttn section_del_bttn_'.$row['id'].'" name="section_delete" value='.$row['id'].'><i class="fa fa-trash"></i> Delete</button>
      </form>
    </div>
    <div class="sections_list_item_info section_info_id_'.$row['id'].'"
    ';

    if (isset($_GET['s']) && $_GET['s'] == $row['id'])
        echo 'id="content_active_info"';

    echo "><p>Posts : ".$row['no_content']."</p>";
    echo "<div><b>Enabled features</b> <ul>";

    if($row['opt_delete'] == "on") {

      echo("<li><i class='fa fa-trash'></i> Delete</li>");
    }

    if($row['opt_edit'] == "on") {

      echo("<li><i class='fa fa-pencil'></i> Edit</li>");
    }

    if($row['opt_upload'] == "on") {

      echo("<li><i class='fa fa-upload'></i> Upload</li>");
    }

    if($row['opt_title'] == "on") {

      echo("<li><i class='fa fa-i-cursor'></i> Title</li>");
    }

    if($row['opt_content'] == "on") {

      echo("<li><i class='fa fa-book'></i> Content</li>");
    }

    if($row['opt_delete'] == "off" && $row['opt_edit'] == "off" && $row['opt_upload'] == "off" && $row['opt_title'] == "off" && $row['opt_content'] == "off")
      echo("<li style='color: red;'>No features enabled</li>");

    echo 
    '
    </ul>
    </div>

    </div>
    ';

    countContent($row['name'], $conn);
    }
  }

  else  {

    echo
    "
    <style>

    .admin_div div:last-child {

      border: 1px solid #555;
      padding: 10px;
    }

    </style>
    <font color=red>No sections</font>
    ";
  }
}

function deleteSections($conn) {

  if (isset($_POST['section_delete'])) {

    $section_id = $_POST['section_id'];

    $stmnt = $conn->prepare("SELECT * FROM sections WHERE id=?");
    $stmnt->bind_param("s", $st_id);

    $st_id = $section_id;

    $stmnt->execute();
    $results = $stmnt->get_result();

    $row = $results->fetch_assoc();

    $section_name = $row['name'];

    $stmnt = $conn->prepare("DELETE FROM sections WHERE id=?");
    $stmnt->bind_param("s", $st_id);

    $st_id = $section_id;

    $stmnt->execute();

    $stmnt = $conn->prepare("SELECT * FROM sitecontent WHERE section_name=?");
    $stmnt->bind_param("s", $st_section_name);

    $st_section_name = $section_name;

    $stmnt->execute();
    $results = $stmnt->get_result();

    while ($row = $results->fetch_assoc()) {

      unlink($row['file']);

      $stmnt = $conn->prepare("DELETE FROM sitecontent WHERE section_name=?");
      $stmnt->bind_param("s", $st_section_name);

      $st_section_name = $section_name;

      $stmnt->execute();

    }

    echo
    '
    <script type="text/javascript">
      window.location.href = "index.php";
    </script>
    ';
  }
}

function showSection($conn) {

  if (isset($_GET['s'])) {

    $section_id = $_GET['s'];

    $stmnt = $conn->prepare("SELECT * FROM sections WHERE id=?");
    $stmnt->bind_param("s", $st_section_id);

    $st_section_id = $section_id;

    $stmnt->execute();
    $results = $stmnt->get_result();

    $row = $results->fetch_assoc();

    echo
    '
    <div class="section_header">
      <h2 class="section_name_heading">'.$row['name'].'</h2>
    </div>
    <div class="section_subdiv">

    <form class="" action="'.setContent($conn).'" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="section_name" value="'.$row['name'].'">
      <div class="content_class_div">
        <label for="class_name">Class</label>
        <input type="text" id="section_class" name="class_name">
      </div>
    ';

    if ($row['opt_content'] == 'off') {

      echo
      '
      <div class="divider"></div>
      ';
    }

    if ($row['opt_title'] == 'on') {

      echo
      '
      <div class="section_title_div">
        <label for="content_title_heading">Title</label>
        <select name="content_title_heading" id="section_title_heading">
          <option value="h1" selected="selected">h1</option>
          <option value="h2">h2</option>
          <option value="h3">h3</option>
          <option value="h4">h4</option>
          <option value="h5">h5</option>
          <option value="h6">h6</option>
        </select>
        <input type="text" id="section_title" name="content_title" ><br>
      </div>
      ';
    }

    if ($row['opt_content'] == 'on') {
      echo '<input name="content_content" id="section_content" type="hidden"/>';
      include 'richEditor/editor.php';
    }

    if ($row['opt_upload'] == 'on') {

      echo
      '
      <label class="custom-file-input" id="custom-file-input">
        <input type="file" id="section_upload" name="content_file">
        <p id="section_upload_p">No file selected</p>
      </label>
      <br>
      ';
    }

    echo
    '
      <button type="submit" class="content_submit_form" name="content_subm"><i class="fa fa-upload"></i> Submit</button>
    </form>
    ';

    if ($row['opt_edit'] == 'on') {

      echo
      '
      <form class="content_edit_form" action="'.editContent($conn).'" method="POST" enctype="multipart/form-data">
      ';

      if ($row['opt_upload'] == 'on') {

        echo
        '
        <label  class="custom-file-input">
          <input type="file" id="section_edit_upload" name="content_edit_file">
          <p id="section_edit_upload_p">No file selected</p>
        </label>
        <br>
        ';
      }

      echo
      '
        <input type="hidden" class="content_edit_id" name="content_id" value="">
        <input type="hidden" class="content_edit_title" name="content_title" value="">
        <input type="hidden" class="content_edit_content" name="content_content" value="">
        <input type="hidden" class="content_edit_class" name="content_class" value="">
        <input type="hidden" class="content_edit_title_heading" name="content_title_heading" value="">
        <button type="submit" name="content_edit_subm" id="content_edit_subm"><i class="fa fa-pencil"></i> Edit</button>
        <a href="index.php?s='.$section_id.'" id="cancel">Cancel</a>
      </form>
      ';
    }

    echo "</div>";
  }
}
