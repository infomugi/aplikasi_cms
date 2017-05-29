
<div class="row" style="margin-bottom: 10px">
    <div class="col-md-4">
        <?php echo anchor(site_url('testimony/create'),'Add Testimony', 'class="btn btn-primary"'); ?>
    </div>
    <div class="col-md-4 text-center">
        <div style="margin-top: 8px" id="message">
            <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
        </div>
    </div>
    <div class="col-md-4 text-right">
        <form action="<?php echo site_url('testimony/index'); ?>" class="form-inline" method="get">
            <div class="input-group">
                <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                <span class="input-group-btn">
                    <?php 
                    if ($q <> '')
                    {
                        ?>
                        <a href="<?php echo site_url('testimony'); ?>" class="btn btn-default">Reset</a>
                        <?php
                    }
                    ?>
                    <button class="btn btn-primary" type="submit">Search</button>
                </span>
            </div>
        </form>
    </div>
</div>
<table class="table table-bordered" style="margin-bottom: 10px">
    <tr>
        <th>No</th>
		<th>Name</th>
		<th>Job</th>
		<th>Company</th>
		<th>Description</th>
		<th>Status</th>
		<th>Action</th>
    </tr><?php
    foreach ($testimony_data as $testimony)
    {
        ?>
        <tr>
			<td><?php echo ++$start ?></td>
			<td><?php echo $testimony->name ?></td>
			<td><?php echo $testimony->job ?></td>
			<td><?php echo $testimony->company ?></td>
			<td><?php echo $testimony->description ?></td>
			<td><?php echo $testimony->status ?></td>
			<td style="text-align:center">
				<?php 
				echo anchor(site_url('testimony/read/'.$testimony->id_testimony),'<span class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></span>'); 
				echo ''; 
				echo anchor(site_url('testimony/update/'.$testimony->id_testimony),'<span class="btn btn-info btn-sm"><i class="fa fa-edit"></i></span>'); 
				echo ''; 
				echo anchor(site_url('testimony/delete/'.$testimony->id_testimony),'<span class="btn btn-danger btn-sm"><i class="fa fa-close"></i></span>','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
				?>
			</td>
		</tr>
            <?php
        }
        ?>
    </table>
    <div class="row">
        <div class="col-md-6">
            <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
		<?php echo anchor(site_url('testimony/excel'), 'Excel', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('testimony/word'), 'Word', 'class="btn btn-primary"'); ?>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
        