
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
                        <?= form_open(base_url('tbl_aspirasi/edit_save/'.$this->uri->segment(3)), [
                            'name'    => 'form_tbl_aspirasi', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_tbl_aspirasi', 
                            'method'  => 'POST'
                            ]); ?>
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header ">
                            <div class="widget-user-image">
                                <img class="img-circle" src="<?= BASE_ASSET; ?>/img/add2.png" alt="User Avatar">
                            </div>
                            <!-- /.widget-user-image -->
                            <h3 class="widget-user-username"><b><?php if($tbl_aspirasi->tipe == 1){echo"Aduan";}else{echo"Aspirasi";} ?></b></h3>
                            <h5 class="widget-user-desc">Proses <?php if($tbl_aspirasi->tipe == 1){echo"Aduan";}else{echo"Aspirasi";} ?></h5>
                            <hr>
                        </div>
                        
                            
                            <div class="col-lg-6">
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

                    <option <?php if ($row->kd_wilayah == $tbl_aspirasi->kd_wilayah) { ?>selected="selected" <?php } ?> value="<?= $row->kd_wilayah ?>"><?= '[ ' . $row->kd_wilayah . ' ] ' . $row->nama ?></option>
                  <?php endforeach; ?>
                </select>
                <small class="info help-block">
                </small>
              </div>
            </div>
            <?php
            $nik = $tbl_aspirasi->nik;
            $datapelapor = db_get_all_data('penduduk_real',"nik = $nik"); 
            foreach($datapelapor as $dat){
                $nama = $dat->nama;
                $jenis = $dat->jenis_kelamin;
                $alamat = $dat->alamat;
            }
            
            ?>
                                               <div class="form-group ">
              <label for="nik" class="col-sm-2 control-label">NIK
                
              </label>
              <div class="col-sm-8">
                
                  <input disabled type="text" class="form-control" name="nik" id="nik" placeholder="NIK" value="<?= set_value('nik', $tbl_aspirasi->nik); ?>">
                <small class="info help-block">
                </small>
              </div>
            </div>
            
            <div class="form-group ">
              <label for="nama" class="col-sm-2 control-label">Nama
                
              </label>
              <div class="col-sm-8">
                
                  <input disabled type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?php echo $nama; ?>">
                <small class="info help-block">
                </small>
              </div>
            </div>
            
            <div class="form-group ">
              <label for="jenis_kelamin" class="col-sm-2 control-label">Jenis Kelamin
                
              </label>
              <div class="col-sm-8">
                
                  <input disabled type="text" class="form-control" name="jenis_kelamin" id="jenis_kelamin" placeholder="jenis_kelamin" value="<?php echo $jenis; ?>">
                <small class="info help-block">
                </small>
              </div>
            </div>
            
            <div class="form-group ">
              <label for="Alamat" class="col-sm-2 control-label">Alamat
                
              </label>
              <div class="col-sm-8">
                
                  <input disabled type="text" class="form-control" name="Alamat" id="Alamat" placeholder="Alamat" value="<?php echo $alamat; ?>">
                <small class="info help-block">
                </small>
              </div>
            </div>
            
             <div class="form-group ">
                            <label for="aduan" class="col-sm-2 control-label">Keterangan 
                            
                            </label>
                            <div class="col-sm-8">
                                <textarea id="aduan" name="aduan" rows="10" cols="50"> <?= set_value('aduan', $tbl_aspirasi->aduan); ?></textarea>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
            
                                                 
                                                
                        
                        
                                                   </div>
                                                   <div class="col-lg-6">
                                                       <div class="form-group ">
              <label for="jenis_aduan" class="col-sm-2 control-label">Jenis Aspirasi
                
              </label>
              <div class="col-sm-8">
                <select class="form-control chosen chosen-select-deselect" name="jenis_aduan" id="jenis_aduan" data-placeholder="Select jenis_aduan">
                  <option value=""></option>

                    <option <?php if ('1' ==  $tbl_aspirasi->jenis_aduan) { ?>selected="selected" <?php } ?> value="1">Kesehatan</option>
                    <option <?php if ('2' ==  $tbl_aspirasi->jenis_aduan) { ?>selected="selected" <?php } ?> value="2">Pendidikan</option>
                    <option <?php if ('3' ==  $tbl_aspirasi->jenis_aduan) { ?>selected="selected" <?php } ?> value="3">Adminduk</option>
                    <option <?php if ('4' ==  $tbl_aspirasi->jenis_aduan) { ?>selected="selected" <?php } ?> value="4">Ekonomi</option>
                  
                </select>
                <small class="info help-block">
                </small>
              </div>
               </div>
                                                   <div class="form-group ">
              <label for="klasifikasi" class="col-sm-2 control-label">Klasifikasi
                
              </label>
              <div class="col-sm-8">
                  <?php

                
                $a = db_get_all_data('setup_aduan');

                ?>
                <select class="form-control chosen chosen-select-deselect" name="klasifikasi" id="klasifikasi" data-placeholder="Select klasifikasi Aduan">
                   <?php foreach ($a as $row) : ?>

                    <option <?php if ($row->value == $this->input->post('klasifikasi')) { ?>selected="selected" <?php } ?> value="<?= $row->value ?>"><?= $row->nama ?></option>
                  <?php endforeach; ?>

                  
                </select>
                <small class="info help-block">
                </small>
              </div>
                        
            </div>
            <div class="form-group ">
              <label for="proses" class="col-sm-2 control-label">Proses
                
              </label>
              <div class="col-sm-8">
                  <?php
                $a = db_get_all_data('setup_aduan_proses');
                ?>
                <select class="form-control chosen chosen-select-deselect" name="proses" id="proses" data-placeholder="Select proses Aduan & Aspirasi">
                   <?php foreach ($a as $row) : ?>

                    <option <?php if ($row->value == $this->input->post('proses')) { ?>selected="selected" <?php } ?> value="<?= $row->value ?>"><?= $row->nama ?></option>
                  <?php endforeach; ?>

                  
                </select>
                <small class="info help-block">
                </small>
              </div>
                        
            </div>
            
            <div class="form-group ">
              <label for="nik" class="col-sm-2 control-label">Status
                
              </label>
              <div class="col-sm-8">
                <select class="form-control chosen chosen-select-deselect" name="status" id="status" data-placeholder="Select Status">
                  <option value=""></option>

                    <option <?php if ('menunggu' == $tbl_aspirasi->status) { ?>selected="selected" <?php } ?> value="menunggu">Menunggu</option>
                    <option <?php if ('proses' == $tbl_aspirasi->status) { ?>selected="selected" <?php } ?> value="proses">Proses</option>
                    <option <?php if ('selesai' == $tbl_aspirasi->status) { ?>selected="selected" <?php } ?> value="selesai">Selesai</option>
                    <option <?php if ('hapus' == $tbl_aspirasi->status) { ?>selected="selected" <?php } ?> value="hapus">Hapus</option>
                  
                </select>
                <small class="info help-block">
                </small>
              </div>
                                                   </div>
                                                      
                                                    <div class="form-group ">
                            <label for="balasan" class="col-sm-2 control-label">Balasan
                            
                            </label>
                            <div class="col-sm-8">
                                <textarea id="balasan" name="balasan" rows="11" cols="50"> <?= set_value('balasan', $tbl_aspirasi->balasan); ?></textarea>
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
              window.location.href = BASE_URL + 'tbl_aspirasi';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
        $('#keterangan').val(keterangan.getData());
                    
        var form_tbl_aspirasi = $('#form_tbl_aspirasi');
        var data_post = form_tbl_aspirasi.serializeArray();
        var save_type = $(this).attr('data-stype');
        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: form_tbl_aspirasi.attr('action'),
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if(res.success) {
            var id = $('#tbl_aspirasi_image_galery').find('li').attr('qq-file-id');
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