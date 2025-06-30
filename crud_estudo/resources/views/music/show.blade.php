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

<br><br>

<div class="max-w-4xl mx-auto bg-white p-6  ">
    <div class="mt-8">
            <a href="{{ route('musicas.index') }}" class="text-blue-600 hover:underline">← Voltar</a>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 mt-8 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Sucesso!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif
</div>

<div class="max-w-4xl mx-auto bg-white p-6 rounded-xl shadow-md">
    <h2 class="text-2xl font-bold mb-4 text-pink-600">Adicionar Audio</h2>

    <form action="{{ route('musicas.store2') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Descrição -->
        <div class="mb-4 ">
            <label class="block mb-1 font-medium">Audio Texto </label>
            <input type="text" name="descricao" class="w-full border border-gray-300 rounded-md p-2 focus:outline-pink-500" required>
        </div>

        <!-- Dica -->
        <div class="mb-4">
            <label class="block mb-1 font-medium">Dica Info</label>
            <input type="text" name="dica" class="w-full border border-gray-300 rounded-md p-2 focus:outline-pink-500" required>
        </div>

         <!-- Dica -->
        <div class="mb-4">
            <label class="block mb-1 font-medium">Arquivo</label>
            <input type="file" name="audio" >
        </div>

        <!-- Prioridade -->
        <div class="mb-4 hidden">
            <label class="block mb-1 font-medium">Prioridade</label>
            <input value=1 type="number" name="prioridade" class="w-full border border-gray-300 rounded-md p-2 focus:outline-pink-500" required>
        </div>


        <!-- Dia (se quiser associar a um dia específico) -->
        <div class="mb-4 hidden">
            <label class="block mb-1 font-medium">Dia (ID)</label>
            <input type="number" value='{{ $dia->id }}' name="dia_id" class="w-full border border-gray-300 rounded-md p-2 focus:outline-pink-500" required>
        </div>

        <!-- Botão -->
        <button type="submit" class="ml-auto block bg-pink-600 text-white px-5 py-2 rounded-full font-bold hover:bg-pink-700">
            Salvar
        </button>
    </form>
</div>

<br><br> 
<div class="max-w-4xl mx-auto p-6 bg-white rounded-2xl shadow-md mt-8">
    <h1 class="text-3xl font-bold text-pink-600 mb-2">{{ $dia->titulo }}</h1>
    <p class="text-gray-700 mb-1">{{ $dia->descricao }}</p>
    <p class="text-gray-500 mb-5">Data: {{ $dia->data }}</p>

    <div class="flex justify-between items-center mb-5">
        <h2 class="text-2xl font-semibold text-gray-800">Audios</h2>

        <form action="{{ route('musicas.delete.dia', $dia->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja deletar este dia?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-xl">
                🗑️ Deletar Dia
            </button>
        </form>
    </div>

    <div class="space-y-5">
        @foreach ($dia->musicas as $musica)
            <div class="bg-gray-50 p-5 rounded-xl shadow">

            <div class='toggler_click'>
                <p class="text-lg font-medium text-gray-800">{{ $musica->descricao }}</p>
                <p class="text-sm text-pink-600 mb-2 alvo_toggle hidden">{{ $musica->dica }}</p>                
            </div>
                @if ($musica->url)
                    <audio controls class="w-full mb-3">
                        <source src="{{ $musica->url }}" type="audio/mpeg">
                        Seu navegador não suporta o elemento de áudio.
                    </audio>
                @endif

                <form action="{{ route('musicas.delete.musica', $musica->id) }}" method="POST" onsubmit="return confirm('Deletar este Audio?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-200 hover:bg-red-500 text-white px-4 py-2 rounded-xl" style=' margin-left: auto; display: block;'>
                        🗑️ 
                    </button>
                </form>
            </div>
        @endforeach
    </div>

    <div class="mt-8">
        <a href="{{ route('musicas.index') }}" class="text-blue-600 hover:underline">← Voltar</a>
    </div>
</div>


<script>
    document.querySelectorAll('.toggler_click').forEach(el => {
        el.addEventListener('click', () => {
            const alvo = el.querySelector('.alvo_toggle');
            if (alvo) {
            alvo.classList.toggle('hidden');
            }
        });
    });
</script>
</body>
</html>
