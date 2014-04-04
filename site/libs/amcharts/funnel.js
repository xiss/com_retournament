AmCharts.AmFunnelChart = AmCharts.Class({inherits: AmCharts.AmSlicedChart, construct: function (s) {
    this.type = "funnel";
    AmCharts.AmFunnelChart.base.construct.call(this, s);
    this.cname = "AmFunnelChart";
    this.startX = this.startY = 0;
    this.baseWidth = "100%";
    this.neckHeight = this.neckWidth = 0;
    this.rotate = !1;
    this.valueRepresents = "height";
    this.pullDistance = 30;
    this.labelPosition = "center";
    this.labelText = "[[title]]: [[value]]";
    this.balloonText = "[[title]]: [[value]]\n[[description]]";
    AmCharts.applyTheme(this, s, this.cname)
}, drawChart: function () {
    AmCharts.AmFunnelChart.base.drawChart.call(this);
    var s = this.chartData;
    if (AmCharts.ifArray(s))if (0 < this.realWidth && 0 < this.realHeight) {
        var t = this.container, B = this.startDuration, k = this.rotate, w = this.updateWidth();
        this.realWidth = w;
        var f = this.updateHeight();
        this.realHeight = f;
        var m = AmCharts.toCoordinate, A = m(this.marginLeft, w), v = m(this.marginRight, w), a = m(this.marginTop, f) + this.getTitleHeight(), m = m(this.marginBottom, f), v = w - A - v, x = AmCharts.toCoordinate(this.baseWidth, v), n = AmCharts.toCoordinate(this.neckWidth, v), C = f - m - a, y = AmCharts.toCoordinate(this.neckHeight,
            C), p = a + C - y;
        k && (a = f - m, p = a - C + y);
        this.firstSliceY = a;
        AmCharts.VML && (this.startAlpha = 1);
        for (var g = v / 2 + A, D = (C - y) / ((x - n) / 2), z = x / 2, x = (C - y) * (x + n) / 2 + n * y, y = a, F = 0, E = 0; E < s.length; E++) {
            var c = s[E], d;
            if (!0 !== c.hidden) {
                var q = [], h = [], b;
                if ("height" == this.valueRepresents)b = C * c.percents / 100; else {
                    var l = -x * c.percents / 100 / 2, u = z;
                    d = -1 / (2 * D);
                    b = Math.pow(u, 2) - 4 * d * l;
                    0 > b && (b = 0);
                    b = (Math.sqrt(b) - u) / (2 * d);
                    if (!k && a >= p || k && a <= p)b = 2 * -l / n; else if (!k && a + b > p || k && a - b < p)d = k ? Math.round(b + (a - b - p)) : Math.round(b - (a + b - p)), b = d / D, b = d + 2 * (-l - (u - b /
                        2) * d) / n
                }
                l = z - b / D;
                d = !1;
                !k && a + b > p || k && a - b < p ? (l = n / 2, q.push(g - z, g + z, g + l, g + l, g - l, g - l), k ? (d = b + (a - b - p), a < p && (d = 0), h.push(a, a, a - d, a - b, a - b, a - d, a)) : (d = b - (a + b - p), a > p && (d = 0), h.push(a, a, a + d, a + b, a + b, a + d, a)), d = !0) : (q.push(g - z, g + z, g + l, g - l), k ? h.push(a, a, a - b, a - b) : h.push(a, a, a + b, a + b));
                t.set();
                u = t.set();
                q = AmCharts.polygon(t, q, h, c.color, c.alpha, this.outlineThickness, this.outlineColor, this.outlineAlpha);
                u.push(q);
                this.graphsSet.push(u);
                c.wedge = u;
                c.index = E;
                if (h = this.gradientRatio) {
                    var r = [], e;
                    for (e = 0; e < h.length; e++)r.push(AmCharts.adjustLuminosity(c.color,
                        h[e]));
                    0 < r.length && q.gradient("linearGradient", r);
                    c.pattern && q.pattern(c.pattern)
                }
                0 < B && (this.chartCreated || u.setAttr("opacity", this.startAlpha));
                this.addEventListeners(u, c);
                c.ty0 = a - b / 2;
                this.labelsEnabled && this.labelText && c.percents >= this.hideLabelsPercent && (h = this.formatString(this.labelText, c), r = c.labelColor, r || (r = this.color), q = this.labelPosition, e = "left", "center" == q && (e = "middle"), "left" == q && (e = "right"), h = AmCharts.text(t, h, r, this.fontFamily, this.fontSize, e), u.push(h), r = g, k ? (e = a - b / 2, c.ty0 = e) : (e = a +
                    b / 2, c.ty0 = e, e < y + F + 5 && (e = y + F + 5), e > f - m && (e = f - m)), "right" == q && (r = v + 10 + A, c.tx0 = g + (z - b / 2 / D), d && (c.tx0 = g + l)), "left" == q && (c.tx0 = g - (z - b / 2 / D), d && (c.tx0 = g - l), r = A), c.label = h, c.labelX = r, c.labelY = e, c.labelHeight = h.getBBox().height, h.translate(r, e), F = h.getBBox().height, y = e);
                (0 === c.alpha || 0 < B && !this.chartCreated) && u.hide();
                a = k ? a - b : a + b;
                z = l;
                c.startX = AmCharts.toCoordinate(this.startX, w);
                c.startY = AmCharts.toCoordinate(this.startY, f);
                c.pullX = AmCharts.toCoordinate(this.pullDistance, w);
                c.pullY = 0;
                c.balloonX = g;
                c.balloonY =
                    c.ty0
            }
        }
        this.arrangeLabels();
        this.initialStart();
        (s = this.legend) && s.invalidateSize()
    } else this.cleanChart();
    this.dispDUpd();
    this.chartCreated = !0
}, arrangeLabels: function () {
    var s = this.rotate, t;
    t = s ? 0 : this.realHeight;
    for (var B = 0, k = this.chartData, w = k.length, f, m = 0; m < w; m++) {
        f = k[w - m - 1];
        var A = f.label, v = f.labelY, a = f.labelX, x = f.labelHeight, n = v;
        s ? t + B + 5 > v && (n = t + B + 5) : v + x + 5 > t && (n = t - 5 - x);
        t = n;
        B = x;
        A && A.translate(a, n);
        f.labelY = n;
        f.tx = a;
        f.ty = n;
        f.tx2 = a
    }
    "center" != this.labelPosition && this.drawTicks()
}});