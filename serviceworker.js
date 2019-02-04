const cacheName = 'v1';

const cacheAssets = [
'uploadimage.php',    
'signinForm.php',    
'signin.php',    
'setsession.php',
'send_form_email.php',
'profile.php',
'products-page.php',
'product.php',
'product-information.php',
'password-forgotten.php',
'logout.php',
'loginForm.php',
'login.php',
'index.php',
'hamburger-menu.php',
'filtersearch.php',
'filter.php',
'edit-profile.php',
'edit-product.php',
'destroy.php',
'deleteimage.php',
'delete.php',
'delete-product.php',
'db-connection.php',
'create-new-password.php',
'contact.php',
'contact-script.php',
'addproduct.php',
'js/product.js',
'js/product-jq.js',
'js/maps.js',
'js/ajax.js',
'js/aboutus.js',
'images/tomaat.jpeg',
'images/tim.png',
'images/smartphone.png',
'images/scroll-down-icon.png',
'images/right-arrow.png',
'images/logo-foodsavers.png',
'images/like.png',
'images/left-arrow.png',
'images/landingspage-searchfield-bg-image.jpg',
'images/john.png',
'images/imad.png',
'images/handshake.png',
'images/groente.png',
'images/fruit.png',
'images/email.png',
'images/chat.png',
'images/arrow-right.png',
'images/arrow-left.png',
'images/alles.png',
'images/adje.png',
'images/adje-1.png',
'css/style-landingspage.css',
'css/signin.css',
'css/profile.css',
'css/products-page.css',
'css/product-information.css',
'css/my-products.css',
'css/login.css',
'css/edit-profile.css',
'css/delete-product.css',
'css/contact.css',
'css/animate.css',
'css/add-product.css',
];




// call install event

self.addEventListener('install', e => {
    console.log('Service Worker: Installed');

    e.waitUntil(
        caches
        .open(cacheName)
        .then(cache => {
            console.log('Service Worker: Caching Files');
            cache.addAll(cacheAssets);
        })
        .then(() => self.skipWaiting())
    );
});

// call activate event

self.addEventListener('activate', e => {
            console.log('Service Worker: Activated');

            //remove unwanted caches

            e.waitUntil(
                caches.keys().then(cacheNames => {
                    return Promise.all(
                        cacheNames.map(cache => {
                            if (cache !== cacheName) {
                                console.log('Servic Worker: Clearing Old Cache');
                                return caches.delete(cache);
                            }
                        })
                    );
                })
            );
            });

// Call Fetch Event

self.addEventListener('fetch', e => {
    console.log('Service Worker: Fetching');
    e.respondWith(fetch(e.request).catch(() => caches.match(e.request)));
});

