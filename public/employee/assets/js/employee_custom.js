// function stop() {
//     let punch_in = "{{ $existingDetails->punch_in ?? '' }}";
//     let punch_out = "{{ $existingDetails->punch_out ?? '' }}";
//     $("#start-timer").hide();
//     $("#stop-timer").hide();
//     if (punch_out != 'NULL') {
//         var StartedTime = new Date(punch_in).getTime();
//         var EndedTime = new Date(punch_out).getTime();

//         var diff = EndedTime - StartedTime;
//         var hours = Math.floor(diff / 3.6e6);
//         var minutes = Math.floor((diff % 3.6e6) / 6e4);
//         var seconds = Math.floor((diff % 6e4) / 1000);
//         let h = hours < 10 ? '0' + hours : hours;
//         let m = minutes < 10 ? '0' + minutes : minutes;
//         let s = seconds < 10 ? '0' + seconds : seconds;
//         var duration = h + ":" + m + ":" + s;
//         timeLaps = duration;
//         $("#timer").text(timeLaps);
//     }
// }


$(document).ready(function () {

    $("#start-timer").on("click", function () {
        $.ajax({
            url: employeeAttendanceUrl, // Ensure this route is correct
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                if (response.success) {
                    Swal.fire("Success!", response.message, "success").then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire("Error!", response.message, "danger");
                }
            },
            error: function (error_messages) {
                let errors = error_messages.responseJSON.errors;
                for (var error_key in errors) {
                    console.log(error_key, '--', rrors[error_key]);
                }
            }
        });
    });
    $("#stop-timer").on("click", function () {
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to punch out now?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Punch Out',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                // If confirmed, make the AJAX request
                $.ajax({
                    url: employeeAttendanceUrl, // Ensure this route is correct
                    type: 'POST',
                    data: {
                        "attendance_id": $('#attendance_id').val()
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        if (response.success) {
                            Swal.fire("Success!", response.message, "success").then(() => {
                                location.reload();
                            });
                        }
                        else if (response.before_punchout_confirm_required) {
                            Swal.fire({
                                title: "Confirm Early Punch Out",
                                text: response.message,
                                icon: "warning",
                                showCancelButton: true,
                                confirmButtonText: "Yes, Confirm",
                                cancelButtonText: "Cancel"
                            }).then((confirm) => {
                                if (confirm.isConfirmed) {
                                    // Add force flag for backend
                                    $.ajax({
                                        url: employeeAttendanceUrl,
                                        type: 'GET',
                                        data: {
                                            "attendance_id": $('#attendance_id').val(),
                                            "force": true // Signal to backend to skip re-check
                                        },
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        },
                                        success: function (finalResponse) {
                                            if (finalResponse.success) {
                                                Swal.fire("Success!", finalResponse.message, "success").then(() => {
                                                    location.reload();
                                                });
                                            } else {
                                                Swal.fire("Error!", finalResponse.message, "error");
                                            }
                                        }
                                    });
                                }
                            });
                        }
                        else {
                            Swal.fire("Error!", response.message, "error");
                        }
                    },
                    error: function (error_messages) {
                        let errors = error_messages.responseJSON.error;
                        for (var error_key in errors) {
                            console.error(error_key, '--', errors[error_key]);
                        }
                    }
                });
            }
        });
    });
});


