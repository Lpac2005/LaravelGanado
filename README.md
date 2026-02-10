# 🐄 Sistema de Registro de Ganado

Bienvenido al **Sistema de Registro de Ganado**, una aplicación web moderna diseñada para facilitar la gestión integral de fincas ganaderas. Este sistema permite llevar un control detallado de los animales, su salud, peso y eventos importantes.

## 🚀 Tecnologías (VILT Stack)

Este proyecto está construido sobre un stack robusto y moderno para garantizar rendimiento y escalabilidad:

- **Backend**: [Laravel 10](https://laravel.com) (PHP 8.1+)
- **Frontend**: [Vue.js 3](https://vuejs.org) (Composition API)
- **Intermediario**: [Inertia.js](https://inertiajs.com) (Monolito Moderno)
- **Estilos**: [Tailwind CSS 3](https://tailwindcss.com)
- **Base de Datos**: SQLite (Integrada)

## 📋 Módulos Principales

El sistema cuenta con los siguientes módulos clave:

1.  ✅ **Gestión de Bovinos**: Registro individual de animales (raza, edad, origen, etc.).
2.  ✅ **Control de Pesajes**: Historial de peso para monitorear el desarrollo y ganancia diaria.
3.  ✅ **Sanidad**: Registro de vacunas, tratamientos y controles veterinarios.
4.  ✅ **Eventos**: Calendario de actividades, partos, destetes y recordatorios.
5.  ✅ **Modo Oscuro**: Interfaz adaptable a temas claro/oscuro.

## 📅 Historial de Cambios

### v1.0.0 - Versión Estable
- **Base de Datos**: Migración completa a SQLite para simplificar instalación.
- **Interfaz**: Implementación de Modo Oscuro/Claro con persistencia.
- **Configuración**: Eliminación de depencia de XAMPP/MySQL.

## 🛠️ Instalación y Configuración (Simplificada)

Sigue estos pasos para levantar el proyecto en tu entorno local:

### 1. Requisitos Previos
Asegúrate de tener instalado:
- PHP >= 8.1
- Node.js & NPM
- Git

### 2. Clonar el Repositorio
```bash
git clone <URL_DEL_REPOSITORIO>
cd registro_ganado
```

### 3. Instalar Dependencias
Backend (PHP):
```bash
composer install
```
Frontend (JS):
```bash
npm install
```

### 4. Configuración de Entorno
Copia el archivo de ejemplo (ya configurado para SQLite):
```bash
cp .env.example .env
```
Genera la clave de la aplicación:
```bash
php artisan key:generate
```

### 5. Base de Datos
Crea el archivo de base de datos vacío (si no existe) y ejecuta las migraciones:
*En Windows (PowerShell):*
```powershell
New-Item -ItemType File database/database.sqlite
```
*En Linux/Mac:*
```bash
touch database/database.sqlite
```

Luego ejecuta las migraciones:
```bash
php artisan migrate
```

### 6. Ejecutar la Aplicación
Necesitarás dos terminales para correr los servidores de desarrollo:

Terminal 1 (Frontend):
```bash
npm run dev
```

Terminal 2 (Backend):
```bash
php artisan serve
```

Abre tu navegador en `http://localhost:8000`.

## ⚠️ Solución de Problemas Comunes

**1. Error de Scripts en PowerShell**
Si al ejecutar `npm run dev` obtienes un error de seguridad, ejecuta este comando en PowerShell:
```powershell
Set-ExecutionPolicy -Scope Process Bypass
```

**2. Base de Datos no encontrada**
Asegúrate de haber creado el archivo `database/database.sqlite` antes de correr las migraciones.

## 📂 Estructura del Proyecto

- `app/Models`: Modelos de datos (Eloquent).
- `app/Http/Controllers`: Lógica del backend.
- `resources/js/Pages`: Componentes Vue (Vistas).
- `resources/js/Components`: Componentes Vue reutilizables.
- `routes/web.php`: Definición de rutas web.

---
Desarrollado con ❤️ para la gestión eficiente del campo.
