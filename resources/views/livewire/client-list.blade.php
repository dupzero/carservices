<div class="container mt-4">
    <livewire:client-search />

    <h2>Ügyfelek</h2>

    <div class="accordion" id="clientsAccordion">
        @foreach($clients as $client)
            <div class="accordion-item">
                <h2 class="accordion-header" id="heading-{{ $client->id }}">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse-{{ $client->id }}" aria-expanded="false"
                            aria-controls="collapse-{{ $client->id }}"
                            wire:click="selectClient({{ $client->id }})">
                        {{ $client->name }} ({{ $client->card_number }})
                    </button>
                </h2>
                <div id="collapse-{{ $client->id }}"
                     class="accordion-collapse collapse @if($selectedClientId === $client->id) show @endif"
                     aria-labelledby="heading-{{ $client->id }}"
                     data-bs-parent="#clientsAccordion">
                    <div class="accordion-body">
                        @if($selectedClientId === $client->id)
                            <h5>Autók</h5>
                            <table class="table table-sm table-bordered">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Típus</th>
                                    <th>Regisztráció</th>
                                    <th>Saját márkás</th>
                                    <th>Balesetek</th>
                                    <th>Utolsó esemény</th>
                                    <th>Időpont</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($cars as $car)
                                    @php
                                        $lastService = $car->services->sortByDesc('log_number')->first();
                                    @endphp
                                    <tr wire:click="selectCar({{ $car->id }})"
                                        style="cursor: pointer"
                                        class="{{ $selectedCarId === $car->id ? 'table-primary' : '' }}">
                                        <td>{{ $car->id }}</td>
                                        <td>{{ $car->type }}</td>
                                        <td>{{ \Carbon\Carbon::parse($car->registered)->format('Y-m-d') }}</td>
                                        <td>{{ $car->ownbrand ? 'Igen' : 'Nem' }}</td>
                                        <td>{{ $car->accidents }}</td>
                                        <td>{{ $lastService?->event ?? 'N/A' }}</td>
                                        <td>
                                            @if($lastService?->event === 'regisztralt' && empty($lastService->event_time))
                                                {{ \Carbon\Carbon::parse($car->registered)->format('Y-m-d') }}
                                            @else
                                                {{ $lastService?->event_time ?? 'N/A' }}
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                            @if($selectedCarId && $services->isNotEmpty())
                                <h5>Szerviznapló</h5>
                                <table class="table table-sm table-hover">
                                    <thead>
                                    <tr>
                                        <th>Log sorszám</th>
                                        <th>Esemény</th>
                                        <th>Időpont</th>
                                        <th>Munkalap azonosító</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($services as $service)
                                        <tr>
                                            <td>{{ $service->log_number }}</td>
                                            <td>{{ $service->event }}</td>
                                            <td>
                                                @if($service->event === 'regisztralt' && empty($service->event_time))
                                                    {{ \Carbon\Carbon::parse($service->car->registered)->format('Y-m-d') }}
                                                @else
                                                    {{ $service->event_time ?? 'N/A' }}
                                                @endif
                                            </td>
                                            <td>{{ $service->document_id }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @endif

                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
