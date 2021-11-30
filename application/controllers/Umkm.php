<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Umkm Controller
*| --------------------------------------------------------------------------
*| Umkm site
*|
*/
class Umkm extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_umkm');
	}

	/**
	* show all Umkms
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('umkm_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['umkms'] = $this->model_umkm->get($filter, $field, $this->limit_page, $offset);
		$this->data['umkm_counts'] = $this->model_umkm->count_all($filter, $field);

		$config = [
			'base_url'     => 'umkm/index/',
			'total_rows'   => $this->model_umkm->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 3,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Umkm List');
		$this->render('modul/umkm/umkm_list', $this->data);
	}
	
	/**
	* Add new umkms
	*
	*/
	public function add()
	{
		$this->is_allowed('umkm_add');

		$this->template->title('Umkm New');
		$this->render('modul/umkm/umkm_add', $this->data);
	}

	/**
	* Add New Umkms
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('umkm_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'nama_pelaku_usaha' => $this->input->post('nama_pelaku_usaha'),
				'nik' => $this->input->post('nik'),
				'jenis_kelamin' => $this->input->post('jenis_kelamin'),
				'pr' => implode(',', (array) $this->input->post('pr')),
				'js' => implode(',', (array) $this->input->post('js')),
				'pd' => implode(',', (array) $this->input->post('pd')),
				'wr' => implode(',', (array) $this->input->post('wr')),
				'bd' => implode(',', (array) $this->input->post('bd')),
				'jenis_usaha' => $this->input->post('jenis_usaha'),
				'manusia' => $this->input->post('manusia'),
				'alam' => $this->input->post('alam'),
				'lahan_bagunan' => $this->input->post('lahan_bagunan'),
				'mesin_alat' => $this->input->post('mesin_alat'),
				'finansial' => $this->input->post('finansial'),
				'ket_finansial' => $this->input->post('ket_finansial'),
				'pasar' => $this->input->post('pasar'),
				'mitra' => $this->input->post('mitra'),
				'lokasi' => $this->input->post('lokasi'),
				'bentuk_org' => $this->input->post('bentuk_org'),
				'kegiatan' => $this->input->post('kegiatan'),
				'mulai_usaha' => $this->input->post('mulai_usaha'),
				'moral' => $this->input->post('moral'),
				'aturan' => $this->input->post('aturan'),
			];

			
			$save_umkm = $this->model_umkm->store($save_data);

			if ($save_umkm) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_umkm;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('umkm/edit/' . $save_umkm, 'Edit Umkm'),
						anchor('umkm', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('umkm/edit/' . $save_umkm, 'Edit Umkm')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('umkm');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('umkm');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Umkms
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('umkm_update');

		$this->data['umkm'] = $this->model_umkm->find($id);

		$this->template->title('Umkm Update');
		$this->render('modul/umkm/umkm_update', $this->data);
	}

	/**
	* Update Umkms
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('umkm_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'nama_pelaku_usaha' => $this->input->post('nama_pelaku_usaha'),
				'nik' => $this->input->post('nik'),
				'jenis_kelamin' => $this->input->post('jenis_kelamin'),
				'pr' => implode(',', (array) $this->input->post('pr')),
				'js' => implode(',', (array) $this->input->post('js')),
				'pd' => implode(',', (array) $this->input->post('pd')),
				'wr' => implode(',', (array) $this->input->post('wr')),
				'bd' => implode(',', (array) $this->input->post('bd')),
				'jenis_usaha' => $this->input->post('jenis_usaha'),
				'manusia' => $this->input->post('manusia'),
				'alam' => $this->input->post('alam'),
				'lahan_bagunan' => $this->input->post('lahan_bagunan'),
				'mesin_alat' => $this->input->post('mesin_alat'),
				'finansial' => $this->input->post('finansial'),
				'ket_finansial' => $this->input->post('ket_finansial'),
				'pasar' => $this->input->post('pasar'),
				'mitra' => $this->input->post('mitra'),
				'lokasi' => $this->input->post('lokasi'),
				'bentuk_org' => $this->input->post('bentuk_org'),
				'kegiatan' => $this->input->post('kegiatan'),
				'mulai_usaha' => $this->input->post('mulai_usaha'),
				'moral' => $this->input->post('moral'),
				'aturan' => $this->input->post('aturan'),
			];

			
			$save_umkm = $this->model_umkm->change($id, $save_data);

			if ($save_umkm) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('umkm', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('umkm');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('umkm');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Umkms
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('umkm_delete');

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
            set_message(cclang('has_been_deleted', 'umkm'), 'success');
        } else {
            set_message(cclang('error_delete', 'umkm'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Umkms
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('umkm_view');

		$this->data['umkm'] = $this->model_umkm->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Umkm Detail');
		$this->render('modul/umkm/umkm_view', $this->data);
	}
	
	/**
	* delete Umkms
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$umkm = $this->model_umkm->find($id);

		
		
		return $this->model_umkm->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('umkm_export');

		$this->model_umkm->export('umkm', 'umkm');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('umkm_export');

		$this->model_umkm->pdf('umkm', 'umkm');
	}
}


/* End of file umkm.php */
/* Location: ./application/controllers/Umkm.php */