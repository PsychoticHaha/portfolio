<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="/images/favicon.png" type="image/x-icon">
  <link rel="stylesheet" href="./css/common.css">
  <link rel="stylesheet" href="./css/dashboard.css">
  <title>RAF | Dashboard</title>
</head>

<body>
  <header>
    <div class="left" role="tablist" aria-label="Dashboard sections">
      <button class="item active" type="button" role="tab" aria-selected="true" aria-controls="panel-messages" id="tab-messages" data-tab="messages">
        Messages
      </button>
      <button class="item" type="button" role="tab" aria-selected="false" aria-controls="panel-reactions" id="tab-reactions" data-tab="reactions">
        Reactions
      </button>
      <button class="item" type="button" role="tab" aria-selected="false" aria-controls="panel-usage" id="tab-usage" data-tab="usage">
        Usage
      </button>
    </div>
    <div class="logout">
      <form action="logout.php" method="POST">
        <input type="submit" name="logout" value=".">
        <input type="hidden" name="token" value="<?= htmlspecialchars($_SESSION['token'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
      </form>
    </div>
  </header>
  <main>
    <section class="panel active" data-panel="messages" id="panel-messages" role="tabpanel" aria-labelledby="tab-messages">
      <div class="data-container">
        <!-- "id", 'fullname', 'email', 'message', 'is_read', 'date' -->
        <table id="message-container" class="data-table">
          <thead>
            <tr>
              <th>Email</th>
              <th>Message</th>
              <th>Date</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
        <div class="empty-state" id="messages-empty" hidden>No messages yet.</div>
      </div>
      <aside class="message-details" id="message-details">
        <h2>Select a message</h2>
        <p>Choose a message from the table to read the full content.</p>
      </aside>
    </section>
    <section class="panel" data-panel="reactions" id="panel-reactions" role="tabpanel" aria-labelledby="tab-reactions" aria-hidden="true">
      <div class="data-container">
        <div class="stats-grid" id="reaction-stats"></div>
        <table id="reaction-container" class="data-table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Reaction</th>
              <th>Date</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
        <div class="empty-state" id="reactions-empty" hidden>No reactions yet.</div>
      </div>
    </section>
    <section class="panel" data-panel="usage" id="panel-usage" role="tabpanel" aria-labelledby="tab-usage" aria-hidden="true">
      <div class="data-container">
        <table id="usage-container" class="data-table">
          <thead></thead>
          <tbody></tbody>
        </table>
        <div class="empty-state" id="usage-empty" hidden>No usage data yet.</div>
      </div>
    </section>
  </main>
  <script src="./scripts/load.js"></script>
</body>

</html>
