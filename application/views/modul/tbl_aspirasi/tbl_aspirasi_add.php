
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
                            <h3 class="widget-user-username"><b>Tbl Aspirasi</b></h3>
                            <h5 class="widget-user-desc"><?= cclang('new', ['Tbl Aspirasi']); ?></h5>
                            <hr>
                        </div>
                        <?= form_open('', [
                            'name'    => 'form_tbl_aspirasi', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_tbl_aspirasi', 
                            'enctype' => 'multipart/form-data', 
                            'method'  => 'POST'
                            ]); ?>
                         
                                                <div class="form-group ">
                            <label for="kd_wilayah" class="col-sm-2 control-label">Kd Wilayah 
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="kd_wilayah" id="kd_wilayah" data-placeholder="Select Kd Wilayah" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('wilayah') as $row): ?>
                                    <option value="<?= $row->kd_wilayah ?>"><?= $row->nama; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                                                 
                        <!--                        <div class="form-group ">-->
                        <!--    <label for="nik" class="col-sm-2 control-label">Nik -->
                        <!--    <i class="required">*</i>-->
                        <!--    </label>-->
                        <!--    <div class="col-sm-8">-->
                        <!--        <select  class="form-control chosen chosen-select-deselect" name="nik" id="nik" data-placeholder="Select Nik" >-->
                        <!--            <option value=""></option>-->
                                    <!--?php foreach (db_get_all_data('penduduk_real') as $row): ?>
                                    <!--<option value="<!?= $row->nik ?>"><!?= $row->nik; ?></option>-->
                                    <!--<!?php endforeach; ?>  -->
                        <!--        </select>-->
                        <!--        <small class="info help-block">-->
                        <!--        </small>-->
                        <!--    </div>-->
                        <!--</div>-->
                        
                        <div class="form-group ">
                            <label for="nik" class="col-sm-2 control-label">Nik
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="nik" id="nik" placeholder="nik" value="<?= set_value('nik'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="nama" class="col-sm-2 control-label">Nama 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?= set_value('nama'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="no_hp" class="col-sm-2 control-label">No Hp 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="no_hp" id="no_hp" placeholder="No Hp" value="<?= set_value('no_hp'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="jenis_aduan" class="col-sm-2 control-label">Jenis Aduan 
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="jenis_aduan" id="jenis_aduan" data-placeholder="Select Jenis Aduan" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('setup_aduan') as $row): ?>
                                    <option value="<?= $row->value ?>"><?= $row->nama; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                                                 
                                                <div class="form-group ">
                            <label for="aduan" class="col-sm-2 control-label">Aduan 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <textarea id="aduan" name="aduan" rows="5" class="textarea"><?= set_value('aduan'); ?></textarea>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="tipe" class="col-sm-2 control-label">Tipe 
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select" name="tipe" id="tipe" data-placeholder="Select Tipe" >
                                    <option value=""></option>
                                    <option value="1">Aduan</option>
                                    <option value="2">Aspirasi</option>
                                    </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="balasan" class="col-sm-2 control-label">Balasan 
                            </label>
                            <div class="col-sm-8">
                                <textarea id="balasan" name="balasan" rows="5" class="textarea"><?= set_value('balasan'); ?></textarea>
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
                                    <option value="proses">Proses</option>
                                    <option value="menunggu">Menunggu</option>
                                    <option value="selesai">Selesai</option>
                                    </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                        
                        <div class="form-group ">
                            <label for="klasifikasi" class="col-sm-2 control-label">Klasifikasi 
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select" name="klasifikasi" id="klasifikasi" data-placeholder="Select Klasifikasi" >
                                    <option value=""></option>
                                    <option value="1">Bidang Penyelenggaraan Pemerintahan Desa</option>
                                    <option value="2">Bidang Pembinaan Kemasyarakatan Desa</option>
                                    <option value="3">Bidang Pemberdayaan Masyarakat Desa</option>
                                    <option value="4">Bidang Penanggulangan Bencana, Keadaan Darurat dan Mendesak Desa</option>
                                    </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                        <!--                        <div class="form-group ">-->
                        <!--    <label for="tahun" class="col-sm-2 control-label">Tahun -->
                        <!--    </label>-->
                        <!--    <div class="col-sm-2">-->
                        <!--        <select  class="form-control chosen chosen-select-deselect" name="tahun" id="tahun" data-placeholder="Select Tahun" >-->
                        <!--            <option value=""></option>-->
                                   <!-- ?php for ($i = 2020; $i < date('Y')+10; $i++){ ?>-->
                        <!--            <option value="<<!-- ?= $i;?>"><<!-- ?= $i; ?></option>-->
                        <!--            <<!-- ?php }; ?>  -->
                        <!--        </select>-->
                        <!--        <small class="info help-block">-->
                        <!--        </small>-->
                        <!--    </div>-->
                        <!--</div>-->
                                                 
                                                <div class="form-group  wrapper-options-crud">
                            <label for="disabilitas" class="col-sm-2 control-label">Disabilitas 
                            </label>
                            <div class="col-sm-8">
                                    <div class="col-md-3 padding-left-0">
                                    <label>
                                    <input type="radio" class="flat-red" name="disabilitas" value="1"> YA                                    </label>
                                    </div>
                                    <div class="col-md-3 padding-left-0">
                                    <label>
                                    <input type="radio" class="flat-red" name="disabilitas" value="2"> Tidak                                    </label>
                                    </div>
                                    </select>
                                <div class="row-fluid clear-both">
                                <small class="info help-block">
                                </small>
                                </div>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="proses" class="col-sm-2 control-label">Proses 
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="proses" id="proses" data-placeholder="Select Proses" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('setup_aduan_proses') as $row): ?>
                                    <option value="<?= $row->value ?>"><?= $row->nama; ?></option>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script type="text/javascript">
            function isi_otomatis(){
                var nim = $("#nim").val();
                $.ajax({
                    url: 'ajax.php',
                    data:"nik="+nik,
                }).success(function (data) {
                    var json = data,
                    obj = JSON.parse(json);
                    $('#nama').val(obj.nama);
                });
            }
        </script>
        
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
              window.location.href = BASE_URL + 'tbl_aspirasi';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
            
        var form_tbl_aspirasi = $('#form_tbl_aspirasi');
        var data_post = form_tbl_aspirasi.serializeArray();
        var save_type = $(this).attr('data-stype');

        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: BASE_URL + '/tbl_aspirasi/add_save',
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