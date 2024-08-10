$(document).ready(function() {
    Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#292b2c';
    get_counters();
    GTI();
    Get_Request_Distribution();
    BALLISTIC();
    Get_Pending_Expenses_Distribution();
    GUNTECH();
    Get_Released_Expenses_Distribution();
    ELITE_ACES();
    Get_Request_Status_Distribution();
    SOTERIA();
    Pending_Request();
    PERSONAL();
});

function logout() {

    $(".loader").show();

    var audio = new Audio('src/sound/thankyou.mp3');

    audio.addEventListener('canplaythrough', function() {
        audio.play();
    });

    audio.addEventListener('ended', function() {
        window.location.href = './php/logout.php';
    });
    
}

function get_counters() {
    $.ajax({
        url: "./php/get_counters.php",
        method: "GET",
        success: function (data) {
            $('#users').html(data);
            var counter = data.split('@');
            $('#users').html(counter[0]);
            $('#request').html(counter[1]);
            $('#released').html(counter[2]);
            $('#pending').html(counter[3]);
        }
    });
}

function getDaysInMonth(year, month) {
    return new Date(year, month + 1, 0).getDate();
}

function generateMonthLabels() {
    var today = new Date();
    var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    var currentMonth = today.getMonth();
    var totalDaysInMonth = getDaysInMonth(today.getFullYear(), currentMonth);

    var labels = [];
    for (var i = 1; i <= today.getDate(); i++) {
        labels.push(monthNames[currentMonth] + " " + i);
    }

    return labels;
}

function GTI() {
    $.ajax({
        url: "./php/get_monthly_GTI.php",
        method: "GET",
        success: function (data) {
            Area_GTI(JSON.parse(data));
        }
    });
}

function Area_GTI(data) {
    var ctx = document.getElementById("Area_GTI");
    var myLineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: generateMonthLabels(),
            datasets: [{
                label: "Expenses",
                lineTension: 0.3,
                backgroundColor: "rgba(2,117,216,0.2)",
                borderColor: "rgba(2,117,216,1)",
                pointRadius: 5,
                pointBackgroundColor: "rgba(2,117,216,1)",
                pointBorderColor: "rgba(255,255,255,0.8)",
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(2,117,216,1)",
                pointHitRadius: 50,
                pointBorderWidth: 2,
                data: data.data,
            }],
        },
        options: {
            scales: {
                xAxes: [{
                    time: {
                        unit: 'date'
                    },
                    gridLines: {
                        display: false
                    },
                    ticks: {
                        maxTicksLimit: generateMonthLabels().length
                    }
                }],
                yAxes: [{
                    ticks: {
                        min: 0,
                        max: Math.max(...data.data),
                        maxTicksLimit: 5
                    },
                    gridLines: {
                        color: "rgba(0, 0, 0, .125)",
                    }
                }],
            },
            legend: {
                display: false
            }
        }
    });
}

function Get_Request_Distribution() {
    $.ajax({
        url: "./php/get_request_distribution.php",
        method: "GET",
        success: function (data) {
            data = data.split('@').map(Number);
            Request_Distribution(data);
        }
    });
}

function Request_Distribution(data) {
    var ctx = document.getElementById("Request_Distribution");
    var myPieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ["GTI", "BALLISTIC", "GUNTECH", "SOTERIA", "ELITE ACES", "PERSONAL", "OTHERS"],
            datasets: [{
                data: data,
                backgroundColor: ['#1E90FF', '#FF6347', '#7FFF00', '#FFA500', '#FF4500', '#6495ED'],
            }],
        },
    });
}

function BALLISTIC() {
    $.ajax({
        url: "./php/get_monthly_BALLISTIC.php",
        method: "GET",
        success: function (data) {
            Area_BALLISTIC(JSON.parse(data));
        }
    });
}

function Area_BALLISTIC(data) {
    var ctx = document.getElementById("Area_BALLISTIC");
    var myLineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: generateMonthLabels(),
            datasets: [{
                label: "Expenses",
                lineTension: 0.3,
                backgroundColor: "rgba(2,117,216,0.2)",
                borderColor: "rgba(2,117,216,1)",
                pointRadius: 5,
                pointBackgroundColor: "rgba(2,117,216,1)",
                pointBorderColor: "rgba(255,255,255,0.8)",
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(2,117,216,1)",
                pointHitRadius: 50,
                pointBorderWidth: 2,
                data: data.data,
            }],
        },
        options: {
            scales: {
                xAxes: [{
                    time: {
                        unit: 'date'
                    },
                    gridLines: {
                        display: false
                    },
                    ticks: {
                        maxTicksLimit: generateMonthLabels().length
                    }
                }],
                yAxes: [{
                    ticks: {
                        min: 0,
                        max: Math.max(...data.data),
                        maxTicksLimit: 5
                    },
                    gridLines: {
                        color: "rgba(0, 0, 0, .125)",
                    }
                }],
            },
            legend: {
                display: false
            }
        }
    });
}

