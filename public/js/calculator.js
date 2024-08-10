$(function() {
    Fill_Result();
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

function Fill_Result() {
    $.ajax({
        url: "./php/get_result.php",
        method: "GET",
        data: {
            from: $('#filter').find('input[name="from"]').val(),
            to: $('#filter').find('input[name="to"]').val(),
            entity: $('#filter').find('select[name="entity"]').val(),
            status: $('#filter').find('select[name="status"]').val()
        },
        success: function (data) {
            data = data.trim();
            $("#result_container").html(data);

            $('#filter').find('input[name="from"]').on('change', function() {
                $.ajax({
                    url: "./php/get_result.php",
                    method: "GET",
                    data: {
                        from: $('#filter').find('input[name="from"]').val(),
                        to: $('#filter').find('input[name="to"]').val(),
                        entity: $('#filter').find('select[name="entity"]').val(),
                        status: $('#filter').find('select[name="status"]').val()
                    },
                    success: function (data) {
                        data = data.trim();
                        $("#result_container").html(data);
                    }
                });
            })

            $('#filter').find('input[name="to"]').on('change', function() {
                $.ajax({
                    url: "./php/get_result.php",
                    method: "GET",
                    data: {
                        from: $('#filter').find('input[name="from"]').val(),
                        to: $('#filter').find('input[name="to"]').val(),
                        entity: $('#filter').find('select[name="entity"]').val(),
                        status: $('#filter').find('select[name="status"]').val()
                    },
                    success: function (data) {
                        data = data.trim();
                        $("#result_container").html(data);
                    }
                });
            })

            $('#filter').find('select[name="entity"]').on('change', function() {
                $.ajax({
                    url: "./php/get_result.php",
                    method: "GET",
                    data: {
                        from: $('#filter').find('input[name="from"]').val(),
                        to: $('#filter').find('input[name="to"]').val(),
                        entity: $('#filter').find('select[name="entity"]').val(),
                        status: $('#filter').find('select[name="status"]').val()
                    },
                    success: function (data) {
                        data = data.trim();
                        $("#result_container").html(data);
                    }
                });
            })

            $('#filter').find('select[name="status"]').on('change', function() {
                $.ajax({
                    url: "./php/get_result.php",
                    method: "GET",
                    data: {
                        from: $('#filter').find('input[name="from"]').val(),
                        to: $('#filter').find('input[name="to"]').val(),
                        entity: $('#filter').find('select[name="entity"]').val(),
                        status: $('#filter').find('select[name="status"]').val()
                    },
                    success: function (data) {
                        data = data.trim();
                        $("#result_container").html(data);
                    }
                });
            })
        }
    });
}

function download_pdf() {
    var element = document.getElementById('result_container');
    html2pdf(element, {
        margin: 0,
        filename: 'Report.pdf',
        image: { type: 'jpg', quality: 1.0 },
        html2canvas: { scale: 1 },
        jsPDF: { 
            unit: 'mm', 
            format: 'a3', 
            orientation: 'portrait',
        },
        pagebreak: { mode: 'avoid-all' },
        html2pdf: {
            margin: 0,
            jsPDF: { 
                unit: 'mm', 
                format: 'a3', 
                orientation: 'portrait',
            }
        },
    });
}

function download_excel() {
     var table = document.getElementById('table_to_export');
    var workbook = XLSX.utils.book_new();
    var worksheet = XLSX.utils.table_to_sheet(table);
    
    var max_widths = [];
    var rows = table.getElementsByTagName('tr');
    for (var i = 0; i < rows.length; i++) {
        var cells = rows[i].getElementsByTagName(i === 0 ? 'th' : 'td');
        for (var j = 0; j < cells.length; j++) {
            var cell_value = cells[j].innerText || cells[j].textContent;
            var cell_width = cell_value.length;
            max_widths[j] = max_widths[j] ? Math.max(max_widths[j], cell_width) : cell_width;
        }
    }

    worksheet['!cols'] = max_widths.map(w => ({ wch: w + 2 }));

    XLSX.utils.book_append_sheet(workbook, worksheet, 'Sheet1');
    var excelFile = XLSX.write(workbook, { bookType: 'xlsx', type: 'binary' });
    var blob = new Blob([s2ab(excelFile)], { type: 'application/octet-stream' });
    var url = URL.createObjectURL(blob);
    var link = document.createElement('a');
    link.href = url;
    link.setAttribute('download', 'Report.xlsx');
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
    URL.revokeObjectURL(url);
}

function s2ab(s) {
    var buf = new ArrayBuffer(s.length);
    var view = new Uint8Array(buf);
    for (var i = 0; i < s.length; i++) view[i] = s.charCodeAt(i) & 0xFF;
    return buf;
}