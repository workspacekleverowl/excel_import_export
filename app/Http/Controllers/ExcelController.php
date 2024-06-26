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

    //function to show index page and import the file
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

        try {
            // Import the Excel file with the unique identifier
            Excel::import(new ExcelImport($uniqueString), $request->file('file'));
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            // This will catch validation errors (e.g., header mismatch)
            $failures = $e->failures();
            // Redirect back with error message
            return redirect()->back()->withErrors(['file' => 'The headers in the uploaded file do not match the expected format.']);
        } catch (\Exception $e) {
            // General exception handling
            return redirect()->back()->withErrors(['file' => 'An error occurred during file upload. Please try again with different file.']);
        }

        // Redirect to a route that shows the averages
        return redirect()->route('showData', ['identifier' => $uniqueString]);
    }


//function to display analysis

    public function showData(Request $request, $identifier)
    {
                // Retrieve filter values from request, default to null
            $season = $request->input('season', null);
            $category = $request->input('category', null);
            $cluster = $request->input('cluster', null);
            $subBrand = $request->input('sub_brand', null);

            // Build the query
            $query = DB::table('excel')
                ->select(
                    DB::raw('COALESCE(season, "") as season'), // Ensure season is always present, even if null
                    DB::raw('SUM(order_quantity) as Sum_quantity'), 
                    DB::raw('AVG(fabric_cost_per_gmt) as Fabric_Cost_per_GMT'),
                    DB::raw('AVG(trim_cost) as trim_cost'), 
                    DB::raw('AVG(fob) as fob'), 
                    DB::raw('AVG(mrp) as mrp')
                )->where('identifier',$identifier);

            // Apply filters if selected
            if (!is_null($season)) {
                $query->where('season', $season);
            }
            if (!is_null($category)) {
                $query->where('Category', $category);
            }
            if (!is_null($cluster)) {
                $query->where('Cluster', $cluster);
            }
            if (!is_null($subBrand)) {
                $query->where('sub_brand', $subBrand);
            }

            // Ensure the query uses GROUP BY to allow aggregates to work
            $query->groupBy(DB::raw('COALESCE(season, "")'));

            // Get the data
            $data = $query->get();

            // Get unique filter values
            $seasons = DB::table('excel')->distinct()->pluck('season');
            $categories = DB::table('excel')->distinct()->pluck('Category');
            $clusters = DB::table('excel')->distinct()->pluck('Cluster');
            $subBrands = DB::table('excel')->distinct()->pluck('sub_brand');

            return view('showdata', compact('data', 'seasons', 'categories', 'clusters', 'subBrands','identifier'));
    }



//function to export data into excel
        public function export(Request $request,$identifier)
        {
            $exportData = json_decode($request->input('exportData'), true);

          
            // Check if there's exported data
            if (!empty($exportData))
            {
                try { return Excel::download(new ExcelExport($exportData), 'filtered_data.xlsx'); } 
                finally {$this->deleteData($identifier);}
            
            } 
            else {
                return redirect()->back()->with('error', 'No data to export.');
            }
            
           
            //return redirect()->route('indexexcel');
            
        }

    
//function to delete data of imported file after analysis        
        public function deleteData($identifier)
        {
            ExcelData::where('identifier', $identifier)->delete();
            return redirect()->route('indexexcel')->with('success', 'Uploaded excel Data deleted successfully.');
        }

  
    
}
