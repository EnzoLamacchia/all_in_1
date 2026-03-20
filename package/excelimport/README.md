# Excel Import Package for Laravel 8

This package provides a flexible solution for importing Excel files into a MySQL database in Laravel 8 applications.

## Features

- Dynamic schema detection
- Flexible table creation and management
- Overwrite protection for existing data
- CRUD operations for imported data
- User-friendly interface for data management

## Installation

1. Install the package via Composer:
   ```
   composer require vendor-name/excel-import
   ```

2. Publish the package assets:
   ```
   php artisan vendor:publish --provider="VendorName\Excelimport\ExcelimportServiceProvider"
   ```

3. Run the migrations:
   ```
   php artisan migrate
   ```

## Usage

1. Navigate to `/excel-import` to access the import form.
2. Upload an Excel file to import.
3. If a matching table structure exists, you'll be prompted to confirm overwriting.
4. View and manage imported data through the provided interface.

## License

This package is open-sourced software licensed under the MIT license.
