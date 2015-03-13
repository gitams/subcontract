
<div class="search_company">
    <?php ?>
    <div class="container">
	
	<div style="margin:150px 0px 0px 180px;">
	<form name="searchLand" onsubmit="return validationForm();" id="searchLand" method="post" enctype="multipart/form-data" action="<?php echo base_url('landing/searchAll'); ?>">
		<input class="landing_search" placeholder="Search Jobs, Companies" type="text" name="searchKeyword" id="searchKeyword">
		<input class="landing_search" placeholder="Search Locations" type="text" name="searchKeyword2" id="searchKeyword2">
		<input type="submit" class="search_btn" value="Search">
	</form>
	
	</div>
	
        
        <div class="signup_btns">
            <div class="as_company">
                <a href="<?php echo base_url('landing/register'); ?>">
                    <img src="<?php echo base_url('assets/images/company_as.png'); ?>"/><br/>Employer<br/>Sign Up
                </a>
            </div>
            <div class="as_candidate">
                <a href="<?php echo base_url('landing/registerUser'); ?>">
                    <img src="<?php echo base_url('assets/images/candidate_as.png'); ?>"/><br/>Employee<br/>Sign Up
                </a>
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