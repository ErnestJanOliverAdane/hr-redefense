<?php

namespace App\Exports;

use App\Models\MasterlistModel;
use Illuminate\Support\Collection;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Symfony\Component\HttpFoundation\StreamedResponse;

class EmployeesExport
{
    protected $spreadsheet;
    protected $sheet;

    public function __construct()
    {
        $this->spreadsheet = new Spreadsheet();
        $this->sheet = $this->spreadsheet->getActiveSheet();
    }

    public function download(): StreamedResponse
    {
        // Set letterhead
        $letterhead = [
            'Republic of the Philippines',
            'Province of Misamis Oriental',
            'Municipality of Tagoloan',
            'Office of the Human Resource Management',
            'LIST OF CASUAL/CONTRACTUAL PERSONNEL'
        ];

        // Add letterhead
        foreach ($letterhead as $index => $text) {
            $row = $index + 1;
            $this->sheet->setCellValue("A{$row}", $text);
            $this->sheet->mergeCells("A{$row}:F{$row}");

            // Apply center alignment to all letterhead rows
            $this->sheet->getStyle("A{$row}:F{$row}")->applyFromArray([
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER
                ]
            ]);
        }

        // Style "Republic of the Philippines"
        $this->sheet->getStyle('A1')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 14
            ]
        ]);

        // Style middle letterhead rows
        $this->sheet->getStyle('A2:A4')->applyFromArray([
            'font' => [
                'size' => 12
            ]
        ]);

        // Style "LIST OF CASUAL/CONTRACTUAL PERSONNEL"
        $this->sheet->getStyle('A5')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 12
            ]
        ]);

        // Add spacing row
        $this->sheet->setCellValue('A6', '');

        // Set headers
        $headers = [
            'Employee ID',
            'Employee Name',
            'Email Address',
            'Job Title',
            'Department/Designation',
            'Work Status'
        ];

        foreach ($headers as $key => $header) {
            $column = Coordinate::stringFromColumnIndex($key + 1);
            $this->sheet->setCellValue($column . '7', $header);
        }

        // Get data
        $data = MasterlistModel::whereIn('employment_status', ['Casual', 'Contractual'])
            ->orderBy('full_name', 'asc')
            ->get();

        // Add data rows
        $row = 8;
        foreach ($data as $item) {
            $this->sheet->setCellValue('A' . $row, $item->employee_id);
            $this->sheet->setCellValue('B' . $row, $item->full_name);
            $this->sheet->setCellValue('C' . $row, $item->contact_information);
            $this->sheet->setCellValue('D' . $row, $item->job_title);
            $this->sheet->setCellValue('E' . $row, $item->department);
            $this->sheet->setCellValue('F' . $row, $item->employment_status);
            $row++;
        }

        // Style headers
        $this->sheet->getStyle('A7:F7')->applyFromArray([
            'font' => [
                'bold' => true
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'A020F0']
            ]
        ]);

        // Auto-size columns
        foreach (range('A', 'F') as $column) {
            $this->sheet->getColumnDimension($column)->setAutoSize(true);
        }

        // Create response
        $filename = 'casual_contractual_employees_' . date('Y-m-d_H-i-s') . '.xlsx';

        return response()->stream(
            function () {
                $writer = new Xlsx($this->spreadsheet);
                $writer->save('php://output');
            },
            200,
            [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            ]
        );
    }
}