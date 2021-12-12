<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Dashboard Controller
*| --------------------------------------------------------------------------
*| For see your board
*|
*/
class Pusatdata extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();
	    $this->load->model('model_dasboard');
	}

    public function index(){

    $datas = array(
		"token" => "9876543210",
		"user" => "infokom",
		
	);
	 $ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, 'http://10.73.3.200:8182/silacak/public/api/v1/layanan/umum/aggregate');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($datas));
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/json')); 
	$result = curl_exec($ch);
	$respon = json_decode($result,true);

		




     $data['l_b_proses'] = $respon['0']['response']['data']['0']['belum_proses'];
     $data['l_tolak'] = $respon['0']['response']['data']['0']['ditolak'];
     $data['l_proses'] = $respon['0']['response']['data']['0']['berkas_diproses'];
     $data['l_selesai'] = $respon['0']['response']['data']['0']['selesai_dibuat'];
     $data['l_serah'] = $respon['0']['response']['data']['0']['telah_diserahkan'];

     $data['penduduk'] = $this->model_dasboard->count_penduduk();
     $data['pend_laki'] = $this->model_dasboard->pend_laki();
     $data['pend_perem'] = $this->model_dasboard->pend_perem();
     $data['pend_lansia'] = $this->model_dasboard->pend_lansia();
     $data['u_bayi'] = $this->model_dasboard->u_bayi();
     $data['u_anak'] = $this->model_dasboard->u_anak();
     $data['u_remaja'] = $this->model_dasboard->u_remaja();
     $data['u_dewasa'] = $this->model_dasboard->u_dewasa();
     $data['u_tua'] = $this->model_dasboard->u_tua();
     $data['u_lansia'] = $this->model_dasboard->u_lansia();
     $data['g_a'] = $this->model_dasboard->g_a();
     $data['g_b'] = $this->model_dasboard->g_b();
     $data['g_ab'] = $this->model_dasboard->g_ab();
     $data['g_o'] = $this->model_dasboard->g_o();
     $data['g_tt'] = $this->model_dasboard->g_tt();
     $data['k_belum'] = $this->model_dasboard->k_belum();
     $data['k_k'] = $this->model_dasboard->k_k();
     $data['k_ch'] = $this->model_dasboard->k_ch();
     $data['k_cm'] = $this->model_dasboard->k_cm();
     $data['a_i'] = $this->model_dasboard->a_i();
     $data['a_b'] = $this->model_dasboard->a_b();
     $data['a_h'] = $this->model_dasboard->a_h();
     $data['a_kk'] = $this->model_dasboard->a_kk();
     $data['a_kp'] = $this->model_dasboard->a_kp();
     $data['a_khc'] = $this->model_dasboard->a_khc();
     $data['a_l'] = $this->model_dasboard->a_l();
     $data['v_v'] = $this->model_dasboard->v_v();
     $data['v_b'] = $this->model_dasboard->v_b();
     $data['v_p'] = $this->model_dasboard->v_p();
     $data['kor_kk'] = $this->model_dasboard->kor_kk();
     $data['kor_ktp'] = $this->model_dasboard->kor_ktp();
     $data['kor_kelahiran'] = $this->model_dasboard->kor_kelahiran();
     $data['kor_kematian'] = $this->model_dasboard->kor_kematian();
     $data['kor_perceraian'] = $this->model_dasboard->kor_perceraian();
     $data['kor_pernikahan'] = $this->model_dasboard->kor_pernikahan();
     $data['kor_sp'] = $this->model_dasboard->kor_sp();
     $this->render('backend/standart/chart', $data);
    }

	public function index1()
	{
		if (!$this->aauth->is_allowed('dashboard')) {
			redirect('/','refresh');
		}

		$data = [];
		$user=get_user_data('kd_wilayah');
		if(strlen($user)==10){
        	$this->render('backend/standart/chart_desa', $data);
        }else if (strlen($user)==6){
            $this->render('backend/standart/chart_kec', $data);
		}else{
		$this->render('backend/standart/chart', $data);
		}
	}

}

/* End of file Dashboard.php */
/* Location: ./application/controllers/administrator/Dashboard.php */