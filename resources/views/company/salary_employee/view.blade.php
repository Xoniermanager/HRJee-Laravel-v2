@extends('layouts.company.main')
@section('content')
@section('title', 'Salary Payslip')
    <div class="container-fluid pb-0">
        <div class="col-md-12">
            <div class="card card-body mb-0">
                <div class="row">
                    <div class="col-md-3">
                        <select name="year" class="form-control min-w-250px" id="year">
                            <option value="">Select Year</option>
                            @for ($i = date('Y', strtotime('-1 year')); $i <= date('Y'); $i++)
                                <option value="{{ $i }}" {{ $i == date('Y') ? 'selected' : '' }}>
                                    {{ $i }}
                                </option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="month" class="form-control min-w-250px ml-10" id="month">
                            <option value="">Select Month</option>
                            @php
                                $currentMonth = date('m', strtotime('-1 month'));
                                $months = fullMonthList();
                            @endphp
                            @foreach (range(1, $currentMonth) as $month)
                                <option value="{{ $month }}"> {{ $months[$month] }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-5">
                        <div class="">
                            <a href="#" onclick="getPayslip({{ $userId }})" class="btn btn-primary btn-sm">View</a>
                            <a href="{{ route('employee_salary.index')}}" class="btn btn-danger btn-sm">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="text-end m-5" id="download_btn" style="display: none">
        <a href="#" class="btn btn-primary btn-sm" onclick="downloadPaySlip({{ $userId }})">Download PDF</a>
    </div>
    <div id="payslip_html">
    </div>
    <script>
        var months = @json(fullMonthList());
        $('#year').on('change', function () {
            var yearValue = this.value;
            var currentYear = {{ date('Y') }};
            var currentMonth = {{ date('m', strtotime('-1 month')) }};
            var options = '';
            if (yearValue != currentYear) {
                options = `<option value="">Select the Month</option>`;
                $.each(months, function (key, month) {
                    options += `<option value="${key}">${month}</option>`;
                });
            } else {
                for (var i = 1; i <= currentMonth; i++) {
                    var monthStr = i.toString();
                    options +=
                        `<option value="${monthStr}" ${monthStr == currentMonth ? 'selected' : ''}>${months[monthStr]}</option>`;
                }
            }
            $('#month').html(options);
        });

        function getPayslip(userId) {
            $('#payslip_html').html("");
            $.ajax({
                type: 'GET',
                url: company_ajax_base_url + '/employee-salary/show/payslip',
                data: {
                    'year': $('#year').val(),
                    'month': $('#month').val(),
                    'user_id': userId
                },
                success: function (response) {
                    if (response.status) {
                        $('#download_btn').show();
                        $('#payslip_html').html(response.data);
                    } else {
                        $('#download_btn').hide();
                        $('#payslip_html').html("");
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: response.message,
                        });
                    }
                }
            });
        }

        function downloadPaySlip(userId) {
            $.ajax({
                type: 'get',
                url: "{{ route('employee_salary.generatePDF') }}",
                data: {
                    'year': $('#year').val(),
                    'month': $('#month').val(),
                    'user_id': userId
                },
                xhrFields: {
                    responseType: 'blob'
                },
                success: function (response, status, xhr) {
                    var blob = response;
                    var link = document.createElement('a');
                    var filename = xhr.getResponseHeader('Content-Disposition').split(
                        'filename=')[1].replace(/"/g, '');
                    link.href = URL.createObjectURL(blob);
                    link.download = filename;
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                    // SweetAlert notification after download is triggered
                    Swal.fire({
                        title: 'Download Complete',
                        text: 'Your Payslip has been successfully downloaded!',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                },
                error: function () {
                    $('#download_btn').hide();
                    console.log("Export failed");
                }
            });
        }
    </script>
@endsection
