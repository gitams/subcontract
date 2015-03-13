
<?php include('layout/header.php');?>
        <div class="register_section">
        	<div class="container search-page">
            	<div class="register_content">
                	<div class="register_form">
                    	<h1 class="page-title"><i class="fa fa-search"></i>Search for Job Offers</h1>
                        <div class="row">
                        	<div class="col-sm-12">
                        		<form onsubmit="return searchJob(keyword.value,locations.value);" action = "<?php echo base_url('dashboard/searchJob');?>" class="form-horizontal" role="form">
                                    <div class="form-group">
                                    	<div class="col-sm-3">
                                            <input type="text" class="form-control" id="keyword" name="keyword" placeholder="Keyword">
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" id="locations" name="locations" placeholder="All Locations">
                                        </div>
                                        <div class="col-sm-3">
                                            <select class="form-control" id="industries">
                                                <option>All Industries</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-2">
                                            <button class="btn btn-primary" type="submit"> Search &nbsp;<i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
    							</form>
                        	</div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="form-group btn-group col-sm-2 pull-right" role="group">
                        <button type="button" class="btn btn-default">Map</button>
                        <button type="button" class="btn btn-default">Grid</button>
                    </div>
                </div>
                <div class="register_content">
                    <div class="register_form">
                        <div class="row">
                            <div class="col-sm-12 clearfix filter-headings">
                                <h4 class="col-sm-4 feature-jobs"><i class="fa fa-star"></i>&nbsp; FEATURED JOBS!</h4>
                                <h4 class="col-sm-4 latest-popular-jobs"><i class="fa fa-bullhorn"></i>&nbsp; LATEST JOBS</h4>
                                <h4 class="col-sm-4 latest-popular-jobs text-primary"><i class="fa fa-heart"></i>&nbsp; POPULAR JOBS</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="col-sm-4 padding0">
                                    <div class="clearfix">
                                        <h4 class="col-sm-12 form-group filter-refinement"><i class="fa fa-filter"></i>&nbsp; FILTERS & REFINEMENTS</h4>
                                        <div class="filter-container clearfix">
                                            <div class="col-sm-6 padding0">
                                                <h4 class="col-sm-12 form-group padding0">Job Types</h4>
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" value=""> All Types
                                                    </label>
                                                </div>
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" value=""> Freelance
                                                    </label>
                                                </div>
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" value=""> Part-Time
                                                    </label>
                                                </div>
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" value=""> Full-Time
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 padding0">
                                                <h4 class="col-sm-12 form-group padding0">Featured</h4>
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" value=""> All Jobs
                                                    </label>
                                                </div>
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" value=""> Regular
                                                    </label>
                                                </div>
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" value=""> Featured
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix filter-container">
                                        <h4 class="col-sm-12 padding0">Salary</h4>
                                        <p class="clearfix">
                                            <div class="pull-left">Starting from <b>$200</b></div>
                                            <div class="pull-right salary-slider"></div>
                                        </p>
                                    </div>
                                    <div class="clearfix filter-container">
                                        <h4 class="col-sm-12 padding0">Experience</h4>
                                        <p class="clearfix">
                                            <div class="pull-left">More than <b>2</b> years</div>
                                            <div class="pull-right experience-slider"></div>
                                        </p>
                                        <p></p>
                                    </div>
                                    <div class="clearfix">
                                        <div class="col-sm-6 filter-container">
                                            <h4 class="col-sm-12 form-group padding0">Career Level</h4>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" value=""> All Levels
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" value=""> Junior
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" value=""> Middle
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" value=""> Senior
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 filter-container">
                                            <h4 class="col-sm-12 form-group padding0">Presence</h4>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" value=""> All
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" value=""> Remote Jobs
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" value=""> At Office
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" value=""> Travel a lot
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="col-sm-12">
                                        <div class="col-sm-6 latest-popular-jobs-border top_arrow_box">&nbsp;</div>
                                        <div class="col-sm-6 latest-popular-jobs-border">&nbsp;</div>
                                    </div>
                                    <ul class="list-group clearfix" id="searchJobResult">
                                        <?php include('layout/jobsearch_div.php');?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<script type="text/javascript">
    function searchJob(word, location)
    {
        //alert(word);

        $.ajax({
            url: "<?php echo base_url('dashboard/jobpostSearch')?>",
            type: "POST",
            data: {'key' : word, 'loc' : location, 'rand': Math.round(Math.random() * 100000000)},
            dataType: 'html',
            error: function(data){
                alert(data);
            },
            success:function(data){
               // alert(data);

                $('#searchJobResult').html('').append(data);
            }
        });
        return false;
    }

</script>
        <?php include('layout/footer.php');?>