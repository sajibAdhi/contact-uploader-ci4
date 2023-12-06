<?php

namespace App\Libraries;


use CodeIgniter\HTTP\Files\UploadedFile;

class CsvFileReader
{
    /**
     * @param UploadedFile file
     * @param array $headers
     * 
     * @return false|array
     */
    public static function readCsvFile(UploadedFile $file, array $headers)
    {
        $csvData = [];

        if (($handle = fopen($file->getTempName(), "r")) === false) return false;

        $fileHeaders = fgetcsv($handle, 1000, ",");

        // Check if all elements in $headers are present in $fileHeader
        $diff = array_diff($headers, $fileHeaders);
        if (!empty($diff))    return false;


        while (($data = fgetcsv($handle, 1000, ",")) !== false) {
            $row = array_combine($fileHeaders, $data);
            $csvData[] = $row;
        }

        fclose($handle);

        return $csvData;
    }

    // protected UploadedFile $file;
    // protected ?array $expectedHeader;
    // public ?array $data;

    // public function __construct(UploadedFile $file)
    // {
    //     $this->file = $file;
    // }

    // public 

    // public function read()
    // {
    //     if (($handle = fopen($this->file->getTempName(), "r")) === false) return false;

    //     $fileHeaders = fgetcsv($handle, 1000, ",");

    //     // Check if all elements in $headers are present in $fileHeader
    //     $diff = array_diff($headers, $fileHeaders);
    //     if (!empty($diff))    return false;


    //     while (($data = fgetcsv($handle, 1000, ",")) !== false) {
    //         $row = array_combine($fileHeaders, $data);
    //         $csvData[] = $row;
    //     }

    //     fclose($handle);

    //     return $csvData;
    // }
}
