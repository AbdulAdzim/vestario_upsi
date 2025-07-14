@extends('layouts.admin')

@section('title', 'Manage Busana & Bookings')

@section('content')
<style>
    body {
        background-color: #f4f6f8;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: #333;
    }

    .container {
        max-width: 1140px;
        margin: auto;
        padding: 30px;
        background-color: #fff;
        border-radius: 12px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
    }

    .nav-tabs .nav-link {
        padding: 10px 20px;
        font-weight: 500;
        border-radius: 8px 8px 0 0;
        color: #555;
    }

    .nav-tabs .nav-link.active {
        background-color: #0d6efd;
        color: #fff;
        font-weight: 600;
    }

    h1 {
        font-size: 2rem;
        font-weight: bold;
        margin-bottom: 30px;
        color: #2c3e50;
    }

    h3 {
        margin-top: 20px;
        font-weight: 600;
        color: #374151;
        font-size: 1.2rem;
    }

    label {
        font-weight: 500;
        margin-top: 15px;
        display: block;
    }

    input[type="text"],
    input[type="date"],
    textarea,
    select,
    input[type="file"] {
        width: 100%;
        padding: 10px 14px;
        margin-top: 5px;
        border-radius: 8px;
        border: 1px solid #ced4da;
        background-color: #fdfdfd;
        transition: border-color 0.2s;
    }

    input:focus,
    textarea:focus,
    select:focus {
        border-color: #0d6efd;
        outline: none;
    }

    .size-options label {
        margin-right: 10px;
        font-weight: normal;
        margin-top: 5px;
    }

    .btn {
        padding: 8px 16px;
        border-radius: 6px;
        font-weight: 500;
        transition: background-color 0.2s;
    }

    .btn-success {
        background-color: #198754;
        color: white;
        border: none;
    }

    .btn-danger {
        background-color: #dc3545;
        color: white;
        border: none;
    }

    .btn:hover {
        opacity: 0.9;
    }

    .btn-close {
        float: right;
    }

    .status-badge {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 600;
        margin-top: 8px;
    }

    .available {
        background-color: #d1e7dd;
        color: #0f5132;
    }

    .not-available {
        background-color: #f8d7da;
        color: #842029;
    }

    .outfit-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-top: 20px;
    }

    .outfit-card {
        border: 1px solid #e0e0e0;
        border-radius: 10px;
        padding: 15px;
        background-color: #fff;
        transition: 0.3s ease-in-out;
        box-shadow: 0 4px 6px rgba(0,0,0,0.03);
    }

    .outfit-title {
        font-size: 16px;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 6px;
    }

    .edit-link {
        color: #0d6efd;
        margin-left: 10px;
        font-size: 0.95rem;
    }

    table.table {
        font-size: 14px;
    }

    th {
        background-color: #f1f5f9;
        font-weight: 600;
        color: #2c3e50;
    }

    td {
        vertical-align: middle;
    }

    .alert-success {
        margin-top: 15px;
    }
</style>

<h1 class="display-5 fw-bold mb-4">Manage Outfit</h1>

<!-- 🔄 Tabs -->
<ul class="nav nav-tabs mb-3" id="busanaTab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="booking-tab" data-bs-toggle="tab" href="#viewBookings" role="tab">View Bookings</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="add-tab" data-bs-toggle="tab" href="#addOutfit" role="tab">Add Outfit</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="list-tab" data-bs-toggle="tab" href="#outfitList" role="tab">Outfit List</a>
    </li>
</ul>

<!-- Tab Content -->
<div class="tab-content" id="busanaTabContent">
    <div class="tab-pane fade show active" id="viewBookings" role="tabpanel">
        @include('admin.outfits.partials.view-bookings')
    </div>
    <div class="tab-pane fade" id="addOutfit" role="tabpanel">
        @include('admin.outfits.partials.add-outfit-form')
    </div>
    <div class="tab-pane fade" id="outfitList" role="tabpanel">
        @include('admin.outfits.partials.outfit-list')
    </div>
</div>
@endsection
