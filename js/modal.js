document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById("myModal");
    const btn = document.getElementById("openModalBtn");
    const span = document.getElementsByClassName('close')[0];
    const form = document.getElementById('devisForm');
    const formMessage = document.getElementById('formMessage');
    
    btn.onclick = () => {
        modal.style.display = 'block';
    };

    span.onclick = () => {
        modal.style.display = 'none';
    };

    window.onclick = (event) => {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    };

    form.onsubmit = (event) => {
        event.preventDefault();

        const formData = new FormData(form);

        fetch('process_devis.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                formMessage.textContent = 'Merci! Votre message a été envoyé.';
                form.reset();
                // Masquer le modal après 3 secondes.
                setTimeout(()=> {
                    modal.style.display ='none';
                },3000);
            } else {
                formMessage.textContent = 'Oops! Un problème s\'est produit, nous n\'avons pas pu envoyer votre message. Veuillez réessayer.';
            }
        })
        .catch(error => {
            formMessage.textContent = 'Il y a eu un problème avec votre soumission, veuillez réessayer.';
            console.error('Error:', error);
        });
    };
   
});
    
        