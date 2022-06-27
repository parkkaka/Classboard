<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>글쓰기</title>
</head>
<body>
  
<form action="writePost.php" method="POST">
  <table width=800 border="1" cellpadding=5>
    <tr>
      <th>작성자</th>
      <td><input type="text" name="name" autocomplete="off" required></td>
    </tr>

    <tr>
      <th>제목</th>
      <td><input type="text" name="subject" style="width:100%;" autocomplete="off" required></td>
    </tr>

    <tr>
      <th>내용</th>
      <td><textarea name="memo" style="width:100%; height:300px" autocomplete="off" required></textarea></td>
    </tr>

    <tr>
      <th>비밀번호</th>
      <td><input type="password" name="pwd" placeholder="비밀번호" autocomplete="off" required></td>
    </tr>

    <tr>
      <td colspan="2">
        <div style="text-align:center";>
        <input type="submit" value="저장" name="save">
        </div>
      </td>
    </tr>
  </table>
</form>
</body>
</html>

