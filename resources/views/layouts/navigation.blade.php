 <nav class="flex sticky items-center justify-center flex-wrap bg-gray-800 p-3 w-full top-0 z-50">
     <div class="flex items-center flex-shrink-0 text-white mr-6 ">
         <a href="/" class="flex items-center border-2 rounded border-pink-600 p-2">
             <img src="{{ url('images/logo.png') }}" class="h-12 mr-3" alt="Logo" />
             <span class="font-semibold text-xl tracking-tight">My Tech Blog™</span>
         </a>
     </div>

     <div class="w-full block flex-grow lg:flex lg:items-center lg:w-auto">
         <div class="text-sm lg:flex-grow">
             <a href="/" class="block mt-4 lg:inline-block lg:mt-0 text-white hover:text-pink-600 mr-8 text-base">
                 Home
             </a>
             <a href="{{ route('posts.all') }}"
                 class="block mt-4 lg:inline-block lg:mt-0  text-white hover:text-pink-600 mr-8 text-base">
                 Posts
             </a>
             <a href="/about"
                 class="block mt-4 lg:inline-block lg:mt-0  text-white hover:text-pink-600 mr-8 text-base">
                 About
             </a>
             <a href="/contacts"
                 class="block mt-4 lg:inline-block lg:mt-0  text-white hover:text-pink-600 mr-8 text-base">
                 Contacts
             </a>
             <form action="{{ route('search.posts') }}" method="GET" class="block mt-4 lg:inline-block lg:mt-0">
                 <input type="text" name="query" placeholder="Search..."
                     class="rounded-full text-black w-40 px-4 py-1 lg:mr-4"
                     onkeydown="if (event.keyCode == 13) { this.form.submit(); return false; }" />
                 <span class="cursor-pointer" onclick="this.closest('form').submit();">
                     <i class="fas fa-search text-pink-600"></i>
                 </span>
             </form>
         </div>

         @if (Route::has('login'))
             <div class="sm:fixed sm:top-0 sm:right-0 p-6 mt-1 text-right z-10">
                 @auth
                     <div class="hidden sm:flex sm:items-center sm:ml-6">
                         <x-dropdown align="right" width="48">
                             <x-slot name="trigger">
                                 <button
                                     class="inline-flex items-center px-3 py-2 border border-transparent text-base leading-4 font-medium rounded-sm text-white bg-pink hover:text-pink-600 focus:outline-none transition ease-in-out duration-150">
                                     <div>{{ Auth::user()->name }}</div>

                                     <div class="ml-1">
                                         <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                             viewBox="0 0 20 20">
                                             <path fill-rule="evenodd"
                                                 d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                 clip-rule="evenodd" />
                                         </svg>
                                     </div>
                                 </button>
                             </x-slot>

                             <x-slot name="content">
                                 <x-dropdown-link :href="route('add.post')">
                                     {{ __('Add New Post') }}
                                 </x-dropdown-link>
                                 <x-dropdown-link :href="route('my.posts')">
                                     {{ __('My Posts') }}
                                 </x-dropdown-link>
                                 <x-dropdown-link :href="route('profile.edit')">
                                     {{ __('Profile') }}
                                 </x-dropdown-link>

                                 <!-- Authentication -->
                                 <form method="POST" action="{{ route('logout') }}">
                                     @csrf

                                     <x-dropdown-link :href="route('logout')"
                                         onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                         {{ __('Log Out') }}
                                     </x-dropdown-link>
                                 </form>
                             </x-slot>
                         </x-dropdown>
                     @else
                         <a href="{{ route('login') }}"
                             class="block mt-4 lg:inline-block lg:mt-0 text-white hover:text-pink-600 mr-4 text-base">Log
                             In</a>

                         @if (Route::has('register'))
                             <a href="{{ route('register') }}"
                                 class="block mt-4 lg:inline-block lg:mt-0 text-white hover:text-pink-600 mr-4 text-base">Register</a>
                         @endif
                     @endauth
                 </div>
         @endif
     </div>
 </nav>
