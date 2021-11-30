<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Wilayah Profil Controller
*| --------------------------------------------------------------------------
*| Wilayah Profil site
*|
*/
class Wilayah_profil extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_wilayah_profil');
	}

	/**
	* show all Wilayah Profils
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('wilayah_profil_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['wilayah_profils'] = $this->model_wilayah_profil->get($filter, $field, $this->limit_page, $offset);
		$this->data['wilayah_profil_counts'] = $this->model_wilayah_profil->count_all($filter, $field);
//		$this->data['wilayah_perangkats'] =  $this->db->join('wilayah_perangkat','wilayah_perangkat.kd_wilayah = wilayah_profil.kd_wilayah');
		$config = [
			'base_url'     => 'wilayah_profil/index/',
			'total_rows'   => $this->model_wilayah_profil->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 3,
		];
		
$this->data['pagination'] = $this->pagination($config);
		
		$this->template->title('Wilayah Profil List');
		$this->data['pagination'] = $this->pagination($config);
		
		$user=get_user_data('kd_wilayah');
		$this->db->from('wilayah_profil');
		$this->db->where('kd_wilayah', get_user_data('kd_wilayah'));
		$exist = $this->db->get()->row();
		if (empty($exist))
           { $this->render('modul/wilayah_profil/wilayah_profil_blak', $this->data);}
		else if(strlen($user)==10){
        	$this->render('modul/wilayah_profil/wilayah_profil_list_desa', $this->data);
        }else {
            $this->render('modul/wilayah_profil/wilayah_profil_list_kec', $this->data);
		}
	}
	
	/**
	* Add new wilayah_profils
	*
	*/
	public function add()
	{
		$this->is_allowed('wilayah_profil_add');

		$this->template->title('Wilayah Profil New');
		$this->render('modul/wilayah_profil/wilayah_profil_add', $this->data);
	}

	/**
	* Add New Wilayah Profils
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('wilayah_profil_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('kd_wilayah[]', 'Kd Wilayah', 'trim|required|max_length[30]');
		$this->form_validation->set_rules('alamat_kantor', 'Alamat Kantor', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('luas', 'Luas', 'trim|max_length[12]');
		$this->form_validation->set_rules('utara', 'Utara', 'trim|max_length[50]');
		$this->form_validation->set_rules('timur', 'Timur', 'trim|max_length[50]');
		$this->form_validation->set_rules('selatan', 'Selatan', 'trim|max_length[50]');
		$this->form_validation->set_rules('barat', 'Barat', 'trim|max_length[50]');
		$this->form_validation->set_rules('tahun_pembentukan', 'Tahun Pembentukan', 'trim|max_length[4]');
		$this->form_validation->set_rules('kd_pos', 'Kd Pos', 'trim|required|max_length[15]');
		$this->form_validation->set_rules('tipologi', 'Tipologi', 'trim|max_length[50]');
		$this->form_validation->set_rules('wilayah_profil_foto_name[]', 'Foto', 'trim');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'kd_wilayah' => implode(',', (array) $this->input->post('kd_wilayah')),
				'alamat_kantor' => $this->input->post('alamat_kantor'),
				'luas' => $this->input->post('luas'),
				'utara' => $this->input->post('utara'),
				'timur' => $this->input->post('timur'),
				'selatan' => $this->input->post('selatan'),
				'barat' => $this->input->post('barat'),
				'sejarah' => $this->input->post('sejarah'),
				'tahun_pembentukan' => $this->input->post('tahun_pembentukan'),
				'dasar_hukum' => $this->input->post('dasar_hukum'),
				'kd_pos' => $this->input->post('kd_pos'),
				'tipologi' => $this->input->post('tipologi'),
				'lokasi' => $this->input->post('lokasi'),
				'visi_misi' => $this->input->post('visi_misi'),
			];

			if (!is_dir(FCPATH . '/uploads/wilayah_profil/')) {
				mkdir(FCPATH . '/uploads/wilayah_profil/');
			}

			if (count((array) $this->input->post('wilayah_profil_foto_name'))) {
				foreach ((array) $_POST['wilayah_profil_foto_name'] as $idx => $file_name) {
					$wilayah_profil_foto_name_copy = date('YmdHis') . '-' . $file_name;

					rename(FCPATH . 'uploads/tmp/' . $_POST['wilayah_profil_foto_uuid'][$idx] . '/' .  $file_name, 
							FCPATH . 'uploads/wilayah_profil/' . $wilayah_profil_foto_name_copy);

					$listed_image[] = $wilayah_profil_foto_name_copy;

					if (!is_file(FCPATH . '/uploads/wilayah_profil/' . $wilayah_profil_foto_name_copy)) {
						echo json_encode([
							'success' => false,
							'message' => 'Error uploading file'
							]);
						exit;
					}
				}

				$save_data['foto'] = implode($listed_image, ',');
			}
		
			
			$save_wilayah_profil = $this->model_wilayah_profil->store($save_data);

			if ($save_wilayah_profil) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_wilayah_profil;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('wilayah_profil/edit/' . $save_wilayah_profil, 'Edit Wilayah Profil'),
						anchor('wilayah_profil', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('wilayah_profil/edit/' . $save_wilayah_profil, 'Edit Wilayah Profil')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('wilayah_profil');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('wilayah_profil');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Wilayah Profils
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('wilayah_profil_update');

		$this->data['wilayah_profil'] = $this->model_wilayah_profil->find($id);

		$this->template->title('Wilayah Profil Update');
		$this->render('modul/wilayah_profil/wilayah_profil_update', $this->data);
	}

	/**
	* Update Wilayah Profils
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('wilayah_profil_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
	
		$this->form_validation->set_rules('alamat_kantor', 'Alamat Kantor', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('luas', 'Luas', 'trim|max_length[12]');
		$this->form_validation->set_rules('utara', 'Utara', 'trim|max_length[50]');
		$this->form_validation->set_rules('timur', 'Timur', 'trim|max_length[50]');
		$this->form_validation->set_rules('selatan', 'Selatan', 'trim|max_length[50]');
		$this->form_validation->set_rules('barat', 'Barat', 'trim|max_length[50]');
		$this->form_validation->set_rules('tahun_pembentukan', 'Tahun Pembentukan', 'trim|max_length[4]');
		$this->form_validation->set_rules('kd_pos', 'Kd Pos', 'trim|required|max_length[15]');
		$this->form_validation->set_rules('tipologi', 'Tipologi', 'trim|max_length[50]');
		$this->form_validation->set_rules('wilayah_profil_foto_name[]', 'Foto', 'trim');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				
				'alamat_kantor' => $this->input->post('alamat_kantor'),
				'luas' => $this->input->post('luas'),
				'utara' => $this->input->post('utara'),
				'timur' => $this->input->post('timur'),
				'selatan' => $this->input->post('selatan'),
				'barat' => $this->input->post('barat'),
				'sejarah' => $this->input->post('sejarah'),
				'tahun_pembentukan' => $this->input->post('tahun_pembentukan'),
				'dasar_hukum' => $this->input->post('dasar_hukum'),
				'kd_pos' => $this->input->post('kd_pos'),
				'tipologi' => $this->input->post('tipologi'),
				'lokasi' => $this->input->post('lokasi'),
				'visi_misi' => $this->input->post('visi_misi'),
			];

			$listed_image = [];
			if (count((array) $this->input->post('wilayah_profil_foto_name'))) {
				foreach ((array) $_POST['wilayah_profil_foto_name'] as $idx => $file_name) {
					if (isset($_POST['wilayah_profil_foto_uuid'][$idx]) AND !empty($_POST['wilayah_profil_foto_uuid'][$idx])) {
						$wilayah_profil_foto_name_copy = date('YmdHis') . '-' . $file_name;

						rename(FCPATH . 'uploads/tmp/' . $_POST['wilayah_profil_foto_uuid'][$idx] . '/' .  $file_name, 
								FCPATH . 'uploads/wilayah_profil/' . $wilayah_profil_foto_name_copy);

						$listed_image[] = $wilayah_profil_foto_name_copy;

						if (!is_file(FCPATH . '/uploads/wilayah_profil/' . $wilayah_profil_foto_name_copy)) {
							echo json_encode([
								'success' => false,
								'message' => 'Error uploading file'
								]);
							exit;
						}
					} else {
						$listed_image[] = $file_name;
					}
				}
			}
			
			$save_data['foto'] = implode($listed_image, ',');
		
			
			$save_wilayah_profil = $this->model_wilayah_profil->change($id, $save_data);

			if ($save_wilayah_profil) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('wilayah_profil', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('wilayah_profil');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('wilayah_profil');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Wilayah Profils
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('wilayah_profil_delete');

		$this->load->helper('file');

		$arr_id = $this->input->get('id');
		$remove = false;

		if (!empty($id)) {
			$remove = $this->_remove($id);
		} elseif (count($arr_id) >0) {
			foreach ($arr_id as $id) {
				$remove = $this->_remove($id);
			}
		}

		if ($remove) {
            set_message(cclang('has_been_deleted', 'wilayah_profil'), 'success');
        } else {
            set_message(cclang('error_delete', 'wilayah_profil'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Wilayah Profils
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('wilayah_profil_view');

		$this->data['wilayah_profil'] = $this->model_wilayah_profil->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Wilayah Profil Detail');
		$this->render('modul/wilayah_profil/wilayah_profil_view', $this->data);
	}
	
	/**
	* delete Wilayah Profils
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$wilayah_profil = $this->model_wilayah_profil->find($id);

		
		if (!empty($wilayah_profil->foto)) {
			foreach ((array) explode(',', $wilayah_profil->foto) as $filename) {
				$path = FCPATH . '/uploads/wilayah_profil/' . $filename;

				if (is_file($path)) {
					$delete_file = unlink($path);
				}
			}
		}
		
		return $this->model_wilayah_profil->remove($id);
	}
	
	
	/**
	* Upload Image Wilayah Profil	* 
	* @return JSON
	*/
	public function upload_foto_file()
	{
		if (!$this->is_allowed('wilayah_profil_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'wilayah_profil',
			'allowed_types' => 'jpeg|jpg|png',
			'max_size' 	 	=> 2000,
		]);
	}

	/**
	* Delete Image Wilayah Profil	* 
	* @return JSON
	*/
	public function delete_foto_file($uuid)
	{
		if (!$this->is_allowed('wilayah_profil_delete', false)) {
			echo json_encode([
				'success' => false,
				'error' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		echo $this->delete_file([
            'uuid'              => $uuid, 
            'delete_by'         => $this->input->get('by'), 
            'field_name'        => 'foto', 
            'upload_path_tmp'   => './uploads/tmp/',
            'table_name'        => 'wilayah_profil',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/wilayah_profil/'
        ]);
	}

	/**
	* Get Image Wilayah Profil	* 
	* @return JSON
	*/
	public function get_foto_file($id)
	{
		if (!$this->is_allowed('wilayah_profil_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$wilayah_profil = $this->model_wilayah_profil->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'foto', 
            'table_name'        => 'wilayah_profil',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/wilayah_profil/',
            'delete_endpoint'   => 'wilayah_profil/delete_foto_file'
        ]);
	}
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('wilayah_profil_export');

		$this->model_wilayah_profil->export('wilayah_profil', 'wilayah_profil');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('wilayah_profil_export');

		$this->model_wilayah_profil->pdf('wilayah_profil', 'wilayah_profil');
	}
}


/* End of file wilayah_profil.php */
/* Location: ./application/controllers/Wilayah Profil.php */