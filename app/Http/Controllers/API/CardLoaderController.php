<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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

        $articlesJSONPath = storage_path() . '/json/articles-data.json';
        $marsPhotoJSONPath = storage_path() . '/json/mars-photo-data.json';

        if ($articlesJSONPath && $marsPhotoJSONPath) {
            $articles = json_decode(file_get_contents($articlesJSONPath), true);
            $marsPhotoCollection = json_decode(file_get_contents($marsPhotoJSONPath), true);
        } else
            return ['redirect' => '/'];

        $photoObject = $marsPhotoCollection[array_rand($marsPhotoCollection, 1)];

        foreach (array_splice($articles, $offset, $limit) as $index => $article) {
            $loop = (object)['index' => $index];

            $viewHTML .= view('components.card', compact('loop', 'limit', 'article', 'marsPhotoCollection', 'photoObject'));
        }

        return ['view' => $viewHTML, 'eod' => ($offset + $limit) > count($articles)];
    }
}