function Get_Released_Expenses_Distribution() {
    $.ajax({
        url: "./php/get_released_expenses_distribution.php",
        method: "GET",
        success: function (data) {
            data = data.split('@').map(Number);
            Released_Expenses_Distribution(data);
        }
    });
}

function Released_Expenses_Distribution(data) {
    var ctx = document.getElementById("Released_Expenses_Distribution");
    var myPieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ["GTI", "BALLISTIC", "GUNTECH", "SOTERIA", "ELITE ACES", "PERSONAL", "OTHERS"],
            datasets: [{
                data: data,
                backgroundColor: ['#1E90FF', '#FF6347', '#7FFF00', '#FFA500', '#FF4500', '#6495ED'],
            }],
        },
    });
}

function GUNTECH() {
    $.ajax({
        url: "./php/get_monthly_GUNTECH.php",
        method: "GET",
        success: function (data) {
            Area_GUNTECH(JSON.parse(data));
        }
    });
}

function Area_GUNTECH(data) {
    var ctx = document.getElementById("Area_GUNTECH");
    var myLineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: generateMonthLabels(),
            datasets: [{
                label: "Expenses",
                lineTension: 0.3,
                backgroundColor: "rgba(2,117,216,0.2)",
                borderColor: "rgba(2,117,216,1)",
                pointRadius: 5,
                pointBackgroundColor: "rgba(2,117,216,1)",
                pointBorderColor: "rgba(255,255,255,0.8)",
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(2,117,216,1)",
                pointHitRadius: 50,
                pointBorderWidth: 2,
                data: data.data,
            }],
        },
        options: {
            scales: {
                xAxes: [{
                    time: {
                        unit: 'date'
                    },
                    gridLines: {
                        display: false
                    },
                    ticks: {
                        maxTicksLimit: generateMonthLabels().length
                    }
                }],
                yAxes: [{
                    ticks: {
                        min: 0,
                        max: Math.max(...data.data),
                        maxTicksLimit: 5
                    },
                    gridLines: {
                        color: "rgba(0, 0, 0, .125)",
                    }
                }],
            },
            legend: {
                display: false
            }
        }
    });
}

function Get_Pending_Expenses_Distribution() {
    $.ajax({
        url: "./php/get_pending_expenses_distribution.php",
        method: "GET",
        success: function (data) {
            data = data.split('@').map(Number);
            Pending_Expenses_Distribution(data);
        }
    });
}

function Pending_Expenses_Distribution(data) {
    var ctx = document.getElementById("Pending_Expenses_Distribution");
    var myPieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ["GTI", "BALLISTIC", "GUNTECH", "SOTERIA", "ELITE ACES", "PERSONAL", "OTHERS"],
            datasets: [{
                data: data,
                backgroundColor: ['#1E90FF', '#FF6347', '#7FFF00', '#FFA500', '#FF4500', '#6495ED'],
            }],
        },
    });
}

function SOTERIA() {
    $.ajax({
        url: "./php/get_monthly_SOTERIA.php",
        method: "GET",
        success: function (data) {
            Area_SOTERIA(JSON.parse(data));
        }
    });
}

function Area_SOTERIA(data) {
    var ctx = document.getElementById("Area_SOTERIA");
    var myLineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: generateMonthLabels(),
            datasets: [{
                label: "Expenses",
                lineTension: 0.3,
                backgroundColor: "rgba(2,117,216,0.2)",
                borderColor: "rgba(2,117,216,1)",
                pointRadius: 5,
                pointBackgroundColor: "rgba(2,117,216,1)",
                pointBorderColor: "rgba(255,255,255,0.8)",
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(2,117,216,1)",
                pointHitRadius: 50,
                pointBorderWidth: 2,
                data: data.data,
            }],
        },
        options: {
            scales: {
                xAxes: [{
                    time: {
                        unit: 'date'
                    },
                    gridLines: {
                        display: false
                    },
                    ticks: {
                        maxTicksLimit: generateMonthLabels().length
                    }
                }],
                yAxes: [{
                    ticks: {
                        min: 0,
                        max: Math.max(...data.data),
                        maxTicksLimit: 5
                    },
                    gridLines: {
                        color: "rgba(0, 0, 0, .125)",
                    }
                }],
            },
            legend: {
                display: false
            }
        }
    });
}

