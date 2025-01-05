<script src="../js/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script type="text/javascript" src="../js/gauge/gauge.min.js"></script>
<script type="text/javascript" src="../js/gauge/gauge_demo.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="../js/progressbar/bootstrap-progressbar.min.js"></script>
<script src="../js/nicescroll/jquery.nicescroll.min.js"></script>
<script src="../js/icheck/icheck.min.js"></script>
 <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<script src="../js/chart../js/chart.min.js"></script>
<script src="../js/custom.js"></script>
<!--[if lte IE 8]><script type="text/javascript" src="../js/excanvas.min.js"></script><![endif]-->
<script src="../js/flot/jquery.flot.js"></script>
<script src="../js/flot/jquery.flot.pie.js"></script>
<script src="../js/flot/jquery.flot.orderBars.js"></script>
<script src="../js/flot/jquery.flot.time.min.js"></script>
<script src="../js/flot/date.js"></script>
<script src="../js/flot/jquery.flot.spline.js"></script>
<script src="../js/flot/jquery.flot.stack.js"></script>
<script src="../js/flot/curvedLines.js"></script>
<script src="../js/flot/jquery.flot.resize.js"></script>
<script type="text/javascript" src="../js/maps/jquery-jvectormap-2.0.3.min.js"></script>
<script type="text/javascript" src="../js/maps/gdp-data.js"></script>
<script type="text/javascript" src="../js/maps/jquery-jvectormap-world-mill-en.js"></script>
<script type="text/javascript" src="../js/maps/jquery-jvectormap-us-aea-en.js"></script>
<!-- SweetAlert CSS dan JavaScript -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="../js/pace/pace.min.js"></script>
<script src="../js/skycons/skycons.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<!-- DataTables FixedColumns JS -->

<script src="https://cdn.datatables.net/fixedcolumns/3.3.2/js/dataTables.fixedColumns.min.js"></script>
<script type="text/javascript" src="../pages/jscript/serverside.js"></script>
<!-- Buttons extension -->
<script src="https://cdn.datatables.net/buttons/2.3.1/js/dataTables.buttons.min.js"></script>
<!-- JSZip for Excel export -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<!-- Excel Export -->
<script src="https://cdn.datatables.net/buttons/2.3.1/js/buttons.html5.min.js"></script>
<!-- Optional: Add for Print and PDF export -->
<script src="https://cdn.datatables.net/buttons/2.3.1/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.1/js/buttons.flash.min.js"></script>

<script type="text/javascript" src="../js/zebrabrowserprint/BrowserPrint-3.1.250.min.js"></script>
<script type="text/javascript" src="../js/zebrabrowserprint/BrowserPrint-Zebra-1.1.250.min.js"></script>


<script>
document.addEventListener("DOMContentLoaded", function() {
    BrowserPrint.init(function() {
        console.log("BrowserPrint initialized successfully.");
        if (typeof BrowserPrint.getLocalPrinters === 'function') {
            fetchPrinters();
        } else {
            console.error("getLocalPrinters is not available in this version.");
        }
    }, function(error) {
        console.error("BrowserPrint initialization failed:", error);
    });
});


function fetchPrinters() {
    BrowserPrint.getLocalPrinters(function(printers) {
        const printerSelect = document.getElementById('printerSelect');
        printerSelect.innerHTML = '';

        if (printers.length === 0) {
            const option = document.createElement('option');
            option.textContent = 'No printers found';
            printerSelect.appendChild(option);
            return;
        }

        printers.forEach(printer => {
            const option = document.createElement('option');
            option.value = printer.name;
            option.textContent = printer.name;
            printerSelect.appendChild(option);
        });
    }, function(error) {
        console.error("Error fetching printers:", error);
        alert("Could not fetch printers. Please check the console for more details.");
    });
}

 $(document).ready(function() {
    // Inisialisasi DataTable dengan opsi export Excel
    var table = $('#example2').DataTable({
        dom: 'Bfrtip', // Mengaktifkan tombol export
        buttons: [
                    {
                        extend: 'excelHtml5', // Ekspor ke Excel
                        text: 'Export to Excel',
                        title: 'Good Receipt Report',
                        className: 'btn btn-success', // Gaya tombol
                        exportOptions: {
                            columns: ':visible', // Hanya kolom yang terlihat
                        },
                        customize: function(xlsx) {
                            var sheet = xlsx.xl.worksheets['sheet1.xml'];
                            // Menambahkan header khusus jika diperlukan
                            // Misalnya menambahkan judul di atas tabel
                        }
                    },
                    {
                        extend: 'csvHtml5', // Ekspor ke CSV
                        text: 'Export to CSV',
                        title: 'Good Receipt Report',
                        className: 'btn btn-success',
                        exportOptions: {
                            columns: ':visible',
                        }
                    },
                    {
                        extend: 'print', // Print
                        text: 'Print Table',
                        className: 'btn btn-success',
                        title: 'Good Receipt Report',
                        exportOptions: {
                            columns: ':visible'
                        }
                    }
                ]
    });

    // Filter berdasarkan Item Code
    $('#itemCodeFilter').on('keyup change', function() {
        table.column(2).search(this.value).draw(); // Kolom ke-2 untuk Item Code
    });

    // Filter berdasarkan Item Name
    $('#itemNameFilter').on('keyup change', function() {
        table.column(3).search(this.value).draw(); // Kolom ke-3 untuk Item Name
    });

    // Inisialisasi Date Range Picker
    $('#receiptDateRange').daterangepicker({
        opens: 'left',
        autoUpdateInput: false,
        locale: {
            format: 'YYYY-MM-DD', // Format tanggal yang dipakai di tabel
            cancelLabel: 'Clear'
        }
    });

    // Variabel global untuk menyimpan fungsi filter
    var dateFilterFunc = function(settings, data, dataIndex) { return true; };

    // Set nilai pada input ketika tanggal dipilih
    $('#receiptDateRange').on('apply.daterangepicker', function(ev, picker) {
        var startDate = picker.startDate.format('YYYY-MM-DD');
        var endDate = picker.endDate.format('YYYY-MM-DD');
        $(this).val(startDate + ' - ' + endDate);

        dateFilterFunc = function(settings, data, dataIndex) {
            var receiptDate = data[10]; // Ambil tanggal dari kolom ke-10
            if (receiptDate) {
                var date = new Date(receiptDate);
                var start = new Date(startDate);
                var end = new Date(endDate);
                return (date >= start && date <= end);
            }
            return false;
        };

        // Pastikan hanya ada satu filter aktif
        $.fn.dataTable.ext.search = [];
        $.fn.dataTable.ext.search.push(dateFilterFunc);

        table.draw(); // Refresh table setelah filter diterapkan
    });

    // Clear filter range tanggal saat dibatalkan
    $('#receiptDateRange').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val(''); // Kosongkan input tanggal
        $.fn.dataTable.ext.search = [];
        table.draw(); // Refresh ulang table tanpa filter
    });
});


