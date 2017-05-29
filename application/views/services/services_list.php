
<div class="row" style="margin-bottom: 10px">
    <div class="col-md-4">
        <?php echo anchor(site_url('services/create'),'Add Services', 'class="btn btn-primary"'); ?>
    </div>
    <div class="col-md-4 text-center">
        <div style="margin-top: 8px" id="message">
            <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
        </div>
    </div>
    <div class="col-md-4 text-right">
        <form action="<?php echo site_url('services/index'); ?>" class="form-inline" method="get">
            <div class="input-group">
                <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                <span class="input-group-btn">
                    <?php 
                    if ($q <> '')
                    {
                        ?>
                        <a href="<?php echo site_url('services'); ?>" class="btn btn-default">Reset</a>
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
        <th>Description</th>
        <th>Status</th>
        <th>Action</th>
    </tr><?php
    foreach ($services_data as $services)
    {
        ?>
        <tr>
           <td><?php echo ++$start ?></td>
           <td><?php echo $services->name ?></td>
           <td><?php echo $services->description ?></td>
           <td><?php echo $this->User_model->status($services->status); ?></td>
           <td style="text-align:center">
            <?php 
            echo anchor(site_url('services/read/'.$services->id_services),'<span class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></span>'); 
            echo ''; 
            echo anchor(site_url('services/image/'.$services->id_services),'<span class="btn btn-success btn-sm"><i class="fa fa-image"></i></span>'); 
            echo '';             
            echo anchor(site_url('services/update/'.$services->id_services),'<span class="btn btn-info btn-sm"><i class="fa fa-edit"></i></span>'); 
            echo ''; 
            echo anchor(site_url('services/delete/'.$services->id_services),'<span class="btn btn-danger btn-sm"><i class="fa fa-close"></i></span>','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
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
        <?php echo anchor(site_url('services/excel'), 'Excel', 'class="btn btn-primary"'); ?>
        <?php echo anchor(site_url('services/word'), 'Word', 'class="btn btn-primary"'); ?>
    </div>
    <div class="col-md-6 text-right">
        <?php echo $pagination ?>
    </div>
</div>
