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
             
    <form name="form_dashboard" id="form_dashboard" action="<?= base_url('administrator/kesehatan/index'); ?>" method="get">
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
    
     <div class="row">              
     <div class="col-md-12">   
            <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Puskesmas</span>
                     <span class="info-box-number" id="total_penduduk"><?php 
                      echo number_format($hit_puskesmas,0,"",".");
                    ?> Puskesmas </span>
                </div>
            </div>
        </div>
        
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Posyandu</span>
                     <span class="info-box-number" id="total_penduduk"><?php 
                      echo number_format($hit_posyandu,0,"",".");
                    ?> Posyandu </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">   
            <div class="col-md-8 col-sm-12 col-xs-12">
            <div class="info-box">
                <div id="stunting">
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-12 col-xs-12">
            <div class="info-box">
                <div id="stunting_jk">
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">   
            <div class="col-md-8 col-sm-12 col-xs-12">
            <!-- <div class="info-box">
                <div id="stunting">
                </div>
            </div> -->
        </div>
        <div class="col-md-4 col-sm-12 col-xs-12">
            <div class="info-box">
                <div id="vaksinasi">
                </div>
            </div>
        </div>
    </div>
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
 var options = {
          series: [<?php echo db_get_all_data_count('view_vaksinasi',"dosis ='Sudah'");  ?>, 
          <?php echo db_get_all_data_count('view_vaksinasi',"dosis ='belum'");  ?>],
          chart: {
          width: '100%',
          type: 'pie',
        },
        labels: ["Sudah", "Belum"],
        theme: {
          monochrome: {
            enabled: false
          }
        },
        plotOptions: {
          pie: {
            dataLabels: {
              offset: -5
            }
          }
        },
        title: {
          text: "Vaksinasi"
        },
        dataLabels: {
          formatter(val, opts) {
            const name = opts.w.globals.labels[opts.seriesIndex]
            return [name, val.toFixed(1) + '%']
          }
        },
        legend: {
          show: false
        }
        };

        var chart = new ApexCharts(document.querySelector("#vaksinasi"), options);
        chart.render();
</script>
<script>
 var options = {
          series: [25, 15],
          chart: {
          width: '100%',
          type: 'pie',
        },
        labels: ["Laki-Laki", "Perempuan"],
        theme: {
          monochrome: {
            enabled: true
          }
        },
        plotOptions: {
          pie: {
            dataLabels: {
              offset: -5
            }
          }
        },
        title: {
          text: "Stunting Berdasarkan Jenis Kelamin"
        },
        dataLabels: {
          formatter(val, opts) {
            const name = opts.w.globals.labels[opts.seriesIndex]
            return [name, val.toFixed(1) + '%']
          }
        },
        legend: {
          show: false
        }
        };

        var chart = new ApexCharts(document.querySelector("#stunting_jk"), options);
        chart.render();
</script>
<script>
        var options = {
          series: [{
            name: "Session Duration",
            data: [45, 52, 38, 24, 33, 26, 21, 20, 6, 8, 15, 10]
          },
         
        ],
          chart: {
          height: 350,
          type: 'line',
          zoom: {
            enabled: false
          },
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          width: [5, 7, 5],
          curve: 'straight',
          dashArray: [0, 8, 5]
        },
        title: {
          text: 'Data Stunting Perbulan Kabupaten Bantaeng',
          align: 'left'
        },
        legend: {
          tooltipHoverFormatter: function(val, opts) {
            return val + ' - ' + opts.w.globals.series[opts.seriesIndex][opts.dataPointIndex] + ''
          }
        },
        markers: {
          size: 0,
          hover: {
            sizeOffset: 6
          }
        },
        xaxis: {
          categories: ['Jan', 'Feb', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'agust', 'Sep',
            'okt', 'Nov', 'Des'
          ],
        },
        tooltip: {
          y: [
            {
              title: {
                formatter: function (val) {
                  return val + " (mins)"
                }
              }
            },
            {
              title: {
                formatter: function (val) {
                  return val + " per session"
                }
              }
            },
            {
              title: {
                formatter: function (val) {
                  return val;
                }
              }
            }
          ]
        },
        grid: {
          borderColor: '#f1f1f1',
        }
        };

        var chart = new ApexCharts(document.querySelector("#stunting"), options);
        chart.render();
        

</script>