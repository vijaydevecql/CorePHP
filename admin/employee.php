
  
<?php 
session_start();

if($_SESSION['user_id']==''){

header("location:index.php");
}
 $title_tag = "student";








   
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
                    <li class="xn-icon-button pull-right">
                       <!--  <a href="#"><span class="fa fa-comments"></span></a> -->
                       <!--  <div class="informer informer-danger">4</div> -->
                        <div class="panel panel-primary animated zoomIn xn-drop-left xn-panel-dragging">
                            <div class="panel-heading">
                                <h3 class="panel-title"><span class="fa fa-comments"></span> Messages</h3>                                
                                <div class="pull-right">
                                    <span class="label label-danger">4 new</span>
                                </div>
                            </div>
                            <div class="panel-body list-group list-group-contacts scroll" style="height: 200px;">
                                <a href="#" class="list-group-item">
                                    <div class="list-group-status status-online"></div>
                                    <img src="assets/images/users/user2.jpg" class="pull-left" alt="John Doe"/>
                                    <span class="contacts-title">John Doe</span>
                                    <p>Praesent placerat tellus id augue condimentum</p>
                                </a>
                                <a href="#" class="list-group-item">
                                    <div class="list-group-status status-away"></div>
                                    <img src="assets/images/users/user.jpg" class="pull-left" alt="Dmitry Ivaniuk"/>
                                    <span class="contacts-title">Dmitry Ivaniuk</span>
                                    <p>Donec risus sapien, sagittis et magna quis</p>
                                </a>
                                <a href="#" class="list-group-item">
                                    <div class="list-group-status status-away"></div>
                                    <img src="assets/images/users/user3.jpg" class="pull-left" alt="Nadia Ali"/>
                                    <span class="contacts-title">Nadia Ali</span>
                                    <p>Mauris vel eros ut nunc rhoncus cursus sed</p>
                                </a>
                                <a href="#" class="list-group-item">
                                    <div class="list-group-status status-offline"></div>
                                    <img src="assets/images/users/user6.jpg" class="pull-left" alt="Darth Vader"/>
                                    <span class="contacts-title">Darth Vader</span>
                                    <p>I want my money back!</p>
                                </a>
                            </div>     
                            <div class="panel-footer text-center">
                                <a href="pages-messages.html">Show all messages</a>
                            </div>                            
                        </div>                        
                    </li>
                    <!-- END MESSAGES -->
                    <!-- TASKS -->
                    <li class="xn-icon-button pull-right">
                        <!-- <a href="#"><span class="fa fa-tasks"></span></a>
                        <div class="informer informer-warning">3</div> -->
                        <div class="panel panel-primary animated zoomIn xn-drop-left xn-panel-dragging">
                            <div class="panel-heading">
                                <h3 class="panel-title"><span class="fa fa-tasks"></span> Tasks</h3>                                
                                <!-- <div class="pull-right">
                                    <span class="label label-warning">3 active</span>
                                </div> -->
                            </div>
                            <div class="panel-body list-group scroll" style="height: 200px;">                                
                                <a class="list-group-item" href="#">
                                    <strong>Phasellus augue arcu, elementum</strong>
                                    <div class="progress progress-small progress-striped active">
                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%;">50%</div>
                                    </div>
                                    <small class="text-muted">John Doe, 25 Sep 2014 / 50%</small>
                                </a>
                                <a class="list-group-item" href="#">
                                    <strong>Aenean ac cursus</strong>
                                    <div class="progress progress-small progress-striped active">
                                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%;">80%</div>
                                    </div>
                                    <small class="text-muted">Dmitry Ivaniuk, 24 Sep 2014 / 80%</small>
                                </a>
                                <a class="list-group-item" href="#">
                                    <strong>Lorem ipsum dolor</strong>
                                    <div class="progress progress-small progress-striped active">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100" style="width: 95%;">95%</div>
                                    </div>
                                    <small class="text-muted">John Doe, 23 Sep 2014 / 95%</small>
                                </a>
                                <a class="list-group-item" href="#">
                                    <strong>Cras suscipit ac quam at tincidunt.</strong>
                                    <div class="progress progress-small">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">100%</div>
                                    </div>
                                    <small class="text-muted">John Doe, 21 Sep 2014 /</small><small class="text-success"> Done</small>
                                </a>                                
                            </div>     
                            <div class="panel-footer text-center">
                                <a href="pages-tasks.html">Show all tasks</a>
                            </div>                            
                        </div>                        
                    </li>
                    <!-- END TASKS -->
                </ul>
                <!-- END X-NAVIGATION VERTICAL -->                     
                
                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="dashboard.php">Home</a></li>
                    
                    <li class="active">Employee's</li>
                </ul>
                <!-- END BREADCRUMB -->
                
                <!-- PAGE TITLE -->
                <div class="page-title">                    
                    <h2><span onclick="back();"class="fa fa-arrow-circle-o-left"></span> Employee's Record</h2>
                </div>
                <!-- END PAGE TITLE -->                
                
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                
                    
                    
                    <div class="row">
                        <div class="col-md-12">
                            
                            <!-- START DATATABLE EXPORT -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Employee's Record</h3>
                                                     
                                    <div class="btn-group pull-right">
                                        <button class="btn btn-danger" onclick="goadd();" >Add Employee</button>
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
        <th><center>Name</center></th>
        <th><center>Email</center></th>
        <th><center>Image</center></th>
        <th><center>Action</center></th>
      </tr>
    </thead>
    <tbody id="gfd">
  <?php 
    $x=1 ;
	
	if($_GET['id']){
	$employee=$user->getorgemplye($_GET['id']);
	}else {
	$employee=$user->getallemplye();
	}
    foreach($employee as $row){

  ?>
      <tr id="this<?php echo $row['id']; ?>">
  
  <td>  <center> <?php echo $x ; ?> </center></td>

 <td><center><input  id="name<?php echo $row['id']; ?>"  type="text" value="<?php echo $row['first_name']; ?>" class="n<?php echo $row['id'] ?> form-control" style="display:none;"/>      <p  id="name1<?php echo $row['id']; ?>" class="p<?php echo $row['id']; ?>"><?php echo $row['first_name']; ?> </p></center></td>

 <td><center> <input  id="email<?php echo $row['id']; ?>"  type="text" value="<?php echo $row['email']; ?>" class="n<?php echo $row['id'] ?> form-control" style="display:none;"/>      
  

 <p id="email1<?php echo $row['id']; ?>" class="p<?php echo $row['id']; ?>"><?php echo ($row['email']=='')?'Email is not Register':$row['email']; ?> </p>
   

</center></td>
<td><center>


   <input  id="image<?php echo $row['id']; ?>"   type="file" value="" class="n<?php echo $row['id'] ?> form-control pankaj" style="display:none;"/> 
        <p  id="image1<?php echo $row['id']; ?>" class="p<?php echo $row['id']; ?>"><?php  ?> <img   id="img1<?php echo $row['id']; ?>" src="<?php echo ($row['profile_pic']=='')?'images.jpg':$row['profile_pic']; ?>" height=50 width=50 /></p>
   <?php

    ?> 
</center></td>
  <td><center>      <p class="p<?php echo $row['id'] ?>"><a  onclick="the(<?php echo $row['id']; ?>);" class="btn btn-primary">Edit</a> 
   <a  onclick="chl(<?php echo $row['id']; ?>);"    class="btn btn-danger mb-control">Delete  </a>





   <p><input type="submit" onclick="ch(<?php echo $row['id']; ?>);" class="n<?php echo $row['id'] ?> btn btn-primary " value="save" style="display:none;" /> </center></td>
  </tr>
     
   <?php $x++;} ?>
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
        <!-- <script type="text/javascript" src="js/settings.js"></script> -->
        
        <script type="text/javascript" src="js/plugins.js"></script>        
        <script type="text/javascript" src="js/actions.js"></script>        
        <!-- END TEMPLATE -->
    <!-- END SCRIPTS -->    
