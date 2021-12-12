
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
                            <h3 class="widget-user-username"><b>Balita Stunting</b></h3>
                            <h5 class="widget-user-desc">Edit Balita Stunting</h5>
                            <hr>
                        </div>
                        <?= form_open(base_url('balita_stunting/edit_save/'.$this->uri->segment(3)), [
                            'name'    => 'form_balita_stunting', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_balita_stunting', 
                            'method'  => 'POST'
                            ]); ?>
                         
                        <div class="col-lg-6">
                        <div class="form-group ">
                            <label for="kd_wilayah" class="col-sm-2 control-label">Kd Wilayah 
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="kd_wilayah" id="kd_wilayah" data-placeholder="Select Kd Wilayah" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('wilayah') as $row): ?>
                                    <option <?=  $row->kd_wilayah ==  $balita_stunting->kd_wilayah ? 'selected' : ''; ?> value="<?= $row->kd_wilayah ?>"><?= $row->nama; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                                                 
                                                <div class="form-group ">
                            <label for="nik" class="col-sm-2 control-label">Nik 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="nik" id="nik" placeholder="Nik" value="<?= set_value('nik', $balita_stunting->nik); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="nama" class="col-sm-2 control-label">Nama 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?= set_value('nama', $balita_stunting->nama); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="jenis_kelamin" class="col-sm-2 control-label">Jenis Kelamin 
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select" name="jenis_kelamin" id="jenis_kelamin" data-placeholder="Select Jenis Kelamin" >
                                    <option value=""></option>
                                    <option <?= $balita_stunting->jenis_kelamin == "1" ? 'selected' :''; ?> value="1">laki-Laki</option>
                                    <option <?= $balita_stunting->jenis_kelamin == "2" ? 'selected' :''; ?> value="2">Perempuan</option>
                                    </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="tanggal_lahir" class="col-sm-2 control-label">Tanggal Lahir 
                            </label>
                            <div class="col-sm-6">
                            <div class="input-group date col-sm-8">
                              <input type="text" class="form-control pull-right datepicker" name="tanggal_lahir"  placeholder="Tanggal Lahir" id="tanggal_lahir" value="<?= set_value('balita_stunting_tanggal_lahir_name', $balita_stunting->tanggal_lahir); ?>">
                            </div>
                            <small class="info help-block">
                            </small>
                            </div>
                        </div>
                       
                                                 
                                                <div class="form-group ">
                            <label for="bb_lahir" class="col-sm-2 control-label">Bb Lahir 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="bb_lahir" id="bb_lahir" placeholder="Bb Lahir" value="<?= set_value('bb_lahir', $balita_stunting->bb_lahir); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="tb_lahir" class="col-sm-2 control-label">Tb Lahir 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="tb_lahir" id="tb_lahir" placeholder="Tb Lahir" value="<?= set_value('tb_lahir', $balita_stunting->tb_lahir); ?>">
                                <small class="info help-block">
                                <b>Input Tb Lahir</b> Max Length : 100.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="nama_ortu" class="col-sm-2 control-label">Nama Ortu 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="nama_ortu" id="nama_ortu" placeholder="Nama Ortu" value="<?= set_value('nama_ortu', $balita_stunting->nama_ortu); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="posyandu" class="col-sm-2 control-label">Posyandu 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="posyandu" id="posyandu" placeholder="Posyandu" value="<?= set_value('posyandu', $balita_stunting->posyandu); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                        </div>
                        <div class="col-lg-6">
                        <div class="form-group ">
                            <label for="alamat" class="col-sm-2 control-label">Alamat 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat" value="<?= set_value('alamat', $balita_stunting->alamat); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="usia_saat_diukur" class="col-sm-2 control-label">Usia Saat Diukur 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="usia_saat_diukur" id="usia_saat_diukur" placeholder="Usia Saat Diukur" value="<?= set_value('usia_saat_diukur', $balita_stunting->usia_saat_diukur); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="tanggal_pengukur" class="col-sm-2 control-label">Tanggal Pengukur 
                            </label>
                            <div class="col-sm-6">
                            <div class="input-group date col-sm-8">
                              <input type="text" class="form-control pull-right datepicker" name="tanggal_pengukur"  placeholder="Tanggal Pengukur" id="tanggal_pengukur" value="<?= set_value('balita_stunting_tanggal_pengukur_name', $balita_stunting->tanggal_pengukur); ?>">
                            </div>
                            <small class="info help-block">
                            </small>
                            </div>
                        </div>
                       
                                                 
                                                <div class="form-group ">
                            <label for="berat" class="col-sm-2 control-label">Berat 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="berat" id="berat" placeholder="Berat" value="<?= set_value('berat', $balita_stunting->berat); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="tinggi" class="col-sm-2 control-label">Tinggi 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="tinggi" id="tinggi" placeholder="Tinggi" value="<?= set_value('tinggi', $balita_stunting->tinggi); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="lila" class="col-sm-2 control-label">Lila 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="lila" id="lila" placeholder="Lila" value="<?= set_value('lila', $balita_stunting->lila); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="tb_u" class="col-sm-2 control-label">Tb U 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="tb_u" id="tb_u" placeholder="Tb U" value="<?= set_value('tb_u', $balita_stunting->tb_u); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="zs_tb_u" class="col-sm-2 control-label">Zs Tb U 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="zs_tb_u" id="zs_tb_u" placeholder="Zs Tb U" value="<?= set_value('zs_tb_u', $balita_stunting->zs_tb_u); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
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
              window.location.href = BASE_URL + 'balita_stunting';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
            
        var form_balita_stunting = $('#form_balita_stunting');
        var data_post = form_balita_stunting.serializeArray();
        var save_type = $(this).attr('data-stype');
        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: form_balita_stunting.attr('action'),
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if(res.success) {
            var id = $('#balita_stunting_image_galery').find('li').attr('qq-file-id');
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