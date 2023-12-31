const randomChartData = (n) => {
  let data = [];

  for (let i = 0; i < n; i++) {
    data.push(Math.round(Math.random() * 200));
  }

  return data;
};

const chartColors = {
  default: {
    primary: "#00D1B2",
    info: "#209CEE",
    danger: "#FF3860",
  },
};

// Sent Mails Per Month Chart
const ctx = document.getElementById("big-line-chart")?.getContext("2d");

if(ctx){
  new Chart(ctx, {
    type: "line",
    data: {
      datasets: [
        {
          fill: false,
          borderColor: chartColors.default.primary,
          borderWidth: 2,
          borderDash: [],
          borderDashOffset: 0.0,
          pointBackgroundColor: chartColors.default.primary,
          pointBorderColor: "rgba(255,255,255,0)",
          pointHoverBackgroundColor: chartColors.default.primary,
          pointBorderWidth: 20,
          pointHoverRadius: 4,
          pointHoverBorderWidth: 15,
          pointRadius: 4,
          data: randomChartData(12),
        },
        // {
        //   fill: false,
        //   borderColor: chartColors.default.info,
        //   borderWidth: 2,
        //   borderDash: [],
        //   borderDashOffset: 0.0,
        //   pointBackgroundColor: chartColors.default.info,
        //   pointBorderColor: 'rgba(255,255,255,0)',
        //   pointHoverBackgroundColor: chartColors.default.info,
        //   pointBorderWidth: 20,
        //   pointHoverRadius: 4,
        //   pointHoverBorderWidth: 15,
        //   pointRadius: 4,
        //   data: randomChartData(9)
        // },
        // {
        //   fill: false,
        //   borderColor: chartColors.default.danger,
        //   borderWidth: 2,
        //   borderDash: [],
        //   borderDashOffset: 0.0,
        //   pointBackgroundColor: chartColors.default.danger,
        //   pointBorderColor: 'rgba(255,255,255,0)',
        //   pointHoverBackgroundColor: chartColors.default.danger,
        //   pointBorderWidth: 20,
        //   pointHoverRadius: 4,
        //   pointHoverBorderWidth: 15,
        //   pointRadius: 4,
        //   data: randomChartData(9)
        // }
      ],
      labels: [
        "Jan",
        "Feb",
        "Mar",
        "Apr",
        "May",
        "Jun",
        "Jul",
        "Aug",
        "Sep",
        "Oct",
        "Nov",
        "Dec",
      ],
    },
    options: {
      maintainAspectRatio: false,
      legend: {
        display: false,
      },
      responsive: true,
      tooltips: {
        backgroundColor: "#f5f5f5",
        titleFontColor: "#333",
        bodyFontColor: "#666",
        bodySpacing: 4,
        xPadding: 12,
        mode: "nearest",
        intersect: 0,
        position: "nearest",
      },
      scales: {
        yAxes: [
          {
            barPercentage: 1.6,
            gridLines: {
              drawBorder: false,
              color: "rgba(29,140,248,0.0)",
              zeroLineColor: "transparent",
            },
            ticks: {
              padding: 20,
              fontColor: "#9a9a9a",
            },
          },
        ],
  
        xAxes: [
          {
            barPercentage: 1.6,
            gridLines: {
              drawBorder: false,
              color: "rgba(225,78,202,0.1)",
              zeroLineColor: "transparent",
            },
            ticks: {
              padding: 20,
              fontColor: "#9a9a9a",
            },
          },
        ],
      },
    },
  });
}



// Campaign Charts
var options = {
  series: [
    {
      name: "Campaign Report",
      data: [50, 100, 150, 60, 70, 80],
    },
  ],
  chart: {
    type: "bar",
    height: 350,
  },
  plotOptions: {
    bar: {
      borderRadius: 4,
      horizontal: true,
      fill: {
        colors: chartColors.default.primary
      }
    },
  },
  dataLabels: {
    enabled: true,
  },
  xaxis: {
    categories: [
      "Recipients",
      "Delivered",
      "Click",
      "Unique Click",
      "Open",
      "Bounce",
    ],
  },
};

if(document.querySelector("#campaign-report-stats")){
  var campaignChart1 = new ApexCharts(
    document.querySelector("#campaign-report-stats"),
    options
  );
  campaignChart1.render();
}

// Single Campaign Charts
var options = {
  series: [
    {
      name: "Campaign Report",
      data: [80, 100, 150, 60, 70, 80],
    },
  ],
  chart: {
    type: "bar",
    height: 350,
  },
  plotOptions: {
    bar: {
      borderRadius: 4,
      horizontal: true,
      fill: {
        colors: chartColors.default.primary
      }
    },
  },
  dataLabels: {
    enabled: true,
  },
  xaxis: {
    categories: [
      "Recipients",
      "Delivered",
      "Click",
      "Unique Click",
      "Open",
      "Bounce",
    ],
  },
};

if(document.querySelector("#single-campaign-report-stats")){
  var campaignChart2 = new ApexCharts(
    document.querySelector("#single-campaign-report-stats"),
    options
  );
  
  campaignChart2.render();
}

// EMAIL
var options = {
  series: [80, 20],
  chart: {
    type: "donut",
  },
  labels: ["Sent Emails", "Available Emails"],
  dataLabels: {
    enabled: true,
  },
  plotOptions:{
    pie: {
      size: 600,
      donut: {
        size: '65%'
      }
    }
  },
  responsive: [
    {
      breakpoint: 480,
      options: {
        legend: {
          show: true,
        },
      },
      plotOptions:{
        size: 280 
      }
    },
  ],
  legend: {
    position: "right",
    offsetY: 0,
    height: 230,
  },
};

var chart = new ApexCharts(
  document.querySelector("#chart-emails-dashboard"),
  options
);
chart.render();