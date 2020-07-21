<?php

function get_years_ago($n)
{
    if (is_numeric($n) && $n > 1) {
        for ($i=0; $i <= $n; $i++) {
            $tahun_sekarang =  date('Y');
            $tahun[] = $tahun_sekarang - $i;
        }
        return $tahun;
    }
}