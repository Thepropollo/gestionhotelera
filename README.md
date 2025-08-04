# Gestión Hotelera Backend

Este proyecto es el backend para un sistema de gestión hotelera interna. Está desarrollado con **Laravel 12** y **PHP 8.2**, integrando herramientas modernas para desarrollo ágil y seguro.

## Descripción

Gestiona operaciones internas de hoteles, incluyendo:
- Registro y administración de habitaciones
- Control de huéspedes y reservas
- Gestión de empleados y servicios
- Reportes y estadísticas
- Seguridad de acceso y autenticación

## Tecnologías utilizadas

- **Laravel 12** (Framework PHP)
- **PHP 8.2**
- **Sanctum** (Autenticación API)
- **Vite + TailwindCSS** (Frontend assets)
- **MySQL o SQLite** (Base de datos, configurable)
- **Composer** (Gestión de dependencias PHP)
- **npm** (Gestión de dependencias JS)

## Instalación

1. Clona el repositorio:
    ```bash
    git clone https://github.com/Thepropollo/gestionhotelera.git
    cd gestionhotelera
    ```

2. Instala dependencias PHP:
    ```bash
    composer install
    ```

3. Instala dependencias JS:
    ```bash
    npm install
    ```

4. Copia y configura el entorno:
    ```bash
    cp .env.example .env
    # Edita .env según tus credenciales y entorno
    ```

5. Genera la clave de aplicación:
    ```bash
    php artisan key:generate
    ```

6. Ejecuta migraciones:
    ```bash
    php artisan migrate
    ```

7. Inicia el servidor de desarrollo:
    ```bash
    npm run dev
    php artisan serve
    ```

## Pruebas

Ejecuta los tests de backend con:
```bash
php artisan test
```

## Uso

El backend expone una API REST para integrar con aplicaciones móviles o web internas. Consulta la documentación interna de rutas y recursos en el directorio `/routes` y `/app`.

## Contribuir

1. Haz un fork del repositorio.
2. Crea tu rama (`git checkout -b feature/mi-funcionalidad`).
3. Haz commit de tus cambios.
4. Envía un pull request.

Sugerencias y mejoras siempre son bienvenidas.

## Licencia

Este proyecto está bajo la licencia MIT. Ver el archivo [LICENSE](LICENSE) para más detalles.

## Autor

Creado y mantenido por el equipo de Thepropollo.

