<h4 style="text-align: center; margin: 0"><label><!--"--><?php /*echo strtoupper($profile[0]->accountname); */?>Your Profile</label></h4><hr/>
<style>
    /*#pp {
        width: 200px;
        height: 250px;
    }
    #pi {
        width: 100px;
        height: 100px;
    }
    #edit{
        display: none;
        position: absolute;
    }*/
</style>
<style>
    .black_overlay{
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: black;
        z-index:1001;
        -moz-opacity: 0.8;
        opacity:.80;
        filter: alpha(opacity=80);
    }
    .white_content {
        display: none;
        position: fixed;
        top: 15%;
        left: 15%;
        width: 70%;
        height: 70%;
        padding: 16px;
        border: 5px solid #16A085;
        background-color: white;
        z-index:1002;
        overflow: auto;
    }
    .edit_profile_pic {
        display: none; /* Hide button */
        position: absolute;
    }
    .profile_pic_class:hover .edit_profile_pic{
        display: block; /* On :hover of div show button */
    }
</style>
<?php //print'<pre>'; print_r($profile);exit;
    if((isset($profile))&&(!empty($profile))){ ?>
        <div class="col-sm-2">
            <form id="profile" action="" method="post" enctype="multipart/form-data">
                <input id="userfile" type="file" style="display: none">
                <input type="submit" name="submit" id="submit" style="display: none">
            </form>
            <div class="profile_pic_class"><button id="popup" class="edit_profile_pic editicon btn btn-primary" style="margin: 0 0 0 0;"><i class="fa fa-pencil"> Change profile pic</i></button>
                <img id="pp"  src="<?php echo base_url('assets/images/user1.png');?>" />
            </div>

        </div>
        <script>
            $('#popup').click(function(e) {
                alert("Resolution W 100 x H 150 is preferred");
                e.preventDefault();
                $('#userfile').trigger('click');
            });
            $(':file').change(function(){
                $('#submit').trigger('click');
            });
            $('#submit').click(function(){
                var form =document.getElementById('profile'); //frmSample is form id
                var file = document.getElementById('userfile').files[0]; //userfile file tag id
                if (file) {
                    form['userfile'] = file;
                }

                $.ajaxFileUpload({
                    url:'<?php echo base_url("dashboard/testupload")?>',
                    secureuri:false,
                    fileElementId:'userfile',
                    dataType: 'json',
                    success: function (data, status) {
                        debugger;
                        if(typeof(data.error) != 'undefined')
                        {
                            if(data.error != '')
                            {
                                alert(data.error);
                            }else
                            {
                                alert(data.msg);
                            }
                        }
                    },
                    error: function (data, status, e) {
                        debugger;
                        alert(e);
                    }
                });
                return false;

                /*$.ajax({
                    url: '<?php echo base_url("dashboard/testupload")?>',
                    type: 'POST',
                    xhr: function() {  // custom xhr
                        //progressHandlingFunction to hangle file progress
                        var myXhr = $.ajaxSettings.xhr();
                        if (myXhr.upload) { // check if upload property exists
                            myXhr.upload.addEventListener('progress', progressHandlingFunction, false); // for handling the progress of the upload
                        }
                        return myXhr;
                    },
                    data: form,
                    cache: false,
                    contentType: false,  //must
                    processData: false,  //must
                    complete: function(XMLHttpRequest) {
                        //var data = JSON.parse(XMLHttpRequest.responseText);

                        console.log(XMLHttpRequest.responseText);
                        console.log('complete');
                    },
                    error: function() {
                        console.log("Sa");
                        console.log('error');
                    }
                }).done(function() {
                    console.log('Done Sending messages');
                }).fail(function() {
                    console.log('message sending failed');
                });*/
            });
        </script>
        <div class="col-sm-9">

    <?php   }  ?>
    <script src="<?php echo base_url('assets/js/tabcontent.js')?>" type="text/javascript"></script>
    <!--<h3 style="text-align: center; margin-top: 3px;"><label>Your Connections & All Other Jobs</label></h3><hr/>-->
    <?php   $userDetails = $this->session->userdata('userLoginDetails');
    $accountId = $userDetails->accountid;
    //print($accountId);
    //print'<pre>';print_r($jobs); exit;
    echo $this->session->flashdata('suc_msg');?>
    <ul class="tabs" data-persist="true">
        <li><a href="#view1">Main Details</a></li>
        <li><a href="#view2">Social links</a></li>
        <li><a href="#view3">Services</a></li>
        <li><a href="#view4">Company Est</a></li>
        <!--<li><a href="#view5">Portfolio</a></li>-->
    </ul>
    <div class="tabcontents">
        <div id="view1" style="min-height: 180px;">
            <?php //print'<pre>'; print_r($profile); print'</pre>'; ?>
            <div style="float: right; margin-right: 17%">
                <!--<div style="display: none; z-index: 99; position: absolute"  id="se1But">
                    <a href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='block';document.getElementById('fade').style.display='block'"><p class="btn btn-primary">To Edit click here</p></a>
                </div>-->
            </div>
            <div class="">
                <div class="col-md-10">
                    <strong> <a> <?php //echo $profile[0]->accountname; ?></a> </strong>
                    <!--<table class="table table-striped" style="margin-top: 15px;">
                        <tbody>
                        <tr> <td style="border: 0">Industry : </td><td style="border: 0"><?php /*echo $profile[0]->industry_name; */?></td> </tr>
                        <tr> <td style="border: 0">Email: </td><td style="border: 0"><strong><?php /*echo $profile[0]->username; */?></td> </tr>
                        <tr> <td style="border: 0">Mobile: </td><td style="border: 0"><strong>+1 - <?php /*echo $profile[0]->phonenumber; */?></td> </tr>
                        <tr> <td style="border: 0">Location:</td><td style="border: 0"> <?php /*echo $profile[0]->locationname; */?></td></tr>
                        </tbody>
                    </table>-->
                    <table class="table table-hover" style="margin-top: 15px;">
                        <tbody>
                        <tr><td style="border: 0;"><i class="fa fa-users"></i>&nbsp; <strong> <a><?php echo $profile[0]->accountname; ?> </a> </strong></td>
                            <td style="border: 0;"><i class="fa fa-list"></i>&nbsp;
                                <?php if($profile[0]->accounttype == 1) {echo " Super Admin "; }?>
                                <?php if($profile[0]->accounttype == 2) {echo " Employer "; }?>
                                <?php if($profile[0]->accounttype == 3) {echo " Recruiter "; }?>
                                <?php if($profile[0]->accounttype == 4) {echo " user "; }?>
                            </td>
                        </tr>
                        <tr>
                            <td style="border: 0;"><i class="fa fa-inbox"></i>&nbsp; <?php echo $profile[0]->username; ?></td>
                            <td style="border: 0;"><i class="fa fa-mobile-phone"></i>&nbsp; <?php echo $profile[0]->phonenumber; ?></td>
                        </tr>
                        <tr>
                            <td style="border: 0;"><i class="fa fa-user"></i>&nbsp; <?php echo $profile[0]->first_name; ?></td>
                            <!--<td style="border: 0;"><i class="fa fa-list-alt"></i>&nbsp; <?php /*echo $profile[0]->last_name; */?></td>-->
                            <td style="border: 0;"><i class="fa fa-suitcase"></i>&nbsp; <?php echo $profile[0]->industry_name; ?></td>
                        </tr>
                        <tr>
                            <td colspan="2" style="border: 0;"><i class="fa fa-map-marker"></i>&nbsp; <?php echo  $profile[0]->locationname; ?></td>
                            <!--<td style="border: 0;"><i class="fa fa-flag-checkered"></i>&nbsp; <?php /*echo  $profile[0]->countryname; */?></td>-->
                        </tr>
                        <!--<tr>
                     <td style="border: 0;"><i class="fa fa-automobile"></i>&nbsp; <?php /*echo $profile[0]->statename; */?></td>
                    <td style="border: 0;"><i class="fa fa-map-marker"></i>&nbsp; <?php /*echo $profile[0]->cityname; */?></td>
                </tr>-->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- pop up window for edit section 1-->
        <div id="light" class="white_content">
            <form action="<?php echo base_url('dashboard/editEmployer') ?>" onsubmit="return validationForm();" name="registercompany" id="registercompany" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">
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
                            <?php foreach ($industries as $industry) { echo '<option value="' . $industry->industryid . '">' . $industry->industry_name . '</option>'; } ?>
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
                <div class="col-md-12" align="center">
                    <input class="btn btn-success" type="submit" value="Send..!" id="submit">
                    <a href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'" class="btn btn-danger">Close</a>
                </div>
            </form>
        </div>
        <div id="fade" class="black_overlay"></div>
        <!-- End pop up window for edit section 1-->
        <div id="view2" style="min-height: 180px;">
            <?php //print'<pre>'; print_r($social); print'</pre>'; ?>
            <div style="float: right; margin-right: 17%">
                <div style="display: none; z-index: 99; position: absolute" id="sec2But">
                    <a href = "javascript:void(0)" onclick = "document.getElementById('light2').style.display='block';document.getElementById('fade2').style.display='block'"><p class="btn btn-primary">To Edit click here</p></a>
                </div>
            </div>
            <?php if(isset($social) && (!empty($social))) {?>
            <div class="user">
                <div class="col-md-10">
                    <table class="table table-striped" style="margin-top: 15px;">
                        <tbody>
                        <tr> <td style="border: 0">Facebook </td><td style="border: 0"><a href="javascript: void(0);"> <?php echo $social[0]->asu_facebook; ?></a></td> </tr>
                        <tr> <td style="border: 0">Google Plus  </td><td style="border: 0"><a href="javascript: void(0);"> <?php echo $social[0]->asu_google; ?></a></td> </tr>
                        <tr> <td style="border: 0">Twitter </td><td style="border: 0"><a href="javascript: void(0);"> <?php echo $social[0]->asu_twitter; ?></a></td> </tr>
                        <tr> <td style="border: 0">Linked In </td><td style="border: 0"><a href="javascript: void(0);"> <?php echo $social[0]->asu_linkedin; ?></a></td> </tr>
                        <tr> <td style="border: 0">Website </td><td style="border: 0"><a href="javascript: void(0);"><?php echo $social[0]->asu_website; ?></a></td> </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php  } else {?>
                <h3> No Details found for you</h3>
            <?php }?>
        </div>
        <div id="light2" class="white_content">
            <form action="<?php echo base_url('dashboard/editEmpSec2'); ?>" enctype="multipart/form-data" method="post" class="form-horizontal" role="form">
                    <div class="col-sm-6">
                        <label for="contact-name" class="control-label">Facebook:<span style="color:#C00"> *</span></label>
                        <input type="text" name="facebook" class="form-control" id="facebook" <?php if(isset($social) && (!empty($social))) { ?>value="<?php echo $social[0]->asu_facebook; ?>" <?php } else { ?> placeholder="facebook.com/yourId" <?php } ?>>
                        <div id="fErr" style="color:#C00"></div>
                    </div>
                    <div class="col-sm-6">
                        <label for="contact-name" class="control-label">Linked In:<span style="color:#C00"> *</span></label>
                        <input type="text" name="linkedIn" class="form-control" id="linkedIn" <?php if(isset($social) && (!empty($social))) { ?> value="<?php echo $social[0]->asu_linkedin; ?>" <?php } else { ?> placeholder="linkedin.com/yourId" <?php } ?>>
                        <div id="lErr" style="color:#C00"></div>
                    </div>
                    <div class="col-sm-6">
                        <label for="contact-name" class="control-label">Website:<span style="color:#C00"> *</span></label>
                        <input type="text" name="website" class="form-control" id="website" <?php if(isset($social) && (!empty($social))) { ?> value="<?php echo $social[0]->asu_website; ?>" <?php } else { ?> placeholder="www.example.com" <?php } ?>>
                        <div id="wErr" style="color:#C00"></div>
                    </div>
                    <div class="col-sm-6">
                        <label for="contact-name" class="control-label">Twitter:<span style="color:#C00"> *</span></label>
                        <input type="text" class="form-control" name="twitter" id="twitter" <?php if(isset($social) && (!empty($social))) { ?> value="<?php echo $social[0]->asu_twitter; ?>" <?php } else { ?> placeholder="twitter.com/yourId" <?php } ?>>
                        <div id="tErr" style="color:#C00"></div>
                    </div>
                    <div class="col-sm-6">
                        <label for="contact-name" class="control-label">Google+:<span style="color:#C00"> *</span></label>
                        <input type="text" class="form-control" name="google" id="google" <?php if(isset($social) && (!empty($social))) { ?> value="<?php echo $social[0]->asu_google; ?>" <?php } else { ?> placeholder="plus.google.com/+yourId" <?php } ?>>
                        <div id="gErr" style="color:#C00"></div>
                    </div>
                <div class="col-lg-12" style="margin-top: 20px;">
                    <div class="text-center">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-floppy-o"></i>&nbsp;Update</button>
                        <a href = "javascript:void(0)" onclick = "document.getElementById('light2').style.display='none';document.getElementById('fade2').style.display='none'" class="btn btn-danger"><i class="fa fa-times"></i> Close</a>
                    </div>
                </div>
            </form>
        </div>
        <div id="fade2" class="black_overlay"></div>
        <div id="view3" style="min-height: 180px;">
            <?php //print'<pre>'; print_r($services); print'</pre>'; ?>
            <div style="float: right; margin-right: 17%">
                <div style="display: none; z-index: 99; position: absolute" id="sec3But">
                    <a href = "javascript:void(0)" onclick = "document.getElementById('light3').style.display='block';document.getElementById('fade3').style.display='block'"><p class="btn btn-primary">To Edit click here</p></a>
                </div>
            </div>
            <?php if(isset($services) && (!empty($services))) {?>
            <div class="user">
                <div class="col-md-10">
                    <strong> <a href="javascript: void(0);"> <?php echo $profile[0]->accountname; ?></a> </strong>
                    <table class="table table-striped" style="margin-top: 15px;">
                        <tbody>
                        <tr> <td style="border: 0">Doing Services in </td><td style="border: 0"><?php echo $services[0]->as_service;?></td> </tr>
                        <tr> <td style="border: 0">Expert In </td><td style="border: 0"><?php echo $services[0]->as_expertise;?></td> </tr>
                        <tr> <td style="border: 0">Major client is </td><td style="border: 0"><?php echo $services[0]->as_client; ?></td> </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php  } else {?>
                <h3> No Details found for you</h3>
            <?php }?>
        </div>
        <div id="light3" class="white_content">
            <form action="<?php echo base_url('dashboard/editEmpSec3'); ?>" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">

                <h2>Services</h2>
                <div class="form-group">
                    <div class="col-sm-12">
                        <label for="contact-name" class="col-sm-2 control-label">Service Name:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="serviceName" name="serviceName" <?php if(isset($services) && (!empty($services))) { ?> value="<?php echo $services[0]->as_service; ?>" <?php } else { ?> placeholder="service Name" <?php } ?>>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <label for="contact-name" class="col-sm-2 control-label">Expertise:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="expertise" name="expertise" <?php if(isset($services) && (!empty($services))) { ?> value="<?php echo $services[0]->as_expertise; ?>" <?php } else { ?> placeholder="Expertise" <?php } ?>>
                        </div>
                    </div>
                </div>
                <h2>Clients</h2>
                <div class="form-group">
                    <div class="col-sm-12">
                        <label for="contact-name" class="col-sm-2 control-label">Client Name:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="client" name="client" <?php if(isset($services) && (!empty($services))) { ?> value="<?php echo $services[0]->as_client; ?>" <?php } else { ?> placeholder="Client Names by ," <?php } ?>>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12" style="margin-top: 20px;">
                    <div class="text-center">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-floppy-o"></i>&nbsp;Update</button>
                        <a href = "javascript:void(0)" onclick = "document.getElementById('light3').style.display='none';document.getElementById('fade3').style.display='none'" class="btn btn-danger"><i class="fa fa-times"></i> Close</a>
                    </div>
                </div>
            </form>
        </div>
        <div id="fade3" class="black_overlay"></div>
        <div id="view4" style="min-height: 180px;">
            <?php //print'<pre>'; print_r($company); print'</pre>'; ?>
            <div style="float: right; margin-right: 17%">
                <div style="display: none; z-index: 99; position: absolute" id="sec4But">
                    <a href = "javascript:void(0)" onclick = "document.getElementById('light4').style.display='block';document.getElementById('fade4').style.display='block'"><p class="btn btn-primary">To Edit click here</p></a>
                </div>
            </div>
            <?php if(isset($company) && (!empty($company))) {?>
            <div class="user">
                <div class="col-md-10">
                    <strong> <a href="javascript: void(0);"> <?php echo $profile[0]->accountname; ?></a> </strong>
                    <table class="table table-striped" style="margin-top: 15px;">
                        <tbody>
                        <tr> <td style="border: 0">Established date </td><td style="border: 0"><?php echo $company[0]->ac_est_date;?></td> </tr>
                        <tr> <td style="border: 0">Current revenue per year </td><td style="border: 0"><?php echo $company[0]->ac_ann_revenue;?></td> </tr>
                        <tr> <td style="border: 0">Total Employees </td><td style="border: 0"><?php echo $company[0]->ac_num_emp; ?></td> </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php  } else {?>
                <h3> No Details found for you</h3>
            <?php }?>
        </div>
        <div id="light4" class="white_content">
            <form action="<?php echo base_url('dashboard/editEmpSec4'); ?>" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">

                <div class="form-group">
                    <div class="col-sm-12">
                        <label for="contact-name" class="col-sm-3 control-label">Company Established Date:</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name ="estDate" id="estDate" <?php if(isset($company) && (!empty($company))) { ?> value="<?php echo $company[0]->ac_est_date; ?>" <?php } else { ?> placeholder="mm/dd/yyyy" <?php } ?> >
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <label for="contact-name" class="col-sm-3 control-label">Annual Revenue:</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="annRev" id="annRev" <?php if(isset($company) && (!empty($company))) { ?> value="<?php echo $company[0]->ac_ann_revenue; ?>" <?php } else { ?> placeholder="ex: 127545000" <?php } ?>>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <label for="contact-name" class="col-sm-3 control-label">Number Of Employees:</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="numEmp" id="numEmp" <?php if(isset($company) && (!empty($company))) { ?> value="<?php echo $company[0]->ac_num_emp; ?>" <?php } else { ?> placeholder="ex: 127545000" <?php } ?>>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12" style="margin-top: 20px;">
                    <div class="text-center">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-floppy-o"></i>&nbsp;Update</button>
                        <a href = "javascript:void(0)" onclick = "document.getElementById('light4').style.display='none';document.getElementById('fade4').style.display='none'" class="btn btn-danger"><i class="fa fa-times"></i> Close</a>
                    </div>
                </div>
            </form>
        </div>
        <div id="fade4" class="black_overlay"></div>
        <?php
        /*
         *
         ?>
        <div id="view5" style="min-height: 200px;">
            <?php $c = count($portfolio); //print'<pre>'; print_r($portfolio); print'</pre>'; ?>
            <div style="float: right; margin-right: 17%">
                <div style="display: none; z-index: 99; position: absolute" id="sec5But">
                    <a href = "javascript:void(0)" onclick = "document.getElementById('light5').style.display='block';document.getElementById('fade5').style.display='block'"><p class="btn btn-primary">To Edit click here</p></a>
                </div>
            </div>
            <?php if(isset($portfolio) && (!empty($portfolio))) {?>
            <strong> <a href="javascript: void(0);"> <?php echo $profile[0]->accountname; ?></a> </strong>
            <?php for($i=0;$i<$c;$i++){ ?>
            <div class="user">
                <div class="col-md-10">
                    <table class="table table-striped" style="margin-top: 15px;">
                        <!--file:///d:/xampp/htdocs/subcontract/application/portfolio_images/cartoon13.png-->
                        <tbody>
                        <tr> <td style="border: 0">Product Name</td><td style="border: 0"><?php echo $portfolio[$i]->ap_item;?></td> </tr>
                        <tr> <td style="border: 0">Product Category</td><td style="border: 0"><?php echo $portfolio[$i]->ap_item_cat;?></td> </tr>
                        <tr> <td style="border: 0">Product Description</td><td style="border: 0"><?php echo $portfolio[$i]->ap_item_desc;?></td> </tr>
                        <tr> <td style="border: 0">Product Image</td><td style="border: 0"><img id="pi" src='<?php echo base_url()."assets/portfolio_images/".$portfolio[$i]->ap_item_img;?>' /></td> </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php } } else {?>
                <h3> No portfolio details for you</h3>
            <?php }?>
        </div>
        <div id="light5" class="white_content">
            <form action="<?php echo base_url('dashboard/editEmpSec5'); ?>" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
                <input type="hidden" value="<?php echo $c;?>" name="counter">

                <?php $ids = array();
                foreach($portfolio as $p) {
                    $ids[] = $p->ap_id;
                }
                print_r($ids); ?>
                <input type="hidden" value="<?php print_r($ids);?>" name="ids">
                <?php for($i=0;$i<$c;$i++){ ?>
                <div class="col-sm-6">
                        <div class="form-group">
                            <div class="col-sm-12">
                                <label for="contact-name" class="col-sm-3 control-label">Item Name:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" <?php if(isset($portfolio) && (!empty($portfolio))) { ?> value="<?php echo $portfolio[$i]->ap_item; ?>" <?php } else { ?> placeholder="Enter Item Name" <?php } ?> id="item_<?php echo $i;?>" name="item_<?php echo $i;?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <label for="contact-name" class="col-sm-3 control-label">Category:</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="cat_<?php echo $i;?>">
                                        <option value="desktop">Desktop</option>
                                        <option value="mobile">Mobile</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <div class="col-sm-11">
                                <textarea  class="form-control" style="height:100px;"  placeholder="Enter Brief Description" name="desc_<?php echo $i;?>" id="desc_<?php echo $i;?>"><?php if(isset($portfolio) && (!empty($portfolio))) { echo $portfolio[$i]->ap_item_desc; } ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6">
                            <label for="Upload-Photo" class="col-sm-3 control-label">Upload Photo:</label>
                            <div class="col-sm-9">
                                <input type="file" id="file<?php echo $i;?>"  name="file_<?php echo $i;?>" class="form-control"/>
                                <span><?php echo $portfolio[$i]->ap_item_img;?></span>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <div class="col-lg-12" style="margin-top: 20px;">
                    <div class="text-center">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-floppy-o"></i>&nbsp;Update</button>
                        <a href = "javascript:void(0)" onclick = "document.getElementById('light5').style.display='none';document.getElementById('fade5').style.display='none'" class="btn btn-danger"><i class="fa fa-times"></i> Close</a>
                    </div>
                </div>
            </form>
        </div>
        <div id="fade5" class="black_overlay"></div>
        <?php
         */
