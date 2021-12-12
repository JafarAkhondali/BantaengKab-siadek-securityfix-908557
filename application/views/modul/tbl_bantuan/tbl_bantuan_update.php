
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
                            <h3 class="widget-user-username"><b>Tagging Bantuan</b></h3>
                            <h5 class="widget-user-desc">Edit Tagging Bantuan</h5>
                            <hr>
                        </div>
                        <?= form_open(base_url('tbl_bantuan/edit_save/'.$this->uri->segment(3)), [
                            'name'    => 'form_tbl_bantuan', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_tbl_bantuan', 
                            'method'  => 'POST'
                            ]); ?>

                            <div class="form-group ">
                            <label for="kd_wilayah" class="col-sm-2 control-label">Kd Wilayah 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select class="form-control chosen chosen-select-deselect" name="kd_wilayah" id="kd_wilayah" data-placeholder="Select Kd Wilayah" disabled>
                  <option value=""></option>
                  <?php foreach (db_get_all_data('wilayah') as $row) : ?>
                    <option <?= $row->kd_wilayah ==  $tbl_regulasi->kd_wilayah ? 'selected' : ''; ?> value="<?= $row->kd_wilayah ?>"><?= $row->nama; ?></option>
                  <?php endforeach; ?>
                </select>
                                <small class="info help-block">
                                <b>Input Kd Wilayah</b> Max Length : 30.</small>
                            </div>
                        </div>
                         
                                                <div class="form-group ">
                            <label for="no_kk" class="col-sm-2 control-label">No.KK 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="no_kk" id="no_kk" placeholder="No.KK" value="<?= set_value('no_kk', $tbl_bantuan->no_kk); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="nama_kepala" class="col-sm-2 control-label">Nama Kepala Keluarga 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="nama_kepala" id="nama_kepala" placeholder="Nama Kepala Keluarga" value="<?= set_value('nama_kepala', $tbl_bantuan->nama_kepala); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="pkh" class="col-sm-2 control-label">PKH 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select" name="pkh" id="pkh" data-placeholder="Select Pkh" >
                                    <option value=""></option>
                                    <option <?= $tbl_bantuan->pkh == "Ya" ? 'selected' :''; ?> value="Ya">Ya</option>
                                    <option <?= $tbl_bantuan->pkh == "Tidak" ? 'selected' :''; ?> value="Tidak">Tidak</option>
                                    </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="bpnt" class="col-sm-2 control-label">BPNT 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select" name="bpnt" id="bpnt" data-placeholder="Select Bpnt" >
                                    <option value=""></option>
                                    <option <?= $tbl_bantuan->bpnt == "Ya" ? 'selected' :''; ?> value="Ya">Ya</option>
                                    <option <?= $tbl_bantuan->bpnt == "Tidak" ? 'selected' :''; ?> value="Tidak">Tidak</option>
                                    </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="blt_dd" class="col-sm-2 control-label">BLT DD 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select" name="blt_dd" id="blt_dd" data-placeholder="Select Blt Dd" >
                                    <option value=""></option>
                                    <option <?= $tbl_bantuan->blt_dd == "Ya" ? 'selected' :''; ?> value="Ya">Ya</option>
                                    <option <?= $tbl_bantuan->blt_dd == "Tidak" ? 'selected' :''; ?> value="Tidak">Tidak</option>
                                    </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="bst" class="col-sm-2 control-label">BST 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select" name="bst" id="bst" data-placeholder="Select Bst" >
                                    <option value=""></option>
                                    <option <?= $tbl_bantuan->bst == "Ya" ? 'selected' :''; ?> value="Ya">Ya</option>
                                    <option <?= $tbl_bantuan->bst == "Tidak" ? 'selected' :''; ?> value="Tidak">Tidak</option>
                                    </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="last_updated_by" class="col-sm-2 control-label">Last Updated By 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="last_updated_by" id="last_updated_by" placeholder="Last Updated By" value="<?= set_value('last_updated_by', $tbl_bantuan->last_updated_by); ?>">
                                <small class="info help-block">
                                <b>Input Last Updated By</b> Max Length : 50.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="last_updated_date" class="col-sm-2 control-label">Last Updated Date 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-6">
                            <div class="input-group date col-sm-8">
                              <input type="text" class="form-control pull-right datetimepicker" name="last_updated_date"  placeholder="Last Updated Date" id="last_updated_date" value="<?= set_value('last_updated_date', $tbl_bantuan->last_updated_date); ?>">
                            </div>
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
              window.location.href = BASE_URL + 'tbl_bantuan';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
            
        var form_tbl_bantuan = $('#form_tbl_bantuan');
        var data_post = form_tbl_bantuan.serializeArray();
        var save_type = $(this).attr('data-stype');
        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: form_tbl_bantuan.attr('action'),
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if(res.success) {
            var id = $('#tbl_bantuan_image_galery').find('li').attr('qq-file-id');
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