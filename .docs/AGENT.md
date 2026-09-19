# AGENT.md

## 1. Project Overview

This project consists of developing a CRUD/ABM application for managing **Users** and their associated **Roles**.

The system must provide the following functionality:

* List users.
* Create new users.
* Edit existing users.
* Delete users.
* Associate each user with exactly one role.
* Allow one role to be associated with multiple users.

The application must be developed primarily using **Vanilla PHP**.

The project must be divided into three main areas:

```text
Database
FrontEnd
BackEnd
```

The implementation should prioritize simplicity, maintainability, clarity, and understanding of the technologies being used.

---

## 2. Technology Stack

### Required Technologies

The project must use:

* PHP Vanilla.
* MySQL.
* HTML5.
* CSS3.
* JavaScript.

PHP must be the primary backend technology.

No PHP framework such as Laravel, Symfony, CodeIgniter, or similar frameworks should be introduced unless explicitly requested.

### Optional Technologies

The project may use:

* Bootstrap.
* jQuery.

These technologies are optional and should only be introduced when they provide a clear benefit.

The project must remain functional and understandable without depending heavily on external frameworks or libraries.

If Bootstrap is used, avoid overriding large portions of its styling unnecessarily.

If jQuery is used, avoid replacing simple JavaScript functionality that can be implemented clearly with Vanilla JavaScript.

---

## 3. Architecture

The project should follow a simple layered structure separating:

```text
Database
    ↓
BackEnd
    ↓
FrontEnd
```

A possible project structure is:

```text
Proyecto-ABM/
│
├── database/
│   └── abm_usuarios.sql
│
├── backend/
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

The architecture may be simplified if the complexity of the project does not justify additional layers.

Do not introduce unnecessary abstractions.

---

## 4. Database

The database must use **MySQL**.

The main entities are:

### User

A User contains:

* ID.
* First name.
* Last name.
* Username/Nickname.
* Email.
* Role.

### Role

A Role contains:

* ID.
* Name.
* Description.

The relationship is:

```text
Role 1 ───────── N User
```

Each User must have exactly one Role.

A Role may be associated with multiple Users.

The foreign key must therefore be stored in the `users` table.

Example:

```text
users.role_id → roles.id
```

The database must enforce referential integrity using foreign keys.

---

## 5. Backend

The backend must be implemented using **Vanilla PHP**.

The backend is responsible for:

* Database connections.
* SQL queries.
* CRUD operations.
* Data validation.
* Processing form submissions.
* Handling errors.
* Returning or rendering the appropriate result.

Database access should preferably use **PDO** with prepared statements.

Avoid constructing SQL queries by directly concatenating user-provided values.

Example:

```php
$stmt = $pdo->prepare(
    "SELECT * FROM users WHERE id = :id"
);

$stmt->execute([
    ':id' => $id
]);
```

---

## 6. Frontend

The frontend must use:

* HTML5.
* CSS3.
* Vanilla JavaScript.

Bootstrap and jQuery may be used optionally.

The frontend must provide:

* User listing.
* Create user form.
* Edit user form.
* Delete action.
* Role selection.
* Validation messages.
* Success/error feedback.

Forms must use semantic HTML.

Example:

```html
<form method="POST" action="guardar.php">
    <label for="name">Name</label>
    <input
        type="text"
        id="name"
        name="name"
        required
    >

    <button type="submit">
        Save
    </button>
</form>
```

---

## 7. CRUD/ABM Requirements

The application must implement:

### Create

Register a new user.

### Read

Display a list of existing users.

The list should display the associated role name rather than only the role ID.

### Update

Allow an existing user to modify their information and role.

### Delete

Allow an existing user to be removed.

A confirmation should be displayed before deleting a user.

---

## 8. Coding Guidelines

Prefer simple and readable code.

Use descriptive names.

Avoid unnecessary duplication.

Keep database logic separate from presentation logic whenever practical.

Do not place large SQL queries directly inside HTML templates unless the architecture explicitly requires it.

Avoid inline CSS.

Avoid inline JavaScript when the same functionality can be placed in a dedicated JavaScript file.

Use comments when they help explain non-obvious logic.

Do not add libraries, frameworks, or dependencies without a clear reason.

---

## 9. Security Guidelines

The application should follow basic web security practices.

At minimum:

* Use PDO prepared statements.
* Validate server-side input.
* Escape HTML output using `htmlspecialchars()`.
* Validate email addresses.
* Do not trust client-side validation alone.
* Do not expose database credentials in frontend files.
* Keep database configuration outside publicly accessible frontend assets when possible.

Example:

```php
echo htmlspecialchars(
    $user['name'],
    ENT_QUOTES,
    'UTF-8'
);
```

---

## 10. Development Philosophy

The primary objective is to create a functional and understandable academic project.

Prefer:

```text
Simple
    ↓
Readable
    ↓
Maintainable
```

over:

```text
Complex
    ↓
Over-engineered
    ↓
Difficult to understand
```

The project should demonstrate understanding of:

* Relational database modeling.
* MySQL.
* PHP.
* CRUD/ABM operations.
* HTML forms.
* CSS.
* JavaScript.
* Backend/frontend separation.

Do not introduce advanced technologies simply because they are available.

---

## 11. Agent Behavior

When modifying the project:

1. Respect the existing architecture.
2. Prefer Vanilla PHP.
3. Preserve the separation between Database, Backend, and Frontend.
4. Use MySQL for persistence.
5. Use PDO and prepared statements.
6. Avoid unnecessary dependencies.
7. Explain significant architectural changes.
8. Do not replace existing code with a framework unless explicitly requested.
9. Keep the implementation appropriate for an academic ABM project.
10. Prioritize working, understandable code over unnecessary complexity.
