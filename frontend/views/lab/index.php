<div id="placeholder" style="width:600px;height:300px;"></div>

<script language="javascript" type="text/javascript">
    var all_data = [
        {data: [["2010/10/01", 0], ["2010/10/5", 1], ["2010/10/10", 7], ["2010/10/15", 8]]},
        {data: [["2010/10/01", 13], ["2010/10/5", 23], ["2010/10/10", 32], ["2010/10/15", 33]]}
    ];
    // преобразуем даты в UTC
    for (var j = 0; j < all_data.length; ++j) {
        for (var i = 0; i < all_data[j].data.length; ++i)
            all_data[j].data[i][0] = Date.parse(all_data[j].data[i][0]);
    }

    var plot_conf = {
        series: {
            lines: {
                show: true,
                lineWidth: 2
            }
        },
        xaxis: {
            mode: "time",
            timeformat: "%y/%m/%d",
        }
    };

    $.plot($("#placeholder"), all_data, plot_conf);
</script>