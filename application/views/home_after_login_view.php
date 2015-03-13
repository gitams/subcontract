<script src="<?php echo base_url('assets/js/tabcontent.js')?>" type="text/javascript"></script>
<!--<h3 style="text-align: center; margin-top: 3px;"><label>Your Connections & All Other Jobs</label></h3><hr/>-->
<?php   $userDetails = $this->session->userdata('userLoginDetails');
        $accountId = $userDetails->accountid;
        //print($accountId);
        //print'<pre>';print_r($jobs); exit;
    echo $this->session->flashdata('suc_msg');?>
<ul class="tabs" data-persist="true">
    <li><a href="#view1">Jobs Posted By Your Connections</a></li>
    <li><a href="#view2">All Jobs</a></li>
    <li><a href="#view3">Applied Jobs</a></li>
</ul>
<style>
    .view_apply_div {
        display: none; /* Hide button */
        position: absolute;
        right:0;
    }
    .each_job_post:hover .view_apply_div{
        display: block; /* On :hover of div show button */
    }
</style>
<div class="tabcontents">
    <div id="view1">
        <?php //print"<pre>";print_r($jobs);?>
        <?php if((isset($jobs))&&(!empty($jobs))){
            foreach ($jobs as $job) {
                $skillset = $skillsObj->fetchJobSkills($job->post_id);
                if($job->ja_applied_acc_id != $accountId) { ?>
                    <div class="user">
                        <!--<div class="col-sm-2"> <img src="<?php /*echo base_url('assets/images/user1.png');*/?>" alt=""> </div>-->
                        <div class="col-sm-12 each_job_post">
                            <div class="view_apply_div"><a href="<?php echo base_url('dashboard/jobViewApply')."/".$job->post_id.""."/".$job->accid;?>" class="btn btn-primary" style="float: right">View & Apply</a></div>
                            <p style="color: #16A085;"><strong><a><i class="fa fa-bookmark"></i>&nbsp;&nbsp;<?php echo $job->post_title;?></a></p>
                            <p style="color: #16A085;"><small><i class="fa fa-building">&nbsp;<?php echo $job->accountname;?>&nbsp;</i><i class="fa fa-calendar">&nbsp;&nbsp;<?php echo $job->createddate;?></i></small></p></a></strong>
                            <table class="table table-striped" style="margin-top: 15px;">
                                <tbody>
                                <tr> <td style="border: 0"><i class="fa fa-bars"></i> <?php echo $job->post_description; ?></td> </tr>
                                <tr> <td style="border: 0"><i class="fa fa-money"></i> <strong><?php echo $job->ctc_from . '$ - ' . $job->ctc_to . '$ per' . " ".$job->rate; ?></strong> <i class="fa fa-calendar-o"> </i> <strong><?php echo $job->experience_from . '  '.' - '.$job->experience_to . ' Years '; ?></strong> Experience</td> </tr>
                                <tr> <td style="border: 0"><i class="fa fa-star"></i> <strong><?php $counter = 0; foreach ($skillset as $skill) { if ($counter != 0) { echo ', '; } echo $skill->skillname; $counter++; } ?></strong> <i class="fa fa-map-marker"></i> <?php echo $job->locationname; ?></td> </tr>
                                <tr> <td style="border: 0"><!--<a href=""> &nbsp;&nbsp;&nbsp;&nbsp;Link</a> <a href="">-Comment</a> <a href="">-Delete</a> <a href="">-Share</a>--></td> </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div style="height: 5px;"></div>
                <?php   } } ?>
        <?php } else { ?>
            <h4>No Jobs Posted by Your Connections</h4>
        <?php }?>
    </div>
    <div id="view2">
        <?php if((isset($jobs))&&(!empty($jobs))){
            foreach ($jobs as $job) {
                $skillset = $skillsObj->fetchJobSkills($job->post_id);
                if($accountId = $job->accid) { ?>
                    <div class="user">
                        <!--<div class="col-sm-2"> <img src="<?php /*echo base_url('assets/images/user1.png');*/?>" alt=""> </div>-->
                        <div class="col-sm-10">
                            <strong> <a>&nbsp;&nbsp;<i class="fa fa-bookmark"></i>&nbsp;&nbsp;<?php echo $job->post_title; ?></a><p style="color: #16A085"><small><i class="fa fa-building"> &nbsp;<?php echo $job->accountname; ?>&nbsp;</i> <i class="fa fa-calendar"> &nbsp;&nbsp;<?php echo $job->createddate; ?></i></small></p> </a> </strong>
                            <table class="table table-striped" style="margin-top: 15px;">
                                <tbody>
                                    <tr> <td style="border: 0"><i class="fa fa-bars"></i> <?php echo $job->post_description; ?></td> </tr>
                                    <tr> <td style="border: 0"><i class="fa fa-money"></i> <strong><?php echo $job->ctc_from . '$ - ' . $job->ctc_to . '$ per' . " ".$job->rate; ?></strong> <i class="fa fa-calendar-o"> </i> <strong><?php echo $job->experience_from . '  '.' - '.$job->experience_to . ' Years '; ?></strong> Experience</td> </tr>
                                    <tr> <td style="border: 0"><i class="fa fa-star"></i> <strong><?php $counter = 0; foreach ($skillset as $skill) { if ($counter != 0) { echo ', '; } echo $skill->skillname; $counter++; } ?></strong>  <i class="fa fa-map-marker"></i> <?php echo $job->locationname; ?></td> </tr>
                                    <tr> <td style="border: 0"><!--<a href=""> &nbsp;&nbsp;&nbsp;&nbsp;Link</a> <a href="">-Comment</a> <a href="">-Delete</a> <a href="">-Share</a>--></td> </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div style="height: 5px;"></div>
                <?php   } } ?>
        <?php } else { ?>
            <h4>No Jobs Posted Found</h4>
        <?php }?>
    </div>
    <div id="view3">
        <?php if((isset($appliedJobs))&&(!empty($appliedJobs))){
            //print'<pre>';print_r($appliedJobs);
            foreach ($appliedJobs as $ajob) {
                $skillset = $skillsObj->fetchJobSkills($ajob->post_id);?>
                    <div class="user">
                        <!--<div class="col-sm-2"> <img src="<?php /*echo base_url('assets/images/user1.png');*/?>" alt=""> </div>-->
                        <div class="col-sm-10">
                            <strong> <a>&nbsp;&nbsp;<i class="fa fa-bookmark"></i>&nbsp;&nbsp;<?php echo $ajob->post_title; ?></a><p style="color: #16A085"><small><i class="fa fa-building"> &nbsp;<?php echo $ajob->accountname; ?>&nbsp;</i> <i class="fa fa-calendar"> &nbsp;&nbsp;<?php echo $job->createddate; ?></i></small></p> </a> </strong>
                            <table class="table table-striped" style="margin-top: 15px;">
                                <tbody>
                                <tr> <td style="border: 0"><i class="fa fa-bars"></i> <?php echo $ajob->post_description; ?></td> </tr>
                                <tr> <td style="border: 0"><i class="fa fa-money"></i> <strong><?php echo $ajob->ctc_from . '$ - ' . $ajob->ctc_to . '$ per' . " ".$ajob->rate; ?></strong> <strong><i class="fa fa-calendar-o"></i> <?php echo $ajob->experience_from . '  '.' - '.$ajob->experience_to . ' Years '; ?></strong> Experience</td> </tr>
                                <tr> <td style="border: 0"><i class="fa fa-star"></i>  <strong><?php $counter = 0; foreach ($skillset as $skill) { if ($counter != 0) { echo ', '; } echo $skill->skillname; $counter++; } ?></strong> <i class="fa fa-map-marker"></i> <?php echo $ajob->locationname; ?></td> </tr>
                                <tr> <td style="border: 0"><!--<a href=""> &nbsp;&nbsp;&nbsp;&nbsp;Link</a> <a href="">-Comment</a> <a href="">-Delete</a> <a href="">-Share</a>--></td> </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div style="height: 5px;"></div>
                <?php    } ?>
        <?php } else { ?>
            <h4>No Jobs Applied</h4>
        <?php }?>
    </div>
</div>
