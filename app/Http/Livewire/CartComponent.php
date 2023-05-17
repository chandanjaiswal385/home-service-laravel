<?php

namespace App\Http\Livewire;
use Livewire\Component;
use Cart;
use Illuminate\Support\Facades\Auth;

class CartComponent extends Component
{
    public function increaseQuantity($rowId)
    {
      $service = Cart::instance('cart')->get($rowId);
      $qty = $service->qty + 1;
      Cart::instance('cart')->update($rowId,$qty);
    }

    public function decreaseQuantity($rowId)
    {
      $service = Cart::instance('cart')->get($rowId);
      $qty = $service->qty - 1;
      Cart::instance('cart')->update($rowId,$qty);
    }

    public function destroy($rowId)
    {
       Cart::instance('cart')->remove($rowId);
       session()->flash('success_message','Service has been removed');
    }

    public function destroyAll()
    {
      cart::destroy();
    }

    public function checkout()
    {
      if(Auth::check())
      {
         return redirect()->route('checkout');
      }
      else
      {
         return redirect()->route('login');
      }
    }

    public function setAmountForCheckout()
    {
        if(!Cart::instance('cart')->count()>0)
        {
          session()->forget('checkout');
          return;
        }
       if(session()->has('coupon'))
       {
         session()->put('checkout',[
           'discount' => $this->discount,
           'subtotal' => $this->subtotalAfterDiscount
         ]);
       }
       else
       {
         session()->put('checkout',[

           'subtotal' => Cart::instance('cart')->subtotal()
         ]);
       }
    }


    public function render()
    {
        return view('livewire.cart-component')->layout('layouts.base');
    }
}
