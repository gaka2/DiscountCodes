# Installation

Run:
```
git clone <repository_url>
composer install --no-dev --optimize-autoloader
php bin/console cache:clear
```

# Usage

## Web browser
Go to:
```
/codes/generate
```

## CLI
Run:
```
php bin/console app:generate-codes <numberOfCodes> <lengthOfCode> <fileName>
```