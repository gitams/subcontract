
<div class="afterLogin">
    <div class="row">
                <h2 align="center"><i class="fa fa-suitcase"></i>&nbsp;&nbsp;&nbsp;Edit Company Profile</h2><hr/>
                <div class="row">
                    <div class="col-sm-12">
                        <form action="<?php echo base_url('landing/saveCompany') ?>" onsubmit="return validationForm();" name="registercompany" id="registercompany" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">
                            <div class="">
                                <div class="col-sm-6">
                                    <label for="email" class="control-label">Email Id:<span style="color: #FF0000"> *</span></label>
                                        <input type="text" readonly name="username" value="<?php echo set_value("username"); ?>" class="form-control" id="email" placeholder="Email Id" >
                                </div>
                            </div>
                            <div class="">
                                <div class="col-sm-6">
                                    <label for="company" class="control-label">Company Name:<span style="color: #FF0000"> *</span></label>
                                        <input type="text" readonly name="companyname" class="form-control" id="companyName" placeholder="Company Name" value="<?php echo set_value("companyname"); ?>" >
                                        <p id="cNameErr" style="color:#C00;"></p>
                                </div>

                                <div class="col-sm-6">
                                    <label for="industry" class="control-label">Industry Type:<span style="color: #FF0000"> *</span></label>
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
                            <div class="">
                                <div class="col-sm-6">
                                    <label for="address" class="control-label">Address:<span style="color: #FF0000"> *</span></label>
                                        <input type="text" name="address1" class="form-control" id="address1" placeholder="Line1" value="<?php echo set_value("address1"); ?>" >
                                        <p id="a1Err" style="color:#C00;"></p>
                                </div>
                                <div class="col-sm-6">
                                        <label for="address" class="control-label">street:</label>
                                        <input type="text" name="address2" class="form-control" id="Address2" placeholder="Line2" value="<?php echo set_value("address2"); ?>">
                                </div>

                            </div>
                            <div class="">
                                <div class="col-sm-6">
                                    <label for="country" class="control-label">Country:<span style="color: #FF0000"> *</span></label>
                                        <select name="country" id="country_name" class="form-control" >
                                            <option value="0">Select Country</option>
                                            <?php foreach ($countries as $country) { echo '<option value="' . $country->countryid . '">' . $country->countryname . '</option>'; } ?>
                                        </select>
                                        <p id="cErr" style="color:#C00;"></p>
                                </div>
                                <div class="col-sm-6">
                                    <label for="state" class="control-label">State:<span style="color: #FF0000"> *</span></label>
                                        <select name="state" id="state_name" class="form-control" >
                                            <option value="">Select a State</option>
                                        </select>
                                        <p id="sErr" style="color:#C00;"></p>
                                </div>
                            </div>
                            <div class="">
                                <div class="col-sm-6">
                                    <label for="city" class="control-label">City:<span style="color: #FF0000"> *</span></label>
                                        <select name="city" id="city_name" class="form-control" >
                                            <option value="0">Select a City</option>
                                        </select>
                                        <p id="ctErr" style="color:#C00;"></p>
                                </div>
                                <div class="col-sm-6">
                                    <label for="zipcode" class="control-label">Zipcode:<span style="color: #FF0000"> *</span></label>
                                        <input type="text" class="form-control" id="zipcode" placeholder="Zipcode" name="zipcode" value="<?php echo set_value("zipcode"); ?>" />
                                        <p id="zErr" style="color:#C00;"></p>
                                </div>

                            </div>
                            <div class="">
                                <div class="col-sm-6">
                                    <label for="contact-number" class="control-label">Contact Number:<span style="color: #FF0000"> *</span></label>
                                        <input type="text" maxlength="10" name="contactNumber" class="form-control" id="contact-number" placeholder="Contact Number" value="<?php echo set_value("contactNumber"); ?>" >
                                        <p id="numErr" style="color:#C00;"></p>
                                </div>
                            </div>
                            <div class=" form_buttons">
                                <div class="col-lg-12 text-center">
                                    <button class="btn btn-primary submit" type="submit"><i class="fa fa-floppy-o"></i></i> &nbsp; Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
<?php $ext = $this->config->item('restrictedDomains'); $cnt = count($ext); //print_r($ext); echo $cnt;?>
<script type="text/javascript">
    function validationForm() {

        var i = document.getElementById('industry').value;
        var a1 = document.getElementById('address1').value;
        var c = document.getElementById('country_name').value;
        var s = document.getElementById('state_name').value;
        var ct = document.getElementById('city_name').value;
        var z = document.getElementById('zipcode').value;
        var cNum = document.getElementById('contact-number').value;


        
        document.getElementById('cNameErr').innerHTML = "";
        document.getElementById('iErr').innerHTML = "";
        document.getElementById('a1Err').innerHTML = "";
        document.getElementById('cErr').innerHTML = "";
        document.getElementById('sErr').innerHTML = "";
        document.getElementById('ctErr').innerHTML = "";
        document.getElementById('zErr').innerHTML = "";
        document.getElementById('numErr').innerHTML = "";

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
    }
</script>
<script type="text/javascript" src="<?php echo base_url('assets/js/register.js'); ?>"></script>