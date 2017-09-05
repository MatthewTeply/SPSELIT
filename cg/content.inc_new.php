<?php

include 'db.inc.php';

$stmnt = $conn->prepare("SELECT * FROM sitecontent ORDER BY id DESC");
$stmnt->execute();

$results = $stmnt->get_result();

while ($row = $results->fetch_assoc()) {

  $monthYearDay = explode(" ", $row['content_date']);
  $explodeMonthYearDay = explode("-", $monthYearDay[0]);

  echo $row['title'].'<cg_break>'.$explodeMonthYearDay[2].".".$explodeMonthYearDay[1].". ".$explodeMonthYearDay[0].'<cg_break>'.$row['content'].'<cg_break>'.$row['file'].'<cg_break>'.$row['class'].'<cg_break>'.$row['title_heading'].'<cg_break>'.$row['id'].'<new_line>';
}
