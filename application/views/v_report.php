<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3>Thông tin giờ làm của nhân viên </h3>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Tên nhân viên </th>
                    <th>Tổng giờ làm </th>
                    <th>Tổng giờ nghỉ</th>
                    <th>Tháng</th>
                    <th>Giờ làm thêm </th>
                    <th>Xuất báo cáo</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach( $report as $item )
                    {
                        // làm thêm giờ = tổng thời gian làm việc - giờ bận nghỉ - 192h làm việc trong 1 tháng
                        $over_time = ( $item['total_work_time'] - $item['total_pause_time'] )/3600 - 192;
                        if($over_time < 0 )
                        {
                            $over_time = 0;
                        }
                        else 
                        {
                            $over_time = round($over_time,0);
                        }
                        echo '
                            <tr>
                                <td>'.$item['name'].'</td>
                                <td>'.$item['total_work_time'].'</td>
                                <td>'.$item['total_pause_time'].'</td>
                                <td>'.$item['month'].'</td>
                                <td>'.$over_time.'</td>
                                <td>
                                    <a href="'.base_url().'home/report_excel/'.$item['id_staff'].'">
                                        <button class="btn btn-primary"> Xuất báo cáo </button>
                                    </a>
                                </td>
                                    
                            </tr>
                        ';
                    }
                ?>
                

            </tbody>
        </table>
        </div>

    </div>
</div>