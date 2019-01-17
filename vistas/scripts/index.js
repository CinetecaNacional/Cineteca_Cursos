var dolar = 0, euro=0;
function init(){
  getCurrency();
}

function getCurrency(){
  // set endpoint and your access key
endpoint = 'latest'
access_key = 'd11ad76b3a4242395b58c2de978d8605';

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
      }else{
        $('#section_tipos_cambio').hide();
      }
    }
});
}

init();
