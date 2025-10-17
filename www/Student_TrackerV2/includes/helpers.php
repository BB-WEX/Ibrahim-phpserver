<?php

function validateScore($score)
{
    return is_numeric($score) && $score >= 0 && $score <= 100;
}

function formatAverage($number)
{
    return number_format($number, 0);
}

function generateUniqueId()
{
    return uniqid();
}

?>