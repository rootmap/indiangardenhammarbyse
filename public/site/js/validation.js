$(document).ready(function(){
        $('#send_message').on("click",function(e){
            
            // Stop form submission & check the validation
            e.preventDefault();
            
            // Variable declaration
            var error = false;
            
            var email = $('#email').val();
            
            var message = $('#message').val();
            
            
            if(email.length == 0 || email.indexOf('@') < 1 || (email.lastIndexOf('.') - email.indexOf('@') < 2) || (email.length - email.lastIndexOf('.') < 2) )
            {
                var error = true;
                
                $('#email').addClass("validation");
                
            }else{
                $('#email').removeClass("validation");
            }
            
            if(message.length == 0){
                var error = true;
                $('#message').addClass("validation");
            }else{
                $('#message').removeClass("validation");
            }
            
            // If there is no validation error, next to process the mail function
            if(error == false){
               // Disable submit button just after the form processed 1st time successfully.
                
                $('#send_message').attr({'enabled' : 'enable', 'value' : 'Sending...' });
                
                /* Post Ajax function of jQuery to get all the data from the submission of the form as soon as the form sends the values to email.php*/
                $.post("php/email.php", $("#contact_form").serialize(),function(result){
                    //Check the result set from email.php file.
                    if(result == 'sent'){
                        //If the email is sent successfully, remove the submit button
                         
                         $('#send_message').attr({'enabled' : 'enable', 'value' : 'send' });
                        //Display the success message
                        $('#mail_success').fadeIn(500);
                    }else{
                        //Display the error message
                        $('#mail_fail').fadeIn(500);
                        // Enable the submit button again
                        $('#send_message').removeAttr('disabled').attr('value', 'Send The Message');
                    }
                });
            }
        });    


        $('#send-message-sidebar').on("click",function(e){
            
            // Stop form submission & check the validation
            e.preventDefault();
            
            // Variable declaration
            var error = false;
            
            var email = $('#email-sidebar').val();
            
            var date = $('#datepicker-sidebar').val();
            
            
            if(email.length == 0 || email.indexOf('@') < 1 || (email.lastIndexOf('.') - email.indexOf('@') < 2) || (email.length - email.lastIndexOf('.') < 2) )
            {
                var error = true;
                
                $('#email-sidebar').addClass("validation");
                
            }else{
                $('#email-sidebar').removeClass("validation");
            }
            
            if(date.length == 0){
                var error = true;
                $('#datepicker-sidebar').addClass("validation");
            }else{
                $('#datepicker-sidebar').removeClass("validation");
            }
            


            // If there is no validation error, next to process the mail function
            if(error == false){
               // Disable submit button just after the form processed 1st time successfully.
                
                $('#send-message-sidebar').attr({'enabled' : 'enable', 'value' : 'Sending...' });
                
                /* Post Ajax function of jQuery to get all the data from the submission of the form as soon as the form sends the values to email.php*/
                $.post("php/reservation.php", $("#sidebar_form").serialize(),function(result){
                    //Check the result set from email.php file.
                    
                    if(result == 'sent'){
                        //If the email is sent successfully, remove the submit button
                         
                         $('#send-message-sidebar').attr({'enabled' : 'enable', 'value' : 'send' });
                        //Display the success message
                        $('#sidebar_mail_success').fadeIn(500);
                    }else{
                        //Display the error message
                        $('#sidebar_mail_fail').fadeIn(500);
                        // Enable the submit button again
                        $('#send-message-sidebar').removeAttr('disabled').attr('value', 'Send The Message');
                    }
                });
            }
            
        });   



        $('#send-message-reservation').on("click",function(e){
            
            // Stop form submission & check the validation
            e.preventDefault();
            
            // Variable declaration
            var error = false;
            
            var email = $('#email-reservation').val();
            
            var date = $('#datepicker').val();
            
            
            if(email.length == 0 || email.indexOf('@') < 1 || (email.lastIndexOf('.') - email.indexOf('@') < 2) || (email.length - email.lastIndexOf('.') < 2) )
            {
                var error = true;
                
                $('#email-reservation').addClass("validation");
                
            }else{
                $('#email-reservation').removeClass("validation");
            }
            
            if(date.length == 0){
                var error = true;
                $('#datepicker').addClass("validation");
            }else{
                $('#datepicker').removeClass("validation");
            }
            

            // If there is no validation error, next to process the mail function
            if(error == false){
               // Disable submit button just after the form processed 1st time successfully.
                
                $('#send-message-reservation').attr({'enabled' : 'enable', 'value' : 'Sending...' });
                
                /* Post Ajax function of jQuery to get all the data from the submission of the form as soon as the form sends the values to email.php*/
                $.post("php/reservation-main.php", $("#booking_form").serialize(),function(result){
                    //Check the result set from email.php file.
                    
                    if(result == 'sent'){
                        //If the email is sent successfully, remove the submit button
                         
                         $('#send-message-reservation').attr({'enabled' : 'enable', 'value' : 'send' });
                        //Display the success message
                        $('#reservation_mail_success').fadeIn(500);
                        var high = "";
                        high=$(".booking-back").height(); 
                        $(".book-table-wrapper .booking-image img").css("height", high+190); 
                    }else{
                        //Display the error message
                        $('#reservation_mail_fail').fadeIn(500);
                        var high = "";
                        high=$(".booking-back").height(); 
                        $(".book-table-wrapper .booking-image img").css("height", high+190); 
                        // Enable the submit button again
                        $('#send-message-reservation').removeAttr('disabled').attr('value', 'Send The Message');
                    }
                });
            }
            
        });

$('#comment-submit').on("click",function(e){
            
            // Stop form submission & check the validation
            e.preventDefault();
            
            // Variable declaration
            var error = false;
            
            var email = $('#exampleInputEmail1').val();
            
            var name = $('#yourName1').val();
            
            
            if(email.length == 0 || email.indexOf('@') < 1 || (email.lastIndexOf('.') - email.indexOf('@') < 2) || (email.length - email.lastIndexOf('.') < 2) )
            {
                var error = true;
                
                $('#exampleInputEmail1').addClass("validation");
                
            }else{
                $('#exampleInputEmail1').removeClass("validation");
            }
            
            if(name.length == 0){
                var error = true;
                $('#yourName1').addClass("validation");
            }else{
                $('#yourName1').removeClass("validation");
            }
        });


    });