<h3 style="text-align: center; margin-top: 3px;"><label>Search By Major Skill</label></h3><hr/>
<script src="<?php echo base_url('assets/js/tabcontent.js')?>" type="text/javascript"></script>

<div class="user">
    <div class="col-md-12">
        <div class="col-sm-4"></div>
        <div class="col-sm-4 control-label">
            <label for="contact-name" >Company Name:<span style="color: #FF0000"> *</span></label>
                <input class="form-control" type="text" id="company_name" name="company_name" placeholder="Employer Name">
        </div>
        <div class="col-sm-4 control-label">
            <br/>
            <i class="fa fa-search fa-2x btn btn-primary" id="search"> &nbsp;Search</i>
        </div>


    </div>
</div>
<br/>
<div id="wait" style="display: none" align="center"><img src='<?php echo base_url('assets/images/loading.gif');?>' /></div>
<div class="form-group" id="searchResultDiv">
    <?php include('layout/self_user_search_by_emp_div.php');?>
</div>
<script>
    $(document).ready(function () {
        $(document).on('click', '#search', function () {
            $("#wait").css("display","block");
            var empName = document.getElementById('company_name');
            if (empName.value == null || empName.value == "") {
                alert('Please enter an employer name');
                return false;
            }
            $.ajax({
                url: '<?php echo base_url('user_dashboard/searchResultByEmp');?>',
                type: 'POST',
                data: {'company': empName.value, 'rand': Math.round(Math.random() * 1000000)},
                datatype: 'html',
                error: function () {

                },
                success: function (data) {
                    //$("#wait").css("display","none");
                    $('#wait').fadeOut(1000);
                    $('#searchResultDiv').html('').append(data);
                }
            });
        });
    });

</script>
