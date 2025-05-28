function mainData() {
    return {
        activeTab: 1,
        isOpen: false,
        open: false,
        darkMode: localStorage.getItem('darkMode') === 'true',
        dropdownOpen: false,
        posts: [],
        currentPost: null,
        activeSlide: 0,
        slidesCount: 0,  // Número de imágenes

        async initialize() {
            this.$watch('darkMode', value => localStorage.setItem('darkMode', value));
            await this.storeAllPosts(); // Cargar todos los posts en caché
            this.fetchPosts(); // Luego, cargar los posts del idioma actual

            // Lógica del slideshow
            this.startSlideshow();
        },

        startSlideshow() {
            // Establece el intervalo para cambiar las imágenes cada 3 segundos
            setInterval(() => {
                this.activeSlide = (this.activeSlide + 1) % this.slidesCount;
            }, 3000);
        },


        async fetchPosts() {
            const locale = localStorage.getItem('locale') || 'pt'; // Obtener el idioma guardado o usar 'en' por defecto
            const cacheKey = `posts_${locale}`; // Clave para el localStorage
            try {
                // Verificar si los datos están en localStorage
                const cachedData = localStorage.getItem(cacheKey);
                if (cachedData) {
                    // Si hay datos en la caché, usarlos
                    this.posts = JSON.parse(cachedData).map(post => ({
                        ...post,
                        expanded: false
                    }));
                } else {
                    // Si no hay datos en la caché, hacer la solicitud
                    const response = await fetch(`./posts_${locale}.json`); // Cargar el archivo de posts según el idioma
                    const data = await response.json();
                    this.posts = data.map(post => ({
                        ...post,
                        expanded: false
                    }));

                    // Almacenar los datos en localStorage para futuros usos
                    localStorage.setItem(cacheKey, JSON.stringify(data));
                }
            } catch (error) {
                console.error('Error fetching posts:', error);
            }
        },
        async storeAllPosts() {
            const locales = ['en', 'es', 'pt']; // Lista de idiomas
            for (const locale of locales) {
                const cacheKey = `posts_${locale}`;
                try {
                    const response = await fetch(`./posts_${locale}.json`);
                    const data = await response.json();
                    localStorage.setItem(cacheKey, JSON.stringify(data)); // Almacenar en localStorage
                } catch (error) {
                    console.error(`Error fetching posts for ${locale}:`, error);
                }
            }
        },
        toggleExpand(post) {
            if (this.currentPost && this.currentPost.id !== post.id) {
                this.currentPost.expanded = false; // Collapse the currently expanded post
            }
            post.expanded = !post.expanded;
            this.currentPost = post.expanded ? post : null;
        },

        nextPost() {
            const index = this.posts.findIndex(post => post.id === this.currentPost.id);
            this.currentPost = this.posts[(index + 1) % this.posts.length];
        },

        prevPost() {
            const index = this.posts.findIndex(post => post.id === this.currentPost.id);
            this.currentPost = this.posts[(index - 1 + this.posts.length) % this.posts.length];
        }
    }
}
// Exponer `mainData` globalmente
window.mainData = mainData;
