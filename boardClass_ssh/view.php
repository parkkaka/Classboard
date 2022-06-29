<?php
  require_once('signupConfig.php');
  $viewData = new signupConfig();
  $viewData->setIdx($_GET['idx']);
  $record= $viewData->fetchOne();
  $viewData->cntCount();
  $val = $record[0];
?>

<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>게시물보기</title>
</head>
<body>
  
<form action="writePost.php" method="POST">
  <table width=800 border="1" cellpadding=5>

    <tr>
      <th width=200>작성자</th>
      <td><?php echo $val['name']?></td>
    </tr>

    <tr>
      <th>제목</th>
      <td><?php echo $val['subject']?></td>
    </tr>

    <tr>
      <th>내용</th>
      <td><?php echo nl2br($val['memo'])?></td>
    </tr>

    <tr>
      <th>조회수</th>
      <td><?php echo $val['cnt']?></td>
    </tr>


    <tr>
      <td colspan="2">
        <div style="float:right";>
        <a href="confirmDel.php?idx=<?php echo $val['idx']?>">삭제</a>
        <a href="update.php?idx=<?php echo $val['idx']?>">수정</a>
        </div>
        <a href="index.php">목록</a>
      </td>
    </tr>

  </table>
</form>
</body>
</html>

