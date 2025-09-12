<nav class="px-4 py-6">
    <ul class="space-y-2">
        <li>
            <a href="{{ route('dashboard') }}" 
               class="block px-4 py-2 rounded hover:bg-gray-200
               {{ request()->routeIs('dashboard') ? 'bg-gray-300 font-bold' : '' }}">
               Dashboard
            </a>
        </li>
        <li>
            <a href="{{ route('profile.edit') }}" 
               class="block px-4 py-2 rounded hover:bg-gray-200
               {{ request()->routeIs('profile.*') ? 'bg-gray-300 font-bold' : '' }}">
               Perfil
            </a>
        </li>
        <!-- Adicione mais links aqui -->
    </ul>
</nav>
