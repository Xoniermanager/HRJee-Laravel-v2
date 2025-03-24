@extends('layouts.employee.main')
@section('content')
@section('title')
    Payslip
@endsection
<div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
    <!--begin::Container-->
    <div class="container-xxl" id="kt_content_container">
            @if (isset($data) && !empty($data))
            <div class="text-end m-5" id="download_btn">
                <input type="hidden" id="year" value="{{\Carbon\Carbon::now()->subMonth()->format('Y') }}">
                <input type="hidden" id="month" value="{{ \Carbon\Carbon::now()->subMonth()->format('n') }}">
                <a href="#" class="btn btn-primary btn-sm" onclick="downloadPaySlip({{ Auth()->user()->id }})">Download PDF</a>
            </div>
            <div>
                @include('salary_temp')
            </div>
            @else
            <div class="mt-4">
                <h2 class="text-danger">No Payslip Generate for Previous Month {{ date('F Y', strtotime('last month')) }}</h2>
            </div>
            @endif
    </div>
</div>
@endsection
