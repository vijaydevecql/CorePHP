


<?php
session_start();

if ($_SESSION['admin_id'] == '') {

    header("location:index.php");
}
$title_tag1 = "addbook";
$title_tag = "book";
?> 
<!DOCTYPE html>
<!-- META SECTION -->
<title>Audio Panel</title>            
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link rel="stylesheet" type="text/css" id="theme" href="css/toast.css"/>
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
            <?php include("sidebar.php"); ?>
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
                <!--      <li class="xn-search">
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
                <li><a href="#">Book</a></li>
                <li class="active"><?php echo ($_GET['id']) ? 'Update Book' : 'Add Book'; ?></li>
            </ul>
            <!-- END BREADCRUMB -->

            <!-- PAGE TITLE -->
            <div class="page-title">                    
                <h2><span onclick="back();"class="fa fa-arrow-circle-o-left"></span> Books </h2>
            </div>
            <!-- END PAGE TITLE -->                

            <!-- PAGE CONTENT WRAPPER -->
            <div class="page-content-wrap">

		<?php $books=$admin->get_singal_book_details($_GET['id']);
		$msg=0;
 if (isset($_POST['submit']) && isset($_GET['id'])) {

                                        if (move_uploaded_file($_FILES['audio_url']['tmp_name'], "ajax/upload/" . $_FILES['audio_url']['name'])) {
                                            $audio = BASE_HTTP_BASE_URL . "upload/" . $_FILES['audio_url']['name'];
                                        } else {
                                            $audio = $books['audio_url'];
                                        }
                                        if (move_uploaded_file($_FILES['image']['tmp_name'], "ajax/upload/" . $_FILES['image']['name'])) {
                                            $image = BASE_HTTP_BASE_URL . "upload/" . $_FILES['image']['name'];
                                        } else {
                                            $image = $books['image'];
                                        }
                                        $formdata = array(
                                            'book_name' => $_POST['book_name'],
                                            'id' => $_GET['id'],
                                            'language' => $_POST['language'],
                                            'categary_id' => $_POST['categary_id'],
                                            'publisher' => $_POST['publisher'],
                                            'publish_date' => strtotime($_POST['publish_date']),
                                            'size' => $_POST['size'],
                                            'seller_name' => $_POST['seller_name'],
                                            'length_print' => $_POST['length_print'],
                                            'description' => $_POST['description'],
                                            'book_type' => $_POST['book_type'],
                                            'is_paid' => $_POST['is_paid'],
                                            'audio_url' => $audio,
                                            'price' => $_POST['price'],
                                            'image' => $image
                                        );
                                        $data = $admin->update_book($formdata);
										echo "<script>$('#message-box-sound-1').modal('show');
										</script>";
                                        $msg = 1;
                                    }
									
									if(isset($_POST['adding'])){
											
											foreach($_POST['index_no'] as $k => $v){
												$query="insert into book_index set book_id='".$_GET['id']."',index_no='$v',index_name='".$_POST['index_name'][$k]."',created='".time()."'";
												if($admin->excuite($query, 'false', 'insert')){ 
												
												$check= "select * from update_books where book_id='".$_GET['book_id']."' and type=0";
												$result=$admin->excuite($check, 'false', 'select');
												if (empty($result)) {
													$this_query="insert into update_books set created='".time()."',book_id='".$_GET['book_id']."',type=0";
													$datad = $admin->excuite($this_query, 'false', 'insert');
												}else{
													$this_query="update update_books set created='".time()."',book_id='".$_GET['book_id']."',type=0 where book_id='".$_GET['book_id']."' and type=0";
													$datad = $admin->excuite($this_query, 'false', 'insert');
												}
												
												
												
												
												
												?>
												<script>
												add_index_done();
																		</script>
											<?php } }
									}
									
									
									
		//print_r($books);
		$books=$admin->get_singal_book_details($_GET['id']);
		?>

		<div id="snackbar">Profile Updated Successfully</div>
                <div class="row">
                    <div class="col-md-12">

                        <!-- START DATATABLE EXPORT -->
                        <form method="post" class="form-horizontal" enctype="multipart/form-data">
                                                            
                                <div class="panel panel-default tabs">                            
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="active"><a href="#tab-first" role="tab" data-toggle="tab">Book Details</a></li>
                                        <li><a href="#tab-second" role="tab" data-toggle="tab">Book <?php echo ($books['book_type']==1)?'Audio':'E-Book';  ?></a></li>
                                        <li><a href="#tab-third" role="tab" data-toggle="tab">Edit Book</a></li>
                                    </ul>
                                    <div class="panel-body tab-content">
                                        <div class="tab-pane active" id="tab-first">
                                          <div class="container-fluid">
                                                         <div class="row">
                        <div class="col-md-2">                        
                            <a href="#" class="tile tile-danger tile-valign"><span class="fa fa-laptop"></span></a>                        
                        </div>                    
                        <div class="col-md-2">                        
                            <a href="#" class="tile tile-success tile-valign"><span class="fa fa-calendar"></span></a>
                        </div>                                        
                        <div class="col-md-2">                        
                            <a href="#" class="tile tile-warning tile-valign"><?php echo $books['size']; ?>
                                <div class="informer informer-default dir-bl"><span class="fa fa-globe"></span>Size</div>
                            </a>                        
                        </div>
                        <div class="col-md-2">                        
                            <a href="#" class="tile tile-info">
                              <?php echo date("Y",$books['publish_date']); ?>
                                <p>Publish Date</p>                            
                                <div class="informer informer-default dir-tr"><span class="fa fa-calendar"></span></div>
                            </a>                        
                        </div>
                        <div class="col-md-2">                        
                            <a href="#" class="tile tile-danger">
                               <?php echo $books['language']; ?>
                                <p>Language</p>                            
                                <div class="informer informer-danger dir-tr"><span class="fa fa-caret-down"></span></div>
                            </a>                        
                        </div>
                        <div class="col-md-2">                        
                            <a href="#" class="tile tile-primary">
                                <?php echo ($books['price']=='')?0:$books['price']; ?>
                                <p>Price</p>                            
                                <div class="informer informer-default"><span class="fa fa-shopping-cart"></span></div>
                            </a>                        
                        </div>
                    </div>                   
    
   <table class="table table-condensed table-striped table-bordered">
    <thead>
     
        
        <!--<th>Book Name : <?php echo $books['book_name']; ?></th>-->
        <tr>
                                    <th colspan="3"><h3>Book Information</h3></th>
                                    <th></th>
                                  </tr>
     
    </thead>
    <tbody style="font-size: 12px;
