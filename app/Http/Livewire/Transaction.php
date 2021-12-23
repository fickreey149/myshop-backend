<?php

namespace App\Http\Livewire;

use App\Models\Transaction as ModelsTransaction;
use App\Models\TransactionItem;
use Livewire\Component;
use Livewire\WithPagination;

class Transaction extends Component
{
    use WithPagination;

    public $visibleModalStatus = false;
    public $confirmCancelTransaction = false;
    public $detailModalForm = false;
    public $status;
    public $items = [];
    public $username;
    public $address;
    public $shippingPrice;
    public $totalPrice;
    public $payment;
    public $modelId;

    public function rules()
    {
        return [
            'status' => 'required|in:PENDING,SUCCESS,CANCELLED,FAILED,SHIPPING,SHIPPED'
        ];
    }

    public function mount()
    {
        $this->resetPage();
    }

    public function read()
    {
        return ModelsTransaction::orderBy('created_at', 'desc')->paginate(5);
    }

    public function createOrUpdate()
    {
        $this->validate();
        ModelsTransaction::updateOrCreate(['id' => $this->modelId], $this->modelData());
        $this->visibleModalStatus = false;
        $this->resetFields();
    }

    public function delete()
    {
        ModelsTransaction::destroy($this->modelId);
        $this->confirmDeleteModal = false;
    }

    public function updateModal($id)
    {
        $this->resetValidation();
        $this->resetFields();
        $this->modelId = $id;
        $this->loadModel();
        if ($this->status == 'PENDING') {
            $this->status = 'SUCCESS';
        } elseif ($this->status == 'SUCCESS') {
            $this->status = 'SHIPPING';
        } elseif ($this->status == 'SHIPPING') {
            $this->status = 'SHIPPED';
        }

        $this->visibleModalStatus = true;
    }

    public function showCancelTransaction($id)
    {
        $this->modelId = $id;
        $this->confirmCancelTransaction = true;
    }

    public function cancelTransaction()
    {
        $this->loadModel();
        if ($this->status == 'FAILED') {
            $this->status = 'FAILED';
        } else {
            $this->status = 'CANCELLED';
        }
        ModelsTransaction::updateOrCreate(['id' => $this->modelId], $this->modelData());
        $this->confirmCancelTransaction = false;
    }

    public function loadModel()
    {
        $data = ModelsTransaction::findOrFail($this->modelId);
        $this->username = $data->user->name;
        $this->address = $data->address;
        $this->shippingPrice = $data->shipping_price;
        $this->totalPrice = $data->total_price;
        $this->payment = $data->payment;
        $this->status = $data->status;
        $this->items = TransactionItem::where('transactions_id', $data->id)->get();
    }

    public function modelData()
    {
        return [
            'status' => $this->status,
        ];
    }

    public function resetFields()
    {
        $this->modelId = null;
        $this->username = null;
        $this->address = null;
        $this->shippingPrice = null;
        $this->totalPrice = null;
        $this->payment = null;
    }

    public function showDetailModal($id)
    {
        $this->resetFields();
        $this->modelId = $id;
        $this->loadModel();
        $this->detailModalForm = true;
    }

    public function render()
    {
        return view('livewire.transaction', [
            'data' => $this->read()
        ]);
    }
}
