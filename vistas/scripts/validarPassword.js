var input_password = document.getElementById('input_password'),
    input_password_comfirm = document.getElementById('input_password_comfirm');
input_password_comfirm.addEventListener("blur", function( event ){
  if(input_password.value!==input_password_comfirm.value){
    input_password.setCustomValidity('Las contraseñas no coinciden');
  }else{
    input_password.setCustomValidity("");
  }
});

input_password.addEventListener("blur", function( event ){
  if(input_password.value!==input_password_comfirm.value){
    input_password.setCustomValidity('Las contraseñas no coinciden');
  }else{
    input_password.setCustomValidity("");
  }
});
