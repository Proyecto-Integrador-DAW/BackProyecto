<div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
    <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
        {{ __('Home') }}
    </x-nav-link>
</div>
<div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
    <x-nav-link :href="route('zones.index')" :active="request()->routeIs('home')">
        {{ __('Zonas') }}
    </x-nav-link>
</div>
<div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
    <x-nav-link :href="route('teleoperators.index')" :active="request()->routeIs('home')">
        {{ __('Teleoperadores') }}
    </x-nav-link>
</div>
<div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
    <x-nav-link :href="route('languages.index')" :active="request()->routeIs('home')">
        {{ __('Idiomas') }}
    </x-nav-link>
</div>
<div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
    <x-nav-link :href="route('patients.index')" :active="request()->routeIs('home')">
        {{ __('Pacientes') }}
    </x-nav-link>
</div>
<div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
    <x-nav-link :href="route('contacts.index')" :active="request()->routeIs('home')">
        {{ __('Contactos') }}
    </x-nav-link>
</div>