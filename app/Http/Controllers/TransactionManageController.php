<?php

namespace App\Http\Controllers;

use PDF;
use Auth;
use Session;
use DB;
use App\Acces;
use App\Market;
use App\Product;
use App\Activity;
use App\Transaction;
use App\TransactionDetail;
use App\Supply_system;
use Illuminate\Http\Request;

class TransactionManageController extends Controller
{
    // Show View Transaction
    public function viewTransaction()
    {
        $id_account = Auth::id();
        $check_access = Acces::where('user', $id_account)
        ->first();
        if($check_access->transaksi == 1){
        	$products = Product::all()
        	->sortBy('kode_barang');
            $supply_system = Supply_system::first();

            return view('transaction.transaction', compact('products', 'supply_system'));
        }else{
            return back();
        }
    }

    // Take Transaction Product
    public function transactionProduct($id)
    {
        $id_account = Auth::id();
        $check_access = Acces::where('user', $id_account)
        ->first();
        if($check_access->transaksi == 1){
        	$product = Product::where('kode_barang', '=', $id)
        	->first();
        	$supply_system = Supply_system::first();
        	$status = $supply_system->status;

        	return response()->json([
        		'product' => $product,
        		'status' => $status
        	]);
        }else{
            return back();
        }
    }

    // Check Transaction Product
    public function transactionProductCheck($id)
    {
        $id_account = Auth::id();
        $check_access = Acces::where('user', $id_account)
        ->first();
        if($check_access->transaksi == 1){
        	$product_check = Product::where('kode_barang', '=', $id)
        	->count();

        	if($product_check != 0){
        		$product = Product::where('kode_barang', '=', $id)
    	    	->first();
    	    	$supply_system = Supply_system::first();
    	    	$status = $supply_system->status;
        		$check = "tersedia";
        	}else{
        		$product = '';
        		$status = '';
        		$check = "tidak tersedia";
        	}

        	return response()->json([
        		'product' => $product,
        		'status' => $status,
        		'check' => $check
        	]);
        }else{
            return back();
        }
    }

    // Transaction Process
    public function transactionProcess(Request $req)
    {
        $id_account = Auth::id();
        $check_access = Acces::where('user', $id_account)
        ->first();
        if($check_access->transaksi == 1){
    		$jml_barang = count($req->kode_barang);
            DB::beginTransaction();
            try {
                $transaction = new Transaction;
                $transaction->kode_transaksi = $req->kode_transaksi;
                $transaction->subtotal = $req->subtotal;
        		$transaction->diskon = $req->diskon;
        		$transaction->total = $req->total;
        		$transaction->bayar = $req->bayar;
        		$transaction->kembali = $req->bayar - $req->total;
        		$transaction->id_kasir = Auth::id();
                $transaction->kasir = Auth::user()->nama;
        		$transaction->save();
                for($i = 0; $i < $jml_barang; $i++){
                    $transaction_detail = new TransactionDetail;
                    $transaction_detail->transaction_id = $transaction->id;
                    $transaction_detail->kode_barang = $req->kode_barang[$i];
                    $product_data = Product::where('kode_barang', $req->kode_barang[$i])
                    ->first();
                    $transaction_detail->nama_barang = $product_data->nama_barang;
                    $transaction_detail->harga = $product_data->harga;
                    $transaction_detail->jumlah = $req->jumlah_barang[$i];
                    $transaction_detail->total_barang = $req->total_barang[$i];
                    $transaction_detail->diskon_per_barang = $req->diskon_per_barang[$i];
                    $transaction_detail->save();
                }    
                $check_supply_system = Supply_system::first();
                if($check_supply_system->status == true){
                    for($j = 0; $j < $jml_barang; $j++){
                        $product = Product::where('kode_barang', '=', $req->kode_barang[$j])
                        ->first();
                        $product->stok = $product->stok - $req->jumlah_barang[$j];
                        $product->save();
                        $product_status = Product::where('kode_barang', '=', $req->kode_barang[$j])
                        ->first();
                        if($product_status->stok == 0){
                            $product_status->keterangan = 'Habis';
                            $product_status->save();
                        }
                    }
                }

                $activity = new Activity;
                $activity->id_user = Auth::id();
                $activity->user = Auth::user()->nama;
                $activity->nama_kegiatan = 'transaksi';
                $activity->jumlah = $jml_barang;
                $activity->save();

                Session::flash('transaction_success', $req->kode_transaksi);

                DB::commit();
                return back();
                
                // all good
            } catch (\Exception $e) {
                DB::rollback();
                return back();
                // something went wrong
            }
        }else{
            return back();
        }
    }

    // Transaction Receipt
    public function receiptTransaction($id)
    {
        $market = Market::first();
        $id_account = Auth::id();
        $check_access = Acces::where('user', $id_account)
        ->first();
        if($check_access->transaksi == 1){
            $transaction = Transaction::where('kode_transaksi', '=', $id)
            ->select('transactions.*')
            ->first();
            $transactions = TransactionDetail::where('transaction_id', '=', $transaction->id)
            ->select('*')
            ->get();
            // return response()->json($transactions);
            $diskon = $transaction->subtotal * $transaction->diskon / 100;

            $customPaper = array(0,0,400.00,283.80);
            $pdf = PDF::loadview('transaction.receipt_transaction', compact('transaction', 'transactions', 'diskon', 'market'))->setPaper($customPaper, 'landscape');
            return $pdf->stream();
        }else{
            return back();
        }
    }
}
