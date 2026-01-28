@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card shadow-sm">
            <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                <h4 class="mb-0 text-primary"><i class="bi bi-list-ul"></i> Stored Passwords</h4>
                <a href="{{ route('passwords.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-lg"></i> Add New
                </a>
            </div>
            <div class="card-body">
                @if($passwords->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Website</th>
                                <th>Username</th>
                                <th>Password (Hidden)</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($passwords as $item)
                            <tr>
                                <td class="fw-bold">{{ $item->website_name }}</td>
                                <td>{{ $item->username }}</td>
                                <td>
                                    <div class="input-group input-group-sm" style="max-width: 200px;">
                                        <input type="password" class="form-control" value="********" readonly>
                                    </div>
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('passwords.edit', $item->id) }}" class="btn btn-sm btn-outline-secondary">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    <form action="{{ route('passwords.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                    <div class="text-center py-5">
                        <i class="bi bi-safe h1 text-muted"></i>
                        <p class="text-muted mt-3">No passwords stored yet. Start by adding one!</p>
                        <a href="{{ route('passwords.create') }}" class="btn btn-primary mt-2">Add First Password</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
