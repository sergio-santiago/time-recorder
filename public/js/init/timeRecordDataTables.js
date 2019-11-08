$(document).ready(function () {
    $('#time_record_table').DataTable(
        {
            "columnDefs": [
                {
                    "orderable": false,
                    "targets": [3, 4]
                }
            ]
        }
    );
});
