@extends('layouts.admin')

@section('title', 'Tambah Pengguna Baru')

@section('content')
    <div class="bg-white p-6 rounded-playful-md shadow-border-offset border-2 border-dark">
        <div class="flex justify-between items-center mb-6 border-b-2 border-dark pb-4">
            <h1 class="text-h2 font-exo2 text-dark">Tambah Pengguna Baru</h1>
            <a href="{{ route('admin.user') }}" 
               class="px-5 py-2 bg-gray-200 text-dark font-bold rounded-playful-sm border-2 border-dark shadow-border-offset hover:bg-gray-300 transition-all duration-200">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>

        <form action="{{ route('admin.user.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="mb-4">
                    <label for="name" class="block text-dark font-semibold mb-2">Nama</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" class="w-full px-4 py-2 border-2 border-dark rounded-playful-sm-inner" required>
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-dark font-semibold mb-2">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" class="w-full px-4 py-2 border-2 border-dark rounded-playful-sm-inner" required>
                    @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label for="role" class="block text-dark font-semibold mb-2">Role</label>
                    <select id="role" name="role" class="w-full px-4 py-2 border-2 border-dark rounded-playful-sm-inner bg-white" required>
                        <option value="user">User</option>
                        <option value="reseller">Reseller</option>
                        <option value="admin">Admin</option>
                    </select>
                    @error('role') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-dark font-semibold mb-2">Password</label>
                    <input type="password" id="password" name="password" class="w-full px-4 py-2 border-2 border-dark rounded-playful-sm-inner" required>
                    @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="mt-6 flex justify-end">
                <button type="submit" class="px-8 py-3 bg-primary text-dark font-bold rounded-playful-sm border-2 border-dark shadow-border-offset hover:bg-opacity-80">
                    <i class="fas fa-save mr-2"></i> Simpan Pengguna
                </button>
            </div>
        </form>
    </div>
@endsection