@extends('layouts.company.main')

@section('title', 'main')

@section('content')
<div class="card card-body col-md-12">
								<div class="card-header cursor-pointer p-0">
									<!--begin::Card title-->
									<div class="card-title m-0">
										<h3 class="fw-bold m-0"> Add Designation</h3>
									</div>
									<!--end::Card title-->
								</div>
								<div class="mb-5 mb-xl-10"> 
												<div class="card-body py-3">
												<form method="post" action="{{ isset($designation) ? route('update.designations', ['id' => $designation->id]) : route('add.designations')}}">

														@csrf
														@if(isset($designation))
															@method('patch')
														@endif
														<table class="_table table  dt-responsive nowrap">
															<thead>
															  <tr>
																<th>Select Department</th>
															  </tr>
															</thead>
															<tbody id="table_body">
															  <tr>
																<td>
																<select class="form-select mb-3" name="department_id">
																	<option value="">Select Department</option>
																	@foreach ($departments as $dept)
																		<option value="{{ $dept->id }}" {{ isset($designation) && $designation->department_id == $dept->id ? 'selected' : '' }}>
																			{{ $dept->name }}
																		</option>
																	@endforeach
																</select>																	
																<!-- @error('name')
																		<span class="text-red-500">{{ $message }}</span>
																	@enderror -->
																</td>
															  </tr>
															  
															</tbody>
														  </table> 
														<table class="_table table  dt-responsive nowrap">
															<thead>
															  <tr>
																<th>Designation Name</th>
															  </tr>
															</thead>
															<tbody id="table_body">
															  <tr>
																<td>
																<input type="text" class="form-control mb-3" name="name" value="{{ isset($designation) ? $designation['name'] : '' }}">
																	@error('name')
																		<span class="text-red-500">{{ $message }}</span>
																	@enderror
																</td>
															  </tr>
															  
															</tbody>
														  </table> 
														  
														  @if(isset($designation))
																<button class="btn btn-primary">update</button>
															@else
																<button class="btn btn-primary">save</button>
															@endif
													</form>
												</div>
										 
								</div>
							</div>
@endsection
