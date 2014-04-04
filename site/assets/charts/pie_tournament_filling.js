AmCharts.ready(function () {
    var chart;
    var legend;

    // Подключаем тему
    AmCharts.theme = AmCharts.themes.light;


    AmCharts.ready(function () {
        // Pie chart
        chart = new AmCharts.AmPieChart();
        chart.dataProvider = chartData;
        chart.titleField = "name";
        chart.autoMargins = false;
        chart.marginBottom = 0;
        chart.marginLeft = 0;
        chart.marginRight = 0;
        chart.marginTop = 40;
        chart.valueField = "qtParticipants";
//        chart.percentPrecision = 4;
        chart.startDuration = 0;

        // Balloons / Tooltips
        var balloon = chart.balloon;
        balloon.verticalPadding = 0;


        // Legend
//        legend = new AmCharts.AmLegend();
//        legend.align = "center";
//        legend.markerType = "circle";
//        legend.position = "right";
//        legend.autoMargins = false;
//        legend.marginRight = 60;
//        legend.right = 0;

        chart.balloonText = "<b>Участников:</b> [[value]] ([[percents]]%)";
//        chart.addLegend(legend);

        // Write
        chart.write("chartDivFiling");
    });

});