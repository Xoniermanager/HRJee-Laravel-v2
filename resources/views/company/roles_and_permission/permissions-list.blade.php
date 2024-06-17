@extends('layouts.company.main')

@section('title', 'main')

@section('content')
<div class="card card-body col-md-12">
								<div class="card-header cursor-pointer p-0">
									<!--begin::Card title-->
									<div class="card-title m-0">
									 
									</div>
									<!--end::Card title-->
									<!--begin::Action-->
									<a href="{{ route('create.permissions.form')}}" class="btn btn-sm btn-primary align-self-center">
									Add	permissions</a>
									<!--end::Action-->
								</div>

								<div class="mb-5 mb-xl-10">

									<div class="">
										<div class="">
											<!--begin::Body-->
											<div class="">
												<div class="card-body py-3">
													<!--begin::Table container-->
													<div class="table-responsive">
														<!--begin::Table-->
														<table
															class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
															<!--begin::Table head-->
															<thead>
																<tr class="fw-bold">
																	<th>Sr. No.</th>
																	<th>permissions Name</th>
																	
																	<th>Created Date</th> 
																	<th class="float-right">Action</th>
																</tr>
															</thead>
															<!--end::Table head-->
															<!--begin::Table body-->
															<tbody class="">
															@forelse ($permissions as $index => $permissions)
																<tr>
																	
																	<td>{{$index+1}}</td>
																	<td> {{isset($permissions->name) ? $permissions->name : '';}}	</td>
																	<td> {{isset($permissions->created_at)? $permissions->created_at:''}}  </td>
																	<td>
																		<div class="d-flex justify-content-end flex-shrink-0">
																			<a href="{{ route('edit.permissions', ['id'=>$permissions->id]) }}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
																				<!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
																				<i class="fa fa-edit"></i>
																				<!--end::Svg Icon-->
																			</a>
																			<a href="{{ route('delete.permissions', ['id'=> $permissions->id ]) }}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
																				<!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
																				<i class="fa fa-trash"></i>
																				<!--end::Svg Icon-->
																			</a>

																		</div>
																	</td>
																</tr>
																@empty
																<tr>
																	
																	<td> <p> empty</p>
		
																	</td>
																</tr>
																@endforelse
															</tbody>
															<!--end::Table body-->
														</table>
														<!--end::Table-->
													</div>
													<!--end::Table container-->

												</div>
											</div>
											<!--begin::Body-->

										</div>
										<!--begin::Body-->
									</div>
									<!--begin::Body-->
								</div>
							</div>
@endsection
