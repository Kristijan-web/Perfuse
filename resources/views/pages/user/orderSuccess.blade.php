@extends('layouts.user')

@section('title', 'Order Successful')

@section('content')
    <section class="flex min-h-[70vh] items-center justify-center px-4 py-12">
        <div class="w-full max-w-xl rounded-2xl border border-green-100 bg-white p-8 text-center shadow-lg">
            <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-green-100">
                <svg class="h-8 w-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            </div>

            <h1 class="mt-6 text-3xl font-bold text-gray-900">Order placed successfully</h1>
            <p class="mt-3 text-base text-gray-600">
                Thank you for your purchase. Your order has been received and is now being processed.
            </p>

            <div class="mt-8 rounded-xl bg-green-50 px-5 py-4 text-sm text-green-700">
                A confirmation message will be sent to you shortly with the details of your purchase.
            </div>

            <a href="{{ route('shopPage') }}"
                class="mt-8 inline-flex items-center justify-center rounded-lg bg-green-600 px-6 py-3 text-sm font-semibold text-white transition hover:bg-green-700">
                Continue Shopping
            </a>
        </div>
    </section>

@endsection