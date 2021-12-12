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
                            <h5 class="widget-user-desc"><?= cclang('new', ['Penduduk']); ?></h5>
                            <hr>
                        </div>
                        <?= form_open('', [
                            'name'    => 'form_penduduk_real', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_penduduk_real', 
                            'enctype' => 'multipart/form-data', 
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

                <select class="form-control chosen chosen-select-deselect" name="kd_wilayah" id="kd_wilayah" data-placeholder="PILIH wilayah" onchange="submit()">

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
                            <label for="nik" class="col-sm-2 control-label">Nik 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="nik" id="nik" placeholder="Nik" value="<?= set_value('nik'); ?>">
                                <small class="info help-block">
                                <b>Input Nik</b></small>
                            </div>
                        </div>
                                                 
                                                
                                                 
                                                <div class="form-group ">
                            <label for="nama" class="col-sm-2 control-label">Nama 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?= set_value('nama'); ?>">
                                <small class="info help-block">
                                <b>Input Nama</b></small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="tgl_lahir" class="col-sm-2 control-label">Tanggal Lahir 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-6">
                            <div class="input-group date col-sm-2">
                              <input type="text" class="form-control pull-right datepicker" name="tgl_lahir"  placeholder="Tgl Lahir" id="tgl_lahir">
                            </div>
                            <small class="info help-block">
                            </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="jenis_kelamin" class="col-sm-2 control-label">Jenis Kelamin 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-2">
                               <select class="form-control chosen chosen-select-deselect" name="jenis_kelamin" id="jenis_kelamin" data-placeholder="PILIH Jenis Kelamin" >

                    <option value="0"></option>

                    <option <?php if ('Laki-Laki' == $this->input->post('jenis_kelamin')) { ?>selected="selected" <?php } ?> value="Laki-laki">Laki-Laki</option>
                    <option <?php if ('Perempuan' == $this->input->post('jenis_kelamin')) { ?>selected="selected" <?php } ?> value="Perempuan">Perempuan</option>
                </select>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="alamat" class="col-sm-2 control-label">Alamat 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat" value="<?= set_value('alamat'); ?>">
                                <small class="info help-block">
                                <b>Input Alamat</b> </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="status_hubungan" class="col-sm-2 control-label">Status Hubungan 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-4">

                <select class="form-control chosen chosen-select-deselect" name="status_hubungan" id="status_hubungan" data-placeholder="PILIH Status Hubungan" >


                  <?php foreach (db_get_all_data('setup_hubungan') as $row) : ?>

                    <option <?php if ('11' == $this->input->post('status_hubungan')) { ?>selected="selected" <?php } ?> value="<?= $row->value ?>"><?=  $row->nama ?></option>
                  <?php endforeach; ?>
                </select>
                <small class="info help-block">
                                <b>Input Status Hubungan Keluarga</b></small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="status_perkawinan" class="col-sm-2 control-label">Status Perkawinan 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select" name="status_perkawinan[]" id="status_perkawinan" data-placeholder="Select Status Perkawinan" multiple >
                                    <option value=""></option>
                                    <option value="1">Kawin</option>
                                    <option value="2">Belum Kawin</option>
                                    <option value="3">Cerai Hidup</option>
                                    <option value="4">Cerai Mati</option>
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
                                <input type="text" class="form-control" name="nama_ayah" id="nama_ayah" placeholder="Nama Ayah" value="<?= set_value('nama_ayah'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="Nama_Ibu" class="col-sm-2 control-label">Nama Ibu 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="Nama_Ibu" id="Nama_Ibu" placeholder="Nama Ibu" value="<?= set_value('Nama_Ibu'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                 <div class="form-group ">
                            <label for="jenis_pekerjaan" class="col-sm-2 control-label">Jenis Pekerjaan 
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select" name="jenis_pekerjaan" id="jenis_pekerjaan" data-placeholder="Select Jenis Pekerjaan" >
                                 <option value="0"></option>
                                    <?php foreach (db_get_all_data('setup_pekerjaan') as $row): ?>
                                    <option value="<?= $row->value ?>"><?= $row->nama; ?></option>
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
                                    <option value="0"></option>
                                    <?php foreach (db_get_all_data('setup_agama') as $row): ?>
                                    <option value="<?= $row->value ?>"><?= $row->nama; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                                                 
                                                <div class="form-group ">
                            <label for="gologan_dara" class="col-sm-2 control-label">Gologan Darah 
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select" name="gologan_dara" id="gologan_dara" data-placeholder="Select Gologan Dara" >
                                    <option value=""></option>
                                    <option value="0">Tidak Tahu</option>
                                    <option value="1">A</option>
                                    <option value="2">B</option>
                                    <option value="3">AB</option>
                                    <option value="4">O</option>
                                    </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                        <!--                        <div class="form-group ">-->
                        <!--    <label for="verifikasi" class="col-sm-2 control-label">Verifikasi -->
                        <!--    </label>-->
                        <!--    <div class="col-sm-8">-->
                        <!--        <select  class="form-control chosen chosen-select" name="verifikasi[]" id="verifikasi" data-placeholder="Select Verifikasi" multiple >-->
                        <!--            <option value=""></option>-->
                        <!--            <option value="1">Verifikasi</option>-->
                        <!--            <option value="2">Belum Verifikasi</option>-->
                        <!--            <option value="3">Proses</option>-->
                        <!--            </select>-->
                        <!--        <small class="info help-block">-->
                        <!--        </small>-->
                        <!--    </div>-->
                        <!--</div>-->
                                                 
                                                <div class="form-group ">
                            <label for="tempat_lahir" class="col-sm-2 control-label">Tempat Lahir 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" placeholder="Tempat Lahir" value="<?= set_value('tempat_lahir'); ?>">
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
          url: BASE_URL + '/penduduk_real/add_save',
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
      
       
 
       
    
    
    }); /*end doc ready*/
</script>