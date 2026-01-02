# Phase 1 – Foundations

## Goal
Establecer las bases técnicas del proyecto para garantizar un entorno
reproducible, profesional y alineado a un backend de nivel empresarial.

En esta fase **no se implementa lógica de negocio**, solo infraestructura,
estructura y convenciones.

---

## Scope
- Docker como único entorno de ejecución
- Laravel API base
- Arquitectura DDD-lite (estructura inicial)
- Autenticación básica
- Conexión a Postgres
- Conexión a RabbitMQ (infraestructura preparada)
- Primeros tests

---

## Deliverables
- docker-compose funcional
- Laravel API ejecutándose vía Nginx + PHP-FPM
- Postgres operativo con migraciones
- RabbitMQ operativo (cola preparada, sin uso funcional aún)
- Endpoint de health check
- Autenticación API básica
- Estructura de carpetas DDD-lite creada
- Tests iniciales ejecutables

---

## Implemented Components

### Infrastructure
- Docker Compose
- Nginx (reverse proxy)
- PHP-FPM (Laravel)
- Postgres
- RabbitMQ
- Queue worker container

### Application
- Laravel API base
- API versioning (`/api/v1`)
- Auth (login/logout)
- Health endpoint

### Domain
- Identity (estructura mínima)
- Audit (estructura base, sin lógica aún)

---

## API Endpoints

### Health
- `GET /api/v1/health`
  - Verifica que la API esté operativa

### Auth
- `POST /api/v1/auth/login`
- `POST /api/v1/auth/logout`
- `GET /api/v1/me`

---

## Architecture Decisions

### API-first
El backend se diseña exclusivamente como API REST,
pensado para ser consumido por frontend web o mobile.

### DDD-lite
Se utiliza una separación clara de responsabilidades:
- Domain
- Application
- Infrastructure
- Http

Sin aplicar DDD estricto para evitar sobreingeniería.

### Asynchronous-ready
RabbitMQ se configura desde el inicio para evitar
refactors posteriores cuando se incorporen notificaciones.

---

## Folder Structure (Initial)

```text
app/
├── Domain/
│   ├── Identity/
│   └── Audit/
├── Application/
├── Infrastructure/
├── Http/
│   ├── Controllers/
│   └── Requests/
routes/
└── api.php
