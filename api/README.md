# API CMDB - Clocimodel Data Basement

## Descripción

La API de CMDB (Clocimodel Data Basement) fue desarrollada en PHP utilizando una arquitectura basada en Modelo-Controlador-Rutas (Model - Controller - Routes), permitiendo la comunicación entre aplicaciones mediante servicios web REST.

La API facilita la gestión de la información almacenada en la base de datos MySQL del proyecto CMDB, permitiendo administrar clientes, citas, pagos, planos, historial y autenticación de usuarios.

---

# Tecnologías utilizadas

- PHP 8
- MySQL
- XAMPP
- Apache
- JSON
- Git
- GitHub

---

# Arquitectura del proyecto

```
api/

controllers/

models/

routes/

index.php
```

Cada módulo está dividido en tres capas:

- Modelo
- Controlador
- Rutas

---

# Endpoints

## Login

### Inicio de sesión

GET

```
/api/?module=login&action=login
```

Parámetros

| Campo | Tipo |
|---------|---------|
| usuario | String |
| password | String |

---

## Clientes

### Listar clientes

GET

```
/api/?module=clientes&action=listar
```

---

### Registrar cliente

POST

```
/api/?module=clientes&action=registrar
```

Parámetros

- nombre
- telefono
- correo

---

### Actualizar cliente

POST

```
/api/?module=clientes&action=actualizar
```

Parámetros

- idPrimaria
- nombre
- telefono
- correo

---

### Eliminar cliente

POST

```
/api/?module=clientes&action=eliminar
```

Parámetros

- idPrimaria

---

# Citas

### Listar

GET

```
/api/?module=citas&action=listar
```

---

### Registrar

POST

```
/api/?module=citas&action=registrar
```

Parámetros

- cliente
- fecha
- descripcion
- cliente_id

---

### Actualizar

POST

```
/api/?module=citas&action=actualizar
```

---

### Eliminar

POST

```
/api/?module=citas&action=eliminar
```

---

# Pagos

### Listar

GET

```
/api/?module=pagos&action=listar
```

---

### Registrar

POST

```
/api/?module=pagos&action=registrar
```

Parámetros

- cliente
- valor
- fecha
- cliente_id

---

# Planos

### Listar

GET

```
/api/?module=planos&action=listar
```

---

### Registrar

POST

```
/api/?module=planos&action=registrar
```

Parámetros

- nombre
- tipo
- descripcion
- cliente_id

---

### Eliminar

POST

```
/api/?module=planos&action=eliminar
```

---

# Historial

### Listar

GET

```
/api/?module=historial&action=listar
```

---

### Registrar

POST

```
/api/?module=historial&action=registrar
```

Parámetros

- accion

---

# Formato de respuesta

La API responde utilizando JSON.

Ejemplo:

```json
{
    "success": true,
    "message": "Operación realizada correctamente."
}
```

---

# Versionamiento

El proyecto utiliza Git para el control de versiones y GitHub como repositorio remoto.

---

# Autor

Andrés Felipe

Proyecto Formativo CMDB

SENA