<div class="carousel-container overflow-hidden relative w-full">
    <div id="carousel" class="flex transition-transform duration-500">
        @foreach (['img1.png', 'img2.png', 'img3.png', 'img4.png', 'img5.png', 'img6.png', 'img7.png'] as $image)
            <div class="w-1/3 sm:w-1/5 flex-shrink-0 p-2">
                <div class="w-[100px] h-[100px] border-2 border-double bg-white shadow-lg shadow-ocean-main rounded-lg p-1">
                    <img src="{{ asset('images/carousel/' . $image) }}" class="w-full h-full object-cover" loading="lazy">
                </div>
            </div>
        @endforeach
        <!-- Duplicando para hacer loop -->
        @foreach (['img1.png', 'img2.png', 'img3.png', 'img4.png', 'img5.png', 'img6.png', 'img7.png'] as $image)
            <div class="w-1/3 sm:w-1/5 flex-shrink-0 p-2">
                <div class="w-[100px] h-[100px] border-2 border-double bg-white shadow-lg shadow-ocean-main rounded-lg p-1">
                    <img src="{{ asset('images/carousel/' . $image) }}" class="w-full h-full object-cover" loading="lazy">
                </div>
            </div>
        @endforeach
    </div>
</div>
