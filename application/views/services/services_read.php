
<h2 style="margin-top:0px">Detail Services</h2>
<a href="<?php echo site_url('services/create') ?>" class="btn btn-primary">Add Services</a>
<a href="<?php echo site_url('services/index') ?>" class="btn btn-primary"> Manage Services</a>
<HR>
	<table class="table">
	    <tr><td>Name</td><td><?php echo $name; ?></td></tr>
	    <tr><td>Image</td><td><?php echo $image; ?></td></tr>
	    <tr><td>Icon</td><td><?php echo $icon; ?></td></tr>
	    <tr><td>Description</td><td><?php echo $description; ?></td></tr>
	    <tr><td>Status</td><td><?php echo $status; ?></td></tr>
	</table>
		