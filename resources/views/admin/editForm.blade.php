
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
   
    <div class="mx-auto mt-6 w-full max-w-md rounded-xl bg-white/80 p-6 shadow-xl backdrop-blur-xl sm:mt-10 sm:p-10">

        <form action="{{ route('editAdvertisement') }}" method="post" >


        @csrf
        <div class="mb-6 flex flex-col gap-6">
            <label for="category" class="block text-sm font-medium text-gray-700">Оглавление</label>
            <select name="categoryID" id="category" class="w-full flex" required  onchange="showInput()">
            <option value="{{$currentCategory->id}}">{{$currentCategory->categoryName}}</option>

            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->categoryName }}</option>
            @endforeach
            </select>
            
            <div id="categoryDiv" class="hidden">
            <hr>
                <label for="categoryInput" class="block text-sm font-medium text-gray-700 my-6">Категория</label>
                <input type="text" id="categoryInput" name="categoryInput" value="" autofocus class="{{ $errors->has('email') ? 'text-red-900 placeholder-red-300       focus:border-red-500 focus:ring-red-500 border-red-300' : 'border-gray-300 focus:border-green-500 focus:ring-green-500      placeholder:text-gray-400' }} w-full rounded-md pl-5 py-2 text-sm" placeholder="Название категории..." />
            </div>
            <hr>
            <label for="title" class="block text-sm font-medium text-gray-700">Оглавление</label>
            <input type="text" id="title" name="title" value="{{ $advertisement->title }}" required autofocus class="{{ $errors->has('email') ? 'text-red-900 placeholder-red-300 focus:border-red-500 focus:ring-red-500 border-red-300' : 'border-gray-300 focus:border-green-500 focus:ring-green-500 placeholder:text-gray-400' }} w-full rounded-md pl-5 py-2 text-sm" placeholder="Название..." />
            <hr>
            <label for="content" class="block text-sm font-medium text-gray-700">Описание</label>
            <textarea type="text" id="content" name="description" value="" required autofocus class="{{ $errors->has('email') ? 'text-red-900 placeholder-red-300 focus:border-red-500 focus:ring-red-500 border-red-300' : 'border-gray-300 focus:border-green-500 focus:ring-green-500 placeholder:text-gray-400' }} w-full rounded-md pl-5 py-2 text-sm" placeholder="Что-то..." />{{ $advertisement->description }}</textarea>
            <hr>
            <label for="file" class="block text-sm font-medium text-gray-700">Картинка<small> (необязательно)</small></label>
            <input type="file" id="file" name="file" value="{{ !!$advertisement->file ? $advertisement->file : '' }}" autofocus class="{{ $errors->has('email') ? 'text-red-900 placeholder-red-300 focus:border-red-500 focus:ring-red-500 border-red-300' : 'border-gray-300 focus:border-green-500 focus:ring-green-500 placeholder:text-gray-400' }} w-full rounded-md pl-5 py-2 text-sm" placeholder="Название..." />
            <input type="hidden" name="advertisementID" value="{{ $advertisementID }}" />
        </div> 
        <div class="flex w-full justify-end">   
        <button type="submit" class="rounded-md bg-blue-500 self-end py-2 px-4 font-semibold text-white shadow-lg transition duration-150 ease-in-out hover:bg-gray-300 hover:shadow-xl focus:shadow-xl focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-offset-2">Отправить</button>
        </div>
           
        </form>
    </div>
    </main>
    <script>
    function showInput() {
    const selectBox = document.getElementById("categoryDiv");
    const userInput = document.getElementById("category");
    const categoryInput = document.getElementById("categoryInput");
    if (userInput.value === "5") {
        selectBox.classList.remove('hidden')
        categoryInput.setAttribute("required", "required");
    } else {
        selectBox.classList.add('hidden')
        categoryInput.removeAttribute("required");
    }
}
</script>
</body>
</html>