function Get_Request_Status_Distribution() {
    $.ajax({
        url: "./php/get_request_status_distribution.php",
        method: "GET",
        success: function (data) {
            data = data.split('@').map(Number);
            Request_Status_Distribution(data);
        }
    });
}

function Request_Status_Distribution(data) {
    var ctx = document.getElementById("Request_Status_Distribution");
    var myPieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ["PENDING", "TO RETURN", "HOLD", "TO PROCESS", "PROCESSING", "FOR FUNDING", "RELEASED"],
            datasets: [{
                data: data,
                backgroundColor: ['#1E90FF', '#FF6347', '#7FFF00', '#FFA500', '#FF4500', '#6495ED'],
            }],
        },
    });
}

function ELITE_ACES() {
    $.ajax({
        url: "./php/get_monthly_ELITE_ACES.php",
        method: "GET",
        success: function (data) {
            Area_ELITE_ACES(JSON.parse(data));
        }
    });
}

function Area_ELITE_ACES(data) {
    var ctx = document.getElementById("Area_ELITE_ACES");
    var myLineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: generateMonthLabels(),
            datasets: [{
                label: "Expenses",
                lineTension: 0.3,
                backgroundColor: "rgba(2,117,216,0.2)",
                borderColor: "rgba(2,117,216,1)",
                pointRadius: 5,
                pointBackgroundColor: "rgba(2,117,216,1)",
                pointBorderColor: "rgba(255,255,255,0.8)",
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(2,117,216,1)",
                pointHitRadius: 50,
                pointBorderWidth: 2,
                data: data.data,
            }],
        },
        options: {
            scales: {
                xAxes: [{
                    time: {
                        unit: 'date'
                    },
                    gridLines: {
                        display: false
                    },
                    ticks: {
                        maxTicksLimit: generateMonthLabels().length
                    }
                }],
                yAxes: [{
                    ticks: {
                        min: 0,
                        max: Math.max(...data.data),
                        maxTicksLimit: 5
                    },
                    gridLines: {
                        color: "rgba(0, 0, 0, .125)",
                    }
                }],
            },
            legend: {
                display: false
            }
        }
    });
}

function Pending_Request() {
    $.ajax({
        url: "./php/get_bar_request.php",
        method: "GET",
        success: function (data) {
            data = data.split(',').map(Number);
            Bar_Request(data);
        }
    });
}
function Bar_Request(data) {
    var max = Math.max.apply(null, data);
    var ctx = document.getElementById("Bar_Request");
    var myLineChart = new Chart(ctx, {
        type: 'bar',
        data: {
                labels: ["Book Keeper", "Accountant", "Finance", "Auditor"],
                datasets: [{
                    label: "Quantity",
                    backgroundColor: "rgba(2,117,216,1)",
                    borderColor: "rgba(2,117,216,1)",
                data: data,
                }],
        },
        options: {
            scales: {
                xAxes: [{
                    time: {
                        unit: 'month'
                    },
                    gridLines: {
                        display: false
                    },
                    ticks: {
                        maxTicksLimit: 6
                    }
                }],
                yAxes: [{
                    ticks: {
                        min: 0,
                        max: max,
                        maxTicksLimit: 5
                    },
                    gridLines: {
                        display: true
                    }
                }],
            },
            legend: {
                display: false
            }
        }
    });
}

function PERSONAL() {
    $.ajax({
        url: "./php/get_monthly_PERSONAL.php",
        method: "GET",
        success: function (data) {
            Area_PERSONAL(JSON.parse(data));
        }
    });
}

function Area_PERSONAL(data) {
    var ctx = document.getElementById("Area_PERSONAL");
    var myLineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: generateMonthLabels(),
            datasets: [{
                label: "Expenses",
                lineTension: 0.3,
                backgroundColor: "rgba(2,117,216,0.2)",
                borderColor: "rgba(2,117,216,1)",
                pointRadius: 5,
                pointBackgroundColor: "rgba(2,117,216,1)",
                pointBorderColor: "rgba(255,255,255,0.8)",
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(2,117,216,1)",
                pointHitRadius: 50,
                pointBorderWidth: 2,
                data: data.data,
            }],
        },
        options: {
            scales: {
                xAxes: [{
                    time: {
                        unit: 'date'
                    },
                    gridLines: {
                        display: false
                    },
                    ticks: {
                        maxTicksLimit: generateMonthLabels().length
                    }
                }],
                yAxes: [{
                    ticks: {
                        min: 0,
                        max: Math.max(...data.data),
                        maxTicksLimit: 5
                    },
                    gridLines: {
                        color: "rgba(0, 0, 0, .125)",
                    }
                }],
            },
            legend: {
                display: false
            }
        }
    });
}