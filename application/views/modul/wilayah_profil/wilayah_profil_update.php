
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
                            <h3 class="widget-user-username"><b>Wilayah Profil</b></h3>
                            <h5 class="widget-user-desc">Edit Wilayah Profil</h5>
                            <hr>
                        </div>
                        <?= form_open(base_url('wilayah_profil/edit_save/'.$this->uri->segment(3)), [
                            'name'    => 'form_wilayah_profil', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_wilayah_profil', 
                            'method'  => 'POST'
                            ]); ?>



 <div class="col-md-6">
                                                <div class="form-group ">
                            <label for="kd_wilayah" class="col-sm-2 control-label">Kd Wilayah 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input disabled type="text" class="form-control" name="kd_wilayah" id="kd_wilayah" placeholder="Kd Wilayah" value="<?= set_value('kd_wilayah', $wilayah_profil->kd_wilayah); ?>">
                                <small class="info help-block">
                                <b>Input Kd Wilayah</b> Max Length : 30.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="alamat_kantor" class="col-sm-2 control-label">Alamat Kantor 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="alamat_kantor" id="alamat_kantor" placeholder="Alamat Kantor" value="<?= set_value('alamat_kantor', $wilayah_profil->alamat_kantor); ?>">
                                <small class="info help-block">
                                <b>Input Alamat Kantor</b> Max Length : 100.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="luas" class="col-sm-2 control-label">Luas 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="luas" id="luas" placeholder="Luas" value="<?= set_value('luas', $wilayah_profil->luas); ?>">
                                <small class="info help-block">
                                <b>Input Luas</b> Max Length : 12.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="utara" class="col-sm-2 control-label">Utara 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="utara" id="utara" placeholder="Utara" value="<?= set_value('utara', $wilayah_profil->utara); ?>">
                                <small class="info help-block">
                                <b>Input Utara</b> Max Length : 50.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="timur" class="col-sm-2 control-label">Timur 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="timur" id="timur" placeholder="Timur" value="<?= set_value('timur', $wilayah_profil->timur); ?>">
                                <small class="info help-block">
                                <b>Input Timur</b> Max Length : 50.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="selatan" class="col-sm-2 control-label">Selatan 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="selatan" id="selatan" placeholder="Selatan" value="<?= set_value('selatan', $wilayah_profil->selatan); ?>">
                                <small class="info help-block">
                                <b>Input Selatan</b> Max Length : 50.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="barat" class="col-sm-2 control-label">Barat 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="barat" id="barat" placeholder="Barat" value="<?= set_value('barat', $wilayah_profil->barat); ?>">
                                <small class="info help-block">
                                <b>Input Barat</b> Max Length : 50.</small>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="sejarah" class="col-sm-2 control-label">Sejarah 
                            </label>
                            <div class="col-sm-8">
                                <textarea id="sejarah" name="sejarah" rows="10" cols="80"> <?= set_value('sejarah', $wilayah_profil->sejarah); ?></textarea>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                        </div>
                        <div class="col-md-6">

                        <div class="form-group ">
                            <label for="tahun_pembentukan" class="col-sm-2 control-label">Tahun Pembentukan 
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="tahun_pembentukan" id="tahun_pembentukan" data-placeholder="Select Tahun Pembentukan" >
                                    <option value=""></option>
                                    <?php for ($i = 1970; $i < date('Y')+100; $i++){ ?>
                                    <option <?=  $i ==  $wilayah_profil->tahun_pembentukan ? 'selected' : ''; ?> value="<?= $i; ?>"><?= $i; ?></option>
                                    <?php }; ?>  
                                </select>
                                <small class="info help-block">
                            </div>
                        </div> 

                                                                        <div class="form-group ">
                            <label for="tipologi" class="col-sm-2 control-label">Tipologi 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="tipologi" id="tipologi" placeholder="Tipologi" value="<?= set_value('tipologi', $wilayah_profil->tipologi); ?>">
                                <small class="info help-block">
                            </div>
                        </div> 
                                                 
                        <div class="form-group ">
                            <label for="kd_pos" class="col-sm-2 control-label">Kd Pos 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="kd_pos" id="kd_pos" placeholder="Kd Pos" value="<?= set_value('kd_pos', $wilayah_profil->kd_pos); ?>">
                                <small class="info help-block">
                            </div>
                        </div>                       
                        <div class="form-group ">
                            <label for="lokasi" class="col-sm-2 control-label">Lokasi 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="lokasi" id="lokasi" placeholder="Lokasi" value="<?= set_value('lokasi', $wilayah_profil->lokasi); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>                         

                        <div class="form-group ">
                            <label for="visi_misi" class="col-sm-2 control-label">Visi Misi 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="visi_misi" id="visi_misi" placeholder="Visi Misi" value="<?= set_value('visi_misi', $wilayah_profil->visi_misi); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                         
                        <div class="form-group ">
                            <label for="foto" class="col-sm-2 control-label">Foto 
                            </label>
                            <div class="col-sm-8">
                                <div id="wilayah_profil_foto_galery"></div>
                                <div id="wilayah_profil_foto_galery_listed">
                                <?php foreach ((array) explode(',', $wilayah_profil->foto) as $idx => $filename): ?>
                                    <input type="hidden" class="listed_file_uuid" name="wilayah_profil_foto_uuid[<?= $idx ?>]" value="" /><input type="hidden" class="listed_file_name" name="wilayah_profil_foto_name[<?= $idx ?>]" value="<?= $filename; ?>" />
                                <?php endforeach; ?>
                                </div>
                                <small class="info help-block">
                                <b>Extension file must</b> JPEG,JPG,PNG,  <b>Max size file</b>  2000 kb.</small>
                            </div>
                        </div>

                                                <div class="form-group ">
                            <label for="dasar_hukum" class="col-sm-2 control-label">Dasar Hukum 
                            </label>
                            <div class="col-sm-8">
                                <textarea id="dasar_hukum" name="dasar_hukum" rows="10" cols="80"> <?= set_value('dasar_hukum', $wilayah_profil->dasar_hukum); ?></textarea>
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
<script src="<?= BASE_ASSET; ?>ckeditor/ckeditor.js"></script>
<!-- Page script -->
<script>
    $(document).ready(function(){
      
      CKEDITOR.replace('sejarah'); 
      var sejarah = CKEDITOR.instances.sejarah;
            CKEDITOR.replace('dasar_hukum'); 
      var dasar_hukum = CKEDITOR.instances.dasar_hukum;
                   
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
              window.location.href = BASE_URL + 'wilayah_profil';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
        $('#sejarah').val(sejarah.getData());
                $('#dasar_hukum').val(dasar_hukum.getData());
                    
        var form_wilayah_profil = $('#form_wilayah_profil');
        var data_post = form_wilayah_profil.serializeArray();
        var save_type = $(this).attr('data-stype');
        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: form_wilayah_profil.attr('action'),
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if(res.success) {
            var id = $('#wilayah_profil_image_galery').find('li').attr('qq-file-id');
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

       $('#wilayah_profil_foto_galery').fineUploader({
          template: 'qq-template-gallery',
          request: {
              endpoint: BASE_URL + '/wilayah_profil/upload_foto_file',
              params : params
          },
          deleteFile: {
              enabled: true, 
              endpoint: BASE_URL + '/wilayah_profil/delete_foto_file',
          },
          thumbnails: {
              placeholders: {
                  waitingPath: BASE_URL + '/asset/fine-upload/placeholders/waiting-generic.png',
                  notAvailablePath: BASE_URL + '/asset/fine-upload/placeholders/not_available-generic.png'
              }
          },
           session : {
             endpoint: BASE_URL + 'wilayah_profil/get_foto_file/<?= $wilayah_profil->id; ?>',
             refreshOnRequest:true
           },
          validation: {
              allowedExtensions: ["jpeg","jpg","png"],
              sizeLimit : 2048000,
                        },
          showMessage: function(msg) {
              toastr['error'](msg);
          },
          callbacks: {
              onComplete : function(id, name, xhr) {
                if (xhr.success) {
                   var uuid = $('#wilayah_profil_foto_galery').fineUploader('getUuid', id);
                   $('#wilayah_profil_foto_galery_listed').append('<input type="hidden" class="listed_file_uuid" name="wilayah_profil_foto_uuid['+id+']" value="'+uuid+'" /><input type="hidden" class="listed_file_name" name="wilayah_profil_foto_name['+id+']" value="'+xhr.uploadName+'" />');
                } else {
                   toastr['error'](xhr.error);
                }
              },
              onDeleteComplete : function(id, xhr, isError) {
                if (isError == false) {
                  $('#wilayah_profil_foto_galery_listed').find('.listed_file_uuid[name="wilayah_profil_foto_uuid['+id+']"]').remove();
                  $('#wilayah_profil_foto_galery_listed').find('.listed_file_name[name="wilayah_profil_foto_name['+id+']"]').remove();
                }
              }
          }
      }); /*end foto galery*/
                  
    
    }); /*end doc ready*/
</script>