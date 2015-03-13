<script type="text/javascript">
    var geocoder;
    var map;
    var Location = '<?php echo $latlong['Location']; ?>';
    function initialize() {
        geocoder = new google.maps.Geocoder();
        var latlng = new google.maps.LatLng(<?php echo $latlong['Latitude'] ?>, <?php echo $latlong['Longitude']; ?>);
        var mapOptions = {
            zoom: 16,
            center: latlng
        };
        map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
        var marker = new google.maps.Marker({
            position: latlng,
            map: map,
            draggable: true,
            title: Location
        });
        var infowindow = new google.maps.InfoWindow({
            content: " "
        });
        google.maps.event.addListener(marker, 'click', function () {
            infowindow.setContent(Location);
            infowindow.open(map, this);
        });
        marker.setMap(map);
        google.maps.event.addListener(marker, 'dragend', function (event) {
            var lat = document.getElementById("longitudeNumber").value = this.getPosition().lat();
            var long = document.getElementById("longitudeNumber").value = this.getPosition().lng();
            var contactId = document.getElementById("contactIdNumber").value;
            $.ajax({
                url: BASEURL + 'index/updateLatLong',
                method: 'POST',
                data: {'contactId': contactId, 'latitude': lat, 'longitude': long, 'rand': Math.round(Math.random() * 10000000)},
                success: function (data) {
                    //alert(data);
                }
            });

        });
    }
    function loadScript() {
        var script = document.createElement("script");
        script.type = "text/javascript";
        script.src = "http://maps.google.com/maps/api/js?sensor=false&callback=initialize";
        document.body.appendChild(script);
    }
    window.onload = loadScript;
    //initialize();
</script>
<?php   //$userDetails = $this->session->userdata('userLoginDetails');
        //print'<pre>'; print_r($userDetails);//exit;
        //$accountId = $userDetails->accountid; ?>
<div class="register_section">
    <div class="container">
        <div class="register_content">
            <div class="step_staging">
                <img src="<?php echo base_url('assets/images/step2_num.jpg'); ?>"  />
            </div>
            <div class="register_form">
                <h1><i class="fa fa-bookmark"></i>&nbsp;&nbsp;&nbsp;Contact Details</h1>
                <div class="row">
                    <div class="col-sm-12">
                        <form action="<?php echo base_url('landing/saveStep2'); ?>" method="post" class="form-horizontal" role="form" onsubmit="return validationForm();">
                            <input type="hidden" name="accountIdNumber" value="<?php echo $latlong['accountId']; ?>" id="accountIdNumber"/>
                            <input type="hidden" name="contactIdNumber" value="<?php echo $latlong['contactId']; ?>" id="contactIdNumber"/>
                            <input type="hidden" name="longitudeNumber" value="<?php echo $latlong['Longitude']; ?>" id="longitudeNumber"/>
                            <input type="hidden" name="latitudeNumber" value="<?php echo $latlong['Latitude']; ?>" id="latitudeNumber"/>
                            <input type="hidden" name="location" value="<?php echo $latlong['Location']; ?>" id="location"/>
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <label for="contact-name" class="col-sm-4 control-label">Facebook:<span style="color:#C00"> *</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" name="facebook" class="form-control" id="facebook" placeholder="facebook.com/company">
                                        <div id="fErr" style="color:#C00"></div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="contact-name" class="col-sm-4 control-label">Linked In:<!--<span style="color:#C00"> *</span>--></label>
                                    <div class="col-sm-8">
                                        <input type="text" name="linkedIn" class="form-control" id="linkedIn" placeholder="linkedin.com/company">
                                        <div id="lErr" style="color:#C00"></div>
                                    </div>
                                </div>

                            </div>
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <label for="contact-name" class="col-sm-4 control-label">Website:<span style="color:#C00"> *</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" name="website" class="form-control" id="website" placeholder="www.company.com">
                                        <div id="wErr" style="color:#C00"></div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="contact-name" class="col-sm-4 control-label">Twitter:<!--<span style="color:#C00"> *</span>--></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="twitter" id="twitter" placeholder="twitter.com/yourID">
                                        <div id="tErr" style="color:#C00"></div>
                                    </div>
                                </div>

                            </div>
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <div class="col-sm-4">&nbsp;</div>
                                    <label for="contact-name" class="col-sm-8 control-label"><i class="fa fa-check-square"></i>&nbsp;&nbsp;&nbsp;Publish Company's Email:</label>

                                </div>
                                <div class="col-sm-6">
                                    <label for="contact-name" class="col-sm-4 control-label">Google+:<!--<span style="color:#C00"> *</span>--></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="google" id="google" placeholder="plus.google.com/+user">
                                        <div id="gErr" style="color:#C00"></div>
                                    </div>
                                </div>

                            </div>
                            <div class="form-group">
                                <div class="col-sm-12 company_locationmap" id="map-canvas" style="height: 480px;">
                                </div>
                            </div>
                            <div class="form-group form_buttons">
                                <div class="col-lg-12 text-center">
                                   <button class="btn btn-primary" type="submit"><i class="fa fa-share"></i> &nbsp;&nbsp;Next</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function validationForm() {

        var f = document.getElementById('facebook').value;
        /*var l = document.getElementById('linkedIn').value;*/
        var w = document.getElementById('website').value;
        /*var t = document.getElementById('twitter').value;
        var g = document.getElementById('google').value;*/
        if (f == "" || f == null) {
            //alert("Name value not Empty");
            document.getElementById('fErr').innerHTML = "Please Provide Facebook URL";
            //error = "Name not Empty";
            //if(focusCurser == "" || focusCurser == null) { focusCurser = "nameUser"; }
            document.getElementById('facebook').focus();
            return false;
        }
       /* if (l == "" || l == null) {
            //alert("Name value not Empty");
            document.getElementById('lErr').innerHTML = "Field not Empty";
            document.getElementById('fErr').innerHTML = "";
            //error = "Name not Empty";
            //if(focusCurser == "" || focusCurser == null) { focusCurser = "nameUser"; }
            document.getElementById('linkedIn').focus();
            return false;
        }*/
        if (w == "" || w == null) {
            //alert("Name value not Empty");
            document.getElementById('wErr').innerHTML = "Website field is mandatory";
            document.getElementById('fErr').innerHTML = "";
            document.getElementById('lErr').innerHTML = "";
            //error = "Name not Empty";
            //if(focusCurser == "" || focusCurser == null) { focusCurser = "nameUser"; }
            document.getElementById('website').focus();
            return false;
        }
        /*if (t == "" || t == null) {
            //alert("Name value not Empty");
            document.getElementById('tErr').innerHTML = "Field not Empty";
            document.getElementById('wErr').innerHTML = "";
            document.getElementById('lErr').innerHTML = "";
            document.getElementById('fErr').innerHTML = "";
            //error = "Name not Empty";
            //if(focusCurser == "" || focusCurser == null) { focusCurser = "nameUser"; }
            document.getElementById('twitter').focus();
            return false;
        }
        if (g == "" || g == null) {
            //alert("Name value not Empty");
            document.getElementById('gErr').innerHTML = "Field not Empty";
            document.getElementById('tErr').innerHTML = "";
            document.getElementById('wErr').innerHTML = "";
            document.getElementById('tErr').innerHTML = "";
            document.getElementById('fErr').innerHTML = "";
            //error = "Name not Empty";
            //if(focusCurser == "" || focusCurser == null) { focusCurser = "nameUser"; }
            document.getElementById('google').focus();
            return false;
        }*/
    }
</script>
