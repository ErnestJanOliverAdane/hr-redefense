<?php

namespace App\Http\Controllers;

use App\Models\PersonalInformationModel;
use App\Models\FamilyBackgroundModel;
use App\Models\ChildrenModel;
use App\Models\EducationalBackgroundModel;
use App\Models\CivilServiceEligibilityModel;
use App\Models\WorkExperienceModel;
use App\Models\VoluntaryWorkModel;
use App\Models\LearningDevelopmentModel;
use App\Models\OtherInformationModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Log;

class PersonalDataSheetController extends Controller
{
    public function index()
    {
        $employee = Auth::guard('employee')->user();
        $personalInfo = PersonalInformationModel::where('employee_id', $employee->employee_id)->first();
        
        if (!$personalInfo) {
            $personalInfo = PersonalInformationModel::create([
                'employee_id' => $employee->employee_id,
            ]);
        }

        return view('employee.pds.index', compact('employee', 'personalInfo'));
    }

    public function edit($personal_information_id)
    {
        $employee = Auth::user();
        $personalInfo = PersonalInformationModel::findOrFail($personal_information_id);
        return view('employee.pds.index', compact('employee', 'personalInfo'));
    }

    public function view($id)
    {
        try {
            $personalInfo = PersonalInformationModel::with([
                'familyBackground',
                'children',
                'educationalBackground',
                'civilServiceEligibility',
                'workExperience',
                'voluntaryWork',
                'learningDevelopment',
                'otherInformation'
            ])->findOrFail($id);

            return view('employee.pds.view', compact('personalInfo'));
        } catch (Exception $e) {
            Log::error('Error viewing personal data sheet: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Unable to load profile data.');
        }
    }
    
