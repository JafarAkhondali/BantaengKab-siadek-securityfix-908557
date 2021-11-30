
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
                            <h3 class="widget-user-username"><b>Surat Masuk</b></h3>
                            <h5 class="widget-user-desc">Edit Surat Masuk</h5>
                            <hr>
                        </div>
                        <?= form_open(base_url('surat_masuk/edit_save/'.$this->uri->segment(3)), [
                            'name'    => 'form_surat_masuk', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_surat_masuk', 
                            'method'  => 'POST'
                            ]); ?>
                         <div class="col-sm-6">
                                                <div class="form-group ">
                            <label for="surat_masuk_nomor" class="col-sm-4 control-label">Surat Masuk Nomor 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="surat_masuk_nomor" id="surat_masuk_nomor" placeholder="Surat Masuk Nomor" value="<?= set_value('surat_masuk_nomor', $surat_masuk->surat_masuk_nomor); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="surat_masuk_perihal" class="col-sm-4 control-label">Surat Masuk Perihal 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="surat_masuk_perihal" id="surat_masuk_perihal" placeholder="Surat Masuk Perihal" value="<?= set_value('surat_masuk_perihal', $surat_masuk->surat_masuk_perihal); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="surat_masuk_pengirim" class="col-sm-4 control-label">Surat Masuk Pengirim 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="surat_masuk_pengirim" id="surat_masuk_pengirim" placeholder="Surat Masuk Pengirim" value="<?= set_value('surat_masuk_pengirim', $surat_masuk->surat_masuk_pengirim); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="surat_masuk_tgl_masuk" class="col-sm-4 control-label">Surat Masuk Tgl Masuk 
                            </label>
                            <div class="col-sm-6">
                            <div class="input-group date col-sm-8">
                              <input type="text" class="form-control pull-right datepicker" name="surat_masuk_tgl_masuk"  placeholder="Surat Masuk Tgl Masuk" id="surat_masuk_tgl_masuk" value="<?= set_value('surat_masuk_surat_masuk_tgl_masuk_name', $surat_masuk->surat_masuk_tgl_masuk); ?>">
                            </div>
                            <small class="info help-block">
                            </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="surat_masuk_tgl_terima" class="col-sm-4 control-label">Surat Masuk Tgl Terima 
                            </label>
                            <div class="col-sm-6">
                            <div class="input-group date col-sm-8">
                              <input type="text" class="form-control pull-right datepicker" name="surat_masuk_tgl_terima"  placeholder="Surat Masuk Tgl Terima" id="surat_masuk_tgl_terima" value="<?= set_value('surat_masuk_surat_masuk_tgl_terima_name', $surat_masuk->surat_masuk_tgl_terima); ?>">
                            </div>
                            <small class="info help-block">
                            </small>
                            </div>
                        </div>
                      </div>
                       <div class="col-sm-6">
                                                 
                                                <div class="form-group ">
                            <label for="surat_masuk_file" class="col-sm-4 control-label">Surat Masuk File 
                            </label>
                            <div class="col-sm-8">
                                <div id="surat_masuk_surat_masuk_file_galery"></div>
                                <input class="data_file data_file_uuid" name="surat_masuk_surat_masuk_file_uuid" id="surat_masuk_surat_masuk_file_uuid" type="hidden" value="<?= set_value('surat_masuk_surat_masuk_file_uuid'); ?>">
                                <input class="data_file" name="surat_masuk_surat_masuk_file_name" id="surat_masuk_surat_masuk_file_name" type="hidden" value="<?= set_value('surat_masuk_surat_masuk_file_name', $surat_masuk->surat_masuk_file); ?>">
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
              window.location.href = BASE_URL + 'surat_masuk';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
            
        var form_surat_masuk = $('#form_surat_masuk');
        var data_post = form_surat_masuk.serializeArray();
        var save_type = $(this).attr('data-stype');
        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: form_surat_masuk.attr('action'),
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if(res.success) {
            var id = $('#surat_masuk_image_galery').find('li').attr('qq-file-id');
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

       $('#surat_masuk_surat_masuk_file_galery').fineUploader({
          template: 'qq-template-gallery',
          request: {
              endpoint: BASE_URL + '/surat_masuk/upload_surat_masuk_file_file',
              params : params
          },
          deleteFile: {
              enabled: true, // defaults to false
              endpoint: BASE_URL + '/surat_masuk/delete_surat_masuk_file_file'
          },
          thumbnails: {
              placeholders: {
                  waitingPath: BASE_URL + '/asset/fine-upload/placeholders/waiting-generic.png',
                  notAvailablePath: BASE_URL + '/asset/fine-upload/placeholders/not_available-generic.png'
              }
          },
           session : {
             endpoint: BASE_URL + 'surat_masuk/get_surat_masuk_file_file/<?= $surat_masuk->id_surat_masuk; ?>',
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
                   var uuid = $('#surat_masuk_surat_masuk_file_galery').fineUploader('getUuid', id);
                   $('#surat_masuk_surat_masuk_file_uuid').val(uuid);
                   $('#surat_masuk_surat_masuk_file_name').val(xhr.uploadName);
                } else {
                   toastr['error'](xhr.error);
                }
              },
              onSubmit : function(id, name) {
                  var uuid = $('#surat_masuk_surat_masuk_file_uuid').val();
                  $.get(BASE_URL + '/surat_masuk/delete_surat_masuk_file_file/' + uuid);
              },
              onDeleteComplete : function(id, xhr, isError) {
                if (isError == false) {
                  $('#surat_masuk_surat_masuk_file_uuid').val('');
                  $('#surat_masuk_surat_masuk_file_name').val('');
                }
              }
          }
      }); /*end surat_masuk_file galey*/
              
       
           
    
    }); /*end doc ready*/
</script>