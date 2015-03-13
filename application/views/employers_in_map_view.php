<?php   //print'<pre>'; print_r($empLats);
        $count = count($empLats);
        $userDetails = $this->session->userdata('userLoginDetails');
        $accountId = $userDetails->accountid;
        //echo $accountId . $count;?>
<?php /*for($i=0; $i<$count; $i++) {
    if($empLats[$i]->aid != $accountId) {
    echo "[".$empLats[$i]->latitude.",".$empLats[$i]->longitude.","."'".$empLats[$i]->cname."'"."],"; }  }*/
?>
<script type="text/javascript">
    var geocoder;
    var map;
    function initialize() {
        geocoder = new google.maps.Geocoder();
        <?php for($i=0; $i<$count; $i++) {
                if($empLats[$i]->aid == $accountId) { ?>
        var latlng = new google.maps.LatLng(<?php echo $empLats[$i]->latitude;?>, <?php echo $empLats[$i]->longitude;?>);
        <?php }  }?>
        var mapOptions = {
            zoom: 9,
            center: latlng
        };
        map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
        var marker = new google.maps.Marker({
            position: latlng,
            map: map,
            icon: 'http://maps.google.com/mapfiles/ms/icons/green-dot.png',
            title: "Your organization"
        });
       var atlong = [<?php for($i=0; $i<$count; $i++) {
                            if($empLats[$i]->aid != $accountId) {
                                echo "[".$empLats[$i]->latitude.",".$empLats[$i]->longitude.","."'".$empLats[$i]->cname."','".$empLats[$i]->aid."'],"; }  }
                                ?>];
        //var atlong = [[-13.530825,-71.957565],]
        var content_array = new Array();
        for (i = 0; i < atlong.length; i++) {

            var dyn_mar = 'marker'+i;
            console.log(dyn_mar);
            dyn_mar = new google.maps.Marker({
                position: new google.maps.LatLng(atlong[i][0], atlong[i][1]),
                map: map
            });
            content_array[i] = "<a href='<?php echo base_url("dashboard/otherProfile")."/"; ?>"+atlong[i][3]+"'>" + atlong[i][2] + "</a>";
            //content_array[i] = atlong[i][2];
            attachinfo(dyn_mar, i);

        }
        function attachinfo(marker, num) {
            var infowindow = new google.maps.InfoWindow({
                content: content_array[num]
            });

            google.maps.event.addListener(marker, 'click', function() {
                infowindow.open(marker.get('map'), marker);
            });
        }

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
<div class="register_section">
    <div class="container">
        <div class="register_content">
            <div class="register_form">
                <h3><i class="fa fa-bookmark"></i>&nbsp;&nbsp;&nbsp;Employers By Region</h3>
                <div class="row">
                    <div class="company_locationmap" id="map-canvas" style="height: 480px; width: 96%;"></div>
                </div>
            </div>
        </div>
    </div>
</div>
