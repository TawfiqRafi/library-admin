@extends('layouts.dashboard')

@section('content')
    <div class="mt-4">
        <div class="card shadow">
            <div class="card-header p-3 d-flex justify-content-between align-items-center">
                <h3 class="mb-0">User List</h3>
                <form method="GET" action="{{ route('users.index') }}" class="form-inline">
                    <div class="d-flex gap-2 flex-nowrap">
                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            class="form-control"
                            placeholder="Search users"
                            aria-label="Search users">
                        <button type="submit" class="btn btn-primary text-nowrap btn-sm px-3">
                            <i class="fas fa-search"></i> Search
                        </button>
                    </div>
                </form>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-middle table-bordered table-hover" style="min-width: 600px">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col" class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($users as $key => $user)
                            <tr>
                                <td>{{ $key + 1 + ($users->currentPage() - 1) * $users->perPage() }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td class="text-center">
                                    <a href="{{ route('users.show', $user->id) }}" class="btn btn-sm btn-info text-nowrap">
                                        <i class="fas fa-eye"></i> View Details
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                @if ($users->isEmpty())
                    <div class="alert alert-warning text-center mt-3">
                        No users found.
                    </div>
                @endif

                <div class="d-flex justify-content-center mt-3">
                    {{ $users->appends(['search' => request('search')])->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
