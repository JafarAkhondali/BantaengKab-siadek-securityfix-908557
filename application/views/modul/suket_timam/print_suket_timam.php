<?php
class MYPDF extends TCPDF
{

  //Page header
  public function Header()
  {


    // Logo
    $image_file = K_PATH_IMAGES . 'logo_bantaeng.png';
    $this->Image($image_file, 27, 13, 22, '', 'PNG', '', '', false, 150, '', false, false, 0, false, false, false);
    // Set font
    $this->SetFont('times', 'B', 13);
    // Title
    $headerdata = $this->getHeaderData();
    // $isi_header='<table align="center">
    //   <tr>
    //     <td><h3>PEMERINTAH KABUPATEN BANTAENG</h3></td>
    //     </tr><tr>
    //     <td><h2>KECAMATAN '.$camat.'</h2></td>
    //     </tr><tr>
    //     <td><h1>DESA '.$desa.'</h1></td></tr><tr>
    //     <td><h5>Alamat : '.$alamat.'</h5><hr></td>
    //   </tr>

    // </table>';
    $this->writeHTML($headerdata['string']);
  }

  // Page footer
  public function Footer()
  {
  }
}

foreach ($wilayah as $wilayahs) {
  $desa = $wilayahs['nama'];
  $kdwilayah = $wilayahs['kd_wilayah'];
  $kdinduk = $wilayahs['kd_induk'];
  $klasifikasi = $wilayahs['klasifikasi'];
  $skt_desa = $wilayahs['singkatan'];
}
foreach ($cetak as $row) {
  $nik = $row['nik'];
  $perangkat_id = $row['perangkat_id'];
  if ($row['perihal_surat'] == "Lainnya") {
    $perihal = "membayar" . $row['perihal_surat'];
  } else {
    $perihal = "";
  }
}
if ($perangkat_id == "lurah") {
  $wilayah_kepala = db_get_all_data('wilayah_kepala', "kd_wilayah= $kdwilayah and banned= '0'");
  foreach ($wilayah_kepala as $kepala) {
    $nama_ttd = $kepala->nama;
    $jabatan = $kepala->jabatan;
    $nip_kepala = $kepala->nip;
  }
  if ($nip_kepala != NULL) {
    $nip = "NIP. $nip_kepala";

  } else {
    $nip = $nip_kepala;
  }
} else {
  $perangkat = db_get_all_data('wilayah_perangkat', "id = $perangkat_id");
  foreach ($perangkat as $perangkats) {
    $nama_ttd = $perangkats->nama;
    $jabatan = $perangkats->jabatan;
    $nip = $perangkats->nip;
  }
}

$pemohons = db_get_all_data('penduduk_real', "nik = $nik");
foreach ($pemohons as $row) {
  $nama_pemohon = $row->nama;
  $alamat_pemohon = $row->alamat;
  $tempat_lahir = $row->tempat_lahir;
  $date_lahir = date_create($row->tgl_lahir);
  $tanggal_lahir = date_format($date_lahir, "d - m - Y");
  $jen_peker = $row->jenis_pekerjaan;
}

$pekerjaans = db_get_all_data('setup_pekerjaan', "id_pekerjaan = $jen_peker");
foreach ($pekerjaans as $value) {
  $pekerjaan = $value->value;
}





$wilayah_profil = db_get_all_data('wilayah_profil', "kd_wilayah= $kdwilayah");
foreach ($wilayah_profil as $profils) {
  $alamat = $profils->alamat_kantor;
  $kdpos = $profils->kd_pos;
}
$wilayah_camat = db_get_all_data('wilayah', "kd_wilayah= $kdinduk");
foreach ($wilayah_camat as $wilayahcas) {
  $camat = $wilayahcas->nama;
  $skt_camat = $wilayahcas->singkatan;
}


if ($klasifikasi == "DESA") {
  $klasifikasis = "Kepala Desa";
  $klasifikasik = "DESA";
} else {
  $klasifikasis = "Lurah";
  $klasifikasik = "KELURAHAN";
}
if (strlen($desa) <= '14') {
  $k = "<h1>";
  $kt = "</h1>";
} else {
  $k = "<h3>";
  $kt = "</h3>";
}
if ($perangkat_id == "lurah") {
  $jabatan_ttd = $jabatan;
} else {
  $jabatan_ttd = "A.n  " . $klasifikasis . " " . $desa . "<br>" . $jabatan;
}


// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->setHeaderData($ln = '', $lw = 0, $ht = '', $hs = '<table align="center">
<tr>
  <td><h3>PEMERINTAH KABUPATEN BANTAENG</h3></td>
  </tr><tr>
  <td><h2>KECAMATAN ' . strtoupper($camat) . '</h2></td>
  </tr><tr>
  <td>' . $k . '' . $klasifikasik . ' ' . strtoupper($desa) . '' . $kt . '</td></tr><tr>
  <td><h5>Alamat : ' . $alamat . ' Kode Pos ' . $kdpos . '</h5><hr></td>
