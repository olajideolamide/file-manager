<?php


/**
 * Returns the first error from an error array
 *
 * @param $error array Error array usually from a validator
 *
 * @return string
 */
function singleError($error): string
{
   return array_values($error)[0];
}
