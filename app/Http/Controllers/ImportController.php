<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Throwable;

class ImportController extends Controller
{
    public function form()
    {
        return view('import.form');
    }

    public function upload(Request $request)
    {
        $data = $request->validate([
            'entity' => 'required|in:patients,users,medicines',
            'file'   => 'required|file|mimetypes:text/plain,text/csv,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet|max:5120',
        ]);

        try {
            // Dynamic class loading with existence check
            $importerClass = $this->getImporterClass($data['entity']);
            
            if (!class_exists($importerClass)) {
                return back()->with('error', "Import class for {$data['entity']} not found. Please create {$importerClass}");
            }
            
            $importer = new $importerClass();
            Excel::import($importer, $request->file('file'));

            $entityName = ucfirst($data['entity']);
            return back()->with('success', "{$entityName} import completed successfully.");
            
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            $errors = [];
            
            foreach ($failures as $failure) {
                $errors[] = "Row {$failure->row()}: " . implode(', ', $failure->errors());
            }
            
            return back()->with('error', 'Import validation failed: ' . implode(' | ', $errors));
            
        } catch (Throwable $e) {
            report($e);
            
            return back()->with('error', 'Import failed: ' . $e->getMessage());
        }
    }

    /**
     * Get the importer class name based on entity
     */
    private function getImporterClass(string $entity): string
    {
        $classMap = [
            'patients'  => 'App\\Imports\\PatientsImport',
            'users'     => 'App\\Imports\\UsersImport', 
            'medicines' => 'App\\Imports\\MedicinesImport',
        ];

        return $classMap[$entity] ?? throw new \InvalidArgumentException("No importer found for entity: {$entity}");
    }

    public function template(string $entity)
    {
        if (!in_array($entity, ['patients', 'users', 'medicines'])) {
            abort(404, 'Template not found');
        }

        $templates = [
            'patients' => [
                'headers' => ['name', 'dob', 'gender', 'address', 'phone'],
                'sample'  => ['Juan Dela Cruz', '1990-01-01', 'Male', 'Sample address', '09123456789']
            ],
            'users' => [
                'headers' => ['name', 'email', 'role', 'password'],
                'sample'  => ['Nurse A', 'nurse.a@medicore.local', 'Staff', 'password123']
            ],
            'medicines' => [
                'headers' => ['name', 'category', 'quantity', 'min_level', 'expiry_date'],
                'sample'  => ['Paracetamol', 'Analgesic', '200', '50', '2026-01-01']
            ],
        ];

        $template = $templates[$entity];
        
        return response()->streamDownload(function() use ($template) {
            $csvContent = implode(',', $template['headers']) . "\n";
            $csvContent .= implode(',', $template['sample']) . "\n";
            echo $csvContent;
        }, "{$entity}_template.csv", [
            'Content-Type' => 'text/csv',
        ]);
    }
}