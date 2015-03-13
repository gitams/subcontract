<div class="col-lg-12">
    <div class="text-right">
        <a href = "javascript:void(0)" onclick = "document.getElementById('light2').style.display='none';document.getElementById('fade2').style.display='none'" class="btn btn-danger"><i class="fa fa-times"></i> Close</a>
    </div>
</div>
<?php //print_r($acs); exit;
if((isset($acs)) && (!empty($acs))) { ?>
    <?php $i = 1; foreach($acs as $ymk) {
        if($i==10) break;?>
        <?php //print_r($ymk); ?>
            <div class="col-sm-12">
                <div style="border: 1px solid #D3D4D4; margin-bottom:5px;">
                    <img src="<?php //echo base_url('assets/images/user1.png'); ?>" alt="">
                    <div>
					<h5 style="margin-left:10px;"><a><i class="fa fa-user"></i> <?php echo $ymk->can_first_name." ".$ymk->can_last_name; ?></a></h5>
                    <!--<p><?php /*echo $ymk->industry_name; */?></p>-->
                    <i class="fa fa-flag"  style="margin-left:10px;"></i> <?php echo $ymk->can_current_exp_years." + Years"; ?>
                    <i class="fa fa-star" style="margin-left:10px;"></i> <?php echo $ymk->skillname; ?>
                    </div>
                    <div style="float:right">
                    	<p style="margin-right:10px;">
                    		Applied By <a href="<?php echo base_url('dashboard/otherProfile')."/".$ymk->accountid;?>">
                    		<i class="fa fa-building"></i> <?php echo $ymk->accountname; ?></a>
                    		On<i class="fa fa-calendar" style="margin-left:10px;"></i> <?php echo $ymk->ja_applied_date; ?>
                    	</p>
                    </div>
                    <!--<input type="button" class="btn btn-danger" style="margin-left: 8px; height: 32px;" id="<?php /*echo $ymk->accountid;*/?>" value="Disconnect">-->
                </div>
            </div>
    <?php } } else {?>
    <h5>None Applied</h5>
<?php } ?>