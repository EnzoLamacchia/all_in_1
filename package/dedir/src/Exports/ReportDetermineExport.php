<?php

namespace Elamacchia\Dedir\Exports;

use Elamacchia\Dedir\Models\Determine;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;


class ReportDetermineExport implements FromQuery, WithHeadings
{
    public function __construct(Request $request)
    {
        $this->determine = $this->qB2Find($request)[0];
    }

    public function headings():array{
        return [
            'Nr. Progressivo',
            'Nr. Determinazione',
            'Data Determinazione',
            'Competenza',
            'Oggetto',
            'Nr. Impegno',
            'Data Impegno',
            'Pubbicato dal',
            'Pubblicato al',
        ];
    }

    public function query()
    {
        return $this->determine;
    }

    public function qB2Find($request){
        $sez = $request->input('ddCompetenza');
        $oggetto = str_replace('%', '\\%', $request->input('ddOggetto'));
        $nr = $request->input('ddNrDet');
        $year = $request->input('ddAnno');

        $startDate = $year.'-01-01';
        $endDate = $year.'-12-31';
        //dd([$sez, $year]);
        $qbPartial = Determine::query()
            ->select('NrProgr','NrDet','DataDetD','Competenza','Oggetto','Impegno','DataImpegnoD','PubbDAD','PubbAD')
            ->orderBy('id', 'DESC');
        if ($sez!=null) $qbPartial = $qbPartial->where('Competenza_Id', '=', $sez);
        if ($year!=null) $qbPartial = $qbPartial->where('DataDetD','>=',$startDate)->where('DataDetD','<=',$endDate);
        if ($oggetto!=null) $qbPartial = $qbPartial->where('Oggetto', 'LIKE', '%'.$oggetto.'%');
        if ($nr!=null) $qbPartial = $qbPartial->where('NrDet', '=', $nr);

        return [$qbPartial, $sez];
    }
}
