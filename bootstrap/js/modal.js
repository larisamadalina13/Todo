$(document).ready(function(){
$("button#submit").click(function(){
$.ajax({
type: "POST",
url: "resultsUsers.php",
data: $('form.formaddUser').serialize(),
success: function(message){
$("#formaddUser").html(message)
$("#myModal").modal('hide');
},
error: function(){
alert("Error");
}
});
});
});

