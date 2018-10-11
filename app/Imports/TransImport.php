<?php

namespace App\Imports;


use App\Models\Trans;
use Maatwebsite\Excel\Concerns\ToModel;

class TransImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {


//        return new Trans([
//            'id_num'        => $row[0],
//            'ptrans_id'     => $row[1],
//            'itrans_id'     => $row[2],
//            'itrans_amount' => $row[3],
//        ]);
    }

}
