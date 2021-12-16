<?php

namespace App\Http\Livewire;

use App\Models\Product as ModelsProduct;
use App\Models\ProductCategory;
use Livewire\Component;
use Livewire\WithPagination;

class Product extends Component
{
    use WithPagination;

    public $visibleModalForm = false;
    public $confirmDeleteModal = false;
    public $name;
    public $price;
    public $description;
    public $tags;
    public $categories_id;
    public $categories;
    public $modelId;

    public function rules()
    {
        return [
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
        ];
    }

    public function mount()
    {
        $this->resetPage();
    }

    public function read()
    {
        return ModelsProduct::orderBy('created_at', 'desc')->paginate(5);
    }

    public function createOrUpdate()
    {
        $this->validate();
        ModelsProduct::updateOrCreate(['id' => $this->modelId], $this->modelData());
        $this->visibleModalForm = false;
        $this->resetFields();
    }

    public function modelData()
    {
        return [
            'name' => $this->name,
            'price' => $this->price,
            'description' => $this->description,
            'tags' => $this->tags,
            'categories_id' => $this->categories_id
        ];
    }

    public function resetFields()
    {
        $this->modelId = null;
        $this->name = null;
        $this->price = null;
        $this->description = null;
        $this->tags = null;
        $this->categories_id = null;
    }

    public function showModal()
    {
        $this->categories = ProductCategory::all();
        $this->resetValidation();
        $this->resetFields();
        $this->visibleModalForm = true;
    }

    public function render()
    {
        return view('livewire.product', [
            'data' => $this->read(),
            'categories' => $this->categories
        ]);
    }
}
