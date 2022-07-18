<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('UserModel', 'user');
	}

	public function index()
	{
		$today_player = $this->user->get_today_player();
		if ($today_player != array()) {
			$this->load->view('search.php', array('img_url' => $today_player['image1']));
		} else {
			$this->load->view('search_no.php');
		}
	}

	public function guess()
	{
		$player_name = $this->input->post('player_name');
		$history_no = $this->input->post('no');

		$today_player = $this->user->get_today_player();

		if ($player_name == $today_player['pname']) {

			$result = array(
				'status' 	=> 'win',
				'name'		=> $today_player['pname'],
				'date'		=> $today_player['date']
			);
			echo json_encode($result);

		} else {

			if ($history_no * 1 < 5) {

				$result = array(
					'status' 	=> 'failed',
					'image'		=> isset($today_player['image'.($history_no * 1 + 1)]) ? $today_player['image'.($history_no * 1 + 1)] : NULL
				);
				echo json_encode($result);

			} else {

				$result = array(
					'status' 	=> 'lose',
					'date'		=> $today_player['date']
				);
				echo json_encode($result);
			}
		}
	}

	public function result()
	{	
		$today_player = $this->user->get_today_player();
		$this->load->view('result.php', array('player' => $today_player));
	}
}
