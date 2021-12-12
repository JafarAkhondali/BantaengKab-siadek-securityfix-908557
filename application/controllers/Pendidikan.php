<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Pendidikan Controller
*| --------------------------------------------------------------------------
*| Pendidikan site
*|
*/
class Pendidikan extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_pendidikan');
	}

	/**
	* show all Pendidikans
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('pendidikan_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['pendidikans'] = $this->model_pendidikan->get($filter, $field, $this->limit_page, $offset);
		$this->data['pendidikan_counts'] = $this->model_pendidikan->count_all($filter, $field);

		$config = [
			'base_url'     => 'pendidikan/index/',
			'total_rows'   => $this->model_pendidikan->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 3,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Pendidikan List');
		$this->render('modul/pendidikan/pendidikan_list', $this->data);
	}
	
	/**
	* Add new pendidikans
	*
	*/
	public function add()
	{
		$this->is_allowed('pendidikan_add');

		$this->template->title('Pendidikan New');
		$this->render('modul/pendidikan/pendidikan_add', $this->data);
	}

	/**
	* Add New Pendidikans
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('pendidikan_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('kd_wilayah[]', 'Kd Wilayah', 'trim|required');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'kd_wilayah' => implode(',', (array) $this->input->post('kd_wilayah')),
				'nama_sekolah' => $this->input->post('nama_sekolah'),
				'npsm' => $this->input->post('npsm'),
				'bp' => $this->input->post('bp'),
				'status' => $this->input->post('status'),
				'Jml_Sync' => $this->input->post('Jml_Sync'),
				'pd' => $this->input->post('pd'),
				'rombel' => $this->input->post('rombel'),
				'guru' => $this->input->post('guru'),
				'pegawai' => $this->input->post('pegawai'),
				'ruang_kelas' => $this->input->post('ruang_kelas'),
				'ruang_perpus' => $this->input->post('ruang_perpus'),
				'ruang_lab' => $this->input->post('ruang_lab'),
				'tanggal_update' => $this->input->post('tanggal_update'),
			];

			
			$save_pendidikan = $this->model_pendidikan->store($save_data);

			if ($save_pendidikan) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_pendidikan;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('pendidikan/edit/' . $save_pendidikan, 'Edit Pendidikan'),
						anchor('pendidikan', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('pendidikan/edit/' . $save_pendidikan, 'Edit Pendidikan')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('pendidikan');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('pendidikan');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Pendidikans
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('pendidikan_update');

		$this->data['pendidikan'] = $this->model_pendidikan->find($id);

		$this->template->title('Pendidikan Update');
		$this->render('modul/pendidikan/pendidikan_update', $this->data);
	}

	/**
	* Update Pendidikans
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('pendidikan_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('kd_wilayah[]', 'Kd Wilayah', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'kd_wilayah' => implode(',', (array) $this->input->post('kd_wilayah')),
				'nama_sekolah' => $this->input->post('nama_sekolah'),
				'npsm' => $this->input->post('npsm'),
				'bp' => $this->input->post('bp'),
				'status' => $this->input->post('status'),
				'Jml_Sync' => $this->input->post('Jml_Sync'),
				'pd' => $this->input->post('pd'),
				'rombel' => $this->input->post('rombel'),
				'guru' => $this->input->post('guru'),
				'pegawai' => $this->input->post('pegawai'),
				'ruang_kelas' => $this->input->post('ruang_kelas'),
				'ruang_perpus' => $this->input->post('ruang_perpus'),
				'ruang_lab' => $this->input->post('ruang_lab'),
			];

			
			$save_pendidikan = $this->model_pendidikan->change($id, $save_data);

			if ($save_pendidikan) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('pendidikan', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('pendidikan');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('pendidikan');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Pendidikans
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('pendidikan_delete');

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
            set_message(cclang('has_been_deleted', 'pendidikan'), 'success');
        } else {
            set_message(cclang('error_delete', 'pendidikan'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Pendidikans
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('pendidikan_view');

		$this->data['pendidikan'] = $this->model_pendidikan->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Pendidikan Detail');
		$this->render('modul/pendidikan/pendidikan_view', $this->data);
	}
	
	/**
	* delete Pendidikans
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$pendidikan = $this->model_pendidikan->find($id);

		
		
		return $this->model_pendidikan->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('pendidikan_export');

		$this->model_pendidikan->export('pendidikan', 'pendidikan');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('pendidikan_export');

		$this->model_pendidikan->pdf('pendidikan', 'pendidikan');
	}
}


/* End of file pendidikan.php */
/* Location: ./application/controllers/Pendidikan.php */