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
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Penduduk</span>
                     <span class="info-box-number" id="total_penduduk"><?php 
                      echo number_format($penduduk,0,"",".");
                    ?> Jiwa</span>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-male"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Laki-Laki</span>
                    <span class="info-box-number" id="total_lakilaki"><?php 
        
            		  echo number_format($pend_laki,0,"",".");
                    ?> Jiwa</span>
                                    </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-female"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Perempuan</span>
                    <span class="info-box-number" id="total_perempuan"><?php  
                      echo number_format($pend_perem,0,"",".");
                    ?> Jiwa</span>
                                    </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span><img src="<?php echo base_url()?>uploads/cacat_logo.png" style="width:90px;height:90px;float:left;">
                    <!-- <i class="fa fa-wheelchair"></i> --></span>

                <div class="info-box-content">
                    <span class="info-box-text">Lansia</span>
                    <span class="info-box-number" id="total_disabilitas">
                    <?php 
          echo number_format($pend_lansia,0,"",".");
        ?></span>
                                    </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>
        <!-- /.col -->
        <!-- /.col -->
    </div>
     <div class="row">
      <div class="col-md-9">        
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Penduduk</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class=""><a href="#usia" data-toggle="tab" aria-expanded="false" data-original-title="" title="">Usia</a></li>
                        <li class=""><a href="#golongan" data-toggle="tab" aria-expanded="true" data-original-title="" title="">Golongan Darah</a></li>
                        <li class="active"><a href="#Perkawinan" data-toggle="tab" aria-expanded="false" data-original-title="" title="">Perkawinan</a></li>
                        <li class=""><a href="#keyakinan" data-toggle="tab" aria-expanded="false" data-original-title="" title="">Agama</a></li>
                        <li class=""><a href="#pendidikanterakhir" data-toggle="tab" aria-expanded="false" data-original-title="" title="">Pendidikan</a></li>
                    </ul>
            </div>
            <div class="tab-content">
                <div class="tab-pane " id="usia">
                <div id='Usiah'></div>
                </div>
                <div class="tab-pane" id="golongan">
                <div id='golongandara'></div>
                </div>
                <div class="tab-pane active" id="Perkawinan">
                  <div id='kawin'></div>
                </div>
                <div class="tab-pane" id="keyakinan">
                  <div id='agama'></div>
                </div>
                <div class="tab-pane" id="pendidikanterakhir">
                  <div id='pendidikanterakhir'></div>
                </div>
            </div>
          </div>
          <!-- /.box -->
        </div>
  

        <div class="col-md-3">        
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Data Wilayah</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body chart-responsive">
              <div class="chart" id="wilayah" style="height: 300px; position: relative;"></div>
            </div>
          </div>
        </div>



        <div class="col-md-9">        
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Layanan Adminduk</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class=""><a href="#1" data-toggle="tab" aria-expanded="false" data-original-title="" title="">Layanan Umum</a></li>
                       <li class="active"><a href="#3" data-toggle="tab" aria-expanded="false" data-original-title="" title="">Adminduk</a></li>
                     </ul>
            </div>
            <div class="tab-content">
                <div class="tab-pane" id="1">
                    <div id='layanan'></div>
                </div>
                <div class="tab-pane active" id="3">
                <div id='admiinduk'></div>
                </div>
            </div>
          </div>
          <!-- /.box -->
        </div>
        <div class="col-md-3">        
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Verifikasi Nik Penduduk</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body chart-responsive">
              <div class="chart" id="verifikasi" style="height: 300px; position: relative;"></div>
            </div>
          </div>
        </div>
        </div> 
        </form>
</section>
<!-- /.content -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="<?= BASE_ASSET; ?>admin-lte/plugins/morris/morris.min.js"></script>
<script>

