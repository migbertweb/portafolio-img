<div class="text-center p-2 lg:py-2">
    <div>
        <h3 class="text-5xl font-brotherline py-1 dark:text-white ">{{ __('about_me') }}</h3>
        {!! __('bio') !!}
    </div>
    <div class="lg:flex gap-4">
        <div
            class="text-center flex flex-col items-center shadow-lg shadow-ocean-main p-2 pb-6 my-6 rounded-xl bg-white dark:bg-white flex-1">
            <div clas="text-center">
                <img src="{{ asset('images/misc/coding.png') }}" class="h-48 w-48">
            </div>
            <h3 class="text-xl font-extrabold pt-6 pb-2">
                {{ __('coding') }}
            </h3>
            <p class="py-2">
                {{ __('coding_desc') }}
            </p>
            <h4 class="py-3 text-lg text-bold text-everest-lightest">{{ __('coding_uses') }}</h4>
            <ul class="list-none">
                <li class="flex items-center">
                    <i class="fa-brands fa-php text-gray-900 mr-2"></i>
                    <span class="text-gray-700">PHP y MySql</span>
                </li>
                <li class="flex items-center">
                    <i class="fa-brands fa-python text-gray-900 mr-2"></i>
                    <span class="text-gray-700">Python y Django</span>
                </li>
                <li class="flex items-center">
                    <i class="fa-brands fa-laravel text-gray-900 mr-2"></i>
                    <span class="text-gray-700">Laravel</span>
                </li>
                <li class="flex items-center">
                </li>
                <li class="flex items-center">
                    <i class="fa-brands fa-docker text-gray-900 mr-2"></i>
                    <span class="text-gray-700">Docker</span>
                </li>
                <li class="flex items-center">
                    <i class="fa-brands fa-linux text-gray-900 mr-2"></i>
                    <span class="text-gray-700">GNU Linux</span>
                </li>
            </ul>

        </div>
        <div
            class="text-center flex flex-col items-center shadow-lg shadow-ocean-main p-2 pb-6 my-6 rounded-xl bg-white dark:bg-white flex-1">
            <div clas="text-center">
                <img src="{{ asset('images/misc/aptitud.webp') }}" class="h-48 w-48">
            </div>
            <h3 class="text-xl font-extrabold pt-6 pb-2  ">
                {{ __('aptitud') }}
            </h3>
            <p class="py-2">
                {{ __('aptitud_desc') }}
            </p>
            <h4 class="py-3 text-lg text-bold text-everest-lightest">{{ __('aptitud_uses') }}</h4>
            <ul class="list-none">
                <li class="flex items-center">
                    <i class="fa-solid fa-user-group text-gray-900 mr-2"></i>
                    <span class="text-gray-700">{{ __('workteam') }}</span>
                </li>
                <li class="flex items-center">
                    <i class="fa-solid fa-bolt text-gray-900 mr-2"></i>
                    <span class="text-gray-700">{{ __('p_activo') }}</span>
                </li>
                <li class="flex items-center">
                    <i class="fa-solid fa-shapes text-gray-900 mr-2"></i>
                    <span class="text-gray-700">{{ __('eficient') }}</span>
                </li>
                <li class="flex items-center">
                    <i class="fa-solid fa-gauge-high text-gray-900 mr-2"></i>
                    <span class="text-gray-700">{{ __('speed_a') }}</span>
                </li>
            </ul>
        </div>
    </div>
    <!-- Aquí llamamos al componente Livewire del carrusel -->
    <livewire:image-carousel />
</div>