</tr>

</table>', $tc = array(0, 0, 0), $lc = array(0, 0, 0));
$pdf->SetTitle('Suket Tidak Mampu');
$pdf->SetMargins(26, 40, 26);
$pdf->SetHeaderMargin(10);
$pdf->setFooterMargin(26);
$pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
$pdf->SetAuthor('DISKOMINFO KAB.Bantaeng');
$pdf->SetDisplayMode('real', 'default');
$pdf->AddPage('P', 'A4');
$pdf->SetFontSize(10);
$i = 0;


foreach ($cetak as $row) {
  $date = date_create($row['tanggal_surat']);
  $day = date_format($date, "d");
  $bln = date_format($date, "m");
  $thn = date_format($date, "Y");


  switch ($bln) {
    case '1':
      $nm_bln = "Januari";
      break;
    case '2':
      $nm_bln = "Februari";
      break;
    case '3':
      $nm_bln = "Maret";
      break;
    case '4':
      $nm_bln = "April";
      break;
    case '5':
      $nm_bln = "Mei";
      break;
    case '6':
      $nm_bln = "Juni";
      break;
    case '7':
      $nm_bln = "Juli";
      break;
    case '8':
      $nm_bln = "Agustus";
      break;
    case '9':
      $nm_bln = "September";
      break;
    case '10':
      $nm_bln = "Oktober";
      break;
    case '11':
      $nm_bln = "November";
      break;
    case '12':
      $nm_bln = "Desember";
      break;
  }
  switch ($bln) {
    case '1':
      $rm_bln = "I";
      break;
    case '2':
      $rm_bln = "II";
      break;
    case '3':
      $rm_bln = "III";
      break;
    case '4':
      $rm_bln = "IV";
      break;
    case '5':
      $rm_bln = "V";
      break;
    case '6':
      $rm_bln = "VI";
      break;
    case '7':
      $rm_bln = "VII";
      break;
    case '8':
      $rm_bln = "VIII";
      break;
    case '9':
      $rm_bln = "IX";
      break;
    case '10':
      $rm_bln = "X";
      break;
    case '11':
      $rm_bln = "XI";
      break;
    case '12':
      $rm_bln = "XII";
      break;
  }

  $html = '<h4 align="center"><U>SURAT KETERANGAN TIDAK MAMPU</U> <br> Nomor:' . $row['no'] . '</h4>
            
            <table cellspacing="17">
            <tr>
              <td><p>Yang bertandatangan dibawah ini :</p></td>
              <td></td>
            </tr>
            <tr>
              <td>Nama</td>
              <td colspan="3">: ' . $nama_ttd . '</td>
            </tr>
            <tr>
            <td>Jabatan</td>
            <td colspan="3">: ' . $jabatan . '</td>
            </tr>
            <tr>
            <td>NIP</td>
            <td colspan="3">: ' . $nip_kepala . '</td><br>
            </tr>
            <tr>
              <td><p>Menerangkan bahwa :</p></td>
              <td></td>
            </tr>
            <tr>
              <td>Nama</td>
              <td colspan="3">: ' . $nama_pemohon . '</td>
            </tr>
            <tr>
            <td>Tempat/Tgl Lahir</td>
            <td colspan="3">: ' . $tempat_lahir . '/' . $tanggal_lahir . '</td>
            </tr>
            <tr>
            <td>Pekerjaan</td>
            <td colspan="3">: ' . $pekerjaan . '</td>
            </tr>
            <tr>
            <td>Alamat</td>
            <td colspan="3">: ' . $alamat_pemohon . '</td>
            </tr>
            
            
          </table>

          <p>Benar yang namanya tersebut diatas adalah Warga di ' . strtolower($klasifikasik) . ' ' . $desa . ' Kecamatan ' . $camat . ' Kabupaten Bantaeng yang Kurang Mampu <b>' . $perihal . '</b> .<br><br>Demikian surat keterangan ini diberikan untuk dipergunakan sebagaimana mestinya.<br><br>
          </p>
         <table>
         <tr> <td></td> <td> </td> <td>Bantaeng,  ' . $day . ' ' . $nm_bln . ' ' . $thn . '</td></tr><br><br>
         <tr> <td></td> <td> </td> <td>Mengetahui,</td></tr>
         <tr> <td></td><td> </td><td>' . $jabatan_ttd . '</td></tr>
         <br><br><br><br>
         <tr> <td><b><u></u></b></td><td> </td><td><b><u>' . $nama_ttd . '</u></b></td></tr>
         <tr> <td></td><td> </td><td>' . $nip . '</td></tr>
         </table>
         ';
}

$pdf->WriteHTML($html, true, false, true, false, '');
$pdf->Output('REKAP_ABSEN.pdf', 'I');
?>
<!-- <td align="right">'.number_format($row['harga_produk'],0,",",",").'</td> -->