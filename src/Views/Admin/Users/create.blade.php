@extends('layouts.master')

@section('title')
    Thêm mới người dùng
    
@endsection

@section('content')
    <h2>Welcome to admin</h2>

    @if (!empty($_SESSION['errors']))
        <div class="alert alert-warning">
            <ul>
                @foreach ($_SESSION['errors'] as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            
             @php
                 unset($_SESSION['errors']);
             @endphp
        </div>
    @endif

    <form action="{{ url('admin/users/store') }}" enctype="multipart/form-data" method="POST">
        <div class="mb-3 mt-3">
            <label for="name" class="form-label">Name:</label>
            <input type="text" class="form-control" id="name" placeholder="Enter name" name="name">
        </div>
        <div class="mb-3 mt-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
        </div>
        <div class="mb-3 mt-3 ">
            <select class="form-select" name="role" id="role">
                <option value="1">Admin</option>
                <option value="0" selected>Client</option>
            </select>
        </div>
        <div class="mb-3 mt-3">
            <label for="avatar" class="form-label">Avatar:</label>
            <input type="file" class="form-control" id="avatar" placeholder="Enter avatar" name="avatar">
        </div>
        <div class="mb-3 mt-3">
            <label for="password" class="form-label">Password:</label>
            <input type="text" class="form-control" id="password" placeholder="Enter password" name="password">
        </div>
        <div class="mb-3 mt-3">
            <label for="password" class="form-label">Confirm Password:</label>
            <input type="text" class="form-control" id="confirm_password" placeholder="confirm password"
                name="confirm_password">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    
@endsection



