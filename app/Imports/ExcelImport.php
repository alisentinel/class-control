<?php

namespace App\Imports;

use App\Models\Course;
use App\Models\Teacher;
use App\Models\Location;
use App\Models\University;
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

            $teacher = (!empty($row['kd_mly']) && is_numeric($row['kd_mly'])) ? Teacher::where('national_code', $row['kd_mly'])->first(['id'])->id : null;

            // Try to get location information from location name
            // Each location name might has a number that represent class number
            // Each location name has a string that represents university name
            // If location name doesn't have any number, then it will be 0
            $class_number = filter_var($row['nam_mkan'], FILTER_SANITIZE_NUMBER_INT) or 0;
            $class_number = (is_numeric($class_number)) ? $class_number : 0;
            $university_name = preg_replace('/[0-9]+/', '', $row['nam_mkan']) or 'نامشخص';
            $university_name = (!empty($university_name)) ? $university_name : 'نامشخص';

            // Try to import university if it's not already there
            if (!University::where('name', $university_name)->first()) {
                try {
                    University::create([
                        'name' => $university_name,
                        'code' => 0
                    ]);
                } catch (\Exception $e) {
                    print($e->getMessage());
                }
            }
            $university_id = University::where('name', $university_name)->first(['id'])->id;

            // Try to import location to DB if it's not already there
            if (!Location::where('class_number', $class_number)->first()) {
                try {
                    Location::create([
                        'name' => $university_name,
                        'class_number' => $class_number,
                        'university_id' => $university_id,
                        'floor' => 0
                    ]);
                } catch (\Exception $e) {
                    print($e->getMessage());
                }
            }
            $location_id = Location::where('class_number', $class_number)->first(['id'])->id;



            try {
                Course::create([
                    'course_id' => $row['kd_drs'],
                    'teacher_id' => $teacher, # if it's null, make teacher unknown
                    'location_id' => $location_id,
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
