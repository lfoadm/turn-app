<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased" x-data="{ sidebarOpen: false }">
    <div class="min-h-screen flex bg-gray-100">

        <!-- Sidebar -->
        <aside
            class="fixed top-0 left-0 h-screen bg-white shadow-md z-40 transition-all duration-300
                   hidden lg:flex flex-col group
                   w-16 hover:w-64">
            @include('layouts.sidebar')
        </aside>

        <!-- Sidebar Mobile -->
        <div class="lg:hidden">
            <button @click="sidebarOpen = !sidebarOpen"
                class="fixed top-4 left-4 z-50 p-2 bg-gray-200 rounded">
                ☰
            </button>
            <aside x-show="sidebarOpen" @click.away="sidebarOpen = false"
                class="fixed top-0 left-0 h-screen w-64 bg-white shadow-md z-40">
                @include('layouts.sidebar')
            </aside>
        </div>

        <!-- Conteúdo -->
        <div class="flex-1 flex flex-col transition-all duration-300 lg:ml-16 lg:group-hover:ml-64">

            <!-- Header fixo -->
            @include('layouts.header')

            <!-- Página -->
            <main class="flex-1 p-[6px] mt-16">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>
