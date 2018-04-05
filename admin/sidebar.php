<?php
include("controller/admin_login.php");
 $admin=new login();
 ?>
<ul class="x-navigation">
                    <li class="xn-logo">
                        <a href="dashboard">Audio Book</a>
                        <a href="" class="x-navigation-control"></a>
                    </li>
                    <li class="xn-profile">
                        <a href="" class="profile-mini">
                            <img src="<?php echo $_SESSION['profile_pic']; ?>" alt="John Doe"/>
                        </a>
                        <div class="profile">
                            <div class="profile-image">
                                <img id="sidebarimge"src="<?php echo $_SESSION['profile_pic']; ?>" alt="John Doe"/>
                            </div>
                            <div class="profile-data">
                                <div class="profile-data-name"><?php echo $_SESSION['name']; ?></div>
                                <div class="profile-data-title">Admin</div>
                            </div>
                            <div class="profile-controls">
                                <a href="profile" class="profile-control-left"><span class="fa fa-info"></span></a>
                                <!-- <a href="#" class="profile-control-right"><span class="fa fa-envelope"></span></a> -->
                            </div>
                        </div>                                                                        
                    </li>
                    <li class="xn-title">Navigation</li>
                    <li <?php if($title_tag == 'Dashboard') echo 'class="active"'; ?>>
                        <a href="dashboard"><span class="fa fa-desktop"></span> <span class="xn-text">Dashboard</span></a>                        
                    </li>
					<?php if($_SESSION['admin_type']==0){ ?>
                     <li class="xn-openable <?php if($title_tag == 'user') echo "active"; ?>" >
                                <a href="#"><span  class="fa fa-users"></span> <span class="xn-text">Users</span></a>
                                <ul>
								
						
								
                                   <li <?php if($title_tag1 == 'user') echo 'class="active"'; ?>><a href="user"><span class="fa fa-user"></span>User's</a></li>
                                    <li <?php if($title_tag1 == 'adduser') echo 'class="active"'; ?>><a href="add_user"><span class="fa fa-eye"></span>Add User</a></li>

                                   
									 
									 
                                </ul>
                            </li>
							<?php  }?>
			<!--fa-book-->
                            
			<li class="xn-openable <?php if($title_tag == 'book') echo "active"; ?>" >
                                <a href="#"><span  class="fa fa-book"></span> <span class="xn-text">Books</span></a>
                                <ul>
								
						
								
                                   <li <?php if($title_tag1 == 'audio') echo 'class="active"'; ?>><a href="audio_book"><span class="fa fa-file-audio-o"></span>Audio Books</a></li>
                                    <li <?php if($title_tag1 == 'simple') echo 'class="active"'; ?>><a href="simple_book"><span class="fa fa-book"></span>E-Books</a></li>
									<li <?php if($title_tag1 == 'addbook') echo 'class="active"'; ?>><a href="add_book"><span class="fa fa-plus"></span>Add Books</a></li>
                                   
									 
									 
                                </ul>
                            </li>
                            <li <?php if($title_tag == 'category') echo 'class="active"'; ?>>
                        <a href="category"><span class="fa fa-tags"></span> <span class="xn-text">Category</span></a>                        
                    </li>
					<?php if($_SESSION['admin_type']==0) {?>
					 <li <?php if($title_tag == 'auther') echo 'class="active"'; ?>>
                        <a href="auther"><span class="fa fa-male"></span> <span class="xn-text">Author</span></a>                        
                    </li>
					<?php } ?>
                            
							<li class="xn-openable <?php if($title_tag == 'cal') echo "active"; ?>"  >
                                <a href="#"><span class="fa fa fa-cogs"></span> <span class="xn-text">Setting</span></a>
                                <ul>
								
						
								 <li <?php if($title_tag1 == 'profile') echo 'class="active"'; ?>> <a href="profile"><span class="fa fa-user"></span>Profile</a></li>

                                   <li <?php if($title_tag1 == 'changepassword') echo 'class="active"'; ?>><a href="changepassword"><span class="fa fa-key" ></span>Change password</a></li>
                                    <li <?php if($title_tag1 == 'email') echo 'class="active"'; ?>><a href="changeemail"><span class="fa fa-envelope"></span>Change Email</a></li>

                                   
									 
									  <li <?php if($title_tag == 'cal5') echo 'class="active"'; ?>><a href="logout"><span class="fa fa-sign-in"></span>Logout</a></li>
                                   
                                </ul>
                            </li>
							
							
							
							
                    
                </ul>
