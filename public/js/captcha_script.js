$(document).ready(function() {
//change CAPTCHA on each click or on refreshing page
    $("#reload").click(function() {
	
        $("img#img").remove();
		var id = Math.random();
        $('<img id="img" src="php/captcha.php?id='+id+'"/>').appendTo("#imgdiv");
		 id ='';
    });

//validation function
    $('.submit_sign_up').click(function(e) {

        /************** form validation **************/
 
        var captcha = $("#captcha").val();

        var  val_captcha;
        

        	//validating CAPTCHA with user input text
            var dataString = 'captcha=' + captcha;
            $.ajax({
                type: "POST",
                url: "php/verify.php",
                data: dataString,
                success: function(html) {
                   if(html == 1)
                    {
                       $("div.captcha_val").html("wrong captcha");
                    }
                    else
                    { 
                      $('#signup_form').submit();  
                    }
                }
            
        });
    });
});
