
<!-- Fine Uploader Gallery CSS file
    ====================================================================== -->
<link href="<?= BASE_ASSET; ?>/fine-upload/fine-uploader-gallery.min.css" rel="stylesheet">
<!-- Fine Uploader jQuery JS file
    ====================================================================== -->
<script src="<?= BASE_ASSET; ?>/fine-upload/jquery.fine-uploader.js"></script>
<?php $this->load->view('core_template/fine_upload'); ?>
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
                            <h3 class="widget-user-username"><b>Adminduk Akta Perkawinan 2</b></h3>
                            <h5 class="widget-user-desc">Edit Adminduk Akta Perkawinan 2</h5>
                            <hr>
                        </div>
                        <?= form_open(base_url('tbl_kordukcapil/edit_save/'.$this->uri->segment(3)), [
                            'name'    => 'form_tbl_kordukcapil', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_tbl_kordukcapil', 
                            'method'  => 'POST'
                            ]); ?>
                         
                                                <div class="form-group ">
                            <label for="kd_wilayah" class="col-sm-2 control-label">Kd Wilayah 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="kd_wilayah" id="kd_wilayah" placeholder="Kd Wilayah" value="<?= set_value('kd_wilayah', $tbl_kordukcapil->kd_wilayah); ?>">
                                <small class="info help-block">
                                <b>Input Kd Wilayah</b> Max Length : 30.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="nik" class="col-sm-2 control-label">Nik 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="nik" id="nik" placeholder="Nik" value="<?= set_value('nik', $tbl_kordukcapil->nik); ?>">
                                <small class="info help-block">
                                <b>Input Nik</b> Max Length : 100.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="nama" class="col-sm-2 control-label">Nama 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?= set_value('nama', $tbl_kordukcapil->nama); ?>">
                                <small class="info help-block">
                                <b>Input Nama</b> Max Length : 100.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="alamat" class="col-sm-2 control-label">Alamat 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat" value="<?= set_value('alamat', $tbl_kordukcapil->alamat); ?>">
                                <small class="info help-block">
                                <b>Input Alamat</b> Max Length : 200.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="jenis_kelamin" class="col-sm-2 control-label">Jenis Kelamin 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="jenis_kelamin" id="jenis_kelamin" placeholder="Jenis Kelamin" value="<?= set_value('jenis_kelamin', $tbl_kordukcapil->jenis_kelamin); ?>">
                                <small class="info help-block">
                                <b>Input Jenis Kelamin</b> Max Length : 15.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="form" class="col-sm-2 control-label">Form 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <div id="tbl_kordukcapil_form_galery"></div>
                                <input class="data_file data_file_uuid" name="tbl_kordukcapil_form_uuid" id="tbl_kordukcapil_form_uuid" type="hidden" value="<?= set_value('tbl_kordukcapil_form_uuid'); ?>">
                                <input class="data_file" name="tbl_kordukcapil_form_name" id="tbl_kordukcapil_form_name" type="hidden" value="<?= set_value('tbl_kordukcapil_form_name', $tbl_kordukcapil->form); ?>">
                                <small class="info help-block">
                                <b>Extension file must</b> JPG, PDF, PNG,  <b>Max size file</b>  500 kb.</small>
                            </div>
                        </div>
                                                  
                                                <div class="form-group ">
                            <label for="kk" class="col-sm-2 control-label">Kk 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <div id="tbl_kordukcapil_kk_galery"></div>
                                <input class="data_file data_file_uuid" name="tbl_kordukcapil_kk_uuid" id="tbl_kordukcapil_kk_uuid" type="hidden" value="<?= set_value('tbl_kordukcapil_kk_uuid'); ?>">
                                <input class="data_file" name="tbl_kordukcapil_kk_name" id="tbl_kordukcapil_kk_name" type="hidden" value="<?= set_value('tbl_kordukcapil_kk_name', $tbl_kordukcapil->kk); ?>">
                                <small class="info help-block">
                                <b>Extension file must</b> JPG, PDF, PNG,  <b>Max size file</b>  300 kb.</small>
                            </div>
                        </div>
                                                  
                                                <div class="form-group ">
                            <label for="ktp1" class="col-sm-2 control-label">KTP Suami 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <div id="tbl_kordukcapil_ktp1_galery"></div>
                                <input class="data_file data_file_uuid" name="tbl_kordukcapil_ktp1_uuid" id="tbl_kordukcapil_ktp1_uuid" type="hidden" value="<?= set_value('tbl_kordukcapil_ktp1_uuid'); ?>">
                                <input class="data_file" name="tbl_kordukcapil_ktp1_name" id="tbl_kordukcapil_ktp1_name" type="hidden" value="<?= set_value('tbl_kordukcapil_ktp1_name', $tbl_kordukcapil->ktp1); ?>">
                                <small class="info help-block">
                                <b>Extension file must</b> JPG, PDF, PNG,  <b>Max size file</b>  300 kb.</small>
                            </div>
                        </div>
                                                  
                                                <div class="form-group ">
                            <label for="ktp2" class="col-sm-2 control-label">KTP Istri 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <div id="tbl_kordukcapil_ktp2_galery"></div>
                                <input class="data_file data_file_uuid" name="tbl_kordukcapil_ktp2_uuid" id="tbl_kordukcapil_ktp2_uuid" type="hidden" value="<?= set_value('tbl_kordukcapil_ktp2_uuid'); ?>">
                                <input class="data_file" name="tbl_kordukcapil_ktp2_name" id="tbl_kordukcapil_ktp2_name" type="hidden" value="<?= set_value('tbl_kordukcapil_ktp2_name', $tbl_kordukcapil->ktp2); ?>">
                                <small class="info help-block">
                                <b>Extension file must</b> JPG, PDF, PNG,  <b>Max size file</b>  300 kb.</small>
                            </div>
                        </div>
                                                  
                                                <div class="form-group ">
                            <label for="surat_nikah" class="col-sm-2 control-label">Surat Nikah 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <div id="tbl_kordukcapil_surat_nikah_galery"></div>
                                <input class="data_file data_file_uuid" name="tbl_kordukcapil_surat_nikah_uuid" id="tbl_kordukcapil_surat_nikah_uuid" type="hidden" value="<?= set_value('tbl_kordukcapil_surat_nikah_uuid'); ?>">
                                <input class="data_file" name="tbl_kordukcapil_surat_nikah_name" id="tbl_kordukcapil_surat_nikah_name" type="hidden" value="<?= set_value('tbl_kordukcapil_surat_nikah_name', $tbl_kordukcapil->surat_nikah); ?>">
                                <small class="info help-block">
                                <b>Extension file must</b> JPG, PDF, PNG,  <b>Max size file</b>  300 kb.</small>
                            </div>
                        </div>
                                                  
                                                <div class="form-group ">
                            <label for="suket_hilang" class="col-sm-2 control-label">Suket Hilang 
                            </label>
                            <div class="col-sm-8">
                                <div id="tbl_kordukcapil_suket_hilang_galery"></div>
                                <input class="data_file data_file_uuid" name="tbl_kordukcapil_suket_hilang_uuid" id="tbl_kordukcapil_suket_hilang_uuid" type="hidden" value="<?= set_value('tbl_kordukcapil_suket_hilang_uuid'); ?>">
                                <input class="data_file" name="tbl_kordukcapil_suket_hilang_name" id="tbl_kordukcapil_suket_hilang_name" type="hidden" value="<?= set_value('tbl_kordukcapil_suket_hilang_name', $tbl_kordukcapil->suket_hilang); ?>">
                                <small class="info help-block">
                                <b>Extension file must</b> JPG, PDF, PNG,  <b>Max size file</b>  300 kb.</small>
                            </div>
                        </div>
                                                  
                                                <div class="form-group ">
                            <label for="akta_kelahiran_suami" class="col-sm-2 control-label">Akta Kelahiran Suami 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <div id="tbl_kordukcapil_akta_kelahiran_suami_galery"></div>
                                <input class="data_file data_file_uuid" name="tbl_kordukcapil_akta_kelahiran_suami_uuid" id="tbl_kordukcapil_akta_kelahiran_suami_uuid" type="hidden" value="<?= set_value('tbl_kordukcapil_akta_kelahiran_suami_uuid'); ?>">
                                <input class="data_file" name="tbl_kordukcapil_akta_kelahiran_suami_name" id="tbl_kordukcapil_akta_kelahiran_suami_name" type="hidden" value="<?= set_value('tbl_kordukcapil_akta_kelahiran_suami_name', $tbl_kordukcapil->akta_kelahiran_suami); ?>">
                                <small class="info help-block">
                                <b>Extension file must</b> JPG, PDF, PNG,  <b>Max size file</b>  300 kb.</small>
                            </div>
                        </div>
                                                  
                                                <div class="form-group ">
                            <label for="akta_kelahiran_istri" class="col-sm-2 control-label">Akta Kelahiran Istri 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <div id="tbl_kordukcapil_akta_kelahiran_istri_galery"></div>
                                <input class="data_file data_file_uuid" name="tbl_kordukcapil_akta_kelahiran_istri_uuid" id="tbl_kordukcapil_akta_kelahiran_istri_uuid" type="hidden" value="<?= set_value('tbl_kordukcapil_akta_kelahiran_istri_uuid'); ?>">
                                <input class="data_file" name="tbl_kordukcapil_akta_kelahiran_istri_name" id="tbl_kordukcapil_akta_kelahiran_istri_name" type="hidden" value="<?= set_value('tbl_kordukcapil_akta_kelahiran_istri_name', $tbl_kordukcapil->akta_kelahiran_istri); ?>">
                                <small class="info help-block">
                                <b>Extension file must</b> JPG, PDF, PNG,  <b>Max size file</b>  300 kb.</small>
                            </div>
                        </div>
                                                  
                                                <div class="form-group ">
                            <label for="ijazah_suami" class="col-sm-2 control-label">Ijazah Suami 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <div id="tbl_kordukcapil_ijazah_suami_galery"></div>
                                <input class="data_file data_file_uuid" name="tbl_kordukcapil_ijazah_suami_uuid" id="tbl_kordukcapil_ijazah_suami_uuid" type="hidden" value="<?= set_value('tbl_kordukcapil_ijazah_suami_uuid'); ?>">
                                <input class="data_file" name="tbl_kordukcapil_ijazah_suami_name" id="tbl_kordukcapil_ijazah_suami_name" type="hidden" value="<?= set_value('tbl_kordukcapil_ijazah_suami_name', $tbl_kordukcapil->ijazah_suami); ?>">
                                <small class="info help-block">
                                <b>Extension file must</b> JPG, PDF, PNG,  <b>Max size file</b>  300 kb.</small>
                            </div>
                        </div>
                                                  
                                                <div class="form-group ">
                            <label for="ijazah_istri" class="col-sm-2 control-label">Ijazah Istri 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <div id="tbl_kordukcapil_ijazah_istri_galery"></div>
                                <input class="data_file data_file_uuid" name="tbl_kordukcapil_ijazah_istri_uuid" id="tbl_kordukcapil_ijazah_istri_uuid" type="hidden" value="<?= set_value('tbl_kordukcapil_ijazah_istri_uuid'); ?>">
                                <input class="data_file" name="tbl_kordukcapil_ijazah_istri_name" id="tbl_kordukcapil_ijazah_istri_name" type="hidden" value="<?= set_value('tbl_kordukcapil_ijazah_istri_name', $tbl_kordukcapil->ijazah_istri); ?>">
                                <small class="info help-block">
                                <b>Extension file must</b> JPG, PDF, PNG,  <b>Max size file</b>  300 kb.</small>
                            </div>
                        </div>
                                                  
                                                <div class="form-group ">
                            <label for="pas_foto" class="col-sm-2 control-label">Pas Foto 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <div id="tbl_kordukcapil_pas_foto_galery"></div>
                                <input class="data_file data_file_uuid" name="tbl_kordukcapil_pas_foto_uuid" id="tbl_kordukcapil_pas_foto_uuid" type="hidden" value="<?= set_value('tbl_kordukcapil_pas_foto_uuid'); ?>">
                                <input class="data_file" name="tbl_kordukcapil_pas_foto_name" id="tbl_kordukcapil_pas_foto_name" type="hidden" value="<?= set_value('tbl_kordukcapil_pas_foto_name', $tbl_kordukcapil->pas_foto); ?>">
                                <small class="info help-block">
                                <b>Extension file must</b> JPG, PDF, PNG,  <b>Max size file</b>  300 kb.</small>
                            </div>
                        </div>
                                                  
                                                <div class="form-group ">
                            <label for="suket_pernikahan" class="col-sm-2 control-label">Suket Pernikahan 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <div id="tbl_kordukcapil_suket_pernikahan_galery"></div>
                                <input class="data_file data_file_uuid" name="tbl_kordukcapil_suket_pernikahan_uuid" id="tbl_kordukcapil_suket_pernikahan_uuid" type="hidden" value="<?= set_value('tbl_kordukcapil_suket_pernikahan_uuid'); ?>">
                                <input class="data_file" name="tbl_kordukcapil_suket_pernikahan_name" id="tbl_kordukcapil_suket_pernikahan_name" type="hidden" value="<?= set_value('tbl_kordukcapil_suket_pernikahan_name', $tbl_kordukcapil->suket_pernikahan); ?>">
                                <small class="info help-block">
                                <b>Extension file must</b> JPG, PDF, PNG,  <b>Max size file</b>  300 kb.</small>
                            </div>
                        </div>
                                                  
                                                <div class="form-group ">
                            <label for="suket_desa" class="col-sm-2 control-label">Suket Desa 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <div id="tbl_kordukcapil_suket_desa_galery"></div>
                                <input class="data_file data_file_uuid" name="tbl_kordukcapil_suket_desa_uuid" id="tbl_kordukcapil_suket_desa_uuid" type="hidden" value="<?= set_value('tbl_kordukcapil_suket_desa_uuid'); ?>">
                                <input class="data_file" name="tbl_kordukcapil_suket_desa_name" id="tbl_kordukcapil_suket_desa_name" type="hidden" value="<?= set_value('tbl_kordukcapil_suket_desa_name', $tbl_kordukcapil->suket_desa); ?>">
                                <small class="info help-block">
                                <b>Extension file must</b> JPG, PDF, PNG,  <b>Max size file</b>  300 kb.</small>
                            </div>
                        </div>
                                                  
                                                <div class="form-group ">
                            <label for="surat_pengantar" class="col-sm-2 control-label">Surat Izin Atasan 
                            </label>
                            <div class="col-sm-8">
                                <div id="tbl_kordukcapil_surat_pengantar_galery"></div>
                                <input class="data_file data_file_uuid" name="tbl_kordukcapil_surat_pengantar_uuid" id="tbl_kordukcapil_surat_pengantar_uuid" type="hidden" value="<?= set_value('tbl_kordukcapil_surat_pengantar_uuid'); ?>">
                                <input class="data_file" name="tbl_kordukcapil_surat_pengantar_name" id="tbl_kordukcapil_surat_pengantar_name" type="hidden" value="<?= set_value('tbl_kordukcapil_surat_pengantar_name', $tbl_kordukcapil->surat_pengantar); ?>">
                                <small class="info help-block">
                                <b>Extension file must</b> JPG, PDF, PNG,  <b>Max size file</b>  300 kb.</small>
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
<script src="<?= BASE_ASSET; ?>ckeditor/ckeditor.js"></script>
<!-- Page script -->
<script>
    $(document).ready(function(){
      
                                                 
      $('#btn_cancel').click(function(){
        swal({
            title: "Are you sure?",
            text: "the data that you have created will be in the exhaust!",
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
              window.location.href = BASE_URL + 'tbl_kordukcapil';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
                                                            
        var form_tbl_kordukcapil = $('#form_tbl_kordukcapil');
        var data_post = form_tbl_kordukcapil.serializeArray();
        var save_type = $(this).attr('data-stype');
        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: form_tbl_kordukcapil.attr('action'),
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if(res.success) {
            var id = $('#tbl_kordukcapil_image_galery').find('li').attr('qq-file-id');
            if (save_type == 'back') {
              window.location.href = res.redirect;
              return;
            }
    
            $('.message').printMessage({message : res.message});
            $('.message').fadeIn();
            $('.data_file_uuid').val('');
    
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
      
                     var params = {};
       params[csrf] = token;

       $('#tbl_kordukcapil_form_galery').fineUploader({
          template: 'qq-template-gallery',
          request: {
              endpoint: BASE_URL + '/tbl_kordukcapil/upload_form_file',
              params : params
          },
          deleteFile: {
              enabled: true, // defaults to false
              endpoint: BASE_URL + '/tbl_kordukcapil/delete_form_file'
          },
          thumbnails: {
              placeholders: {
                  waitingPath: BASE_URL + '/asset/fine-upload/placeholders/waiting-generic.png',
                  notAvailablePath: BASE_URL + '/asset/fine-upload/placeholders/not_available-generic.png'
              }
          },
           session : {
             endpoint: BASE_URL + 'tbl_kordukcapil/get_form_file/<?= $tbl_kordukcapil->id; ?>',
             refreshOnRequest:true
           },
          multiple : false,
          validation: {
              allowedExtensions: ["jpg","pdf","png"],
              sizeLimit : 512000,
                        },
          showMessage: function(msg) {
              toastr['error'](msg);
          },
          callbacks: {
              onComplete : function(id, name, xhr) {
                if (xhr.success) {
                   var uuid = $('#tbl_kordukcapil_form_galery').fineUploader('getUuid', id);
                   $('#tbl_kordukcapil_form_uuid').val(uuid);
                   $('#tbl_kordukcapil_form_name').val(xhr.uploadName);
                } else {
                   toastr['error'](xhr.error);
                }
              },
              onSubmit : function(id, name) {
                  var uuid = $('#tbl_kordukcapil_form_uuid').val();
                  $.get(BASE_URL + '/tbl_kordukcapil/delete_form_file/' + uuid);
              },
              onDeleteComplete : function(id, xhr, isError) {
                if (isError == false) {
                  $('#tbl_kordukcapil_form_uuid').val('');
                  $('#tbl_kordukcapil_form_name').val('');
                }
              }
          }
      }); /*end form galey*/
                            var params = {};
       params[csrf] = token;

       $('#tbl_kordukcapil_kk_galery').fineUploader({
          template: 'qq-template-gallery',
          request: {
              endpoint: BASE_URL + '/tbl_kordukcapil/upload_kk_file',
              params : params
          },
          deleteFile: {
              enabled: true, // defaults to false
              endpoint: BASE_URL + '/tbl_kordukcapil/delete_kk_file'
          },
          thumbnails: {
              placeholders: {
                  waitingPath: BASE_URL + '/asset/fine-upload/placeholders/waiting-generic.png',
                  notAvailablePath: BASE_URL + '/asset/fine-upload/placeholders/not_available-generic.png'
              }
          },
           session : {
             endpoint: BASE_URL + 'tbl_kordukcapil/get_kk_file/<?= $tbl_kordukcapil->id; ?>',
             refreshOnRequest:true
           },
          multiple : false,
          validation: {
              allowedExtensions: ["jpg","pdf","png"],
              sizeLimit : 307200,
                        },
          showMessage: function(msg) {
              toastr['error'](msg);
          },
          callbacks: {
              onComplete : function(id, name, xhr) {
                if (xhr.success) {
                   var uuid = $('#tbl_kordukcapil_kk_galery').fineUploader('getUuid', id);
                   $('#tbl_kordukcapil_kk_uuid').val(uuid);
                   $('#tbl_kordukcapil_kk_name').val(xhr.uploadName);
                } else {
                   toastr['error'](xhr.error);
                }
              },
              onSubmit : function(id, name) {
                  var uuid = $('#tbl_kordukcapil_kk_uuid').val();
                  $.get(BASE_URL + '/tbl_kordukcapil/delete_kk_file/' + uuid);
              },
              onDeleteComplete : function(id, xhr, isError) {
                if (isError == false) {
                  $('#tbl_kordukcapil_kk_uuid').val('');
                  $('#tbl_kordukcapil_kk_name').val('');
                }
              }
          }
      }); /*end kk galey*/
                            var params = {};
       params[csrf] = token;

       $('#tbl_kordukcapil_ktp1_galery').fineUploader({
          template: 'qq-template-gallery',
          request: {
              endpoint: BASE_URL + '/tbl_kordukcapil/upload_ktp1_file',
              params : params
          },
          deleteFile: {
              enabled: true, // defaults to false
              endpoint: BASE_URL + '/tbl_kordukcapil/delete_ktp1_file'
          },
          thumbnails: {
              placeholders: {
                  waitingPath: BASE_URL + '/asset/fine-upload/placeholders/waiting-generic.png',
                  notAvailablePath: BASE_URL + '/asset/fine-upload/placeholders/not_available-generic.png'
              }
          },
           session : {
             endpoint: BASE_URL + 'tbl_kordukcapil/get_ktp1_file/<?= $tbl_kordukcapil->id; ?>',
             refreshOnRequest:true
           },
          multiple : false,
          validation: {
              allowedExtensions: ["jpg","pdf","png"],
              sizeLimit : 307200,
                        },
          showMessage: function(msg) {
              toastr['error'](msg);
          },
          callbacks: {
              onComplete : function(id, name, xhr) {
                if (xhr.success) {
                   var uuid = $('#tbl_kordukcapil_ktp1_galery').fineUploader('getUuid', id);
                   $('#tbl_kordukcapil_ktp1_uuid').val(uuid);
                   $('#tbl_kordukcapil_ktp1_name').val(xhr.uploadName);
                } else {
                   toastr['error'](xhr.error);
                }
              },
              onSubmit : function(id, name) {
                  var uuid = $('#tbl_kordukcapil_ktp1_uuid').val();
                  $.get(BASE_URL + '/tbl_kordukcapil/delete_ktp1_file/' + uuid);
              },
              onDeleteComplete : function(id, xhr, isError) {
                if (isError == false) {
                  $('#tbl_kordukcapil_ktp1_uuid').val('');
                  $('#tbl_kordukcapil_ktp1_name').val('');
                }
              }
          }
      }); /*end ktp1 galey*/
                            var params = {};
       params[csrf] = token;

       $('#tbl_kordukcapil_ktp2_galery').fineUploader({
          template: 'qq-template-gallery',
          request: {
              endpoint: BASE_URL + '/tbl_kordukcapil/upload_ktp2_file',
              params : params
          },
          deleteFile: {
              enabled: true, // defaults to false
              endpoint: BASE_URL + '/tbl_kordukcapil/delete_ktp2_file'
          },
          thumbnails: {
              placeholders: {
                  waitingPath: BASE_URL + '/asset/fine-upload/placeholders/waiting-generic.png',
                  notAvailablePath: BASE_URL + '/asset/fine-upload/placeholders/not_available-generic.png'
              }
          },
           session : {
             endpoint: BASE_URL + 'tbl_kordukcapil/get_ktp2_file/<?= $tbl_kordukcapil->id; ?>',
             refreshOnRequest:true
           },
          multiple : false,
          validation: {
              allowedExtensions: ["jpg","pdf","png"],
              sizeLimit : 307200,
                        },
          showMessage: function(msg) {
              toastr['error'](msg);
          },
          callbacks: {
              onComplete : function(id, name, xhr) {
                if (xhr.success) {
                   var uuid = $('#tbl_kordukcapil_ktp2_galery').fineUploader('getUuid', id);
                   $('#tbl_kordukcapil_ktp2_uuid').val(uuid);
                   $('#tbl_kordukcapil_ktp2_name').val(xhr.uploadName);
                } else {
                   toastr['error'](xhr.error);
                }
              },
              onSubmit : function(id, name) {
                  var uuid = $('#tbl_kordukcapil_ktp2_uuid').val();
                  $.get(BASE_URL + '/tbl_kordukcapil/delete_ktp2_file/' + uuid);
              },
              onDeleteComplete : function(id, xhr, isError) {
                if (isError == false) {
                  $('#tbl_kordukcapil_ktp2_uuid').val('');
                  $('#tbl_kordukcapil_ktp2_name').val('');
                }
              }
          }
      }); /*end ktp2 galey*/
                            var params = {};
       params[csrf] = token;

       $('#tbl_kordukcapil_surat_nikah_galery').fineUploader({
          template: 'qq-template-gallery',
          request: {
              endpoint: BASE_URL + '/tbl_kordukcapil/upload_surat_nikah_file',
              params : params
          },
          deleteFile: {
              enabled: true, // defaults to false
              endpoint: BASE_URL + '/tbl_kordukcapil/delete_surat_nikah_file'
          },
          thumbnails: {
              placeholders: {
                  waitingPath: BASE_URL + '/asset/fine-upload/placeholders/waiting-generic.png',
                  notAvailablePath: BASE_URL + '/asset/fine-upload/placeholders/not_available-generic.png'
              }
          },
           session : {
             endpoint: BASE_URL + 'tbl_kordukcapil/get_surat_nikah_file/<?= $tbl_kordukcapil->id; ?>',
             refreshOnRequest:true
           },
          multiple : false,
          validation: {
              allowedExtensions: ["jpg","pdf","png"],
              sizeLimit : 307200,
                        },
          showMessage: function(msg) {
              toastr['error'](msg);
          },
          callbacks: {
              onComplete : function(id, name, xhr) {
                if (xhr.success) {
                   var uuid = $('#tbl_kordukcapil_surat_nikah_galery').fineUploader('getUuid', id);
                   $('#tbl_kordukcapil_surat_nikah_uuid').val(uuid);
                   $('#tbl_kordukcapil_surat_nikah_name').val(xhr.uploadName);
                } else {
                   toastr['error'](xhr.error);
                }
              },
              onSubmit : function(id, name) {
                  var uuid = $('#tbl_kordukcapil_surat_nikah_uuid').val();
                  $.get(BASE_URL + '/tbl_kordukcapil/delete_surat_nikah_file/' + uuid);
              },
              onDeleteComplete : function(id, xhr, isError) {
                if (isError == false) {
                  $('#tbl_kordukcapil_surat_nikah_uuid').val('');
                  $('#tbl_kordukcapil_surat_nikah_name').val('');
                }
              }
          }
      }); /*end surat_nikah galey*/
                            var params = {};
       params[csrf] = token;

       $('#tbl_kordukcapil_suket_hilang_galery').fineUploader({
          template: 'qq-template-gallery',
          request: {
              endpoint: BASE_URL + '/tbl_kordukcapil/upload_suket_hilang_file',
              params : params
          },
          deleteFile: {
              enabled: true, // defaults to false
              endpoint: BASE_URL + '/tbl_kordukcapil/delete_suket_hilang_file'
          },
          thumbnails: {
              placeholders: {
                  waitingPath: BASE_URL + '/asset/fine-upload/placeholders/waiting-generic.png',
                  notAvailablePath: BASE_URL + '/asset/fine-upload/placeholders/not_available-generic.png'
              }
          },
           session : {
             endpoint: BASE_URL + 'tbl_kordukcapil/get_suket_hilang_file/<?= $tbl_kordukcapil->id; ?>',
             refreshOnRequest:true
           },
          multiple : false,
          validation: {
              allowedExtensions: ["jpg","pdf","png"],
              sizeLimit : 307200,
                        },
          showMessage: function(msg) {
              toastr['error'](msg);
          },
          callbacks: {
              onComplete : function(id, name, xhr) {
                if (xhr.success) {
                   var uuid = $('#tbl_kordukcapil_suket_hilang_galery').fineUploader('getUuid', id);
                   $('#tbl_kordukcapil_suket_hilang_uuid').val(uuid);
                   $('#tbl_kordukcapil_suket_hilang_name').val(xhr.uploadName);
                } else {
                   toastr['error'](xhr.error);
                }
              },
              onSubmit : function(id, name) {
                  var uuid = $('#tbl_kordukcapil_suket_hilang_uuid').val();
                  $.get(BASE_URL + '/tbl_kordukcapil/delete_suket_hilang_file/' + uuid);
              },
              onDeleteComplete : function(id, xhr, isError) {
                if (isError == false) {
                  $('#tbl_kordukcapil_suket_hilang_uuid').val('');
                  $('#tbl_kordukcapil_suket_hilang_name').val('');
                }
              }
          }
      }); /*end suket_hilang galey*/
                            var params = {};
       params[csrf] = token;

       $('#tbl_kordukcapil_akta_kelahiran_suami_galery').fineUploader({
          template: 'qq-template-gallery',
          request: {
              endpoint: BASE_URL + '/tbl_kordukcapil/upload_akta_kelahiran_suami_file',
              params : params
          },
          deleteFile: {
              enabled: true, // defaults to false
              endpoint: BASE_URL + '/tbl_kordukcapil/delete_akta_kelahiran_suami_file'
          },
          thumbnails: {
              placeholders: {
                  waitingPath: BASE_URL + '/asset/fine-upload/placeholders/waiting-generic.png',
                  notAvailablePath: BASE_URL + '/asset/fine-upload/placeholders/not_available-generic.png'
              }
          },
           session : {
             endpoint: BASE_URL + 'tbl_kordukcapil/get_akta_kelahiran_suami_file/<?= $tbl_kordukcapil->id; ?>',
             refreshOnRequest:true
           },
          multiple : false,
          validation: {
              allowedExtensions: ["jpg","pdf","png"],
              sizeLimit : 307200,
                        },
          showMessage: function(msg) {
              toastr['error'](msg);
          },
          callbacks: {
              onComplete : function(id, name, xhr) {
                if (xhr.success) {
                   var uuid = $('#tbl_kordukcapil_akta_kelahiran_suami_galery').fineUploader('getUuid', id);
                   $('#tbl_kordukcapil_akta_kelahiran_suami_uuid').val(uuid);
                   $('#tbl_kordukcapil_akta_kelahiran_suami_name').val(xhr.uploadName);
                } else {
                   toastr['error'](xhr.error);
                }
              },
              onSubmit : function(id, name) {
                  var uuid = $('#tbl_kordukcapil_akta_kelahiran_suami_uuid').val();
                  $.get(BASE_URL + '/tbl_kordukcapil/delete_akta_kelahiran_suami_file/' + uuid);
              },
              onDeleteComplete : function(id, xhr, isError) {
                if (isError == false) {
                  $('#tbl_kordukcapil_akta_kelahiran_suami_uuid').val('');
                  $('#tbl_kordukcapil_akta_kelahiran_suami_name').val('');
                }
              }
          }
      }); /*end akta_kelahiran_suami galey*/
                            var params = {};
       params[csrf] = token;

       $('#tbl_kordukcapil_akta_kelahiran_istri_galery').fineUploader({
          template: 'qq-template-gallery',
          request: {
              endpoint: BASE_URL + '/tbl_kordukcapil/upload_akta_kelahiran_istri_file',
              params : params
          },
          deleteFile: {
              enabled: true, // defaults to false
              endpoint: BASE_URL + '/tbl_kordukcapil/delete_akta_kelahiran_istri_file'
          },
          thumbnails: {
              placeholders: {
                  waitingPath: BASE_URL + '/asset/fine-upload/placeholders/waiting-generic.png',
                  notAvailablePath: BASE_URL + '/asset/fine-upload/placeholders/not_available-generic.png'
              }
          },
           session : {
             endpoint: BASE_URL + 'tbl_kordukcapil/get_akta_kelahiran_istri_file/<?= $tbl_kordukcapil->id; ?>',
             refreshOnRequest:true
           },
          multiple : false,
          validation: {
              allowedExtensions: ["jpg","pdf","png"],
              sizeLimit : 307200,
                        },
          showMessage: function(msg) {
              toastr['error'](msg);
          },
          callbacks: {
              onComplete : function(id, name, xhr) {
                if (xhr.success) {
                   var uuid = $('#tbl_kordukcapil_akta_kelahiran_istri_galery').fineUploader('getUuid', id);
                   $('#tbl_kordukcapil_akta_kelahiran_istri_uuid').val(uuid);
                   $('#tbl_kordukcapil_akta_kelahiran_istri_name').val(xhr.uploadName);
                } else {
                   toastr['error'](xhr.error);
                }
              },
              onSubmit : function(id, name) {
                  var uuid = $('#tbl_kordukcapil_akta_kelahiran_istri_uuid').val();
                  $.get(BASE_URL + '/tbl_kordukcapil/delete_akta_kelahiran_istri_file/' + uuid);
              },
              onDeleteComplete : function(id, xhr, isError) {
                if (isError == false) {
                  $('#tbl_kordukcapil_akta_kelahiran_istri_uuid').val('');
                  $('#tbl_kordukcapil_akta_kelahiran_istri_name').val('');
                }
              }
          }
      }); /*end akta_kelahiran_istri galey*/
                            var params = {};
       params[csrf] = token;

       $('#tbl_kordukcapil_ijazah_suami_galery').fineUploader({
          template: 'qq-template-gallery',
          request: {
              endpoint: BASE_URL + '/tbl_kordukcapil/upload_ijazah_suami_file',
              params : params
          },
          deleteFile: {
              enabled: true, // defaults to false
              endpoint: BASE_URL + '/tbl_kordukcapil/delete_ijazah_suami_file'
          },
          thumbnails: {
              placeholders: {
                  waitingPath: BASE_URL + '/asset/fine-upload/placeholders/waiting-generic.png',
                  notAvailablePath: BASE_URL + '/asset/fine-upload/placeholders/not_available-generic.png'
              }
          },
           session : {
             endpoint: BASE_URL + 'tbl_kordukcapil/get_ijazah_suami_file/<?= $tbl_kordukcapil->id; ?>',
             refreshOnRequest:true
           },
          multiple : false,
          validation: {
              allowedExtensions: ["jpg","pdf","png"],
              sizeLimit : 307200,
                        },
          showMessage: function(msg) {
              toastr['error'](msg);
          },
          callbacks: {
              onComplete : function(id, name, xhr) {
                if (xhr.success) {
                   var uuid = $('#tbl_kordukcapil_ijazah_suami_galery').fineUploader('getUuid', id);
                   $('#tbl_kordukcapil_ijazah_suami_uuid').val(uuid);
                   $('#tbl_kordukcapil_ijazah_suami_name').val(xhr.uploadName);
                } else {
                   toastr['error'](xhr.error);
                }
              },
              onSubmit : function(id, name) {
                  var uuid = $('#tbl_kordukcapil_ijazah_suami_uuid').val();
                  $.get(BASE_URL + '/tbl_kordukcapil/delete_ijazah_suami_file/' + uuid);
              },
              onDeleteComplete : function(id, xhr, isError) {
                if (isError == false) {
                  $('#tbl_kordukcapil_ijazah_suami_uuid').val('');
                  $('#tbl_kordukcapil_ijazah_suami_name').val('');
                }
              }
          }
      }); /*end ijazah_suami galey*/
                            var params = {};
       params[csrf] = token;

       $('#tbl_kordukcapil_ijazah_istri_galery').fineUploader({
          template: 'qq-template-gallery',
          request: {
              endpoint: BASE_URL + '/tbl_kordukcapil/upload_ijazah_istri_file',
              params : params
          },
          deleteFile: {
              enabled: true, // defaults to false
              endpoint: BASE_URL + '/tbl_kordukcapil/delete_ijazah_istri_file'
          },
          thumbnails: {
              placeholders: {
                  waitingPath: BASE_URL + '/asset/fine-upload/placeholders/waiting-generic.png',
                  notAvailablePath: BASE_URL + '/asset/fine-upload/placeholders/not_available-generic.png'
              }
          },
           session : {
             endpoint: BASE_URL + 'tbl_kordukcapil/get_ijazah_istri_file/<?= $tbl_kordukcapil->id; ?>',
             refreshOnRequest:true
           },
          multiple : false,
          validation: {
              allowedExtensions: ["jpg","pdf","png"],
              sizeLimit : 307200,
                        },
          showMessage: function(msg) {
              toastr['error'](msg);
          },
          callbacks: {
              onComplete : function(id, name, xhr) {
                if (xhr.success) {
                   var uuid = $('#tbl_kordukcapil_ijazah_istri_galery').fineUploader('getUuid', id);
                   $('#tbl_kordukcapil_ijazah_istri_uuid').val(uuid);
                   $('#tbl_kordukcapil_ijazah_istri_name').val(xhr.uploadName);
                } else {
                   toastr['error'](xhr.error);
                }
              },
              onSubmit : function(id, name) {
                  var uuid = $('#tbl_kordukcapil_ijazah_istri_uuid').val();
                  $.get(BASE_URL + '/tbl_kordukcapil/delete_ijazah_istri_file/' + uuid);
              },
              onDeleteComplete : function(id, xhr, isError) {
                if (isError == false) {
                  $('#tbl_kordukcapil_ijazah_istri_uuid').val('');
                  $('#tbl_kordukcapil_ijazah_istri_name').val('');
                }
              }
          }
      }); /*end ijazah_istri galey*/
                            var params = {};
       params[csrf] = token;

       $('#tbl_kordukcapil_pas_foto_galery').fineUploader({
          template: 'qq-template-gallery',
          request: {
              endpoint: BASE_URL + '/tbl_kordukcapil/upload_pas_foto_file',
              params : params
          },
          deleteFile: {
              enabled: true, // defaults to false
              endpoint: BASE_URL + '/tbl_kordukcapil/delete_pas_foto_file'
          },
          thumbnails: {
              placeholders: {
                  waitingPath: BASE_URL + '/asset/fine-upload/placeholders/waiting-generic.png',
                  notAvailablePath: BASE_URL + '/asset/fine-upload/placeholders/not_available-generic.png'
              }
          },
           session : {
             endpoint: BASE_URL + 'tbl_kordukcapil/get_pas_foto_file/<?= $tbl_kordukcapil->id; ?>',
             refreshOnRequest:true
           },
          multiple : false,
          validation: {
              allowedExtensions: ["jpg","pdf","png"],
              sizeLimit : 307200,
                        },
          showMessage: function(msg) {
              toastr['error'](msg);
          },
          callbacks: {
              onComplete : function(id, name, xhr) {
                if (xhr.success) {
                   var uuid = $('#tbl_kordukcapil_pas_foto_galery').fineUploader('getUuid', id);
                   $('#tbl_kordukcapil_pas_foto_uuid').val(uuid);
                   $('#tbl_kordukcapil_pas_foto_name').val(xhr.uploadName);
                } else {
                   toastr['error'](xhr.error);
                }
              },
              onSubmit : function(id, name) {
                  var uuid = $('#tbl_kordukcapil_pas_foto_uuid').val();
                  $.get(BASE_URL + '/tbl_kordukcapil/delete_pas_foto_file/' + uuid);
              },
              onDeleteComplete : function(id, xhr, isError) {
                if (isError == false) {
                  $('#tbl_kordukcapil_pas_foto_uuid').val('');
                  $('#tbl_kordukcapil_pas_foto_name').val('');
                }
              }
          }
      }); /*end pas_foto galey*/
                            var params = {};
       params[csrf] = token;

       $('#tbl_kordukcapil_suket_pernikahan_galery').fineUploader({
          template: 'qq-template-gallery',
          request: {
              endpoint: BASE_URL + '/tbl_kordukcapil/upload_suket_pernikahan_file',
              params : params
          },
          deleteFile: {
              enabled: true, // defaults to false
              endpoint: BASE_URL + '/tbl_kordukcapil/delete_suket_pernikahan_file'
          },
          thumbnails: {
              placeholders: {
                  waitingPath: BASE_URL + '/asset/fine-upload/placeholders/waiting-generic.png',
                  notAvailablePath: BASE_URL + '/asset/fine-upload/placeholders/not_available-generic.png'
              }
          },
           session : {
             endpoint: BASE_URL + 'tbl_kordukcapil/get_suket_pernikahan_file/<?= $tbl_kordukcapil->id; ?>',
             refreshOnRequest:true
           },
          multiple : false,
          validation: {
              allowedExtensions: ["jpg","pdf","png"],
              sizeLimit : 307200,
                        },
          showMessage: function(msg) {
              toastr['error'](msg);
          },
          callbacks: {
              onComplete : function(id, name, xhr) {
                if (xhr.success) {
                   var uuid = $('#tbl_kordukcapil_suket_pernikahan_galery').fineUploader('getUuid', id);
                   $('#tbl_kordukcapil_suket_pernikahan_uuid').val(uuid);
                   $('#tbl_kordukcapil_suket_pernikahan_name').val(xhr.uploadName);
                } else {
                   toastr['error'](xhr.error);
                }
              },
              onSubmit : function(id, name) {
                  var uuid = $('#tbl_kordukcapil_suket_pernikahan_uuid').val();
                  $.get(BASE_URL + '/tbl_kordukcapil/delete_suket_pernikahan_file/' + uuid);
              },
              onDeleteComplete : function(id, xhr, isError) {
                if (isError == false) {
                  $('#tbl_kordukcapil_suket_pernikahan_uuid').val('');
                  $('#tbl_kordukcapil_suket_pernikahan_name').val('');
                }
              }
          }
      }); /*end suket_pernikahan galey*/
                            var params = {};
       params[csrf] = token;

       $('#tbl_kordukcapil_suket_desa_galery').fineUploader({
          template: 'qq-template-gallery',
          request: {
              endpoint: BASE_URL + '/tbl_kordukcapil/upload_suket_desa_file',
              params : params
          },
          deleteFile: {
              enabled: true, // defaults to false
              endpoint: BASE_URL + '/tbl_kordukcapil/delete_suket_desa_file'
          },
          thumbnails: {
              placeholders: {
                  waitingPath: BASE_URL + '/asset/fine-upload/placeholders/waiting-generic.png',
                  notAvailablePath: BASE_URL + '/asset/fine-upload/placeholders/not_available-generic.png'
              }
          },
           session : {
             endpoint: BASE_URL + 'tbl_kordukcapil/get_suket_desa_file/<?= $tbl_kordukcapil->id; ?>',
             refreshOnRequest:true
           },
          multiple : false,
          validation: {
              allowedExtensions: ["jpg","pdf","png"],
              sizeLimit : 307200,
                        },
          showMessage: function(msg) {
              toastr['error'](msg);
          },
          callbacks: {
              onComplete : function(id, name, xhr) {
                if (xhr.success) {
                   var uuid = $('#tbl_kordukcapil_suket_desa_galery').fineUploader('getUuid', id);
                   $('#tbl_kordukcapil_suket_desa_uuid').val(uuid);
                   $('#tbl_kordukcapil_suket_desa_name').val(xhr.uploadName);
                } else {
                   toastr['error'](xhr.error);
                }
              },
              onSubmit : function(id, name) {
                  var uuid = $('#tbl_kordukcapil_suket_desa_uuid').val();
                  $.get(BASE_URL + '/tbl_kordukcapil/delete_suket_desa_file/' + uuid);
              },
              onDeleteComplete : function(id, xhr, isError) {
                if (isError == false) {
                  $('#tbl_kordukcapil_suket_desa_uuid').val('');
                  $('#tbl_kordukcapil_suket_desa_name').val('');
                }
              }
          }
      }); /*end suket_desa galey*/
                            var params = {};
       params[csrf] = token;

       $('#tbl_kordukcapil_surat_pengantar_galery').fineUploader({
          template: 'qq-template-gallery',
          request: {
              endpoint: BASE_URL + '/tbl_kordukcapil/upload_surat_pengantar_file',
              params : params
          },
          deleteFile: {
              enabled: true, // defaults to false
              endpoint: BASE_URL + '/tbl_kordukcapil/delete_surat_pengantar_file'
          },
          thumbnails: {
              placeholders: {
                  waitingPath: BASE_URL + '/asset/fine-upload/placeholders/waiting-generic.png',
                  notAvailablePath: BASE_URL + '/asset/fine-upload/placeholders/not_available-generic.png'
              }
          },
           session : {
             endpoint: BASE_URL + 'tbl_kordukcapil/get_surat_pengantar_file/<?= $tbl_kordukcapil->id; ?>',
             refreshOnRequest:true
           },
          multiple : false,
          validation: {
              allowedExtensions: ["jpg","pdf","png"],
              sizeLimit : 307200,
                        },
          showMessage: function(msg) {
              toastr['error'](msg);
          },
          callbacks: {
              onComplete : function(id, name, xhr) {
                if (xhr.success) {
                   var uuid = $('#tbl_kordukcapil_surat_pengantar_galery').fineUploader('getUuid', id);
                   $('#tbl_kordukcapil_surat_pengantar_uuid').val(uuid);
                   $('#tbl_kordukcapil_surat_pengantar_name').val(xhr.uploadName);
                } else {
                   toastr['error'](xhr.error);
                }
              },
              onSubmit : function(id, name) {
                  var uuid = $('#tbl_kordukcapil_surat_pengantar_uuid').val();
                  $.get(BASE_URL + '/tbl_kordukcapil/delete_surat_pengantar_file/' + uuid);
              },
              onDeleteComplete : function(id, xhr, isError) {
                if (isError == false) {
                  $('#tbl_kordukcapil_surat_pengantar_uuid').val('');
                  $('#tbl_kordukcapil_surat_pengantar_name').val('');
                }
              }
          }
      }); /*end surat_pengantar galey*/
              
       
           
    
    }); /*end doc ready*/
</script>