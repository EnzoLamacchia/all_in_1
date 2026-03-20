<?php

namespace Elamacchia\Excelimport\Http\Controllers;

use Illuminate\Http\Request;
use Elamacchia\Excelimport\Services\TableManagementService;
use App\Http\Controllers\Controller;

class ImportedDataController extends Controller
{
    protected $tableManagementService;

    public function __construct(TableManagementService $tableManagementService)
    {
        $this->tableManagementService = $tableManagementService;
    }

    public function index()
    {
        $tables = $this->tableManagementService->getAllTables();
        return view('excel-import::tables_list', compact('tables'));
    }

    public function destroy($tableName)
    {
        $this->tableManagementService->deleteTable($tableName);
        return redirect()->route('excel-import.tables.index')->with('success', 'Tabella eliminata con successo.');
    }

    public function edit($tableName, $id)
    {
        $record = $this->tableManagementService->getRecord($tableName, $id);
        $columns = $this->tableManagementService->getTableColumns($tableName);
        return view('excel-import::edit_record', compact('record', 'columns', 'tableName', 'id'));
    }

    public function update(Request $request, $tableName, $id)
    {
        $data = $request->except(['_token', '_method']);
        $this->tableManagementService->updateRecord($tableName, $id, $data);
        return redirect()->route('excel-import.result', ['table' => $tableName])->with('success', 'Record aggiornato con successo.');
    }
}
