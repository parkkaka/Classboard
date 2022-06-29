
<?php

  class PageNation {

    private $cntRowAll = 0;    // 릴레이션의 카디널리티
    private $cntRowPerPage = 10; // 한 페이지 당 보여줄 레코드 개수 // 게시판수
    private $cntPagePerBlock = 10; // 한화면에 보여줄 페이지 개수 // 
    //private $pageURL = '#'; // 페이지 선택시 이동할 경로 (a링크쓸때필요)
    
    // 페이지네이션 전체 div와 ul 태그
    private $beginTag = '<div class="PageNation"><ul>';
    private $endTag = '</ul></div>';

    private $currentPage = -1; // 현재 선택된 페이지

    function __construct()
    {
    }

    // 맴버 변수 초기화
    public function initialize(array $params = array())
    {
      foreach($params as $key => $val)
      {
        if(property_exists($this, $key)) // 객체 또는 클래스에 속성이 있는지 확인 
        {
          $this->$key = $val;
        }
      }
      return $this;
    } 

    // 페이지 네이션 html 소스 생성 메소드
    public function create()
    {
      // 현재 페이지 옵션을 설정하지 않으면 html 소스대신 에러문구 출력
      if($this->currentPage == -1) // 
      return "Failed to create PageNation, Please set the 'currentPage' property.";

      // 리턴할 최종 html소스
      $htmlText ='';

      // 페이지네이션 전체 div와 ul태그 열기
      $htmlText .= $this->beginTag;
      
      // 릴레이션의 카디널리티로 총 페이지 개수 계산
      $totalPage = ($this->cntRowAll / $this->cntRowPerPage) +1;

      // 현재 페이지에서 출력할 페이지 번호 범위 계산
      $startPage = (ceil($this->currentPage / $this->cntPagePerBlock) -1) * $this->cntPagePerBlock +1;
      $endPage = ($startPage + $this->cntPagePerBlock);
      $endPage = ($endPage < $totalPage) ? $endPage : $totalPage;

      // 처음페이지 버튼 생성
      $htmlText .= $this->getFirstPage();

      // 이전 페이지 버튼 생성
      $htmlText .= $this->getPrevTag();


      // 각 페이지 버튼 생성
      for($i = $startPage; $i < $endPage; $i++)
      {
        // if($i > $totalPage) break;
        if($i == $this->currentPage) {
          $htmlText .= '<li class="on">'.$i.'</li>';
        } else {
          $htmlText .= '<li class="page-link" id="'.$i.'">'.$i.'</li>';
        }
      }

      // 다음 페이지 버튼 생성
      $htmlText .=$this->getNextTag($totalPage);

     // 마지막 페이지 버튼 생성

      $htmlText .=$this->getLastPage($totalPage);

      // 페이지네이션 전체 div와 ul 태그 닫기
      $htmlText .= $this->endTag;
      return $htmlText;
    }

    // 처음 페이지 생성 메소드
    private function getFirstPage() {
      if($this->currentPage !=1) {
        return '<li class="page-link" id="'.'1'.'">First</li>';
      } else {
        return '<li>First<li>';
      }
    }

    // 마지막 페이지 생성 메소드  
    //
    private function getLastPage($totalPage) {
      if($this->currentPage != (ceil($totalPage)-1)) {
        return '<li class="page-link" id="'.(ceil($totalPage)-1).'">LAST</li>';
      } else {
        return '<li>LAST<li>';
      }
    }

    //.$this->pageURL

    // 이전 페이지버튼 생성 메소드
    private function getPrevTag() 
    {
      $prevIdx = $this->currentPage -1;
      if($prevIdx < 1) {
        return '<li>prev</li>';
      } else {
        return '<li class="page-link" id="'.$prevIdx.'">prev</li>';
      }
    }

    // 다음 페이지 버튼 생성 메소드
    private function getNextTag($endPage)
    {
      $nextIdx = $this->currentPage +1;
      if($nextIdx >= $endPage) {
        return '<li>next</li>';
      } else {
        return '<li class="page-link" id="'.$nextIdx.'">next</li>';
      }
    }

    // DBMS에서 쿼리 중 LIMIT할 때 시작 레코드 인덱스 리턴
    public function getStartIndex() 
    {
      return (($this->currentPage -1) * $this->cntRowPerPage);
    }
    public function getEndIndex()
    {
      return $this->currentPage * $this->cntRowPerPage; //현재선택된페이지 * 보여질개수
    }
    public function getCntRowPerPage()
    {
      return $this->cntRowPerPage;
    }
  }

?>