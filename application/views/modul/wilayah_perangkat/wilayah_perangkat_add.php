
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
                            <h5 class="widget-user-desc"><?= cclang('new', ['Wilayah Perangkat']); ?></h5>
                            <hr>
                        </div>
                        <?= form_open('', [
                            'name'    => 'form_wilayah_perangkat', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_wilayah_perangkat', 
                            'enctype' => 'multipart/form-data', 
                            'method'  => 'POST'
                            ]); ?>
                         
                        <div class="col-lg-6">
                                                <div class="form-group ">
              <label for="kd_wilayah" class="col-sm-4 control-label">Wilayah
              </label>
              <div class="col-sm-8">
                <?php

                $kdwilayah = get_user_data('kd_wilayah');
                $username = get_user_data('username');
                if ($username == 'admin') {
                  $a = db_get_all_data('wilayah');
                } else {
                  $a = db_get_all_data('wilayah', "kd_wilayah = $kdwilayah");
                }
                ?>

                <select class="form-control chosen chosen-select-deselect" name="kd_wilayah" id="kd_wilayah" data-placeholder="PILIH wilayah" onchange="submit()">

                  <?php if ($username == 'admin') { ?>
                    <option value="0"></option>
                  <?php } ?>

                  <?php foreach ($a as $row) : ?>

                    <option <?php if ($row->kd_wilayah == $this->input->post('kd_wilayah')) { ?>selected="selected" <?php } ?> value="<?= $row->kd_wilayah ?>"><?= '[ ' . $row->kd_wilayah . ' ] ' . $row->nama ?></option>
                  <?php endforeach; ?>
                </select>
                <small class="info help-block">
                </small>
              </div>
            </div>

                                                 
                                                <div class="form-group ">
                            <label for="nama" class="col-sm-4 control-label">Nama 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?= set_value('nama'); ?>">
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
                                    <option value="Unsur Staf">Unsur Staf</option>
                                    <option value="Unsur Pelaksana">Unsur Pelaksana</option>
                                    <option value="Unsur Wilayah">Unsur Wilayah</option>
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
                                <input type="text" class="form-control" name="nip" id="nip" placeholder="NIP" value="<?= set_value('nip'); ?>">
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
                                    <option value="Sekretaris">Sekretaris</option>
                                    <option value="Kepala Urusan Pemerintah">Kepala Urusan Pemerintah</option>
                                    <option value="Kepala Urusan Pembangunan">Kepala Urusan Pembangunan</option>
                                    <option value="Kepala Urusan Kesejahteraan Rakyat">Kepala Urusan Kesejahteraan Rakyat</option>
                                    <option value="Kepala Urusan Keuangan">Kepala Urusan Keuangan</option>
                                    <option value="Kepala Urusan Umum">Kepala Urusan Umum</option>
                                    <option value="Kepala Dusun">Kepala Dusun</option>
                                    <option value="Kepala Urusan Perencana">Kepala Urusan Perencanaan</option>
                                    <option value="Kepala urusan umun">Kepala urusan umun</option>
                                    <option value="Kepala urusan keuangan">Kepala urusan keuangan</option>
                                    <option value="Kepala seksi pemerintahan">Kepala seksi pemerintahan</option>
                                    <option value="Kepala seksi kesejahteraan">Kepala seksi kesejahteraan</option>
                                    <option value="Kepala seksi pelayanan">Kepala seksi pelayanan</option>
                                    <option value="Staf">Staf</option>
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
                                    <option value="Laki - Laki">Laki - Laki</option>
                                    <option value="Perempuan">Perempuan</option>
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
                              <input type="text" class="form-control pull-right datepicker" name="tgl_lahir"  placeholder="Tanggal Lahir" id="tgl_lahir">
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
                                    <option value="<?= $row->value ?>"><?= $row->nama; ?></option>
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
                                    <option value="SD/Sederajat">SD/Sederajat</option>
                                    <option value="SMP/Sederajat">SMP/Sederajat</option>
                                    <option value="SMA/Sederajat">SMA/Sederajat</option>
                                    <option value="D1/D2/D3">D1/D2/D3</option>
                                    <option value="D4/S1">D4/S1</option>
                                    <option value="S2">S2</option>
                                    <option value="S3">S3</option>
                                    </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="pekerjaan" class="col-sm-4 control-label">Pekerjaan 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="pekerjaan" id="pekerjaan" placeholder="Pekerjaan" value="<?= set_value('pekerjaan'); ?>">
                                <small class="info help-block">
                                <b>Input Pekerjaan</b> Max Length : 50.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="no_hp" class="col-sm-4 control-label">Nomor HP 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="no_hp" id="no_hp" placeholder="Nomor HP" value="<?= set_value('no_hp'); ?>">
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
                              <input type="text" class="form-control pull-right datepicker" name="periode_mulai"  placeholder="Periode Mulai" id="periode_mulai">
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
                              <input type="text" class="form-control pull-right datepicker" name="periode_selesai"  placeholder="Periode Selesai" id="periode_selesai">
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
                                <input type="number" class="form-control" name="no_seq" id="no_seq" placeholder="No Urut" value="<?= set_value('no_seq'); ?>">
                                <small class="info help-block">
                                <b>Input No Seq</b> Max Length : 2.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="avatar" class="col-sm-4 control-label">Foto 
                            </label>
                            <div class="col-sm-8">
                                <div id="wilayah_perangkat_avatar_galery"></div>
                                <input class="data_file" name="wilayah_perangkat_avatar_uuid" id="wilayah_perangkat_avatar_uuid" type="hidden" value="<?= set_value('wilayah_perangkat_avatar_uuid'); ?>">
                                <input class="data_file" name="wilayah_perangkat_avatar_name" id="wilayah_perangkat_avatar_name" type="hidden" value="<?= set_value('wilayah_perangkat_avatar_name'); ?>">
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
          url: BASE_URL + '/wilayah_perangkat/add_save',
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if(res.success) {
            var id_avatar = $('#wilayah_perangkat_avatar_galery').find('li').attr('qq-file-id');
            
            if (save_type == 'back') {
              window.location.href = res.redirect;
              return;
            }
    
            $('.message').printMessage({message : res.message});
            $('.message').fadeIn();
            resetForm();
            if (typeof id_avatar !== 'undefined') {
                    $('#wilayah_perangkat_avatar_galery').fineUploader('deleteFile', id_avatar);
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

       $('#wilayah_perangkat_avatar_galery').fineUploader({
          template: 'qq-template-gallery',
          request: {
              endpoint: BASE_URL + '/wilayah_perangkat/upload_avatar_file',
              params : params
          },
          deleteFile: {
              enabled: true, 
              endpoint: BASE_URL + '/wilayah_perangkat/delete_avatar_file',
          },
          thumbnails: {
              placeholders: {
                  waitingPath: BASE_URL + '/asset/fine-upload/placeholders/waiting-generic.png',
                  notAvailablePath: BASE_URL + '/asset/fine-upload/placeholders/not_available-generic.png'
              }
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
      }); /*end avatar galery*/
              
 
       
    
    
    }); /*end doc ready*/
</script>