<?php

/**
 * @file
 * Simple Salesforce ID conversion function. Converts 15 character SFIDs to 18 character variant.
 *
 */


/**
 * Convert a 15 character Salesforce ID to the 18 character variant.
 * @see https://codegolf.stackexchange.com/questions/69127/convert-salesforce-15-character-id-to-18-character
 *
 *
 * @param string $sfid
 *   Fifteen character Salesforce ID.
 *
 * @return
 *   Returns 18 character variant of SFID provided, or FALSE if an issue was encountered.
 */
function sfid15to18Conversion($sfid) {
  // Concatenation of uppercase alphabet and digits 0-5.
  $alpha = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ012345';
  // 1. Split ID into three 5-character chunks.
  $segments = str_split($sfid, 5);
  $suffix = '';
  foreach ($segments as $index => $value) {
    // 2. Reverse each chunk.
    $reversed = strrev($value);
    // 3. Replace each character in every chunk by 1 if it's uppercase or by 0 if otherwise.
    $characters = str_split($reversed, 1);
    $binary = '';
    foreach ($characters as $character) {
      $binary .= ctype_upper($character) ? 1 : 0;
    }
    // 4. For each 5-digit binary number i, get character at position i in concatenation
    // of uppercase alphabet and digits 0-5 (ABCDEFGHIJKLMNOPQRSTUVWXYZ012345).
    $position = bindec($binary);
    $suffix .= substr($alpha, $position, 1);
  }
  // 5. Append these characters, the checksum, to the original ID.
  return $sfid . $suffix;
}

