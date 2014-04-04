AmCharts.GaugeAxis = AmCharts.Class({construct: function (a) {
    this.cname = "GaugeAxis";
    this.radius = "95%";
    this.startAngle = -120;
    this.endAngle = 120;
    this.startValue = 0;
    this.endValue = 200;
    this.gridCount = 5;
    this.tickLength = 10;
    this.minorTickLength = 5;
    this.tickColor = "#555555";
    this.labelFrequency = this.tickThickness = this.tickAlpha = 1;
    this.inside = !0;
    this.labelOffset = 10;
    this.showLastLabel = this.showFirstLabel = !0;
    this.axisThickness = 1;
    this.axisColor = "#000000";
    this.axisAlpha = 1;
    this.gridInside = !0;
    this.topTextYOffset = 0;
    this.topTextBold = !0;
    this.bottomTextYOffset = 0;
    this.bottomTextBold = !0;
    this.centerY = this.centerX = "0%";
    this.bandOutlineAlpha = this.bandOutlineThickness = 0;
    this.bandOutlineColor = "#000000";
    this.bandAlpha = 1;
    AmCharts.applyTheme(this, a, "GaugeAxis")
}, value2angle: function (a) {
    return this.startAngle + this.singleValueAngle * a
}, setTopText: function (a) {
    if (void 0 !== a) {
        this.topText = a;
        var b = this.chart;
        if (this.axisCreated) {
            this.topTF && this.topTF.remove();
            var d = this.topTextFontSize;
            d || (d = b.fontSize);
            var c = this.topTextColor;
            c || (c = b.color);
            a = AmCharts.text(b.container, a, c, b.fontFamily, d, void 0, this.topTextBold);
            a.translate(this.centerXReal, this.centerYReal - this.radiusReal / 2 + this.topTextYOffset);
            this.chart.graphsSet.push(a);
            this.topTF = a
        }
    }
}, setBottomText: function (a) {
    if (void 0 !== a) {
        this.bottomText = a;
        var b = this.chart;
        if (this.axisCreated) {
            this.bottomTF && this.bottomTF.remove();
            var d = this.bottomTextFontSize;
            d || (d = b.fontSize);
            var c = this.bottomTextColor;
            c || (c = b.color);
            a = AmCharts.text(b.container, a, c, b.fontFamily,
                d, void 0, this.bottomTextBold);
            a.translate(this.centerXReal, this.centerYReal + this.radiusReal / 2 + this.bottomTextYOffset);
            this.bottomTF = a;
            this.chart.graphsSet.push(a)
        }
    }
}, draw: function () {
    var a = this.chart, b = a.graphsSet, d = this.startValue, c = this.endValue, e = this.valueInterval;
    isNaN(e) && (e = (c - d) / this.gridCount);
    var m = this.minorTickInterval;
    isNaN(m) && (m = e / 5);
    var p = this.startAngle, h = this.endAngle, f = this.tickLength, k = (c - d) / e + 1, g = (h - p) / (k - 1);
    this.singleValueAngle = c = g / e;
    var l = a.container, r = this.tickColor, v = this.tickAlpha,
        C = this.tickThickness, D = e / m, F = g / D, m = this.minorTickLength, G = this.labelFrequency, t = this.radiusReal;
    this.inside || (t -= 15);
    var y = a.centerX + AmCharts.toCoordinate(this.centerX, a.realWidth), z = a.centerY + AmCharts.toCoordinate(this.centerY, a.realHeight);
    this.centerXReal = y;
    this.centerYReal = z;
    var H = {fill: this.axisColor, "fill-opacity": this.axisAlpha, "stroke-width": 0, "stroke-opacity": 0}, n, A;
    this.gridInside ? A = n = t : (n = t - f, A = n + m);
    var s = this.axisThickness / 2, h = AmCharts.wedge(l, y, z, p, h - p, n + s, n + s, n - s, 0, H);
    b.push(h);
    h = AmCharts.doNothing;
    AmCharts.isModern || (h = Math.round);
    H = AmCharts.getDecimals(e);
    for (n = 0; n < k; n++) {
        var q = d + n * e, s = p + n * g, w = h(y + t * Math.sin(s / 180 * Math.PI)), B = h(z - t * Math.cos(s / 180 * Math.PI)), x = h(y + (t - f) * Math.sin(s / 180 * Math.PI)), u = h(z - (t - f) * Math.cos(s / 180 * Math.PI)), w = AmCharts.line(l, [w, x], [B, u], r, v, C, 0, !1, !1, !0);
        b.push(w);
        w = -1;
        x = this.labelOffset;
        this.inside || (x = -x - f, w = 1);
        var B = Math.sin(s / 180 * Math.PI), u = Math.cos(s / 180 * Math.PI), B = y + (t - f - x) * B, x = z - (t - f - x) * u, E = this.fontSize;
        isNaN(E) && (E = a.fontSize);
        var u = Math.sin((s - 90) / 180 * Math.PI),
            J = Math.cos((s - 90) / 180 * Math.PI);
        if (0 < G && n / G == Math.round(n / G) && (this.showLastLabel || n != k - 1) && (this.showFirstLabel || 0 !== n)) {
            var q = AmCharts.formatNumber(q, a.numberFormatter, H), I = this.unit;
            I && (q = "left" == this.unitPosition ? I + q : q + I);
            q = AmCharts.text(l, q, a.color, a.fontFamily, E);
            E = q.getBBox();
            q.translate(B + w * E.width / 2 * J, x + w * E.height / 2 * u);
            b.push(q)
        }
        if (n < k - 1)for (q = 1; q < D; q++)u = s + F * q, w = h(y + A * Math.sin(u / 180 * Math.PI)), B = h(z - A * Math.cos(u / 180 * Math.PI)), x = h(y + (A - m) * Math.sin(u / 180 * Math.PI)), u = h(z - (A - m) * Math.cos(u / 180 *
            Math.PI)), w = AmCharts.line(l, [w, x], [B, u], r, v, C, 0, !1, !1, !0), b.push(w)
    }
    if (b = this.bands)for (d = 0; d < b.length; d++)if (e = b[d])r = e.startValue, v = e.endValue, f = AmCharts.toCoordinate(e.radius, t), isNaN(f) && (f = A), k = AmCharts.toCoordinate(e.innerRadius, t), isNaN(k) && (k = f - m), g = p + c * r, v = c * (v - r), C = e.outlineColor, void 0 == C && (C = this.bandOutlineColor), D = e.outlineThickness, isNaN(D) && (D = this.bandOutlineThickness), F = e.outlineAlpha, isNaN(F) && (F = this.bandOutlineAlpha), r = e.alpha, isNaN(r) && (r = this.bandAlpha), e = AmCharts.wedge(l, y,
        z, g, v, f, f, k, 0, {fill: e.color, stroke: C, "stroke-width": D, "stroke-opacity": F}), e.setAttr("opacity", r), a.gridSet.push(e);
    this.axisCreated = !0;
    this.setTopText(this.topText);
    this.setBottomText(this.bottomText);
    a = a.graphsSet.getBBox();
    this.width = a.width;
    this.height = a.height
}});
AmCharts.GaugeArrow = AmCharts.Class({construct: function (a) {
    this.cname = "GaugeArrow";
    this.color = "#000000";
    this.nailAlpha = this.alpha = 1;
    this.startWidth = this.nailRadius = 8;
    this.endWidth = 0;
    this.borderAlpha = 1;
    this.radius = "90%";
    this.nailBorderAlpha = this.innerRadius = 0;
    this.nailBorderThickness = 1;
    this.frame = 0;
    AmCharts.applyTheme(this, a, "GaugeArrow")
}, setValue: function (a) {
    var b = this.chart;
    b ? b.setValue(this, a) : this.previousValue = this.value = a
}});
AmCharts.GaugeBand = AmCharts.Class({construct: function () {
    this.cname = "GaugeBand"
}});
AmCharts.AmAngularGauge = AmCharts.Class({inherits: AmCharts.AmChart, construct: function (a) {
    this.cname = "AmAngularGauge";
    AmCharts.AmAngularGauge.base.construct.call(this, a);
    this.theme = a;
    this.type = "gauge";
    this.minRadius = this.marginRight = this.marginBottom = this.marginTop = this.marginLeft = 10;
    this.faceColor = "#FAFAFA";
    this.faceAlpha = 0;
    this.faceBorderWidth = 1;
    this.faceBorderColor = "#555555";
    this.faceBorderAlpha = 0;
    this.arrows = [];
    this.axes = [];
    this.startDuration = 1;
    this.startEffect = "easeOutSine";
    this.adjustSize = !0;
    this.extraHeight = this.extraWidth = 0;
    AmCharts.applyTheme(this, a, this.cname)
}, addAxis: function (a) {
    this.axes.push(a)
}, formatString: function (a, b) {
    return a = AmCharts.formatValue(a, b, ["value"], this.numberFormatter, "", this.usePrefixes, this.prefixesOfSmallNumbers, this.prefixesOfBigNumbers)
}, initChart: function () {
    AmCharts.AmAngularGauge.base.initChart.call(this);
    var a;
    0 === this.axes.length && (a = new AmCharts.GaugeAxis(this.theme), this.addAxis(a));
    var b;
    for (b = 0; b < this.axes.length; b++)a = this.axes[b], a = AmCharts.processObject(a,
        AmCharts.GaugeAxis, this.theme), a.chart = this, this.axes[b] = a;
    var d = this.arrows;
    for (b = 0; b < d.length; b++) {
        a = d[b];
        a = AmCharts.processObject(a, AmCharts.GaugeArrow, this.theme);
        a.chart = this;
        d[b] = a;
        var c = a.axis;
        AmCharts.isString(c) && (a.axis = AmCharts.getObjById(this.axes, c));
        a.axis || (a.axis = this.axes[0]);
        isNaN(a.value) && a.setValue(a.axis.startValue);
        isNaN(a.previousValue) && (a.previousValue = a.axis.startValue)
    }
    this.setLegendData(d);
    this.drawChart();
    this.totalFrames = 1E3 * this.startDuration / AmCharts.updateRate
}, drawChart: function () {
    AmCharts.AmAngularGauge.base.drawChart.call(this);
    var a = this.container, b = this.updateWidth();
    this.realWidth = b;
    var d = this.updateHeight();
    this.realHeight = d;
    var c = AmCharts.toCoordinate, e = c(this.marginLeft, b), m = c(this.marginRight, b), p = c(this.marginTop, d) + this.getTitleHeight(), h = c(this.marginBottom, d), f = c(this.radius, b, d), c = b - e - m, k = d - p - h + this.extraHeight;
    f || (f = Math.min(c, k) / 2);
    f < this.minRadius && (f = this.minRadius);
    this.radiusReal = f;
    this.centerX = (b - e - m) / 2 + e;
    this.centerY = (d - p - h) / 2 + p + this.extraHeight / 2;
    isNaN(this.gaugeX) || (this.centerX = this.gaugeX);
    isNaN(this.gaugeY) ||
    (this.centerY = this.gaugeY);
    var b = this.faceAlpha, d = this.faceBorderAlpha, g;
    if (0 < b || 0 < d)g = AmCharts.circle(a, f, this.faceColor, b, this.faceBorderWidth, this.faceBorderColor, d, !1), g.translate(this.centerX, this.centerY), g.toBack(), (a = this.facePattern) && g.pattern(a);
    for (b = f = a = 0; b < this.axes.length; b++)d = this.axes[b], d.radiusReal = AmCharts.toCoordinate(d.radius, this.radiusReal), d.draw(), d.width > a && (a = d.width), d.height > f && (f = d.height);
    (b = this.legend) && b.invalidateSize();
    if (this.adjustSize && !this.chartCreated) {
        g &&
        (g = g.getBBox(), g.width > a && (a = g.width), g.height > f && (f = g.height));
        g = 0;
        if (k > f || c > a)g = Math.min(k - f, c - a);
        0 < g && (this.extraHeight = k - f, this.chartCreated = !0, this.validateNow())
    }
    this.dispDUpd();
    this.chartCreated = !0
}, validateSize: function () {
    this.extraHeight = this.extraWidth = 0;
    this.chartCreated = !1;
    AmCharts.AmAngularGauge.base.validateSize.call(this)
}, addArrow: function (a) {
    this.arrows.push(a)
}, removeArrow: function (a) {
    AmCharts.removeFromArray(this.arrows, a);
    this.validateNow()
}, removeAxis: function (a) {
    AmCharts.removeFromArray(this.axes,
        a);
    this.validateNow()
}, drawArrow: function (a, b) {
    a.set && a.set.remove();
    var d = this.container;
    a.set = d.set();
    if (!a.hidden) {
        var c = a.axis, e = c.radiusReal, m = c.centerXReal, p = c.centerYReal, h = a.startWidth, f = a.endWidth, k = AmCharts.toCoordinate(a.innerRadius, c.radiusReal), g = AmCharts.toCoordinate(a.radius, c.radiusReal);
        c.inside || (g -= 15);
        var l = a.nailColor;
        l || (l = a.color);
        var r = a.nailColor;
        r || (r = a.color);
        l = AmCharts.circle(d, a.nailRadius, l, a.nailAlpha, a.nailBorderThickness, l, a.nailBorderAlpha);
        a.set.push(l);
        l.translate(m,
            p);
        isNaN(g) && (g = e - c.tickLength);
        var c = Math.sin(b / 180 * Math.PI), e = Math.cos(b / 180 * Math.PI), l = Math.sin((b + 90) / 180 * Math.PI), v = Math.cos((b + 90) / 180 * Math.PI), d = AmCharts.polygon(d, [m - h / 2 * l + k * c, m + g * c - f / 2 * l, m + g * c + f / 2 * l, m + h / 2 * l + k * c], [p + h / 2 * v - k * e, p - g * e + f / 2 * v, p - g * e - f / 2 * v, p - h / 2 * v - k * e], a.color, a.alpha, 1, r, a.borderAlpha, void 0, !0);
        a.set.push(d);
        this.graphsSet.push(a.set)
    }
}, setValue: function (a, b) {
    a.axis && (a.axis.value2angle(b), a.frame = 0, a.previousValue = a.value);
    a.value = b;
    var d = this.legend;
    d && d.updateValues()
}, handleLegendEvent: function (a) {
    var b =
        a.type;
    a = a.dataItem;
    if (!this.legend.data && a)switch (b) {
        case "hideItem":
            this.hideArrow(a);
            break;
        case "showItem":
            this.showArrow(a)
    }
}, hideArrow: function (a) {
    a.set.hide();
    a.hidden = !0
}, showArrow: function (a) {
    a.set.show();
    a.hidden = !1
}, updateAnimations: function () {
    AmCharts.AmAngularGauge.base.updateAnimations.call(this);
    for (var a = this.arrows.length, b, d = 0; d < a; d++) {
        b = this.arrows[d];
        var c;
        b.frame >= this.totalFrames ? c = b.value : (b.frame++, b.clockWiseOnly && b.value < b.previousValue && (c = b.axis, b.previousValue -= c.endValue -
            c.startValue), c = AmCharts.getEffect(this.startEffect), c = AmCharts[c](0, b.frame, b.previousValue, b.value - b.previousValue, this.totalFrames), isNaN(c) && (c = b.value));
        c = b.axis.value2angle(c);
        this.drawArrow(b, c)
    }
}});