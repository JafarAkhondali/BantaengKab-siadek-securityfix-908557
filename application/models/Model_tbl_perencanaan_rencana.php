<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_tbl_perencanaan_rencana extends MY_Model {

	private $primary_key 	= 'id';
	private $table_name 	= 'tbl_perencanaan_rencana';
	private $field_search 	= ['bidang', 'pekerjaan', 'sasaran', 'volume', 'lokasi', 'sumber_dana', 'anggaran'];

	public function __construct()
	{
		$config = array(
			'primary_key' 	=> $this->primary_key,
		 	'table_name' 	=> $this->table_name,
		 	'field_search' 	=> $this->field_search,
		 );

		parent::__construct($config);
	}

	public function count_all_pendapatan()
	{
		
	 //tambahan
        $username = get_user_data('id'); 
        $user_gr = get_user_group($username);
        $tahun = $this->input->get('tahun');
        if($user_gr == '1' || $user_gr == '9' || $user_gr == '7'){
            $kd_wilayah = $this->input->get('kd_wilayah');
        }else{
            $kd_wilayah = get_user_data('kd_wilayah');
        }
		$this->db->where('jenis','pendapatan');
		$this->db->where('kd_wilayah',$kd_wilayah);
		$this->db->where('periode',$tahun);
        $this->db->order_by('tbl_perencanaan_rencana.kd_rekening', "ASC");
		$query = $this->db->get($this->table_name);
        
		return $query->num_rows();
	}

	public function get_pendapatan()
	{
		//tambahan
        $username = get_user_data('id'); 
        $user_gr = get_user_group($username);
        $tahun = $this->input->get('tahun');
        if($user_gr == '1' || $user_gr == '9' || $user_gr == '7'){
            $kd_wilayah = $this->input->get('kd_wilayah');
        }else{
            $kd_wilayah = get_user_data('kd_wilayah');
        }
		$this->db->where('jenis','pendapatan');
		$this->db->where('kd_wilayah',$kd_wilayah);
		$this->db->where('periode',$tahun);
        $this->db->order_by('tbl_perencanaan_rencana.kd_rekening', "ASC");
		$query = $this->db->get($this->table_name);

		return $query->result();
	}
	
		public function count_all_belanja()
	{
		
		//tambahan
		$username = get_user_data('username');
		$kd_wilayah = $this->input->get('kd_wilayah');
		$tahun = $this->input->get('tahun');
		if($username=='admin'){
			$kd_wilayah = $this->input->get('kd_wilayah');
		}else{
			$kd_wilayah = get_user_data('kd_wilayah');
		}
		$this->db->where('jenis','belanja');
		$this->db->where('kd_wilayah',$kd_wilayah);
		$this->db->where('periode',$tahun);
        $this->db->order_by('tbl_perencanaan_rencana.kd_rekening', "ASC");
		$query = $this->db->get($this->table_name);
        
		return $query->num_rows();
	}
	
	public function get_belanja()
	{
		//tambahan
		$username = get_user_data('username');
		$kd_wilayah = $this->input->get('kd_wilayah');
		$tahun = $this->input->get('tahun');
		if($username=='admin'){
			$kd_wilayah = $this->input->get('kd_wilayah');
		}else{
			$kd_wilayah = get_user_data('kd_wilayah');
		}
		$this->db->where('jenis','belanja');
		$this->db->where('kd_wilayah',$kd_wilayah);
		$this->db->where('periode',$tahun);
        $this->db->order_by('tbl_perencanaan_rencana.kd_rekening', "ASC");
		$query = $this->db->get($this->table_name);

		return $query->result();
	}
	
		public function count_all_pembiayaan()
	{
		
		//tambahan
		$username = get_user_data('username');
		$kd_wilayah = $this->input->get('kd_wilayah');
		$tahun = $this->input->get('tahun');
		if($username=='admin'){
			$kd_wilayah = $this->input->get('kd_wilayah');
		}else{
			$kd_wilayah = get_user_data('kd_wilayah');
		}
		$this->db->where('jenis','pembiayaan');
		$this->db->where('kd_wilayah',$kd_wilayah);
		$this->db->where('periode',$tahun);
        $this->db->order_by('tbl_perencanaan_rencana.kd_rekening', "ASC");
		$query = $this->db->get($this->table_name);
        
		return $query->num_rows();
	}
	
	public function get_pembiayaan()
	{
		//tambahan
		$username = get_user_data('username');
		$kd_wilayah = $this->input->get('kd_wilayah');
		$tahun = $this->input->get('tahun');
		if($username=='admin'){
			$kd_wilayah = $this->input->get('kd_wilayah');
		}else{
			$kd_wilayah = get_user_data('kd_wilayah');
		}
		$this->db->where('jenis','pembiayaan');
		$this->db->where('kd_wilayah',$kd_wilayah);
		$this->db->where('periode',$tahun);
        $this->db->order_by('tbl_perencanaan_rencana.kd_rekening', "ASC");
		$query = $this->db->get($this->table_name);

		return $query->result();
	}

    public function join_avaiable() {
        
        return $this;
    }

    public function filter_avaiable() {
        
        return $this;
	}

	public function view(){
		return $this->db->get('tbl_perencanaan_rencana')->result();
	}

	public function upload_file($filename){
		$this->load->library('upload');
		
		$config['upload_path'] = './excel/';
		$config['allowed_types'] = 'xlsx';
		$config['max_size']	= '2048';
		$config['overwrite'] = true;
		$config['file_name'] = $filename;
	
		$this->upload->initialize($config);
		if($this->upload->do_upload('file')){
			$return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
			return $return;
		}else{
			$return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
			return $return;
		}
	}

	public function insert_multiple($data){
		$this->db->insert_batch('tbl_perencanaan_rencana', $data);
	}

}

/* End of file Model_tbl_perencanaan_rencana.php */
/* Location: ./application/models/Model_tbl_perencanaan_rencana.php */