<?php

namespace App\Http\Controllers;

use App\Models\Expenses;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
// use Dompdf\Dompdf;
// use SnappyPdf;

class ExpensesController extends Controller
{
    public function index()
    {

        // $startOfPreviousMonth = Carbon::now()->subMonth()->startOfMonth();
        // $endOfPreviousMonth = Carbon::now()->subMonth()->endOfMonth();
        // $data = DB::table('expenses')
        // ->whereBetween('created_at', [$startOfPreviousMonth, $endOfPreviousMonth])
        // ->get();

        // $last30days = Carbon::now()->subDays(30);
        // $last30daysReports = Expenses::where('date','>=',$last30days)->get();

        // return $dompdf->loadHtml('admin/expenses', ['data' => $data])
        //  ->download('previousMonth.pdf');

        return view('admin/reports/index');
    }


    // weekly report
    public function weekly()
    {
        $last7days = Carbon::now()->subWeek();
        // $end = Carbon::now();
        // $oldRecords = Expenses::where('date', '<', $last7days)->delete();
        // echo $oldRecords;
        $last7daysReports = Expenses::where('date', '>=', $last7days)->get();
        $data = DB::table('expenses')->where('date', '>=', $last7days)
        ->selectRaw('sum(daily_sale) as daily_sale, sum(daily_expenses) as daily_expenses, sum(daily_profit) as daily_profit')
        ->first();
        return view('admin/reports/weekly',compact('last7daysReports', 'data' ));

    }

    // fifteen days report
    public function fifteenDays()
    {
        $last15days = Carbon::now()->subDays(15);
        $last15daysReports = Expenses::where('date', '>=', $last15days)->get();
        $data = DB::table('expenses')->where('date', '>=', $last15days)
        ->selectRaw('sum(daily_sale) as daily_sale, sum(daily_expenses) as daily_expenses, sum(daily_profit) as daily_profit')
        ->first();
        return view('admin/reports/fifteen_days',compact('last15daysReports', 'data'));

    }

    // monthly report
    public function monthly()
    {
        // select last month record start from today(now)
        $last30days = Carbon::now()->subMonth();
        // get last month record
        $last30daysReports = Expenses::where('date', '>=', $last30days)->get();
        // calculate sum of each column of last month
        $data = DB::table('expenses')->where('date', '>=', $last30days)
        ->selectRaw('sum(daily_sale) as daily_sale, sum(daily_expenses) as daily_expenses, sum(daily_profit) as daily_profit')
        ->first();
        return view('admin/reports/one_month',compact('last30daysReports', 'data'));
    }

    // Add daily reports to expenses table
    public function store(Request $request)
    {
        $post = new Expenses;
        $post->date = $request->get('date');
        $post->daily_expenses = $request->get('daily_expenses');
        $post->daily_sale = $request->get('daily_sale');
        $post->daily_profit = $request->get('daily_profit');
        $post->save();
        return redirect(route('admin.dashboard'));

    }
}



