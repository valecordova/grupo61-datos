$(document).ready( function () {
    /*
    $('#example').DataTable({
        "lengthChange":false,
        "pageLength": 10
    });
    */

    $("#tab-container").on("click", ".tab-lbl", function(){
        var that = $(this);
        var tabid = that.data("tab");

        $(".tab").each(function(k, v){
            $(this).hide();
        });

        $(tabid).show();
    });

    var table = $('#employee-grid').DataTable({
        "responsive": true,
        "processing": true,
        "serverSide": true,
        "ajax": {
            url: "server_processing.php", // json datasource
            data: {action: 'getEMP'},
            type: 'post',  // method  , by default get
        },
        error: function () {  // error handling
            $(".employee-grid-error").html("");
            $("#employee-grid").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
            $("#employee-grid_processing").css("display", "none");
        }
    });

    /*
    var table = $('#example').DataTable({
        "lengthChange":false,
        "pageLength": 7,
        //,"scrollY":'50vh'
        //,"searching": false
        //"fnInitComplete": function(oSettings, json) { $('#example tbody tr:eq(0)').click(); }
    });
    */

    $('#example tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
        }
        else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    } );

    // Setup - add a text input to each footer cell
    $('#example tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Buscar '+title+'" />' );
    } );

    // Apply the search
    table.columns().every( function () {
        var that = this;
        $( 'input', this.footer() ).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        } );
    } );

} );