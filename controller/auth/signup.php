<?php
  /**
    * 전송 받은 POST 데이터를 추출/검증 후 DB insert, main 페이지로 redirection
    * @Author Jeong Junwoo
    */
  require('../../database/userDAO.php');
  $db = new userDAO();

  // 중복 연산자, 3항 연산자와 같은 역할
  $u_email = $_REQUEST['email'] ?? '';
  $u_password = $_REQUEST['password'] ?? '';
  $u_nickname = $_REQUEST['nickname'] ?? '';
  // 결과 값이 있으면 결과를, 없으면 false반환
  $info = $db->insertUser($u_email, $u_password, $u_nickname);
  header('Location: /signinpage.php');
?>