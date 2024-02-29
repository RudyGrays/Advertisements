<?php
    use App\Models\Category;
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

<body class="min-h-screen bg-gray-50">
    
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

                <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="rounded-md bg-gray-200 py-2 px-4 font-semibold text-gray-900 shadow-lg transition duration-150 ease-in-out hover:bg-gray-300 hover:shadow-xl focus:shadow-xl focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-offset-2">Log Out</a>
            </form>
        </div>
    </header>
    <main class="flex flex-col items-center w-full">
   
    <div class="mt-8 w-1/2 flex flex-col">
        <a href="{{ route('getFormAdvertisement') }}" class="rounded-md self-end max-w-max bg-blue-500 py-2 px-4 font-semibold text-white shadow-lg transition duration-150 ease-in-out hover:bg-gray-300 hover:text-blue-500 hover:shadow-xl focus:shadow-xl focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-offset-2">Сделать объявление</a>
    
    <form action="{{ route('getAdvertisementsWithCategory') }}" method="post" class="mt-8 flex gap-3">
    
    @csrf
    @if(isset($categories) && $categories->count() > 0)
        @foreach($categories as $currentCategory)
        @if($currentCategory->id == '5')
            @continue
        @endif
        <button type="submit" class="appearance-none {{ isset($category) && $category->categoryName == $currentCategory->categoryName ? 'text-red-800' : 'text-blue-800'}}" name="categoryID" value="{{ $currentCategory->id}}">
        #{{ $currentCategory->categoryName }}
        </button>
        @endforeach
        @else
            Пусто
    @endif
    
    </form>
    <div style="max-height: 520px;" class="flex flex-col min-w-80 overflow-auto gap-4 mt-4">
       
    @if(isset($advertisements) && $advertisements->count() > 0)
        @foreach($advertisements as $advertisement)
        <div class="min-w-full max-w-lg mx-auto bg-white shadow-md rounded-md p-6">
            <h2 class="text-xl font-semibold mb-4 w-full">Объявление</h2>
            <div class="mb-4">
              <p class="text-lg font-semibold text-gray-800">Заголовок:</p>
              <p class="text-gray-600">{{$advertisement->title}}</p>
            </div>
            <div class="mb-4">
              <p class="text-lg font-semibold text-gray-800">Описание:</p>
              <p class="text-gray-600">{{$advertisement->description}}</p>
            </div>
            <?php  $category = Category::where('id', $advertisement->categoryID)->first();
            if($category){
                $categoryName = $category->categoryName;
            } else{
                $categoryName = '';
            } ?>
            <div class="mb-4">
                <p class="text-lg font-semibold text-gray-800">Категория:</p>
                
                <p class="text-gray-600">#{{$categoryName}}</p>
                
            </div>
        </div>
        @endforeach
        @else
            Пока никто ничего не опубликовал :(
        @endif
    </div>
    </div>  
    </main>
</body>

</html>
