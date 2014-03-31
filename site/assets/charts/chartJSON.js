var chart = AmCharts.makeChart("chartdiv", {
    type: "serial",
    // TODO Возможно удать ссылку на картинки
    pathToImages: "amcharts/images/",
    autoMargins: false,
    marginBottom: 35,
    marginLeft: 55,
    marginRight: 30,
    marginTop: 30,
    borderAlpha: 0.2,
    backgroundAlpha: 0.25,
    backgroundColor: "#FFFFFF",
    creditsPosition: "top-right",
    thousandsSeparator: "##",
    dataProvider: [
        {
            "opponent": "Вася",
            "value": 1604
        },
        {
            "opponent": "Петя",
            "value": 1568
        },
        {
            "opponent": "Рома",
            "value": 1789
        },
        {
            "opponent": "Женя",
            "value": 1567
        },
        {
            "opponent": "Василий",
            "value": 1609
        },
        {
            "opponent": "Петр",
            "value": 1457
        },
        {
            "opponent": "Виталий",
            "value": 1679
        },
        {
            "opponent": "Костя",
            "value": 1789
        },
        {
            "opponent": "Леша",
            "value": 1678
        },
        {
            "opponent": "Гоги",
            "value": 1568
        },
        {
            "opponent": "Вася",
            "value": 1604
        },
        {
            "opponent": "Петя",
            "value": 1568
        },
        {
            "opponent": "Рома",
            "value": 1789
        },
        {
            "opponent": "Женя",
            "value": 1567
        },
        {
            "opponent": "Василий",
            "value": 1609
        },
        {
            "opponent": "Петр",
            "value": 1457
        },
        {
            "opponent": "Виталий",
            "value": 1679
        },
        {
            "opponent": "Костя",
            "value": 1789
        },
        {
            "opponent": "Леша",
            "value": 1678
        },
        {
            "opponent": "Гоги",
            "value": 1568
        },
        {
            "opponent": "Вася",
            "value": 1604
        },
        {
            "opponent": "Петя",
            "value": 1568
        },
        {
            "opponent": "Рома",
            "value": 1789
        },
        {
            "opponent": "Женя",
            "value": 1567
        },
        {
            "opponent": "Василий",
            "value": 1609
        },
        {
            "opponent": "Петр",
            "value": 1457
        },
        {
            "opponent": "Виталий",
            "value": 1679
        },
        {
            "opponent": "Костя",
            "value": 1789
        },
        {
            "opponent": "Леша",
            "value": 1678
        },
        {
            "opponent": "Гоги",
            "value": 1568
        }
    ],
    balloon: {
        color: "#FFFFFF",
        cornerRadius: 0,
        fillColor: "#0D8ECF",
        fillAlpha: 1,
        shadowAlpha: 0,
        borderAlpha: 0,
        verticalPadding: 2
    },
    valueAxes: [
        {
            axisColor: "#0D8ECF",
            axisThickness: 2,
            gridColor: "#dadada",
            gridAlpha: 1,
            maximum: 1800,
            minimum: 1400,
            tickLength: 0,
            showFirstLabel: false,
            guides: [
                {
                    fillAlpha: 0.25,
                    fillColor: "#E6C0C0",
                    lineAlpha: 0,
                    toValue: 1600,
                    value: 0
                }
            ]
        }
    ],
    categoryField: "opponent",
    categoryAxis: {
        axisColor: "#0D8ECF",
        gridColor: "#dadada",
        gridAlpha: 1,
//                "position": "top",
        labelsEnabled: false
    },
    graphs: [
        {
            valueField: "value",
            bullet: "round",
            type: "line",
            lineColor: "#AF5D5D",
//            negativeLineColor: "#CC0000",
//            negativeBase: 1600,
            lineThickness: 2
        }
    ],
    chartCursor: {
        cursorColor: "#0D8ECF",
        selectWithoutZooming: true
    }
});