<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use App\OrderProduct;
use App\Mail\OrderPlaced;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\CheckoutRequest;
use Gloudemans\Shoppingcart\Facades\Cart;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Cartalyst\Stripe\Exception\CardErrorException;
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index($slug)
    // {
    //     $product = Product::where('slug', $slug)->firstOrFail();
    //     return view('checkout')->with([
    //         'newSubtotal' => getNumbers()->get('newSubtotal'),
    //         'newTax' => getNumbers()->get('newTax'),
    //         'newTotal' => getNumbers()->get('newTotal'),
    //         'product' => $product,
    //     ]);
    // }
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        return view('checkout')->with([
            'newSubtotal' => getNumbers()->get('newSubtotal'),
            'newTax' => getNumbers()->get('newTax'),
            'newTotal' => getNumbers()->get('newTotal'),
            'product' => $product,
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CheckoutRequest $request)
    {
        // Check race condition when there are less items available to purchase
        // if ($this->productsAre()) {
        //     return back()->withErrors('Sorry! One of the items in your cart is no longer avialble.');
        // }

        // $contents = Cart::content()->map(function ($item) {
        //     return $item->model->slug.', '.$item->qty;
        // })->values()->toJson();

        // try {
        //     $charge = Stripe::charges()->create([
        //         'amount' => getNumbers()->get('newTotal') / 100,
        //         'currency' => 'CAD',
        //         'source' => $request->stripeToken,
        //         'description' => 'Order',
        //         'receipt_email' => $request->email,
        //         'metadata' => [
        //             'contents' => $contents,
        //             'quantity' => Cart::instance('default')->count(),
        //             'discount' => collect(session()->get('coupon'))->toJson(),
        //         ],
        //     ]);

        //     $order = $this->addToOrdersTables($request, null);
        //     Mail::send(new OrderPlaced($order));

        //     // decrease the quantities of all the products in the cart
        //     $this->decreaseQuantities();

        //     Cart::instance('default')->destroy();
        //     session()->forget('coupon');

        //     return redirect()->route('confirmation.index')->with('success_message', 'Thank you! Your payment has been successfully accepted!');
        // } catch (CardErrorException $e) {
        //     $this->addToOrdersTables($request, $e->getMessage());
        //     return back()->withErrors('Error! ' . $e->getMessage());
        // }
    }

    public function chargeCreditCard(Request $request)
    {
        //commented this out for now it was throwing an error
        /*if ($this->productsAreNoLongerAvailable($request->productid, intval($request->ticketquantity))) {
            // $product = Product::where('id', $request->productid)->firstOrFail();
            return back()->withInput()->with('status', 'The most updated quantity of tickets is less than what you selected.');
            //send an error message somehow
        } else { */
            // decrease the quantities of product by 1
            $this->decreaseQuantities($request->productid, intval($request->ticketquantity));
    
            // Common setup for API credentials
            $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
            $merchantAuthentication->setName(config('services.authorize.login'));
            $merchantAuthentication->setTransactionKey(config('services.authorize.key'));
            $refId = 'ref'.time();
    
            // Create the payment data for a credit card
            $creditCard = new AnetAPI\CreditCardType();
            $creditCard->setCardNumber($request->cnumber);
    
            // Create order information
            $order = new AnetAPI\OrderType();
            $order->setDescription($request->description);
    
            // $creditCard->setExpirationDate( "2038-12");
            $expiry = $request->card_expiry_year . '-' . $request->card_expiry_month;
            $creditCard->setExpirationDate($expiry);
            $paymentOne = new AnetAPI\PaymentType();
            $paymentOne->setCreditCard($creditCard);
    
            // Set the customer's identifying information
            $customerData = new AnetAPI\CustomerDataType();
            $customerData->setEmail($request->email);
    
            // Set the customer's Bill To address
            $customerAddress = new AnetAPI\CustomerAddressType();
            $customerAddress->setFirstName($request->firstName);
            $customerAddress->setLastName($request->lastName);
            $customerAddress->setAddress($request->address);
            $customerAddress->setCity($request->city);
            $customerAddress->setState($request->state);
            $customerAddress->setZip($request->postalcode);
            $customerAddress->setCountry($request->country);
    
            // Create a transaction
            $transactionRequestType = new AnetAPI\TransactionRequestType();
            $transactionRequestType->setTransactionType("authCaptureTransaction");
            $transactionRequestType->setAmount($request->camount);
            $transactionRequestType->setOrder($order);
            $transactionRequestType->setPayment($paymentOne);
            $transactionRequestType->setBillTo($customerAddress);
            $transactionRequestType->setCustomer($customerData);
            $request = new AnetAPI\CreateTransactionRequest();
            $request->setMerchantAuthentication($merchantAuthentication);
            $request->setRefId( $refId);
            $request->setTransactionRequest($transactionRequestType);
            $controller = new AnetController\CreateTransactionController($request);
            $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX);
            
    
            // if ($response != null)
            //             {
            //             $tresponse = $response->getTransactionResponse();
            //             if (($tresponse != null) && ($tresponse->getResponseCode()=="1"))
            //             {
            //                 echo "Charge Credit Card AUTH CODE : " . $tresponse->getAuthCode() . "\n";
            //                 echo "Charge Credit Card TRANS ID  : " . $tresponse->getTransId() . "\n";
            //             }
            //             else
            //             {
            //                 echo "Charge Credit Card ERROR :  Invalid response\n";
            //             }
            //             }
            //             else
            //             {
            //             echo  "Charge Credit Card Null response returned";
            //             }
            return redirect('/thankyou');

        // }
    }

    protected function addToOrdersTables($request, $error)
    {
        // Insert into orders table
    $order = Order::create([
            'user_id' => auth()->user() ? auth()->user()->id : null,
            'billing_email' => $request->email,
            'billing_name' => $request->name,
            'billing_address' => $request->address,
            'billing_city' => $request->city,
            'billing_province' => $request->province,
            'billing_postalcode' => $request->postalcode,
            'billing_phone' => $request->phone,
            'billing_name_on_card' => $request->name_on_card,
            'billing_discount' => getNumbers()->get('discount'),
            'billing_discount_code' => getNumbers()->get('code'),
            'billing_subtotal' => getNumbers()->get('newSubtotal'),
            'billing_tax' => getNumbers()->get('newTax'),
            'billing_total' => getNumbers()->get('newTotal'),
            'error' => $error,
        ]);

        // Insert into order_product table
        foreach (Cart::content() as $item) {
            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $item->model->id,
                'quantity' => $item->qty,
            ]);
        }

        return $order;
    }

    protected function decreaseQuantities($id, $quantity)
    {
            $product = Product::where('id', $id)->firstOrFail();

            $product->update(['quantity' => $product->quantity - $quantity]);
    }

    protected function checkIfZero($id)
    {
        $product = Product::where('id', $id)->firstOrFail();
        return $product->quantity == 0;
    }
}
