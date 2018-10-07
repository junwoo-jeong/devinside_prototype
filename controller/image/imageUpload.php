<?php
  /**
    * 전송받은 blob image를 aws S3 버킷에 저장 후 URL 리턴
    * @Author Jeong Junwoo
    * @Return Image URL
    */
  session_start();

  // AWS 설정
  define('S3_KEY', 'AKIAIC2GZCGEVWIXK3GA');
  define('S3_SEC', 'EHWXalkuXvPZC3dkbdb2d0G8ptl8+1EYuLvPDkzv');
  define('BUCKET', 'testjjw');

  // AWS SDK 로드
  include_once('../../public/vender/aws/aws-autoloader.php');

  use Aws\S3\S3Client;
  use Aws\S3\Exception\S3Exception;

  // S3 객체 생성
  $s3Client = S3Client::factory(array(
    'region' => 'ap-northeast-2',
    'version' => 'latest',
    'credentials' => [
      'key'    => S3_KEY,
      'secret' => S3_SEC
    ]
  ));

  //POST 로 전달받은 blob 읽기
  $pdf_statement = stream_get_contents(fopen($_FILES['file']['tmp_name'], 'rb'));
  
  //blob을 버킷으로 전송
  $result = $s3Client->putObject(array(
    'Bucket' => BUCKET,
    'Key'    => $_SESSION['user']['nickname'] . '/' . $_FILES['file']['name'],
    'Body'   => $pdf_statement,
    'ACL'    => 'public-read'
  ));

  //Image URL 응답
  echo $result->get('ObjectURL');
?>