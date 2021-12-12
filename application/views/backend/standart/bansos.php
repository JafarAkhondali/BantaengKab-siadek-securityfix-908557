<style type="text/css">
   .widget-user-header {
      padding-left: 20px !important;
   }
</style>

<link rel="stylesheet" href="<?= BASE_ASSET; ?>admin-lte/plugins/morris/morris.css">
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<section class="content-header">
    <h1>
        <?= cclang('dashboard') ?>
        <small>
            
        <?= cclang('control_panel') ?>
        </small>
    </h1>
    <ol class="breadcrumb">
        <li>
            <a href="#">
                <i class="fa fa-dashboard">
                </i>
                <?= cclang('home') ?>
            </a>
        </li>
        <li class="active">
            <?= cclang('dashboard') ?>
        </li>
    </ol>
</section>

<section class="content">
     <div class="row">
         <div class="form-group ">
             
    <form name="form_dashboard" id="form_dashboard" action="<?= base_url('administrator/bansos/index'); ?>" method="get">
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
                  
     <div class="col-md-8">        
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Data Bansos</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class=""><a href="#bansos_usia" data-toggle="tab" aria-expanded="false" data-original-title="" title="">Bansos Berdasarkan Usia</a></li>
                        <li class="active"><a href="#profil" data-toggle="tab" aria-expanded="true" data-original-title="" title="">Bansos Berdasarkan Jenis</a></li>
                        <li class=""><a href="#Perkawinan" data-toggle="tab" aria-expanded="false" data-original-title="" title="">Rentan & Disabilitas</a></li>
                        <li class=""><a href="#bjeniskelamin" data-toggle="tab" aria-expanded="false" data-original-title="" title="">Bansos Jenis Kelamin</a></li>
                    </ul>
            </div>
            <div class="tab-content">
                <div class="tab-pane active" id="profil">
                <div id='kartu'></div>
                </div>
                <div class="tab-pane" id="bansos_usia">
                <div id='usia_bansos'></div>
                </div>
                <div class="tab-pane" id="Perkawinan">
                  <div id='penderita'></div>
                </div>
                <div class="tab-pane" id="bjeniskelamin">
                  <div id='jeniskelamin'></div>
                </div>
            </div>
          </div>
        </div>


     <div class="col-md-4">        
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Lansia</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body chart-responsive">
             <div id='lansia'></div>
            </div>
          </div>
          <!-- /.box -->
        </div>


          <!-- /.box -->
        </div>
      </div>
      <!-- /.row -->
</section>
<!-- /.content -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="<?= BASE_ASSET; ?>admin-lte/plugins/morris/morris.min.js"></script>
<script>
        //data Bansos
        var options = {
        //disabilitas
          series: [<?php 
          echo $hit_disabilitas;
        ?>, <?php 
          echo $hit_rentan;
        ?>],
          chart: {
          width: 380,
          type: 'pie',
        },
        labels: ['DISABILITAS', 'RENTAN'],
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

        var chart = new ApexCharts(document.querySelector("#penderita"), options);
        chart.render();
      
      
      //lansia
      var options = {
          series: [<?php 
          $this->db->from('art_dtks');
          $wilayahkel= $this->db->count_all_results(); 
          echo $wilayahkel;
        ?>],
          chart: {
          width: 380,
          type: 'pie',
        },
        labels: ['Data Lansia'],
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

        var chart = new ApexCharts(document.querySelector("#lansia"), options);
        chart.render();

      
      //data kartu
      var options = {
          series: [
            <?php 
        echo $hit_pbi;
      ?>,  <?php 
        echo $hit_kks;
      ?>, <?php 
        echo $hit_bpnt;
      ?>, <?php 
        echo $hit_kip;
      ?>],
          chart: {
          width: 380,
          type: 'pie',
        },
        labels: ['PBI', 'KKS', 'BPNT', 'KIP'],
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

        var chart = new ApexCharts(document.querySelector("#kartu"), options);
        chart.render();

      //data Bansos
      var options = {
          series: [<?php 
          $this->db->from('art_dtks');
          $this->db->where('ada_BPNT', 1);
          $bpnt= $this->db->count_all_results(); 
          echo $bpnt;
        ?>, <?php 
        $this->db->from('art_dtks');
        $this->db->where('ada_pkh', 1);
        $pkh= $this->db->count_all_results(); 
        echo $pkh;
      ?>],
          chart: {
          width: 380,
          type: 'pie',
        },
        labels: ['BPNT', 'PKH'],
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

        var chart = new ApexCharts(document.querySelector("#bantuan"), options);
        chart.render();
      
      
      //bansos berdasarkan jenis kelamin
      var options = {
          series: [<?php echo $hit_jenis_kelamin_L;?>, <?php echo $hit_jenis_kelamin_P;?>],
          chart: {
          width: 380,
          type: 'polarArea'
        },
        labels: ['Laki-Laki', 'Perempuan'],
        fill: {
          opacity: 1
        },
        stroke: {
          width: 1,
          colors: undefined
        },
        yaxis: {
          show: false
        },
        legend: {
          position: 'bottom'
        },
        plotOptions: {
          polarArea: {
            rings: {
              strokeWidth: 0
            },
            spokes: {
              strokeWidth: 0
            },
          }
        },
        theme: {
          monochrome: {
            enabled: true,
            shadeTo: 'light',
            shadeIntensity: 0.6
          }
        }
        };

        var chart = new ApexCharts(document.querySelector("#jeniskelamin"), options);
        chart.render();
        
        
        
       var options = {
          series: [{
          data: [<?php echo $bs_bayi;?>, <?php echo $bs_anak;?>, <?php echo $bs_remaja;?>, <?php echo $bs_dewasa;?>, <?php echo $bs_tua;?>, <?php echo $bs_lansia;?>]
        }],
          chart: {
          type: 'bar',
          height: 350
        },
        plotOptions: {
          bar: {
            borderRadius: 4,
            horizontal: true,
          }
        },
        dataLabels: {
          enabled: false
        },
        xaxis: {
          categories: ['Bayi 0-5 Tahun', 'Anak 6-14 Tahun', 'Remaja 15-24 Tahun', 'Dewasa 25-44 Tahun', 'Tua 45-59 Tahun', 'Lansia 60-130'
          ],
        }
        };

        var chart = new ApexCharts(document.querySelector("#usia_bansos"), options);
        chart.render();

    
  </script>
