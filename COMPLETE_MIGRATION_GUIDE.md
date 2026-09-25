# Complete PHP to Laravel Migration Guide
## Nullified Solutions - Secure Transfer with Render Deployment

This guide provides step-by-step instructions to transfer your PHP+MySQL project to Laravel with comprehensive security for Render deployment.

## ✅ Migration Progress

### Phase 1: Initial Setup (COMPLETED)
- ✅ Laravel project created
- ✅ Assets copied (images, CSS, JS)
- ✅ Models created
- ✅ Controllers created
- ✅ Middleware created
- ✅ Form requests created
- ✅ Seeders created
- ✅ Users migration updated with roles

### Phase 2: Database Migrations (IN PROGRESS)
You need to update the following migration files with your database schema.

### Phase 3: Models & Relationships (NEXT)
Configure Eloquent models with relationships and security features.

### Phase 4: Controllers & Business Logic (PENDING)
Transfer PHP business logic to Laravel controllers.

### Phase 5: Views & Frontend (PENDING)
Convert PHP views to Blade templates.

### Phase 6: Security Configuration (PENDING)
Configure security for Render deployment.

### Phase 7: Testing & Deployment (PENDING)
Test and deploy to Render.

---

## Detailed Implementation Steps

### STEP 1: Update Database Migrations

I'll provide the complete migration files. Update each file in `database/migrations/`:

