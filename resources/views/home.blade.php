@extends('layouts.app')


@section('HEADCONTENT')
    <title>Home | SpaceNews</title>
@endsection

@php
    use App\Functions\Fetch;
    
    try {
        $articlesJSONPath = storage_path() . '/json/articles-data.json';
        $marsPhotoJSONPath = storage_path() . '/json/mars-photo-data.json';
    
        if ($articlesJSONPath) {
            $articles = json_decode(file_get_contents($articlesJSONPath), true);
    
            $dataFetchedFromAPI = true;
            if (empty($articles)) {
                // fetching articles from API
                $articles = (new Fetch())->fetch_articles();
    
                // caching articles to JSON file
                file_put_contents($articlesJSONPath, json_encode($articles));
            }
        }
    
        if ($marsPhotoJSONPath) {
            $marsPhotoCollection = json_decode(file_get_contents($marsPhotoJSONPath), true);
    
            if (empty($marsPhotoCollection)) {
                // fetching mars photos from API
                $marsPhotoCollection = (new Fetch())->fetch_mars_photos();
    
                // caching mars photos to JSON file
                file_put_contents($marsPhotoJSONPath, json_encode($marsPhotoCollection));
            }
        }
    } catch (\Throwable $th) {
        error_log($th->getMessage());
    }
@endphp

@section('MAINCONTENT')
    @if (isset($dataFetchedFromAPI) && $dataFetchedFromAPI)
        <div class="absolute right-1 top-1 flex items-center z-10 p-4 space-x-4 w-full max-w-xs text-white bg-slate-400 rounded-lg divide-x divide-gray-200 shadow dark:text-gray-400 dark:divide-gray-700 space-x dark:bg-gray-800"
            id="redis-error-toast" role="alert">
            <span class="material-icons">
                warning
            </span>
            <div class="pl-4 text-sm font-normal">
                The results are served from the API on first hit, `redis-server` is not installed in the current hosting
                environment, thus, the results are cached by custom algorithm in JSON format. Next <span
                    class="font-semibold">refresh</span>
                will serve the results from the cache in an instant. Note that the site is still under development!
            </div>
            <button type="button"
                class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
                data-button-type="close" data-dismiss-target="#redis-error-toast" aria-label="Close">
                <span class="sr-only">Close</span>
                <span class="material-icons">close</span>
            </button>
        </div>
    @endif
    <div class="mt-10">

        @if (empty($articles))
            <p class="text-center text-xl text-red-500 font-light my-20">
                Couldn't fetch the results, please try again after some time.
            </p>
        @else
            @php
                $limit = 12;
                
                if (!empty($marsPhotoCollection)) {
                    $photoObject = $marsPhotoCollection[array_rand($marsPhotoCollection, 1)];
                }
            @endphp

            <div id="card-containers">

                @foreach (array_splice($articles, null, $limit) as $article)
                    @include('components.card')
                @endforeach

            </div>

            <div class="flex justify-center align-middle my-20" id="load-more">
                <button type="button" name="load" value="true" onclick="loadMoreCards()"
                    class="border rounded-md shadow-sm outline-none px-5 py-1 text-gray-600 hover:bg-sky-400 hover:text-white">Load
                    More</button>
            </div>
        @endif

    </div>
@endsection
