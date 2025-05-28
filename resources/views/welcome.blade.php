<x-layouts.index-layout>

    @section('sidebar')
        @livewire('about-me')
    @endsection

    @section('content')
        @livewire('experience')
    @endsection

    @section('content2')
        @livewire('portafolio')
    @endsection

    @section('content3')
        @livewire('blog')
    @endsection

</x-layouts.index-layout>
