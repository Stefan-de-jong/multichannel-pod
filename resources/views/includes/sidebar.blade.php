<aside class="w-full md:w-64 bg-gray-800 md:min-h-screen" x-data="{ isOpen: false }">
    <div class="flex items-center justify-between bg-gray-900 p-4 h-16">
        <a href="/" class="flex items-center">
            <img class="h-8 w-8 rounded"
                 src="logo_transparant.png"
                 alt="Transparent logo of Rotterdam Transport Centrale"/>
            <span class="text-gray-300 text-xl font-semibold mx-2">Dashboard</span>
        </a>
        <div class="flex md:hidden">
            <<button type="button" @click="isOpen = !isOpen"
                     class="text-gray-300 hover:text-gray-500 focus:outline-none focus:text-gray-500">
                <svg class="fill-current w-8" fill="none" stroke-linecap="round" stroke-linejoin="round"
                     stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                    <path d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>
    </div>
    <div class="px-2 py-6 md:block" :class="isOpen? 'block': 'hidden'" >
        <ul>
            <li class="{{ (request()->is('/')) ? 'px-2 py-3 bg-gray-900 rounded mt-2' :'' }} : px-2 py-3 hover:bg-gray-900 rounded mt-2">
                <!--<li class="px-2 py-3 hover:bg-gray-900 rounded">-->
                <a href="/" class="flex items-center">
                    <svg class="w-6 text-gray-500" fill="none" stroke-linecap="round"
                         stroke-linejoin="round"
                         stroke-width="2"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    <span class="mx-2 text-gray-300">Dashboard</span>
                </a>
            </li>
            <li class="{{ (request()->is('attachment')) ? 'px-2 py-3 bg-gray-900 rounded mt-2' :'' }} : px-2 py-3 hover:bg-gray-900 rounded mt-2">
                <a href="attachment" class="flex items-center">
                    <svg class="w-6 text-gray-500" fill="none" stroke-linecap="round"
                         stroke-linejoin="round"
                         stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path
                            d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                    </svg>
                    <span class="mx-2 text-gray-300">Attachments</span>
                </a>
        </ul>
        <div class="border-t border-gray-700 -mx-2 mt-2 md:hidden"></div>
        <ul class="mt-6 md:hidden">
            <li class="px-2 py-3 hover:bg-gray-900 rounded mt-2">
                <a href="#" class="mx-2 text-gray-300">Account Settings</a>
            </li>
            <li class="px-2 py-3 hover:bg-gray-900 rounded mt-2">
                <button class="mx-2 text-gray-300" @click="logout">Logout</button>
            </li>
        </ul>
    </div>
</aside>
