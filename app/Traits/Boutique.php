<?php
namespace App\Traits;


use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

Trait Boutique
{
    public function __construct()
    {

        setlocale(LC_TIME, 'French');
    }

    /**
     * @return string date de la forme mardi 12 janvier 2018
     */
    public function maDateSimple()
    {
        $hier = Carbon::yesterday()->toFormattedDateString();
        $today = Carbon::today()->toFormattedDateString();

        $dat = $this->created_at->toFormattedDateString();
        $auj = 'Aujourd\'hui à';
        $hie = 'Hier à';

        if($today == $dat)
        {
            $date = $auj.$this->created_at->format(' H:i');
        }
        elseif ($today == $hier)
        {
            $date = $hie.$this->created_at->format(' H:i');
        }
        else
        {
            $date = $this->created_at->formatLocalized('%A %d %B %Y');
        }

        return $date;
    }

    /**
     * @return string date de la forme mardi 12 janvier 2018 à 10:36
     */
    public function maDateAvecHeure()
    {
        $hier = Carbon::yesterday()->toFormattedDateString();
        $today = Carbon::today()->toFormattedDateString();

        $dat = $this->created_at->toFormattedDateString();
        $auj = 'Aujourd\'hui à';
        $hie = 'Hier à';

        if($today == $dat)
        {
            $date = $auj.$this->created_at->format(' H:i');
        }
        elseif ($today == $hier)
        {
            $date = $hie.$this->created_at->format(' H:i');
        }
        else
        {
            $date = $this->created_at->formatLocalized('%A %d %B %Y').$this->created_at->format(' H:i');
        }

        return $date;
    }

    /**
     * @return string l'heure exact de la forme 10:30
     */
    public function maDateAvecHeureSimple()
    {
        $hier = Carbon::yesterday()->toFormattedDateString();
        $today = Carbon::today()->toFormattedDateString();

        $dat = $this->created_at->toFormattedDateString();
        $auj = 'Aujourd\'hui à';
        $hie = 'Hier à';

        if($today == $dat)
        {
            $date = $this->created_at->format(' H:i');
        }
        elseif ($today == $hier)
        {
            $date = $hie.$this->created_at->format(' H:i');
        }
        else
        {
            $date = $this->created_at->formatLocalized('%A %d %B %Y').$this->created_at->format(' H:i');

           // $date = $this->created_at->format(' H:i');

        }

        return $date;
    }
}