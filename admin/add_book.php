


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



                <div class="row">
                    <div class="col-md-12">

                        <!-- START DATATABLE EXPORT -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"></h3>
                                <div class="container-fluid">

                                    <?php
                                    if (isset($_POST['submit']) && (!isset($_GET['id']))) {
                                        if (move_uploaded_file($_FILES['ebook_url']['tmp_name'], "ajax/upload/" . $_FILES['ebook_url']['name'])) {
                                            $audio = BASE_HTTP_BASE_URL . "upload/" . $_FILES['ebook_url']['name'];
                                        }
                                        if (move_uploaded_file($_FILES['image']['tmp_name'], "ajax/upload/" . $_FILES['image']['name'])) {
                                            $image = BASE_HTTP_BASE_URL . "upload/" . $_FILES['image']['name'];
                                        }
										$ebook_audio=[];
										foreach($_FILES['audio_url']['name'] as $k=>$value){
										  
											if (move_uploaded_file($_FILES['audio_url']['tmp_name'][$k], "ajax/upload/" . $value)) {
											 
											 $mp3file = new MP3File($_FILES['audio_url']['name'][$k]);//http://www.npr.org/rss/podcast.php?id=510282
                                             $duration[]= MP3File::formatTime($duration2)."\n";
                                            $ebook_audio[] = BASE_HTTP_BASE_URL . "upload/" . $value;
                                           }
										}
										if (move_uploaded_file($_FILES['sample_url']['tmp_name'], "ajax/upload/" . $_FILES['sample_url']['name'])) {
                                            $sample_url = BASE_HTTP_BASE_URL . "upload/" . $_FILES['sample_url']['name'];
                                        }
										
                                        $formdata = array(
                                            'book_name' => $_POST['book_name'],
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
                                            'image' => $image,
                                            'book_audio' => $ebook_audio,
                                            'duration' => $duration,
											'author_id' => $_POST['author_id'],
											'sample_url' => $sample_url
                                        );
										
                                        $data = $admin->addbook($formdata);

                                        if ($data == 0) {

                                            echo "<script>window.location='simple_book'</script>";
                                        } else {
                                            echo "<script>window.location='audio_book'</script>";
                                        }
                                    }

                                    if ($_GET['id']) {
                                        $book_info = $admin->singalbook($_GET['id']);
                                    }
                                    if (isset($_POST['submit']) && isset($_GET['id'])) {

                                        if (move_uploaded_file($_FILES['audio_url']['tmp_name'], "ajax/upload/" . $_FILES['audio_url']['name'])) {
                                            $audio = BASE_HTTP_BASE_URL . "upload/" . $_FILES['audio_url']['name'];
                                        } else {
                                            $audio = $book_info['audio_url'];
                                        }
                                        if (move_uploaded_file($_FILES['image']['tmp_name'], "ajax/upload/" . $_FILES['image']['name'])) {
                                            $image = BASE_HTTP_BASE_URL . "upload/" . $_FILES['image']['name'];
                                        } else {
                                            $image = $book_info['image'];
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
                                            'author_id' => $_POST['author_id'],
                                            'image' => $image
                                        );
                                        $data = $admin->update_book($formdata);
                                        $msg = '<div class="alert alert-success">
  <strong>Success!</strong> Book Updateed Successfully
</div>';
                                    }
                                    if ($_GET['id']) {
                                        $book_info = $admin->singalbook($_GET['id']);
                                    }
                                    ?>




                                    <span id="p"> <?php echo $msg; ?></span>					

                                    <h2><?php echo ($_GET['id']) ? 'Update Book' : 'Add Book'; ?></h2>
                                    <form class="form-horizontal" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="email">Book Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="book_name" value="<?php echo $book_info['book_name']; ?>" required class="form-control" id="" placeholder="Book Name" name="email">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="pwd">Book Type:</label>
                                            <div class="col-sm-10">          
                                                <select onchange= "checkaudio()" name="book_type" id="book_type" class="form-control" id="sel1" required>
                                                    <option>Please select the Book Type</option>
                                                    <option value="0"<?php if($_GET['id']) echo (isset($book_info['book_type']) == 0) ? 'selected' : ''; ?>>E-Book</option>
                                                    <option value="1"<?php echo ($book_info['book_type'] == 1) ? 'selected' : ''; ?>>Audio</option>
                                                    <option value="2"<?php echo ($book_info['book_type'] == 2) ? 'selected' : ''; ?>>Both</option>


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
                                        <div class="form-group " <?php if (!isset($_GET['id']) || $book_info['book_type'] != 1 || $book_info['book_type'] == 2 ) { ?> style="display:none;" <?php } ?>>
                                            <label class="control-label col-sm-2" for="pwd">Listen Audio</label>
                                            <audio controls>
                                                <source src="<?php echo $book_info['audio_url']; ?>" type="audio/ogg">
                                                <source src="<?php echo $book_info['audio_url']; ?>" type="audio/mpeg">
                                                Your browser does not support the audio tag.
                                            </audio>
                                        </div>


                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="pwd">Paid:</label>
                                            <div class="col-sm-10">          
                                                <select onchange="ispaid()" name="is_paid" class="form-control" id="is_paid" required>
                                                    <option>Please select the Paid Type</option>
                                                    <option value="0" <?php if($_GET['id']) echo ($book_info['is_paid'] == 0) ? 'selected' : ''; ?>>Not Paid</option>
                                                    <option value="1" <?php echo($book_info['is_paid'] == 1) ? 'selected' : ''; ?>>Paid</option>


                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group paid" <?php if ($book_info['is_paid'] == 0) { ?> style="display:none;" <?php } ?>>
                                            <label class="control-label col-sm-2" for="pwd">Book Price</label>
                                            <div class="col-sm-10">          
                                                <input type="money" name="price" value="<?php echo $book_info['price']; ?>" id="price" class="form-control" id="" placeholder="Book Price" name="email">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="pwd">Categary:</label>
                                            <div class="col-sm-10">          
                                                <select name="categary_id" class="form-control" id="is_paid" required>
                                                    <option>Please select Categary</option>
                                                    <?php foreach ($admin->getallcat() as $row): ?>
                                                        <option value="<?php echo $row['id']; ?>" <?php echo ($book_info['categary_id'] == $row['id']) ? 'selected' : ''; ?>><?php echo $row['catgory_name']; ?></option>


                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="email">Language</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="language" value="<?php echo $book_info['language']; ?>" required class="form-control" id="" placeholder="Language" >
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="email">Publisher Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="publisher" value="<?php echo $book_info['publisher']; ?>" required class="form-control" id="" placeholder="Publisher Name" >
                                            </div>
                                        </div>
										 <div class="form-group">
                                            <label class="control-label col-sm-2" for="pwd">Book Author:</label>
                                            <div class="col-sm-10"> 
												<?php if($_SESSION['admin_type']==0){ ?>
                                                <select name="author_id" class="form-control" id="" required>
                                                    <option>Please select Author</option>
                                                    <?php foreach ($admin->get_auther() as $row): ?>
                                                        <option value="<?php echo $row['id']; ?>" ><?php echo $row['name']; ?></option>


                                                    <?php endforeach; ?>
                                                </select>
												<?php } else { ?>
												<select name="author_id" class="form-control" id="" required>
                                                    <option>Please select Author</option>
                                                    <?php $data= $admin->get_auther_id($_SESSION['admin_id']);  ?>
                                                        <option selected value="<?php echo $data['id']; ?>" ><?php echo $data['name']; ?></option>


                                       
                                                </select>
												
												
											 <?php	} ?>
                                            </div>
                                        </div>
										
										
										
										
										
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="email">Seller Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="seller_name" value="<?php echo $book_info['seller_name']; ?>" required class="form-control" id="" placeholder="Seller Name" >
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="email">Publish Date</label>
                                            <div class="col-sm-10">
                                                <input type="<?php echo (!$_GET['id']) ? 'date' : 'text' ?>" name="publish_date" value="<?php echo date("m/d/Y", $book_info['publish_date']); ?>" required class="form-control" id="" placeholder="Publish Date" >
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="email">Book Size</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="size" value="<?php echo $book_info['size']; ?>" required class="form-control" id="" placeholder="Book Size" >
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
                                                <img src="<?php echo $book_info['image']; ?>" height="10%" width="10%">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="email">About Book</label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" name="description" rows="5" id="comment"><?php echo $book_info['description']; ?></textarea>
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
    <script>
                                                    //$("#p").fadeOut("slow");
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
                                                        $.ajax({
                                                            type: 'POST',
                                                            url: 'ajax/updateuser.php',
                                                            data: {id: d, name: name, email: email},
                                                            success: function (data) {

                                                                $("#name1" + d).html('').append(name);
                                                                $("#name2" + d).html('').append(email);

                                                                $(".p" + d).show();
                                                                $(".n" + d).hide();

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
                                                        if (confirm("are you sure want to delete this user ?")) {

                                                            var del_id = pk;
                                                            $.ajax({
                                                                type: 'POST',
                                                                url: 'ajax/delete.php',
                                                                data: "del_id=" + pk,
                                                                success: function (data) {
                                                                    $("#this" + pk).fadeOut("xslow");
                                                                }



                                                            })

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
    </script>	
</body>
</html>






