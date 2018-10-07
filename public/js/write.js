 var editor = new tui.Editor({
  el: document.getElementById('editSection'),
  initialEditType: 'markdown',
  previewStyle: 'vertical',
  hooks: {
    'addImageBlobHook': function(blob, callback) {
      //blob 전송후 return Image URL을 callback 함수로 전달
      alert('asdasd');
      sendingBlob(blob, callback);
    }
  }
});

function sendingBlob(blob, callback) {
  // blob을 담을 formdata 객체 생성, php에서 $_FILES로 접근가능
  var data = new FormData();
  // ajax 전송 객체 생성
  var xhr = new XMLHttpRequest();
  // 호출 url 설정
  xhr.open('POST', '/controller/image/imageUpload.php', true);
   
  xhr.onload = function() {
    if(xhr.status === 200 || xhr.status === 201) {
      // 성공적으로 수행했을 시 전달받은 callback 함수 실행, xhr.responseText : URL
      callback(xhr.responseText, "asd");
    } else {
      console.error(xhr.responseText);
    }
  }
  // upload 진행상황 log로 표시
  xhr.upload.onprogress = function(e) {
    if (e.lengthComputable) {
      console.log((e.loaded / e.total) * 100);
    }
  };
  // formdata에 blob Image 추가
  data.append('file', blob);
  // 요청 시작
  xhr.send(data);
}

function modify() {
  var title = $('#title_text')[0].value;
  var content = editor.convertor.toHTMLWithCodeHightlight(editor.getValue());
  if(!title && !content){
    alert("모두 입력하여 주십시오");
  }else {
    var data = {
      title: title,
      content: content,
      id: document.state['post_id']
    }
    $.ajax({
      url: '/controller/post/postModify.php', // 요청 할 주소
      type: 'POST', // GET, PUT
      dataType: 'json',
      data: data,
      beforeSend: function(jqXHR) {
        //alert("서버 요청을 시작합니다.");
      }, // 서버 요청 전 호출 되는 함수 return false; 일 경우 요청 중단
      success: function(jqXHR) {
        alert("성공적으로 수정되었습니다.");
        location.href="/main.php";
      }, // 요청 완료 시
      error: function(jqXHR) {
        //alert("서버 요청이 실패했습니다.")
      }, // 요청 실패.
      complete: function(jqXHR) {} // 요청의 실패, 성공과 상관 없이 완료 될 경우 호출
    });
  }
 
}

function submit() {
  var title = $('#title_text')[0].value;
  var content = editor.convertor.toHTMLWithCodeHightlight(editor.getValue());
  if(!title && !content) {
    alert("모두 입력하여 주십시오");
  }else {
    var data = {
      title: title,
      content: content
    }
    $.ajax({
      url: '/controller/post/postUpload.php', // 요청 할 주소
      type: 'POST', // GET, PUT
      dataType: 'json',
      data: data,
      beforeSend: function(jqXHR) {
        //alert("서버 요청을 시작합니다.");
      }, // 서버 요청 전 호출 되는 함수 return false; 일 경우 요청 중단
      success: function(jqXHR) {
        alert("성공적으로 등록되었습니다.");
        location.href="/main.php";
      }, // 요청 완료 시
      error: function(jqXHR) {
        //alert("서버 요청이 실패했습니다.")
      }, // 요청 실패.
      complete: function(jqXHR) {} // 요청의 실패, 성공과 상관 없이 완료 될 경우 호출
    });
  }
}