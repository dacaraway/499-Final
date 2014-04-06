<?php
class DVDController extends BaseController {

    public function listMovies(){
        $dvd_title = Input::get('title');
        $ratings = Input::get('ratings');
        $genres = Input::get('genres');
        $labels = Input::get('labels');
        $format = Input::get('formats');
        $sound = Input::get('sounds');


        if($genres != -1 && $ratings != -1){
        $movies = Dvd::with('format', 'genre', 'label','rating','sound')
            ->where('genre_id', '=', $genres)
            ->where('rating_id', '=', $ratings)
            ->where('label_id', '=', $labels)
            ->where('format_id', '=', $format)
            ->where('sound_id', '=', $sound)
            ->where('title','LIKE', "%$dvd_title%")
            ->take(30)
            ->get();

        //$dvds = Dvd::listMovies($dvd_title, $ratings, $genres);
        return View::make('dvds/results', [
            'dvds' => $movies
        ]);
        }

        if($genres == -1 && $ratings != -1 ){
            $movies = Dvd::with('format', 'genre', 'label','rating','sound')
                ->where('rating_id', '=', $ratings)
                ->where('title','LIKE', "%$dvd_title%")
                ->where('label_id', '=', $labels)
                ->where('format_id', '=', $format)
                ->where('sound_id', '=', $sound)
                ->take(30)
                ->get();

            //$dvds = Dvd::listMovies($dvd_title, $ratings, $genres);

            return View::make('dvds/results', [
                'dvds' => $movies
            ]);
        }
        if($ratings != -1 && $genres != -1){
            $movies = Dvd::with('format', 'genre', 'label','rating','sound')
                ->where('genre_id', '=', $genres)
                ->where('title','LIKE', "%$dvd_title%")
                ->where('label_id', '=', $labels)
                ->where('format_id', '=', $format)
                ->where('sound_id', '=', $sound)
                ->take(30)
                ->get();

            //$dvds = Dvd::listMovies($dvd_title, $ratings, $genres);

            return View::make('dvds/results', [
                'dvds' => $movies
            ]);
        }
        if($genres == -1 && $ratings == -1){
            $movies = Dvd::with('format', 'genre', 'label','rating','sound')
                ->where('title','LIKE', "%$dvd_title%")
                ->where('label_id', '=', $labels)
                ->where('format_id', '=', $format)
                ->where('sound_id', '=', $sound)
                ->take(30)
                ->get();

            //$dvds = Dvd::listMovies($dvd_title, $ratings, $genres);
            //dd($movies->toArray());
            return View::make('dvds/results', [
                'dvds' => $movies
            ]);
        }

    }

    public function add(){
        $validation = Dvd::validate(Input::all());
        if ($validation->passes()) {
            $movie = new Dvd();
            $movie->title = Input::get('title');
            $movie->genre_id = Input::get('genres');
            $movie->rating_id = Input::get('ratings');
            $movie->sound_id = Input::get('sounds');
            $movie->format_id = Input::get('formats');
            $movie->label_id = Input::get('labels');
            $movie->save();

            return Redirect::to('dvds/create')
                ->with('success', 'The Song Was Inserted Successfully!');
        }
        return Redirect::to('dvds/create')
            ->withInput(Input::old())
            ->with('errors', $validation->messages());
    }

    public function getBoxes(){
        $ratings = $this->giveRatings();
        $genres = $this->giveGenres();
        $format = $this->giveFormat();
        $label = $this->giveLabel();
        $sound = $this->giveSound();

        return View::make('dvds/search', [
            'ratings' => $ratings,
            'genres' => $genres,
            'formats' => $format,
            'labels'  => $label,
            'sounds'  => $sound
        ]);
    }

    public function getBoxes2(){
        $ratings = $this->giveRatings();
        $genres = $this->giveGenres();
        $format = $this->giveFormat();
        $label = $this->giveLabel();
        $sound = $this->giveSound();

        return View::make('dvds/create', [
            'ratings' => $ratings,
            'genres' => $genres,
            'formats' => $format,
            'labels'  => $label,
            'sounds'  => $sound
        ]);
    }

    public function giveRatings(){
        $ratings = Rating::all();
        return $ratings;
    }

    public function giveGenres(){
        $genres = Genre::all();
        return $genres;
    }

    public function giveFormat(){
        $format = Format::all();
        return $format;
    }
    public function giveLabel(){
        $label = Label::all();
        return $label;
    }
    public function giveSound(){
        $sound = Sound::all();
        return $sound;
    }
} 