
<?php 
session_start();

if($_SESSION['admin_id']==''){

header("location:index.php");
}
 $title_tag1 = "adduser";
 $title_tag = "user";

  


 
   
   ?>	
        <!-- META SECTION -->
                   
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
        <!-- START PAGE CONTAINER -->
        <div class="page-container">
            
            <!-- START PAGE SIDEBAR -->
            <div class="page-sidebar">
                <!-- START X-NAVIGATION -->
               <?php include("sidebar.php");
			   
			   $details=$admin->admin_detail();
			   ?>
                <!-- END X-NAVIGATION -->
            </div>
            <!-- END PAGE SIDEBAR -->
            
            <!-- PAGE CONTENT -->
            <div class="page-content">
                
                <!-- START X-NAVIGATION VERTICAL -->
                <ul class="x-navigation x-navigation-horizontal x-navigation-panel">
                    <!-- TOGGLE NAVIGATION -->
                    <li class="xn-icon-button">
                        <a href="#" class="x-navigation-minimize"><span class="fa fa-dedent"></span></a>
                    </li>
                    <!-- END TOGGLE NAVIGATION -->
                    <!-- SEARCH -->
                  <!--   <li class="xn-search">
                        <form role="form">
                            <input type="text" name="search" placeholder="Search..."/>
                        </form>
                    </li>  -->  
                    <!-- END SEARCH -->
                    <!-- SIGN OUT -->
                    <li class="xn-icon-button pull-right">
                        <a href="#" class="mb-control" data-box="#mb-signout"><span class="fa fa-sign-out"></span></a>                        
                    </li> 
                    <!-- END SIGN OUT -->
                    <!-- MESSAGES -->
                 
                    <!-- END MESSAGES -->
                    <!-- TASKS -->
                   
                    <!-- END TASKS -->
                </ul>
                <!-- END X-NAVIGATION VERTICAL -->                     
                
                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="dashboard">Home</a></li>
                    <li><a href="user">Users</a></li>
                    <li class="active">ADD User</li>
                </ul>
                <!-- END BREADCRUMB -->
          
                <!-- PAGE TITLE -->
                <div class="page-title">                    
                    <h2><span onclick="back();"class="fa fa-arrow-circle-o-left"></span>Add User</h2>
                </div>
                <!-- END PAGE TITLE -->                
                
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                
                    
                    
                    <div class="row">
                        <div class="col-md-12">
                            
                            <!-- START DATATABLE EXPORT -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title"></h3>
                                         <div class="container1">
										  <div class="profile_form">
										        <div class="alert alert-success" style="display:none;">
  <strong>Success!</strong> User Add Sucessfuly
</div>
  <h2 >Profile</h2>
   <?php
// $p=mysql_query("select *from admin where id='".$_SESSION['user_id']."'");
// $details=mysql_fetch_assoc($p);

	  ?>
  <form class="form-horizontal" id="form" method="post">
    <div class="form-group">
      <label class="control-label col-sm-2" for="email"> Name</label>
	 
      <div class="col_101">
	  
        <input type="text" class="form-control c" name="name" id="name" value="" placeholder="Name" required>
      </div>
    </div>
	<div class="form-group">
      <label class="control-label col-sm-2" for="email">Email </label>
      <div class="col_101">
        <input type="email" class="form-control c" name="email" id="email" value="" placeholder="Email" required>
      </div>
    </div>
	
    <div class="form-group group1">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit"  class="btn btn-default " >Save</button>
		 
      </div>
    </div>
  </form>
