<?php
$companies = json_decode($companies);
?>
<div class="row" style="padding-top: 10px;">
    <form class="form-group" name="autosuggest" action="<?php echo base_url('dashboard/sendarequest'); ?>" method="post" enctype="multipart/form-data">
        <!--<input type="text" class="form-control" name="autosuggestfield" id="autosuggestion" placeholder="Search a Company"/>-->
        <div class="col-lg-8">
            <select name="selectCompanies" class="form-control" id="selectCompany">
                <option value="0">Select a Company</option>
                <?php
                foreach ($companies as $company) {
                    echo '<option value="' . $company->id . '">' . $company->item . '</option>';
                }
                ?>
            </select>
        </div>
        <div class="col-lg-4">
            <button name="Submit" type="submit" class="btn btn-lg signin_btn">Send a Request</button>
        </div>
    </form>
</div>
<script type="text/javascript">
    /* $('#autosuggestion').autocomplete({
     source: function (request, response)
     {
     $.ajax({
     url: BASEURL + 'dashboard/fetchCompanySuggestions',
     dataType: "json",
     data: {term: request.term, },
     success: function (data)
     {
     response(data);
     }
     });
     },
     minLength: 2,
     //serviceUrl: BASEURL + 'dashboard/fetchCompanySuggestions',
     select: function (event, ui) {
     console.log(ui);
     }
     });*/

    /*$('#autosuggestion').typeahead({
     source: function (query, process) {
     $.ajax({
     url: BASEURL + 'dashboard/fetchCompanySuggestions',
     type: 'GET',
     dataType: 'JSON',
     data: 'term=' + query,
     success: function (data) {
     console.log(data);
     process(data);
     }
     });
     }
     });*/

</script>