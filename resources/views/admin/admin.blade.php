<?php
    use App\Models\Category;
    use App\Models\User;
    use App\Models\Advertisement;
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
            <svg class="h-10 text-green-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                <path fill-rule="evenodd" d="M12.516 2.17a.75.75 0 00-1.032 0 11.209 11.209 0 01-7.877 3.08.75.75 0 00-.722.515A12.74 12.74 0 002.25 9.75c0 5.942 4.064 10.933 9.563 12.348a.749.749 0 00.374 0c5.499-1.415 9.563-6.406 9.563-12.348 0-1.39-.223-2.73-.635-3.985a.75.75 0 00-.722-.516l-.143.001c-2.996 0-5.717-1.17-7.734-3.08zm3.094 8.016a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd" />
            </svg>
            <div>Advertisements</div>
            <span class="text-xl font-black">Project</span>
        </a>
        
        <div>
            <form method="post" action="{{ route('logout') }}">
                @csrf

                <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="rounded-md bg-gray-200 py-2 px-4 font-semibold text-gray-900 shadow-lg transition duration-150 ease-in-out hover:bg-gray-300 hover:shadow-xl focus:shadow-xl focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-offset-2">Выйти</a>
            </form>
        </div>
    </header>
    <main class="mt-10 flex-grow flex flex-col items-center w-full h-full">
        <div style="min-height: 700px;" class="w-3/4 rounded-2xl  flex flex-col flex-wrap justify-center">
            <div class="h-12 w-full flex-shrink ">
                <form action="{{ route('getInfo') }}" method="post" class="flex gap-5 h-full justify-end">
                @csrf
                    <button type="submit" class="appearance-none  border-solid rounded-2xl border h-full px-5 {{ isset($type) && $type == 'users' ? 'bg-gray-500 text-white' : 'bg-blue-500 text-white'}}" name="type" value="users">
                        Пользователи
                    </button>
                    <button type="submit" class="appearance-none border-solid rounded-2xl border h-full px-5  {{ isset($type) && $type == 'advertisements' ? 'bg-gray-500 text-white' : 'bg-blue-500 text-white'}}" name="type" value="advertisements">
                        Объявления
                    </button>
                </form>
            </div>
            <div style="max-height: 660px;" class="w-full border-solid border-t pt-7 mt-6 flex flex-col gap-5 overflow-auto flex-grow">
            @if(isset($advertisements) && $advertisements->count() > 0)
            @foreach($advertisements as $advertisement)  
                <div style="min-height: 400px; min-width: 600px " class="min-w-full max-w-lg mx-auto bg-transparent shadow-md rounded-md p-6">
                    <h2 class="text-xl font-semibold mb-4 w-full">Объявление</h2>
                    <div class="mb-4">
                      <p class="text-lg font-semibold text-gray-800">Идентификатор пользователя:</p>
                      <?php  
                            $user = User::where('id', $advertisement->userID)->first();
                        ?>  
                      <p class="text-gray-600">{{$user->id}}</p>
                    </div>
                    <div class="mb-4">
                      <p class="text-lg font-semibold text-gray-800">Заголовок:</p>
                      <p class="text-gray-600">{{$advertisement->title}}</p>
                    </div>
                    <div class="mb-4">
                      <p class="text-lg font-semibold text-gray-800">Описание:</p>
                      <p class="text-gray-600">{{$advertisement->description}}</p>
                    </div>
                    <div class="mb-4">
                    <p class="text-lg font-semibold text-gray-800">Категория:</p>
                    <?php  

                        $category = Category::where('id', $advertisement->categoryID)->first();
                        if($category){
                            $categoryName = $category->categoryName;
                        } else{
                            $categoryName = '';
                        } ?>
                    <p class="text-gray-600">#{{$categoryName}}</p>
                    </div>
                    <form action="{{ route('controlAdvertisement') }}" method="post" class="flex gap-5 h-10 justify-end">
                        @csrf
                        @if($advertisement->status == 'pending')
                        <button type="submit" class="appearance-none  border-solid rounded-md border h-full px-5 bg-green-500 text-white" name="unBlockAdvertisement" value="{{$advertisement->id}}">
                            Разрешить
                        </button>
                        @else
                        <button type="submit" class="appearance-none  border-solid rounded-md border h-full px-5 bg-red-500 text-white" name="blockAdvertisement" value="{{$advertisement->id}}">
                            Запретить
                        </button>
                        @endif
                        <button type="submit" class="appearance-none border-solid rounded-md border h-full px-5  bg-blue-500 text-white " name="editAdvertisement" value="{{$advertisement->id}}">
                            Изменить
                        </button>
                    </form>
                    </div>
            @endforeach
            @elseif (isset($users) && $users->count() > 0)
            @foreach($users as $user)
                <div  style="min-height: 400px; min-width: 600px " class="lg:min-w-60 mx-auto bg-white shadow-md rounded-md p-6">
                    <h2 class="text-xl font-semibold mb-4 w-full">Пользователь</h2>
                    <div class="mb-4">
                      <p class="text-lg font-semibold text-gray-800">Имя:</p>
                      <p class="text-gray-600">{{$user->name}}</p>
                    </div>
                    <div class="mb-4">
                      <p class="text-lg font-semibold text-gray-800">Почта:</p>
                      <p class="text-gray-600">{{$user->email}}</p>
                    </div>
                    <div class="mb-4">
                      <p class="text-lg font-semibold text-gray-800">Роль:</p>
                      <p class="text-gray-600">{{$user->role}}</p>
                    </div>
                    <div class="mb-4">
                      <p class="text-lg font-semibold text-gray-800">Идентификатор:</p>
                      <p class="text-gray-600">{{$user->id}}</p>
                    </div>
                    
                    <form action="{{ route('controlUser') }}" method="post" class="flex gap-5 h-10 justify-end">
                        @csrf
                        <button type="submit" class="appearance-none  border-solid rounded-md border h-full px-5 bg-red-500 text-white" name="blockUser" value="{{$user->id}}">
                            Заблокировать
                        </button>
                        <button type="submit" class="appearance-none border-solid rounded-md border h-full px-5  bg-green-500 text-white " name="unBlockUser" value="{{$user->id}}">
                            Разблокировать
                        </button>
                    </form>
                </div>
            @endforeach
            @else
            <div class="text-3xl border flex flex-grow items-center justify-center">КОМАНДУЙ ХОЗЯИН</div>
            @endif
            </div>
        </div>
    </main>
</body>

</html>
