<?php

$hidden_data = "";
$current_textarea_data = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $previous_hidden = isset($_POST["accumulated_data"]) ? $_POST["accumulated_data"] : "";
    
    $new_text = isset($_POST["textarea_content"]) ? $_POST["textarea_content"] : "";
    
    if (!empty($new_text)) {
        if (!empty($previous_hidden)) {
            $hidden_data = $previous_hidden . " | " . $new_text;
        } else {
            $hidden_data = $new_text;
        }
    } else {
        $hidden_data = $previous_hidden;
    }
}

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["accumulated_data"])) {
    $previous_hidden = $_GET["accumulated_data"];
    $new_text = isset($_GET["textarea_content"]) ? $_GET["textarea_content"] : "";
    
    if (!empty($new_text)) {
        if (!empty($previous_hidden)) {
            $hidden_data = $previous_hidden . " | " . $new_text;
        } else {
            $hidden_data = $new_text;
        }
    } else {
        $hidden_data = $previous_hidden;
    }
}

$safe_hidden_data = htmlspecialchars($hidden_data, ENT_QUOTES, 'UTF-8');
?>
<!DOCTYPE html>
<html lang="sv">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Avancerad Formulär Loop</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div id="app" style="padding-top: 80px;">
    <header>
      <h1>Formulär Ackumulator</h1>
    </header>

    <div id="content-panels" style="display: flex; flex-direction: column; gap: 40px; max-width: 600px; margin: 0 auto; padding: 20px;">
      
      <section id="upgrades-panel" style="width: 100%;">
        <h2>GET-Scope Formulär</h2>
        <div class="contact-box" style="background: rgba(0, 0, 0, 0.5); padding: 25px; border: 2px solid #2e3842;">
          <form action="" method="GET">
            
            <input type="hidden" name="accumulated_data" value="<?php echo $safe_hidden_data; ?>">
            
            <label style="display: block; margin-bottom: 10px; color: #a3b3c2; font-weight: bold;">
              Skriv text att lägga till i loopen (GET):
            </label>
            <textarea name="textarea_content" placeholder="Skriv ditt meddelande här..." rows="4" style="width:100%; min-height:80px;"></textarea>
            
            <button type="submit" class="biker-btn" style="margin-top: 15px; width: 100%;">
              Ackumulera via GET
            </button>
          </form>
        </div>
      </section>


      <section id="producers-panel" style="width: 100%;">
        <h2>POST-Scope Formulär</h2>
        <div class="contact-box" style="background: rgba(0, 0, 0, 0.5); padding: 25px; border: 2px solid #2e3842;">
          <form action="" method="POST">
            
            <input type="hidden" name="accumulated_data" value="<?php echo $safe_hidden_data; ?>">
            
            <label style="display: block; margin-bottom: 10px; color: #a3b3c2; font-weight: bold;">
              Skriv text att lägga till i loopen (POST):
            </label>
            <textarea name="textarea_content" placeholder="Skriv ditt meddelande här..." rows="4" style="width:100%; min-height:80px;"></textarea>
            
            <button type="submit" class="biker-btn" style="margin-top: 15px; width: 100%; background-color: #f39c12;">
              Ackumulera via POST
            </button>
          </form>
        </div>
      </section>


      <section style="width: 100%; margin-top: 10px;">
        <h2>Innehåll i Hidden-fältet upravo nu:</h2>
        <div style="background: rgba(211, 84, 0, 0.15); border-left: 4px solid #d35400; padding: 20px; border-radius: 4px; word-wrap: break-word;">
          <?php if (!empty($hidden_data)): ?>
            <p style="text-align: left; background: none; padding: 0; border: none; font-family: monospace; color: #e2e8f0; font-size: 1.1rem;">
              <?php echo $safe_hidden_data; ?>
            </p>
          <?php else: ?>
            <p style="text-align: left; background: none; padding: 0; border: none; color: #666680; font-style: italic;">
              Hidden-fältet är tomt. Skriv i något av formulären ovan och skicka för att starta kedjan!
            </p>
          <?php endif; ?>
        </div>
      </section>

    </div>
  </div>
</body>
</html>