?>
    </div>
</div>
<!--<script>
    $(document).ready(function () {
        $("input#submit").click(function(){
            $.ajax({
                type: "POST",
                url: "<?php /*echo base_url('dashboard/editEmployer');*/?>", //process to mail
                data: $('form.contact').serialize(),
                success: function(msg){
                    $("#thanks").html(msg) //hide button and show thank you
                    $("#form-content").modal('hide'); //hide popup
                },
                error: function(){
                    alert("failure");
                }
            });
        });
    });
</script>-->
<script>
    $("#view1").hover(function() {
        $("#se1But").fadeIn();
    },function() {
        $("#se1But").hide();
    });
    $("#se1But").mouseover(function() {
        $(this).show();
    });
    // Section 2 edit button
    $("#view2").hover(function() {
        $("#sec2But").fadeIn();
    },function() {
        $("#sec2But").hide();
    });
    $("#sec2But").mouseover(function() {
        $(this).show();
    });
    // Section 3 edit button
    $("#view3").hover(function() {
        $("#sec3But").fadeIn();
    },function() {
        $("#sec3But").hide();
    });
    $("#sec3But").mouseover(function() {
        $(this).show();
    });
    // Section 4 edit button
    $("#view4").hover(function() {
        $("#sec4But").fadeIn();
    },function() {
        $("#sec4But").hide();
    });
    $("#sec4But").mouseover(function() {
        $(this).show();
    });
    // Section 2 edit button
    $("#view5").hover(function() {
        $("#sec5But").fadeIn();
    },function() {
        $("#sec5But").hide();
    });
    $("#sec5But").mouseover(function() {
        $(this).show();
    });