</script>
<script>
$(document).ready(function() {
    
    // Select2 initialization
    $('.mySelect').select2({
        placeholder: "Select an option",
       width: 'resolve',
        allowClear: true
    });

  $('#additem').on('shown.bs.modal', function () {
        $('.mySelect').select2(); // Initialize Select2
    });
    // Date Range Picker
    var cb = function(start, end, label) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    };

    var optionSet1 = {
        startDate: moment().subtract(29, 'days'),
        endDate: moment(),
        minDate: '01/01/2012',
        maxDate: '12/31/2015',
        dateLimit: { days: 60 },
        showDropdowns: true,
        showWeekNumbers: true,
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        opens: 'left',
        buttonClasses: ['btn btn-default'],
        applyClass: 'btn-small btn-primary',
        cancelClass: 'btn-small',
        format: 'MM/DD/YYYY',
        separator: ' to ',
        locale: {
            applyLabel: 'Submit',
            cancelLabel: 'Clear',
            fromLabel: 'From',
            toLabel: 'To',
            customRangeLabel: 'Custom',
            daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
            monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            firstDay: 1
        }
    };
    $('#reportrange span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
    $('#reportrange').daterangepicker(optionSet1, cb);

    // Ajax for dropdowns
    $("#category").change(function() {
        var category = $("#category").val();
        $.ajax({
            type: "post",
            url: "dropdown_ajax_category.php",
            data: "category=" + category,
            success: function(data) {
                $("#subcat").html(data).trigger('change');
            }
        });
    });
        // Ajax for dropdowns
    $("#txtDepartment").change(function() {
        var department = $("#txtDepartment").val();
        $.ajax({
            type: "post",
            url: "jscript/dropdown_ajax_department.php",
            data: "department=" + department,
            success: function(data) {
                $("#txtPic").html(data).trigger('change');
            }
        });
    });

    $("#txtsite").change(function() {
        var txtsite = $("#txtsite").val(); 
        $.ajax({
            type: "post",
            url: "dropdown_ajax_location.php",
            data: "txtsite=" + txtsite,
            success: function(data) {
                $("#location").html(data).trigger('change');
            }
        });
    });

    $("#location").change(function() {
        var location = $("#location").val();
        $.ajax({
            type: "post",
            url: "jscript/dropdown_ajax_rack.php",
            data: "location=" + location,
            success: function(data) {
                $("#rack").html(data).trigger('change');
            }
        });
    });
    
     $(document).ready(function() {
        $('#example').DataTable(); // Replace 'example' with the ID of your table
    });
    
    
$('#itemcode').change(function() {
    var itemCode = $("#itemcode").val();
    
    if (itemCode != "0") {
        // Fetch the measurement
        $.ajax({
            url: 'jscript/get_measurement.php', // URL for fetching measurement
            type: 'POST',
            data: { item_code: itemCode },
            success: function(response) {
                $('#measurement').val(response); // Display the measurement
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error: " + error); // Log any AJAX errors
            }
        });

        // Fetch the item name
        $.ajax({
            url: 'jscript/get_item_name.php', // New URL for fetching item name
            type: 'POST',
            data: { item_code: itemCode },
            success: function(response) {
                $('#item_name').val(response); // Display the item name
                $('#measurementGroup').show(); // Show the measurement group
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error: " + error); // Log any AJAX errors
            }
        });
        
         $.ajax({
            url: 'jscript/get_item_stock.php', // New URL for fetching item name
            type: 'POST',
            data: { item_code: itemCode },
            success: function(response) {
                $('#stock').val(response); // Display the item name
                $('#measurementGroup').show(); // Show the measurement group
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error: " + error); // Log any AJAX errors
            }
        });
        
    } else {
        $('#measurement').val(''); // Clear the measurement input
        $('#item_name').val(''); // Clear the item name input
         $('#stock').val(''); // Clear the Stock input
        $('#measurementGroup').hide(); // Hide the measurement group
    }
});

    
});

// NProgress
NProgress.done();
</script>

<script>
var icons = new Skycons({ "color": "#73879C" }),
    list = ["clear-day", "clear-night", "partly-cloudy-day", "partly-cloudy-night", "cloudy", "rain", "sleet", "snow", "wind", "fog"],
    i;

for (i = list.length; i--;) {
    icons.set(list[i], list[i]);
}
icons.play();
</script>

