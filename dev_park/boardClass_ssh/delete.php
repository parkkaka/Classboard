<?php
  require_once("signupConfig.php");
  $delData = new signupConfig();
  $delData->setIdx($_POST['idx']);
  $data = $delData->passwordConfirm();
  $val = $data[0];

if($_POST['pwd'] == $val['pwd']) {
  $delData->delete();
  echo "<script>alert('게시물이 성공적으로 삭제 되었습니다.');document.location='index.php';</script>";
}else {
  echo "<script>alert('비밀번호가 틀립니다.');history.back(1);</script>";
}
?>
