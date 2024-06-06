@extends('layouts.master')

@section('title')
    Danh sách User
@endsection

@section('content')
    <h2>Welcome to admin</h2>


    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="white_card card_height_100 mb_30">
                <div class="white_card_header">
                    <div class="box_header m-0">
                        <div class="main-title">
                            <h1 class="m-0">Danh sách User</h1>
                        </div>
                    </div>
                </div>
                <div class="white_card_body">

                    <a href="{{ url('admin/users/create') }}" class="btn  btn-primary mb-2">Thêm người dùng</a>

                    @if (isset($_SESSION['status']) && $_SESSION['status'])
                        <div class="alert alert-warning">
                            {{ $_SESSION['msg'] }}
                            @php
                                unset($_SESSION['status']);
                                unset($_SESSION['msg']);
                            @endphp
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-success mt-2">
                            <thead>
                                <tr>
                                    <th class="table-primary">ID</th>
                                    <th class="table-primary">IMAGE</th>
                                    <th class="table-primary">NAME</th>
                                    <th class="table-primary">EMAIL</th>
                                    <th class="table-primary">ROLE</th>
                                    <th class="table-primary">CREATE AT</th>
                                    <th class="table-primary">UPDATE AT</th>
                                    <th class="table-primary">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td class="table-info"><?= $user['id'] ?></td>
                                        <td class="table-info">
                                            <img src="{{ asset($user['avatar']) }}" alt="" width="100px">
                                        </td>
                                        <td class="table-info"><?= $user['name'] ?></td>
                                        <td class="table-info"><?= $user['email'] ?></td>
                                        <td class="table-info"><?= $user['role'] == 1 ? 'Admin' $$  : 'Client' ?></td>
                                        <td class="table-info"><?= $user['create_at'] ?></td>
                                        <td class="table-info"><?= $user['update_at'] ?></td>
                                        <td class="table-info">

                                            <a class="btn btn-warning" type="submit"
                                                href="{{ url('admin/users/' . $user['id'] . '/edit') }}">Edit</a>

                                            <a class="btn btn-success" type="submit"
                                                href="{{ url('admin/users/' . $user['id'] . '/show') }}">Show</a>

                                            <a onclick="return confirm('Chắc muốn xóa không?')" class="btn btn-danger mt-1"
                                                type="submit"
                                                href="{{ url('admin/users/' . $user['id'] . '/delete') }}">Delete</a>

                                        </td>
                                    </tr>
                            </tbody>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
