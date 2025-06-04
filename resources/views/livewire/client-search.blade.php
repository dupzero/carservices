<div class="mb-4">
    <form wire:submit.prevent="searchClient" id="client-search-form">
        <div class="row">
            <div class="col-md-5">
                <label for="name" class="form-label">Ügyfél neve</label>
                <input type="text" id="name" wire:model.lazy="name"
                       class="form-control @error('name') is-invalid @enderror">
            </div>

            <div class="col-md-5">
                <label for="cardNumber" class="form-label">Ügyfél okmányazonosítója</label>
                <input type="text" id="cardNumber" wire:model.lazy="cardNumber"
                       class="form-control @error('cardNumber') is-invalid @enderror">
            </div>

            <div class="col-md-2 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">Keresés</button>

            </div>

            <div class="col-md-10 mt-3">
                @error('form')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                @error('cardNumber')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

        </div>
    </form>

    @if (session()->has('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif

    @if ($client)
        <div class="card mt-4">
            <div class="card-header">
                Ügyfél adatai
            </div>
            <div class="card-body">
                <p><strong>Azonosító:</strong> {{ $client->id }}</p>
                <p><strong>Név:</strong> {{ $client->name }}</p>
                <p><strong>Okmányazonosító:</strong> {{ $client->card_number }}</p>
                <p><strong>Autók száma:</strong> {{ $client->cars()->count() }}</p>
                <p><strong>Szerviznaplók
                        száma:</strong> {{ $client->cars()->withCount('serviceLogs')->get()->sum('service_logs_count') }}
                </p>
            </div>
        </div>
    @endif
</div>

<script>
    document.getElementById('client-search-form').addEventListener('submit', function (e) {
        const name = document.getElementById('name').value.trim();
        const cardNumber = document.getElementById('cardNumber').value.trim();
        const regex = /^[a-zA-Z0-9]*$/;

        if (!name && !cardNumber) {
            alert('Legalább az egyik mezőt ki kell tölteni!');
            e.preventDefault();
        } else if (name && cardNumber) {
            alert('Egyszerre csak egy mezőt töltsön ki!');
            e.preventDefault();
        } else if (cardNumber && !regex.test(cardNumber)) {
            alert('Az okmányazonosító csak betűket és számokat tartalmazhat.');
            e.preventDefault();
        }
    });
</script>
