# Documentación de la API - Gestión Hotelera

Este archivo describe las rutas principales del backend y sus funciones.

## Endpoints

### GET /
- Descripción: Página de bienvenida (solo web).
- Respuesta: Renderiza la vista `welcome`.

---

### Ejemplo de futuras rutas RESTful (a implementar)

#### Habitaciones
- `GET /api/habitaciones` - Lista todas las habitaciones.
- `POST /api/habitaciones` - Crea una nueva habitación.
- `GET /api/habitaciones/{id}` - Consulta una habitación específica.
- `PUT /api/habitaciones/{id}` - Actualiza una habitación.
- `DELETE /api/habitaciones/{id}` - Elimina una habitación.

#### Mesas
- `GET /api/mesas` - Lista todas las mesas.
- `POST /api/mesas` - Crea una mesa.
- ...

#### Reservas
- `GET /api/reservas` - Lista todas las reservas.
- `POST /api/reservas` - Crea una reserva.
- ...

---

## Autenticación

La API utiliza Laravel Sanctum para la autenticación de usuarios vía token.

- Registro/Login: `/api/register`, `/api/login` (a implementar)
- Requiere enviar el token en la cabecera `Authorization: Bearer <token>`

## Modelos principales

- `Reserva`: Relaciona clientes, habitaciones, mesas y salones. Permite obtener el objeto reservado según el tipo.
- `Mesa`: Maneja las características y estado de cada mesa.

## Próximos pasos

- Definir y documentar más endpoints en `routes/api.php`
- Agregar ejemplos de uso y respuesta de cada endpoint.
