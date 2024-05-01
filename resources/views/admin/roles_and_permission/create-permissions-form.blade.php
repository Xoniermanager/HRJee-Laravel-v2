@extends('layouts.main')

@section('title', 'main')

@section('content')
<div class="card card-body col-md-12">
								<div class="card-header cursor-pointer p-0">
									<!--begin::Card title-->
									<div class="card-title m-0">
										<h3 class="fw-bold m-0"> Add permission</h3>
									</div>
									<!--end::Card title-->
								</div>
								<div class="mb-5 mb-xl-10"> 
												<div class="card-body py-3">
												<form method="post" action="{{ isset($permissions) ? route('update.permissions', ['id' => $permissions->id]) : route('add.permissions')}}">

														@csrf
														@if(isset($permissions))
															@method('patch')
														@endif
												
													
														<table class="_table table  dt-responsive nowrap">
															<thead>
															  <tr>
																<th>permission Name</th>
															  </tr>
															</thead>
															<tbody id="table_body">
															  <tr>
																<td>
																<input type="text" class="form-control mb-3" name="name" value="{{ isset($permissions) ? $permissions['name'] : '' }}">
																	@error('name')
																		<span class="text-red-500">{{ $message }}</span>
																	@enderror
																</td>
															  </tr>
															  
															</tbody>
														  </table> 
														  
														  @if(isset($permissions))
																<button class="btn btn-primary">update</button>
															@else
																<button class="btn btn-primary">save</button>
															@endif
													</form>
												</div>
										 
								</div>
							</div>
@endsection
