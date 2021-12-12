
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
                            <h3 class="widget-user-username"><b>Bumdes</b></h3>
                            <h5 class="widget-user-desc"><?= cclang('new', ['Bumdes']); ?></h5>
                            <hr>
                        </div>
                        <?= form_open('', [
                            'name'    => 'form_bumdes', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_bumdes', 
                            'enctype' => 'multipart/form-data', 
                            'method'  => 'POST'
                            ]); ?>
                            <div class="col-lg-6">
                            <div class="form-group ">
                            <label for="periode" class="col-sm-2 control-label">Periode 
                            </label>
                            <div class="col-sm-4">
                                <select  class="form-control chosen chosen-select-deselect" name="periode" id="periode" data-placeholder="Select Periode" >
                                    <option value=""></option>
                                    <?php for ($i = 1970; $i < date('Y')+100; $i++){ ?>
                                    <option value="<?= $i;?>"><?= $i; ?></option>
                                    <?php }; ?>  
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="jenis_BUMDes" class="col-sm-2 control-label">Jenis BUMDes 
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select" name="jenis_BUMDes" id="jenis_BUMDes" data-placeholder="Select Jenis BUMDes" >
                                    <option value=""></option>
                                    <option value="1">BUMDes</option>
                                    <option value="2">BUMDes BERSAMA</option>
                                    <option value="3">BUMDes</option>
                                    </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="nama_BUMDes" class="col-sm-2 control-label">Nama BUMDes 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="nama_BUMDes" id="nama_BUMDes" placeholder="Nama BUMDes" value="<?= set_value('nama_BUMDes'); ?>">
                                <small class="info help-block">
                                <b>Input Nama BUMDes</b> Max Length : 500.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="pengelolah" class="col-sm-2 control-label">Pengelolah 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="pengelolah" id="pengelolah" placeholder="Pengelolah" value="<?= set_value('pengelolah'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="jabatan" class="col-sm-2 control-label">Jabatan 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="jabatan" id="jabatan" placeholder="Jabatan" value="<?= set_value('jabatan'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                            </div>
                            <div class="col-lg-6"> 
                            <div class="form-group ">
                            <label for="tanggal_pendirian" class="col-sm-2 control-label">Tanggal Pendirian 
                            </label>
                            <div class="col-sm-6">
                            <div class="input-group date col-sm-8">
                              <input type="text" class="form-control pull-right datetimepicker" name="tanggal_pendirian"  id="tanggal_pendirian">
                            </div>
                            <small class="info help-block">
                            </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="perdes" class="col-sm-2 control-label">Perdes 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="perdes" id="perdes" placeholder="Perdes" value="<?= set_value('perdes'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                        
                            <div class="form-group ">
                            <label for="jenis_kegiatan" class="col-sm-2 control-label">Jenis Kegiatan 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="jenis_kegiatan" id="jenis_kegiatan" placeholder="Jenis Kegiatan" value="<?= set_value('jenis_kegiatan'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                         <div class="form-group  wrapper-options-crud">
                            <label for="status" class="col-sm-2 control-label">Status 
                            </label>
                            <div class="col-sm-8">
                                    <div class="col-md-3 padding-left-0">
                                    <label>
                                    <input type="radio" class="flat-red" name="status" value="1"> Aktif                                    </label>
                                    </div>
                                    <div class="col-md-5 padding-left-0">
                                    <label>
                                    <input type="radio" class="flat-red" name="status" value="2"> Tidak Aktif                                    </label>
                                    </div>
                                    </select>
                                <div class="row-fluid clear-both">
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
              window.location.href = BASE_URL + 'bumdes';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
            
        var form_bumdes = $('#form_bumdes');
        var data_post = form_bumdes.serializeArray();
        var save_type = $(this).attr('data-stype');

        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: BASE_URL + '/bumdes/add_save',
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