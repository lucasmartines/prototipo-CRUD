
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Hello Tailwind</title>
  <!-- Tailwind via CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<div class="max-w-4xl mx-auto p-6 bg-white rounded-2xl shadow-md mt-8">
    
<div class="max-w-4xl mx-auto p-6 bg-white rounded-2xl shadow-md mt-8">

    @if (session('success'))
      <div class="bg-green-100 border border-green-400 mt-8 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
          <strong class="font-bold">Sucesso!</strong>
          <span class="block sm:inline">{{ session('success') }}</span>
      </div>
    @endif
    
  <h1 class="text-3xl font-bold text-pink-600 mb-2">Cadastre Um novo</h1>



  <form action="{{ route('dias.store') }}" method="POST" enctype="multipart/form-data">
          @csrf

          <!-- Descrição -->
          <div class="mb-4 ">
              <label class="block mb-1 font-medium">Título </label>
              <input type="text" name="titulo" class="w-full border border-gray-300 rounded-md p-2 focus:outline-pink-500" required>
          </div>

          <!-- Dica -->
          <div class="mb-4">
              <label class="block mb-1 font-medium">Descrição </label>
              <input type="dica" name="descricao" class="w-full border border-gray-300 rounded-md p-2 focus:outline-pink-500">
          </div>

          <!-- Prioridade -->
          <div class="mb-4">
              <label class="block mb-1 font-medium">Data</label>
              <input value=1 type="date" name="data" class="w-full border border-gray-300 rounded-md p-2 focus:outline-pink-500" required>
          </div>

          <!-- Botão -->
          <button type="submit" class="ml-auto block bg-pink-600 text-white px-5 py-2 rounded-full font-bold hover:bg-pink-700">
              Salvar
          </button>
  </form>
</div>

<br><br>
<h1 class="text-3xl font-bold text-pink-600 mb-2">Dias Disponíveis</h1>
        <ul>
            @foreach ($dias as $dia)
            <a href="{{ route('musicas.show', $dia->id) }}">
            <li class="bg-gray-50 p-5 rounded-xl shadow mb-5">

                        {{ $dia->titulo }} - {{ $dia->id }}
            </li>
            </a>
            @endforeach
        </ul>
</div>
</body>
</html>