<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Movies</title>

        <!-- Fonts -->
        <link href="/css/semantic.css" rel="stylesheet" type="text/css">
        <link href="/css/app.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="viewport">
            <div class="ui two column grid">
                <div class="column">
                    <form action="/" method="get">
                        <select class="ui dropdown selection" name="year">
                            @foreach($dates as $date)
                                <option value="{{ $date->year }}" {{ $selectedYear === $date->year ? 'selected' : '' }}>{{ $date->year }}</option>
                            @endforeach
                        </select>
                        <button class="ui primary button">Go</button>
                    </form>
                </div>
                <div class="column">

                </div>
            </div>

            <div class="ui stackable three column grid">
            @foreach($movies as $movie)
                    <div class="movie column" data-genres="{{ json_encode($movie->getGenres()) }}">
                        <img src="{{ $movie->getImageUrl() }}" alt="{{ $movie->getTitle() }}" />
                        <h2>{{ $movie->getTitle() }}</h2>
                        <div class="genres">
                            @foreach($movie->getGenres() as $genre)
                                <div class="ui label">{{ $genre }}</div>
                            @endforeach
                        </div>
                        <p>{{ $movie->getDescription() }}</p>
                    </div>
                @endforeach
            </div>
        </div>


        <script src="/js/app.js"></script>
    </body>
</html>
