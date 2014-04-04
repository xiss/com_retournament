AmCharts.ready(function () {
    var chart;

    // Подключаем тему
    AmCharts.theme = AmCharts.themes.light;


    // Serial Chart
    chart = new AmCharts.AmSerialChart();
    chart.dataProvider = chartData;
    chart.autoMargins = false;
    chart.marginBottom = 40;
    chart.marginLeft = 55;
    chart.marginRight = 30;
    chart.marginTop = 60;

    // Legend
    var legend = new AmCharts.AmLegend();
    legend.periodValueText = "Рейтинговых турниров посещено: [[value.count]]";
    chart.addLegend(legend);


    // Balloons / Tooltips
    var balloon = chart.balloon;
    balloon.verticalPadding = 0;

    // Category (X)
    chart.categoryField = "name";
    var categoryAxis = chart.categoryAxis;
    categoryAxis.labelsEnabled = false;

    // Value (Y)
    var valueAxis = new AmCharts.ValueAxis();
    valueAxis.showFirstLabel = false;
    chart.addValueAxis(valueAxis);

    // Cursor
    var chartCursor = new AmCharts.ChartCursor();
    chart.addChartCursor(chartCursor);

    // Graph
    var graph = new AmCharts.AmGraph();
    graph.valueField = "avg_rating";
    graph.balloonText = "<p style='line-height: 18px; margin: 8px 1px 3px 1px; text-align: left'><strong>[[avg_rating]]<br>Участвовали:</strong><br>[[participants_list]]</p>";
    graph.legendValueText = "[[name]] - [[date]]";
    chart.addGraph(graph);

    // Lower horizontal red range
    var guide = new AmCharts.Guide();
    valueAxis.addGuide(guide);

    // Write
    chart.write("chartDivRating");
});