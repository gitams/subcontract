<?php //print'<pre>';print_r($requests);
if((isset($requests)) && (!empty($requests))) { ?>
    <?php $i = 1; foreach($requests as $ymk) {
        if($i==10) break;?>
        <a href="<?php echo base_url('dashboard/otherProfile')."/".$ymk->accountid;?>">
            <div class="padL15 fl">
                <div style="width: 160px;border: 1px solid #D3D4D4;" align="center">
                    <img src="<?php echo base_url('assets/images/user1.png'); ?>" alt="">
                    <h5><?php echo $ymk->accountname; ?></h5>
                    <p><?php echo $ymk->industry_name; ?></p>
                    <!--<input type="button" class="btn btn-danger" style="margin-left: 8px; height: 32px;" id="<?php /*echo $ymk->accountid;*/?>" value="Disconnect">-->
                </div>
            </div>
        </a>
    <?php } } else {?>
    <h5>Not Connected to Any One Yet</h5>
    <a href="<?php echo base_url('dashboard/rsvMore');?>" class="btn btn-primary">Send A Request</a>
    <?php } ?>
    <script type="text/javascript">
        $(document).ready(function () {
            $(document).on('click', '.deleteRequest', function () {
                $(this).addClass('deleted');
                $.ajax({
                    url: BASEURL + 'dashboard/updaterequest',
                    method: "POST",
                    data: {'id': $(this).attr('requestid'), 'typeid': '3', 'csrf': Math.round(Math.random() * 10000000)},
                    datatype: 'html',
                    success: function (data) {
                        alert(data);
                        $('.deleted').parent().parent().remove();
                    }
                })
            });
        });
    </script>