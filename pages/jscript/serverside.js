jQuery(function($) {
    //initiate dataTables plugin
    var oTable1 = $('#catalog').dataTable({
        "processing": true,
        "language": {
            "processing": " Please Wait..."
        },
        "bServerSide": true,
        "sAjaxSource": "../pages/serverside_catalog.php",
        "ordering": true,
        "searching": true,
       // "scrollX": true,
        "aoColumns": [
            {
                "mData": null,
                "bSortable": false,
                "mRender": function(data, type, full, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1; // Row number
                }
            },
            {
                "aaData": "item_code"
            },
            {
                "aaData": "part_number"
            },
            {
                "aaData": "item_name"
            },
            {
                "aaData": "spec"
            },
            {
                "aaData": "category_name"
            },
            {
                "aaData": "sub_catname"
            },
           
            {
                "aaData": "brand_name"
            },
            {
                "aaData": "maesurename"
            },
    
            {
                "aaData": "min_stock"
            },
            {
                "mData": [0],
                "mRender": function(data, type, full) {
                    return '<a align="center" class="glyphicon glyphicon-edit" href="?pages=edit_catalog&id=' +
                        data + '"></a>';
                }
            },
            {
                "mData": [0],
                "mRender": function(data, type, full) {
                    return '<a align="center" class="glyphicon glyphicon-trash" href="../controller/process.php?actionCatalog=delete&code=' +
                        data + '"></a>';
                }
            }
        ]
    });

    // Add tooltip for small view action buttons in dropdown menu
    $('[data-rel="tooltip"]').tooltip({
        placement: tooltip_placement
    });

    // Tooltip placement on right or left
    function tooltip_placement(context, source) {
        var $source = $(source);
        var $parent = $source.closest('table')
        var off1 = $parent.offset();
        var w1 = $parent.width();
        var off2 = $source.offset();

        if (parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2)) return 'right';
        return 'left';
    }
    
    
    
});


$(document).ready(function() {
    // Initialize DataTable with FixedColumns
    var table = $('#assettable').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "serverside_catalog.php",
        "columns": [
            {
                "data": null,
                "render": function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1; // Row number
                }
            },
            { "data": "item_code" },
            { "data": "part_number" },
            { "data": "item_name" },
            { "data": "spec" },
            { "data": "category_name" },
            { "data": "sub_catname" },
            { "data": "brand_name" },
            { "data": "maesurename" },
              { "data": "min_stock" },
            {
                "data": "id", // Assuming 'id' is the primary key
                "render": function(data) {
                    return '<a align="center" class="glyphicon glyphicon-edit" href="?pages=edit_catalog&id=' + data + '"></a>';
                }
            },
            {
                "data": "id", // Assuming 'id' is the primary key
                "render": function(data) {
                    return '<a align="center" class="glyphicon glyphicon-trash" href="../controller/process.php?actionCatalog=delete&code=' + data + '"></a>';
                }
            }
        ],
        "fixedColumns": {
            "leftColumns": 2,   // Fix the first column on the left
            "rightColumns": 2   // Fix the last two columns on the right
        }
    });
});
