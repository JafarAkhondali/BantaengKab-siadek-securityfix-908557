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
             
    <form name="form_dashboard" id="form_dashboard" action="<?= base_url('administrator/Pengaduan/index'); ?>" method="get">
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
            <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total Aduan : <?php 
                      echo number_format($total_aduan,0,"",".");
                    ?></span>
                     <span class="info-box-number" id="total_penduduk"></span>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 col-sm-4col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Diproses : <?php 
                      echo number_format($total_proses,0,"",".");
                    ?> </span>
                     <span class="info-box-number" id="total_penduduk"></span>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 col-sm-4col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Selesai : <?php 
                      echo number_format($total_proses,0,"",".");
                    ?> </span>
                     <span class="info-box-number" id="total_penduduk"></span>
                </div>
            </div>
        </div>
      </div>
      
           <div class="row">
      <div class="col-md-12">        
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Grafik Aspirasi Dan Aduan Warga</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class=""><a href="#usia" data-toggle="tab" aria-expanded="false" data-original-title="" title="">Periode</a></li>
                        <li class="active"><a href="#Perkawinan" data-toggle="tab" aria-expanded="false" data-original-title="" title="">Jenis</a></li>
                        <li class=""><a href="#keyakinan" data-toggle="tab" aria-expanded="false" data-original-title="" title="">Jenis Kelamin</a></li>
                    </ul>
            </div>
            <div class="tab-content">
                <div class="tab-pane " id="usia">
                <div id='periode'></div>
                </div>
                <div class="tab-pane active" id="Perkawinan">
                  <div id='aduan'></div>
                </div>
                <div class="tab-pane" id="keyakinan">
                    <div class="col-lg-6">
                  <div id='jenisaduan'></div>
                  </div>
                   <div class="col-lg-6">
                  <div id='jeniskelamin'></div>
                  </div>
                </div>
            </div>
          </div>
          <!-- /.box -->
        </div>
  
        
        </div>
      </div>
      <!-- /.row -->
</section>
<!-- /.content -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="<?= BASE_ASSET; ?>admin-lte/plugins/morris/morris.min.js"></script>
<script>
        var options = {
          series: [{
          name: 'Jumlah',
          data: [
            <?php echo number_format($jenis_aduan1); ?>,
            <?php echo ($jenis_aduan2); ?>,
            <?php echo number_format($jenis_aduan3); ?>,
            <?php echo number_format($jenis_aduan4); ?>,
            <?php echo number_format($jenis_aduan5); ?>,
            <?php echo number_format($jenis_aduan6); ?>,
            <?php echo number_format($jenis_aduan7); ?>,
            <?php echo number_format($jenis_aduan8); ?>,
            <?php echo number_format($jenis_aduan9); ?>,
            <?php echo number_format($jenis_aduan10); ?>,
            <?php echo number_format($jenis_aduan11); ?>,
            <?php echo number_format($jenis_aduan12); ?>,
            <?php echo number_format($jenis_aduan13); ?>,
            <?php echo number_format($jenis_aduan14); ?>,
            <?php echo number_format($jenis_aduan15); ?>,
            <?php echo number_format($jenis_aduan16); ?>,
            <?php echo number_format($jenis_aduan17); ?>,
            <?php echo number_format($jenis_aduan18); ?>]
        }],
          chart: {
          height: 350,
          type: 'bar',
        },
        plotOptions: {
          bar: {
            borderRadius: 10,
            dataLabels: {
              position: 'top', // top, center, bottom
            },
          }
        },
        dataLabels: {
          enabled: true,
          formatter: function (val) {
            return val;
          },
          offsetY: -20,
          style: {
            fontSize: '12px',
            colors: ["#304758"]
          }
        },
        
        xaxis: {
          categories: ["Administrasi", "Kesehatan", "Disabilitas", "Lansia", "Perlindungan Sosial", "Infrastruktur", "Pengembangan Ekonomi", "Pemberdayaan Perempuan", "Penataan lingkungan", "Pertanian", "Perikanan", "Peningkatan Insentif", "Kepemudaan", "kegiatan keagamaan", "Pelayanan Masyarakat", "Pendidikan", "Penguatan BPD", "Lainya"],
          position: 'top',
          axisBorder: {
            show: false
          },
          axisTicks: {
            show: false
          },
          crosshairs: {
            fill: {
              type: 'gradient',
              gradient: {
                colorFrom: '#D8E3F0',
                colorTo: '#BED1E6',
                stops: [0, 100],
                opacityFrom: 0.4,
                opacityTo: 0.5,
              }
            }
          },
          tooltip: {
            enabled: true,
          }
        },
        yaxis: {
          axisBorder: {
            show: false
          },
          axisTicks: {
            show: false,
          },
          labels: {
            show: false,
            formatter: function (val) {
              return val + " orang";
            }
          }
        
        },
        title: {
          text: 'Data Aspirasi, 2021',
          floating: true,
          offsetY: 330,
          align: 'center',
          style: {
            color: '#444'
          }
        }
        };

        var chart = new ApexCharts(document.querySelector("#aduan"), options);
        chart.render();
