<?php 
$pwn=new user();
  $row=$pwn->admin_detail();
?>


<ul class="x-navigation">
                    <li class="xn-logo">
                        <a href="dashboard.php">Add Chat</a>
                        <a href="" class="x-navigation-control"></a>
                    </li>
                    <li class="xn-profile">
                        <a href="" class="profile-mini">
                            <img src="assets/images/users/avatar.jpg" alt="John Doe"/>
                        </a>
                        <div class="profile">
                            <div class="profile-image">
                                <img src="<?php echo $row['image']; ?>" alt="John Doe"/>
                            </div>
                            <div class="profile-data">
                                <div class="profile-data-name"><?php echo $row['name']; ?></div>
                                <div class="profile-data-title">Admin</div>
                            </div>
                            <div class="profile-controls">
                                <a href="profile.php" class="profile-control-left"><span class="fa fa-info"></span></a>
                                <a href="#" class="profile-control-right"><span class="fa fa-envelope"></span></a>
                            </div>
                        </div>                                                                        
                    </li>
                    <li class="xn-title">Navigation</li>
                    <li <?php if($title_tag == 'Dashboard') echo 'class="active"'; ?>>
                        <a href="dashboard.php"><span class="fa fa-desktop"></span> <span class="xn-text">Dashboard</span></a>                        
                    </li>
                    <li <?php if($title_tag == 'student') echo 'class="active"'; ?> >
                        <a href="user.php"><span class="fa fa-users"></span> <span class="xn-text">All Users</span></a>                        
                    </li>
					
					<!-- <li class="xn-openable" <?php if($title_tag == 'cat') echo 'class="active"'; ?>>
                                <a href="#"><span class="fa fa-tasks"></span> Category & Sport</a>
                                <ul>
                                    <li <?php if($title_tag == 'sport') echo 'class="active"'; ?>><a href="cat"><span class="fa fa-hand-o-right"></span>Category List</a></li>
                                    
				     <li <?php if($title_tag == 'country') echo 'class="active"'; ?>><a href="sport"><span class="fa fa-dribbble"></span>Sport List</a></li>
                                    
                                   
                                </ul>
                            </li> -->
					
				<!-- 	
					<li class="xn-openable" <?php if($title_tag == 'country') echo 'class="active"'; ?>>
                                <a href="#"><span class="fa fa-sitemap"></span> Items</a>
                                <ul>
                                    <!-- <li <?php if($title_tag == 'country') echo 'class="active"'; ?>><a href="additem"><span class="fa fa-plus-square"></span>Add Item</a></li> -->
                                    <!-- <li><a href="itemlist"><span class="fa fa-file-text"></span> Item List</a></li> -->
                                   
                               <!--  </ul>
 -->                            <!-- </li> 
                             <li <?php if($title_tag == 'sales') echo 'class="active"'; ?> >
                        <a href="sales"><span class="fa fa-users"></span> <span class="xn-text">Sales</span></a>                        
                    </li>
                     <li <?php if($title_tag == 'country') echo 'class="active"'; ?> >
                        <a href="country"><span class="fa fa-users"></span> <span class="xn-text">Country's List</span></a>                        
                    </li> -->
							
							
							
							<!-- <li <?php if($title_tag == 'charity') echo 'class="active"'; ?>>
                                <a href="charity"><span class="fa fa-inbox"></span>Charity</a>
                            </li>
							
							
							 <li class="xn-openable" <?php if($title_tag == 'Refund_Payment') echo 'class="active"'; ?>>
                                <a href="refundpayment"><span class="fa fa-rss-square"></span>Refund payment</a>
                            </li> -->
					<!-- 		<li class="xn-openable" <?php if($title_tag == 'tranx') echo 'class="active"'; ?>>
                                <a href="#"><span class="fa fa-exchange"></span>Transaction </a>
                                <ul>
                                    <li <?php if($title_tag == 'tranx') echo 'class="active"'; ?>><a href="transfers"><span class="fa fa-rss-square"></span>Transfers</a></li> -->
                                  <!--   <li <?php if($title_tag == 'tranx') echo 'class="active"'; ?>><a href="blocktrxn"><span class="fa fa-stop"></span>Blocked Transaction</a></li>
									<li <?php if($title_tag == 'tranx') echo 'class="active"'; ?>><a href="complete"><span class="fa fa-list"></span>Complete Transaction</a></li> -->
                                <!--    
                                </ul>
                            </li> -->
							<!-- <li class="xn-openable" <?php if($title_tag == 'lang') echo 'class="active"'; ?>>
                                <a href="#"><span class="fa fa-language"></span> Language</a>
                                <ul>
                                    <li <?php if($title_tag == 'lang') echo 'class="active"'; ?>><a href="addlanguage"><span class="fa fa-plus-square"></span>Add Language</a></li>
                                    <li <?php if($title_tag == 'lang') echo 'class="active"'; ?>><a href="language"><span class="fa fa-list"></span>Language List</a></li>
                                   
                                </ul>
                            </li>
							<li class="xn-openable" <?php if($title_tag == 'cal') echo 'class="active"'; ?>>
                                <a href="#"><span class="fa fa-cog"></span> Conversion Calculator</a>
                                <ul>
                                   <li <?php if($title_tag == 'cal') echo 'class="active"'; ?>><a href="ihave"><span class="fa fa-cog"></span>I Have</a></li>
                                    <li <?php if($title_tag == 'cal') echo 'class="active"'; ?>><a href="iwant"><span class="fa fa-cog"></span>I want</a></li>
                                   
                                </ul>
                            </li> -->
							
							<li class="xn-openable" <?php if($title_tag == 'cal') echo 'class="active"'; ?>>
                                <a href="#"><span class="fa fa-cogs"></span> Setting</a>
                                <ul>
								
						<!-- 		<li <?php if($title_tag == 'cal') echo 'class="active"'; ?>><a href="profile"><span class="fa fa-user"></span>Profile</a></li>
                                <li <?php if($title_tag == 'cal') echo 'class="active"'; ?>><a href="status"><span class="fa fa-user"></span>Shipment</a></li> -->
								
                                   <li <?php if($title_tag == 'cal') echo 'class="active"'; ?>><a href="changepassword.php"><span class="fa fa-cog fa-spin fa-3x fa-fw"></span>Change password</a></li>
                                    <li <?php if($title_tag == 'cal') echo 'class="active"'; ?>><a href="changeemail.php"><span class="fa fa-cog fa-spin fa-3x fa-fw"></span>Change Email</a></li>

                                    <!-- <li <?php if($title_tag == 'cal') echo 'class="active"'; ?>><a href="commision"><span class="fa fa-cog fa-spin fa-3x fa-fw"></span>Commision</a></li>


                                    <li <?php if($title_tag == 'cal') echo 'class="active"'; ?>><a href="verification"><span class="fa fa-cog fa-spin fa-3x fa-fw"></span>Verification Request</a></li>
                                     -->
									 
									  <li <?php if($title_tag == 'cal') echo 'class="active"'; ?>><a href="logout.php"><span class="fa fa-sign-in"></span>Logout</a></li>
                                   
                                </ul>
                            </li>
							
							
							
							
							<!--
							<li class="xn-openable" <?php if($title_tag == 'cal') echo 'class="active"'; ?>>
                                <a href="#"><span class="fa fa-calculator"></span>Conversion Calculator</a>
                                <ul>
                                    <li <?php if($title_tag == 'lang') echo 'class="active"'; ?>><a href="#"><span class="fa fa-calculator"></span>I Have</a></li>
                                    <li <?php if($title_tag == 'lang') echo 'class="active"'; ?>><a href="#"><span class="fa fa-calculator"></span>I want</a></li>
                                   
                                </ul>
                            </li>
							-->
							
							
							
              <!--      <li class="xn-openable">
                        <a href="#"><span class="fa fa-files-o"></span> <span class="xn-text">Pages</span></a>
                        <ul>
                            <li><a href="pages-gallery.html"><span class="fa fa-image"></span> Gallery</a></li>
                            <li><a href="pages-profile.html"><span class="fa fa-user"></span> Profile</a></li>
                            <li><a href="pages-address-book.html"><span class="fa fa-users"></span> Address Book</a></li>
                            <li class="xn-openable">
                                <a href="#"><span class="fa fa-clock-o"></span> Timeline</a>
                                <ul>
                                    <li><a href="pages-timeline.html"><span class="fa fa-align-center"></span> Default</a></li>
                                    <li><a href="pages-timeline-simple.html"><span class="fa fa-align-justify"></span> Full Width</a></li>
                                </ul>
                            </li>
                            <li class="xn-openable">
                                <a href="#"><span class="fa fa-envelope"></span> Mailbox</a>
                                <ul>
                                    <li><a href="pages-mailbox-inbox.html"><span class="fa fa-inbox"></span> Inbox</a></li>
                                    <li><a href="pages-mailbox-message.html"><span class="fa fa-file-text"></span> Message</a></li>
                                    <li><a href="pages-mailbox-compose.html"><span class="fa fa-pencil"></span> Compose</a></li>
                                </ul>
                            </li>
                            <li><a href="pages-messages.html"><span class="fa fa-comments"></span> Messages</a></li>
                            <li><a href="pages-calendar.html"><span class="fa fa-calendar"></span> Calendar</a></li>
                            <li><a href="pages-tasks.html"><span class="fa fa-edit"></span> Tasks</a></li>
                            <li><a href="pages-content-table.html"><span class="fa fa-columns"></span> Content Table</a></li>
                            <li><a href="pages-faq.html"><span class="fa fa-question-circle"></span> FAQ</a></li>
                            <li><a href="pages-search.html"><span class="fa fa-search"></span> Search</a></li>
                            <li class="xn-openable">
                                <a href="#"><span class="fa fa-file"></span> Blog</a>
                                
                                <ul>                                    
                                    <li><a href="pages-blog-list.html"><span class="fa fa-copy"></span> List of Posts</a></li>
                                    <li><a href="pages-blog-post.html"><span class="fa fa-file-o"></span>Single Post</a></li>
                                </ul>
                            </li>
                            <li class="xn-openable">
                                <a href="#"><span class="fa fa-sign-in"></span> Login</a>
                                <ul>                                    
                                    <li><a href="pages-login.html">App Login</a></li>
                                    <li><a href="pages-login-website.html">Website Login</a></li>
                                    <li><a href="pages-login-website-light.html"> Website Login Light</a></li>
                                </ul>
                            </li>
                            <li class="xn-openable">
                                <a href="#"><span class="fa fa-warning"></span> Error Pages</a>
                                <ul>                                    
                                    <li><a href="pages-error-404.html">Error 404 Sample 1</a></li>
                                    <li><a href="pages-error-404-2.html">Error 404 Sample 2</a></li>
                                    <li><a href="pages-error-500.html"> Error 500</a></li>
                                </ul>
                            </li>                            
                        </ul>
                    </li>
                    <li class="xn-openable">
                        <a href="#"><span class="fa fa-file-text-o"></span> <span class="xn-text">Layouts</span></a>
                        <ul>
                            <li><a href="layout-boxed.html">Boxed</a></li>
                            <li><a href="layout-nav-toggled.html">Navigation Toggled</a></li>
                            <li><a href="layout-nav-top.html">Navigation Top</a></li>
                            <li><a href="layout-nav-right.html">Navigation Right</a></li>
                            <li><a href="layout-nav-top-fixed.html">Top Navigation Fixed</a></li>                            
                            <li><a href="layout-nav-custom.html">Custom Navigation</a></li>
                            <li><a href="layout-frame-left.html">Frame Left Column</a></li>
                            <li><a href="layout-frame-right.html">Frame Right Column</a></li>
                            <li><a href="layout-search-left.html">Search Left Side</a></li>
                            <li><a href="blank.html">Blank Page</a></li>
                        </ul>
                    </li>
                    <li class="xn-title">Components</li>
                    <li class="xn-openable">
                        <a href="#"><span class="fa fa-cogs"></span> <span class="xn-text">UI Kits</span></a>                        
                        <ul>
                            <li><a href="ui-widgets.html"><span class="fa fa-heart"></span> Widgets</a></li>                            
                            <li><a href="ui-elements.html"><span class="fa fa-cogs"></span> Elements</a></li>
                            <li><a href="ui-buttons.html"><span class="fa fa-square-o"></span> Buttons</a></li>                            
                            <li><a href="ui-panels.html"><span class="fa fa-pencil-square-o"></span> Panels</a></li>
                            <li><a href="ui-icons.html"><span class="fa fa-magic"></span> Icons</a><div class="informer informer-warning">+679</div></li>
                            <li><a href="ui-typography.html"><span class="fa fa-pencil"></span> Typography</a></li>
                            <li><a href="ui-portlet.html"><span class="fa fa-th"></span> Portlet</a></li>
                            <li><a href="ui-sliders.html"><span class="fa fa-arrows-h"></span> Sliders</a></li>
                            <li><a href="ui-alerts-popups.html"><span class="fa fa-warning"></span> Alerts & Popups</a></li>                            
                            <li><a href="ui-lists.html"><span class="fa fa-list-ul"></span> Lists</a></li>
                            <li><a href="ui-tour.html"><span class="fa fa-random"></span> Tour</a></li>
                        </ul>
                    </li>                    
                    <li class="xn-openable">
                        <a href="#"><span class="fa fa-pencil"></span> <span class="xn-text">Forms</span></a>
                        <ul>
                            <li>
                                <a href="form-layouts-two-column.html"><span class="fa fa-tasks"></span> Form Layouts</a>
                                <div class="informer informer-danger">New</div>
                                <ul>
                                    <li><a href="form-layouts-one-column.html"><span class="fa fa-align-justify"></span> One Column</a></li>
                                    <li><a href="form-layouts-two-column.html"><span class="fa fa-th-large"></span> Two Column</a></li>
                                    <li><a href="form-layouts-tabbed.html"><span class="fa fa-table"></span> Tabbed</a></li>
                                    <li><a href="form-layouts-separated.html"><span class="fa fa-th-list"></span> Separated Rows</a></li>
                                </ul> 
                            </li>
                            <li><a href="form-elements.html"><span class="fa fa-file-text-o"></span> Elements</a></li>
                            <li><a href="form-validation.html"><span class="fa fa-list-alt"></span> Validation</a></li>
                            <li><a href="form-wizards.html"><span class="fa fa-arrow-right"></span> Wizards</a></li>
                            <li><a href="form-editors.html"><span class="fa fa-text-width"></span> WYSIWYG Editors</a></li>
                            <li><a href="form-file-handling.html"><span class="fa fa-floppy-o"></span> File Handling</a></li>
                        </ul>
                    </li>
                    <li class="xn-openable">
                        <a href="tables.html"><span class="fa fa-table"></span> <span class="xn-text">Tables</span></a>
                        <ul>                            
                            <li><a href="table-basic.html"><span class="fa fa-align-justify"></span> Basic</a></li>
                            <li><a href="table-datatables.html"><span class="fa fa-sort-alpha-desc"></span> Data Tables</a></li>
                            <li><a href="table-export.html"><span class="fa fa-download"></span> Export Tables</a></li>                            
                        </ul>
                    </li>
                    <li class="xn-openable">
                        <a href="#"><span class="fa fa-bar-chart-o"></span> <span class="xn-text">Charts</span></a>
                        <ul>
                            <li><a href="charts-morris.html"><span class="xn-text">Morris</span></a></li>
                            <li><a href="charts-nvd3.html"><span class="xn-text">NVD3</span></a></li>
                            <li><a href="charts-rickshaw.html"><span class="xn-text">Rickshaw</span></a></li>
                            <li><a href="charts-other.html"><span class="xn-text">Other</span></a></li>
                        </ul>
                    </li>                    
                    <li>
                        <a href="maps.html"><span class="fa fa-map-marker"></span> <span class="xn-text">Maps</span></a>
                    </li>                    
                    <li class="xn-openable">
                        <a href="#"><span class="fa fa-sitemap"></span> <span class="xn-text">Navigation Levels</span></a>
                        <ul>                            
                            <li class="xn-openable">
                                <a href="#">Second Level</a>
                                <ul>
                                    <li class="xn-openable">
                                        <a href="#">Third Level</a>
                                        <ul>
                                            <li class="xn-openable">
                                                <a href="#">Fourth Level</a>
                                                <ul>
                                                    <li><a href="#">Fifth Level</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>                            
                        </ul>
                    </li>-->
                    
                </ul>
