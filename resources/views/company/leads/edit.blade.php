@extends('layouts.company.main')
@section('content')
@section('title')
    Edit Lead
@endsection
<div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
    <!--begin::Container-->
    <div class="container-xxl" id="kt_content_container">
        <!--begin::Row-->
        <div class="col-lg-12 col-xl-12 col-xxl-12 mb-5">
            <!--begin::Timeline widget 3-->
            <div class="card h-md-100">
                <!--begin::Header-->
                <div class="card-header p-0 align-items-center">
                    <div class="card-body">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    jQuery(document).ready(function() {
        var check_condition = {{ $editLeadDetails->all_department }}
        if (check_condition == 0) {
            get_designation_by_department_id({{ $selectedDesignationId ?? '' }});
        }
    });
</script>
@endsection
