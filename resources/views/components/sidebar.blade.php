<aside  id="sidebar" class="bg-black text-white w-64 min-h-screen fixed">
    <div class="p-4 flex justify-between items-center">
        <!-- Logo -->
        <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-2">
            <x-application-mark class="block h-9 w-auto" />

        </a>


    </div>


    <!-- Navigation Links -->
    <nav class="mt-auto p-4 border-t border-gray-700">
        <ul class="space-y-4">
            <li>
                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 hover:bg-gray-700 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-700' : '' }}">
                    Dashboard
                </a>
            </li>

            {{-- <li>
                <a href="{{ route('admin.jetski.index') }}" class="block px-4 py-2 hover:bg-gray-700 {{ request()->routeIs('admin.jetski.index') ? 'bg-gray-700' : '' }}">

                </a>
            </li> --}}

            <li>
                <a href="{{ route('admin.pilihpakets.index') }}" class="block px-4 py-2 hover:bg-gray-700 {{ request()->routeIs('admin.pilihpakets.index') ? 'bg-gray-700' : '' }}">
                    Pilih Paket Jetski
                </a>
            </li>
            <li>
                <a href="{{ route('admin.detail_pakets.index') }}" class="block px-4 py-2 hover:bg-gray-700 {{ request()->routeIs('admin.detail_pakets.index') ? 'bg-gray-700' : '' }}">
                    Detail Paket
                </a>
            </li>
            <li>
                <a href="{{ route('admin.bookings.index') }}" class="block px-4 py-2 hover:bg-gray-700 {{ request()->routeIs('admin.bookings.index') ? 'bg-gray-700' : '' }}">
                    Booking
                </a>
            </li>

            <li>
                <a href="{{ route('admin.beritas.index') }}" class="block px-4 py-2 hover:bg-gray-700 {{ request()->routeIs('admin.news.*') ? 'bg-gray-700' : '' }}">
                    Berita
                </a>
            </li>

        </ul>
    </nav>

    <!-- User Profile and Settings -->
    <div class="mt-auto p-4 border-t border-gray-700">
        <!-- User Info -->
        <div class="flex items-center space-x-3">
            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" class="size-10 rounded-full object-cover">
            @endif
            <div>
                <div class="font-medium text-sm">{{ Auth::user()->name }}</div>
                <div class="text-xs text-gray-400">{{ Auth::user()->email }}</div>
            </div>
        </div>

        <!-- Settings Dropdown -->
        <div class="mt-4">
            <ul class="space-y-2">
                <li>
                    <a href="{{ route('profile.show') }}" class="block px-4 py-2 hover:bg-gray-700 {{ request()->routeIs('profile.show') ? 'bg-gray-700' : '' }}">
                        Profile
                    </a>
                </li>
                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <li>
                        <a href="{{ route('api-tokens.index') }}" class="block px-4 py-2 hover:bg-gray-700 {{ request()->routeIs('api-tokens.index') ? 'bg-gray-700' : '' }}">
                            API Tokens
                        </a>
                    </li>
                @endif
                <li>
                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-700">
                            Log Out
                        </button>
                    </form>
                </li>
            </ul>
        </div>

        <!-- Team Management -->
        @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
            <div class="mt-4">
                <div class="text-xs text-gray-400">Manage Team</div>
                <ul class="mt-2 space-y-2">
                    <li>
                        <a href="{{ route('teams.show', Auth::user()->currentTeam->id) }}" class="block px-4 py-2 hover:bg-gray-700 {{ request()->routeIs('teams.show') ? 'bg-gray-700' : '' }}">
                            Team Settings
                        </a>
                    </li>
                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                        <li>
                            <a href="{{ route('teams.create') }}" class="block px-4 py-2 hover:bg-gray-700 {{ request()->routeIs('teams.create') ? 'bg-gray-700' : '' }}">
                                Create New Team
                            </a>
                        </li>
                    @endcan
                    @if (Auth::user()->allTeams()->count() > 1)
                        <li>
                            <div class="text-xs text-gray-400 mt-2">Switch Teams</div>
                            <ul class="mt-2 space-y-2">
                                @foreach (Auth::user()->allTeams() as $team)
                                    <li>
                                        <x-switchable-team :team="$team" class="block px-4 py-2 hover:bg-gray-700" />
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        @endif
    </div>
</aside>
