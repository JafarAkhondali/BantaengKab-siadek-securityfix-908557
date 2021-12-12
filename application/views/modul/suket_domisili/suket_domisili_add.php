
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
                            <h3 class="widget-user-username"><b>Suket Domisili</b></h3>
                            <h5 class="widget-user-desc"><?= cclang('new', ['Suket Domisili']); ?></h5>
                            <hr>
                        </div>
                        <?= form_open('', [
                            'name'    => 'form_suket_domisili', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_suket_domisili', 
                            'enctype' => 'multipart/form-data', 
                            'method'  => 'POST'
                            ]); ?>
                         
                         <div class="form-group ">
                            <label for="kd_wilayah" class="col-sm-2 control-label">Wilayah 
                            </label>
                            <div class="col-sm-8">
                            <?php 

$kdwilayah = get_user_data('kd_wilayah'); 
$username = get_user_data('username'); 
if($username == 'admin' ){
  $a = db_get_all_data('wilayah');
}else{
  $a = db_get_all_data('wilayah',"kd_wilayah = $kdwilayah");
}
?>

<select  class="form-control chosen chosen-select-deselect" name="kd_wilayah" id="kd_wilayah" data-placeholder="PILIH wilayah" onchange="submit()">
 
  <?php if($username == 'admin'){?>
    <option value="0"></option>
  <?php } ?>

  <?php foreach ($a as $row): ?>
    
    <option 
    <?php if ($row->kd_wilayah == $this->input->post('kd_wilayah')) { ?>selected="selected"<?php } ?>
    value="<?= $row->kd_wilayah ?>"><?= '[ '.$row->kd_wilayah.' ] '. $row->nama ?></option>
    <?php endforeach; ?>  
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                                                 
                                                <div class="form-group ">
                            <label for="no" class="col-sm-2 control-label">No.Surat 
                            </label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" name="no" id="no" placeholder="No.Surat" value="<?= set_value('no'); ?>">
                                <small class="info help-block">
                                <b>Format No must</b> Valid Number.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="nik" class="col-sm-2 control-label">NIK 
                            </label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="nik" id="nik" placeholder="NIK" value="<?= set_value('nik'); ?>">
                                <small class="info help-block">
                                <b>Input Nik</b> Max Length : 30.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="nama" class="col-sm-2 control-label">Nama 
                            </label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?= set_value('nama'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="tmpt_lahir" class="col-sm-2 control-label">Tempat Lahir 
                            </label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="tmpt_lahir" id="tmpt_lahir" placeholder="Tempat Lahir" value="<?= set_value('tmpt_lahir'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="tgl_lahir" class="col-sm-2 control-label">Tanggal Lahir 
                            </label>
                            <div class="col-sm-2">
                            <div class="input-group date col-sm-8">
                              <input type="text" class="form-control pull-right datepicker" name="tgl_lahir"  placeholder="Tanggal Lahir" id="tgl_lahir">
                            </div>
                            <small class="info help-block">
                            </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="agama" class="col-sm-2 control-label">Agama 
                            </label>
                            <div class="col-sm-3">
                                <select  class="form-control chosen chosen-select-deselect" name="agama" id="agama" data-placeholder="Select Agama" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('setup_agama') as $row): ?>
                                    <option value="<?= $row->value ?>"><?= $row->nama; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                                                 
                                                <div class="form-group ">
                            <label for="pekerjaan" class="col-sm-2 control-label">Pekerjaan 
                            </label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="pekerjaan" id="pekerjaan" placeholder="Pekerjaan" value="<?= set_value('pekerjaan'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="alamat" class="col-sm-2 control-label">Alamat 
                            </label>
                            <div class="col-sm-8">
                                <textarea id="alamat" name="alamat" rows="5" class="textarea"><?= set_value('alamat'); ?></textarea>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="bukti_surat" class="col-sm-2 control-label">Bukti Surat 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-3">
                                <select  class="form-control chosen chosen-select" name="bukti_surat" id="bukti_surat" data-placeholder="Select Bukti Surat" >
                                    <option value=""></option>
                                    <option value="Ijazah">Ijazah</option>
                                    <option value="Akte Kelahiran">Akte Kelahiran</option>
                                    <option value="Kartu Keluarga">Kartu Keluarga</option>
                                    </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="tanggal_surat" class="col-sm-2 control-label">Tanggal Surat 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-2">
                            <div class="input-group date col-sm-8">
                              <input type="text" class="form-control pull-right datepicker" name="tanggal_surat"  placeholder="Tanggal Surat" id="tanggal_surat">
                            </div>
                            <small class="info help-block">
                            </small>
                            </div>
                        </div>
                                                 
                         
                        
                        <div class="message"></div>
                        <div class="row-fluid col-md-7">
                           <button class="btn btn-flat btn-primary btn_save btn_action" id="btn_save" data-stype='stay' title="<?= cclang('save_button'); ?> (Ctrl+s)">
                            <i class="fa fa-save" ></i> <?= cclang('save_button'); ?>
                            </button>
                            <a class="btn btn-flat btn-info btn_save btn_action btn_save_back" id="btn_save" data-stype='back' title="<?= cclang('save_and_go_the_list_button'); ?> (Ctrl+d)">
                            <i class="ion ion-ios-list-outline" ></i> <?= cclang('save_and_go_the_list_button'); ?>
                            </a>
                            <a class="btn btn-flat btn-default btn_action" id="btn_cancel" title="<?= cclang('cancel_button'); ?> (Ctrl+x)">
                            <i class="fa fa-undo" ></i> <?= cclang('cancel_button'); ?>
                            </a>
                            <span class="loading loading-hide">
                            <img src="<?= BASE_ASSET; ?>/img/loading-spin-primary.svg"> 
                            <i><?= cclang('loading_saving_data'); ?></i>
                            </span>
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
<!-- /.content -->
<!-- Page script -->
<script>
    $(document).ready(function(){
                   
      $('#btn_cancel').click(function(){
        swal({
            title: "<?= cclang('are_you_sure'); ?>",
            text: "<?= cclang('data_to_be_deleted_can_not_be_restored'); ?>",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes!",
            cancelButtonText: "No!",
            closeOnConfirm: true,
            closeOnCancel: true
          },
          function(isConfirm){
            if (isConfirm) {
              window.location.href = BASE_URL + 'surat_keluar';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
            
        var form_suket_domisili = $('#form_suket_domisili');
        var data_post = form_suket_domisili.serializeArray();
        var save_type = $(this).attr('data-stype');

        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: BASE_URL + '/suket_domisili/add_save',
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if(res.success) {
            
            if (save_type == 'back') {
              window.location.href = res.redirect;
              return;
            }
    
            $('.message').printMessage({message : res.message});
            $('.message').fadeIn();
            resetForm();
            $('.chosen option').prop('selected', false).trigger('chosen:updated');
                
          } else {
            $('.message').printMessage({message : res.message, type : 'warning'});
          }
    
        })
        .fail(function() {
          $('.message').printMessage({message : 'Error save data', type : 'warning'});
        })
        .always(function() {
          $('.loading').hide();
          $('html, body').animate({ scrollTop: $(document).height() }, 2000);
        });
    
        return false;
      }); /*end btn save*/
      
       
 
       
    
    
    }); /*end doc ready*/
</script>