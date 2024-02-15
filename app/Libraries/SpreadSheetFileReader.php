<?php

namespace App\Libraries;

use CodeIgniter\HTTP\Files\UploadedFile;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class SpreadSheetFileReader
{
    /**
     * @return array|false
     * @throws Exception
     */
    public static function readCsvFile(UploadedFile $file, array $headers)
    {
        $csvData = [];

        // Check is the file is valid and text/csv type
        if (!$file->isValid() || $file->getClientMimeType() !== 'text/csv') {
            throw new Exception('Invalid file');
        }

        if (($handle = fopen($file->getTempName(), 'rb')) === false) {
            throw new Exception('Error opening file');
        }

        $fileHeaders = fgetcsv($handle, 1000, ',');

        // Check if all elements in $headers are present in $fileHeader
        $diff = array_diff($headers, $fileHeaders);
        if (!empty($diff)) {
            throw new Exception('The headers do not match');
        }

        while (($data = fgetcsv($handle, 1000, ',')) !== false) {
            $row = array_combine($fileHeaders, $data);
            $csvData[] = $row;
        }

        fclose($handle);

        return $csvData;
    }

    /**
     * @return array|false
     *
     * @throws Exception
     */
    public static function readExcelFile(UploadedFile $file, array $headers)
    {
        // Check is the file is excel type
        if (!in_array($file->getClientMimeType(), ['application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'], true)) {
            return false;
        }

        // Load the spreadsheet reader library
        $spreadsheet = new Xlsx();

        // Get the first worksheet
        $worksheet = $spreadsheet->load($file->getTempName())->getActiveSheet();

        $excelData = [];

        // check fileHeaders
        $fileHeaders = $worksheet->rangeToArray('A1:' . $worksheet->getHighestColumn() . '1', null, true, true, true)[1];

        // Check if all elements in $headers are present in $fileHeader
        $diff = array_diff($headers, $fileHeaders);

        // If $diff is not an empty array, return false
        if (count($diff) !== 0) {
            return false;
        }

        // Get the highest row that contains data
        $highestRow = $worksheet->getHighestDataRow();
        $highestColumn = $worksheet->getHighestDataColumn();

        // Get all rows from the worksheet
        $rows = $worksheet->rangeToArray("A2:{$highestColumn}{$highestRow}");

        foreach ($rows as $row) {
            $excelData[] = array_combine($fileHeaders, $row);
        }

        return $excelData;
    }

    /**
     * @throws \Exception
     */
    public static function readFile(UploadedFile $file, array $expectedHeaders): array
    {
        // Check is the file is valid
        if (!$file->isValid()) {
            throw new \Exception('The file is not valid');
        }

        // Load the file using PhpSpreadsheet's IOFactory
        $spreadsheet = IOFactory::load($file->getPathname());

        // Get the active sheet
        $sheet = $spreadsheet->getActiveSheet();

        // Read the headers from the first row of the sheet
        $actualHeaders = [];

        for ($col = 'A'; $col <= $sheet->getHighestColumn(); $col++) {
            $actualHeaders[] = $sheet->getCell($col . '1')->getValue();
        }

        $diff = array_diff($expectedHeaders, $actualHeaders);
        // Check if the actual headers match the expected headers
        if (count($diff) !== 0) {
            // The headers do not match, return false or handle the error as needed
            throw new \Exception('The headers do not match');
        }

        // The headers match, continue processing the file
        $data = [];

        for ($row = 2; $row <= $sheet->getHighestRow(); $row++) {
            // Read the data from the current row and add it to the data array
            $rowData = [];

            foreach ($actualHeaders as $index => $header) {
                $rowData[$header] = $sheet->getCell([$index + 1, $row])->getValue();
            }
            $data[] = $rowData;
        }

        return $data;
    }
}
