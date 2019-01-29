@extends('layout')

@section('title')
Buy Verified Resale Tickets
@endsection

@section('description', 'Purchase verified resale tickets with confidence on Tix4Cause. Every ticket is backed by a 100% money-back guarantee.')

@section('content')
<div class="container about">
    <h1>We <span>provide</span> people an <span>effortless</span> way to support the causes that move them.
    </h1>
    <div class="intro">
      <div class="row">
        <div class="img"><img src="{{ asset('img/about1.png') }}"></div>
        <div class="text">
          <h2>Our Story</h2>
          <p class="copy">It all started when Co-Founder Kevin Nemetz asked himself a simple question while sitting in a mostly empty section at a Chicago White Sox game:</p>
          <p>“What if, instead of going to waste, all these tickets for these empty seats were donated to charity?" Determined to find a way to make that happen, Kevin and his wife Mary set out to create a social enterprise that would change the way people buy tickets and help the causes they care about. For many, the most significant barrier to charitable giving is that it always costs "more" to give back - either more time or more money. Tix4Cause changes all of this forever. Now, instead of having to come out of pocket to help a cause, you're able to seamlessly help an organization you care about through a purchase you're going to make anyway - at no extra cost. This is what working together on Tix4cause is all about.</p>
        </div>
      </div>
      <div class="row">
        <div class="text">
          <h2>Why Tix4Cause?</h2>
          <p class="copy">At Tix4Cause, we empower people to turn everyday ticket purchases into meaningful change by donating a portion of our service fee on every purchase to charity.</p>
          <p>Tix4Cause is not a ticket broker. We’re a social enterprise that offers access to the same verified resale tickets available on other popular sites at the exact same prices. While other sites broker the tickets and pocket the service fee they charge on top of your ticket price, Tix4Cause receives a portion of the fee and donates 50% of what it earns to the charitable cause of your choosing. Same tickets, same price, but a whole lot of good. We also offer access to exclusive tickets and events that are generously donated by partners and individuals like you. For these exclusive tickets and events, 100% of the price paid benefits the cause of the donor’s choosing. Charitable giving is at the core of everything we do, and we promise to continue working to create solutions that make giving back simple and accessible to everyone.</p>
        </div>
        <div class="img"><img src="{{ asset('img/about2.png') }}"></div>
      </div>
    </div>

    @component('components.howitworks')
    @endcomponent

    <div class="blog-posts-preview">
        <h2>News + Updates</h2>
        <div class="col-md-3">
        @foreach ($posts as $post)
          <a href="{{ route('post.show', $post->slug) }}" class="post">
              <div>
                  <div class="post-img" style="background-image: url({{ Voyager::image( $post->image ) }})"></div>
                  <h3>{{ $post->title }}</h3> 
                  <p>{{ str_limit($post->excerpt, $limit = 150, $end= '...') }} <span>Read More</span></p>
              </div>
          </a>
        @endforeach
        </div>
        <!--
        <div class="more-posts">
                <a href="{{ route('blog.index') }}" class="yellow-btn">See More</a>
        </div>-->
    </div> <!-- end blog posts preview -->
</div>
    @component('components.searchevents')
    @endcomponent
@endsection