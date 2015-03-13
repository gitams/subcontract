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
        $contactId = $userDetails->contactid;
//print($accountId);
//print'<pre>';print_r($jobs); exit;
if($this->session->flashdata('suc_msg')){?>
    <div id=flash align="center" style="clear: both; height: 50px; border: solid lightgreen"><p style="padding: 10px;;color: #16A085;font-weight: bold;"> <?=$this->session->flashdata('suc_msg')?> </p></div>
<?php }?>

<?php if((isset($jobs))&&(!empty($jobs))){ ?>
    <?php foreach ($jobs as $job) {
            $skillset = $skillsObj->fetchJobSkills($job->post_id);
            //print ($job->ja_applied_by);
            //print ($job->ja_applied_by); print($job->post_id);?>
        <?php if($job->ja_applied_con_id != $contactId) { ?>
       <div class="user">
                <div class="col-md-2"> <img src="<?php echo base_url('assets/images/user1.png');?>" alt=""> </div>
                <div class="col-md-10 each_job_post">
                    <strong> <a> <?php echo $job->post_title; ?></a><p style="color: #16A085"><small>Posted By <?php echo $job->accountname; ?></small></p> </a> </strong>
                    <div class="view_apply_div"><a href="<?php echo base_url('user_dashboard/jVApplyUser')."/".$job->post_id.""."/".$job->accid;?>" class="btn btn-primary" style="float: right">View & Apply</a></div>
                    <table class="table table-striped" style="margin-top: 15px;">
                        <tbody>
                        <tr> <td style="border: 0"><?php echo substr($job->post_description, 0, 250)."...";?></td> </tr>
                        <tr> <td style="border: 0">On <?php echo $job->createddate; ?><!--<a href=""> &nbsp;&nbsp;&nbsp;&nbsp;Link</a> <a href="">-Comment</a> <a href="">-Delete</a> <a href="">-Share</a>--></td> </tr>
                        <!--<tr><td style="border: 0"><a href="<?php /*echo base_url('dashboard/jobViewApply')."/".$job->post_id.""."/".$job->accid;*/?>" class="btn btn-primary" style="float: right">View & Apply</a> </td></tr>-->
                        </tbody>
                    </table>
                </div>
            </div>
            <div style="height: 5px;"></div>
        <?php  }  } ?>

<?php } else { ?>
    <h4>No Jobs Posted By Your Subscriptions</h4>
<?php }?>

