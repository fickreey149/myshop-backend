<?php

namespace App\Http\Livewire;

use App\Models\Product as ModelsProduct;
use App\Models\ProductCategory;
use Livewire\Component;
use Livewire\WithPagination;

class Product extends Component
{
    use WithPagination;

    public $isOpen = false;
    public $productId, $name, $price, $description, $category;
    public $categories;

    public function render()
    {
        return view('livewire.Product.product', [
            'products' => ModelsProduct::all()
        ]);
    }

    public function showModal()
    {
        $this->categories = ProductCategory::all();
        $this->isOpen = true;
    }

    public function hideModal()
    {
        $this->isOpen = false;
    }

    public function store()
    {
        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'max:10'],
            'description' => ['required', 'string'],
        ]);

        ModelsProduct::updateOrCreate(['id' => $this->productId], [
            'name' => $this->name,
            'price' => $this->price,
            'description' => $this->description,
            'categories_id' => $this->category
        ]);

        $this->hideModal();
        $this->productId = '';
        $this->name = '';
        $this->price = '';
        $this->description = '';
        $this->category = '';
    }

    public function edit($id)
    {
        $product = ModelsProduct::findOrFail($id);
        $this->productId = $product->id;
        $this->name = $product->name;
        $this->price = $product->price;
        $this->description = $product->description;
        $this->category = $product->categories_id;


        $this->showModal();
    }

    public function delete($id)
    {
        ModelsProduct::find($id)->delete();
    }
}
