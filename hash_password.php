<?php

  /**
   * hash_password.php
   * Falmesino Abdul Hamid
   * 231232028
   */

  function hash_password($password, $salt, $iterasi) {
    $hash = hash_pbkdf2('sha256', $password, $salt, $iterasi, 32);
    return $hash;
  }

  // Input Password
  $password = 'rahasia';

  // Input Salt
  $salt = 'abc123';

  // Input Iterasi
  $iterasi = 1000;

  // Menghasilkan hash password
  $hash_password = hash_password($password, $salt, $iterasi);

  // Menampilkan hasil
  echo "Password: $password\n";
  echo "Salt: $salt\n";
  echo "Iterasi: $iterasi\n";
  echo "Hash Password: $hash_password\n";

?>