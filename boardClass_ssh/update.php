<?php
  require_once('signupConfig.php');
  $updateData = new signupConfig();
  $updateData->setIdx($_GET['idx']);
  $record= $updateData->fetchOne();
  $val = $record[0];
?>

<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>게시판 수정</title>
</head>
<body>
  
<form action="updatePost.php" method="POST">
  <input type="hidden" name="idx" value="<?php echo $val['idx']?>">
  <table width=800 border="1" cellpadding=5>
    <tr>
      <th>작성자</th>
      <td><input type="text" name="name" value="<?php echo htmlspecialchars($val['name'])?>"></td>
    </tr>

    <tr>
      <th>제목</th>
      <td><input type="text" name="subject" style="width:100%;" value="<?php echo htmlspecialchars($val['subject'])?>"></td>
    </tr>

    <tr>
      <th>내용</th>
      <td><textarea name="memo" style="width:100%; height:300px"><?php echo htmlspecialchars($val['memo'])?></textarea></td>
    </tr>

    <tr>
      <th>비밀번호</th>
      <td><input type="password" name="pwd" placeholder="비밀번호" required></td>
    </tr>

    <tr>
      <td colspan="2">
        <div style="text-align:center";>
        <input type="submit" value="수정" name="update">
        </div>
      </td>
    </tr>
  </table>
</form>
</body>
</html>

