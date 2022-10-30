<?php

declare(strict_types = 1);

namespace App\Charts;

use App\Models\Ot;
use App\Models\Unite;
use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;

class OtChart extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $unitesName = Unite::pluck('name')->toArray();
        $unites = Unite::with('moteurs')->get();

        foreach($unites as $unite){
            $ot = 0;
            foreach($unite->moteurs as $moteur){
                $ot = $moteur->ots->count();
            }
            $ots[] = $ot;
            
            $moteurs[] = $unite->name;
        }

        //$ots = Unite::with('moteurs')->count()->toArray();
        
        return Chartisan::build()
            ->labels($moteurs)
            ->dataset('Sample', $ots);
            //->dataset('Sample 2', [3, 2, 1]);
    }
}