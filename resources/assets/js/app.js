(function() {

    let genres = document.querySelectorAll('.genres > *');
    let movies = document.querySelectorAll('.movie');

    let genreClickHandler = (event) => {
        let selectedGenre = event.target.textContent;

        movies.forEach(movie => {
           let movieGenres = JSON.parse(movie.dataset.genres);

           if(movieGenres.indexOf(selectedGenre) === -1) {
               movie.classList.add('hide');
           }
           else {
               movie.classList.remove('hide');
           }
        });
    };

    genres.forEach(genre => genre.addEventListener('click', genreClickHandler));

})();