var staticCacheName = "eac" + new Date().getTime();
var filesToCache = [
  "/offline",
  "/assets/assets/favicon.ico",
  "https://cdn.tiny.cloud/1/7skl4x3q5eenkdujpy5gwjba1ld9g94o5i4y0uswljf631lu/tinymce/6/tinymce.min.js",
  "assets/libs/jsvectormap/css/jsvectormap.min.css",
  "assets/js/layout.js",
  "assets/css/bootstrap.min.css",
  "assets/css/icons.min.css",
  "assets/css/app.min.css",
  "assets/css/custom.min.css",
  "assets/plugins/global/plugins.bundle.css",
  "assets/css/style.bundle.css",
  "assets/plugins/custom/datatables/datatables.bundle.css",
  "assets/plugins/global/plugins.bundle.js",
  "assets/js/scripts.bundle.js",
  "assets/plugins/custom/datatables/datatables.bundle.js",
  "assets/js/pdfobject.min.js",
  "assets/js/jquery.min.js",
  "//cdn.jsdelivr.net/npm/sweetalert2@11",
  "assets/libs/bootstrap/js/bootstrap.bundle.min.js",
  "assets/js/plugins.js",
  "assets/libs/feather-icons/feather.min.js",
  "assets/libs/node-waves/waves.min.js",
  "js/fslightbox.js",
  "css/main.css",
  "/css/app.css",
  "/js/app.js",
  "/images/icons/icon-72x72.png",
  "/images/icons/icon-96x96.png",
  "/images/icons/icon-128x128.png",
  "/images/icons/icon-144x144.png",
  "/images/icons/icon-152x152.png",
  "/images/icons/icon-192x192.png",
  "/images/icons/icon-384x384.png",
  "/images/icons/icon-512x512.png",
];

// Cache on install
self.addEventListener("install", (event) => {
  this.skipWaiting();
  event.waitUntil(
    caches.open(staticCacheName).then((cache) => {
      return cache.addAll(filesToCache);
    })
  );
});

// Clear cache on activate
self.addEventListener("activate", (event) => {
  event.waitUntil(
    caches.keys().then((cacheNames) => {
      return Promise.all(
        cacheNames
          .filter((cacheName) => cacheName.startsWith("pwa-"))
          .filter((cacheName) => cacheName !== staticCacheName)
          .map((cacheName) => caches.delete(cacheName))
      );
    })
  );
});

// Serve from Cache
self.addEventListener("fetch", (event) => {
  event.respondWith(
    caches
      .match(event.request)
      .then((response) => {
        return response || fetch(event.request);
      })
      .catch(() => {
        return caches.match("offline");
      })
  );
});
