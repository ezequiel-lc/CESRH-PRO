<div>
    <form action="{{ route('guardar.correo') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="email" class="block text-gray-700">Correo electrónico</label>
            <input type="email" name="email" id="email" class="w-full p-2 border rounded" required>
        </div>
        <button type="submit" class="bg-blue-500 text-white p-2 rounded">Guardar correo</button>
    </form>
</div>
