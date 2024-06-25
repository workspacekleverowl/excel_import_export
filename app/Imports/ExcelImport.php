<?php




namespace App\Imports;
use Illuminate\Support\Collection;
use App\Models\ExcelData;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow; 
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Validation\Rule;

class ExcelImport implements ToModel, WithHeadingRow
{

    public $uniqueString;

    protected $expectedHeaders = [
        'season', 'brand', 'sub_brand', 'style_code', 'order_quantity', 'gender',
        'budget', 'category', 'product', 'cluster', 'sleeve', 'body_length',
        'sleeve_length', 'width', 'shell_fabric', 'structure', 'content', 'count',
        'gsm', 'fabric_bio', 'fabric_dyeing', 'special_process_1', 'special_process_2',
        'smv', 'print_emb', 'trim_cost', 'incremental_consumptions', 'trim_fab_1',
        'rib_jacquards', 'variegated_cost', 'cpl', 'gmt_wash', 'yarn_rl_compact',
        'knitting', 'fab_bio', 'dyeing', 'compacting', 'sum', 'process_loss', 'fabric_per_kg',
        'std_consumption', 'incremental_consum', 'per_gmt_fab_cost', 'rib_consumption',
        'rib_per_kg', 'per_gmt_rib_cost', 'fabric_cost_per_gmt', 'cmt', 'emb_print',
        'thread', 'branded_trims', 'packaging_trims', 'washing', 'variegated_cost',
        'sum', 'rejection', 'finance', 'margin+oh', 'total', 'testing', 'transport',
        'fob', 'mrp', 'cost', 'min_range', 'multiple', 'percent'
    ];

    public function __construct( $uniqueString)
    {
        
        $this->uniqueString =  $uniqueString;
    }
    public function model(array $row)
    {
        
        //dd($row);
        // Define how to create a model from the Excel row data
        return new ExcelData([
           
           'season' => $row['season'],
            'brand' => $row['brand'],
            'sub_brand' => $row['sub_brand'],
            'style_code' => $row['style_code'],
            'order_quantity' => $row['order_quantity'],
            'gender' => $row['gender'],
            'budget' => $row['budget'],
            'Category' => $row['category'],
            'Product' => $row['product'],
            'Cluster' => $row['cluster'],
            'Sleeve' => $row['sleeve'],
            'Body_Length' => $row['body_length'],
            'Sleeve_Length' => $row['sleeve_length'],
            'Width' => $row['width'],
            'Shell_Fabric' => $row['shell_fabric'],
            'Structure' => $row['structure'],
            'Content' => $row['content'],
            'Count' => $row['count'],
            'Gsm' => $row['gsm'],
            'fabric_bio' => $row['fabric_bio'],
            'fabric_dyeing' => $row['fabric_dyeing'],
            'special_process_1_input' => $row['special_process_1'],
            'special_process_2_input' => $row['special_process_2'],
            'SMV' => $row['smv'],
            'print_emb' => $row['print_emb'],
            'trim_cost' => $row['trim_cost'],
            'incremental_consumptions' => $row['incremental_consumptions'],
            'trim_fab_1' => $row['trim_fab_1'],
            'rib_jacquards' => $row['rib_jacquards'],
            'variegated_cost_input' => $row['variegated_cost'],
            'cpl_input' => $row['cpl'],
            'gmt_wash' => $row['gmt_wash'],
            'yarn_rl_compact' => $row['yarn_rl_compact'],
            'knitting' => $row['knitting'],
            'fab_bio' => $row['fab_bio'],
            'dyeing' => $row['dyeing'],
            'special_process_1' => $row['special_process_1'],
            'special_process_2' => $row['special_process_2'],
            'compacting' => $row['compacting'],
            'sum_input' => $row['sum'],
            'process_loss' => $row['process_loss'],
            'CPL' => $row['cpl'],
            'fabric_per_kg' => $row['fabric_per_kg'],
            'std_consumption' => $row['std_consumption'],
            'Incremental_Consum' => $row['incremental_consum'],
            'per_gmt_fab_cost' => $row['per_gmt_fab_cost'],
            'rib_consumption' => $row['rib_consumption'],
            'rib_per_kg' => $row['rib_per_kg'],
            'per_gmt_rib_cost' => $row['per_gmt_rib_cost'],
            'fabric_cost_per_gmt' => $row['fabric_cost_per_gmt'],
            'cmt' => $row['cmt'],
            'emb_print' => $row['emb_print'],
            'Thread' => $row['thread'],
            'branded_trims' => $row['branded_trims'],
            'packaging_trims' => $row['packaging_trims'],
            'washing' => $row['washing'],
            'Variegated_Cost' => $row['variegated_cost'],
            'Sum' => $row['sum'],
            'rejection_%' => $row['rejection'] ?? null,
            'finance_%' => $row['finance'],
            'margin+oh_%' => $row['marginoh'],
            'total' => $row['total'],
            'testing' => $row['testing'],
            'transport' => $row['transport'],
            'fob' => $row['fob'],
            'mrp' => $row['mrp'],
            'cost' => $row['cost'],
            'min_range' => $row['min_range'],
            'multiple' => $row['multiple'],
            'percent' => $row['percent'],
            'identifier' => $this->uniqueString
        ]);
    }

   
   
}
