<?php
include("include/function.php");
$pwn=new user();
  $d=$pwn->admin_detail();

if(isset($_POST["next"]))
{
$to=$_POST["email"];
if($d['email']==$to)
{




    
    $from="nitin.cqlsys@gmail.com";
    $message="";

    // Always set content-type when sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= 'From: '.$from . "\r\n" .
    'Reply-To: '.$from . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
    $subject="Add Chat Passward Change ";
    /*Start mail content*/

    $message .="<p>Thank you for providing us with your up-to-date contact information. This email is part of the sign-up validation process.</p>"; 
     $message .="<p>Please click the URL link below, which finalises our validation checks and will take you back to the YouMeFX app</p>";
    $message .="<p><a href='".$token."' >".$token."</a></p>";
    $message .="<p>New Passward is:</p>";
    <!-- $message .=echo rand(); -->
    $message .="<br>Kind Regards,<br>Team Add Chat";
    //echo $message; die;
    /*End mail content*/
    $mail=mail($to,$subject,$message,$headers);
}
else
{
echo "Wrong Email";
}
}

?>
<html lang="en" class="body-full-height">
    <head>        
        <!-- META SECTION -->
        <title>Add Chat</title>            
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
               
                <div class="login-body">
                    <div class="login-title"><b>Enter any recovery email  associated with your account</b></div>
                    <form id="login" class="form-horizontal" method="post" >
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="text" name="email" class="form-control" placeholder="E-mail" required/>
                        </div>
                    </div>
                    <!-- <div class="form-group">
                        <div class="col-md-12">
                            <input type="password" name="password" class="form-control" placeholder="Password" required/>
                        </div>
                    </div> -->
                    <div class="form-group">
                        <!-- <div class="col-md-6">
                            <a href="forget.php" class="btn btn-link btn-block">Forget your password?</a>
                        </div> -->
                        <div class="col-md-6">
                            
                            <input type="submit" name="next" class="btn btn-info btn-block" value="Next" />

                        </div>
                        <div "pull-right>
                             <a href="index.php"><b>Back</b></a>
                        </div>
                    </div>
                  
                    </form>
                </div>
                <div class="login-footer">
                    <div class="pull-left">
                        &copy; 2017 Add Chat
                    </div>
                    <!-- <div class="pull-right">
                        <a href="#">About</a> |
                        <a href="#">Privacy</a> |
                        <a href="#">Contact Us</a>
                    </div> -->
                </div>
            </div>
            
        </div>
        
    </body>
</html>


<script type="text/javascript" src="js/plugins/jquery/jquery.min.js"></script>
        <script type="text/javascript" src="js/plugins/jquery/jquery-ui.min.js"></script>
        <script type="text/javascript" src="js/plugins/bootstrap/bootstrap.min.js"></script>
         <script type='text/javascript' src='js/plugins/validationengine/languages/jquery.validationEngine-en.js'></script>
        <script type='text/javascript' src='js/plugins/validationengine/jquery.validationEngine.js'></script>        

        <script type='text/javascript' src='js/plugins/jquery-validation/jquery.validate.js'></script>



