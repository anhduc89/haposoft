<?php
    class Home_m extends  CI_Model
    {
        public function __construct()
        {
            parent::__construct();
        }

        public function get_login($username, $password )
        {
            $this->db->select("*"); 
            $this->db->from("staff");
            $this->db->where("staff.username", $username);
            $this->db->where("staff.password", $password);

            $query = $this->db->get();

            if($query->num_rows() == 1 )
            {               
                return $query->row_array();
            }
            else
            {
                return false;
            }
        }
        public function get_admin()
        {
            $this->db->select("*");
            $this->db->from("staff");
            $query = $this->db->get();
            return $query->row_array();
        }
        // lấy ra tổng thời gian làm việc trong tháng đó
        public function total_time_in_month( $id_staff, $month)
        {
            $month = date('m',time());
            $this->db->select("time_staff.month, time_staff.year, time_staff.work_time");
            $this->db->from("time_staff");
            $this->db->where("time_staff.id_staff", $id_staff);
            $this->db->where("time_staff.month", $month);
            $query = $this->db->get();
            return $query->result_array();
        }
        public function insert_time($data)
        {
            $this->db->insert("time_staff",$data);
            
            if($this->db->affected_rows() === 1)
            {
                return true;
            }
            return false;
        }

        private function report_by_idStaff($id_staff, $month)
        {
            $month = date('m',time());
            $this->db->select("time_staff.id_staff, time_staff.month, SUM(time_staff.work_time) as total_work_time,
                                            SUM(time_staff.pause_time) as total_pause_time, staff.name");
            $this->db->from("time_staff");
            $this->db->where("time_staff.id_staff", $id_staff);
            $this->db->where("time_staff.month", $month);
            $this->db->join("staff", "staff.id_staff = time_staff.id_staff");

            $query = $this->db->get();
            return  $query->row_array();
        }
        public function report_month()
        {
            $month = date('m',time());
            $this->db->select("time_staff.id_staff");
            $this->db->from("time_staff");
            $query = $this->db->get();
            $data = $query->result_array();
            $output = array();
            $newArr = array();
           
            foreach( $data as $item)
            {
                $output[] = $this->report_by_idStaff($item['id_staff'], $month);
            }
            return $output ;
            // foreach($output as $item2)
            // {
            //     $newArr	= array_unique($item2);
            // }
            // echo "<pre>"; print_r($newArr);
           # return $newArr ; //$newArr	= array_unique($output);
        }

        public function report_excel($id_staff, $month)
        {
            $this->db->select("time_staff.id_staff, time_staff.start_time, time_staff.end_time, 
                                            time_staff.start_pause_time, time_staff.end_pause_time, time_staff.created_day, 
                                            time_staff.work_time, time_staff.pause_time, staff.name");
            $this->db->from("time_staff");
            $this->db->where("time_staff.id_staff", $id_staff);
            $this->db->where("time_staff.month", $month);
            $this->db->join("staff", "staff.id_staff = time_staff.id_staff");

            $query = $this->db->get();
            return  $query->result_array();
        }
    }

?>