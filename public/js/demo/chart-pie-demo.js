// Chart.js mặc định
Chart.defaults.global.defaultFontFamily = 'Nunito', 
    '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Biểu đồ nguồn truy cập (3 nguồn)
var ctx = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: ["Trực tiếp", "Mạng xã hội", "Công cụ tìm kiếm"],
    datasets: [{
      data: [45, 30, 25], // % giả định, bạn có thể thay số
      backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'], 
      hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: true,
      caretPadding: 10,
      callbacks: {
        label: function(tooltipItem, data) {
          var dataset = data.datasets[tooltipItem.datasetIndex];
          var value = dataset.data[tooltipItem.index];
          var label = data.labels[tooltipItem.index];
          return label + ': ' + value + '%';
        }
      }
    },
    legend: {
      display: false // tắt legend mặc định, dùng legend HTML custom của bạn
    },
    cutoutPercentage: 70,
  },
});
