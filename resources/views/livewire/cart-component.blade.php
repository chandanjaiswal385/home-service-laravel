<main id="main" class="main-site">

		<div class="container">

			<div class="wrap-breadcrumb">
				<ul>
					<li class="item-link"><a href="/" class="link">Home</a></li>
					<li class="item-link"><span>Cart</span></li>
				</ul>
			</div>
			<div class=" main-content-area">

				<div class="wrap-iten-in-cart">
          @if(Session::has('success_message'))
             <div class="alert alert-success">
               <strong>Success</strong> {{Session::get('success_message')}}
             </div>
          @endif
          @if(Cart::instance('cart')->count() >0)
					<h3 class="box-title">services Name</h3>
					<ul class="services-cart">
						@foreach (Cart::instance('cart')->content() as $item)

						<li class="sr-cart-item">
							<div class="service-image">
								<figure><img src="{{asset('images/services')}}/{{$item->model->image}}" alt="{{$item->model->name}}"</figure>
							</div>
							<div class="service-name">
								<a class="link-to-service" href="{{route('home.service_details',['service_slug'=>$item->model->slug])}}">{{$item->name}}</a>
							</div>
							<div class="price-field service-price"><p class="price">₹ {{$item->price}}</p></div>
							<div class="quantity">
								<div class="quantity-input">
									<input type="text" name="service-quatity" value="{{$item->qty}}" data-max="120" pattern="[0-9]*">
									<a class="btn btn-increase" href="#" wire:click.prevent="increaseQuantity('{{$item->rowId}}')"</a>
									<a class="btn btn-reduce" href="#" wire:click.prevent="decreaseQuantity('{{$item->rowId}}')"></a>
								</div>
							</div>

							<div class="delete">
								<a href="#" wire:click.prevent="destroy('{{$item->rowId}}')" class="btn btn-delete" title="">
									<span>Delete from your cart</span>
									<i class="fa fa-times-circle" aria-hidden="true"></i>
								</a>
							</div>
						</li>
            @endforeach
					</ul>
          @else
           <p>No item in cart</p>
          @endif
				</div>

				<div class="summary">
					<div class="order-summary">
						<h4 class="title-box">Order Summary</h4>
						<p class="summary-info"><span class="title">Shipping</span><b class="index">Free Shipping</b></p>
						<p class="summary-info total-info "><span class="title">Total</span><b class="index">₹ {{Cart::instance('cart')->subtotal()}}</b></p>
					</div>
					<div class="checkout-info">

						<a class="btn btn-checkout" href="{{route('checkout')}}" wire:click.prevent="checkout">Check out</a>
						<!-- <a class="link-to-shop" href="shop.html">Continue Booking Service<i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a> -->
					</div>
					<div class="update-clear">
						<!-- <a class="btn btn-clear" href="#" wire:click.prevent="destroyAll()">Clear Service Cart</a>
						<a class="btn btn-update" href="#">Update Service Cart</a> -->
					</div>
				</div>


			</div><!--end main content area-->
		</div><!--end container-->

	</main>
