<!DOCTYPE html>
<html lang="en">
<head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

        <title>
            Report in PDF
        </title>
        <!--     Fonts and icons     -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
        <!-- CSS Files -->
        <link href="/bootstrap-italia/css/bootstrap-italia.min.css?202101280752" rel="stylesheet">
        <link href="/assets/materialDashboard/css/material-dashboard.css" rel="stylesheet" />
        <style>
            body{
                margin:10px;
                font-family: Calibri;

            }
            H1 {
                /*font-family: Calibri;*/
                font-size: xxx-large;
                text-align: center;
            }

            H2 {
            /*font-family: Calibri;*/
            font-size: xx-large;
            text-align: center;
        }
        TABLE {
            border: 2px solid #0d47a1;
            margin: 10px;
            width: 100%;
            table-layout:fixed;
        }
        TH{
            border: 1px solid #0d47a1;
            text-align: center;
            font-size: large;
            font-weight: bold;
            color: #ffffff;
            background: #0a6ebd;
        }

        TD{
            border: 1px solid #0a6ebd;
            font-size: large;
        }

        TD.centrato{
            text-align: center;
            width: 5%;
        }

        TD.w45{
                width: 70%;
            }
        #intestazione{
            margin : auto;
        }


</style>

</head>
<body>
<div id="intestazione">
<h1>Consiglio regionale della Puglia</h1>
<h2>Report determine dirigenziali</h2>
    <div class="row">
            <div class="d-flex d-flex col-md-12 align-self-center justify-content-end">
                <a href={{"/detdir/determinazioni/report/createFilePDF?".$req}}><button class="btn btn-primary">Esporta in PDF</button></a>
            </div>
    </div>
</div>
<table id="ddrep">
    <thead>
        <th style="width:7%">Nr. Progr.</th>
        <th style="width:7%">Nr. Det.</th>
        <th style="width:10%">Data Det.</th>
        <th style="width:16%">Competenza</th>
        <th style="width:36%">Oggetto determinazione</th>
        <th style="width:7%">Nr. Impegno</th>
        <th style="width:10%">Data Impegno</th>
        <th style="width:7%">Testo</th>
    </thead>
    <tbody>
    @foreach($dds as $dd)
        <tr>
            <td class="centrato">{{$dd->NrProgr}}</td>
            <td class="centrato">{{$dd->NrDet}}</td>
            <td class="centrato">{{\Carbon\Carbon::parse($dd->DataDetD)->format('d/m/Y')}}</td>
            <td class="centrato">{{$dd->sezione}}</td>
            <td class="w45">{{$dd->Oggetto}}</td>
            <td class="centrato">{{$dd->Impegno}}</td>
            <td class="centrato">@if ($dd->DataImpegnoD) {{\Carbon\Carbon::parse($dd->DataImpegnoD)->format('d/m/Y')}} @endif</td>
            <td class="centrato">
                @if ($dd->NomeFileT_1)
                    <a href="{{$dd->storage}}" title="vai al testo">link</a>
                @else

                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
