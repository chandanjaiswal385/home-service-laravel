<?php

namespace App\Http\Livewire;

use App\Models\ServiceCategory;
use Livewire\Component;
use Cart;

class ServicesByCategoryComponent extends Component
{
    public $category_slug;

    public function mount($category_slug)
    {
       $this->category_slug = $category_slug;
    }

    public function store($service_id,$service_name,$service_price)
    {
      Cart::add($service_id,$service_name,1,$service_price)->associate('App\Models\Service');
      session()->flash('Success_message','service added in cart');
      return redirect()->route('service.cart');
    }

    public function render()
    {
        $scategory = ServiceCategory::where('slug', $this->category_slug)->first();
        return view('livewire.services-by-category-component',['scategory'=>$scategory])->layout('layouts.base');
    }
}
