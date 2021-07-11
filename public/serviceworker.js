var staticCacheName = "perpusSMK7-v" + new Date().getTime();
var filesToCache = [
    'offline.html',
    'favicon.ico',
    '/css/app.css',
    '/css/bootstrap.min.css',
    '/css/dataTables.bootstrap4.min.css',
    '/css/font-awesome.css',
    '/css/font-awesome.min.css',
    '/css/jquery-ui.css',
    '/css/style.css',
    '/css/style3.css',
    '/css/welcome-style.css',
    '/js/app.js',
    '/js/jquery-3.2.1.slim.min.js',
    '/js/popper.min.js',
    '/js/bootstrap2.min.js',
    '/images/logo3.png',
    '/images/image.jpeg',
    '/images/icons/icon-72x72.png',
    '/images/icons/icon-96x96.png',
    '/images/icons/icon-128x128.png',
    '/images/icons/icon-144x144.png',
    '/images/icons/icon-152x152.png',
    '/images/icons/icon-192x192.png',
];

// Cache on install
self.addEventListener("install", event => {
    this.skipWaiting();
    event.waitUntil(
        caches.open(staticCacheName)
            .then(cache => {
                return cache.addAll(filesToCache);
            })
    )
});

// Clear cache on activate
self.addEventListener('activate', event => {
    event.waitUntil(
        caches.keys().then(cacheNames => {
            return Promise.all(
                cacheNames
                    .filter(cacheName => (cacheName.startsWith("perpusSMK7-")))
                    .filter(cacheName => (cacheName !== staticCacheName))
                    .map(cacheName => caches.delete(cacheName))
            );
        })
    );
});

// Serve from Cache
self.addEventListener("fetch", event => {
    event.respondWith(
        caches.match(event.request)
            .then(response => {
                return response || fetch(event.request);
            })
            .catch(() => {
                return caches.match('offline.html');
            })
    )
});