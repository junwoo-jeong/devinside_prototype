<!--
  * signup page
  * @Author Jeong Junwoo
  구현 기능
  1. 회원가입 페이지 구현
-->
<!DOCTYPE html>
<html lang="kr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" href="./public/css/signup.css">
  <link rel="stylesheet" href="./public/css/tools/button.css">
  <title>Document</title>
</head>
<body>
    <body class="text-center">
        <form class="form-signin" action="./controller/auth/signup.php" method="POST">
          <h1 class="display-2 mb-4">회원 가입</h1>
          <hr/>
          <h1 class="h3 mb-3 font-weight-normal">Please sign up</h1>
          <label for="inputEmail" class="sr-only">Email address</label>
          <input type="email" id="email" name="email" class="form-control" placeholder="Email address" required="" autofocus="">
          
          <label for="inputPassword" class="sr-only">Password</label>
          <input type="password" id="password" name="password" class="form-control" placeholder="Password" required="">
          
          <label for="inputText" class="sr-only">Nickname</label>
          <input type="text" id="nickname" name="nickname" class="form-control" placeholder="Nickname" required="" autofocus="">
          
          <button class="btn btn-lg btn-danger btn-block" type="submit">회원 가입</button>
          <hr />
          <h1 class="h4 mb-3 font-weight-normal">이미 계정이 있으신가요?</h1>
          <a class="btn btn-link btn-block" href="/signinpage.php">로그인 페이지로</a>
          <p class="mt-5 mb-3 text-muted">JEONG Copyright© 2018.09.28 ~ </p>
        </form>
      </body>
</body>

</html>