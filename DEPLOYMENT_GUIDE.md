# 🚀 Service Booking - Deployment Guide

This guide covers deployment options for your Service Booking application.

---

## 📋 Table of Contents
1. [Local Development Setup](#local-development-setup)
2. [Deployment to Railway](#deployment-to-railway)
3. [Docker Deployment](#docker-deployment)
4. [Environment Variables](#environment-variables)
5. [Post-Deployment Checklist](#post-deployment-checklist)

---

## Local Development Setup

### Prerequisites
- PHP 8.2 or higher
- MySQL 8.0 or higher
- Composer
- Node.js 16+ (for frontend assets)
- Git

### Steps

1. **Clone and Setup**
   ```bash
   git clone <your-repo-url>
   cd service-booking
   composer install
   npm install
   ```

2. **Configure Environment**
   ```bash
   # .env file is already created, update these:
   DB_HOST=127.0.0.1
   DB_USERNAME=root
   DB_PASSWORD=your_password
   ```

3. **Generate Key & Setup Database**
   ```bash
   php artisan key:generate
   php artisan migrate
   php artisan db:seed
   ```

4. **Build Frontend Assets**
   ```bash
   npm run build
   # or for development with watch
   npm run dev
   ```

5. **Run Local Server**
   ```bash
   php artisan serve
   # Visit http://localhost:8000
   ```

---

## Deployment to Railway

### Prerequisites
- GitHub account (push your code)
- Railway account (railway.app)
- Payment gateway credentials

### Step 1: Push to GitHub

```bash
git init
git add .
git commit -m "Initial commit: Service Booking System"
git branch -M main
git remote add origin https://github.com/YOUR_USERNAME/service-booking.git
git push -u origin main
```

### Step 2: Deploy on Railway

1. Go to [railway.app](https://railway.app)
2. Click **"New Project"**
3. Select **"Deploy from GitHub repo"**
4. Connect your GitHub account
5. Select **service-booking** repository
6. Click **"Deploy Now"**

### Step 3: Add Environment Variables

In Railway Dashboard:
1. Go to **Variables** tab
2. Add these variables:

```
APP_KEY=base64:<generated-key>
APP_DEBUG=false
APP_ENV=production
DB_HOST=<railway-mysql-host>
DB_NAME=railway
DB_USER=<generated-user>
DB_PASSWORD=<generated-password>
RAZORPAY_KEY=your_razorpay_key
RAZORPAY_SECRET=your_razorpay_secret
PAYPAL_MODE=live
PAYPAL_CLIENT_ID=your_paypal_id
PAYPAL_SECRET=your_paypal_secret
```

### Step 4: Add MySQL Plugin

1. In Railway project, click **"+ Add"**
2. Search and select **"MySQL"**
3. Click **"Add Plugin"**
4. Railway auto-populates DB_HOST, DB_USER, etc.

### Step 5: Run Initial Setup

Click on your deployment → **"Run Command"** → Enter:

```bash
php artisan migrate --force
php artisan db:seed --force
php artisan cache:clear
php artisan config:clear
```

✅ Your app is now live! Railway provides a public URL.

---

## Docker Deployment

### Local Docker Setup

```bash
docker-compose up -d
```

This starts:
- **App container** on `http://localhost:8000`
- **MySQL container** with auto-setup

### Initialize Database

```bash
docker-compose exec app php artisan migrate
docker-compose exec app php artisan db:seed
```

### View Logs

```bash
docker-compose logs -f app
```

### Stop Containers

```bash
docker-compose down
```

### Deploy Docker to Production

Build and push to Docker Hub:

```bash
docker build -t yourusername/service-booking:latest .
docker push yourusername/service-booking:latest
```

Then deploy using AWS ECS, Google Cloud Run, or similar services.

---

## Environment Variables

### Development (.env)
```env
APP_ENV=local
APP_DEBUG=true
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
```

### Production (.env.production)
```env
APP_ENV=production
APP_DEBUG=false
DB_CONNECTION=mysql
PAYPAL_MODE=live
```

### Payment Gateways

**Razorpay:**
- Get keys from: https://dashboard.razorpay.com
- Set `RAZORPAY_KEY` and `RAZORPAY_SECRET`

**PayPal:**
- Get credentials from: https://developer.paypal.com
- Set `PAYPAL_CLIENT_ID` and `PAYPAL_SECRET`

---

## Post-Deployment Checklist

- [ ] Database migrations completed
- [ ] Storage permissions set to 755
- [ ] Bootstrap cache writable
- [ ] APP_DEBUG set to false
- [ ] APP_ENV set to production
- [ ] SSL/HTTPS enabled
- [ ] Payment gateway credentials configured
- [ ] Email configuration tested
- [ ] Backup strategy in place
- [ ] Monitoring/logging configured

---

## Troubleshooting

### 1. **Storage Permission Error**
```bash
chmod -R 755 storage
chmod -R 755 bootstrap/cache
```

### 2. **Database Connection Error**
```bash
# Test connection
php artisan tinker
>>> DB::connection()->getPdo()
```

### 3. **Asset Files Not Loading**
```bash
npm run build
php artisan storage:link
```

### 4. **Memory Limit Error**
Update PHP.ini:
```
memory_limit = 256M
```

---

## Support

For more help:
- [Laravel Docs](https://laravel.com/docs)
- [Railway Docs](https://docs.railway.app)
- [Docker Docs](https://docs.docker.com)

---

*Last Updated: February 14, 2026*
