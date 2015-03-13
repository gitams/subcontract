<!DOCTYPE html>
<html>
<head>
    <title><?php if(isset($title)) { echo $title; } ?></title>
    <!-- CSS Links-->
    <link rel="stylesheet" media="screen" href="<?php echo base_url('assets/styles/font-awesome.css')?>"/>
    <link rel="stylesheet" media="screen" href="<?php echo base_url('assets/styles/jquery-ui.css')?>"/>
    <link rel="stylesheet" media="screen" href="<?php echo base_url('assets/styles/bootstrap.css')?>"/>
    <link rel="stylesheet" media="screen" href="<?php echo base_url('assets/styles/dash.css"')?>"/>
    <link rel="stylesheet" media="screen" href="<?php echo base_url('assets/styles/jquery1-ui.css')?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/styles/responsivemobilemenu.css')?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/styles/jquery.tokenize.css')?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/styles/tabcontent.css')?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/styles/slideControl.css');  ?>" />
    <!-- Js Links -->
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery-ui.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.validate.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/typeahead.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.dataTables.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/dataTables.bootstrap.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/responsivemobilemenu.js')?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery-1.10.2.js')?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery1-ui.js')?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.slideControl.js');  ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.min.js');  ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.tokenize.js'); ?>"></script>
    <script type="text/javascript" >
        $(document).ready(function()
        {
            $("#notificationLink").click(function() {
                $("#notificationContainer").fadeToggle(300);
                $("#notification_count").fadeOut("slow");
                $("#notificationsBody").load("notifications");
                return false;
            });
            //Document Click
            $(document).click(function() {	$("#notificationContainer").hide();	});
            //Popup Click
        });
    </script>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
</head>
<body>
<div class="dash-wrap">
    <div class="dash-container">
        <div class="dash-header">
            <div class="dash-logo"><img style="padding-left:35px;" src="<?php echo base_url('assets/images/logo.png');?>" alt=""></div>
            <?php if ($this->session->userdata('isLoggedin') == 1) { ?>
                <div class="clear"></div>
                <div class="drop" style="margin-top: 2.3%">
                    <ul class="drop_menu">
                        <li><a href='javascript:void(0);' style="padding-left:0px; margin-left:0px;">Home</a></li>
                        <li><a href='javascript:void(0);'>Jobs</a>
                        </li>
                        <li><a href='javascript:void(0);'>Employers</a>
                        </li>
                    </ul>
                    <div class="drop" style=" width: auto; padding: 5px; border: 2px; border-radius: 20px; float: right">
                        <div class="circle" style=" float: left; background-image: url('<?php echo base_url('assets/images/kick.png'); ?>'); "></div>
                        <ul class="drop_menu">
                            <li><a href="<?php echo base_url('dashboard'); ?>"><?php echo $this->session->userdata('username'); ?></a>
                                <ul>
                                    <li><a href="javascript:void(0);">My Profile</a></li>
                                    <li><a href="javascript:void(0);">Messages</a></li>
                                    <li><a href="javascript:void(0);">Settings</a></li>
                                    <li><a href="<?php echo base_url('no_profile/signout'); ?>">Sign Out</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>

            <?php } else { ?>
                <form name="userlogin" id="userlogin" method="post" enctype="multipart/form-data" action="<?php echo base_url('landing/login'); ?>">
                    <div class="col-sm-2 fr">
                        <input type="submit" value="Sign In" tabindex="3" class="signin_btn" />
                    </div>
                    <div class="input_section col-sm-3 fr">
                        <i class="fa fa-key"></i>&nbsp;<input tabindex="2" type="password" name="userpassword" id="userpassword" placeholder="Password" />
                    </div>
                    <div class="input_section col-sm-3 fr">
                        <i class="fa fa-envelope"></i>&nbsp;<input tabindex="1" type="text" name="useremail" id="useremail" placeholder="Email Address"  />
                    </div>
                </form>
                <div class="clear"></div>
            <?php } ?>
        </div>
