<?php

namespace App\Imports;

use App\Models\User;
use App\Models\GradeLevel;
use Illuminate\Support\Facades\Hash;
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

class UserImport implements ToCollection
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
            //$grade = GradeLevel::where('key', $row[2])->first();

            // if ($grade) {
            //     $user = User::create([
            //         'name' => $row[0],
            //         'email' => $row[1],
            //         'grade_level_id' => $grade->id,
            //         'password' => Hash::make('Password1')
            //     ]);

            //     $this->result[] = $user;
            // }

            $user = User::create([
                'email' => $row[0],
                'name' => $row[1] . " " . $row[2],
                'password' => Hash::make('Password1')
            ]);

            $this->result[] = $user;
        }

        return $this->result;
    }
}
