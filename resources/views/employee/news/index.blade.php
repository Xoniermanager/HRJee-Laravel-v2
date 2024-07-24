@extends('layouts.employee.main')
@section('content')
@section('title')
    News
@endsection
<!--begin::Header-->
<!--end::Header-->
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
    <!--begin::Container-->
    <div class="container-xxl" id="kt_content_container">
        <section class="blog" data-scroll-index="4">
            <div class="container">
                <!-- header of section -->
                <div class="blog-head text-center">
                    <h6>latest news</h6>
                </div>
                <!-- blog items -->
                <div class="row">
                    @forelse ($allAssinedNewsDetails as $newsDetails)
                        <div class="col-md-6 col-lg-4 mb-4 ">
                            <div class="item">
                                <div class="img">
                                    <img src="{{ $newsDetails->image }}" alt="" >
                                </div>
                                <div class="info">
                                    <div class="date">
                                        <span>{{ date('d', strtotime($newsDetails->created_at)) }}<br>{{ date('M', strtotime($newsDetails->created_at)) }}</span>
                                    </div> 
                                        <h5>
                                            <span class="category">{{$newsDetails->newsCategories->name}}</span>
                                            {{ $newsDetails->title }}
                                        </h5> 
                                   
                                    <a href="{{ route('employee.news.details', $newsDetails->id) }}" class="user"><i
                                            class="fas fa-newspaper"></i>Read More</a>
                                    <a href="{{ route('employee.news.details', $newsDetails->id) }}" class="more"><i
                                            class="fas fa-long-arrow-alt-right"></i></a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <td colspan="3">
                            <span class="text-danger">
                                <strong>No News Available!</strong>
                            </span>
                        </td>
                    @endforelse
                </div>

            </div>
        </section>
    </div>
</div>
@endsection
