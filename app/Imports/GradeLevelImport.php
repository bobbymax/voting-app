<?php

namespace App\Imports;

use App\Models\GradeLevel;
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

class GradeLevelImport implements ToCollection
{
    use Importable, SkipsErrors, SkipsFailures;

    protected $values = [];

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        foreach($rows as $row) {
            $grade = GradeLevel::create([
                'key' => $row[0],
                'name' => $row[1]
            ]);

            $this->values[] = $grade;
        }

        return $this->values;

        // dd($rows);
    }
}
