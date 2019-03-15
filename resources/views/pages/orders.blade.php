@include('includes.css-link')
@include('includes.navbar')
<div class="container">
    <div class="card card-body container margin-top-20">
        <h3>Confirm Items</h3>
        <hr>
        @php
            $totalPrice = 0;
        @endphp
        @foreach(\App\Model\Cart::totalCarts() as $cart)
            <p>
                {{$cart->product->title}} -
                <strong>{{$cart->product->price}}</strong> taka
                -{{$cart->product_quantity}}  item
            </p>
            @php
                $totalPrice += $cart->product->price*$cart->product_quantity;
            @endphp
        @endforeach
        <a href="{{route('carts.index')}}">Change Cart Items</a><hr>
        <h2>Total Price is {{$totalPrice}}</h2>
    </div>

    <div class="row justify-content-center margin-top-20">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Details') }}</div>
                @include('pages.admin.partials.messages')
                <div class="card-body">
                    <form method="POST" action="{{route('orders.store')}}">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-6 col-form-label text-md-right">{{ __('Name') }}</label>
                            <input id="name" type="text" class=" col-md-4 form-control" name="name" value="{{Auth::check()? Auth::user()->name:''}}"  autofocus>

                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-6 col-form-label text-md-right">{{ __('Email') }}</label>
                            <input id="email" type="text" class=" col-md-4 form-control" name="email" value="{{Auth::check()? Auth::user()->email:''}}"  autofocus>

                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-6 col-form-label text-md-right">{{ __('Phone') }}</label>
                            <input id="phone" type="text" class=" col-md-4 form-control" name="phone" value=""  autofocus>

                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-6 col-form-label text-md-right">{{ __('Address') }}</label>
                            <input id="address" type="text" class=" col-md-4 form-control" name="address" value="{{Auth::check()? Auth::user()->address:''}}"  autofocus>

                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-6 col-form-label text-md-right">{{ __('Select a Payment Method') }}</label>
                            <select id="paymentSc" class="form-control col-md-4 " name="payment_method" required="1">
                                <option value="">-Select-</option>
                            @foreach ($payments as $payment)
                                    <option value="{{$payment->short_name}}">{{$payment->name}}</option>
                                @endforeach
                            </select>
                            <div class="col-md-6">
                            @foreach ($payments as $payment)
                                    @if($payment->short_name == "cash_in")

                                    <div class="hidden" id="payment_{{$payment->short_name}}">
                                        <p><h3>Please Cash In</h3></p>
                                    </div>
                                    @else
                                <div class="hidden col-md-6 margin-top-20" id="payment_{{$payment->short_name}}">
                                        <p>
                                        <strong>{{$payment->name}} NO: {{$payment->no}}</strong>
                                        <hr>
                                        <strong>Account Type: {{$payment->type}}</strong>
                                        </p>
                                        <div class="alert alert-success">
                                            Please sent to avobe money to this bkash no. And input the transaction no.
                                        </div>
                                    @endif
                                </div>
                                 @endforeach
                                        <input id="transaction_id"  type="text" placeholder="Enter Transaction Number" class="col-md-6  form-control hidden" name="transaction_id">
                            </div>
                        </div>



                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-6">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Order') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>



@include('includes.scripts')


<script type="text/javascript">
    $("#paymentSc").change(function () {

        $payment_method = $("#paymentSc").val();
        // alert($payment_method);

        if($payment_method == "cash_in"){
            $("#payment_cash_in").removeClass('hidden');
            $("#payment_bkash").addClass('hidden');
            $("#payment_rocket").addClass('hidden');
        }
        else if($payment_method == "bkash"){
            $("#payment_bkash").removeClass('hidden');
            $("#payment_rocket").addClass('hidden');
            $("#payment_cash_in").addClass('hidden');
            $("#transaction_id").removeClass('hidden');
        }
        else if($payment_method == "rocket"){
            $("#payment_rocket").removeClass('hidden');
            $("#payment_bkash").addClass('hidden');
            $("#payment_cash_in").addClass('hidden');
            $("#transaction_id").removeClass('hidden');
        }
    })
</script>












