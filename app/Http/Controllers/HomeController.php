<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function index()
    {
        $response = Http::get('https://api.digikala.com/v1/categories/book/search/');
        $response = json_decode($response->body());

        // Page Count
        $pages = $response->data->pager->total_pages;

        $crawl_code = time();

        for ( $i = 0; $i <= $pages; $i++) {
            try {
                $response = Http::get('https://api.digikala.com/v1/categories/book/search/?page=' . $i);
                $response = json_decode($response->body());

                foreach ($response->data->products as $product)
                    $book = Book::query()->create([
                        'crawl_code'         => $crawl_code,
                        'digikala_id'        => $product->id,
                        'title'              => $product->title_fa,
                        'brand'              => $product->data_layer->brand,
                        'image'              => array_key_exists(0 , optional($product->images->main)->url) ? optional($product->images->main)->url[0] : '',
                        'seller_id'          => $product->default_variant->seller->id,
                        'seller_name'        => $product->default_variant->seller->title,
                        'seller_url'         => $product->default_variant->seller->url,
                        'rate'               => $product->default_variant->rate,
                        'selling_price'      => $product->default_variant->price->selling_price,
                        'rrp_price'          => $product->default_variant->price->rrp_price,
                        'order_limit'        => $product->default_variant->price->order_limit,
                        'discount_percent'   => $product->default_variant->price->discount_percent,
                    ]);

                Log::info('successfully reading page number '. $i . ' Done!');
            }catch (\Exception $exception){
                Log::error('reading page number '. $i . ' failed.');
                Log::error($exception);
            }
            sleep(1);
        }


        $books = Book::query()
            ->orderBy('discount_percent' , 'DESC')
            ->orderby('crawl_code' , 'DESC')
            ->paginate(500);

        return view('panel.Home.index')->with(['books' => $books]);

    }
}
