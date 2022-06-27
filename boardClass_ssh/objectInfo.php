<?php
  require_once("signupConfig.php");
  require_once("page.php");

  
  $data = new signupConfig();
  
  $currentPage = isset($_POST['page']) ? $_POST['page'] : 1;

  $conf = array(
    'cntRowAll' => $data->getMemoTotalCnt(), // 총 테이블 데이터 개수
    'cntRowPerPage' => 5, // 한 페이지당 보여질 데이터 개수,
    //'pageURL' =>'index.php?page=', // 페이지 선택시 이동할 경로(페이지번호 제외),
    'currentPage' => $currentPage, // 현재 페이지 번호 
  );
  $builder = new PageNation();
  $builder->initialize($conf);
  $pageNation = $builder->create();

  $start = $builder->getStartIndex();
  $count = $builder->getCntRowPerPage();

  $all = $data->fetchPage($start, $count);
?>