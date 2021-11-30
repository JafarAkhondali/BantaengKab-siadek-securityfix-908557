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
                    <span class="info-box-text">Ruang Belajar</span>
                     <span class="info-box-number" id="total_penduduk">1</span>
                </div>
            </div>
        </div>

        
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Ruang Lab</span>
                     <span class="info-box-number" id="total_penduduk">2</span>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Ruang Kelas</span>
                     <span class="info-box-number" id="total_penduduk">2</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Pegawai</span>
                     <span class="info-box-number" id="total_penduduk">2</span>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Guru</span>
                     <span class="info-box-number" id="total_penduduk">2</span>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Peserta Didik</span>
                     <span class="info-box-number" id="total_penduduk">2</span>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-male"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Peserta Didik Laki-Laki</span>
                     <span class="info-box-number" id="total_penduduk">11</span>
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
                    <span class="info-box-text">Peserta Didik Perempuan</span>
                                    </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Negeri</span>
                     <span class="info-box-number" id="total_penduduk">11</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Swasta</span>
                     <span class="info-box-number" id="total_penduduk">11</span>
                </div>
            </div>
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span><img src="<?php echo base_url()?>uploads/cacat_logo.png" style="width:90px;height:90px;float:left;">
                    <!-- <i class="fa fa-wheelchair"></i> --></span>

                <div class="info-box-content">
                    <span class="info-box-text">Ruang Perpus</span>
                    <span class="info-box-number" id="total_disabilitas">
                    12</span>
                                    </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        
        
        <div class="col-md-12 col-sm-6 col-xs-12">
            <div class="info-box">
                <div class="info-box-content">
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
</form>
</section>
<!-- /.content -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="<?= BASE_ASSET; ?>admin-lte/plugins/morris/morris.min.js"></script>
<script>
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
          1, 
        1, 1],
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
     1,  
        1,  
        1, 
        1, 
        1, 
        1, 1]
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
          data: [1,1,1,1,1,1]
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

  </script>
