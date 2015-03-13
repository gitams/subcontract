<h3 style="text-align: center; margin-top: 3px;"><label>Search for Jobs</label></h3><hr/>
<script src="<?php echo base_url('assets/js/tabcontent.js')?>" type="text/javascript"></script>

<div class="user">
    <div class="col-md-12">
        <div class="col-sm-3 control-label"><br/><label for="contact-name" >Search for Jobs:<span style="color: #FF0000"> *</span></label></div>
        <div class="col-sm-6 control-label">
            <br/><input class="form-control" type="text" id="search_key" name="search_key" placeholder="Enter search keywords with spaces">
        </div>
        <div class="col-sm-3 control-label">
            <br/>
            <i class="fa fa-search fa-2x btn btn-primary" id="search"> &nbsp;Search</i>
        </div>
    </div>
</div>
<br/>
<div id="wait" style="display: none" align="center"><img src='<?php echo base_url('assets/images/loading.gif');?>' /></div>
<div class="form-group" id="searchResultDiv">
    <?php include('layout/self_user_job_search_result_div.php');?>
</div>
<script>
    $(document).ready(function () {
        $(document).on('click', '#search', function () {
            $("#wait").css("display","block");
            var keyWord = document.getElementById('search_key');
            if (keyWord.value == null || keyWord.value == "") {
                alert('Please enter an employer name');
                $("#wait").css("display","none");
                return false;
            }
            $.ajax({
                url: '<?php echo base_url('user_dashboard/selfUserSearchJobsResult');?>',
                type: 'POST',
                data: {'company': keyWord.value, 'rand': Math.round(Math.random() * 1000000)},
                datatype: 'html',
                error: function () {

                },
                success: function (data) {
                    $("#wait").css("display","none");
                    //$('#wait').fadeOut(500);
                    $('#searchResultDiv').html('').append(data);
                }
            });
        });
    });

</script>
