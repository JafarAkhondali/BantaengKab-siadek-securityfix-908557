
<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>

<script type="text/javascript">
//This page is a result of an autogenerated content made by running test.html with firefox.
function domo(){
 
   // Binding keys
   $('*').bind('keydown', 'Ctrl+a', function assets() {
       window.location.href = BASE_URL + '/layanan_umum/add';
       return false;
   });

   $('*').bind('keydown', 'Ctrl+f', function assets() {
       $('#sbtn').trigger('click');
       return false;
   });

   $('*').bind('keydown', 'Ctrl+x', function assets() {
       $('#reset').trigger('click');
       return false;
   });

   $('*').bind('keydown', 'Ctrl+b', function assets() {

       $('#reset').trigger('click');
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
                     <!--<div class="row pull-right">-->
                     <!--   <?php is_allowed('layanan_umum_add', function(){?>-->
                     <!--   <a class="btn btn-flat btn-success btn_add_new" id="btn_add_new" title="Tambah Data  (Ctrl+a)" href="<?=  site_url('layanan_umum/add'); ?>"><i class="fa fa-plus-square-o" ></i> Tambah Data</a>-->
                     <!--   <?php }) ?>-->
                     <!--   <?php is_allowed('layanan_umum_export', function(){?>-->
                     <!--   <a class="btn btn-flat btn-success" title="<?= cclang('export'); ?> XLS" href="<?= site_url('layanan_umum/export'); ?>"><i class="fa fa-file-excel-o" ></i></a>-->
                     <!--   <?php }) ?>-->
                       
                     <!--</div>-->
                     <div class="widget-user-image">
                        <img class="img-circle" src="<?= BASE_ASSET; ?>/img/list.png" alt="User Avatar">
                     </div>
                     <!-- /.widget-user-image -->
                     <h3 class="widget-user-username"><b>Layanan Umum</b></h3>
                     <h5 class="widget-user-desc"><?= cclang('list_all', ['Layanan']); ?>  <i class="label bg-yellow"><?= $layanan_umum_counts; ?>  <?= cclang('items'); ?></i></h5>
                  </div>
                
                  <form name="form_layanan_umum" id="form_layanan_umum" action="<?= base_url('layanan_umum/index'); ?>">


                          <div class="row">
                    <div class="form-group ">
                   <div class="col-sm-3">
                                <select  class="form-control chosen chosen-select-deselect" name="Status" id="Status" data-placeholder="PILIH Status" onchange="submit()">
                                  <option value="0"></option>
                                    <option 
                                    <?php if ('1' == $this->input->get('Status') || NULL == $this->input->get('Status')) { ?>selected="selected"<?php } ?>
                                    value="1">Belum Proses</option>
                                     <option 
                                    <?php if ('2' == $this->input->get('Status')) { ?>selected="selected"<?php } ?>
                                    value="2">-</option>
                                     <option 
                                    <?php if ('3' == $this->input->get('Status')) { ?>selected="selected"<?php } ?>
                                    value="3">Proses</option>
                                     <option 
                                    <?php if('4' == $this->input->get('Status')) { ?>selected="selected"<?php } ?>
                                    value="4">Berkas Selesai</option>
                                    
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                  </div>


                    <br>
                  <div class="table-responsive"> 
                  <table class="table table-bordered table-striped dataTable">
                     <thead>
                        <tr class="">
                           <th width="7%">
                            <input type="checkbox" class="flat-red toltip" id="check_all" name="check_all" title="check all">
                           </th>
                           <th style="text-align:center" width="7%">No</th>
                           <th style="text-align:center" width="20%">Jenis Layanan</th>
                           <th style="text-align:center" width="20%">Nik</th>
                           <th style="text-align:center" width="20%">Nama Lengkap</th>
                            <th style="text-align:center" width="10%">Status</th>
                            <th style="text-align:center" width="20%">Waktu Permohonan</th>
                        </tr>
                     </thead>
                     <tbody id="tbody_layanan_umum">
                     <?php foreach($layanan_umums as $layanan_umum): ?>
                        <tr>
                           <td width="5">
                              <input type="checkbox" class="flat-red check" name="id[]" value="<?= $layanan_umum['no']; ?>">
                           </td>
                           
                           <td style="text-align:center"><?= _ent($layanan_umum['no']); ?></td> 
                           <td style="text-align:center"><?= _ent($layanan_umum['jenis_layanan']); ?></td>
                            <td style="text-align:center"><?= _ent($layanan_umum['nik']); ?></td> 
                           <td style="text-align:center"><?= _ent($layanan_umum['nama_lengkap']); ?> </td>
                           <td style="text-align:center">-</td>
                           <td style="text-align:center"><?php $date_create = date_create($layanan_umum['sts1_waktu_permohonan']); echo date_format($date_create,"d/m/Y"); ?></td>
                        </tr>
                      <?php endforeach; ?>
                      <?php if ($layanan_umum_counts == 0) :?>
                         <tr>
                           <td colspan="100">
                           API Dalam Proses Pengembangan
                           </td>
                         </tr>
                      <?php endif; ?>
                     </tbody>
                  </table>
                  </div>
               </div>
               <hr>
             
            </div>
            <!--/box body -->
         </div>
         <!--/box -->
      </div>
   </div>
</section>
<!-- /.content -->

