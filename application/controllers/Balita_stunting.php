<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Balita Stunting Controller
*| --------------------------------------------------------------------------
*| Balita Stunting site
*|
*/
class Balita_stunting extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_balita_stunting');
	}

	/**
	* show all Balita Stuntings
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('balita_stunting_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['balita_stuntings'] = $this->model_balita_stunting->get($filter, $field, $this->limit_page, $offset);
		$this->data['balita_stunting_counts'] = $this->model_balita_stunting->count_all($filter, $field);

		$config = [
			'base_url'     => 'balita_stunting/index/',
			'total_rows'   => $this->model_balita_stunting->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 3,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Balita Stunting List');
		$this->render('modul/balita_stunting/balita_stunting_list', $this->data);
	}
	
	/**
	* Add new balita_stuntings
	*
	*/
	public function add()
	{
		$this->is_allowed('balita_stunting_add');

		$this->template->title('Balita Stunting New');
		$this->render('modul/balita_stunting/balita_stunting_add', $this->data);
	}

	/**
	* Add New Balita Stuntings
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('balita_stunting_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('tb_lahir', 'Tb Lahir', 'trim|required|max_length[100]');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'kd_wilayah' => $this->input->post('kd_wilayah'),
				'nik' => $this->input->post('nik'),
				'nama' => $this->input->post('nama'),
				'jenis_kelamin' => $this->input->post('jenis_kelamin'),
				'tanggal_lahir' => $this->input->post('tanggal_lahir'),
				'bb_lahir' => $this->input->post('bb_lahir'),
				'tb_lahir' => $this->input->post('tb_lahir'),
				'nama_ortu' => $this->input->post('nama_ortu'),
				'posyandu' => $this->input->post('posyandu'),
				'alamat' => $this->input->post('alamat'),
				'usia_saat_diukur' => $this->input->post('usia_saat_diukur'),
				'tanggal_pengukur' => $this->input->post('tanggal_pengukur'),
				'berat' => $this->input->post('berat'),
				'tinggi' => $this->input->post('tinggi'),
				'lila' => $this->input->post('lila'),
				'tb_u' => $this->input->post('tb_u'),
				'zs_tb_u' => $this->input->post('zs_tb_u'),
				'user_masuk' => get_user_data('username'),
				'waktu_masuk' => date('Y-m-d H:i:s'),
				'user_update' => get_user_data('username'),
			];

			
			$save_balita_stunting = $this->model_balita_stunting->store($save_data);

			if ($save_balita_stunting) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_balita_stunting;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('balita_stunting/edit/' . $save_balita_stunting, 'Edit Balita Stunting'),
						anchor('balita_stunting', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('balita_stunting/edit/' . $save_balita_stunting, 'Edit Balita Stunting')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('balita_stunting');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('balita_stunting');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Balita Stuntings
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('balita_stunting_update');

		$this->data['balita_stunting'] = $this->model_balita_stunting->find($id);

		$this->template->title('Balita Stunting Update');
		$this->render('modul/balita_stunting/balita_stunting_update', $this->data);
	}

	/**
	* Update Balita Stuntings
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('balita_stunting_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('tb_lahir', 'Tb Lahir', 'trim|required|max_length[100]');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'kd_wilayah' => $this->input->post('kd_wilayah'),
				'nik' => $this->input->post('nik'),
				'nama' => $this->input->post('nama'),
				'jenis_kelamin' => $this->input->post('jenis_kelamin'),
				'tanggal_lahir' => $this->input->post('tanggal_lahir'),
				'bb_lahir' => $this->input->post('bb_lahir'),
				'tb_lahir' => $this->input->post('tb_lahir'),
				'nama_ortu' => $this->input->post('nama_ortu'),
				'posyandu' => $this->input->post('posyandu'),
				'alamat' => $this->input->post('alamat'),
				'usia_saat_diukur' => $this->input->post('usia_saat_diukur'),
				'tanggal_pengukur' => $this->input->post('tanggal_pengukur'),
				'berat' => $this->input->post('berat'),
				'tinggi' => $this->input->post('tinggi'),
				'lila' => $this->input->post('lila'),
				'tb_u' => $this->input->post('tb_u'),
				'zs_tb_u' => $this->input->post('zs_tb_u'),
				'user_masuk' => get_user_data('username'),
				'user_update' => get_user_data('username'),
				'waktu_update' => date('Y-m-d H:i:s'),
			];

			
			$save_balita_stunting = $this->model_balita_stunting->change($id, $save_data);

			if ($save_balita_stunting) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('balita_stunting', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('balita_stunting');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('balita_stunting');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Balita Stuntings
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('balita_stunting_delete');

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
            set_message(cclang('has_been_deleted', 'balita_stunting'), 'success');
        } else {
            set_message(cclang('error_delete', 'balita_stunting'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Balita Stuntings
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('balita_stunting_view');

		$this->data['balita_stunting'] = $this->model_balita_stunting->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Balita Stunting Detail');
		$this->render('modul/balita_stunting/balita_stunting_view', $this->data);
	}
	
	/**
	* delete Balita Stuntings
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$balita_stunting = $this->model_balita_stunting->find($id);

		
		
		return $this->model_balita_stunting->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('balita_stunting_export');

		$this->model_balita_stunting->export('balita_stunting', 'balita_stunting');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('balita_stunting_export');

		$this->model_balita_stunting->pdf('balita_stunting', 'balita_stunting');
	}
}


/* End of file balita_stunting.php */
/* Location: ./application/controllers/Balita Stunting.php */