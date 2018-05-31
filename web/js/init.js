(function($){
  $(function(){

    $('.button-collapse').sideNav();
    $('.tooltipped').tooltip({delay: 5});
    $('select').material_select();
    $('.indicator').addClass('blue-grey');
    $('.anima .indicator').addClass('white');
  	$('.datepicker').pickadate({
  		format: 'dd-mm-yyyy',
  		selectMonths: true, 
  		selectYears: 20 
  	});
      $('.modal').leanModal();
  }); // end of document ready
})(jQuery); // end of jQuery name space