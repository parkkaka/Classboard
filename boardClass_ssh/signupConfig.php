<?php
  require_once("database.php");

  class signupConfig {

    private $idx;
    private $name;
    private $subject;
    private $memo;
    private $pwd;
    private $regDate;
    private $cnt;

    protected $dbCnx;

    public function __construct($idx="", $name="", $subject="", $memo="", $pwd="", $regDate="", $ip="", $cnt=0) {
      $this->idx = $idx;
      $this->name = $name;
      $this->subject = $subject;
      $this->memo = $memo;
      $this->pwd = password_hash($pwd,PASSWORD_DEFAULT);
      $this->regDate = $regDate;
      $this->ip = $ip;
      $this->cnt = $cnt;

      $this->dbCnx = new PDO(DB_TYPE.":host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PWD,[PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]); 
      }

    // idx
    public function setIdx($idx) {
      $this->idx = $idx;
    }
    public function getIdx() {
      return $this->idx;
    }

    // 이름
    public function setName($name) {
      $this->name = $name;
    }
    public function getName() {
      return $this->name;
    }

    // 주제
    public function setSubject($subject) {
      $this->subject = $subject;
    }
    public function getSubject() {
      return $this->subject;
    }

    // MEMO
    public function setMemo($memo) {
      $this->memo = $memo;
    }
    public function getMemo() {
      return $this->memo;
    }
    
    // pwd
    public function setPwd($pwd) {
      $this->pwd = $pwd;
    }
    public function getPwd() {
      return $this->pwd;
    }

    // 날짜
    public function setRegDate($regDate) {
      $this->regDate = $regDate;
    }
    public function getRegDate() {
      return $this->regDate;
    }

    // ip
    public function setIp($ip) {
      $this->ip = $ip;
    }
    public function getIp() {
      return $this->ip;
    }

    // 조회수
    public function setCnt($cnt) {
      $this->cnt = $cnt;
    }
    public function getCnt() {
      return $this->cnt;
    }

    //-----------sql 구문
    
    // 삽입sql
    public function insertData() {
      try {
        $stm = $this->dbCnx->prepare("INSERT INTO memo(name, subject, memo, pwd, regDate, ip, cnt) values(:name, :subject, :memo, :pwd, :regDate, :ip, :cnt)");
        $stm->bindValue(':name', $this->name, PDO::PARAM_STR);
        $stm->bindValue(':subject', $this->subject, PDO::PARAM_STR);
        $stm->bindValue(':memo', $this->memo, PDO::PARAM_STR);
        $stm->bindValue(':pwd', $this->pwd, PDO::PARAM_STR);
        $stm->bindValue(':regDate', $this->regDate, PDO::PARAM_STR);
        $stm->bindValue(':ip', $this->ip, PDO::PARAM_STR);
        $stm->bindValue(':cnt', (int) $this->cnt, PDO::PARAM_INT);
        $stm->execute();
        // $stm->execute([$this->name, $this->subject, $this->memo, $this->pwd, $this->regDate, $this->ip, $this->cnt]);
        echo "<script>alert('게시물이 저장되었습니다.');document.location='index.php'</script>";
      } catch(Exception $e) {
        return $e->getMessage();
      }
    }
    // 전체 데이터 sql
    public function fetchAll() {
      try {
        $stm = $this->dbCnx->prepare("SELECT * FROM memo order by idx desc");
        $stm->execute();
        return $stm->fetchAll(); 
      } catch(Exception $e) {
        return $e->getMessage();
      }
    }
    // Limit sql
    public function fetchPage($start, $count) {
        try {
            $stm = $this->dbCnx->prepare("SELECT * FROM memo order by idx desc LIMIT :limit, :offset");
            $stm->bindValue(':limit',  (int) $start, PDO::PARAM_INT);
            $stm->bindValue(':offset', (int) $count, PDO::PARAM_INT);
            $stm->execute();
            return $stm->fetchAll();
          } catch(Exception $e) {
            return $e->getMessage();
          }
    }
    // 총 테이블 데이터 개수 sql
    public function getMemoTotalCnt() {
        try {
            return $this->dbCnx->query("SELECT count(*) from memo")->fetchColumn();
          } catch(Exception $e) {
            return $e->getMessage();
          }
    }
    
    // 인덱스 sql
    public function fetchOne() {
      try {
        $stm= $this->dbCnx->prepare("SELECT * FROM memo WHERE idx=:idx");
        $stm->bindValue(':idx',(int) $this->idx, PDO::PARAM_INT);
        $stm->execute();
        //$stm->execute([$this->idx]); 
        return $stm->fetchAll();
      } catch(Exception $e) {
        return $e->getMessage();      
      }
    }
    // 수정 sql
    public function update() {
      try {
        // $stm = $this->dbCnx->prepare("UPDATE memo SET name =?, subject =?, memo =?, regDate =?, ip =? WHERE idx = ?");
        // $stm->execute([$this->name, $this->subject, $this->memo, $this->regDate, $this->ip, $this->idx]);
        $stm = $this->dbCnx->prepare("UPDATE memo SET name =:name, subject =:subject, memo =:memo, regDate =:regDate, ip =:ip WHERE idx = :idx");
        $stm->bindValue(':name', $this->name, PDO::PARAM_STR);
        $stm->bindValue(':subject', $this->subject, PDO::PARAM_STR);
        $stm->bindValue(':memo', $this->memo, PDO::PARAM_STR);
        $stm->bindValue(':regDate', $this->regDate, PDO::PARAM_STR);
        $stm->bindValue(':ip', $this->ip, PDO::PARAM_STR);
        $stm->bindValue(':idx',(int) $this->idx, PDO::PARAM_INT);
        $stm->execute();
        return $stm->fetchAll();
      } catch(Exception $e) {
        return $e->getMessage();
      }
    }
    // 삭제 sql
    public function delete() {
      try {
        //$stm = $this->dbCnx->prepare("DELETE FROM memo WHERE idx=?");
        $stm = $this->dbCnx->prepare("DELETE FROM memo WHERE idx=:idx");
        $stm->bindValue(':idx',(int) $this->idx, PDO::PARAM_INT);
        $stm->execute();
        //$stm->execute([$this->idx]);
        return $stm->fetchAll();
      } catch(Exception $e) {
        return $e->getMessage();
      }
    }
    // idx를 조건으로 비밀번호 확인 sql
    public function passwordConfirm() {
      try {
        // $stm = $this->dbCnx->prepare("SELECT pwd from memo where idx=?");
        // $stm->execute([$this->idx]);
        $stm = $this->dbCnx->prepare("SELECT pwd from memo where idx=:idx");
        $stm->bindValue(':idx',(int) $this->idx, PDO::PARAM_INT);
        $stm->execute();
        return $stm->fetchAll();
      } catch(Exception $e) {
        return $e->getMessage();
      }
    }
    // idx를 조건으로 조회수 sql
    public function cntCount() {
      try {
        //$stm = $this->dbCnx->prepare("UPDATE memo SET cnt = cnt+1 WHERE idx = ?");
        $stm = $this->dbCnx->prepare("UPDATE memo SET cnt = cnt+1 WHERE idx =:idx");
        //$stm->bindValue(':cnt', (int) $this->cnt, PDO::PARAM_INT);
        $stm->bindValue(':idx',(int) $this->idx, PDO::PARAM_INT);
        $stm->execute();
        //$stm->execute([$this->idx]);
        return $stm->fetchAll();
      } catch(Exception $e) {
        return $e->getMessage();
      }
    }
  }
?>