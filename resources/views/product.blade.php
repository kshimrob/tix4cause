@extends('layout')

<?php
use Carbon\Carbon; 
?>
@section('title', $product->name)

@section('extra-css')
    <link rel="stylesheet" href="{{ asset('css/algolia.css') }}">
@endsection

@section('content')
    {{-- <div class="container">
        @if (session()->has('success_message'))
            <div class="alert alert-success">
                {{ session()->get('success_message') }}
            </div>
        @endif

        @if(count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div> --}}

    <div class="product-section container cleafix">
        <div class="product-section-image">
            <img src="https://elasticbeanstalk-us-east-2-698644334116.s3.us-east-2.amazonaws.com/{{ $product->image }}">
            <p>Share</p>
            <a class="twitter-share-button" target="_blank" href="https://twitter.com/intent/tweet?text={{ $product->name }}&url={{ 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] }}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg></a>
            <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] }}&src=sdkpreparse" class="fb-xfbml-parse-ignore"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"/></svg></a>
        </div>
        <div class="product-section-information">
            <h1 class="product-section-title">{{ $product->name }}</h1>
            <p class="tag">{{ $product->venue }}</p>
            <p class="tag">{{ $product->details }}</p>
            <p class="date-time">{{ date("D M jS, Y", strtotime($product->date)) }} | {{ date("g:i a", strtotime($product->time)) }}</p>
            <div>{!! $stockLevel !!}</div>
            <p>{!! $product->description !!}</p>
            <div class="product-section-price">{{ $product->presentPrice() }}</div>
            <p class="tag">Quantity</p>
            <form action="{{ route('checkout.show', $product->slug) }}" method="get">
                <select style="background-image: url({{ asset('img/dropdown.png') }});display:block;" class="quantity" name="quantity" id="quantity" data-id="{{ $product->rowId }}" data-productQuantity="{{ $product->quantity }}">
                    @for ($i = 1; $i < $product->quantity + 1 ; $i++)
                        <option {{ 1 == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
                <input id="terms-checkbox" style="margin-top:25px;" type="checkbox"><p style="display:inline;">I agree to the <a style="text-decoration:underline;" id="terms-link" target="_blank" href="/proprietary">Terms & Conditions</a></p>
                @if ($product->quantity > 0)
                    {{-- <a href="{{ route('checkout.show', $product->slug) }}">Purchase</a> --}}
                    <button type="submit" class="red-btn">Purchase</button>
                @endif
            </form>
            <p class="donated-by">{{ $product->donated_by }}</p>
        </div>
    </div> <!-- end product-section -->

    <div class="cause-banner">
        <h2>Your Purchase Will <span>be the Change</span> For:</h2>
    </div>

    <div class="single-cause container clearfix">
        <div class="row">
            <div class="md-col-6 sm-col-12">
                @if ( $cause->logo )
                    <img class="logo" src="{{ Voyager::image( $cause->logo ) }}" alt="Logo of organization">
                @endif
                <h1>{{ $cause->name }}</h1>
                <h2>{{ $cause->second_headline }}</h2>
                {!! $cause->description !!}
                <p><a class="tag" href="{{ $cause->website }}">{{ $cause->website }}</a></p>
            </div>
            <div class="md-col-6 sm-col-12">
                <img class="main-img" src="{{ Voyager::image( $cause->image ) }}" alt="{{ $cause->image_alt_tag }}">
            </div>
        </div>
    </div>
@endsection

@section('extra-js')
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        (function(){

            // const currentImage = document.querySelector('#currentImage');
            // const images = document.querySelectorAll('.product-section-thumbnail');

            // images.forEach((element) => element.addEventListener('click', thumbnailClick));

            // function thumbnailClick(e) {
            //     currentImage.classList.remove('active');

            //     currentImage.addEventListener('transitionend', () => {
            //         currentImage.src = this.querySelector('img').src;
            //         currentImage.classList.add('active');
            //     })

            //     images.forEach((element) => element.classList.remove('selected'));
            //     this.classList.add('selected');
            // }

        })();
    </script>

    <!-- Include AlgoliaSearch JS Client and autocomplete.js library -->
    <script src="https://cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
    <script src="https://cdn.jsdelivr.net/autocomplete.js/0/autocomplete.min.js"></script>
    <script src="{{ asset('js/algolia.js') }}"></script>

@endsection
