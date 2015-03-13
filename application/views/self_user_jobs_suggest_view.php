<?php   $userDetails = $this->session->userdata('userLoginDetails');
        $accountId = $userDetails->accountid;
        //print($accountId);
        //print'<pre>';print_r($sugJobs); exit;
        echo $this->session->flashdata('suc_msg');
if((isset($sugJobs))&&(!empty($sugJobs))){
    foreach ($sugJobs as $job) {
        $skillset = $skillsObj->fetchJobSkills($job->post_id);
        //print ($job->ja_applied_by);
            //print ($job->ja_applied_by); print($job->post_id);?>
            <div class="user">
                <div class="col-md-2">
                    <img src="<?php echo base_url('assets/images/user1.png');?>" alt="">
                </div>
                <div class="col-md-10">
                    <strong>
                        <a href="javascript: void(0);">
                            <?php echo $job->post_title; ?></a><p style="color: #16A085"><small>Posted By <?php echo $job->accountname; ?></small></p>
                        </a>
                    </strong>
                    <table class="table table-striped" style="margin-top: 15px;">
                        <tbody>
                        <tr>
                            <td style="border: 0px"><?php echo $job->post_description; ?></td>
                        </tr>
                        <tr>
                            <td style="border: 0"><!--<a href=""> &nbsp;&nbsp;&nbsp;&nbsp;Link</a> <a href="">-Comment</a> <a href="">-Delete</a> <a href="">-Share</a>-->
                            <?php echo $job->statename;?>
                            &nbsp;&nbsp;&nbsp;&nbsp;<?php echo $job->cityname;?>
                            &nbsp;&nbsp;&nbsp;&nbsp;<?php echo $job->skillname;?>
                            &nbsp;&nbsp;&nbsp;&nbsp;<span style="font-size: smaller">posted on </span> <?php echo $job->createddate; ?>
                            </td>
                        </tr>
                        <!--<tr><td style="border: 0"><a href="<?php /*echo base_url('dashboard/jobViewApply')."/".$job->post_id.""."/".$job->accid;*/?>" class="btn btn-primary" style="float: right">View & Apply</a> </td></tr>-->
                        </tbody>
                    </table>
                </div>
            </div>
            <div style="height: 5px;"></div>
        <?php   } ?>
<?php } else { ?>
    <h4>No Jobs Posted by Your Connections</h4>
<?php }?>
