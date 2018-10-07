<?php
  /**
    * 실행시 유저 인증 작업 후 user, visited 세션 생성후 main페이지로 redirection
    * @Author Jeong Junwoo
    * user : 유저 정보
    * visited : 방문 기록(조회수 용도)
    */
  session_start();
  require('../../database/userDAO.php');

  $db = new userDAO();

  // 중복 연산자, 3항 연산자와 같은 역할
  $u_email = $_REQUEST['email'] ?? '';
  $u_password = $_REQUEST['password'] ?? '';

  // 결과 값이 있으면 결과를, 없으면 false반환
  $info = $db->getUserByEmail($u_email) ?? false;
  if($info) {
    //아이디가 일치하는 경우
    if($u_password== $info['password']){
      // 비밀번호도 일치하면 세션 생성 후 redirect
      $_SESSION['user'] = $info;
      // 방문했던 포스트를 기록하여 조회수 중복 증가 방지
      $_SESSION['visited'] = array();
      
      header('Location: /main.php');
    }else {
      //일치하지 않으면 로그인 페이지로 redirect
      header('Location: /signin.php');
    }
  }else {
    //아이디가 없는 정보임, 로그인 페이지로 redirect
    header('Location: /signin.php');
  }
?>