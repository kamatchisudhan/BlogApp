@extends('layouts.app')
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 20px;
        padding: 20px;
    }

    h2 {
        color: #333;
        text-align: center;
    }

    a {
        display: inline-block;
        text-decoration: none;
        background-color: #28a745;
        color: white;
        padding: 8px 15px;
        border-radius: 5px;
        margin-bottom: 10px;
    }

    a:hover {
        background-color: #218838;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background-color: white;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        overflow: hidden;
    }

    table, th, td {
        border: 1px solid #ddd;
    }

    th, td {
        padding: 12px;
        text-align: left;
    }

    th {
        background-color: #007bff;
        color: white;
    }

    td {
        color: #333;
    }

    td a {
        background-color: #007bff;
        padding: 5px 10px;
        border-radius: 3px;
    }

    td a:hover {
        background-color: white;
    }

    form {
        display: inline;
    }

    button {
        background-color: #dc3545;
        color: white;
        padding: 5px 10px;
        border: none;
        border-radius: 3px;
        cursor: pointer;
    }

    button:hover {
        background-color: #c82333;
    }

    p {
        text-align: center;
        font-size: 16px;
        font-weight: bold;
    }
</style>


@section('content')
<h2>Manage Users</h2>
<a href="{{ route('admin.users.create') }}">Create New User</a>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

<table border="1">
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Role</th>
        <th>Actions</th>
    </tr>
    @foreach($users as $user)
    <tr>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->role }}</td>
        <td>
            <a href="{{ route('admin.users.edit', $user->id) }}">Edit</a>
            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection
