
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
                            <h3 class="widget-user-username"><b>Pendidikan</b></h3>
                            <h5 class="widget-user-desc">Edit Pendidikan</h5>
                            <hr>
                        </div>
                        <?= form_open(base_url('pendidikan/edit_save/'.$this->uri->segment(3)), [
                            'name'    => 'form_pendidikan', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_pendidikan', 
                            'method'  => 'POST'
                            ]); ?>
                         
                        <div class="col-lg-6">
                        <div class="form-group ">
                            <label for="kd_wilayah" class="col-sm-2 control-label">Kd Wilayah 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select" name="kd_wilayah[]" id="kd_wilayah" data-placeholder="Select Kd Wilayah" multiple >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('wilayah') as $row): ?>
                                    <option <?=  in_array($row->kd_wilayah, explode(',', $pendidikan->kd_wilayah)) ? 'selected' : ''; ?> value="<?= $row->kd_wilayah ?>"><?= $row->nama; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="nama_sekolah" class="col-sm-2 control-label">Nama Sekolah 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="nama_sekolah" id="nama_sekolah" placeholder="Nama Sekolah" value="<?= set_value('nama_sekolah', $pendidikan->nama_sekolah); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="npsm" class="col-sm-2 control-label">Npsm 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="npsm" id="npsm" placeholder="Npsm" value="<?= set_value('npsm', $pendidikan->npsm); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="bp" class="col-sm-2 control-label">Bp 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="bp" id="bp" placeholder="Bp" value="<?= set_value('bp', $pendidikan->bp); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="status" class="col-sm-2 control-label">Status 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="status" id="status" placeholder="Status" value="<?= set_value('status', $pendidikan->status); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="Jml_Sync" class="col-sm-2 control-label">Jml Sync 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="Jml_Sync" id="Jml_Sync" placeholder="Jml Sync" value="<?= set_value('Jml_Sync', $pendidikan->Jml_Sync); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="pd" class="col-sm-2 control-label">Pd 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="pd" id="pd" placeholder="Pd" value="<?= set_value('pd', $pendidikan->pd); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                        </div>
                        <div class="col-lg-6">
                                    
                        <div class="form-group ">
                            <label for="rombel" class="col-sm-2 control-label">Rombel 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="rombel" id="rombel" placeholder="Rombel" value="<?= set_value('rombel', $pendidikan->rombel); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="guru" class="col-sm-2 control-label">Guru 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="guru" id="guru" placeholder="Guru" value="<?= set_value('guru', $pendidikan->guru); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="pegawai" class="col-sm-2 control-label">Pegawai 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="pegawai" id="pegawai" placeholder="Pegawai" value="<?= set_value('pegawai', $pendidikan->pegawai); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="ruang_kelas" class="col-sm-2 control-label">Ruang Kelas 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="ruang_kelas" id="ruang_kelas" placeholder="Ruang Kelas" value="<?= set_value('ruang_kelas', $pendidikan->ruang_kelas); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="ruang_perpus" class="col-sm-2 control-label">Ruang Perpus 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="ruang_perpus" id="ruang_perpus" placeholder="Ruang Perpus" value="<?= set_value('ruang_perpus', $pendidikan->ruang_perpus); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="ruang_lab" class="col-sm-2 control-label">Ruang Lab 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="ruang_lab" id="ruang_lab" placeholder="Ruang Lab" value="<?= set_value('ruang_lab', $pendidikan->ruang_lab); ?>">
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
              window.location.href = BASE_URL + 'pendidikan';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
            
        var form_pendidikan = $('#form_pendidikan');
        var data_post = form_pendidikan.serializeArray();
        var save_type = $(this).attr('data-stype');
        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: form_pendidikan.attr('action'),
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if(res.success) {
            var id = $('#pendidikan_image_galery').find('li').attr('qq-file-id');
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