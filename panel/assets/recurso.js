$(document).ready(function() {


    $('#deku').click(function() {
        var categoria = $("#categoria").val();
        var pagina = $("#pagina").val();
        var seo = $("#seo").val();
        setTimeout(function() {
            $.ajax({
                type: 'POST',
                url: urlWeb + '/api/resource/extractor.php',
                data: 'categoria=' + categoria + '&pagina=' + pagina + '&seo=' + seo,
                success: function(html) {
                    $('#resultado').html(html);
                    $('#resultado').hide().fadeIn();
                }
            });
        }, 1000);
    });
});