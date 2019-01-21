<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">

        <div class="card-body">
          {{ __('Hello ') . $order->shop->name }}!

          <br>
          {{ __('You have got a webshop order for delivery.') }}

          <br>
          {{ __('The order has been created in Rackbeat with number ')}}
          <a href="{{ 'https://app.rackbeat.com/sales/orders/' . $rb_order->number }}"
             target="_blank">{{ $rb_order->number }}</a>

          <br>
          {{ __('Contact info:') }}

          <br>
          <span style="font-weight: bold;">{{ __('Webshop ID:') }} </span><a href="{{ ' https://app.rackbeat.com/sales/orders/' .  $rb_order->number  }}"
                                                                             target="_blank">{{  $rb_order->number }}</a>
          <br>
          <span style="font-weight: bold;">{{ __('Customer name:') }} </span>{{  $order->customer_name }}
          <br>
          <span style="font-weight: bold;">{{ __('Address, zip & city:') }} </span>{{  $order->address . ', ' . $order->zip . ' ' . $order->city }}
          <br>
          <span style="font-weight: bold;">{{ __('E-mail:') }} </span>{{  $order->email }}
          <br>
          <span style="font-weight: bold;">{{ __('Phone:') }} </span>{{  $order->phone }}
          <br>
          <span style="font-weight: bold;">{{ __('CVR:') }} </span>{{  $order->cvr }}
          <br>
          <span style="font-weight: bold;">{{ __('Value (DKK) including VAT:') }} </span>{{  $rb_order->total_total }}
          <br>
          <span style="font-weight: bold;">{{ __('Internal note:') }} </span>{{  $order->note }}

          <br>
          <img src="{{ url('/storage/jupiter-logo.png') }}">
          <br>
          {{ __('Happy closing!') }}
          <br>
          {{ __('Best regards') }}
          <br>
          <span style="font-weight: bold;">{{ __('Jupiter Platform') }}</span>
        </div>
      </div>
    </div>
  </div>
</div>
