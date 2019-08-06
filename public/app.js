 
  // register service worker
  if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('service-worker.js', { scope: '' }).then(function(reg) {
  
      if(reg.installing) {
        console.log('Service worker installing');
      } else if(reg.waiting) {
        console.log('Service worker installed');
      } else if(reg.active) {
        console.log('Service worker active');
      }
  
    }).catch(function(error) {
      // registration failed
      console.log('Registration failed with ' + error);
    });
  }
  
  
  let deferredPrompt;
  const addBtn = document.querySelector('.add-button');
  window.addEventListener('beforeinstallprompt', (e) => {
    // Prevent Chrome 67 and earlier from automatically showing the prompt
    e.preventDefault();
    // Stash the event so it can be triggered later.
    deferredPrompt = e;
    // Update UI to notify the user they can add to home screen
    $(".add").show();
  
    addBtn.addEventListener('click', (e) => {
     
      // Show the prompt
      deferredPrompt.prompt();
      // Wait for the user to respond to the prompt
      deferredPrompt.userChoice.then((choiceResult) => {
          if (choiceResult.outcome === 'accepted') {
            console.log('MARS Instalado');
            
          } else {
            console.log('MARS Cancelado');
  
          }
          $(".add").hide();
          localStorage.setItem("c",1);
          deferredPrompt = null;
        });
    });
  });
  
  
  $(".add").show();
  
  var c = localStorage.getItem("c");
  if ( c == 0 ) {
    $(".add").hide();
    console.log("Sem banner...");
  }
  
  $("#cancel").click(function() {
    $(".add").hide();
    localStorage.setItem("c",0);
    console.log("Cancelado...")
  })
  
  
  
  