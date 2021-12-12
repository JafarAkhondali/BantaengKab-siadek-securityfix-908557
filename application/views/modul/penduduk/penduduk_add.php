
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
                            'name'    => 'form_penduduk', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_penduduk', 
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
                            <label for="nik" class="col-sm-2 control-label">NIK 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="nik" id="nik" placeholder="Nik" value="<?= set_value('nik'); ?>">
                                <small class="info help-block">
                                <b>Input Nik</b> .</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="nama" class="col-sm-2 control-label">Nama 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?= set_value('nama'); ?>">
                                <small class="info help-block">
                                <b>Input Nama</b> .</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="tempat_lahir" class="col-sm-2 control-label">Tempat/Tanggal Lahir 
                            <i class="required">*</i>
                            </label>
                            <div class="row">
                            <div class="col-sm-2">
                                <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" placeholder="Tempat Lahir" value="<?= set_value('tempat_lahir'); ?>"> 
                                <small class="info help-block">
                                <b>Input Tempat Lahir</b></small>
                            </div>
                            <div class="col-sm-2">
                            <div class="input-group date">
                              <input type="text" class="form-control pull-right datepicker" name="tgl_lahir"  id="tgl_lahir">
                            </div>
                            <small class="info help-block">
                                <b>Input Tanggal Lahir</b></small>
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
                                    <option value="laki-laki">Laki - Laki</option>
                                    <option value="perempuan">Perempuan</option>
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
                                <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat" value="<?= set_value('alamat'); ?>">
                                <small class="info help-block">
                                <b>Input Alamat</b></small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="status_hubungan" class="col-sm-2 control-label">Status Hubungan 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-2">
                                 <select  class="form-control chosen chosen-select" name="status_hubungan" id="status_hubungan" data-placeholder="Select Hubungan Keluarga" >
                                    <option value=""></option>
                                   <option value="1">KEPALA KELUARGA</option>
                                            <option value="2">SUAMI</option>
                                            <option value="3">ISTRI</option>
                                            <option value="4">ANAK</option>
                                            <option value="5">ORANG TUA</option>
                                            <option value="6">MERTUA</option>
                                            <option value="7">MENANTU</option>
                                            <option value="8">CUCU</option>
                                            <option value="9">PEMBANTU</option>
                                            <option value="10">FAMILI LAIN</option>
                                            <option value="11">LAINNYA</option>
                                    </select>
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
                                    <option value="1">Islam</option>
                                    <option value="2">Kristen Protestan</option>
                                    <option value="3">Kristen Katolik</option>
                                    <option value="4">Hindu</option>
                                    <option value="5">Buddha</option>
                                    <option value="6">Kong Hu Cu</option>
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
                                    <option value="1">Menikah</option>
                                    <option value="2">Belum Menikah</option>
                                    <option value="3">Cerai Hidup</option>
                                    <option value="4">Cerai Mati</option>
                                    </select>
                                <small class="info help-block">
                                <b>Input Status Perkawinan</b> </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="kepemilikan_akte_perkawinan" class="col-sm-2 control-label">Kepemilikan Akte Perkawinan 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="kepemilikan_akte_perkawinan" id="kepemilikan_akte_perkawinan" placeholder="Kepemilikan Akte Perkawinan" value="<?= set_value('kepemilikan_akte_perkawinan'); ?>">
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
                                    <option value="SD/Sederajat">SD/Sederajat</option>
                                    <option value="SMP/Sederajat">SMP/Sederajat</option>
                                    <option value="SMA/Sederajat">SMA/Sederajat</option>
                                    <option value="D1/D2/D3">D1/D2/D3</option>
                                    <option value="D4/S1">D4/S1</option>
                                    <option value="S2">S2</option>
                                    <option value="S3">S3</option>
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
                                <select  class="form-control chosen chosen-select" name="jenis_pekerjaan" id="jenis_pekerjaan" data-placeholder="Select Jenis Pekerjaan" >
                                    <option value=""></option>
                                           <option value="1">ANGGOTA BPK</option>
                                            <option value="2">ANGGOTA DPR RI</option>
                                            <option value="3">ANGGOTA DPRD KAB./KOTA</option>
                                            <option value="4">ANGGOTA DPRD PROP.</option>
                                            <option value="5">APOTEKER</option>
                                            <option value="6">BELUM/TIDAK BEKERJA</option>
                                            <option value="7">BIARAWAN/BIARAWATI</option>
                                            <option value="8">BIDAN</option>
                                            <option value="9">BUPATI</option>
                                            <option value="10">BURUH HARIAN LEPAS</option>
                                            <option value="11">BURUH NELAYAN/PERIKANAN</option>
                                            <option value="12">BURUH PETERNAKAN</option>
                                            <option value="13">ANGGOTA DPRD KAB./KOTA</option>
                                            <option value="14">BURUH TANI/PERKEBUNAN</option>
                                            <option value="15">DOKTER</option>
                                            <option value="16">DOSEN</option>
                                            <option value="17">GURU</option>
                                            <option value="18">IMAM MASJID</option>
                                            <option value="19">INDUSTRI</option>
                                            <option value="20">KARYAWAN BUMD</option>
                                            <option value="21">KARYAWAN BUMN</option>
                                            <option value="22">KARYAWAN HONORER</option>
                                            <option value="23">KARYAWAN SWASTA</option>
                                            <option value="24">KEPALA DESA</option>
                                            <option value="25">KEPOLISIAN RI (POLRI)</option>
                                            <option value="26">KONSTRUKSI</option>
                                            <option value="27">KONSULTAN</option>
                                            <option value="28">MEKANIK</option>
                                            <option value="29">BUPATI</option>
                                            <option value="30">MENGURUS RUMAH TANGGA</option>
                                            <option value="31">NELAYAN/PERIKANAN</option>
                                            <option value="32">NOTARIS</option>
                                            <option value="33">PARAJI</option>
                                            <option value="34">PASTOR</option>
                                            <option value="35">PEDAGANG</option>
                                            <option value="36">PEGAWAI NEGERI SIPIL (PNS)</option>
                                            <option value="37">PEKERJAAN LAINNYA</option>
                                            <option value="38">PELAJAR/MAHASISWA</option>
                                            <option value="39">PELAUT</option>
                                            <option value="40">PENATA RIAS</option>
                                            <option value="41">PENDETA</option>
                                            <option value="42">PENELITI</option>
                                            <option value="43">PENGACARA</option>
                                            <option value="44">PENSIUNAN</option>
                                            <option value="45">PENTERJAMAH</option>
                                            <option value="46">PENYIAR RADIO</option>
                                            <option value="47">PERANGKAT DESA</option>
                                            <option value="48">PERAWAT</option>
                                            <option value="49">PERDAGANGAN</option>
                                            <option value="50">PETANI/PEKEBUN</option>
                                            <option value="51">PETERNAK</option>
                                            <option value="52">SECURITY/SATPAM</option>
                                            <option value="53">SENIMAN</option>
                                            <option value="54">SOPIR</option>
                                            <option value="55">TENTARA NASIONAL INDONESIA (TNI)</option>
                                            <option value="56">TRANSPORTASI</option>
                                            <option value="57">TUKANG BATU</option>
                                            <option value="58">TUKANG BECAK</option>
                                            <option value="59">TUKANG CUKUR</option>
                                            <option value="60">TUKANG GIGI</option>
                                            <option value="61">TUKANG JAHIT</option>
                                            <option value="62">TUKANG KAYU</option>
                                            <option value="63">TUKANG LAS/PANDAI BESI</option>
                                            <option value="64">TUKANG LISTRIK</option>
                                            <option value="65">TUKANG SOL SEPATU</option>
                                            <option value="66">USTADZ/MUBALIGH</option>
                                            <option value="67">WAKIL BUPATI</option>
                                            <option value="68">WARTAWAN</option>
                                            <option value="69">WIRASWASTA</option>
                                    </select>
                                <small class="info help-block">
                                <b>Input Jenis Pekerjaan</b> </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="bidang_pekerjaan" class="col-sm-2 control-label">Bidang Pekerjaan 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="bidang_pekerjaan" id="bidang_pekerjaan" placeholder="Bidang Pekerjaan" value="<?= set_value('bidang_pekerjaan'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="no_kk" class="col-sm-2 control-label">No Kk 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="no_kk" id="no_kk" placeholder="No Kk" value="<?= set_value('no_kk'); ?>">
                                
                                <small class="info help-block">
                                <b>Input No Kk</b> </small>
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

  <script type="text/javascript">

        $(document).ready(function(){
             $('#nik').on('input',function(){
                var nik = $('#nik').val();
                
    $.ajax({
     url:BASE_URL + 'api_siadek/api/penduduk_dwh/valid',
     method: 'post',
     data: {nik: nik},
     dataType: 'json',
     headers: {
    "APIKEY": "siadekv2",
  },
     success: function(response){
       
       
         // Read values
        var nama = response.message.nama;
        $('#nama').val(nama);
         
         
        var alamat = response.message.alamat;
        $('#alamat').val(alamat);
        
         var jenis_kelamin = response.message.jenis_kelamin;
        $('#jenis_kelamin').val(jenis_kelamin);
        $('#jenis_kelamin').trigger("chosen:updated");
        
          var status_hubungan = response.message.status_hubungan;
        $('#status_hubungan').val(status_hubungan);
        $('#status_hubungan').trigger("chosen:updated");
        
        var status_perkawinan = response.message.status_perkawinan;
        $('#status_perkawinan').val(status_perkawinan);
        $('#status_perkawinan').trigger("chosen:updated");
          

     }
   });
                return false;
           });
 
        });
</script>

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
          url: BASE_URL + '/penduduk/add_save',
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