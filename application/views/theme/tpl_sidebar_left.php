<?php
$posts = $this->db->query('SELECT count(id_post) as totalPost FROM post WHERE status=1');
$post = $posts->row();

$users = $this->db->query('SELECT count(id_user) as totalUser FROM user WHERE status=1');
$user = $users->row();
?>
<!-- sidebar panel -->
<div class="sidebar-panel offscreen-left">
  <div class="brand">
    <!-- toggle small sidebar menu -->
    <a href="<?php echo base_url(); ?>javascript:;" class="toggle-apps hidden-xs" data-toggle="quick-launch">
      <i class="icon-grid"></i>
    </a>
    <!-- /toggle small sidebar menu -->
    <!-- toggle offscreen menu -->
    <div class="toggle-offscreen">
      <a href="<?php echo base_url(); ?>javascript:;" class="visible-xs hamburger-icon" data-toggle="offscreen" data-move="ltr">
        <span></span>
        <span></span>
        <span></span>
      </a>
    </div>
    <!-- /toggle offscreen menu -->
    <!-- logo -->
    <a class="brand-logo">
      <span><?php echo $app->name; ?></span>
    </a>
    <a href="#" class="small-menu-visible brand-logo">R</a>
    <!-- /logo -->
  </div>
  <ul class="quick-launch-apps hide">
    <li>
      <a href="<?php echo base_url(); ?>user/index">
        <span class="app-icon bg-danger text-white">
          A
        </span>
        <span class="app-title">Account</span>
      </a>
    </li>
    <li>
      <a href="<?php echo base_url(); ?>post/index">
        <span class="app-icon bg-success text-white">
          P
        </span>
        <span class="app-title">Post</span>
      </a>
    </li>
    <li>
      <a href="<?php echo base_url(); ?>division/index">
        <span class="app-icon bg-primary text-white">
          D
        </span>
        <span class="app-title">Division</span>
      </a>
    </li>
    <li>
      <a href="<?php echo base_url(); ?>category/index">
        <span class="app-icon bg-info text-white">
          C
        </span>
        <span class="app-title">Category</span>
      </a>
    </li>
  </ul>
  <!-- main navigation -->
  <nav role="navigation">
    <ul class="nav">

      <!-- dashboard -->
      <li>
        <a href="<?php echo base_url(); ?>dashboard">
          <i class="icon-compass"></i>
          <span>Dashboard</span>
        </a>
      </li>

      <!-- /view site -->
      <li>
        <a href="<?php echo base_url(); ?>site" target="_BLANK">
          <i class="icon-screen-desktop"></i>
          <span>Lihat Situs</span>
        </a>
      </li>


      <?php
      $level = $this->session->userdata('level');
      if($level==1){
        ?>

        <li>
          <a href="#">
            <span class="badge pull-right"><?php echo $post->totalPost; ?></span>
            <i class="icon-note"></i>
            <span>Post</span>
          </a>
          <ul class="sub-menu">
            <li>
              <a href="<?php echo base_url(); ?>post/create">
                <span>New</span>
              </a>
            </li>
            <li>
              <a href="<?php echo base_url(); ?>post/index">
                <span>Manage</span>
              </a>
            </li>
          </ul>
        </li>

        <li>
          <a href="#">
            <span class="badge pull-right"><?php echo $user->totalUser; ?></span>
            <i class="icon-users"></i>
            <span>Account</span>
          </a>
          <ul class="sub-menu">
            <li>
              <a href="<?php echo base_url(); ?>user/create">
                <span>New</span>
              </a>
            </li>
            <li>
              <a href="<?php echo base_url(); ?>user/index">
                <span>Manage</span>
              </a>
            </li>
            <li>
              <a href="<?php echo base_url(); ?>user/log">
                <span>Log</span>
              </a>
            </li>              
          </ul>
        </li>

        <li>
          <a href="#">
            <i class="icon-layers"></i>
            <span>Configuration</span>
          </a>
          <ul class="sub-menu">       
            <li>
              <a href="<?php echo base_url(); ?>testimony/index">
                <span>Testimony</span>
              </a>
            </li>            
            <li>
              <a href="<?php echo base_url(); ?>services/index">
                <span>Services</span>
              </a>
            </li>
            <li>
              <a href="<?php echo base_url(); ?>slide/index">
                <span>Slide</span>
              </a>
            </li>                            
          </ul>
        </li>          
        <!-- /cards -->

        <li>
          <a href="#">
            <i class="icon-layers"></i>
            <span>Master</span>
          </a>
          <ul class="sub-menu">       
            <li>
              <a href="<?php echo base_url(); ?>category/index">
                <span>Category</span>
              </a>
            </li>  
            <li>
              <a href="<?php echo base_url(); ?>tag/index">
                <span>Tag</span>
              </a>
            </li>                          
            <li>
              <a href="<?php echo base_url(); ?>division/index">
                <span>Division</span>
              </a>
            </li>
            <li>
              <a href="<?php echo base_url(); ?>setting/index">
                <span>Organization</span>
              </a>
            </li>                          
          </ul>
        </li>          
        <!-- /cards -->


        <?php }elseif($level==2){ ?>

          <li>
            <a href="#">
              <span class="badge pull-right">4</span>
              <i class="icon-users"></i>
              <span>Account</span>
            </a>
            <ul class="sub-menu">
              <li>
                <a href="<?php echo base_url(); ?>user/create">
                  <span>New</span>
                </a>
              </li>
              <li>
                <a href="<?php echo base_url(); ?>user/index">
                  <span>Manage</span>
                </a>
              </li>
              <li>
                <a href="<?php echo base_url(); ?>user/log">
                  <span>Log</span>
                </a>
              </li>              
            </ul>
          </li>


          <?php }else{ ?>  


            <li>
              <a href="#">
                <span class="badge pull-right">4</span>
                <i class="icon-note"></i>
                <span>Post</span>
              </a>
              <ul class="sub-menu">
                <li>
                  <a href="<?php echo base_url(); ?>post/create">
                    <span>New</span>
                  </a>
                </li>
                <li>
                  <a href="<?php echo base_url(); ?>post/index">
                    <span>Manage</span>
                  </a>
                </li>
              </ul>
            </li>

            <?php } ?>  

          </ul>
        </nav>
        <!-- /main navigation -->
      </div>
    <!-- /sidebar panel -->