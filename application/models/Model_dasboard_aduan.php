<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_dasboard_aduan extends MY_Model {

	private $primary_key 	= 'id';
	private $table_name 	= 'tbl_aspirasi';
	private $field_search 	= ['nik', 'no_kk', 'no_hp', 'status'];

	public function __construct()
	{
		$config = array(
			'primary_key' 	=> $this->primary_key,
		 	'table_name' 	=> $this->table_name,
		 	'field_search' 	=> $this->field_search,
		 );
		parent::__construct($config);
	}
	
	
	 public function count_aduan()
	{
	    
        $username = get_user_data('id'); 
        $user_gr = get_user_group($username);
        if($user_gr == '1' || $user_gr == '9' || $user_gr == '7'){
            $kd_wilayah = $this->input->get('kd_wilayah');
        }else{
            $kd_wilayah = get_user_data('kd_wilayah');
        }
        
        $tahun = date('Y');                          
        $this->db->from('tbl_aspirasi');
       // $this->db->where('status','menunggu');
        $this->db->like('kd_wilayah',$kd_wilayah);
        $this->db->where('year(creation_date)',$tahun);
        return $this->db->count_all_results();
        
	}
		 public function count_aduan_proses()
	{
	    
        $username = get_user_data('id'); 
        $user_gr = get_user_group($username);
        if($user_gr == '1' || $user_gr == '9' || $user_gr == '7'){
            $kd_wilayah = $this->input->get('kd_wilayah');
        }else{
            $kd_wilayah = get_user_data('kd_wilayah');
        }
        
        $tahun = date('Y');                          
        $this->db->from('tbl_aspirasi');
        $this->db->where('status','proses');
        $this->db->like('kd_wilayah',$kd_wilayah);
        $this->db->where('year(creation_date)',$tahun);
        return $this->db->count_all_results();
        
	}
	
	public function count_aduan_selesai()
	{
	    
        $username = get_user_data('id'); 
        $user_gr = get_user_group($username);
        if($user_gr == '1' || $user_gr == '9' || $user_gr == '7'){
            $kd_wilayah = $this->input->get('kd_wilayah');
        }else{
            $kd_wilayah = get_user_data('kd_wilayah');
        }
        
        $tahun = date('Y');                          
        $this->db->from('tbl_aspirasi');
        $this->db->where('status','selesai');
        $this->db->like('kd_wilayah',$kd_wilayah);
        $this->db->where('year(creation_date)',$tahun);
        return $this->db->count_all_results();
        
	}
	
	
		public function count_aduan_jenis_1()
	{
	    
        $username = get_user_data('id'); 
        $user_gr = get_user_group($username);
        if($user_gr == '1' || $user_gr == '9' || $user_gr == '7'){
            $kd_wilayah = $this->input->get('kd_wilayah');
        }else{
            $kd_wilayah = get_user_data('kd_wilayah');
        }
        
        $tahun = date('Y');                          
        $this->db->from('tbl_aspirasi');
        $this->db->where('jenis_aduan','1');
        $this->db->like('kd_wilayah',$kd_wilayah);
        $this->db->where('year(creation_date)',$tahun);
        return $this->db->count_all_results();
        
	}
			public function count_aduan_jenis_2()
	{
	    
        $username = get_user_data('id'); 
        $user_gr = get_user_group($username);
        if($user_gr == '1' || $user_gr == '9' || $user_gr == '7'){
            $kd_wilayah = $this->input->get('kd_wilayah');
        }else{
            $kd_wilayah = get_user_data('kd_wilayah');
        }
        
        $tahun = date('Y');                          
        $this->db->from('tbl_aspirasi');
        $this->db->where('jenis_aduan','2');
        $this->db->like('kd_wilayah',$kd_wilayah);
        $this->db->where('year(creation_date)',$tahun);
        return $this->db->count_all_results();
        
	}
			public function count_aduan_jenis_3()
	{
	    
        $username = get_user_data('id'); 
        $user_gr = get_user_group($username);
        if($user_gr == '1' || $user_gr == '9' || $user_gr == '7'){
            $kd_wilayah = $this->input->get('kd_wilayah');
        }else{
            $kd_wilayah = get_user_data('kd_wilayah');
        }
        
        $tahun = date('Y');                          
        $this->db->from('tbl_aspirasi');
        $this->db->where('jenis_aduan','3');
        $this->db->like('kd_wilayah',$kd_wilayah);
        $this->db->where('year(creation_date)',$tahun);
        return $this->db->count_all_results();
        
	}		public function count_aduan_jenis_4()
	{
	    
        $username = get_user_data('id'); 
        $user_gr = get_user_group($username);
        if($user_gr == '1' || $user_gr == '9' || $user_gr == '7'){
            $kd_wilayah = $this->input->get('kd_wilayah');
        }else{
            $kd_wilayah = get_user_data('kd_wilayah');
        }
        
        $tahun = date('Y');                          
        $this->db->from('tbl_aspirasi');
        $this->db->where('jenis_aduan','4');
        $this->db->like('kd_wilayah',$kd_wilayah);
        $this->db->where('year(creation_date)',$tahun);
        return $this->db->count_all_results();
        
	}		public function count_aduan_jenis_5()
	{
	    
        $username = get_user_data('id'); 
        $user_gr = get_user_group($username);
        if($user_gr == '1' || $user_gr == '9' || $user_gr == '7'){
            $kd_wilayah = $this->input->get('kd_wilayah');
        }else{
            $kd_wilayah = get_user_data('kd_wilayah');
        }
        
        $tahun = date('Y');                          
        $this->db->from('tbl_aspirasi');
        $this->db->where('jenis_aduan','5');
        $this->db->like('kd_wilayah',$kd_wilayah);
        $this->db->where('year(creation_date)',$tahun);
        return $this->db->count_all_results();
        
	}		public function count_aduan_jenis_6()
	{
	    
        $username = get_user_data('id'); 
        $user_gr = get_user_group($username);
        if($user_gr == '1' || $user_gr == '9' || $user_gr == '7'){
            $kd_wilayah = $this->input->get('kd_wilayah');
        }else{
            $kd_wilayah = get_user_data('kd_wilayah');
        }
        
        $tahun = date('Y');                          
        $this->db->from('tbl_aspirasi');
        $this->db->where('jenis_aduan','6');
        $this->db->like('kd_wilayah',$kd_wilayah);
        $this->db->where('year(creation_date)',$tahun);
        return $this->db->count_all_results();
        
	}		public function count_aduan_jenis_7()
	{
	    
        $username = get_user_data('id'); 
        $user_gr = get_user_group($username);
        if($user_gr == '1' || $user_gr == '9' || $user_gr == '7'){
            $kd_wilayah = $this->input->get('kd_wilayah');
        }else{
            $kd_wilayah = get_user_data('kd_wilayah');
        }
        
        $tahun = date('Y');                          
        $this->db->from('tbl_aspirasi');
        $this->db->where('jenis_aduan','7');
        $this->db->like('kd_wilayah',$kd_wilayah);
        $this->db->where('year(creation_date)',$tahun);
        return $this->db->count_all_results();
        
	}
			public function count_aduan_jenis_8()
	{
	    
        $username = get_user_data('id'); 
        $user_gr = get_user_group($username);
        if($user_gr == '1' || $user_gr == '9' || $user_gr == '7'){
            $kd_wilayah = $this->input->get('kd_wilayah');
        }else{
            $kd_wilayah = get_user_data('kd_wilayah');
        }
        
        $tahun = date('Y');                          
        $this->db->from('tbl_aspirasi');
        $this->db->where('jenis_aduan','8');
        $this->db->like('kd_wilayah',$kd_wilayah);
        $this->db->where('year(creation_date)',$tahun);
        return $this->db->count_all_results();
        
	}
			public function count_aduan_jenis_9()
	{
	    
        $username = get_user_data('id'); 
        $user_gr = get_user_group($username);
        if($user_gr == '1' || $user_gr == '9' || $user_gr == '7'){
            $kd_wilayah = $this->input->get('kd_wilayah');
        }else{
            $kd_wilayah = get_user_data('kd_wilayah');
        }
        
        $tahun = date('Y');                          
        $this->db->from('tbl_aspirasi');
        $this->db->where('jenis_aduan','9');
        $this->db->like('kd_wilayah',$kd_wilayah);
        $this->db->where('year(creation_date)',$tahun);
        return $this->db->count_all_results();
        
	}
			public function count_aduan_jenis_10()
	{
	    
        $username = get_user_data('id'); 
        $user_gr = get_user_group($username);
        if($user_gr == '1' || $user_gr == '9' || $user_gr == '7'){
            $kd_wilayah = $this->input->get('kd_wilayah');
        }else{
            $kd_wilayah = get_user_data('kd_wilayah');
        }
        
        $tahun = date('Y');                          
        $this->db->from('tbl_aspirasi');
        $this->db->where('jenis_aduan','10');
        $this->db->like('kd_wilayah',$kd_wilayah);
        $this->db->where('year(creation_date)',$tahun);
        return $this->db->count_all_results();
        
	}		public function count_aduan_jenis_11()
	{
	    
        $username = get_user_data('id'); 
        $user_gr = get_user_group($username);
        if($user_gr == '1' || $user_gr == '9' || $user_gr == '7'){
            $kd_wilayah = $this->input->get('kd_wilayah');
        }else{
            $kd_wilayah = get_user_data('kd_wilayah');
        }
        
        $tahun = date('Y');                          
        $this->db->from('tbl_aspirasi');
        $this->db->where('jenis_aduan','11');
        $this->db->where('year(creation_date)',$tahun);
        $this->db->like('kd_wilayah',$kd_wilayah);
        return $this->db->count_all_results();
        
	}		public function count_aduan_jenis_12()
	{
	    
        $username = get_user_data('id'); 
        $user_gr = get_user_group($username);
        if($user_gr == '1' || $user_gr == '9' || $user_gr == '7'){
            $kd_wilayah = $this->input->get('kd_wilayah');
        }else{
            $kd_wilayah = get_user_data('kd_wilayah');
        }
        
        $tahun = date('Y');                          
        $this->db->from('tbl_aspirasi');
        $this->db->where('jenis_aduan','12');
        $this->db->like('kd_wilayah',$kd_wilayah);
                $this->db->where('year(creation_date)',$tahun);
        return $this->db->count_all_results();
        
	}		public function count_aduan_jenis_13()
	{
	    
        $username = get_user_data('id'); 
        $user_gr = get_user_group($username);
        if($user_gr == '1' || $user_gr == '9' || $user_gr == '7'){
            $kd_wilayah = $this->input->get('kd_wilayah');
        }else{
            $kd_wilayah = get_user_data('kd_wilayah');
        }
        
        $tahun = date('Y');                          
        $this->db->from('tbl_aspirasi');
        $this->db->where('jenis_aduan','13');
        $this->db->like('kd_wilayah',$kd_wilayah);
        $this->db->where('year(creation_date)',$tahun);
        return $this->db->count_all_results();
        
	}		public function count_aduan_jenis_14()
	{
	    
        $username = get_user_data('id'); 
        $user_gr = get_user_group($username);
        if($user_gr == '1' || $user_gr == '9' || $user_gr == '7'){
            $kd_wilayah = $this->input->get('kd_wilayah');
        }else{
            $kd_wilayah = get_user_data('kd_wilayah');
        }
        
        $tahun = date('Y');                          
        $this->db->from('tbl_aspirasi');
        $this->db->where('jenis_aduan','14');
        $this->db->like('kd_wilayah',$kd_wilayah);
        $this->db->where('year(creation_date)',$tahun);
        return $this->db->count_all_results();
        
	}
				public function count_aduan_jenis_15()
	{
	    
        $username = get_user_data('id'); 
        $user_gr = get_user_group($username);
        if($user_gr == '1' || $user_gr == '9' || $user_gr == '7'){
            $kd_wilayah = $this->input->get('kd_wilayah');
        }else{
            $kd_wilayah = get_user_data('kd_wilayah');
        }
        
        $tahun = date('Y');                          
        $this->db->from('tbl_aspirasi');
        $this->db->where('jenis_aduan','15');
        $this->db->like('kd_wilayah',$kd_wilayah);
        $this->db->where('year(creation_date)',$tahun);
        return $this->db->count_all_results();
        
	}		public function count_aduan_jenis_16()
	{
	    
        $username = get_user_data('id'); 
        $user_gr = get_user_group($username);
        if($user_gr == '1' || $user_gr == '9' || $user_gr == '7'){
            $kd_wilayah = $this->input->get('kd_wilayah');
        }else{
            $kd_wilayah = get_user_data('kd_wilayah');
        }
        
        $tahun = date('Y');                          
        $this->db->from('tbl_aspirasi');
        $this->db->where('jenis_aduan','16');
        $this->db->like('kd_wilayah',$kd_wilayah);
        $this->db->where('year(creation_date)',$tahun);
        return $this->db->count_all_results();
        
	}		public function count_aduan_jenis_17()
	{
	    
        $username = get_user_data('id'); 
        $user_gr = get_user_group($username);
        if($user_gr == '1' || $user_gr == '9' || $user_gr == '7'){
            $kd_wilayah = $this->input->get('kd_wilayah');
        }else{
            $kd_wilayah = get_user_data('kd_wilayah');
        }
        
        $tahun = date('Y');                          
        $this->db->from('tbl_aspirasi');
        $this->db->where('jenis_aduan','17');
        $this->db->like('kd_wilayah',$kd_wilayah);
        $this->db->where('year(creation_date)',$tahun);
        return $this->db->count_all_results();
        
	}		public function count_aduan_jenis_18()
	{
	    
        $username = get_user_data('id'); 
        $user_gr = get_user_group($username);
        if($user_gr == '1' || $user_gr == '9' || $user_gr == '7'){
            $kd_wilayah = $this->input->get('kd_wilayah');
        }else{
            $kd_wilayah = get_user_data('kd_wilayah');
        }
        
        $tahun = date('Y');                          
        $this->db->from('tbl_aspirasi');
        $this->db->where('jenis_aduan','18');
        $this->db->like('kd_wilayah',$kd_wilayah);
        $this->db->where('year(creation_date)',$tahun);
        return $this->db->count_all_results();
        
	}
	
	
	//perperiode
	
	public function count_aduan_periode1()
	{
	    
        $username = get_user_data('id'); 
        $user_gr = get_user_group($username);
        if($user_gr == '1' || $user_gr == '9' || $user_gr == '7'){
            $kd_wilayah = $this->input->get('kd_wilayah');
        }else{
            $kd_wilayah = get_user_data('kd_wilayah');
        }
        $tahun = date('Y');                           
        $this->db->from('tbl_aspirasi');
        $this->db->where('month(creation_date)',01);
        $this->db->where('year(creation_date)',$tahun);
        $this->db->like('kd_wilayah',$kd_wilayah);
        return $this->db->count_all_results();
        
	}
	
		public function count_aduan_periode2()
	{
	    
        $username = get_user_data('id'); 
        $user_gr = get_user_group($username);
        if($user_gr == '1' || $user_gr == '9' || $user_gr == '7'){
            $kd_wilayah = $this->input->get('kd_wilayah');
        }else{
            $kd_wilayah = get_user_data('kd_wilayah');
        }
        $tahun = date('Y');                           
        $this->db->from('tbl_aspirasi');
        $this->db->where('month(creation_date)',02);
        $this->db->where('year(creation_date)',$tahun);
        $this->db->like('kd_wilayah',$kd_wilayah);
        return $this->db->count_all_results();
        
	}
		public function count_aduan_periode3()
	{
	    
        $username = get_user_data('id'); 
        $user_gr = get_user_group($username);
        if($user_gr == '1' || $user_gr == '9' || $user_gr == '7'){
            $kd_wilayah = $this->input->get('kd_wilayah');
        }else{
            $kd_wilayah = get_user_data('kd_wilayah');
        }
        $tahun = date('Y');                           
        $this->db->from('tbl_aspirasi');
        $this->db->where('month(creation_date)',03);
        $this->db->where('year(creation_date)',$tahun);
        $this->db->like('kd_wilayah',$kd_wilayah);
        return $this->db->count_all_results();
        
	}
		public function count_aduan_periode4()
	{
	    
        $username = get_user_data('id'); 
        $user_gr = get_user_group($username);
        if($user_gr == '1' || $user_gr == '9' || $user_gr == '7'){
            $kd_wilayah = $this->input->get('kd_wilayah');
        }else{
            $kd_wilayah = get_user_data('kd_wilayah');
        }
        $tahun = date('Y');                           
        $this->db->from('tbl_aspirasi');
        $this->db->where('month(creation_date)',04);
        $this->db->where('year(creation_date)',$tahun);
        $this->db->like('kd_wilayah',$kd_wilayah);
        return $this->db->count_all_results();
        
	}
		public function count_aduan_periode5()
	{
	    
        $username = get_user_data('id'); 
        $user_gr = get_user_group($username);
        if($user_gr == '1' || $user_gr == '9' || $user_gr == '7'){
            $kd_wilayah = $this->input->get('kd_wilayah');
        }else{
            $kd_wilayah = get_user_data('kd_wilayah');
        }
        $tahun = date('Y'); 
        $this->db->from('tbl_aspirasi');
        $this->db->where('month(creation_date)',05);
        $this->db->where('year(creation_date)',$tahun);
        $this->db->like('kd_wilayah',$kd_wilayah);
        return $this->db->count_all_results();
        
	}
		public function count_aduan_periode6()
	{
	    
        $username = get_user_data('id'); 
        $user_gr = get_user_group($username);
        if($user_gr == '1' || $user_gr == '9' || $user_gr == '7'){
            $kd_wilayah = $this->input->get('kd_wilayah');
        }else{
            $kd_wilayah = get_user_data('kd_wilayah');
        }
        $tahun = date('Y');                           
        $this->db->from('tbl_aspirasi');
        $this->db->where('month(creation_date)',06);
        $this->db->where('year(creation_date)',$tahun);
        $this->db->like('kd_wilayah',$kd_wilayah);
        return $this->db->count_all_results();
        
	}
		public function count_aduan_periode7()
	{
	    
        $username = get_user_data('id'); 
        $user_gr = get_user_group($username);
        if($user_gr == '1' || $user_gr == '9' || $user_gr == '7'){
            $kd_wilayah = $this->input->get('kd_wilayah');
        }else{
            $kd_wilayah = get_user_data('kd_wilayah');
        }
        $tahun = date('Y');                           
        $this->db->from('tbl_aspirasi');
        $this->db->where('month(creation_date)',07);
        $this->db->where('year(creation_date)',$tahun);
        $this->db->like('kd_wilayah',$kd_wilayah);
        return $this->db->count_all_results();
        
	}
			public function count_aduan_periode8()
	{
	    
        $username = get_user_data('id'); 
        $user_gr = get_user_group($username);
        if($user_gr == '1' || $user_gr == '9' || $user_gr == '7'){
            $kd_wilayah = $this->input->get('kd_wilayah');
        }else{
            $kd_wilayah = get_user_data('kd_wilayah');
        }
        $tahun = date('Y');                           
        $this->db->from('tbl_aspirasi');
        $this->db->where('month(creation_date)',8);
        $this->db->where('year(creation_date)',$tahun);
        $this->db->like('kd_wilayah',$kd_wilayah);
        return $this->db->count_all_results();
        
	}
		public function count_aduan_periode9()
	{
	    
        $username = get_user_data('id'); 
        $user_gr = get_user_group($username);
        if($user_gr == '1' || $user_gr == '9' || $user_gr == '7'){
            $kd_wilayah = $this->input->get('kd_wilayah');
        }else{
            $kd_wilayah = get_user_data('kd_wilayah');
        }
        $tahun = date('Y');                           
        $this->db->from('tbl_aspirasi');
        $this->db->where('month(creation_date)',9);
        $this->db->where('year(creation_date)',$tahun);
        $this->db->like('kd_wilayah',$kd_wilayah);
        return $this->db->count_all_results();
        
	}
		public function count_aduan_periode10()
	{
	    
        $username = get_user_data('id'); 
        $user_gr = get_user_group($username);
        if($user_gr == '1' || $user_gr == '9' || $user_gr == '7'){
            $kd_wilayah = $this->input->get('kd_wilayah');
        }else{
            $kd_wilayah = get_user_data('kd_wilayah');
        }
        $tahun = date('Y');                           
        $this->db->from('tbl_aspirasi');
        $this->db->where('month(creation_date)',10);
        $this->db->where('year(creation_date)',$tahun);
        $this->db->like('kd_wilayah',$kd_wilayah);
        return $this->db->count_all_results();
        
	}
		public function count_aduan_periode11()
	{
	    
        $username = get_user_data('id'); 
        $user_gr = get_user_group($username);
        if($user_gr == '1' || $user_gr == '9' || $user_gr == '7'){
            $kd_wilayah = $this->input->get('kd_wilayah');
        }else{
            $kd_wilayah = get_user_data('kd_wilayah');
        }
        $tahun = date('Y');                           
        $this->db->from('tbl_aspirasi');
         $this->db->where('month(creation_date)',11);
        $this->db->where('year(creation_date)',$tahun);
        $this->db->like('kd_wilayah',$kd_wilayah);
        return $this->db->count_all_results();
        
	}	public function count_aduan_periode12()
	{
	    
        $username = get_user_data('id'); 
        $user_gr = get_user_group($username);
        if($user_gr == '1' || $user_gr == '9' || $user_gr == '7'){
            $kd_wilayah = $this->input->get('kd_wilayah');
        }else{
            $kd_wilayah = get_user_data('kd_wilayah');
        }
        $tahun = date('Y');                           
        $this->db->from('tbl_aspirasi');
         $this->db->where('month(creation_date)',12);
        $this->db->where('year(creation_date)',$tahun);
        $this->db->like('kd_wilayah',$kd_wilayah);
        return $this->db->count_all_results();
        
	}
	
	
}

/* End of file Model_tbl_disabilitas.php */
/* Location: ./application/models/Model_tbl_disabilitas.php */