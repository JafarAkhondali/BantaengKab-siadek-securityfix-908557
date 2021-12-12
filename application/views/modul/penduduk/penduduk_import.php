
<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>
<script type="text/javascript">
    function domo(){
     
       // Binding keys
       $('*').bind('keydown', 'Ctrl+s', function assets() {
          $('#btn_save').trigger('click');
           return false;
       });
    
       $('*').bind('keydown', 'Ctrl+x', function assets() {
          $('#btn_cancel').trigger('click');
           return false;
       });
    
      $('*').bind('keydown', 'Ctrl+d', function assets() {
          $('.btn_save_back').trigger('click');
           return false;
       });
        
    }
    
    jQuery(document).ready(domo);
</script>

<!-- Main content -->
<section class="content">
    <div class="row" >
        <div class="col-md-12">
            <div class="box box-warning">
                <div class="box-body ">
                    <!-- Widget: user widget style 1 -->
                    <div class="box box-widget widget-user-2">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header ">
                            <div class="widget-user-image">
                                <img class="img-circle" src="<?= BASE_ASSET; ?>/img/add2.png" alt="User Avatar">
                            </div>
                            <!-- /.widget-user-image -->
                            <h3 class="widget-user-username"><b>Data Penduduk</b></h3>
                            <h5 class="widget-user-desc">Import Data Penduduk</h5>
                            <hr>
                        </div>
                        <?= form_open(base_url('penduduk/upload'), [
                            'name'    => 'form_penduduk', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_penduduk', 
                            'enctype' => 'multipart/form-data', 
                            'method'  => 'POST'
                            ]); ?>

                            <?php echo $this->session->flashdata('notif') ?>

                            <div class="col-sm-5">Unduh Format Inport Data Penduduk <a href="<?=  site_url(); ?>uploads/format/format_penduduk_desa.xls"><i class="fa fa-download" ></i></a></label>
                            <br><br>
                            
                             <div class="form-group ">
                            <label for="file" class="col-sm-2 control-label">File Import 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input class="form-control" type="file" name="file"><br>
                                <button class="btn btn-flat btn-success" type="submit">Import</button>
                            </div>
                        </div>

                        <?= form_close(); ?>
                    </div>
                </div>
                <!--/box body -->
            </div>
            <!--/box -->
        </div>
    </div>
</section>