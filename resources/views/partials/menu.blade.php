<div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
    <x-nav-link :href="route('zones.index')" :active="request()->routeIs('dashboard')">
        {{ __('Zonas') }}
    </x-nav-link>
</div>
<div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
    <x-nav-link :href="route('teleoperators.index')" :active="request()->routeIs('dashboard')">
        {{ __('Teleoperadores') }}
    </x-nav-link>
</div>