# POS Customer and User Account Management System

This application is a web-based POS account management system developed using CodeIgniter 4, PHP, and MySQL. The application allows authorized users to manage customer and user accounts, upload profile pictures, and protect application pages through login authentication.

## Main Features

- Secure login using a username and password
- Password verification using hashed passwords
- Session-based access control
- Customer account creation and editing
- User account creation and editing
- Unique username validation
- Avatar upload for user accounts
- JPG, JPEG, and PNG file validation
- Maximum avatar file size of 2 MB
- Placeholder avatar for users without profile pictures
- Logout function
- Protected Customer Accounts and User Accounts pages

## System Requirements

To run the application locally, the following are required:

- PHP 8.2 or later
- MySQL or MariaDB
- Apache web server
- XAMPP
- Composer, if the `vendor` folder is not included
- A modern web browser

## Running the Application Locally

### 1. Start XAMPP

Open the XAMPP Control Panel and start:

- Apache
- MySQL

### 2. Open the project folder

Open a terminal and go to the application directory:

```bash
cd C:\xampp\htdocs\posact
```

### 3. Start the CodeIgniter development server

Run:

```bash
php spark serve
```

The server should display an address similar to:

```text
http://localhost:8080
```

### 4. Open the login page

In a browser, open:

```text
http://localhost:8080/index.php/login
```

## Logging In

Enter a valid username and password from the `users` table.

Example laboratory account:

```text
Username: admin
Password: Password123!
```

Click **Login**.

After a successful login, the application redirects to the Customer Accounts page.

If the username or password is incorrect, the application displays:

```text
Invalid username or password.
```

## Navigation

After logging in, the application provides the following navigation links:

- **Customer Accounts**: Opens the list of customer accounts.
- **User Accounts**: Opens the list of user accounts.
- **Logout**: Ends the active session and returns to the login page.

Only logged-in users can access the Customer Accounts and User Accounts pages.

## Managing Customer Accounts

### View customers

Click **Customer Accounts** to display all customer records.

The list displays:

- ID
- Full Name
- Email
- Phone
- Edit action

### Add a new customer

1. Open **Customer Accounts**.
2. Click **Add New Customer**.
3. Enter the customer's full name.
4. Enter a valid email address.
5. Enter an optional phone number.
6. Click **Save Customer**.

The following validation rules apply:

- Full name is required.
- Email is required.
- Email must use a valid format.

If validation fails, the form displays an error and does not insert the record.

### Edit a customer

1. Open **Customer Accounts**.
2. Click **Edit** beside the customer.
3. The form displays the customer's existing information.
4. Change the required information.
5. Click **Update Customer**.

After a successful update, the application returns to the Customer Accounts page.

## Managing User Accounts

### View users

Click **User Accounts** to display all user records.

The list displays:

- Avatar
- ID
- Username
- Full Name
- Edit action

Users without an uploaded avatar display the default placeholder image.

### Add a new user

1. Open **User Accounts**.
2. Click **Add New User**.
3. Enter a unique username.
4. Enter the user's full name.
5. Enter a password containing at least eight characters.
6. Enter the same password in **Confirm Password**.
7. Click **Save User**.

The following validation rules apply:

- Username is required.
- Username must be unique.
- Full name is required.
- Password is required.
- Password must contain at least eight characters.
- Password confirmation must match the password.

The application hashes the password before saving the account. Plain-text passwords are not stored in the database.

### Edit a user

1. Open **User Accounts**.
2. Click **Edit** beside the user.
3. The form displays the existing username and full name.
4. Change the required information.
5. Optionally select a profile picture.
6. Click **Update User**.

The current username remains valid for the selected account, but the username cannot match another account's username.

## Uploading an Avatar

Avatar upload is available on the User Edit page.

1. Open **User Accounts**.
2. Click **Edit** beside a user.
3. Under **Profile Picture**, click **Choose File**.
4. Select an image.
5. Click **Update User**.

Avatar requirements:

- JPG, JPEG, or PNG format only
- Maximum file size of 2 MB

Uploaded files are stored in:

```text
public/uploads
```

Only the generated filename is stored in the `avatar` database column.

The application displays avatars in a consistent square format using CSS. If no avatar is available, the application displays:

```text
public/images/placeholder.png
```

When an avatar is replaced, the previous uploaded avatar file is removed.

## Logging Out

To log out:

1. Click **Logout**.
2. The application destroys the active session.
3. The browser returns to the login page.

After logout, opening a protected page redirects to the login page.

## Protected Pages

The following application sections require login:

