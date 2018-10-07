<?php
  /**
    * 전송받은 post data를 검증 후 DB update
    * @Author Jeong Junwoo
    */
  session_start();
  require('../../database/postDAO.php');

  $db = new PostDAO();

  $title = $_POST['title'] ?? '';
  $author = $_SESSION['user']['nickname'] ?? '';
  $content = $_POST['content'] ?? '';
  $id = $_POST['id'] ?? '';
  
  $result = $db->updatePost($title, $author, $content, $id);
  
  echo json_encode($result);
?>