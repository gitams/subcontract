<h3 style="text-align: center; margin-top: 3px;"><label>Search By Major Skill</label></h3><hr/>
<script src="<?php echo base_url('assets/js/tabcontent.js')?>" type="text/javascript"></script>

<div class="user">
    <div class="col-md-12">
        <div class="col-sm-3"><br/><label for="contact-name" >Select Technology:<span style="color: #FF0000"> *</span></label></div>
        <div class="col-sm-6 control-label">
            <br/>
                <select name="skill" id="skill" class="form-control">
                    <option value="">Select Skill</option>
                    <?php foreach ($skills as $skill) { echo '<option value="' . $skill->skillid . '">' . $skill->skillname . '</option>'; } ?>
                </select>
        </div>
        <div class="col-sm-3 control-label">
            <br/>
            <i class="fa fa-search fa-2x btn btn-primary" id="search"> &nbsp;Search</i>
        </div>


    </div>
</div>
<div id="wait" style="display: none" align="center"><img src='<?php echo base_url('assets/images/loading.gif');?>' /></div>
<div class="form-group" id="searchResultDiv">
    <?php include('layout/self_user_search_by_skill_div.php');?>
</div>
<script>
    $(document).ready(function () {
        $(document).on('click', '#search', function () {
            $("#wait").css("display","block");
            var skillId = document.getElementById('skill');
            if (skillId.value == 0 || skillId.value == "") {
                alert('Please select proper Skill');
                $("#wait").css("display","none");
                return false;
            }
            $.ajax({
                url: '<?php echo base_url('user_dashboard/searchResultBySkill');?>',
                type: 'POST',
                data: {'skill': skillId.value, 'rand': Math.round(Math.random() * 1000000)},
                datatype: 'html',
                error: function () {

                },
                success: function (data) {
                    $('#wait').fadeOut(1000);
                    $('#searchResultDiv').html('').append(data);
                }
            });
        });
    });
</script>
