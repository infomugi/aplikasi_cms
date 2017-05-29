
<form action="<?php echo $action; ?>" method="post">
    <div class="col-md-10 form-normal form-horizontal clearfix">
        
	    <div class="row form-group">
            <div class="col-sm-4 control-label col-xs-12">
                <label class="required" for="varchar">Name </label>
            </div>
            <div class="col-md-8 col-xs-12" data-toggle="tooltip" title="Name">
                <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="<?php echo $name; ?>" />
                <?php echo form_error('name') ?>
            </div>
        </div>
	    <div class="row form-group">
            <div class="col-sm-4 control-label col-xs-12">
                <label class="required" for="varchar">Job </label>
            </div>
            <div class="col-md-8 col-xs-12" data-toggle="tooltip" title="Job">
                <input type="text" class="form-control" name="job" id="job" placeholder="Job" value="<?php echo $job; ?>" />
                <?php echo form_error('job') ?>
            </div>
        </div>
	    <div class="row form-group">
            <div class="col-sm-4 control-label col-xs-12">
                <label class="required" for="varchar">Company </label>
            </div>
            <div class="col-md-8 col-xs-12" data-toggle="tooltip" title="Company">
                <input type="text" class="form-control" name="company" id="company" placeholder="Company" value="<?php echo $company; ?>" />
                <?php echo form_error('company') ?>
            </div>
        </div>
	    <div class="row form-group">
                <div class="col-sm-4 control-label col-xs-12">
                    <label class="required" for="description">Description </label>
                </div>
                <div class="col-md-8 col-xs-12" data-toggle="tooltip" title="Description">
                    <textarea class="form-control" rows="3" name="description" id="description" placeholder="Description"><?php echo $description; ?></textarea>
                    <?php echo form_error('description') ?>
                </div>
            </div>
	    <div class="row form-group">
            <div class="col-sm-4 control-label col-xs-12">
                <label class="required" for="int">Status </label>
            </div>
            <div class="col-md-8 col-xs-12" data-toggle="tooltip" title="Status">
                <input type="text" class="form-control" name="status" id="status" placeholder="Status" value="<?php echo $status; ?>" />
                <?php echo form_error('status') ?>
            </div>
        </div>
	    <button type="submit" class="btn btn-primary pull-right"><?php echo $button ?></button> 
	    <input type="hidden" name="id_testimony" value="<?php echo $id_testimony; ?>" /> 
	    <a href="<?php echo site_url('testimony') ?>" class="btn btn-default pull-right">Cancel</a>
	</div></form>
