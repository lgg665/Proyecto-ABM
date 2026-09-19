# SKILL.md

# PHP Vanilla User Management ABM

## 1. Purpose

This skill defines how to develop the User Management ABM/CRUD application.

The application manages two entities:

```text
User
Role
```

The main objective is to provide:

* User listing.
* User creation.
* User editing.
* User deletion.
* Role assignment.

The application must be developed using **Vanilla PHP** as the main backend technology.

---

# 2. Technology Stack

## 2.1 Core Technologies

The project uses:

```text
PHP
MySQL
HTML5
CSS3
JavaScript
```

PHP is responsible for backend processing.

MySQL is responsible for persistent data storage.

HTML5 provides the structure of the interface.

CSS3 provides the visual presentation.

JavaScript provides client-side interactions.

---

## 2.2 Vanilla PHP

The project should use standard PHP without a PHP framework.

Allowed:

```php
<?php

$users = [];

foreach ($users as $user) {
    echo $user['name'];
}
```

```php
$stmt = $pdo->prepare(
    "SELECT * FROM users WHERE id = :id"
);
```

Not allowed unless explicitly requested:

```text
Laravel
Symfony
CodeIgniter
CakePHP
Yii
Slim
Other PHP frameworks
```

The goal is to understand the fundamentals of PHP and backend development.

---

# 3. Optional Libraries

## 3.1 Bootstrap

Bootstrap may be included if it improves the interface development.

Possible uses:

* Responsive grid.
* Buttons.
* Forms.
* Tables.
* Alerts.
* Navigation.
* Modals.

Bootstrap should not be mandatory for backend functionality.

The application must continue to be conceptually understandable as a Vanilla PHP project.

---

## 3.2 jQuery

jQuery may be used optionally.

Possible uses:

* DOM manipulation.
* Simple AJAX requests.
* Event handling.
* Modal interactions.

However, simple functionality should preferably use Vanilla JavaScript.

For example:

```javascript
document
    .querySelector('#deleteButton')
    .addEventListener('click', function () {
        // ...
    });
```

should not be replaced with jQuery without a reason.

If jQuery is introduced, document why it is being used.

---

# 4. Application Architecture

The application should be organized into three major areas:

```text
┌─────────────────────┐
│      DATABASE       │
│       MySQL         │
└──────────┬──────────┘
           │
           ▼
┌─────────────────────┐
│      BACKEND        │
│    Vanilla PHP      │
└──────────┬──────────┘
           │
           ▼
┌─────────────────────┐
│      FRONTEND       │
│ HTML/CSS/JavaScript │
└─────────────────────┘
```

This separation should be maintained throughout development.

---

# 5. Suggested Project Structure

A recommended structure is:

```text
abm-usuarios/
│
├── database/
│   └── abm_usuarios.sql
│
├── backend/
│   │
│   ├── config/
│   │   └── database.php
│   │
│   ├── models/
│   │   ├── Usuario.php
│   │   └── Rol.php
│   │
│   ├── controllers/
│   │   └── UsuarioController.php
│   │
│   └── services/
│       └── UsuarioService.php
│
├── frontend/
│   │
│   ├── css/
│   │   └── styles.css
│   │
│   ├── js/
│   │   └── script.js
│   │
│   ├── usuarios/
│   │   ├── listar.php
│   │   ├── crear.php
│   │   └── editar.php
│   │
│   └── index.php
│
└── README.md
```

This structure is a guideline rather than a strict requirement.

For a small academic project, it is acceptable to simplify the architecture.

---

# 6. Database Model

## 6.1 Role

The Role entity contains:

```text
id
name
description
```

Example:

```text
1 | Administrator | Full system access
2 | Editor        | Content management
3 | User          | Basic system access
```

---

## 6.2 User

The User entity contains:

```text
id
first_name
last_name
username
email
role_id
```

---

# 7. Relationship

The relationship between User and Role is:

```text
Role 1 ─────────── N User
```

Meaning:

* A User has one Role.
* A Role can belong to many Users.

Database representation:

```text
roles
    |
    | 1
    |
    | N
    |
users
```

The `users.role_id` column must reference `roles.id`.

Example:

```sql
CREATE TABLE roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    description VARCHAR(255)
);
```

```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    role_id INT NOT NULL,

    CONSTRAINT fk_users_role
        FOREIGN KEY (role_id)
        REFERENCES roles(id)
);
```

---

# 8. Database Access

PDO should be used to communicate with MySQL.

Example:

```php
<?php

$host = 'localhost';
$dbname = 'abm_usuarios';
$username = 'root';
$password = '';

$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

$pdo = new PDO($dsn, $username, $password);

$pdo->setAttribute(
    PDO::ATTR_ERRMODE,
    PDO::ERRMODE_EXCEPTION
);
```

