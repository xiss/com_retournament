AmCharts.ready(function () {
    var chart;

    // Serial Chart
    chart = new AmCharts.AmSerialChart();
    chart.dataProvider = chartData;
    chart.pathToImages = "amcharts/images/";
    chart.autoMargins = false;
    chart.marginBottom = 40;
    chart.marginLeft = 55;
    chart.marginRight = 30;
    chart.marginTop = 30;
    chart.borderAlpha = 0.2;
    chart.backgroundAlpha = 0.25;
    chart.backgroundColor = "#FFFFFF";
    chart.creditsPosition = "top-right";
    chart.fontFamily = "Arial";
    chart.fontSize = 13;

    // Balloons / Tooltips
    var balloon = chart.balloon;
    balloon.color = "#FFFFFF";
    balloon.cornerRadius = 0;
    balloon.fillColor = "#0D8ECF";
    balloon.fillAlpha = 1;
    balloon.shadowAlpha = 0;
    balloon.borderAlpha = 0;
    balloon.verticalPadding = 2;
    balloon.textAlign = "left";

    // Category (X)
    chart.categoryField = "opponent_name";
    var categoryAxis = chart.categoryAxis;
    categoryAxis.axisColor = "#0D8ECF";
    categoryAxis.gridColor = "#dadada";
    categoryAxis.gridAlpha = 1;
    categoryAxis.labelsEnabled = false;
    categoryAxis.startOnAxis = true;

    // Value (Y)
    var valueAxis = new AmCharts.ValueAxis();
    valueAxis.axisColor = "#0D8ECF";
    valueAxis.axisThickness = 2;
    valueAxis.gridColor = "#dadada";
    valueAxis.gridAlpha = 1;
    valueAxis.maximum = 1800;
    valueAxis.minimum = 1400;
    valueAxis.tickLength = 0;
    valueAxis.showFirstLabel = false;
    chart.addValueAxis(valueAxis);

    // Cursor
    var chartCursor = new AmCharts.ChartCursor();
    chartCursor.cursorColor = "#0D8ECF";
    chartCursor.selectWithoutZooming = true;
    chart.addChartCursor(chartCursor);

    // Graph
    var graph = new AmCharts.AmGraph();
    graph.valueField = "rating";
    graph.balloonText = "<strong>[[rating]]</strong><br>[[tournament_name]] - [[tournament_date]] - [[tournament_stage]] тур<br>[[opponent_name]]";
    graph.bullet = "round";
    graph.type = "line";
    graph.lineColor = "#AF5D5D";
    graph.negativeLineColor = "#CC0000";
    graph.negativeBase = 1600;
    graph.lineThickness = 2;
    chart.addGraph(graph);

    // Lower horizontal red range
    var guide = new AmCharts.Guide();
    guide.fillAlpha = 0.25;
    guide.fillColor = "#E6C0C0";
    guide.lineAlpha = 0;
    guide.toValue = 1600;
    guide.value = 0;
    valueAxis.addGuide(guide);

    // Write
    chart.write("chartDivRatingChange");
});