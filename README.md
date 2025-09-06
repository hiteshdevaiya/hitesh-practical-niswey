# Laravel Project

Clone the project, set environment credentials, install dependencies, migrate, seed, and run the application:  

```bash
# 1. Clone the repository
git clone <your-repo-url>
cd <your-project-folder>

# 2. Copy and edit environment file
cp .env.example .env
# Edit .env for DB and other credentials:
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=your_database_name
# DB_USERNAME=your_username
# DB_PASSWORD=your_password

# 3. Install PHP dependencies
composer install

# 4. Run migrations and seeders
php artisan migrate --seed

# 5. Install frontend dependencies and compile assets
npm install

# 6. Serve the application
composer run dev
