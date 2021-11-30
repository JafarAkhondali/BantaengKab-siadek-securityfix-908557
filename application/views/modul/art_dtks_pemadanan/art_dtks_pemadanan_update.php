
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
                            <h3 class="widget-user-username"><b>Art Dtks Pemadanan</b></h3>
                            <h5 class="widget-user-desc">Edit Art Dtks Pemadanan</h5>
                            <hr>
                        </div>
                        <?= form_open(base_url('art_dtks_pemadanan/edit_save/'.$this->uri->segment(3)), [
                            'name'    => 'form_art_dtks_pemadanan', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_art_dtks_pemadanan', 
                            'method'  => 'POST'
                            ]); ?>
                         
                                                <div class="form-group ">
                            <label for="kd_wilayah" class="col-sm-2 control-label">Kd Wilayah 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="kd_wilayah" id="kd_wilayah" data-placeholder="Select Kd Wilayah" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('wilayah') as $row): ?>
                                    <option <?=  $row->kd_wilayah ==  $art_dtks_pemadanan->kd_wilayah ? 'selected' : ''; ?> value="<?= $row->kd_wilayah ?>"><?= $row->nama; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                                                 
                                                <div class="form-group ">
                            <label for="IDBDT" class="col-sm-2 control-label">IDBDT 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="IDBDT" id="IDBDT" placeholder="IDBDT" value="<?= set_value('IDBDT', $art_dtks_pemadanan->IDBDT); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="IDARTBDT" class="col-sm-2 control-label">IDARTBDT 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="IDARTBDT" id="IDARTBDT" placeholder="IDARTBDT" value="<?= set_value('IDARTBDT', $art_dtks_pemadanan->IDARTBDT); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="KDPROP" class="col-sm-2 control-label">KDPROP 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="KDPROP" id="KDPROP" data-placeholder="Select KDPROP" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('wilayah') as $row): ?>
                                    <option <?=  $row->kd_wilayah ==  $art_dtks_pemadanan->KDPROP ? 'selected' : ''; ?> value="<?= $row->kd_wilayah ?>"><?= $row->nama; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                                                 
                                                <div class="form-group ">
                            <label for="KDKAB" class="col-sm-2 control-label">KDKAB 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="KDKAB" id="KDKAB" data-placeholder="Select KDKAB" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('wilayah') as $row): ?>
                                    <option <?=  $row->kd_wilayah ==  $art_dtks_pemadanan->KDKAB ? 'selected' : ''; ?> value="<?= $row->kd_wilayah ?>"><?= $row->nama; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                                                 
                                                <div class="form-group ">
                            <label for="KDKEC" class="col-sm-2 control-label">KDKEC 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="KDKEC" id="KDKEC" data-placeholder="Select KDKEC" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('wilayah') as $row): ?>
                                    <option <?=  $row->kd_wilayah ==  $art_dtks_pemadanan->KDKEC ? 'selected' : ''; ?> value="<?= $row->kd_wilayah ?>"><?= $row->nama; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                                                 
                                                <div class="form-group ">
                            <label for="KDDESA" class="col-sm-2 control-label">KDDESA 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="KDDESA" id="KDDESA" data-placeholder="Select KDDESA" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('wilayah') as $row): ?>
                                    <option <?=  $row->kd_wilayah ==  $art_dtks_pemadanan->KDDESA ? 'selected' : ''; ?> value="<?= $row->kd_wilayah ?>"><?= $row->nama; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                                                 
                                                <div class="form-group ">
                            <label for="NoPesertaPKH" class="col-sm-2 control-label">NoPesertaPKH 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="NoPesertaPKH" id="NoPesertaPKH" placeholder="NoPesertaPKH" value="<?= set_value('NoPesertaPKH', $art_dtks_pemadanan->NoPesertaPKH); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="Nama" class="col-sm-2 control-label">Nama 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="Nama" id="Nama" placeholder="Nama" value="<?= set_value('Nama', $art_dtks_pemadanan->Nama); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="JnsKel" class="col-sm-2 control-label">JnsKel 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select" name="JnsKel" id="JnsKel" data-placeholder="Select JnsKel" >
                                    <option value=""></option>
                                    <option <?= $art_dtks_pemadanan->JnsKel == "1" ? 'selected' :''; ?> value="1">Laki-Laki</option>
                                    <option <?= $art_dtks_pemadanan->JnsKel == "2" ? 'selected' :''; ?> value="2">Perempuan</option>
                                    </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="TmpLahir" class="col-sm-2 control-label">TmpLahir 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="TmpLahir" id="TmpLahir" placeholder="TmpLahir" value="<?= set_value('TmpLahir', $art_dtks_pemadanan->TmpLahir); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="TglLahir" class="col-sm-2 control-label">TglLahir 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-6">
                            <div class="input-group date col-sm-8">
                              <input type="text" class="form-control pull-right datepicker" name="TglLahir"  placeholder="TglLahir" id="TglLahir" value="<?= set_value('art_dtks_pemadanan_TglLahir_name', $art_dtks_pemadanan->TglLahir); ?>">
                            </div>
                            <small class="info help-block">
                            </small>
                            </div>
                        </div>
                       
                                                 
                                                <div class="form-group ">
                            <label for="HubKRT" class="col-sm-2 control-label">HubKRT 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select" name="HubKRT" id="HubKRT" data-placeholder="Select HubKRT" >
                                    <option value=""></option>
                                    <option <?= $art_dtks_pemadanan->HubKRT == "1" ? 'selected' :''; ?> value="1">Yes</option>
                                    <option <?= $art_dtks_pemadanan->HubKRT == "2" ? 'selected' :''; ?> value="2">No</option>
                                    </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="NIK" class="col-sm-2 control-label">NIK 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="NIK" id="NIK" placeholder="NIK" value="<?= set_value('NIK', $art_dtks_pemadanan->NIK); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="NoKK" class="col-sm-2 control-label">NoKK 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="NoKK" id="NoKK" placeholder="NoKK" value="<?= set_value('NoKK', $art_dtks_pemadanan->NoKK); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group  wrapper-options-crud">
                            <label for="Hub_KRT" class="col-sm-2 control-label">Hub KRT 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                    <div class="col-md-3 padding-left-0">
                                    <label>
                                    <input <?= $art_dtks_pemadanan->Hub_KRT == "1" ? "checked" : ""; ?> type="radio" class="flat-red" name="Hub_KRT" value="1"> Yes                                    </label>
                                    </div>
                                    <div class="col-md-3 padding-left-0">
                                    <label>
                                    <input <?= $art_dtks_pemadanan->Hub_KRT == "2" ? "checked" : ""; ?> type="radio" class="flat-red" name="Hub_KRT" value="2"> No                                    </label>
                                    </div>
                                    </select>
                                <div class="row-fluid clear-both">
                                <small class="info help-block">
                                </small>
                                </div>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="NUK" class="col-sm-2 control-label">NUK 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="NUK" id="NUK" placeholder="NUK" value="<?= set_value('NUK', $art_dtks_pemadanan->NUK); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="Hubkel" class="col-sm-2 control-label">Hubkel 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="Hubkel" id="Hubkel" placeholder="Hubkel" value="<?= set_value('Hubkel', $art_dtks_pemadanan->Hubkel); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="Umur" class="col-sm-2 control-label">Umur 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="Umur" id="Umur" placeholder="Umur" value="<?= set_value('Umur', $art_dtks_pemadanan->Umur); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="Sta_kawin" class="col-sm-2 control-label">Sta Kawin 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="Sta_kawin" id="Sta_kawin" placeholder="Sta Kawin" value="<?= set_value('Sta_kawin', $art_dtks_pemadanan->Sta_kawin); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="Ada_akta_nikah" class="col-sm-2 control-label">Ada Akta Nikah 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="Ada_akta_nikah" id="Ada_akta_nikah" placeholder="Ada Akta Nikah" value="<?= set_value('Ada_akta_nikah', $art_dtks_pemadanan->Ada_akta_nikah); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="Ada_diKK" class="col-sm-2 control-label">Ada DiKK 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="Ada_diKK" id="Ada_diKK" placeholder="Ada DiKK" value="<?= set_value('Ada_diKK', $art_dtks_pemadanan->Ada_diKK); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group  wrapper-options-crud">
                            <label for="Ada_kartu_identitas" class="col-sm-2 control-label">Ada Kartu Identitas 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                    <div class="col-md-3 padding-left-0">
                                    <label>
                                    <input <?= $art_dtks_pemadanan->Ada_kartu_identitas == "1" ? "checked" : ""; ?> type="radio" class="flat-red" name="Ada_kartu_identitas" value="1"> Yes                                    </label>
                                    </div>
                                    <div class="col-md-3 padding-left-0">
                                    <label>
                                    <input <?= $art_dtks_pemadanan->Ada_kartu_identitas == "2" ? "checked" : ""; ?> type="radio" class="flat-red" name="Ada_kartu_identitas" value="2"> No                                    </label>
                                    </div>
                                    </select>
                                <div class="row-fluid clear-both">
                                <small class="info help-block">
                                </small>
                                </div>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="Sta_hamil" class="col-sm-2 control-label">Sta Hamil 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="Sta_hamil" id="Sta_hamil" placeholder="Sta Hamil" value="<?= set_value('Sta_hamil', $art_dtks_pemadanan->Sta_hamil); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="Jenis_cacat" class="col-sm-2 control-label">Jenis Cacat 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="Jenis_cacat" id="Jenis_cacat" data-placeholder="Select Jenis Cacat" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('setup_cacat') as $row): ?>
                                    <option <?=  $row->value ==  $art_dtks_pemadanan->Jenis_cacat ? 'selected' : ''; ?> value="<?= $row->value ?>"><?= $row->nama; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                                                 
                                                <div class="form-group ">
                            <label for="Penyakit_kronis" class="col-sm-2 control-label">Penyakit Kronis 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="Penyakit_kronis" id="Penyakit_kronis" data-placeholder="Select Penyakit Kronis" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('setup_penyakit') as $row): ?>
                                    <option <?=  $row->value ==  $art_dtks_pemadanan->Penyakit_kronis ? 'selected' : ''; ?> value="<?= $row->value ?>"><?= $row->nama; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                                                 
                                                <div class="form-group ">
                            <label for="Partisipasi_sekolah" class="col-sm-2 control-label">Partisipasi Sekolah 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="Partisipasi_sekolah" id="Partisipasi_sekolah" placeholder="Partisipasi Sekolah" value="<?= set_value('Partisipasi_sekolah', $art_dtks_pemadanan->Partisipasi_sekolah); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="Pendidikan_tertinggi" class="col-sm-2 control-label">Pendidikan Tertinggi 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="Pendidikan_tertinggi" id="Pendidikan_tertinggi" placeholder="Pendidikan Tertinggi" value="<?= set_value('Pendidikan_tertinggi', $art_dtks_pemadanan->Pendidikan_tertinggi); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="Kelas_tertinggi" class="col-sm-2 control-label">Kelas Tertinggi 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="Kelas_tertinggi" id="Kelas_tertinggi" placeholder="Kelas Tertinggi" value="<?= set_value('Kelas_tertinggi', $art_dtks_pemadanan->Kelas_tertinggi); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="Ijazah_tertinggi" class="col-sm-2 control-label">Ijazah Tertinggi 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select" name="Ijazah_tertinggi" id="Ijazah_tertinggi" data-placeholder="Select Ijazah Tertinggi" >
                                    <option value=""></option>
                                    <option <?= $art_dtks_pemadanan->Ijazah_tertinggi == "1" ? 'selected' :''; ?> value="1">SD</option>
                                    <option <?= $art_dtks_pemadanan->Ijazah_tertinggi == "2" ? 'selected' :''; ?> value="2">SLTP</option>
                                    <option <?= $art_dtks_pemadanan->Ijazah_tertinggi == "3" ? 'selected' :''; ?> value="3">SLTA</option>
                                    <option <?= $art_dtks_pemadanan->Ijazah_tertinggi == "4" ? 'selected' :''; ?> value="4">D1</option>
                                    <option <?= $art_dtks_pemadanan->Ijazah_tertinggi == "4" ? 'selected' :''; ?> value="4">D2</option>
                                    <option <?= $art_dtks_pemadanan->Ijazah_tertinggi == "4" ? 'selected' :''; ?> value="4">D3</option>
                                    <option <?= $art_dtks_pemadanan->Ijazah_tertinggi == "5" ? 'selected' :''; ?> value="5">S1</option>
                                    <option <?= $art_dtks_pemadanan->Ijazah_tertinggi == "6" ? 'selected' :''; ?> value="6">S2</option>
                                    <option <?= $art_dtks_pemadanan->Ijazah_tertinggi == "7" ? 'selected' :''; ?> value="7">S3</option>
                                    </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="Sta_Bekerja" class="col-sm-2 control-label">Sta Bekerja 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="Sta_Bekerja" id="Sta_Bekerja" placeholder="Sta Bekerja" value="<?= set_value('Sta_Bekerja', $art_dtks_pemadanan->Sta_Bekerja); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="Jumlah_jamkerja" class="col-sm-2 control-label">Jumlah Jamkerja 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="Jumlah_jamkerja" id="Jumlah_jamkerja" placeholder="Jumlah Jamkerja" value="<?= set_value('Jumlah_jamkerja', $art_dtks_pemadanan->Jumlah_jamkerja); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="Lapangan_usaha" class="col-sm-2 control-label">Lapangan Usaha 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="Lapangan_usaha" id="Lapangan_usaha" placeholder="Lapangan Usaha" value="<?= set_value('Lapangan_usaha', $art_dtks_pemadanan->Lapangan_usaha); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="Status_pekerjaan" class="col-sm-2 control-label">Status Pekerjaan 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="Status_pekerjaan" id="Status_pekerjaan" data-placeholder="Select Status Pekerjaan" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('setup_pekerjaan') as $row): ?>
                                    <option <?=  $row->value ==  $art_dtks_pemadanan->Status_pekerjaan ? 'selected' : ''; ?> value="<?= $row->value ?>"><?= $row->nama; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                                                 
                                                <div class="form-group ">
                            <label for="Sta_keberadaan_art" class="col-sm-2 control-label">Sta Keberadaan Art 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select" name="Sta_keberadaan_art" id="Sta_keberadaan_art" data-placeholder="Select Sta Keberadaan Art" >
                                    <option value=""></option>
                                    <option <?= $art_dtks_pemadanan->Sta_keberadaan_art == "1" ? 'selected' :''; ?> value="1">Yes</option>
                                    <option <?= $art_dtks_pemadanan->Sta_keberadaan_art == "2" ? 'selected' :''; ?> value="2">No</option>
                                    </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="Sta_kepesertaan_pbi" class="col-sm-2 control-label">Sta Kepesertaan Pbi 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select" name="Sta_kepesertaan_pbi" id="Sta_kepesertaan_pbi" data-placeholder="Select Sta Kepesertaan Pbi" >
                                    <option value=""></option>
                                    <option <?= $art_dtks_pemadanan->Sta_kepesertaan_pbi == "1" ? 'selected' :''; ?> value="1">Yes</option>
                                    <option <?= $art_dtks_pemadanan->Sta_kepesertaan_pbi == "2" ? 'selected' :''; ?> value="2">No</option>
                                    </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="Ada_kks" class="col-sm-2 control-label">Ada Kks 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select" name="Ada_kks" id="Ada_kks" data-placeholder="Select Ada Kks" >
                                    <option value=""></option>
                                    <option <?= $art_dtks_pemadanan->Ada_kks == "1" ? 'selected' :''; ?> value="1">Yes</option>
                                    <option <?= $art_dtks_pemadanan->Ada_kks == "2" ? 'selected' :''; ?> value="2">No</option>
                                    </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="Ada_pbi" class="col-sm-2 control-label">Ada Pbi 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select" name="Ada_pbi" id="Ada_pbi" data-placeholder="Select Ada Pbi" >
                                    <option value=""></option>
                                    <option <?= $art_dtks_pemadanan->Ada_pbi == "1" ? 'selected' :''; ?> value="1">Yes</option>
                                    <option <?= $art_dtks_pemadanan->Ada_pbi == "2" ? 'selected' :''; ?> value="2">No</option>
                                    </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="Ada_kip" class="col-sm-2 control-label">Ada Kip 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select" name="Ada_kip" id="Ada_kip" data-placeholder="Select Ada Kip" >
                                    <option value=""></option>
                                    <option <?= $art_dtks_pemadanan->Ada_kip == "1" ? 'selected' :''; ?> value="1">Yes</option>
                                    <option <?= $art_dtks_pemadanan->Ada_kip == "2" ? 'selected' :''; ?> value="2">No</option>
                                    </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="Ada_pkh" class="col-sm-2 control-label">Ada Pkh 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select" name="Ada_pkh" id="Ada_pkh" data-placeholder="Select Ada Pkh" >
                                    <option value=""></option>
                                    <option <?= $art_dtks_pemadanan->Ada_pkh == "1" ? 'selected' :''; ?> value="1">Yes</option>
                                    <option <?= $art_dtks_pemadanan->Ada_pkh == "2" ? 'selected' :''; ?> value="2">No</option>
                                    </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="Ada_BPNT" class="col-sm-2 control-label">Ada BPNT 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select" name="Ada_BPNT" id="Ada_BPNT" data-placeholder="Select Ada BPNT" >
                                    <option value=""></option>
                                    <option <?= $art_dtks_pemadanan->Ada_BPNT == "1" ? 'selected' :''; ?> value="1">Yes</option>
                                    <option <?= $art_dtks_pemadanan->Ada_BPNT == "2" ? 'selected' :''; ?> value="2">No</option>
                                    </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="Anak_diluar_rt" class="col-sm-2 control-label">Anak Diluar Rt 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="Anak_diluar_rt" id="Anak_diluar_rt" placeholder="Anak Diluar Rt" value="<?= set_value('Anak_diluar_rt', $art_dtks_pemadanan->Anak_diluar_rt); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="namagadis_ibukandung" class="col-sm-2 control-label">Namagadis Ibukandung 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="namagadis_ibukandung" id="namagadis_ibukandung" placeholder="Namagadis Ibukandung" value="<?= set_value('namagadis_ibukandung', $art_dtks_pemadanan->namagadis_ibukandung); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="Status" class="col-sm-2 control-label">Status 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select" name="Status[]" id="Status" data-placeholder="Select Status" multiple >
                                    <option value=""></option>
                                    <option <?= in_array('1', explode(',', $art_dtks_pemadanan->Status)) ? 'selected' : ''; ?> value="1">Sesuai</option>
                                    <option <?= in_array('2', explode(',', $art_dtks_pemadanan->Status)) ? 'selected' : ''; ?> value="2">NIK Tidak Sesuai</option>
                                    <option <?= in_array('3', explode(',', $art_dtks_pemadanan->Status)) ? 'selected' : ''; ?>  value="3">Sudah Meninggal</option>
                                    <option <?= in_array('4', explode(',', $art_dtks_pemadanan->Status)) ? 'selected' : ''; ?>  value="4">Wilayah Tidak Sesuai</option>
                                    </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="periode" class="col-sm-2 control-label">Periode 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-2">
                                <select  class="form-control chosen chosen-select-deselect" name="periode" id="periode" data-placeholder="Select Periode" >
                                    <option value=""></option>
                                    <?php for ($i = 1970; $i < date('Y')+100; $i++){ ?>
                                    <option <?=  $i ==  $art_dtks_pemadanan->periode ? 'selected' : ''; ?> value="<?= $i; ?>"><?= $i; ?></option>
                                    <?php }; ?>  
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
              window.location.href = BASE_URL + 'art_dtks_pemadanan';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
            
        var form_art_dtks_pemadanan = $('#form_art_dtks_pemadanan');
        var data_post = form_art_dtks_pemadanan.serializeArray();
        var save_type = $(this).attr('data-stype');
        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: form_art_dtks_pemadanan.attr('action'),
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if(res.success) {
            var id = $('#art_dtks_pemadanan_image_galery').find('li').attr('qq-file-id');
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