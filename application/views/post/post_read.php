<a href="<?php echo site_url('post/create') ?>" class="btn btn-primary">Add Post</a>
<a href="<?php echo site_url('post/index') ?>" class="btn btn-primary"> Manage Post</a>
<a href="<?php echo site_url("post/update/".$id_post) ?>" class="btn btn-primary"> Edit</a>
<a href="<?php echo site_url("post/image/".$id_post) ?>" class="btn btn-primary"> Image</a>
<a href="<?php echo site_url("post/delete/".$id_post) ?>" class="btn btn-primary"> Remove</a>
<HR>
	<div class="m-t-n m-b">
		<div class="card m-b-0 bg-primary-dark p-a-md no-border m-b m-x-n-g">
			<div class="card-block" style="height: 200px">
			</div>
		</div>
		<div class="row post-header text-white">
			<div class="col p-b-lg col-xs-8 col-xs-offset-2">
				<h4><?php echo $title; ?></h4>
				<div class="meta">
					<span class="author">by <span class="author-name"><?php echo $id_user; ?></span></span>
					<span class="pub-date format-date"><?php echo $created_date; ?></span>
					<span class="pub-date">#<?php echo $id_category; ?></span>
					<span class="pub-date">#<?php echo $id_tag; ?></span>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="p-b-lg col-sm-8 col-sm-offset-2">
				<article class="article">

					<figure class="cap-left">
						<img src="<?php echo base_url(); ?>assets/uploads/post/big/<?php echo $image; ?>" alt="<?php echo $title; ?>" class="img-responsive">
						<figcaption><?php echo $keyword; ?>.</figcaption>
					</figure>
					<p><?php echo $description; ?></p>
				</article>
			</div>
		</div>
	</div>


