<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use App\Payment;

class Transaction extends Model
{
    // Initialize
    protected $fillable = [
        'kode_transaksi', 'total_barang', 'subtotal', 'jenis_diskon', 'diskon', 'total', 'bayar', 'kembali', 'id_kasir', 'kasir',
    ];

    /**
     * Get the user that owns the Transaction
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function jenisPayment()
    {
        return $this->hasOne(jenis_payment::class, 'id', 'jenisPayment_id');
    }
}
