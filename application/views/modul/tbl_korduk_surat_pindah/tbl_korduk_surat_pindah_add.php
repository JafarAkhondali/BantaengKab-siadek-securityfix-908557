
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
                            <h3 class="widget-user-username"><b>Adminduk Surat Pindah</b></h3>
                            <h5 class="widget-user-desc"><?= cclang('new', ['Adminduk Surat Pindah']); ?></h5>
                            <hr>
                        </div>
                        <?= form_open('', [
                            'name'    => 'form_tbl_korduk_surat_pindah', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_tbl_korduk_surat_pindah', 
                            'enctype' => 'multipart/form-data', 
                            'method'  => 'POST'
                            ]); ?>
                         
                                                <div class="form-group ">
                            <label for="nik" class="col-sm-2 control-label">NIK 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="nik" id="nik" placeholder="NIK" value="<?= set_value('nik'); ?>">
                                <small class="info help-block">
                                <b>Input Nik</b> Max Length : 100.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="nama" class="col-sm-2 control-label">Nama 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?= set_value('nama'); ?>">
                                <small class="info help-block">
                                <b>Input Nama</b> Max Length : 100.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="alamat" class="col-sm-2 control-label">Alamat 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat" value="<?= set_value('alamat'); ?>">
                                <small class="info help-block">
                                <b>Input Alamat</b> Max Length : 200.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="jenis_kelamin" class="col-sm-2 control-label">Jenis Kelamin 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="jenis_kelamin" id="jenis_kelamin" placeholder="Jenis Kelamin" value="<?= set_value('jenis_kelamin'); ?>">
                                <small class="info help-block">
                                <b>Input Jenis Kelamin</b> Max Length : 15.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="surat_pengantar" class="col-sm-2 control-label">Surat Pengantar 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <div id="tbl_korduk_surat_pindah_surat_pengantar_galery"></div>
                                <input class="data_file" name="tbl_korduk_surat_pindah_surat_pengantar_uuid" id="tbl_korduk_surat_pindah_surat_pengantar_uuid" type="hidden" value="<?= set_value('tbl_korduk_surat_pindah_surat_pengantar_uuid'); ?>">
                                <input class="data_file" name="tbl_korduk_surat_pindah_surat_pengantar_name" id="tbl_korduk_surat_pindah_surat_pengantar_name" type="hidden" value="<?= set_value('tbl_korduk_surat_pindah_surat_pengantar_name'); ?>">
                                <small class="info help-block">
                                <b>Extension file must</b> JPG,PNG,PDF,  <b>Max size file</b>  300 kb.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="ktp" class="col-sm-2 control-label">KTP 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <div id="tbl_korduk_surat_pindah_ktp_galery"></div>
                                <input class="data_file" name="tbl_korduk_surat_pindah_ktp_uuid" id="tbl_korduk_surat_pindah_ktp_uuid" type="hidden" value="<?= set_value('tbl_korduk_surat_pindah_ktp_uuid'); ?>">
                                <input class="data_file" name="tbl_korduk_surat_pindah_ktp_name" id="tbl_korduk_surat_pindah_ktp_name" type="hidden" value="<?= set_value('tbl_korduk_surat_pindah_ktp_name'); ?>">
                                <small class="info help-block">
                                <b>Extension file must</b> JPG,PNG,PDF,  <b>Max size file</b>  300 kb.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="kk" class="col-sm-2 control-label">KK 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <div id="tbl_korduk_surat_pindah_kk_galery"></div>
                                <input class="data_file" name="tbl_korduk_surat_pindah_kk_uuid" id="tbl_korduk_surat_pindah_kk_uuid" type="hidden" value="<?= set_value('tbl_korduk_surat_pindah_kk_uuid'); ?>">
                                <input class="data_file" name="tbl_korduk_surat_pindah_kk_name" id="tbl_korduk_surat_pindah_kk_name" type="hidden" value="<?= set_value('tbl_korduk_surat_pindah_kk_name'); ?>">
                                <small class="info help-block">
                                <b>Extension file must</b> JPG,PNG,PDF,  <b>Max size file</b>  300 kb.</small>
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
              window.location.href = BASE_URL + 'tbl_korduk_surat_pindah';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
            
        var form_tbl_korduk_surat_pindah = $('#form_tbl_korduk_surat_pindah');
        var data_post = form_tbl_korduk_surat_pindah.serializeArray();
        var save_type = $(this).attr('data-stype');

        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: BASE_URL + '/tbl_korduk_surat_pindah/add_save',
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if(res.success) {
            var id_surat_pengantar = $('#tbl_korduk_surat_pindah_surat_pengantar_galery').find('li').attr('qq-file-id');
            var id_ktp = $('#tbl_korduk_surat_pindah_ktp_galery').find('li').attr('qq-file-id');
            var id_kk = $('#tbl_korduk_surat_pindah_kk_galery').find('li').attr('qq-file-id');
            
            if (save_type == 'back') {
              window.location.href = res.redirect;
              return;
            }
    
            $('.message').printMessage({message : res.message});
            $('.message').fadeIn();
            resetForm();
            if (typeof id_surat_pengantar !== 'undefined') {
                    $('#tbl_korduk_surat_pindah_surat_pengantar_galery').fineUploader('deleteFile', id_surat_pengantar);
                }
            if (typeof id_ktp !== 'undefined') {
                    $('#tbl_korduk_surat_pindah_ktp_galery').fineUploader('deleteFile', id_ktp);
                }
            if (typeof id_kk !== 'undefined') {
                    $('#tbl_korduk_surat_pindah_kk_galery').fineUploader('deleteFile', id_kk);
                }
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
      
              var params = {};
       params[csrf] = token;

       $('#tbl_korduk_surat_pindah_surat_pengantar_galery').fineUploader({
          template: 'qq-template-gallery',
          request: {
              endpoint: BASE_URL + '/tbl_korduk_surat_pindah/upload_surat_pengantar_file',
              params : params
          },
          deleteFile: {
              enabled: true, 
              endpoint: BASE_URL + '/tbl_korduk_surat_pindah/delete_surat_pengantar_file',
          },
          thumbnails: {
              placeholders: {
                  waitingPath: BASE_URL + '/asset/fine-upload/placeholders/waiting-generic.png',
                  notAvailablePath: BASE_URL + '/asset/fine-upload/placeholders/not_available-generic.png'
              }
          },
          multiple : false,
          validation: {
              allowedExtensions: ["jpg","png","pdf"],
              sizeLimit : 307200,
                        },
          showMessage: function(msg) {
              toastr['error'](msg);
          },
          callbacks: {
              onComplete : function(id, name, xhr) {
                if (xhr.success) {
                   var uuid = $('#tbl_korduk_surat_pindah_surat_pengantar_galery').fineUploader('getUuid', id);
                   $('#tbl_korduk_surat_pindah_surat_pengantar_uuid').val(uuid);
                   $('#tbl_korduk_surat_pindah_surat_pengantar_name').val(xhr.uploadName);
                } else {
                   toastr['error'](xhr.error);
                }
              },
              onSubmit : function(id, name) {
                  var uuid = $('#tbl_korduk_surat_pindah_surat_pengantar_uuid').val();
                  $.get(BASE_URL + '/tbl_korduk_surat_pindah/delete_surat_pengantar_file/' + uuid);
              },
              onDeleteComplete : function(id, xhr, isError) {
                if (isError == false) {
                  $('#tbl_korduk_surat_pindah_surat_pengantar_uuid').val('');
                  $('#tbl_korduk_surat_pindah_surat_pengantar_name').val('');
                }
              }
          }
      }); /*end surat_pengantar galery*/
                     var params = {};
       params[csrf] = token;

       $('#tbl_korduk_surat_pindah_ktp_galery').fineUploader({
          template: 'qq-template-gallery',
          request: {
              endpoint: BASE_URL + '/tbl_korduk_surat_pindah/upload_ktp_file',
              params : params
          },
          deleteFile: {
              enabled: true, 
              endpoint: BASE_URL + '/tbl_korduk_surat_pindah/delete_ktp_file',
          },
          thumbnails: {
              placeholders: {
                  waitingPath: BASE_URL + '/asset/fine-upload/placeholders/waiting-generic.png',
                  notAvailablePath: BASE_URL + '/asset/fine-upload/placeholders/not_available-generic.png'
              }
          },
          multiple : false,
          validation: {
              allowedExtensions: ["jpg","png","pdf"],
              sizeLimit : 307200,
                        },
          showMessage: function(msg) {
              toastr['error'](msg);
          },
          callbacks: {
              onComplete : function(id, name, xhr) {
                if (xhr.success) {
                   var uuid = $('#tbl_korduk_surat_pindah_ktp_galery').fineUploader('getUuid', id);
                   $('#tbl_korduk_surat_pindah_ktp_uuid').val(uuid);
                   $('#tbl_korduk_surat_pindah_ktp_name').val(xhr.uploadName);
                } else {
                   toastr['error'](xhr.error);
                }
              },
              onSubmit : function(id, name) {
                  var uuid = $('#tbl_korduk_surat_pindah_ktp_uuid').val();
                  $.get(BASE_URL + '/tbl_korduk_surat_pindah/delete_ktp_file/' + uuid);
              },
              onDeleteComplete : function(id, xhr, isError) {
                if (isError == false) {
                  $('#tbl_korduk_surat_pindah_ktp_uuid').val('');
                  $('#tbl_korduk_surat_pindah_ktp_name').val('');
                }
              }
          }
      }); /*end ktp galery*/
                     var params = {};
       params[csrf] = token;

       $('#tbl_korduk_surat_pindah_kk_galery').fineUploader({
          template: 'qq-template-gallery',
          request: {
              endpoint: BASE_URL + '/tbl_korduk_surat_pindah/upload_kk_file',
              params : params
          },
          deleteFile: {
              enabled: true, 
              endpoint: BASE_URL + '/tbl_korduk_surat_pindah/delete_kk_file',
          },
          thumbnails: {
              placeholders: {
                  waitingPath: BASE_URL + '/asset/fine-upload/placeholders/waiting-generic.png',
                  notAvailablePath: BASE_URL + '/asset/fine-upload/placeholders/not_available-generic.png'
              }
          },
          multiple : false,
          validation: {
              allowedExtensions: ["jpg","png","pdf"],
              sizeLimit : 307200,
                        },
          showMessage: function(msg) {
              toastr['error'](msg);
          },
          callbacks: {
              onComplete : function(id, name, xhr) {
                if (xhr.success) {
                   var uuid = $('#tbl_korduk_surat_pindah_kk_galery').fineUploader('getUuid', id);
                   $('#tbl_korduk_surat_pindah_kk_uuid').val(uuid);
                   $('#tbl_korduk_surat_pindah_kk_name').val(xhr.uploadName);
                } else {
                   toastr['error'](xhr.error);
                }
              },
              onSubmit : function(id, name) {
                  var uuid = $('#tbl_korduk_surat_pindah_kk_uuid').val();
                  $.get(BASE_URL + '/tbl_korduk_surat_pindah/delete_kk_file/' + uuid);
              },
              onDeleteComplete : function(id, xhr, isError) {
                if (isError == false) {
                  $('#tbl_korduk_surat_pindah_kk_uuid').val('');
                  $('#tbl_korduk_surat_pindah_kk_name').val('');
                }
              }
          }
      }); /*end kk galery*/
              
 
       
    
    
    }); /*end doc ready*/
</script>