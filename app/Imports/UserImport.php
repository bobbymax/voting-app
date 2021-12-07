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
            $emal = $row[0] == "" ? trim($row[1]) . "." . trim($row[2]) . "@ncdmb.gov.ng" : $row[0];
            $grade = $row[3] !== "" ? GradeLevel::where('key', $row[3])->first() : null;
            if ($grade) {
                $user = User::create([
                    'name' => $row[1] . " " . $row[2],
                    'email' => $row[0],
                    'grade_level_id' => $grade !== null ? $grade->id : 0,
                    'password' => Hash::make('Password1'),
                    'type' => $row[4]
                ]);

                $this->result[] = $user;
            }

            // $user = User::create([
            //     'email' => $emal,
            //     'name' => $row[1] . " " . $row[2],
            //     'password' => Hash::make('Password1'),
            //     'type' => trim($row[3])
            // ]);

            $this->result[] = $user;
        }

        return $this->result;
    }
}
