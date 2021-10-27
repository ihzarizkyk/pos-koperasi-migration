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
        $startShift->modal = preg_replace("/[^a-zA-Z0-9]/", "", $req->modal);
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
        $total = 0;
        $items = 0;
        foreach ($getTransaction as $sold) {
            $total += $sold->total;
            $items += 1;
        }
        return view('shift.edit', compact('data', 'total', 'items'));
    }

    public function end(Request $req, $id)
    {
        $endShift = Shift::where('id', $id)->first();

        $endShift->users_id = Auth::id();
        $endShift->pemasukan = preg_replace("/[^a-zA-Z0-9]/", "", $req->pemasukan);
        $endShift->sold = $req->sold;
        $masuk = preg_replace("/[^a-zA-Z0-9]/", "", $req->pemasukan);
        $modal = preg_replace("/[^a-zA-Z0-9]/", "", $req->modal);
        $total = $masuk + $modal;
        $endShift->total = $total;
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