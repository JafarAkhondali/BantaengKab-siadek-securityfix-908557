<style type="text/css">
   .widget-user-header {
      padding-left: 20px !important;
   }
</style>

<link rel="stylesheet" href="<?= BASE_ASSET; ?>admin-lte/plugins/morris/morris.css">
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<section class="content">
    <form name="form_dashboard" id="form_dashboard" action="<?= base_url('administrator/pusatdata/index'); ?>" method="get">
    
         <div class="row">
                    <div class="form-group ">
                      <br>
                            <div class="col-sm-3">
                              
                              <?php 
                                $kdwilayah = get_user_data('kd_wilayah'); 
                                $username = get_user_data('username'); 
                                if($username == 'admin' ){
                                  $a = db_get_all_data('wilayah');
                                }else{
                                 $a = db_get_all_data('wilayah',"kd_wilayah LIKE '$kdwilayah%'");
                                }
                              ?>

                                <select  class="form-control chosen chosen-select-deselect" name="kd_wilayah" id="kd_wilayah" data-placeholder="PILIH wilayah" onchange="submit()">
                                 
                                  <?php if($username == 'admin'){?>
                                    <option value="0"></option>
                                  <?php } ?>

                                  <?php foreach ($a as $row): ?>
                                    
                                    <option 
                                    <?php if ($row->kd_wilayah == $this->input->get('kd_wilayah')) { ?>selected="selected"<?php } ?>
                                    value="<?= $row->kd_wilayah ?>"><?= '[ '.$row->kd_wilayah.' ] '. $row->nama ?></option>
                                    <?php endforeach; ?>  
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                  </div>
                         <br> 

     <div class="row">
      <div class="col-md-12">        
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">BUMDes</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class=""><a href="#bumdes-jenkel" data-toggle="tab" aria-expanded="true" data-original-title="" title="">Jenis Kelamin</a></li>
                        <li class="active"><a href="#bumdes-jenis" data-toggle="tab" aria-expanded="false" data-original-title="" title=""> Jenis Bumdes</a></li>
                    </ul>
            </div>
            <div class="tab-content">
                <div class="tab-pane active" id="bumdes-jenkel">
                <div id='bumdes_jk'></div>
                </div>
                <div class="tab-pane" id="bumdes-jenis">
                <div id='bumdes_jenis'></div>
                </div>
                </div>
            </div>
          </div>
          <!-- /.box -->
        </div>
        
        <div class="row">
      <div class="col-md-12">        
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">UMKM</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class=""><a href="#umkm-tab" data-toggle="tab" aria-expanded="true" data-original-title="" title="">UMKM </a></li>
                        <li class="active"><a href="#umkm-tab1" data-toggle="tab" aria-expanded="false" data-original-title="" title="">UMKM 1 </a></li>
                    </ul>
            </div>
            <div class="tab-content">
                <div class="tab-pane active" id="umkm-tab">
                <div id='umkm'></div>
                </div>
                <div class="tab-pane" id="umkm-tab1">
                <div id='bumdes'></div>
                </div>
                </div>
            </div>
          </div>
          <!-- /.box -->
        </div>
        
        </div> 
        </form>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="<?= BASE_ASSET; ?>admin-lte/plugins/morris/morris.min.js"></script>
<script>
var options = {
          series: [44, 55],
          chart: {
          width: 380,
          type: 'pie',
        },
        labels: ['Laki-Laki', 'Perempuan'],
        responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              width: 200
            },
            legend: {
              position: 'bottom'
            }
          }
        }]
        };

        var chart = new ApexCharts(document.querySelector("#bumdes-jenkel"), options);
        chart.render();
  </script>
  <script>
var options = {
          series: [15, 20,14],
          chart: {
          width: 380,
          type: 'pie',
        },
        labels: ['BUMDes', 'BUMDes Bersama', 'BUMDes Lainya'],
        responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              width: 200
            },
            legend: {
              position: 'bottom'
            }
          }
        }]
        };

        var chart = new ApexCharts(document.querySelector("#bumdes-jenis"), options);
        chart.render();
  </script>
  