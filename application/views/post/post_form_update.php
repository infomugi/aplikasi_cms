
<form action="<?php echo $action; ?>" method="post" id="upload_form">
  <div class="col-md-12 form-normal form-horizontal clearfix">

    <div class="row form-group">
      <div class="col-md-12 col-xs-12" data-toggle="tooltip" title="Title">
        <input type="text" class="form-control input-lg" name="title" id="title" placeholder="Title" value="<?php echo $title; ?>" />
        <span id="title_result"></span>  
        <?php echo form_error('title') ?>
      </div>

    </div>
    <div class="row form-group">
      <div class="col-md-12 col-xs-12" data-toggle="tooltip" title="Description">
        <textarea class="summernote" rows="3" name="description" id="description" placeholder="Description"><?php echo $description; ?></textarea>
        <?php echo form_error('description') ?>
      </div>
    </div>

    <div class="row form-group">

      <div class="col-md-3 col-xs-12" data-toggle="tooltip" title="Id Category">
        <select name="id_category" id="id_category" class="form-control">
          <option>-- Pilih Kategori --</option>
          <!-- fungsi untuk menampilkan data pada select list-->
          <?php foreach($list_category as $data) { ?>
            <option value="<?php echo $data->id_category?>" data-chained="<?php echo $data->id_category?>"><?php echo $data->name?></option>
            <?php } ?>
          </select>        
          <?php echo form_error('id_category') ?>
        </div>


        <div class="col-md-3 col-xs-12" data-toggle="tooltip" title="Id Tag">
          <select name="id_tag" id="id_tag" class="form-control">
            <option>-- Pilih Tag --</option>
            <!-- fungsi untuk menampilkan data pada select list-->
            <?php foreach($list_tag as $data) { ?>
              <option value="<?php echo $data->id_category_sub?>" data-chained="<?php echo $data->category_id?>"><?php echo $data->name?></option>
              <?php } ?>
            </select>        
            <?php echo form_error('id_tag') ?>
          </div>


          <div class="col-md-6 col-xs-12" data-toggle="tooltip" title="Url">
            <input type="text" class="form-control" name="url" id="url" placeholder="Url" value="<?php echo $url; ?>" readOnly="true"/>
            <?php echo form_error('url') ?>
          </div>

        </div>

        <div class="row form-group">
          <div class="col-sm-4 control-label col-xs-12">
            <label class="required" for="varchar">Image </label>
          </div>
          <div class="col-md-8 col-xs-12" data-toggle="tooltip" title="Image">
            <input type="text" class="form-control" name="image" id="image" placeholder="Image" value="<?php echo $image; ?>" />

            <form method="post" id="upload_form" align="center" enctype="multipart/form-data">  
              <input type="file" name="image_file" id="image_file" />  
              <div id="uploaded_image"></div>    
              <input type="submit" name="upload" id="upload" value="Upload" class="btn btn-info" />  
            </form>  

            <?php echo form_error('image') ?>
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
        <div class="row form-group">
          <div class="col-sm-4 control-label col-xs-12">
            <label class="required" for="varchar">Tags </label>
          </div>
          <div class="col-md-8 col-xs-12" data-toggle="tooltip" title="Tags">
            <input type="text" class="form-control" name="tags" id="tags" placeholder="Tags" value="<?php echo $tags; ?>" />
            <?php echo form_error('tags') ?>
          </div>
        </div>
        <div class="row form-group">
          <div class="col-sm-4 control-label col-xs-12">
            <label class="required" for="varchar">Keyword </label>
          </div>
          <div class="col-md-8 col-xs-12" data-toggle="tooltip" title="Keyword">
            <input type="text" class="form-control" name="keyword" id="keyword" placeholder="Keyword" value="<?php echo $keyword; ?>" />
            <?php echo form_error('keyword') ?>
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
              $('#title_result').html(data);  
            }  
          });  
          }  
        });  

          $("#title").keyup(function(){
            var Text = $(this).val();
            Text = Text.toLowerCase();
            Text = Text.replace(/[^a-zA-Z0-9]+/g,'-');
            $("#url").val(Text);        
          });

          $("#image_file").change(function(){
            var Text = $(this).val();
            Text = Text.toLowerCase();
            Text = Text.replace(/[^a-zA-Z0-9]+/g,'-');            
            $("#image").val(Text);        
          });

        });  
      </script> 

    <!--   <script>  
       $(document).ready(function(){  
        $('#upload_form').on('submit', function(e){  
         e.preventDefault();  
         if($('#image_file').val() == '')  
         {  
           swal({
            title: 'Error!',
            text: 'Silahkan pilih file terlebih dahulu',
            type: 'error',
            confirmButtonText: 'Kembali'
          });
         }  
         else  
         {  
          $.ajax({  
            url:"<?php echo base_url(); ?>post/ajax_upload",   
            method:"POST",  
            data:new FormData(this),  
            contentType: false,  
            cache: false,  
            processData:false,  
            success:function(data)  
            {  
              $('#uploaded_image').html(data);  
              swal({
                title: 'Sukses!',
                text: 'Image anda berhasil di unggah',
                type: 'success',
                confirmButtonText: 'Oke'
              });
            }  
          });  
        }  
      });  
      });  
    </script>   -->