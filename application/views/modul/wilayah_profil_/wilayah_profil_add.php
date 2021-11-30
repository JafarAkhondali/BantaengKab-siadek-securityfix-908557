
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
                            <h5 class="widget-user-desc"><?= cclang('new', ['Wilayah Profil']); ?></h5>
                            <hr>
                        </div>
                        <?= form_open('', [
                            'name'    => 'form_wilayah_profil', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_wilayah_profil', 
                            'enctype' => 'multipart/form-data', 
                            'method'  => 'POST'
                            ]); ?>
                         
                            <div class="form-group ">
                            <label for="kd_wilayah" class="col-sm-2 control-label">Wilayah 
                            </label>
                            <div class="col-sm-8">
                            <?php 

                            $kdwilayah = get_user_data('kd_wilayah'); 
                            $username = get_user_data('username'); 
                            if($username == 'admin' ){
                            $a = db_get_all_data('wilayah');
                            }else{
                            $a = db_get_all_data('wilayah',"kd_wilayah = $kdwilayah");
                            }
                            ?>

                            <select  class="form-control chosen chosen-select-deselect" name="kd_wilayah" id="kd_wilayah" data-placeholder="PILIH wilayah" onchange="submit()">
                            
                            <?php if($username == 'admin'){?>
                                <option value="0"></option>
                            <?php } ?>

                            <?php foreach ($a as $row): ?>
                                
                                <option 
                                <?php if ($row->kd_wilayah == $this->input->post('kd_wilayah')) { ?>selected="selected"<?php } ?>
                                value="<?= $row->kd_wilayah ?>"><?= '[ '.$row->kd_wilayah.' ] '. $row->nama ?></option>
                                <?php endforeach; ?>  
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                                                 
                                                <div class="form-group ">
                            <label for="alamat_kantor" class="col-sm-2 control-label">Alamat Kantor 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="alamat_kantor" id="alamat_kantor" placeholder="Alamat Kantor" value="<?= set_value('alamat_kantor'); ?>">
                                <small class="info help-block">
                                <b>Input Alamat Kantor</b> Max Length : 100.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="luas" class="col-sm-2 control-label">Luas 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="luas" id="luas" placeholder="Luas" value="<?= set_value('luas'); ?>">
                                <small class="info help-block">
                                <b>Input Luas</b> Max Length : 12.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="utara" class="col-sm-2 control-label">Utara 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="utara" id="utara" placeholder="Utara" value="<?= set_value('utara'); ?>">
                                <small class="info help-block">
                                <b>Input Utara</b> Max Length : 50.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="timur" class="col-sm-2 control-label">Timur 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="timur" id="timur" placeholder="Timur" value="<?= set_value('timur'); ?>">
                                <small class="info help-block">
                                <b>Input Timur</b> Max Length : 50.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="selatan" class="col-sm-2 control-label">Selatan 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="selatan" id="selatan" placeholder="Selatan" value="<?= set_value('selatan'); ?>">
                                <small class="info help-block">
                                <b>Input Selatan</b> Max Length : 50.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="barat" class="col-sm-2 control-label">Barat 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="barat" id="barat" placeholder="Barat" value="<?= set_value('barat'); ?>">
                                <small class="info help-block">
                                <b>Input Barat</b> Max Length : 50.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="sejarah" class="col-sm-2 control-label">Sejarah 
                            </label>
                            <div class="col-sm-8">
                                <textarea id="sejarah" name="sejarah" rows="5" cols="80"><?= set_value('Sejarah'); ?></textarea>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="tahun_pembentukan" class="col-sm-2 control-label">Tahun Pembentukan 
                            </label>
                            <div class="col-sm-2">
                                <select  class="form-control chosen chosen-select-deselect" name="tahun_pembentukan" id="tahun_pembentukan" data-placeholder="Select Tahun Pembentukan" >
                                    <option value=""></option>
                                    <?php for ($i = 1970; $i < date('Y')+100; $i++){ ?>
                                    <option value="<?= $i;?>"><?= $i; ?></option>
                                    <?php }; ?>  
                                </select>
                                <small class="info help-block">
                                <b>Input Tahun Pembentukan</b> Max Length : 4.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="dasar_hukum" class="col-sm-2 control-label">Dasar Hukum 
                            </label>
                            <div class="col-sm-8">
                                <textarea id="dasar_hukum" name="dasar_hukum" rows="5" cols="80"><?= set_value('Dasar Hukum'); ?></textarea>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="kd_pos" class="col-sm-2 control-label">Kd Pos 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="kd_pos" id="kd_pos" placeholder="Kd Pos" value="<?= set_value('kd_pos'); ?>">
                                <small class="info help-block">
                                <b>Input Kd Pos</b> Max Length : 15.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="tipologi" class="col-sm-2 control-label">Tipologi 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="tipologi" id="tipologi" placeholder="Tipologi" value="<?= set_value('tipologi'); ?>">
                                <small class="info help-block">
                                <b>Input Tipologi</b> Max Length : 50.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="foto" class="col-sm-2 control-label">Foto 
                            </label>
                            <div class="col-sm-8">
                                <div id="wilayah_profil_foto_galery"></div>
                                <div id="wilayah_profil_foto_galery_listed"></div>
                                <small class="info help-block">
                                <b>Extension file must</b> JPEG,JPG,PNG,  <b>Max size file</b>  2000 kb.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="lokasi" class="col-sm-2 control-label">Lokasi 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="lokasi" id="lokasi" placeholder="Lokasi" value="<?= set_value('lokasi'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="visi_misi" class="col-sm-2 control-label">Visi Misi 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="visi_misi" id="visi_misi" placeholder="Visi Misi" value="<?= set_value('visi_misi'); ?>">
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
          url: BASE_URL + '/wilayah_profil/add_save',
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if(res.success) {
            
            if (save_type == 'back') {
              window.location.href = res.redirect;
              return;
            }
    
            $('.message').printMessage({message : res.message});
            $('.message').fadeIn();
            resetForm();
            $('#wilayah_profil_foto_galery').find('li').each(function() {
               $('#wilayah_profil_foto_galery').fineUploader('deleteFile', $(this).attr('qq-file-id'));
            });
            $('.chosen option').prop('selected', false).trigger('chosen:updated');
            sejarah.setData('');
            dasar_hukum.setData('');
                
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