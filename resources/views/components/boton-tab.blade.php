<button @click="activeTab = {{ $numero }}"
    :class="activeTab === {{ $numero }} ? 'bg-ocean-main text-white shadow-ocean-main' : 'bg-gray-200 text-gray-700'"
    class="py-2 px-6 transition-all duration-300 transform rounded-full focus:outline-none hover:shadow-lg hover:-translate-y-1">
    {{ $texto }}
</button>
