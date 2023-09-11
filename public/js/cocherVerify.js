$(document).ready(function() {
    $('.verify-checkbox').change(function() {
        var id = $(this).attr('id').replace('cocher', ''); // Récupérer l'ID de l'utilisateur
        var isChecked = $(this).prop('checked') ? 1 : 0; // Vérifier si la case est cochée ou non

        // Envoyer une demande AJAX au serveur pour mettre à jour l'état de vérification
        $.ajax({
            type: 'POST', // ou 'GET' selon votre configuration
            url: '/mettre_a_jour_etat_verification/' + id, // Remplacez par votre URL de mise à jour
            data: { isVerified: isChecked },
            success: function(response) {
                // Gérer la réponse du serveur (éventuellement)
                console.log(response);
            },
            error: function(error) {
                // Gérer les erreurs (éventuellement)
                console.error(error);
            }
        });
    });
});