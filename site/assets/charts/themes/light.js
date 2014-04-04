AmCharts.themes.light = {

    themeName: "light",

    // Диаграмма
    AmChart: {
        color: "#000000",
        fontFamily: "Arial",
        fontSize: "13",
        creditsPosition: "top-right",
        backgroundColor: "#FFFFFF",
        borderAlpha: "0.2",
        backgroundAlpha: "0.25",
        pathToImages: "amcharts/images/",
        labelRadius: "10",
        radius: "200"
    },

    // Легенда
    AmLegend: {
        switchable: "false",
        position: "absolute",
        valueAlign: "left",
        markerSize: "0",
        top: "0",
        left: "-15"
    },

    // Тултипы
    AmBalloon: {
        color: "#FFFFFF",
        cornerRadius: "0",
        fillColor: "#329A02",
        fillAlpha: "0.8",
        shadowAlpha: "0",
        borderAlpha: "0"
    },

    // (X)
    CategoryAxis: {
        axisColor: "#329A02",
        gridColor: "#dadada",
        gridAlpha: "1",
        startOnAxis: "true"
    },

    // (Y)
    ValueAxis: {
        axisColor: "#329A02",
        axisThickness: "2",
        gridColor: "#dadada",
        gridAlpha: "1",
        tickLength: "0"
    },

    // Курсор
    ChartCursor: {
        color: "#FFFFFF",
        cursorColor: "#329A02",
        selectWithoutZooming: "true",
        // Размер выделенной точки
        graphBulletSize: "1"
    },

    // График
    AmGraph: {
        bullet: "round",
        type: "line",
        lineColor: "#AF5D5D",
        negativeLineColor: "#CC0000",
        negativeBase: "1600",
        lineThickness: "2",
        hideBulletsCount: "40"
    },

    // Дапазон на диаграмме другого цвета
    Guide: {
        fillAlpha: "0.25",
        fillColor: "#E6C0C0",
        lineAlpha: "0",
        toValue: "1600",
        value: "0"
    }
};
