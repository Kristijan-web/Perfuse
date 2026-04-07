@extends('layouts.user')

@section('title', 'Author')

@section('content')
    <div class="w-full mt-20">
        <div class="flex flex-col items-center justify-center text-center">
            <img src="{{ asset('images/author/authorImage.jpg') }}" alt="Kristijan Stojanovic"
                class="img-fluid rounded mb-4" style="max-width: 320px;">
            <h1 class="h3 ">Kristijan Stojanovic 125/22</h1>
        </div>
    </div>

@endsection