```text
/customers
/customers/new
/customers/edit/{id}
/customers/create
/customers/update/{id}
/users
/users/new
/users/edit/{id}
/users/create
/users/update/{id}
```

The authentication filter checks the session before allowing access.

## Database Tables

### Customers table

```sql
CREATE TABLE customers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20),
    created_at DATETIME NOT NULL
);
```

### Users table

```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    full_name VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    avatar VARCHAR(255) NULL,
    created_at DATETIME NOT NULL
);
```

## Important Project Files

```text
app/
├── Config/
│   ├── Filters.php
│   └── Routes.php
├── Controllers/
│   ├── Auth.php
│   ├── Customer.php
│   └── User.php
├── Filters/
│   └── AuthFilter.php
├── Models/
│   ├── CustomerModel.php
│   └── UserModel.php
└── Views/
    ├── auth/
    │   └── login.php
    ├── customers/
    │   ├── index.php
    │   ├── new.php
    │   └── edit.php
    └── users/
        ├── index.php
        ├── new.php
        └── edit.php

public/
├── images/
│   └── placeholder.png
└── uploads/
    └── .gitkeep
```

## Local Database Configuration

The local `.env` database settings may use:

```ini
CI_ENVIRONMENT = development

app.baseURL = 'http://localhost:8080/'

database.default.hostname = localhost
database.default.database = pos_db
database.default.username = root
database.default.password =
database.default.DBDriver = MySQLi
database.default.port = 3306
```

Do not upload the local `.env` file to a public GitHub repository.

## Public Hosting Configuration

For public hosting, update the hosted `.env` file using the actual public URL and hosting database credentials:

```ini
CI_ENVIRONMENT = development

app.baseURL = 'http://pos-lab.infinityfreeapp.com/'

database.default.hostname = sql110.infinityfree.com
database.default.database = if0_43078844_pos_db
database.default.username = if0_43078844
database.default.password = 
database.default.DBDriver = MySQLi
database.default.port = 3306
```

Do not place real hosting passwords in this README or in a public repository.

## Testing Checklist

### Authentication

- [ ] Blank login fields display validation errors.
- [ ] Invalid credentials display an error.
- [ ] Valid credentials create a session.
- [ ] Protected pages redirect logged-out visitors to login.
- [ ] Logged-in users can open protected pages.
- [ ] Logout destroys the session.

### Customers

- [ ] A customer can be created.
- [ ] Blank full name is rejected.
- [ ] Blank or invalid email is rejected.
- [ ] Customer edit form is pre-filled.
- [ ] Customer information can be updated.

### Users

- [ ] A user can be created.
- [ ] Duplicate username is rejected.
- [ ] Blank required fields are rejected.
- [ ] A short password is rejected.
- [ ] Different password confirmation is rejected.
- [ ] Password is stored as a hash.
- [ ] A newly created user can log in.
- [ ] User information can be updated.

### Avatar upload

- [ ] JPG, JPEG, and PNG files below 2 MB are accepted.
- [ ] Unsupported file types are rejected.
- [ ] Files larger than 2 MB are rejected.
- [ ] Uploaded avatar appears on the User Accounts page.
- [ ] Placeholder appears when no avatar exists.
- [ ] Previous avatar is removed when replaced.

## Troubleshooting

### The application cannot connect to the database

Check the database hostname, database name, username, password, driver, and port in `.env`.

### Hosted links redirect to localhost

Change the hosted base URL:

```ini
app.baseURL = 'http://pos-lab.infinityfreeapp.com/'
```

Also check `app/Config/App.php` for an old localhost URL.

### Login does not work

Confirm that:

- The username exists in the database.
- The password column contains a complete password hash.
- A bcrypt hash usually begins with `$2y$` and contains 60 characters.
- The plain password is entered on the login page.
- The authentication controller uses `password_verify()`.

### Avatar does not display

Confirm that:

- The file exists in `public/uploads`.
- The database contains only the avatar filename.
- `public/images/placeholder.png` exists.
- The uploads folder is writable on the hosting server.

## Security Notes

- Never store plain-text passwords.
- Never upload the real `.env` file to a public repository.
- Never publish database or hosting credentials.
- Use production mode on the hosted website.
- Validate all uploaded files by type and size.
- Use generated filenames for avatar uploads.
- Log out after using the application on a shared device.

Recommended `.gitignore` entries:

```gitignore
.env
/public/uploads/*
!/public/uploads/.gitkeep
```

## Educational Use

This application was developed for a laboratory activity. The project demonstrates database integration, validation, CRUD operations, file uploads, password hashing, session authentication, route filters, and access control using CodeIgniter 4.
