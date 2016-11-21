<?php

namespace spec\LucasCourot\Movie;

use LucasCourot\Movie\Movie;
use LucasCourot\Movie\MovieCollection;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MovieCollectionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(MovieCollection::class);
    }

    function it_should_count_zero_when_empty()
    {
        $this->count()->shouldReturn(0);
    }

    function it_adds_a_movie()
    {
        $this->add(Movie::named('Terminator'));
        $this->count()->shouldReturn(1);
    }

    function it_adds_two_movies()
    {
        $this->add(Movie::named('Terminator 1'));
        $this->add(Movie::named('Terminator 2'));
        $this->count()->shouldReturn(2);
    }

    function it_contains_a_movie_by_name()
    {
        $movieName = 'Terminator';
        $this->add(Movie::named($movieName));
        $this->contains($movieName)->shouldBe(true);
    }

    function it_does_not_contain_a_movie()
    {
        $movieName = 'Terminator';
        $this->add(Movie::named($movieName));
        $this->contains('Bambi')->shouldBe(false);
    }

    function it_cannot_add_two_movies_with_same_name()
    {
        $this->add(Movie::named('Terminator'));
        $this->shouldThrow(\InvalidArgumentException::class)->during('add', [Movie::named('Terminator')]);
    }
}
