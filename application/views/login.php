


<style>
    @import url(http://fonts.googleapis.com/css?family=Roboto:400);
body {
  background-color:#fff;
  -webkit-font-smoothing: antialiased;
  font: normal 14px Roboto,arial,sans-serif;
}

.container {
    padding: 25px;
    position: fixed;
}

.form-login {
    background-color: #EDEDED;
    padding-top: 10px;
    padding-bottom: 20px;
    padding-left: 20px;
    padding-right: 20px;
    border-radius: 15px;
    border-color:#d2d2d2;
    border-width: 5px;
    box-shadow:0 1px 0 #cfcfcf;
}

h4 { 
 border:0 solid #fff; 
 border-bottom-width:1px;
 padding-bottom:10px;
 text-align: center;
}

.form-control {
    border-radius: 10px;
}

.wrapper {
    text-align: center;
}

</style>
            <div class="container">
                <div class="row">
                    <div class="col-md-offset-5 col-md-3">
                        <div class="form-login">
                            <h4>Đăng nhập</h4>
                            <input type="text" id="userName" class="form-control input-sm chat-input" placeholder="username" />
                        </br>
                            <input type="password" id="userPassword" class="form-control input-sm chat-input" placeholder="password" />
                        </br>
                            <div class="wrapper">
                                <span class="group-btn">     
                                    <a href="#" class="btn btn-primary btn-md" id="login">login <i class="fa fa-sign-in"></i></a>
                                </span>
                            </div>
                            <p class="notification"></p>
                        </div>
                    
                    </div>
                </div>
            </div>

            <script>
                $(document).ready(function(){
                    $("#login").on('click', function(){
                        var base_url = "<?php echo base_url();?>";
                        var username = $("#userName").val();
                        var password = $("#userPassword").val();

                        console.log(username);
                        console.log(password);

                        $.ajax({
                            url : base_url + "home/login",
                            dataType : "json",
                            method: "post",
                            data : {
                                username : username,
                                password : password
                            },
                            success : function(data)
                            {
                                console.log(data);
                                if(data.success == "0")
                                {
                                    $(".notification").html(data.response);
                                }
                                else if(data.success == "1")
                                {
                                    $(".notification").html(data.response);
                                    if(data.role == "1")
                                    {
                                        window.setTimeout(function() {
                                            window.location.href = base_url+"home/show_time_of_staff";
                                        }, 1000);
                                    }
                                    else if(data.role == "2")
                                    {
                                        window.setTimeout(function() {
                                            window.location.href = base_url+"home/show_report";
                                        }, 1000);
                                    }
                                  
                                }
                            }
                        });
                    });
                });
            </script>

</body>

</html>