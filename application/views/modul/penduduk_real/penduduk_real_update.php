
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
                            <h3 class="widget-user-username"><b>Penduduk</b></h3>
                            <h5 class="widget-user-desc">Edit Penduduk</h5>
                            <hr>
                        </div>
                        <?= form_open(base_url('penduduk_real/edit_save/'.$this->uri->segment(3)), [
                            'name'    => 'form_penduduk_real', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_penduduk_real', 
                            'method'  => 'POST'
                            ]); ?>
                         
                                            
                                                 
                                               <div class="form-group ">
              <label for="kd_wilayah" class="col-sm-2 control-label">Wilayah
              </label>
              <div class="col-sm-8">
                <?php

                $kdwilayah = get_user_data('kd_wilayah');
                $id = get_user_data('id');
                $group = get_user_group($id);
                if ($group == '1') {
                  $a = db_get_all_data('wilayah');
                } else {
                  $a = db_get_all_data('wilayah',"kd_wilayah LIKE '$kdwilayah%'");
                }
                ?>

                <select class="form-control chosen chosen-select-deselect" name="kd_wilayah" id="kd_wilayah" data-placeholder="PILIH wilayah" onchange="submit()" disabled>

                  <?php if ($group == '1') { ?>
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
                            <label for="no_kk" class="col-sm-2 control-label">No Kk 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-4">
                                

                <?php 
                                $kdwilayah = get_user_data('kd_wilayah'); 
                                $username = get_user_data('username'); 
                                if($username == 'admin' ){
                                  $a = db_get_all_data('tbl_kk');
                                }else{
                                 $a = db_get_all_data('tbl_kk',"kd_wilayah LIKE '$kdwilayah%'");
                                }
                              ?>

                <select class="form-control chosen chosen-select-deselect" name="no_kk" id="no_kk" data-placeholder="PILIH No.KK" >

                    <option value="0"></option>

                  <?php foreach ($a as $row) : ?>

                    <option <?php if ($row->no_kk == $this->input->post('no_kk')) { ?>selected="selected" <?php } ?> value="<?= $row->no_kk ?>"><?=  $row->no_kk ?></option>
                  <?php endforeach; ?>
                </select>
                <small class="info help-block">
                </small>
              </div>
            </div>
                                                 
                                                <div class="form-group ">
                            <label for="nik" class="col-sm-2 control-label">NIK 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="nik" id="nik" placeholder="nik" value="<?= set_value('nik', $penduduk_real->nik); ?>">
                                <small class="info help-block">
                                <b>Input Nik</b></small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="nama" class="col-sm-2 control-label">Nama 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?= set_value('nama', $penduduk_real->nama); ?>">
                                <small class="info help-block">
                                <b>Input Nama</b></small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="tgl_lahir" class="col-sm-2 control-label">Tanggal Lahir 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-6">
                            <div class="input-group date col-sm-8">
                              <input type="text" class="form-control pull-right datepicker" name="tgl_lahir"  placeholder="Tgl Lahir" id="tgl_lahir" value="<?= set_value('penduduk_real_tgl_lahir_name', $penduduk_real->tgl_lahir); ?>">
                            </div>
                            <small class="info help-block">
                            </small>
                            </div>
                        </div>
                       
                                                 
                                                <div class="form-group ">
                            <label for="jenis_kelamin" class="col-sm-2 control-label">Jenis Kelamin 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                 <select class="form-control chosen chosen-select-deselect" name="jenis_kelamin" id="jenis_kelamin" data-placeholder="PILIH Jenis Kelamin" >

                    <option value="0"></option>

                    <option <?php if ('Laki-Laki' == $penduduk_real->jenis_kelamin) { ?>selected="selected" <?php } ?> value="Laki-laki">Laki-Laki</option>
                    <option <?php if ('Perempuan' == $penduduk_real->jenis_kelamin) { ?>selected="selected" <?php } ?> value="Perempuan">Perempuan</option>
                </select>
                <small class="info help-block">
                                <b>Input Jenis Kelamin</b></small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="alamat" class="col-sm-2 control-label">Alamat 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat" value="<?= set_value('alamat', $penduduk_real->alamat); ?>">
                                <small class="info help-block">
                                <b>Input Alamat</b></small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="status_hubungan" class="col-sm-2 control-label">Status Hubungan 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="status_hubungan" id="status_hubungan" data-placeholder="Select Status Hubungan" >
                                    <option value="0"></option>
                                    <?php foreach (db_get_all_data('setup_hubungan') as $row): ?>
                                    <option <?=  $row->value ==  $penduduk_real->status_hubungan ? 'selected' : ''; ?> value="<?= $row->value ?>"><?= $row->nama; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                                <small class="info help-block">
                                <b>Input Status Hubungan</b></small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="status_perkawinan" class="col-sm-2 control-label">Status Perkawinan 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select" name="status_perkawinan[]" id="status_perkawinan" data-placeholder="Select Status Perkawinan" multiple >
                                    <option value=""></option>
                                    <option <?= in_array('1', explode(',', $penduduk_real->status_perkawinan)) ? 'selected' : ''; ?>  value="1">Kawin</option>
                                    <option <?= in_array('2', explode(',', $penduduk_real->status_perkawinan)) ? 'selected' : ''; ?>  value="2">Belum Kawin</option>
                                    <option <?= in_array('3', explode(',', $penduduk_real->status_perkawinan)) ? 'selected' : ''; ?>  value="3">Cerai Hidup</option>
                                    <option <?= in_array('4', explode(',', $penduduk_real->status_perkawinan)) ? 'selected' : ''; ?>  value="4">Cerai Mati</option>
                                    </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="nama_ayah" class="col-sm-2 control-label">Nama Ayah 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="nama_ayah" id="nama_ayah" placeholder="Nama Ayah" value="<?= set_value('nama_ayah', $penduduk_real->nama_ayah); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="Nama_Ibu" class="col-sm-2 control-label">Nama Ibu 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="Nama_Ibu" id="Nama_Ibu" placeholder="Nama Ibu" value="<?= set_value('Nama_Ibu', $penduduk_real->Nama_Ibu); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                
                                                 
                                                <div class="form-group ">
                            <label for="jenis_pekerjaan" class="col-sm-2 control-label">Jenis Pekerjaan 
                            </label>
                            <div class="col-sm-8">
                                 <select  class="form-control chosen chosen-select-deselect" name="jenis_pekerjaan" id="jenis_pekerjaan" data-placeholder="Select Pekerjaan" >
                                    <option value="0"></option>
                                    <?php foreach (db_get_all_data('setup_pekerjaan') as $row): ?>
                                    <option <?=  $row->value ==  $penduduk_real->jenis_pekerjaan ? 'selected' : ''; ?> value="<?= $row->value ?>"><?= $row->nama; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="agama" class="col-sm-2 control-label">Agama 
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="agama" id="agama" data-placeholder="Select Agama" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('setup_agama') as $row): ?>
                                    <option <?=  $row->value ==  $penduduk_real->agama ? 'selected' : ''; ?> value="<?= $row->value ?>"><?= $row->nama; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                                                 
                                                <div class="form-group ">
                            <label for="golongan_dara" class="col-sm-2 control-label">golongan Darah 
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select" name="golongan_dara" id="golongan_dara" data-placeholder="Select golongan Dara" >
                                    <option value=""></option>
                                    <option <?= $penduduk_real->golongan_dara == "0" ? 'selected' :''; ?> value="0">Tidak Tahu</option>
                                    <option <?= $penduduk_real->golongan_dara == "1" ? 'selected' :''; ?> value="1">A</option>
                                    <option <?= $penduduk_real->golongan_dara == "2" ? 'selected' :''; ?> value="2">B</option>
                                    <option <?= $penduduk_real->golongan_dara == "3" ? 'selected' :''; ?> value="3">AB</option>
                                    <option <?= $penduduk_real->golongan_dara == "4" ? 'selected' :''; ?> value="4">O</option>
                                    </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                
                                                 
                                                <div class="form-group ">
                            <label for="tempat_lahir" class="col-sm-2 control-label">Tempat Lahir 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" placeholder="Tempat Lahir" value="<?= set_value('tempat_lahir', $penduduk_real->tempat_lahir); ?>">
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
              window.location.href = BASE_URL + 'penduduk_real';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
            
        var form_penduduk_real = $('#form_penduduk_real');
        var data_post = form_penduduk_real.serializeArray();
        var save_type = $(this).attr('data-stype');
        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: form_penduduk_real.attr('action'),
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if(res.success) {
            var id = $('#penduduk_real_image_galery').find('li').attr('qq-file-id');
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