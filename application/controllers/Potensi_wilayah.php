<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Potensi Wilayah Controller
*| --------------------------------------------------------------------------
*| Potensi Wilayah site
*|
*/
class Potensi_wilayah extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_potensi_wilayah');
	}

	/**
	* show all Potensi Wilayahs
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('potensi_wilayah_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['potensi_wilayahs'] = $this->model_potensi_wilayah->get($filter, $field, $this->limit_page, $offset);
		$this->data['potensi_wilayah_counts'] = $this->model_potensi_wilayah->count_all($filter, $field);

		$config = [
			'base_url'     => 'potensi_wilayah/index/',
			'total_rows'   => $this->model_potensi_wilayah->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 3,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Potensi Wilayah List');
		$this->render('modul/potensi_wilayah/potensi_wilayah_list', $this->data);
	}
	
	/**
	* Add new potensi_wilayahs
	*
	*/
	public function add()
	{
		$this->is_allowed('potensi_wilayah_add');

		$this->template->title('Potensi Wilayah New');
		$this->render('modul/potensi_wilayah/potensi_wilayah_add', $this->data);
	}

	/**
	* Add New Potensi Wilayahs
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('potensi_wilayah_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('kategori_potensi', 'Kategori Potensi', 'trim|required|max_length[100]');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
			    'kd_wilayah' => get_user_data('kd_wilayah'),
				'kategori_potensi' => $this->input->post('kategori_potensi'),
				'potensi_wilayah' => $this->input->post('potensi_wilayah'),
				'keterangan' => $this->input->post('keterangan'),
				'created_by' => get_user_data('username'),
				'creation_date' => date('Y-m-d H:i:s'),
			];

			
			$save_potensi_wilayah = $this->model_potensi_wilayah->store($save_data);

			if ($save_potensi_wilayah) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_potensi_wilayah;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('potensi_wilayah/edit/' . $save_potensi_wilayah, 'Edit Potensi Wilayah'),
						anchor('potensi_wilayah', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('potensi_wilayah/edit/' . $save_potensi_wilayah, 'Edit Potensi Wilayah')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('potensi_wilayah');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('potensi_wilayah');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Potensi Wilayahs
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('potensi_wilayah_update');

		$this->data['potensi_wilayah'] = $this->model_potensi_wilayah->find($id);

		$this->template->title('Potensi Wilayah Update');
		$this->render('modul/potensi_wilayah/potensi_wilayah_update', $this->data);
	}

	/**
	* Update Potensi Wilayahs
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('potensi_wilayah_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('kategori_potensi', 'Kategori Potensi', 'trim|required|max_length[100]');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'kategori_potensi' => $this->input->post('kategori_potensi'),
				'potensi_wilayah' => $this->input->post('potensi_wilayah'),
				'keterangan' => $this->input->post('keterangan'),
				'last_updated_by' => get_user_data('username'),
				'last_updated_date' => date('Y-m-d H:i:s'),
			];

			
			$save_potensi_wilayah = $this->model_potensi_wilayah->change($id, $save_data);

			if ($save_potensi_wilayah) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('potensi_wilayah', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('potensi_wilayah');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('potensi_wilayah');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Potensi Wilayahs
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('potensi_wilayah_delete');

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
            set_message(cclang('has_been_deleted', 'potensi_wilayah'), 'success');
        } else {
            set_message(cclang('error_delete', 'potensi_wilayah'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Potensi Wilayahs
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('potensi_wilayah_view');

		$this->data['potensi_wilayah'] = $this->model_potensi_wilayah->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Potensi Wilayah Detail');
		$this->render('modul/potensi_wilayah/potensi_wilayah_view', $this->data);
	}
	
	/**
	* delete Potensi Wilayahs
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$potensi_wilayah = $this->model_potensi_wilayah->find($id);

		
		
		return $this->model_potensi_wilayah->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('potensi_wilayah_export');

		$this->model_potensi_wilayah->export('potensi_wilayah', 'potensi_wilayah');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('potensi_wilayah_export');

		$this->model_potensi_wilayah->pdf('potensi_wilayah', 'potensi_wilayah');
	}
}


/* End of file potensi_wilayah.php */
/* Location: ./application/controllers/Potensi Wilayah.php */