@extends('layouts.dashboard')

@section('content')
    <div class="card shadow">
        <div class="card-header d-flex justify-content-between align-items-center p-3">
            <h3 class="mb-0">Currently Borrowed Books</h3>
        </div>
        <div class="card-body">
            <!-- Search Form -->
            <form class="mb-3" method="GET" action="{{ route('report.current') }}">
                <div class="d-flex gap-2 flex-nowrap">
                    <input type="text" name="search" value="{{ $search }}" class="form-control" placeholder="Search by user or book title">
                    <button type="submit" class="btn btn-primary text-nowrap btn-sm px-3">Search</button>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-bordered align-middle table-hover" style="min-width: 700px">
                    <thead class="text-nowrap">
                        <tr>
                            <th>Sl</th>
                            <th>User</th>
                            <th>Book Title</th>
                            <th>Author</th>
                            <th>BarCode</th>
                            <th>Borrowed At</th>
                            <th class="text-center">Actions</th>
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
                                    <div class="mt-2">{{ $borrowing->book->barcode }}</div>
                                </div>
                            </td>
                            <td>{{ $borrowing->borrowed_at->format('Y-m-d H:i') }}</td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <form action="{{ route('report.return', $borrowing->id) }}" method="POST" class="return-book-form">
                                        @csrf
                                        @method('POST')
                                        <button type="submit" class="btn btn-success btn-sm text-nowrap" onclick="formSubmit(this, event)">Mark as Returned</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @if ($borrowings->isEmpty())
                <div class="alert alert-warning text-center mt-3">
                    No borrow history found.
                </div>
            @endif
            <!-- Pagination Links -->
            <div class="d-flex justify-content-center">
                {{ $borrowings->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
@endsection
