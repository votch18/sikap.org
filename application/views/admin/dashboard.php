<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Dashboard</h3>
    </div>   
</div>

<div class="row">
    <div class="col-md-9">
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <div>
                        <h3 class="card-title m-b-5"><span class="lstick"></span>Daily Views (Unique)</h3>
                    </div>
                    <div class="ml-auto">
                        <select class="custom-select b-0" name="month">
                            <?php
                            foreach ($monthly_views as $month){
                                ?>
                                <option value="<?=$month['period']?>" selected><?=$month['period']?></option>
                                <?php
                            }
                            ?>

                        </select>
                    </div>
                </div>
                <canvas id="myChart"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <div>
                        <h3 class="card-title m-b-5"><span class="lstick"></span>Monthly Views</h3>
                    </div>

                </div>
                <br/>
                <table class="table vm font-14">
                    <tbody>
                    <?php
                    foreach ($monthly_views as $month){
                        ?>
                        <tr>
                            <td class="b-0"><?=$month['period']?></td>
                            <td class="text-right font-medium b-0"><?=$month['views']?></td>
                        </tr>
                    <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
   
<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <div class="m-r-20 align-self-center">
                        <i class="mdi mdi-file-document fa-3x text-info"></i>
                    </div>
                    <div class="align-self-center">
                        <h6 class="text-muted m-t-10 m-b-0">News</h6>
                        <h2 class="m-t-0"><?=count($news)?></h2></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <div class="m-r-20 align-self-center">
                        <i class="mdi mdi-clipboard-text fa-3x text-info"></i>
                    </div>
                    <div class="align-self-center">
                        <h6 class="text-muted m-t-10 m-b-0">Programs & Projects</h6>
                        <h2 class="m-t-0"><?=count($programs)?></h2></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <div class="m-r-20 align-self-center">
                        <i class="mdi mdi-image fa-3x text-info"></i></div>
                    <div class="align-self-center">
                        <h6 class="text-muted m-t-10 m-b-0">Gallery</h6>
                        <h2 class="m-t-0"><?=count($gallery)?></h2></div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="row">

    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <div class="m-r-20 align-self-center">
                        <i class="mdi mdi-burst-mode fa-3x text-info"></i></div>
                    <div class="align-self-center">
                        <h6 class="text-muted m-t-10 m-b-0">Slider</h6>
                        <h2 class="m-t-0"><?=count($slider)?></h2></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <div class="m-r-20 align-self-center">
                    <i class="mdi mdi-account-multiple fa-3x text-info"></i></div>
                    <div class="align-self-center">
                        <h6 class="text-muted m-t-10 m-b-0">Users</h6>
                        <h2 class="m-t-0"><?=count($users)?></h2></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <div class="m-r-20 align-self-center">
                        <i class="mdi mdi-eye fa-3x text-info"></i></div>
                    <div class="align-self-center">
                        <h6 class="text-muted m-t-10 m-b-0">Page Views</h6>
                        <h2 class="m-t-0"><?=count($views)?></h2></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var data = JSON.parse('<?=json_encode($daily_views)?>');

    console.log(data);

    var labels = [];
    var items  = [];

    $.each(data, function(index, value) {
        labels.push(value.period);
        items.push(parseInt(value.views));
        console.log(labels);

    })
    var options = {
        legend: {
            display: true,
            labels: {
                fontColor: '#4dc9f6'
            }
        },

        elements: {
            line: {
                fill: false,
            }
        },
        scales: {
            xAxes: [{
                display: true,
                scaleLabel: {
                    display: true,
                    labelString: 'Days'
                }
            }],
            yAxes: [{
                display: true,
                ticks: {
                    beginAtZero: true,
                    steps: 5,
                    stepValue: 20,
                }
            }]
        }
    };

    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'No of views',
                data: items,
                backgroundColor: '#4dc9f6',
                borderColor: '#4dc9f6',
            }]
        },
        options: options
    });

    $('body').on('change', 'select[name="month"]', function(e){
        e.preventDefault();

        $.post('<?=base_url()?>admin/get_daily_views', { month: $(this).val()} ).done(function(results){

            //console.log(results);
            var res = results;
            var dt = [];
            var lbl = [];

            $.each(res, function (index, value) {
                dt.push(value.views);
                lbl.push(value.period);
            })

            myChart.data.datasets.shift();

            myChart.data.labels = lbl;
            myChart.data.datasets.push({
                label: 'No of views',
                data: dt,
                backgroundColor: '#4dc9f6',
                borderColor: '#4dc9f6',
            })

            myChart.update();
            res = null;
            dt = null;
            lbl = null;
        })
    })
</script>