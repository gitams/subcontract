
<div class="register_section">
    <div class="container">
        <div class="register_content">
            <div class="step_staging">
                <img src="<?php echo base_url('assets/images/step1_num.jpg'); ?>"  />
            </div>
            <div class="register_form">
                <h1><i class="fa fa-suitcase"></i>&nbsp;&nbsp;&nbsp;Add Company Profile</h1>
                <div class="row">
                    <div class="col-sm-12">
                        <form action="<?php echo base_url('landing/saveCompany') ?>" onsubmit="return validationForm();" name="registercompany" id="registercompany" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <label for="email" class="col-sm-4 control-label">Email Id:<span style="color: #FF0000"> *</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" name="username" value="<?php echo set_value("username"); ?>" class="form-control" id="email" placeholder="Email Id" >
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
                                        <input type="password" name="confirmpassword" class="form-control" id="confirmpassword" placeholder="Confirm Password" >
                                        <p id="cpErr" style="color:#C00;"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <label for="company" class="col-sm-4 control-label">Company Name:<span style="color: #FF0000"> *</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" name="companyname" class="form-control" id="companyName" placeholder="Company Name" value="<?php echo set_value("companyname"); ?>" >
                                        <p id="cNameErr" style="color:#C00;"></p>
                                    </div>
                                </div>

                                <!--<div class="col-sm-6">
                                    <label for="contact-name" class="col-sm-4 control-label">Profile Image:</label>
                                    <div class="col-sm-8">
                                        <input type="file" class="form-control" name="profile_pic" id="profile_pic"/>
                                    </div>
                                </div>-->

                                <div class="col-sm-6">
                                    <label for="industry" class="col-sm-4 control-label">Industry Type:<span style="color: #FF0000"> *</span></label>
                                    <div class="col-sm-8">
                                        <select name="industry" class="form-control" id="industry">
                                            <option value="0">Select Industry</option>
                                            <?php
                                            foreach ($industries as $industry) {
                                                echo '<option value="' . $industry->industryid . '">' . $industry->industry_name . '</option>';
                                            }
                                            ?>
                                        </select>
                                        <p id="iErr" style="color:#C00;"></p>
                                        <!--<input type="text" class="form-control" id="contact-name" placeholder="Name">-->
                                    </div>
                                </div>

                            </div>
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <label for="address" class="col-sm-4 control-label">Address:<span style="color: #FF0000"> *</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" name="address1" class="form-control" id="address1" placeholder="Line1" value="<?php echo set_value("address1"); ?>" >
                                        <p id="a1Err" style="color:#C00;"></p>
                                    </div> </div>
                                    <div class="col-sm-6">
                                        <div class="col-sm-4">
                                            <label for="address" class="control-label">street:</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <input type="text" name="address2" class="form-control" id="Address2" placeholder="Line2" value="<?php echo set_value("address2"); ?>">
                                        </div>
                                    </div>

                            </div>
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <label for="country" class="col-sm-4 control-label">Country:<span style="color: #FF0000"> *</span></label>
                                    <div class="col-sm-8">
                                        <select name="country" id="country_name" class="form-control" >
                                            <option value="0">Select Country</option>
                                            <?php foreach ($countries as $country) { echo '<option value="' . $country->countryid . '">' . $country->countryname . '</option>'; } ?>
                                        </select>
                                        <p id="cErr" style="color:#C00;"></p>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="state" class="col-sm-4 control-label">State:<span style="color: #FF0000"> *</span></label>
                                    <div class="col-sm-8">
                                        <select name="state" id="state_name" class="form-control" >
                                            <option value="">Select a State</option>
                                        </select>
                                        <p id="sErr" style="color:#C00;"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <label for="city" class="col-sm-4 control-label">City:<span style="color: #FF0000"> *</span></label>
                                    <div class="col-sm-8">
                                        <select name="city" id="city_name" class="form-control" >
                                            <option value="0">Select a City</option>
                                        </select>
                                        <p id="ctErr" style="color:#C00;"></p>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="zipcode" class="col-sm-4 control-label">Zipcode:<span style="color: #FF0000"> *</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="zipcode" placeholder="Zipcode" name="zipcode" value="<?php echo set_value("zipcode"); ?>" />
                                        <p id="zErr" style="color:#C00;"></p>
                                    </div>
                                </div>

                            </div>
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <label for="contact-number" class="col-sm-4 control-label">Contact Number:<span style="color: #FF0000"> *</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" maxlength="10" name="contactNumber" class="form-control" id="contact-number" placeholder="Contact Number" value="<?php echo set_value("contactNumber"); ?>" >
                                        <p id="numErr" style="color:#C00;"></p>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="contact-name" class="col-sm-4 control-label">Contact Name:<span style="color: #FF0000"> *</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" name="contactName" class="form-control" id="contact-name" placeholder="Contact name" value="<?php echo set_value("contactName"); ?>" >
                                        <p id="conErr" style="color:#C00;"></p>
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
                            <div class="form-group">
                                <div class="col-sm-5"></div>
                                <div class="col-sm-6">
                                    <input type="checkbox" name="promotions"/>&nbsp;&nbsp;&nbsp;I want to receive promotions on my email Id.
                                </div>

                            </div>
                            <div class="form-group form_buttons">
                                <div class="col-lg-12 text-center">
                                    <button class="btn btn-primary submit" type="submit"><i class="fa fa-floppy-o"></i> <i class="fa fa-share"></i> &nbsp; Next</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $ext = $this->config->item('restrictedDomains'); $cnt = count($ext); //print_r($ext); echo $cnt;?>
