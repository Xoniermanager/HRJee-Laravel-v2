function stop() {
    let punch_in = "{{ $existingDetails->punch_in ?? '' }}";
    let punch_out = "{{ $existingDetails->punch_out ?? '' }}";
    $("#start-timer").hide();
    $("#stop-timer").hide();
    if (punch_out != 'NULL') {
        var StartedTime = new Date(punch_in).getTime();
        var EndedTime = new Date(punch_out).getTime();

        var diff = EndedTime - StartedTime;
        var hours = Math.floor(diff / 3.6e6);
        var minutes = Math.floor((diff % 3.6e6) / 6e4);
        var seconds = Math.floor((diff % 6e4) / 1000);
        let h = hours < 10 ? '0' + hours : hours;
        let m = minutes < 10 ? '0' + minutes : minutes;
        let s = seconds < 10 ? '0' + seconds : seconds;
        var duration = h + ":" + m + ":" + s;
        timeLaps = duration;
        $("#timer").text(timeLaps);
    }
}
function get_timer_clock(punch_in, punch_out) {
    var refreshIntervalId = '';
    if (punch_in != '' && punch_out == '') {
        $("#start-timer").hide();
        $("#stop-timer").show();
        let timeLaps = '';
        $("#timer").show();
        var StartedTime = new Date(punch_in).getTime();
        refreshIntervalId = setInterval(() => {
            var EndedTime = new Date().getTime();
            var diff = EndedTime - StartedTime;
            var hours = Math.floor(diff / 3.6e6);
            var minutes = Math.floor((diff % 3.6e6) / 6e4);
            var seconds = Math.floor((diff % 6e4) / 1000);
            let h = hours < 10 ? '0' + hours : hours;
            let m = minutes < 10 ? '0' + minutes : minutes;
            let s = seconds < 10 ? '0' + seconds : seconds;
            var duration = h + ":" + m + ":" + s;
            timeLaps = duration;
            $("#timer").text(timeLaps);

        }, 1);
    } else if (punch_out != '') {
        $("#start-timer").hide();
        $("#stop-timer").hide();
        clearInterval(refreshIntervalId);
        $("#timer").show();
        if (punch_out) {
            var StartedTime = new Date(punch_in).getTime();
            var EndedTime = new Date(punch_out).getTime();

            var diff = EndedTime - StartedTime;
            var hours = Math.floor(diff / 3.6e6);
            var minutes = Math.floor((diff % 3.6e6) / 6e4);
            var seconds = Math.floor((diff % 6e4) / 1000);
            let h = hours < 10 ? '0' + hours : hours;
            let m = minutes < 10 ? '0' + minutes : minutes;
            let s = seconds < 10 ? '0' + seconds : seconds;
            var duration = h + ":" + m + ":" + s;
            timeLaps = duration;
            $("#timer").text(timeLaps);
        }
    } else {
        $("#start-timer").show();
        $("#stop-timer").hide();
        $("#timer").hide();
    }
}