@extends('layouts.app')
    
@section('content')
<div class="container mt-5">
        <h1>Daftar Pengguna Terdaftar</h1>  
        @if(Auth::user()->role == 'admin')
    <a href="{{ route('admin.users.export') }}" class="btn btn-success mb-3">  
    <i class="fa-regular fa-file-excel"></i> Download XLS  
    </a>      
    @endif
        <!-- Tombol Back -->  
        <a href="{{ route('absen.index') }}" class="btn btn-secondary mb-3">Kembali ke Kehadiran</a>  
  
        @if($users->isEmpty())  
            <div class="alert alert-warning">Tidak ada pengguna terdaftar.</div>  
        @else  
            <table class="table table-striped">  
                <thead>  
                    <tr>  
                        <th>ID</th>  
                        <th>Nama</th>  
                        <th>Email</th>  
                        <th>Tanggal Bergabung</th>  
                        <th>Aksi</th>  
                    </tr>  
                </thead>  
                <tbody>  
                    @foreach ($users as $user)  
                        <tr>  
                            <td>{{ $user->id }}</td>  
                            <td>{{ $user->name }}</td>  
                            <td>{{ $user->email }}</td>  
                            <td>{{ $user->created_at->format('d-m-Y') }}</td>  
                            <td>  
                                <!-- Tombol Hapus -->  
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">  
                                    @csrf  
                                    @method('DELETE')  
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?');">Hapus</button>  
                                </form>  
                            </td>  
                        </tr>  
                    @endforeach  
                </tbody>  
            </table>  
        @endif  
</div> 
@endsection