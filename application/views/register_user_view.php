<div class="register_section">
    <div class="container">
        <div class="register_content">
            <div class="register_form">
                <h1 style="margin-bottom: 5%;"><i class="fa fa-pencil"></i>&nbsp;&nbsp;&nbsp;Create User Profile</h1>
                <div class="row">
                    <div class="col-sm-12">
                        <form action="<?php echo base_url('landing/saveUser') ?>" onsubmit="return validationForm();" name="registercompany" id="registercompany" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <label for="contact-name" class="col-sm-4 control-label">First Name:<span style="color: #FF0000"> *</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" name="user_fname" class="form-control" id="user_fname" placeholder="First Name" required="required">
                                        <p id="fnameErr" style="color:#C00;"></p>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="contact-name" class="col-sm-4 control-label">Last Name:<span style="color: #FF0000"> *</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" name="user_lname" class="form-control" id="user_lname" placeholder="Last Name" required="required">
                                        <p id="lnameErr" style="color:#C00;"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <label for="contact-name" class="col-sm-4 control-label">Email Id:<span style="color: #FF0000"> *</span></label>
                                    <div class="col-sm-8">
                                        <input type="email" name="user_email" onblur="check_email_extension();" class="form-control" id="user_email" placeholder="Email Id" required="required">
                                        <p id="emailErr" style="color:#C00;"></p>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="contact-name" class="col-sm-4 control-label">Mobile:<span style="color: #FF0000"> *</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" name="user_mobile" class="form-control" id="user_mobile" placeholder="Mobile" required="required">
                                        <p id="mobErr" style="color:#C00;"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <label for="contact-name" class="col-sm-4 control-label">Password:<span style="color: #FF0000"> *</span></label>
                                    <div class="col-sm-8">
                                        <input type="password" name="user_password" class="form-control" id="user_password" placeholder="Password" required="required">
                                        <p id="pErr" style="color:#C00;"></p>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="contact-name" class="col-sm-4 control-label">Confirm Password:<span style="color: #FF0000"> *</span></label>
                                    <div class="col-sm-8">
                                        <input type="password" name="user_cpassword" onkeyup="checkPass(); return false;" class="form-control" id="user_cpassword" placeholder="Confirm Password" required="required">
                                        <p id="cpErr" style="color:#C00;"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group form_buttons" style="margin-top: 5%;">
                                <div class="col-lg-12 text-center">
                                    <p style="color: #1D7FB0">By clicking Register you agree to <a style="color:#16A085" href="">terms & conditions</a></p>
                                    <button class="btn btn-primary" id="submit_btn" type="submit" name="submit"><i class="fa fa-floppy-o"></i> &nbsp; Register</button>
                                    <a class="btn btn-warning" href="<?php echo base_url('landing');?>"> Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function checkPass()
    {
        var pass1 = document.getElementById('user_password');
        var pass2 = document.getElementById('user_cpassword');
        var goodColor = "#66cc66";
        var badColor = "#ff6666";
        if(pass1.value == pass2.value){
            pass2.style.backgroundColor = goodColor;
        }else{
            pass2.style.backgroundColor = badColor;
        }
    }
