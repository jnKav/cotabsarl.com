document.addEventListener('DOMContentLoaded', () => {
    const devForm =document.getElementById('devis');
    const formMessages = document.getElementById('formMessages');
    
    devForm.onsubmit = (event) => {
       event.preventDefault();

       const formData = new FormData(devForm);

       fetch('process_devis.php', {
          method: 'POST',
          body: formData
       })
       .then(response => response.json())
       .then(data => {
          if (data.success) {
             formMessages.textContent = 'Merci! Votre message a été envoyé.';
             devForm.reset();
          } else {
             formMessages.textContent = 'Oops! Un problème s\'est produit, nous n\'avons pas pu envoyer votre message. Veuillez réessayer.';
          }
       })
       .catch(error => {
          formMessages.textContent = 'Il y a eu un problème avec votre soumission, veuillez réessayer.';
          console.error('Error:', error);
       });
    };

 });