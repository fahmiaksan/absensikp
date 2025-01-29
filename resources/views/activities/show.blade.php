@extends('layouts.app')  
  
@section('content')  
<div class="container">  
    <h1>Detail Aktivitas</h1>  
  
    <h2>{{ $activity->name }}</h2>  
    <p><strong>Deskripsi:</strong> {{ $activity->activity_text }}</p>  
    <p><strong>Status:</strong> {{ ucfirst($activity->status) }}</p>  
    <p><strong>Tanggal Dibuat:</strong> {{ $activity->created_at }}</p>  
  
    <a href="{{ route('activities.index') }}" class="btn btn-primary">Kembali ke Daftar Aktivitas</a>  
</div>  
@endsection  
