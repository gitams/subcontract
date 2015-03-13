<div class="afterLogin">
    <div class="row">
        <div class="col-sm-12">
            <h2 style="text-align: center"><label>Add A Recruiter</label></h2><hr/>
            <form action="<?php echo base_url('dashboard/saveRec') ?>" name="add_rec" id="add_rec" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">
                <div class="form-group">
                    <div class="col-sm-9">
                        <label for="posttitle" class="col-sm-4 control-label pull-left">First name:<span style="color: #FF0000"> *</span></label>
                        <div class="col-sm-8">
                            <input type="text" name="rec_first_name" class="form-control" id="rec_first_name" placeholder="First name" required="required">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                        <label for="posttitle" class="col-sm-4 control-label pull-left">Last Name:<span style="color: #FF0000"> *</span></label>
                        <div class="col-sm-8">
                                <input type="text" name="rec_last_name" class="form-control" id="rec_last_name" placeholder="Last Name" required="required">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                        <label for="numberOfPositions" class="col-sm-4 control-label pull-left">Email:<span style="color: #FF0000"> *</span></label>
                        <div class="col-sm-8">
                            <input type="text" name="rec_email" class="form-control" id="rec_email" placeholder="Eg: email@company.com" required="required">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                        <label for="Qualification" class="col-sm-4 control-label pull-left">Mobile:<span style="color: #FF0000"> *</span></label>
                        <div class="col-sm-8">
                            <input type="text" name="rec_mobile" class="form-control" id="rec_mobile" placeholder=" 10 Digits only" required="required">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                        <label for="Password" class="col-sm-4 control-label pull-left">Password:<span style="color: #FF0000"> *</span></label>
                        <div class="col-sm-8">
                            <input type="password" name="rec_password" class="form-control" id="rec_password" placeholder="******" required="required">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                        <label for="ConfirmPassword" class="col-sm-4 control-label pull-left">Confirm password:<span style="color: #FF0000"> *</span></label>
                        <div class="col-sm-8">
                            <input type="password" name="rec_cpassword" onkeyup="checkPass(); return false;" class="form-control" id="rec_cpassword" placeholder="*******" required="required">
                        </div>
                    </div>
                </div>
                <div class="form-group form_buttons">
                    <div class="col-lg-12 text-center">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-floppy-o"></i> &nbsp; Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function checkPass()
    {
        var pass1 = document.getElementById('rec_password');
        var pass2 = document.getElementById('rec_cpassword');
        var goodColor = "#66cc66";
        var badColor = "#ff6666";
        if(pass1.value == pass2.value){
            pass2.style.backgroundColor = goodColor;
        }else{
            pass2.style.backgroundColor = badColor;
        }
    }
</script>
