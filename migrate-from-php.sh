#!/bin/bash

# Nullified Solutions - PHP to Laravel Migration Script
# This script helps transfer files from PHP+MySQL project to Laravel

set -e

# Colors for output
GREEN='\033[0;32m'
BLUE='\033[0;34m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

PHP_PROJECT="/Applications/XAMPP/xamppfiles/htdocs/Nullified"
LARAVEL_PROJECT="/Applications/XAMPP/xamppfiles/htdocs/nullified-laravel"

echo -e "${BLUE}================================${NC}"
echo -e "${BLUE}Nullified Solutions Migration${NC}"
echo -e "${BLUE}PHP+MySQL → Laravel${NC}"
echo -e "${BLUE}================================${NC}\n"

# Step 1: Copy Assets
echo -e "${GREEN}Step 1: Copying Assets...${NC}"
echo "- Copying images..."
cp -r "$PHP_PROJECT/images/"* "$LARAVEL_PROJECT/public/images/" 2>/dev/null || true
echo "- Copying CSS..."
cp -r "$PHP_PROJECT/css/"* "$LARAVEL_PROJECT/public/css/" 2>/dev/null || true
echo "- Copying JavaScript..."
cp -r "$PHP_PROJECT/js/"* "$LARAVEL_PROJECT/public/js/" 2>/dev/null || true
echo -e "${GREEN}✓ Assets copied${NC}\n"

# Step 2: Copy Database SQL for reference
echo -e "${GREEN}Step 2: Copying Database Schema...${NC}"
cp "$PHP_PROJECT/database/nullified_db.sql" "$LARAVEL_PROJECT/database/" 2>/dev/null || true
echo -e "${GREEN}✓ Database schema copied for reference${NC}\n"

# Step 3: Create Models
echo -e "${GREEN}Step 3: Creating Eloquent Models...${NC}"
cd "$LARAVEL_PROJECT"

echo "Creating models..."
php artisan make:model UserProfile -m 2>/dev/null || echo "UserProfile model exists"
php artisan make:model Booking -m 2>/dev/null || echo "Booking model exists"
php artisan make:model BookingAttachment -m 2>/dev/null || echo "BookingAttachment model exists"
php artisan make:model RepairService -m 2>/dev/null || echo "RepairService model exists"
php artisan make:model RepairPricing -m 2>/dev/null || echo "RepairPricing model exists"
php artisan make:model ContactMessage -m 2>/dev/null || echo "ContactMessage model exists"
php artisan make:model PremiumPlan -m 2>/dev/null || echo "PremiumPlan model exists"
php artisan make:model PremiumAccount -m 2>/dev/null || echo "PremiumAccount model exists"
php artisan make:model SoftwareStoreItem -m 2>/dev/null || echo "SoftwareStoreItem model exists"
php artisan make:model SoftwareStorePurchase -m 2>/dev/null || echo "SoftwareStorePurchase model exists"
php artisan make:model AccountSettings -m 2>/dev/null || echo "AccountSettings model exists"

echo -e "${GREEN}✓ Models created${NC}\n"

# Step 4: Create Controllers
echo -e "${GREEN}Step 4: Creating Controllers...${NC}"

php artisan make:controller HomeController 2>/dev/null || echo "HomeController exists"
php artisan make:controller ServicesController 2>/dev/null || echo "ServicesController exists"
php artisan make:controller PricingController 2>/dev/null || echo "PricingController exists"
php artisan make:controller ContactController 2>/dev/null || echo "ContactController exists"
php artisan make:controller DashboardController 2>/dev/null || echo "DashboardController exists"
php artisan make:controller BookingController 2>/dev/null || echo "BookingController exists"

# Admin controllers
php artisan make:controller Admin/DashboardController 2>/dev/null || echo "Admin/DashboardController exists"
php artisan make:controller Admin/UserController --resource 2>/dev/null || echo "Admin/UserController exists"
php artisan make:controller Admin/BookingController --resource 2>/dev/null || echo "Admin/BookingController exists"
php artisan make:controller Admin/PricingController --resource 2>/dev/null || echo "Admin/PricingController exists"

echo -e "${GREEN}✓ Controllers created${NC}\n"

# Step 5: Create Middleware
echo -e "${GREEN}Step 5: Creating Middleware...${NC}"

php artisan make:middleware CheckRole 2>/dev/null || echo "CheckRole middleware exists"
php artisan make:middleware CheckAdmin 2>/dev/null || echo "CheckAdmin middleware exists"

echo -e "${GREEN}✓ Middleware created${NC}\n"

# Step 6: Create Form Requests
echo -e "${GREEN}Step 6: Creating Form Requests...${NC}"

php artisan make:request BookingRequest 2>/dev/null || echo "BookingRequest exists"
php artisan make:request ContactRequest 2>/dev/null || echo "ContactRequest exists"
php artisan make:request UpdateProfileRequest 2>/dev/null || echo "UpdateProfileRequest exists"

echo -e "${GREEN}✓ Form requests created${NC}\n"

# Step 7: Create Seeders
echo -e "${GREEN}Step 7: Creating Seeders...${NC}"

php artisan make:seeder RepairServiceSeeder 2>/dev/null || echo "RepairServiceSeeder exists"
php artisan make:seeder RepairPricingSeeder 2>/dev/null || echo "RepairPricingSeeder exists"
php artisan make:seeder PremiumPlanSeeder 2>/dev/null || echo "PremiumPlanSeeder exists"
php artisan make:seeder AdminUserSeeder 2>/dev/null || echo "AdminUserSeeder exists"

echo -e "${GREEN}✓ Seeders created${NC}\n"

# Step 8: Summary
echo -e "${BLUE}================================${NC}"
echo -e "${BLUE}Migration Summary${NC}"
echo -e "${BLUE}================================${NC}"
echo -e "${GREEN}✓ Assets copied (images, CSS, JS)${NC}"
echo -e "${GREEN}✓ Database schema copied${NC}"
echo -e "${GREEN}✓ Models created${NC}"
echo -e "${GREEN}✓ Controllers created${NC}"
echo -e "${GREEN}✓ Middleware created${NC}"
echo -e "${GREEN}✓ Form requests created${NC}"
echo -e "${GREEN}✓ Seeders created${NC}"
echo ""
echo -e "${YELLOW}Next Steps:${NC}"
echo "1. Update migrations in database/migrations/"
echo "2. Update models with relationships in app/Models/"
echo "3. Update controllers with business logic in app/Http/Controllers/"
echo "4. Create Blade views in resources/views/"
echo "5. Update routes in routes/web.php"
echo "6. Configure security settings for Render deployment"
echo "7. Run: php artisan migrate"
echo "8. Run: php artisan db:seed"
echo ""
echo -e "${GREEN}Ready to continue with code migration!${NC}"