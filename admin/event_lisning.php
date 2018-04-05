

 

<html lang="en">
    <head>

<?php 

session_start();
include("controller/event.php");
if($_SESSION['user_id']==''){

header("location:index.php");
}
 
$event=new event();

if($_GET['id']){


$delete=$event->deletevent($_GET['id']);

}

   
   ?>	
       <!-- META SECTION -->
        <title>Car Show Admin</title>            
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
                    <!-- <li class="xn-search">
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
                    <li><a href="dashboard.php">Home</a></li>
                    
                    <li class="active">Event's</li>
                </ul>
                <!-- END BREADCRUMB -->
                
                <!-- PAGE TITLE -->
                <div class="page-title">                    
                    <h2><span onclick="back();"class="fa fa-arrow-circle-o-left"></span> Event's Record</h2>
                </div>
                <!-- END PAGE TITLE -->                
                
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                
                    
                    
                    <div class="row">
                        <div class="col-md-12">
                            
                            <!-- START DATATABLE EXPORT -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Event's Record</h3>
                                                     
                                    <div class="btn-group pull-right">
                                        <button class="btn btn-danger" onclick="goadd();" >Add Event</button>
                                        <ul class="dropdown-menu">
                                            <!-- <li><a href="#" onClick ="$('#customers2').tableExport({type:'json',escape:'false'});"><img src='img/icons/json.png' width="24"/> JSON</a></li>
                                            <li><a href="#" onClick ="$('#customers2').tableExport({type:'json',escape:'false',ignoreColumn:'[2,3]'});"><img src='img/icons/json.png' width="24"/> JSON (ignoreColumn)</a></li>
                                            <li><a href="#" onClick ="$('#customers2').tableExport({type:'json',escape:'true'});"><img src='img/icons/json.png' width="24"/> JSON (with Escape)</a></li>
                                            <li class="divider"></li>
                                            <li><a href="#" onClick ="$('#customers2').tableExport({type:'xml',escape:'false'});"><img src='img/icons/xml.png' width="24"/> XML</a></li>
                                            <li><a href="#" onClick ="$('#customers2').tableExport({type:'sql'});"><img src='img/icons/sql.png' width="24"/> SQL</a></li> -->
                                            <li class="divider"></li>
                                            <li><a href="#" onClick ="$('#customers2').tableExport({type:'csv',escape:'false'});"><img src='img/icons/csv.png' width="24"/> CSV</a></li>
                                           <!--  <li><a href="#" onClick ="$('#customers2').tableExport({type:'txt',escape:'false'});"><img src='img/icons/txt.png' width="24"/> TXT</a></li> -->
                                            <li class="divider"></li>
                                            <li><a href="#" onClick ="$('#customers2').tableExport({type:'excel',escape:'false'});"><img src='img/icons/xls.png' width="24"/> XLS</a></li>
                                            <!-- <li><a href="#" onClick ="$('#customers2').tableExport({type:'doc',escape:'false'});"><img src='img/icons/word.png' width="24"/> Word</a></li>
                                            <li><a href="#" onClick ="$('#customers2').tableExport({type:'powerpoint',escape:'false'});"><img src='img/icons/ppt.png' width="24"/> PowerPoint</a></li>
                                            <li class="divider"></li>
                                            <li><a href="#" onClick ="$('#customers2').tableExport({type:'png',escape:'false'});"><img src='img/icons/png.png' width="24"/> PNG</a></li>
                                            <li><a href="#" onClick ="$('#customers2').tableExport({type:'pdf',escape:'false'});"><img src='img/icons/pdf.png' width="24"/> PDF</a></li> -->
                                        </ul>
                                    </div>
                                     <div class="btn-group pull-right">
                                        <!--  <form method="post">
                                         Filter by : <select name="filterby" id="filterby">
                                            <option value="">--select--</option>
                                            <option value="1" <?php if($_POST['filterby'] == "1"){?> selected <?php } ?>>Celebrity User</option>
                                            <option value="0" <?php if($_POST['filterby'] == "0"){?> selected <?php } ?>>Common User</option>
                                         </select>
                                          <input type="submit"  name="go"  class=" btn btn-success" value="Go">
                                          </form> -->
                                     </div>                                     
                                    
                                </div>
                                <div class="panel-body">
                                    <table id="customers2" class="table datatable">
                                        <thead>
      <tr>
        <th>#</th>
        <th>Event Name</th>
        <th>Event Title</th>
        <th>Event Date</th>
        <th>Images</th>
        <th>Location</th>
		<th>Attend User's</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody id="gfd">
		 <?php
		 $count=1;
     foreach($event->getallevent() as $row){
		 ?>

	 <tr id="this<?php echo $row['id']; ?>">
	
  <td><input  type="text" value="<?php echo $row['id']; ?>" id="idd<?php echo $row['id']; ?>" class=" form-control" style="display:none;"/>   <p >   <?php echo $count; ?></p></td>
 <td><input  id="event_name<?php echo $row['id']; ?>"  type="text" value="<?php echo $row['event_name']; ?>" class="n<?php echo $row['id'] ?> form-control" style="display:none;"/>      <p  id="name1<?php echo $row['id']; ?>" class="p<?php echo $row['id']; ?>"><?php echo $row['event_name']; ?> </p></td>
 <td> <input  id="event_des<?php echo $row['id']; ?>"  type="text" value="<?php echo $row['event_title']; ?>" class="n<?php echo $row['id'] ?> form-control" style="display:none;"/>       <p id="name2<?php echo $row['id']; ?>" class="p<?php echo $row['id']; ?>"><?php echo $row['event_title']; ?> </p></td>
 <td> <input  id="event_date<?php echo $row['id']; ?>"  type="text" value="<?php echo $row['date']; ?>" class="n<?php echo $row['id'] ?> form-control date" style="display:none;"/>       <p id="name3<?php echo $row['id']; ?>" class="p<?php echo $row['id']; ?>"><?php echo date("m/d/Y",strtotime($row['date'])); ?> </p></td>

  <td> <input  id="image<?php echo $row['id']; ?>"  type="file" value="" class="n<?php echo $row['id'] ?> form-control pankaj" style="display:none;" />   <p id="image1<?php echo $row['id']; ?>" class="p<?php echo $row['id']; ?>">  <img id="img1<?php echo $row['id']; ?>"src="<?php echo $row['event_pic']; ?>"height="50"width="50"/> </p>  </td>  

  
  <td> <input  id="location<?php echo $row['id']; ?>"  type="text" value="<?php echo $row['location']; ?>" class="n<?php echo $row['id'] ?> form-control" style="display:none;"/>       <p id="name5<?php echo $row['id']; ?>" class="p<?php echo $row['id']; ?>"><?php echo $row['location']; ?> </p></td>
<td><a href="attend?id=<?php echo $row['id']; ?>"class="btn btn-danger">Atendees </a></center></td>
  <td>  <?php  if($row['status']==0){?>    <p class="p<?php echo $row['id'] ?>"><a  onclick="the(<?php echo $row['id']; ?>);" class="btn btn-success">Edit</a><a onclick="cancel(<?php echo $row['id']; ?>)"  href="#" class="btn btn-danger">Cancel</a><?php } ?>  <a onclick="return confirm('are you sure want to delete this event?');"  href="?id=<?php echo $row['id']; ?>" class="btn btn-info">Delete</a><p><input type="submit" onclick="ch(<?php echo $row['id']; ?>);" class="n<?php echo $row['id'] ?> btn btn-primary " value="save" style="display:none;" /> <?php  if($row['status']==1){echo "<p style='color:red;'>This Event is cancel now</p>";} ?></td> </form>
  </tr>
     <?php  $count++;} ?>
       


       
	  
	  
    </tbody>

                                    </table>                                    
                                    
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
        
        <!-- START TEMPLATE -->
        <script type="text/javascript" src="js/settings.js"></script>
        
        <script type="text/javascript" src="js/plugins.js"></script>        
        <script type="text/javascript" src="js/actions.js"></script>        
        <!-- END TEMPLATE -->
      
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">


  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <!-- END SCRIPTS -->   
