<?php

declare(strict_types=1);

namespace LucasCourot\Movie;

class Movie
{
    const RATING_1 = 1;
    const RATING_2 = 2;
    const RATING_3 = 3;
    const RATING_4 = 4;
    const RATING_5 = 5;
    const CATEGORY_DEFAULT = 'uncategorized';
    const ALLOWED_CATEGORIES = ['action', 'adventure', 'horror', 'comedy'];

    private $name;
    private $rating;
    private $category;

    private function __construct()
    {
    }

    public static function named(string $name) : self
    {
        self::checkName($name);

        $movie = new self();

        $movie->name = $name;
        $movie->category = self::CATEGORY_DEFAULT;

        return $movie;
    }

    private static function checkName(string $name)
    {
        if (empty($name)) {
            throw new \InvalidArgumentException('Movie name cannot be empty');
        }
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function rename(string $newName)
    {
        self::checkName($newName);

        $this->name = $newName;
    }

    public function isRated() : bool
    {
        return null !== $this->rating;
    }

    public function rate(int $rating)
    {
        if ($rating < self::RATING_1 || $rating > self::RATING_5) {
            throw new \InvalidArgumentException('Invalid rating value');
        }

        $this->rating = $rating;
    }

    public function getRating() : int
    {
        if (!$this->isRated()) {
            throw new \LogicException('Has not been rated yet');
        }

        return $this->rating;
    }

    public function getCategory() : string
    {
        return $this->category;
    }

    public function categorize(string $category)
    {
        if (!in_array($category, self::ALLOWED_CATEGORIES)) {
            throw new \InvalidArgumentException('Unknown category');
        }

        $this->category = $category;
    }
}
