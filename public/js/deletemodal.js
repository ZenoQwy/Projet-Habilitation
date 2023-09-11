$(document).ready(function() {
    $('.deletee').click(function(){
        var id = $(this).data('numuser');
        var email = $(this).data('emailuser');
        console.log(email);
        var url = '/admin-listeusers/' + id;

        $('#numUser').text(id);
        $('#emailUser').text(email);
        $('#deleteArticleForm').attr('action', url);
        $('#lien').attr('href','http://s3-4676.nuage-peda.fr/habilitation/public/admin-suppuser/'+id);
    })
});
