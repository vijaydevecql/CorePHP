<?php
error_reporting(0);
session_start();
if($_SESSION['admin_id']!=''){
header("Location:dashboard.php");

}

 ?>
<html lang="en" class="body-full-height">
    <head>        
        <!-- META SECTION -->
        <title>Audio Book</title>            
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        
        <link rel="icon" href="favicon.ico" type="image/x-icon" />
        <!-- END META SECTION -->
        
        <!-- CSS INCLUDE -->        
        <link rel="stylesheet" type="text/css" id="theme" href="css/theme-default.css"/>
        <!-- EOF CSS INCLUDE -->                                     
    </head>
    <body>
        
        <div class="login-container lightmode">
        
            <div class="login-box animated fadeInDown">
                       <div id="snackbar" style="backgroud-color:red;">Signup successfully</div>
                <div class="login-body">
                    <div class="login-title"><strong>Create</strong> to your account</div>
                    <form id="signup" class="form-horizontal" method="post" >
					  <div class="form-group">
                        <div class="col-md-12">
                            <input type="text" name="name" class="form-control" placeholder="Author Name" required/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="email" name="email" class="form-control" placeholder="E-mail" required/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="password" name="password" class="form-control" placeholder="Password" required/>
                        </div>
                    </div>
					 <div class="form-group">
                        <div class="col-md-12">
                            <input type="file" name="image" class="form-control" placeholder="Author Name" required/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            <a href="index" class="btn btn-link btn-block">Login?</a>
                        </div>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-info btn-block">Signup</button>
                        </div>
                    </div>
                  
                    </form>
                </div>
                <div class="login-footer">
                    <div class="pull-left">
                        &copy; 2017 Audio Book
                    </div>
                    <div class="pull-right">
                        <a href="#">About</a> |
                        <a href="#">Privacy</a> |
                        <a href="#">Contact Us</a>
                    </div>
                </div>
            </div>
            
        </div>
        
    </body>
</html>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>	
<script type="text/javascript" src="js/plugins/jquery/jquery.min.js"></script>
        <script type="text/javascript" src="js/plugins/jquery/jquery-ui.min.js"></script>
        <script type="text/javascript" src="js/plugins/bootstrap/bootstrap.min.js"></script>
		 <script type='text/javascript' src='js/plugins/validationengine/languages/jquery.validationEngine-en.js'></script>
        <script type='text/javascript' src='js/plugins/validationengine/jquery.validationEngine.js'></script>        

        <script type='text/javascript' src='js/plugins/jquery-validation/jquery.validate.js'></script>

 <script>
$('document').ready(function()
{ 

	 	 $("#signup").validate({
      rules:
	  {
			email: {
				required: true,
				email: true
			},
			password: {
				required: true,	
			},
			image:{
				required: true,	
			},
			name: {
				required: true,	
			},
			
            
            },
	  
       messages:
	   {
           
            password: "Password field is Required",
			name:"Please enter the name",
			image:"Please choice image",
			email:"Please Enter Email",
            
					
       },
	submitHandler: function(data){
	var data = new FormData(data);
		$.ajax({
			type:"post",
			url: "ajax/author_signup.php", 
            data:data,
			contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
            processData: false,
		success: function(data){
			console.log(data);
			if(data=="1"){
				$("#snackbar").addClass('show');
                setTimeout(function () {
                    $("#snackbar").removeClass('show');
                }, 3000);
				window.location="index";
			}else if(data=="3"){
				swal("This email already register please choice another");
			}else{ 
				//alert("wrong username and password");
				swal("Error to signup");
			}
				
        }
        });
	
	}
       });
	   
	   
	   
	   });
</script>
