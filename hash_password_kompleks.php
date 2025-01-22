<?php

  /**
   * hash_password_kompleks.php
   * Falmesino Abdul Hamid - 231232028
   */

  // Fungsi untuk menghasilkan hash password
  function hash_password($password = '', $salt = '', $iterasi = 1) {
    return hash_pbkdf2('sha256', $password, $salt, $iterasi, 32);
  }

  // Fungsi untuk memeriksa kekuatan password
  function check_password_strength($password = '') {
    $strength = 0;
    if (strlen($password) >= 8) $strength++;
    if (preg_match("/[A-Z]/", $password)) $strength++;
    if (preg_match("/[a-z]/", $password)) $strength++;
    if (preg_match("/[0-9]/", $password)) $strength++;
    if (preg_match("/[!@#$%^&*()_+={}:;<>,.\/?]/", $password)) $strength++;
    return $strength;
  }

  // Fungsi untuk menghasilkan salt acak
  function generate_salt() {
    return bin2hex(random_bytes(16));
  }

   // Input password
  $password = $_POST['password'] ?? 'tahusumedang';

   // Input iterasi
  $iterasi = $_POST['iterasi'] ?? 1;

   // Menghasilkan salt acak
  $salt = generate_salt();

  // Menghasilkan hash password
  $hash_password = hash_password($password, $salt, $iterasi);

   // Memeriksa kekuatan password
  $strength = check_password_strength($password);

  // Simpan ke database (contoh)
  $db = array(
    'password' => $hash_password,
    'salt' => $salt,
    'iterasi' => $iterasi,
    'kekuatan' => $strength
  );

  file_put_contents('database.json', json_encode($db));

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="author" content="@falmesino" />
    <title>Hash Password Kompleks</title>
  </head>
  <body>
    <form role="form" method="post" action="">
      <h1>Hash Password Kompleks</h1>
      <div class="">
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" placeholder="Password" required tabindex="1" value="<?= $password; ?>"
        />
      </div>
      <div class="">
        <label for="iterasi">Iterasi</label>
        <input type="number" name="iterasi" id="iterasi" placeholder="Iterasi" min="1" step="1" value="<?= $iterasi; ?>" required tabindex="2"
        />
      </div>
      <div class="">
        <button type="submit" name="submit" id="submit" tabindex="3">
          Hash
        </button>
      </div>
    </form>

    <br />

    <div class="">
      <?php
        echo "Password: $password<br />";
        echo "Salt: $salt<br />";
        echo "Iterasi: $iterasi<br />";
        echo "Hash Password: $hash_password<br />";
        echo "Kekuatan Password: $strength/5<br />";
      ?>
    </div>
  </body>
</html>