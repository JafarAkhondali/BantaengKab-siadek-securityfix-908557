
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
                            <h3 class="widget-user-username"><b>Kepala Desa</b></h3>
                            <h5 class="widget-user-desc">Edit Kepala Desa</h5>
                            <hr>
                        </div>
                        <?= form_open(base_url('wilayah_kepala/edit_save/'.$this->uri->segment(3)), [
                            'name'    => 'form_wilayah_kepala', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_wilayah_kepala', 
                            'method'  => 'POST'
                            ]); ?>
                            
                        <div class="col-lg-6">
                                                <div class="form-group ">
                            <label for="kd_wilayah" class="col-sm-4 control-label">Kd Wilayah 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input disabled type="text" class="form-control" name="kd_wilayah" id="kd_wilayah" placeholder="Kd Wilayah" value="<?= set_value('kd_wilayah', $wilayah_kepala->kd_wilayah); ?>">
                                <small class="info help-block">
                                <b>Input Kd Wilayah</b> Max Length : 30.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="nama" class="col-sm-4 control-label">Nama 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?= set_value('nama', $wilayah_kepala->nama); ?>">
                                <small class="info help-block">
                                <b>Input Nama</b> Max Length : 50.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="jabatan" class="col-sm-4 control-label">Jabatan 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select" name="jabatan[]" id="jabatan" data-placeholder="Select Jabatan" multiple >
                                    <option value=""></option>
                                    <option <?= in_array('Kepala Desa', explode(',', $wilayah_kepala->jabatan)) ? 'selected' : ''; ?>  value="Kepala Desa">Kepala Desa</option>
                                    <option <?= in_array('Lurah', explode(',', $wilayah_kepala->jabatan)) ? 'selected' : ''; ?>  value="Lurah">Lurah</option>
                                    <option <?= in_array('Camat', explode(',', $wilayah_kepala->jabatan)) ? 'selected' : ''; ?>  value="Camat">Camat</option>
                                    </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="jenis_kelamin" class="col-sm-4 control-label">Jenis Kelamin 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select" name="jenis_kelamin" id="jenis_kelamin" data-placeholder="Select Jenis Kelamin" >
                                    <option value=""></option>
                                    <option <?= $wilayah_kepala->jenis_kelamin == "Laki - Laki" ? 'selected' :''; ?> value="Laki - Laki">Laki - Laki</option>
                                    <option <?= $wilayah_kepala->jenis_kelamin == "Perempuan" ? 'selected' :''; ?> value="Perempuan">Perempuan</option>
                                    </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="usia" class="col-sm-4 control-label">Usia 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="usia" id="usia" placeholder="Usia" value="<?= set_value('usia', $wilayah_kepala->usia); ?>">
                                <small class="info help-block">
                                <b>Input Usia</b> Max Length : 20.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="agama" class="col-sm-4 control-label">Agama 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select" name="agama[]" id="agama" data-placeholder="Select Agama" multiple >
                                    <option value=""></option>
                                    <option <?= in_array('Islam', explode(',', $wilayah_kepala->agama)) ? 'selected' : ''; ?>  value="Islam">Islam</option>
                                    <option <?= in_array('Kristen Protestan', explode(',', $wilayah_kepala->agama)) ? 'selected' : ''; ?>  value="Kristen Protestan">Kristen Protestan</option>
                                    <option <?= in_array('Kristen Katolik', explode(',', $wilayah_kepala->agama)) ? 'selected' : ''; ?>  value="Kristen Katolik">Kristen Katolik</option>
                                    <option <?= in_array('Hindu', explode(',', $wilayah_kepala->agama)) ? 'selected' : ''; ?>  value="Hindu">Hindu</option>
                                    <option <?= in_array('Buddha', explode(',', $wilayah_kepala->agama)) ? 'selected' : ''; ?>  value="Buddha">Buddha</option>
                                    <option <?= in_array('Kong Hu Cu', explode(',', $wilayah_kepala->agama)) ? 'selected' : ''; ?>  value="Kong Hu Cu">Kong Hu Cu</option>
                                    </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="pend_terakhir" class="col-sm-4 control-label">Pend Terakhir 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select" name="pend_terakhir[]" id="pend_terakhir" data-placeholder="Select Pend Terakhir" multiple >
                                    <option value=""></option>
                                    <option <?= in_array('SD/Sederajat', explode(',', $wilayah_kepala->pend_terakhir)) ? 'selected' : ''; ?>  value="SD/Sederajat">SD/Sederajat</option>
                                    <option <?= in_array('SMP/Sederajat', explode(',', $wilayah_kepala->pend_terakhir)) ? 'selected' : ''; ?>  value="SMP/Sederajat">SMP/Sederajat</option>
                                    <option <?= in_array('SMA/Sederajat', explode(',', $wilayah_kepala->pend_terakhir)) ? 'selected' : ''; ?>  value="SMA/Sederajat">SMA/Sederajat</option>
                                    <option <?= in_array('D1/D2/D3', explode(',', $wilayah_kepala->pend_terakhir)) ? 'selected' : ''; ?>  value="D1/D2/D3">D1/D2/D3</option>
                                    <option <?= in_array('D4/S1', explode(',', $wilayah_kepala->pend_terakhir)) ? 'selected' : ''; ?>  value="D4/S1">D4/S1</option>
                                    <option <?= in_array('S2', explode(',', $wilayah_kepala->pend_terakhir)) ? 'selected' : ''; ?>  value="S2">S2</option>
                                    <option <?= in_array('S3', explode(',', $wilayah_kepala->pend_terakhir)) ? 'selected' : ''; ?>  value="S3">S3</option>
                                    </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="pekerjaan" class="col-sm-4 control-label">Pekerjaan 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="pekerjaan" id="pekerjaan" placeholder="Pekerjaan" value="<?= set_value('pekerjaan', $wilayah_kepala->pekerjaan); ?>">
                                <small class="info help-block">
                                <b>Input Pekerjaan</b> Max Length : 50.</small>
                            </div>
                        </div>
                         
                        </div>
                        <div class="col-lg-6">                        
                                                <div class="form-group ">
                            <label for="no_telp" class="col-sm-4 control-label">No Telp 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="no_telp" id="no_telp" placeholder="No Telp" value="<?= set_value('no_telp', $wilayah_kepala->no_telp); ?>">
                                <small class="info help-block">
                                <b>Input No Telp</b> Max Length : 15.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="periode_mulai" class="col-sm-4 control-label">Periode Mulai 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-6">
                            <div class="input-group date col-sm-8">
                              <input type="text" class="form-control pull-right datepicker" name="periode_mulai"  placeholder="Periode Mulai" id="periode_mulai" value="<?= set_value('wilayah_kepala_periode_mulai_name', $wilayah_kepala->periode_mulai); ?>">
                            </div>
                            <small class="info help-block">
                            </small>
                            </div>
                        </div>
                       
                                                 
                                                <div class="form-group ">
                            <label for="periode_selesai" class="col-sm-4 control-label">Periode Selesai 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-6">
                            <div class="input-group date col-sm-8">
                              <input type="text" class="form-control pull-right datepicker" name="periode_selesai"  placeholder="Periode Selesai" id="periode_selesai" value="<?= set_value('wilayah_kepala_periode_selesai_name', $wilayah_kepala->periode_selesai); ?>">
                            </div>
                            <small class="info help-block">
                            </small>
                            </div>
                        </div>
                       
                                                 
                         
                         
                                                <div class="form-group ">
                            <label for="nip" class="col-sm-4 control-label">Nip 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="nip" id="nip" placeholder="Nip" value="<?= set_value('nip', $wilayah_kepala->nip); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="avatar" class="col-sm-4 control-label">Avatar 
                            </label>
                            <div class="col-sm-8">
                                <div id="wilayah_kepala_avatar_galery"></div>
                                <input class="data_file data_file_uuid" name="wilayah_kepala_avatar_uuid" id="wilayah_kepala_avatar_uuid" type="hidden" value="<?= set_value('wilayah_kepala_avatar_uuid'); ?>">
                                <input class="data_file" name="wilayah_kepala_avatar_name" id="wilayah_kepala_avatar_name" type="hidden" value="<?= set_value('wilayah_kepala_avatar_name', $wilayah_kepala->avatar); ?>">
                                <small class="info help-block">
                                <b>Extension file must</b> JPG,PNG,JPEG,  <b>Max size file</b>  2000 kb.</small>
                            </div>
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
              window.location.href = BASE_URL + 'wilayah_kepala';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
            
        var form_wilayah_kepala = $('#form_wilayah_kepala');
        var data_post = form_wilayah_kepala.serializeArray();
        var save_type = $(this).attr('data-stype');
        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: form_wilayah_kepala.attr('action'),
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if(res.success) {
            var id = $('#wilayah_kepala_image_galery').find('li').attr('qq-file-id');
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

       $('#wilayah_kepala_avatar_galery').fineUploader({
          template: 'qq-template-gallery',
          request: {
              endpoint: BASE_URL + '/wilayah_kepala/upload_avatar_file',
              params : params
          },
          deleteFile: {
              enabled: true, // defaults to false
              endpoint: BASE_URL + '/wilayah_kepala/delete_avatar_file'
          },
          thumbnails: {
              placeholders: {
                  waitingPath: BASE_URL + '/asset/fine-upload/placeholders/waiting-generic.png',
                  notAvailablePath: BASE_URL + '/asset/fine-upload/placeholders/not_available-generic.png'
              }
          },
           session : {
             endpoint: BASE_URL + 'wilayah_kepala/get_avatar_file/<?= $wilayah_kepala->id; ?>',
             refreshOnRequest:true
           },
          multiple : false,
          validation: {
              allowedExtensions: ["jpg","png","jpeg"],
              sizeLimit : 2048000,
                        },
          showMessage: function(msg) {
              toastr['error'](msg);
          },
          callbacks: {
              onComplete : function(id, name, xhr) {
                if (xhr.success) {
                   var uuid = $('#wilayah_kepala_avatar_galery').fineUploader('getUuid', id);
                   $('#wilayah_kepala_avatar_uuid').val(uuid);
                   $('#wilayah_kepala_avatar_name').val(xhr.uploadName);
                } else {
                   toastr['error'](xhr.error);
                }
              },
              onSubmit : function(id, name) {
                  var uuid = $('#wilayah_kepala_avatar_uuid').val();
                  $.get(BASE_URL + '/wilayah_kepala/delete_avatar_file/' + uuid);
              },
              onDeleteComplete : function(id, xhr, isError) {
                if (isError == false) {
                  $('#wilayah_kepala_avatar_uuid').val('');
                  $('#wilayah_kepala_avatar_name').val('');
                }
              }
          }
      }); /*end avatar galey*/
              
       
           
    
    }); /*end doc ready*/
</script>