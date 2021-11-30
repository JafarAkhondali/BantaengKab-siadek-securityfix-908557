<?php
   class MYPDF extends TCPDF {

    //Page header
    public function Header() {
     

        // Logo
        $image_file = K_PATH_IMAGES.'logo_bantaeng.png';
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
    public function Footer() {
        
    }
}

foreach($wilayah as $wilayahs){ $desa = $wilayahs['nama']; $kdwilayah = $wilayahs['kd_wilayah']; $kdinduk = $wilayahs['kd_induk']; $klasifikasi = $wilayahs['klasifikasi']; $skt_desa = $wilayahs['singkatan'];}
$wilayah_profil = db_get_all_data('wilayah_profil',"kd_wilayah= $kdwilayah");
foreach($wilayah_profil as $profils){ $alamat = $profils->alamat_kantor; $kdpos = $profils->kd_pos; }
$wilayah_camat = db_get_all_data('wilayah',"kd_wilayah= $kdinduk");
foreach($wilayah_camat as $wilayahcas){ $camat = $wilayahcas->nama; }
$wilayah_kepala = db_get_all_data('wilayah_kepala',"kd_wilayah= $kdwilayah and banned= 0");
foreach($wilayah_kepala as $kepala){ $nama_kepala = $kepala->nama;  $jabatan_kepala = $kepala->jabatan; $nip_kepala = $kepala->nip;}
$wilayah_kepala_camat = db_get_all_data('wilayah_kepala',"kd_wilayah= $kdinduk and banned= 0");
foreach($wilayah_kepala_camat as $camats){ $nama_camat = $camats->nama;  $jabatan_camat = $camats->jabatan; $nip_camat = $camats->nip;}
if($nip_kepala != NULL){ $nip ="NIP. $nip_kepala"; }else{ $nip =""; }
if($klasifikasi == "DESA"){ $klasifikasis = "Kepala Desa"; $klasifikasik = "DESA"; }else{ $klasifikasis = "Lurah"; $klasifikasik = "KELURAHAN";}
if(strlen($desa) <= '14'){ $k = "<h1>"; $kt = "</h1>"; }else{ $k = "<h3>"; $kt = "</h3>"; }

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->setHeaderData($ln='', $lw=0, $ht='', $hs='<table align="center">
<tr>
  <td><h3>PEMERINTAH KABUPATEN BANTAENG</h3></td>
  </tr><tr>
  <td><h2>KECAMATAN '.strtoupper($camat).'</h2></td>
  </tr><tr>
  <td>'.$k.''.$klasifikasik.' '.strtoupper($desa).''.$kt.'</td></tr><tr>
  <td><h5>Alamat : '.$alamat.' Kode Pos '.$kdpos.'</h5><hr></td>
</tr>

</table>', $tc=array(0,0,0), $lc=array(0,0,0));
    $pdf->SetTitle('Suket Domisili');
    $pdf->SetMargins(26, 40, 26);
    $pdf->SetHeaderMargin(10);
    $pdf->setFooterMargin(26);
    $pdf->SetAutoPageBreak(true,PDF_MARGIN_BOTTOM);
    $pdf->SetAuthor('DISKOMINFO KAB.Bantaeng');
    $pdf->SetDisplayMode('real', 'default');
    $pdf->AddPage('P', 'A4');
    $pdf->SetFontSize(10);
    $i=0;
    
  
    foreach($cetak as $row){
      $date = date_create($row['tanggal_surat']);
      $day = date_format($date,"d");
      $bln = date_format($date,"m");
      $thn = date_format($date,"Y");
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

$agama = setup_get_data('setup_agama',$row['agama']);
    
            $html='<h4 align="center"><U>SURAT KETERANGAN DOMISILI</U> <br> Nomor:'.$row['no'].'</h4>
            <p>Yang bertandatangan dibawah ini '.$klasifikasis.' '.$desa.' Kecamatan '.$camat.' Kabupaten Bantaeng, menerangkan bahwa:</p>
            <table cellspacing="17">
            <tr>
              <td>Nama</td>
              <td colspan="3">: '.$row['nama'].'</td>
            </tr>
            <tr>
            <td>Tempat/Tgl Lahir</td>
            <td colspan="3">: '.$row['tmpt_lahir'].'/'.$row['tgl_lahir'].'</td>
            </tr>
            <tr>
            <td>NIK</td>
            <td colspan="3">: '.$row['nik'].'</td>
            </tr>
            <tr>
            <td>Agama</td>
            <td colspan="3">: '.$agama.'</td>
            </tr>
            <tr>
            <td>Pekerjaan</td>
            <td colspan="3">: '.$row['pekerjaan'].'</td>
            </tr>
            <tr>
            <td>Alamat</td>
            <td colspan="3">: '.$row['alamat'].'</td>
            </tr>
            
            
          </table>

          <p>Bahwa yang tersebut namanya di atas adalah benar penduduk  yang berdomisili atau bertempat tinggal di '.strtolower($klasifikasik).' '.$desa.' Kecamatan '.$camat.' Kabupaten Bantaeng, data yang diatas adalah data yang benar sesuai dengan <b>“'.$row['bukti_surat'].'”</b>  dan mempunyai hubungan baik  dengan masyarakat sekitarnya.<br><br>Demikian surat keterangan ini diberikan untuk dipergunakan sebagaimana mestinya.
          </p>
         <table>
         <tr> <td></td> <td> </td> <td>Bantaeng,  '.$day.' '.$nm_bln.' '.$thn.'</td></tr><br><br>
         <tr> <td>Mengetahui,</td> <td> </td> <td></td></tr>
         <tr> <td>Camat '.$camat.'</td><td> </td><td>'.$klasifikasis.' '.$desa.'</td></tr>
         <br><br><br><br>
         <tr> <td><b><u>'.$nama_camat.'</u></b></td><td> </td><td><b><u>'.$nama_kepala.'</u></b></td></tr>
         <tr> <td>NIP. '.$nip_camat.'</td><td> </td><td>'.$nip.'</td></tr>
         </table>
         ';
            
    }    
               
    $pdf->WriteHTML($html, true, false, true, false, '');
    $pdf->Output('SUKET DOMISILI.pdf', 'I');
?>
<!-- <td align="right">'.number_format($row['harga_produk'],0,",",",").'</td> -->