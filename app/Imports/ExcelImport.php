<?php

namespace App\Imports;

use App\Models\Course;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ExcelImport implements ToCollection, WithHeadingRow
{



    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {



            // Teacher::create([]);

            // Get numbers in string
            dd($row[22]);
            $locationid = filter_var($row[22], FILTER_SANITIZE_NUMBER_INT);


            Course::create([
                'course_id' => $row[0],
                'name' => $row[2],
                'location_id' => $locationid,
                'times' => $row[71] . "-" . $row[72],
                'teacher_id' => $row[9], // کد پرسنلی
                'students_count' => $row[49],
                'group' => $row[59],
                'term_id' => $row[54],
                'status' => 'enabled',
                'level' => $row[63]
            ]);
        }
    }
}
