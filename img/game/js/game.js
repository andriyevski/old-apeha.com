$(function() { 
$('#send_msg').submit(function() {
  $.ajax({
   url:'chat.php',
   type:'POST',
   data:'msg='+$('#chat_msg').val()+'&to_login='+$('#to_login').val()+'&private='+$('#private').val(),
   dataType: 'html',
   success: function(data) {
          $("#chat").scrollTop(990);
	  $('#chat').load('function/chat_msg.php');
	  }
  });
  $('#chat_msg').replaceWith('<input type=text name=chat_msg id=chat_msg size=110>');

  return false;
 }); 
});

$(function refresh_chat() { 
	$("#chat").scrollTop(500);
	setInterval("jQuery('#chat').load('function/chat_msg.php');",5000);
});