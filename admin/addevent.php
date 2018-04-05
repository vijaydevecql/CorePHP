
<?php 
session_start();
include("include/function.php");
if($_SESSION['user_id']==''){

header("location:index.php");
}

   ?>	
      
                   
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
               <?php include("sidebar.php");?>
                <!-- END X-NAVIGATION -->
            </div>
            <!-- END PAGE SIDEBAR -->
            
           
            <div class="page-content">
                
                
                <ul class="x-navigation x-navigation-horizontal x-navigation-panel">
                  
                    <li class="xn-icon-button">
                        <a href="#" class="x-navigation-minimize"><span class="fa fa-dedent"></span></a>
                    </li>
                    
                    <li class="xn-search">
                        <form role="form">
                            <input type="text" name="search" placeholder="Search..."/>
                        </form>
                    </li>   

                    <li class="xn-icon-button pull-right">
                        <a href="#" class="mb-control" data-box="#mb-signout"><span class="fa fa-sign-out"></span></a>                        
                    </li> 
                   
                </ul>
               
                <ul class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Events</a></li>
                    <li class="active">Add Events</li>
                </ul>
                <!-- END BREADCRUMB -->
                
                <!-- PAGE TITLE -->
                <div class="page-title">                    
                    <h2><span onclick="back();"class="fa fa-arrow-circle-o-left"></span> Add Events</h2>
                </div>
                <!-- END PAGE TITLE -->                
                
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                
                    
                    
                    <div class="row">
                        <div class="col-md-12">
                            
                            <!-- START DATATABLE EXPORT -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Add Events </h3>
                                                                   
                                    
                                </div>
                                <div class="panel-body">
                                    
                                    <form method="post" id="event" enctype="multipart/form-data">
    <div class="form-group">
      <label for="name">Event Name:</label>
      <input type="text" name="event_name" class="form-control" id="event_name" placeholder="Event Name" required>
    </div>
    <div class="form-group">
      <label for="em">Event Title:</label>
      <textarea  name ="event_title" rows="2" cols="123" id="event_title" class="form-control" placeholder="Event Title "required></textarea>
    </div>
    <div class="form-group">
      <label for="dob">	Event Date:</label>
       <input type="text"  name="date" class="form-control" id="date" placeholder="Event Date"required>
    </div>
    <div class="form-group">
      <label for="im">	Event Picture:</label>
       <input type="file" name="event_pic" id="event_pic" class="form-control"required>
    </div>
	    <div class="form-group">
      <label for="dob">	Event description:</label>
       <textarea class="form-control pp" rows="5" id="description" ></textarea>
    </div>
    <div class="form-group">
      <label for="loc">	Location:</label>
              <div class="page-content-wrap">                
                
                    <div class="row" style="display:none;">
                        <div class="col-md-6">                        
                            <!-- START GOOGLE WORLD MAP -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Google World Map</h3>
                                </div>
                                <div class="panel-body panel-body-map">
                                    <div id="google_world_map" style="width: 100%; height: 300px;"></div>
                                </div>
                            </div>
                            <!-- END GOOGLE WORLD MAP-->
                        </div>                                        
                        <div class="col-md-6">                        
                            <!-- START GOOGLE EUROPE MAP -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Google Europe Map</h3>
                                </div>
                                <div class="panel-body panel-body-map">
                                    <div id="google_eu_map" style="width: 100%; height: 300px;"></div>
                                </div>
                            </div>
                            <!-- END GOOGLE EUROPE MAP -->
                        </div>
                    </div>

                                                          
                        <div >                        

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Google Map </h3>
                                    <div class="pull-right" style="width: 200px;">
                                        <input type="text" name ="location" id="target" class="form-control" Required/>
                                    </div>                                
                                </div>
                                <div class="panel-body panel-body-map">
                                    <div id="google_search_map" style="width: 100%; height: 200px;"></div>
                                </div>
                            </div>

                        </div>
                    </div>

                   
                
                    
                </div>

                        </div>
                    
    
    
    <button type="submit"  name="submit"class="btn btn-danger">Submit</button>&nbsp;&nbsp;&nbsp;<button type="reset"  name="clear"class="btn btn-info">Clear</button>
  </form>
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
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places"></script>

        <script type='text/javascript' src='js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js'></script>
        <script type='text/javascript' src='js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js'></script>
        <script type='text/javascript' src='js/plugins/jvectormap/jquery-jvectormap-europe-mill-en.js'></script>
        <script type='text/javascript' src='js/plugins/jvectormap/jquery-jvectormap-us-aea-en.js'></script>

        <script type='text/javascript' src='js/plugins/icheck/icheck.min.js'></script>
        <script type="text/javascript" src="js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>       
        <!-- END THIS PAGE PLUGINS-->        
<script src="//cdn.ckeditor.com/4.6.2/basic/ckeditor.js"></script>
        <!-- START TEMPLATE -->
        <script type="text/javascript" src="js/settings.js"></script>
         <script type='text/javascript' src='js/plugins/validationengine/languages/jquery.validationEngine-en.js'></script>
        <script type='text/javascript' src='js/plugins/validationengine/jquery.validationEngine.js'></script>        

        <script type='text/javascript' src='js/plugins/jquery-validation/jquery.validate.js'></script>
        <script type="text/javascript" src="js/plugins.js"></script>        
        <script type="text/javascript" src="js/actions.js"></script>
        <script type="text/javascript" src="js/demo_maps.js"></script>
        <!-- END TEMPLATE -->
    <!-- END SCRIPTS -->          
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">


  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    </body>
</html>
    
        <!-- END TEMPLATE -->
    <!-- END SCRIPTS -->    
<script>
var editor = CKEDITOR.replace( 'description' );


 $( function() {
    $( "#date" ).datepicker();
  } );
    
 $("#event").validate({
      rules:
	  {
			event_name: {
		    required: true,
			
			},
			event_title: {
			required: true,	
			},
			event_pic: {
			required: true,	
			},
			location: {
			required: true,	
			},
			date: {
			required: true,	
			},
            
            },
	  
       messages:
	   {
           
            event_name: "please enter the event name",
			event_title: "please enter the event Title",
			event_pic: "Event Image is required",
			location: "location field is required",
            date: "Event Date is required",
					
       },
	submitHandler: login
       });
	   
	   
	   function login(){
	  
	   var form =  new FormData();
	   
	   var event_name=$("#event_name").val();
	   var event_title=$("#event_title").val();
	   var event_owner="<?php echo $_SESSION['user_id']; ?>";
	   var location=$("#target").val();
	   var date=$("#date").val();
	   var lat="";
	   var longs="";
	   var description=editor.getData();
	   var event_pic=$('#event_pic').prop('files')[0];   
	   
	   // for (instance in CKEDITOR.instances) {
                 // CKEDITOR.instances[instance].updateElement();
             // }
	
		   form.append('event_name',event_name);
		   form.append('event_title',event_title);
		   form.append('event_pic',event_pic);
		   form.append('event_owner',event_owner);
		   form.append('lat',lat);
		   form.append('long',longs);
		   form.append('location',location);
		   form.append('date',date);
		   form.append('description',description);
	   
	  	$.ajax({
		  type:"post", 
		  url: "ajax/addevent.php", 
          datatype:'text',
          cache: false,
          contentType: false,
          processData: false,
          data:form,
          success:function(data){
		window.location="event_lisning";

			
				
        }
        });
	   
	   
	   }
	 
function back(){

window.history.back();

}
</script>	
    </body>
</html>






