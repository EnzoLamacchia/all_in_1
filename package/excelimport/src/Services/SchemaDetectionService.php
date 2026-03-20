<?php

namespace Elamacchia\Excelimport\Services;

use Maatwebsite\Excel\Facades\Excel;

class SchemaDetectionService
{
    public function detectSchema($file)
    {
        $data = Excel::toArray([], $file)[0];

        $header = array_shift($data);

        $schema = [];
        $nr_col=0;
        foreach ($header as $column) {
//            dd($column);
            $schema[$column] = $this->detectColumnType($data, $nr_col);
            $nr_col=$nr_col+1;
        }
//        dd($schema);
        return $schema;
    }

    protected function detectColumnType($data, $columnIndex)
    {
//        dd($data,$columnIndex);
        $values = array_column($data, $columnIndex);
//dd($values);
        $numericCount = 0;
        $dateCount = 0;

        foreach ($values as $value) {
            if (is_numeric($value)) {
                $numericCount++;
            } elseif (strtotime($value) !== false) {
                $dateCount++;
            }
        }

        $totalCount = count($values);
        if ($numericCount / $totalCount > 0.8) {
            return 'numeric';
        } elseif ($dateCount / $totalCount > 0.8) {
            return 'date';
        }
        return 'string';
    }
}

