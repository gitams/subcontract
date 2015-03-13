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
    .pac-container{
        z-index: 1002;
    }
</style>
<?php
if($this->session->flashdata('suc_msg')){?>
    <div id=flash align="center" style="clear: both; height: 50px; border: solid lightgreen"><p style="padding: 10px;;color: #16A085;font-weight: bold;"> <?=$this->session->flashdata('suc_msg')?> </p></div>
<?php }?><br/>
<?php //print'<pre>'; print_r($profile);exit;
    if((isset($profile))&&(!empty($profile))){ ?>
        <div class="col-sm-2">
            <form id="profile" action="" method="post" enctype="multipart/form-data">
                <input id="userfile" type="file" style="display: none">
                <input type="submit" name="submit" id="submit" style="display: none">
            </form>
            <div class="profile_pic_class"><button style="display:none;" id="popup" class="edit_profile_pic editicon btn btn-primary" style="margin: 0 0 0 0;"><i class="fa fa-pencil"> Change profile pic</i></button>
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
    //print'<pre>';print_r($profile); exit;
   // echo $this->session->flashdata('suc_msg');?>
    <ul class="tabs" data-persist="true">
        <li><a href="#view1">Main Details</a></li>
        <!--<li><a href="#view2">Social links</a></li>
        <li><a href="#view3">Services</a></li>
        <li><a href="#view4">Company Est</a></li>
        <li><a href="#view5">Portfolio</a></li>-->
    </ul>
    <div class="tabcontents">
        <div id="view1" style="min-height: 180px;">
            <?php //print'<pre>'; print_r($profile); print'</pre>'; ?>
            <div style="float: right; margin-right: 17%">
                <div style="display: none; z-index: 99; position: absolute"  id="se1But">
                    <a href = "<?php echo base_url('user_dashboard/updateProfile') ?>"><p class="btn btn-primary">To Edit click here</p></a>
                </div>
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
                        <tr><td style="border: 0;"><i class="fa fa-users"></i>&nbsp; <strong> <a><?php echo $profile[0]->scd_first_name." ".$profile[0]->scd_last_name ?> </a> </strong></td>
                            <td style="border: 0;"><i class="fa fa-list"></i>&nbsp;
                                <?php {echo " user "; }?>
                            </td>
                        </tr>
                        <tr>
                            <td style="border: 0;"><i class="fa fa-inbox"></i>&nbsp; <?php echo $profile[0]->scd_email; ?></td>
                            <td style="border: 0;"><i class="fa fa-mobile-phone"></i>&nbsp; <?php echo $profile[0]->scd_mobile; ?></td>
                        </tr>
                        <tr>
                            <td style="border: 0;"><i class="fa fa-user"></i>&nbsp; <?php echo $profile[0]->scd_first_name; ?></td>
                            <!--<td style="border: 0;"><i class="fa fa-list-alt"></i>&nbsp; <?php /*echo $profile[0]->last_name; */?></td>-->
                            <td style="border: 0;"><i class="fa fa-suitcase"></i>&nbsp; <?php echo $profile[0]->scd_cur_company; ?></td>
                        </tr>
                        <tr>
                            <td colspan="2" style="border: 0;"><i class="fa fa-map-marker"></i>&nbsp; <?php echo  $profile[0]->scd_location; ?></td>
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
            <form action="<?php echo base_url('user_dashboard/saveUpdateProfile') ?>" onsubmit="return validationForm();" name="registercompany" id="registercompany" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">
                
              
                    <div class="">
                    <div class="col-sm-6">
                        <label for="email" class="control-label">Email Id:<span style="color: #FF0000"> *</span></label>
                        <input type="text" readonly name="username" value="<?php echo  $profile[0]->scd_email; ?>" class="form-control" id="email" >
                    </div>
                </div>
                <div class="">
                    <div class="col-sm-6">
                        <label for="company" class="control-label">Company Name:<span style="color: #FF0000"> *</span></label>
                        <input type="text" name="su_current_company" class="form-control" id="su_current_company" value="<?php echo  $profile[0]->scd_cur_company; ?>" >
                        <p id="cNameErr" style="color:#C00;"></p>
                    </div>

                    <div class="col-sm-6">
                        <label for="company" class="control-label">First Name:<span style="color: #FF0000"> *</span></label>
                        <input type="text" name="su_first_name" class="form-control" id="firstname" value="<?php echo  $profile[0]->scd_first_name; ?>" >
                        <p id="cNameErr" style="color:#C00;"></p>
                    </div>

                </div>
                <div class="col-sm-6">
                        <label for="company" class="control-label">Last Name:<span style="color: #FF0000"> *</span></label>
                        <input type="text" name="su_last_name" class="form-control" id="lastname" value="<?php echo  $profile[0]->scd_last_name; ?>" >
                        <p id="cNameErr" style="color:#C00;"></p>
                    </div>
                <div class="">

                    <div class="col-sm-6">
                        <label for="address" class="control-label">Mobile Number:</label>
                        <input type="text" name="su_mobile" class="form-control" id="su_mobile" value="<?php echo  $profile[0]->scd_mobile; ?>">
                    </div>

                    <div class="col-sm-6">
                    <label for="location" class="control-label">Address<span style="color: #FF0000"> *</span></label>
                    <input name="su_location" class="form-control" id="autocomplete" value="<?php echo  $profile[0]->scd_location; ?>"   type="text"/>
                    <p id="LErr" style="color:#C00;"></p>
                </div>
                </div>
                <div class="col-md-12" align="center">
                    <input class="btn btn-success" type="submit" value="Send..!" id="submit">
                    <a href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'" class="btn btn-danger">Close</a>
                </div>
            </form>
        </div>

        
        <!-- End pop up window for edit section 1-->
        
        
        
        
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
        var a1 = document.getElementById('address1').value;
        var cNum = document.getElementById('contact-number').value;
        var conName = document.getElementById('contact-name').value;

        document.getElementById('iErr').innerHTML = "";
        document.getElementById('LErr').innerHTML = "";
        document.getElementById('a1Err').innerHTML = "";
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
        if (a1 == "" || a1 == null) {
            $('#a1Err').css('padding', '10px 0 0 12px');
            document.getElementById('a1Err').innerHTML = "Please fill this field";
            document.getElementById('address1').focus();
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
