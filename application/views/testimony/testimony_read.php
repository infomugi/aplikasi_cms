
<h2 style="margin-top:0px">Detail Testimony</h2>
<a href="<?php echo site_url('testimony/create') ?>" class="btn btn-primary">Add Testimony</a>
<a href="<?php echo site_url('testimony/index') ?>" class="btn btn-primary"> Manage Testimony</a>
<HR>
	<table class="table">
	    <tr><td>Name</td><td><?php echo $name; ?></td></tr>
	    <tr><td>Job</td><td><?php echo $job; ?></td></tr>
	    <tr><td>Company</td><td><?php echo $company; ?></td></tr>
	    <tr><td>Description</td><td><?php echo $description; ?></td></tr>
	    <tr><td>Status</td><td><?php echo $status; ?></td></tr>
	</table>
		