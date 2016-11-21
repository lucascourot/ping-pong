<?php

namespace spec\LucasCourot\Movie;

use LucasCourot\Movie\Movie;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MovieSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->beConstructedThrough('named', ['Terminator']);
        $this->shouldHaveType(Movie::class);
    }

    function it_has_a_name()
    {
        $this->beConstructedThrough('named', ['Terminator']);
        $this->getName()->shouldReturn('Terminator');
    }

    function it_can_change_name()
    {
        $this->beConstructedThrough('named', ['Terminator 1']);
        $this->rename('Terminator 2');
        $this->getName()->shouldReturn('Terminator 2');
    }

    function it_cannot_be_null()
    {
        $this->beConstructedThrough('named', [null]);
        $this->shouldThrow(\TypeError::class)->duringInstantiation();
    }

    function it_cannot_be_empty()
    {
        $this->beConstructedThrough('named', ['']);
        $this->shouldThrow(\InvalidArgumentException::class)->duringInstantiation();
    }

    function it_cannot_rename_by_null()
    {
        $this->beConstructedThrough('named', ['Terminator 1']);
        $this->shouldThrow(\TypeError::class)->during('rename', [null]);
    }

    function it_cannot_rename_by_empty()
    {
        $this->beConstructedThrough('named', ['Terminator 1']);
        $this->shouldThrow(\InvalidArgumentException::class)->during('rename', ['']);
    }

    function it_has_a_rating()
    {
        $this->beConstructedThrough('named', ['Terminator 1']);
        $this->isRated()->shouldBe(false);
    }

    function it_rates_a_movie()
    {
        $this->beConstructedThrough('named', ['Terminator 1']);
        $this->rate(Movie::RATING_1);
        $this->isRated()->shouldBe(true);
    }

    function it_gets_rating()
    {
        $this->beConstructedThrough('named', ['Terminator 1']);
        $this->rate(Movie::RATING_3);
        $this->getRating()->shouldBe(Movie::RATING_3);
    }

    function it_cannot_get_rating_if_not_rated_yet()
    {
        $this->beConstructedThrough('named', ['Terminator 1']);
        $this->shouldThrow(\LogicException::class)->during('getRating');
    }

    function it_has_a_default_category()
    {
        $this->beConstructedThrough('named', ['Terminator 1']);
        $this->getCategory()->shouldBe('uncategorized');
    }

    function it_can_categorize()
    {
        $this->beConstructedThrough('named', ['Terminator 1']);
        $this->categorize('action');
        $this->getCategory()->shouldBe('action');
    }

    function it_cannot_define_unknown_category()
    {
        $this->beConstructedThrough('named', ['Terminator 1']);
        $this->shouldThrow(\InvalidArgumentException::class)->during('categorize', ['unknown']);
        $this->getCategory()->shouldBe('uncategorized');
    }
}
