<?php
  require_once('objectInfo.php');
  require_once("signupConfig.php");
  require_once("page.php");

  $output ="";
  $output .= '
  <table class="table" border="1">
    <tr>
      <th width=50>No</th>
      <th width=50>작성자</th>
      <th>제목</th>
      <th width=100>작성일자</th>
      <th width=50>조회수</th>
    </tr>
    ';
    foreach($all as $key => $val) {
      $output .='
      <tr style="text-align:center;">
      <td>'.$val['idx'].'</td>
      <td>'.$val['name'].'</td>
      <td><a href="view.php?idx='.$val['idx'].'">'.$val['subject'].'</a></td>
      <td>'.substr($val['regDate'],0,10).'</td>
      <td>'.$val['cnt'].'</td>
    </tr>
    ';
    }
    $output .='</table>';

    //  $res = [
    //   'list' => $output,
    //   'page' => $pageNation
    // ];

     echo json_encode(['list' => $output, 'page' => $pageNation], JSON_FORCE_OBJECT);
    
  ?>

