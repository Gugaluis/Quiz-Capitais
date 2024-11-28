<x-main-layout pageTitle="Quiz Países e Capitais">

<div class="container">

    <x-pergunta :country="$country" :currentQuestion="$currentQuestion" :totalQuestions="$totalQuestions" />

    <div class="row">

        @foreach ($answers as $answer)
            <x-resposta :capital="$answer" />
        @endforeach

    </div>
    
</div>

<!-- cancel game -->
<div class="text-center mt-5">
    <a href="{{ route('startGame') }}" class="btn btn-outline-danger mt-3 px-5">Cancelar jogo</a>
</div>

</x-main-layout>
