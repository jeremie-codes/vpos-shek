document.addEventListener("DOMContentLoaded", function (e) {
  let a, o, s, r;
  (a = config.colors.textMuted),
    (o = config.colors.headingColor),
    (s = config.colors.borderColor),
    (r = config.fontFamily),
    config.colors.bodyColor;
    var t = {
      donut: {
        series1:
          "color-mix(in sRGB, " + config.colors.success + " 80%, " + config.colors.black + ")",
        series2: "color-mix(in sRGB, " + config.colors.success + " 90%, " + config.colors.black + ")",
        series3: config.colors.success,
        series4: "color-mix(in sRGB, " + config.colors.success + " 80%, " + config.colors.cardColor + ")",
        series5: "color-mix(in sRGB, " + config.colors.success + " 60%, " + config.colors.cardColor + ")", series6: "color-mix(in sRGB, " + config.colors.success + " 40%, " + config.colors.cardColor + ")",
      },
    },
    n = document.querySelector("#leadsReportChart"),
    t = {
      chart: { height: 170, width: 150, parentHeightOffset: 0, type: "donut" },
      labels: ["36h", "56h", "16h", "32h", "56h", "16h"],
      series: [23, 35, 10, 20, 35, 23],
      colors: [
        t.donut.series1,
        t.donut.series2,
        t.donut.series3,
        t.donut.series4,
        t.donut.series5,
        t.donut.series6,
      ],
      stroke: { width: 0 },
      dataLabels: {
        enabled: !1,
        formatter: function (e, a) {
          return parseInt(e) + "%";
        },
      },
      legend: { show: !1 },
      tooltip: { theme: !1 },
      grid: { padding: { top: 0 } },
      states: {
        hover: { filter: { type: "none" } },
        active: { filter: { type: "none" } },
      },
      plotOptions: {
        pie: {
          donut: {
            size: "70%",
            labels: {
              show: !0,
              value: {
                fontSize: "1.125rem",
                fontFamily: r,
                color: o,
                fontWeight: 500,
                offsetY: -20,
                formatter: function (e) {
                  return parseInt(e) + "%";
                },
              },
              name: { offsetY: 20, fontFamily: r },
              total: {
                show: !0,
                fontSize: ".9375rem",
                fontFamily: r,
                label: "Total",
                color: a,
                formatter: function (e) {
                  return "0%";
                },
              },
            },
          },
        },
      },
    };
  null !== n && new ApexCharts(n, t).render();
});