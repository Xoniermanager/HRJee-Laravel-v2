@extends('layouts.company.main')
@section('content')
@section('title')
    Reports
@endsection
@php
    $userType = Auth()->user()->userRole->name;
@endphp
<div class="row g-5 g-xl-10 mb-5 mb-xl-10">
    <!--begin::Col-->
    <div class="col-md-12">

        <!--begin::Chart Widget 35-->
        <div class="card card-flush h-md-100 mt-5">
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible">
                    {{ session('error') }}
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success alert-dismissible">
                    {{ session('success') }}
                </div>
            @endif
            <!--begin::Body-->
            <div class="card-body px-0">
                <!--begin::Table container-->
                <div class="mx-9">
                    <!--begin::Table-->

                    <form action="{{ route('report.generate') }}" method="GET" class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Report Type</label>
                            <select class="form-select" name="type" required>
                                <option value="" disabled selected>Select Report Types</option>
                                <option value="Connector">Connector</option>
                                @if ($userType != 'Connector')
                                <option value="Audit">Audit</option>
                                <option value="Lead">Lead</option>
                                @endif
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">From Date</label>
                            <input type="date" class="form-control" name="from_date" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">To Date</label>
                            <input type="date" class="form-control" name="to_date" required>
                        </div>
                        <div class="col-md-12 mb-3">
                            <button class="btn btn-sm btn-primary" type="submit">Download</button>
                        </div>
                    </form>
                    <!--end::Table-->
                </div>
                <!--end::Table container-->

            </div>
            <!--end::Body-->
        </div>
        <!--end::Chart Widget 35-->
    </div>
    <!--end::Col-->

</div>
@endsection
