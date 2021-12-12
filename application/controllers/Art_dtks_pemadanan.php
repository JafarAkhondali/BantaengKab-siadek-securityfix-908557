<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Art Dtks Pemadanan Controller
*| --------------------------------------------------------------------------
*| Art Dtks Pemadanan site
*|
*/
class Art_dtks_pemadanan extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_art_dtks_pemadanan');
	}

	/**
	* show all Art Dtks Pemadanans
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('art_dtks_pemadanan_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['art_dtks_pemadanans'] = $this->model_art_dtks_pemadanan->get($filter, $field, $this->limit_page, $offset);
		$this->data['art_dtks_pemadanan_counts'] = $this->model_art_dtks_pemadanan->count_all($filter, $field);

		$config = [
			'base_url'     => 'art_dtks_pemadanan/index/',
			'total_rows'   => $this->model_art_dtks_pemadanan->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 3,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Art Dtks Pemadanan List');
		$this->render('modul/art_dtks_pemadanan/art_dtks_pemadanan_list', $this->data);
	}
	
	/**
	* Add new art_dtks_pemadanans
	*
	*/
	public function add()
	{
		$this->is_allowed('art_dtks_pemadanan_add');

		$this->template->title('Art Dtks Pemadanan New');
		$this->render('modul/art_dtks_pemadanan/art_dtks_pemadanan_add', $this->data);
	}

	/**
	* Add New Art Dtks Pemadanans
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('art_dtks_pemadanan_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('kd_wilayah', 'Kd Wilayah', 'trim|required');
		$this->form_validation->set_rules('IDBDT', 'IDBDT', 'trim|required');
		$this->form_validation->set_rules('IDARTBDT', 'IDARTBDT', 'trim|required');
		$this->form_validation->set_rules('KDKEC', 'KDKEC', 'trim|required');
		$this->form_validation->set_rules('KDDESA', 'KDDESA', 'trim|required');
		$this->form_validation->set_rules('NoPesertaPKH', 'NoPesertaPKH', 'trim|required');
		$this->form_validation->set_rules('Nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('JnsKel', 'JnsKel', 'trim|required');
		$this->form_validation->set_rules('TmpLahir', 'TmpLahir', 'trim|required');
		$this->form_validation->set_rules('TglLahir', 'TglLahir', 'trim|required');
		$this->form_validation->set_rules('HubKRT', 'HubKRT', 'trim|required');
		$this->form_validation->set_rules('NIK', 'NIK', 'trim|required');
		$this->form_validation->set_rules('NoKK', 'NoKK', 'trim|required');
		$this->form_validation->set_rules('Hub_KRT', 'Hub KRT', 'trim|required');
		$this->form_validation->set_rules('NUK', 'NUK', 'trim|required');
		$this->form_validation->set_rules('Hubkel', 'Hubkel', 'trim|required');
		$this->form_validation->set_rules('Umur', 'Umur', 'trim|required');
		$this->form_validation->set_rules('Sta_kawin', 'Sta Kawin', 'trim|required');
		$this->form_validation->set_rules('Ada_akta_nikah', 'Ada Akta Nikah', 'trim|required');
		$this->form_validation->set_rules('Ada_diKK', 'Ada DiKK', 'trim|required');
		$this->form_validation->set_rules('Ada_kartu_identitas', 'Ada Kartu Identitas', 'trim|required');
		$this->form_validation->set_rules('Sta_hamil', 'Sta Hamil', 'trim|required');
		$this->form_validation->set_rules('Jenis_cacat', 'Jenis Cacat', 'trim|required');
		$this->form_validation->set_rules('Penyakit_kronis', 'Penyakit Kronis', 'trim|required');
		$this->form_validation->set_rules('Partisipasi_sekolah', 'Partisipasi Sekolah', 'trim|required');
		$this->form_validation->set_rules('Pendidikan_tertinggi', 'Pendidikan Tertinggi', 'trim|required');
		$this->form_validation->set_rules('Kelas_tertinggi', 'Kelas Tertinggi', 'trim|required');
		$this->form_validation->set_rules('Ijazah_tertinggi', 'Ijazah Tertinggi', 'trim|required');
		$this->form_validation->set_rules('Sta_Bekerja', 'Sta Bekerja', 'trim|required');
		$this->form_validation->set_rules('Jumlah_jamkerja', 'Jumlah Jamkerja', 'trim|required');
		$this->form_validation->set_rules('Lapangan_usaha', 'Lapangan Usaha', 'trim|required');
		$this->form_validation->set_rules('Status_pekerjaan', 'Status Pekerjaan', 'trim|required');
		$this->form_validation->set_rules('Sta_keberadaan_art', 'Sta Keberadaan Art', 'trim|required');
		$this->form_validation->set_rules('Sta_kepesertaan_pbi', 'Sta Kepesertaan Pbi', 'trim|required');
		$this->form_validation->set_rules('Ada_kks', 'Ada Kks', 'trim|required');
		$this->form_validation->set_rules('Ada_pbi', 'Ada Pbi', 'trim|required');
		$this->form_validation->set_rules('Ada_kip', 'Ada Kip', 'trim|required');
		$this->form_validation->set_rules('Ada_pkh', 'Ada Pkh', 'trim|required');
		$this->form_validation->set_rules('Ada_BPNT', 'Ada BPNT', 'trim|required');
		$this->form_validation->set_rules('Anak_diluar_rt', 'Anak Diluar Rt', 'trim|required');
		$this->form_validation->set_rules('namagadis_ibukandung', 'Namagadis Ibukandung', 'trim|required');
		$this->form_validation->set_rules('Status[]', 'Status', 'trim|required');
		$this->form_validation->set_rules('periode', 'Periode', 'trim|required');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'kd_wilayah' => $this->input->post('kd_wilayah'),
				'IDBDT' => $this->input->post('IDBDT'),
				'IDARTBDT' => $this->input->post('IDARTBDT'),
				'KDPROP' => "73",
				'KDKAB' => "7303",
				'KDKEC' => $this->input->post('KDKEC'),
				'KDDESA' => $this->input->post('KDDESA'),
				'NoPesertaPKH' => $this->input->post('NoPesertaPKH'),
				'Nama' => $this->input->post('Nama'),
				'JnsKel' => $this->input->post('JnsKel'),
				'TmpLahir' => $this->input->post('TmpLahir'),
				'TglLahir' => $this->input->post('TglLahir'),
				'HubKRT' => $this->input->post('HubKRT'),
				'NIK' => $this->input->post('NIK'),
				'NoKK' => $this->input->post('NoKK'),
				'Hub_KRT' => $this->input->post('Hub_KRT'),
				'NUK' => $this->input->post('NUK'),
				'Hubkel' => $this->input->post('Hubkel'),
				'Umur' => $this->input->post('Umur'),
				'Sta_kawin' => $this->input->post('Sta_kawin'),
				'Ada_akta_nikah' => $this->input->post('Ada_akta_nikah'),
				'Ada_diKK' => $this->input->post('Ada_diKK'),
				'Ada_kartu_identitas' => $this->input->post('Ada_kartu_identitas'),
				'Sta_hamil' => $this->input->post('Sta_hamil'),
				'Jenis_cacat' => $this->input->post('Jenis_cacat'),
				'Penyakit_kronis' => $this->input->post('Penyakit_kronis'),
				'Partisipasi_sekolah' => $this->input->post('Partisipasi_sekolah'),
				'Pendidikan_tertinggi' => $this->input->post('Pendidikan_tertinggi'),
				'Kelas_tertinggi' => $this->input->post('Kelas_tertinggi'),
				'Ijazah_tertinggi' => $this->input->post('Ijazah_tertinggi'),
				'Sta_Bekerja' => $this->input->post('Sta_Bekerja'),
				'Jumlah_jamkerja' => $this->input->post('Jumlah_jamkerja'),
				'Lapangan_usaha' => $this->input->post('Lapangan_usaha'),
				'Status_pekerjaan' => $this->input->post('Status_pekerjaan'),
				'Sta_keberadaan_art' => $this->input->post('Sta_keberadaan_art'),
				'Sta_kepesertaan_pbi' => $this->input->post('Sta_kepesertaan_pbi'),
				'Ada_kks' => $this->input->post('Ada_kks'),
				'Ada_pbi' => $this->input->post('Ada_pbi'),
				'Ada_kip' => $this->input->post('Ada_kip'),
				'Ada_pkh' => $this->input->post('Ada_pkh'),
				'Ada_BPNT' => $this->input->post('Ada_BPNT'),
				'Anak_diluar_rt' => $this->input->post('Anak_diluar_rt'),
				'namagadis_ibukandung' => $this->input->post('namagadis_ibukandung'),
				'Status' => implode(',', (array) $this->input->post('Status')),
				'periode' => $this->input->post('periode'),
			];

			
			$save_art_dtks_pemadanan = $this->model_art_dtks_pemadanan->store($save_data);

			if ($save_art_dtks_pemadanan) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_art_dtks_pemadanan;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('art_dtks_pemadanan/edit/' . $save_art_dtks_pemadanan, 'Edit Art Dtks Pemadanan'),
						anchor('art_dtks_pemadanan', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('art_dtks_pemadanan/edit/' . $save_art_dtks_pemadanan, 'Edit Art Dtks Pemadanan')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('art_dtks_pemadanan');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('art_dtks_pemadanan');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Art Dtks Pemadanans
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('art_dtks_pemadanan_update');

		$this->data['art_dtks_pemadanan'] = $this->model_art_dtks_pemadanan->find($id);

		$this->template->title('Art Dtks Pemadanan Update');
		$this->render('modul/art_dtks_pemadanan/art_dtks_pemadanan_update', $this->data);
	}

	/**
	* Update Art Dtks Pemadanans
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('art_dtks_pemadanan_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('kd_wilayah', 'Kd Wilayah', 'trim|required');
		$this->form_validation->set_rules('IDBDT', 'IDBDT', 'trim|required');
		$this->form_validation->set_rules('IDARTBDT', 'IDARTBDT', 'trim|required');
		$this->form_validation->set_rules('KDPROP', 'KDPROP', 'trim|required');
		$this->form_validation->set_rules('KDKAB', 'KDKAB', 'trim|required');
		$this->form_validation->set_rules('KDKEC', 'KDKEC', 'trim|required');
		$this->form_validation->set_rules('KDDESA', 'KDDESA', 'trim|required');
		$this->form_validation->set_rules('NoPesertaPKH', 'NoPesertaPKH', 'trim|required');
		$this->form_validation->set_rules('Nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('JnsKel', 'JnsKel', 'trim|required');
		$this->form_validation->set_rules('TmpLahir', 'TmpLahir', 'trim|required');
		$this->form_validation->set_rules('TglLahir', 'TglLahir', 'trim|required');
		$this->form_validation->set_rules('HubKRT', 'HubKRT', 'trim|required');
		$this->form_validation->set_rules('NIK', 'NIK', 'trim|required');
		$this->form_validation->set_rules('NoKK', 'NoKK', 'trim|required');
		$this->form_validation->set_rules('Hub_KRT', 'Hub KRT', 'trim|required');
		$this->form_validation->set_rules('NUK', 'NUK', 'trim|required');
		$this->form_validation->set_rules('Hubkel', 'Hubkel', 'trim|required');
		$this->form_validation->set_rules('Umur', 'Umur', 'trim|required');
		$this->form_validation->set_rules('Sta_kawin', 'Sta Kawin', 'trim|required');
		$this->form_validation->set_rules('Ada_akta_nikah', 'Ada Akta Nikah', 'trim|required');
		$this->form_validation->set_rules('Ada_diKK', 'Ada DiKK', 'trim|required');
		$this->form_validation->set_rules('Ada_kartu_identitas', 'Ada Kartu Identitas', 'trim|required');
		$this->form_validation->set_rules('Sta_hamil', 'Sta Hamil', 'trim|required');
		$this->form_validation->set_rules('Jenis_cacat', 'Jenis Cacat', 'trim|required');
		$this->form_validation->set_rules('Penyakit_kronis', 'Penyakit Kronis', 'trim|required');
		$this->form_validation->set_rules('Partisipasi_sekolah', 'Partisipasi Sekolah', 'trim|required');
		$this->form_validation->set_rules('Pendidikan_tertinggi', 'Pendidikan Tertinggi', 'trim|required');
		$this->form_validation->set_rules('Kelas_tertinggi', 'Kelas Tertinggi', 'trim|required');
		$this->form_validation->set_rules('Ijazah_tertinggi', 'Ijazah Tertinggi', 'trim|required');
		$this->form_validation->set_rules('Sta_Bekerja', 'Sta Bekerja', 'trim|required');
		$this->form_validation->set_rules('Jumlah_jamkerja', 'Jumlah Jamkerja', 'trim|required');
		$this->form_validation->set_rules('Lapangan_usaha', 'Lapangan Usaha', 'trim|required');
		$this->form_validation->set_rules('Status_pekerjaan', 'Status Pekerjaan', 'trim|required');
		$this->form_validation->set_rules('Sta_keberadaan_art', 'Sta Keberadaan Art', 'trim|required');
		$this->form_validation->set_rules('Sta_kepesertaan_pbi', 'Sta Kepesertaan Pbi', 'trim|required');
		$this->form_validation->set_rules('Ada_kks', 'Ada Kks', 'trim|required');
		$this->form_validation->set_rules('Ada_pbi', 'Ada Pbi', 'trim|required');
		$this->form_validation->set_rules('Ada_kip', 'Ada Kip', 'trim|required');
		$this->form_validation->set_rules('Ada_pkh', 'Ada Pkh', 'trim|required');
		$this->form_validation->set_rules('Ada_BPNT', 'Ada BPNT', 'trim|required');
		$this->form_validation->set_rules('Anak_diluar_rt', 'Anak Diluar Rt', 'trim|required');
		$this->form_validation->set_rules('namagadis_ibukandung', 'Namagadis Ibukandung', 'trim|required');
		$this->form_validation->set_rules('Status[]', 'Status', 'trim|required');
		$this->form_validation->set_rules('periode', 'Periode', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'kd_wilayah' => $this->input->post('kd_wilayah'),
				'IDBDT' => $this->input->post('IDBDT'),
				'IDARTBDT' => $this->input->post('IDARTBDT'),
				'KDPROP' => $this->input->post('KDPROP'),
				'KDKAB' => $this->input->post('KDKAB'),
				'KDKEC' => $this->input->post('KDKEC'),
				'KDDESA' => $this->input->post('KDDESA'),
				'NoPesertaPKH' => $this->input->post('NoPesertaPKH'),
				'Nama' => $this->input->post('Nama'),
				'JnsKel' => $this->input->post('JnsKel'),
				'TmpLahir' => $this->input->post('TmpLahir'),
				'TglLahir' => $this->input->post('TglLahir'),
				'HubKRT' => $this->input->post('HubKRT'),
				'NIK' => $this->input->post('NIK'),
				'NoKK' => $this->input->post('NoKK'),
				'Hub_KRT' => $this->input->post('Hub_KRT'),
				'NUK' => $this->input->post('NUK'),
				'Hubkel' => $this->input->post('Hubkel'),
				'Umur' => $this->input->post('Umur'),
				'Sta_kawin' => $this->input->post('Sta_kawin'),
				'Ada_akta_nikah' => $this->input->post('Ada_akta_nikah'),
				'Ada_diKK' => $this->input->post('Ada_diKK'),
				'Ada_kartu_identitas' => $this->input->post('Ada_kartu_identitas'),
				'Sta_hamil' => $this->input->post('Sta_hamil'),
				'Jenis_cacat' => $this->input->post('Jenis_cacat'),
				'Penyakit_kronis' => $this->input->post('Penyakit_kronis'),
				'Partisipasi_sekolah' => $this->input->post('Partisipasi_sekolah'),
				'Pendidikan_tertinggi' => $this->input->post('Pendidikan_tertinggi'),
				'Kelas_tertinggi' => $this->input->post('Kelas_tertinggi'),
				'Ijazah_tertinggi' => $this->input->post('Ijazah_tertinggi'),
				'Sta_Bekerja' => $this->input->post('Sta_Bekerja'),
				'Jumlah_jamkerja' => $this->input->post('Jumlah_jamkerja'),
				'Lapangan_usaha' => $this->input->post('Lapangan_usaha'),
				'Status_pekerjaan' => $this->input->post('Status_pekerjaan'),
				'Sta_keberadaan_art' => $this->input->post('Sta_keberadaan_art'),
				'Sta_kepesertaan_pbi' => $this->input->post('Sta_kepesertaan_pbi'),
				'Ada_kks' => $this->input->post('Ada_kks'),
				'Ada_pbi' => $this->input->post('Ada_pbi'),
				'Ada_kip' => $this->input->post('Ada_kip'),
				'Ada_pkh' => $this->input->post('Ada_pkh'),
				'Ada_BPNT' => $this->input->post('Ada_BPNT'),
				'Anak_diluar_rt' => $this->input->post('Anak_diluar_rt'),
				'namagadis_ibukandung' => $this->input->post('namagadis_ibukandung'),
				'Status' => implode(',', (array) $this->input->post('Status')),
				'periode' => $this->input->post('periode'),
			];

			
			$save_art_dtks_pemadanan = $this->model_art_dtks_pemadanan->change($id, $save_data);

			if ($save_art_dtks_pemadanan) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('art_dtks_pemadanan', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('art_dtks_pemadanan');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('art_dtks_pemadanan');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Art Dtks Pemadanans
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('art_dtks_pemadanan_delete');

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
            set_message(cclang('has_been_deleted', 'art_dtks_pemadanan'), 'success');
        } else {
            set_message(cclang('error_delete', 'art_dtks_pemadanan'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Art Dtks Pemadanans
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('art_dtks_pemadanan_view');

		$this->data['art_dtks_pemadanan'] = $this->model_art_dtks_pemadanan->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Art Dtks Pemadanan Detail');
		$this->render('modul/art_dtks_pemadanan/art_dtks_pemadanan_view', $this->data);
	}
	
	/**
	* delete Art Dtks Pemadanans
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$art_dtks_pemadanan = $this->model_art_dtks_pemadanan->find($id);

		
		
		return $this->model_art_dtks_pemadanan->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('art_dtks_pemadanan_export');

		$this->model_art_dtks_pemadanan->export('art_dtks_pemadanan', 'art_dtks_pemadanan');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('art_dtks_pemadanan_export');

		$this->model_art_dtks_pemadanan->pdf('art_dtks_pemadanan', 'art_dtks_pemadanan');
	}
}


/* End of file art_dtks_pemadanan.php */
/* Location: ./application/controllers/Art Dtks Pemadanan.php */