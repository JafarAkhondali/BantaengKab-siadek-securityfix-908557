
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
                            <h3 class="widget-user-username"><b>Adminduk Akta Kelahiran</b></h3>
                            <h5 class="widget-user-desc">Edit Adminduk Akta Kelahiran</h5>
                            <hr>
                        </div>
                        <?= form_open(base_url('tbl_korduk_akta_kelahiran/edit_save/'.$this->uri->segment(3)), [
                            'name'    => 'form_tbl_korduk_akta_kelahiran', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_tbl_korduk_akta_kelahiran', 
                            'method'  => 'POST'
                            ]); ?>
                         
                                                <div class="form-group ">
                            <label for="no_kk" class="col-sm-2 control-label">No KK 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="no_kk" id="no_kk" placeholder="No KK" value="<?= set_value('no_kk', $tbl_korduk_akta_kelahiran->no_kk); ?>">
                                <small class="info help-block">
                                <b>Input No Kk</b> Max Length : 100.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="kepala_keluarga" class="col-sm-2 control-label">Kepala Keluarga 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="kepala_keluarga" id="kepala_keluarga" placeholder="Kepala Keluarga" value="<?= set_value('kepala_keluarga', $tbl_korduk_akta_kelahiran->kepala_keluarga); ?>">
                                <small class="info help-block">
                                <b>Input Kepala Keluarga</b> Max Length : 100.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="alamat" class="col-sm-2 control-label">Alamat 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat" value="<?= set_value('alamat', $tbl_korduk_akta_kelahiran->alamat); ?>">
                                <small class="info help-block">
                                <b>Input Alamat</b> Max Length : 200.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="form_f228" class="col-sm-2 control-label">Form F-2.28 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <div id="tbl_korduk_akta_kelahiran_form_f228_galery"></div>
                                <input class="data_file data_file_uuid" name="tbl_korduk_akta_kelahiran_form_f228_uuid" id="tbl_korduk_akta_kelahiran_form_f228_uuid" type="hidden" value="<?= set_value('tbl_korduk_akta_kelahiran_form_f228_uuid'); ?>">
                                <input class="data_file" name="tbl_korduk_akta_kelahiran_form_f228_name" id="tbl_korduk_akta_kelahiran_form_f228_name" type="hidden" value="<?= set_value('tbl_korduk_akta_kelahiran_form_f228_name', $tbl_korduk_akta_kelahiran->form_f228); ?>">
                                <small class="info help-block">
                                <b>Extension file must</b> JPG,PNG,PDF,  <b>Max size file</b>  500 kb.</small>
                            </div>
                        </div>
                                                  
                                                <div class="form-group ">
                            <label for="kk" class="col-sm-2 control-label">KK 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <div id="tbl_korduk_akta_kelahiran_kk_galery"></div>
                                <input class="data_file data_file_uuid" name="tbl_korduk_akta_kelahiran_kk_uuid" id="tbl_korduk_akta_kelahiran_kk_uuid" type="hidden" value="<?= set_value('tbl_korduk_akta_kelahiran_kk_uuid'); ?>">
                                <input class="data_file" name="tbl_korduk_akta_kelahiran_kk_name" id="tbl_korduk_akta_kelahiran_kk_name" type="hidden" value="<?= set_value('tbl_korduk_akta_kelahiran_kk_name', $tbl_korduk_akta_kelahiran->kk); ?>">
                                <small class="info help-block">
                                <b>Extension file must</b> JPG,PNG,PDF,  <b>Max size file</b>  300 kb.</small>
                            </div>
                        </div>
                                                  
                                                <div class="form-group ">
                            <label for="ktp_ayah" class="col-sm-2 control-label">KTP Ayah 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <div id="tbl_korduk_akta_kelahiran_ktp_ayah_galery"></div>
                                <input class="data_file data_file_uuid" name="tbl_korduk_akta_kelahiran_ktp_ayah_uuid" id="tbl_korduk_akta_kelahiran_ktp_ayah_uuid" type="hidden" value="<?= set_value('tbl_korduk_akta_kelahiran_ktp_ayah_uuid'); ?>">
                                <input class="data_file" name="tbl_korduk_akta_kelahiran_ktp_ayah_name" id="tbl_korduk_akta_kelahiran_ktp_ayah_name" type="hidden" value="<?= set_value('tbl_korduk_akta_kelahiran_ktp_ayah_name', $tbl_korduk_akta_kelahiran->ktp_ayah); ?>">
                                <small class="info help-block">
                                <b>Extension file must</b> JPG,PNG,PDF,  <b>Max size file</b>  300 kb.</small>
                            </div>
                        </div>
                                                  
                                                <div class="form-group ">
                            <label for="ktp_ibu" class="col-sm-2 control-label">KTP Ibu 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <div id="tbl_korduk_akta_kelahiran_ktp_ibu_galery"></div>
                                <input class="data_file data_file_uuid" name="tbl_korduk_akta_kelahiran_ktp_ibu_uuid" id="tbl_korduk_akta_kelahiran_ktp_ibu_uuid" type="hidden" value="<?= set_value('tbl_korduk_akta_kelahiran_ktp_ibu_uuid'); ?>">
                                <input class="data_file" name="tbl_korduk_akta_kelahiran_ktp_ibu_name" id="tbl_korduk_akta_kelahiran_ktp_ibu_name" type="hidden" value="<?= set_value('tbl_korduk_akta_kelahiran_ktp_ibu_name', $tbl_korduk_akta_kelahiran->ktp_ibu); ?>">
                                <small class="info help-block">
                                <b>Extension file must</b> JPG,PNG,PDF,  <b>Max size file</b>  300 kb.</small>
                            </div>
                        </div>
                                                  
                                                <div class="form-group ">
                            <label for="akta_pernikahan" class="col-sm-2 control-label">Akta Pernikahan 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <div id="tbl_korduk_akta_kelahiran_akta_pernikahan_galery"></div>
                                <input class="data_file data_file_uuid" name="tbl_korduk_akta_kelahiran_akta_pernikahan_uuid" id="tbl_korduk_akta_kelahiran_akta_pernikahan_uuid" type="hidden" value="<?= set_value('tbl_korduk_akta_kelahiran_akta_pernikahan_uuid'); ?>">
                                <input class="data_file" name="tbl_korduk_akta_kelahiran_akta_pernikahan_name" id="tbl_korduk_akta_kelahiran_akta_pernikahan_name" type="hidden" value="<?= set_value('tbl_korduk_akta_kelahiran_akta_pernikahan_name', $tbl_korduk_akta_kelahiran->akta_pernikahan); ?>">
                                <small class="info help-block">
                                <b>Extension file must</b> JPG,PNG,PDF,  <b>Max size file</b>  300 kb.</small>
                            </div>
                        </div>
                                                  
                                                <div class="form-group ">
                            <label for="form_f201" class="col-sm-2 control-label">Form F-2.01 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <div id="tbl_korduk_akta_kelahiran_form_f201_galery"></div>
                                <input class="data_file data_file_uuid" name="tbl_korduk_akta_kelahiran_form_f201_uuid" id="tbl_korduk_akta_kelahiran_form_f201_uuid" type="hidden" value="<?= set_value('tbl_korduk_akta_kelahiran_form_f201_uuid'); ?>">
                                <input class="data_file" name="tbl_korduk_akta_kelahiran_form_f201_name" id="tbl_korduk_akta_kelahiran_form_f201_name" type="hidden" value="<?= set_value('tbl_korduk_akta_kelahiran_form_f201_name', $tbl_korduk_akta_kelahiran->form_f201); ?>">
                                <small class="info help-block">
                                <b>Extension file must</b> JPG,PNG,PDF,  <b>Max size file</b>  500 kb.</small>
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
              window.location.href = BASE_URL + 'tbl_korduk_akta_kelahiran';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
            
        var form_tbl_korduk_akta_kelahiran = $('#form_tbl_korduk_akta_kelahiran');
        var data_post = form_tbl_korduk_akta_kelahiran.serializeArray();
        var save_type = $(this).attr('data-stype');
        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: form_tbl_korduk_akta_kelahiran.attr('action'),
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if(res.success) {
            var id = $('#tbl_korduk_akta_kelahiran_image_galery').find('li').attr('qq-file-id');
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

       $('#tbl_korduk_akta_kelahiran_form_f228_galery').fineUploader({
          template: 'qq-template-gallery',
          request: {
              endpoint: BASE_URL + '/tbl_korduk_akta_kelahiran/upload_form_f228_file',
              params : params
          },
          deleteFile: {
              enabled: true, // defaults to false
              endpoint: BASE_URL + '/tbl_korduk_akta_kelahiran/delete_form_f228_file'
          },
          thumbnails: {
              placeholders: {
                  waitingPath: BASE_URL + '/asset/fine-upload/placeholders/waiting-generic.png',
                  notAvailablePath: BASE_URL + '/asset/fine-upload/placeholders/not_available-generic.png'
              }
          },
           session : {
             endpoint: BASE_URL + 'tbl_korduk_akta_kelahiran/get_form_f228_file/<?= $tbl_korduk_akta_kelahiran->id; ?>',
             refreshOnRequest:true
           },
          multiple : false,
          validation: {
              allowedExtensions: ["jpg","png","pdf"],
              sizeLimit : 512000,
                        },
          showMessage: function(msg) {
              toastr['error'](msg);
          },
          callbacks: {
              onComplete : function(id, name, xhr) {
                if (xhr.success) {
                   var uuid = $('#tbl_korduk_akta_kelahiran_form_f228_galery').fineUploader('getUuid', id);
                   $('#tbl_korduk_akta_kelahiran_form_f228_uuid').val(uuid);
                   $('#tbl_korduk_akta_kelahiran_form_f228_name').val(xhr.uploadName);
                } else {
                   toastr['error'](xhr.error);
                }
              },
              onSubmit : function(id, name) {
                  var uuid = $('#tbl_korduk_akta_kelahiran_form_f228_uuid').val();
                  $.get(BASE_URL + '/tbl_korduk_akta_kelahiran/delete_form_f228_file/' + uuid);
              },
              onDeleteComplete : function(id, xhr, isError) {
                if (isError == false) {
                  $('#tbl_korduk_akta_kelahiran_form_f228_uuid').val('');
                  $('#tbl_korduk_akta_kelahiran_form_f228_name').val('');
                }
              }
          }
      }); /*end form_f228 galey*/
                            var params = {};
       params[csrf] = token;

       $('#tbl_korduk_akta_kelahiran_kk_galery').fineUploader({
          template: 'qq-template-gallery',
          request: {
              endpoint: BASE_URL + '/tbl_korduk_akta_kelahiran/upload_kk_file',
              params : params
          },
          deleteFile: {
              enabled: true, // defaults to false
              endpoint: BASE_URL + '/tbl_korduk_akta_kelahiran/delete_kk_file'
          },
          thumbnails: {
              placeholders: {
                  waitingPath: BASE_URL + '/asset/fine-upload/placeholders/waiting-generic.png',
                  notAvailablePath: BASE_URL + '/asset/fine-upload/placeholders/not_available-generic.png'
              }
          },
           session : {
             endpoint: BASE_URL + 'tbl_korduk_akta_kelahiran/get_kk_file/<?= $tbl_korduk_akta_kelahiran->id; ?>',
             refreshOnRequest:true
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
                   var uuid = $('#tbl_korduk_akta_kelahiran_kk_galery').fineUploader('getUuid', id);
                   $('#tbl_korduk_akta_kelahiran_kk_uuid').val(uuid);
                   $('#tbl_korduk_akta_kelahiran_kk_name').val(xhr.uploadName);
                } else {
                   toastr['error'](xhr.error);
                }
              },
              onSubmit : function(id, name) {
                  var uuid = $('#tbl_korduk_akta_kelahiran_kk_uuid').val();
                  $.get(BASE_URL + '/tbl_korduk_akta_kelahiran/delete_kk_file/' + uuid);
              },
              onDeleteComplete : function(id, xhr, isError) {
                if (isError == false) {
                  $('#tbl_korduk_akta_kelahiran_kk_uuid').val('');
                  $('#tbl_korduk_akta_kelahiran_kk_name').val('');
                }
              }
          }
      }); /*end kk galey*/
                            var params = {};
       params[csrf] = token;

       $('#tbl_korduk_akta_kelahiran_ktp_ayah_galery').fineUploader({
          template: 'qq-template-gallery',
          request: {
              endpoint: BASE_URL + '/tbl_korduk_akta_kelahiran/upload_ktp_ayah_file',
              params : params
          },
          deleteFile: {
              enabled: true, // defaults to false
              endpoint: BASE_URL + '/tbl_korduk_akta_kelahiran/delete_ktp_ayah_file'
          },
          thumbnails: {
              placeholders: {
                  waitingPath: BASE_URL + '/asset/fine-upload/placeholders/waiting-generic.png',
                  notAvailablePath: BASE_URL + '/asset/fine-upload/placeholders/not_available-generic.png'
              }
          },
           session : {
             endpoint: BASE_URL + 'tbl_korduk_akta_kelahiran/get_ktp_ayah_file/<?= $tbl_korduk_akta_kelahiran->id; ?>',
             refreshOnRequest:true
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
                   var uuid = $('#tbl_korduk_akta_kelahiran_ktp_ayah_galery').fineUploader('getUuid', id);
                   $('#tbl_korduk_akta_kelahiran_ktp_ayah_uuid').val(uuid);
                   $('#tbl_korduk_akta_kelahiran_ktp_ayah_name').val(xhr.uploadName);
                } else {
                   toastr['error'](xhr.error);
                }
              },
              onSubmit : function(id, name) {
                  var uuid = $('#tbl_korduk_akta_kelahiran_ktp_ayah_uuid').val();
                  $.get(BASE_URL + '/tbl_korduk_akta_kelahiran/delete_ktp_ayah_file/' + uuid);
              },
              onDeleteComplete : function(id, xhr, isError) {
                if (isError == false) {
                  $('#tbl_korduk_akta_kelahiran_ktp_ayah_uuid').val('');
                  $('#tbl_korduk_akta_kelahiran_ktp_ayah_name').val('');
                }
              }
          }
      }); /*end ktp_ayah galey*/
                            var params = {};
       params[csrf] = token;

       $('#tbl_korduk_akta_kelahiran_ktp_ibu_galery').fineUploader({
          template: 'qq-template-gallery',
          request: {
              endpoint: BASE_URL + '/tbl_korduk_akta_kelahiran/upload_ktp_ibu_file',
              params : params
          },
          deleteFile: {
              enabled: true, // defaults to false
              endpoint: BASE_URL + '/tbl_korduk_akta_kelahiran/delete_ktp_ibu_file'
          },
          thumbnails: {
              placeholders: {
                  waitingPath: BASE_URL + '/asset/fine-upload/placeholders/waiting-generic.png',
                  notAvailablePath: BASE_URL + '/asset/fine-upload/placeholders/not_available-generic.png'
              }
          },
           session : {
             endpoint: BASE_URL + 'tbl_korduk_akta_kelahiran/get_ktp_ibu_file/<?= $tbl_korduk_akta_kelahiran->id; ?>',
             refreshOnRequest:true
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
                   var uuid = $('#tbl_korduk_akta_kelahiran_ktp_ibu_galery').fineUploader('getUuid', id);
                   $('#tbl_korduk_akta_kelahiran_ktp_ibu_uuid').val(uuid);
                   $('#tbl_korduk_akta_kelahiran_ktp_ibu_name').val(xhr.uploadName);
                } else {
                   toastr['error'](xhr.error);
                }
              },
              onSubmit : function(id, name) {
                  var uuid = $('#tbl_korduk_akta_kelahiran_ktp_ibu_uuid').val();
                  $.get(BASE_URL + '/tbl_korduk_akta_kelahiran/delete_ktp_ibu_file/' + uuid);
              },
              onDeleteComplete : function(id, xhr, isError) {
                if (isError == false) {
                  $('#tbl_korduk_akta_kelahiran_ktp_ibu_uuid').val('');
                  $('#tbl_korduk_akta_kelahiran_ktp_ibu_name').val('');
                }
              }
          }
      }); /*end ktp_ibu galey*/
                            var params = {};
       params[csrf] = token;

       $('#tbl_korduk_akta_kelahiran_akta_pernikahan_galery').fineUploader({
          template: 'qq-template-gallery',
          request: {
              endpoint: BASE_URL + '/tbl_korduk_akta_kelahiran/upload_akta_pernikahan_file',
              params : params
          },
          deleteFile: {
              enabled: true, // defaults to false
              endpoint: BASE_URL + '/tbl_korduk_akta_kelahiran/delete_akta_pernikahan_file'
          },
          thumbnails: {
              placeholders: {
                  waitingPath: BASE_URL + '/asset/fine-upload/placeholders/waiting-generic.png',
                  notAvailablePath: BASE_URL + '/asset/fine-upload/placeholders/not_available-generic.png'
              }
          },
           session : {
             endpoint: BASE_URL + 'tbl_korduk_akta_kelahiran/get_akta_pernikahan_file/<?= $tbl_korduk_akta_kelahiran->id; ?>',
             refreshOnRequest:true
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
                   var uuid = $('#tbl_korduk_akta_kelahiran_akta_pernikahan_galery').fineUploader('getUuid', id);
                   $('#tbl_korduk_akta_kelahiran_akta_pernikahan_uuid').val(uuid);
                   $('#tbl_korduk_akta_kelahiran_akta_pernikahan_name').val(xhr.uploadName);
                } else {
                   toastr['error'](xhr.error);
                }
              },
              onSubmit : function(id, name) {
                  var uuid = $('#tbl_korduk_akta_kelahiran_akta_pernikahan_uuid').val();
                  $.get(BASE_URL + '/tbl_korduk_akta_kelahiran/delete_akta_pernikahan_file/' + uuid);
              },
              onDeleteComplete : function(id, xhr, isError) {
                if (isError == false) {
                  $('#tbl_korduk_akta_kelahiran_akta_pernikahan_uuid').val('');
                  $('#tbl_korduk_akta_kelahiran_akta_pernikahan_name').val('');
                }
              }
          }
      }); /*end akta_pernikahan galey*/
                            var params = {};
       params[csrf] = token;

       $('#tbl_korduk_akta_kelahiran_form_f201_galery').fineUploader({
          template: 'qq-template-gallery',
          request: {
              endpoint: BASE_URL + '/tbl_korduk_akta_kelahiran/upload_form_f201_file',
              params : params
          },
          deleteFile: {
              enabled: true, // defaults to false
              endpoint: BASE_URL + '/tbl_korduk_akta_kelahiran/delete_form_f201_file'
          },
          thumbnails: {
              placeholders: {
                  waitingPath: BASE_URL + '/asset/fine-upload/placeholders/waiting-generic.png',
                  notAvailablePath: BASE_URL + '/asset/fine-upload/placeholders/not_available-generic.png'
              }
          },
           session : {
             endpoint: BASE_URL + 'tbl_korduk_akta_kelahiran/get_form_f201_file/<?= $tbl_korduk_akta_kelahiran->id; ?>',
             refreshOnRequest:true
           },
          multiple : false,
          validation: {
              allowedExtensions: ["jpg","png","pdf"],
              sizeLimit : 512000,
                        },
          showMessage: function(msg) {
              toastr['error'](msg);
          },
          callbacks: {
              onComplete : function(id, name, xhr) {
                if (xhr.success) {
                   var uuid = $('#tbl_korduk_akta_kelahiran_form_f201_galery').fineUploader('getUuid', id);
                   $('#tbl_korduk_akta_kelahiran_form_f201_uuid').val(uuid);
                   $('#tbl_korduk_akta_kelahiran_form_f201_name').val(xhr.uploadName);
                } else {
                   toastr['error'](xhr.error);
                }
              },
              onSubmit : function(id, name) {
                  var uuid = $('#tbl_korduk_akta_kelahiran_form_f201_uuid').val();
                  $.get(BASE_URL + '/tbl_korduk_akta_kelahiran/delete_form_f201_file/' + uuid);
              },
              onDeleteComplete : function(id, xhr, isError) {
                if (isError == false) {
                  $('#tbl_korduk_akta_kelahiran_form_f201_uuid').val('');
                  $('#tbl_korduk_akta_kelahiran_form_f201_name').val('');
                }
              }
          }
      }); /*end form_f201 galey*/
              
       
           
    
    }); /*end doc ready*/
</script>