<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ExcelImport;
use App\Exports\ExcelExport;
use App\Models\ExcelData;
use Maatwebsite\Excel\HeadingRowImport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ExcelController extends Controller
{
    public function index()
    {
        return view('indexexcel');
    }

    public function import(Request $request)
    {

        $request->validate([
            'file' => 'required|mimes:xls,xlsx'
        ]);

        // Generate a unique identifier
        $user = auth()->user();
        $uniqueString = Str::slug($user->name . '_' . uniqid());

        // Import the Excel file with the unique identifier
        Excel::import(new ExcelImport($uniqueString), $request->file('file'));

        // Redirect to a route that shows the averages
        return redirect()->route('showData', ['identifier' => $uniqueString]);
    }



    
//     public function deleteData($uniqueString)
// {
//     ExcelData::where('unique_identifier', $uniqueString)->delete();
// }

    

    

public function showData($identifier)
{
    $data = ExcelData::where('identifier', $identifier)
        ->select('season', 
        DB::raw('SUM(order_quantity) as Sum_quantity'), 
        DB::raw('AVG(fabric_cost_per_gmt) as Fabric_Cost_per_GMT'),
        DB::raw('AVG(trim_cost) as trim_cost'), 
        DB::raw('AVG(fob) as fob'), 
        DB::raw('AVG(mrp) as mrp'),)
        ->groupBy('season')
        ->get();

    // Get unique filter values
    $seasons = ExcelData::where('identifier', $identifier)->distinct()->pluck('season');
    $categories = ExcelData::where('identifier', $identifier)->distinct()->pluck('category');
    $clusters = ExcelData::where('identifier', $identifier)->distinct()->pluck('cluster');
    $subBrands = ExcelData::where('identifier', $identifier)->distinct()->pluck('sub_brand');

    return view('showdata', compact('data', 'seasons', 'categories', 'clusters', 'subBrands'));
}


public function export(Request $request)
{
    $exportData = json_decode($request->input('exportData'), true);

    // Check if there's exported data
    if (!empty($exportData)) {
        return Excel::download(new ExcelExport($exportData), 'filtered_data.xlsx');
    } else {
        return redirect()->back()->with('error', 'No data to export.');
    }
}

   
    
}
