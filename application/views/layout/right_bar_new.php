<script src="<?php echo base_url('assets/js/tabcontent.js')?>" type="text/javascript"></script>
<?php //print'<pre>';print_r($jobs); exit;
$userDetails = $this->session->userdata('userLoginDetails');
$CurAccId = $userDetails->accountid;
$contact_type_id = $userDetails->contacttypeid;
?>
    <div class="wt-nxt" style="margin-bottom: 15px;">
        <h4><img src="<?php echo base_url('assets/images/glance.png'); ?>" width="26px">Stats</h4>
        <h3 style="border-bottom:1px solid #c3c3c3;">
        	<span style="padding:0px 0px 0px 8px;font-size: smaller;">Active Jobs</span>
        	<span style="float:right;font-size:25px;color:#16a085;padding:0px 5px 0px 0px;"><a style="text-decoration: none; border:none; font-size : 18px;" href="<?php echo base_url('dashboard/myposts')?>"><?php echo $jobsCount;?></a></span></h3>
        <h3 style="border-bottom:1px solid #c3c3c3;">
        	<span style="padding:0px 0px 0px 8px;font-size: smaller;">Active Candidates</span>
        	<span style="padding:0px 5px 0px 0px;float:right;font-size:25px;color:#16a085"><a style="text-decoration: none; border:none; font-size : 18px;" href="<?php echo base_url('dashboard/myCandidates')?>"><?php echo $canCount;?></a></span></h3>
        <h3 style="border:none;">
        	<span style="padding:0px 0px 0px 8px;font-size: smaller;">Connected Employers</span>
    		<span style="float:right;font-size:25px;color:#16a085;padding:0px 5px 0px 0px;"><a style="text-decoration: none; border:none; font-size : 18px;" href="<?php echo base_url('dashboard/connections')?>"><?php echo $vendorsCount?></a></span>
    </div>
    <div class="wt-nxt">
        <h4>WHAT'S NEXT</h4>
        <a href="<?php echo base_url('dashboard/addpost');?>" style="padding-top:0px;">Post a job</a>
        <?php if((isset($contact_type_id)) && (!empty($contact_type_id)) && ($contact_type_id == 2)) { ?>
            <a href="<?php echo base_url('dashboard/addRec');?>">Invite your team</a>
        <?php }elseif((isset($contact_type_id)) && (!empty($contact_type_id)) && ($contact_type_id == 3)) { ?>
            <a href="<?php echo base_url('dashboard/addCandidate');?>">Add A Candidate</a>
        <?php } ?>
        <?php if((isset($contact_type_id)) && (!empty($contact_type_id)) && ($contact_type_id == 2)) { ?>
            <a href="<?php echo base_url('dashboard/myRecs');?>">Your Team</a>
        <?php }elseif((isset($contact_type_id)) && (!empty($contact_type_id)) && ($contact_type_id == 3)) { ?>
            <a href="<?php echo base_url('dashboard/myCandidates');?>">All Candidates</a>
        <?php } ?>
    </div>
<?php if((isset($contact_type_id)) && (!empty($contact_type_id)) && ($contact_type_id == 2)) { ?>
    <div class="vendors2" style="overflow:auto;">
        <h3>Employer Suggestions</h3><hr style="margin: 10px 10px"/>
            <ul class="tabs" data-persist="true">
                <li><a href="#tab1">You may know</a></li>
                <li><a href="#tab2">Recently signed</a></li>
            </ul>
            <div id="tab1">
                <div style="height: 3px;"><hr style="margin-top: 10px; margin-bottom: 0;"/></div>
                <?php if(isset($ymkVendors) && (!empty($ymkVendors))){?>
                    <?php $i = 1; foreach($ymkVendors as $ymk) {
                        if($i==4) break;?>
                    <div class="vendors">
                        <img src="<?php echo base_url('assets/images/user1.png'); ?>" alt="">
                        <h5><?php echo $ymk->accountname; ?></h5>
                        <p><?php echo $ymk->iname; ?></p>
                        <input type="button" class="btn btn-success" style="margin-left: 8px; height: 32px;" id="<?php echo $ymk->accountid;?>" value="Connect" onclick="connect(this.id)">
                    </div>
                    <?php $i++;} ?>
                    <a href="<?php echo base_url('dashboard/ymkMore');?>" class="btn btn-primary" style="float: right">More >></a>
                <?php } else { ?>
                    <div class="vendors"> No Suggestions Found</div>
                <?php } ?>
            </div>
            <div id="tab2">
                <div style="height: 3px;"><hr style="margin-top: 10px; margin-bottom: 0;"/></div>
                <?php if(isset($rsVendors) && (!empty($rsVendors))){?>
                <?php $i = 1;//print"<pre>"; print_r($rsVendors); echo $CurAccId; exit;
                foreach($rsVendors as $key=>$ven) {
                    //print'<pre>'; print_r($ven); echo $CurAccId; exit;
                    if(!($ven->accountid == $CurAccId)) {?>
                        <?php if($i==4) break;?>
                <div class="vendors">
                    <img src="<?php echo base_url('assets/images/user1.png'); ?>" alt="">
                    <h5><?php echo $ven->accountname; ?></h5>
                    <p><?php echo $ven->industry_name; ?></p>
                    <input type="button" class="btn btn-success" style="float: right; height: 32px;" id="<?php echo $ven->accountid;?>" value="Connect" onclick="connect(this.id)">
                </div>
                <?php }  $i++;} ?>
                <div><a href="<?php echo base_url('dashboard/rsvMore');?>" class="btn btn-primary" style="float: right">More >></a></div>
                <?php } else { ?>
                    <div class="vendors"> No Suggestions Found</div>
                <?php } ?>
            </div>

    </div>
<?php } ?>
    <div class="vendors2" style="overflow: auto">
        <h3>Recent Job Posts</h3><hr style="margin-top: 10px; margin-bottom: 10px;"/>
        <?php if((isset($jobs)) && (!empty($jobs))) {
        $i=1;foreach($jobs as $job) {
                if($i==4) break;?>
        <div class="vendors">
            <img src="<?php echo base_url('assets/images/user1.png'); ?>" alt="">
            <h5><a href="<?php echo base_url('dashboard/jobViewApply')."/".$job->post_id.""."/".$job->accid;?>"><?php echo $job->post_title; ?></a></h5> <br/> <p><small>By "<?php echo $job->accountname;?>" <?php echo $job->createddate; ?></small></p>
            <p><?php echo substr($job->post_description, 0, 50)."...";?></p>
        </div>
        <?php $i++;}?>
        <a href="<?php echo base_url('dashboard/rjpMore');?>" class="btn btn-primary" style="float: right"> More >></a>
        <?php } else { ?>
        <div class="vendors"> No Jobs Found</div>
        <?php } ?>
    </div>
<script type="text/javascript">
    function connect(id)
    {
        //alert(id);
        $.ajax({
            url: "<?php echo base_url('dashboard/sendarequestFromSearch')?>",
            type: "POST",
            data: {'accountid' : id, 'rand': Math.round(Math.random() * 100000000)},
            dataType: 'html',
            error: function(data){
                alert(data);
            },
            success:function(data){
                // alert(data);
                document.getElementById(id).value="Requested";
                document.getElementById(id).disabled = true;
                location.reload(true);
            }
        });
        return false;
    }
</script>