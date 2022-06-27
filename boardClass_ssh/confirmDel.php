<?php
  require_once("signupConfig.php");
  $confirmDelData = new signupConfig();
  $idx = $_GET['idx'];
  $confirmDelData->setIdx($idx);
?>
<form action="delete.php" method="post">
  <input type="hidden" name="idx" value="<?php echo $idx?>"> 
  <table width=800 border="1" cellpadding=5>/home/pyj/boardClass
    <tr>
      <th colspan=2><?php echo $idx?>번 게시물을 정말 삭제할까요?</th>
    </tr>
    <tr>
      <th>비밀번호</th>
      <td><input type="password" name="pwd" placeholder="비밀번호" required autocomplete="off"></td>
    </tr>
    <tr>
      <td colspan="2">
        <div style="text-align:center";>
          <input type="submit" value="삭제">
        </div>
      </td>
    </tr>
  </table>
</form>
