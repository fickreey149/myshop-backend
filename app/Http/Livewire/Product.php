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
    public $slug;
    public $categories_id;
    public $categories;
    public $modelId;

    public function rules()
    {
        return [
            'name' => 'required',
            'slug' => 'required',
            'price' => 'required',
            'description' => 'required',
            'categories_id' => 'required'
        ];
    }

    public function updatedName($value)
    {
        $this->generateSlug($value);
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

    public function delete()
    {
        ModelsProduct::destroy($this->modelId);
        $this->confirmDeleteModal = false;
    }

    public function showUpdateModal($id)
    {
        $this->resetValidation();
        $this->resetFields();
        $this->modelId = $id;
        $this->visibleModalForm = true;
        $this->loadModel();
    }

    public function showDeleteModal($id)
    {
        $this->modelId = $id;
        $this->confirmDeleteModal = true;
    }

    public function loadModel()
    {
        $data = ModelsProduct::findOrFail($this->modelId);
        $this->name = $data->name;
        $this->slug = $data->slug;
        $this->price = $data->price;
        $this->description = $data->description;
        $this->tags = $data->tags;
        $this->categories_id = $data->categories_id;
        $this->categories = ProductCategory::all();
    }

    public function modelData()
    {
        return [
            'name' => $this->name,
            'slug' => $this->slug,
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
        $this->slug = null;
        $this->price = null;
        $this->description = null;
        $this->tags = null;
        $this->categories_id = null;
    }

    private function generateSlug($value)
    {
        $dash = str_replace(' ', '-', $value);
        $lower = strtolower($dash);
        $this->slug = $lower;
    }

    public function showModal()
    {
        $this->resetValidation();
        $this->resetFields();
        $this->categories = ProductCategory::all();
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
