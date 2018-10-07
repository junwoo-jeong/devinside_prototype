<?php
 /**
    * users table DAO 
    * @Author Jeong Junwoo
    */
  class UserDAO {
    private $db;

    //DB 생성자
    public function __construct() {
      try {
        $this->db = new PDO("mysql:host=localhost;dbname=report", "root", "");

        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      } catch (PDOException $e) {
        exit($e->getMessage());
      }
    }

    //이메일로 user 가져오기
    function getUserByEmail($email) {
      try {
        $pstmt = $this->db->prepare("SELECT * FROM users WHERE email=:email");
        $pstmt->bindValue(":email", $email, PDO::PARAM_STR);
        $pstmt->execute();

        return $result = $pstmt->fetch(PDO::FETCH_ASSOC);
      }catch (PDOException $e) {
        exit($e->getMessage());
      }
    }

    //user 저장
    function insertUser($email, $password, $nickname){
      try {
        $pstmt = $this->db->prepare("INSERT INTO users(email, password, nickname) VALUES (:email, :password, :nickname)");
        $pstmt->bindValue(":email", $email, PDO::PARAM_STR);
        $pstmt->bindValue(":password", $password, PDO::PARAM_STR);
        $pstmt->bindValue(":nickname", $nickname, PDO::PARAM_STR);
        $pstmt->execute();
      } catch (PDOException $e) {
        exit($e->getMessage());
      }
    }
  }
?>