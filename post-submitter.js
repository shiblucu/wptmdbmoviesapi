jQuery( document ).ready( function ( $ ) {
    $( '#post-submission-form' ).on( 'submit', function(e) {
        e.preventDefault();
        var title = $( '#post-submission-title' ).val();
        var excerpt = $( '#post-submission-excerpt' ).val();
        var content = $( '#post-submission-content' ).val();
        var youtubeLink = $('#post-submission-youtube-link').val();
        var status = 'draft';

        var data = {
            title: title,
            excerpt: excerpt,
            content: content,
			meta: {
            'youtube_link' : youtubeLink,
        }
        };

        $.ajax({
            method: "POST",
            url: POST_SUBMITTER.root + 'wp/v2/movies',
            data: data,
            beforeSend: function ( xhr ) {
                xhr.setRequestHeader( 'X-WP-Nonce', POST_SUBMITTER.nonce );
            },
            success : function( response ) {
                console.log( response );
                alert( POST_SUBMITTER.success );
            },
            fail : function( response ) {
                console.log( response );
                alert( POST_SUBMITTER.failure );
            }

        });

    });

} );
