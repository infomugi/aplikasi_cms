
<h2 style="margin-top:0px">Detail Category</h2>
<a href="<?php echo site_url('category/create') ?>" class="btn btn-primary">Add Category</a>
<a href="<?php echo site_url('category/index') ?>" class="btn btn-primary"> Manage Category</a>
<HR>
	<table class="table">
	    <tr><td>Name</td><td><?php echo $name; ?></td></tr>
	    <tr><td>Icon</td><td><?php echo $icon; ?></td></tr>
	    <tr><td>Image</td><td><?php echo $image; ?></td></tr>
	    <tr><td>Url</td><td><?php echo $url; ?></td></tr>
	    <tr><td>Status</td><td><?php echo $status; ?></td></tr>
	</table>
		