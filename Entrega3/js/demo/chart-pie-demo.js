// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

$(document).ready(function(){			
	$.ajax({
		url: "/grupo61/bd/data_reg_personal.php",
		method: "GET", 
		success: function(data) {
			console.log(data);
			var slabels = [];
			var score = [];

			for(var i in data) {
				slabels.push(data[i].tipo_producto);
				score.push(data[i].TOTAL);				
			}

			// Pie Chart Example
			var ctx = document.getElementById("myPieChart");
			var myPieChart = new Chart(ctx, {
			  type: 'doughnut',
			  data: {
				labels: slabels, //["Direct", "Referral", "Social"],
				datasets: [{
				  data: score, //[55, 30, 15],
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
				  displayColors: false,
				  caretPadding: 10,
				},
				legend: {
				  display: true
				},
				cutoutPercentage: 80,
			  },
			});

			
		},
		error: function(data) {
		  console.log(data);
		}
	  });
});

