<form method="post" id="image_form" align="center" enctype="multipart/form-data"> 
  <div class="col-md-10 form-normal form-horizontal clearfix">


    <div class="row form-group">
      <div class="col-sm-4 control-label col-xs-12">
        <label class="required" for="varchar">Image </label>
      </div>
      <div class="col-md-8 col-xs-12" data-toggle="tooltip" title="Image">
        <input type="file" class="btn btn-primary" name="image" id="image" placeholder="Foto Profile" value="<?php echo $image; ?>" required/>
        <?php echo form_error('image') ?>

        <div id="uploaded_image"></div>   
      </div>
    </div>
    
    <button type="submit" class="btn btn-primary pull-right"><?php echo $button ?></button> 
    <input type="hidden" name="id_post" value="<?php echo $id_post; ?>" /> 
    <a href="<?php echo site_url('post') ?>" class="btn btn-default pull-right">Cancel</a>
  </div></form>


  <script>  
   $(document).ready(function(){  
    $('#image_form').on('submit', function(e){  
     e.preventDefault();  
     if($('#image_file').val() == '')  
     {  
       swal({
        title: 'Error!',
        text: 'Silahkan pilih gambar terlebih dahulu',
        type: 'error',
        confirmButtonText: 'Kembali'
      });
     }  
     else  
     {  
      $.ajax({  
        url:"<?php echo $action; ?>",  
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
            text: 'Gambar Posting berhasil di Perbaharui',
            type: 'success',
            confirmButtonText: 'Oke'
          });
        } 

      });  
    }  
  });  
  });  
</script>  