</div>                     
</div>                     
                                    
                                </div>
                                
                            </div>
                            <!-- END DATATABLE EXPORT -->                            
                            
                            

                        </div>
                    </div>

                </div>         
                <!-- END PAGE CONTENT WRAPPER -->
            </div>            
            <!-- END PAGE CONTENT -->
        </div>
        <!-- END PAGE CONTAINER -->    

        <!-- MESSAGE BOX-->
        <div class="message-box animated fadeIn" data-sound="alert" id="mb-remove-row">
            <div class="mb-container">
                <div class="mb-middle">
                    <div class="mb-title"><span class="fa fa-times"></span> Remove <strong>Data</strong> ?</div>
                    <div class="mb-content">
                        <p>Are you sure you want to remove this row?</p>                    
                        <p>Press Yes if you sure.</p>
                    </div>
                    <div class="mb-footer">
                        <div class="pull-right">
                            <button class="btn btn-success btn-lg mb-control-yes">Yes</button>
                            <button class="btn btn-default btn-lg mb-control-close">No</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MESSAGE BOX-->        
        
       <?php include("footer.php");?>
        <!-- END PRELOADS -->                      

    <!-- START SCRIPTS -->
        <!-- START PLUGINS -->
        <script type="text/javascript" src="js/plugins/jquery/jquery.min.js"></script>
        <script type="text/javascript" src="js/plugins/jquery/jquery-ui.min.js"></script>
        <script type="text/javascript" src="js/plugins/bootstrap/bootstrap.min.js"></script>        
        <!-- END PLUGINS -->
        
        <!-- START THIS PAGE PLUGINS-->        
        <script type='text/javascript' src='js/plugins/icheck/icheck.min.js'></script>
        <script type="text/javascript" src="js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
        
        <script type="text/javascript" src="js/plugins/datatables/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="js/plugins/tableexport/tableExport.js"></script>
	<script type="text/javascript" src="js/plugins/tableexport/jquery.base64.js"></script>
	<script type="text/javascript" src="js/plugins/tableexport/html2canvas.js"></script>
	<script type="text/javascript" src="js/plugins/tableexport/jspdf/libs/sprintf.js"></script>
	<script type="text/javascript" src="js/plugins/tableexport/jspdf/jspdf.js"></script>
	<script type="text/javascript" src="js/plugins/tableexport/jspdf/libs/base64.js"></script>        
        <!-- END THIS PAGE PLUGINS-->  
        <script type='text/javascript' src='js/plugins/validationengine/languages/jquery.validationEngine-en.js'></script>
        <script type='text/javascript' src='js/plugins/validationengine/jquery.validationEngine.js'></script>        

        <script type='text/javascript' src='js/plugins/jquery-validation/jquery.validate.js'></script>
        <!-- START TEMPLATE -->
        <!-- <script type="text/javascript" src="js/settings.js"></script> -->
        
        <script type="text/javascript" src="js/plugins.js"></script>        
        <script type="text/javascript" src="js/actions.js"></script>        
        <!-- END TEMPLATE -->
    <!-- END SCRIPTS -->    
<script>

function change(){



$(".p").hide();
$(".c").show();

}
function readURL(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#blah').attr('src', e.target.result);
            $('#sidebarimge').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#imgInp").change(function(){

$("#blah").show();
    readURL(this);
});

function addlang(){

var name=$("#name").val();


   $.ajax({
                type:'POST',
                url:'ajax/addlanguage.php',
                data:{name:name},
                success:function(data){
		
				if(data==1){
				window.location="language";
				
				}else {
				
				alert("error to Add lanuage");
				
				}
				
				
				
				
				}
				
				
				});

}


function ch(str){

var d = str;
var name=$("#name"+d).val();


   $.ajax({
                type:'POST',
                url:'ajax/addlanguage.php',
                data:{name:name},
                success:function(data){
		
				$("#name1"+d).html('').append(name);
				
				
				
				$(".p"+d).show();
$(".n"+d).hide();
				
				}
				
				
				});


}
function chl(pk){
if(confirm("are you sure")){
$( "#this"+pk ).fadeOut( "xslow", function() {
   
  });
}
}
function jf(){



$("#gfd").prepend("<tr id='dk'><td></td><td><input type='text' class='form-control' ></td><td><input type='text' class='form-control' ></td><td><input type='submit'  value='save' class='btn btn-primary' > <input type='submit' onclick='dog();' value='Remove' class='btn btn-danger' ></td></tr>");


}
function dog(){
$("#dk").remove();
}
function back(){

window.history.back();

}
</script>	
<script>
$('document').ready(function()
{ 

	 	 $("#form").validate({
      rules:
	  {
			name: {
		    required: true,
			
			},
			email: {
			required: true,
			
			},
			
            
            },
	  
       messages:
	   {
           name: "Please enter the Name",
           email: "Please enter the Email",
		  
					
       },
	submitHandler: login
       });
	   
	   
	   function login(){
	   
	   
	  
    var form_data = new FormData(); 
   
    var name=$("#name").val();
    var email=$("#email").val();
   
    
    form_data.append('name', name);
    form_data.append('email', email);
      

   

                             
    $.ajax({
                url: 'ajax/adduser.php', // point to server-side PHP script 
                dataType: 'text',  // what to expect back from the PHP script, if anything
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,                         
                type: 'post',
                success: function(data){
                  var data=data;
				  
				  if(data == "3"){
                  alert("this email is already register Kindly Please use another");
				  
					}	else{
						$("#form")[0].reset();
					  $(".alert").fadeIn( "slow", function() {
						   setInterval(hides,3000);
						});
     }        
				       
                }
     });
	   
	   }
	   });
	   function hides(){
		$(".alert").fadeOut("slow");
	   }
</script>