#### 1.1 User Profile Migration
File: `database/migrations/*_create_user_profiles_table.php`

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('address')->nullable();
            $table->string('city', 100)->nullable();
            $table->string('province', 100)->nullable();
            $table->string('postal_code', 20)->nullable();
            $table->enum('preferred_contact', ['email', 'sms', 'phone'])->default('email');
            $table->string('avatar')->nullable();
            $table->timestamps();

            $table->unique('user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_profiles');
    }
};
```

#### 1.2 Repair Services Migration
File: `database/migrations/*_create_repair_services_table.php`

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('repair_services', function (Blueprint $table) {
            $table->id();
            $table->enum('category', ['computer', 'phone', 'tablet', 'accessory', 'software']);
            $table->string('service_name', 150);
            $table->string('short_description')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->timestamps();

            $table->index('category');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('repair_services');
    }
};
```

#### 1.3 Repair Pricing Migration
File: `database/migrations/*_create_repair_pricings_table.php`

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('repair_pricings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained('repair_services')->onDelete('cascade');
            $table->string('device_type', 100);
            $table->decimal('price', 10, 2);
            $table->string('price_label', 50);
            $table->string('notes')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index('service_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('repair_pricings');
    }
};
```

#### 1.4 Bookings Migration
File: `database/migrations/*_create_bookings_table.php`

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('service_id')->nullable()->constrained('repair_services')->onDelete('set null');
            $table->string('device_name', 100);
            $table->string('device_brand', 100)->nullable();
            $table->string('device_model', 100)->nullable();
            $table->text('issue_description');
            $table->date('preferred_date')->nullable();
            $table->time('preferred_time')->nullable();
            $table->enum('status', ['pending', 'confirmed', 'in_progress', 'completed', 'cancelled'])->default('pending');
            $table->enum('priority', ['low', 'normal', 'high'])->default('normal');
            $table->text('admin_notes')->nullable();
            $table->timestamps();

            $table->index('user_id');
            $table->index('status');
            $table->index('preferred_date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
```

#### 1.5 Booking Attachments Migration
File: `database/migrations/*_create_booking_attachments_table.php`

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('booking_attachments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained()->onDelete('cascade');
            $table->string('file_name');
            $table->string('file_path');
            $table->timestamps();

            $table->index('booking_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('booking_attachments');
    }
};
```

#### 1.6 Contact Messages Migration
File: `database/migrations/*_create_contact_messages_table.php`

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contact_messages', function (Blueprint $table) {
            $table->id();
            $table->string('full_name', 150);
            $table->string('email', 150);
            $table->string('phone', 30)->nullable();
            $table->string('subject', 200)->nullable();
            $table->text('message');
            $table->enum('status', ['new', 'read', 'replied'])->default('new');
            $table->timestamps();

            $table->index('email');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_messages');
    }
};
```

#### 1.7 Premium Plans Migration
File: `database/migrations/*_create_premium_plans_table.php`

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('premium_plans', function (Blueprint $table) {
            $table->id();
            $table->string('plan_name', 100);
            $table->text('description')->nullable();
            $table->decimal('monthly_price', 10, 2);
            $table->json('features')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('premium_plans');
    }
};
```

#### 1.8 Premium Accounts Migration
File: `database/migrations/*_create_premium_accounts_table.php`

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('premium_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('plan_id')->constrained('premium_plans')->onDelete('restrict');
            $table->enum('status', ['active', 'expired', 'cancelled', 'pending'])->default('pending');
            $table->timestamp('started_at')->useCurrent();
            $table->timestamp('expires_at')->nullable();
            $table->string('payment_reference', 150)->nullable();
            $table->timestamps();

            $table->index('user_id');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('premium_accounts');
    }
};
```

#### 1.9 Software Store Items Migration
File: `database/migrations/*_create_software_store_items_table.php`

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('software_store_items', function (Blueprint $table) {
            $table->id();
            $table->string('item_name', 150);
            $table->string('category', 100);
            $table->decimal('price', 10, 2);
            $table->text('description')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->string('image_url')->nullable();
            $table->timestamps();

            $table->index('category');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('software_store_items');
    }
};
```

#### 1.10 Software Store Purchases Migration
File: `database/migrations/*_create_software_store_purchases_table.php`

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('software_store_purchases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('item_id')->constrained('software_store_items')->onDelete('cascade');
            $table->enum('purchase_status', ['paid', 'pending', 'refunded'])->default('paid');
            $table->timestamps();

            $table->index('user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('software_store_purchases');
    }
};
```

#### 1.11 Account Settings Migration
File: `database/migrations/*_create_account_settings_table.php`

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('account_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('theme', ['light', 'dark', 'system'])->default('system');
            $table->boolean('email_notifications')->default(true);
            $table->boolean('sms_notifications')->default(false);
            $table->boolean('booking_reminders')->default(true);
            $table->boolean('auto_login')->default(false);
            $table->string('timezone', 80)->default('Asia/Manila');
            $table->timestamps();

            $table->unique('user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('account_settings');
    }
};
```

### STEP 2: Run Migrations

After updating all migration files, run:

```bash
cd /Applications/XAMPP/xamppfiles/htdocs/nullified-laravel
php artisan migrate
```

---

## Security Configuration for Render

### Environment Variables (.env for Production)

```env
APP_NAME="Nullified Solutions"
APP_ENV=production
APP_KEY=base64:YOUR_PRODUCTION_KEY_HERE
APP_DEBUG=false
APP_URL=https://your-app.onrender.com

DB_CONNECTION=mysql
DB_HOST=YOUR_RENDER_DB_HOST
DB_PORT=3306
DB_DATABASE=YOUR_DB_NAME
DB_USERNAME=YOUR_DB_USER
DB_PASSWORD=YOUR_SECURE_PASSWORD

SESSION_DRIVER=database
SESSION_LIFETIME=120
SESSION_ENCRYPT=true
SESSION_SECURE_COOKIE=true
SESSION_SAME_SITE=lax

CACHE_DRIVER=database
QUEUE_CONNECTION=database

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@nullifiedsolutions.com"
MAIL_FROM_NAME="${APP_NAME}"
```

### Render Build Script (render.yaml)

```yaml
services:
  - type: web
    name: nullified-laravel
    env: php
    buildCommand: |
      composer install --no-dev --optimize-autoloader
      php artisan config:cache
      php artisan route:cache
      php artisan view:cache
      npm install
      npm run build
    startCommand: |
      php artisan migrate --force
      php artisan serve --host=0.0.0.0 --port=$PORT
    envVars:
      - key: APP_ENV
        value: production
      - key: APP_KEY
        generateValue: true
      - key: APP_DEBUG
        value: false
```

---

## Next Steps

1. ✅ Update all migration files (copy code above)
2. Run `php artisan migrate`
3. Update models with relationships
4. Transfer controllers business logic
5. Create Blade templates
6. Configure security middleware
7. Test locally
8. Deploy to Render

## Need Help?

Refer to:
- `MIGRATION_PLAN.md` - Overall strategy
- `TRANSFER_GUIDE.md` - File mapping reference
- Laravel documentation: https://laravel.com/docs
- Render deployment: https://render.com/docs