@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>Kehadiran</h1>
    @if(Auth::user()->role != 'admin')
    <a class="text-white btn btn-primary mb-3" href="{{ route('absen.create') }}">Absen</a>
    @endif
    <table id="attendanceTable" class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Jam Masuk</th>
                <th>Jam Keluar</th>
                <th>Durasi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($attendance as $record)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $record->user->name ?? 'Unknown User' }}</td>
                    <td>{{ \Carbon\Carbon::parse($record->check_in)->format('d M Y H:i:s') }}</td>
<td>{{ $record->check_out ? \Carbon\Carbon::parse($record->check_out)->format('d M Y H:i:s') : 'Not Checked Out' }}</td>
                    <td>{{ $record->duration ?? 'N/A' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
@push('scripts')
<!-- Tambahkan script DataTables -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#attendanceTable').DataTable({
            paging: true,
            ordering: true,
            searching: true,
            pageLength: 5,
        });
    });
</script>