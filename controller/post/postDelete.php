<?php
  /**
    * 쿼리스트링을 읽어 해당 post 삭제 후 main 페이지로 redirection
    * @Author Jeong Junwoo
    */
  session_start();
  require('../../database/postDAO.php');

  //쿼리스트링 검증 없으면 main 페이지로
  $id = $_GET['num'] ?? false;
  if(!$id) {
    header('Location: /main.php');
    exit();
  }

  //삭제 작업 수행 후 main 페이지 redirection
  $db = new PostDAO();
  $db -> deletePost($id);
  header('Location: /main.php');
?>