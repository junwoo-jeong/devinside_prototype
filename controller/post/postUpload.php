<?php
  /**
    * 전송받은 post data를 검증 후 DB insert
    * @Author Jeong Junwoo
    */
  session_start();
  require('../../database/postDAO.php');

  $db = new PostDAO();

  $title = $_POST['title'] ?? '';
  $author = $_SESSION['user']['nickname'] ?? '';
  $content = $_POST['content'] ?? '';
  
  $result = $db->insertPost($title, $author, $content);
  
  echo json_encode($result);
?>