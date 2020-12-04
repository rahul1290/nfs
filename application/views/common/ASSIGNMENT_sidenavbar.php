<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo base_url();?>" class="brand-link">
      <img src="<?php echo base_url('assets/images/ibc_logo.png');?>"
           alt="NEWSFLOW"
           class="brand-image elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">NEWSFLOW</span>
    </a>

    	<div class="sidebar">
          <!-- Sidebar user (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
    			<a href="<?php echo base_url('Auth/profile'); ?>">
    					<?php 
    					if($this->session->userdata('profile_pic') == ''){ ?>
    						<img class="profile-user-img img-fluid img-circle" src="<?php echo base_url('assets/images/avatar.png');?>" alt="User profile picture">
    					<?php } else {  ?>
    						<img src="<?php echo base_url('assets/');?><?php echo $this->session->userdata('role')?>/<?php echo $this->session->userdata('profile_pic'); ?>" class="img-circle elevation-2" alt="User Image">
    					<?php } ?>
    			</a>
            </div>
            <div class="info">
              <a href="<?php echo base_url('Auth/profile'); ?>" class="d-block">
              	<?php echo $this->session->userdata('username'); ?>
              	<p><small>(<?php echo $this->session->userdata('role'); ?>)</small></p>
              </a>
            </div>
          </div>
    
          <!-- Sidebar Menu -->
          <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">            	
				<li class="nav-item">
						<a href="<?php echo base_url('Assignment/Daily-Feed-Status/CG/green/MP/green'); ?>" class="nav-link <?php if($this->uri->segment('2') == 'Daily-Feed-Status') { echo "active"; }?>">
                        	<i class="nav-icon far fa-circle text-warning"></i>
                          	<p class="text">DAILY FEED STATUS</p>
                        </a>
                  	</li>
                  	<li class="nav-item">
                    	<a href="<?php echo base_url('Assignment/Story-File-Entry'); ?>" class="nav-link <?php if($this->uri->segment('2') == 'Story-File-Entry') { echo "active"; }?>">
                        	<i class="nav-icon far fa-circle text-warning"></i>
                          	<p class="text">STORY FILE ENTRY</p>
                        </a>
                  	</li>
                  	<li class="nav-item has-treeview <?php if($this->uri->segment('2') == 'story-idea') { echo "menu-open"; }?>">
                    	<a href="#" class="nav-link">
                        	<i class="nav-icon fas fa-chart-pie"></i>
                          	<p>STORY IDEA
                            	<i class="right fas fa-angle-left"></i>
                          	</p>
                       	</a>
                    	<ul class="nav nav-treeview">
                        	<li class="nav-item">
                            	<a href="<?php echo base_url('Assignment/story-idea/today-activity');?>" class="nav-link <?php if($this->uri->segment('3') == 'today-activity') { echo "active"; }?>">
                              		<i class="far fa-circle nav-icon"></i>
                              		<p>TODAY'S ACTIVITY</p>
                            	</a>
                          	</li>
                          	<li class="nav-item">
                            	<a href="<?php echo base_url('Assignment/story-idea/yesterday-dashboard');?>" class="nav-link <?php if($this->uri->segment('3') == 'yesterday-dashboard') { echo "active"; }?>">
                              		<i class="far fa-circle nav-icon"></i>
                              		<p>YESTERDAY'S DASHBOARD</p>
                            	</a>
                          	</li>
                          	<li class="nav-item">
                            	<a href="<?php echo base_url('Assignment/story-idea/all-report');?>" class="nav-link <?php if($this->uri->segment('2') == 'story-idea' && $this->uri->segment('3') == 'all-report') { echo "active"; }?>">
                              		<i class="far fa-circle nav-icon"></i>
                              		<p>ALL REPORT</p>
                            	</a>
                          	</li>
                        </ul>
                   	</li>
                  	
                  	<li class="nav-item has-treeview <?php if($this->uri->segment('2') == 'report') { echo "menu-open"; }?>">
                    	<a href="#" class="nav-link">
                       		<i class="nav-icon fas fa-chart-pie"></i>
                          	<p>REPORTS
                            	<i class="right fas fa-angle-left"></i>
                          	</p>
                        </a>
                    	<ul class="nav nav-treeview">
                        	<li class="nav-item">
                            	<a href="<?php echo base_url('Assignment/report/today-activity');?>" class="nav-link <?php if($this->uri->segment('3') == 'today-activity' || $this->uri->segment('3') == 'scriptFileReport') { echo "active"; }?>">
                              		<i class="far fa-circle nav-icon"></i>
                              		<p>TODAY'S ACTIVITY</p>
                            	</a>
                          	</li>
                          	<li class="nav-item">
                            	<a href="<?php echo base_url('Report/scriptFile');?>" class="nav-link <?php if($this->uri->segment('2') == 'scriptFile') { echo "active"; }?>">
                              		<i class="far fa-circle nav-icon"></i>
                              		<p>DAILY AGENDA</p>
                            	</a>
                          	</li>
                          	<li class="nav-item">
                            	<a href="<?php echo base_url('Assignment/report/all-report');?>" class="nav-link <?php if($this->uri->segment('2') == 'report' && $this->uri->segment('3') == 'all-report') { echo "active"; }?>">
                              		<i class="far fa-circle nav-icon"></i>
                              		<p>ALL REPORT</p>
                            	</a>
                          	</li>
                          	<li class="nav-item">
                            	<a href="<?php echo base_url('Assignment/report/reporter-summary');?>" class="nav-link <?php if(($this->uri->segment('2') == 'report' && $this->uri->segment('3') == 'reporter-summary') || $this->uri->segment('3') == 'reporter') { echo "active"; }?>">
                              		<i class="far fa-circle nav-icon"></i>
                              		<p>REPORTER</p>
                            	</a>
                          	</li>
                          	<li class="nav-item">
                            	<a href="<?php echo base_url('Assignment/report/stringer-summary');?>" class="nav-link <?php if($this->uri->segment('3') == 'stringer-summary') { echo "active"; }?>">
                              		<i class="far fa-circle nav-icon"></i>
                              		<p>STRINGER</p>
                            	</a>
                          	</li>
                          	<li class="nav-item">
                            	<a href="<?php echo base_url('Report/scriptFileReport');?>" class="nav-link <?php if($this->uri->segment('2') == 'scriptFileReport') { echo "active"; }?>">
                              		<i class="far fa-circle nav-icon"></i>
                              		<p>SWARNA SHARDA</p>
                            	</a>
                          	</li>
                        </ul>
                    </li>
              <br/>
              <li class="nav-item">
                <a href="<?php echo base_url('Auth/logout'); ?>" class="nav-link">
                  <i class="nav-icon far fa-circle text-danger"></i>
                  <p class="text">LogOut</p>
                </a>
              </li>
            </ul>
          </nav>
          <!-- /.sidebar-menu -->
        </div>
  </aside>