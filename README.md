# 🐄 Sistema de Registro de Ganado

Bienvenido al **Sistema de Registro de Ganado**, una aplicación web moderna diseñada para facilitar la gestión integral de fincas ganaderas. Este sistema permite llevar un control detallado de los animales, su salud, peso y eventos importantes.

## 🚀 Tecnologías (VILT Stack)

Este proyecto está construido sobre un stack robusto y moderno para garantizar rendimiento y escalabilidad:

- **Backend**: [Laravel 10](https://laravel.com) (PHP 8.1+)
- **Frontend**: [Vue.js 3](https://vuejs.org) (Composition API)
- **Intermediario**: [Inertia.js](https://inertiajs.com) (Monolito Moderno)
- **Estilos**: [Tailwind CSS 3](https://tailwindcss.com)
- **Base de Datos**: MySQL / MariaDB

## 📋 Módulos Principales

El sistema cuenta (o contará) con los siguientes módulos clave:

1.  ✅ **Gestión de Bovinos**: Registro individual de animales (raza, edad, origen, etc.).
2.  ✅ **Control de Pesajes**: Historial de peso para monitorear el desarrollo y ganancia diaria.
3.  ✅ **Sanidad**: Registro de vacunas, tratamientos y controles veterinarios.
4.  **Eventos**: Calendario de actividades, partos, destetes y recordatorios.

## 📅 Historial de Cambios

### v0.3.0 - Módulo de Sanidad
- Creación de Modelo y Migración para `Sanidad`.
- Controlador con métodos CRUD.
- Vistas Vue (Index, Create, Edit) con badges de tipo.
- Registro de costos y próximas dosis.
- Navegación actualizada.

### v0.2.0 - Módulo de Pesajes
- Creación de Modelo y Migración para `Pesajes`.
- Controlador con métodos CRUD.
- Vistas Vue (Index, Create, Edit) con integración de Inertia.
- Relación `Bovino -> Pesajes` implementada.
- Navegación actualizada.

### v0.1.0 - Módulo de Bovinos
- Configuración inicial del proyecto (Laravel + Vue + Inertia).
- CRUD completo para `Bovinos`.
- Autenticación y configuración de base de datos.

## 🛠️ Instalación y Configuración Local

Sigue estos pasos para levantar el proyecto en tu entorno local:

### 1. Requisitos Previos
Asegúrate de tener instalado:
- PHP >= 8.1
- Composer
- Node.js & NPM
- Servidor de Base de Datos (MySQL)

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
Copia el archivo de ejemplo y configura tus credenciales de base de datos:
```bash
cp .env.example .env
```
Edita el archivo `.env` y ajusta `DB_DATABASE`, `DB_USERNAME`, y `DB_PASSWORD`.

Genera la clave de la aplicación:
```bash
php artisan key:generate
```

### 5. Base de Datos
Ejecuta las migraciones para crear las tablas necesarias:
```bash
php artisan migrate
```

### 6. Ejecutar la Aplicación
Necesitarás dos terminales para correr los servidores de desarrollo:

Terminal 1 (Vite - Hot Reload):
```bash
npm run dev
```

Terminal 2 (Laravel Server):
```bash
php artisan serve
```

Abre tu navegador en `http://localhost:8000`.

## 📂 Estructura del Proyecto

- `app/Models`: Modelos de datos (Eloquent).
- `app/Http/Controllers`: Lógica del backend.
- `resources/js/Pages`: Componentes Vue (Vistas).
- `resources/js/Components`: Componentes Vue reutilizables.
- `routes/web.php`: Definición de rutas web.

---
Desarrollado con ❤️ para la gestión eficiente del campo.
