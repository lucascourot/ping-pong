<?php

declare(strict_types=1);

namespace LucasCourot\Movie;

class MovieCollection
{
    private $movies;

    public function __construct()
    {
        $this->movies = [];
    }

    public function count() : int
    {
        return count($this->movies);
    }

    public function add(Movie $movie)
    {
        if ($this->contains($movie->getName())) {
            throw new \InvalidArgumentException('Movie already exists');
        }

        $this->movies[$movie->getName()] = $movie;
    }

    public function contains(string $movieName)
    {
        return array_key_exists($movieName, $this->movies);
    }
}
