<?php

namespace App\Exports;

use App\Necesidad;
use Maatwebsite\Excel\Concerns\FromCollectoin;

class NecesidadesExport implements FromCollection
{
	public function collection()
	{
		return Necesidad::all();
	}
}

