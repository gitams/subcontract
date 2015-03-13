<style>
    .black_overlay{
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: black;
        z-index:1001;
        -moz-opacity: 0.8;
        opacity:.80;
        filter: alpha(opacity=80);
    }
    .white_content {
        display: none;
        position: fixed;
        top: 25%;
        left: 25%;
        width: 50%;
        height: 50%;
        padding: 16px;
        border: 5px solid #16A085;
        background-color: white;
        z-index:1002;
        overflow: auto;
    }

</style>
<?php $userDetails = $this->session->userdata('userLoginDetails');
    $accountId = $userDetails->accountid;
    $contactId = $userDetails->contactid;
?>
<?php //foreach($resultJob as $res) {print'<pre>'; print_r($res); }exit;
        //print'<pre>'; print_r($cans); exit;
if(isset($resultJob) && (!empty($resultJob))) {?>
<?php foreach($resultJob as $res){ ?>
<div class="user">
    <div class="col-md-2"> <img src="<?php echo base_url('assets/images/user1.png');?>" alt=""> </div>
    <div class="col-md-10">
        <strong> <a href="javascript: void(0);"> <?php echo $res->post_title; ?></a><p style="color: #16A085"><small>Posted By <?php echo $res->accountname; ?></small></p> </a> </strong>
        <table class="table table-striped" style="margin-top: 15px;">
            <?php //$skillset = $skillsObj->fetchJobSkills($job->post_id); ?>
            <tbody>
            <tr> <td style="border: 0px"><?php echo substr($res->post_description, 0, 250)."...";?></td> </tr>
            <tr> <td style="border: 0px">Salary Range: <strong><?php echo $res->ctc_from . '$ - ' . $res->ctc_to . '$ per' . " ".$res->rate; ?></strong> With <strong><?php echo $res->experience_from . '  '.' - '.$res->experience_to . ' Years '; ?></strong> Experience</td> </tr>
            <tr> <td style="border: 0px">Applied Date : <?php echo $res->ja_applied_date; ?><!--<a href=""> &nbsp;&nbsp;&nbsp;&nbsp;Link</a> <a href="">-Comment</a> <a href="">-Delete</a> <a href="">-Share</a>--></td> </tr>
            </tbody>
        </table>
    </div>
    
</div>
<?php } }else {?>
<div>   <h3>No Jobs Applied</h3>
        <a href="<?php echo base_url('user_dashboard');?>" class="btn btn-primary">Back to Home</a>
</div>
<?php }?>





