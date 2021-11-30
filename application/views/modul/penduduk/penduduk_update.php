
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
                        <?= form_open(base_url('penduduk/edit_save/'.$this->uri->segment(3)), [
                            'name'    => 'form_penduduk', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_penduduk', 
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
                            <label for="nik" class="col-sm-2 control-label">Nik 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="nik" id="nik" placeholder="Nik" value="<?= set_value('nik', $penduduk->nik); ?>">
                                <small class="info help-block">
                                <b>Input Nik</b> </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="nama" class="col-sm-2 control-label">Nama 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?= set_value('nama', $penduduk->nama); ?>">
                                <small class="info help-block">
                                <b>Input Nama</b> </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="tempat_lahir" class="col-sm-2 control-label">Tempat Lahir 
                            <i class="required">*</i>
                            </label>
                            <div class="row">
                            <div class="col-sm-2">
                            <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" placeholder="Tempat Lahir" value="<?= set_value('tempat_lahir', $penduduk->tempat_lahir); ?>"> 
                               
                            </div>
                            <div class="col-sm-2">
                            <div class="input-group date">
                              <input type="text" class="form-control pull-right datetimepicker" name="tgl_lahir"  placeholder="Tgl Lahir" id="tgl_lahir" value="<?= set_value('tgl_lahir', $penduduk->tgl_lahir); ?>">
                            </div>
                            </div>
                            </div>
                            
                        </div>
                                               
                                                 
                        <div class="form-group ">
                            <label for="jenis_kelamin" class="col-sm-2 control-label">Jenis Kelamin 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-2">
                                <select  class="form-control chosen chosen-select" name="jenis_kelamin" id="jenis_kelamin" data-placeholder="Select Jenis Kelamin" >
                                    <option value=""></option>
                                    <option <?= $wilayah_kepala->jenis_kelamin == "Laki - Laki" ? 'selected' :''; ?> value="Laki - Laki">Laki - Laki</option>
                                    <option <?= $wilayah_kepala->jenis_kelamin == "Perempuan" ? 'selected' :''; ?> value="Perempuan">Perempuan</option>
                                    </select>
                                <small class="info help-block">
                                <b>Input Jenis Kelamin</b> </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="alamat" class="col-sm-2 control-label">Alamat 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat" value="<?= set_value('alamat', $penduduk->alamat); ?>">
                                <small class="info help-block">
                                <b>Input Alamat</b> </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="status_hubungan" class="col-sm-2 control-label">Status Hubungan 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="status_hubungan" id="status_hubungan" placeholder="Status Hubungan" value="<?= set_value('status_hubungan', $penduduk->status_hubungan); ?>">
                                <small class="info help-block">
                                <b>Input Status Hubungan</b> </small>
                            </div>
                        </div>
                                                 
                        <div class="form-group ">
                            <label for="agama" class="col-sm-2 control-label">Agama 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-4">
                                <select  class="form-control chosen chosen-select" name="agama[]" id="agama" data-placeholder="Select Agama">
                                    <option value=""></option>
                                    <option <?= in_array('Islam', explode(',', $wilayah_kepala->agama)) ? 'selected' : ''; ?>  value="Islam">Islam</option>
                                    <option <?= in_array('Kristen Protestan', explode(',', $wilayah_kepala->agama)) ? 'selected' : ''; ?>  value="Kristen Protestan">Kristen Protestan</option>
                                    <option <?= in_array('Kristen Katolik', explode(',', $wilayah_kepala->agama)) ? 'selected' : ''; ?>  value="Kristen Katolik">Kristen Katolik</option>
                                    <option <?= in_array('Hindu', explode(',', $wilayah_kepala->agama)) ? 'selected' : ''; ?>  value="Hindu">Hindu</option>
                                    <option <?= in_array('Buddha', explode(',', $wilayah_kepala->agama)) ? 'selected' : ''; ?>  value="Buddha">Buddha</option>
                                    <option <?= in_array('Kong Hu Cu', explode(',', $wilayah_kepala->agama)) ? 'selected' : ''; ?>  value="Kong Hu Cu">Kong Hu Cu</option>
                                    </select>
                                <small class="info help-block">
                                <b>Input Agama</b> </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="status_perkawinan" class="col-sm-2 control-label">Status Perkawinan 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-2">
                            <select  class="form-control chosen chosen-select" name="status_perkawinan" id="status_perkawinan" placeholder="Status Perkawinan" value="<?= set_value('status_perkawinan'); ?>">
                                    <option value=""></option>
                                    <option <?= $wilayah_kepala->status_perkawinan == "Menikah" ? 'selected' :''; ?>  value="Menikah">Menikah</option>
                                    <option <?= $wilayah_kepala->status_perkawinan == "Belum Menikah" ? 'selected' :''; ?> value="Belum Menikah">Belum Menikah</option>
                                    <option <?= $wilayah_kepala->status_perkawinan == "Cerai Hidup" ? 'selected' :''; ?> value="Cerai Hidup">Cerai Hidup</option>
                                    <option <?= $wilayah_kepala->status_perkawinan == "Cerai Mati" ? 'selected' :''; ?> value="Cerai Mati">Cerai Mati</option>
                                    </select>
                                <small class="info help-block">
                                <b>Input Status Perkawinan</b></small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="kepemilikan_akte_perkawinan" class="col-sm-2 control-label">Kepemilikan Akte Perkawinan 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="kepemilikan_akte_perkawinan" id="kepemilikan_akte_perkawinan" placeholder="Kepemilikan Akte Perkawinan" value="<?= set_value('kepemilikan_akte_perkawinan', $penduduk->kepemilikan_akte_perkawinan); ?>">
                                <small class="info help-block">
                                <b>Input Kepemilikan Akte Perkawinan</b> </small>
                            </div>
                        </div>
                                                 
                        <div class="form-group ">
                            <label for="pendidikan_terakhir" class="col-sm-2 control-label">Pend Terakhir 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-2">
                                <select  class="form-control chosen chosen-select" name="pendidikan_terakhir[]" id="pendidikan_terakhir" data-placeholder="Select Pend Terakhir">
                                    <option value=""></option>
                                    <option <?= in_array('SD/Sederajat', explode(',', $wilayah_kepala->pendidikan_terakhir)) ? 'selected' : ''; ?>  value="SD/Sederajat">SD/Sederajat</option>
                                    <option <?= in_array('SMP/Sederajat', explode(',', $wilayah_kepala->pendidikan_terakhir)) ? 'selected' : ''; ?>  value="SMP/Sederajat">SMP/Sederajat</option>
                                    <option <?= in_array('SMA/Sederajat', explode(',', $wilayah_kepala->pendidikan_terakhir)) ? 'selected' : ''; ?>  value="SMA/Sederajat">SMA/Sederajat</option>
                                    <option <?= in_array('D1/D2/D3', explode(',', $wilayah_kepala->pendidikan_terakhir)) ? 'selected' : ''; ?>  value="D1/D2/D3">D1/D2/D3</option>
                                    <option <?= in_array('D4/S1', explode(',', $wilayah_kepala->pendidikan_terakhir)) ? 'selected' : ''; ?>  value="D4/S1">D4/S1</option>
                                    <option <?= in_array('S2', explode(',', $wilayah_kepala->pendidikan_terakhir)) ? 'selected' : ''; ?>  value="S2">S2</option>
                                    <option <?= in_array('S3', explode(',', $wilayah_kepala->pendidikan_terakhir)) ? 'selected' : ''; ?>  value="S3">S3</option>
                                    </select>
                                <small class="info help-block">
                                <b>Input Pend Terakhir</b> </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="jenis_pekerjaan" class="col-sm-2 control-label">Jenis Pekerjaan 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="jenis_pekerjaan" id="jenis_pekerjaan" placeholder="Jenis Pekerjaan" value="<?= set_value('jenis_pekerjaan', $penduduk->jenis_pekerjaan); ?>">
                                <small class="info help-block">
                                <b>Input Jenis Pekerjaan</b> </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="bidang_pekerjaan" class="col-sm-2 control-label">Bidang Pekerjaan 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="bidang_pekerjaan" id="bidang_pekerjaan" placeholder="Bidang Pekerjaan" value="<?= set_value('bidang_pekerjaan', $penduduk->bidang_pekerjaan); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="no_kk" class="col-sm-2 control-label">No Kk 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="no_kk" id="no_kk" placeholder="No Kk" value="<?= set_value('no_kk', $penduduk->no_kk); ?>">
                                <small class="info help-block">
                                <b>Input No Kk</b> </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="kd_wilayah" class="col-sm-2 control-label">Kd Wilayah 
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select" name="kd_wilayah[]" id="kd_wilayah" data-placeholder="Select Kd Wilayah" multiple >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('wilayah') as $row): ?>
                                    <option <?=  in_array($row->kd_wilayah, explode(',', $penduduk->kd_wilayah)) ? 'selected' : ''; ?> value="<?= $row->kd_wilayah ?>"><?= $row->nama; ?></option>
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
              window.location.href = BASE_URL + 'penduduk';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
            
        var form_penduduk = $('#form_penduduk');
        var data_post = form_penduduk.serializeArray();
        var save_type = $(this).attr('data-stype');
        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: form_penduduk.attr('action'),
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if(res.success) {
            var id = $('#penduduk_image_galery').find('li').attr('qq-file-id');
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