</script>
<script>
      //periode
        var options = {
          series: [{
          name: 'Aduan',
          data: [<?php echo number_format($total_periode1); ?>,
          <?php echo number_format($total_periode2); ?>,
          <?php echo number_format($total_periode3); ?>,
          <?php echo number_format($total_periode4); ?>,
          <?php echo number_format($total_periode5); ?>,
          <?php echo number_format($total_periode6); ?>,
          <?php echo number_format($total_periode7); ?>,
          <?php echo number_format($total_periode8); ?>,
          <?php echo number_format($total_periode9); ?>,
          <?php echo number_format($total_periode10); ?>,
          <?php echo number_format($total_periode11); ?>,
          <?php echo number_format($total_periode12); ?>,
          ]
        }, {
          name: 'Aspirasi',
          data: [<?php echo number_format($total_periode1); ?>,
          <?php echo number_format($total_periode2); ?>,
          <?php echo number_format($total_periode3); ?>,
          <?php echo number_format($total_periode4); ?>,
          <?php echo number_format($total_periode5); ?>,
          <?php echo number_format($total_periode6); ?>,
          <?php echo number_format($total_periode7); ?>,
          <?php echo number_format($total_periode8); ?>,
          <?php echo number_format($total_periode9); ?>,
          <?php echo number_format($total_periode10); ?>,
          <?php echo number_format($total_periode11); ?>,
          <?php echo number_format($total_periode12); ?>,]
        }],
          chart: {
          type: 'bar',
          height: 350
        },
        plotOptions: {
          bar: {
            horizontal: false,
            columnWidth: '55%',
            endingShape: 'rounded'
          },
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          show: true,
          width: 2,
          colors: ['transparent']
        },
        xaxis: {
          categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Des'],
        },
        yaxis: {
          title: {
            text: '$ (Data Aduan Perperiode)'
          }
        },
        fill: {
          opacity: 1
        },
        tooltip: {
          y: {
            formatter: function (val) {
              return   val 
            }
          }
        }
        };

        var chart = new ApexCharts(document.querySelector("#periode"), options);
        chart.render();
</script>

<script>
//jenis pie
        var options = {
          series: [
            <?php echo number_format($jenis_aduan1); ?>,
            <?php echo number_format($jenis_aduan2); ?>,
            <?php echo number_format($jenis_aduan3); ?>,
            <?php echo number_format($jenis_aduan4); ?>,
            <?php echo number_format($jenis_aduan5); ?>,
            <?php echo number_format($jenis_aduan6); ?>,
            <?php echo number_format($jenis_aduan7); ?>,
            <?php echo number_format($jenis_aduan8); ?>,
            <?php echo number_format($jenis_aduan9); ?>,
            <?php echo number_format($jenis_aduan10); ?>,
            <?php echo number_format($jenis_aduan11); ?>,
            <?php echo number_format($jenis_aduan12); ?>,
            <?php echo number_format($jenis_aduan13); ?>,
            <?php echo number_format($jenis_aduan14); ?>,
            <?php echo number_format($jenis_aduan15); ?>,
            <?php echo number_format($jenis_aduan16); ?>,
            <?php echo number_format($jenis_aduan17); ?>],
          chart: {
          width: 600,
          type: 'pie',
        },
        labels: ['Administrasi', 'Kesehatan', 'Disabilitas', 'Lansia', 'Perlindungan Sosial', 'Infrastruktur', 'Pengembangan Ekonomi', 'Pemberdayaan Perempuan', 'Penataan lingkungan', 'Pertanian', 'Perikanan', 'Peningkatan Insentif', 'Kepemudaan', 'Pelayanan Masyarakat', 'Pendidikan', 'Penguatan BPD', 'kegiatan keagamaan', 'Lainya'],
        responsive: [{
          breakpoint: 680,
          options: {
            chart: {
              width: 500
            },
            legend: {
              position: 'bottom'
            }
          }
        }]
        };

        var chart = new ApexCharts(document.querySelector("#jenisaduan"), options);
        chart.render();
</script>
<script>
      //jenis kelamin
        var options = {
          series: [{
          name: 'Aduan',
          data: [44, 44]
        }],
          chart: {
          type: 'bar',
          height: 350
        },
        plotOptions: {
          bar: {
            horizontal: false,
            columnWidth: '55%',
            endingShape: 'rounded'
          },
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          show: true,
          width: 2,
          colors: ['transparent']
        },
        xaxis: {
          categories: ['Laki-Laki', 'Perempuan'],
        },
        yaxis: {
          title: {
            text: 'Jumlah (Jiwa)'
          }
        },
        fill: {
          opacity: 1
        },
        tooltip: {
          y: {
            formatter: function (val) {
              return "Jumlah " + val + " Jiwa"
            }
          }
        }
        };

        var chart = new ApexCharts(document.querySelector("#jeniskelamin"), options);
        chart.render();
</script>