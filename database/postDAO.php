<?php
  /**
    * posts table DAO 
    * @Author Jeong Junwoo
    */
  class PostDAO {
    private $db;

    //생성자, DB 객체 생성
    public function __construct() {
      try {
        $this->db = new PDO("mysql:host=localhost;dbname=report", "root", "");

        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      } catch (PDOException $e) {
        exit($e->getMessage());
      }
    }

    //정렬 기준을 바탕으로 모든 포스트 가져오기
    function getAllPosts($sorting) {
      $descColumn = ($sorting=='tranding') ? 'p.hit' : 'p.create_at';
      try {
        $pstmt = $this->db->prepare("SELECT p.*, u.thumbnail_img as user_thumbnail_img FROM posts as p join users as u on p.author = u.nickname order by " . $descColumn . " desc;");
        $pstmt->execute();
        return $result = $pstmt->fetchAll(PDO::FETCH_ASSOC);
      } catch (PDOException $e) {
        exit($e->getMessage());
      }
    }

    //id를 통하여 포스트 가져오기
    function getPostById($id) {
      try {
        $pstmt = $this->db->prepare("SELECT * FROM posts WHERE id=:id");
        $pstmt->bindValue(":id", $id, PDO::PARAM_INT);
        $pstmt->execute();

        return $result = $pstmt->fetch(PDO::FETCH_ASSOC);
      }catch (PDOException $e) {
        exit($e->getMessage());
      }
    }
    
    //post 저장
    function insertPost($title, $author, $content) {
      try {
        $pstmt = $this->db->prepare("INSERT INTO posts(title, author, content) VALUES (:title, :author, :content)");
        $pstmt->bindValue(":title", $title, PDO::PARAM_STR);
        $pstmt->bindValue(":author", $author, PDO::PARAM_STR);
        $pstmt->bindValue(":content", $content, PDO::PARAM_STR);
        $pstmt->execute();
      } catch (PDOException $e) {
        exit($e->getMessage());
      }
    }

    //post 삭제
    function deletePost($id) {
      try {
        $pstmt = $this->db->prepare("delete from posts where id=:id;");
        $pstmt->bindValue(":id", $id, PDO::PARAM_INT);
        $pstmt->execute();
      } catch (PDOException $e) {
        exit($e->getMessage());
      }
    }

    //post  업데이트
    function updatePost($title, $author, $content, $id) {
      try {
        $pstmt = $this->db->prepare("update posts set title = :title, author = :author, content = :content, create_at = now() where id = :id;");
        $pstmt->bindValue(":title", $title, PDO::PARAM_STR);
        $pstmt->bindValue(":author", $author, PDO::PARAM_STR);
        $pstmt->bindValue(":content", $content, PDO::PARAM_STR);
        $pstmt->bindValue(":id", $id, PDO::PARAM_INT);
        $pstmt->execute();
      } catch (PDOException $e) {
        exit($e->getMessage());
      }
    }

    //post 조회수 증가    
    function incrementPostHit($id) {
      try {
        $pstmt = $this->db->prepare("update posts set hit = hit+1 where id = :id;");
        $pstmt->bindValue(":id", $id, PDO::PARAM_INT);
        $pstmt->execute();
      } catch (PDOException $e) {
        exit($e->getMessage());
      }
    }
  }
?>