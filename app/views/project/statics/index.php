<html>
<head>
    <meta charset="utf-8">
    <title>后台统计信息</title>
    <!-- 引入 ECharts 文件 -->
    <script src="<?=STATIC_URL?>js/echarts.min.js"></script>
    <script  src="<?=STATIC_URL?>js/bootstrap.min.js?940144957"></script>
    <link href="<?=STATIC_URL?>css/bootstrap.min.css?1597064090" rel="stylesheet">
    <link href="<?=STATIC_URL?>css/style.css?2080292721" rel="stylesheet">
    <link href="<?=STATIC_URL?>js/bootstrap-table/bootstrap-table.min.css?2123846075" rel="stylesheet">
</head>
<body>
<!-- 为 ECharts 准备一个具备大小（宽高）的 DOM -->
<div style="width: 900px;height:600px;margin: 0 auto;">
    <div class="table-wrap" style="margin-top: 30px;">
        <table  data-toggle="table" class="table-item table" style="border: 1px solid #1278f6;">
            <thead>
            <tr>
                <th>类型</th>
                <th>数量</th>
                <th>用户id</th>
                <th>用户名</th>

            </tr>
            </thead>
            <?php foreach ($static_data_group as $k=>$v){?>

                <?php foreach ($v as $k1=>$v1){?>
                    <tr>
                        <td><?php if($k=='projects_group'){echo "项目";}elseif ($k=='tasks_group'){echo "任务";}else{echo "BUG";}?></td> <td><?=$v1['total']?></td><td><?=$v1['owner_user_id']?></td>  <td><?=$v1['owner_user']?></td>
                    </tr>
                <?php }?>

            <?php }?>
        </table>
    </div>
    <div id="main" style="width: 900px;height:300px;"></div>
    <div id="main_1" style="width:900px;height:300px;"></div>

</div>

<script type="text/javascript">
  //  test1();
  projecct_statics_line();
  project_statics();


    function projecct_statics_line(){
        var myChart = echarts.init(document.getElementById('main'));
        option = {
            title: {
                text: '项目统计',
                left:'center',
            },
            xAxis: {
                data: ["项目","任务","BUG"]
            },
            yAxis: {minInterval:1},
            series: [
                {
                    type: 'line',
                    data: <?=json_encode($static_data)?>
                }
            ]
        };
        myChart.setOption(option);
    }
    function project_statics() {
        var myChart_1 = echarts.init(document.getElementById('main_1'));

        var option = {
            title: {
                text: '项目统计',
                left:'center',
            },
            tooltip: {},
            legend: {
                data:['项目统计']
            },
            xAxis: {
                data: ["项目","任务","BUG"]
            },
            yAxis: {minInterval:1},
            series: [{
                name: '数量',
                type: 'bar',
                data: <?=json_encode($static_data)?>
            }]
        };

        myChart_1.setOption(option);
    }



</script>
</body>
</html>
