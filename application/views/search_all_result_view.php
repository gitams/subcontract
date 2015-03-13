<div class="register_section">
    <div class="container">
	
        <div class="register_content">
		<div>
			<form name="searchLand" onsubmit="return validationForm();" id="searchLand" method="post" enctype="multipart/form-data" action="<?php echo base_url('landing/searchAll'); ?>">
		<input class="landing_search" placeholder="Search Jobs, Companies" type="text" name="searchKeyword" id="searchKeyword" value="<?php echo $_POST['searchKeyword']; ?>">
		<input class="landing_search" placeholder="Search Locations" type="text" name="searchKeyword2" id="searchKeyword2" value="<?php echo $_POST['searchKeyword2']; ?>">
		<input type="submit" class="search_btn" value="Search">
	</form>
	
		</div>
            <div class="register_form">
                <div class="row">
                    <div class="col-sm-12">
					
                            <div class="form-group">
                                
                                <div>
                                    
                                    <?php if(isset($jobs) && !empty($jobs)) {
                                        //print_r($jobs);exit;
                                        foreach($jobs as $key=>$result) { ?>
                                            <li class="list-group-item">
                                                <div class="clearfix">
                                                    <div class="dummy-image pull-left"></div>
                                                    <div class="job-description pull-left">
                                                       <a href="<?php echo base_url('landing/landSingleJob')."/".$result->post_id;?>"><h4 style="color: #1D7FB0"><?php echo $result->post_title;?></h4></a>
                                                        <p>
                                                            <i class="fa fa-envelope"></i>&nbsp; <?php echo $result->post_description;?>
                                                            <br/><i class="fa fa-book"></i>&nbsp; <?php echo $result->accountname;?>
                                                            <i class="fa fa-map-marker"></i>&nbsp; <?php echo $result->cityname;?>
                                                            <i class="fa fa-bookmark"></i>&nbsp; <?php echo $result->skillname;?>
                                                            <small><i class="fa fa-calendar-o"></i>&nbsp;  <?php echo $result->createddate;?></small>
                                                        </p>
                                                    </div>
                                                    <div class="pull-right job-desc-image freelance"></div>
                                                </div>
                                            </li>
                                        <?php } } else {?>
                                        <h4>No Results Found </h4>
                                    <?php }?>
                                    
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function validationForm() {
        var f = document.getElementById('searchKeyword').value;
        var f2 = document.getElementById('searchKeyword2').value;
        if ((f == "" || f == null) && (f2 == "" || f2 == null)) {
            alert("No Search terms Found....!");
            document.getElementById('searchKeyword').focus();
            return false;
        }
    }
</script>
<script type="text/javascript" src="<?php echo base_url('assets/js/register.js'); ?>"></script>