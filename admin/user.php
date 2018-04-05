<?php 
session_start();

if($_SESSION['admin_id']==''){

header("location:index.php");
}
 $title_tag1 = "user";
 $title_tag = "user";
 
   ?> 
   <!DOCTYPE html>
     <!-- META SECTION -->
        <title>Audio Panel</title>            
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
                    <li class="xn-search">
                        <form role="form">
                            <input type="text" name="search" placeholder="Search..."/>
                        </form>
                    </li>   
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
                    <li><a href="#">Tables</a></li>
                    <li class="active">User</li>
                </ul>
                <!-- END BREADCRUMB -->
                
                <!-- PAGE TITLE -->
                <div class="page-title">                    
                    <h2><span onclick="back();"class="fa fa-arrow-circle-o-left"></span> User's Record</h2>
                </div>
                <!-- END PAGE TITLE -->                
                
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                
                    
                    
                    <div class="row">
                        <div class="col-md-12">
                            
                            <!-- START DATATABLE EXPORT -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">User's Record</h3>
                                    <div class="btn-group pull-right">
                                        <button class="btn btn-danger dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i> Export Data</button>
                                        <ul class="dropdown-menu">
                                            <li><a href="#" onClick ="$('#customers2').tableExport({type:'json',escape:'false'});"><img src='img/icons/json.png' width="24"/> JSON</a></li>
                                            <li><a href="#" onClick ="$('#customers2').tableExport({type:'json',escape:'false',ignoreColumn:'[2,3]'});"><img src='img/icons/json.png' width="24"/> JSON (ignoreColumn)</a></li>
                                            <li><a href="#" onClick ="$('#customers2').tableExport({type:'json',escape:'true'});"><img src='img/icons/json.png' width="24"/> JSON (with Escape)</a></li>
                                            <li class="divider"></li>
                                            <li><a href="#" onClick ="$('#customers2').tableExport({type:'xml',escape:'false'});"><img src='img/icons/xml.png' width="24"/> XML</a></li>
                                            <li><a href="#" onClick ="$('#customers2').tableExport({type:'sql'});"><img src='img/icons/sql.png' width="24"/> SQL</a></li>
                                            <li class="divider"></li>
                                            <li><a href="#" onClick ="$('#customers2').tableExport({type:'csv',escape:'false'});"><img src='img/icons/csv.png' width="24"/> CSV</a></li>
                                            <li><a href="#" onClick ="$('#customers2').tableExport({type:'txt',escape:'false'});"><img src='img/icons/txt.png' width="24"/> TXT</a></li>
                                            <li class="divider"></li>
                                            <li><a href="#" onClick ="$('#customers2').tableExport({type:'excel',escape:'false'});"><img src='img/icons/xls.png' width="24"/> XLS</a></li>
                                            <li><a href="#" onClick ="$('#customers2').tableExport({type:'doc',escape:'false'});"><img src='img/icons/word.png' width="24"/> Word</a></li>
                                            <li><a href="#" onClick ="$('#customers2').tableExport({type:'powerpoint',escape:'false'});"><img src='img/icons/ppt.png' width="24"/> PowerPoint</a></li>
                                            <li class="divider"></li>
                                            <li><a href="#" onClick ="$('#customers2').tableExport({type:'png',escape:'false'});"><img src='img/icons/png.png' width="24"/> PNG</a></li>
                                            <li><a href="#" onClick ="$('#customers2').tableExport({type:'pdf',escape:'false'});"><img src='img/icons/pdf.png' width="24"/> PDF</a></li>
                                        </ul>
                                    </div>                                    
                                    
                                </div>
                                <div class="panel-body">
                                    <table id="customers1" class="table datatable">
                                        <thead>
      <tr>
        <th>#</th>
        <th><center>Name</center></th>
        <th><center>EMail</center></th>
        <th><center>Active</center></th>
        <th><center>Action</center></th>
      </tr>
    </thead>
    <tbody id="gfd">
	<?php 
        
        if($_GET['id'] ){
            $data=array(
               'id' => $_GET['id'],
               'status' => $_GET['status'],
            );
            $admin->verifie($data);
        }
        $i=1;
foreach($admin->getalluser() as $row){

	?>
      <tr id="this<?php echo $row['id']; ?>">
	
  <td><center><input  type="text" value="<?php echo $row['id']; ?>" id="idd<?php echo $row['id']; ?>" class=" form-control" style="display:none;"/>   <p >   <?php echo $i; ?></p></center></td>
 <td><center><input  id="name<?php echo $row['id']; ?>"  type="text" value="<?php echo $row['name']; ?>" class="n<?php echo $row['id'] ?> form-control" style="display:none;"/>      <p  id="name1<?php echo $row['id']; ?>" class="p<?php echo $row['id']; ?>"><?php echo $row['name']; ?> </p></center></td>
 <td><center> <input  id="email<?php echo $row['id']; ?>"  type="text" value="<?php echo $row['email']; ?>" class="n<?php echo $row['id'] ?> form-control" style="display:none;"/>       <p id="name2<?php echo $row['id']; ?>" class="p<?php echo $row['id']; ?>"><?php echo $row['email']; ?> </p></center></td>
  
 
        <td><center><a href="?id=<?php echo $row['id']; ?>&status=<?php echo ($row['status']==0)?'1':'0'; ?>"<span class="label label-sm  <?php echo ($row['status']==0)?'label-danger':'label-info'?>"><?php echo ($row['status']==0)?'Deactive':'Active'; ?></span></a></td>
  <td> <center>     <p class="p<?php echo $row['id'] ?>"><button  onclick="the(<?php echo $row['id']; ?>);" class="btn btn-primary">Edit</button>  <button  onclick="chl(<?php echo $row['id']; ?>);" class="btn btn-danger">Delete</button><p><input type="submit" onclick="ch(<?php echo $row['id']; ?>);" class="n<?php echo $row['id'] ?> btn btn-primary " value="save" style="display:none;" /> </td> </center></form>
  </tr>
      </tr>
	  
	  <?php $i++;} ?>
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
    <!-- END SCRIPTS -->    
<script>

function the(st){

var d = st;

$(".p"+d).hide();
$(".n"+d).show();

}
function ch(str){

var d = str;
var name=$("#name"+d).val();
var email=$("#email"+d).val();
   $.ajax({
                type:'POST',
                url:'ajax/updateuser.php',
                data:{id:d,name:name,email:email},
                success:function(data){
		         if(data==3){
					swal("This Email already register for another User");
				 }else{
				$("#name1"+d).html('').append(name);
				$("#name2"+d).html('').append(email);
				swal({
  title: "Updated",
  text: "User info updated",
  icon: "success",
  button: "Ok!",
});
				$(".p"+d).show();
$(".n"+d).hide();
				}
				}
				
				
				});


}
function chl(pk){
if(confirm("are you sure want to delete this user ?")){

var del_id=pk;
    $.ajax({
                type:'POST',
                url:'ajax/delete.php',
                data:"del_id="+pk,
                success:function(data){
                  $("#this"+pk).fadeOut("xslow");
                }



    })

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
    </body>
</html>






