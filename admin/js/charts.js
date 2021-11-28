(function($) {
    "use strict"

    var lineChartDiv = document.getElementById("lineChart");
    lineChartDiv.height = 150;
    var lineChart = new Chart(lineChartDiv, {
        type: 'line',
        data: {
            labels: ["a", "b"],
            datasets: [{
                    label: "Total Products Ordered",
                    borderColor: "rgba(47, 98, 243, 0.9)",
                    borderWidth: "1",
                    backgroundColor: "rgba(47, 98, 243, 0.7)",
                    data: [1, 2]
                },
                {
                    label: "Total Orders Placed",
                    borderColor: "rgba(45, 244, 39, 0.7)",
                    borderWidth: "1",
                    backgroundColor: "rgba(45, 244, 39, 0.9)",
                    pointHighlightStroke: "rgba(45, 244, 39, 0.7)",
                    data: [1, 2]
                }
            ]
        },
        options: {
            responsive: true,
            tooltips: {
                mode: 'index',
                intersect: false
            },
            hover: {
                mode: 'nearest',
                intersect: true
            }

        }
    });

    getLineChart("Week", lineChart);
    $(".date-cards span").on("click", function(e) {
        let elementid = $(this).attr("id");
        if ($("#" + elementid).hasClass("active")) {
            return;
        } else {
            $(".date-cards span").removeClass("active");
            $("#" + elementid).addClass("active");
        }
        let filterCard = elementid.split("orderProduct")[1];
        getLineChart(filterCard, lineChart);
    });
    //line chart    

    function getLineChart(SortBy, lineChart) {
        var labels = [];
        var ProductsOrdered = [];
        var OrdersPlaced = [];

        var data = { "datafor": "LineChart", "sortby": SortBy };
        $.ajax({
            url: "database/getChartData.php",
            method: "POST",
            cache: "false",
            data: data,
            success: function(result) {
                var dataforchart = JSON.parse(result);
                for (const info in dataforchart) {
                    if (!dataforchart.hasOwnProperty(info)) {
                        continue;
                    }
                    labels.push(info);
                    ProductsOrdered.push(dataforchart[info][1]);
                    OrdersPlaced.push(dataforchart[info][0]);
                }

                lineChart.data.labels = labels;
                lineChart.data.datasets[0].data = ProductsOrdered;
                lineChart.data.datasets[1].data = OrdersPlaced;
                lineChart.update();
            }
        });
    }

    //
    //pie chart
    var pieChartDiv = document.getElementById("pieChart");
    pieChartDiv.height = 150;
    var pieChart = new Chart(pieChartDiv, {
        type: 'pie',
        data: {
            datasets: [{
                data: [1, 2, 3, 4, 5],
                backgroundColor: [
                    "#F66D44",
                    "#FEAE65",
                    "#E6F69D",
                    "#AADEA7",
                    "#64C2A6"
                ],
                hoverBackgroundColor: [
                    "#003f5c",
                    "#58508d",
                    "#bc5090",
                    "#ff6361",
                    "#ffa600"
                ]

            }],
            labels: [
                "a",
                "b",
                "c",
                "d",
                "e"
            ]
        },
        options: {
            responsive: true
        }

    });
    getPieChartData("PieChart", pieChart);

    function getPieChartData(datafor, pieChart) {
        var labels = [];
        var piedata = [];
        var data = { "datafor": datafor };
        $.ajax({
            url: "database/getChartData.php",
            method: "POST",
            cache: "false",
            data: data,
            success: function(result) {
                var dataforchart = JSON.parse(result);
                for (const info in dataforchart) {
                    if (!dataforchart.hasOwnProperty(info)) {
                        continue;
                    }
                    labels.push(dataforchart[info][0]);
                    piedata.push(dataforchart[info][1]);
                }

                pieChart.data.labels = labels;
                pieChart.data.datasets[0].data = piedata;
                pieChart.update();
            }
        });
    }

    var pieChartDiv1 = document.getElementById("pieChart1");
    pieChartDiv1.height = 150;
    var pieChart1 = new Chart(pieChartDiv1, {
        type: 'pie',
        data: {
            datasets: [{
                data: [1, 2, 3, 4, 5],
                backgroundColor: [
                    "#003f5c",
                    "#58508d",
                    "#bc5090",
                    "#ff6361",
                    "#ffa600"
                ],
                hoverBackgroundColor: [
                    "#F66D44",
                    "#FEAE65",
                    "#E6F69D",
                    "#AADEA7",
                    "#64C2A6"
                ]

            }],
            labels: [
                "a",
                "b",
                "c",
                "d",
                "e"
            ]
        },
        options: {
            responsive: true,
        }
    });
    getPieChartData("PieChart1", pieChart1);


})(jQuery);