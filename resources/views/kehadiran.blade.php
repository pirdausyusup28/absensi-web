@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @foreach($data as $item)
                @endforeach
                @if (isset($item->cekin) == '')
                    <div class="card-header">{{ __('CHECKIN') }}</div>
                @endif
                @if (isset($item->cekin) !== '' && isset($item->cekout) == '00:00:00')
                    <div class="card-header">{{ __('CHECKOUT') }}</div>
                @endif
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    @if (isset($item->cekin) == '')
                        <form id="location-form" action="{{ route('checkin') }}" method="POST">
                            @csrf
                            <label for="nama">Nama:</label>
                            <input type="hidden" class="form-control" name="nama" id="nama" value="{{ Auth::user()->id }}" required><br>
                            <input type="text" class="form-control" name="namax" id="namax" value="{{ Auth::user()->name }}" required><br>
                            <label for="nama">Latitude</label>
                            <input type="text" class="form-control" name="lat" id="lat" ><br>
                            <label for="nama">longtitude</label>
                            <input type="text" class="form-control" name="long" id="long" ><br>
                            <button class="btn btn-primary btn-lg" id="checkin" type="submit">CHECK IN</button>
                        </form>    
                    {{-- @endif --}}

                    @elseif ($item->cekin !== '' && $item->cekout == '00:00:00')
                    <p style="color: red">Anda Sudah Checkin silakan untuk melakukan Checkout</p>
                    <form id="location-form" action="{{ route('checkout') }}" method="POST">
                        @csrf
                        <label for="nama">Nama:</label>
                        <input type="hidden" class="form-control" name="id" id="id" value="{{ $item->id }}" required><br>
                        <input type="hidden" class="form-control" name="nama" id="nama" value="{{ Auth::user()->id }}" required><br>
                        <input type="text" class="form-control" name="namax" id="namax" value="{{ Auth::user()->name }}" required><br>
                        <label for="nama">Latitude</label>
                        <input type="text" class="form-control" name="lat" id="lat" ><br>
                        <label for="nama">longtitude</label>
                        <input type="text" class="form-control" name="long" id="long" ><br>
                        <button class="btn btn-primary btn-lg" id="checkout" type="submit">CHECK OUT</button>
                    </form>

                    @else
                    <form id="location-form" action="{{ route('checkin') }}" method="POST">
                        @csrf
                        <label for="nama">Nama:</label>
                        <input type="hidden" class="form-control" name="nama" id="nama" value="{{ Auth::user()->id }}" required><br>
                        <input type="text" class="form-control" name="namax" id="namax" value="{{ Auth::user()->name }}" required><br>
                        <label for="nama">Latitude</label>
                        <input type="text" class="form-control" name="lat" id="lat" ><br>
                        <label for="nama">longtitude</label>
                        <input type="text" class="form-control" name="long" id="long" ><br>
                        <button class="btn btn-primary btn-lg" id="checkin" type="submit">CHECK IN</button>
                    </form>    
                @endif

                </div>
            </div>
        </div>
    </div>
</div>
<script src=" https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js "></script>
<script>
    // const locationForm = document.getElementById('location-form');
    
    // locationForm.addEventListener('submit', function(e) {
    //     e.preventDefault();

        if ("geolocation" in navigator) {
            navigator.geolocation.getCurrentPosition(function(position) {
                const lat = position.coords.latitude;
                const long = position.coords.longitude;

                // Isi nilai input tersembunyi dengan Lat dan Long
                const latInput = document.createElement('input');
                latInput.type = 'hidden';
                latInput.name = 'lat';
                latInput.value = lat;
                // locationForm.appendChild(latInput);

                const longInput = document.createElement('input');
                longInput.type = 'hidden';
                longInput.name = 'long';
                longInput.value = long;
                // locationForm.appendChild(longInput);

                $("#lat").val(lat)
                $("#long").val(long)



                // Lanjutkan dengan mengirim formulir
                // locationForm.submit();
            });
        } else {
            alert('Geolocation tidak didukung oleh browser Anda.');
        }
    // });
</script>

@endsection