</script>
<script>
    $("#pp").hover(function() {
        $("#edit").fadeIn();
    },function() {
        $("#edit").hide();
    });
    $("#edit").mouseover(function() {
        $(this).show();
    });
</script>
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
<script>
    $(document).ready(function () {
        $(document).on('change', '#country_name', function () {
            if (this.value == 0) {
                alert('Please select proper country');
                return false;
            }
            var dest = '#state_name';
            $.ajax({
                url: '<?php echo base_url('dashboard/getStates');?>',
                type: 'POST',
                data: {'countryId': this.value, 'rand': Math.round(Math.random() * 1000000)},
                datatype: 'html',
                beforeSend: function () {
                    $(dest).text('<option value="0">Please wait .. </option>');
                },
                error: function () {
                    $(dest).text('<option value="0">Error....</option>');
                },
                success: function (data) {
                    $(dest).text('').append(data);
                }
            });
        });
        $(document).on('change', '#state_name', function () {
            if (this.value == 0) {
                alert('Please select proper state');
                return false;
            }
            var dest = '#city_name';
            $.ajax({
                url: '<?php echo base_url('dashboard/getCities');?>',
                type: 'POST',
                data: {'stateId': this.value, 'rand': Math.round(Math.random() * 1000000)},
                datatype: 'html',
                beforeSend: function () {
                    $(dest).text('<option value="0">Please wait .. </option>');
                },
                error: function () {
                    $(dest).text('<option value="0">Error....</option>');
                },
                success: function (data) {
                    $(dest).text('').append(data);
                }
            });
        });

    });

</script>
<script type="text/javascript">
    $(document).ready(
        function() {
            $('#estDate').datepicker( {
                onClose: function(dateText, inst) {
                    alert("My date is: " + dateText);
                },
                dateFormat:"mm/dd/yy"
            });
        }
    );
</script>