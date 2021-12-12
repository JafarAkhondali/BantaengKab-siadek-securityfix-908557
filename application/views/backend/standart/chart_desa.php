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
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Penduduk</span>
                    <span class="info-box-number" id="total_penduduk"><?php 
          $this->db->from('penduduk_real');
          $this->db->like('kd_wilayah', get_user_data('kd_wilayah'));
		      $jumlahpdd= $this->db->count_all_results(); 
          echo $jumlahpdd;
        ?> Jiwa</span>
        </div>
            </div>
            <!-- /.info-box -->
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-male"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Laki-Laki</span>
                    <span class="info-box-number" id="total_lakilaki"><?php 
          $this->db->from('penduduk_real');
          $this->db->like('kd_wilayah', get_user_data('kd_wilayah'));
          $this->db->where('jenis_kelamin', 'laki-laki');
		      $jumlahpdd= $this->db->count_all_results(); 
          echo $jumlahpdd;
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
          $this->db->from('penduduk_real');
          $this->db->like('kd_wilayah', get_user_data('kd_wilayah'));
          $this->db->where('jenis_kelamin', 'Perempuan');
		      $jumlahpdd= $this->db->count_all_results(); 
          echo $jumlahpdd;
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
                    <span class="info-box-text">Disabilitas</span>
                    <span class="info-box-number" id="total_disabilitas">
                    <?php 
          $this->db->from('art_dtks');
          $this->db->where_in('Jenis_cacat', array('1','2','3','4','5','6','7','8','9','10','11','12'));
          $jumlahdisabiltas= $this->db->count_all_results(); 
          echo $jumlahdisabiltas;
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
      <div class="col-md-12">        
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
                        <li class=""><a href="#golongan" data-toggle="tab" aria-expanded="false" data-original-title="" title="">Usia</a></li>
                        <li class=""><a href="#profil" data-toggle="tab" aria-expanded="true" data-original-title="" title="">Golongan Darah</a></li>
                        <li class="active"><a href="#Perkawinan" data-toggle="tab" aria-expanded="false" data-original-title="" title="">Perkawinan</a></li>
                        <li class=""><a href="#keyakinan" data-toggle="tab" aria-expanded="false" data-original-title="" title="">Agama</a></li>
                    </ul>
            </div>
            <div class="tab-content">
                <div class="tab-pane " id="profil">
                <div id='golongandara'></div>
                </div>
                <div class="tab-pane" id="golongan">
                <div id='Usiah'></div>
                </div>
                <div class="tab-pane active" id="Perkawinan">
                  <div id='kawin'></div>
                </div>
                <div class="tab-pane" id="keyakinan">
                  <div id='agama'></div>
                </div>
            </div>
          </div>
          <!-- /.box -->
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
                        <!--li class=""><a href="#1" data-toggle="tab" aria-expanded="false" data-original-title="" title="">Usia</a></li-->
                       <li class="active"><a href="#3" data-toggle="tab" aria-expanded="false" data-original-title="" title="">Adminduk</a></li>
                     </ul>
            </div>
            <div class="tab-content">
                <!---div class="tab-pane" id="1">
                2
                </div-->
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
</section>
<!-- /.content -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="<?= BASE_ASSET; ?>admin-lte/plugins/morris/morris.min.js"></script>
<script>
     var donut = new Morris.Donut({
      element: 'wilayah',
      resize: true,
      colors: ["#3cbcbc","#f56954"],
      data: [
        {label: "Kelurahan", value:  
        <?php 
          $this->db->from('wilayah');
          $this->db->where('kd_induk', get_user_data('kd_wilayah'));
          $this->db->where('klasifikasi', 'KEL');
          $wilayahkel= $this->db->count_all_results(); 
          echo $wilayahkel;
        ?>},

          {label: "Desa", value: 
        <?php 
          $this->db->from('wilayah');
          $this->db->where('klasifikasi', 'DESA');
         $this->db->where('kd_induk', get_user_data('kd_wilayah'));
          $wilayahdes= $this->db->count_all_results(); 
          echo $wilayahdes;
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
          $this->db->from('penduduk_real');
          $this->db->where('verifikasi', '1');
          $this->db->where('kd_wilayah', get_user_data('kd_wilayah'));
          $wilayahkel= $this->db->count_all_results(); 
          echo $wilayahkel;
        ?>, 
        <?php 
        $this->db->from('penduduk_real');
        $this->db->where('verifikasi', '2');
        $this->db->where('kd_wilayah', get_user_data('kd_wilayah'));
        $wilayahkel= $this->db->count_all_results(); 
        echo $wilayahkel;
      ?>, <?php 
      $this->db->from('penduduk_real');
      $this->db->where('verifikasi', '3');
      $this->db->where('kd_wilayah', get_user_data('kd_wilayah'));
      $wilayahkel= $this->db->count_all_results(); 
      echo $wilayahkel;
    ?>],
          chart: {
          width: 380,
          type: 'pie',
        },
        labels: ['Verifikasi', 'Belum Verifikasi', 'Proses Verifikasi'],
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
        $this->db->from('tbl_korduk_kk');
        $this->db->where('kd_wilayah', get_user_data('kd_wilayah'));
        $kordukkk= $this->db->count_all_results(); 
        echo $kordukkk;
        ?>,  
        <?php 
        $this->db->from('tbl_korduk_ktp');
        $this->db->where('kd_wilayah', get_user_data('kd_wilayah'));
        $kordukktp= $this->db->count_all_results(); 
        echo $kordukktp;
        ?>,  
        <?php 
        $this->db->from('tbl_korduk_surat_pindah');
        $this->db->where('kd_wilayah', get_user_data('kd_wilayah'));
        $kordukpindah= $this->db->count_all_results(); 
        echo $kordukpindah;
        ?>, 
        <?php 
        $this->db->from('tbl_korduk_akta_kematian');
        $this->db->where('kd_wilayah', get_user_data('kd_wilayah'));
        $kordukmati= $this->db->count_all_results(); 
        echo $kordukmati;
        ?>, 
        <?php 
        $this->db->from('tbl_korduk_akta_kelahiran');
        $this->db->where('kd_wilayah', get_user_data('kd_wilayah'));
        $korduklahir= $this->db->count_all_results(); 
        echo $korduklahir;
        ?>, 
        <?php 
        $this->db->from('tbl_korduk_akta_pernikahan');
        $this->db->where('kd_wilayah', get_user_data('kd_wilayah'));
        $kordukkawin= $this->db->count_all_results(); 
        echo $kordukkawin;
        ?>, <?php 
        $this->db->from('tbl_korduk_akta_perceraian');
        $this->db->where('kd_wilayah', get_user_data('kd_wilayah'));
        $kordukcerai= $this->db->count_all_results(); 
        echo $kordukcerai;
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

//data penduduk Berdasarkan usiah
var options = {
          series: [{
          data: [200, 230, 348, 448, 870]
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
          categories: ['Bayi 0-5 Tahun', 'Anak 6-14 Tahun', 'Remaja 15-24', 'Dewasa 25-44', 'Tua 45-75','Lansia 75-130',
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
            $this->db->from('penduduk_real');
            $this->db->where('golongan_dara', '1');
            $golongandaraa= $this->db->count_all_results(); 
            echo $golongandaraa;
          ?>
          ,
          <?php 
            $this->db->from('penduduk_real');
            $this->db->where('golongan_dara', '2');
            $golongandarab= $this->db->count_all_results(); 
            echo $golongandarab;
          ?>, 
          <?php 
          $this->db->from('penduduk_real');
          $this->db->where('golongan_dara', '3');
          $golongandaraab= $this->db->count_all_results(); 
          echo $golongandaraab;
        ?>, 
          <?php 
          $this->db->from('penduduk_real');
          $this->db->where('golongan_dara', '4');
          $golongandarao= $this->db->count_all_results(); 
          echo $golongandarao;
        ?>, 
        <?php 
        $this->db->from('penduduk_real');
        $this->db->where('golongan_dara', '0');
        $golongandaratt= $this->db->count_all_results(); 
        echo $golongandaratt;
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
          $this->db->from('penduduk_real');
          $this->db->where('agama', '5');
          $islam= $this->db->count_all_results(); 
          echo $islam;
        ?>, 
        <?php 
          $this->db->from('penduduk_real');
          $this->db->where('agama', '1');
          $kristen= $this->db->count_all_results(); 
          echo $kristen;
        ?>, 
        <?php 
        $this->db->from('penduduk_real');
        $this->db->where('agama', '2');
        $khatolik= $this->db->count_all_results(); 
        echo $khatolik;
      ?>, <?php 
      $this->db->from('penduduk_real');
      $this->db->where('agama', '4');
      $hindu= $this->db->count_all_results(); 
      echo $hindu;
    ?>, 
    <?php 
    $this->db->from('penduduk_real');
    $this->db->where('agama', '6');
    $bdh= $this->db->count_all_results(); 
    echo $bdh;
  ?>, <?php 
  $this->db->from('penduduk_real');
  $this->db->where('agama', '3');
  $kho= $this->db->count_all_results(); 
  echo $kho;
?>, <?php 
$this->db->from('penduduk_real');
$this->db->where('agama', '7');
$ln= $this->db->count_all_results(); 
echo $ln;
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
          data: [<?php 
$this->db->from('penduduk_real');
$this->db->where('status_perkawinan', '2');
$bkawin= $this->db->count_all_results(); 
echo $bkawin;
?>, <?php 
$this->db->from('penduduk_real');
$this->db->where('status_perkawinan', '1');
$kw= $this->db->count_all_results(); 
echo $kw;
?>, <?php 
$this->db->from('penduduk_real');
$this->db->where('status_perkawinan', '3');
$ch= $this->db->count_all_results(); 
echo $ch;
?>, <?php 
$this->db->from('penduduk_real');
$this->db->where('status_perkawinan', '4');
$cm= $this->db->count_all_results(); 
echo $cm;
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
