@extends('layout')

@section('title')
Concert & Sports Ticket Exchange
@endsection

@section('description', 'Tix4Cause is a ticket exchange with access to millions of concert, sports & event tickets where a portion of every purchase is donated to charity.')

@section('content')
<div class="header-container">
    <div class="landing-header">
        <video autoplay muted loop id="bgvid">
            <source src="https://s3.us-east-2.amazonaws.com/elasticbeanstalk-us-east-2-698644334116/videoplayback+v3.mp4" />
        </video>
        <div id="mobile-bg-img" style="background:url(https://s3.us-east-2.amazonaws.com/elasticbeanstalk-us-east-2-698644334116/videoplayback_still+image.png);background-size:cover;"></div>
        <div class="text">
            <h1>Where you buy your ticket matters</h1>
            <p>Shop millions of tickets on our ticket platform and with every purchase, we donate 50% of our earnings to the cause of your choice.</p>
            <!--<p><a href="/about" class="yellow-btn">Learn More</a></p>-->
            <div class="home-search">
                <form action="/searchEvents">
                    <p>Search by Event, Performer, Venue, or Team</p>
                    
                    <input type="text" name="keyword">
                    <button type="submit">Search</button>
                    
                </form>
                <p>Find events near you:</p>
                <ul>
                    <li><a href="/searchEvents?category=concerts">Music</a></li>
                    <li><a href="/searchEvents?category=sports">Sports</a></li>
                    <li><a href="/searchEvents?category=arts-and-theater">Theater</a></li>
                    <li><a href="/searchEvents?category=comedy">Comedy</a></li>
                    
                    
                </ul>
            </div>
        </div>
    </div>
</div>
    <div class="featured-tickets">
        <h2>Popular Near You</h2>
        <!--
        <div class="col-md-3">
            @foreach ($products as $product)
                <div class="product clearfix">
                    <div class="ticket-img" style="background-image: url({{ productImage($product->image) }})"></div>
                    <p class="product-name">{{ $product->name }}</p>
                    <p>{{ $product->date }}</p>
                    <p>{{ $product->venue }}</p>
                    <a href="{{ route('shop.show', $product->slug) }}" class="red-btn">Read More</a>
                </div>
            @endforeach
        </div>-->
        <?php
include(app_path().'/Includes/tnwsConstants.php');
include(app_path().'/Includes/genericLib.php');
?>
<?php
            
        ?>
        <div class="col-md-3">
        <?php getHomeEvents(array('websiteConfigID' => WEB_CONF_ID, 'cityZip' => 'Chicago', 'numberOfEvents' => 6)); ?>
        </div>
        <div class="more-tickets">
            <a href="/searchEvents?category=concerts" class="yellow-btn">See More</a>
        </div>
    </div> <!-- end tickets -->

    <div class="long-promos">
        @foreach ($long_promos as $promo)
        <div class="single-long-promo clearfix">
            <div class="text">
                <h2>{{ $promo->title }}</h2>
                <p>{{ $promo->description }}</p>
                <p><a href="{{ $promo->url }}" class="red-btn">See Tickets</a></p>
            </div>
            <div class="promo-img" style="background-image: url({{ Voyager::image($promo->image) }});"></div>
        </div>
        @endforeach
    </div> <!-- end long promos -->

    <div class="short-promos">
        @foreach ($short_promos as $promo)
        <div class="single-short-promo clearfix">
            <div class="text">
                <h2>{{ $promo->title }}</h2>
                <p>{{ $promo->description }}</p>
                <p><a href="{{ $promo->url }}" class="red-btn">See Tickets</a></p>
            </div>
            <div class="promo-img" style="background-image: url({{ Voyager::image($promo->image) }});"></div>
        </div>
        @endforeach
    </div> <!-- end short promos -->

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
    <script>
        
        var promise = document.querySelector('video').play();

if (promise !== undefined) {
  promise.then(_ => {
    // Autoplay started!
  }).catch(error => {
    // Autoplay was prevented.
    // Show a "Play" button so that user can start playback.
  });
}
    </script>
@endsection