var options = {
          series: [ <?php 
            echo $l_b_proses;
          ?>, <?php 
            echo $l_tolak;
          ?>, <?php  
            echo $l_proses;
          ?>, <?php  
            echo $l_selesai;
          ?>, <?php  
            echo $l_serah;
          ?>],
          chart: {
          width: 380,
          type: 'pie',
        },
        labels: ['Belum Proses', 'Ditolak', 'Berkas Diproses', 'Selesai Dibuat', 'Telah Diserahkan'],
        responsive: [{
          breakpoint: 20,
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

        var chart = new ApexCharts(document.querySelector("#layanan"), options);
        chart.render();
        
        

     var donut = new Morris.Donut({
      element: 'wilayah',
      resize: true,
      colors: ["#3cbcbc","#f56954","#44e800"],
      data: [
        {label: "Kelurahan", value:  
        <?php 
          $this->db->from('wilayah');
          $this->db->like('klasifikasi', 'KEL');
          $wilayahkel= $this->db->count_all_results(); 
          echo $wilayahkel;
        ?>},

          {label: "Desa", value: 
        <?php 
          $this->db->from('wilayah');
          $this->db->where('klasifikasi', 'DESA');
          $wilayahdes= $this->db->count_all_results(); 
          echo $wilayahdes;
        ?>},

        {label: "Kecamatan", value: 
        <?php 
          $this->db->from('wilayah');
          $this->db->where('kd_induk', '7303');
          $wilayahkec= $this->db->count_all_results(); 
          echo $wilayahkec;
        ?>}
        
      ],
      hideHover: 'auto'
    });

</script>

<script>

//verifikasi penduduk   
var options = {
          series: [
          <?php 
          echo $v_v;
        ?>, 
        <?php 
        echo $v_b;
      ?>, <?php  
      echo $v_p;
    ?>],
          chart: {
          width: 380,
          type: 'pie',
        },
        labels: ['TerVerifikasi', 'Belum Verifikasi', 'Proses Verifikasi'],
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

        var chart = new ApexCharts(document.querySelector("#verifikasi"), options);
        chart.render();
      
//admin induk
var options = {
        series: [{
        data: [
        <?php 
          echo $kor_kk;
          ?>,  
         <?php 
          echo $kor_ktp;
          ?>,  
        <?php 
        echo $kor_sp;
        ?>, 
        <?php 
       echo $kor_kematian;
        ?>, 
        <?php 
       echo $kor_kelahiran;
        ?>, 
        <?php 
       echo $kor_pernikahan;
        ?>, <?php 
       echo $kor_perceraian;
        ?>]
        }],
          chart: {
          type: 'bar',
          height: 280
        },
        title: {
            text: 'adminduk',
            align: 'center',
            floating: true
        },
        plotOptions: {
          bar: {
            horizontal: true,
          }
        },
        dataLabels: {
          enabled: false
        },
        xaxis: {
          categories: ['KK', 'KTP', 'Surat Pindah', 'Akta Kematian', 'Akta Kelahiran', 'Akta Perkawinan', 'Akta Perceraian',
          ],
        }
        };
        var chart = new ApexCharts(document.querySelector("#admiinduk"), options);
        chart.render();

//data penduduk Berdasarkan usia
var options = {
          series: [{
          data: [<?php echo $u_bayi; ?>,<?php echo $u_anak; ?>, <?php echo $u_remaja; ?>, <?php echo $u_dewasa; ?>, <?php echo $u_tua; ?>, <?php echo $u_lansia; ?>]
        }],
          chart: {
          type: 'bar',
          height: 280
        },
        title: {
            text: 'Jumlah Penduduk Berdasarkan Usia',
            align: 'center',
            floating: true
        },
        plotOptions: {
          bar: {
            horizontal: true,
          }
        },
        dataLabels: {
          enabled: false
        },
        xaxis: {
          categories: ['Bayi 0-5 Tahun', 'Anak 6-14 Tahun', 'Remaja 15-24', 'Dewasa 25-44', 'Tua 45-59','Lansia 60-130',
          ],
        }
        };

        var chart = new ApexCharts(document.querySelector("#Usiah"), options);
        chart.render();

//data penduduk Berdasarkan Golongan Dara
var options = {
          series: [{
          data: [ 
            <?php  
            echo $g_a;
          ?>,
          <?php 
            echo $g_b;
          ?>, 
          <?php 
          echo $g_ab;
          ?>, 
          <?php 
          echo $g_o;
          ?>, 
          <?php 
          echo $g_tt;
          ?>]
        }],
          chart: {
          type: 'bar',
          height: 280
        },
        title: {
            text: 'Jumlah Penduduk Berdasarkan Golongan Dara',
            align: 'center',
            floating: true
        },
        plotOptions: {
          bar: {
            horizontal: true,
          }
        },
        dataLabels: {
          enabled: false
        },
        xaxis: {
          categories: ['A', 'AB', 'O', 'B', 'Tidak Tahu'
          ],
        }
        };

        var chart = new ApexCharts(document.querySelector("#golongandara"), options);
        chart.render();
  //data penduduk Berdasarkan Agama
  var options = {
          series: [{
          data: [
          <?php 
          echo $a_i;
        ?>, 
        <?php 
          echo $a_kp;
        ?>, 
        <?php  
        echo $a_kk;
        ?>, <?php 
        echo $a_h;
        ?>, 
        <?php  
        echo $a_b;
        ?>, 
        <?php  
        echo $a_khc;
        ?>, 
        <?php  
        echo $a_l;
        ?>]
        }],
          chart: {
          type: 'bar',
          height: 300
        },
        plotOptions: {
          bar: {
            barHeight: '100%',
            distributed: true,
            horizontal: true,
            dataLabels: {
              position: 'bottom'
            },
          }
        },
        colors: ['#00a65a','#f39c12','#33b2df', '#546E7A', '#d4526e', '#13d8aa', '#A5978B'
        ],
        dataLabels: {
          enabled: true,
          textAnchor: 'start',
          style: {
            colors: ['#000']
          },
          formatter: function (val, opt) {
            return opt.w.globals.labels[opt.dataPointIndex] + ":  " + val
          },
          offsetX: 0,
          dropShadow: {
            enabled: true
          }
        },
        stroke: {
          width: 1,
          colors: ['#fff']
        },
        xaxis: {
          categories: ['SD', 'SLTP', 'SLTA', 'D3','D4/S1', 'S2','Lainya'
          ],
        },
        yaxis: {
          labels: {
            show: false
          }
        },
        title: {
            text: 'Jumlah Penduduk Berdasarkan pendidikan terakhir',
            align: 'center',
            floating: true
        },
        subtitle: {
            text: 'Total',
            align: 'center',
        },
        tooltip: {
          theme: 'dark',
          x: {
            show: false
          },
          y: {
            title: {
              formatter: function () {
                return ''
              }
            }
          }
        }
        };

        var chart = new ApexCharts(document.querySelector("#pendidikanterakhir"), options);
        chart.render();



  //data penduduk Berdasarkan Agama
  var options = {
          series: [{
          data: [
          <?php 
          echo $a_i;
        ?>, 
        <?php 
          echo $a_kp;
        ?>, 
        <?php  
        echo $a_kk;
        ?>, <?php 
        echo $a_h;
        ?>, 
        <?php  
        echo $a_b;
        ?>, 
        <?php  
        echo $a_khc;
        ?>, 
        <?php  
        echo $a_l;
        ?>]
        }],
          chart: {
          type: 'bar',
          height: 300
        },
        plotOptions: {
          bar: {
            barHeight: '100%',
            distributed: true,
            horizontal: true,
            dataLabels: {
              position: 'bottom'
            },
          }
        },
        colors: ['#00a65a','#f39c12','#33b2df', '#546E7A', '#d4526e', '#13d8aa', '#A5978B'
        ],
        dataLabels: {
          enabled: true,
          textAnchor: 'start',
          style: {
            colors: ['#000']
          },
          formatter: function (val, opt) {
            return opt.w.globals.labels[opt.dataPointIndex] + ":  " + val
          },
          offsetX: 0,
          dropShadow: {
            enabled: true
          }
        },
        stroke: {
          width: 1,
          colors: ['#fff']
        },
        xaxis: {
          categories: ['Islam', 'Kristen', 'Kahtolik', 'Hindu','Budha', 'Khonghucu','Lainya'
          ],
        },
        yaxis: {
          labels: {
            show: false
          }
        },
        title: {
            text: 'Jumlah Penduduk Berdasarkan Agama',
            align: 'center',
            floating: true
        },
        subtitle: {
            text: 'Total',
            align: 'center',
        },
        tooltip: {
          theme: 'dark',
          x: {
            show: false
          },
          y: {
            title: {
              formatter: function () {
                return ''
              }
            }
          }
        }
        };

        var chart = new ApexCharts(document.querySelector("#agama"), options);
        chart.render();


        //data penduduk Berdasarkan Perkawinan
  var options = {
          series: [{
          data: [
          <?php 
          echo $k_belum;
          ?>, 
          <?php 
          echo $k_k;
          ?>, 
          <?php 
          echo $k_ch;
          ?>, 
          <?php 
          echo $k_cm;
          ?>]
        }],
          chart: {
          type: 'bar',
          height: 280
        },
        plotOptions: {
          bar: {
            barHeight: '100%',
            distributed: true,
            horizontal: true,
            dataLabels: {
              position: 'bottom'
            },
          }
        },
        colors: ['#00a65a','#f39c12','#33b2df', '#546E7A'
        ],
        dataLabels: {
          enabled: true,
          textAnchor: 'start',
          style: {
            colors: ['#000']
          },
          formatter: function (val, opt) {
            return opt.w.globals.labels[opt.dataPointIndex] + ":  " + val
          },
          offsetX: 0,
          dropShadow: {
            enabled: true
          }
        },
        stroke: {
          width: 1,
          colors: ['#fff']
        },
        xaxis: {
          categories: ['Belum Kawin', 'Kawin', 'Cerai Hidup', 'Cerai Mati'
          ],
        },
        yaxis: {
          labels: {
            show: false
          }
        },
        title: {
            text: 'Jumlah Penduduk Berdasarkan Perkawinan',
            align: 'center',
            floating: true
        },
        subtitle: {
            text: 'Total',
            align: 'center',
        },
        tooltip: {
          theme: 'dark',
          x: {
            show: false
          },
          y: {
            title: {
              formatter: function () {
                return ''
              }
            }
          }
        }
        };
        var chart = new ApexCharts(document.querySelector("#kawin"), options);
        chart.render();
  </script>
