function userButton() {
  var target = document.getElementsByClassName('user-menu-wrapper')[0];
  if(target.style.display){
    target.style.display = '';
  }else{
    target.style.display = 'none';
  }
}
