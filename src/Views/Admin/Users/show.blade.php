@extends('layouts.master')

@section('title')

Chi tiết người dùng: {{ $user['name'] }}
    
@endsection

@section('content')

    <h2>Welcome to admin</h2>
    
    <table class="table table-success">
        <thead>
            <tr>
                <th class="table-primary">Trường </th>
                <th class="table-primary">Giá trị</th>
            
                
            </tr>
        </thead>
        <tbody>
            @foreach ($user as $field => $value)
                <tr>
                    <td class="table-info">{{ $field }}</td>
                    <td class="table-info">{{ $value }}</td>
                    
                </tr>
        </tbody>
        @endforeach
    </table>
@endsection


