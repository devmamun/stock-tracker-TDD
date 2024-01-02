<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Stock extends Model
{
    use HasFactory;

    protected $table = 'stock';
    protected $guarded = [];

    protected $casts = [
        'in_stock' => 'boolean'
    ];

    public function retailer()
    {
        return $this->belongsTo(Retailer::class);
    }

    public function track()
    {
        if ($this->retailer->name == 'Best Buy') {
            $result = Http::get('https://foo.com')->json();

            $this->update([
                'in_stock' => $result['available'],
                'price' => $result['price']
            ]);
        }
    }

}
