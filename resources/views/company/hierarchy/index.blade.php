@extends('layouts.company.main')
@section('title', 'Hierarchy Management')
@section('content')
<style>
.hierarchy {
    list-style-type: none;
    padding-left: 10px;
}
.hierarchy-item {
    position: relative;
    padding: 5px 15px;
    border-radius: 8px;
    background: #f0fcfe;
    margin: 5px 0;
    box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
    cursor: pointer;
    transition: 0.3s;
    border: 1px solid #a4ebf8;
}

.hierarchy-item:hover {
    background: #eef5ff;
}

.inner-hierarchy {
    list-style-type: none;
    padding-left: 20px;
    margin-left: 10px;
    border-left: 2px solid #ccc;
    display: none; /* Hide nested employees by default */
}

.toggle-btn {
    font-size: 14px;
    cursor: pointer;
    margin-right: 10px;
    color: #007bff;
    font-weight: bold;
    transition: 0.3s;
}

.toggle-btn:hover {
    color: #0056b3;
}
.min-h-auto {
    min-height: auto !important;
}
.employee-name {
    font-weight: bold;
    color: #333;
}
.employee-count {
    background: #28a745;
    color: #fff;
    font-size: 12px;
    font-weight: bold;
    padding: 4px 10px;
    border-radius: 12px;
    margin-left: 10px;
    min-width: 20px;
    text-align: center;
    display: inline-block;
}
</style>
<div class="container">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header p-5 min-h-auto">
                <h4 class="m-0">Hierarchy</h4>
            </div>
            <div class="card-body">
                <ul class="hierarchy">
                    @include('company.hierarchy.item', ['user' => $companyDetail])
                </ul>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".toggle-btn").forEach(function (btn) {
            btn.addEventListener("click", function () {
                let nestedList = this.parentElement.querySelector(".inner-hierarchy");
                if (nestedList) {
                    let isVisible = nestedList.style.display === "block";
                    nestedList.style.display = isVisible ? "none" : "block";
                    this.textContent = isVisible ? "▶" : "▼"; // Toggle icon
                }
            });
        });
    });
    </script>
@endsection
