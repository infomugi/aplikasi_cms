
<form action="<?php echo $action; ?>" method="post" id="upload_form">
  <div class="col-md-12 form-normal form-horizontal clearfix">

    <div class="row form-group">
      <div class="col-md-12 col-xs-12" data-toggle="tooltip" title="Judul Posting">
        <input type="text" class="form-control input-lg" name="title" id="title" placeholder="Judul Posting" value="<?php echo $title; ?>" />
        <?php echo form_error('title') ?>
      </div>

    </div>
    <div class="row form-group">
      <div class="col-md-12 col-xs-12" data-toggle="tooltip" title="Konten Posting">
        <textarea class="summernote" rows="3" name="description" id="description" placeholder="Description"><?php echo $description; ?></textarea>
        <?php echo form_error('description') ?>
      </div>
    </div>

    <div class="row form-group">


      <div class="col-md-6 col-xs-12" data-toggle="tooltip" title="Deskripsi Singkat">
        <input type="text" class="form-control" name="keyword" id="keyword" placeholder="Deskripsi Singkat" value="<?php echo $keyword; ?>" />
        <?php echo form_error('keyword') ?>
      </div>




      <div class="col-md-6 col-xs-12" data-toggle="tooltip" title="Url">
        <input type="text" class="form-control" name="url" id="url" placeholder="Url" value="<?php echo $url; ?>" readOnly="true"/>
        <?php echo form_error('url') ?>
      </div>

    </div>

    <div class="row form-group">

      <div class="col-md-6 col-xs-12" data-toggle="tooltip" title="Tags">
        <input type="text" class="form-control" name="tags" id="tags" placeholder="Tags" value="<?php echo $tags; ?>" />
        <?php echo form_error('tags') ?>
      </div>

      <div class="col-md-3 col-xs-12" data-toggle="tooltip" title="Kategori Posting">
        <select name="id_category" id="id_category" class="select2" style="width: 100%;">
          <option>-- Pilih Kategori --</option>
          <!-- fungsi untuk menampilkan data pada select list-->
          <?php foreach($list_category as $data) { ?>
            <option value="<?php echo $data->id_category?>" data-chained="<?php echo $data->id_category?>"><?php echo $data->name?></option>
            <?php } ?>
          </select>        
          <?php echo form_error('id_category') ?>
        </div>


        <div class="col-md-3 col-xs-12" data-toggle="tooltip" title="Tag Posting">
          <select name="id_tag" id="id_tag" class="select2" style="width: 100%;">
            <option>-- Pilih Tag --</option>
            <!-- fungsi untuk menampilkan data pada select list-->
            <?php foreach($list_tag as $data) { ?>
              <option value="<?php echo $data->id_category_sub?>" data-chained="<?php echo $data->category_id?>"><?php echo $data->name?></option>
              <?php } ?>
            </select>        
            <?php echo form_error('id_tag') ?>
          </div>

        </div>

        <button type="submit" class="btn btn-primary pull-right"><?php echo $button ?></button> 
        <input type="hidden" name="id_post" value="<?php echo $id_post; ?>" /> 
        <a href="<?php echo site_url('post') ?>" class="btn btn-default pull-right">Cancel</a>
      </div></form>


      <script>  

        $(document).ready(function(){  

          $('#title').change(function(){  
           var title = $('#title').val();  
           if(title != '')  
           {  
            $.ajax({  
             url:"<?php echo base_url(); ?>post/check",  
             method:"POST",  
             data:{title:title},  
             success:function(data){  
              $('#app_url').html(data);  
            }  
          });  
          }  
        });  

          $("#title").keyup(function(){
            var Text = $(this).val();
            $("#app_title").html(Text);        
            Text = Text.toLowerCase();
            Slug = Text.replace(/[^a-zA-Z0-9]+/g,'-');
            Keyword = Text.replace(/[^a-zA-Z0-9]+/g,',');
            $("#url").val(Slug);        
            $("#tags").val(Keyword);        
          });

          $("#image_file").change(function(){
            var Text = $(this).val();
            Text = Text.toLowerCase();
            Text = Text.replace(/[^a-zA-Z0-9]+/g,'-');            
            $("#image").val(Text);        
          });

        });  
      </script> 

