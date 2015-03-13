<div class="register_section search_company">
    <div class="container">
        <div class="search_bar2">
            <div class="register_content">
                <div class="register_form">
                    <h1 style="margin-bottom: 1%;"><i class="fa fa-check-square"></i>&nbsp;&nbsp;&nbsp;Forgot Password</h1>
                    <div class="row">
                        <div class="col-sm-12">
                            <form action="<?php echo base_url('landing/checkUserF') ?>" onsubmit="return validationForm();" name="registercompany" id="registercompany" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">
                                <div class="form-group">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-6">
                                        <span  style="color: #16A085; font-size: 14px;">Please provide your registered Email id and Mobile</span><br/>
                                        <p id="emailErr" style="color:#C00;"><?php
                                            if(isset($_GET['msg']) && $_GET['msg'] == 2)
                                            {
                                                echo "No user with the email or mobile.";
                                            }?></p>
                                        <p id="emailSuc" style="color:#06a03c;"><?php
                                            if(isset($_GET['msg']) && $_GET['msg'] == 1)
                                            {
                                                echo "Mail sent to the email";
                                            }
                                            ?></p>
                                        <label for="email" class="control-label">Email Id:<span style="color: #FF0000"> *</span></label>
                                        <input type="text" name="email" value="<?php echo set_value("username"); ?>" class="form-control" id="email" placeholder="Email" >
										<?php 
										/*
                                        <p id="emailErr" style="color:#C00;"><?php
                                            if(isset($_GET['msg']) && $_GET['msg'] == 2)
                                            {
                                                echo "No user with the email or mobile.";
                                            }?></p>
                                        <p id="emailSuc" style="color:#06a03c;"><?php
                                            if(isset($_GET['msg']) && $_GET['msg'] == 1)
                                            {
                                                echo "Mail sent to the email";
                                            }
                                            ?></p>
										*/	
										?>	
                                        <label for="mobile" class="control-label">Mobile:<span style="color: #FF0000"> *</span></label>
                                        <input type="text" name="mobile" value="<?php echo set_value("mobile"); ?>" class="form-control" id="mobile" placeholder="Mobile"  maxlength="10">
                                        <p id="mobErr" style="color:#C00;"></p>
                                        <p id="mobSuc" style="color:#06a03c;"></p>
                                        <div class="text-center"  style="margin-top: 1%;">
                                            <button class="btn btn-primary" id="submit_btn" type="submit" name="submit"><i class="fa fa-paper-plane"></i> &nbsp; Submit</button>
                                            <a class="btn btn-danger" href="<?php echo base_url('landing'); ?>"><i class="fa fa-times"></i> &nbsp Close</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function validationForm()
    {
        var e = document.getElementById('email').value;
        var m = document.getElementById('mobile').value;
        var eReg = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/igm;
        var mReg = /^\d{10}/;

        document.getElementById('emailErr').innerHTML = "";
        document.getElementById('mobErr').innerHTML = "";
        document.getElementById('emailSuc').innerHTML = "";
        document.getElementById('mobSuc').innerHTML = "";

        if (e == "" || e == null)
        {
            $('#emailErr').css('padding', '10px 0 0 12px');
            document.getElementById('emailErr').innerHTML = "Please fill this field";
            document.getElementById('email').focus();
            return false;
        } 
		else if(!(eReg.test(e))) {
            $('#emailErr').css('padding', '10px 0 0 12px');
            document.getElementById('emailErr').innerHTML = "Please Enter a valid email Id";
            document.getElementById('email').focus();
            return false;
        }
        if (m == "" || m == null) {
            $('#mobErr').css('padding', '10px 0 0 12px');
            document.getElementById('mobErr').innerHTML = "Please fill this field";
            document.getElementById('mobile').focus();
            return false;
        } else if(!(mReg.test(m))) {
            $('#mobErr').css('padding', '10px 0 0 12px');
            document.getElementById('mobErr').innerHTML = "Please Enter a valid Mobile number";
            document.getElementById('mobile').focus();
            return false;
        }
    }
    function check_email_extension()
    {
        var e = document.getElementById('email').value;
        var m = document.getElementById('mobile').value;
        if(e == '')
        {
            return false;
        }
        $("#submit_btn").attr('disabled','disabled');
        $.ajax({
            url: "<?php echo base_url('landing/checkUser')?>",
            method: "POST",
            data: {'email': e, 'mobile':m,'csrf': Math.round(Math.random() * 10000000)},
            error: function()
            {
                alert(data);
            },
            success:function(stat)
            {
				document.getElementById("emailErr").style.padding = "10px 0 0 12px";
				$("#submit_btn").removeAttr('disabled');
                if(stat == 0)
                {
					document.getElementById('emailErr').innerHTML = "Email ID Not Exists";	
                }
                else
                {
					document.getElementById('emailErr').innerHTML = "Mail Sent To Mail ID";
                }
            }
        });
    }
</script>