The connection should preferably be centralized in:

```text
backend/config/database.php
```

Other PHP files should reuse the connection rather than creating a new connection repeatedly.

---

# 9. CRUD Operations

## 9.1 Create

The creation process should be:

```text
Form
 ↓
POST request
 ↓
Server-side validation
 ↓
Prepared SQL statement
 ↓
MySQL
 ↓
Success/Error response
```

Example:

```php
$stmt = $pdo->prepare(
    "INSERT INTO users
    (first_name, last_name, username, email, role_id)
    VALUES
    (:first_name, :last_name, :username, :email, :role_id)"
);

$stmt->execute([
    ':first_name' => $firstName,
    ':last_name' => $lastName,
    ':username' => $username,
    ':email' => $email,
    ':role_id' => $roleId
]);
```

---

# 10. Read / List

The user listing should retrieve the role name through a SQL `JOIN`.

Example:

```sql
SELECT
    u.id,
    u.first_name,
    u.last_name,
    u.username,
    u.email,
    r.name AS role_name
FROM users u
INNER JOIN roles r
    ON u.role_id = r.id
ORDER BY u.id;
```

The frontend can then display:

```text
ID | Name | Last Name | Username | Email | Role | Actions
```

---

# 11. Update

The edit workflow should be:

```text
User list
    ↓
Edit
    ↓
Load user data
    ↓
Display form
    ↓
Modify information
    ↓
Submit
    ↓
Validate
    ↓
UPDATE database
```

Example:

```sql
UPDATE users
SET
    first_name = :first_name,
    last_name = :last_name,
    username = :username,
    email = :email,
    role_id = :role_id
WHERE id = :id;
```

---

# 12. Delete

The deletion workflow should be:

```text
User list
    ↓
Delete
    ↓
Confirmation
    ↓
DELETE request
    ↓
Database
    ↓
Updated user list
```

A confirmation can be implemented using Vanilla JavaScript:

```javascript
const confirmed = confirm(
    'Are you sure you want to delete this user?'
);

if (!confirmed) {
    event.preventDefault();
}
```

The backend must still validate the requested ID.

The application must never rely exclusively on frontend validation.

---

# 13. Frontend Forms

The creation and editing forms should contain:

```text
First Name
Last Name
Username
Email
Role
```

Example:

```html
<form method="POST">

    <label for="first_name">
        First Name
    </label>

    <input
        type="text"
        id="first_name"
        name="first_name"
        required
    >

    <label for="last_name">
        Last Name
    </label>

    <input
        type="text"
        id="last_name"
        name="last_name"
        required
    >

    <label for="username">
        Username
    </label>

    <input
        type="text"
        id="username"
        name="username"
        required
    >

    <label for="email">
        Email
    </label>

    <input
        type="email"
        id="email"
        name="email"
        required
    >

    <label for="role_id">
        Role
    </label>

    <select
        id="role_id"
        name="role_id"
        required
    >
        <!-- Roles loaded from database -->
    </select>

    <button type="submit">
        Save
    </button>

</form>
```

---

# 14. Validation

Validation should happen on both:

```text
Frontend
Backend
```

Frontend validation improves user experience.

Backend validation protects the application.

Examples:

```php
if (empty($firstName)) {
    $errors[] = 'First name is required.';
}
```

```php
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Invalid email address.';
}
```

The backend must validate:

* Required fields.
* Email format.
* Valid role ID.
* Username uniqueness.
* Email uniqueness.
* Valid user ID when editing or deleting.

---

# 15. Security

The application should follow basic security practices.

## Prepared Statements

Always use prepared statements for values originating from users.

Avoid:

```php
$sql = "SELECT * FROM users WHERE id = " . $_GET['id'];
```

Prefer:

```php
$stmt = $pdo->prepare(
    "SELECT * FROM users WHERE id = :id"
);

$stmt->execute([
    ':id' => $_GET['id']
]);
```

---

## Output Escaping

When displaying database values in HTML:

```php
<?= htmlspecialchars(
    $user['first_name'],
    ENT_QUOTES,
    'UTF-8'
) ?>
```

---

## Input Validation

Never assume that data received through:

```text
GET
POST
URL parameters
Forms
```

is valid.

Always validate it on the server.

---

# 16. Frontend Design

The interface should prioritize:

* Clarity.
* Usability.
* Responsive design.
* Consistent spacing.
* Readable forms.
* Clear actions.

The main user management screen should make the following actions immediately understandable:

```text
+ Add User

Edit
Delete
```

Tables should remain usable on smaller screens.

If Bootstrap is used, its responsive utilities may be used to achieve this.

If Bootstrap is not used, implement responsive behavior using CSS media queries.

