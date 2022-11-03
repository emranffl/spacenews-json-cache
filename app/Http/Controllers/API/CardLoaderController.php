<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Functions\Fetch;
use Illuminate\Support\Facades\Cache;

class CardLoaderController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $offset = $request->header('offset');
        $limit = 12;
        $viewHTML = '';

        // try {

        //     if (Cache::has('cachedArticles') && Cache::has('cachedMarsPhotoData')) {
        //         $articles = Cache::store('redis')->get('cachedArticles');
        //         $marsPhotoCollection = Cache::store('redis')->get('cachedMarsPhotoData');
        //     } else
        //         return ['redirect' => '/'];
        // } catch (Throwable $th) {
        //     $fetch = new Fetch();

        //     $articles = $fetch->fetch_articles();
        //     $marsPhotoCollection = $fetch->fetch_mars_photos();
        // }

        // $photoObject = $marsPhotoCollection[array_rand($marsPhotoCollection, 1)];

        // foreach (array_splice($articles, $offset, $limit) as $index => $article) {
        //     $loop = (object)['index' => $index];

        //     $viewHTML .= view('components.card', compact('loop', 'limit', 'article', 'marsPhotoCollection', 'photoObject'));
        // }

        // return ['view' => $viewHTML, 'eod' => ($offset + $limit) > count($articles)];
    }
}
