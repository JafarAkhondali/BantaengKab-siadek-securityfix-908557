
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
                            <h3 class="widget-user-username"><b>Art Dtks</b></h3>
                            <h5 class="widget-user-desc"><?= cclang('new', ['Art Dtks']); ?></h5>
                            <hr>
                        </div>
                        <?= form_open('', [
                            'name'    => 'form_art_dtks', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_art_dtks', 
                            'enctype' => 'multipart/form-data', 
                            'method'  => 'POST'
                            ]); ?>
                            <div class="col-lg-6">
                                                 
                                                <div class="form-group ">
                            <label for="IDBDT" class="col-sm-4 control-label">IDBDT 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="IDBDT" id="IDBDT" placeholder="IDBDT" value="<?= set_value('IDBDT'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="IDARTBDT" class="col-sm-4 control-label">IDARTBDT 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="IDARTBDT" id="IDARTBDT" placeholder="IDARTBDT" value="<?= set_value('IDARTBDT'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                            
                                                <div class="form-group ">
                            <label for="KDKEC" class="col-sm-4 control-label">KDKEC 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="KDKEC" id="KDKEC" placeholder="KDKEC" value="<?= set_value('KDKEC'); ?>">
                                <small class="info help-block">
                                <b>Input KDKEC</b> Max Length : 11.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="KDDESA" class="col-sm-4 control-label">KDDESA 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="KDDESA" id="KDDESA" placeholder="KDDESA" value="<?= set_value('KDDESA'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="NoPesertaPKH" class="col-sm-4 control-label">NoPesertaPKH 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="NoPesertaPKH" id="NoPesertaPKH" placeholder="NoPesertaPKH" value="<?= set_value('NoPesertaPKH'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="Nama" class="col-sm-4 control-label">Nama 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="Nama" id="Nama" placeholder="Nama" value="<?= set_value('Nama'); ?>">
                                <small class="info help-block">
                                <b>Input Nama</b> Max Length : 11.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="JnsKel" class="col-sm-4 control-label">JnsKel 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select" name="JnsKel[]" id="JnsKel" data-placeholder="Select JnsKel" multiple >
                                    <option value=""></option>
                                    <option value="1">Laki-Laki</option>
                                    <option value="2">Perempuan</option>
                                    </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="TmpLahir" class="col-sm-4 control-label">TmpLahir 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="TmpLahir" id="TmpLahir" placeholder="TmpLahir" value="<?= set_value('TmpLahir'); ?>">
                                <small class="info help-block">
                                <b>Input TmpLahir</b> Max Length : 11.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="TglLahir" class="col-sm-4 control-label">TglLahir 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-6">
                            <div class="input-group date col-sm-8">
                              <input type="text" class="form-control pull-right datepicker" name="TglLahir"  placeholder="TglLahir" id="TglLahir">
                            </div>
                            <small class="info help-block">
                            </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="HubKRT" class="col-sm-4 control-label">HubKRT 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="HubKRT" id="HubKRT" placeholder="HubKRT" value="<?= set_value('HubKRT'); ?>">
                                <small class="info help-block">
                                <b>Input HubKRT</b> Max Length : 11.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="NIK" class="col-sm-4 control-label">NIK 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="NIK" id="NIK" placeholder="NIK" value="<?= set_value('NIK'); ?>">
                                <small class="info help-block">
                                <b>Input NIK</b> Max Length : 11.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="NoKK" class="col-sm-4 control-label">NoKK 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="NoKK" id="NoKK" placeholder="NoKK" value="<?= set_value('NoKK'); ?>">
                                <small class="info help-block">
                                <b>Input NoKK</b> Max Length : 11.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="Hub_KRT" class="col-sm-4 control-label">Hub KRT 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="Hub_KRT" id="Hub_KRT" placeholder="Hub KRT" value="<?= set_value('Hub_KRT'); ?>">
                                <small class="info help-block">
                                <b>Input Hub KRT</b> Max Length : 11.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="NUK" class="col-sm-4 control-label">NUK 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="NUK" id="NUK" placeholder="NUK" value="<?= set_value('NUK'); ?>">
                                <small class="info help-block">
                                <b>Input NUK</b> Max Length : 11.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="Hubkel" class="col-sm-4 control-label">Hubkel 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="Hubkel" id="Hubkel" placeholder="Hubkel" value="<?= set_value('Hubkel'); ?>">
                                <small class="info help-block">
                                <b>Input Hubkel</b> Max Length : 11.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="Umur" class="col-sm-4 control-label">Umur 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="Umur" id="Umur" placeholder="Umur" value="<?= set_value('Umur'); ?>">
                                <small class="info help-block">
                                <b>Input Umur</b> Max Length : 11.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="Sta_kawin" class="col-sm-4 control-label">Sta Kawin 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="Sta_kawin" id="Sta_kawin" placeholder="Sta Kawin" value="<?= set_value('Sta_kawin'); ?>">
                                <small class="info help-block">
                                <b>Input Sta Kawin</b> Max Length : 11.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="Ada_akta_nikah" class="col-sm-4 control-label">Ada Akta Nikah 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="Ada_akta_nikah" id="Ada_akta_nikah" placeholder="Ada Akta Nikah" value="<?= set_value('Ada_akta_nikah'); ?>">
                                <small class="info help-block">
                                <b>Input Ada Akta Nikah</b> Max Length : 11.</small>
                            </div>
                        </div>
                                                 
                                                
                        </div>
                        
                        <div class="col-lg-6">
                            
                            <div class="form-group ">
                            <label for="Ada_diKK" class="col-sm-4 control-label">Ada DiKK 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="Ada_diKK" id="Ada_diKK" placeholder="Ada DiKK" value="<?= set_value('Ada_diKK'); ?>">
                                <small class="info help-block">
                                <b>Input Ada DiKK</b> Max Length : 11.</small>
                            </div>
                        </div>
                          <div class="form-group ">
                            <label for="Ada_kartu_identitas" class="col-sm-4 control-label">Ada Kartu Identitas 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="Ada_kartu_identitas" id="Ada_kartu_identitas" placeholder="Ada Kartu Identitas" value="<?= set_value('Ada_kartu_identitas'); ?>">
                                <small class="info help-block">
                                <b>Input Ada Kartu Identitas</b> Max Length : 11.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="Sta_hamil" class="col-sm-4 control-label">Sta Hamil 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="Sta_hamil" id="Sta_hamil" placeholder="Sta Hamil" value="<?= set_value('Sta_hamil'); ?>">
                                <small class="info help-block">
                                <b>Input Sta Hamil</b> Max Length : 11.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="Jenis_cacat" class="col-sm-4 control-label">Jenis Cacat 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="Jenis_cacat" id="Jenis_cacat" placeholder="Jenis Cacat" value="<?= set_value('Jenis_cacat'); ?>">
                                <small class="info help-block">
                                <b>Input Jenis Cacat</b> Max Length : 11.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="Penyakit_kronis" class="col-sm-4 control-label">Penyakit Kronis 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="Penyakit_kronis" id="Penyakit_kronis" placeholder="Penyakit Kronis" value="<?= set_value('Penyakit_kronis'); ?>">
                                <small class="info help-block">
                                <b>Input Penyakit Kronis</b> Max Length : 11.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="Partisipasi_sekolah" class="col-sm-4 control-label">Partisipasi Sekolah 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="Partisipasi_sekolah" id="Partisipasi_sekolah" placeholder="Partisipasi Sekolah" value="<?= set_value('Partisipasi_sekolah'); ?>">
                                <small class="info help-block">
                                <b>Input Partisipasi Sekolah</b> Max Length : 11.</small>
                            </div>
                        </div>
                              <div class="form-group ">
                            <label for="Pendidikan_tertinggi" class="col-sm-4 control-label">Pendidikan Tertinggi 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="Pendidikan_tertinggi" id="Pendidikan_tertinggi" placeholder="Pendidikan Tertinggi" value="<?= set_value('Pendidikan_tertinggi'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="Kelas_tertinggi" class="col-sm-4 control-label">Kelas Tertinggi 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="Kelas_tertinggi" id="Kelas_tertinggi" placeholder="Kelas Tertinggi" value="<?= set_value('Kelas_tertinggi'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="Ijazah_tertinggi" class="col-sm-4 control-label">Ijazah Tertinggi 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="Ijazah_tertinggi" id="Ijazah_tertinggi" placeholder="Ijazah Tertinggi" value="<?= set_value('Ijazah_tertinggi'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="Sta_Bekerja" class="col-sm-4 control-label">Sta Bekerja 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="Sta_Bekerja" id="Sta_Bekerja" placeholder="Sta Bekerja" value="<?= set_value('Sta_Bekerja'); ?>">
                                <small class="info help-block">
                                <b>Input Sta Bekerja</b> Max Length : 11.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="Jumlah_jamkerja" class="col-sm-4 control-label">Jumlah Jamkerja 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="Jumlah_jamkerja" id="Jumlah_jamkerja" placeholder="Jumlah Jamkerja" value="<?= set_value('Jumlah_jamkerja'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="Lapangan_usaha" class="col-sm-4 control-label">Lapangan Usaha 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="Lapangan_usaha" id="Lapangan_usaha" placeholder="Lapangan Usaha" value="<?= set_value('Lapangan_usaha'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="Status_pekerjaan" class="col-sm-4 control-label">Status Pekerjaan 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="Status_pekerjaan" id="Status_pekerjaan" placeholder="Status Pekerjaan" value="<?= set_value('Status_pekerjaan'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="Sta_keberadaan_art" class="col-sm-4 control-label">Sta Keberadaan Art 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="Sta_keberadaan_art" id="Sta_keberadaan_art" placeholder="Sta Keberadaan Art" value="<?= set_value('Sta_keberadaan_art'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="Sta_kepesertaan_pbi" class="col-sm-4 control-label">Sta Kepesertaan Pbi 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="Sta_kepesertaan_pbi" id="Sta_kepesertaan_pbi" placeholder="Sta Kepesertaan Pbi" value="<?= set_value('Sta_kepesertaan_pbi'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="Ada_kks" class="col-sm-4 control-label">Ada Kks 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="Ada_kks" id="Ada_kks" placeholder="Ada Kks" value="<?= set_value('Ada_kks'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="Ada_pbi" class="col-sm-4 control-label">Ada Pbi 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="Ada_pbi" id="Ada_pbi" placeholder="Ada Pbi" value="<?= set_value('Ada_pbi'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="Ada_kip" class="col-sm-4 control-label">Ada Kip 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="Ada_kip" id="Ada_kip" placeholder="Ada Kip" value="<?= set_value('Ada_kip'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="Ada_pkh" class="col-sm-4 control-label">Ada Pkh 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="Ada_pkh" id="Ada_pkh" placeholder="Ada Pkh" value="<?= set_value('Ada_pkh'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="Ada_BPNT" class="col-sm-4 control-label">Ada BPNT 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="Ada_BPNT" id="Ada_BPNT" placeholder="Ada BPNT" value="<?= set_value('Ada_BPNT'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="Anak_diluar_rt" class="col-sm-4 control-label">Anak Diluar Rt 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="Anak_diluar_rt" id="Anak_diluar_rt" placeholder="Anak Diluar Rt" value="<?= set_value('Anak_diluar_rt'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="namagadis_ibukandung" class="col-sm-4 control-label">Namagadis Ibukandung 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="namagadis_ibukandung" id="namagadis_ibukandung" placeholder="Namagadis Ibukandung" value="<?= set_value('namagadis_ibukandung'); ?>">
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
              window.location.href = BASE_URL + 'art_dtks';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
            
        var form_art_dtks = $('#form_art_dtks');
        var data_post = form_art_dtks.serializeArray();
        var save_type = $(this).attr('data-stype');

        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: BASE_URL + '/art_dtks/add_save',
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