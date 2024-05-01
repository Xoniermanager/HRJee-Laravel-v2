@extends('layouts.main')

@section('title', 'main')

@section('content')
<div class="card card-body col-md-12">
								<div class="card-header cursor-pointer p-0">
									<!--begin::Card title-->
									<div class="card-title m-0">
										<h3 class="fw-bold m-0"> Add Department</h3>
									</div>
									<!--end::Card title-->
								</div>
								<div class="mb-5 mb-xl-10"> 
												<div class="card-body py-3">
												<form method="post" action="{{ isset($department) ? route('update.departments', ['id' => $department->id]) : route('add.departments')}}">

														@csrf
														@if(isset($department))
															@method('patch')
														@endif
														<table class="_table table  dt-responsive nowrap">
															<thead>
															  <tr>
																<th>Department Name</th>
										
															  </tr>
															</thead>
															<tbody id="table_body">
															  <tr>
																<td>
																<input type="text" class="form-control mb-3" name="name" value="{{ isset($department) ? $department['name'] : '' }}">
																	@error('name')
																		<span class="text-red-500">{{ $message }}</span>
																	@enderror
																</td>
															  </tr>
															</tbody>
														  </table> 
														  
														  @if(isset($department))
																<button class="btn btn-primary">update</button>
															@else
																<button class="btn btn-primary">save</button>
															@endif
													</form>
												</div>
										 
								</div>
							</div>
@endsection
