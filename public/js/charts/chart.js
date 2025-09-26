(function (modules) {
    var installedModules = {};

    function __webpack_require__(moduleId) {
        if (installedModules[moduleId]) {
            return installedModules[moduleId].exports;
        }

        var module = installedModules[moduleId] = {
            i: moduleId,
            l: false,
            exports: {}
        };

        modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
        module.l = true;

        return module.exports;
    }

    __webpack_require__.m = modules;
    __webpack_require__.c = installedModules;

    __webpack_require__.d = function (exports, name, getter) {
        if (!__webpack_require__.o(exports, name)) {
            Object.defineProperty(exports, name, { enumerable: true, get: getter });
        }
    };

    __webpack_require__.r = function (exports) {
        if (typeof Symbol !== "undefined" && Symbol.toStringTag) {
            Object.defineProperty(exports, Symbol.toStringTag, { value: "Module" });
        }
        Object.defineProperty(exports, "__esModule", { value: true });
    };

    __webpack_require__.t = function (value, mode) {
        if (mode & 1) value = __webpack_require__(value);
        if (mode & 8) return value;
        if (mode & 4 && typeof value === "object" && value && value.__esModule) return value;

        var ns = Object.create(null);
        __webpack_require__.r(ns);

        Object.defineProperty(ns, "default", { enumerable: true, value: value });

        if (mode & 2 && typeof value != "string") {
            for (var key in value) {
                __webpack_require__.d(ns, key, function (key) {
                    return value[key];
                }.bind(null, key));
            }
        }

        return ns;
    };

    __webpack_require__.n = function (module) {
        var getter = module && module.__esModule
            ? function () { return module.default; }
            : function () { return module; };

        __webpack_require__.d(getter, "a", getter);
        return getter;
    };

    __webpack_require__.o = function (object, property) {
        return Object.prototype.hasOwnProperty.call(object, property);
    };

    __webpack_require__.p = "";

    return __webpack_require__(__webpack_require__.s = 4);
})
({
    4: function (module, exports, __webpack_require__) {
        module.exports = __webpack_require__(5);
    },

    5: function (module, exports) {

        function defineProperties(target, props) {
            for (var i = 0; i < props.length; i++) {
                var descriptor = props[i];
                descriptor.enumerable = descriptor.enumerable || false;
                descriptor.configurable = true;

                if ("value" in descriptor) descriptor.writable = true;

                Object.defineProperty(target, descriptor.key, descriptor);
            }
        }

        var AppCharts = (function () {
            function AppCharts() {
                if (!(this instanceof AppCharts)) {
                    throw new TypeError("Cannot call a class as a function");
                }
            }

            var protoProps, staticProps;

            staticProps = [
                {
                    key: "initRandomEasyPieChart",
                    value: function () {
                        jQuery(".js-pie-randomize").on("click", function (e) {
                            jQuery(e.currentTarget).parents(".block").find(".pie-chart").each(function (i, el) {
                                jQuery(el).data("easyPieChart").update(Math.floor(Math.random() * 100 + 1));
                            });
                        });
                    }
                },

                {
                    key: "initChartsSparkline",
                    value: function () {
                        var line1 = jQuery(".js-slc-line1"),
                            line2 = jQuery(".js-slc-line2"),
                            line3 = jQuery(".js-slc-line3"),
                            bar1 = jQuery(".js-slc-bar1"),
                            bar2 = jQuery(".js-slc-bar2"),
                            bar3 = jQuery(".js-slc-bar3"),
                            pie1 = jQuery(".js-slc-pie1"),
                            pie2 = jQuery(".js-slc-pie2"),
                            pie3 = jQuery(".js-slc-pie3"),
                            tri1 = jQuery(".js-slc-tristate1"),
                            tri2 = jQuery(".js-slc-tristate2"),
                            tri3 = jQuery(".js-slc-tristate3");

                        var lineCfg = {
                            type: "line",
                            width: "120px",
                            height: "80px",
                            tooltipOffsetX: -25,
                            tooltipOffsetY: 20,
                            lineColor: "#ffca28",
                            fillColor: "#ffca28",
                            spotColor: "#555",
                            minSpotColor: "#555",
                            maxSpotColor: "#555",
                            highlightSpotColor: "#555",
                            highlightLineColor: "#555",
                            spotRadius: 2,
                            tooltipPrefix: "",
                            tooltipSuffix: " Tickets",
                            tooltipFormat: "{{prefix}}{{y}}{{suffix}}"
                        };

                        line1.length && line1.sparkline("html", lineCfg);

                        lineCfg.lineColor = "#9ccc65";
                        lineCfg.fillColor = "#9ccc65";
                        lineCfg.tooltipPrefix = "$ ";
                        lineCfg.tooltipSuffix = "";
                        line2.length && line2.sparkline("html", lineCfg);

                        lineCfg.lineColor = "#42a5f5";
                        lineCfg.fillColor = "#42a5f5";
                        lineCfg.tooltipPrefix = "";
                        lineCfg.tooltipSuffix = " Sales";
                        line3.length && line3.sparkline("html", lineCfg);

                        var barCfg = {
                            type: "bar",
                            barWidth: 8,
                            barSpacing: 6,
                            height: "80px",
                            barColor: "#ffca28",
                            tooltipPrefix: "",
                            tooltipSuffix: " Tickets",
                            tooltipFormat: "{{prefix}}{{value}}{{suffix}}"
                        };

                        bar1.length && bar1.sparkline("html", barCfg);

                        barCfg.barColor = "#9ccc65";
                        barCfg.tooltipPrefix = "$ ";
                        barCfg.tooltipSuffix = "";
                        bar2.length && bar2.sparkline("html", barCfg);

                        barCfg.barColor = "#42a5f5";
                        barCfg.tooltipPrefix = "";
                        barCfg.tooltipSuffix = " Sales";
                        bar3.length && bar3.sparkline("html", barCfg);

                        var pieCfg = {
                            type: "pie",
                            width: "80px",
                            height: "80px",
                            sliceColors: ["#ffca28", "#9ccc65", "#42a5f5", "#ef5350"],
                            highlightLighten: 1.1,
                            tooltipPrefix: "",
                            tooltipSuffix: " Tickets",
                            tooltipFormat: "{{prefix}}{{value}}{{suffix}}"
                        };

                        pie1.length && pie1.sparkline("html", pieCfg);

                        pieCfg.tooltipPrefix = "$ ";
                        pieCfg.tooltipSuffix = "";
                        pie2.length && pie2.sparkline("html", pieCfg);

                        pieCfg.tooltipPrefix = "";
                        pieCfg.tooltipSuffix = " Sales";
                        pie3.length && pie3.sparkline("html", pieCfg);

                        var triCfg = {
                            type: "tristate",
                            barWidth: 8,
                            barSpacing: 6,
                            height: "110px",
                            posBarColor: "#9ccc65",
                            negBarColor: "#ef5350"
                        };

                        tri1.length && tri1.sparkline("html", triCfg);
                        tri2.length && tri2.sparkline("html", triCfg);
                        tri3.length && tri3.sparkline("html", triCfg);
                    }
                },

                {
                    key: "initChartsChartJS",
                    value: function () {
                        Chart.defaults.global.defaultFontColor = "#555555";
                        Chart.defaults.scale.gridLines.color = "rgba(0,0,0,.04)";
                        Chart.defaults.scale.gridLines.zeroLineColor = "rgba(0,0,0,.1)";
                        Chart.defaults.scale.ticks.beginAtZero = true;
                        Chart.defaults.global.elements.line.borderWidth = 2;
                        Chart.defaults.global.elements.point.radius = 5;
                        Chart.defaults.global.elements.point.hoverRadius = 7;
                        Chart.defaults.global.tooltips.cornerRadius = 3;
                        Chart.defaults.global.legend.labels.boxWidth = 12;

                        var chartLines = jQuery(".js-chartjs-lines"),
                            chartBars = jQuery(".js-chartjs-bars"),
                            chartRadar = jQuery(".js-chartjs-radar"),
                            chartPolar = jQuery(".js-chartjs-polar"),
                            chartPie = jQuery(".js-chartjs-pie"),
                            chartDonut = jQuery(".js-chartjs-donut");

                        var lineData = {
                            labels: ["MON", "TUE", "WED", "THU", "FRI", "SAT", "SUN"],
                            datasets: [
                                {
                                    label: "This Week",
                                    fill: true,
                                    backgroundColor: "rgba(66,165,245,.75)",
                                    borderColor: "rgba(66,165,245,1)",
                                    pointBackgroundColor: "rgba(66,165,245,1)",
                                    pointBorderColor: "#fff",
                                    pointHoverBackgroundColor: "#fff",
                                    pointHoverBorderColor: "rgba(66,165,245,1)",
                                    data: [25, 38, 62, 45, 90, 115, 130]
                                },
                                {
                                    label: "Last Week",
                                    fill: true,
                                    backgroundColor: "rgba(66,165,245,.25)",
                                    borderColor: "rgba(66,165,245,1)",
                                    pointBackgroundColor: "rgba(66,165,245,1)",
                                    pointBorderColor: "#fff",
                                    pointHoverBackgroundColor: "#fff",
                                    pointHoverBorderColor: "rgba(66,165,245,1)",
                                    data: [112, 90, 142, 130, 170, 188, 196]
                                }
                            ]
                        };

                        var pieData = {
                            labels: ["Earnings", "Sales", "Tickets"],
                            datasets: [
                                {
                                    data: [50, 25, 25],
                                    backgroundColor: [
                                        "rgba(156,204,101,1)",
                                        "rgba(255,202,40,1)",
                                        "rgba(239,83,80,1)"
                                    ],
                                    hoverBackgroundColor: [
                                        "rgba(156,204,101,.5)",
                                        "rgba(255,202,40,.5)",
                                        "rgba(239,83,80,.5)"
                                    ]
                                }
                            ]
                        };

                        chartLines.length && new Chart(chartLines, { type: "line", data: lineData });
                        chartBars.length && new Chart(chartBars, { type: "bar", data: lineData });
                        chartRadar.length && new Chart(chartRadar, { type: "radar", data: lineData });
                        chartPolar.length && new Chart(chartPolar, { type: "polarArea", data: pieData });
                        chartPie.length && new Chart(chartPie, { type: "pie", data: pieData });
                        chartDonut.length && new Chart(chartDonut, { type: "doughnut", data: pieData });
                    }
                },

                {
                    key: "initChartsFlot",
                    value: function () {
                        var live = jQuery(".js-flot-live"),
                            lines = jQuery(".js-flot-lines"),
                            stacked = jQuery(".js-flot-stacked"),
                            pie = jQuery(".js-flot-pie"),
                            bars = jQuery(".js-flot-bars");

                        var earnings = [
                                [1, 1500], [2, 1700], [3, 1400], [4, 1900], [5, 2500], [6, 2300],
                                [7, 2700], [8, 3200], [9, 3500], [10, 3260], [11, 4100], [12, 4600]
                            ],
                            sales = [
                                [1, 500], [2, 600], [3, 400], [4, 750], [5, 1150], [6, 950],
                                [7, 1400], [8, 1700], [9, 1800], [10, 1300], [11, 1750], [12, 2900]
                            ],
                            months = [
                                [1, "Jan"], [2, "Feb"], [3, "Mar"], [4, "Apr"], [5, "May"], [6, "Jun"],
                                [7, "Jul"], [8, "Aug"], [9, "Sep"], [10, "Oct"], [11, "Nov"], [12, "Dec"]
                            ];

                        var data = [], updateInterval = 0;

                        function getRandomData() {
                            if (data.length > 0) {
                                data = data.slice(1);
                            }

                            while (data.length < 300) {
                                var prev = data.length > 0 ? data[data.length - 1] : 50;
                                var y = prev + Math.random() * 10 - 5;
                                if (y < 0) y = 0;
                                if (y > 100) y = 100;
                                data.push(y);
                            }

                            var res = [];
                            for (var i = 0; i < data.length; ++i) {
                                res.push([i, data[i]]);
                            }

                            jQuery(".js-flot-live-info").html(updateInterval.toFixed(0) + "%");
                            return res;
                        }

                        if (live.length) {
                            var plot = jQuery.plot(live, [{ data: getRandomData() }], {
                                series: { shadowSize: 0 },
                                lines: {
                                    show: true,
                                    lineWidth: 1,
                                    fill: true,
                                    fillColor: { colors: [{ opacity: 1 }, { opacity: 0.5 }] }
                                },
                                colors: ["#42a5f5"],
                                grid: { borderWidth: 0, color: "#cccccc" },
                                yaxis: { show: true, min: 0, max: 100 },
                                xaxis: { show: false }
                            });

                            (function update() {
                                plot.setData([getRandomData()]);
                                plot.draw();
                                setTimeout(update, 100);
                            })();
                        }

                        if (lines.length) {
                            jQuery.plot(lines, [
                                {
                                    label: "Earnings",
                                    data: earnings,
                                    lines: {
                                        show: true,
                                        fill: true,
                                        fillColor: { colors: [{ opacity: 0.7 }, { opacity: 0.7 }] }
                                    },
                                    points: { show: true, radius: 5 }
                                },
                                {
                                    label: "Sales",
                                    data: sales,
                                    lines: {
                                        show: true,
                                        fill: true,
                                        fillColor: { colors: [{ opacity: 0.5 }, { opacity: 0.5 }] }
                                    },
                                    points: { show: true, radius: 5 }
                                }
                            ], {
                                colors: ["#ffca28", "#555555"],
                                legend: { show: true, position: "nw", backgroundOpacity: 0 },
                                grid: { borderWidth: 0, hoverable: true, clickable: true },
                                yaxis: { tickColor: "#ffffff", ticks: 3 },
                                xaxis: { ticks: months, tickColor: "#f5f5f5" }
                            });

                            var prevIndex = null, tooltip = null;
                            lines.bind("plothover", function (event, pos, item) {
                                if (item) {
                                    if (prevIndex !== item.dataIndex) {
                                        prevIndex = item.dataIndex;
                                        jQuery(".js-flot-tooltip").remove();

                                        var y = item.datapoint[1];
                                        tooltip =
                                            item.seriesIndex === 0 ? "$ <strong>" + y + "</strong>" :
                                            item.seriesIndex === 1 ? "<strong>" + y + "</strong> sales" :
                                            "<strong>" + y + "</strong> tickets";

                                        jQuery('<div class="js-flot-tooltip flot-tooltip">' + tooltip + "</div>")
                                            .css({ top: item.pageY - 45, left: item.pageX + 5 })
                                            .appendTo("body")
                                            .show();
                                    }
                                } else {
                                    jQuery(".js-flot-tooltip").remove();
                                    prevIndex = null;
                                }
                            });
                        }

                        stacked.length && jQuery.plot(stacked, [
                            { label: "Sales", data: sales },
                            { label: "Earnings", data: earnings }
                        ], {
                            colors: ["#555555", "#26c6da"],
                            series: { stack: true, lines: { show: true, fill: true } },
                            lines: {
                                show: true,
                                lineWidth: 0,
                                fill: true,
                                fillColor: { colors: [{ opacity: 1 }, { opacity: 1 }] }
                            },
                            legend: { show: true, position: "nw", sorted: true, backgroundOpacity: 0 },
                            grid: { borderWidth: 0 },
                            yaxis: { tickColor: "#ffffff", ticks: 3 },
                            xaxis: { ticks: months, tickColor: "#f5f5f5" }
                        });

                        bars.length && jQuery.plot(bars, [
                            {
                                label: "Sales Before Release",
                                data: [
                                    [1, 500], [4, 600], [7, 1000], [10, 600],
                                    [13, 800], [16, 1200], [19, 1500], [22, 1600],
                                    [25, 2500], [28, 2700], [31, 3500], [34, 4500]
                                ],
                                bars: {
                                    show: true,
                                    lineWidth: 0,
                                    fillColor: { colors: [{ opacity: 0.75 }, { opacity: 0.75 }] }
                                }
                            },
                            {
                                label: "Sales After Release",
                                data: [
                                    [2, 900], [5, 1200], [8, 2000], [11, 1200],
                                    [14, 1600], [17, 2400], [20, 3000], [23, 3200],
                                    [26, 5000], [29, 5400], [32, 7000], [35, 9000]
                                ],
                                bars: {
                                    show: true,
                                    lineWidth: 0,
                                    fillColor: { colors: [{ opacity: 0.75 }, { opacity: 0.75 }]
