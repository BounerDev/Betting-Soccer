<?php
    class AdminModel extends CI_Model 
    {
        public function get_schedule_list() 
        {
            $this->db->select('player_list.id as pid, player_list.name as pname, schedule_list.id as sid, schedule_list.date, schedule_list.create_date, schedule_list.update_date');
            $this->db->from('schedule_list');
            $this->db->join('player_list', 'player_list.id = schedule_list.player_id', 'left');
            $this->db->order_by('schedule_list.date', 'DESC');
            $schedule_list = $this->db->get()->result_array();

            return $schedule_list;
        }

        public function get_schedule_detail($schedule_id)
        {
            $this->db->select('player_list.id as pid, player_list.name as pname, schedule_list.*');
            $this->db->from('schedule_list');
            $this->db->join('player_list', 'player_list.id = schedule_list.player_id', 'left');
            $this->db->where('schedule_list.id', $schedule_id);
            $this->db->order_by('schedule_list.date', 'DESC');
            $schedule = $this->db->get()->row_array();

            return $schedule;
        }

        public function save_schedule($schedule_info, $schedule_id)
        {
            if ($schedule_id == "") {
                $this->db->where('date', $schedule_info['date']);
                $today = $this->db->get('schedule_list')->result_array();
                if ($today != array()) {
                    return "duplicate";
                }
            }
    
            $player_id = '';
            
            $this->db->where('name', $schedule_info['player_id']);
            $player = $this->db->get('player_list')->result_array();

            if ($player == array()) {
                $this->db->insert('player_list', array('name' => $schedule_info['player_id']));
                $player_id = $this->db->insert_id();
            } else {
                $player_id = $player[0]['id'];
            }

            $schedule_info['player_id'] = $player_id;

            if ($schedule_id == "") {
                $this->db->insert('schedule_list', $schedule_info);
            } else {
                $this->db->where('id', $schedule_id)->update('schedule_list', $schedule_info);
            }

            return "success";
        }

        public function update_schedule($schedule_info)
        {
            $player_id = '';
            
            $this->db->where('name', $schedule_info['player_id']);
            $player = $this->db->get('player_list')->result_array();

            if ($player == array()) {
                $this->db->insert('player_list', array('name' => $schedule_info['player_id']));
                $player_id = $this->db->insert_id();
            } else {
                $player_id = $player[0]['id'];
            }

            $schedule_info['player_id'] = $player_id;

            $this->db->insert('schedule_list', $schedule_info);

            return "success";
        }

        public function delete_schedule($schedule_id)
        {
            $this->db->where('id', $schedule_id);
            $this->db->delete('schedule_list');
        }
    }
?>