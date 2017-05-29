
<form action="<?php echo $action; ?>" method="post">
    <div class="col-md-10 form-normal form-horizontal clearfix">

        <div class="row form-group">
            <div class="col-sm-4 control-label col-xs-12">
                <label class="required" for="int">Kategori </label>
            </div>
            <div class="col-md-8 col-xs-12" data-toggle="tooltip" title="Category Id">
                <select name="category_id" id="category_id" class="select2" style="width: 100%;">
                  <option>-- Pilih Kategori --</option>
                  <!-- fungsi untuk menampilkan data pada select list-->
                  <?php foreach($list_category as $data) { ?>
                    <option value="<?php echo $data->id_category?>"><?php echo $data->name?></option>
                    <?php } ?>
                </select> 
                <?php echo form_error('category_id') ?>
            </div>
        </div>
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
                <label class="required" for="image">Image </label>
            </div>
            <div class="col-md-8 col-xs-12" data-toggle="tooltip" title="Image">
                <textarea class="form-control" rows="3" name="image" id="image" placeholder="Image"><?php echo $image; ?></textarea>
                <?php echo form_error('image') ?>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-sm-4 control-label col-xs-12">
                <label class="required" for="varchar">Url </label>
            </div>
            <div class="col-md-8 col-xs-12" data-toggle="tooltip" title="Url">
                <input type="text" class="form-control" name="url" id="url" placeholder="Url" value="<?php echo $url; ?>" />
                <?php echo form_error('url') ?>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-sm-4 control-label col-xs-12">
                <label class="required" for="int">Status </label>
            </div>
            <div class="col-md-8 col-xs-12" data-toggle="tooltip" title="Status">
                <?php
                echo form_radio('status','1',TRUE).'Aktif ';
                echo form_radio('status','0').'Tidak Aktif';
                ?>    
                <?php echo form_error('status') ?>
            </div>
        </div>
        <button type="submit" class="btn btn-primary pull-right"><?php echo $button ?></button> 
        <input type="hidden" name="id_category_sub" value="<?php echo $id_category_sub; ?>" /> 
        <a href="<?php echo site_url('tag') ?>" class="btn btn-default pull-right">Cancel</a>
    </div></form>
