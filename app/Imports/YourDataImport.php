<?php
// app/Imports/YourDataImport.php
namespace App\Imports;

use App\Models\YourModel;
use Maatwebsite\Excel\Concerns\ToModel;

class YourDataImport implements ToModel
{
    public function model(array $row)
    {
        return new YourModel([
            'column1' => $row[0],
            'column2' => $row[1],
            // map additional columns as needed
        ]);
    }
}
