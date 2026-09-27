# Proyecto-ABM

Sistema de gestión de usuarios (ABM) desarrollado en PHP con MySQL, siguiendo una estructura modular en capas con un enfoque MVC orientado a la lógica de negocio y acceso a datos.

## Descripción general

Este proyecto permite:

- Listar usuarios
- Crear nuevos usuarios
- Editar usuarios existentes
- Eliminar usuarios
- Asignar roles desde una base de datos
- Validar unicidad de usuario y email
- Mostrar una interfaz web simple y responsiva

La aplicación está pensada como un ejemplo práctico de separación de responsabilidades, donde la vista se renderiza desde PHP y el flujo principal pasa por un controlador frontal ubicado en la carpeta frontend.

## Arquitectura actual

La estructura actual se organiza en capas:

- Model: entidades del dominio
- Repository: acceso a la base de datos
- Service: validaciones y lógica de negocio
- Controller: coordinación entre requests HTTP y servicio
- View: templates HTML/PHP que renderizan la interfaz

Flujo típico:

1. El usuario navega desde frontend/index.php
2. El controlador recibe la acción solicitada
3. El servicio valida los datos y ejecuta la lógica
4. El repositorio persiste o consulta la base de datos
5. La vista se carga con los resultados

## Estructura del proyecto

```text
Proyecto-ABM/
├── backend/
│   ├── config/
│   │   └── database.php
│   ├── controllers/
│   │   └── UserController.php
│   ├── models/
│   │   ├── Role.php
│   │   └── User.php
│   ├── repositories/
│   │   ├── RoleRepository.php
│   │   └── UserRepository.php
│   └── services/
│       └── UserService.php
├── database/
│   └── abm_usuarios.sql
├── frontend/
│   ├── css/
│   │   └── styles.css
│   ├── views/
│   │   └── users/
│   │       ├── form.php
│   │       └── index.php
│   ├── index.php
│   └── .htaccess (si se agrega más adelante)
├── README.md
└── .gitignore
```

## Base de datos

El proyecto usa MySQL y la estructura inicial queda definida en:

- [database/abm_usuarios.sql](database/abm_usuarios.sql)

La base de datos por defecto es:

- Nombre: abm_usuarios
- Host: 127.0.0.1
- Puerto: 3307
- Usuario: root
- Contraseña: vacía

Estas credenciales pueden configurarse mediante variables de entorno:

```bash
DB_HOST=127.0.0.1
DB_PORT=3307
DB_NAME=abm_usuarios
DB_USER=root
DB_PASS=
```

## Requisitos

- PHP 8.x
- MySQL / MariaDB
- Servidor web local (XAMPP, Laragon, WAMP, Apache o PHP built-in server)

## Instalación y ejecución

### 1. Crear la base de datos

Importá el archivo SQL desde MySQL:

```bash
mysql -u root -p < database/abm_usuarios.sql
```

O desde phpMyAdmin / MySQL Workbench usando el archivo SQL.

### 2. Levantar el proyecto

Desde la raíz del proyecto:

```bash
php -S 127.0.0.1:8001 -t frontend
```

Luego abrí en el navegador:

```text
http://127.0.0.1:8001/index.php
```

### 3. Usar con XAMPP

Si usás XAMPP:

1. Copiá la carpeta del proyecto dentro de htdocs
2. Iniciá Apache y MySQL
3. Importá la base de datos
4. Accedé a:

```text
http://localhost/Proyecto-ABM/frontend/index.php
```

## Funcionalidad principal

### Gestión de usuarios

- Crear un usuario con nombre, apellido, username, email y rol
- Validar campos obligatorios
- Validar formato de email
- Evitar usernames o emails duplicados
- Editar un registro existente manteniendo el mismo ID
- Eliminar un usuario con confirmación previa

### Roles

La aplicación trabaja con una relación entre usuarios y roles, leyendo la lista desde la tabla roles.

## Vista y frontend

La interfaz se encuentra en la carpeta:

- [frontend/index.php](frontend/index.php)
- [frontend/views/users/index.php](frontend/views/users/index.php)
- [frontend/views/users/form.php](frontend/views/users/form.php)
- [frontend/css/styles.css](frontend/css/styles.css)

Se usa HTML + PHP + CSS puro, sin frameworks de frontend, y una estética moderna oscura con estilo de panel administrativo.

## Notas sobre la arquitectura

El proyecto sigue un patrón en capas con intención MVC, pero con una separación más clara de responsabilidades:

- Controller: orquesta el flujo de la request
- Service: encapsula la lógica de negocio
- Repository: maneja el acceso a la base de datos
- Model: representa entidades del dominio
- View: renderiza la salida HTML

Esto evita mezclar lógica de acceso a datos, validación y presentación en los mismos archivos.

## Estado del proyecto

El proyecto se encuentra funcional y en una versión organizada para aprendizaje y extensión.

Se puede continuar mejorando agregando:

- paginación
- búsquedas
- filtros por rol
- manejo de sesiones
- autenticación
- API REST
- tests automatizados

## Autor

Proyecto desarrollado como ejemplo de ABM con PHP y MySQL.
