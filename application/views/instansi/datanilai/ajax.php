<script type="text/javascript">

var save_method; //for save method string
var table;
var status_btn_afektif = 0;
var status_btn_kognitif = 0;
var status_btn_psikomotor = 0;

$(document).ready(function() {

    //datatables
    table = $('#table').DataTable({ 

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('instansi_datanilai/ajax_list')?>",
            "type": "POST"
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ -1 ], //last column
            "orderable": false, //set not orderable
        },
        ],

    });   



    $( "#afektif" ).keyup(function() {
    // console.log($(this).val());
    var val_afektif = $(this).val();
    if(val_afektif < 15 || val_afektif > 25) {
        $( "#alert_afektif" ).text("Nilai harus berada antara 15 & 25");
        status_btn_afektif = 0
    } else {
        $( "#alert_afektif" ).text("");
        status_btn_afektif = 1
    }
    if(status_btn_afektif == 1 && status_btn_kognitif == 1 && status_btn_psikomotor == 1) {
        $( "#btnSave" ).prop( "disabled", false );
    } else {        
        $( "#btnSave" ).prop( "disabled", true );
    }
});

$( "#kognitif" ).keyup(function() {
    // console.log($(this).val());
    var val_kognitif = $(this).val();
    if(val_kognitif < 30 || val_kognitif > 40) {
        $( "#alert_kognitif" ).text("Nilai harus berada antara 30 & 40");
        status_btn_kognitif = 0
    } else {
        $( "#alert_kognitif" ).text("");
        status_btn_kognitif = 1
    }
    if(status_btn_afektif == 1 && status_btn_kognitif == 1 && status_btn_psikomotor == 1) {
        $( "#btnSave" ).prop( "disabled", false );
    } else {        
        $( "#btnSave" ).prop( "disabled", true );
    }
});

$( "#psikomotor" ).keyup(function() {
    // console.log($(this).val());
    var val_psikomotor = $(this).val();
    if(val_psikomotor < 20 || val_psikomotor > 35) {
        $( "#alert_psikomotor" ).text("Nilai harus berada antara 20 & 35");
        status_btn_psikomotor = 0
    } else {
        $( "#alert_psikomotor" ).text("");
        status_btn_psikomotor = 1
    }
    if(status_btn_afektif == 1 && status_btn_kognitif == 1 && status_btn_psikomotor == 1) {
        $( "#btnSave" ).prop( "disabled", false );
    } else {        
        $( "#btnSave" ).prop( "disabled", true );
    }
}); 

});


function edit_person(id)
{
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('instansi_datanilai/ajax_edit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            $('[name="id"]').val(data.id);
            $('[name="rel_nim"]').val(data.rel_nim);
            $('[name="nama_mhs"]').val(data.nama_mhs);
            $('[name="lh_afektif"]').val(data.lh_afektif);
            $('[name="lh_kognitif"]').val(data.lh_kognitif);
            $('[name="lh_psikomotor"]').val(data.lh_psikomotor);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Nilai Mahasiswa'); // Set title to Bootstrap modal title

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function reload_table()
{
    table.ajax.reload(null,false); //reload datatable ajax 
}

function save()
{
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url;

    if(save_method == 'add') {
        url = "<?php echo site_url('instansi_datanilai/ajax_add')?>";
    } else {
        url = "<?php echo site_url('instansi_datanilai/ajax_update')?>";
    }

    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) //if success close modal and reload ajax table
            {
                $('#modal_form').modal('hide');
                reload_table();
            }

            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 

        }
    });
}

function delete_person(id)
{
    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('person/ajax_delete')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
                $('#modal_form').modal('hide');
                reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });

    }
}

</script>