<script>
var cd='';

 $( function() {
    $( ".date" ).datepicker();
  } );
    
	function cancel(id){

		if(confirm("are you sure want to Cancel this event ?")){
         $.ajax({
                type:'POST',
                url:'ajax/cancelevent.php',
                data:"id="+id,
                success:function(data){
					location.reload();
				}
				
				
				});
			
		}




	}
function the(st){

var d = st;

$(".p"+d).hide();
$(".n"+d).show();
cd =st;
}
function ch(str){

var d = str;
var data = new FormData();
 var image = $('#image'+d).prop('files')[0];   

var event_name=$("#event_name"+d).val();
var event_des=$("#event_des"+d).val();
var event_date=$("#event_date"+d).val();

var location=$("#location"+d).val();
var created=$("#created"+d).val();
 data.append("image",image);
 data.append("id",d);
 data.append("event_name",event_name);
 data.append("event_des",event_des);
 data.append("location",location);
  data.append("event_date",event_date);
 

   $.ajax({
                type:'POST',
                url:'ajax/updateevent.php',
                cache: false,
                contentType: false,
                processData: false,
                data:data,
                success:function(data){
		
				$("#name1"+d).html('').append(event_name);
				$("#name2"+d).html('').append(event_des);
				$("#name3"+d).html('').append(event_date);
				$("#name4"+d).html('').append(image);
				$("#name5"+d).html('').append(location);
				$("#name6"+d).html('').append(created);
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



$("#gfd").prepend("<tr id='dk'><form id='abc'><td></td><td><input type='text' name='p' class='form-control' ></td><td><input type='text' name='dd' class='form-control' ></td><td><input type='submit'  value='save' onclick='sb();' class='btn btn-primary' > <input type='submit' onclick='dog();' value='Remove' class='btn btn-danger' ></form></td></tr>");


}

$(".pankaj").change(function(){


    readURL(this,cd);
});


function dog(){
$("#dk").remove();
}
function sb(){

 var str = $("#abc").serialize();
 alert(str);

}
function readURL(input,cd) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#img1'+cd).attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}


function goadd(){

window.location="addevent";

}
</script>
    </body>
</html>






