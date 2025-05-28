<div
    class="text-center flex flex-col items-center shadow-lg shadow-ocean-main p-2 my-6 rounded-xl bg-white dark:bg-white flex-1 hover:shadow-2xl transform transition-all duration-300 hover:scale-105">
    <div class="relative h-64 w-full" x-data="mainData()" x-init="slidesCount = {{ count($images) }};
    initialize()">
        <!-- Carousel de imágenes -->
        <template x-for="(image, index) in {{ json_encode($images) }}" :key="index">
            <img :src="'/images/' + image" x-show="activeSlide === index"
                class="absolute w-full h-full object-cover border-2 border-gray-300 shadow-lg shadow-ocean-main rounded-md transition-opacity duration-500">
        </template>
    </div>
    <div class="p-4 flex-grow">
        <h3 class="text-lg font-bold mb-2">{{ $title }}</h3>
        <p class="text-gray-600">{{ $description }}</p>
    </div>
    <div class="p-4 flex justify-between w-full mt-auto">
        <a href="{{ $github }}" class="text-blue-500 hover:underline flex items-center">
            <i class="fab fa-github mr-2"></i> Ver en GitHub
        </a>
        @if ($website)
            <a href="{{ $website }}" class="text-blue-500 hover:underline flex items-center">
                <i class="fas fa-globe mr-2"></i> Visitar Sitio
            </a>
        @endif
    </div>
</div>
