<?php //print'<pre>';print_r($ymkVendors); exit;
$userDetails = $this->session->userdata('userLoginDetails');
$CurAccId = $userDetails->accountid;
?>
<div class="wt-nxt2">
    <h4><img src="<?php echo base_url('assets/images/signal.png'); ?>">AT-A-GLANCE</h4>
    <h3><?php echo $appliedJobsCount?><span style="font-size: smaller;">Jobs Total Applied</span></h3>
    <h3><?php echo $canCount?><span style="font-size: smaller;">Employer Subscription</span></h3>
    <h3 style="border:none;">Up to<span style="font-size: smaller;"><br/><?php echo date("Y-m-d");?></span>
</div>
<div class="wt-nxt">
    <h4>WHAT'S NEXT</h4>
    <a href="<?php echo base_url('user_dashboard/updateProfile');?>" style="display:none; padding-top:0px;">Update Profile</a>
    <a href="<?php echo base_url('user_dashboard/searchByLoc');?>">Search Jobs by Location</a>
    <a href="<?php echo base_url('user_dashboard/searchBySkill');?>">Search Jobs by Skill</a>
    <a href="<?php echo base_url('user_dashboard/searchByEmp');?>">Search Jobs by Company</a>
</div>
<div class="vendors2" style="overflow: auto">
    <div id="tabs-1">
        <h4 class="btn btn-primary" style="width: 100%; margin-bottom: 5%;">Recently Posted Jobs</h4>
        <div id="tabs-2">
            <?php if((isset($jobs)) && (!empty($jobs))) {
                $i=1; foreach($jobs as $job) {
                    if($i==4) break;?>
                    <div class="vendors">
                        <img src="<?php echo base_url('assets/images/user1.png'); ?>" alt="">
                        <h5><?php echo $job->post_title; ?></h5> <br/> <p><small>By "<?php echo $job->accountname;?>" <?php echo $job->createddate; ?></small></p>
                        <p><?php echo substr($job->post_description, 0, 50)."...";?></p>
                    </div>
                <?php $i++;}?>
                <a href="<?php echo base_url('user_dashboard/recentJobPost');?>" style="float: right" class="btn btn-primary">More >></a>
            <?php } else { ?>
                <div class="vendors"> No Jobs Found</div>
            <?php } ?>
        </div>
    </div>
</div>
