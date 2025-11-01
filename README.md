# RAF Portfolio

A full-stack personal portfolio for Fanasina (R.A.F.) showcasing experience, selected work, and ways to get in touch. The project ships with a PHP backend, a lightweight JavaScript front-end, a secure back office, and telemetry tooling to keep track of visitor interactions.

## Features

### Public site
- **Theming & motion** – dark/light theme toggle with animated icons, custom cursor, animated hero headline, and an immersive loader.
- **Hero call-to-actions** – primary CTA to learn more plus quick-access social links (LinkedIn, GitHub, Gmail).
- **Lazy-loaded media** – images defer loading via `data-img` attributes until their section becomes active.
- **Skills & projects** – data-driven skills grid and project cards rendered from JSON.
- **Dynamic project details** – `/project/{id}` pages hydrate from the same JSON catalogue, with graceful 404 handling.
- **Contact & reactions** – validated contact form (captcha, client-side validation) that persists messages, plus a reactions widget that records votes, keeps counts in sync, and opens a qualitative feedback form for dislikes.
- **Feedback loop** – visitors can submit free-text feedback that is stored alongside messages for review in the back office.
- **Telemetry hooks** – optional WhatIsMyBrowser integration collects enriched visitor headers and stores them in JSON logs.

### Backend services
- **Environment aware** – database credentials and API keys resolved via `.env` (loaded for every endpoint).
- **Message capture** – `/backend/saveMessage.php` stores contact submissions in MySQL.
- **Reaction analytics** – `/backend/saveReaction.php` accepts POST votes, exposes aggregated stats on GET, and returns live totals to the UI.
- **Feedback capture** – `/backend/saveFeedback.php` stores qualitative feedback in the `messages` table for a single source of truth.
- **Visitor logs** – `/backend/save-logs.php` persists structured telemetry payloads into timestamped JSON files under `logs/`.

### Back office
- **Authentication** – HTTP Basic Auth gate (`backoffice/index.php`) followed by CSRF-protected login with exponential back-off.
- **Token-guarded API** – `backoffice/backend/allData.php` validates session tokens before streaming messages, reactions, and usage metrics.
- **Responsive dashboard** – `backoffice/dashboard.php` consumes the API, renders the inbox, and shows a detail panel for selected messages.
- **Secure logout** – dedicated endpoint destroys the session only when the submitted token matches the session token.

## Tech stack

| Layer          | Technologies |
| -------------- | ------------ |
| Front-end      | HTML5, Vanilla JS (ES modules), CSS/SCSS, Swiper.js |
| Back-end       | PHP 8+, MySQL (PDO) |
| Tooling        | Node.js (PostCSS, Clean-CSS), Stylelint, Prettier |
| Back office UI | Plain HTML/CSS/JS |

## Project structure

```
backend/             # PHP endpoints (messages, reactions, logs, etc.)
components/          # Reusable HTML partials for the public site
project/             # Project detail page and loader
scripts/             # Front-end JavaScript modules and JSON data
stylesheets/         # Global site styles
backoffice/          # Admin area (PHP endpoints, assets, dashboard)
logs/                # JSON visitor logs (gitignored)
```

## Getting started

### Prerequisites
- PHP 8.1+
- MySQL 5.7+/MariaDB 10+
- Node.js 18+ (for linting/build tooling)

### Installation
1. Clone the repository and install Node dependencies (optional for linting/build helpers):
   ```bash
   npm install
   ```
2. Edit `.env` and provide your environment values:
   ```env
   DB_HOST=localhost
   DB_NAME=portfolio
   DB_USER=raf
   DB_PASS=super-secret
   WHAT_IS_MY_BROWSER_API_KEY=your_api_key_here
   ```
3. Create the required MySQL tables (`messages`, `reactions`, `usage`, plus any others you rely on). Minimum schema:
   ```sql
   CREATE TABLE messages (
     id INT AUTO_INCREMENT PRIMARY KEY,
     fullname VARCHAR(255) NOT NULL,
     email VARCHAR(255) NOT NULL,
     message TEXT NOT NULL,
     is_read TINYINT(1) DEFAULT 0,
     date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
   );

   CREATE TABLE reactions (
     id INT AUTO_INCREMENT PRIMARY KEY,
     reaction ENUM('love','like','dislike') NOT NULL,
     date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
   );

   CREATE TABLE usage (
     id INT AUTO_INCREMENT PRIMARY KEY,
     label VARCHAR(255) NOT NULL,
     value VARCHAR(255) NOT NULL,
     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
   );
   ```
4. Serve the project (example using PHP’s built-in server):
   ```bash
   php -S localhost:8000
   ```
5. Visit `http://localhost:8000` for the public site and `http://localhost:8000/backoffice` for the admin dashboard.

### Back office access
- Default HTTP Basic credentials: `raf-admin` / `secret` (update `backoffice/index.php` before deploying).
- Dashboard login password hash lives in `backoffice/scripts/login.php` – replace with your own hashed password using `password_hash`.

## Environment variables

| Key | Description |
| --- | ----------- |
| `DB_HOST`, `DB_NAME`, `DB_USER`, `DB_PASS` | MySQL connection parameters consumed by `backend/pdo.php`. |
| `WHAT_IS_MY_BROWSER_API_KEY` | API key for WhatIsMyBrowser; required only if you enable advanced telemetry in `backend/get-client-headers.php`. |

## Logging & analytics
- `backend/get-client-headers.php` forwards enriched client hints to WhatIsMyBrowser and saves responses through `backend/save-logs.php`.
- Logs are written to `logs/visitor_*.json`; the directory ships with a `.gitignore` to avoid committing sensitive data.
- If the API key is missing, the endpoint returns a clear error and avoids external calls.

## Tooling
- `npm run lint` (configure in `package.json`) to run Stylelint.
- `npx prettier` can format JS/CSS/JSON using the bundled Prettier config.
- Clean-CSS/PostCSS dependencies are available should you need to build minified stylesheets.

## Palette & typography
- Primary palette: `#6918b4`, `#36117e`, `#8318b4`, `#1a3eb4`, `#122b7e`.
- Headings use **Open Sans** (weight 664), body copy uses **Montserrat**.

## Deployment checklist
- Update `.env` with production credentials.
- Change Basic Auth credentials (`backoffice/index.php`).
- Re-hash the back office password and update `backoffice/scripts/login.php`.
- Ensure the `logs/` directory is writable by the web server user.
- Configure HTTPS so that telemetry callbacks post to a secure endpoint.

## License

This project is open-sourced under the [MIT License](./LICENSE).
