<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$query = $this->db->query('SELECT * FROM setting WHERE status=1');
$app = $query->row();
?>

<div id="top-content" class="container-fluid">
	<div class="container">
		<div class="row">
			<div class="col-md-12 text-center">
				<div id="main-slider">
					<?php
					foreach ($slide_data as $slide)
					{
						?>
						<div class="slide info-slide<?php echo $slide->id_setting_slide ?>" title="<?php echo $slide->name ?>">
							<div class="image-holder"><img src="<?php echo base_url(); ?>assets/uploads/slide/big/<?php echo $slide->image ?>" alt="<?php echo $slide->name ?>" class="img-responsive" /></div>
							<div class="text-holder txt"><?php echo $slide->description ?></div>
						</div>
						<?php
					}
					?>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="info" class="container-fluid">
	<canvas id="infobg" data-paper-resize="true"></canvas>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="row-title"><?php echo $app->name; ?></div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="info-text"><?php echo $app->description; ?></div>

				<a href="#more-features" class="white-green-shadow-button">Layanan</a>
			</div>
		</div>
	</div>
</div>


<div id="more-features" class="container-fluid">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="row-title">Orientasi Layanan</div>
			</div>
		</div>
		<div class="row">
			<?php
			foreach ($services_data as $services)
			{
				?>
				<div class="col-sm-6 col-md-4">
					<div class="mfeature-box">
						<div class="mfeature-icon">
							<div class="icon-bg"><img src="<?php echo base_url(); ?>assets/frontend/images/cloud-light.png" alt="<?php echo $services->name ?>" /></div>
							<div class="icon-img">
								<img src="<?php echo base_url(); ?>assets/uploads/services/big/<?php echo $services->image ?>" alt="<?php echo $services->name ?>">
							</div>
						</div>
						<div class="mfeature-title"><?php echo $services->name ?></div>
						<div class="mfeature-details"><?php echo $services->description ?></div>
					</div>
				</div>
				<?php
			}
			?>
		</div>
	</div>
</div>





