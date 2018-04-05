
  
<?php 
session_start();
include("controller/chat.php");

 $title_tag = "chat";




$chat=new chat();



   
   ?> 
        <!-- META SECTION -->
        <title>Event Admin</title>            
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        
        <link rel="icon" href="favicon.ico" type="image/x-icon" />
        <!-- END META SECTION -->
        
        <!-- CSS INCLUDE -->        
        <link rel="stylesheet" type="text/css" id="theme" href="css/theme-default.css"/>
        <!-- EOF CSS INCLUDE -->                                      
    </head>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>



    <body >
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
                 <ul class="breadcrumb push-down-0">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Pages</a></li>                    
                    <li class="active">Messages</li>
                </ul>
                <!-- END BREADCRUMB -->                
                                
                <!-- START CONTENT FRAME -->
                <div class="content-frame"  >                                    
                    <!-- START CONTENT FRAME TOP -->
                    <div class="content-frame-top">                        
                        <div class="page-title">                    
                            <h2><span class="fa fa-comments"></span> Messages</h2>
                        </div>                                                    
                        <div class="pull-right">                            
                            <button class="btn btn-danger"><span class="fa fa-book"></span> Contacts</button>
                            <button class="btn btn-default content-frame-right-toggle"><span class="fa fa-bars"></span></button>
                        </div>                           
                    </div>
                    <!-- END CONTENT FRAME TOP -->
                    
                    <!-- START CONTENT FRAME RIGHT -->
                    <div class="content-frame-right">
                        
                        <div class="list-group list-group-contacts border-bottom push-down-10">
					<?php 	$c=1;foreach($chat->getlastchat($_SESSION['user_id']) as $k){



					?>
                            <a href="#" ng-click="" <?php echo ($c==1)?'class="list-group-item active"':'class="list-group-item"' ?>>                                 
                                <div class="list-group-status status-online"></div>
                                <img src="assets/images/users/user.jpg" class="pull-left" alt="Dmitry Ivaniuk">
                                <span class="contacts-title"><?php echo $k['name']; ?></span>
                                <p><?php echo $k['message']; ?></p>
                            </a>    

<?php $c++; } ?>                            
                                                      
                        </div>
                        
                     <!--   <div class="block">
                            <h4>Status</h4>
                            <div class="list-group list-group-simple">                                
                                <a href="#" class="list-group-item"><span class="fa fa-circle text-success"></span> Online</a>
                                <a href="#" class="list-group-item"><span class="fa fa-circle text-warning"></span> Away</a>
                                <a href="#" class="list-group-item"><span class="fa fa-circle text-muted"></span> Offline</a>                                
                            </div>
                        </div>-->
                        
                    </div>
                    <!-- END CONTENT FRAME RIGHT -->
                
                    <!-- START CONTENT FRAME BODY -->
                    <div class="content-frame-body content-frame-body-left" >
                       
                        <div class="messages messages-img">
                            <div class="item in">
                                <div class="image">
                                    <img src="assets/images/users/user2.jpg" alt="John Doe">
                                </div>
                                <div class="text">
                                    <div class="heading">
                                        <a href="#">John Doe</a>
                                        <span class="date">08:33</span>
                                    </div>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed facilisis suscipit eros vitae iaculis.
                                </div>
                            </div>
                            <div class="item">
                                <div class="image">
                                    <img src="assets/images/users/user.jpg" alt="Dmitry Ivaniuk">
                                </div>                                
                                <div class="text">
                                    <div class="heading">
                                        <a href="#">Dmitry Ivaniuk</a>
                                        <span class="date">08:39</span>
                                    </div>                                    
                                    Integer et ipsum vitae urna mattis dictum. Sed eu sollicitudin nibh, in luctus velit.
                                </div>
                            </div>
                            <div class="item">
                                <div class="image">
                                    <img src="assets/images/users/user.jpg" alt="Dmitry Ivaniuk">
                                </div>                                
                                <div class="text">
                                    <div class="heading">
                                        <a href="#">Dmitry Ivaniuk</a>
                                        <span class="date">08:42</span>
                                    </div>                                    
                                    In dapibus ex ut nisl laoreet aliquam. Donec in mollis leo. Aenean nec suscipit neque, non iaculis justo. Quisque eget odio efficitur, porta risus vitae, sagittis neque.
                                </div>
                            </div>
                            <div class="item in">
                                <div class="image">
                                    <img src="assets/images/users/user2.jpg" alt="John Doe">
                                </div>
                                <div class="text">
                                    <div class="heading">
                                        <a href="#">John Doe</a>
                                        <span class="date">08:58</span>
                                    </div>
                                    Curabitur et euismod urna?
                                </div>
                            </div>
                            <div class="item">
                                <div class="image">
                                    <img src="assets/images/users/user.jpg" alt="Dmitry Ivaniuk">
                                </div>                                
                                <div class="text">
                                    <div class="heading">
                                        <a href="#">Dmitry Ivaniuk</a>
                                        <span class="date">09:11</span>
                                    </div>                                    
                                    Fusce ultricies erat quis massa interdum, eu elementum urna iaculis
                                </div>
                            </div>
                            <div class="item in">
                                <div class="image">
                                    <img src="assets/images/users/user2.jpg" alt="John Doe">
                                </div>
                                <div class="text">
                                    <div class="heading">
                                        <a href="#">John Doe</a>
                                        <span class="date">09:22</span>
                                    </div>
                                    Vestibulum cursus ipsum ut dolor vulputate dapibus. Donec elementum est vel vulputate malesuada?
                                </div>
                            </div>
                        </div>                        
                        
                        <div class="panel panel-default push-up-10">
                            <div class="panel-body panel-body-search">
                                <div class="input-group">
                                    <div class="input-group-btn">
                                        <button class="btn btn-default"><span class="fa fa-camera"></span></button>
                                        <button class="btn btn-default"><span class="fa fa-chain"></span></button>
                                    </div>
                                    <input type="text" id="m" class="form-control" placeholder="Your message..."/>
                                    <div class="input-group-btn">
                                        <button ng- click= "sendmessage()"class="btn btn-default">Send</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <!-- END CONTENT FRAME BODY -->      
                </div>
                <!-- END PAGE CONTENT FRAME -->
            </div>            
            <!-- END PAGE CONTENT -->
        </div>
        <!-- END PAGE CONTAINER -->

        <!-- MESSAGE BOX-->
      <?php echo "footer.php"; ?>
        <!-- END MESSAGE BOX-->

        <!-- START PRELOADS -->
        <audio id="audio-alert" src="audio/alert.mp3" preload="auto"></audio>
        <audio id="audio-fail" src="audio/fail.mp3" preload="auto"></audio>
        <!-- END PRELOADS -->                        
        
    <!-- START SCRIPTS -->
        <!-- START PLUGINS -->
        <script type="text/javascript" src="js/plugins/jquery/jquery.min.js"></script>
        <script type="text/javascript" src="js/plugins/jquery/jquery-ui.min.js"></script>
        <script type="text/javascript" src="js/plugins/bootstrap/bootstrap.min.js"></script>        
        <!-- END PLUGINS -->

        <!-- THIS PAGE PLUGINS -->
        <script type='text/javascript' src='js/plugins/icheck/icheck.min.js'></script>
        <script type="text/javascript" src="js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
        <!-- END PAGE PLUGINS -->     

        <!-- START TEMPLATE -->
        <script type="text/javascript" src="js/settings.js"></script>
        
        <script type="text/javascript" src="js/plugins.js"></script>        
        <script type="text/javascript" src="js/actions.js"></script>        
        <!-- END TEMPLATE -->
    <!-- END SCRIPTS -->  

<script>
$(document).ready(function(){

$("#m").on('keypress',function (e) {

	var key = e.which;
    if (key == 13) {
	alert('xx');
	chat();
	
	}
	});
	function chat(){

var s="<?php echo session_id()?>";
var r='1';
var m=$("#m").val();
var j=m;
$("#m").val("");

$.ajax({
method:'post',
url:'http://202.164.42.226/staging/mertol_event/api/chat.php',
data: {sender_id:'91',friend_id:'20',message:m},
success:function(data){

console.log(data);

}});}
setInterval(get,1000);
function get(){
var s="<?php echo session_id()?>";
var r='1';
var m=$("#m").val();

$.ajax({
method:'post',
url:'http://202.164.42.226/staging/mertol_event/api/getmessage.php',
data: {sender_id:'91',friend_id:'20'},
success:function(data){

console.log(data);
 
   

}});

}


});
</script>
	
    </body>
</html>