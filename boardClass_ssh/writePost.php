<?php
  if(isset($_POST['save'])) {
    require_once("signupConfig.php");
    $writeData = new signupConfig();

    $writeData->setName($_POST['name']);
    $writeData->setSubject($_POST['subject']);
    $writeData->setMemo($_POST['memo']);
    $writeData->setPwd($_POST['pwd']);
    $writeData->setRegDate(date("Y-m-d H:i:s"));
    $writeData->setIp($_SERVER['REMOTE_ADDR']);
    $writeData->insertData();
  }
?>