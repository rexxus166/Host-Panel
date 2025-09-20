@extends('layouts.admin')

@section('title', 'Kelola Pengguna')

@section('content')
    <div class="bg-white p-6 rounded-playful-md shadow-border-offset">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-h2 font-exo2 text-dark">Kelola Pengguna</h1>
            <a href="{{ route('admin.user.create') }}" 
               class="px-5 py-2 bg-primary text-dark font-bold rounded-playful-sm border-2 border-dark shadow-border-offset hover:bg-opacity-80 transition-all duration-200">
                <i class="fas fa-user-plus mr-2"></i> Tambah Pengguna
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-dark rounded-playful-md overflow-hidden">
                <thead class="bg-dark text-white">
                    <tr>
                        <th class="py-3 px-4 text-left font-semibold">ID</th>
                        <th class="py-3 px-4 text-left font-semibold">Nama</th>
                        <th class="py-3 px-4 text-left font-semibold">Email</th>
                        <th class="py-3 px-4 text-left font-semibold">Role</th>
                        <th class="py-3 px-4 text-left font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-dark">
                    @forelse ($users as $user)
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="py-3 px-4">{{ $user->id }}</td>
                            <td class="py-3 px-4">{{ $user->name }}</td>
                            <td class="py-3 px-4">{{ $user->email }}</td>
                            <td class="py-3 px-4">
                                <span class="px-2 py-1 font-semibold leading-tight text-xs rounded-full
                                    @if($user->role == 'admin') bg-red-100 text-red-700 @endif
                                    @if($user->role == 'reseller') bg-secondary bg-opacity-20 text-secondary @endif
                                    @if($user->role == 'user') bg-gray-200 text-gray-800 @endif
                                ">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <td class="py-3 px-4 flex space-x-2">
                                <a href="{{ route('admin.user.edit', $user->id) }}" class="px-3 py-1 bg-secondary text-white rounded-playful-sm text-sm font-semibold hover:bg-purple">Edit</a>
                                <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Anda yakin ingin menghapus pengguna ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded-playful-sm text-sm font-semibold hover:bg-red-700">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-5 px-4 text-center text-gray-500">Belum ada data pengguna.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="mt-6">
            
        </div>
    </div>
@endsection