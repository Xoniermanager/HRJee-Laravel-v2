@extends('layouts.employee.main')
@section('content')
@section('title', 'Reward Details')
    <div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
        <!--begin::Container-->
        <div class="container-xxl" id="kt_content_container">
            <!--begin::Row-->
            <div class="container py-5">
                <div class="card border-0 rounded-4 p-5 bg-white">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped text-center align-middle shadow-sm rounded overflow-hidden">
                            <tbody>
                                <tr>
                                    <th>Date</th>
                                    <td class="fw-semibold p-3">{{ getFormattedDate($rewardDetail->date) }}</td>
                                </tr>
                                <tr>
                                    <th>Reward Category</th>
                                    <td class="fw-boldp-3">{{ $rewardDetail->rewardCategory->name }}</td>
                                </tr>
                                <tr>
                                    <th>Reward</th>
                                    <td class="fw-bold text-success p-3">{{ $rewardDetail->reward_name }}</td>
                                </tr>
                                <tr>
                                    <th>Description</th>
                                    <td class="text-muted p-3">{{ $rewardDetail->description ?? ''}}</td>
                                </tr>
                                @if ($rewardDetail->getRawOriginal('image'))
                                <tr>
                                    <th>Certificate</th>
                                    <td class="p-3">
                                            <img src="{{ $rewardDetail->image }}" alt="Reward Image" class="img-fluid rounded shadow-sm" style="max-width: 250px; height: auto;">
                                    </td>
                                </tr>
                                @endif
                                @if ($rewardDetail->getRawOriginal('document'))
                                <tr>
                                    <th >Document</th>
                                    <td class="p-3">
                                            <div class="d-flex flex-column align-items-center">
                                                <iframe src="{{ $rewardDetail->document }}" width="50%" height="300px" class="border rounded shadow-sm mb-3"></iframe>
                                                <a href="{{ $rewardDetail->document }}" download class="btn btn-danger shadow">
                                                    <i class="fa fa-file-pdf fs-3 me-2"></i> Download
                                                </a>
                                            </div>
                                    </td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
