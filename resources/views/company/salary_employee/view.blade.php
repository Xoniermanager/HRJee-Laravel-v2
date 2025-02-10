@extends('layouts.company.main')
@section('content')
@section('title','Salary Payslip')
<div class="text-center">
    <a href="{{ route('employee_salary.index')}}" class="btn btn-primary btn-sm">Back</a>
    <a href="{{ route('employee_salary.generatePDF',getEncryptId($data['employeeSalary']['id'])) }}" class="btn btn-primary btn-sm">Generate PDF</a>
</div>
@include('salary_temp')
@endsection
