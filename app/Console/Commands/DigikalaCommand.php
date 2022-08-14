<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class DigikalaCommand extends Command
{
    protected $signature = 'digikala:get';
    protected $description = 'Get Data From Digikala';
    public function handle()
    {
        $response = Http::get('https://api.digikala.com/v1/categories/book/search');
        return $response->body();
    }
}