    public function store(Request $request)
    {
        try {

            $existingRecord = PersonalInformationModel::where('employee_id', auth()->guard('employee')->user()->employee_id)
             ->first();

            if ($existingRecord) {
                return redirect()->route('personal.data.sheet.update', $existingRecord->personal_information_id);
            }

            DB::beginTransaction();
            Log::info('Starting Personal Data Sheet creation transaction');

            // 1. Create Personal Information
            $personalInfo = $this->createPersonalInformation($request);
            if (!$personalInfo || !$personalInfo->personal_information_id) {
                throw new Exception('Failed to create personal information record');
            }
            Log::info('Successfully created personal information with ID: ' . $personalInfo->personal_information_id);

            // 2. Create Family Background
            $this->createFamilyBackground($request, $personalInfo);
            Log::info('Successfully created family background');

            // 3. Create Children Records
            $this->createChildren($request, $personalInfo);
            Log::info('Successfully created children records');

            // 4. Create Educational Background
            $this->createEducationalBackground($request, $personalInfo);
            Log::info('Successfully created educational background');

            // 5. Create Civil Service Eligibility
            $this->createCivilServiceEligibility($request, $personalInfo);
            Log::info('Successfully created civil service eligibility');

            // 6. Create Work Experience
            $this->createWorkExperience($request, $personalInfo);
            Log::info('Successfully created work experience');

            // 7. Create Voluntary Work
            $this->createVoluntaryWork($request, $personalInfo);
            Log::info('Successfully created voluntary work');

            // 8. Create Learning Development
            $this->createLearningDevelopment($request, $personalInfo);
            Log::info('Successfully created learning development');

            // 9. Create Other Information
            $this->createOtherInformation($request, $personalInfo);
            Log::info('Successfully created other information');

            DB::commit();
            Log::info('Successfully committed all Personal Data Sheet records');

            return redirect()->back()->with('success', 'Personal Data Sheet submitted successfully!');

        } catch (Exception $e) {
            DB::rollback();
            Log::error('Error in personal data sheet creation: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());

            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'An error occurred while saving your data. Please try again. Error details: ' . $e->getMessage()]);
        }
    }

    private function createPersonalInformation(Request $request)
    {
        try {
            $personalInfoData = [
                'employee_id' => auth()->guard('employee')->user()->employee_id,
                'surname' => $request->surname ?? '',
                'first_name' => $request->first_name ?? '',
                'middle_name' => $request->middle_name,
                'name_extension' => $request->name_extension,
                'date_of_birth' => $request->date_of_birth,
                'place_of_birth' => $request->place_of_birth,
                'sex' => $request->sex,
                'civil_status' => $request->civil_status,
                'height' => $request->height,
                'weight' => $request->weight,
                'blood_type' => $request->blood_type,
                'gsis_no' => $request->gsis_no,
                'pagibig_no' => $request->pagibig_no,
                'philhealth_no' => $request->philhealth_no,
                'sss_no' => $request->sss_no,
                'tin_no' => $request->tin_no,
                'agency_employee_no' => $request->agency_employee_no,
                'citizenship' => $request->citizenship,
                'citizenship_type' => $request->citizenship_type,
                'residential_address' => $request->residential_address,
                'residential_zip_code' => $request->residential_zip_code,
                'permanent_address' => $request->permanent_address,
                'permanent_zip_code' => $request->permanent_zip_code,
                'telephone_no' => $request->telephone_no,
                'mobile_no' => $request->mobile_no,
                'email' => $request->email
            ];

            $personalInfo = PersonalInformationModel::create($personalInfoData);
            $personalInfo->refresh();

            if (!$personalInfo || !$personalInfo->personal_information_id) {
                throw new Exception('Failed to create personal information record');
            }

            Log::info('Created personal information with ID: ' . $personalInfo->personal_information_id);
            return $personalInfo;

        } catch (Exception $e) {
            Log::error('Error creating personal information: ' . $e->getMessage());
            throw $e;
        }
    }

    private function createFamilyBackground(Request $request, PersonalInformationModel $personalInfo)
    {
        try {
            $personalInfoExists = PersonalInformationModel::find($personalInfo->personal_information_id);
            if (!$personalInfoExists) {
                throw new Exception('Referenced personal information record does not exist');
            }

            $familyBackgroundData = [
                'personal_information_id' => $personalInfo->personal_information_id,
                'spouse_surname' => $request->spouse_surname,
                'spouse_first_name' => $request->spouse_first_name,
                'spouse_middle_name' => $request->spouse_middle_name,
                'spouse_name_extension' => $request->spouse_name_extension,
                'spouse_occupation' => $request->spouse_occupation,
                'spouse_employer' => $request->spouse_employer,
                'spouse_business_address' => $request->spouse_business_address,
                'spouse_telephone' => $request->spouse_telephone,
                'father_surname' => $request->father_surname,
                'father_first_name' => $request->father_first_name,
                'father_middle_name' => $request->father_middle_name,
                'father_name_extension' => $request->father_name_extension,
                'mother_surname' => $request->mother_surname,
                'mother_first_name' => $request->mother_first_name,
                'mother_middle_name' => $request->mother_middle_name
            ];

            $familyBackground = FamilyBackgroundModel::create($familyBackgroundData);

            if (!$familyBackground) {
                throw new Exception('Failed to create family background record');
            }

            Log::info('Successfully created family background for personal_informations_id: ' . $personalInfo->personal_information_id);
            return $familyBackground;

        } catch (Exception $e) {
            Log::error('Error creating family background: ' . $e->getMessage());
            throw $e;
        }
    }

    private function createChildren(Request $request, PersonalInformationModel $personalInfo)
    {
        try {
            if ($request->has('children')) {
                foreach ($request->children as $child) {
                    if (!empty($child['name']) && !empty($child['dob'])) {
                        ChildrenModel::create([
                            'personal_information_id' => $personalInfo->personal_information_id,
                            'name' => $child['name'],
                            'date_of_birth' => $child['dob']
                        ]);
                    }
                }
            }
        } catch (Exception $e) {
            Log::error('Error creating children records: ' . $e->getMessage());
            throw $e;
        }
    }

    private function createEducationalBackground(Request $request, PersonalInformationModel $personalInfo)
    {
        try {
            $educationLevels = [
                'elementary' => 'Elementary',
                'secondary' => 'Secondary',
                'vocational' => 'Vocational',
                'college' => 'College'
            ];

            foreach ($educationLevels as $requestKey => $dbValue) {
                if ($request->has($requestKey . '_school')) {
                    EducationalBackgroundModel::create([
                        'personal_information_id' => $personalInfo->personal_information_id,
                        'level' => $dbValue,
                        'school_name' => $request->{$requestKey . '_school'},
                        'degree_course' => $request->{$requestKey . '_degree'},
                        'period_from' => $request->{$requestKey . '_from'},
                        'period_to' => $request->{$requestKey . '_to'},
                        'highest_level_earned' => $request->{$requestKey . '_highest_level'},
                        'year_graduated' => $request->{$requestKey . '_year_graduated'},
                        'academic_honors' => $request->{$requestKey . '_honors'}
                    ]);
                }
            }
        } catch (Exception $e) {
            Log::error('Error creating educational background: ' . $e->getMessage());
            throw $e;
        }
    }

    private function createCivilServiceEligibility(Request $request, PersonalInformationModel $personalInfo)
    {
        try {
            if ($request->has('eligibility')) {
                foreach ($request->eligibility as $key => $eligibility) {
                    CivilServiceEligibilityModel::create([
                        'personal_information_id' => $personalInfo->personal_information_id,
                        'eligibility' => $eligibility,
                        'rating' => $request->rating[$key],
                        'exam_date' => $request->exam_date[$key],
                        'exam_place' => $request->exam_place[$key],
                        'license_number' => $request->license_number[$key],
                        'release_date' => $request->release_date[$key]
                    ]);
                }
            }
        } catch (Exception $e) {
            Log::error('Error creating civil service eligibility: ' . $e->getMessage());
            throw $e;
        }
    }

    private function createWorkExperience(Request $request, PersonalInformationModel $personalInfo)
    {
        try {
            Log::info('Entire Request Data:', ['request' => $request->all()]);

            if ($request->has('work')) {
                $workData = $request->work;
                Log::info('Work Data:', ['work_data' => $workData]);

                $entries = isset($workData['position_title']) ? count($workData['position_title']) : 0;

                for ($i = 0; $i < $entries; $i++) {
                    try {
                        $workExperience = [
                            'personal_information_id' => $personalInfo->personal_information_id,
                            'position_title' => $work['position_title'][$i] ?? 'N/A',
                            'department' => $work['department'][$i] ?? 'N/A',
                            'monthly_salary' => $work['monthly_salary'][$i] ?? 0,
                            'salary_grade' => $work['salary_grade'][$i] ?? 'N/A',
                            'status_of_appointment' => $work['status_of_appointment'][$i] ?? 'N/A',
                            'govt_service' => $work['gov_service'][$i] ?? 'N/A',
                            'from_date' => $work['from_date'][$i] ?? now()->toDateString(),
                            'to_date' => $work['to_date'][$i] ?? now()->toDateString()
                        ];

                        Log::info('Creating Work Experience:', $workExperience);

                        WorkExperienceModel::create($workExperience);
                    } catch (Exception $e) {
                        Log::error('Error creating individual work experience:', [
                            'index' => $i,
                            'error' => $e->getMessage(),
                            'work_data' => $workData
                        ]);
                        throw $e;
                    }
                }
            }
        } catch (Exception $e) {
            Log::error('Error in createWorkExperience function:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }
    private function createVoluntaryWork(Request $request, PersonalInformationModel $personalInfo)
    {
        try {
            if ($request->has('voluntary')) {
                foreach ($request->voluntary['organization_name'] as $key => $org) {
                    if (!empty($org)) {
                        VoluntaryWorkModel::create([
                            'personal_information_id' => $personalInfo->personal_information_id,
                            'organization_name' => $org,
                            'organization_address' => $request->voluntary['organization_address'][$key] ?? 'N/A',
                            'position' => $request->voluntary['position'][$key] ?? 'N/A',
                            'hours' => $request->voluntary['number_of_hours'][$key] ?? 0,
                            'from_date' => $request->voluntary['from_date'][$key] ?? now()->toDateString(),
                            'to_date' => $request->voluntary['to_date'][$key] ?? now()->toDateString()
                        ]);
                    }
                }
                Log::info('Successfully created voluntary work records for personal_informations_id: ' . $personalInfo->id);
            }
        } catch (Exception $e) {
            Log::error('Error creating voluntary work: ' . $e->getMessage());
            throw $e;
        }
    }


    private function createLearningDevelopment(Request $request, PersonalInformationModel $personalInfo)
    {
        try {
            if ($request->has('learning')) {
                foreach ($request->learning['title'] as $key => $title) {
                    if (!empty($title)) {
                        LearningDevelopmentModel::create([
                            'personal_information_id' => $personalInfo->personal_information_id,
                            'title' => $title,
                            'from_date' => $request->learning['from_date'][$key] ?? null,
                            'to_date' => $request->learning['to_date'][$key] ?? null,
                            'hours' => $request->learning['number_of_hours'][$key] ?? null, 
                            'type' => $request->learning['type_of_ld'][$key] ?? null, 
                            'conducted_by' => $request->learning['conducted_by'][$key] ?? null
                        ]);
                    }
                }
            }
        } catch (Exception $e) {
            Log::error('Error creating learning development: ' . $e->getMessage());
            throw $e;
        }
    }
    private function createOtherInformation(Request $request, PersonalInformationModel $personalInfo)
    {
        try {
            if ($request->has('other')) {
                foreach ($request->other['special_skills'] as $key => $skill) {
                    OtherInformationModel::create([
                        'personal_information_id' => $personalInfo->personal_information_id,
                        'special_skills' => $skill,
                        'distinctions' => $request->other['distinctions'][$key],
                        'membership' => $request->other['membership'][$key]
                    ]);
                }
            }
        } catch (Exception $e) {
            Log::error('Error creating other information: ' . $e->getMessage());
            throw $e;
        }
    }
    public function validateForm(Request $request)
    {
        return $request->validate([
            'surname' => 'required|string|max:100',
            'first_name' => 'required|string|max:100',
            'middle_name' => 'nullable|string|max:100',
            'date_of_birth' => 'required|date',
            'place_of_birth' => 'required|string|max:255',
            'sex' => 'required|in:Male,Female',
            'civil_status' => 'required|in:Single,Married,Widowed,Separated',
            'height' => 'required|numeric|between:0,3',
            'weight' => 'required|numeric|between:0,500',
            'blood_type' => 'required|string|max:5',
            'gsis_no' => 'nullable|string|max:50',
            'pagibig_no' => 'nullable|string|max:50',
            'philhealth_no' => 'nullable|string|max:50',
            'sss_no' => 'nullable|string|max:50',
            'tin_no' => 'nullable|string|max:50',
            'agency_employee_no' => 'nullable|string|max:50',
            'citizenship' => 'required|string|max:50',
            'email' => 'required|email|max:255',
            'mobile_no' => 'required|string|max:20',

            // Family Background Validation
            'spouse_surname' => 'nullable|required_if:civil_status,Married|string|max:100',
            'spouse_first_name' => 'nullable|required_if:civil_status,Married|string|max:100',

            // Children Validation
            'children.*.name' => 'nullable|string|max:255',
            'children.*.dob' => 'nullable|date',

            // Educational Background Validation
            'elementary_school' => 'required|string|max:255',
            'elementary_year_graduated' => 'required|string|max:4',

            // Work Experience Validation in validateForm method
            'work.position_title.*' => 'nullable|string|max:255',
            'work.department.*' => 'nullable|string|max:255',
            'work.monthly_salary.*' => 'nullable|numeric',
            'work.salary_grade.*' => 'nullable|string|max:50',
            'work.status_of_appointment.*' => 'nullable|string|max:100',
            'work.gov_service.*' => 'nullable|string|max:3',
            'work.from_date.*' => 'nullable|date',
            'work.to_date.*' => 'nullable|date',

            // In validateForm method:
            'voluntary.organization_name.*' => 'required|string|max:255',
            'voluntary.organization_address.*' => 'nullable|string',
            'voluntary.from_date.*' => 'required_with:voluntary.organization_name.*|date',
            'voluntary.to_date.*' => 'required_with:voluntary.organization_name.*|date|after_or_equal:voluntary.from_date.*',
            'voluntary.number_of_hours.*' => 'nullable|numeric|min:0',
            'voluntary.position.*' => 'nullable|string|max:255',
            'voluntary.organization_address.*' => 'nullable|string|max:255',



            // Learning Development Validation
            // Add these to your existing validation rules
            'learning.from_date.*' => 'nullable|date',
            'learning.to_date.*' => 'nullable|date|after_or_equal:learning.from_date.*',

            // Other Information Validation
            'other.special_skills.*' => 'nullable|string|max:255',
            'other.distinctions.*' => 'nullable|string|max:255',
            'other.membership.*' => 'nullable|string|max:255',
        ]);
    }
    public function update(Request $request, $personal_information_id)
    {
        try {
            DB::beginTransaction();
            Log::info('Starting Personal Data Sheet update transaction for ID: ' . $personal_information_id);

            $personalInfo = PersonalInformationModel::findOrFail($personal_information_id);

            $personalInfo->update ([
                'surname' => $request->surname ?? $personalInfo->surname,
                'first_name' => $request->first_name ?? $personalInfo->first_name,
                'middle_name' => $request->middle_name,
                'name_extension' => $request->name_extension,
                'date_of_birth' => $request->date_of_birth,
                'place_of_birth' => $request->place_of_birth,
                'sex' => $request->sex,
                'civil_status' => $request->civil_status,
                'height' => $request->height,
                'weight' => $request->weight,
                'blood_type' => $request->blood_type,
                'gsis_no' => $request->gsis_no,
                'pagibig_no' => $request->pagibig_no,
                'philhealth_no' => $request->philhealth_no,
                'sss_no' => $request->sss_no,
                'tin_no' => $request->tin_no,
                'agency_employee_no' => $request->agency_employee_no,
                'citizenship' => $request->citizenship,
                'citizenship_type' => $request->citizenship_type,
                'residential_address' => $request->residential_address,
                'residential_zip_code' => $request->residential_zip_code,
                'permanent_address' => $request->permanent_address,
                'permanent_zip_code' => $request->permanent_zip_code,
                'telephone_no' => $request->telephone_no,
                'mobile_no' => $request->mobile_no,
                'email' => $request->email
            ]);

            // Update Family Background
            if ($familyBackground = $personalInfo->familyBackground) {
                $familyBackground->update([
                    'spouse_surname' => $request->spouse_surname,
                    'spouse_first_name' => $request->spouse_first_name,
                    'spouse_middle_name' => $request->spouse_middle_name,
                    'spouse_name_extension' => $request->spouse_name_extension,
                    'spouse_occupation' => $request->spouse_occupation,
                    'spouse_employer' => $request->spouse_employer,
                    'spouse_business_address' => $request->spouse_business_address,
                    'spouse_telephone' => $request->spouse_telephone,
                    'father_surname' => $request->father_surname,
                    'father_first_name' => $request->father_first_name,
                    'father_middle_name' => $request->father_middle_name,
                    'father_name_extension' => $request->father_name_extension,
                    'mother_surname' => $request->mother_surname,
                    'mother_first_name' => $request->mother_first_name,
                    'mother_middle_name' => $request->mother_middle_name,
                    'mother_maiden_name' => $request->mother_maiden_name
                ]);

            } else {

                $personalInfo->familyBackground()->create([
                    'spouse_surname' => $request->spouse_surname,
                    'spouse_first_name' => $request->spouse_first_name,
                    'spouse_middle_name' => $request->spouse_middle_name,
                    'spouse_name_extension' => $request->spouse_name_extension,
                    'spouse_occupation' => $request->spouse_occupation,
                    'spouse_employer' => $request->spouse_employer,
                    'spouse_business_address' => $request->spouse_business_address,
                    'spouse_telephone' => $request->spouse_telephone,
                    'father_surname' => $request->father_surname,
                    'father_first_name' => $request->father_first_name,
                    'father_middle_name' => $request->father_middle_name,
                    'father_name_extension' => $request->father_name_extension,
                    'mother_surname' => $request->mother_surname,
                    'mother_first_name' => $request->mother_first_name,
                    'mother_middle_name' => $request->mother_middle_name,
                    'mother_maiden_name' => $request->mother_maiden_name
                ]);
            }

            // Update Children
            if ($request->has('children')) {
                // Delete existing children records
                $personalInfo->children()->delete();

                // Create new children records
                foreach ($request->children as $child) {
                    if (!empty($child['name']) && !empty($child['dob'])) {
                        $personalInfo->children()->create([
                            'name' => $child['name'],
                            'date_of_birth' => $child['dob']
                        ]);
                    }
                }
            }

            $personalInfo->educationalBackground()->delete();
            $educationLevels = [
                'elementary' => 'Elementary',
                'secondary' => 'Secondary',
                'vocational' => 'Vocational',
                'college' => 'College'
            ];

            // Add logging to see what data we're receiving
            Log::info('Educational Background Request Data:', [
                'elementary_school' => $request->elementary_school,
                'secondary_school' => $request->secondary_school,
                'vocational_school' => $request->vocational_school,
                'college_school' => $request->college_school,
            ]);

            foreach ($educationLevels as $requestKey => $dbValue) {
                $schoolField = $requestKey . '_school';
                
                // Log the specific field we're checking
                Log::info("Checking for {$schoolField}: " . ($request->has($schoolField) ? 'exists' : 'does not exist'));
                
                if ($request->filled($schoolField)) { // Use filled instead of has to check for non-empty values
                    try {
                        $educRecord = $personalInfo->educationalBackground()->create([
                            'level' => $dbValue,
                            'school_name' => $request->{$requestKey . '_school'},
                            'degree_course' => $request->{$requestKey . '_degree'},
                            'period_from' => $request->{$requestKey . '_from'},
                            'period_to' => $request->{$requestKey . '_to'},
                            'highest_level_earned' => $request->{$requestKey . '_highest_level'},
                            'year_graduated' => $request->{$requestKey . '_year_graduated'},
                            'academic_honors' => $request->{$requestKey . '_honors'}
                        ]);
                        
                        // Log successful creation
                        Log::info("Created educational record for level {$dbValue}", [
                            'record_id' => $educRecord->id,
                            'school_name' => $educRecord->school_name
                        ]);
                    } catch (\Exception $e) {
                        // Log any errors during creation
                        Log::error("Error creating educational record for level {$dbValue}: " . $e->getMessage());
                        throw $e;
                    }
                }
            }

                    // Verify the records were created
                    $verifyRecords = $personalInfo->fresh()->educationalBackground;
                    Log::info('Educational records after update:', [
                        'count' => $verifyRecords->count(),
                        'records' => $verifyRecords->toArray()
                    ]);

            // Update Civil Service Eligibility
            if ($request->has('eligibility')) {
                // Delete existing eligibility records
                $personalInfo->civilServiceEligibility()->delete();

                foreach ($request->eligibility as $key => $eligibility) {
                    $personalInfo->civilServiceEligibility()->create([
                        'eligibility' => $eligibility,
                        'rating' => $request->rating[$key],
                        'exam_date' => $request->exam_date[$key],
                        'exam_place' => $request->exam_place[$key],
                        'license_number' => $request->license_number[$key],
                        'release_date' => $request->release_date[$key]
                    ]);
                }
            }

            // Update Work Experience
            if ($request->has('work')) {
                // Delete existing work experience records
                $personalInfo->workExperience()->delete();

                foreach ($request->work['position_title'] as $key => $position) {
                    $personalInfo->workExperience()->create([
                        'position_title' => $position,
                        'department' => $request->work['department'][$key],
                        'monthly_salary' => $request->work['monthly_salary'][$key],
                        'salary_grade' => $request->work['salary_grade'][$key],
                        'status_of_appointment' => $request->work['status_of_appointment'][$key],
                        'govt_service' => $request->work['gov_service'][$key],
                        'from_date' => $request->work['from_date'][$key],
                        'to_date' => $request->work['to_date'][$key]
                    ]);
                }
            }

            // Update Voluntary Work
            if ($request->has('voluntary')) {
                // Delete existing voluntary work records
                $personalInfo->voluntaryWork()->delete();

                foreach ($request->voluntary['organization_name'] as $key => $org) {
                    if (!empty($org)) {
                        $personalInfo->voluntaryWork()->create([
                            'organization_name' => $org,
                            // 'organization_address' => $request->voluntary['organization_address'][$key],
                            'position' => $request->voluntary['position'][$key],
                            'hours' => $request->voluntary['number_of_hours'][$key],
                            'from_date' => $request->voluntary['from_date'][$key],
                            'to_date' => $request->voluntary['to_date'][$key]
                        ]);
                    }
                }
            }

            // Update Learning Development
            if ($request->has('learning')) {
                // Delete existing learning development records
                $personalInfo->learningDevelopment()->delete();

                foreach ($request->learning['title'] as $key => $title) {
                    if (!empty($title)) {
                        $personalInfo->learningDevelopment()->create([
                            'title' => $title,
                            'from_date' => $request->learning['from_date'][$key],
                            'to_date' => $request->learning['to_date'][$key],
                            'hours' => $request->learning['number_of_hours'][$key],
                            'type' => $request->learning['type_of_ld'][$key],
                            'conducted_by' => $request->learning['conducted_by'][$key]
                        ]);
                    }
                }
            }

            // Update Other Information
            if ($request->has('other')) {
                // Delete existing other information records
                $personalInfo->otherInformation()->delete();

                foreach ($request->other['special_skills'] as $key => $skill) {
                    $personalInfo->otherInformation()->create([
                        'special_skills' => $skill,
                        'distinctions' => $request->other['distinctions'][$key],
                        'membership' => $request->other['membership'][$key]
                    ]);
                }
            }

            DB::commit();
            Log::info('Successfully updated Personal Data Sheet records for ID: ' . $personal_information_id);

            return redirect()->back()->with('success', 'Personal Data Sheet updated successfully!');

        } catch (Exception $e) {
            DB::rollback();
            Log::error('Error in personal data sheet update: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());

            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'An error occurred while updating your data. Please try again. Error details: ' . $e->getMessage()]);
        }
    }
}