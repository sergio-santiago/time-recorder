$(document).ready(function () {
    $('#my_team_table').DataTable(
        {
            "columnDefs": [
                {
                    "orderable": false,
                    "targets": [2, 4]
                }
            ]
        }
    );
});
