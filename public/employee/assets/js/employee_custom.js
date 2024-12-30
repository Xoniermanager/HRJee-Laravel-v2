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


$(document).ready(function() {
   
    $("#start-timer").on("click", function() {
        $.ajax({
            url: employeeAttendanceUrl, // Ensure this route is correct
            type: 'GET',
            success: function(response) {

                console.log(response);
                if(response.success){
                    // $("#start-timer").hide();
                    // $("#current-time").hide();
                    Swal.fire("Success!", response.message, "success").then(() => {
                        location.reload();
                    });
                }else{
                    Swal.fire("Error!", response.message, "danger");
                }
            },
            error: function(error_messages) {
                let errors = error_messages.responseJSON.errors;
                for (var error_key in errors) {
                    console.log(error_key, '--', rrors[error_key]);
                }
            }
        });
    });
    $("#stop-timer").on("click", function() {
        $.ajax({
            url: employeeAttendanceUrl, // Ensure this route is correct
            type: 'GET',
            success: function(response) {
                if(response.success){
                    Swal.fire("Success!", response.message, "success").then(() => {
                        location.reload();
                    });
                }else{
                    Swal.fire("Error!", response.message, "danger");
                }
            },
            error: function(error_messages) {
                let errors = error_messages.responseJSON.errors;
                for (var error_key in errors) {
                    console.log(error_key, '--', rrors[error_key]);
                }
            }
        });
    });
});


