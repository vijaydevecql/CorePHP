

  
<?php 
session_start();

if($_SESSION['admin_id']==''){

	header("location:index.php");
}
if($_SESSION['admin_type']==1){

	header("location:dashboard");
}
 $title_tag1 = "auther";
 $title_tag = "auther";
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
                    <li class="active">Auther</li>
                </ul>
                <!-- END BREADCRUMB -->
                
                <!-- PAGE TITLE -->
                <div class="page-title">                    
                    <h2><span onclick="back();"class="fa fa-arrow-circle-o-left"></span> Auther's Record</h2>
                </div>
                <!-- END PAGE TITLE -->                
                
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                
                    
                    
                    <div class="row">
                        <div class="col-md-12">
                            
                            <!-- START DATATABLE EXPORT -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Auther's Record</h3>
                                    <div class="btn-group pull-right">
                                        <button class="btn btn-info dropdown-toggle" data-toggle="modal" data-target="#myModal" ><i class="fa fa-plus"></i> Add Auther</button>
                                        
                                    </div>                                    
                                    
                                </div>
                                <div class="panel-body">
                                    <table id="customers1" class="table datatable table-bordered table-striped">
                                        <thead>
      <tr>
        <th>#</th>
        <th><center>Author Name</center></th>
         <th><center>Image</center></th>
		  <th><center>Approved</center></th>
        <th><center>Action</center></th>
      </tr>
    </thead>
    <tbody id="gfd">
	<?php 
	if(isset($_POST['submit'])){
		
		if (move_uploaded_file($_FILES['image']['tmp_name'], "ajax/upload/" . $_FILES['image']['name'])) {
           $image = BASE_HTTP_BASE_URL . "upload/" . $_FILES['image']['name'];
        }else{
			$image = "";
		}
										
		$formdata = array(
			'name' => $_POST['name'],
			'image' => $image,
			'created' =>time(),
			
		);
		
		$admin->add_auther($formdata);
	}
	
	
	$i=1;
	
foreach($admin->getallauther() as $row){

	?>
      <tr  id="this<?php echo $row['id']; ?>">
	
  <td><center>   <?php echo $i; ?></center></td>
 <td ><center><input  id="name<?php echo $row['id']; ?>"  type="text" value="<?php echo $row['name']; ?>" class="n<?php echo $row['id'] ?> form-control" style="display:none;"/>      <p  id="name1<?php echo $row['id']; ?>" class="p<?php echo $row['id']; ?>"><?php echo $row['name']; ?> </p></center></td>
 <td style="width:33.33333%" ><center><input  id="name<?php echo $row['id']; ?>"  type="file"  class="n<?php echo $row['id'] ?> form-control" style="display:none;"/>      <img src="<?php echo $row['image']; ?>" height="5%" width="5%" id="name1<?php echo $row['id']; ?>" class="p<?php echo $row['id']; ?>"/>  </center></td>

 <td>
 <?php if($row['admin_id']==0){ echo "no admin"; } else {   ?>
 <center><label class="switch switch-small">
                                                    <input type="checkbox" rel="<?php echo $row['admin_id'] ?>"  <?php echo ($row['status']==1)?'checked':'';  ?> class="ddd" value="<?php echo $row['status']  ?>">
                                                    <span></span>
                                                </label></center>
 <?php }  ?>
 </td>
  <td style="width:33.33333%"> <center>     <p class="p<?php echo $row['id'] ?>"><button  onclick="the(<?php echo $row['id']; ?>);" class="btn btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>  <button  onclick="chl(<?php echo $row['id']; ?>);" class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></button><p><button type="button" onclick="ch(<?php echo $row['id']; ?>);" class="n<?php echo $row['id'] ?> btn btn-primary " value="save" style="display:none;" /><i class="fa fa-floppy-o" aria-hidden="true"></i> </button></center></td> 
  </tr>
      
	  
	  <?php $i++;} ?>
    </tbody>

                                    </table>                                    
                                    
                                </div>
                            </div>
                            <!-- END DATATABLE EXPORT -->                            
                              <div id="snackbar" style="backgroud-color:red;">Wrong Email or Password</div>
                            

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
		
		
		  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-m">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><center>Add author</center></h4>
        </div>
        <div class="modal-body">
          <form class="form" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="email">Author Name:</label>
    <input type="text" class="form-control" name="name" placeholder="Author Name" id="email">
  </div>
 <div class="form-group">
    <label for="email">Image:</label>
    <input type="file" class="form-control" name="image" placeholder="" id="email">
  </div>
  
  <center></center>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button><button type="submit" name ="submit" class="btn btn-danger">Save</button>
		  </form>
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

   $.ajax({
                type:'POST',
                url:'ajax/updatecat.php',
                data:{id:d,name:name},
                success:function(data){
		
				$("#name1"+d).html('').append(name);
				
				
				$(".p"+d).show();
				$(".n"+d).hide();
				
				}
				
				
				});


}


function chl(pk){

var del_id=pk;
swal({
  title: "Are you sure want to delete this Author ?",
  text: "",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
	 $.ajax({
				type:'POST',
				url:'ajax/author_delete.php',
				data:"del_id="+pk,
				success:function(data){
				  $("#this"+pk).fadeOut("xslow");
				   swal("Poof! Your Author file has been deleted!", {
	  icon: "success",
	});
				}
	});
   
  } else {
	swal(" Author  is safe!");
  }
});
}

function dog(){
$("#dk").remove();
}

$(".ddd").on('change',function(e){
	_this=$(this).val();
	
	if(_this==1){
		_this=0;
		$(this).val(_this);
	}else{
		_this=1;
		$(this).val(_this);
	}
	id = $(this).attr('rel');
	
	 $.ajax({
				type:'POST',
				url:'ajax/update_status_admin.php',
				data:{id:id,status:_this},
				success:function(data){
				
					if(_this==1){
							 $("#snackbar").html("Account Approved");
					}else{
						 $("#snackbar").html("Account Disapproved");
					}
				  $("#snackbar").addClass('show');
                setTimeout(function () {
                    $("#snackbar").removeClass('show');
                }, 3000);
				 
				}
	});

});
function back(){

window.history.back();

}
</script>	
    </body>
</html>






