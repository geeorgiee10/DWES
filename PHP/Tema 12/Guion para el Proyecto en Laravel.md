### 📂 **Estructura del Proyecto**
```
jornadas-videojuegos/
│── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AuthController.php
│   │   │   ├── UserController.php
│   │   │   ├── AdminController.php
│   │   │   ├── EventoController.php
│   │   │   ├── PonenteController.php
│   │   │   ├── AsistenteController.php
│   │   │   ├── PagoController.php
│   │   ├── Middleware/
│   │   │   ├── Authenticate.php
│   │   │   ├── AdminMiddleware.php
│   ├── Models/
│   │   ├── User.php
│   │   ├── Evento.php
│   │   ├── Ponente.php
│   │   ├── Asistente.php
│   │   ├── Pago.php
│   ├── Repositories/
│   │   ├── EventoRepository.php
│   │   ├── PonenteRepository.php
│   │   ├── AsistenteRepository.php
│   ├── Services/
│   │   ├── PagoService.php
│── database/
│   ├── migrations/
│   │   ├── 2024_01_31_create_users_table.php
│   │   ├── 2024_01_31_create_eventos_table.php
│   │   ├── 2024_01_31_create_ponentes_table.php
│   │   ├── 2024_01_31_create_asistentes_table.php
│   │   ├── 2024_01_31_create_pagos_table.php
│── routes/
│   ├── web.php
│   ├── api.php
│── resources/
│   ├── views/
│   │   ├── auth/
│   │   │   ├── login.blade.php
│   │   │   ├── register.blade.php
│   │   ├── admin/
│   │   │   ├── dashboard.blade.php
│   │   │   ├── eventos.blade.php
│   │   │   ├── ponentes.blade.php
│   │   │   ├── asistentes.blade.php
│   │   ├── user/
│   │   │   ├── home.blade.php
│   │   │   ├── perfil.blade.php
│── config/
│── public/
│── tests/
│── composer.json
│── .env
│── .gitignore
│── readme.md
```

---

### 🔹 **Explicación de la estructura**
1. **Controladores (`Http/Controllers`)**  
   - `AuthController.php`: Maneja el registro, login, confirmación de cuenta.
   - `UserController.php`: Permite a los usuarios gestionar su perfil.
   - `AdminController.php`: Controla las vistas del administrador.
   - `EventoController.php`: CRUD de eventos, asegurando horarios y disponibilidad.
   - `PonenteController.php`: CRUD de ponentes y su información.
   - `AsistenteController.php`: Maneja el registro y selección de eventos.
   - `PagoController.php`: Procesa los pagos y genera tickets.

2. **Modelos (`Models/`)**  
   - `User.php`: Usuarios del sistema (roles: admin, asistente).
   - `Evento.php`: Representa un evento con restricciones de tiempo.
   - `Ponente.php`: Almacena los datos de los ponentes.
   - `Asistente.php`: Relación entre usuarios y eventos elegidos.
   - `Pago.php`: Registra pagos y estados de inscripción.

3. **Repositorios (`Repositories/`)**  
   - Separamos la lógica de acceso a datos para seguir el patrón Repository.

4. **Servicios (`Services/`)**  
   - `PagoService.php`: Maneja la integración con PayPal.

5. **Rutas (`routes/`)**  
   - `web.php`: Rutas protegidas y acceso a vistas.
   - `api.php`: Opcional, si se decide hacer API REST.

6. **Vistas (`resources/views/`)**  
   - Estructura clara para usuarios y administradores.

7. **Middlewares (`Middleware/`)**  
   - `Authenticate.php`: Asegura que los usuarios estén logueados.
   - `AdminMiddleware.php`: Restringe acceso a zonas de administración.

---

### 🔥 **Flujo de trabajo**
1. **Registro de usuario** con confirmación de email.
2. **Selección de tipo de inscripción** (presencial, virtual, gratuita).
3. **Elección de conferencias y talleres** con disponibilidad.
4. **Pago (PayPal) y generación de tickets** con confirmación por email.
5. **Acceso del administrador** para gestionar eventos, ponentes y pagos.

---

### 🚀 **Extras**
- **Autenticación con Laravel Breeze o Jetstream.**
- **API REST opcional si se trabaja en grupo.**
- **Deploy en un hosting como Heroku o Railway.**