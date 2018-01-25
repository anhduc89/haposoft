<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller 
{
	public function __construct()
    {
        parent::__construct();
        $this->load->model("home_m");
        date_default_timezone_set('Asia/Ho_Chi_Minh');
    }
    public function index()
    {
        $this->load->view("head");
        $this->load->view("login");
    }
    public function login()
    {
        $username = $this->input->post("username");
        $password = $this->input->post("password");
        $data = $this->home_m->get_login($username,md5($password));
        if($data == false)
        {
            echo json_encode(array("success" => "0", "response" => "Tài khoản hoặc mật khẩu không đúng"));
        }
        else 
        {
            $this->session->set_userdata($data);
            echo json_encode(array("success" => "1", "response" => "Đăng nhập thành công", "role" => $this->session->userdata("role")));
        }
    }

    public function show_time_of_staff()
    {
        $id_staff = $this->session->userdata("id_staff");
        $month = date('m',time());
        $data['total_time'] = $this->home_m->total_time_in_month( $id_staff, $month);
        $this->load->view("head");
        $this->load->view("v_time",$data);
    }
    public function insert_time()
    {
        $data = $this->input->post();
        $hour_start_time = explode(":", $data['start_time'])[0];
        $minute_start_time = explode(":", $data['start_time'])[1];

        $hour_end_time = explode(":", $data['end_time'])[0];
        $minute_end_time = explode(":", $data['end_time'])[1];

        $hour_start_pause_time = explode(":", $data['start_pause_time'])[0];
        $minute_start_pause_time = explode(":", $data['start_pause_time'])[1];

        $hour_end_pause_time = explode(":", $data['end_pause_time'])[0];
        $minute_end_pause_time = explode(":", $data['end_pause_time'])[1];

        $work_time = ( ($hour_end_time - $hour_start_time)*3600 + ($minute_end_time -  $minute_start_time)*60) - 
                                (($hour_end_pause_time - $hour_start_pause_time)*3600 + ($minute_end_pause_time - $minute_start_pause_time)*60 ) - 3600;
        $pause_time = (($hour_end_pause_time - $hour_start_pause_time)*3600 + ($minute_end_pause_time - $minute_start_pause_time)*60 );

        $dataInsert = array(
            'id_staff' => $data["id_staff"],
            'start_time' => $data["start_time"],
            'end_time' => $data["end_time"],
            'start_pause_time' => $data["start_pause_time"],
            'end_pause_time' => $data["end_pause_time"],
            'created_time' => time(),
            'created_day' => date('d/m/Y',time()),
            'month' => date('m',time()),
            'year' => date('Y',time()),
            'work_time' => $work_time,
            'pause_time' => $pause_time
        );

        $result = $this->home_m->insert_time($dataInsert);

        if($result == true)
        {
            echo json_encode(array("success" => "1", "response" => "Bạn đã cập nhật thành công"));
        }
    }

    // xem chi tiết từng nhân viên và xuất ra báo cáo
    public function show_report()
    {
        $report = array();
        $month = date('m',time());
        $data['report'] = $this->home_m->report_month($month);
        $this->load->view("head");
        $this->load->view("v_report",$data);    
    }

    public function report_excel()
    {
        $id_staff = $this->uri->segment(3);
        $month = date("m", time());

        $data = $this->home_m->report_excel($id_staff, $month);
        #echo "<pre>"; print_r($data); exit();

        require(APPPATH.'third_party/PHPExcel-1.8/Classes/PHPExcel.php');
		require(APPPATH.'third_party/PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');

		$objPHPExcel = new PHPExcel();
		$objPHPExcel->getProperties()->setCreator("");
		$objPHPExcel->getProperties()->setLastModifiedBy("");
		$objPHPExcel->getProperties()->setTitle("");
		$objPHPExcel->getProperties()->setSubject("");
		$objPHPExcel->getProperties()->setDescription("");

		$objPHPExcel->getActiveSheet()->mergeCells('C3:J3');
		$objPHPExcel->getActiveSheet()->setCellValue('C3','BÁO CÁO CHI TIẾT ');
		$objPHPExcel->getActiveSheet()->getStyle('C3:J3')->getFont()->setBold(true);

		$objPHPExcel->getActiveSheet()->mergeCells('C4:J4');
		$objPHPExcel->getActiveSheet()->setCellValue('C4','Tháng '.date('d/Y', time()));
		$style = array(
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
			)
		);

		$objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet()->SetCellValue('C6','Tên nhân viên');
		$objPHPExcel->getActiveSheet()->SetCellValue('D6','Ngày làm ');
        $objPHPExcel->getActiveSheet()->SetCellValue('E6','Bắt đầu ');
        $objPHPExcel->getActiveSheet()->SetCellValue('F6','Kết thúc ');
        $objPHPExcel->getActiveSheet()->SetCellValue('G6','Bắt đầu nghỉ ');
        $objPHPExcel->getActiveSheet()->SetCellValue('H6','Kết thúc nghỉ ');
        $objPHPExcel->getActiveSheet()->SetCellValue('I6','Tổng giờ làm ');
        $objPHPExcel->getActiveSheet()->SetCellValue('J6','Tổng giờ nghỉ ');
        
        $rowCount = 6 ;
        foreach($data as $item)
        {
            $rowCount++;
            $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, $item['name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, $item['created_day']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, $item['start_time']);
            $objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, $item['end_time']);
            $objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, $item['start_pause_time']);
            $objPHPExcel->getActiveSheet()->SetCellValue('H'.$rowCount, $item['end_pause_time']);
            $objPHPExcel->getActiveSheet()->SetCellValue('I'.$rowCount, $item['work_time']);
            $objPHPExcel->getActiveSheet()->SetCellValue('J'.$rowCount, $item['pause_time']);
        }

		$filename = "Bao_cao_".date("d-m-Y",time()).'.xlsx';
		$objPHPExcel->getActiveSheet()->setTitle("Báo Cáo ".date("d-m-Y",time()));

		header('Content-type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename='.$filename);

		$writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$writer->save('php://output');
    }
}