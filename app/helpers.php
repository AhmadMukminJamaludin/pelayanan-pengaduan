<?php

use App\Models\Aduan;

if (!function_exists('generateNoTracking')) {
    function generateNoTracking(): string
    {
        $no = 1;
        $prefix = date('Ymd', strtotime(now()));

        $latest = Aduan::query()
            ->whereYear('created_at', date('Y', strtotime(now())))
            ->whereMonth('created_at', date('m', strtotime(now())))
            ->withTrashed()
            ->latest()
            ->lockForUpdate()
            ->first();

        if ($latest) {
            $no = ((int) substr($latest->no_tracking, 8)) + 1;
        }

        $infix = str_pad($no, 8, '0', STR_PAD_LEFT);

        return $prefix . $infix;
    }
}

?>
