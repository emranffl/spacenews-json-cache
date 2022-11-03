@if ($loop->index == 0)
    <div class="container">
        <div class="grid gap-y-10 md:gap-y-16 lg:gap-y-20 mt-6 mx-3 sm:mx-5 md:mx-10 lg:mx-32 xl:mx-40 2xl:mx-60">
@endif

<div class="col-span-1 space-y-3" data-type="news-article">
    <div class="group relative space-y-3">
        <div
            class="w-full h-[60vh] bg-white rounded-t-xl shadow-sm overflow-hidden sm:aspect-w-2 sm:aspect-h-1 lg:aspect-w-1 lg:aspect-h-1">
            <img src="{{ $article['image']['src'] }}" alt="{{ $article['image']['alt'] }}"
                class="group-hover:opacity-75 w-full h-full object-center object-cover">
        </div>

        <h3 class="text-base text-gray-800 group-hover:text-blue-400">
            <a href="{{ $article['link'] }}" target="blank">
                <span class="absolute inset-0"></span>
                {{ $article['title'] }}
            </a>
        </h3>
    </div>

    <p class="text-sm font-light text-gray-500">{{ $article['description'] }}</p>

    <div class="flex justify-around align-middle pt-5">
        <span class="text-xs text-gray-500">
            {{ \Carbon\Carbon::parse($article['time'])->format('M, j | l, g:i A') }}
        </span>
        <small class="font-light text-purple-400">{{ $article['author'] }}</small>
    </div>

    <div class="flex h-10 mt-5 gap-x-1">
        <button class="group h-full w-1/2 justify-center align-middle rounded-bl-md bg-slate-200 hover:bg-slate-300"
            type="button">
            <span class="material-icons group-hover:text-red-600 group-hover:text-lg">
                favorite_border
            </span>
        </button>
        <button class="group h-full w-1/2 justify-center align-middle bg-slate-200 hover:bg-slate-300" type="button">
            <span class="material-icons group-hover:text-gray-400 group-hover:text-lg">
                repeat
            </span>
        </button>
        <button class="group h-full w-1/2 justify-center align-middle rounded-br-md bg-slate-200 hover:bg-slate-300"
            type="button">
            <span class="material-icons group-hover:text-blue-400 group-hover:text-lg">
                share
            </span>
        </button>
    </div>
</div>

@if ($loop->index == $limit - 1)
    </div>

    @if (!empty($marsPhotoCollection))
        <div class="mt-20">
            <div class="grid grid-cols-1">
                <div class="col-span-1 space-y-3 p-8 my-auto drop-shadow-xl">
                    <div class="group relative">
                        <a href="{{ $photoObject['img_src'] }}" target="blank">
                            <div
                                class="w-full h-96 md:h-[70vh] bg-white rounded-md overflow-hidden sm:aspect-w-2 sm:aspect-h-1  lg:aspect-w-1 lg:aspect-h-1">
                                <img src="{{ $photoObject['img_src'] }}" alt="{{ $photoObject['id'] }}"
                                    class="w-full h-full object-center object-cover group-hover:opacity-75">
                            </div>
                        </a>
                    </div>
                    <div class="flex flex-col">
                        <small class="font-light text-gray-500">
                            {{ $photoObject['camera']['full_name'] }}
                        </small>

                        <h3 class="text-base text-blue-300 my-3">
                            Photo {{ $photoObject['id'] }} on Mars - sol.
                            {{ $photoObject['sol'] }}
                        </h3>

                        <small class="text-xs font-light text-gray-400 italic ml-auto">
                            Courtesy of {{ $photoObject['rover']['name'] }}</small>
                    </div>
                </div>
            </div>
        </div>
    @endif
    </div>
@endif
