<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_dasboard extends MY_Model {

	private $primary_key 	= 'id';
	private $table_name 	= 'penduduk_real';
	private $field_search 	= ['nik', 'no_kk', 'nama', 'tgl_lahir'];

	public function __construct()
	{
		$config = array(
			'primary_key' 	=> $this->primary_key,
		 	'table_name' 	=> $this->table_name,
		 	'field_search' 	=> $this->field_search,
		 );
		parent::__construct($config);
	}
	
	
	 public function kor_kelahiran()
	{
	    //tambahan
        $username = get_user_data('id'); 
        $user_gr = get_user_group($username);
        if($user_gr == '1' || $user_gr == '9' || $user_gr == '7'){
            $kd_wilayah = $this->input->get('kd_wilayah');
        }else{
            $kd_wilayah = get_user_data('kd_wilayah');
        }
                                
        $this->db->from('tbl_korduk_akta_kelahiran');
        $this->db->like('kd_wilayah',$kd_wilayah);
        return $this->db->count_all_results();
        
	}
	public function kor_kematian()
	{
	    //tambahan
        $username = get_user_data('id'); 
        $user_gr = get_user_group($username);
        if($user_gr == '1' || $user_gr == '9' || $user_gr == '7'){
            $kd_wilayah = $this->input->get('kd_wilayah');
        }else{
            $kd_wilayah = get_user_data('kd_wilayah');
        }
                                
        $this->db->from('tbl_korduk_akta_kematian');
        $this->db->like('kd_wilayah',$kd_wilayah);
        return $this->db->count_all_results();
        
	}
	public function kor_perceraian()
	{
	    //tambahan
        $username = get_user_data('id'); 
        $user_gr = get_user_group($username);
        if($user_gr == '1' || $user_gr == '9' || $user_gr == '7'){
            $kd_wilayah = $this->input->get('kd_wilayah');
        }else{
            $kd_wilayah = get_user_data('kd_wilayah');
        }
                                
        $this->db->from('tbl_korduk_akta_perceraian');
        $this->db->like('kd_wilayah',$kd_wilayah);
        return $this->db->count_all_results();
        
	}
	public function kor_pernikahan()
	{
	    //tambahan
        $username = get_user_data('id'); 
        $user_gr = get_user_group($username);
        if($user_gr == '1' || $user_gr == '9' || $user_gr == '7'){
            $kd_wilayah = $this->input->get('kd_wilayah');
        }else{
            $kd_wilayah = get_user_data('kd_wilayah');
        }
                                
        $this->db->from('tbl_korduk_akta_pernikahan');
        $this->db->like('kd_wilayah',$kd_wilayah);
        return $this->db->count_all_results();
        
	}
	public function kor_kk()
	{
	    //tambahan
        $username = get_user_data('id'); 
        $user_gr = get_user_group($username);
        if($user_gr == '1' || $user_gr == '9' || $user_gr == '7'){
            $kd_wilayah = $this->input->get('kd_wilayah');
        }else{
            $kd_wilayah = get_user_data('kd_wilayah');
        }
                                
        $this->db->from('tbl_korduk_kk');
        $this->db->like('kd_wilayah',$kd_wilayah);
        return $this->db->count_all_results();
        
	}
	public function kor_ktp()
	{
	    //tambahan
        $username = get_user_data('id'); 
        $user_gr = get_user_group($username);
        if($user_gr == '1' || $user_gr == '9' || $user_gr == '7'){
            $kd_wilayah = $this->input->get('kd_wilayah');
        }else{
            $kd_wilayah = get_user_data('kd_wilayah');
        }
                                
        $this->db->from('tbl_korduk_ktp');
        $this->db->like('kd_wilayah',$kd_wilayah);
        return $this->db->count_all_results();
        
	}
	public function kor_sp()
	{
	    //tambahan
        $username = get_user_data('id'); 
        $user_gr = get_user_group($username);
        if($user_gr == '1' || $user_gr == '9' || $user_gr == '7'){
            $kd_wilayah = $this->input->get('kd_wilayah');
        }else{
            $kd_wilayah = get_user_data('kd_wilayah');
        }
                                
        $this->db->from('tbl_korduk_surat_pindah');
        $this->db->like('kd_wilayah',$kd_wilayah);
        return $this->db->count_all_results();
        
	}
	
    
    public function count_penduduk()
	{
	    //tambahan
        $username = get_user_data('id'); 
        $user_gr = get_user_group($username);
        if($user_gr == '1' || $user_gr == '9' || $user_gr == '7'){
            $kd_wilayah = $this->input->get('kd_wilayah');
        }else{
            $kd_wilayah = get_user_data('kd_wilayah');
        }
                                
        $this->db->from('penduduk_real');
        $this->db->where('verifikasi','1');
        $this->db->like('kd_wilayah',$kd_wilayah);
        return $this->db->count_all_results();
        
	}
	 public function pend_laki()
	{
	    //tambahan
        $username = get_user_data('id');
        $user_gr = get_user_group($username);
        if($user_gr == '1' || $user_gr == '9' || $user_gr == '7'){
            $kd_wilayah = $this->input->get('kd_wilayah');
        }else{
            $kd_wilayah = get_user_data('kd_wilayah');
        }
        $this->db->from('penduduk_real');
        $this->db->where('verifikasi','1');
        $this->db->where('jenis_kelamin','Laki-laki');
        $this->db->like('kd_wilayah',$kd_wilayah);
        return $this->db->count_all_results();
        
	}
	 public function pend_perem()
	{
	    //tambahan
        $username = get_user_data('id');
        $user_gr = get_user_group($username);
        if($user_gr == '1' || $user_gr == '9' || $user_gr == '7'){
            $kd_wilayah = $this->input->get('kd_wilayah');
        }else{
            $kd_wilayah = get_user_data('kd_wilayah');
        }
        $this->db->from('penduduk_real');
        $this->db->where('verifikasi','1');
        $this->db->where('jenis_kelamin','Perempuan');
        $this->db->like('kd_wilayah',$kd_wilayah);
        return $this->db->count_all_results();
        
	}
	public function pend_lansia()
	{
	   //tambahan
        $username = get_user_data('id');
        $user_gr = get_user_group($username);
        if($user_gr == '1' || $user_gr == '9' || $user_gr == '7'){
            $kd_wilayah = $this->input->get('kd_wilayah');
        }else{
            $kd_wilayah = get_user_data('kd_wilayah');
        }
		$date = date('Y-m-d', strtotime('-60 year', strtotime(date('Y-m-d'))));
        $this->db->from('penduduk_real');
        $this->db->where('verifikasi','1');
        $this->db->where('tgl_lahir <=',$date);
        $this->db->like('kd_wilayah',$kd_wilayah);
        return $this->db->count_all_results();
        
	}
	
	public function u_bayi()
	{
	    //tambahan
        $username = get_user_data('id');
        $user_gr = get_user_group($username);
        if($user_gr == '1' || $user_gr == '9' || $user_gr == '7'){
            $kd_wilayah = $this->input->get('kd_wilayah');
        }else{
            $kd_wilayah = get_user_data('kd_wilayah');
        }
		$date = date('Y-m-d', strtotime('-5 year', strtotime(date('Y-m-d'))));
        $this->db->from('penduduk_real');
        $this->db->where('verifikasi','1');
        $this->db->where('tgl_lahir >=',$date);
        $this->db->like('kd_wilayah',$kd_wilayah);
        return $this->db->count_all_results();
        
	}
	
	public function u_anak()
	{
	    //tambahan
        $username = get_user_data('id');
        $user_gr = get_user_group($username);
        if($user_gr == '1' || $user_gr == '9' || $user_gr == '7'){
            $kd_wilayah = $this->input->get('kd_wilayah');
        }else{
            $kd_wilayah = get_user_data('kd_wilayah');
        }
		$date = date('Y-m-d', strtotime('-14 year', strtotime(date('Y-m-d'))));
		$date2 = date('Y-m-d', strtotime('-6 year', strtotime(date('Y-m-d'))));
        $this->db->from('penduduk_real');
        $this->db->where('verifikasi','1');
        $this->db->where('tgl_lahir >=',$date);
        $this->db->where('tgl_lahir <=',$date2);
        $this->db->like('kd_wilayah',$kd_wilayah);
        return $this->db->count_all_results();
        
	}
	
		public function u_remaja()
	{
	    //tambahan
        $username = get_user_data('id');
        $user_gr = get_user_group($username);
        if($user_gr == '1' || $user_gr == '9' || $user_gr == '7'){
            $kd_wilayah = $this->input->get('kd_wilayah');
        }else{
            $kd_wilayah = get_user_data('kd_wilayah');
        }
		$date = date('Y-m-d', strtotime('-24 year', strtotime(date('Y-m-d'))));
		$date2 = date('Y-m-d', strtotime('-15 year', strtotime(date('Y-m-d'))));
        $this->db->from('penduduk_real');
        $this->db->where('verifikasi','1');
        $this->db->where('tgl_lahir >=',$date);
        $this->db->where('tgl_lahir <=',$date2);
        $this->db->like('kd_wilayah',$kd_wilayah);
        return $this->db->count_all_results();
        
	}
	
		public function u_dewasa()
	{
	    //tambahan
        $username = get_user_data('id');
        $user_gr = get_user_group($username);
        if($user_gr == '1' || $user_gr == '9' || $user_gr == '7'){
            $kd_wilayah = $this->input->get('kd_wilayah');
        }else{
            $kd_wilayah = get_user_data('kd_wilayah');
        }
		$date = date('Y-m-d', strtotime('-44 year', strtotime(date('Y-m-d'))));
		$date2 = date('Y-m-d', strtotime('-25 year', strtotime(date('Y-m-d'))));
        $this->db->from('penduduk_real');
        $this->db->where('verifikasi','1');
        $this->db->where('tgl_lahir >=',$date);
        $this->db->where('tgl_lahir <=',$date2);
        $this->db->like('kd_wilayah',$kd_wilayah);
        return $this->db->count_all_results();
        
	}
	
	public function u_tua()
	{
	    //tambahan
        $username = get_user_data('id');
        $user_gr = get_user_group($username);
        if($user_gr == '1' || $user_gr == '9' || $user_gr == '7'){
            $kd_wilayah = $this->input->get('kd_wilayah');
        }else{
            $kd_wilayah = get_user_data('kd_wilayah');
        }
		$date = date('Y-m-d', strtotime('-59 year', strtotime(date('Y-m-d'))));
		$date2 = date('Y-m-d', strtotime('-45 year', strtotime(date('Y-m-d'))));
        $this->db->from('penduduk_real');
        $this->db->where('verifikasi','1');
        $this->db->where('tgl_lahir >=',$date);
        $this->db->where('tgl_lahir <=',$date2);
        $this->db->like('kd_wilayah',$kd_wilayah);
        return $this->db->count_all_results();
        
	}
	
	public function u_lansia()
	{
	   //tambahan
        $username = get_user_data('id');
        $user_gr = get_user_group($username);
        if($user_gr == '1' || $user_gr == '9' || $user_gr == '7'){
            $kd_wilayah = $this->input->get('kd_wilayah');
        }else{
            $kd_wilayah = get_user_data('kd_wilayah');
        }
		$date = date('Y-m-d', strtotime('-130 year', strtotime(date('Y-m-d'))));
		$date2 = date('Y-m-d', strtotime('-60 year', strtotime(date('Y-m-d'))));
        $this->db->from('penduduk_real');
        $this->db->where('verifikasi','1');
        $this->db->where('tgl_lahir >=',$date);
        $this->db->where('tgl_lahir <=',$date2);
        $this->db->like('kd_wilayah',$kd_wilayah);
        return $this->db->count_all_results();
        
	}
	
	public function g_a()
	{
	    //tambahan
        $username = get_user_data('id');
        $user_gr = get_user_group($username);
        if($user_gr == '1' || $user_gr == '9' || $user_gr == '7'){
            $kd_wilayah = $this->input->get('kd_wilayah');
        }else{
            $kd_wilayah = get_user_data('kd_wilayah');
        }
        $this->db->from('penduduk_real');
        $this->db->where('verifikasi','1');
        $this->db->where('golongan_dara','1');
        $this->db->like('kd_wilayah',$kd_wilayah);
        return $this->db->count_all_results();
        
	}
	
	public function g_b()
	{
	    //tambahan
        $username = get_user_data('id');
        $user_gr = get_user_group($username);
        if($user_gr == '1' || $user_gr == '9' || $user_gr == '7'){
            $kd_wilayah = $this->input->get('kd_wilayah');
        }else{
            $kd_wilayah = get_user_data('kd_wilayah');
        }
        $this->db->from('penduduk_real');
        $this->db->where('verifikasi','1');
        $this->db->where('golongan_dara','2');
        $this->db->like('kd_wilayah',$kd_wilayah);
        return $this->db->count_all_results();
        
	}
	
	public function g_ab()
	{
	    //tambahan
        $username = get_user_data('id');
        $user_gr = get_user_group($username);
        if($user_gr == '1' || $user_gr == '9' || $user_gr == '7'){
            $kd_wilayah = $this->input->get('kd_wilayah');
        }else{
            $kd_wilayah = get_user_data('kd_wilayah');
        }
        $this->db->from('penduduk_real');
        $this->db->where('verifikasi','1');
        $this->db->where('golongan_dara','3');
        $this->db->like('kd_wilayah',$kd_wilayah);
        return $this->db->count_all_results();
        
	}
	
	public function g_o()
	{
	    //tambahan
        $username = get_user_data('id');
        $user_gr = get_user_group($username);
        if($user_gr == '1' || $user_gr == '9' || $user_gr == '7'){
            $kd_wilayah = $this->input->get('kd_wilayah');
        }else{
            $kd_wilayah = get_user_data('kd_wilayah');
        }
        $this->db->from('penduduk_real');
        $this->db->where('verifikasi','1');
        $this->db->where('golongan_dara','4');
        $this->db->like('kd_wilayah',$kd_wilayah);
        return $this->db->count_all_results();
        
	}
	
	public function g_tt()
	{
	    //tambahan
        $username = get_user_data('id');
        $user_gr = get_user_group($username);
        if($user_gr == '1' || $user_gr == '9' || $user_gr == '7'){
            $kd_wilayah = $this->input->get('kd_wilayah');
        }else{
            $kd_wilayah = get_user_data('kd_wilayah');
        }
        $this->db->from('penduduk_real');
        $this->db->where('verifikasi','1');
        $this->db->where('golongan_dara','0');
        $this->db->like('kd_wilayah',$kd_wilayah);
        return $this->db->count_all_results();
        
	}
	
	public function k_belum()
	{
	   //tambahan
        $username = get_user_data('id');
        $user_gr = get_user_group($username);
        if($user_gr == '1' || $user_gr == '9' || $user_gr == '7'){
            $kd_wilayah = $this->input->get('kd_wilayah');
        }else{
            $kd_wilayah = get_user_data('kd_wilayah');
        }
        $this->db->from('penduduk_real');
        $this->db->where('verifikasi','1');
        $this->db->where('status_perkawinan','2');
        $this->db->like('kd_wilayah',$kd_wilayah);
        return $this->db->count_all_results();
        
	}
	
	public function k_k()
	{
	    //tambahan
        $username = get_user_data('id');
        $user_gr = get_user_group($username);
        if($user_gr == '1' || $user_gr == '9' || $user_gr == '7'){
            $kd_wilayah = $this->input->get('kd_wilayah');
        }else{
            $kd_wilayah = get_user_data('kd_wilayah');
        }
        $this->db->from('penduduk_real');
        $this->db->where('verifikasi','1');
        $this->db->where('status_perkawinan','1');
        $this->db->like('kd_wilayah',$kd_wilayah);
        return $this->db->count_all_results();
        
	}
	
	public function k_ch()
	{
	   //tambahan
        $username = get_user_data('id');
        $user_gr = get_user_group($username);
        if($user_gr == '1' || $user_gr == '9' || $user_gr == '7'){
            $kd_wilayah = $this->input->get('kd_wilayah');
        }else{
            $kd_wilayah = get_user_data('kd_wilayah');
        }
        $this->db->from('penduduk_real');
        $this->db->where('verifikasi','1');
        $this->db->where('status_perkawinan','3');
        $this->db->like('kd_wilayah',$kd_wilayah);
        return $this->db->count_all_results();
        
	}
	
	public function k_cm()
	{
	    //tambahan
        $username = get_user_data('id');
        $user_gr = get_user_group($username);
        if($user_gr == '1' || $user_gr == '9' || $user_gr == '7'){
            $kd_wilayah = $this->input->get('kd_wilayah');
        }else{
            $kd_wilayah = get_user_data('kd_wilayah');
        }
        $this->db->from('penduduk_real');
        $this->db->where('verifikasi','1');
        $this->db->where('status_perkawinan','4');
        $this->db->like('kd_wilayah',$kd_wilayah);
        return $this->db->count_all_results();
        
	}
	
		public function a_i()
	{
	    //tambahan
        $username = get_user_data('id');
        $user_gr = get_user_group($username);
        if($user_gr == '1' || $user_gr == '9' || $user_gr == '7'){
            $kd_wilayah = $this->input->get('kd_wilayah');
        }else{
            $kd_wilayah = get_user_data('kd_wilayah');
        }
        $this->db->from('penduduk_real');
        $this->db->where('verifikasi','1');
        $this->db->where('agama','5');
        $this->db->like('kd_wilayah',$kd_wilayah);
        return $this->db->count_all_results();
        
	}
	
	public function a_h()
	{
	   //tambahan
        $username = get_user_data('id');
        $user_gr = get_user_group($username);
        if($user_gr == '1' || $user_gr == '9' || $user_gr == '7'){
            $kd_wilayah = $this->input->get('kd_wilayah');
        }else{
            $kd_wilayah = get_user_data('kd_wilayah');
        }
        $this->db->from('penduduk_real');
        $this->db->where('verifikasi','1');
        $this->db->where('agama','4');
        $this->db->like('kd_wilayah',$kd_wilayah);
        return $this->db->count_all_results();
        
	}
	
	public function a_b()
	{
	    //tambahan
        $username = get_user_data('id');
        $user_gr = get_user_group($username);
        if($user_gr == '1' || $user_gr == '9' || $user_gr == '7'){
            $kd_wilayah = $this->input->get('kd_wilayah');
        }else{
            $kd_wilayah = get_user_data('kd_wilayah');
        }
        $this->db->from('penduduk_real');
        $this->db->where('verifikasi','1');
        $this->db->where('agama','6');
        $this->db->like('kd_wilayah',$kd_wilayah);
        return $this->db->count_all_results();
        
	}
	
	public function a_khc()
	{
	   //tambahan
        $username = get_user_data('id');
        $user_gr = get_user_group($username);
        if($user_gr == '1' || $user_gr == '9' || $user_gr == '7'){
            $kd_wilayah = $this->input->get('kd_wilayah');
        }else{
            $kd_wilayah = get_user_data('kd_wilayah');
        }
        $this->db->from('penduduk_real');
        $this->db->where('verifikasi','1');
        $this->db->where('agama','3');
        $this->db->like('kd_wilayah',$kd_wilayah);
        return $this->db->count_all_results();
        
	}
	
	public function a_kk()
	{
	   //tambahan
        $username = get_user_data('id');
        $user_gr = get_user_group($username);
        if($user_gr == '1' || $user_gr == '9' || $user_gr == '7'){
            $kd_wilayah = $this->input->get('kd_wilayah');
        }else{
            $kd_wilayah = get_user_data('kd_wilayah');
        }
        $this->db->from('penduduk_real');
        $this->db->where('verifikasi','1');
        $this->db->where('agama','2');
        $this->db->like('kd_wilayah',$kd_wilayah);
        return $this->db->count_all_results();
        
	}
	
	public function a_kp()
	{
	    //tambahan
        $username = get_user_data('id');
        $user_gr = get_user_group($username);
        if($user_gr == '1' || $user_gr == '9' || $user_gr == '7'){
            $kd_wilayah = $this->input->get('kd_wilayah');
        }else{
            $kd_wilayah = get_user_data('kd_wilayah');
        }
        $this->db->from('penduduk_real');
        $this->db->where('verifikasi','1');
        $this->db->where('agama','1');
        $this->db->like('kd_wilayah',$kd_wilayah);
        return $this->db->count_all_results();
        
	}
	
	public function a_l()
	{
	    //tambahan
        $username = get_user_data('id');
        $user_gr = get_user_group($username);
        if($user_gr == '1' || $user_gr == '9' || $user_gr == '7'){
            $kd_wilayah = $this->input->get('kd_wilayah');
        }else{
            $kd_wilayah = get_user_data('kd_wilayah');
        }
        $this->db->from('penduduk_real');
        $this->db->where('verifikasi','1');
        $this->db->where('agama','7');
        $this->db->like('kd_wilayah',$kd_wilayah);
        return $this->db->count_all_results();
        
	}
	
	public function v_v()
	{
	   //tambahan
        $username = get_user_data('id');
        $user_gr = get_user_group($username);
        if($user_gr == '1' || $user_gr == '9' || $user_gr == '7'){
            $kd_wilayah = $this->input->get('kd_wilayah');
        }else{
            $kd_wilayah = get_user_data('kd_wilayah');
        }
        $this->db->from('penduduk_real');
        $this->db->where('verifikasi','1');
        $this->db->like('kd_wilayah',$kd_wilayah);
        return $this->db->count_all_results();
        
	}
	
	public function v_b()
	{
	   //tambahan
        $username = get_user_data('id');
        $user_gr = get_user_group($username);
        if($user_gr == '1' || $user_gr == '9' || $user_gr == '7'){
            $kd_wilayah = $this->input->get('kd_wilayah');
        }else{
            $kd_wilayah = get_user_data('kd_wilayah');
        }
        $this->db->from('penduduk_real');
        $this->db->where('verifikasi','2');
        $this->db->like('kd_wilayah',$kd_wilayah);
        return $this->db->count_all_results();
        
	}
	
	public function v_p()
	{
	    //tambahan
        $username = get_user_data('id');
        $user_gr = get_user_group($username);
        if($user_gr == '1' || $user_gr == '9' || $user_gr == '7'){
            $kd_wilayah = $this->input->get('kd_wilayah');
        }else{
            $kd_wilayah = get_user_data('kd_wilayah');
        }
        $this->db->from('penduduk_real');
        $this->db->where('verifikasi','0');
        $this->db->like('kd_wilayah',$kd_wilayah);
        return $this->db->count_all_results();
        
	}
	
	
	
}

/* End of file Model_tbl_disabilitas.php */
/* Location: ./application/models/Model_tbl_disabilitas.php */