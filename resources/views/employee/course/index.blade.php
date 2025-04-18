@extends('layouts.employee.main')
@section('content')
@section('title','Course')
<!--begin::Header-->
<!--end::Header-->
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
    <!--end::Container-->
<div class="container-xxl">
    <section class="blog" data-scroll-index="4">
        <div class="container">
            <!-- header of section -->
            <div class="blog-head text-center">
                <h6>latest Course</h6>
            </div>
            <!-- blog items -->
            <div class="row">
                @forelse ($allCourseDetails as $item)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="item">
                            <div class="img">
                                <img src="{{ asset('assets/course.png') }}" alt="">
                            </div>
                            <div class="info">
                                <div class="date">
                                    <span>{{ date('d', strtotime($item->created_at)) }}<br>{{ date('M', strtotime($item->created_at)) }}</span>
                                </div>
                                    <h5>{{ $item->title }}</h5>
                                <a href="{{ route('employee.course.details', $item->id) }}"
                                    class="user"><i class="fas fa-eye"></i>Read More</a>
                                <a href="{{ route('employee.course.details', $item->id) }}"
                                    class="more"><i class="fas fa-long-arrow-alt-right"></i></a>
                            </div>
                        </div>
                    </div>
                @empty
                    <td colspan="3">
                        <span class="text-danger">
                            <strong>No Course Available!</strong>
                        </span>
                    </td>
                @endforelse
            </div>
        </div>
    </section>
</div>
</div>
<!--end::Content-->
@endsection
