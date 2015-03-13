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
<?php   $userDetails = $this->session->userdata('userLoginDetails');
        $accountId = $userDetails->accountid;
        //print($accountId);
        //print'<pre>';print_r($jobs); exit;
        echo $this->session->flashdata('suc_msg');
if((isset($jobs))&&(!empty($jobs))){
    foreach ($jobs as $job) {
        $skillset = $skillsObj->fetchJobSkills($job->post_id);
        //print ($job->ja_applied_by);
        if($job->ja_applied_by != $accountId) { ?>
            <?php //print ($job->ja_applied_by); print($job->post_id);?>
            <div class="user">
                <div class="col-md-2">
                    <img src="<?php echo base_url('assets/images/user1.png');?>" alt="">
                </div>
                <div class="col-md-10 each_job_post">
                    <div class="view_apply_div"><a href="<?php echo base_url('dashboard/jobViewApply')."/".$job->post_id.""."/".$job->accid;?>" class="btn btn-primary" style="float: right">View & Apply</a></div>
                    <strong> <a href="javascript: void(0);"> <?php echo $job->post_title; ?></a><p style="color: #16A085"><small>Posted By <?php echo $job->accountname; ?></small></p> </a> </strong>
                    <table class="table table-striped" style="margin-top: 15px;">
                        <tbody>
                        <tr> <td style="border: 0px"><?php echo $job->post_description; ?></td> </tr>
                        <tr> <td style="border: 0px">On <?php echo $job->createddate; ?><a href=""> &nbsp;&nbsp;&nbsp;&nbsp;Link</a> <a href="">-Comment</a> <a href="">-Delete</a> <a href="">-Share</a></td> </tr>
                        <tr> <td style="border: 0"> </td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div style="height: 5px;"></div>
        <?php   } } ?>
<?php } else { ?>
    <h4>No Jobs Posted by Your Connections</h4>
<?php }?>
