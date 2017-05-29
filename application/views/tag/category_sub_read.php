
<h2 style="margin-top:0px">Detail Tag</h2>
<a href="<?php echo site_url('tag/create') ?>" class="btn btn-primary">Add Tag</a>
<a href="<?php echo site_url('tag/index') ?>" class="btn btn-primary"> Manage Tag</a>
<HR>
	<table class="table">
		<tr><td>Category</td><td><?php echo $this->Category_model->view($category_id); ?></td></tr>
		<tr><td>Name</td><td><?php echo $name; ?></td></tr>
		<tr><td>Image</td><td><?php echo $image; ?></td></tr>
		<tr><td>Url</td><td><?php echo $url; ?></td></tr>
		<tr><td>Status</td><td><?php echo $status; ?></td></tr>
	</table>
