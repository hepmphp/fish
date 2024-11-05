<html>
<head>
    <meta charset="utf-8">
    <title>后台统计信息</title>
    <!-- 引入 ECharts 文件 -->
    <script src="<?=STATIC_URL?>js/echarts.min.js"></script>
</head>
<body>
<!-- 为 ECharts 准备一个具备大小（宽高）的 DOM -->
<div style="width: 900px;height:600px;margin: 0 auto;">
    <div id="main" style="width: 900px;height:300px;"></div>
    <div id="main_1" style="width:900px;height:300px;"></div>

</div>

<script type="text/javascript">
    test1();
    test2();

    // 指定图表的配置项和数据
    // var option = {
    //     title: {
    //         text: 'ECharts 入门示例'
    //     },
    //     tooltip: {},
    //     legend: {
    //         data:['销量']
    //     },
    //     xAxis: {
    //         data: ["衬衫","羊毛衫","雪纺衫","裤子","高跟鞋","袜子"]
    //     },
    //     yAxis: {},
    //     series: [{
    //         name: '销量',
    //         type: 'bar',
    //         data: [5, 20, 36, 10, 10, 20]
    //     }]
    // };
    // 使用刚指定的配置项和数据显示图表。
    function test1() {
        // 基于准备好的dom，初始化echarts实例
        var myChart = echarts.init(document.getElementById('main'));
        option = {
            legend: {},
            tooltip: {
                trigger: 'axis',
                showContent: false
            },
            dataset: {
                source: [
                    ['product', '2012', '2013', '2014', '2015', '2016', '2017'],
                    ['Milk Tea', 56.5, 82.1, 88.7, 70.1, 53.4, 85.1],
                    ['Matcha Latte', 51.1, 51.4, 55.1, 53.3, 73.8, 68.7],
                    ['Cheese Cocoa', 40.1, 62.2, 69.5, 36.4, 45.2, 32.5],
                    ['Walnut Brownie', 25.2, 37.1, 41.2, 18, 33.9, 49.1]
                ]
            },
            xAxis: { type: 'category' },
            yAxis: { gridIndex: 0 },
            grid: { top: '55%' },
            series: [
                {
                    type: 'line',
                    smooth: true,
                    seriesLayoutBy: 'row',
                    emphasis: { focus: 'series' }
                },
                {
                    type: 'line',
                    smooth: true,
                    seriesLayoutBy: 'row',
                    emphasis: { focus: 'series' }
                },
                {
                    type: 'line',
                    smooth: true,
                    seriesLayoutBy: 'row',
                    emphasis: { focus: 'series' }
                },
                {
                    type: 'line',
                    smooth: true,
                    seriesLayoutBy: 'row',
                    emphasis: { focus: 'series' }
                },
                {
                    type: 'pie',
                    id: 'pie',
                    radius: '30%',
                    center: ['50%', '25%'],
                    emphasis: {
                        focus: 'self'
                    },
                    label: {
                        formatter: '{b}: {@2012} ({d}%)'
                    },
                    encode: {
                        itemName: 'product',
                        value: '2012',
                        tooltip: '2012'
                    }
                }
            ]
        };
        myChart.on('updateAxisPointer', function (event) {
            const xAxisInfo = event.axesInfo[0];
            if (xAxisInfo) {
                const dimension = xAxisInfo.value + 1;
                myChart.setOption({
                    series: {
                        id: 'pie',
                        label: {
                            formatter: '{b}: {@[' + dimension + ']} ({d}%)'
                        },
                        encode: {
                            value: dimension,
                            tooltip: dimension
                        }
                    }
                });
            }
        });
        myChart.setOption(option);
    }

    function test2() {
        var myChart_1 = echarts.init(document.getElementById('main_1'));
        option_1 = {
            legend: {},
            tooltip: {},
            dataset: {
                source: [
                    ['product', '2012', '2013', '2014', '2015'],
                    ['Matcha Latte', 41.1, 30.4, 65.1, 53.3],
                    ['Milk Tea', 86.5, 92.1, 85.7, 83.1],
                    ['Cheese Cocoa', 24.1, 67.2, 79.5, 86.4]
                ]
            },
            xAxis: [
                { type: 'category', gridIndex: 0 },
                { type: 'category', gridIndex: 1 }
            ],
            yAxis: [{ gridIndex: 0 }, { gridIndex: 1 }],
            grid: [{ bottom: '55%' }, { top: '55%' }],
            series: [
                // These series are in the first grid.
                { type: 'bar', seriesLayoutBy: 'row' },
                { type: 'bar', seriesLayoutBy: 'row' },
                { type: 'bar', seriesLayoutBy: 'row' },
                // These series are in the second grid.
                { type: 'bar', xAxisIndex: 1, yAxisIndex: 1 },
                { type: 'bar', xAxisIndex: 1, yAxisIndex: 1 },
                { type: 'bar', xAxisIndex: 1, yAxisIndex: 1 },
                { type: 'bar', xAxisIndex: 1, yAxisIndex: 1 }
            ]
        };

        myChart_1.setOption(option_1);
    }





</script>
</body>
</html>
