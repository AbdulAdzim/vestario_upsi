@extends('layouts.visitor')

@section('content')
<div class="container mt-5">

    <!-- Header with Logo -->
    <header class="text-center mb-4">
        <a href="https://kebudayaan.upsi.edu.my" target="_blank">
            <img src="{{ asset('upsi.png') }}" alt="UPSI Logo"  class="img-fluid mb-3">
        </a>
        <h1>Vestario</h1>
        <p>The cooperation between PUSKEB and Vestario enhances the management of traditional outfit bookings.</p>
</header>

    <!-- Poster Section -->
    <div class="text-center mt-5">
    <div class="w-100 mt-3">
        <img src="{{ asset('poster.png') }}" alt="Poster" class="img-fluid rounded shadow w-100">
    </div>
    </div>   

    <!-- Gallery Section -->
    <div class="mt-5">
    <h3 class="text-center">Club</h3>

    <div class="outfit-grid">
        <div class="outfit-card">
            <a href="https://kebudayaan.upsi.edu.my/vocal-arts-group/" target="_blank">
                <img src="{{ asset('Seni Suara.png') }}" alt="Club" class="gallery-img mb-2">
            </a>
            <div class="outfit-title">KELAB SENI SUARA</div>

            <a href="https://kebudayaan.upsi.edu.my/upsi-combo-club-2/" target="_blank">
                <img src="{{ asset('Kelab Kombo.png') }}" alt="Club" class="gallery-img mb-2">
            </a>
            <div class="outfit-title">KELAB KOMBO UPSI</div>
        </div>

        <div class="outfit-card">
            <a href="https://kebudayaan.upsi.edu.my/seni-warisan-cenderawasih-club/" target="_blank">
                <img src="{{ asset('Kelab Dikir Barat.png') }}" alt="Club" class="gallery-img mb-2">
            </a>
            <div class="outfit-title">KELAB DIKIR BARAT WARISAN CENDERAWASIH</div>

            <a href="https://kebudayaan.upsi.edu.my/gamelan-margamas-club/" target="_blank">
                <img src="{{ asset('Kelab Gamelan.png') }}" alt="Club" class="gallery-img mb-2">
            </a>
            <div class="outfit-title">KELAB GAMELAN MARGAMAS UPSI</div>
        </div>

        <div class="outfit-card">
            <a href="https://kebudayaan.upsi.edu.my/destar-limar-club/" target="_blank">
                <img src="{{ asset('Destarlima.png') }}" alt="Club" class="gallery-img mb-2">
            </a>
            <div class="outfit-title">KELAB DESTAR LIMAR</div>

            <a href="https://kebudayaan.upsi.edu.my/u-tech-club/" target="_blank">
                <img src="{{ asset('Technical.png') }}" alt="Club" class="gallery-img mb-2">
            </a>
            <div class="outfit-title">KELAB U-TECH</div>
        </div>
    </div>
</div>


</div>
@endsection
