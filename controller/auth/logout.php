<?php
  /**
    * 실행시 user, visited 세션 삭제 후 main페이지로 redirection
    * @Author Jeong Junwoo
    * user : 유저 정보
    * visited : 방문 기록(조회수 용도)
    */
  session_start();
  unset($_SESSION['user']);
  unset($_SESSION['visited']);

  header('Location: /main.php');
?>