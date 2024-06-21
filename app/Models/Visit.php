<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Visit extends Model
{
    protected $fillable = ['visit_month', 'visit_count'];

    public static function recordVisit()
    {
        // Set locale to ensure the month name is translated
        Carbon::setLocale('id'); // Adjust 'id' to your desired locale

        // Format current month to show month name and year
        $currentMonth = Carbon::now()->translatedFormat('F');

        // Find or create a new visit record for the current month
        $visit = self::firstOrNew(['visit_month' => $currentMonth]);
        $visit->visit_count = ($visit->visit_count ?? 0) + 1;
        $visit->save();
    }
}
