
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
                            <h3 class="widget-user-username"><b>Wilayah Perangkat</b></h3>
                            <h5 class="widget-user-desc">Edit Wilayah Perangkat</h5>
                            <hr>
                        </div>
                        <?= form_open(base_url('wilayah_perangkat/edit_save/'.$this->uri->segment(3)), [
                            'name'    => 'form_wilayah_perangkat', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_wilayah_perangkat', 
                            'method'  => 'POST'
                            ]); ?>
                         
                        <div class="col-lg-6">
                                                <div class="form-group ">
                            <label for="kd_wilayah" class="col-sm-4 control-label">Kd Wilayah 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select class="form-control chosen chosen-select-deselect" name="kd_wilayah" id="kd_wilayah" data-placeholder="Select Kd Wilayah" disabled>
                  <option value=""></option>
                  <?php foreach (db_get_all_data('wilayah') as $row) : ?>
                    <option <?= $row->kd_wilayah ==  $wilayah_perangkat->kd_wilayah ? 'selected' : ''; ?> value="<?= $row->kd_wilayah ?>"><?= $row->nama; ?></option>
                  <?php endforeach; ?>
                </select>
                                <small class="info help-block">
                                <b>Input Kd Wilayah</b> Max Length : 30.</small>
                            </div>
                        </div>

                                                 
                                                <div class="form-group ">
                            <label for="nama" class="col-sm-4 control-label">Nama 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?= set_value('nama', $wilayah_perangkat->nama); ?>">
                                <small class="info help-block">
                                <b>Input Nama</b> Max Length : 50.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="unsur_pem" class="col-sm-4 control-label">Unsur Pemerintahan 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select" name="unsur_pem" id="unsur_pem" data-placeholder="Select Unsur Pem" >
                                    <option value=""></option>
                                    <option <?= $wilayah_perangkat->unsur_pem == "Unsur Staf" ? 'selected' :''; ?> value="Unsur Staf">Unsur Staf</option>
                                    <option <?= $wilayah_perangkat->unsur_pem == "Unsur Pelaksana" ? 'selected' :''; ?> value="Unsur Pelaksana">Unsur Pelaksana</option>
                                    <option <?= $wilayah_perangkat->unsur_pem == "Unsur Wilayah" ? 'selected' :''; ?> value="Unsur Wilayah">Unsur Wilayah</option>
                                    </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="nip" class="col-sm-4 control-label">NIP 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="nip" id="nip" placeholder="NIP" value="<?= set_value('nip', $wilayah_perangkat->nip); ?>">
                                <small class="info help-block">
                                <b>Input Nip</b> Max Length : 30.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="jabatan" class="col-sm-4 control-label">Jabatan 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select" name="jabatan" id="jabatan" data-placeholder="Select Jabatan" >
                                    <option value=""></option>
                                    <option <?= $wilayah_perangkat->jabatan == "Sekretaris" ? 'selected' :''; ?> value="Sekretaris">Sekretaris</option>
                                    <option <?= $wilayah_perangkat->jabatan == "Kepala Urusan Pemerintah" ? 'selected' :''; ?> value="Kepala Urusan Pemerintah">Kepala Urusan Pemerintah</option>
                                    <option <?= $wilayah_perangkat->jabatan == "Kepala Urusan Pembangunan" ? 'selected' :''; ?> value="Kepala Urusan Pembangunan">Kepala Urusan Pembangunan</option>
                                    <option <?= $wilayah_perangkat->jabatan == "Kepala Urusan Kesejahteraan Rakyat" ? 'selected' :''; ?> value="Kepala Urusan Kesejahteraan Rakyat">Kepala Urusan Kesejahteraan Rakyat</option>
                                    <option <?= $wilayah_perangkat->jabatan == "Kepala Urusan Keuangan" ? 'selected' :''; ?> value="Kepala Urusan Keuangan">Kepala Urusan Keuangan</option>
                                    <option <?= $wilayah_perangkat->jabatan == "Kepala Urusan Umum" ? 'selected' :''; ?> value="Kepala Urusan Umum">Kepala Urusan Umum</option>
                                    <option <?= $wilayah_perangkat->jabatan == "Kepala Dusun" ? 'selected' :''; ?> value="Kepala Dusun">Kepala Dusun</option>
                                    <option <?= $wilayah_perangkat->jabatan == "Kepala Urusan Perencana" ? 'selected' :''; ?> value="Kepala Urusan Perencana">Kepala Urusan Perencana</option>
                                    <option <?= $wilayah_perangkat->jabatan == "Kepala urusan umun" ? 'selected' :''; ?> value="Kepala urusan umun">Kepala urusan umun</option>
                                    <option <?= $wilayah_perangkat->jabatan == "Kepala urusan keuangan" ? 'selected' :''; ?> value="Kepala urusan keuangan">Kepala urusan keuangan</option>
                                    <option <?= $wilayah_perangkat->jabatan == "Kepala seksi pemerintahan" ? 'selected' :''; ?> value="Kepala seksi pemerintahan">Kepala seksi pemerintahan</option>
                                    <option <?= $wilayah_perangkat->jabatan == "Kepala seksi kesejahteraan" ? 'selected' :''; ?> value="Kepala seksi kesejahteraan">Kepala seksi kesejahteraan</option>
                                     <option <?= $wilayah_perangkat->jabatan == "Kepala seksi pelayanan" ? 'selected' :''; ?> value="Kepala seksi pelayanan">Kepala seksi pelayanan</option>
                                    <option <?= $wilayah_perangkat->jabatan == "Staf" ? 'selected' :''; ?> value="Staf">Staf</option>
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
                                    <option <?= $wilayah_perangkat->jenis_kelamin == "Laki - Laki" ? 'selected' :''; ?> value="Laki - Laki">Laki - Laki</option>
                                    <option <?= $wilayah_perangkat->jenis_kelamin == "Perempuan" ? 'selected' :''; ?> value="Perempuan">Perempuan</option>
                                    </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="tgl_lahir" class="col-sm-4 control-label">Tanggal Lahir 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-6">
                            <div class="input-group date col-sm-8">
                              <input type="text" class="form-control pull-right datepicker" name="tgl_lahir"  placeholder="Tanggal Lahir" id="tgl_lahir" value="<?= set_value('wilayah_perangkat_tgl_lahir_name', $wilayah_perangkat->tgl_lahir); ?>">
                            </div>
                            <small class="info help-block">
                            </small>
                            </div>
                        </div>
                       
                                                 
                                                <div class="form-group ">
                            <label for="agama" class="col-sm-4 control-label">Agama 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="agama" id="agama" data-placeholder="Select Agama" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('setup_agama') as $row): ?>
                                    <option <?=  $row->value ==  $wilayah_perangkat->agama ? 'selected' : ''; ?> value="<?= $row->value ?>"><?= $row->nama; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                                                 
                                               
                                                 
                                               
                        </div>
                        <div class="col-lg-6">
                        <div class="form-group ">
                            <label for="pend_terakhir" class="col-sm-4 control-label">Pendidikan Terakhir 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select" name="pend_terakhir" id="pend_terakhir" data-placeholder="Select Pend Terakhir" >
                                    <option value=""></option>
                                    <option <?= $wilayah_perangkat->pend_terakhir == "SD/Sederajat" ? 'selected' :''; ?> value="SD/Sederajat">SD/Sederajat</option>
                                    <option <?= $wilayah_perangkat->pend_terakhir == "SMP/Sederajat" ? 'selected' :''; ?> value="SMP/Sederajat">SMP/Sederajat</option>
                                    <option <?= $wilayah_perangkat->pend_terakhir == "SMA/Sederajat" ? 'selected' :''; ?> value="SMA/Sederajat">SMA/Sederajat</option>
                                    <option <?= $wilayah_perangkat->pend_terakhir == "D1/D2/D3" ? 'selected' :''; ?> value="D1/D2/D3">D1/D2/D3</option>
                                    <option <?= $wilayah_perangkat->pend_terakhir == "D4/S1" ? 'selected' :''; ?> value="D4/S1">D4/S1</option>
                                    <option <?= $wilayah_perangkat->pend_terakhir == "S2" ? 'selected' :''; ?> value="S2">S2</option>
                                    <option <?= $wilayah_perangkat->pend_terakhir == "S3" ? 'selected' :''; ?> value="S3">S3</option>
                                    </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="pekerjaan" class="col-sm-4 control-label">Pekerjaan 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="pekerjaan" id="pekerjaan" placeholder="Pekerjaan" value="<?= set_value('pekerjaan', $wilayah_perangkat->pekerjaan); ?>">
                                <small class="info help-block">
                                <b>Input Pekerjaan</b> Max Length : 50.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="no_hp" class="col-sm-4 control-label">Nomor HP 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="no_hp" id="no_hp" placeholder="Nomor HP" value="<?= set_value('no_hp', $wilayah_perangkat->no_hp); ?>">
                                <small class="info help-block">
                                <b>Input No Hp</b> Max Length : 13.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="periode_mulai" class="col-sm-4 control-label">Periode Mulai 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-6">
                            <div class="input-group date col-sm-8">
                              <input type="text" class="form-control pull-right datepicker" name="periode_mulai"  placeholder="Periode Mulai" id="periode_mulai" value="<?= set_value('wilayah_perangkat_periode_mulai_name', $wilayah_perangkat->periode_mulai); ?>">
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
                              <input type="text" class="form-control pull-right datepicker" name="periode_selesai"  placeholder="Periode Selesai" id="periode_selesai" value="<?= set_value('wilayah_perangkat_periode_selesai_name', $wilayah_perangkat->periode_selesai); ?>">
                            </div>
                            <small class="info help-block">
                            </small>
                            </div>
                        </div>
                       
                                                 
                                                <div class="form-group ">
                            <label for="no_seq" class="col-sm-4 control-label">No Urut 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="no_seq" id="no_seq" placeholder="No Urut" value="<?= set_value('no_seq', $wilayah_perangkat->no_seq); ?>">
                                <small class="info help-block">
                                <b>Input No Seq</b> Max Length : 2.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="avatar" class="col-sm-4 control-label">Foto 
                            </label>
                            <div class="col-sm-8">
                                <div id="wilayah_perangkat_avatar_galery"></div>
                                <input class="data_file data_file_uuid" name="wilayah_perangkat_avatar_uuid" id="wilayah_perangkat_avatar_uuid" type="hidden" value="<?= set_value('wilayah_perangkat_avatar_uuid'); ?>">
                                <input class="data_file" name="wilayah_perangkat_avatar_name" id="wilayah_perangkat_avatar_name" type="hidden" value="<?= set_value('wilayah_perangkat_avatar_name', $wilayah_perangkat->avatar); ?>">
                                <small class="info help-block">
                                <b>Extension file must</b> JPG,JPEG,PNG,  <b>Max size file</b>  2000 kb.</small>
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
              window.location.href = BASE_URL + 'wilayah_perangkat';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
            
        var form_wilayah_perangkat = $('#form_wilayah_perangkat');
        var data_post = form_wilayah_perangkat.serializeArray();
        var save_type = $(this).attr('data-stype');
        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: form_wilayah_perangkat.attr('action'),
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if(res.success) {
            var id = $('#wilayah_perangkat_image_galery').find('li').attr('qq-file-id');
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

       $('#wilayah_perangkat_avatar_galery').fineUploader({
          template: 'qq-template-gallery',
          request: {
              endpoint: BASE_URL + '/wilayah_perangkat/upload_avatar_file',
              params : params
          },
          deleteFile: {
              enabled: true, // defaults to false
              endpoint: BASE_URL + '/wilayah_perangkat/delete_avatar_file'
          },
          thumbnails: {
              placeholders: {
                  waitingPath: BASE_URL + '/asset/fine-upload/placeholders/waiting-generic.png',
                  notAvailablePath: BASE_URL + '/asset/fine-upload/placeholders/not_available-generic.png'
              }
          },
           session : {
             endpoint: BASE_URL + 'wilayah_perangkat/get_avatar_file/<?= $wilayah_perangkat->id; ?>',
             refreshOnRequest:true
           },
          multiple : false,
          validation: {
              allowedExtensions: ["jpg","jpeg","png"],
              sizeLimit : 2048000,
                        },
          showMessage: function(msg) {
              toastr['error'](msg);
          },
          callbacks: {
              onComplete : function(id, name, xhr) {
                if (xhr.success) {
                   var uuid = $('#wilayah_perangkat_avatar_galery').fineUploader('getUuid', id);
                   $('#wilayah_perangkat_avatar_uuid').val(uuid);
                   $('#wilayah_perangkat_avatar_name').val(xhr.uploadName);
                } else {
                   toastr['error'](xhr.error);
                }
              },
              onSubmit : function(id, name) {
                  var uuid = $('#wilayah_perangkat_avatar_uuid').val();
                  $.get(BASE_URL + '/wilayah_perangkat/delete_avatar_file/' + uuid);
              },
              onDeleteComplete : function(id, xhr, isError) {
                if (isError == false) {
                  $('#wilayah_perangkat_avatar_uuid').val('');
                  $('#wilayah_perangkat_avatar_name').val('');
                }
              }
          }
      }); /*end avatar galey*/
              
       
           
    
    }); /*end doc ready*/
</script>