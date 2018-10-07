<?php 
// echo "업로드한 파일명 : ".$_FILES["myFile"]["name"] ."
// ";
//    echo "업로드한 파일의 크기 : ".$_FILES["myFile"]["size"] ."
// ";
//    echo "업로드한 파일의 MIME Type : ".$_FILES["myFile"]["type"] ."
// ";
//    echo "임시 디렉토리에 저장된 파일명 : ".$_FILES["myFile"]["tmp_name"] ."
// ";
  $file = file_get_contents($_FILES['file']['tmp_name']);
  file_put_contents('../myImage/test.png', $file);
?>