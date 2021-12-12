
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
                            <h3 class="widget-user-username"><b>Suket Menikah</b></h3>
                            <h5 class="widget-user-desc">Edit Suket Menikah</h5>
                            <hr>
                        </div>
                        <?= form_open(base_url('suket_nikah/edit_save/'.$this->uri->segment(3)), [
                            'name'    => 'form_suket_nikah', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_suket_nikah', 
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
                    <option <?= $row->kd_wilayah ==  $suket_bnikah->kd_wilayah ? 'selected' : ''; ?> value="<?= $row->kd_wilayah ?>"><?= $row->nama; ?></option>
                  <?php endforeach; ?>
                </select>
                <small class="info help-block">
                  <b>Input Kd Wilayah</b> Max Length : 30.</small>
              </div>
            </div>
                         
                                                <div class="form-group ">
                            <label for="no" class="col-sm-2 control-label">NO. Surat 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="no" id="no" placeholder="NO. Surat" value="<?= set_value('no', $suket_nikah->no); ?>">
                                <small class="info help-block">
                                <b>Input No</b> Max Length : 11.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="tanggal_surat" class="col-sm-2 control-label">Tanggal Surat 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-6">
                            <div class="input-group date col-sm-8">
                              <input type="text" class="form-control pull-right datepicker" name="tanggal_surat"  placeholder="Tanggal Surat" id="tanggal_surat" value="<?= set_value('suket_nikah_tanggal_surat_name', $suket_nikah->tanggal_surat); ?>">
                            </div>
                            <small class="info help-block">
                            </small>
                            </div>
                        </div>
                       
                                                 
                                               <div class="form-group ">
              <label for="suami" class="col-sm-2 control-label">Suami
                <i class="required">*</i>
              </label>
              <div class="col-sm-8">
                <?php

                $kdwilayah = $this->input->post('kd_wilayah');
                $a = db_get_all_data('penduduk', "kd_wilayah = $kdwilayah");

                ?>
                <select class="form-control chosen chosen-select-deselect" name="suami" id="suami" data-placeholder="Select suami">
                  <option value=""></option>
                  <?php foreach ($a as $row) : ?>

                    <option <?php if ($row->nik == $suket_nikah->suami) { ?>selected="selected" <?php } ?> value="<?= $row->nik ?>"><?= '[ ' . $row->nik . ' ] ' . $row->nama ?></option>
                  <?php endforeach; ?>
                </select>
                <small class="info help-block">
                </small>
              </div>
            </div>
                                                 
                                               <div class="form-group ">
              <label for="istri" class="col-sm-2 control-label">Istri
                <i class="required">*</i>
              </label>
              <div class="col-sm-8">
                <?php

                $kdwilayah = $this->input->post('kd_wilayah');
                $a = db_get_all_data('penduduk', "kd_wilayah = $kdwilayah");

                ?>
                <select class="form-control chosen chosen-select-deselect" name="istri" id="istri" data-placeholder="Select istri">
                  <option value=""></option>
                  <?php foreach ($a as $row) : ?>

                    <option <?php if ($row->nik == $suket_nikah->istri) { ?>selected="selected" <?php } ?> value="<?= $row->nik ?>"><?= '[ ' . $row->nik . ' ] ' . $row->nama ?></option>
                  <?php endforeach; ?>
                </select>
                <small class="info help-block">
                </small>
              </div>
            </div>
                                                 
                                                <div class="form-group ">
              <label for="perangkat_id" class="col-sm-2 control-label">Perangkat Yang Bertanda Tangan
                <i class="required">*</i>
              </label>
              <div class="col-sm-8">
                <?php

                $kdwilayah = $suket_bnikah->kd_wilayah;
                $a = db_get_all_data('wilayah_perangkat', "kd_wilayah = $kdwilayah");

                ?>
                <select class="form-control chosen chosen-select-deselect" name="perangkat_id" id="perangkat_id" data-placeholder="Select Perangkat Id">
                  <option value="lurah">Lurah/Kepala Desa</option>
                  <?php foreach ($a as $row) : ?>
                    <option <?php if ($row->id == $suket_bnikah->perangkat_id) { ?>selected="selected" <?php } ?> value="<?= $row->id ?>"><?= '[ ' . $row->jabatan . ' ] ' . $row->nama ?></option>
                  <?php endforeach; ?>
                </select>
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
              window.location.href = BASE_URL + 'suket_nikah';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
            
        var form_suket_nikah = $('#form_suket_nikah');
        var data_post = form_suket_nikah.serializeArray();
        var save_type = $(this).attr('data-stype');
        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: form_suket_nikah.attr('action'),
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if(res.success) {
            var id = $('#suket_nikah_image_galery').find('li').attr('qq-file-id');
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