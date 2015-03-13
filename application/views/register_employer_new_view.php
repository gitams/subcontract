<div class="register_section search_company">
    <div class="container">
        <div class="search_bar2">
            <div class="register_content">
                <div class="register_form">
                    <h1 style="margin-bottom: 5%;"><i class="fa fa-check-square"></i>&nbsp;&nbsp;&nbsp;Register as Employer</h1>
                    <div class="row">
                        <div class="col-sm-12">
                            <form action="<?php echo base_url('landing/saveCompanyNew') ?>" onsubmit="return validationForm();" name="registercompany" id="registercompany" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">
                                <div class="form-group">
                                    <div class="col-sm-6">
                                        <label for="company" class="col-sm-4 control-label">Company Name:<span style="color: #FF0000"> *</span></label>
                                        <div class="col-sm-8">
                                            <input type="text" name="companyname" onblur="company_name();" class="form-control" id="companyName" placeholder="Company Name" value="<?php echo set_value("companyname"); ?>" >
                                            <p id="cNameErr" style="color:#C00;"></p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="email" class="col-sm-4 control-label">Email Id:<span style="color: #FF0000"> *</span></label>
                                        <div class="col-sm-8">
                                            <input type="text" name="username" onblur="check_email_extension();" value="<?php echo set_value("username"); ?>" class="form-control" id="email" placeholder="Email Id" >
                                            <p id="emailErr" style="color:#C00;"></p>
                                            <p id="emailSuc" style="color:#06a03c;"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-6">
                                        <label for="password" class="col-sm-4 control-label">Password:<span style="color: #FF0000"> *</span></label>
                                        <div class="col-sm-8">
                                            <input type="password" name="password" class="form-control" id="password" placeholder="Password" title="please fill">
                                            <p id="pErr" style="color:#C00;"></p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="cPassword" class="col-sm-4 control-label">Confirm Password:<span style="color: #FF0000"> *</span></label>
                                        <div class="col-sm-8">
                                            <input type="password" name="confirmpassword" onkeyup="checkPass(); return false;" class="form-control" id="confirmpassword" placeholder="Confirm Password" >
                                            <p id="cpErr" style="color:#C00;"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-5">&nbsp;</div>
                                    <div class="col-sm-6">
                                        <input type="checkbox" name="aggrement"  id="agree" checked/>&nbsp;&nbsp;&nbsp;I agree to Terms & Conditions<span style="color: #FF0000"> *</span>
                                        <p id="agErr" style="color:#C00;"></p>
                                    </div>

                                </div>
                                <!--<div class="form-group">
                                    <div class="col-sm-5"></div>
                                    <div class="col-sm-6">
                                        <input type="checkbox" name="promotions"/>&nbsp;&nbsp;&nbsp;I want to receive promotions on my email Id.
                                    </div>
                                </div>-->
                                <div class="form-group form_buttons" style="margin-top: 1%;">
                                    <div class="col-lg-12 text-center">
                                        <button class="btn btn-primary" id="submit_btn" disabled="disabled" type="submit" name="submit"><i class="fa fa-floppy-o"></i> &nbsp; Register</button>
                                        <a class="btn btn-warning" href="<?php echo base_url('landing');?>">Cancel</a>
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
<?php $ext = $this->config->item('restrictedDomains'); $cnt = count($ext); //print_r($ext); echo $cnt;?>
<script>
    function checkPass() {
        var pass1 = document.getElementById('password');
        var pass2 = document.getElementById('confirmpassword');
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
        var e = document.getElementById('email').value;
        var p = document.getElementById('password').value;
        var cp = document.getElementById('confirmpassword').value;
        var cn = document.getElementById('companyName').value;
        var ag = document.getElementById('agree').checked;
        var eReg = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/igm;

        document.getElementById('emailErr').innerHTML = "";
        document.getElementById('emailSuc').innerHTML = "";
        document.getElementById('pErr').innerHTML = "";
        document.getElementById('cpErr').innerHTML = "";
        document.getElementById('cNameErr').innerHTML = "";
        document.getElementById('agErr').innerHTML = "";

        if (e == "" || e == null)
        {
            $('#emailErr').css('padding', '10px 0 0 12px');
            document.getElementById('emailErr').innerHTML = "Please fill this field";
            document.getElementById('email').focus();
            return false;
        }
        else if(!(eReg.test(e)))
        {
            $('#emailErr').css('padding', '10px 0 0 12px');
            document.getElementById('emailErr').innerHTML = "Please Enter a valid email Id";
            document.getElementById('email').focus();
            return false;
        }
        else
        {
            var one = e.split("@");
            var two = one['1'].split(".");
            <?php for ($i = 0; $i < $cnt; $i++) { ?>
            if(two['0'] == "<?php echo $ext[$i];?>") {
                $('#emailErr').css('padding', '10px 0 0 12px');
                document.getElementById('emailSuc').innerHTML = "";
                document.getElementById('emailErr').innerHTML = "Invalid Email Extension";
                document.getElementById('email').focus();
                return false;
            }<?php } ?>
        }
        if (cn == "" || cn == null) {
            $('#cNameErr').css('padding', '10px 0 0 12px');
            document.getElementById('cNameErr').innerHTML = "Please fill this field";
            document.getElementById('companyName').focus();
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
        if (ag == false) {
            $('#agErr').css('padding', '10px 0 0 12px');
            document.getElementById('agErr').innerHTML = "Please accept terms and conditions";
            document.getElementById('agree').focus();
            return false;
        }
    }
    var email_status = true;
    var company_name_status = true;
    function check_email_extension()
    {
        var e = document.getElementById('email').value;
        if(e == '') {
            return false;
        }
        $("#submit_btn").attr('disabled','disabled');
        $.ajax({
            url: "<?php echo base_url('landing/checkUser')?>",
            method: "POST",
            data: {'email': e, 'csrf': Math.round(Math.random() * 10000000)},
            error: function() {
                alert(data);
            },
            success:function(stat)
            {
                //alert(stat);
                if(stat == 0)
                {
                    email_status =true;
                    document.getElementById('emailErr').innerHTML = "";
                    document.getElementById('emailSuc').innerHTML = "";
                    $("#submit_btn").removeAttr('disabled');
                    return true;
                }
                else
                {
                    email_status =false;
                    document.getElementById("emailErr").style.padding = "10px 0 0 12px";
                    document.getElementById('emailErr').innerHTML = "User already exist !";
                    if(company_name_status == false)
                    {
                        document.getElementById('companyName').focus();
                    }
                    else
                    {
                        document.getElementById('email').focus();
                    }

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
        if(cn == '') {
            return false;
        }
        $("#submit_btn").attr('disabled','disabled');
        $.ajax({
            url: "<?php echo base_url('landing/checkCompany')?>",
            method: "POST",
            data: {'cmp_name': cn, 'csrf': Math.round(Math.random() * 10000000)},
            error: function() {
                alert(data);
            },
            success:function(stat) {
                //alert(stat);
                if(stat == 0)
                {
                    company_name_status =true;

                    document.getElementById('cpErr').innerHTML = "";
                    $("#submit_btn").removeAttr('disabled');
                    return true;
                }
                else
                {
                    company_name_status =false;
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