<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('AdminModel', 'admin');
	}

	public function index()
	{
		$schedule_list = $this->admin->get_schedule_list();

		$this->load->view('admin.php', array('schedule_list' => $schedule_list));
	}

	public function save()
	{
		$schedule_params = $this->input->post();

		$config = array(
			'upload_path' => "./public/uploads/",
			'allowed_types' => "gif|jpg|png|jpeg|pdf",
			'overwrite' => TRUE,
		);
		$this->load->library('upload', $config);

		$image1_path = "";
		$image2_path = "";
		$image3_path = "";
		$image4_path = "";
		$image5_path = "";
		$image_result_path = "";

		$config['file_name'] = strtotime('now')."0";
		$this->upload->initialize($config);
		if($this->upload->do_upload('image1_input'))
		{
			$image1_path = '/public/uploads/'.$this->upload->data('file_name');
		}

		$config['file_name'] = strtotime('now')."1";
		$this->upload->initialize($config);
		if($this->upload->do_upload('image2_input'))
		{
			$image2_path = '/public/uploads/'.$this->upload->data('file_name');
		}

		$config['file_name'] = strtotime('now')."2";
		$this->upload->initialize($config);
		if($this->upload->do_upload('image3_input'))
		{
			$image3_path = '/public/uploads/'.$this->upload->data('file_name');
		}

		$config['file_name'] = strtotime('now')."3";
		$this->upload->initialize($config);
		if($this->upload->do_upload('image4_input'))
		{
			$image4_path = '/public/uploads/'.$this->upload->data('file_name');
		}

		$config['file_name'] = strtotime('now')."4";
		$this->upload->initialize($config);
		if($this->upload->do_upload('image5_input'))
		{
			$image5_path = '/public/uploads/'.$this->upload->data('file_name');
		}

		$config['file_name'] = strtotime('now')."5";
		$this->upload->initialize($config);
		if($this->upload->do_upload('image_result_input'))
		{
			$image_result_path = '/public/uploads/'.$this->upload->data('file_name');
		}

		$schedule_info = array(
			'date' => $schedule_params['date'],
			'player_id' => $schedule_params['player_name'],
			'image1' => $image1_path,
			'image2' => $image2_path,
			'image3' => $image3_path,
			'image4' => $image4_path,
			'image5' => $image5_path,
			'image_result' => $image_result_path,
			'youtube_path' => $schedule_params['youtube_path'],
			'create_date' => date('Y-m-d H:i:s'),
			'update_date' => date('Y-m-d H:i:s')
		);

		$res = $this->admin->save_schedule($schedule_info, $schedule_params['schedule_id']);

		echo $res;
	}

	public function delete()
	{
		$sid = $this->input->post('schedule_id');
		$this->admin->delete_schedule($sid);
		echo "success";
	}

	public function detail()
	{
		$sid = $this->input->post('schedule_id');
		$res = $this->admin->get_schedule_detail($sid);
		echo json_encode($res);
	}

}
