
<style>
.main_content {
    float: left;
    width: 40%;
    margin: auto;
}
strong.hnd_panel {
    float: left;
    width: 100%;
    text-align: center;
    background: #1caf9a;
    color: #fff;
    font-family: arial;
    padding: 14px 0;
    font-size: 25px;
}
span.date_panel {
    float: left;
    width: 100%;
    text-align: center;
    color: #222;
    font-family: arial;
    padding: 14px 0;
    font-size: 25px;
    font-weight: bold;
}


span.user_joe {
    float: left;
    width: 100%;
    text-align: center;
    
    color: #222;
    font-family: arial;
    padding: 14px 0;
    font-size: 25px;
}
.barcode1 {
    float: left;
    width: 100%;
	margin:30px 0;
    text-align: center;
}
.barcode1 img {
    float: none;
    width: 50%;
    margin: auto;
}
footer.footer_panel {
    float: left;
    width: 100%;
    padding: 15px 20px;
    background: #eee;
    box-sizing: border-box;
}
span.link5 {
    float: left;
    width: auto;
}
span.link5 a {
    float: left;
    width: initial;
    color: #222;
}
span.page_quenty {
    float: right;
    font-size: 20px;
}
</style>




  
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
                    
                    <!-- END MESSAGES -->
                    <!-- TASKS -->
                  
                    <!-- END TASKS -->
                </ul>
                <!-- END X-NAVIGATION VERTICAL -->                     
                
                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="dashboard.php">Home</a></li>
                    
                   
                </ul>
                <!-- END BREADCRUMB -->
                
                <!-- PAGE TITLE -->
                <div class="page-title">                    
                    <h2><span onclick="back();"class="fa fa-arrow-circle-o-left"></span>   Car's</h2>
                </div>
                <!-- END PAGE TITLE -->                
                
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                
                    
                    
                    <div class="row">
                        <div class="col-md-12">
                            
                            <!-- START DATATABLE EXPORT -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Car's Detail</h3>
                                                     
                                    <div class="btn-group pull-right">
                                        
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
        <!-- <th>#</th> -->
        <th><center>Make </center></th>
        <th><center>Model </center></th>
        <th><center>Year </center></th>
		<th><center>License </center></th>
        <!-- <th><center>Car Detail</center></th> -->
        <th><center>Action</center></th>
      </tr>
    </thead>
    <tbody id="gfd">
  <?php 
    $x=1 ;

