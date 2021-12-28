<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shift;
use App\Market;
use App\Transaction;
use App\Detail_shift;
use App\jenis_payment;
use App\Employee;
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
        $employee = Employee::where([['users_id',Auth::id()], ['role', "admin"]])->count();
        return view('shift.index', compact('lastShift', 'data', 'employee'));
    }

    public function new()
    {
        $market = Market::all();
       
        return view('shift.create', compact('market'));
    }

    public function start(Request $req)
    {
        $employee = Employee::where([['users_id',Auth::id()], ['role', "admin"]])->first();
        $startShift = new Shift;

        $startShift->employee_id = $employee->id;
        $startShift->markets_id = $req->market;
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
        $employee = Employee::where([['users_id',Auth::id()], ['role', "admin"]])->first();
        $endShift = Shift::where('id', $id)->first();

        $endShift->employee_id = $employee->id;
        $endShift->expected = preg_replace("/[^a-zA-Z0-9]/", "", $req->expected);
        $endShift->difference = preg_replace("/[^a-zA-Z0-9]/", "", $req->beda);
        $endShift->sold = $req->sold;
        $start_cash = preg_replace("/[^a-zA-Z0-9]/", "", $req->start_cash);
        $endShift->actual = preg_replace("/[^a-zA-Z0-9]/", "", $req->actual);
        $endShift->selesai = $req->selesai;

        $endShift->save();

        for ($i=1; $i < 7 ; $i++) { 
            $endShiftDetail = new Detail_shift;
            $endShiftDetail->shifts_id = $id;
            $endShiftDetail->jenis_payments_id = $i;
            
            $endShiftDetail->total_payments = preg_replace("/[^a-zA-Z0-9]/", "", $req->payment[$i-1]);
            $endShiftDetail->save();
        }

        Session::flash('create_success', 'Shift Telah Diakhiri');
        return redirect('/shift');
    }

    public function detail($id)
    {
        $data = Shift::find($id);
        $detailShift = Detail_shift::where('shifts_id', $id)->get();
        return view('shift.detail', compact('data', 'detailShift'));
    }

    public function delete($id)
    {
        $destroy = Shift::find($id);
        $deleteDetail = Detail_shift::where('shifts_id', $id)->delete();
        $destroy->delete();
        Session::flash('create_success', 'Shift telah dihapus');
        return redirect()->back();
    }
}
