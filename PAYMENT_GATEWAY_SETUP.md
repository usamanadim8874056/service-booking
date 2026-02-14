# 💳 Payment Gateway Setup Guide

To enable wallet top-ups and payment processing, you need credentials from PayPal and/or Razorpay.

---

## 🔵 PayPal Setup (Recommended for Global)

### Step 1: Create PayPal Business Account
1. Go to [developer.paypal.com](https://developer.paypal.com)
2. Sign up for a **Business Account**
3. Log in to Developer Dashboard

### Step 2: Create Sandbox Application
1. Navigate to **Apps & Credentials**
2. Select **Sandbox** environment (top right)
3. Click **Create App** (Merchant Account)
4. Enter app name: "Service Booking"
5. Copy the **Client ID** and **Secret**

### Step 3: Update .env File
```env
PAYPAL_MODE=sandbox           # Use 'live' for production
PAYPAL_CLIENT_ID=ABCxxx...    # From PayPal dashboard
PAYPAL_SECRET=EFGxxx...       # From PayPal dashboard
```

### Step 4: Test with Sandbox Account
PayPal provides test buyer/seller accounts in dashboard.

### ✅ After Setup:
- Users can add funds to wallet
- Payments go through PayPal
- Users redirected to PayPal approval
- Auto-credited on confirmation

---

## 🔴 Razorpay Setup (Best for India & Southeast Asia)

### Step 1: Create Razorpay Account
1. Go to [razorpay.com](https://razorpay.com)
2. Sign up for **Merchant Account**
3. Complete KYC verification
4. Dashboard opens automatically after approval

### Step 2: Get API Keys
1. Go to **Settings → API Keys**
2. Copy **Key ID** (this is `RAZORPAY_KEY`)
3. Copy **Key Secret** (this is `RAZORPAY_SECRET`)

### Step 3: Update .env File
```env
RAZORPAY_KEY=key_live_xxx...     # From Razorpay dashboard
RAZORPAY_SECRET=sktwx_xxx...     # From Razorpay dashboard
```

### Step 4: Test Mode
In dashboard, toggle "Test Mode" to test payments without real charges.

### ✅ After Setup:
- Users can add funds via Razorpay
- Supports all Indian payment methods
- Instant settlement
- Webhooks for confirmation

---

## 📋 Comparison

| Feature | PayPal | Razorpay |
|---------|--------|----------|
| **Global** | ✅ 200+ countries | ❌ India/SEA only |
| **Setup Time** | 2-3 hours | 1-2 days (KYC) |
| **Cards** | ✅ All | ✅ All |
| **UPI** | ❌ No | ✅ Yes |
| **Net Banking** | ❌ No | ✅ Yes |
| **Wallets** | ✅ PayPal | ✅ Google Pay, PhonePe |
| **Commission** | 2.9% + $0.30 | 2% + GST |

---

## 🎯 Which One to Choose?

### Choose **PayPal** if:
- Target audience is **international**
- Need UPI in US (via PayPal transfer)
- Want largest user base familiarity

### Choose **Razorpay** if:
- Target audience is **India**
- Want cheaper commission rate
- Need UPI/Net Banking/Wallets

### Recommendation:
**Use BOTH** - Let users choose their preferred method!

---

## 🔧 SETUP CHECKLIST

- [ ] Create PayPal Business Account
- [ ] Create Sandbox App & copy credentials
- [ ] Create Razorpay Merchant Account
- [ ] Complete Razorpay KYC
- [ ] Copy Razorpay API keys
- [ ] Update `.env` with both gateways
- [ ] Test payment flow locally
- [ ] Deploy to Railway
- [ ] Test on live server
- [ ] Switch to LIVE mode when confirmed

---

## 🧪 Testing Payments Locally

### Test PayPal Sandbox
1. In `.env`, keep `PAYPAL_MODE=sandbox`
2. Use PayPal sandbox buyer account (in dashboard)
3. Complete payment, you'll be redirected back

### Test Razorpay
1. In dashboard, enable **Test Mode**
2. Use test card: `4111 1111 1111 1111` (CVC: 123)
3. Any future date as expiry
4. Any OTP works

---

## 🚨 Important Security Notes

⚠️ **NEVER commit these to Git:**
```env
PAYPAL_CLIENT_ID=xxx
PAYPAL_SECRET=xxx
RAZORPAY_KEY=xxx
RAZORPAY_SECRET=xxx
```

These are in `.gitignore` (good!) - But verify before pushing:
```bash
git status  # Check .env is NOT staged
```

✅ **Use Railway Secrets** for production:
1. Add variables in Railway dashboard
2. Don't commit `.env` file
3. Even better: Use GitHub Secrets with CI/CD

---

## 💡 How It Works in Your App

### User Flow:
```
User clicks "Add Funds"
    ↓
Selects amount & gateway
    ↓
Redirected to PayPal/Razorpay
    ↓
Completes payment
    ↓
Returned to your site
    ↓
Amount credited to wallet
    ↓
Can book services!
```

### Code Reference:
- [PaymentController.php](app/Http/Controllers/PaymentController.php)
  - `payWithpaypal()` - Initiate PayPal
  - `getPaymentStatus()` - Handle return
  - `payWithRazorpay()` - Handle Razorpay

---

## 📞 Troubleshooting

### PayPal: "Unable to create PayPal order"
- Check `PAYPAL_CLIENT_ID` and `PAYPAL_SECRET`
- Verify you're using right environment (sandbox vs live)
- Check internet connection

### Razorpay: "Payment capture failed"
- Ensure `RAZORPAY_KEY` and `RAZORPAY_SECRET` are correct
- Check if test mode is enabled (for testing)
- Verify webhook URL in dashboard

### Money charged but not credited to wallet
- Check `wallet_transactions` table
- Check `user_wallet` balance didn't increase
- Verify payment status is showing 'COMPLETED'

---

## ✅ NEXT STEP

Once you've added credentials:
1. Test locally
2. Update Railway environment variables
3. Redeploy

Payment features will then work live! 💰

---

*Payment Setup Guide - Ready for Integration*
