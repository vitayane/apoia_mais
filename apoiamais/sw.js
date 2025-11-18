// Service Worker básico
self.addEventListener('install', function(event) {
    console.log('Service Worker instalado');
});

self.addEventListener('fetch', function(event) {
    // Aqui você pode implementar cache se quiser offline
});
