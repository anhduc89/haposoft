
<?php
    $total_work_time1 = 0;
    $total_work_time = 0;
    foreach($total_time as $item)
    {
       $total_work_time1 = ($total_work_time1 + $item['work_time']);
    }
    
    $total_work_time = round($total_work_time1/3600 ,2);
    // $total_work_time3 = round($total_work_time1/3600 ,0);
    // echo $total_work_time2 .' +++++ '.$total_work_time3; exit();
    // if( ($total_work_time2 - $total_work_time3 ) > 0.6)
    // {
    //     $total_work_time = $total_work_time + $total_work_time3 + 1;
    // }
    $month = $total_time[0]['month'];
    $year = $total_time[0]['year'];
?>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h3>Xin chào : <?php echo $this->session->userdata("name"); ?></h3> 
            <h5>Ngày : <?php echo date("d/m/Y", time());?></h5>
            <h5>Tổng thời gian làm việc trong tháng <?php echo $month;?>/<?php echo $year ;?> là : <?php echo $total_work_time;?> giờ</h5>
            <div class="well">
                <label for=""> Giờ đến :</label>
                <div class="input-group bootstrap-timepicker timepicker">
                        <input id="timepicker1" type="text" class="form-control input-small">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                    </div>
            </div>
            <div class="well">
                <label for=""> Giờ về :</label>
                <div class="input-group bootstrap-timepicker timepicker">
                        <input id="timepicker2" type="text" class="form-control input-small">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                    </div>
            </div>
            <div class="well">
                <label for=""> Giờ nghỉ trưa :</label>
                <div class="input-group bootstrap-timepicker timepicker">
                    <input id="timepicker3" type="text" class="form-control input-small" value="1" readonly>
                </div>
            </div>
            <div class="well">
                <label for=""> Giờ tạm dừng công việc :</label>
                <div class="input-group bootstrap-timepicker timepicker">
                        <input id="timepicker4" type="text" class="form-control input-small">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                    </div>
            </div>
            <div class="well">
                <label for=""> Giờ bắt đầu lại :</label>
                <div class="input-group bootstrap-timepicker timepicker">
                        <input id="timepicker5" type="text" class="form-control input-small">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                    </div>
            </div>

            <!-- <div class="well">
                <label for=""> Ngày làm việc  :</label>
                    <div class="input-group input-append date" id="dateRangePicker">
                        <input type="text" class="form-control" name="date" id="date"/>
                        <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                    </div>
            </div> -->


            <input type="hidden" value="<?php echo $this->session->userdata("id_staff");?>" id="id_staff">
            <button type="submit" id="time">Xác nhận</button>
            <p class="notification"></p>
        </div>
    </div>
</div>






<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">


<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>


<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css" />
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript">
       
    $('#dateRangePicker')
    .datepicker({
        format: 'dd/mm/yyyy',
    });
    // .on('changeDate', function(e) {
    //     var current_date = $("#date").val(); 
    // });
    // $('#dateRangePicker').on('change',function(){
    //     var current_date = $("#date").val(); 
    //     console.log(current_date);
    $('#timepicker1').timepicker({
        showMeridian: false,
        maxHours:24
    });
    $('#timepicker2').timepicker({
        showMeridian: false,
        maxHours:24
    });
    $('#timepicker4').timepicker({
        showMeridian: false,
        maxHours:24
    });
    $('#timepicker5').timepicker({
        showMeridian: false,
        maxHours:24
    });
    $('#timepicker4').timepicker('setTime', '0:00');
    $('#timepicker5').timepicker('setTime', '0:00');

    $("#time").on('click', function(e){
        e.preventDefault();
        var id_staff = $('#id_staff').val();
        var start_time = $('#timepicker1').timepicker().val();
        var end_time = $('#timepicker2').timepicker().val();
        var start_pause_time = $('#timepicker4').timepicker().val();
        var end_pause_time = $('#timepicker5').timepicker().val();
        var base_url = "<?php echo base_url();?>";
        $.ajax({
            url : base_url + "home/insert_time",
            dataType : "json",
            method : "post",
            data : {
                id_staff : id_staff,
                start_time : start_time,
                end_time : end_time,
                start_pause_time : start_pause_time,
                end_pause_time : end_pause_time,
                // current_date : current_date
            },
            success : function(data)
            {
                if(data.success == 1)
                {
                    $(".notification").html(data.response);
                }
            }
        });

    });
           // });
            
        

    
   
    
    
</script>
