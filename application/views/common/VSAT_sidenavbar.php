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
					<a href="<?php echo base_url('Vsat/daily-status'); ?>" class="nav-link <?php if($this->uri->segment('2') == 'daily-status') { echo "active"; }?>">
						<i class="nav-icon far fa-circle text-warning"></i>
						<p class="text">DAILY STATUS</p>
					</a>
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
							<a href="<?php echo base_url('Vsat/report/today-activity');?>" class="nav-link <?php if($this->uri->segment('3') == 'today-activity') { echo "active"; }?>">
								<i class="far fa-circle nav-icon"></i>
								<p>TODAY'S ACTIVITY</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo base_url('Vsat/report/location-wise');?>" class="nav-link <?php if( $this->uri->segment('3') =='location-wise') { echo "active"; }?>">
								<i class="far fa-circle nav-icon"></i>
								<p>LOCATION WISE</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo base_url('Vsat/report/all-report');?>" class="nav-link <?php if($this->uri->segment('3') == 'all-report') { echo "active"; }?>">
								<i class="far fa-circle nav-icon"></i>
								<p>ALL REPORT</p>
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