if($row=$user->user_car_det($_REQUEST['user_id']) ){
    if($row['make_one'] !== '' && $row['model_one'] !== '' && $row['year_one'] !=='' && $row['license_one'] !==''){

  ?>
      <tr id="first<?php echo $row['id']; ?>">
  
  <!-- <td>  <center> <?php echo $x ; ?> </center></td> -->

 <td><center><input  id="make_one<?php echo $row['id']; ?>"  type="text" value="<?php echo $row['make_one']; ?>" class="n<?php echo $row['id'] ?> form-control" style="display:none;"/>      <p  id="make_one1<?php echo $row['id']; ?>" class="p<?php echo $row['id']; ?>"><?php echo $row['make_one']; ?> </p></center></td>

 <td><center> <input  id="model_one<?php echo $row['id']; ?>"  type="text" value="<?php echo $row['model_one']; ?>" class="n<?php echo $row['id'] ?> form-control" style="display:none;"/>      
  

 <p id="model_one1<?php echo $row['id']; ?>" class="p<?php echo $row['id']; ?>"><?php echo $row['model_one']; ?> </p>
   

</center></td>

<td><center> <input  id="year_one<?php echo $row['id']; ?>"  type="text" value="<?php echo $row['year_one']; ?>" class="n<?php echo $row['id'] ?> form-control" style="display:none;"/>      
  

 <p id="year_one1<?php echo $row['id']; ?>" class="p<?php echo $row['id']; ?>"><?php echo $row['year_one']; ?> </p>
   

</center></td>
<td><center> <input  id="license_one<?php echo $row['id']; ?>"  type="text" value="<?php echo $row['license_one']; ?>" class="n<?php echo $row['id'] ?> form-control" style="display:none;"/>      
  

 <p id="license_one1<?php echo $row['id']; ?>" class="p<?php echo $row['id']; ?>"> <?php echo $row['license_one']; ?> </p>
   

</center></td>
<!-- <td><center>


   <input  id="image<?php echo $row['id']; ?>"   type="file" value="" class="n<?php echo $row['id'] ?> form-control pankaj" style="display:none;"/> 
        <p  id="image1<?php echo $row['id']; ?>" class="p<?php echo $row['id']; ?>"><?php  ?> <img   id="img1<?php echo $row['id']; ?>" src="<?php echo ($row['profile_pic']=='')?'images.jpg':$row['profile_pic']; ?>" height=50 width=50 /></p>
    <div class="modal fade" id="myModal<?php echo $row['id']; ?>" role="dialog">
    <div class="modal-dialog">
  
   <div class="modal-content" style="backgroud-color:#1caf9a;">
   <div id="pre<?php echo $row['id']; ?>">
        <div class="modal-header " style="backgroud-color:#1caf9a;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">User <?php echo $row['first_name']; ?>  Qr code</h4>
        </div>
        <div id="pankaj" class="modal-body footer_panel">
          <center><img id="mainImg<?php echo $row['id']; ?>"   src="<?php echo ($row['Qr_code']=='')?'images.jpg':$row['Qr_code']; ?>" height=100 width=100 /></center>
        </div>
		</div>
        <div class="modal-footer">
		  <button type="button" class="btn btn-Primary" onclick="print(<?php echo $row['id']; ?>)">Print</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>
</center></td>
<td><center><img  data-toggle="modal" data-target="#myModal<?php echo $row['id']; ?>"  src="<?php echo ($row['Qr_code']=='')?'images.jpg':$row['Qr_code']; ?>" height=50 width=50 /></center></td> -->
<!-- <td><a href="car_detail.php?<?php echo $row['id']; ?>"  class="btn btn-primary">View</a></td>-->

  <td><center>      <p class="p<?php echo $row['id'] ?>"><a  onclick="the(<?php echo $row['id']; ?>);" class="btn btn-primary">Edit</a> 
   <a  onclick="chl(<?php echo $row['id']; ?>);"    class="btn btn-danger mb-control">Delete  </a>





   <p><input type="submit" onclick="ch(<?php echo $row['id']; ?>);" class="n<?php echo $row['id'] ?> btn btn-primary " value="save" style="display:none;" /> </center></td> 
  </tr>
  <?php } else {} ?>
  <?php if($row['make_two'] !== '' && $row['model_two'] !== '' && $row['year_two'] !=='' && $row['license_two'] !==''){ ?>
  <tr id="second<?php echo $row['id']; ?>">
  
  <!-- <td>  <center> <?php echo $x ; ?> </center></td> -->

 <td><center><input  id="make_two<?php echo $row['id']; ?>"  type="text" value="<?php echo $row['make_two']; ?>" class="n1<?php echo $row['id'] ?> form-control" style="display:none;"/>      <p  id="make_two1<?php echo $row['id']; ?>" class="p1<?php echo $row['id']; ?>"><?php echo $row['make_two']; ?> </p></center></td>

 <td><center> <input  id="model_two<?php echo $row['id']; ?>"  type="text" value="<?php echo $row['model_two']; ?>" class="n1<?php echo $row['id'] ?> form-control" style="display:none;"/>      
  

 <p id="model_two1<?php echo $row['id']; ?>" class="p1<?php echo $row['id']; ?>"><?php echo $row['model_two']; ?> </p>
   

</center></td>

<td><center> <input  id="year_two<?php echo $row['id']; ?>"  type="text" value="<?php echo $row['year_two']; ?>" class="n1<?php echo $row['id'] ?> form-control" style="display:none;"/>      
  

 <p id="year_two1<?php echo $row['id']; ?>" class="p1<?php echo $row['id']; ?>"><?php echo $row['year_two']; ?> </p>
   

</center></td>
<td><center> <input  id="license_two<?php echo $row['id']; ?>"  type="text" value="<?php echo $row['license_two']; ?>" class="n1<?php echo $row['id'] ?> form-control" style="display:none;"/>      
  

 <p id="license_two1<?php echo $row['id']; ?>" class="p1<?php echo $row['id']; ?>"><?php echo $row['license_two']; ?> </p>
   

</center></td>
<td><center>      <p class="p1<?php echo $row['id'] ?>"><a  onclick="the1(<?php echo $row['id']; ?>);" class="btn btn-primary">Edit</a> 
   <a  onclick="chl1(<?php echo $row['id']; ?>);"    class="btn btn-danger mb-control">Delete  </a>





   <p><input type="submit" onclick="ch1(<?php echo $row['id']; ?>);" class="n1<?php echo $row['id'] ?> btn btn-primary " value="save" style="display:none;" /> </center></td> 
</tr>
     <?php } else {} ?>
   <?php $x++; } ?>
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
function print(id){

 var contents = document.getElementById('pre'+id).innerHTML;
            var frame1 = document.createElement('iframe');
            frame1.name = "frame1";
            frame1.style.position = "absolute";
            frame1.style.top = "-1000000px";
            document.body.appendChild(frame1);
            var frameDoc = frame1.contentWindow ? frame1.contentWindow : frame1.contentDocument.document ? frame1.contentDocument.document : frame1.contentDocument;
            frameDoc.document.open();
            frameDoc.document.write('<html><head><title>DIV Contents</title>');
            frameDoc.document.write('</head><body>');
            frameDoc.document.write(contents);
            frameDoc.document.write('</body></html>');
            frameDoc.document.close();
            setTimeout(function () {
                window.frames["frame1"].focus();
                window.frames["frame1"].print();
                document.body.removeChild(frame1);
            }, 500);
            return false;
   
}
function goadd(){
  window.location.href="addemployee.php";

}
function the(st){

var d = st;

$(".p"+d).hide();
$(".n"+d).show();
cd =st;

}