<script>
    $(function() {
        $('#password').on('keypress', function(e) {
            if (e.which == 32)
                return false;
        });
    });
</script>
<script type="text/javascript">
    function validationForm() {
        var e = document.getElementById('email').value;
        var p = document.getElementById('password').value;
        var cp = document.getElementById('confirmpassword').value;
        var cn = document.getElementById('companyName').value;
        var i = document.getElementById('industry').value;
        var a1 = document.getElementById('address1').value;
        var c = document.getElementById('country_name').value;
        var s = document.getElementById('state_name').value;
        var ct = document.getElementById('city_name').value;
        var z = document.getElementById('zipcode').value;
        var cNum = document.getElementById('contact-number').value;
        var conName = document.getElementById('contact-name').value;
        var ag = document.getElementById('agree').checked;
        var eReg = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/igm;

        document.getElementById('emailErr').innerHTML = "";
        document.getElementById('emailSuc').innerHTML = "";
        document.getElementById('pErr').innerHTML = "";
        document.getElementById('cpErr').innerHTML = "";
        document.getElementById('cNameErr').innerHTML = "";
        document.getElementById('iErr').innerHTML = "";
        document.getElementById('a1Err').innerHTML = "";
        document.getElementById('cErr').innerHTML = "";
        document.getElementById('sErr').innerHTML = "";
        document.getElementById('ctErr').innerHTML = "";
        document.getElementById('zErr').innerHTML = "";
        document.getElementById('numErr').innerHTML = "";
        document.getElementById('conErr').innerHTML = "";
        document.getElementById('agErr').innerHTML = "";

        if (e == "" || e == null) {
            $('#emailErr').css('padding', '10px 0 0 12px');
            document.getElementById('emailErr').innerHTML = "Please fill this field";
            document.getElementById('email').focus();
            return false;
        } else if(!(eReg.test(e))){
            $('#emailErr').css('padding', '10px 0 0 12px');
            document.getElementById('emailErr').innerHTML = "Please Enter a valid email Id";
            document.getElementById('email').focus();
            return false;
        } else {
            var one = e.split("@");
            var two = one['1'].split(".");
            <?php for ($i = 0; $i < $cnt; $i++) { ?>
                if(two['0'] == "<?php echo $ext[$i];?>") {
                    $('#emailErr').css('padding', '10px 0 0 12px');
                    document.getElementById('emailSuc').innerHTML = "";
                    document.getElementById('emailErr').innerHTML = "Invalid Email Extension";
                    document.getElementById('email').focus();
                    return false;
                }<?php } ?> else {
                    $.ajax({
                        url: "<?php echo base_url('landing/checkUser')?>",
                        method: "POST",
                        data: {'email': e, 'csrf': Math.round(Math.random() * 10000000)},
                        error: function(){
                            alert(data);
                        },
                        success:function(stat){
                            //alert(stat);
                            if(stat == 0) {
                                $.ajax({
                                    url: "<?php echo base_url('landing/checkExt')?>",
                                    method: "POST",
                                    data: {'email': e, 'csrf': Math.round(Math.random() * 10000000)},
                                    error: function(){
                                        alert(data);
                                    },
                                    success:function(stat){
                                        if(stat == 0) {
                                            document.getElementById("emailErr").style.padding = "0 0 0 0";
                                            document.getElementById("emailSuc").style.padding = "10px 0 0 12px";
                                            document.getElementById('emailSuc').innerHTML = "Available";
                                        }else{
                                            document.getElementById("emailErr").style.padding = "10px 0 0 12px";
                                            document.getElementById('emailErr').innerHTML = "Already registered from ur company";
                                            document.getElementById('email').focus();
                                            //event.preventDefault();
                                            return false;
                                        }
                                    }
                                });
                            }else{
                                document.getElementById("emailErr").style.padding = "10px 0 0 12px";
                                document.getElementById('emailErr').innerHTML = "User already exist !";
                                document.getElementById('email').focus();
                                //event.preventDefault();
                                return false;
                            }
                        }
                    });
                }
        }
        if (p == "" || p == null) {
            $('#pErr').css('padding', '10px 0 0 12px');
            document.getElementById('pErr').innerHTML = "Please fill this field";
            document.getElementById('password').focus();
            return false;
        } /*else if (p.length < 8) {
            $('#pErr').css('padding', '10px 0 0 12px');
            document.getElementById('pErr').innerHTML = "Password must contain 8 chars";
            document.getElementById('password').focus();
            return false;
        } else if (p.length > 20) {
            $('#pErr').css('padding', '10px 0 0 12px');
            document.getElementById('pErr').innerHTML = "Password less than 20 chars";
            document.getElementById('password').focus();
            return false;
        } else if (p.search(/\d/) == -1) {
            $('#pErr').css('padding', '10px 0 0 12px');
            document.getElementById('pErr').innerHTML = "Password must contain one digit";
            document.getElementById('password').focus();
            return false;
        } else if (p.search(/[a-z]/) == -1) {
            $('#pErr').css('padding', '10px 0 0 12px');
            document.getElementById('pErr').innerHTML = "Password must contain one lower case a-z";
            document.getElementById('password').focus();
            return false;
        } else if (p.search(/[A-Z]/) == -1) {
            $('#pErr').css('padding', '10px 0 0 12px');
            document.getElementById('pErr').innerHTML = "Password must contain one upper case A-Z";
            document.getElementById('password').focus();
            return false;
        } else if (p.search(/[\!\@\$]/) == -1) {
            $('#pErr').css('padding', '10px 0 0 12px');
            document.getElementById('pErr').innerHTML = "Password must contain one of these ! @ $";
            document.getElementById('password').focus();
            return false;
        }*/
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
        if (cn == "" || cn == null) {
            $('#cNameErr').css('padding', '10px 0 0 12px');
            document.getElementById('cNameErr').innerHTML = "Please fill this field";
            document.getElementById('companyName').focus();
            return false;
        }
        if (i == "" || i == null || i == 0) {
            $('#iErr').css('padding', '10px 0 0 12px');
            document.getElementById('iErr').innerHTML = "Please select an industry";
            document.getElementById('industry').focus();
            return false;
        }
        if (a1 == "" || a1 == null) {
            $('#a1Err').css('padding', '10px 0 0 12px');
            document.getElementById('a1Err').innerHTML = "Please fill this field";
            document.getElementById('address1').focus();
            return false;
        }
        if (c == "" || c == null || c == 0) {
            $('#cErr').css('padding', '10px 0 0 12px');
            document.getElementById('cErr').innerHTML = "Please fill this field";
            document.getElementById('country_name').focus();
            return false;
        }
        if (s == "" || s == null || s == 0) {
            $('#sErr').css('padding', '10px 0 0 12px');
            document.getElementById('sErr').innerHTML = "Please fill this field";
            document.getElementById('state_name').focus();
            return false;
        }
        if (ct == "" || ct == null || ct == 0) {
            $('#ctErr').css('padding', '10px 0 0 12px');
            document.getElementById('ctErr').innerHTML = "Please fill this field";
            document.getElementById('city_name').focus();
            return false;
        }
        if (z == "" || z == null) {
            $('#zErr').css('padding', '10px 0 0 12px');
            document.getElementById('zErr').innerHTML = "Please fill this field";
            document.getElementById('zipcode').focus();
            return false;
        }
        if (cNum == "" || cNum == null) {
            $('#numErr').css('padding', '10px 0 0 12px');
            document.getElementById('numErr').innerHTML = "Please fill this field";
            document.getElementById('contact-number').focus();
            return false;
        }
        if (conName == "" || conName == null) {
            $('#conErr').css('padding', '10px 0 0 12px');
            document.getElementById('conErr').innerHTML = "Please fill this field";
            document.getElementById('contact-name').focus();
            return false;
        }
        if (ag == false) {
            $('#agErr').css('padding', '10px 0 0 12px');
            document.getElementById('agErr').innerHTML = "Please accept terms and conditions";
            document.getElementById('agree').focus();
            return false;
        }
    }
</script>
<script type="text/javascript" src="<?php echo base_url('assets/js/register.js'); ?>"></script>