# Admin Area — Quick Notes

✅ Default admin username: `admin`

⚠️ Default password used in this project: `admin@123` (used only for development). Replace it before production.

What I changed:
- Added secure session cookie settings and inactivity timeout in `auth.php`.
- Added CSRF token to the login form (`login.php`) and validation in `login_process.php`.
- Added basic rate-limiting (session based) on `login_process.php`.
- Regenerates session ID on successful login and clears sensitive session values on logout.

How to change the admin password safely:
1. Generate a password hash using PHP's `password_hash`:

```php
<?php
echo password_hash('new_password_here', PASSWORD_DEFAULT);
```

2. Replace the password hash in your production-safe storage instead of hard-coding a plain password.
   - For production, move credentials into a database or a configuration file outside of web root, not in code.

Notes & next steps:
- Consider moving to a database-backed admin user table and implement proper user management.
- Add stronger protections like IP-based rate limiting or account lockouts in persistent storage for production.
- Ensure your site runs over HTTPS so secure cookies are used.
