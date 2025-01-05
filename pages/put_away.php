<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3><b>Inbound</b> | <small>Put away</small></h3>
        </div>
    </div>
    <div class="clearfix"></div>
    <br>

    <div class="row">
        <div class="col-md-12">
            <div class="x_content">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="x_panel">
                            <br>
                            <div class="card-box">
                                <div class="table-responsive">
                                    <table id="example" class="table table-striped responsive-utilities jambo_table bulk_action">
                                        <thead>
                                            <tr>
                                                <th><input type="checkbox" id="select_all" onclick="toggleSelectAll(this)"></th>
                                                <th>No</th>
                                                <th>Item Code</th>
                                                <th>Item Name</th>
                                                <th>Specification</th>
                                                <th>Total Qty</th>
                                                <th>Measurement</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            foreach ((array)$db->viewPutAway() as $x) {
                                            ?>
                                            <tr>
                                                <td><input type="checkbox" class="item_checkbox" value="<?php echo htmlspecialchars($x['item_code']); ?>" data-total-qty="<?php echo htmlspecialchars($x['total_qty']); ?>"></td>
                                                <td><?php echo $no++; ?></td>
                                                <td><?php echo htmlspecialchars($x['item_code']?? ''); ?></td>
                                                <td><?php echo htmlspecialchars($x['item_name']?? ''); ?></td>
                                                <td><?php echo htmlspecialchars($x['spec']?? ''); ?></td>
                                                <td><?php echo htmlspecialchars($x['total_qty']?? ''); ?></td>
                                                <td><?php echo htmlspecialchars($x['maesurename']?? ''); ?></td>
                                            </tr>
                                            <?php 
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                    <div class="modal fade" id="printlabel" tabindex="-1" role="dialog" aria-labelledby="printLabelModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="printLabelModalLabel">Print Labels</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Please confirm you want to print the selected labels:</p>
                                                    <ul id="selectedItemsList" class="list-group mb-3" style="max-height: 200px; overflow-y: auto;"></ul>
                                                    <div class="form-group">
                                                        <label for="selected_device">Select Printer:</label>
                                                        <select id="selected_device" class="form-control" onchange="onDeviceSelected(this)">
                                                            <option value="">-- Select Printer --</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                    <button type="button" class="btn btn-primary" onclick="printSelectedBarcodes()">Print</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="addstock" tabindex="-1" role="dialog" aria-labelledby="addstockModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Add Stock</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="../controller/process.php?actionPutaway=insert" method="post" class="form-horizontal form-label-left input_mask">
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="itemcode">Item Code:</label>
                                                            <input id="itemcode" type="text" name="itemcode" class="form-control" oninput="fetchItemDetails()" />
                                                        </div>
                                                        <div id="itemDetails" class="mb-3">
                                                            <ul id="itemDetailsList" class="list-group"></ul>
                                                        </div>
                                                        <div id="locationDetails" class="mb-3">
                                                            <ul id="locationDetailsList" class="list-group"></ul>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="location">Location:</label>
                                                            <select name="location" id="location" class="mySelect form-control" style="width: 100%;">
                                                                <option value="0">- Select Location -</option>
                                                                <?php
                                                                $query = "SELECT * FROM master_location";
                                                                $hasil = mysqli_query($conn, $query);
                                                                while ($data = mysqli_fetch_array($hasil)) {
                                                                    echo "<option value='" . $data['id_location'] . "'>" . $data['location_name'] . "</option>";
                                                                } ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="rack">Select Rack:</label>
                                                            <select id="rack" name="rack" class="form-control" style="width: 100%;">
                                                                <option value="">-- Select Rack --</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="qty">Qty:</label>
                                                           <input id="qty" name="qty" class="form-control" oninput="validateQuantity()" />
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-primary">Add</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <button class="btn btn-custom" data-toggle="modal" data-target="#printlabel" onclick="prepareModal()">
                                        <i class="mdi mdi-qrcode"></i> Print Label Filter
                                    </button>
                                    <button class="btn btn-custom" data-toggle="modal" data-target="#addstock" onclick="prepareModal()">
                                        <i class="mdi mdi-qrcode"></i> Add Stock
                                    </button>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    let totalQty = 0; // Global variable to hold total quantity

// Fetch available printers using Zebra Browser Print API
function fetchPrinters() {
    BrowserPrint.getDefaultDevice("printer", function (printer) {
        const printerSelect = document.getElementById('selected_device');
        printerSelect.innerHTML = '<option value="">-- Select Printer --</option>'; // Clear previous options

        if (printer != null) {
            const option = document.createElement('option');
            option.value = printer.name;
            option.textContent = printer.name;
            printerSelect.appendChild(option);
        } else {
            alert("No Zebra printers found.");
        }

        // Optionally, fetch all printers
        BrowserPrint.getLocalDevices(function (printers) {
            if (printers && printers.length > 0) {
                printers.forEach(p => {
                    const option = document.createElement('option');
                    option.value = p.name;
                    option.textContent = p.name;
                    printerSelect.appendChild(option);
                });
            }
        }, undefined, "printer");
    }, function (error) {
        console.error("Error fetching default printer:", error);
    });
}
function printSelectedBarcodes() {
    const selectedItems = Array.from(document.querySelectorAll('.item_checkbox:checked')).map(checkbox => {
        const row = checkbox.closest('tr');
        return {
            itemCode: checkbox.value, // Assuming the checkbox value is the item code
            itemName: row.cells[3].textContent, // Adjust index based on your table structure
            spec: row.cells[4].textContent,
            maesurename: row.cells[6].textContent
        };
    });

    const printerName = document.getElementById('selected_device').value;

    if (selectedItems.length === 0) {
        alert('Please select at least one item to print.');
        return;
    }

    if (!printerName) {
        alert('Please select a printer.');
        return;
    }

    BrowserPrint.getDefaultDevice("printer", function (printer) {
        if (printer != null) {
            selectedItems.forEach(item => {
                // Construct ZPL code for each item to print with dynamic item code
                const zplData = `^XA
^MMT
^LT3
^MD24
^PW399
^LL200
^FO17,16^BQN,2,5^FD000${item.itemCode}^FS
^FO142,20^A0N,18,19^FD
WAREHOUSE - SGU
^FS
^FO142,40^A0N,27,26^FD${item.itemCode}^FS
^FO142,66^A0N,18,16^FB250,2,0,L,0^FD${item.itemName}^FS
^FO142,90^A0N,18,16^FB250,3,0,L,0^FD${item.spec}^FS
^FO142,130^A0N,18,16^FD
UOM : ${item.maesurename}
^FS
^PQ1,0,1,Y
^XZ`;

                // Send ZPL command to the selected printer
                printer.send(zplData, function () {
                    console.log(`Successfully sent barcode ${item.itemCode} to printer ${printerName}.`);
                }, function (error) {
                    console.error(`Error printing barcode ${item.itemCode}:`, error);
                });
            });
        } else {
            alert("No Zebra printers found.");
        }
    }, function (error) {
        console.error("Error fetching printer:", error);
    });
}


    // Listen for input on the item code field
    document.getElementById('itemcode').addEventListener('input', function(event) {
        if (this.value) {
            $('#addstock').modal('show'); // Open the modal
        }
    });

    function handleScannerInput(value) {
        const itemCodeInput = document.getElementById('itemcode');
        itemCodeInput.value = value; // Set the scanned value to the item code input
        $('#addstock').modal('show'); // Show the modal
        itemCodeInput.focus(); // Focus the input field
    }

    document.addEventListener('keydown', function(event) {
        if (event.key === "Enter") {
            const scannedValue = "ITEM123"; // Replace with the actual scanned value
            handleScannerInput(scannedValue);
        }
    });


// Function to fetch item details
function fetchItemDetails() {
    const itemCode = document.getElementById('itemcode').value;
    const itemDetailsList = document.getElementById('itemDetailsList');
    const locationDetailsList = document.getElementById('locationDetailsList');
    
    itemDetailsList.innerHTML = ''; // Clear existing item details
    locationDetailsList.innerHTML = ''; // Clear existing location details
    totalQty = 0; // Reset total quantity

    if (itemCode) {
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "jscript/fetch_item_details.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onload = function() {
            if (xhr.status === 200) {
                const itemDetails = JSON.parse(xhr.responseText);
                if (itemDetails) {
                    const liName = document.createElement('li');
                    liName.className = 'list-group-item';
                    liName.textContent = 'Item Name: ' + itemDetails.item_name;
                    itemDetailsList.appendChild(liName);

                    const liSpec = document.createElement('li');
                    liSpec.className = 'list-group-item';
                    liSpec.textContent = 'Specification: ' + itemDetails.spec;
                    itemDetailsList.appendChild(liSpec);

                    const liUOM = document.createElement('li');
                    liUOM.className = 'list-group-item';
                    liUOM.textContent = 'UoM: ' + itemDetails.maesurename;
                    itemDetailsList.appendChild(liUOM);

                    // Outstanding Quantity
                    totalQty = itemDetails.total_qty; // Store total quantity
                    const liQTY = document.createElement('li');
                    liQTY.className = 'list-group-item';
                    const badge = `<span style="background-color:#ff7413" class="badge badge-primary float-right">${totalQty}</span>`;
                    liQTY.innerHTML = `Ready to Put Away: ${badge}`;
                    itemDetailsList.appendChild(liQTY);

                    // Fetch stock locations after item details
                    fetchStockLocations(itemCode);
                } else {
                    itemDetailsList.innerHTML = '<li class="list-group-item">No item found.</li>';
                }
            } else {
                console.error("Error fetching item details:", xhr.statusText);
            }
        };
        xhr.send("itemcode=" + encodeURIComponent(itemCode));
    }
}

