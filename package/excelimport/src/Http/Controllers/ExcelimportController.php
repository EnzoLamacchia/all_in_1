<?php

namespace Elamacchia\Excelimport\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Elamacchia\Excelimport\Imports\FlexibleExcelimport;
use Elamacchia\Excelimport\Services\SchemaDetectionService;
use Elamacchia\Excelimport\Services\TableManagementService;
use App\Http\Controllers\Controller;

class ExcelimportController extends Controller
{
    protected $schemaDetectionService;
    protected $tableManagementService;

    public function __construct(SchemaDetectionService $schemaDetectionService, TableManagementService $tableManagementService)
    {
        $this->schemaDetectionService = $schemaDetectionService;
        $this->tableManagementService = $tableManagementService;
    }

    public function showImportForm()
    {
        return view('excelimport::import');
    }

    public function import(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|mimes:xlsx,xls',
        ]);

        $file = $request->file('excel_file');
            // dd($request);
        $detectedSchema = $this->schemaDetectionService->detectSchema($file);
        $existingTable = $this->tableManagementService->findMatchingTable($detectedSchema);

        if ($existingTable) {
            return view('excelimport::confirm_overwrite', [
                'tableName' => $existingTable,
                'schema' => $detectedSchema
            ]);
        }

        return $this->processImport($file, $detectedSchema);
    }

    public function confirmOverwrite(Request $request)
    {
        $file = $request->file('excel_file');
        $tableName = $request->input('table_name');
        $schema = json_decode($request->input('schema'), true);

        $this->tableManagementService->truncateTable($tableName);
        return $this->processImport($file, $schema, $tableName);
    }

    protected function processImport($file, $schema, $tableName = null)
    {
        if (!$tableName) {
            $tableName = $this->tableManagementService->createTable($schema);
        }

        $import = new FlexibleExcelimport($tableName, $schema);
//        dd($im/ort);
        Excel::import($import, $file);

        return redirect()->route('excelimport.result', ['table' => $tableName])
            ->with('success', 'File importato con successo!');
    }

    public function showResult(Request $request)
    {
        $tableName = $request->query('table');
        $importedData = $this->tableManagementService->getTableData($tableName);
        $columns = $this->tableManagementService->getTableColumns($tableName);

        return view('excel-import::result', compact('importedData', 'columns', 'tableName'));
    }
}
