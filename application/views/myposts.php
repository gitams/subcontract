<h3 style="text-align: center; margin-top: 3px;"><label>Your Job Posts</label></h3><hr/>
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
        top: 15%;
        left: 30%;
        width: 40%;
        height: 70%;
        padding: 16px;
        border: 5px solid #16A085;
        background-color: white;
        z-index:1002;
        overflow: auto;
    }
     .fe {
         display: none; /* Hide button */
         /*position: absolute;
         right: 2%;*/
     }
    .vendors2:hover .fe{
        display: block; /* On :hover of div show button */
    }
</style>
<?php   $userDetails = $this->session->userdata('userLoginDetails');
        $accountId = $userDetails->accountid;
        //print($accountId);
        //print'<pre>';print_r($myJobs); exit;
if((isset($myJobs)) && (!empty($myJobs))) {
    foreach ($myJobs as $job) {
        $skillset = $skillsObj->fetchJobSkills($job->post_id);
        /* $from_Months = ($job->experience_from % 12);
         $from_Years = (($job->experience_from - $from_Months) / 12);
         $to_Months = ($job->experience_to % 12);
         $to_Years = (($job->experience_to - $to_Months) / 12);*/ ?>

       <!-- <table class="table table-stripped" style="margin-top: 15px; margin-left: 15px;">
            <tbody>
            <tr>-->
            <div class="vendors2" style="width: 100%;">
               <div class="fl">
                   <div style="padding-bottom: 5px;"><strong><a><i class="fa fa-bookmark" style=" font-size: 16px;">&nbsp;&nbsp;&nbsp;<?php echo $job->post_title; ?></i></a></strong></div>
                   <div class="fl padL15"><i class="fa fa-money"></i>&nbsp;&nbsp;&nbsp;<?php echo $job->ctc_from . '$ - ' . $job->ctc_to . '$ per' . " ".$job->rate; ?></div>
                   <div class="fl padL15"><i class="fa fa-briefcase"></i>&nbsp;&nbsp;&nbsp;<?php echo $job->experience_from . '  '.' - '.$job->experience_to . ' Years '; ?></div>
                   <div class="fl padL15"><i class="fa fa-map-marker"></i>&nbsp;&nbsp;&nbsp;<?php echo $job->locationname; ?></div>
                   <div class="fl padL15"><i class="fa fa-star"></i>&nbsp;&nbsp;&nbsp;<?php $counter = 0; foreach ($skillset as $skill) { if ($counter != 0) { echo ', '; } echo $skill->skillname; $counter++; } ?></div>

               </div>

                <div class="fr" style="width:10%;background-color: #ebebeb; height:100%; min-height:50px;" align="center">Applied <br/>
                    <?php if(isset($job->cnt) && (!empty($job->cnt)) ) { ?>
                    <div style="z-index: 99;" id="sec2But">
                        <a href = "javascript:void(0)" onclick = "check_applied(<?php echo $job->post_id;?>);"><p class="btn btn-primary"><?php echo $job->cnt;?></p></a>
                    </div>
                    <?php } else {?>
                        <div style="z-index: 99;" id="sec2But">
                            <a href = "javascript:void(0)"><p class="btn btn-primary"><?php echo $job->cnt;?></p></a>
                        </div>
                    <?php } ?>
            </div>
                <div class="fe fr padL15"><a class="btn btn-primary" href="<?php echo base_url("dashboard/editJobPost")."/".$job->post_id; ?>"><i class="fa fa-pencil"></i>&nbsp;&nbsp; Edit</a></div>
                <div style="clear:both;height:1px;"></div>
            <!--</tr>
            </tbody>
        </table>-->
            </div>
        <?php if($accountId = $job->accid) { ?>
        <?php   } } } else {?>
        <h4> No Jobs Posted Yet </h4>
        <a href="<?php echo base_url('dashboard/addpost');?>" class="btn btn-primary"> Click to Post A Job</a>
        <?php } ?>
<div id="light2" class="white_content">
    <?php include('layout/applied_view.php');?>
</div>
<div id="fade2" class="black_overlay"></div>
<script>
    function check_applied(id)
    {
        $.ajax({
            url: "<?php echo base_url('dashboard/applied')?>",
            method: "POST",
            data: {'post_id': id, 'csrf': Math.round(Math.random() * 10000000)},
            error: function()
            {
                alert(data);
            },
            success:function(data)
            {
                $('#light2').html('').append(data);
                document.getElementById('light2').style.display='block';
                document.getElementById('fade2').style.display='block';
            }
        });
    }
</script>
