<?php
/**
 * Output form on page "submit-post"
 */
add_filter( 'the_content', function( $content ) {
	if ( is_page( 'submit-post' ) ) {
		//only show to logged in users who can edit posts
		if ( is_user_logged_in() && current_user_can( 'edit_posts' ) ) {
			ob_start();?>
			
			<div class="container">
			<div class="search-id-form">
			  <form class="form-inline" method="get" >
				<div class="form-group">
					<label class="control-label">Search TMDB ID: </label>
					<input type="text" name="search-id" class="form-control">
					<button type="submit" class="btn btn-primary" id="searchidsubmit">Search</button>
				</div>
			</form>
			<div class="id-output">
			  <img src="" alt="" class="poster">
			</div>
			</div> <!-- search id form ends -->
			<div class="import-form">
			  <form class="form-inline" method="get" >
				<div class="form-group">
				<label class="control-label">TMDB ID: </label>
				<input type="text" name="imdb-id" class="form-control">
				<button type="submit" class="btn btn-primary" id="apisubmit">Import</button>
			</div>
			</form>
			</div> <!-- import form ends -->
		
			<form class="form-horizontal" method="post" id="post-submission-form" >
			<div class="form-group">
				<label for="urls" class="col-sm-2 control-label">URLs</label>
				<div class="col-sm-9">
				  <textarea class="form-control" rows="10" name="urls" id="urls" placeholder="URL's"></textarea>
				</div>
				<div class="preview">
				  <div class="col-md-3">
					<img src="" alt="">
					<h4></h4>
				  </div>
				</div>
			  </div>
			  <div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
				  <button type="submit" class="btn btn-success  " id="addmovie">Add Movie</button>
				</div>
			  </div>
			<div class="row">
			  <div class="col-md-6">
			  <div class="form-group">
				<label for="title" class="col-sm-2 control-label">Title</label>
				<div class="col-sm-10">
				  <input type="text" class="form-control" id="title" name="title" placeholder="Movie Title">
				</div>
			  </div>
			  <div class="form-group">
				<label for="original_title" class="col-sm-2 control-label">original_title</label>
				<div class="col-sm-10">
				  <input type="text" class="form-control" id="original_title" name="original_title" placeholder="Original Title">
				</div>
			  </div>
			  <div class="form-group">
				<label for="type" class="col-sm-2 control-label">Type</label>
				<div class="col-sm-10">
				  <input type="text" class="form-control" id="type" name="type" value="movie">
				</div>
			  </div>
			  <div class="form-group">
				<label for="year" class="col-sm-2 control-label">Year</label>
				<div class="col-sm-10">
				  <input type="text" class="form-control" id="year" name="year" placeholder="Year">
				</div>
			  </div>
			  <div class="form-group">
				<label for="imdb" class="col-sm-2 control-label">IMDB</label>
				<div class="col-sm-10">
				  <input type="text" class="form-control" id="imdb" name="imdb" placeholder="IMDB">
				</div>
			  </div>
			  <div class="form-group">
				<label for="tmdb" class="col-sm-2 control-label">tmdb</label>
				<div class="col-sm-10">
				  <input type="text" class="form-control" id="tmdb" name="tmdb" placeholder="tmdb">
				</div>
			  </div>      
			  <!-- <div class="form-group">
				<label for="season" class="col-sm-2 control-label">Season No</label>
				<div class="col-sm-10">
				  <input type="text" class="form-control" id="season" name="season" placeholder="Season No">
				</div>
			  </div>
			  <div class="form-group">
				<label for="episode" class="col-sm-2 control-label">Episode No</label>
				<div class="col-sm-10">
				  <input type="text" class="form-control" id="episode" name="episode" placeholder="Episode No">
				</div>
			  </div> -->
			  <div class="form-group">
				<label for="lang" class="col-sm-2 control-label">Language</label>
				<div class="col-sm-10">
				  <input type="text" class="form-control" id="lang" name="lang" placeholder="Language">
				</div>
			  </div>
			  <div class="form-group">
				<label for="backdrop_path" class="col-sm-2 control-label">backdrop_path</label>
				<div class="col-sm-10">
				  <input type="text" class="form-control" id="backdrop_path" name="backdrop_path">
				</div>
				</div>
				<div class="form-group">
				<label for="actors" class="col-sm-2 control-label">Actors</label>
				<div class="col-sm-10">
				  <input type="text" class="form-control" id="actors" name="actors">
				</div>
			  </div>
			  
			  </div>
			  <!-- column one ends -->
		
			  <div class="col-md-6">
			  <div class="form-group">
				<label for="quality" class="col-sm-2 control-label">Quality</label>
				<div class="col-sm-10">
				  <select class="form-control" id="quality" name="quality">
					<option value="cam" >CAM</option>
					<option value="hd" selected>HD</option>
				  </select>
				</div>
			  </div>
			  <div class="form-group">
				<label for="poster" class="col-sm-2 control-label">poster</label>
				<div class="col-sm-10">
				  <input type="text" class="form-control" id="poster" name="poster">
				</div>
			  </div>
			  <div class="form-group">
				<label for="genres" class="col-sm-2 control-label">genres</label>
				<div class="col-sm-10">
				  <input type="text" class="form-control" id="genres" name="genres">
				</div>
			  </div>
			  <div class="form-group">
				<label for="overview" class="col-sm-2 control-label">overview</label>
				<div class="col-sm-10">
				  <input type="text" class="form-control" id="overview" name="overview">
				</div>
			  </div>
			  <div class="form-group">
				<label for="release_date" class="col-sm-2 control-label">release_date</label>
				<div class="col-sm-10">
				  <input type="text" class="form-control" id="release_date" name="release_date">
				</div>
			  </div>
			  <div class="form-group">
				<label for="runtime" class="col-sm-2 control-label">runtime</label>
				<div class="col-sm-10">
				  <input type="text" class="form-control" id="runtime" name="runtime">
				</div>
			  </div>
			  <div class="form-group">
				<label for="country" class="col-sm-2 control-label">Country</label>
				<div class="col-sm-10">
				  <input type="text" class="form-control" id="country" name="country">
				</div>
			  </div>
			  <div class="form-group">
				<label for="status" class="col-sm-2 control-label">status</label>
				<div class="col-sm-10">
				  <input type="text" class="form-control" id="status" name="status">
				</div>
			  </div>
			  <div class="form-group">
				<label for="tagline" class="col-sm-2 control-label">tagline</label>
				<div class="col-sm-10">
				  <input type="text" class="form-control" id="tagline" name="tagline">
				</div>
			  </div>
			  <div class="form-group">
				<label for="trailer_link" class="col-sm-2 control-label">Trailer Link</label>
				<div class="col-sm-10">
				  <input type="text" class="form-control" id="trailer_link" name="trailer_link">
				</div>
			  </div>
			  <div class="form-group">
				<label for="vote_avarage" class="col-sm-2 control-label">vote_avarage</label>
				<div class="col-sm-10">
				  <input type="text" class="form-control" id="vote_avarage" name="vote_avarage">
				</div>
			  </div>
			 </div>
			 <!-- column two ends -->
			 </div> <!-- row ends -->
			</form>
			</div>

			<script>
				jQuery(document).ready(function($) {
						<?php 
				$imdb_id = $_GET['imdb-id'];
				$search_id = str_replace(" ", "+", trim($_GET['search-id']));
					 ?>

			// test response: https://api.themoviedb.org/3/movie/337170?api_key=cac1dae6a16ac1ce25299e2b29b17e99&append_to_response=videos,images,credits
			var api = 'https://api.themoviedb.org/3/movie/<?php echo $imdb_id; ?>?api_key=cac1dae6a16ac1ce25299e2b29b17e99&append_to_response=videos,images,credits';
		
			var searchidapi = 'https://api.themoviedb.org/3/search/movie?api_key=cac1dae6a16ac1ce25299e2b29b17e99&query=<?php echo $search_id; ?>';
		
			$.getJSON(searchidapi, function(id) {
			   console.log(id);
			   var output = "";
			   for (var i = id.total_results - 1; i >= 0; i--) {
				output += '<img src="https://image.tmdb.org/t/p/w150/' + id.results[i].poster_path + '">';
				output += '<h4>' + id.results[i].id +'</h4>';
				output += '<h4>' + id.results[i].title +'</h4>';
				 // $('.poster').attr('src', 'https://image.tmdb.org/t/p/w300/' + id.results[i].poster_path);
			   }
			   $('.id-output').html(output);
			   
		
			});
		
					$.getJSON(api, function (data) {
							 console.log(data);
		
							 $('#title').val(data.title);
							 // $('#type').val(data.Type);
							 $('#year').val(data.release_date.substr(0, 4));
							 $('#imdb').val(data.imdb_id);
							 $('#lang').val(data.original_language);
							 $('#backdrop_path').val('https://image.tmdb.org/t/p/w1000/' + data.backdrop_path);
							 $('#tmdb').val(data.id);
							 $('#original_title').val(data.original_title);
							 $('#overview').val(data.overview);
							 $('#poster').val('https://image.tmdb.org/t/p/w500/' + data.poster_path);
							 $('#release_date').val(data.release_date);
							 $('#runtime').val(data.runtime);
							 $('#country').val(data.production_countries[0].name);
							 $('#status').val(data.status);
							 $('#tagline').val(data.tagline);
							 $('#trailer_link').val('https://www.youtube.com/watch?v=' + data.videos.results[0]['key']);
							 $('#vote_avarage').val(data.vote_average);
							 
							var genresList = "";
		
							for (i = 0; i < data.genres.length; i++) { 
								genresList += data.genres[i]['name'] + ", ";
								
							}
							 $('#genres').val(genresList);
							 var actorsList ="";
							 for (i=0; i < data.credits.cast.length ; i++) { 
								 actorsList += data.credits.cast[i]['name'] + ", ";						 
							 }
							 $('#actors').val(actorsList);
							 $(".preview").find('img').attr('src', 'https://image.tmdb.org/t/p/w150/' + data.poster_path);
		
							 $(".preview").find('h4').text(data.title);
						 
					$('#inputchange').click(function(event) {
								
							 });
		
					}); 
				});
			</script>
			
			<?php
			$content .= ob_get_clean();
		}else{
			$content .=  sprintf( '<a href="%1s">%2s</a>', esc_url( wp_login_url() ), __( 'Click Here To Login', 'wptmdbmoviesapi' ) );
		}
	}

	return $content;
});

