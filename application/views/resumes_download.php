<?php   
//		print_r($resume_request);
        //print($accountId);
        //print'<pre>';print_r($cans); exit; ?>
<h3 style="text-align: center; margin-top: 3px;"><label>Resume Requests</label></h3><hr/>
<style>
    .canCircle
    {
        width:100px;
        height:100px;
        border-radius:40px;
        font-size:15px;
        color:#fff;
        text-align:center;
        background:#257AB1;
    }
	.canCirclegreen
    {
        width:100px;
        height:100px;
        border-radius:40px;
        font-size:15px;
        color:#fff;
        text-align:center;
        background:rgb(22,160,133);
    }
    .capitalize {
        text-transform: capitalize;
    }
</style>
<?php   $userDetails = $this->session->userdata('userLoginDetails');
        $accountId = $userDetails->accountid;
        //print($accountId);
        //print'<pre>';print_r($cans); exit; ?>
    <p style="color: #006600"><?php echo $this->session->flashdata('suc_msg'); ?> </p>
    <?php if((isset($resume_request)) && (!empty($resume_request))) {
        foreach ($resume_request as $can) {
        if($accountId = $can->can_account_id) { ?>
            <div class="col-sm-12 vendors2" style="width: 100%;">
                <div class="">
                    <i class="fa fa-user"></i>
                    <strong>
                        <a class="canBox capitalize">
                            <?php echo $can->can_first_name." " .$can->can_last_name; ?>
                        </a>
                    </strong>
                </div>
                <div>
					<?php 
						$applyCSS = "canCircle"; 
						
					?>
                    <div id="circle_<?php echo $can->can_id; ?>" class="<?php echo $applyCSS; ?> col-sm-6" style="margin-top: 10px;">
						<div style="padding-top: 20px;">
							<?php echo $can->skillname; ?><br/><?php echo $can->can_current_exp_years . " Years " . $can->can_current_exp_months . " Months"; ?>
						</div>
					</div>
                    <div  class="col-sm-9" >
                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <td style="border:0;"><i class="fa fa-flag"></i> <?php echo $can->can_current_org; ?></td>
                                <td style="border:0;"><i class="fa fa-bookmark"> </i> <?php echo $can->can_emp_type. "(".$can->can_work_type .")"; ?></td>
                                <td style="border:0;"><i class="fa fa-star"></i> <?php echo $can->skillname; ?></td>
                                <td style="border:0;"><i class="fa fa-calendar-o"> </i> <?php echo $can->can_current_exp_years . " Years " . $can->can_current_exp_months . " Months"; ?></td>
                            </tr>
                            <tr>
                                <td style="border:0;"><i class="fa fa-money"></i> <?php echo $can->can_current_ctc; ?></td>
                                <td style="border:0;"><i class="fa fa-file-word-o"></i> <?php echo $can->can_resume; ?></td>
                                <td style="border: 0;"><i class="fa fa-inbox"></i> <?php echo $can->can_email; ?></td>
								<td style="border:0;"><i class="fa fa-graduation-cap"></i> <?php echo $can->can_high_edu; ?></td>
                                
                            </tr>
                            <tr>                                
                                <td style="border:0;"><i class="fa fa-star-half-o"></i> <?php echo $can->can_other_skill_1. ", " . $can->can_other_skill_2; ?></td>
                                <td style="border:0;"><i class="fa fa-map-marker"></i> <?php echo $can->can_location; ?></td>
								<td style="border:0;"><i class="fa fa-phone-square"></i> <?php echo $can->can_mobile;?></td>
                                <td style="border:0;"><!--<a href="<?php /*echo base_url('dashboard/editCandidate')."/".$can->can_id */?>" class="btn btn-primary" style="height: 30px;">Edit</a>--><!--<a href="<?php /*echo base_url('dashboard/deleteCandidate')*/?>" class="btn btn-danger" style="height: 30px;">Delete</a>--></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
					<div>
						<p id="msgDIV" class="hidden" style="color:red;"></p>
						<?php if(1){ ?>
						<input class="btn btn-primary acc" type="button" val_att="2" id="accept<?php echo $can->can_id;?>" value="Accept" onclick="changePlaced(this,<?php echo $can->can_id; ?>,2);"/>
						<div style="height:20px"></div>
						<input class="btn btn-primary acc" type="button" val_att="3" id="reject<?php echo $can->can_id;?>" value="Reject" onclick="changePlaced(this,<?php echo $can->can_id; ?>,3);"/>
						<label class="la" style="display:none"></label>
						<?php }else{ ?>
							<label><?php if(1){}?></label>
						<?php }
						?>
						<span class="hidden" id="loading_<?php echo $can->can_id; ?>">Updating...</span>
					</div>
                </div>
            </div>
            <!--<div style="background-color: #595959; height: 1px;" ></div>-->
        <?php   } } } else { ?>
        <div class="vendors2" style="width: 100%;">
            <h4>No Request List</h4>
            
        </div>
        <?php }?>
		<script>
			function changePlaced(tval,canID,val)
			{
				
				var parms= "val="+val+"&canID="+canID;
				$("#loading_"+canID).show();
				$.ajax({
				   type: "POST",
				   url: "<?php echo base_url('dashboard/acceptrejectsumereq'); ?>",
				   dataType: "json",
				   data: parms,
				   success: function(json){
					   $("#loading_"+canID).hide();
						if(json.status=="success")
						{
							$("#msgDIV").html("Updated Successfully");
							$(".acc").hide();
							$(".la").show();
							$(".la").html(tval.value);
							
						}
						else
						{
							$("#msgDIV").html("Could Not Be Updated");
							return false;
						}
					}
				});
			}
		</script>