const baseUrl = "http://127.0.0.1:8000/";


$(function() {
    var table = $('.yajra-datatable1').DataTable({
        processing: true,
        serverSide: true,
        ajax: baseUrl + "student-list",
        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex'
            },
            {
                data: 'studentName',
                studentName: 'name'
            },
            {
                data: 'grade',
                grade: 'grade'
            },
            {
                data: 'image',
                Image: '<img src="/report/" + data + "" height="50"/>'
            },
            {
                data: 'dateOfBirth',
                Dateofbirth: 'dateofBirth'
            },
            {
                data: 'address',
                Address: 'address'
            },
            {
                data: 'action',
                name: 'action',
                orderable: true,
                searchable: true
            },
        ]
    });
});

/*country select event*/
$('#country').on('change', function() {
    var country_id = this.value;
    // $("#state").html('');
    $.ajax({
        url: baseUrl+'state-list/'+country_id,
        type: "GET",
        dataType: 'json',
        success: function(result) {
            if(result.length !== 0){
                $('#state').html('<option value="">Select State </option>');
                $.each(result, function(key, value) {
                    $("#state").append('<option value="' + value.id + '">' + value.stateName + '</option>');
                });
                $('#city').html('<option value="">Select State First</option>');
            }
        },
        error: function(err){
            console.log('error => ', err);

        }
    });
});

/*state select event*/
$('#state').on('change', function() {
    var stateId = this.value;

    $.ajax({
        url: baseUrl+'city-list/'+stateId,
        type: "GET",
        dataType: 'json',
        success: function(result) {
            if(result.length !== 0){
                $('#city').html('<option value="">Select City</option>');
                $.each(result, function(key, value) {
                    $("#city").append('<option value="' + value.id + '">' + value.cityName + '</option>');
                });
            }
        },
        error: function(err){
            console.log('error => ', err);

        }
    });
});