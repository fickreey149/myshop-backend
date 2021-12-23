<?php

namespace App\Http\Livewire;

use App\Models\ProductCategory;
use Livewire\Component;
use Livewire\WithPagination;

class Category extends Component
{
    use WithPagination;

    public $visibleModalForm = false;
    public $confirmDeleteModal = false;
    public $name;
    public $modelId;

    public function rules()
    {
        return [
            'name' => 'required'
        ];
    }

    public function mount()
    {
        $this->resetPage();
    }

    public function read()
    {
        return ProductCategory::orderBy('created_at', 'desc')->paginate(5);
    }

    public function createOrUpdate()
    {
        $this->validate();
        ProductCategory::updateOrCreate(['id' => $this->modelId], $this->modelData());
        $this->visibleModalForm = false;
        $this->resetFields();
    }

    public function delete()
    {
        ProductCategory::destroy($this->modelId);
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
        $data = ProductCategory::findOrFail($this->modelId);
        $this->name = $data->name;
    }

    public function modelData()
    {
        return [
            'name' => $this->name
        ];
    }

    public function resetFields()
    {
        $this->modelId = null;
        $this->name = null;
    }

    public function showModal()
    {
        $this->resetValidation();
        $this->resetFields();
        $this->visibleModalForm = true;
    }

    public function render()
    {
        return view('livewire.category', [
            'data' => $this->read()
        ]);
    }
}
