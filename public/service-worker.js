//install the service worker
self.addEventListener('install', function(event) {
    event.waitUntil(
      caches.open('chiens').then(function(cache) {
        return cache.addAll([
            'index.php',
        ]);
        console.log("Arquivos cacheados...");
      })
    );
  });
  
  //fetch - verificando as informações do cache
  self.addEventListener('fetch', function(event) {
    event.respondWith(caches.match(event.request).then(function(response) {
      // caches.match() always resolves
      // but in case of success response will have value
      if (response !== undefined) {
        return response;
      } else {
        return fetch(event.request).then(function (response) {
          // response may be used only once
          // we need to save clone to put one copy in cache
          // and serve second one
          let responseClone = response.clone();
          
          caches.open('mars').then(function (cache) {
           // cache.put(event.request, responseClone);
          });
          return response;
        }).catch(function () {
          return caches.match('/www/imgs/Drrnovo.png');
        });
      }
    }));
  });
  
  //atualizar o cache
  self.addEventListener('activate', function(e) {
    console.log('Service Worker Ativo');
    e.waitUntil(
      caches.keys().then(function(keyList) {
        return Promise.all(keyList.map(function(key) {
          if (key !== "tutut") {
            console.log('Service Worker Cache Antigo Removido', key);
            return caches.delete(key);
          }
        }));
      })
    );
    return self.clients.claim();
  });
  
  