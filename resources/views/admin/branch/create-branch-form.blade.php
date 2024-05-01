@extends('layouts.main')

@section('title', 'main')

@section('content')

<div class="card card-body col-md-12">
								<div class="card-header p-4">
									<!--begin::Card title-->
									<div class="card-title m-0">
										<h3 class="fw-bold m-0"> Add Branch</h3>
									</div>
									<!--end::Card title-->
								</div>

								<div class="mb-5 mb-xl-10">
									<div class="card-body">
                                    <form method="post" action="{{ isset($branch) ? route('update.branch', ['id' => $branch->id]) : route('add.branch')}}">
                            @csrf
                            @if(isset($branch))
                                @method('patch')
                            @endif
<table class="_table table dt-responsive nowrap"  style="width:75%; cellspacing:0;">
    <thead>
        <tr>
            <th>Field</th>
            <th>Value</th>
        </tr>
    </thead>
    <tbody id="table_body">
    <tr>
        <td>Branch Name</td>
        <td>
            <input type="text" class="form-control mb-3" name="name" value="{{ isset($branch) ? $branch['name'] : old('name') }}">
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </td>
    </tr>
    <tr>
    <td>Branch Type</td>
    <td>
                <select class="form-select mb-3" name="branch_type">
                <option value="">Select Branch Type</option>
                <option value="Primary" {{ (old('branch_type') == 'Primary') ? 'selected' : '' }}>Primary</option>
                <option value="Secondary" {{ (old('branch_type') == 'Secondary') ? 'selected' : '' }}>Secondary</option>
            </select>
                @error('branch_type')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </td>
        </tr>

        <tr>
    <td>Contact Number</td>
    <td>
        <input type="text" class="form-control mb-3" name="contact_no" value="{{ isset($branch) ? $branch['contact_no'] : old('contact_no') }}">
        @error('contact_no')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </td>
</tr>
<tr>
    <td>Email</td>
    <td>
        <input type="text" class="form-control mb-3" name="email" value="{{ isset($branch) ? $branch['email'] :  old('email') }}">
        @error('email')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </td>
</tr>
<tr>
    <td>Branch HR Email</td>
    <td>
        <input type="text" class="form-control mb-3" name="hr_email" value="{{ isset($branch) ? $branch['hr_email'] :  old('hr_email')}}">
        @error('hr_email')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </td>
</tr>

<tr>
    <td>Branch Address</td>
    <td>
        <input type="text" class="form-control mb-3" name="address" value="{{ isset($branch) ? $branch['address'] :  old('address') }}">
        @error('address')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </td>
</tr>
<tr>
    <td>Branch City</td>
    <td>
        <input type="text" class="form-control mb-3" name="city" value="{{ isset($branch) ? $branch['city'] :  old('city') }}" >
        @error('city')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </td>
</tr>
<tr>
    <td>Branch Pincode</td>
    <td>
        <input type="text" class="form-control mb-3" name="pincode" value="{{ isset($branch) ? $branch['pincode'] :  old('pincode') }}">
        @error('pincode')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </td>
</tr>
<tr>
    <td>State</td>
    <td>
        <select class="form-select mb-3" name="state">
            <option value="">Select States</option>
            @foreach ($states as $state)
                <option value="{{ $state->id }}" {{ (collect(old('state'))->contains($state->id)) ? 'selected':'' }}>
                    {{ $state->name }}
                </option>
            @endforeach
        </select>
        @error('state')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </td>
</tr>
<tr>
    <td>Country</td>
    <td>
    <select class="form-select mb-3" name="country">
    <option value="">Select Country</option>
    <option value="1" {{ (old('country') == '1') ? 'selected' : '' }}>India</option>
    <option value="2" {{ (old('country') == '2') ? 'selected' : '' }}>Sri Lanka</option>
    <option value="3" {{ (old('country') == '3') ? 'selected' : '' }}>Bangladesh</option>
    <option value="4" {{ (old('country') == '4') ? 'selected' : '' }}>Pakistan</option>
</select>

        @error('country_id')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </td>
</tr>

    </tbody>
</table>

                        @if(isset($branch))
                            <button class="btn btn-primary">update</button>
                        @else
                            <button class="btn btn-primary">save</button>
                        @endif
										</form>
									</div>
								</div>
							</div>

@endsection
<style>
    /* Reduce spacing between table cells */
    table._table td {
        padding: 5px; /* Adjust the padding value as needed */
    }
	
</style>