<?php

namespace App\Imports;

use App\Models\Category;
use App\Models\Criteria;
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

class CategoryImport implements ToCollection
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
        foreach($rows as $row) {
            $category = Category::create([
                'name' => $row[0],
                'label' => Str::slug($row[0])
            ]);

            if ($category) {
                $values = explode(",", $row[1]);

                foreach($values as $value) {
                    $label = Str::slug(trim($value));

                    $criteria = Criteria::where('label', $label)->first();

                    if (! $criteria) {
                        $criteria = Criteria::create([
                            'name' => trim($value),
                            'label' => $label
                        ]);
                    }

                    $category->criterias()->save($criteria);
                }

                $this->result[] = $category;
            }
        }

        return $this->result;
    }
}
