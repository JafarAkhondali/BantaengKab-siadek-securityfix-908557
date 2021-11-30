
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
                            <h3 class="widget-user-username"><b>Umkm</b></h3>
                            <h5 class="widget-user-desc">Edit Umkm</h5>
                            <hr>
                        </div>
                        <?= form_open(base_url('umkm/edit_save/'.$this->uri->segment(3)), [
                            'name'    => 'form_umkm', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_umkm', 
                            'method'  => 'POST'
                            ]); ?>
                         
                         <div class="col-lg-6">
                             
                         <div class="form-group ">
                            <label for="nama_pelaku_usaha" class="col-sm-2 control-label">Nama Pelaku Usaha 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="nama_pelaku_usaha" id="nama_pelaku_usaha" placeholder="Nama Pelaku Usaha" value="<?= set_value('nama_pelaku_usaha', $umkm->nama_pelaku_usaha); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="nik" class="col-sm-2 control-label">Nik 
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="nik" id="nik" placeholder="Nik" value="<?= set_value('nik', $umkm->nik); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group  wrapper-options-crud">
                            <label for="jenis_kelamin" class="col-sm-2 control-label">Jenis Kelamin 
                            </label>
                            <div class="col-sm-8">
                                    <div class="col-md-3 padding-left-0">
                                    <label>
                                    <input <?= $umkm->jenis_kelamin == "1" ? "checked" : ""; ?> type="radio" class="flat-red" name="jenis_kelamin" value="1"> Laki-Laki                                    </label>
                                    </div>
                                    <div class="col-md-3 padding-left-0">
                                    <label>
                                    <input <?= $umkm->jenis_kelamin == "2" ? "checked" : ""; ?> type="radio" class="flat-red" name="jenis_kelamin" value="2"> Perempuan                                    </label>
                                    </div>
                                    </select>
                                <div class="row-fluid clear-both">
                                <small class="info help-block">
                                </small>
                                </div>
                            </div>
                        </div>
                                                 
                                                <div class="form-group  wrapper-options-crud">
                            <label for="pr" class="col-sm-2 control-label">Pr 
                            </label>
                            <div class="col-sm-8">
                                    <div class="col-md-3  padding-left-0">
                                    <label>
                                    <input <?= in_array('1', explode(',', $umkm->pr)) ? 'checked' : ''; ?>  type="checkbox" class="flat-red" name="pr[]" value="1"> Ya                                    </label>
                                    </div>
                                                                        <div class="row-fluid clear-both">
                                    <small class="info help-block">
                                    </small>
                                    </div>
                                    
                            </div>
                        </div>
                                                 
                                                <div class="form-group  wrapper-options-crud">
                            <label for="js" class="col-sm-2 control-label">Js 
                            </label>
                            <div class="col-sm-8">
                                    <div class="col-md-3  padding-left-0">
                                    <label>
                                    <input <?= in_array('1', explode(',', $umkm->js)) ? 'checked' : ''; ?>  type="checkbox" class="flat-red" name="js[]" value="1"> Ya                                    </label>
                                    </div>
                                                                        <div class="row-fluid clear-both">
                                    <small class="info help-block">
                                    </small>
                                    </div>
                                    
                            </div>
                        </div>
                                                 
                                                <div class="form-group  wrapper-options-crud">
                            <label for="pd" class="col-sm-2 control-label">Pd 
                            </label>
                            <div class="col-sm-8">
                                    <div class="col-md-3  padding-left-0">
                                    <label>
                                    <input <?= in_array('1', explode(',', $umkm->pd)) ? 'checked' : ''; ?>  type="checkbox" class="flat-red" name="pd[]" value="1"> Ya                                    </label>
                                    </div>
                                                                        <div class="row-fluid clear-both">
                                    <small class="info help-block">
                                    </small>
                                    </div>
                                    
                            </div>
                        </div>
                                                 
                                                <div class="form-group  wrapper-options-crud">
                            <label for="wr" class="col-sm-2 control-label">Wr 
                            </label>
                            <div class="col-sm-8">
                                    <div class="col-md-3  padding-left-0">
                                    <label>
                                    <input <?= in_array('1', explode(',', $umkm->wr)) ? 'checked' : ''; ?>  type="checkbox" class="flat-red" name="wr[]" value="1"> Ya                                    </label>
                                    </div>
                                                                        <div class="row-fluid clear-both">
                                    <small class="info help-block">
                                    </small>
                                    </div>
                                    
                            </div>
                        </div>
                                                 
                                                <div class="form-group  wrapper-options-crud">
                            <label for="bd" class="col-sm-2 control-label">Bd 
                            </label>
                            <div class="col-sm-8">
                                    <div class="col-md-3  padding-left-0">
                                    <label>
                                    <input <?= in_array('1', explode(',', $umkm->bd)) ? 'checked' : ''; ?>  type="checkbox" class="flat-red" name="bd[]" value="1"> Ya                                    </label>
                                    </div>
                                                                        <div class="row-fluid clear-both">
                                    <small class="info help-block">
                                    </small>
                                    </div>
                                    
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="jenis_usaha" class="col-sm-2 control-label">Jenis Usaha 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="jenis_usaha" id="jenis_usaha" placeholder="Jenis Usaha" value="<?= set_value('jenis_usaha', $umkm->jenis_usaha); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="manusia" class="col-sm-2 control-label">Manusia 
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="manusia" id="manusia" placeholder="Manusia" value="<?= set_value('manusia', $umkm->manusia); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="alam" class="col-sm-2 control-label">Alam 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="alam" id="alam" placeholder="Alam" value="<?= set_value('alam', $umkm->alam); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                        </div>
                        <div class="col-lg-6">
                        <div class="form-group ">
                            <label for="lahan_bagunan" class="col-sm-2 control-label">Lahan Bagunan 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="lahan_bagunan" id="lahan_bagunan" placeholder="Lahan Bagunan" value="<?= set_value('lahan_bagunan', $umkm->lahan_bagunan); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="mesin_alat" class="col-sm-2 control-label">Mesin Alat 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="mesin_alat" id="mesin_alat" placeholder="Mesin Alat" value="<?= set_value('mesin_alat', $umkm->mesin_alat); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="finansial" class="col-sm-2 control-label">Finansial 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="finansial" id="finansial" placeholder="Finansial" value="<?= set_value('finansial', $umkm->finansial); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="ket_finansial" class="col-sm-2 control-label">Ket Finansial 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="ket_finansial" id="ket_finansial" placeholder="Ket Finansial" value="<?= set_value('ket_finansial', $umkm->ket_finansial); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="pasar" class="col-sm-2 control-label">Pasar 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="pasar" id="pasar" placeholder="Pasar" value="<?= set_value('pasar', $umkm->pasar); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="mitra" class="col-sm-2 control-label">Mitra 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="mitra" id="mitra" placeholder="Mitra" value="<?= set_value('mitra', $umkm->mitra); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="lokasi" class="col-sm-2 control-label">Lokasi 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="lokasi" id="lokasi" placeholder="Lokasi" value="<?= set_value('lokasi', $umkm->lokasi); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="bentuk_org" class="col-sm-2 control-label">Bentuk Org 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="bentuk_org" id="bentuk_org" placeholder="Bentuk Org" value="<?= set_value('bentuk_org', $umkm->bentuk_org); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="kegiatan" class="col-sm-2 control-label">Kegiatan 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="kegiatan" id="kegiatan" placeholder="Kegiatan" value="<?= set_value('kegiatan', $umkm->kegiatan); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="mulai_usaha" class="col-sm-2 control-label">Mulai Usaha 
                            </label>
                            <div class="col-sm-6">
                            <div class="input-group date col-sm-8">
                              <input type="text" class="form-control pull-right datepicker" name="mulai_usaha"  placeholder="Mulai Usaha" id="mulai_usaha" value="<?= set_value('umkm_mulai_usaha_name', $umkm->mulai_usaha); ?>">
                            </div>
                            <small class="info help-block">
                            </small>
                            </div>
                        </div>
                       
                                                 
                                                <div class="form-group ">
                            <label for="moral" class="col-sm-2 control-label">Moral 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="moral" id="moral" placeholder="Moral" value="<?= set_value('moral', $umkm->moral); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="aturan" class="col-sm-2 control-label">Aturan 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="aturan" id="aturan" placeholder="Aturan" value="<?= set_value('aturan', $umkm->aturan); ?>">
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
              window.location.href = BASE_URL + 'umkm';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
            
        var form_umkm = $('#form_umkm');
        var data_post = form_umkm.serializeArray();
        var save_type = $(this).attr('data-stype');
        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: form_umkm.attr('action'),
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if(res.success) {
            var id = $('#umkm_image_galery').find('li').attr('qq-file-id');
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