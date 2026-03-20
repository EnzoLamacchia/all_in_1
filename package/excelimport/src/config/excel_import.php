<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Table Prefix
    |--------------------------------------------------------------------------
    |
    | This value will be used as a prefix for all tables created by the package.
    | Change this if you want to use a different prefix.
    |
    */
    'table_prefix' => 'imported_',

    /*
    |--------------------------------------------------------------------------
    | Overwrite Confirmation
    |--------------------------------------------------------------------------
    |
    | If set to true, the package will always ask for confirmation before
    | overwriting existing data. If false, it will overwrite without asking.
    |
    */
    'confirm_overwrite' => true,

    /*
    |--------------------------------------------------------------------------
    | Schema Detection Threshold
    |--------------------------------------------------------------------------
    |
    | This value determines the threshold for automatic type detection.
    | For example, if 80% of values in a column are numeric, it will be
    | considered a numeric column.
    |
    */
    'schema_detection_threshold' => 0.8,

    /*
    |--------------------------------------------------------------------------
    | Maximum Rows Per Import
    |--------------------------------------------------------------------------
    |
    | This value determines the maximum number of rows that can be imported
    | in a single operation. Set to 0 for no limit.
    |
    */
    'max_rows_per_import' => 10000,
];

