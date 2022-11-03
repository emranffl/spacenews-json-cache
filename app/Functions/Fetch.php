<?php
namespace App\Functions;

use Illuminate\Support\Facades\Http;


class Fetch
{
    public function fetch_articles()
    {
        $response = Http::withHeaders(['X-RapidAPI-Host' => 'spacefo.p.rapidapi.com', 'X-RapidAPI-Key' => '4e5af1f078msh5096b16206fe69ep162351jsn1bbd3c374daf'])->get('https://spacefo.p.rapidapi.com/articles');

        return $response->successful() ? $response->json() : [];
    }

    public function fetch_mars_photos()
    {
        $date = (new \Datetime('-1 month'))->format('Y-m-d');

        $response = Http::get("https://api.nasa.gov/mars-photos/api/v1/rovers/curiosity/photos?page=1&api_key=t9gdTvb1uSUkiXwComzN8BuCjffdJ7zNG2ZVNZjF&earth_date=$date");

        return $response->successful() ? $response->json()['photos'] : [];
    }
}
