
var dolar = 0, euro=0;
function init(){
  getCurrency();
  var cp = document.getElementById('input_codigo_postal');
  if(cp){
    cp.addEventListener("input",function(){
      if((this.value).length>=5){
        getCodigoPostal(this.value);
      } else if ((this.value).length==0) {
        $('#msg').html('');
      }else{
        $('#msg').html('Código postal no válido');
        $('#input_municipio').val('');
        $('#input_estado').val('');
        $('#input_colonia').html('');
      }
    });
  }
}
function getCurrency(){
  // set endpoint and your access key
  endpoint = 'latest'
  //Token correcto
  //access_key = 'd11ad76b3a4242395b58c2de978d8605';
  //Token erroneo
  access_key = 'd11ad76b3a4242395b58c2de978d860';

  // get the most recent exchange rates via the "latest" endpoint:
  $.ajax({
    url: 'http://data.fixer.io/api/' + endpoint + '?access_key=' + access_key,
    dataType: 'jsonp',
    success: function(json) {
      if(json.success){
        euro = json.rates.MXN.toFixed(2)+' MXN';
        dolar = (json.rates.MXN/json.rates.USD).toFixed(2) +' MXN';
        $('#Dolar').html(dolar);
        $('#Euro').html(euro);
        $('#section_tipos_cambio').show();
      }else{
        $('#section_tipos_cambio').hide();
      }
    }
  });
}
function getCodigoPostal(cp){
  var codigo_postal = cp;
  $.ajax({
    url: 'https://api-codigos-postales.herokuapp.com/v2/codigo_postal/' + codigo_postal,
    dataType: 'json',
    success: function(json) {
      if(json.municipio){
        var options =''
        for(var i=0; i<json.colonias.length; i++){
          options+='<option value="'+json.colonias[i]+'">'+json.colonias[i]+'</option>'
        }
        $('#input_municipio').val(json.municipio);
        $('#input_estado').val(json.estado);
        $('#input_colonia').html(options);
        $('#msg').html('');
      }else{
        $('#msg').html('Código postal no válido');
      }
    }
  });

}
function upperCase(input){
  if(input.value){
    input.value = input.value.toUpperCase();
  }
}
$(document).ready(function(){
  $('.form_singUp').hide();
  var btn_logIn = $('#btn_logIn'),
  btn_singUp =$('#btn_singUp');
  btn_logIn.click(function(){
    btn_logIn.removeClass("btn-light").addClass("btn-primary");
    btn_singUp.removeClass("btn-primary").addClass("btn-light");
    $('.form_singUp').hide();
    $('.form_logIn').show();
  });
  btn_singUp.click(function () {
    btn_logIn.removeClass("btn-primary").addClass("btn-light");
    btn_singUp.removeClass("btn-light").addClass("btn-primary");
    $('.form_logIn').hide();
    $('.form_singUp').show();
  });
  init();
});
