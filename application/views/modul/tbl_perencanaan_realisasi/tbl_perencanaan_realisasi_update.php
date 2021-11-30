
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
                            <h3 class="widget-user-username"><b>Realisasi Pembangunan</b></h3>
                            <h5 class="widget-user-desc">Edit Realisasi Pembangunan</h5>
                            <hr>
                        </div>
                        <?= form_open(base_url('tbl_perencanaan_realisasi/edit_save/'.$this->uri->segment(3)), [
                            'name'    => 'form_tbl_perencanaan_realisasi', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_tbl_perencanaan_realisasi', 
                            'method'  => 'POST'
                            ]); ?>
                         
                                               <div class="form-group ">
              <label for="kd_wilayah" class="col-sm-2 control-label">Kd Wilayah
                <i class="required">*</i>
              </label>
              <div class="col-sm-8">
                <select class="form-control chosen chosen-select-deselect" name="kd_wilayah" id="kd_wilayah" data-placeholder="Select Kd Wilayah" disabled>
                  <option value=""></option>
                  <?php foreach (db_get_all_data('wilayah') as $row) : ?>
                    <option <?= $row->kd_wilayah ==  $tbl_perencanaan_realisasi->kd_wilayah ? 'selected' : ''; ?> value="<?= $row->kd_wilayah ?>"><?= $row->nama; ?></option>
                  <?php endforeach; ?>
                </select>
                <small class="info help-block">
                  <b>Input Kd Wilayah</b> Max Length : 30.</small>
              </div>
            </div>
                         
                                                <div class="form-group ">
                            <label for="bidang" class="col-sm-2 control-label">Bidang 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select class="form-control chosen chosen-select-deselect" name="bidang" id="bidang" data-placeholder="Select Bidang">
                               <?php foreach (db_get_all_data('setup_bidang') as $row) : ?>
                    <option <?= $row->kd_bidang ==  $tbl_perencanaan_realisasi->kd_bidang ? 'selected' : ''; ?> value="<?= $row->kd_bidang ?>"><?= $row->nama; ?></option>
                  <?php endforeach; ?>
                  </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="pekerjaan" class="col-sm-2 control-label">Kegiatan 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="pekerjaan" id="pekerjaan" placeholder="Kegiatan" value="<?= set_value('pekerjaan', $tbl_perencanaan_realisasi->pekerjaan); ?>">
                                <small class="info help-block">
                                <b>Input Pekerjaan</b> Max Length : 255.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="sasaran" class="col-sm-2 control-label">Sasaran 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="sasaran" id="sasaran" placeholder="Sasaran" value="<?= set_value('sasaran', $tbl_perencanaan_realisasi->sasaran); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="volume" class="col-sm-2 control-label">Volume 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="volume" id="volume" placeholder="Volume" value="<?= set_value('volume', $tbl_perencanaan_realisasi->volume); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="lokasi" class="col-sm-2 control-label">Lokasi 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="lokasi" id="lokasi" placeholder="Lokasi" value="<?= set_value('lokasi', $tbl_perencanaan_realisasi->lokasi); ?>">
                                <small class="info help-block">
                                <b>Input Lokasi</b> Max Length : 255.</small>
                            </div>
                        </div>
                                                 
                                                 <div class="form-group ">
                            <label for="sumber_dana" class="col-sm-2 control-label">Sumber Dana 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select class="form-control chosen chosen-select-deselect" name="sumber_dana" id="sumber_dana" data-placeholder="Pilih Sumber Dana">
                  <option value=""></option>
                   <?php foreach (db_get_all_data('setup_sumber_dana') as $row): ?>
                                    <option <?= $row->kd_sumber_dana ==  $tbl_perencanaan_rencana->bidang ? 'selected' : ''; ?> value="<?= $row->kd_sumber_dana ?>"><?= $row->nama; ?></option>
                                    <?php endforeach; ?>  
                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="anggaran" class="col-sm-2 control-label">Anggaran 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="anggaran" id="anggaran" placeholder="Anggaran" value="<?= set_value('anggaran', $tbl_perencanaan_realisasi->anggaran); ?>">
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
              window.location.href = BASE_URL + 'tbl_perencanaan_realisasi';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
            
        var form_tbl_perencanaan_realisasi = $('#form_tbl_perencanaan_realisasi');
        var data_post = form_tbl_perencanaan_realisasi.serializeArray();
        var save_type = $(this).attr('data-stype');
        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: form_tbl_perencanaan_realisasi.attr('action'),
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if(res.success) {
            var id = $('#tbl_perencanaan_realisasi_image_galery').find('li').attr('qq-file-id');
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
      
       
       
           
    
    }); /*end doc ready*/
</script>