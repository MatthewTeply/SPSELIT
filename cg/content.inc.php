<?php

include 'db.inc.php';

function setContent($conn) {

  if (isset($_POST['content_subm'])) {

    $section_name = $_POST['section_name'];
    $class = $_POST['class_name'];
    $title_heading = 'NULL';
    $title = 'NULL';
    $content = 'NULL';
    $file = 'NULL';

    if (!empty($_POST['content_title'])) {

      $title = $_POST['content_title'];
      $title_heading = $_POST['content_title_heading'];
    }

    if (!empty($_POST['content_content']))
      $content = $_POST['content_content'];

    if (!empty($_FILES['content_file'])) {

      $file = $_FILES['content_file'];

      $fileName = $file['name'];
      $fileTmpName = $file['tmp_name'];
      $fileSize = $file['size'];
      $fileError = $file['error'];

      $fileExt = explode('.', $fileName);
      $fileActualExt = strtolower(end($fileExt));

      if ($fileError == 0) {

        $fileNewName = uniqid('', true).'.'.$fileActualExt;
        $fileDestination = 'uploads\\' . $fileNewName;

        move_uploaded_file($fileTmpName, $fileDestination);
      }

      else
        exit("There was an error uploading your file! <a href='index.php'>Back</a>");

      $filePath = $fileDestination;
    }

    if (!isset($filePath))
      $filePath = 'NULL';

    $stmnt = $conn->prepare("INSERT INTO sitecontent (title, content, file, section_name, class, title_heading) VALUES (?, ?, ?, ?, ?, ?)");
    $stmnt->bind_param("ssssss", $st_title, $st_content, $st_file, $st_section_name, $st_class, $st_title_heading);

    $st_title = $title;
    $st_class = $class;
    $st_content = $content;
    $st_file = $filePath;
    $st_section_name = $section_name;
    $st_title_heading = $title_heading;

    $stmnt->execute();

    $section_id = $_GET['s'];

    header("Location: index.php?s=".$section_id."&posted");
  }
}

function listContent($conn) {

  $section_id = $_GET['s'];

  $stmnt = $conn->prepare("SELECT * FROM sections WHERE id=?");
  $stmnt->bind_param("s", $st_id);

  $st_id = $section_id;

  $stmnt->execute();
  $results = $stmnt->get_result();

  $row = $results->fetch_assoc();
  $numRows = $results->num_rows;

  $section_name = $row['name'];

  $stmnt = $conn->prepare("SELECT * FROM sitecontent WHERE section_name=? ORDER BY id DESC");
  $stmnt->bind_param("s", $st_section_name);

  $st_section_name = $section_name;

  $stmnt->execute();
  $results = $stmnt->get_result();

  while ($row = $results->fetch_assoc()) {

    $content_id = $row['id'];
    $content_title = $row['title'];
    $content_content = $row['content'];
    $content_file = $row['file'];
    $content_class = $row['class'];

    echo
    '
    <style>

      .no_content {

        display: none;
      }

    </style>

    <div class="content_list_item">
    <div class="content_list_item_header">
      <i>In element with class : <b>'.$row['class'].'</b></i>
    </div>
    <div class="content_list_item_main">
    ';

    if ($row['title'] != 'NULL') {

      echo
      '
      <h1>'.$row['title'].'</hh1
      ';
    }

    if ($row['content'] != 'NULL') {

      echo
      '
      <p>'.$row['content'].'</p>
      ';
    }

    if ($row['file'] != 'NULL') {

      $file_ext = explode(".", $row['file']);

      echo '<div class="content_list_divider"></div>';


      if (end($file_ext) == "jpg" || end($file_ext) == "png") {

        echo
        '
        <a href="'.$row['file'].'">
          <img src="'.$row['file'].'" />
        </a>
        ';
      }

      else {

        echo
        '
        <a href="'.$row['file'].'" />[Attached file]</a>
        ';
      }

    }

    echo "</div>";

    $stmnt_section = $conn->prepare("SELECT * FROM sections WHERE id=?");
    $stmnt_section->bind_param("s", $st_section_id);

    $st_section_id = $section_id;

    $stmnt_section->execute();
    $results_section = $stmnt_section->get_result();

    $row_section = $results_section->fetch_assoc();

    echo '<ul class="alter_panel">';

    if ($row_section['opt_edit'] == 'on') {

      echo
      '
      <li>
      <form action="" method="POST">
        <button type="button" value="'.$content_id.'" class="content_edit_button" name="content_edit_subm"><i class="fa fa-pencil"></i></button>
      </form>
      </li>
      ';
    }

    if ($row_section['opt_delete'] == 'on') {

      echo
      '
      <li>
      <form class="" action="'.deleteContent($conn).'" method="POST">
        <input type="hidden" name="content_id" value="'.$content_id.'">
        <button type="submit" class="content_delete_button" name="content_delete_subm"><i class="fa fa-trash"></i></button>
      </form>
      </li>
      ';
    }

    echo
    '
      </ul>
    </div><br>
    ';
  }
}

