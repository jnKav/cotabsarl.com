document.addEventListener('DOMContentLoaded', () => {
    const form=document.getElementById('contactForm');
    const formComment = document.getElementById('formComment');
    
    form.onsubmit = (event) => {
            event.preventDefault();
    
            const formData = new FormData(form);
    
            fetch('traitement.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    formComment.textContent = 'Merci! Votre message a été envoyé. Merci de nous avoir contacté!';
                    form.reset();
                } else {
                    formComment.textContent = 'Oops! Un problème s\'est produit, nous n\'avons pas pu envoyer votre message. Veuillez réessayer.';
                }
            })
            .catch(error => {
                formComment.textContent = 'Il y a eu un problème avec votre soumission, veuillez réessayer.';
                console.error('Error:', error);
            });
        };
    
        
    });
        