<div class="register_section search_company">
    <div class="container">
        <div class="search_bar2">
            <div class="register_content">
                <div class="register_form">
                    <h1 style="margin-bottom: 1%;"><i class="fa fa-check-square"></i>&nbsp;&nbsp;&nbsp;Forgot Password</h1>
                    <div class="row">
                        <div class="col-sm-12">
                            <form action="<?php echo base_url('landing/updatePassword') ?>" onsubmit="return validationForm();" name="updatePassword" id="updatePassword" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">
                                <div class="form-group">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-6">
                                        <?php //print_r($_GET);?>
                                        <span>Please provide your registered Email id and New Password for login</span><br/>
                                        <label for="email" class="control-label">Email Id:<span style="color: #FF0000"> *</span></label>
                                        <input type="text" name="email" class="form-control" id="email" placeholder="Email" >
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
                                        <label for="np" class="control-label">New Password:<span style="color: #FF0000"> *</span></label>
                                        <input type="password" name="newP" class="form-control" id="newP" placeholder="New Password">
                                        <p id="newPErr" style="color:#C00;"></p>
                                        <label for="ncp" class="control-label">Confirm New Password:<span style="color: #FF0000"> *</span></label>
                                        <input type="password" name="newCP" class="form-control" id="newCP" placeholder="Confirm">
                                        <p id="newCPErr" style="color:#C00;"></p>
                                        <input type="hidden" name="aid" value="<?php echo $_GET['token']?>">
                                        <input type="hidden" name="cid" value="<?php echo $_GET['toke']?>">
                                        <input type="hidden" name="tid" value="<?php echo $_GET['tok']?>">
                                        <div class="text-center"  style="margin-top: 1%;">
                                            <button class="btn btn-primary" id="submit_btn" type="submit" name="submit"><i class="fa fa-paper-plane"></i> &nbsp; Submit</button>
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
        var p = document.getElementById('newP').value;
        var cp = document.getElementById('newCP').value;
        var eReg = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/igm;

        document.getElementById('emailErr').innerHTML = "";
        document.getElementById('newPErr').innerHTML = "";
        document.getElementById('emailSuc').innerHTML = "";
        document.getElementById('newCPErr').innerHTML = "";
        if (e == "" || e == null)
        {
            $('#emailErr').css('padding', '10px 0 0 12px');
            document.getElementById('emailErr').innerHTML = "Please fill this field";
            document.getElementById('email').focus();
            return false;
        } else if(!(eReg.test(e))) {
            $('#emailErr').css('padding', '10px 0 0 12px');
            document.getElementById('emailErr').innerHTML = "Please Enter a valid email Id";
            document.getElementById('email').focus();
            return false;
        }
       else if (p == "" || p == null) {
            $('#newPErr').css('padding', '10px 0 0 12px');
            document.getElementById('newPErr').innerHTML = "Please fill this field";
            document.getElementById('newP').focus();
            return false;
        }
        else if (cp == "" || cp == null) {
        $('#newCPErr').css('padding', '10px 0 0 12px');
        document.getElementById('newCPErr').innerHTML = "Please fill this field";
        document.getElementById('newCP').focus();
        return false;
        }
        else if (p != cp) {
			$('#newCPErr').css('padding', '10px 0 0 12px');
			document.getElementById('newCPErr').innerHTML = "Password Does not match";
			document.getElementById('newCP').focus();
			return false;
        }
    }

</script>
