@extends('layouts.app')


@section('HEADCONTENT')
    <title>
        test | SpaceNews
    </title>
@endsection

@section('MAINCONTENT')
    <div class="container">
        @php
            use App\Functions\Fetch;
            
            // $offset = $request->header('offset');
            $offset = 12;
            $limit = 12;
            $viewHTML = '';
            
            try {
                if (Cache::has('cachedArticles') && Cache::has('cachedMarsPhotoData')) {
                    $articles = Cache::store('redis')->get('cachedArticles');
                    $marsPhotoCollection = Cache::store('redis')->get('cachedMarsPhotoData');
                } else {
                    return ['redirect' => '/'];
                }
            } catch (\Throwable $th) {
                error_log($th);
                $fetch = new Fetch();
            
                $articles = $fetch->fetch_articles();
                $marsPhotoCollection = $fetch->fetch_mars_photos();
            }
            
            $photoObject = $marsPhotoCollection[array_rand($marsPhotoCollection, 1)];
            
            foreach (array_splice($articles, $offset, $limit) as $index => $article) {
                $loop = (object) ['index' => $index];
            
                $viewHTML .= view('components.card', compact('loop', 'limit', 'article', 'marsPhotoCollection', 'photoObject'));
            }
            
            echo $viewHTML;
        @endphp
        <div class="">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-4 mt-6">

                <div class="h-20 col-span-1 md:col-span-2 bg-gray-800 flex items-center justify-center text-white">
                    0
                </div>
                @for ($i = 1; $i <= 20; $i++)
                    <div class="h-20 col-span-1 bg-gray-800 flex items-center justify-center text-white">
                        {{ $i }}
                    </div>
                @endfor

            </div>
        </div>
    </div>
@endsection
