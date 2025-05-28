<div class="text-center p-2 lg:py-4">

    <div class="relative grid grid-cols-1 gap-6">
        <!-- Loop through posts -->
        <template x-for="post in posts" :key="post.id">
            <div x-show="!currentPost || currentPost.id === post.id"
                class="bg-white text-gray-800 p-5 rounded-lg shadow-lg shadow-ocean-main transition duration-300">
                <div :class="post.expanded ? 'flex flex-col items-center' : 'flex'">
                    <!-- Post Image (1/4 width) -->
                    <div :class="post.expanded ? 'w-[400px] h-[400px] p-4' : 'w-1/4'">
                        <img :src="post.image" alt="Imagen del Post"
                            :class="post.expanded ? 'w-full h-full shadow-lg object-contain rounded-lg' :
                                'w-full h-auto rounded-md'">
                    </div>

                    <!-- Post Content (3/4 width) -->
                    <div :class="post.expanded ? 'h-full' : 'w-3/4 pl-4 flex flex-col justify-between'">
                        <!-- Post Title (Centered) -->
                        <h2 class="text-xl font-bold text-center mb-2" x-text="post.title"></h2>

                        <!-- Post Summary / Full Content (Justified) -->
                        <p x-show="!post.expanded" class="text-gray-800 mb-2 text-justify" x-html="post.summary"></p>
                        <p x-show="post.expanded" class="text-gray-800 mb-2 p-2 text-justify" x-html="post.content"></p>

                        <!-- Author and Date (Left-aligned, but justified with content) -->
                        <div class="text-sm text-gray-500 mb-2 text-justify">
                            <span x-text="post.author"></span> - <span x-text="post.date"></span>
                        </div>

                        <!-- Read More / Collapse Button (Centered, smaller) -->
                        <button @click="toggleExpand(post)" class="text-ocean-main mt-1 text-sm text-center">
                            <span x-show="!post.expanded">Seguir Leyendo...</span>
                            <span x-show="post.expanded">Ver Menos</span>
                        </button>
                    </div>
                </div>
            </div>
        </template>

        <!-- Pagination Arrows -->
        <div class="absolute bottom-4 right-4 flex items-center space-x-4" x-show="currentPost">
            <button @click="prevPost()"
                class="bg-ocean-main text-white shadow-ocean-main p-2 rounded-full shadow-sm hover:bg-gray-400 dark:hover:bg-gray-600">
                &#9664; <!-- Left Arrow -->
            </button>
            <button @click="nextPost()"
                class="bg-ocean-main text-white shadow-ocean-main p-2 rounded-full shadow-sm hover:bg-gray-400 dark:hover:bg-gray-600">
                &#9654; <!-- Right Arrow -->
            </button>
        </div>
    </div>

</div>
