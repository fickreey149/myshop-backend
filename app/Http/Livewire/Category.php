<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\ProductCategory;
use Livewire\WithPagination;

class Category extends Component
{
    use WithPagination;

    public $isOpen = false;
    public $categoryId, $name;

    public function render()
    {
        return view('livewire.Category.category', [
            'category' => ProductCategory::latest()->paginate(5)
        ]);
    }

    public function showModal()
    {
        $this->isOpen = true;
    }

    public function hideModal()
    {
        $this->isOpen = false;
    }

    public function store()
    {
        $this->validate([
            'name' => ['required', 'string', 'max:255']
        ]);

        ProductCategory::updateOrCreate(['id' => $this->categoryId], [
            'name' => $this->name
        ]);

        session()->flash('info', $this->categoryId ? 'Berhasil mengubah data kategori' : 'Berhasil menambah data kategori');

        $this->hideModal();
        $this->categoryId = '';
        $this->name = '';
    }

    public function edit($id)
    {
        $category = ProductCategory::findOrFail($id);
        $this->categoryId = $category->id;
        $this->name = $category->name;

        $this->showModal();
    }

    public function delete($id)
    {
        ProductCategory::find($id)->delete();
    }
}
