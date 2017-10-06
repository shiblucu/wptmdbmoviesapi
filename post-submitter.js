jQuery( document ).ready( function ( $ ) {
    $( '#post-submission-form' ).on( 'submit', function(e) {
        e.preventDefault();
        var title = $( '#title' ).val();
        var excerpt = $( '#post-submission-excerpt' ).val();
        var content = $( '#post-submission-content' ).val();
        var org_title = $( '#original_title' ).val();
        var year = $( '#year' ).val();
        var imdb_id = $( '#imdb' ).val();
        var tmdb_id = $( '#tmdb' ).val();
        var language = $( '#lang' ).val();
        var backdrop_path = $( '#backdrop_path' ).val();
        var actors = $( '#actors' ).val();
        var quality = $( '#quality' ).val();
        var poster_url = $( '#poster' ).val();
        var genres = $( '#genres' ).val();
        var overviews = $( '#overview' ).val();
        var release_date = $( '#release_date' ).val();
        var runtime = $( '#runtime' ).val();
        var country = $( '#country' ).val();
        var tagline = $( '#tagline' ).val();
        var youtubeLink = $('#trailer_link').val();
        var vote_avarage = $( '#vote_avarage' ).val();
        var status = 'draft';

        var data = {
            title: title,
            excerpt: excerpt,
            content: content,
			meta: {
                'org_title' : org_title, 
                'year' : year,
                'imdb_id' : imdb_id,
                'tmdb_id' : tmdb_id,
                'language' : language,
                'backdrop_path' : backdrop_path,
                'actors' : actors,
                'quality' : quality,
                'poster_url' : poster_url,
                'genres' : genres,
                'overviews' : overviews,
                'release_date' : release_date, 
                'runtime' : runtime,
                'country' : country,
                'tagline' : tagline,
                'youtube_link' : youtubeLink,
                'vote_avarage' : vote_avarage, 
            },
            // existing tags by id works
            // tags: [ 
            //     id => 5,
            //     ]            
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
                // alert(response);
            },
            fail : function( response ) {
                console.log( response );
                alert( POST_SUBMITTER.failure );
            }
        });
    });

} );
