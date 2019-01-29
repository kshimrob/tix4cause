@extends('layout')

@section('title', 'Checkout')

@section('extra-css')

<!-- <script src="https://js.stripe.com/v3/"></script> -->

@endsection

@section('content')

    <div class="container">
        @if (session('status'))
            <div class="alert">
                <p>{{ session('status') }}</p>
                <p>Please <a href="{{ route('shop.show', $product->slug) }}">edit the number of tickets</a> you would like to purchase.</p>
            </div>
        @endif
        <h1 class="checkout-heading stylish-heading">Checkout</h1>
        <div class="product-section-information">
            <h2 class="product-section-title">{{ $product->name }}</h2>
            <p>{{ $product->details }}</p>
        </div>
        <div class="checkout-section">
            <div>
                <form class="" action="{{ url('/checkout') }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                    </div>
                    <h3 style="text-decoration:underline;">Billing Details</h3>
                    <div class="half-form">
                            <div class="form-group">
                                <label for="firstName">First Name</label>
                                <input type="text" class="form-control" id="firstName" name="firstName" required>
                            </div>
                            <div class="form-group">
                                <label for="lastName">Last Name</label>
                                <input type="text" class="form-control" id="lastName" name="lastName" required>
                            </div>
                        </div> <!-- end half-form -->
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}" required>
                    </div>

                    <div class="half-form">
                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" class="form-control" id="city" name="city" value="{{ old('city') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="state">State</label>
                            <input type="text" class="form-control" id="state" name="state" value="{{ old('province') }}" required>
                        </div>
                    </div> <!-- end half-form -->
                    <div class="half-form">
                            <div class="form-group">
                                <label for="postalcode">Postal Code</label>
                                <input type="text" class="form-control" id="postalcode" name="postalcode" value="{{ old('postalcode') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="country">Country</label>
                                <input type="text" class="form-control" id="country" name="country" value="{{ old('postalcode') }}" required>
                            </div>
                        </div> <!-- end half-form -->
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}" required>
                    </div>
                    <h3 style="text-decoration:underline;">Credit Card Information</h3>
                    <div class="form-group">
                        <label for="cnumber">Card Number</label>
                        <input type="text" class="form-control" id="cnumber" name="cnumber" placeholder="Enter Card Number">
                    </div>
                    <div class="form-group">
                      <label for="card-expiry-month">Expiration Month</label>
                      {{ Form::selectMonth(null, null, ['name' => 'card_expiry_month', 'class' => 'form-control', 'required']) }}
                    </div>
                    <div class="form-group">
                      <label for="card-expiry-year">Expiration Year</label>
                      {{ Form::selectYear(null, date('Y'), date('Y') + 10, null, ['name' => 'card_expiry_year', 'class' => 'form-control', 'required']) }}
                    </div>
                    <div class="form-group">
                        <label for="ccode">CVV Code</label>
                        <input type="text" class="form-control" id="ccode" name="ccode" placeholder="Enter Card Code">
                    </div>
                    <div class="form-group">
                        <label for="camount">Amount to be Charged</label>
                        <input type="text" class="form-control" id="camount" name="camount" value="{{ str_replace('$', '', $product->priceWithTax(str_replace('quantity=', '', $_SERVER['QUERY_STRING']))) }}" readonly>
                    </div>
                    <input type="hidden" id="productid" name="productid" value="{{ $product->id }}">
                    <input type="hidden" id="ticketquantity" name="ticketquantity" value="{{ str_replace('quantity=', '', $_SERVER['QUERY_STRING']) }}">
                    <button type="submit" class="btn btn-primary">Submit</button>
    </form>
            </div>



            <div class="checkout-table-container">
                <h2>Your Order</h2>

                <div class="checkout-table">
                    {{--@foreach (Cart::content() as $item)--}}
                    <div class="checkout-table-row">
                        <div class="checkout-table-row-left">
                            <img src="{{ productImage($product->image) }}" alt="item" class="checkout-table-img">
                            <div class="checkout-item-details">
                                <div class="checkout-table-item">{{ $product->name }}</div>
                                <div class="checkout-table-description">{{ $product->details }}</div>
                                <div class="checkout-table-price">{{ $product->presentPrice() }}</div>
                            </div>
                        </div> <!-- end checkout-table -->

                        <div class="checkout-table-row-right">
                            <div class="checkout-table-quantity">{{ $product->qty }}</div>
                        </div>
                    </div> <!-- end checkout-table-row -->
                    {{--@endforeach--}}

                </div> <!-- end checkout-table -->

                <div class="checkout-totals">
                    <a href="{{ route('shop.show', $product->slug) }}">Edit Quantity</a>
                    <div class="checkout-totals-left">
                        Quantity <br>
                        Subtotal <br>
                        Fee ({{ $product->fee }}%)<br>
                        <span class="checkout-totals-total">Total</span>
                    </div>

                    <div class="checkout-totals-right">
                        {{ str_replace('quantity=', '', $_SERVER['QUERY_STRING']) }} <br>
                        {{ $product->priceWithQuantity(str_replace('quantity=', '', $_SERVER['QUERY_STRING'])) }} <br>
                        {{ $product->taxCost(str_replace('quantity=', '', $_SERVER['QUERY_STRING'])) }} <br>
                        <span class="checkout-totals-total">{{ $product->priceWithTax(str_replace('quantity=', '', $_SERVER['QUERY_STRING'])) }}</span>
                    </div>
                </div> <!-- end checkout-totals -->
            </div>

        </div> <!-- end checkout-section -->
    </div>

@endsection

@section('extra-js')
    <!-- stripe javascript
    <script>
        (function(){
            // Create a Stripe client
            var stripe = Stripe('pk_test_JKVJPMynL8ckk7ivBxoroTlT');

            // Create an instance of Elements
            var elements = stripe.elements();

            // Custom styling can be passed to options when creating an Element.
            // (Note that this demo uses a wider set of styles than the guide below.)
            var style = {
              base: {
                color: '#32325d',
                lineHeight: '18px',
                fontFamily: '"Roboto", Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                  color: '#aab7c4'
                }
              },
              invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
              }
            };

            // Create an instance of the card Element
            var card = elements.create('card', {
                style: style,
                hidePostalCode: true
            });

            // Add an instance of the card Element into the `card-element` <div>
            card.mount('#card-element');

            // Handle real-time validation errors from the card Element.
            card.addEventListener('change', function(event) {
              var displayError = document.getElementById('card-errors');
              if (event.error) {
                displayError.textContent = event.error.message;
              } else {
                displayError.textContent = '';
              }
            });

            // Handle form submission
            var form = document.getElementById('payment-form');
            form.addEventListener('submit', function(event) {
              event.preventDefault();

              // Disable the submit button to prevent repeated clicks
              document.getElementById('complete-order').disabled = true;

              var options = {
                name: document.getElementById('name_on_card').value,
                address_line1: document.getElementById('address').value,
                address_city: document.getElementById('city').value,
                address_state: document.getElementById('province').value,
                address_zip: document.getElementById('postalcode').value
              }

              stripe.createToken(card, options).then(function(result) {
                if (result.error) {
                  // Inform the user if there was an error
                  var errorElement = document.getElementById('card-errors');
                  errorElement.textContent = result.error.message;

                  // Enable the submit button
                  document.getElementById('complete-order').disabled = false;
                } else {
                  // Send the token to your server
                  stripeTokenHandler(result.token);
                }
              });
            });

            function stripeTokenHandler(token) {
              // Insert the token ID into the form so it gets submitted to the server
              var form = document.getElementById('payment-form');
              var hiddenInput = document.createElement('input');
              hiddenInput.setAttribute('type', 'hidden');
              hiddenInput.setAttribute('name', 'stripeToken');
              hiddenInput.setAttribute('value', token.id);
              form.appendChild(hiddenInput);

              // Submit the form
              form.submit();
            }
        })();
    </script> -->
@endsection
