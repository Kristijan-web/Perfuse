@extends('layouts.admin')
<header class="border-b border-gray-200 bg-white">
    <div class="flex items-center justify-start px-6 py-4">
        <nav class="flex items-center gap-6 text-sm font-medium">
            <a href="{{ url('/admin/users') }}" class="text-gray-700 transition hover:text-gray-900">
                Users
            </a>
            <a href="{{ url('/admin/products') }}" class="text-gray-700 transition hover:text-gray-900">
                Products
            </a>
            <a href="{{ url('/admin/orders') }}" class="text-gray-700 transition hover:text-gray-900">
                Orders
            </a>
            <a href="{{ url('/admin/contacts') }}" class="text-gray-700 transition hover:text-gray-900">
                Contact Form Submissions
            </a>
        </nav>
    </div>
</header>