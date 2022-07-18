<?php
    class UserModel extends CI_Model 
    {
        public function get_today_player() 
        {
            $this->db->select('player_list.id as pid, player_list.name as pname, schedule_list.*');
            $this->db->from('schedule_list');
            $this->db->join('player_list', 'player_list.id = schedule_list.player_id', 'left');
            $this->db->where('schedule_list.date', date('Y-m-d'));
            $today_player = $this->db->get()->row_array();

            return $today_player;
        }
    }
?>