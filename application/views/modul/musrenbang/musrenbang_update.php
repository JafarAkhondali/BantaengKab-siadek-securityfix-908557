
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
                            <h3 class="widget-user-username"><b>Musrenbang</b></h3>
                            <h5 class="widget-user-desc">Edit Musrenbang</h5>
                            <hr>
                        </div>
                        <?= form_open(base_url('musrenbang/edit_save/'.$this->uri->segment(3)), [
                            'name'    => 'form_musrenbang', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_musrenbang', 
                            'method'  => 'POST'
                            ]); ?>
                            
                             <div class="form-group ">
                            <label for="kd_rekening" class="col-sm-4 control-label">Kode Rekening
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="kd_rekening" id="kd_rekening" placeholder="kd_rekening" value="<?= set_value('kd_rekening', $musrenbang->kd_rekening); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="kegitan" class="col-sm-2 control-label">Kegiatan 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="kegitan" id="kegitan" placeholder="Kegitan" value="<?= set_value('kegitan', $musrenbang->kegitan); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="Lokasi" class="col-sm-2 control-label">Lokasi 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="Lokasi" id="Lokasi" placeholder="Lokasi" value="<?= set_value('Lokasi', $musrenbang->Lokasi); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="Biaya" class="col-sm-2 control-label">Biaya 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="Biaya" id="Biaya" placeholder="Biaya" value="<?= set_value('Biaya', $musrenbang->Biaya); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="total" class="col-sm-2 control-label">Total 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="total" id="total" placeholder="Total" value="<?= set_value('total', $musrenbang->total); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="berita_acara" class="col-sm-2 control-label">Berita Acara 
                            </label>
                            <div class="col-sm-8">
                                <div id="musrenbang_berita_acara_galery"></div>
                                <input class="data_file data_file_uuid" name="musrenbang_berita_acara_uuid" id="musrenbang_berita_acara_uuid" type="hidden" value="<?= set_value('musrenbang_berita_acara_uuid'); ?>">
                                <input class="data_file" name="musrenbang_berita_acara_name" id="musrenbang_berita_acara_name" type="hidden" value="<?= set_value('musrenbang_berita_acara_name', $musrenbang->berita_acara); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                  
                                                <div class="form-group ">
                            <label for="daftar_hadir" class="col-sm-2 control-label">Daftar Hadir 
                            </label>
                            <div class="col-sm-8">
                                <div id="musrenbang_daftar_hadir_galery"></div>
                                <input class="data_file data_file_uuid" name="musrenbang_daftar_hadir_uuid" id="musrenbang_daftar_hadir_uuid" type="hidden" value="<?= set_value('musrenbang_daftar_hadir_uuid'); ?>">
                                <input class="data_file" name="musrenbang_daftar_hadir_name" id="musrenbang_daftar_hadir_name" type="hidden" value="<?= set_value('musrenbang_daftar_hadir_name', $musrenbang->daftar_hadir); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                  
                                                <div class="form-group ">
                            <label for="notulensi_rapat" class="col-sm-2 control-label">Notulensi Rapat 
                            </label>
                            <div class="col-sm-8">
                                <div id="musrenbang_notulensi_rapat_galery"></div>
                                <input class="data_file data_file_uuid" name="musrenbang_notulensi_rapat_uuid" id="musrenbang_notulensi_rapat_uuid" type="hidden" value="<?= set_value('musrenbang_notulensi_rapat_uuid'); ?>">
                                <input class="data_file" name="musrenbang_notulensi_rapat_name" id="musrenbang_notulensi_rapat_name" type="hidden" value="<?= set_value('musrenbang_notulensi_rapat_name', $musrenbang->notulensi_rapat); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                  
                                                <div class="form-group ">
                            <label for="ket_usulan" class="col-sm-2 control-label">Ket Usulan 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <textarea id="ket_usulan" name="ket_usulan" rows="5" class="textarea"><?= set_value('ket_usulan', $musrenbang->ket_usulan); ?></textarea>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="satatus_program" class="col-sm-2 control-label">Status Program 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select" name="satatus_program" id="satatus_program" data-placeholder="Select Satatus Program" >
                                    <option value=""></option>
                                    <option <?= $musrenbang->satatus_program == "1" ? 'selected' :''; ?> value="1">Usulan</option>
                                    <option <?= $musrenbang->satatus_program == "2" ? 'selected' :''; ?> value="2">Diterima</option>
                                    </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="Tahun" class="col-sm-2 control-label">Tahun 
                            </label>
                            <div class="col-sm-2">
                                <select  class="form-control chosen chosen-select-deselect" name="Tahun" id="Tahun" data-placeholder="Select Tahun" >
                                    <option value=""></option>
                                    <?php for ($i = 1970; $i < date('Y')+100; $i++){ ?>
                                    <option <?=  $i ==  $musrenbang->Tahun ? 'selected' : ''; ?> value="<?= $i; ?>"><?= $i; ?></option>
                                    <?php }; ?>  
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                         
                                                <div class="form-group ">
                            <label for="tanggal_masuk" class="col-sm-2 control-label">Tanggal Masuk 
                            </label>
                            <div class="col-sm-6">
                            <div class="input-group date col-sm-8">
                              <input type="text" class="form-control pull-right datetimepicker" name="tanggal_masuk"  placeholder="Tanggal Masuk" id="tanggal_masuk" value="<?= set_value('tanggal_masuk', $musrenbang->tanggal_masuk); ?>">
                            </div>
                            <small class="info help-block">
                            </small>
                            </div>
                        </div>
                                                 
                         
                                                <div class="form-group ">
                            <label for="tanggal_update" class="col-sm-2 control-label">Tanggal Update 
                            </label>
                            <div class="col-sm-6">
                            <div class="input-group date col-sm-8">
                              <input type="text" class="form-control pull-right datetimepicker" name="tanggal_update"  placeholder="Tanggal Update" id="tanggal_update" value="<?= set_value('tanggal_update', $musrenbang->tanggal_update); ?>">
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
              window.location.href = BASE_URL + 'musrenbang';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
            
        var form_musrenbang = $('#form_musrenbang');
        var data_post = form_musrenbang.serializeArray();
        var save_type = $(this).attr('data-stype');
        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: form_musrenbang.attr('action'),
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if(res.success) {
            var id = $('#musrenbang_image_galery').find('li').attr('qq-file-id');
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

       $('#musrenbang_berita_acara_galery').fineUploader({
          template: 'qq-template-gallery',
          request: {
              endpoint: BASE_URL + '/musrenbang/upload_berita_acara_file',
              params : params
          },
          deleteFile: {
              enabled: true, // defaults to false
              endpoint: BASE_URL + '/musrenbang/delete_berita_acara_file'
          },
          thumbnails: {
              placeholders: {
                  waitingPath: BASE_URL + '/asset/fine-upload/placeholders/waiting-generic.png',
                  notAvailablePath: BASE_URL + '/asset/fine-upload/placeholders/not_available-generic.png'
              }
          },
           session : {
             endpoint: BASE_URL + 'musrenbang/get_berita_acara_file/<?= $musrenbang->id_musrenbang; ?>',
             refreshOnRequest:true
           },
          multiple : false,
          validation: {
              allowedExtensions: ["*"],
              sizeLimit : 0,
                        },
          showMessage: function(msg) {
              toastr['error'](msg);
          },
          callbacks: {
              onComplete : function(id, name, xhr) {
                if (xhr.success) {
                   var uuid = $('#musrenbang_berita_acara_galery').fineUploader('getUuid', id);
                   $('#musrenbang_berita_acara_uuid').val(uuid);
                   $('#musrenbang_berita_acara_name').val(xhr.uploadName);
                } else {
                   toastr['error'](xhr.error);
                }
              },
              onSubmit : function(id, name) {
                  var uuid = $('#musrenbang_berita_acara_uuid').val();
                  $.get(BASE_URL + '/musrenbang/delete_berita_acara_file/' + uuid);
              },
              onDeleteComplete : function(id, xhr, isError) {
                if (isError == false) {
                  $('#musrenbang_berita_acara_uuid').val('');
                  $('#musrenbang_berita_acara_name').val('');
                }
              }
          }
      }); /*end berita_acara galey*/
                            var params = {};
       params[csrf] = token;

       $('#musrenbang_daftar_hadir_galery').fineUploader({
          template: 'qq-template-gallery',
          request: {
              endpoint: BASE_URL + '/musrenbang/upload_daftar_hadir_file',
              params : params
          },
          deleteFile: {
              enabled: true, // defaults to false
              endpoint: BASE_URL + '/musrenbang/delete_daftar_hadir_file'
          },
          thumbnails: {
              placeholders: {
                  waitingPath: BASE_URL + '/asset/fine-upload/placeholders/waiting-generic.png',
                  notAvailablePath: BASE_URL + '/asset/fine-upload/placeholders/not_available-generic.png'
              }
          },
           session : {
             endpoint: BASE_URL + 'musrenbang/get_daftar_hadir_file/<?= $musrenbang->id_musrenbang; ?>',
             refreshOnRequest:true
           },
          multiple : false,
          validation: {
              allowedExtensions: ["*"],
              sizeLimit : 0,
                        },
          showMessage: function(msg) {
              toastr['error'](msg);
          },
          callbacks: {
              onComplete : function(id, name, xhr) {
                if (xhr.success) {
                   var uuid = $('#musrenbang_daftar_hadir_galery').fineUploader('getUuid', id);
                   $('#musrenbang_daftar_hadir_uuid').val(uuid);
                   $('#musrenbang_daftar_hadir_name').val(xhr.uploadName);
                } else {
                   toastr['error'](xhr.error);
                }
              },
              onSubmit : function(id, name) {
                  var uuid = $('#musrenbang_daftar_hadir_uuid').val();
                  $.get(BASE_URL + '/musrenbang/delete_daftar_hadir_file/' + uuid);
              },
              onDeleteComplete : function(id, xhr, isError) {
                if (isError == false) {
                  $('#musrenbang_daftar_hadir_uuid').val('');
                  $('#musrenbang_daftar_hadir_name').val('');
                }
              }
          }
      }); /*end daftar_hadir galey*/
                            var params = {};
       params[csrf] = token;

       $('#musrenbang_notulensi_rapat_galery').fineUploader({
          template: 'qq-template-gallery',
          request: {
              endpoint: BASE_URL + '/musrenbang/upload_notulensi_rapat_file',
              params : params
          },
          deleteFile: {
              enabled: true, // defaults to false
              endpoint: BASE_URL + '/musrenbang/delete_notulensi_rapat_file'
          },
          thumbnails: {
              placeholders: {
                  waitingPath: BASE_URL + '/asset/fine-upload/placeholders/waiting-generic.png',
                  notAvailablePath: BASE_URL + '/asset/fine-upload/placeholders/not_available-generic.png'
              }
          },
           session : {
             endpoint: BASE_URL + 'musrenbang/get_notulensi_rapat_file/<?= $musrenbang->id_musrenbang; ?>',
             refreshOnRequest:true
           },
          multiple : false,
          validation: {
              allowedExtensions: ["*"],
              sizeLimit : 0,
                        },
          showMessage: function(msg) {
              toastr['error'](msg);
          },
          callbacks: {
              onComplete : function(id, name, xhr) {
                if (xhr.success) {
                   var uuid = $('#musrenbang_notulensi_rapat_galery').fineUploader('getUuid', id);
                   $('#musrenbang_notulensi_rapat_uuid').val(uuid);
                   $('#musrenbang_notulensi_rapat_name').val(xhr.uploadName);
                } else {
                   toastr['error'](xhr.error);
                }
              },
              onSubmit : function(id, name) {
                  var uuid = $('#musrenbang_notulensi_rapat_uuid').val();
                  $.get(BASE_URL + '/musrenbang/delete_notulensi_rapat_file/' + uuid);
              },
              onDeleteComplete : function(id, xhr, isError) {
                if (isError == false) {
                  $('#musrenbang_notulensi_rapat_uuid').val('');
                  $('#musrenbang_notulensi_rapat_name').val('');
                }
              }
          }
      }); /*end notulensi_rapat galey*/
              
       
           
    
    }); /*end doc ready*/
</script>