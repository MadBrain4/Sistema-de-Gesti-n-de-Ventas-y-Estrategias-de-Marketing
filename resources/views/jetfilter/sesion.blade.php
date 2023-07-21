<x-Arriba_JetFilter>
    <x-slot name="title">
        Inicio
    </x-slot>
</x-Arriba_JetFilter>

<section class="hero__contain contain">
    <h1 class="title">Bienvenido {{ auth()->user()->name }}</h1>
    <a href="{{route('index')}}" target="_blank" class="ctan">ir a Webfiltros</a>
    <a href="{{route('jet-filter.marketing.index')}}" target="_blank" class="ctan">ir a Gestión de Estrategias de Marketing </a>
</section>

<x-Abajo_JetFilter />