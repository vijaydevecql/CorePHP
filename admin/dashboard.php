       
  <?php
session_start();

if($_SESSION['admin_id']==''){

header("location:index.php");
}
 $title_tag = "Dashboard";
 //$event=new login();

  ?>
        <!DOCTYPE html>
<html lang="en">
    <head>        

        <title>Audio Book</title>            
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        
        <link rel="icon" href="favicon.ico" type="image/x-icon" />
        <!-- END META SECTION -->
        
        <!-- CSS INCLUDE -->        
        <link rel="stylesheet" type="text/css" id="theme" href="css/theme-default.css"/>
        <link rel="stylesheet" type="text/css" id="theme" href="css/toast.css"/>
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
                    <li><a href="#">Home</a></li>                    
                    <li class="active">Dashboard</li>
                </ul>
                <!-- END BREADCRUMB -->                       
                
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                    
                    <!-- START WIDGETS -->                    
                    <div class="row">
                        <div class="col-md-3">
                            
                            <!-- START WIDGET SLIDER -->
                            <div class="widget widget-warning widget-carousel">
                                <div class="owl-carousel" id="owl-example">
                                    <div>                                    
                                        <div class="widget-title">Total Books</div>                                                                        
                                        <div class="widget-subtitle"><?php echo date("Y/m/d"); ?></div>
                                        <div class="widget-int"><?php echo $admin->totalbook(); ?></div>
                                    </div>
                                    <div>                                    
                                        <div class="widget-title">Simple Books</div>
                                        <div class="widget-subtitle">Books</div>
                                        <div class="widget-int"><?php echo $admin->simplebook(); ?></div>
                                    </div>
									
                                    <div>                                    
                                        <div class="widget-title">Audio Books</div>
                                        <div class="widget-subtitle">Books</div>
                                        <div class="widget-int"><?php echo $admin->audiobook(); ?></div>
                                    </div>
                                </div>                            
                                <div class="widget-controls">                                
                                    <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
                                </div>                             
                            </div>         
                            <!-- END WIDGET SLIDER -->
                            
                        </div>
                        <div id="snackbar" >Welcome <?php echo $_SESSION['name'] ?></div>
                        <div class="col-md-3">
                            
                            <!-- START WIDGET REGISTRED -->
                            <div class="widget widget-warning widget-item-icon" onClick="location.href='user';">
                                <div class="widget-item-left">
                                    <span class="fa fa-user"></span>
                                </div>
                                <div class="widget-data">
                                    <div class="widget-int num-count"><?php echo $admin->totaluser(); ?></div>
                                    <div class="widget-title">Registred users</div>
                                    <div class="widget-subtitle">On your APP</div>
                                </div>
                                <div class="widget-controls">                                
                                    <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
                                </div>                            
                            </div>                            
                            <!-- END WIDGET REGISTRED -->
                            
                        </div>
						 <div class="col-md-3">
                            
                            <!-- START WIDGET REGISTRED -->
                            <div class="widget widget-warning widget-item-icon" onClick="location.href='user';">
                                <div class="widget-item-left">
                                    <span class="fa fa-globe"></span>
                                </div>
                                <div class="widget-data">
                                    <div class="widget-int num-count"><?php echo $admin->getcat_Count(); ?></div>
                                    <div class="widget-title">Total Categary</div>
                                    <div class="widget-subtitle"></div>
                                </div>
                                <div class="widget-controls">                                
                                    <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
                                </div>                            
                            </div>                            
                            <!-- END WIDGET REGISTRED -->
                            
                        </div>
                        <div class="col-md-3">
                            
                            <!-- START WIDGET CLOCK -->
                            <div class="widget widget-danger widget-padding-sm">
                                <div class="widget-big-int plugin-clock">00:00</div>                            
                                <div class="widget-subtitle plugin-date">Loading...</div>
                                <div class="widget-controls">                                
                                    <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="left" title="Remove Widget"><span class="fa fa-times"></span></a>
                                </div>                            
                                <div class="widget-buttons widget-c3">
                                    <div class="col">
                                        <a href="#"><span class="fa fa-clock-o"></span></a>
                                    </div>
                                    <div class="col">
                                        <a href="#"><span class="fa fa-bell"></span></a>
                                    </div>
                                    <div class="col">
                                        <a href="#"><span class="fa fa-calendar"></span></a>
                                    </div>
                                </div>                            
                            </div>                        
                            <!-- END WIDGET CLOCK -->
                            
                        </div>
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
                    </div>
                    <!-- END WIDGETS -->                    
                    
                    <div class="row">
                        <div class="col-md-4">
                            
                            <!-- START USERS ACTIVITY BLOCK -->
                            
                            <!-- END USERS ACTIVITY BLOCK -->
                            
                        </div>
                        <div class="col-md-4">
                            
                           
                            <!-- END VISITORS BLOCK -->
                            
                        </div>

						<div class="col-md-4">
                            
                            <!-- START PROJECTS BLOCK -->
                           
                                    
                           
                            </div>
                            <!-- END PROJECTS BLOCK -->
                            
                        </div>
                    </div>
                    
                    <div class="row">
						<div class="col-md-8">
                            
                            <!-- START SALES BLOCK -->
                       
                            <!-- END SALES BLOCK -->
                            
                        </div>
						<div class="common-modal modal fade" id="common-Modal1" tabindex="-1" role="dialog" aria-hidden="true">
							<div class="modal-content">
								<ul class="list-inline item-details">
									<li><a href="http://themifycloud.com/downloads/janux-premium-responsive-bootstrap-admin-dashboard-template/">Admin templates</a></li>
									<li><a href="http://themescloud.org">Bootstrap themes</a></li>
								</ul>
							</div>
						</div>
                        
                        <div class="col-md-4">
                            
                            <!-- START SALES & EVENTS BLOCK -->
                     
                            <!-- END SALES & EVENTS BLOCK -->
                            
                        </div>
                    </div>
                    
                    <!-- START DASHBOARD CHART -->
					<div class="chart-holder" id="dashboard-area-1" style="height: 200px;"></div>
					<div class="block-full-width">
                                                                       
                    </div>                    
                    <!-- END DASHBOARD CHART -->
                    
                </div>
                <!-- END PAGE CONTENT WRAPPER -->                                
            </div>            
            <!-- END PAGE CONTENT -->
        </div>
        <!-- END PAGE CONTAINER -->

        <!-- MESSAGE BOX-->
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
        <script type="text/javascript" src="js/plugins/scrolltotop/scrolltopcontrol.js"></script>
        
        <script type="text/javascript" src="js/plugins/morris/raphael-min.js"></script>
        <script type="text/javascript" src="js/plugins/morris/morris.min.js"></script>       
        <script type="text/javascript" src="js/plugins/rickshaw/d3.v3.js"></script>
        <script type="text/javascript" src="js/plugins/rickshaw/rickshaw.min.js"></script>
        <script type='text/javascript' src='js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js'></script>
        <script type='text/javascript' src='js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js'></script>                
        <script type='text/javascript' src='js/plugins/bootstrap/bootstrap-datepicker.js'></script>                
        <script type="text/javascript" src="js/plugins/owl/owl.carousel.min.js"></script>                 
        
        <script type="text/javascript" src="js/plugins/moment.min.js"></script>
        <script type="text/javascript" src="js/plugins/daterangepicker/daterangepicker.js"></script>
        <!-- END THIS PAGE PLUGINS-->        

        <!-- START TEMPLATE -->
        <script type="text/javascript" src="js/settings.js"></script>
        
        <script type="text/javascript" src="js/plugins.js"></script>        
        <script type="text/javascript" src="js/actions.js"></script>
        
        <script type="text/javascript" src="js/demo_dashboard.js"></script>
        <!-- END TEMPLATE -->
    <!-- END SCRIPTS -->         
	<script>
		//alert(localStorage.getItem('is_show'));
	if(localStorage.getItem('is_show')==0 ){
		
		$("#snackbar").addClass('show');
                setTimeout(function () {
                    $("#snackbar").removeClass('show');
                }, 3000);
				localStorage.setItem('is_show', '1');
	}
	</script>
    </body>
</html>






