
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
                            <h3 class="widget-user-username"><b>Tbl Regulasi</b></h3>
                            <h5 class="widget-user-desc">Edit Tbl Regulasi</h5>
                            <hr>
                        </div>
                        <?= form_open(base_url('tbl_regulasi/edit_save/'.$this->uri->segment(3)), [
                            'name'    => 'form_tbl_regulasi', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_tbl_regulasi', 
                            'method'  => 'POST'
                            ]); ?>

                          <div class="col-lg-6">
                         
                                                <div class="form-group ">
                            <label for="kd_wilayah" class="col-sm-4 control-label">Kd Wilayah 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input disabled type="text" class="form-control" name="kd_wilayah" id="kd_wilayah" placeholder="Kd Wilayah" value="<?= set_value('kd_wilayah', $tbl_regulasi->kd_wilayah); ?>">
                                <small class="info help-block">
                                <b>Input Kd Wilayah</b> Max Length : 30.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="regulasi_jenis" class="col-sm-4 control-label">Regulasi Jenis 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="regulasi_jenis" id="regulasi_jenis" data-placeholder="Select Regulasi Jenis" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('tbl_regulasi_jenis') as $row): ?>
                                    <option <?=  $row->regulasi_jns_kode ==  $tbl_regulasi->regulasi_jenis ? 'selected' : ''; ?> value="<?= $row->regulasi_jns_kode ?>"><?= $row->regulasi_jns_nama; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                                                 
                                                <div class="form-group ">
                            <label for="keterangan" class="col-sm-4 control-label">Keterangan 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="keterangan" id="keterangan" placeholder="Keterangan" value="<?= set_value('keterangan', $tbl_regulasi->keterangan); ?>">
                                <small class="info help-block">
                                <b>Input Keterangan</b> Max Length : 255.</small>
                            </div>
                        </div>
                      </div>
                      <div class="col-lg-6">
                                                 
                                                
                                                  
                                                <div class="form-group ">
                            <label for="no_regulasi" class="col-sm-4 control-label">No Regulasi 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="no_regulasi" id="no_regulasi" placeholder="No Regulasi" value="<?= set_value('no_regulasi', $tbl_regulasi->no_regulasi); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="status" class="col-sm-4 control-label">Status 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select" name="status[]" id="status" data-placeholder="Select Status" multiple >
                                    <option value=""></option>
                                    <option <?= in_array('1', explode(',', $tbl_regulasi->status)) ? 'selected' : ''; ?>  value="1">Aktif</option>
                                    <option <?= in_array('2', explode(',', $tbl_regulasi->status)) ? 'selected' : ''; ?>  value="2">Tidak Aktif</option>
                                    </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="tahun" class="col-sm-4 control-label">Tahun 
                            </label>
                            <div class="col-sm-4">
                                <select  class="form-control chosen chosen-select-deselect" name="tahun" id="tahun" data-placeholder="Select Tahun" >
                                    <option value=""></option>
                                    <?php for ($i = 1970; $i < date('Y')+100; $i++){ ?>
                                    <option <?=  $i ==  $tbl_regulasi->tahun ? 'selected' : ''; ?> value="<?= $i; ?>"><?= $i; ?></option>
                                    <?php }; ?>  
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="file" class="col-sm-4 control-label">File 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <div id="tbl_regulasi_file_galery"></div>
                                <input class="data_file data_file_uuid" name="tbl_regulasi_file_uuid" id="tbl_regulasi_file_uuid" type="hidden" value="<?= set_value('tbl_regulasi_file_uuid'); ?>">
                                <input class="data_file" name="tbl_regulasi_file_name" id="tbl_regulasi_file_name" type="hidden" value="<?= set_value('tbl_regulasi_file_name', $tbl_regulasi->file); ?>">
                                <small class="info help-block">
                                </small>
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
              window.location.href = BASE_URL + 'tbl_regulasi';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
            
        var form_tbl_regulasi = $('#form_tbl_regulasi');
        var data_post = form_tbl_regulasi.serializeArray();
        var save_type = $(this).attr('data-stype');
        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: form_tbl_regulasi.attr('action'),
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if(res.success) {
            var id = $('#tbl_regulasi_image_galery').find('li').attr('qq-file-id');
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

       $('#tbl_regulasi_file_galery').fineUploader({
          template: 'qq-template-gallery',
          request: {
              endpoint: BASE_URL + '/tbl_regulasi/upload_file_file',
              params : params
          },
          deleteFile: {
              enabled: true, // defaults to false
              endpoint: BASE_URL + '/tbl_regulasi/delete_file_file'
          },
          thumbnails: {
              placeholders: {
                  waitingPath: BASE_URL + '/asset/fine-upload/placeholders/waiting-generic.png',
                  notAvailablePath: BASE_URL + '/asset/fine-upload/placeholders/not_available-generic.png'
              }
          },
           session : {
             endpoint: BASE_URL + 'tbl_regulasi/get_file_file/<?= $tbl_regulasi->id; ?>',
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
                   var uuid = $('#tbl_regulasi_file_galery').fineUploader('getUuid', id);
                   $('#tbl_regulasi_file_uuid').val(uuid);
                   $('#tbl_regulasi_file_name').val(xhr.uploadName);
                } else {
                   toastr['error'](xhr.error);
                }
              },
              onSubmit : function(id, name) {
                  var uuid = $('#tbl_regulasi_file_uuid').val();
                  $.get(BASE_URL + '/tbl_regulasi/delete_file_file/' + uuid);
              },
              onDeleteComplete : function(id, xhr, isError) {
                if (isError == false) {
                  $('#tbl_regulasi_file_uuid').val('');
                  $('#tbl_regulasi_file_name').val('');
                }
              }
          }
      }); /*end file galey*/
              
       
           
    
    }); /*end doc ready*/
</script>