";>
      <tr>
        <td>Book Name: </td><td><?php echo $books['book_name']; ?></td>
        <td>Language: </td><td> <?php echo $books['language']; ?></td>
      </tr>
	 
	  <tr>
        <td>Publisher: </td><td> <?php echo $books['publisher']; ?></td>
         <td>Publish Date: </td><td> <?php echo date("y/m/d",$books['publish_date']); ?></td>
      </tr>
	 
	  <tr>
        <td>Size: </td><td> <?php echo $books['size']; ?></td>
        <td>Seller Name: </td><td> <?php echo $books['seller_name']; ?></td>
      </tr>
	 
	  <tr>
        <td>Description: </td><td> <?php echo $books['description']; ?></td>
         <td>Price: </td><td> <?php echo ($books['price']=='')?0:$books['price']; ?></td>
      </tr>
	  
	  <tr>
        <td>category name: </td><td> <?php echo $books['catgory_name']; ?></td>
        <td>Is Featured: </td><td> <label class="switch">
                                                    <input type="checkbox" id="is_check" onchange="isfeatur(<?php echo $books['id'];?>)" name="switch-radio1" <?php echo ($books['featured']==1)?'checked':''; ?> value="<?php echo $books['featured'];?>"/>
                                                    <span></span>
                                                </label>  </td>
      </tr>
	 
	  
    </tbody>
  </table>
    
   <table class="table table-condensed">
    <thead>
     
        
        <!--<th>Book Name : <?php echo $books['book_name']; ?></th>-->
        <tr>
                                    <th colspan="3"><h3>Book Image</h3></th>
                                  </tr>
     
    </thead>
    <tbody>
       <tr>
        <td>Image </td><td> <img src="<?php echo $books['image'];?>" height="10%" width="10%"/></td>
      </tr>
	      </tbody>
  </table>
