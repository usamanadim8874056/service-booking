#!/bin/bash

echo "🚀 Service Booking Deployment Script"
echo "===================================="

# Colors
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Check if .env exists
if [ ! -f .env ]; then
    echo -e "${RED}❌ .env file not found!${NC}"
    exit 1
fi

echo -e "${YELLOW}📦 Installing dependencies...${NC}"
composer install --optimize-autoloader --no-dev

echo -e "${YELLOW}🔑 Clearing caches...${NC}"
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear

echo -e "${YELLOW}📁 Setting permissions...${NC}"
chmod -R 755 storage
chmod -R 755 bootstrap/cache

echo -e "${YELLOW}🗄️ Running migrations...${NC}"
php artisan migrate --force

echo -e "${YELLOW}🌾 Running seeders...${NC}"
php artisan db:seed --force

echo -e "${YELLOW}🎨 Building assets...${NC}"
npm install
npm run build

echo -e "${GREEN}✅ Deployment complete!${NC}"
echo -e "${GREEN}Your app is ready to go!${NC}"
