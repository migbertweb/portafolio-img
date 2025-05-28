<div class="text-center p-2 lg:py-2">

    <div class="lg:flex gap-4">

        <livewire:project-card title="Mi Portafolio" description="Mi portafolio personal, desarrollado en Laravel"
            :images="['proyecto1/1.png', 'proyecto1/2.png', 'proyecto1/3.png', 'proyecto1/4.png']" github="https://github.com/migbertweb/portafolio" website="https://migbertweb.site" />

        <livewire:project-card title="Sistema de Gestion de Documentos del Instituto Universitario del Estado Bolivar"
            description="Aplicativo web desarrollado para la gestion de documentos que un depenedencia de la universidad entrega a los alumnos de manera regular, fue desarrollado en PHP basico con MySql"
            :images="[
                'proyecto2/1.jpg',
                'proyecto2/2.jpg',
                'proyecto2/3.jpg',
                'proyecto2/4.jpg',
                'proyecto2/5.jpg',
                'proyecto2/6.jpg',
                'proyecto2/7.jpg',
            ]" github="https://github.com/migbertweb/sisgdupt" />

    </div>
    {{-- segunda seccion --}}
    <div class="lg:flex gap-4">

        <livewire:project-card title="Practica en en Django"
            description="Creacion de una aplicacion en Django con un frontend en React para gestion de tareas.. simple pero aprendi mucho"
            :images="['proyecto3/1.png', 'proyecto3/2.png', 'proyecto3/3.png', 'proyecto3/4.png', 'proyecto3/5.png', 'proyecto3/6.png']" github="https://github.com/migbertweb/django_crud_react" />

        <livewire:project-card title="Portafolio en github.io"
            description="Mi primer intento de realizar un portafolio utilizando mi repositorio estatico en Github"
            :images="[
                'proyecto4/1.png',
                'proyecto4/2.png',
                'proyecto4/3.png',
                'proyecto4/4.png',
                'proyecto4/5.png',
                'proyecto4/6.png',
            ]" github="https://github.com/migbertweb/migbertweb.github.io" />

    </div>
    <x-footer-portafolio />
</div>
