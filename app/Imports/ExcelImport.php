<?php

namespace App\Imports;

use App\Models\Course;
use App\Models\Teacher;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ExcelImport implements ToCollection, WithHeadingRow
{



    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {

            // Check if teacher informations filled then try to import it to DB
            if (
                !empty($row['kd_mly']) &&
                is_int($row['kd_mly']) &&
                !empty($row['nam_khanoadgy'])
            ) {
                // Check if teacher isn't already imported
                if (!Teacher::where('national_code', $row['kd_mly'])->first()) {
                    $mobile = is_int($row['mobile']) ? $row['mobile'] : null;
                    try {
                        // Insert teacher to DB
                        Teacher::create([
                            'national_code' => $row['kd_mly'],
                            'name' => $row['nam_khanoadgy'],
                            'phone' => $mobile
                        ]);
                    } catch (\Exception $e) {
                        print($e->getMessage());
                    }
                }
            }

            $locationid = filter_var($row['nam_mkan'], FILTER_SANITIZE_NUMBER_INT) or 0;
            $locationid = (is_int($locationid)) ? $locationid : 0;

            $teacher = (!empty($row['kd_mly']) && is_int($row['kd_mly'])) ? Teacher::where('national_code', $row['kd_mly'])->first(['id'])->id : null;


            try {
                Course::create([
                    'course_id' => $row['kd_drs'],
                    'teacher_id' => $teacher, # if it's null, make teacher unknown
                    'location_id' => $locationid,
                    'times' =>  $row['azsaaat'] . "-" . $row['ta_saaat'],
                    'name' => $row['nam_drs'],
                    'students_count' => $row['taadad_thbt_namy'],
                    'term_id' => $row['kd_nymsal'],
                    'group' => $row['groh'],
                    'level' => $row['mktaa'],
                    'status' => 'enabled'
                ]);
            } catch (\Exception $e) {
                print($e->getMessage());
            }
        }
    }
}
