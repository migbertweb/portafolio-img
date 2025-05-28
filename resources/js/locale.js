// Alternar Idioma
document.addEventListener('DOMContentLoaded', function () {
    const storedLocale = window.localStorage.getItem('locale');

    // Si hay un idioma almacenado en localStorage, envía la solicitud para cambiarlo en el servidor
    if (storedLocale) {
        axios.get(`/lang/${storedLocale}`).then(() => {
            // Recarga la página solo si el idioma actual no coincide con el almacenado
            if (storedLocale !== document.documentElement.lang) {
                location.reload();
            }
        });
    }

    // Función para cambiar el idioma cuando el usuario selecciona uno en el menú
    window.changeLocale = function (locale) {
        // Guardar el idioma seleccionado en localStorage
        window.localStorage.setItem('locale', locale);
        // Redirigir a la ruta para cambiar el idioma en el servidor
        axios.get(`/lang/${locale}`).then(() => {
            location.reload();
        });
    }
});