<script>
var cd='';

function goadd(){
  window.location.href="addemployee.php";

}
function the(st){

var d = st;

$(".p"+d).hide();
$(".n"+d).show();
cd =st;

}




function ch(str){


var d = str;

var name=$("#name"+d).val();
var email=$("#email"+d).val();

var verified=$("#verified"+d).val();
 var image = $('#image'+d).prop('files')[0];   

var fordata= new FormData();

    fordata.append("id",d);
    fordata.append("name",name);
    fordata.append("email",email);
    fordata.append('pic', image);
    fordata.append('verified',verified);
   $.ajax({
                type:'POST',
                url:'ajax/updateuser.php',
                datatype:'text',
                      cache: false,
                contentType: false,
                processData: false,
                
                data:fordata,
                success:function(data){
    
         $("#name1"+d).html('').append(name);
        $("#email1"+d).html('').append(email);
                if(verified==1)
                {
               $("#verified1"+d).html('').append("Verified");
                }
                else
                {
                 $("#verified1"+d).html('').append("Not Verified");
                }
        
        $(".p"+d).show();
                $(".n"+d).hide();
        
        }
        
        
        });


};
function chl(pk){

  if(confirm('Are you sure want to delete this employee?')){
    var del_id=pk;
    $.ajax({
                type:'POST',
                url:'ajax/delete.php',
                data:"del_id="+pk,
                success:function(data){
                  $("#this"+pk).fadeOut("slow");
                }



    })
    }

};
 $(".pankaj").change(function(){


    readURL(this,cd);
});
function jf(){



$("#gfd").prepend("<tr id='dk'><td></td><td><input type='text' class='form-control' ></td><td><input type='text' class='form-control' ></td><td><input type='submit'  value='save' class='btn btn-primary' > <input type='submit' onclick='dog();' value='Remove' class='btn btn-danger' ></td></tr>");


}
function dog(){
$("#dk").remove();
}
function back(){

window.history.back();

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

</script> 
    </body>
</html>






