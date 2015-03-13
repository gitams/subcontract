<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php if(isset($title)) { echo $title; } ?></title>
    <link rel="stylesheet" media="screen" href="<?php echo base_url('assets/styles/font-awesome.css'); ?>"  />
    <link rel="stylesheet" media="screen" href="<?php echo base_url('assets/styles/jquery-ui.css'); ?>"  />
    <link rel="stylesheet" media="screen" href="<?php echo base_url('assets/styles/bootstrap.css'); ?>"  />
    <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/styles/bootstrapValidator.css'); ?>"/> -->
    <link rel="stylesheet" media="screen" href="<?php echo base_url('assets/styles/mainstyles.css'); ?>"  />
    <link rel="stylesheet" media="screen" href="<?php echo base_url('assets/styles/datepicker3.css'); ?>"  />
    <link rel="stylesheet" media="screen" href="<?php echo base_url('assets/styles/datepicker.css'); ?>"  />

    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery-ui.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.validate.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/typeahead.js'); ?>"></script>

    <!--<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery/jquery-1.4.4.min.js"></script>
        <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.7/jquery.validate.min.js"></script>
        <script type="text/javascript" src="<?php /*echo base_url('assets/js/userlogin.js'); */?>"></script>-->

    <script type="text/javascript">

        var assetLoc = '<?php echo base_url('assets'); ?>';
        var BASEURL = '<?php echo base_url(); ?>';

    </script>

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/styles/slideControl.css');  ?>" />
    <!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>-->
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.slideControl.js');  ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap-datepicker.js'); ?>"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.slideControl').slideControl();
        });
    </script>
</head>
<body>
<header>
    <div class="nav_section">
        <div class="container">
            <div class="col-sm-3">
                <div class="logo_section">
                    <a href="<?php echo base_url(); ?>"><img src="<?php echo base_url('assets/images/logo.png'); ?>" /> </a>
                </div>
            </div>
            <div class="col-sm-9">
                <?php if ($this->session->userdata('isLoggedin') == 1) { ?>
                    <div class="fr">
                        <input type="button" value="Logout" class="signin_btn" onclick="window.location = '<?php echo base_url('no_profile_employer/signout'); ?>';"/>
                    </div>
                    <div class="col-sm-3 fr">
                        <?php echo 'Welcome <b>' . $this->session->userdata('username') . '</b>'; ?>
                    </div>
                <?php } else { ?>
                    <form name="userlogin" id="userlogin" method="post" enctype="multipart/form-data" action="<?php echo base_url('landing/login'); ?>">
                        <div class="row" style="float: right; display: inline">
                            <div class="input_section" style="float: left">
                                <i class="fa fa-envelope"></i>&nbsp;<input tabindex="1" type="text" name="useremail" id="useremail" placeholder="Email Address"  />
                            </div>
                            <div class="input_section" style="float: left">
                                <i class="fa fa-key"></i>&nbsp;<input tabindex="2" type="password" name="userpassword" id="userpassword" placeholder="Password" />
                            </div>
                            <div class="" style="float: left">
                                <input type="submit" value="Sign In" tabindex="3" class="signin_btn" />
                            </div>
                        </div>
                    </form>
                <?php } ?>
            </div>
        </div>
    </div>
</header>
<?php
if ($this->session->flashdata('error')) {
    $errors = $this->session->flashdata('error');
    echo '<div class="container" style="margin-top: 3px;">';
    foreach ($errors as $error) {
        echo '<div class="' . $error[0] . '">'
            . '<button class="close" data-dismiss="alert" type="button">x</button>' . $error[1] . '</div>';
    }
    echo '</div>';
}
?>




