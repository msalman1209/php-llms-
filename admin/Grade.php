<?php
function GradeCheck($score)
{
    if ($score >= 90 && $score <= 100) {
        return "A plus";
    } elseif ($score >= 80 && $score <= 89) {
        return "A";
    } elseif ($score >= 50 && $score <= 79) {
        return "B";
    } elseif ($score >= 40 && $score <= 49) {
        return "C";
    } elseif ($score >= 30 && $score <= 39) {
        return "D";
    } else {
        return "F";
    }
}