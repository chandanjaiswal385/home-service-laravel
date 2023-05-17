<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Service;
use Cart;
use Illuminate\Support\Facades\Auth;

class ServiceDetailsComponent extends Component
{

    public function store($service_id,$service_name,$service_price)
    {
      Cart::instance('cart')->add($service_id,$service_name,1,$service_price)->associate('App\Models\Service');
      session()->flash('success_message','service added in cart');
      return redirect()->route('service.cart');
    }

    public $service_slug;

    public function mount($service_slug)
    {
       $this->service_slug = $service_slug;
    }


    public function render()
    {
        $service = Service::where('slug',$this->service_slug)->first();
        $r_service = Service::where('service_category_id',$service->service_category_id)->where('slug','!=',$this->service_slug)->inRandomOrder()->first();
        return view('livewire.service-details-component',['service'=>$service,'r_service'=>$r_service])->layout('layouts.base');
    }
}
