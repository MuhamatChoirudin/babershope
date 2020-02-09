<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

use App\Item;
use App\Transaksi;

class TransaksiDetail extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table="transaksi_detail";
    protected $primaryKey="id";
    protected $fillable = [
        'item_id', 'transaksi_id', 'qty','created_at','updated_at',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    public function transaksis() {
    	return $this->belongsTo(Transaksi::class);
    }
    public function itemss() {
    	return $this->belongsTo(Item::class);
    }
}