function deleteContent($conn) {

  if (isset($_POST['content_delete_subm'])) {

    $content_id = $_POST['content_id'];
    $section_id = $_GET['s'];

    $stmnt = $conn->prepare("SELECT * FROM sitecontent  WHERE id=?");
    $stmnt->bind_param("s", $st_content_id);

    $st_content_id = $content_id;

    $stmnt->execute();
    $results = $stmnt->get_result();

    $row = $results->fetch_assoc();

    if ($row['file'] != 'NULL') {

      unlink($row['file']);
    }

    $stmnt = $conn->prepare("DELETE FROM sitecontent WHERE id=?");
    $stmnt->bind_param("s", $st_content_id);

    $st_content_id = $content_id;

    $stmnt->execute();

    echo
    '
    <script type="text/javascript">
      window.location.href = "index.php?s='.$section_id.'";
    </script>
    ';
  }
}

if (isset($_POST['get_content_no'])) {

    $stmnt = $conn->prepare("SELECT * FROM sitecontent");
    $stmnt->execute();
    $results = $stmnt->get_result();

    $numRows = $results->num_rows;

    echo $numRows;
}

if (isset($_POST['content_edit_id'])) {

  $content_id = $_POST['content_edit_id'];

  $stmnt = $conn->prepare("SELECT * FROM sitecontent WHERE id=?");
  $stmnt->bind_param("s", $st_content_id);

  $st_content_id = $content_id;

  $stmnt->execute();
  $results = $stmnt->get_result();

  $row = $results->fetch_assoc();

  echo $row['title'].'<cg_break>'.$row['content'].'<cg_break>'.$row['file'].'<cg_break>'.$row['class'].'<cg_break>'.$row['title_heading'];
}

function editContent($conn) {

  if (isset($_POST['content_edit_subm'])) {

    $content_id = $_POST['content_id'];

    $stmnt = $conn->prepare("SELECT * FROM sitecontent WHERE id=?");
    $stmnt->bind_param("s", $st_content_id);

    $st_content_id = $content_id;

    $stmnt->execute();
    $results = $stmnt->get_result();

    $row = $results->fetch_assoc();

    $content_title = $_POST['content_title'];
    $content_content = $_POST['content_content'];
    $content_title_heading = $_POST['content_title_heading'];

    if (empty($content_title_heading))
      $content_title_heading = $row['title_heading'];

    if (!empty($_FILES['content_edit_file'])) {

      $file = $_FILES['content_edit_file'];
      $fileName = $file['name'];
    }

    if (empty($fileName))
      $content_file = $row['file'];

    else {

      unlink($row['file']);

      $fileTmpName = $file['tmp_name'];
      $fileSize = $file['size'];
      $fileError = $file['error'];

      $old_file_name = explode('.', $row['file']);

      $fileExt = explode('.', $fileName);
      $fileActualExt = strtolower(end($fileExt));

      if ($fileError == 0) {

        $fileDestination = $old_file_name[0] . '.' . $fileActualExt;

        move_uploaded_file($fileTmpName, $fileDestination);
      }

      else
        exit("There was an error uploading your file! <a href='index.php'>Back</a>");

      $content_file = $fileDestination;
    }

    $content_class = $_POST['content_class'];

    $stmnt = $conn->prepare("UPDATE sitecontent SET title=?, content=?, file=?, class=?, title_heading=? WHERE id=?");
    $stmnt->bind_param("ssssss", $st_content_title, $st_content_content, $st_content_file, $st_content_class, $st_content_title_heading, $st_content_id);

    $st_content_title = $content_title;
    $st_content_content = $content_content;
    $st_content_file = $content_file;
    $st_content_class = $content_class;
    $st_content_id = $content_id;
    $st_content_title_heading = $content_title_heading;

    $stmnt->execute();

  }
}
