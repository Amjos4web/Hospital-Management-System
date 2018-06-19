$(document).ready(function() {                 
  $("#loginBtn").click(function(){
    $.ajax({
      url:'user_authentication.php',
      method:'POST',
      data: {email:$("#loginid").val(), password:$("#loginpsw").val()},
      success: function(data) {
		if(data == "Invalid Username and Password") {
			$("#errorMsg").html("Invalid Username and Password");  
			return false;
		} else {
			window.location.href= data;
			return true;
		}
	  }
    });
  });
});