<?php
if ($this->session->flashdata('error')) {
    $errors = $this->session->flashdata('error');
    echo '<div class="container" style="margin-top: 3px;">';
    foreach ($errors as $error) {
        echo '<div class="' . $error[0] . '">'
            . '<button class="close" data-dismiss="alert" type="button">x</button>' . $error[1] . '</div>';
    }
    echo '</div>';
} ?>
<div class="dash-main">
    <h3 style="text-align: center; margin-top: 3px;"><label>Add Your Profile</label></h3><hr/>
    <div class="errors">
        <?php echo validation_errors(); ?>
    </div>
    <?php //echo "<pre>"; print_r($profile); echo "</pre>";?>
    <?php //echo "<pre>"; echo $profile->username; echo "</pre>";?>
    <div class="row">
        <div class="col-sm-12">
            <form action="<?php echo base_url('no_profile/saveSelfUser') ?>" name="addCandidate" id="addCandidate" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">
                <div class="form-group">
                    <div class="col-sm-9">
                        <label for="posttitle" class="col-sm-4 control-label pull-left">First Name:<span style="color: #FF0000"> *</span></label>
                        <div class="col-sm-8">
                            <input type="text" name="su_first_name" class="form-control" id="su_first_name" value="" required="required">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                        <label for="posttitle" class="col-sm-4 control-label pull-left">Last Name:<span style="color: #FF0000"> *</span></label>
                        <div class="col-sm-8">
                            <input type="text" name="su_last_name" class="form-control" id="su_last_name" value="" required="required">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                        <label for="posttitle" class="col-sm-4 control-label pull-left">Mobile:<span style="color: #FF0000"> *</span></label>
                        <div class="col-sm-8">
                            <input type="text" name="su_mobile" class="form-control" id="su_mobile" value=""  maxlength="10" pattern="\d{10}" required="required" title="only 10 digits">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                        <label for="postDescription" class="col-sm-4 control-label pull-left">Email:<span style="color: #FF0000"> *</span></label>
                        <div class="col-sm-8">
                            <input type="email" class="form-control" rows="4" id="su_email" name="su_email" value="" required="required"/>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                        <label for="numberOfPositions" class="col-sm-4 control-label pull-left">Current CTC:<span style="color: #FF0000"> *</span></label>
                        <div class="col-sm-8">
                            <input type="text" name="su_ctc" class="form-control" id="su_ctc" placeholder="Eg: 320000 (no spaces or spl chars)" required="required" maxlength="10" pattern="\d*" title="only numbers & no characters or special">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                        <label for="experience_from" class="col-sm-4 control-label">Experience:<span style="color: #FF0000"> *</span></label>
                        <div class="col-sm-4">
                            <select name="su_exp_year" class="form-control" id="su_exp_year" required="required">
                                <option value="">Year</option>
                                <?php for ($i = 0; $i <= 15; $i++) { echo "<option value='" . $i . "'>" . $i . ' Years</option>'; } ?>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <select name="su_exp_mnth" class="form-control" id="su_exp_mnth" required="required">
                                <option value="">Month</option>
                                <?php for ($i = 1; $i <= 11; $i++) { echo "<option value='" . $i . "'>" . $i . ' Months</option>'; } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                        <label for="skills" class="col-sm-4 control-label">Major Skill:<span style="color: #FF0000"> *</span></label>
                        <div class="col-sm-8">
                            <select name="su_skill" id="su_skill" class="form-control"  required="required">
                                <option value="">Select a Skill</option>
                                <?php foreach ($skills as $skill) {
                                    echo '<option value="' . $skill->skillid . '">' . $skill->skillname . '</option>';
                                } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                        <label for="numberOfPositions" class="col-sm-4 control-label pull-left">Latest Resume: <span style="font-size: small">(doc, docx, pdf)</span><span style="color: #FF0000"> *</span></label>
                        <div class="col-sm-8">
                            <input type="file" name="su_resume" class="btn-primary form-control" id="su_resume"  required="required">
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <div class="col-sm-9">
                        <label for="posttitle" class="col-sm-4 control-label pull-left">Currently Working in:<span style="color: #FF0000"> *</span></label>
                        <div class="col-sm-8">
                            <input type="text" name="su_current_company" class="form-control" id="su_current_company" placeholder="Company Name" required="required">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                        <label for="experience_from" class="col-sm-4 control-label">As:<span style="color: #FF0000"> *</span></label>
                        <div class="col-sm-4">
                            <select name="su_emp_type" class="form-control" id="su_emp_type" required="required">
                                <option value="Contract">Contract</option>
                                <option value="Permanent">Permanent</option>
                                <option value="Pay-Roll">Pay-Roll</option>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <select name="su_work_type" class="form-control" id="su_work_type" required="required">
                                <option value="Full-Time">Full-Time</option>
                                <option value="Part-Time">Part-Time</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                        <label for="experience_from" class="col-sm-4 control-label">Highest Education & Year:<span style="color: #FF0000"> *</span></label>
                        <div class="col-sm-4">
                            <select name="su_high_edu" class="form-control" id="su_high_edu" required="required">
                                <option value="MCA">MCA</option>
                                <option value="MBA">MBA</option>
                                <option value="B-Tech">B-Tech</option>
                                <option value="B.Sc">B.Sc</option>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <select name="su_high_year_pass" class="form-control" id="su_high_year_pass" required="required">
                                <?php $year = date("Y"); for ($i = 1; $i <= 20; $i++) { echo "<option value='" . $year . "'>" . $year . '</option>'; $year-- ; } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                        <label for="posttitle" class="col-sm-4 control-label pull-left">University:<span style="color: #FF0000"> *</span></label>
                        <div class="col-sm-8">
                            <input type="text" name="su_high_univ" class="form-control" id="su_high_univ" placeholder="University Name" required="required">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                        <label for="experience_from" class="col-sm-4 control-label">Other Education & Year:<span style="color: #FF0000"> *</span></label>
                        <div class="col-sm-4">
                            <select name="su_other_edu" class="form-control" id="su_other_edu" required="required">
                                <option value="MCA">MCA</option>
                                <option value="MBA">MBA</option>
                                <option value="B-Tech">B-Tech</option>
                                <option value="B.Sc">B.Sc</option>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <select name="su_other_year_pass" class="form-control" id="su_other_year_pass" required="required">
                                <?php $year = date("Y"); for ($i = 1; $i <= 20; $i++) { echo "<option value='" . $year . "'>" . $year . '</option>'; $year-- ; } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                        <label for="posttitle" class="col-sm-4 control-label pull-left">University:<span style="color: #FF0000"> *</span></label>
                        <div class="col-sm-8">
                            <input type="text" name="su_other_univ" class="form-control" id="su_other_univ" placeholder="University Name" required="required">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                        <label for="postDescription" class="col-sm-4 control-label pull-left">Other Skills:</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="su_other_skill_1" name="other_skill_1" placeholder="Skill 1"/>
                        </div>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="su_other_skill_2" name="other_skill_2" placeholder="Skill 2"/>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                        <label for="location" class="col-sm-4 control-label">Location:<span style="color: #FF0000"> *</span></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="location" name="location" placeholder="Type Your city" required="required"/>
                        </div>
                    </div>
                </div>
                <input id="latitude" type="hidden" name="latitude" value=""/>
                <input id="longitude" type="hidden" name="longitude" value=""/>
                <input id="fAddress" type="hidden" name="fAddress" value=""/>
                
               
                
                <div class="form-group form_buttons">
                    <div class="col-lg-12 text-center">
                        <button class="btn btn-success" type="submit"><i class="fa fa-floppy-o"></i> &nbsp; Save & Continue</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $(document).on('change', '#su_cur_country', function () {
            if (this.value == 0) {
                alert('Please select proper country');
                return false;
            }
            var dest = '#su_cur_state';
            $.ajax({
                url: '<?php echo base_url('no_profile/getStates');?>',
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
        $(document).on('change', '#su_cur_state', function () {
            if (this.value == 0 || this.value == "") {
                alert('Please select proper state');
                return false;
            }
            var dest = '#su_cur_city';
            $.ajax({
                url: '<?php echo base_url('no_profile/getCities');?>',
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
<?php include('layout/user_footer.php');?>
<link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500">
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places"></script>
<script type="text/javascript">
    var placeSearch, autocomplete;
    function initialize()
    {
        // Create the autocomplete object, restricting the search
        // to geographical location types.
        autocomplete = new google.maps.places.Autocomplete(
            /** @type {HTMLInputElement} */(document.getElementById('location')),
            { types: ['geocode'] });
        // When the user selects an address from the dropdown,
        // populate the address fields in the form.
        google.maps.event.addListener(autocomplete, 'place_changed', function() {
            var place = autocomplete.getPlace();
            //lat = place.geometry.location.k
            //alert(place.geometry.location);
            //alert(place.address_components);
            // hard to segregate the individual details of the address components.
            //alert(place.formatted_address);
            var LAT = place.geometry.location.k;
            //alert(LAT);
            document.getElementById('latitude').value = LAT;
            //var abc = document.getElementById('latitude').value;
            //alert(abc);
            var LON = place.geometry.location.D;
            document.getElementById('longitude').value = LON;
            var ADR = place.formatted_address;
            document.getElementById('fAddress').value = ADR;
            //console.log(place);
            //console.log(place);
            //alert(place.geometry.location.k);
            //alert(place.geometry.location.D);
            //alert('sasa');

        });
    }
</script>
<script type="text/javascript">
    initialize();
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