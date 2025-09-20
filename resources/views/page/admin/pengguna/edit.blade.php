@extends('layouts.admin')

@section('title', 'Edit Pengguna')

@section('content')
    <div class="bg-white p-6 rounded-playful-md shadow-border-offset border-2 border-dark">
        <div class="flex justify-between items-center mb-6 border-b-2 border-dark pb-4">
            <h1 class="text-h2 font-exo2 text-dark">Edit Pengguna: {{ $user->name }}</h1>
            <a href="{{ route('admin.user') }}" 
               class="px-5 py-2 bg-gray-200 text-dark font-bold rounded-playful-sm border-2 border-dark shadow-border-offset hover:bg-gray-300 transition-all duration-200">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>

        <form action="{{ route('admin.user.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="mb-4">
                    <label for="name" class="block text-dark font-semibold mb-2">Nama</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" class="w-full px-4 py-2 border-2 border-dark rounded-playful-sm-inner" required>
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-dark font-semibold mb-2">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" class="w-full px-4 py-2 border-2 border-dark rounded-playful-sm-inner" required>
                    @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label for="role" class="block text-dark font-semibold mb-2">Role</label>
                    <select id="role" name="role" class="w-full px-4 py-2 border-2 border-dark rounded-playful-sm-inner bg-white" required>
                        <option value="user" @selected(old('role', $user->role) == 'user')>User</option>
                        <option value="reseller" @selected(old('role', $user->role) == 'reseller')>Reseller</option>
                        <option value="admin" @selected(old('role', $user->role) == 'admin')>Admin</option>
                    </select>
                    @error('role') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                
                <div></div> {{-- Spacer --}}
                
                <div class="md:col-span-2"><p class="text-sm text-gray-500">Kosongkan password jika tidak ingin mengubahnya.</p></div>
                
                <div class="mb-4">
                    <label for="password" class="block text-dark font-semibold mb-2">Password Baru</label>
                    <input type="password" id="password" name="password" class="w-full px-4 py-2 border-2 border-dark rounded-playful-sm-inner">
                    @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="block text-dark font-semibold mb-2">Konfirmasi Password Baru</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="w-full px-4 py-2 border-2 border-dark rounded-playful-sm-inner">
                </div>
            </div>

            <div class="mt-6 flex justify-end">
                <button type="submit" class="px-8 py-3 bg-secondary text-white font-bold rounded-playful-sm border-2 border-dark shadow-border-offset hover:bg-opacity-80">
                    <i class="fas fa-sync-alt mr-2"></i> Update Pengguna
                </button>
            </div>
        </form>
    </div>
@endsection