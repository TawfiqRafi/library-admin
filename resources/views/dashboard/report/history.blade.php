@extends('layouts.dashboard')

@section('content')
    <div class="card shadow">
        <div class="card-header p-3">
            <h3 class="mb-0">All-Time Borrow History</h3>
        </div>
        <div class="card-body">
            <!-- Search Form -->
            <form class="mb-3" method="GET" action="{{ route('report.history') }}">
                <div class="d-flex gap-2 flex-nowrap">
                    <input type="text" name="search" value="{{ $search }}" class="form-control" placeholder="Search by user or book title">
                    <button type="submit" class="btn btn-primary text-nowrap btn-sm px-3">Search</button>
                </div>
            </form>

            <table class="table table-bordered align-middle table-hover">
                <thead class="text-nowrap" style="min-width: 700px">
                    <tr>
                        <th>Sl</th>
                        <th>User</th>
                        <th>Book Title</th>
                        <th>Author</th>
                        <th>BarCode</th>
                        <th>Borrowed At</th>
                        <th>Returned At</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($borrowings as $key => $borrowing)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $borrowing->user->name }}</td>
                        <td>{{ $borrowing->book->title }}</td>
                        <td>{{ $borrowing->book->author }}</td>
                        <td>
                            <div style="min-width: 200px">
                                @php
                                    $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
                                @endphp
                                <img src="data:image/png;base64,{{ base64_encode($generator->getBarcode($borrowing->book->barcode, $generator::TYPE_CODE_128)) }}" alt="Barcode">
                                <div class="mt-2">
                                    {{ $borrowing->book->barcode }}
                                </div>
                            </div>
                        </td>
                        <td>{{ $borrowing->borrowed_at->format('Y-m-d H:i') }}</td>
                        <td>
                            @if ($borrowing->returned_at)
                                {{ $borrowing->returned_at->format('Y-m-d H:i') }}
                            @else
                                <span class="text-warning">Not Returned</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <!-- Pagination Links -->
            <div class="d-flex justify-content-center">
                {{ $borrowings->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
@endsection
