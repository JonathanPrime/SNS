$(document).ready(function(){
  
  $('#select').change(function(){

var selectValor = '#'+$(this).val();
alert ("hjola" );

$('#pai').children('div').hide();
$('#pai').children(selectValor).show();
  });
});