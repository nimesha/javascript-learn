<?php
$meta_title = 'Generate the report.';
?>


<div class="container">
    <div class="row">
        <div class="text-center">
            <h1 class="mt-5 text-white">Generate the report.</h1>
            <em class="text-light">Select the relevant date period to generate the report.</em>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-8 offset-2">
            <form class="text-white" method="get" action="/download">
                <fieldset>

                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Start Date</label>
                                <input name="startdate" type="date" id="disabledTextInput" class="form-control" placeholder="Disabled input">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">End Date</label>
                                <input name="enddate" type="date" id="disabledTextInput" class="form-control" placeholder="Disabled input">
                            </div>
                        </div>
                    </div>
                    <div class="mt-3"></div>
                    <em class="text-light">Generate report by HTTP request. (depending on dataset size and execution time)</em>
                    <br />
                    <button name="download_action" type="submit" value="tpb" class="btn btn-primary">Turnover Per Brand</button>
                    <button name="download_action" type="submit" value="tpd" class="btn btn-primary">Turnover Per Day</button>
                    <br />
                    <div class="mt-4"></div>
                    <em class="text-light">Generate report by offline processing jobs. (message brokers Redis)</em>
                    <br />
                    <p>Final output('App/CSV/offile') <span class="text-warning"> Real world project file out put can be send with a email or upload to cloud (AWS s3) </span></p>
                    <button name="download_action" type="submit" value="tpb_job" class="btn btn-success">Turnover Per Brand</button>
                    <button name="download_action" type="submit" value="tpd_job" class="btn btn-success">Turnover Per Day</button>
                </fieldset>
            </form>
        </div>
    </div>
</div>