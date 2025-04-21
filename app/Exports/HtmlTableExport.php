<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use DOMDocument;

class HtmlTableExport implements FromArray
{
    protected $html;

    public function __construct(string $html)
    {
        $this->html = $html;
    }

    public function array(): array
    {
        $doc = new \DOMDocument();
        libxml_use_internal_errors(true); // to suppress HTML5 warnings
        $doc->loadHTML($this->html);
        libxml_clear_errors();

        $rows = [];
        foreach ($doc->getElementsByTagName('tr') as $tr) {
            $row = [];
            foreach ($tr->getElementsByTagName('th') as $th) {
                $row[] = trim($th->nodeValue);
            }
            foreach ($tr->getElementsByTagName('td') as $td) {
                $row[] = trim($td->nodeValue);
            }
            if (!empty($row)) {
                $rows[] = $row;
            }
        }

        return $rows;
    }
}


?>
