<?php

namespace App\Imports;

use App\Models\Category;
use App\Models\Criteria;
use App\Models\Weight;
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
                'label' => Str::slug($row[0]),
                'group' => $row[2]
            ]);

            if ($category) {
                $values = explode(",", $row[1]);

                foreach($values as $value) {
                    $crsc = explode("-", $value);
                    $label = Str::slug(trim($crsc[0]));

                    $criteria = Criteria::where('label', $label)->first();

                    if (! $criteria) {
                        $criteria = Criteria::create([
                            'name' => trim($crsc[0]),
                            'label' => $label
                        ]);
                    }

                    $weight = Weight::where('category_id', $category->id)->where('criteria_id', $criteria->id)->first();

                    if (! $weight) {
                        $weight = Weight::create([
                            'category_id' => $category->id,
                            'criteria_id' => $criteria->id,
                            'value' => (int)$crsc[1]
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
