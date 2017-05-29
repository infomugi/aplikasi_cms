<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$details = json_decode(file_get_contents("http://ipinfo.io/"));
$accounts = $this->db->query('SELECT * FROM user WHERE id_user='.$this->session->userdata('id'));
$account = $accounts->row();
?>
<div ng-controller="widgetsController">
	<div class="row">

		<div class="col-lg-12">
			<div class="card card-inverse bg-bluegrey text-white text-center">
				<div class="card-block">
					<div class="clearfix">
						<div class="pull-right"><?php echo $details->ip; ?></div>
						<div class="pull-left"><?php echo $details->country; ?> - <?php echo $details->org; ?></div>
					</div>
					<img src="<?php echo base_url(); ?>assets/uploads/avatar/middle/<?php echo $account->image; ?>" alt="<?php echo $account->fullname; ?>" class="img-thumbnail img-circle" title="<?php echo $account->fullname; ?>">
					<h5><?php echo $account->fullname; ?></h5>
					<p><i class="icon-pointer"></i> <?php echo $details->city; ?> </p>
					<div class="clearfix">
						<div class="pull-right">Terakhir <span class="format-date"><?php echo $account->visit_time; ?></span></div>
						<div class="pull-left"><?php echo $details->region; ?></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="row">
				<div class="col-md-6">
					<div class="card card-block b-a-0 bg-teal text-white">
						<div class="card-circle-bg-icon"> <i class="icon-cup"></i> </div>
						<div class="h4 m-a-0">4,894K</div>
						<div>Cups of coffee</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="card card-block b-a-0 bg-purple text-white">
						<div class="card-circle-bg-icon"> <i class="icon-tag"></i> </div>
						<div class="h4 m-a-0">4,894K</div>
						<div>Sales products</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="card card-block b-a-0 bg-blue text-white">
						<div class="card-circle-bg-icon"> <i class="icon-settings"></i> </div>
						<div class="h4 m-a-0">494</div>
						<div>Items fixed</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="card card-block b-a-0 bg-cyan text-white">
						<div class="card-circle-bg-icon"> <i class="icon-cloud-upload"></i> </div>
						<div class="h4 m-a-0">4,894K</div>
						<div>Files synced</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="row">
				<div class="col-md-6">
					<div class="card card-block no-border bg-primary text-white">
						<h6 class="m-a-0">NEW USERS</h6>
						<h3 class="m-a-0">785</h3>
					</div>
				</div>
				<div class="col-md-6">
					<div class="card card-block no-border bg-dark text-white">
						<h6 class="m-a-0">PAGE VIEWS</h6>
						<h3 class="m-a-0">381</h3>
					</div>
				</div>
				<div class="col-md-6">
					<div class="card card-block no-border bg-red text-white">
						<h6 class="m-a-0">NEW USERS</h6>
						<h3 class="m-a-0">785</h3>
					</div>
				</div>
				<div class="col-md-6">
					<div class="card card-block no-border bg-indigo text-white">
						<h6 class="m-a-0">PAGE VIEWS</h6>
						<h3 class="m-a-0">381</h3>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>