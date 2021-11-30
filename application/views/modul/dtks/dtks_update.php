
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
                            <h3 class="widget-user-username"><b>Data DTKS</b></h3>
                            <h5 class="widget-user-desc">Edit Data DTKS</h5>
                            <hr>
                        </div>
                        <?= form_open(base_url('dtks/edit_save/'.$this->uri->segment(3)), [
                            'name'    => 'form_dtks', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_dtks', 
                            'method'  => 'POST'
                            ]); ?>
                         
                                                <div class="form-group ">
                            <label for="jumlah_keluarga" class="col-sm-2 control-label">Jumlah Anggota Keluarga 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="jumlah_keluarga" id="jumlah_keluarga" placeholder="Jumlah Anggota Keluarga" value="<?= set_value('jumlah_keluarga', $dtks->jumlah_keluarga); ?>">
                                <small class="info help-block">
                                <b>Input Jumlah Keluarga</b> Max Length : 11.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="alamat" class="col-sm-2 control-label">Alamat Tempat Tinggal 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat Tempat Tinggal" value="<?= set_value('alamat', $dtks->alamat); ?>">
                                <small class="info help-block">
                                <b>Input Alamat</b> Max Length : 255.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="no_kk" class="col-sm-2 control-label">No. KK 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="no_kk" id="no_kk" placeholder="No. KK" value="<?= set_value('no_kk', $dtks->no_kk); ?>">
                                <small class="info help-block">
                                <b>Input No Kk</b> Max Length : 50.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="nik" class="col-sm-2 control-label">NIK 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="nik" id="nik" placeholder="NIK" value="<?= set_value('nik', $dtks->nik); ?>">
                                <small class="info help-block">
                                <b>Input Nik</b> Max Length : 50.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="nama" class="col-sm-2 control-label">Nama 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?= set_value('nama', $dtks->nama); ?>">
                                <small class="info help-block">
                                <b>Input Nama</b> Max Length : 50.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="jenis_kelamin" class="col-sm-2 control-label">Jenis Kelamin 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select" name="jenis_kelamin" id="jenis_kelamin" data-placeholder="Select Jenis Kelamin" >
                                    <option value=""></option>
                                    <option <?= $dtks->jenis_kelamin == "Laki - Laki" ? 'selected' :''; ?> value="Laki - Laki">Laki - Laki</option>
                                    <option <?= $dtks->jenis_kelamin == "Perempuan" ? 'selected' :''; ?> value="Perempuan">Perempuan</option>
                                    </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="tgl_lahir" class="col-sm-2 control-label">Tanggal Lahir 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-6">
                            <div class="input-group date col-sm-8">
                              <input type="text" class="form-control pull-right datepicker" name="tgl_lahir"  placeholder="Tanggal Lahir" id="tgl_lahir" value="<?= set_value('dtks_tgl_lahir_name', $dtks->tgl_lahir); ?>">
                            </div>
                            <small class="info help-block">
                            </small>
                            </div>
                        </div>
                       
                                                 
                                                <div class="form-group ">
                            <label for="status_perkawinan" class="col-sm-2 control-label">Status Perkawinan 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select" name="status_perkawinan" id="status_perkawinan" data-placeholder="Select Status Perkawinan" >
                                    <option value=""></option>
                                    <option <?= $dtks->status_perkawinan == "Menikah" ? 'selected' :''; ?> value="Menikah">Menikah</option>
                                    <option <?= $dtks->status_perkawinan == "Belum Menikah" ? 'selected' :''; ?> value="Belum Menikah">Belum Menikah</option>
                                    <option <?= $dtks->status_perkawinan == "Cerai Hidup" ? 'selected' :''; ?> value="Cerai Hidup">Cerai Hidup</option>
                                    <option <?= $dtks->status_perkawinan == "Cerai Mati" ? 'selected' :''; ?> value="Cerai Mati">Cerai Mati</option>
                                    </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="status_hubungan" class="col-sm-2 control-label">Status Hubungan Keluarga 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="status_hubungan" id="status_hubungan" data-placeholder="Select Status Hubungan" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('setup_hubungan') as $row): ?>
                                    <option <?=  $row->value ==  $dtks->status_hubungan ? 'selected' : ''; ?> value="<?= $row->value ?>"><?= $row->nama; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                                                 
                                                <div class="form-group ">
                            <label for="status_kesejahteraan" class="col-sm-2 control-label">Status Kesejahteraan (DESIL) 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="status_kesejahteraan" id="status_kesejahteraan" data-placeholder="Select Status Kesejahteraan" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('setup_desil') as $row): ?>
                                    <option <?=  $row->value ==  $dtks->status_kesejahteraan ? 'selected' : ''; ?> value="<?= $row->value ?>"><?= $row->nama; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                                                 
                                                <div class="form-group ">
                            <label for="status_kepemilikan_bangunan" class="col-sm-2 control-label">Status Kepemilikan Bangunan 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="status_kepemilikan_bangunan" id="status_kepemilikan_bangunan" data-placeholder="Select Status Kepemilikan Bangunan" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('setup_bangunan') as $row): ?>
                                    <option <?=  $row->value ==  $dtks->status_kepemilikan_bangunan ? 'selected' : ''; ?> value="<?= $row->value ?>"><?= $row->nama; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                                                 
                                                <div class="form-group ">
                            <label for="status_kepemilikan_tanah" class="col-sm-2 control-label">Status Kepemilikan Tanah 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="status_kepemilikan_tanah" id="status_kepemilikan_tanah" data-placeholder="Select Status Kepemilikan Tanah" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('setup_lahan') as $row): ?>
                                    <option <?=  $row->value ==  $dtks->status_kepemilikan_tanah ? 'selected' : ''; ?> value="<?= $row->value ?>"><?= $row->nama; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                                                 
                                                <div class="form-group ">
                            <label for="kks_kps" class="col-sm-2 control-label">KKS/KPS 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-6">
                                <div class="col-md-2 padding-left-0">
                                    <label>
                                        <input type="radio" class="flat-red" name="kks_kps" id="kks_kps"  value="yes" <?= $dtks->kks_kps == "yes" ? "checked" : ""; ?>>
                                        Yes
                                    </label>
                                </div>
                                <div class="col-md-14">
                                    <label>
                                        <input type="radio" class="flat-red" name="kks_kps" id="kks_kps"  value="no" <?= $dtks->kks_kps == "no" ? "checked" : ""; ?>>
                                        No
                                    </label>
                                </div>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="pkh" class="col-sm-2 control-label">PKH 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-6">
                                <div class="col-md-2 padding-left-0">
                                    <label>
                                        <input type="radio" class="flat-red" name="pkh" id="pkh"  value="yes" <?= $dtks->pkh == "yes" ? "checked" : ""; ?>>
                                        Yes
                                    </label>
                                </div>
                                <div class="col-md-14">
                                    <label>
                                        <input type="radio" class="flat-red" name="pkh" id="pkh"  value="no" <?= $dtks->pkh == "no" ? "checked" : ""; ?>>
                                        No
                                    </label>
                                </div>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="raskin" class="col-sm-2 control-label">RASKIN 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-6">
                                <div class="col-md-2 padding-left-0">
                                    <label>
                                        <input type="radio" class="flat-red" name="raskin" id="raskin"  value="yes" <?= $dtks->raskin == "yes" ? "checked" : ""; ?>>
                                        Yes
                                    </label>
                                </div>
                                <div class="col-md-14">
                                    <label>
                                        <input type="radio" class="flat-red" name="raskin" id="raskin"  value="no" <?= $dtks->raskin == "no" ? "checked" : ""; ?>>
                                        No
                                    </label>
                                </div>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="kur" class="col-sm-2 control-label">KUR 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-6">
                                <div class="col-md-2 padding-left-0">
                                    <label>
                                        <input type="radio" class="flat-red" name="kur" id="kur"  value="yes" <?= $dtks->kur == "yes" ? "checked" : ""; ?>>
                                        Yes
                                    </label>
                                </div>
                                <div class="col-md-14">
                                    <label>
                                        <input type="radio" class="flat-red" name="kur" id="kur"  value="no" <?= $dtks->kur == "no" ? "checked" : ""; ?>>
                                        No
                                    </label>
                                </div>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="jenis_cacat" class="col-sm-2 control-label">Jenis Cacat 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="jenis_cacat" id="jenis_cacat" data-placeholder="Select Jenis Cacat" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('setup_cacat') as $row): ?>
                                    <option <?=  $row->value ==  $dtks->jenis_cacat ? 'selected' : ''; ?> value="<?= $row->value ?>"><?= $row->nama; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                                                 
                                                <div class="form-group ">
                            <label for="penyakit_kronis" class="col-sm-2 control-label">Penyakit Kronis 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="penyakit_kronis" id="penyakit_kronis" data-placeholder="Select Penyakit Kronis" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('setup_penyakit') as $row): ?>
                                    <option <?=  $row->value ==  $dtks->penyakit_kronis ? 'selected' : ''; ?> value="<?= $row->value ?>"><?= $row->nama; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                                                 
                                                <div class="form-group ">
                            <label for="status_kehamilan" class="col-sm-2 control-label">Status Kehmilan 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-6">
                                <div class="col-md-2 padding-left-0">
                                    <label>
                                        <input type="radio" class="flat-red" name="status_kehamilan" id="status_kehamilan"  value="yes" <?= $dtks->status_kehamilan == "yes" ? "checked" : ""; ?>>
                                        Yes
                                    </label>
                                </div>
                                <div class="col-md-14">
                                    <label>
                                        <input type="radio" class="flat-red" name="status_kehamilan" id="status_kehamilan"  value="no" <?= $dtks->status_kehamilan == "no" ? "checked" : ""; ?>>
                                        No
                                    </label>
                                </div>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="kip_bsm" class="col-sm-2 control-label">KIP/BSM 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-6">
                                <div class="col-md-2 padding-left-0">
                                    <label>
                                        <input type="radio" class="flat-red" name="kip_bsm" id="kip_bsm"  value="yes" <?= $dtks->kip_bsm == "yes" ? "checked" : ""; ?>>
                                        Yes
                                    </label>
                                </div>
                                <div class="col-md-14">
                                    <label>
                                        <input type="radio" class="flat-red" name="kip_bsm" id="kip_bsm"  value="no" <?= $dtks->kip_bsm == "no" ? "checked" : ""; ?>>
                                        No
                                    </label>
                                </div>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="kis_bpjs" class="col-sm-2 control-label">KIS/BPJS KESEHATAN/JAMKESMAS 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-6">
                                <div class="col-md-2 padding-left-0">
                                    <label>
                                        <input type="radio" class="flat-red" name="kis_bpjs" id="kis_bpjs"  value="yes" <?= $dtks->kis_bpjs == "yes" ? "checked" : ""; ?>>
                                        Yes
                                    </label>
                                </div>
                                <div class="col-md-14">
                                    <label>
                                        <input type="radio" class="flat-red" name="kis_bpjs" id="kis_bpjs"  value="no" <?= $dtks->kis_bpjs == "no" ? "checked" : ""; ?>>
                                        No
                                    </label>
                                </div>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="bpjs_mandiri" class="col-sm-2 control-label">BPJS KESEHATAN PESERTA MANDIRI 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-6">
                                <div class="col-md-2 padding-left-0">
                                    <label>
                                        <input type="radio" class="flat-red" name="bpjs_mandiri" id="bpjs_mandiri"  value="yes" <?= $dtks->bpjs_mandiri == "yes" ? "checked" : ""; ?>>
                                        Yes
                                    </label>
                                </div>
                                <div class="col-md-14">
                                    <label>
                                        <input type="radio" class="flat-red" name="bpjs_mandiri" id="bpjs_mandiri"  value="no" <?= $dtks->bpjs_mandiri == "no" ? "checked" : ""; ?>>
                                        No
                                    </label>
                                </div>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="jamsostek" class="col-sm-2 control-label">JAMSOSTEK/BPJS KETENAGAKERJAAN 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-6">
                                <div class="col-md-2 padding-left-0">
                                    <label>
                                        <input type="radio" class="flat-red" name="jamsostek" id="jamsostek"  value="yes" <?= $dtks->jamsostek == "yes" ? "checked" : ""; ?>>
                                        Yes
                                    </label>
                                </div>
                                <div class="col-md-14">
                                    <label>
                                        <input type="radio" class="flat-red" name="jamsostek" id="jamsostek"  value="no" <?= $dtks->jamsostek == "no" ? "checked" : ""; ?>>
                                        No
                                    </label>
                                </div>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="asuransi_lainnya" class="col-sm-2 control-label">ASURANSI KESEHATAN LAINNYA 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-6">
                                <div class="col-md-2 padding-left-0">
                                    <label>
                                        <input type="radio" class="flat-red" name="asuransi_lainnya" id="asuransi_lainnya"  value="yes" <?= $dtks->asuransi_lainnya == "yes" ? "checked" : ""; ?>>
                                        Yes
                                    </label>
                                </div>
                                <div class="col-md-14">
                                    <label>
                                        <input type="radio" class="flat-red" name="asuransi_lainnya" id="asuransi_lainnya"  value="no" <?= $dtks->asuransi_lainnya == "no" ? "checked" : ""; ?>>
                                        No
                                    </label>
                                </div>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="status" class="col-sm-2 control-label">Status 
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select" name="status" id="status" data-placeholder="Select Status" >
                                    <option value=""></option>
                                    <option <?= $dtks->status == "Belum Terverifikasi" ? 'selected' :''; ?> value="Belum Terverifikasi">Belum Terverifikasi</option>
                                    <option <?= $dtks->status == "Terverifikasi" ? 'selected' :''; ?> value="Terverifikasi">Terverifikasi</option>
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
              window.location.href = BASE_URL + 'dtks';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
            
        var form_dtks = $('#form_dtks');
        var data_post = form_dtks.serializeArray();
        var save_type = $(this).attr('data-stype');
        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: form_dtks.attr('action'),
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if(res.success) {
            var id = $('#dtks_image_galery').find('li').attr('qq-file-id');
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