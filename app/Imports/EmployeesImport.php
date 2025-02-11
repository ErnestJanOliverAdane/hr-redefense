<?php

namespace App\Imports;

use App\Models\MasterlistModel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Facades\Log;

class EmployeesImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        try {
            // Debug log before processing
            Log::info('Raw row data received:', $row);

            // Convert array keys to lowercase and trim whitespace
            $row = array_map('trim', array_change_key_case($row, CASE_LOWER));

            // Map the data
            $mapped_data = [
                'employee_id' => $row['employee_id_number'] ?? null,
                'full_name' => $row['full_name'] ?? null,
                'last_name' => $row['last_name'] ?? null,
                'first_name' => $row['first_name'] ?? null,
                'middle_initial' => $row['middle_initial'] ?? null,
                'contact_information' => $row['contact_information'] ?? null,
                'employment_status' => $row['employment_status'] ?? null,
                'job_title' => $row['job_title'] ?? null,
                'department' => $row['department'] ?? null,
                'job_type' => $row['job_type'] ?? null,
            ];

            // Debug log after mapping
            Log::info('Mapped data:', $mapped_data);

            // Validate required fields before creation
            $required_fields = ['employee_id', 'contact_information', 'first_name', 'last_name', 'job_type'];
            foreach ($required_fields as $field) {
                if (empty($mapped_data[$field])) {
                    throw new \Exception("The {$field} field is required but was not found in the import data");
                }
            }

            // Create the model
            $model = MasterlistModel::create($mapped_data);

            // Debug log after creation
            Log::info('Model created successfully:', $model->toArray());

            return $model;

        } catch (\Exception $e) {
            Log::error('Import Error occurred: ' . $e->getMessage());
            Log::error('Raw row data:', $row);
            Log::error('Mapped data:', $mapped_data ?? []);
            throw $e;
        }
    }

    public function rules(): array
    {
        return [
            '*.employee_id_number' => 'required|string|max:255|unique:masterlist,employee_id',
            '*.full_name' => 'required|string|max:255',
            '*.last_name' => 'required|string|max:100',
            '*.first_name' => 'required|string|max:100',
            '*.middle_initial' => 'nullable|string|max:1',
            '*.contact_information' => 'required|string|max:20',
            '*.employment_status' => 'required|in:Job Order,Permanent',
            '*.job_title' => 'required|string|max:100',
            '*.department' => 'required|string|max:100',
            '*.job_type' => 'required|string|in:faculty,Staff',
        ];
    }

    public function customValidationMessages()
    {
        return [
            '*.employee_id_number.required' => 'Employee ID is required.',
            '*.employee_id_number.unique' => 'Employee ID :input already exists.',
            '*.contact_information.required' => 'Contact information is required.',
            '*.employment_status.in' => 'Employment status must be either Job Order or Permanent.',
            '*.first_name.required' => 'First name is required.',
            '*.last_name.required' => 'Last name is required.',
            '*.job_type.required' => 'Job type is required.',
            '*.job_type.in' => 'Job type must be either faculty or Staff.',
        ];
    }
}
