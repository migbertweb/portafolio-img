<div class="w-full fixed top-0 left-0 z-10 bg-transparent px-6 py-4">
    <div class="max-w-7xl mx-auto flex justify-between lg:justify-end items-center">

        <!-- Navbar Menu Button (Visible on small screens) -->
        <button @click="isOpen = !isOpen"
            class="lg:hidden py-2 px-4 rounded-lg bg-everest-main dark:bg-gray-800 dark:hover:bg-everest-lightest dark:text-white text-gray-800 hover:bg-everest-lightest shadow-xl shadow-gray-500 dark:shadow-gray-900 focus:outline-none">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                </path>
            </svg>
        </button>

        <!-- Dropdown Menu (Visible on small screens) -->
        <div x-show="isOpen" @click.away="isOpen = false"
            class="lg:hidden absolute top-12 left-6 bg-everest-main shadow-lg rounded-md w-48 mt-2 z-50">
            <button @click="activeTab = 1; isOpen = false"
                :class="activeTab === 1 ? 'bg-ocean-main text-white shadow-ocean-main' : 'bg-gray-200 text-gray-700'"
                class="block py-2 px-4 w-full text-left transition-colors duration-300 rounded-md hover:bg-ocean-main hover:text-white">
                {{ __('inicio') }}
            </button>
            <button @click="activeTab = 2; isOpen = false"
                :class="activeTab === 2 ? 'bg-ocean-main text-white shadow-ocean-main' : 'bg-gray-200 text-gray-700'"
                class="block py-2 px-4 w-full text-left transition-colors duration-300 rounded-md hover:bg-ocean-main hover:text-white">
                {{ __('portafolio') }}
            </button>
            <button @click="activeTab = 3; isOpen = false"
                :class="activeTab === 3 ? 'bg-ocean-main text-white shadow-ocean-main' : 'bg-gray-200 text-gray-700'"
                class="block py-2 px-4 w-full text-left transition-colors duration-300 rounded-md hover:bg-ocean-main hover:text-white">
                {{ __('blog') }}
            </button>
        </div>

        {{-- Botones derechos --}}
        <div class="flex items-center space-x-2">
            {{-- Menu para cambio de idioma --}}
            <div x-data="{ open: false }" class="relative">
                <!-- Botón para abrir el menú -->
                <button @click="open = !open" title="{{ __('lang')}}"
                    class="flex text-sm items-center p-2 rounded-lg bg-everest-main dark:bg-gray-800 dark:hover:bg-everest-lightest dark:text-white text-gray-800 hover:bg-everest-lightest shadow-xl shadow-gray-500 dark:shadow-gray-900 focus:outline-none">
                    <span class="mr-2">
                        <img :src="`/images/flags/${window.localStorage.getItem('locale') || 'pt'}.svg`"
                            alt="Idioma actual" class="w-5 h-5">
                    </span>
                    <span
                        x-text="window.localStorage.getItem('locale') ? window.localStorage.getItem('locale').toUpperCase() : 'PT'"></span>
                </button>

                <!-- Menú desplegable -->
                <div x-show="open" @click.away="open = false"
                    class="absolute mt-2 w-30 rounded-md  bg-everest-main dark:bg-gray-800 dark:hover:bg-everest-lightest dark:text-white text-gray-800 hover:bg-gray-300 shadow-lg shadow-gray-500 dark:shadow-gray-900 focus:outline-none">
                    <ul>
                        <li>
                            <a href="#" @click="changeLocale('es')"
                                class="flex items-center p-2 hover:bg-gray-100 dark:hover:bg-gray-800">
                                <img src="/images/flags/es.svg" alt="España" class="w-5 h-5 mr-2">
                                <span class="text-sm">ES</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" @click="changeLocale('en')"
                                class="flex items-center p-2 hover:bg-gray-100 dark:hover:bg-gray-800">
                                <img src="/images/flags/en.svg" alt="Inglaterra" class="w-5 h-5 mr-2">
                                <span class="text-sm">EN</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" @click="changeLocale('pt')"
                                class="flex items-center p-2 hover:bg-gray-100 dark:hover:bg-gray-800">
                                <img src="/images/flags/pt.svg" alt="Brasil" class="w-5 h-5 mr-2">
                                <span class="text-sm">PT</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            {{-- -- Boton para cambio de tema -- --}}
            <div class="relative">
                <!-- Botón para modo oscuro -->
                <button id="dark-theme-toggle" title="{{ __('dark') }}"
                    class="bg-gray-800 hover:bg-everest-lightest text-white p-2 rounded-full shadow-lg dark:shadow-gray-900 focus:outline-none hidden">
                    <!-- Icono de media luna -->
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z">
                        </path>
                    </svg>
                </button>

                <!-- Botón para modo claro -->
                <button id="light-theme-toggle"  title="{{ __('light') }}"
                    class="bg-everest-main text-gray-800 hover:bg-everest-lightest p-2 rounded-full shadow-xl shadow-gray-500 focus:outline-none">
                    <!-- Icono de foco encendido -->
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z">
                        </path>
                        <path
                            d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z">
                        </path>
                    </svg>
                </button>
            </div>


        </div>
    </div>
</div>