function the1(st){

var d = st;

$(".p1"+d).hide();
$(".n1"+d).show();
cd =st;

}




function ch(str){


var d = str;

var make_one=$("#make_one"+d).val();
var model_one=$("#model_one"+d).val();

var year_one=$("#year_one"+d).val();
var license_one=$("#license_one"+d).val();


var fordata= new FormData();

    fordata.append("id",d);
    fordata.append("make_one",make_one);
    fordata.append("model_one",model_one);
    fordata.append('year_one', year_one);
    fordata.append('license_one',license_one);
   $.ajax({
                type:'POST',
                url:'ajax/upd_car_det.php',
                datatype:'text',
                cache: false,
                contentType: false,
                processData: false,
                
                data:fordata,
                success:function(data){
    
         $("#make_one1"+d).html('').append(make_one);
        $("#model_one1"+d).html('').append(model_one);
        $("#year_one1"+d).html('').append(year_one);
        $("#license_one1"+d).html('').append(license_one);
               
        
        $(".p"+d).show();
                $(".n"+d).hide();
        
        }
        
        
        });


};

function ch1(str){


var d = str;

var make_two=$("#make_two"+d).val();
var model_two=$("#model_two"+d).val();

var year_two=$("#year_two"+d).val();
var license_two=$("#license_two"+d).val();


var fordata= new FormData();

    fordata.append("id",d);
    fordata.append("make_two",make_two);
    fordata.append("model_two",model_two);
    fordata.append('year_two', year_two);
    fordata.append('license_two',license_two);
   $.ajax({
                type:'POST',
                url:'ajax/upd_car_det.php',
                datatype:'text',
                cache: false,
                contentType: false,
                processData: false,
                
                data:fordata,
                success:function(data){
    
         $("#make_two1"+d).html('').append(make_two);
        $("#model_two1"+d).html('').append(model_two);
        $("#year_two1"+d).html('').append(year_two);
        $("#license_two1"+d).html('').append(license_two);
               
        
        $(".p1"+d).show();
                $(".n1"+d).hide();
        
        }
        
        
        });


};
function chl(pk){

  if(confirm('Are you sure want to delete this user?')){
    var del_id=pk;
   // alert(del_id);
    $.ajax({
                type:'POST',
                url:'ajax/del_cardetal.php',
                data:"del_id="+pk,
                success:function(data){
                   // window.location.reload();
                   $("#first"+pk).fadeOut("slow");
                }



    })
    }

};
function chl1(pk){

  if(confirm('Are you sure want to delete this user?')){
    var del_id=pk;
   // alert(del_id);
    $.ajax({
                type:'POST',
                url:'ajax/del_cardetal2.php',
                data:"del_id="+pk,
                success:function(data){
                  $("#second"+pk).fadeOut("slow");
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