</div>

                                            
                                        </div>
                                        <div class="tab-pane" id="tab-second">
										 <div class="row">
										 <?php if($books['book_type']==1 || $books['book_type']==2){ ?>	
                        <div data-toggle="modal" data-target="#myModal" class="col-md-2">                        
                            <a href="#" class="tile tile-danger tile-valign"><span class="fa fa-plus"></span><div class="informer informer-default dir-bl"><span class="fa fa-plus"></span>Add Audio</div></a>
														
                        </div> 
									<?php }else{ ?>
									   <div data-toggle="modal" data-target="#myModal1" class="col-md-2">                        
                            <a href="#" class="tile tile-danger tile-valign"><span class="fa fa-plus"></span><div class="informer informer-default dir-bl"><span class="fa fa-plus"></span>Add Book Index</div></a>
														
                        </div>
								<?php } ?>	
									
									
                        <div class="col-md-2">                        
                            <a href="#" class="tile tile-success tile-valign"><span class="fa fa-calendar"></span></a>
                        </div>                                        
                        <div class="col-md-2">                        
                            <a href="#" class="tile tile-warning tile-valign"><?php echo $books['size']; ?>
                                <div class="informer informer-default dir-bl"><span class="fa fa-globe"></span>Size</div>
                            </a>                        
                        </div>
                        <div class="col-md-2">                        
                            <a href="#" class="tile tile-info">
                              <?php echo date("Y",$books['publish_date']); ?>
                                <p>Publish Date</p>                            
                                <div class="informer informer-default dir-tr"><span class="fa fa-calendar"></span></div>
                            </a>                        
                        </div>
                        <div class="col-md-2">                        
                            <a href="#" class="tile tile-danger">
                               <?php echo $books['language']; ?>
                                <p>Language</p>                            
                                <div class="informer informer-danger dir-tr"><span class="fa fa-caret-down"></span></div>
                            </a>                        
                        </div>
                        <div class="col-md-2">                        
                            <a href="#" class="tile tile-primary">
                                <?php echo ($books['price']=='')?0:$books['price']; ?>
                                <p>Price</p>                            
                                <div class="informer informer-default"><span class="fa fa-shopping-cart"></span></div>
                            </a>                        
                        </div>
                    </div>                   
                                           
											
											<?php if($books['book_type']==1 || $books['book_type']==2){ ?>	
											 <table  class="table table-condensed">
											    <thead >
												</thead>
												<tbody id="oky" style="font-size: 12px;";>
                                            <?php 
												foreach($books['audio_urls'] as $audio):
												//print_r($audio);
											?>
													
                                             
                                              		<tr class="remove<?php  echo $audio['id'] ?>"><td>						
                                                <label class="col-md-2 col-xs-12 control-label">
												<?php echo($audio['type']==0)?'Audio':'Sample'?></label>
                                                <div class="col-md-2">
												
													<audio controls>
													<source src="<?php echo $audio['audio_url'];  ?>" type="audio/ogg">
													<source src="<?php echo $audio['audio_url'];  ?>" type="audio/mpeg">
													Your browser does not support the audio tag.
													</audio></td><td>   <button class="btn btn-info" >Edit</button>  <a onclick="deleteaudio(<?php echo $audio['id']; ?>)" class="btn btn-danger">Delete</a></td></tr>
                                                </div>   
   												
                                            
                                            <?php endforeach; echo "</tbody></table>";}
											
											
 else {?>
											<div class="form-group">  
                                              										
                                                <label class="col-md-2 col-xs-12 control-label">E-Book PDF</label>
												<div class="col-md-2">
												<a class="btn btn-danger" href="<?php echo $books['audio_url'];?>" traget="_blank">View</a>
										   </div>
										   </div>
											   <table id="customers1" class="table datatable">
											<thead>
											  <tr>
												<th>#</th>
												<th><center>Page NO</center></th>
												<th><center>Index Name</center></th>
												<th><center>Action</center></th>
											  </tr>
											</thead>
											<tbody id="gfd">
											<?php 
												
												$i=1;
											foreach($admin->get_index_books($_GET['id']) as $row){

											?>
											  <tr id="this<?php echo $row['id']; ?>">
											
										  <td><center><input  type="text" value="<?php echo $row['id']; ?>" id="idd<?php echo $row['id']; ?>" class=" form-control" style="display:none;"/>   <p >   <?php echo $i; ?></p></center></td>
										 <td><center><input  id="name<?php echo $row['id']; ?>"  type="text" value="<?php echo $row['index_no']; ?>" class="n<?php echo $row['id'] ?> form-control" style="display:none;"/>      <p  id="name1<?php echo $row['id']; ?>" class="p<?php echo $row['id']; ?>"><?php echo $row['index_no']; ?> </p></center></td>
										 <td><center> <input  id="email<?php echo $row['id']; ?>"  type="text" value="<?php echo $row['index_name']; ?>" class="n<?php echo $row['id'] ?> form-control" style="display:none;"/>       <p id="name2<?php echo $row['id']; ?>" class="p<?php echo $row['id']; ?>"><?php echo $row['index_name']; ?> </p></center></td>
										  	
										  <td> <center>     <p class="p<?php echo $row['id'] ?>"><a  onclick="the(<?php echo $row['id']; ?>);" class="btn btn-primary">Edit</a>  <a  onclick="chl(<?php echo $row['id']; ?>);" class="btn btn-danger">Delete</a><p><a  onclick="ch(<?php echo $row['id']; ?>);" class="n<?php echo $row['id'] ?> btn btn-primary "  style="display:none;">Save <a/> </td> </center></form>
										  </tr>
											  </tr>
											  
											  <?php $i++;} ?>
											</tbody>

																			</table>  
										   											<?php  } ?>
											
                                            <div class="form-group">
                                                <div class="col-md-2"></div>
                                                <div class="col-md-10"><?php echo $books['description']; ?></div>
                                            </div>
                                           
                                            
                                        </div>                                        
                                        <div class="tab-pane" id="tab-third">
                                           		 <div class="row">
                        <div class="col-md-2">                        
                            <a href="#" class="tile tile-danger tile-valign"><span class="fa fa-laptop"></span></a>                        
                        </div>                    
                        <div class="col-md-2">                        
                            <a href="#" class="tile tile-success tile-valign"><span class="fa fa-calendar"></span></a>
                        </div>                                        
                        <div class="col-md-2">                        
                            <a href="#" class="tile tile-warning tile-valign"><?php echo $books['size']; ?>
                                <div class="informer informer-default dir-bl"><span class="fa fa-globe"></span>Size</div>
                            </a>                        
                        </div>
                        <div class="col-md-2">                        
                            <a href="#" class="tile tile-info">
                              <?php echo date("Y",$books['publish_date']); ?>
                                <p>Publish Date</p>                            
                                <div class="informer informer-default dir-tr"><span class="fa fa-calendar"></span></div>
                            </a>                        
                        </div>
                        <div class="col-md-2">                        
                            <a href="#" class="tile tile-danger">
                               <?php echo $books['language']; ?>
                                <p>Language</p>                            
                                <div class="informer informer-danger dir-tr"><span class="fa fa-caret-down"></span></div>
                            </a>                        
                        </div>
                        <div class="col-md-2">                        
                            <a href="#" class="tile tile-primary">
                                <?php echo ($books['price']=='')?0:$books['price']; ?>
                                <p>Price</p>                            
                                <div class="informer informer-default"><span class="fa fa-shopping-cart"></span></div>
                            </a>                        
                        </div>
                    </div>                   
                        
                                            
                                            <form class="form-horizontal" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="email">Book Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="book_name" value="<?php echo $books['book_name']; ?>" required class="form-control" id="" placeholder="Book Name" name="email">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="pwd">Book Type:</label>
                                            <div class="col-sm-10">          
                                                <select onchange= "checkaudio()" name="book_type" id="book_type" class="form-control" id="sel1" required>
                                                    <option>Please select the Book Type</option>
                                                    <option value="0"<?php if($_GET['id']) echo (isset($books['book_type']) == 0) ? 'selected' : ''; ?>>E-Book</option>
                                                    <option value="1"<?php echo ($books['book_type'] == 1) ? 'selected' : ''; ?>>Audio</option>
                                                    <option value="2"<?php echo ($books['book_type'] == 2) ? 'selected' : ''; ?>>Both</option>


                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group audio" style="display:none">
                                             <label class="control-label col-sm-2 change" for="pwd">Audio Sample</label>
                                            <div class="col-sm-10">          
                                                <input type="file" multiple="true" name="sample_url"  class="form-control" id="audio" placeholder="Book Name" ><!--<span onclick="addmore()" class="fa fa-plus">--></span> 
                                            </div>
											<label class="control-label col-sm-2 change" for="pwd">Add Audio</label>
                                            <div class="col-sm-10">          
                                                <input type="file" multiple="true" name="audio_url[]" id="audio_url" class="form-control" id="audio" placeholder="Book Name" ><span onclick="addmore()" class="fa fa-plus"></span> 
                                            </div>
											
                                        </div>
										 <div class="form-group ebook" style="display:none">
                                            <label class="control-label col-sm-2 change" for="pwd">Add E-Book</label>
                                            <div class="col-sm-10">          
                                                <input type="file"  name="ebook_url" id="audio_url" class="form-control" id="ebook" placeholder="Book Name" >
                                            </div>
                                        </div>
                                      <!--  <div class="form-group " <?php if (!isset($_GET['id']) || $books['book_type'] != 1 || $books['book_type'] == 2 ) { ?> style="display:none;" <?php } ?>>
                                            <label class="control-label col-sm-2" for="pwd">Listen Audio</label>
                                            <audio controls>
                                                <source src="<?php echo $books['audio_url']; ?>" type="audio/ogg">
                                                <source src="<?php echo $books['audio_url']; ?>" type="audio/mpeg">
                                                Your browser does not support the audio tag.
                                            </audio>
                                        </div>-->


                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="pwd">Paid:</label>
                                            <div class="col-sm-10">          
                                                <select onchange="ispaid()" name="is_paid" class="form-control" id="is_paid" required>
                                                    <option>Please select the Paid Type</option>
                                                    <option value="0" <?php if($_GET['id']) echo ($books['is_paid'] == 0) ? 'selected' : ''; ?>>Not Paid</option>
                                                    <option value="1" <?php echo($books['is_paid'] == 1) ? 'selected' : ''; ?>>Paid</option>


                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group paid" <?php if ($books['is_paid'] == 0) { ?> style="display:none;" <?php } ?>>
                                            <label class="control-label col-sm-2" for="pwd">Book Price</label>
                                            <div class="col-sm-10">          
                                                <input type="money" name="price" value="<?php echo $books['price']; ?>" id="price" class="form-control" id="" placeholder="Book Price" name="email">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="pwd">Categary:</label>
                                            <div class="col-sm-10">          
                                                <select name="categary_id" class="form-control" id="is_paid" required>
                                                    <option>Please select Categary</option>
                                                    <?php foreach ($admin->getallcat() as $row): ?>
                                                        <option value="<?php echo $row['id']; ?>" <?php echo ($books['categary_id'] == $row['id']) ? 'selected' : ''; ?>><?php echo $row['catgory_name']; ?></option>


                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="email">Language</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="language" value="<?php echo $books['language']; ?>" required class="form-control" id="" placeholder="Language" >
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="email">Publisher Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="publisher" value="<?php echo $books['publisher']; ?>" required class="form-control" id="" placeholder="Publisher Name" >
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="email">Seller Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="seller_name" value="<?php echo $books['seller_name']; ?>" required class="form-control" id="" placeholder="Seller Name" >
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="email">Publish Date</label>
                                            <div class="col-sm-10">
                                                <input type="<?php echo (!$_GET['id']) ? 'date' : 'text' ?>" name="publish_date" value="<?php echo date("m/d/Y", $books['publish_date']); ?>" required class="form-control" id="" placeholder="Publish Date" >
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="email">Book Size</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="size" value="<?php echo $books['size']; ?>" required class="form-control" id="" placeholder="Book Size" >
                                            </div>
                                        </div>
                                       
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="email">Book Image</label>
                                            <div class="col-sm-10">
                                                <input type="file" name="image" <?php if (!$_GET['id']) { ?> required <?php } ?>class="form-control" id="" placeholder="Length Print" >
                                            </div>
                                        </div>
                                        <div class="form-group" <?php if (!$_GET['id']) { ?> style="display:none;<?php } ?>">
                                            <label class="control-label col-sm-2" for="email">Book Image Privew</label>
                                            <div class="col-sm-10">
                                                <img src="<?php echo $books['image']; ?>" height="10%" width="10%">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="email">About Book</label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" name="description" rows="5" id="comment"><?php echo $books['description']; ?></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group">        
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <button type="submit" name="submit" class="btn btn-info"><?php echo ($_GET['id']) ? 'Update Book' : 'Save Book'; ?></button>
                                            </div>
                                        </div>
                                    </form>
                                        </div>
                                    </div>
                                    <div class="panel-footer">                                                                        
                                        <!--<button class="btn btn-primary pull-right">Save Changes <span class="fa fa-floppy-o fa-right"></span></button>-->
                                    </div>
                                </div>                                
                            
                            </form>
                            
                        </div>
                    </div>                    
                    
                </div>
                <!-- END PAGE CONTENT WRAPPER -->                                                
            </div>            
            <!-- END PAGE CONTENT -->
        </div>
        <!-- END PAGE CONTAINER -->
        <div class="modal fade" id="myModal" role="dialog" style="margin-top:200px">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="informer-default dir-tr" >
         
          <h4 class="modal-title"><center><i><font color="red">Add Audio</font></i></center></h4>
        </div>
        <div class="modal-body">
         <center> <input type="file" required id="books" class="form-controle" /></center>
        </div>
        <div class="modal-footer">
		<button type="button" onclick="add_book()"  class="btn btn-info addss" >Add <i class="fa fa-refresh fa-spin rock" style="display:none;"></i></button>
          <button type="button" class="btn btn-danger addss"  data-dismiss="modal">Close</button>
		  
        </div>
      </div>
    </div>
  </div>
 <div class="modal fade" id="myModal1" role="dialog" style="margin-top:200px">
    <div class="modal-dialog modal-lm">
      <div class="modal-content">
        <div class="informer-default dir-tr" >
         
          <h4 class="modal-title"><center><i><font color="red">Add Index</font></i></center></h4>
        </div>
		<form method="post"  class="form-inline">
		<div class="nameindex">
        <div class="modal-body ">
        <div class="form-group">
    <label for="email">Index NO:</label>
    <input type="number" name="index_no[]" required class="form-control" placeholder="Index No">
  </div>
  <div class="form-group">
    <label for="pwd">Index Name:</label>
   <input type="text" name="index_name[]" required class="form-control" placeholder="Index Name" >
  </div>
  
  
  <div class="form-group">
    
  <a onclick="add_more_index()" class="btn btn-info"><span class="fa fa-plus"></span><a>
  </div>
        </div>
		</div >
        <div class="modal-footer">
		<button type="submit" name="adding"   class="btn btn-info addss" >Add <i class="fa fa-refresh fa-spin rock" style="display:none;"></i></button>
          <button type="button" class="btn btn-danger addss"  data-dismiss="modal">Close</button>
		  </form>
        </div>
      </div>
    </div>
  </div>

        <!-- MESSAGE BOX-->
        <div class="message-box animated fadeIn" data-sound="alert" id="mb-signout">
            <div class="mb-container">
                <div class="mb-middle">
                    <div class="mb-title"><span class="fa fa-sign-out"></span> Log <strong>Out</strong> ?</div>
                    <div class="mb-content">
                        <p>Are you sure you want to log out?</p>                    
                        <p>Press No if youwant to continue work. Press Yes to logout current user.</p>
                    </div>
                    <div class="mb-footer">
                        <div class="pull-right">
                            <a href="pages-login.html" class="btn btn-success btn-lg">Yes</a>
                            <button class="btn btn-default btn-lg mb-control-close">No</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		 
		<audio id="audio-alert" src="audio/alert.mp3" preload="auto"></audio>
    <!-- END MESSAGE BOX-->        

    <?php include("footer.php"); ?>
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
	<?php   if($msg==1){?>
		<script>$('#message-box-sound-1').modal('show'); </script>
		<?php } ?>
    <script>
                                                   
												   function add_book(){
														$(".addss").attr('disabled',true);
														$(".rock").show();
														var form_data = new FormData();
														var book_id ="<?php echo $_GET['id']; ?>";
													    var audio = $('#books').prop('files')[0];
														form_data.append('book_id',book_id);
														form_data.append('url',audio);
														$.ajax({
															url: 'ajax/add_new_audio.php', // point to server-side PHP script 
															dataType: 'text', // what to expect back from the PHP script, if anything
															cache: false,
															contentType: false,
															processData: false,
															data: form_data,
															type: 'post',
															success: function (data) {
																console.log(data);
																$(".addss").attr('disabled',false);
																$(".rock").hide();
																var data = JSON.parse(data);
																var newtd='<tr class="remove'+data.id+'"><td> <label class="col-md-2 col-xs-12 control-label">Audio</label>';  
																	newtd+='<div class="col-md-2">';				
																	newtd+='<audio controls>';
																	newtd+='<source src="'+data.url+'" type="audio/ogg">';
																	newtd+='<source src="'+data.url+'" type="audio/mpeg">';
																	newtd+='Your browser does not support the audio tag.';
																	newtd+='</audio></td><td>  <button class="btn btn-info" >Edit</button>  <a onclick="deleteaudio('+data.id+')" class="btn btn-danger">Delete</a></td></tr>';
																	newtd+='</div>';   		
																	
																$("#oky").append(newtd);
																$("#myModal").modal('hide');
																$("#snackbar").html('New audio Added successfully');
																$("#snackbar").addClass('show'); 
																setTimeout(function(){ 
																	$("#snackbar").removeClass('show'); 
																			
																		}, 3000);
															}
														});
												   }
												   function deleteaudio(audio_id){
														var book_id="<?php echo $_GET['id']; ?>";
														if(confirm("are you sure want delete this audio")){
															$.ajax({
                                                            type: 'POST',
                                                            url: 'ajax/delete_aduio.php',
                                                            data: {id:audio_id,book_id:book_id},
                                                            success: function (data) {
																$(".remove"+audio_id).fadeOut('slow');
																$("#snackbar").addClass('show'); 
																$("#snackbar").html('audio deleted successfully!!');
																setTimeout(function(){ 
																	$("#snackbar").removeClass('show'); 
																			
																		}, 3000);
                                                            }
                                                        });
														}
													}
													var gb=0;
													function add_more_index(){
															gb++;
															var indexing='<div class="modal-body" id="rd'+gb+'">';
														    indexing+= '<div class="form-group">';
															indexing+='<label for="email">Index NO:</label>';
															indexing+=' <input type="number" name="index_no[]" required class="form-control" placeholder="Index No">';
															indexing+='</div>';
															indexing+='   <div class="form-group">';
															indexing+='<label for="pwd">Index Name:</label>';
															indexing+=' <input type="text" name="index_name[]" required class="form-control" placeholder="Index Name" >';
															indexing+='</div>';
															indexing+=' <div class="form-group">';
															indexing+=' <a onclick="index_remove('+gb+')" class="btn btn-danger"><span class="fa fa-trash-o"></span><a>';
															indexing+='</div>';
															indexing+='</div>';
															$(".nameindex").append(indexing);
													}
													
													function index_remove(id){
														$("#rd"+id).remove();
													}
													
													
												function   bookhide(){
													$('#message-box-sound-1').modal('hide');
													}
												   
                                                    setInterval(messagedis, 3000);


                                                    function messagedis() {

                                                        $("#p").fadeOut("slow");
                                                    }
                                                    function the(st) {

                                                        var d = st;

                                                        $(".p" + d).hide();
                                                        $(".n" + d).show();

                                                    }
                                                    function ch(str) {
							
                                                        var d = str;
                                                        var name = $("#name" + d).val();
                                                        var email = $("#email" + d).val();
														var book_id="<?php echo $_GET['id']; ?>"; 
                                                        $.ajax({
                                                            type: 'POST',
                                                            url: 'ajax/update_index.php',
                                                            data: {id: d, name: name, email: email,book_id:book_id},
                                                            success: function (data) {
                                                                $("#name1" + d).html('').append(name);
                                                                $("#name2" + d).html('').append(email);
                                                                $(".p" + d).show();
                                                                $(".n" + d).hide();
																$("#snackbar").html('Index updated Successfully');
																	$("#snackbar").addClass('show'); 
																	setTimeout(function(){ 
																	$("#snackbar").removeClass('show'); 
																			
																		}, 3000);
                                                            }


                                                        });


                                                    }
                                                    var audio_count=1;
                                                    function addmore(){
                                                        $(".audio").append(' <label class="control-label col-sm-2 new" id="new'+audio_count+'" for="pwd">Add Audio'+ audio_count +'</label><div id="new1'+audio_count+'" class="new col-sm-10"><input type="file" multiple="true" name="audio_url[]"  class="form-control new" id="new2'+audio_count+'" placeholder="Book Name" /><span onclick="addremove('+audio_count+')" class="fa fa-trash-o"></span></div>');
                                                        audio_count++;
                                                    }
                                                    function addremove(id){
                                                        $("#new"+id).remove();
                                                        $("#new1"+id).remove();
                                                    }
                                                    
                                                    function chl(pk) {
														var book_id="<?php echo $_GET['id']; ?>";
                                                        if (confirm("are you sure want to delete this Index ?")) {

                                                            var del_id = pk;
                                                            $.ajax({
                                                                type: 'POST',
                                                                url: 'ajax/delete_index.php',
                                                                data: {del_id:pk,book_id:book_id},
                                                                success: function (data) {
                                                                    $("#this" + pk).fadeOut("xslow");
																	$("#snackbar").html('Index deleted Successfully');
																	$("#snackbar").addClass('show'); 
																	setTimeout(function(){ 
																	$("#snackbar").removeClass('show'); 
																			
																		}, 3000);
                                                                }


                                                            });
															}
                                                        
                                                    }
                                                    function jf() {

                                                        $("#gfd").prepend("<tr id='dk'><td></td><td><input type='text' class='form-control' ></td><td><input type='text' class='form-control' ></td><td><input type='submit'  value='save' class='btn btn-primary' > <input type='submit' onclick='dog();' value='Remove' class='btn btn-danger' ></td></tr>");

                                                    }
                                                    function dog() {
                                                        $("#dk").remove();
                                                    }
                                                    //ispaid
                                                    function checkaudio() {
                                                        var val = $("#book_type").val();
                                                        if (val == 0) {
                                                            $(".ebook").show();
                                                            $(".audio").hide();
                                                        } else if(val==1) {
                                                            $(".ebook").hide();
                                                            $(".audio").show();
                                                        } else{
															$(".audio").show();
															$(".ebook").show();
														}

                                                    }
                                                    function ispaid() {
                                                        var val = $("#is_paid").val();
                                                        if (val == 0) {
                                                            $(".paid").hide();
                                                            $("#price").removeAttr('required');

                                                        } else {
                                                            $(".paid").show();
                                                            $("#price").attr('required');
                                                        }

                                                    }


                                                    function back() {
                                                        window.history.back();
                                                    }
                                                    
                                                    function isfeatur(book_id){
														$("#snackbar").html('');
                                                        var value=$("#is_check").val();
                                                        if(value==1){
                                                            var val=0;
															$("#is_check").val('0');
															$("#snackbar").html('Book is Unfeatured now');
                                                        }else{
                                                            var val=1;
															$("#is_check").val('1');
															$("#snackbar").html('Book is featured now');
                                                        }
                                                        $.ajax({
                                                            type: 'POST',
                                                            url: 'ajax/is_feature.php',
                                                            data: {book_id: book_id, val: val},
                                                            success: function (data) {
															
																$("#snackbar").addClass('show'); 
															
																setTimeout(function(){ 
																	$("#snackbar").removeClass('show'); 
																			
																		}, 3000);
                                                            }
                                                        });
                                                    }
													
													function add_index_done(){
														$("#snackbar").html('Index Added Successfully');
														$("#snackbar").addClass('show'); 
														setTimeout(function(){ 
														$("#snackbar").removeClass('show'); 
																			
														}, 3000);
													
													
													}
													
                                                    
                                                    
    </script>	
</body>
</html>






