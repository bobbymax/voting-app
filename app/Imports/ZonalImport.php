<?php

namespace App\Imports;

use App\Models\Zonal;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Validators\Failure;

class ZonalImport implements ToCollection
{
    use Importable, SkipsErrors, SkipsFailures;
    
    protected $result = [];

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {

            $zone = Zonal::create([
                'name' => $row[0],
                'label' => Str::slug($row[0])
            ]);

            $this->result[] = $zone;
        }

        return $this->result;
    }
}