<div class="register_section search_company">
    <div class="container">
        <div class="search_bar2">
        <div class="register_content">
            <div class="register_form">
                <?php //print_r($profile->username);
                $w = $profile->username; $w2 = explode('@',$w); $w3 = $w2[1]; //print_r($w3); exit; ?>
                <h1><i class="fa fa-book"></i>&nbsp;&nbsp;&nbsp;Almost There.!</h1>
                <div class="row">
                    <div class="col-sm-12">
                        <form action="<?php echo base_url('no_profile_employer/saveEmployer') ?>" onsubmit="return validationForm();" name="registercompany" id="registercompany" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <label for="industry" class="col-sm-4 control-label">Industry Type:<span style="color: #FF0000"> *</span></label>
                                    <div class="col-sm-8">
                                        <select name="industry" class="form-control" id="industry">
                                            <option value="0">Select Industry</option>
                                            <?php foreach ($industries as $industry) { echo '<option value="' . $industry->industryid . '">' . $industry->industry_name . '</option>'; } ?>
                                        </select>
                                        <p id="iErr" style="color:#C00;"></p>
                                        <!--<input type="text" class="form-control" id="contact-name" placeholder="Name">-->
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="location" class="col-sm-4 control-label">Location<span style="color: #FF0000"> *</span></label>
                                    <div class="col-sm-8">
                                        <input class="form-control" id="autocomplete" placeholder="Enter your address"  type="text" />
                                        <p id="LErr" style="color:#C00;"></p>
                                        <!--<input type="text" class="form-control" id="contact-name" placeholder="Name">-->
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                               <!-- <div class="col-sm-6">
                                    <label for="address" class="col-sm-4 control-label">Address:<span style="color: #FF0000"> *</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" name="address1" class="form-control" id="address1" placeholder="Line1" value="<?php /*echo set_value("address1"); */?>" >
                                        <p id="a1Err" style="color:#C00;"></p>
                                    </div> </div>
                                    <div class="col-sm-6">
                                        <div class="col-sm-4">
                                            <label for="address" class="control-label">street:</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <input type="text" name="address2" class="form-control" id="Address2" placeholder="Line2" value="<?php /*echo set_value("address2"); */?>">
                                        </div>
                                    </div>-->
                                <div class="col-sm-6">
                                    <div class="col-sm-4">
                                        <label for="Website" class="control-label">Website<span style="color: #FF0000"> *</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" name="website" class="form-control" id="website" placeholder="website" value="<?php echo "www.".$w3; ?>" >
                                        <p id="webErr" style="color:#C00;"></p>
                                    </div>
                                </div>
                            </div>
                            <!--<div class="form-group">
                                <div class="col-sm-6">
                                    <label for="country" class="col-sm-4 control-label">Country:<span style="color: #FF0000"> *</span></label>
                                    <div class="col-sm-8">
                                        <select name="country" id="country_name" class="form-control" >
                                            <option value="0">Select Country</option>
                                            <?php /*foreach ($countries as $country) { echo '<option value="' . $country->countryid . '">' . $country->countryname . '</option>'; } */?>
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
                            </div>-->
                            <!--<div class="form-group">
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
                                        <input type="text" class="form-control" id="zipcode" placeholder="Zipcode" name="zipcode" value="<?php /*echo set_value("zipcode"); */?>" />
                                        <p id="zErr" style="color:#C00;"></p>
                                    </div>
                                </div>
                            </div>-->
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <label for="contact-number" class="col-sm-4 control-label">Contact Number:<span style="color: #FF0000"> *</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" maxlength="10" name="contactNumber" class="form-control" id="contact-number" placeholder="Contact Number" value="<?php echo set_value("contactNumber"); ?>"  >
                                        <p id="numErr" style="color:#C00;"></p>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="contact-name" class="col-sm-4 control-label">Contact Name:<span style="color: #FF0000"> *</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" name="contactName" class="form-control" id="contact-name" placeholder="Contact name" value="<?php echo set_value("contactName"); ?>"  >
                                        <p id="conErr" style="color:#C00;"></p>
                                    </div>
                                </div>
                            </div>
                            <input id="latitude" type="hidden" name="latitude" value=""/>
                            <input id="longitude" type="hidden" name="longitude" value=""/>
                            <input id="fAddress" type="hidden" name="fAddress" value=""/>
                            <div class="form-group form_buttons">
                                <div class="col-lg-12 text-center">
                                    <button class="btn btn-primary submit" type="submit"><i class="fa fa-floppy-o"></i> &nbsp; Save</button>
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


<footer>
    <div class="container">
        <div class="col-sm-6">
            &copy; 2014 SubContract. All Rights Reserved.
        </div>
        <div class="col-sm-6 text-right">
            <p>** Page rendered in <strong>{elapsed_time}</strong> seconds **</p>
        </div>
    </div>
</footer>
</body>
</html>
<link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500">
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places"></script>
<script type="text/javascript">
    var placeSearch, autocomplete;
    function initialize()
    {
        // Create the autocomplete object, restricting the search
        // to geographical location types.
        autocomplete = new google.maps.places.Autocomplete(
            /** @type {HTMLInputElement} */(document.getElementById('autocomplete')),
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

<script type="text/javascript">
    $(document).ready(function () {
        $(document).on('change', '#country_name', function () {
            if (this.value == 0) {
                alert('Please select proper country');
                return false;
            }
            var dest = '#state_name';
            $.ajax({
                url: '<?php echo base_url('no_profile_employer/getStates');?>',
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
                url: '<?php echo base_url('no_profile_employer/getCities');?>',
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
    function validationForm() {
        var i = document.getElementById('industry').value;
        var l = document.getElementById('autocomplete').value;
        var w = document.getElementById('website').value;
        var cNum = document.getElementById('contact-number').value;
        var conName = document.getElementById('contact-name').value;

        document.getElementById('iErr').innerHTML = "";
        document.getElementById('LErr').innerHTML = "";
        document.getElementById('webErr').innerHTML = "";
        document.getElementById('numErr').innerHTML = "";
        document.getElementById('conErr').innerHTML = "";


        if (i == "" || i == null || i == 0) {
            $('#iErr').css('padding', '10px 0 0 12px');
            document.getElementById('iErr').innerHTML = "Please select an industry";
            document.getElementById('industry').focus();
            return false;
        }
        if (l == "" || l == null) {
            $('#LErr').css('padding', '10px 0 0 12px');
            document.getElementById('LErr').innerHTML = "Location is Required";
            document.getElementById('autocomplete').focus();
            return false;
        }
        if (w == "" || w == null) {
            $('#webErr').css('padding', '10px 0 0 12px');
            document.getElementById('webErr').innerHTML = "Please fill this field";
            document.getElementById('website').focus();
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
    }
</script>