
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
                            <h3 class="widget-user-username"><b>Data Disabilitas Dan Rentan</b></h3>
                            <h5 class="widget-user-desc">Edit Data Disabilitas Dan Rentan</h5>
                            <hr>
                        </div>
                        <?= form_open(base_url('tbl_disabilitas/edit_save/'.$this->uri->segment(3)), [
                            'name'    => 'form_tbl_disabilitas', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_tbl_disabilitas', 
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
                    <option <?= $row->kd_wilayah ==  $tbl_disabilitas->kd_wilayah ? 'selected' : ''; ?> value="<?= $row->kd_wilayah ?>"><?= $row->nama; ?></option>
                  <?php endforeach; ?>
                </select>
                <small class="info help-block">
                  <b>Input Kd Wilayah</b> Max Length : 30.</small>
              </div>
            </div>
                         
                                               <div class="form-group ">
              <label for="nik" class="col-sm-2 control-label">NIK
                <i class="required">*</i>
              </label>
              <div class="col-sm-8">
                <?php

                $kdwilayah = $$tbl_disabilitas->kd_wilayah;
                $a = db_get_all_data('penduduk', "kd_wilayah = $kdwilayah");

                ?>
                <select class="form-control chosen chosen-select-deselect" name="nik" id="nik" data-placeholder="Select Nik">
                  <option value=""></option>
                  <?php foreach ($a as $row) : ?>

                    <option <?php if ($row->nik == $tbl_disabilitas->nik) { ?>selected="selected" <?php } ?> value="<?= $row->nik ?>"><?= '[ ' . $row->nik . ' ] ' . $row->nama ?></option>
                  <?php endforeach; ?>
                </select>
                <small class="info help-block">
                </small>
              </div>
            </div>
                                                 
                                                <div class="form-group ">
                            <label for="disabilitas" class="col-sm-2 control-label">Disabilatas 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select" name="disabilitas" id="disabilitas" data-placeholder="Select Disabilitas" >
                                    <option value=""></option>
                                    <option <?= $tbl_disabilitas->disabilitas == "Ya" ? 'selected' :''; ?> value="Ya">Ya</option>
                                    <option <?= $tbl_disabilitas->disabilitas == "Tidak" ? 'selected' :''; ?> value="Tidak">Tidak</option>
                                    </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="rentan" class="col-sm-2 control-label">Rentan 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select" name="rentan" id="rentan" data-placeholder="Select Rentan" >
                                    <option value=""></option>
                                    <option <?= $tbl_disabilitas->rentan == "Ya" ? 'selected' :''; ?> value="Ya">Ya</option>
                                    <option <?= $tbl_disabilitas->rentan == "Tidak" ? 'selected' :''; ?> value="Tidak">Tidak</option>
                                    </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="keterangan" class="col-sm-2 control-label">Keterangan 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <textarea id="keterangan" name="keterangan" rows="10" cols="80"> <?= set_value('keterangan', $tbl_disabilitas->keterangan); ?></textarea>
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
      
      CKEDITOR.replace('keterangan'); 
      var keterangan = CKEDITOR.instances.keterangan;
                   
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
              window.location.href = BASE_URL + 'tbl_disabilitas';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
        $('#keterangan').val(keterangan.getData());
                    
        var form_tbl_disabilitas = $('#form_tbl_disabilitas');
        var data_post = form_tbl_disabilitas.serializeArray();
        var save_type = $(this).attr('data-stype');
        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: form_tbl_disabilitas.attr('action'),
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if(res.success) {
            var id = $('#tbl_disabilitas_image_galery').find('li').attr('qq-file-id');
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