
<h2 style="margin-top:0px">Detail Slide</h2>
<a href="<?php echo site_url('slide/create') ?>" class="btn btn-primary">Add Slide</a>
<a href="<?php echo site_url('slide/index') ?>" class="btn btn-primary"> Manage Slide</a>
<HR>
	<table class="table">
		<tr><td>Name</td><td><?php echo $name; ?></td></tr>
		<tr><td>Description</td><td><?php echo $description; ?></td></tr>
		<tr><td>Image</td><td><?php echo $image; ?></td></tr>
		<tr><td>Status</td><td><?php echo $status; ?></td></tr>
	</table>
	