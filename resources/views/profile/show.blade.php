@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <div class="bg-white rounded-lg shadow-md p-6 max-w-md mx-auto">
        <h1 class="text-2xl font-bold mb-4">Mi Perfil</h1>
        
        <div class="space-y-4">
            <div>
                <label class="block text-gray-700 font-medium">Nombre</label>
                <p class="mt-1 p-2 bg-gray-50 rounded">{{ $user['name'] }}</p>
            </div>
            
            <div>
                <label class="block text-gray-700 font-medium">Email</label>
                <p class="mt-1 p-2 bg-gray-50 rounded">{{ $user['email'] }}</p>
            </div>
            
            <div class="pt-4">
                <a href="{{ route('profile.edit') }}" class="inline-block bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded">
                    Editar Perfil
                </a>
            </div>
        </div>
    </div>
</div>
@endsection