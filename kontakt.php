<?php
$jmeno = trim($_POST["jmeno"] ?? "");
$telefon = trim($_POST["telefon"] ?? "");
$email = trim($_POST["email"] ?? "");
$zprava = trim($_POST["zprava"] ?? "");

$chyba = "";

if (empty($jmeno) || empty($telefon) || empty($zprava)) {
    $chyba = "Vyplňte prosím všechna povinná pole: jméno, telefon a zprávu.";
}

if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $chyba = "Zadaný e-mail není platný.";
}

$mailOdeslan = false;

if (!$chyba) {
    $komu = "tombrambora@gmail.com";

    $predmet = "Nová poptávka z webu Dominik Anděl";

    $textEmailu =
    "Nová poptávka z webu:\n\n" .
    "Jméno: $jmeno\n" .
    "Telefon: $telefon\n" .
    "E-mail: $email\n\n" .
    "Zpráva:\n$zprava\n";

    $hlavicky = "From: noreply@dominikandel.cz\r\n";
    $hlavicky .= "Reply-To: $email\r\n";
    $hlavicky .= "Content-Type: text/plain; charset=UTF-8\r\n";

    $mailOdeslan = mail($komu, $predmet, $textEmailu, $hlavicky);
}

?>
<!DOCTYPE html>
<html lang="cs">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Odeslání poptávky | Dominik Anděl</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<section class="result-page">
  <div class="result-card">

    <?php if ($chyba): ?>
      <div class="result-icon error">!</div>
      <h1>Formulář nebyl odeslán</h1>
      <p><?= htmlspecialchars($chyba) ?></p>

      <a class="main-btn" href="index.html#kontakt">Zpět na formulář</a>

    <?php else: ?>
      <div class="result-icon success">✓</div>
      <h1>Poptávka byla odeslána</h1>
      <p>Děkujeme za zprávu. Ozveme se vám co nejdříve.</p>

      <?php if ($mailOdeslan): ?>
        <p style="color: green;">
          ✓ E-mail byl úspěšně odeslán.
        </p>
      <?php else: ?>
        <p style="color: orange;">
          ⚠ Poptávka byla přijata, ale e-mail se nepodařilo odeslat.
        </p>
      <?php endif; ?>

      

      <a class="main-btn" href="index.html">Zpět na web</a>
    <?php endif; ?>

  </div>
</section>

</body>
</html>