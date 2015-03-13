<div id="view2">
    <?php if((isset($jobs))&&(!empty($jobs))){
        foreach ($jobs as $job) {
            $skillset = $skillsObj->fetchJobSkills($job->post_id);
            if($accountId = $job->accid) { ?>
                <div class="user">
                    <div class="col-md-2"> <img src="<?php echo base_url('assets/images/user1.png');?>" alt=""> </div>
                    <div class="col-md-10">
                        <strong> <a href="<?php echo base_url('dashboard/jobViewApply')."/".$job->post_id.""."/".$job->accid;?>">&nbsp;&nbsp;<i class="fa fa-bookmark"></i>&nbsp;&nbsp;<?php echo $job->post_title; ?></a>
                            <p style="color: #16A085"><small><i class="fa fa-building"> &nbsp;<?php echo $job->accountname; ?>&nbsp; </i> <i class="fa fa-calendar">&nbsp;&nbsp; <?php echo $job->createddate; ?> </i></small></p>  </strong>
                        <table class="table table-striped" style="margin-top: 15px;">
                            <tbody>
                            <tr> <td style="border: 0"><i class="fa fa-bars"></i> <?php echo $job->post_description; ?></td> </tr>
                            <tr> <td style="border: 0"><i class="fa fa-money"></i> <strong><?php echo $job->ctc_from . '$ - ' . $job->ctc_to . '$ per' . " ".$job->rate; ?></strong> <i class="fa fa-calendar-o"> </i> <strong><?php echo $job->experience_from . '  '.' - '.$job->experience_to . ' Years '; ?></strong> Experience</td> </tr>
                            <tr> <td style="border: 0"><i class="fa fa-star"></i> <strong><?php $counter = 0; foreach ($skillset as $skill) { if ($counter != 0) { echo ', '; } echo $skill->skillname; $counter++; } ?></strong> <i class="fa fa-map-marker"></i> <?php echo $job->locationname; ?></td> </tr>
                            <tr> <td style="border: 0"><!--<a href=""> &nbsp;&nbsp;&nbsp;&nbsp;Link</a> <a href="">-Comment</a> <a href="">-Delete</a> <a href="">-Share</a>--></td> </tr>
                            </tbody>
                        </table>
                        </a>
                    </div>
                </div>
                <div style="height: 5px;"></div>
            <?php   } } ?>
    <?php } else { ?>
        <h4>No Jobs Posted Found</h4>
    <?php }?>
</div>