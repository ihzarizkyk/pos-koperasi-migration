<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shift;
use App\Transaction;
use Carbon\Carbon;
use DateTime;
use Auth;
use Session;

class ShiftController extends Controller
{
    public function index()
    {
        $lastShift = Shift::latest('id')->first();
        $data = Shift::where('selesai', '!=', 'null')->get();
        return view('shift.index', compact('lastShift', 'data'));
    }

    public function new()
    {
        return view('shift.create');
    }

    public function start(Request $req)
    {
        $startShift = new Shift;

        $startShift->users_id = Auth::id();
        $startShift->start_cash = preg_replace("/[^a-zA-Z0-9]/", "", $req->modal);
        $startShift->mulai = $req->start;

        $startShift->save();

        Session::flash('create_success', 'Shift Telah Dimulai');
        return redirect('/shift');
    }

    public function endShift($id)
    {
        $data = Shift::find($id);
        $shift = Shift::where('id', $id)->first();
        $startShift = $shift->mulai;
        $endShift = date('Y-m-d H:i:s');
        $getTransaction = Transaction::whereBetween('created_at', [$startShift, $endShift])->get();
        $tf = 0;
        $cash = 0;
        $items = 0;
        $qris = 0;
        $ovo = 0;
        $gopay = 0;
        $total = 0;
        $hutang = 0;
        foreach ($getTransaction as $sold) {
            if ($sold->jenisPayment_id == 1) {
                $cash += $sold->total;
            }
            elseif ($sold->jenisPayment_id == 2) {
                $tf += $sold->total;
            }
            elseif ($sold->jenisPayment_id == 3) {
                $qris += $sold->total;
            }
            elseif ($sold->jenisPayment_id == 4) {
                $ovo += $sold->total;
            }
            elseif ($sold->jenisPayment_id == 5) {
                $gopay += $sold->total;
            }
            elseif ($sold->jenisPayment_id == 6) {
                $hutang += $sold->total;
            }
            $items += 1;
            $total += $sold->total;
        }
        return view('shift.edit', compact('data', 'cash', 'items', 'tf', 'qris', 'ovo', 'gopay', 'total', 'hutang'));
    }

    public function end(Request $req, $id)
    {
        $endShift = Shift::where('id', $id)->first();

        $endShift->users_id = Auth::id();
        $endShift->expected = preg_replace("/[^a-zA-Z0-9]/", "", $req->expected);
        $endShift->difference = preg_replace("/[^a-zA-Z0-9]/", "", $req->beda);
        $endShift->sold = $req->sold;
        $start_cash = preg_replace("/[^a-zA-Z0-9]/", "", $req->start_cash);
        $endShift->actual = preg_replace("/[^a-zA-Z0-9]/", "", $req->actual);
        $endShift->cash = preg_replace("/[^a-zA-Z0-9]/", "", $req->cash);
        $endShift->transfer = preg_replace("/[^a-zA-Z0-9]/", "", $req->tf);
        $endShift->qris = preg_replace("/[^a-zA-Z0-9]/", "", $req->qris);
        $endShift->ovo = preg_replace("/[^a-zA-Z0-9]/", "", $req->ovo);
        $endShift->gopay = preg_replace("/[^a-zA-Z0-9]/", "", $req->gopay);
        $endShift->invoice = preg_replace("/[^a-zA-Z0-9]/", "", $req->hutang);
        $endShift->selesai = $req->selesai;

        $endShift->save();
        Session::flash('create_success', 'Shift Telah Diakhiri');
        return redirect('/shift');
    }

    public function detail($id)
    {
        $data = Shift::find($id);
        return view('shift.detail', compact('data'));
    }

    public function delete($id)
    {
        $destroy = Shift::find($id);
        $destroy->delete();
        Session::flash('create_success', 'Shift telah dihapus');
        return redirect()->back();
    }
}
