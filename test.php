<!DOCTYPE html> 

<html> 

<head> 

<link target="_blank" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="nofollow noopener" rel="stylesheet" type="text/css"/> 

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script> 

<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script> 

   <script> 

$(document).ready(function() {

// get the current date

var date = new Date();

var m = date.getMonth(), d = date.getDate(), y = date.getFullYear();


// Disable all dates till today

$('#datepicker2').datepicker({

minDate: new Date(y, m, d+1),

dateFormat: 'mm-dd-yy',

});

function enableFirday(date) {

var day = date.getDay();

return [(day == 5), ''];

}

});

</script> 

<style> 

h1{font-family: serif, "Bitstream Charter", tahoma; color:#1C6575;font-size:3em;border-bottom:1px solid #D6D6D6;}

h2{font-family: serif, "Bitstream Charter", tahoma; color:#1C6575;float:left;clear:both;width:250px;text-align:right}

input{border:1px solid #D6D6D6;background:url(DatePicker.gif) no-repeat right 3px; padding:2px;width:150px;margin:10px;float:left;}

div.dateTypes{margin:0 auto;width:600px;}

</style> 

</head> 

<body style="font-size:62.5%;"> 

<center><a target="_blank" href="http://articles.tutorboy.com/javascript/jquery-ui-datepicker-disable-specified-dates.html" rel="nofollow noopener"></a> 

<div class="dateTypes"> 

<input type="text" id="datepicker2" value="" /> 

</div> 

</center> 

</body> 

</html> 