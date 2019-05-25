<?php

namespace App\Exports;

use App\Student;

use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\ShouldAutosize;

class StudentsExport implements FromCollection, WithMapping, WithHeadings,WithColumnFormatting,ShouldAutosize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $added_by = auth()->id();
        $studentList = Student::where('added_by', $added_by)->get();

        return $studentList;
    }

    public function map($student): array
    {
 
        return [
            $student->student_no,
            $student->last_name,
            $student->first_name,
            $student->middle_name,
            $student->gender,
            Date::dateTimeToExcel($student->birthdate),
            $student->address,
            $student->contact
        ];
    }

    public function headings(): array
    {
        return [
            'Student No.',
            'Last Name',
            'First Name',
            'Middle Name',
            'Gender',
            'Birthday',
            'Address',
            'Contact'
        ];
    }

    public function columnFormats(): array
    {
        return [
            'F' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }

}
