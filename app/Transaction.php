<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
// use App\Payment;

class Transaction extends Model
{
    // Initialize
    protected $fillable = [
        'kode_transaksi', 'total_barang', 'subtotal', 'jenis_diskon', 'diskon', 'total', 'bayar', 'kembali', 'id_kasir', 'kasir',
    ];

    protected $appends = [
        'total_string',
        'nama_barang'
    ];

    protected $casts = [
        'is_refund' => 'boolean',
    ];

    /**
     * Get the user that owns the Transaction
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function transaction_details()
    {
        return $this->hasMany(TransactionDetail::class, 'transaction_id', 'id');
    }

    public function jenisPayment()
    {
        return $this->hasOne(jenis_payment::class, 'id', 'jenisPayment_id');
    }

    public function getTotalStringAttribute()
    {
        $nominal = $this->total;
        return ($nominal<0 ? '(' : '').'Rp '.number_format(($nominal<0 ? $nominal*-1 : $nominal), 0, ',', '.').($nominal<0 ? ')' : '');
    }

    public function getJamAttribute()
    {
        $date = Carbon::parse($this->created_at);
        return $date->format('H.i');
    }

    public function getNamaBarangAttribute()
    {
        $nama_barang = $this->transaction_details->map(function ($p) {
            return $p->nama_barang;
        });
        $nama_barang = collect($nama_barang)->join(', ');
        return $nama_barang;
    }
}
