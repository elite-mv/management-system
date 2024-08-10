$(function() {
    Fill_Pending();
    Fill_Managed();
    Fill_All_Request();
    Entity();
    $.ajax({
        url: "./php/get_total_pending.php",
        method: "GET",
        data: {
            search: ''
        },
        success: function (data) {
            $("#pending_total").html(data);
        }
    });
    $.ajax({
        url: "./php/get_total_managed.php",
        method: "GET",
        data: {
            search: ''
        },
        success: function (data) {
            $("#managed_total").html(data);
        }
    });
    $.ajax({
        url: "./php/get_total_all.php",
        method: "GET",
        data: {
            search: ''
        },
        success: function (data) {
            $("#all_total").html(data);
        }
    });
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

function Entity() {
    $.ajax({
        url: "./php/get_filter_entity.php",
        method: "GET",
        success: function (data) {
            data = data.trim();
            $("select[name='pending_entity']").html(data);
            $("select[name='managed_entity']").html(data);
            $("select[name='all_entity']").html(data);
        }
    });
}

function Fill_Pending() {
    $.ajax({
        url: "./php/get_fin_pending.php",
        method: "GET",
        success: function (data) {
            data = data.trim();
            $("#pending_request").html(data);
            
            const datatablesSimple = document.getElementById('pending_request');
            if (datatablesSimple) {

                datatablesSimple.SimpleDataTable = new simpleDatatables.DataTable(datatablesSimple);
                
                const columnWidths = ['15%', '15%', '10%', '16%', '11%', '11%', '12%'];
                const headers = datatablesSimple.querySelectorAll('th');

                headers.forEach((header, index) => {
                    header.style.width = columnWidths[index];
                    if (header.textContent.trim() === 'REFERENCE' ||
                        header.textContent.trim() === 'DURATION' ||
                        header.textContent.trim() === 'ENTITY' ||
                        header.textContent.trim() === 'REQUESTED BY' ||
                        header.textContent.trim() === 'STATUS' ||
                        header.textContent.trim() === 'TOTAL' ||
                        header.textContent.trim() === 'ACTION') {
                        header.style.fontWeight = 'bold';
                    } else {
                        header.style.fontWeight = 'normal';
                    }
                });

                $("select[name='pending_entity']").on('change', function() {
                    datatablesSimple.SimpleDataTable.search($(this).val());
                    $.ajax({
                        url: "./php/get_total_pending.php",
                        method: "GET",
                        data: {
                            search: $(this).val()
                        },
                        success: function (data) {
                            $("#pending_total").html(data);
                        }
                    });
                })

            }
        }
    });
}

function Fill_Managed() {
    $.ajax({
        url: "./php/get_fin_managed.php",
        method: "GET",
        success: function (data) {
            data = data.trim();
            $("#managed_request").html(data);
            
            const datatablesSimple = document.getElementById('managed_request');
            if (datatablesSimple) {

                datatablesSimple.SimpleDataTable = new simpleDatatables.DataTable(datatablesSimple);
                
                const columnWidths = ['15%', '15%', '10%', '16%', '11%', '11%', '12%'];
                const headers = datatablesSimple.querySelectorAll('th');

                headers.forEach((header, index) => {
                    header.style.width = columnWidths[index];
                    if (header.textContent.trim() === 'REFERENCE' ||
                        header.textContent.trim() === 'DURATION' ||
                        header.textContent.trim() === 'ENTITY' ||
                        header.textContent.trim() === 'REQUESTED BY' ||
                        header.textContent.trim() === 'STATUS' ||
                        header.textContent.trim() === 'TOTAL' ||
                        header.textContent.trim() === 'ACTION') {
                        header.style.fontWeight = 'bold';
                    } else {
                        header.style.fontWeight = 'normal';
                    }
                });

                $("select[name='managed_entity']").on('change', function() {
                    datatablesSimple.SimpleDataTable.search($(this).val());
                    $.ajax({
                        url: "./php/get_total_managed.php",
                        method: "GET",
                        data: {
                            search: $(this).val()
                        },
                        success: function (data) {
                            $("#managed_total").html(data);
                        }
                    });
                })

                $('#one_search_managed').on('click', function() {
                    datatablesSimple.SimpleDataTable.search('Processing DONE');
                    $.ajax({
                        url: "./php/get_total_managed_status.php",
                        method: "GET",
                        data: {
                            search: 'Approve'
                        },
                        success: function (data) {
                            $("#managed_total").html(data);
                        }
                    });
                });

                $('#two_search_managed').on('click', function() {
                    datatablesSimple.SimpleDataTable.search('Disapprove');
                    $.ajax({
                        url: "./php/get_total_managed_status.php",
                        method: "GET",
                        data: {
                            search: 'Disapprove'
                        },
                        success: function (data) {
                            $("#managed_total").html(data);
                        }
                    });
                });

                $('#three_search_managed').on('click', function() {
                    datatablesSimple.SimpleDataTable.search('');
                    $.ajax({
                        url: "./php/get_total_managed.php",
                        method: "GET",
                        data: {
                            search: ''
                        },
                        success: function (data) {
                            $("#managed_total").html(data);
                        }
                    });
                });

            }
        }
    });
}

function Fill_All_Request() {
    $.ajax({
        url: "./php/get_all_request_status.php",
        method: "GET",
        success: function (data) {
            data = data.trim();
            $("#all_request").html(data);
            
            const datatablesSimple = document.getElementById('all_request');
            if (datatablesSimple) {

                datatablesSimple.SimpleDataTable = new simpleDatatables.DataTable(datatablesSimple);
                
                const columnWidths = ['15%', '15%', '10%', '16%', '11%', '11%', '12%'];
                const headers = datatablesSimple.querySelectorAll('th');

                headers.forEach((header, index) => {
                    header.style.width = columnWidths[index];
                    if (header.textContent.trim() === 'REFERENCE' ||
                        header.textContent.trim() === 'DATE' ||
                        header.textContent.trim() === 'ENTITY' ||
                        header.textContent.trim() === 'REQUESTED BY' ||
                        header.textContent.trim() === 'STATUS' ||
                        header.textContent.trim() === 'TOTAL' ||
                        header.textContent.trim() === 'ACTION') {
                        header.style.fontWeight = 'bold';
                    } else {
                        header.style.fontWeight = 'normal';
                    }
                });

                $("select[name='all_entity']").on('change', function() {
                    datatablesSimple.SimpleDataTable.search($(this).val());
                    $.ajax({
                        url: "./php/get_total_all.php",
                        method: "GET",
                        data: {
                            search: $(this).val()
                        },
                        success: function (data) {
                            $("#all_total").html(data);
                        }
                    });
                })

                $('#one_search').on('click', function() {
                    datatablesSimple.SimpleDataTable.search('PENDING');
                    $.ajax({
                        url: "./php/get_total_payment_status.php",
                        method: "GET",
                        data: {
                            search: 'PENDING'
                        },
                        success: function (data) {
                            $("#all_total").html(data);
                        }
                    });
                });

                $('#two_search').on('click', function() {
                    datatablesSimple.SimpleDataTable.search('RETURN');
                    $.ajax({
                        url: "./php/get_total_payment_status.php",
                        method: "GET",
                        data: {
                            search: 'RETURN'
                        },
                        success: function (data) {
                            $("#all_total").html(data);
                        }
                    });
                });

                $('#three_search').on('click', function() {
                    datatablesSimple.SimpleDataTable.search('HOLD');
                    $.ajax({
                        url: "./php/get_total_payment_status.php",
                        method: "GET",
                        data: {
                            search: 'HOLD'
                        },
                        success: function (data) {
                            $("#all_total").html(data);
                        }
                    });
                });

                $('#four_search').on('click', function() {
                    datatablesSimple.SimpleDataTable.search('PROCESS');
                    $.ajax({
                        url: "./php/get_total_payment_status.php",
                        method: "GET",
                        data: {
                            search: 'TO PROCESS'
                        },
                        success: function (data) {
                            $("#all_total").html(data);
                        }
                    });
                });

                $('#five_search').on('click', function() {
                    datatablesSimple.SimpleDataTable.search('PROCESSING');
                    $.ajax({
                        url: "./php/get_total_payment_status.php",
                        method: "GET",
                        data: {
                            search: 'PROCESSING'
                        },
                        success: function (data) {
                            $("#all_total").html(data);
                        }
                    });
                });

                $('#six_search').on('click', function() {
                    datatablesSimple.SimpleDataTable.search('FUNDING');
                    $.ajax({
                        url: "./php/get_total_payment_status.php",
                        method: "GET",
                        data: {
                            search: 'FUNDING'
                        },
                        success: function (data) {
                            $("#all_total").html(data);
                        }
                    });
                });

                $('#seven_search').on('click', function() {
                    datatablesSimple.SimpleDataTable.search('RELEASED');
                    $.ajax({
                        url: "./php/get_total_payment_status.php",
                        method: "GET",
                        data: {
                            search: 'RELEASED'
                        },
                        success: function (data) {
                            $("#all_total").html(data);
                        }
                    });
                });

                $('#eight_search').on('click', function() {
                    datatablesSimple.SimpleDataTable.search('');
                    $.ajax({
                        url: "./php/get_total_all.php",
                        method: "GET",
                        data: {
                            search: ''
                        },
                        success: function (data) {
                            $("#all_total").html(data);
                        }
                    });
                });

            }
        }
    });
}

function edit(data) {
    window.localStorage.setItem('id', data);
    window.location.href = 'editable.php';
}

function view(data) {
    window.localStorage.setItem('id', data);
    window.location.href = 'printable.php';
}