// Validate quantity function
function validateQuantity() {
    const qtyInput = document.getElementById('qty');
    const qtyValue = parseInt(qtyInput.value, 10) || 0; // Default to 0 if NaN

    if (qtyValue > totalQty) {
        qtyInput.setCustomValidity(`Quantity cannot exceed total quantity of ${totalQty}`);
    } else {
        qtyInput.setCustomValidity('');
    }

    qtyInput.reportValidity(); // Trigger validation message display
}

    function fetchStockLocations(itemCode) {
        const locationDetailsList = document.getElementById('locationDetailsList');

        const xhr = new XMLHttpRequest();
        xhr.open("POST", "jscript/fetch_stock_locations.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onload = function() {
            if (xhr.status === 200) {
                const locations = JSON.parse(xhr.responseText);
                if (locations.length > 0) {
                    locations.forEach(location => {
                        const li = document.createElement('li');
                        li.className = 'list-group-item';
                        const badge = `<span class="badge badge-success float-right">${location.qty}</span>`;
                        li.innerHTML = `Location: ${location.location_name} - ${location.rack_name} ${badge}`;
                        locationDetailsList.appendChild(li);
                    });
                } else {
                    locationDetailsList.innerHTML = '<li class="list-group-item">No locations found.</li>';
                }
            } else {
                console.error("Error fetching stock locations:", xhr.statusText);
            }
        };
        xhr.send("itemcode=" + encodeURIComponent(itemCode));
    }

    function toggleSelectAll(source) {
        const checkboxes = document.querySelectorAll('.item_checkbox');
        checkboxes.forEach(checkbox => checkbox.checked = source.checked);
    }

    function prepareModal() {
        const selectedItems = Array.from(document.querySelectorAll('.item_checkbox:checked')).map(checkbox => {
            const row = checkbox.closest('tr');
            const itemCode = checkbox.value;
            const itemName = row.cells[3].textContent; // Item name is in the 4th column (index 3)
            const itemTotalQty = row.cells[5].textContent; // Total Qty is in the 6th column (index 5)
            totalQty = parseInt(itemTotalQty, 10); // Store total quantity
            return { itemCode, itemName, totalQty }; // Include total quantity in the object
        });

        const selectedItemsList = document.getElementById('selectedItemsList');
        selectedItemsList.innerHTML = '';

        if (selectedItems.length > 0) {
            selectedItems.forEach(item => {
                const li = document.createElement('li');
                li.textContent = `${item.itemCode} - ${item.itemName}`; // Display item code and name
                li.classList.add('list-group-item'); // Add Bootstrap class for list item styling
                selectedItemsList.appendChild(li);
            });
        } else {
            selectedItemsList.innerHTML = '<li class="list-group-item">No items selected</li>';
        }

        fetchPrinters();
    }


</script>
