<?php
  require_once("signupConfig.php");
  $editData = new signupConfig();
  $editData->setIdx($_POST['idx']);
  $data = $editData->passwordConfirm();
  $val = $data[0];

  if($_POST['pwd'] == $val['pwd']) {
    $editData->setName($_POST['name']);
    $editData->setSubject($_POST['subject']);
    $editData->setMemo($_POST['memo']);
    $editData->setRegDate(date("Y-m-d H:i:s"));
    $editData->setIp($_SERVER['REMOTE_ADDR']);

    $editData->update();
    echo "<script>alert('게시물이 성공적으로 수정 되었습니다.');document.location='index.php';</script>";
  } else {
    echo "<script>alert('비밀번호가 틀립니다.');history.back(1);</script>";
   }


?>


