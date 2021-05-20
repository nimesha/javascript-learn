<?php
$meta_title = 'Generate the report.';
?>


<div class="container">
    <div class="row">
        <div class="text-center">
            <h1 class="mt-5 text-white">Reports</h1>
            <em class="text-light"></em>
        </div>
    </div>
    <div class="row mt-5">
        <div class="text-center">
            <a href="<?php echo 'download_csv/'.$fileName.'?v'.rand(5, 15) ?>" class="btn btn-success" target="_blank">Download the File</a>
            <a href="<?php echo '/' ?>" class="btn btn-dark  mr-3" target="_blank">Back to home</a>
        </div>
    </div>
</div>