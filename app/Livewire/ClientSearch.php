<?php

namespace App\Livewire;

use App\Models\Client;
use Livewire\Component;

class ClientSearch extends Component
{
    public $name = '';
    public $cardNumber = '';
    public $client;

    public function updated($property)
    {
        $this->validateOnly($property, $this->rules());
    }

    public function searchClient()
    {
        $this->validate($this->rules(), $this->messages());

        $this->reset('client');

        if ($this->name && !$this->cardNumber) {
            $clients = Client::where('name', 'like', '%' . $this->name . '%')->get();
            if ($clients->count() === 0) {
                $this->addError('name', 'Nem található ügyfél ezzel a névvel.');
            } elseif ($clients->count() > 1) {
                $this->addError('name', 'Több ügyfél is megfelel a keresésnek. Pontosítson!');
            } else {
                $this->client = $clients->first();
                session()->flash('success', 'Ügyfél sikeresen megtalálva.');
            }
        }

        if ($this->cardNumber && !$this->name) {
            $client = Client::where('card_number', $this->cardNumber)->first();
            if (!$client) {
                $this->addError('cardNumber', 'Nem található ügyfél ezzel az okmányazonosítóval.');
            } else {
                $this->client = $client;
                session()->flash('success', 'Ügyfél sikeresen megtalálva.');
            }
        }
    }

    public function rules()
    {
        return [
            'name' => ['nullable', 'string'],
            'cardNumber' => ['nullable', 'regex:/^[a-zA-Z0-9]+$/'],
        ];
    }

    public function messages()
    {
        return [
            'cardNumber.regex' => 'Az okmányazonosító csak betűket és számokat tartalmazhat.',
        ];
    }

    public function updatedName($value)
    {
        if (!empty($value) && !empty($this->cardNumber)) {
            $this->addError('name', 'Egyszerre csak egy mezőt tölts ki.');
        } else {
            $this->resetErrorBag('name');
        }
    }

    public function updatedCardNumber($value)
    {
        if (!empty($value) && !empty($this->name)) {
            $this->addError('cardNumber', 'Egyszerre csak egy mezőt tölts ki.');
        } else {
            $this->resetErrorBag('cardNumber');
        }
    }

    public function render()
    {
        return view('livewire.client-search');
    }
}
