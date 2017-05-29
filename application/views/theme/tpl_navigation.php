<?php
$accounts = $this->db->query('SELECT * FROM user WHERE id_user='.$this->session->userdata('id'));
$account = $accounts->row();
?>

<!-- top header -->
<div class="header navbar">
  <div class="brand visible-xs">
    <!-- toggle offscreen menu -->
    <div class="toggle-offscreen">
      <a href="<?php echo base_url(); ?>javascript:;" class="hamburger-icon visible-xs" data-toggle="offscreen" data-move="ltr">
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
    <!-- /logo -->
  </div>
  <ul class="nav navbar-nav hidden-xs">
    <li>
      <a href="<?php echo base_url(); ?>javascript:;" class="small-sidebar-toggle ripple" data-toggle="layout-small-menu">
        <i class="icon-toggle-sidebar"></i>
      </a>
    </li>
    <li class="searchbox">
      <a href="<?php echo base_url(); ?>javascript:;" data-toggle="search">
        <i class="search-close-icon icon-close hide"></i>
        <i class="search-open-icon icon-magnifier"></i>
      </a>
    </li>
    <li class="navbar-form search-form hide">
      <input type="search" class="form-control search-input" placeholder="Start typing...">
      <div class="search-predict hide">
        <a href="<?php echo base_url(); ?>#">Searching for 'purple rain'</a>
        <div class="heading">
          <span class="title">People</span>
        </div>
        <ul class="predictive-list">
          <li>
            <a class="avatar" href="<?php echo base_url(); ?>#">
              <img src="<?php echo base_url(); ?>assets/images/face1.jpg" class="img-circle" alt="">
              <span>Tammy Carpenter</span>
            </a>
          </li>
          <li>
            <a class="avatar" href="<?php echo base_url(); ?>#">
              <img src="<?php echo base_url(); ?>assets/images/face2.jpg" class="img-circle" alt="">
              <span>Catherine Moreno</span>
            </a>
          </li>
          <li>
            <a class="avatar" href="<?php echo base_url(); ?>#">
              <img src="<?php echo base_url(); ?>assets/images/face3.jpg" class="img-circle" alt="">
              <span>Diana Robertson</span>
            </a>
          </li>
          <li>
            <a class="avatar" href="<?php echo base_url(); ?>#">
              <img src="<?php echo base_url(); ?>assets/images/face4.jpg" class="img-circle" alt="">
              <span>Emma Sullivan</span>
            </a>
          </li>
        </ul>
        <div class="heading">
          <span class="title">Page posts</span>
        </div>
        <ul class="predictive-list">
          <li>
            <a class="avatar" href="<?php echo base_url(); ?>#">
              <img src="<?php echo base_url(); ?>assets/images/unsplash/img2.jpeg" class="img-rounded" alt="">
              <span>The latest news for cloud-based developers </span>
            </a>
          </li>
          <li>
            <a class="avatar" href="<?php echo base_url(); ?>#">
              <img src="<?php echo base_url(); ?>assets/images/unsplash/img2.jpeg" class="img-rounded" alt="">
              <span>Trending Goods of the Week</span>
            </a>
          </li>
        </ul>
      </div>
    </li>
  </ul>
  <ul class="nav navbar-nav navbar-right hidden-xs">
    <li>
      <a href="<?php echo base_url(); ?>javascript:;" class="ripple" data-toggle="dropdown">
        <i class="icon-bell"></i>
      </a>
      <ul class="dropdown-menu notifications">
        <li class="notifications-header">
          <p class="text-muted small">You have 3 new messages</p>
        </li>
        <li>
          <ul class="notifications-list">
            <li>
              <a href="<?php echo base_url(); ?>javascript:;">
                <div class="notification-icon">
                  <div class="circle-icon bg-success text-white">
                    <i class="icon-bulb"></i>
                  </div>
                </div>
                <span class="notification-message"><b>Sean</b> launched a new application</span>
                <span class="time">2s</span>
              </a>
            </li>
            <li>
              <a href="<?php echo base_url(); ?>javascript:;">
                <div class="notification-icon">
                  <div class="circle-icon bg-danger text-white">
                    <i class="icon-cursor"></i>
                  </div>
                </div>
                <span class="notification-message"><b>Removed calendar</b> from app list</span>
                <span class="time">4h</span>
              </a>
            </li>
            <li>
              <a href="<?php echo base_url(); ?>javascript:;">
                <div class="notification-icon">
                  <div class="circle-icon bg-primary text-white">
                    <i class="icon-basket"></i>
                  </div>
                </div>
                <span class="notification-message"><b>Denise</b> bought <b>Urban Admin Kit</b></span>
                <span class="time">2d</span>
              </a>
            </li>
            <li>
              <a href="<?php echo base_url(); ?>javascript:;">
                <div class="notification-icon">
                  <div class="circle-icon bg-info text-white">
                    <i class="icon-bubble"></i>
                  </div>
                </div>
                <span class="notification-message"><b>Vincent commented</b> on an item</span>
                <span class="time">2s</span>
              </a>
            </li>
            <li>
              <a href="<?php echo base_url(); ?>javascript:;">
                <span class="notification-icon">
                  <img src="<?php echo base_url(); ?>assets/images/face3.jpg" class="avatar img-circle" alt="">
                </span>
                <span class="notification-message"><b>Jack Hunt</b> has <b>joined</b> mailing list</span>
                <span class="time">9d</span>
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </li>
    <li>
      <a href="#" class="ripple" data-toggle="dropdown">
        <img src="<?php echo base_url(); ?>assets/uploads/avatar/middle/<?php echo $account->image; ?>" class="header-avatar img-circle" alt="<?php echo $account->fullname; ?>" title="<?php echo $account->fullname; ?>">
        <span><?php echo $account->fullname; ?></span>
        <span class="caret"></span>
      </a>
      <ul class="dropdown-menu">
        <li>
          <a href="<?php echo base_url(); ?>user/setting">Edit Profile</a>
        </li>
        <li>
          <a href="<?php echo base_url(); ?>user/password">Change Password</a>
        </li>  
        <li>
          <a href="<?php echo base_url(); ?>user/avatar">Change Avatar</a>
        </li>                            
        <li role="separator" class="divider"></li>
        <li>
          <a href="<?php echo base_url(); ?>auth/logout">Logout</a>
        </li>
      </ul>
    </li>
    <li>
      <a href="<?php echo base_url(); ?>javascript:;" class="ripple" data-toggle="layout-chat-open">
        <i class="icon-user"></i>
      </a>
    </li>
  </ul>
</div>
      <!-- /top header -->