---

# 17. JavaScript

Vanilla JavaScript should be preferred.

Typical uses include:

* Delete confirmations.
* Form interactions.
* Client-side validation.
* Dynamic UI feedback.
* Showing/hiding elements.
* Optional asynchronous requests.

Example:

```javascript
document
    .querySelectorAll('.delete-button')
    .forEach(button => {

        button.addEventListener('click', event => {

            const confirmed = confirm(
                'Are you sure you want to delete this user?'
            );

            if (!confirmed) {
                event.preventDefault();
            }

        });

    });
```

---

# 18. jQuery Usage

If jQuery is introduced, use it consistently within the specific functionality where it is needed.

Do not mix jQuery and Vanilla JavaScript unnecessarily.

For example, avoid creating the same event handler twice:

```javascript
$('.delete-button').click(...);
```

and:

```javascript
document
    .querySelector('.delete-button')
    .addEventListener(...);
```

Choose one approach for the same functionality.

---

# 19. Bootstrap Usage

If Bootstrap is included, it can be used for:

* Forms.
* Tables.
* Buttons.
* Alerts.
* Navigation.
* Responsive layouts.
* Modals.

However, Bootstrap should remain a frontend aid.

It must not determine the backend architecture.

The backend must continue to operate using Vanilla PHP and MySQL.

---

# 20. Error Handling

Errors should be handled clearly.

The application should distinguish between:

```text
Validation errors
Database errors
Not found errors
Unexpected server errors
```

User-facing messages should be understandable.

Technical database errors should not unnecessarily expose:

* Database credentials.
* SQL statements.
* Server paths.
* Internal implementation details.

During development, PHP error reporting may be enabled.

Production-style behavior should avoid displaying sensitive technical information to users.

---

# 21. Development Workflow

Development should follow this order:

```text
1. Model entities
       ↓
2. Create MySQL database
       ↓
3. Test database connection
       ↓
4. Implement User model/data access
       ↓
5. Implement Role retrieval
       ↓
6. Implement User listing
       ↓
7. Implement User creation
       ↓
8. Implement User editing
       ↓
9. Implement User deletion
       ↓
10. Implement frontend styling
       ↓
11. Add JavaScript interactions
       ↓
12. Test complete ABM
```

Each stage should be tested before moving to the next one.

---

# 22. Testing Checklist

Before considering the ABM complete, verify:

### Database

* [ ] Database can be created.
* [ ] Roles can be inserted.
* [ ] Users can be inserted.
* [ ] Foreign key works.
* [ ] Invalid role IDs are rejected.

### Create

* [ ] User can be created.
* [ ] Required fields are validated.
* [ ] Email is validated.
* [ ] Duplicate username is handled.
* [ ] Duplicate email is handled.

### Read

* [ ] Users are displayed.
* [ ] Role name is displayed.
* [ ] Empty user list is handled.

### Update

* [ ] Existing data is loaded.
* [ ] User can be modified.
* [ ] Role can be changed.
* [ ] Validation works.

### Delete

* [ ] User can be deleted.
* [ ] Confirmation is displayed.
* [ ] Invalid IDs are handled.

### Frontend

* [ ] Forms are usable.
* [ ] Buttons are understandable.
* [ ] Layout is responsive.
* [ ] Error messages are visible.
* [ ] Success messages are visible.

---

# 23. Architectural Principles

The project should follow these principles:

### Separation of concerns

Database logic, backend processing, and frontend presentation should not become unnecessarily mixed.

### Simplicity

Use the simplest solution that correctly solves the requirement.

### Maintainability

Code should be organized so another student can understand and modify it.

### Security

User input must always be treated as untrusted.

### Progressive complexity

Start with the basic ABM and introduce additional technologies only when there is a practical reason.

---

# 24. Final Architecture

The target architecture can be summarized as:

```text
                    USER
                     │
                     ▼
              ┌──────────────┐
              │   FRONTEND   │
              │              │
              │ HTML5        │
              │ CSS3         │
              │ JavaScript   │
              │ Bootstrap*   │
              │ jQuery*      │
              └──────┬───────┘
                     │
                     │ HTTP
                     ▼
              ┌──────────────┐
              │   BACKEND    │
              │              │
              │ Vanilla PHP  │
              │ PDO          │
              │ CRUD/ABM     │
              └──────┬───────┘
                     │
                     │ SQL
                     ▼
              ┌──────────────┐
              │   DATABASE   │
              │              │
              │    MySQL     │
              │              │
              │ Users        │
              │ Roles        │
              └──────────────┘

* Optional
```

The application should remain a **Vanilla PHP + MySQL ABM**, with Bootstrap and jQuery treated as optional supporting technologies rather than the foundation of the project.
