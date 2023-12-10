<?php

namespace App\Libraries;


use CodeIgniter\HTTP\Files\UploadedFile;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PHPUnit\Framework\Constraint\StringMatchesFormatDescription;
use function PHPUnit\Framework\matches;

class SpreadSheetFileReader
{
    /**
     * @param UploadedFile $file
     * @param array $headers
     *
     * @return false|array
     */
    public static function readCsvFile(UploadedFile $file, array $headers)
    {
        $csvData = [];

        // Check is the file is valid and text/csv type
        if (!$file->isValid() || $file->getClientMimeType() !== 'text/csv') return false;


        if (($handle = fopen($file->getTempName(), "r")) === false) return false;

        $fileHeaders = fgetcsv($handle, 1000, ",");

        // Check if all elements in $headers are present in $fileHeader
        $diff = array_diff($headers, $fileHeaders);
        if (!empty($diff)) return false;


        while (($data = fgetcsv($handle, 1000, ",")) !== false) {
            $row = array_combine($fileHeaders, $data);
            $csvData[] = $row;
        }

        fclose($handle);

        return $csvData;
    }

    /**
     * @param UploadedFile $file
     * @param array $headers
     * @return array|false
     * @throws Exception
     */
    public static function readExcelFile(UploadedFile $file, array $headers)
    {
        // Check is the file is excel type
        if (!in_array($file->getClientMimeType(), ['application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'])) return false;

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
        if (count($diff) !== 0) return false;

        // Get the highest row that contains data
        $highestRow = $worksheet->getHighestDataRow();
        $highestColumn = $worksheet->getHighestDataColumn();

        // Get all rows from the worksheet
        $rows = $worksheet->rangeToArray("A2:$highestColumn$highestRow" );

        foreach ($rows as $row) {
            $excelData[] = array_combine($fileHeaders, $row);
        }

        return $excelData;
    }

    /**
     * @param UploadedFile $file
     * @param array $array
     * @return array|false
     * @throws Exception
     */
    public static function readFile(UploadedFile $file, array $array)
    {
        // Check is the file is valid
        if (!$file->isValid()) return false;

        $mimeType = $file->getClientMimeType();

        // read csv file
        if ($mimeType === 'text/csv') {
            return self::readCsvFile($file, $array);
        }

        // read xls file
        if (in_array($mimeType, ['application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'])) {
            return self::readExcelFile($file, $array);
        }

        return false;
    }
}
