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

      <div class="result-table">
        <div><strong>Jméno:</strong> <?= htmlspecialchars($jmeno) ?></div>
        <div><strong>Telefon:</strong> <?= htmlspecialchars($telefon) ?></div>
        <div><strong>E-mail:</strong> <?= htmlspecialchars($email) ?></div>
        <div><strong>Zpráva:</strong><br><?= nl2br(htmlspecialchars($zprava)) ?></div>
      </div>

      <a class="main-btn" href="index.html">Zpět na web</a>
    <?php endif; ?>

  </div>
</section>

</body>
</html>