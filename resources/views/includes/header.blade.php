<header
        x-data="{ mobileMenuOpen : false }"
        class="flex flex-wrap flex-row justify-between md:items-center shadow-xl md:space-x-4 w-4/5bg-white py-6 px-6 relative">

        <a href="/" class="block">
          <img
            class="h-6 md:h-8"
            src="https://tcrotterdam.nl/wp-content/uploads/2015/09/logo-kleur.png"
            alt="Logo Transportcentrale Rotterdam"
            title="Logo Transportcentrale Rotterdam">
        </a>

        <button
            @click="mobileMenuOpen = !mobileMenuOpen"
            class="inline-block md:hidden w-8 h-8 bg-gray-200 text-gray-600 p-1">

            <svg
                fill="currentColor"
                viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    fill-rule="evenodd"
                    d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                    clip-rule="evenodd">
                </path>
            </svg>
        </button>

        <nav
            class="absolute md:relative top-16 left-0 md:top-0 z-20 md:flex flex-col md:flex-row md:space-x-6 font-semibold w-full md:w-auto bg-white shadow-md rounded-lg md:rounded-none md:shadow-none md:bg-transparent p-6 pt-0 md:p-0"
            :class="{ 'flex' : mobileMenuOpen , 'hidden' : !mobileMenuOpen}"
            @click.away="mobileMenuOpen = false"
                >
            <a
                href="/"
                class="block py-1 text-orange-500 hover:underline">
                Home
            </a>


@auth()

                <a
                    href="/dashboard"
                    class="block py-1 text-gray-600 hover:underline">
                    Dashboard
                </a>
                <a
                    href="/results"
                    class="block py-1 text-gray-600 hover:underline">
                    Results
                </a>
    @if(auth()->user()->role == 'admin')
        <a
            href="/users"
            class="block py-1 text-gray-600 hover:underline">
            Users
        </a>
    @endif
@endauth

<a
    href="#"
    class="block py-1 text-gray-600 hover:underline">

    @guest
        <a
            class="block py-1 text-gray-600 hover:underline"
            href="
                        {{ route('login') }}">{{ __('Login') }}
        </a>

        @if (Route::has('register'))
            <a
                class="block py-1 text-gray-600 hover:underline"
                href="{{ route('register') }}">{{ __('Register') }}
            </a>
        @endif

    @else
        <span>
                            {{ Auth::user()->name }}
                        </span>

        <a
            href="{{ route('logout') }}"
            class="block py-1 text-gray-600 hover:underline"
            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">{{ __('Logout') }}
        </a>

        <form
            id="logout-form"
            action="{{ route('logout') }}"
            method="POST"
            class="hidden">
            {{ csrf_field() }}
        </form>
    @endguest
</a>
</nav>
</header>
