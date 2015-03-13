<?php
if((isset($requests)) && (!empty($requests))) {
    foreach ($requests as $request) { ?>
    <div class="row postBlock">
        <div class="col-lg-8 col-md-8 col-xs-8 col-sm-8">
            <strong><a href="javascript: void(0);"><?php echo $request->accountname; ?></a></strong>
        </div>
        <div class="col-lg-4 col-md-4 col-xs-4 col-sm-4">
            <button name="approve" id="" class="btn btn-danger cancelRequest" requestid="<?php echo $request->requestto; ?>">Cancel Request</button>
        </div>
    </div>
    <?php } } else {?>
    <h4>No Sent Requests found to Any One</h4>
    <a href="<?php echo base_url('dashboard/rsvMore');?>" class="btn btn-primary">Send A Request</a>
    <?php } ?>
<script type="text/javascript">
    $(document).ready(function () {
        $(document).on('click', '.cancelRequest', function () {
            $(this).addClass('cancelled');
            $.ajax({
                url: '<?php echo base_url('dashboard/updaterequest')?>',
                method: "POST",
                data: {'id': $(this).attr('requestid'), 'typeid': '2', 'csrf': Math.round(Math.random() * 10000000)},
                datatype: 'html',
                success: function (data) {
                    alert(data);
                    $('.cancelled').parent().parent().remove();
                }
            })
        });
    });
</script>