</script>
<script type="text/javascript">
    function validationForm()
    {
        var fn = document.getElementById('user_fname').value;
        var ln = document.getElementById('user_lname').value;
        var e = document.getElementById('user_email').value;
        var m = document.getElementById('user_mobile').value;
        var p = document.getElementById('user_password').value;
        var cp = document.getElementById('user_cpassword').value;

        var eReg = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/igm;

        document.getElementById('fnameErr').innerHTML = "";
        document.getElementById('lnameErr').innerHTML = "";
        document.getElementById('emailErr').innerHTML = "";
        document.getElementById('mobErr').innerHTML = "";
        document.getElementById('pErr').innerHTML = "";
        document.getElementById('cpErr').innerHTML = "";

        if (fn == "" || fn == null)
        {
            $('#fnameErr').css('padding', '10px 0 0 12px');
            document.getElementById('fnameErr').innerHTML = "Please fill this field";
            document.getElementById('user_fname').focus();
            return false;
        }
        if (ln == "" || ln == null)
        {
            $('#lnameErr').css('padding', '10px 0 0 12px');
            document.getElementById('lnameErr').innerHTML = "Please fill this field";
            document.getElementById('user_lname').focus();
            return false;
        }
        if (e == "" || e == null)
        {
            $('#emailErr').css('padding', '10px 0 0 12px');
            document.getElementById('emailErr').innerHTML = "Please fill this field";
            document.getElementById('user_email').focus();
            return false;
        }
        else if(!(eReg.test(e)))
        {
            $('#emailErr').css('padding', '10px 0 0 12px');
            document.getElementById('emailErr').innerHTML = "Please Enter a valid email Id";
            document.getElementById('email').focus();
            return false;
        }
        if (m == "" || m == null)
        {
            $('#mobErr').css('padding', '10px 0 0 12px');
            document.getElementById('mobErr').innerHTML = "Please fill this field";
            document.getElementById('user_mobile').focus();
            return false;
        }
        if (p == "" || p == null) {
            $('#pErr').css('padding', '10px 0 0 12px');
            document.getElementById('pErr').innerHTML = "Please fill this field";
            document.getElementById('password').focus();
            return false;
        }
        if (cp == "" || cp == null) {
            $('#cpErr').css('padding', '10px 0 0 12px');
            document.getElementById('cpErr').innerHTML = "Please fill this field";
            document.getElementById('confirmpassword').focus();
            return false;
        }else if(!(p==cp)){
            $('#cpErr').css('padding', '10px 0 0 12px');
            document.getElementById('cpErr').innerHTML = "Please match with Password";
            document.getElementById('confirmpassword').focus();
            return false;
        }
    }
    function check_email_extension()
    {
        var e = document.getElementById('user_email').value;
        if(e == '')
        {
            $('#emailErr').css('padding', '10px 0 0 12px');
            document.getElementById('emailErr').innerHTML = "Please Enter a valid email Id";
            document.getElementById('user_email').focus();
            return false;
        }
        $("#submit_btn").attr('disabled','disabled');
        $.ajax({
            url: "<?php echo base_url('landing/checkUser')?>",
            method: "POST",
            data: {'email': e, 'csrf': Math.round(Math.random() * 10000000)},
            error: function()
            {
                alert(data);
            },
            success:function(stat)
            {
                //alert(stat);
                if(stat == 0)
                {
                    document.getElementById('emailErr').innerHTML = "";
                    $("#submit_btn").removeAttr('disabled');
                    return true;
                }
                else
                {
                    document.getElementById("emailErr").style.padding = "10px 0 0 12px";
                    document.getElementById('emailErr').innerHTML = "User already exist !";
                    document.getElementById('user_email').focus();
                    $("#submit_btn").attr('disabled','disabled');
                    //event.preventDefault();

                    return false;
                }
            }
        });
    }
    function company_name()
    {
        var cn = document.getElementById('companyName').value;
        document.getElementById('cNameErr').innerHTML = "";
        if(cn == '')
        {
            return false;
        }
        $("#submit_btn").attr('disabled','disabled');
        $.ajax({
            url: "<?php echo base_url('landing/checkCompany')?>",
            method: "POST",
            data: {'cmp_name': cn, 'csrf': Math.round(Math.random() * 10000000)},
            error: function()
            {
                alert(data);
            },
            success:function(stat)
            {
                //alert(stat);
                if(stat == 0)
                {
                    document.getElementById('cpErr').innerHTML = "";
                    $("#submit_btn").removeAttr('disabled');
                    return true;
                }
                else
                {
                    document.getElementById("cNameErr").style.padding = "10px 0 0 12px";
                    document.getElementById('cNameErr').innerHTML = "Company already registered !";
                    document.getElementById('companyName').focus();
                    $("#submit_btn").attr('disabled','disabled');
                    //event.preventDefault();

                    return false;
                }
            }
        });
    }
</script>
<script>
    $(function() {
        $('#password').on('keypress', function(e) {
            if (e.which == 32) {
                return false;
            }
        });
    });
</script>
<script type="text/javascript" src="<?php echo base_url('assets/js/register.js'); ?>"></script>