<?php
    use Illuminate\Support\Facades\Auth;
    $user = Auth::user();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')
    <title>Project</title>
</head>

<body class="min-h-screen bg-gray-50 flex flex-col">
    
    <header class="flex items-center justify-between p-6">
        <a href="{{ route('welcome') }}" class="flex items-center gap-2">
            <svg class="h-10 text-blue-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                <path fill-rule="evenodd" d="M12.516 2.17a.75.75 0 00-1.032 0 11.209 11.209 0 01-7.877 3.08.75.75 0 00-.722.515A12.74 12.74 0 002.25 9.75c0 5.942 4.064 10.933 9.563 12.348a.749.749 0 00.374 0c5.499-1.415 9.563-6.406 9.563-12.348 0-1.39-.223-2.73-.635-3.985a.75.75 0 00-.722-.516l-.143.001c-2.996 0-5.717-1.17-7.734-3.08zm3.094 8.016a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd" />
            </svg>
            <div>Advertisements</div>
            <span class="text-xl font-black">Project</span>
        </a>
        <div>
            @guest 

                <a href="{{ route('login') }}" class="rounded-md bg-gray-200 py-2 px-4 font-semibold text-gray-900 shadow-lg transition duration-150 ease-in-out hover:bg-gray-300 hover:shadow-xl focus:shadow-xl focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-offset-2">Log In</a>
                <a href="{{ route('register') }}" class="rounded-md bg-blue-500 py-2 px-4 font-semibold text-white shadow-lg transition duration-150 ease-in-out hover:bg-green-700 hover:shadow-xl focus:shadow-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">Register</a>
            @endguest
            @auth
            
            <div class="flex items-center gap-4">
            @admin
            <a href="{{ route('getAdminPanel') }}" class="rounded-md bg-gray-200 py-2 px-4 font-semibold text-gray-900 shadow-lg transition duration-150 ease-in-out hover:bg-gray-300 hover:shadow-xl focus:shadow-xl focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-offset-2">Admin Panel</a>
            @endadmin
            <a href="{{ route('advertisements') }}" class="rounded-md bg-gray-200 py-2 px-4 font-semibold text-gray-900 shadow-lg transition duration-150 ease-in-out hover:bg-gray-300 hover:shadow-xl focus:shadow-xl focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-offset-2">Advertisements</a>
            
            <form method="post" action="{{ route('logout') }}">
                @csrf

                <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="rounded-md bg-gray-200 py-2 px-4 font-semibold text-gray-900 shadow-lg transition duration-150 ease-in-out hover:bg-gray-300 hover:shadow-xl focus:shadow-xl focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-offset-2">Log Out</a>
            </form>
            
            </div>
               
            @endauth
            
        </div>
    </header>
    <main class="w-full flex justify-center items-center flex-grow">
    @guest 
        <div class="m-6 mb-12 rounded-xl p-6 shadow-xl sm:p-10">
            <h1 class="text-3xl font-semibold">Чтобы видеть объявления нужно войти в аккаунт!  <a href="{{ route('login') }}" class="rounded-md  bg-blue-500 py-2 px-5 mx-5 font-semibold text-white shadow-lg transition duration-150 ease-in-out hover:bg-gray-300 hover:shadow-xl focus:shadow-xl focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-offset-2">Log In</a> </h1>
            
        </div>
    @endguest

    @auth
    <div class="w-full flex justify-center">
        <div class="m-6 mb-12 rounded-xl p-6 shadow-xl sm:p-10 flex flex-col  items-center gap-10">
            <h2 class="text-3xl font-semibold">Добро пожаловать  {{$user->name}}</h2>
            <h3 class="text-3xl font-semibold text-red-600">{{$user->role == 'Blocked' ? 'К сожалению вы заблокированы :(' : ''}}</h3>
            
            <a href="{{ route('advertisements') }}" class="rounded-md {{$user->role == 'Blocked' ? 'line-through pointer-events-none opacity-50' : ''}} bg-gray-200 py-2 px-4 font-semibold min-w-min text-gray-900 shadow-lg transition duration-150 ease-in-out hover:bg-gray-300 hover:shadow-xl focus:shadow-xl focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-offset-2">Advertisements</a>
        </div>
    </div>
    @endauth
    </main>
</body>

</html>
