<?php

namespace App\Livewire;

use App\Models\Car;
use App\Models\Client;
use App\Models\Service;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class ClientList extends Component
{
    public $selectedClientId = null;
    public $selectedCarId = null;

    public function selectClient($clientId)
    {
        Log::info('selectClient hívva lett', ['client_id' => $clientId]);
        $this->selectedClientId = $clientId;
        $this->selectedCarId = null;
    }

    public function selectCar($carId)
    {
        $this->selectedCarId = $carId;
    }

    public function render()
    {
        $clients = Client::with('cars')->get();

        $cars = $this->selectedClientId
            ? Car::where('client_id', $this->selectedClientId)->with('services')->get()
            : collect();

        $services = $this->selectedCarId
            ? Service::where('car_id', $this->selectedCarId)
                ->with('car')
                ->orderBy('log_number', 'desc')
                ->get()
            : collect();

        return view('livewire.client-list', [
            'clients' => $clients,
            'cars' => $cars,
            'services' => $services,
        ])->layout('layouts.app');
    }
}
