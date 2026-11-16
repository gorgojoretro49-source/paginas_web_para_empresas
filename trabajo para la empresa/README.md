# Taller de Motos Carlos Zampedri

Sitio web para el **Taller de Motos Carlos Zampedri** orientado a presentar el negocio, mostrar servicios y repuestos/precios, gestionar solicitudes de turno y permitir la administración de precios desde la propia página (según el rol del usuario).

## Descripción general
El proyecto incluye:
- **Acceso con inicio de sesión** (pantalla inicial de login).
- **Registro de usuarios**: las cuentas nuevas se crean automáticamente con rol `usuario`.
- **Roles**:
  - **Administrador (`admin`)**: puede ver el sitio y **agregar, editar o eliminar repuestos/precios** desde la sección “Repuestos y Precios”.
  - **Usuario (`usuario`)**: puede ver el sitio, consultar repuestos/precios y solicitar turnos, **sin permisos de modificación**.
- **Sitio principal responsive** con secciones de inicio, servicios, marcas, repuestos/precios, galería, solicitud de turno y ubicación/contacto.
- **Persistencia en MySQL** para usuarios, stock/precios y turnos.

## Tecnologías utilizadas
- **HTML5** (estructura y páginas de acceso)
- **CSS3** (estilos propios)
- **Bootstrap 5** (diseño responsive y componentes)
- **JavaScript (vanilla)** (`js/app.js`: interacción UI y validación del formulario en cliente)
- **PHP** (sesiones, autenticación, lógica de negocio y acceso a datos)
- **MySQL / MariaDB** (base de datos, mediante `mysqli`)

## Estructura del proyecto
```text
.
├── index.php                  # Redirige a la pantalla de inicio de sesión
├── html/
│   ├── login.html             # Inicio de sesión (primera pantalla)
│   ├── registro.html          # Registro de cuentas (rol usuario)
│   └── index.php              # Sitio principal (requiere sesión)
├── css/
│   ├── login.css              # Estilos de login y registro
│   └── estilos.css            # Estilos del sitio principal
├── js/
│   └── app.js                 # Comportamiento del sitio (UI, validación de turno)
├── php/
│   ├── conexion.php           # Conexión a la base de datos
│   ├── base_de_datos.php      # Creación de tablas y carga inicial de datos
│   ├── login.php              # Procesamiento de inicio de sesión
│   ├── registro.php           # Procesamiento de registro (crea usuarios)
│   ├── cerrar_sesion.php      # Cierre de sesión
│   ├── stock_acciones.php     # Alta/edición/eliminación de stock (solo admin)
│   └── turno.php              # Recepción y guardado de solicitudes de turno
├── img/
│   ├── logo.jpeg              # Logo del taller
│   ├── foto1.jpg              # Imagen de galería/hero
│   ├── foto2.jpg              # Imagen de galería
│   └── foto3.jpg              # Imagen de galería
└── README.md
```

## Requisitos
- Servidor web con **PHP** (por ejemplo, XAMPP, Laragon, WAMP o similar).
- **MySQL/MariaDB**.
- Navegador web moderno.

> Importante: el proyecto debe ejecutarse desde el servidor (`http://localhost/...`) para que los scripts PHP funcionen correctamente.

## Instalación y configuración
1. **Clonar o copiar** el proyecto en el directorio público del servidor (por ejemplo, `htdocs` en XAMPP).
2. **Configurar la conexión** en `php/conexion.php` según tu entorno:
   - Servidor: `localhost`
   - Usuario: `root` (por defecto)
   - Contraseña: vacía (por defecto)
   - Base de datos: `zampedribs`
3. **Crear la base de datos** `zampedribs` en MySQL (si no existe).
4. **Inicializar tablas y datos** ejecutando una vez en el navegador:
   - `http://localhost/<ruta-del-proyecto>/php/base_de_datos.php`

   Este script:
   - Crea/verifica las tablas `usuarios`, `stock` y `turnos`.
   - Carga el usuario administrador inicial (si no existe).
   - Inserta los productos/precios iniciales en `stock` (si la tabla está vacía).

## Acceso y roles
- **Inicio de sesión**: `index.php` (raíz) redirige a `html/login.html`.
- **Registro**: desde el login, el enlace **“Registrarse”** permite crear una cuenta nueva.
  - Las cuentas registradas se guardan siempre como **`usuario`**.
  - Tras registrarse, se redirige al login para iniciar sesión.
- **Administrador inicial (sembrado por `base_de_datos.php`)**:
  - Usuario: `ADMIN`
  - Contraseña: `s0yElA5m!`
  - Rol: `admin`
- **Comportamiento de acceso**:
  - Si las credenciales son incorrectas, se muestra un mensaje de error y se puede volver a intentar.
  - Las páginas PHP procesan la lógica y redirigen a páginas HTML/PHP correspondientes; la interfaz visible para el usuario es la del sitio (login, registro y página principal).

## Funcionalidades principales

### Sitio principal (`html/index.php`)
- Requiere sesión iniciada.
- Secciones: **Inicio/Hero**, **Servicios**, **Marcas**, **Repuestos y Precios**, **Galería**, **Solicitud de turno**, **Ubicación y contacto**.
- Diseño responsive con Bootstrap 5 y estilos propios.

### Repuestos y precios (gestionables)
- Los repuestos/precios se almacenan en la tabla `stock` de la base de datos.
- **Usuario**: visualiza los productos y precios (solo lectura).
- **Administrador**: puede **agregar, editar y eliminar** ítems desde la sección “Repuestos y Precios” sin modificar código (acciones procesadas por `php/stock_acciones.php`).

### Solicitud de turno
- Formulario en la sección “Solicitar Turno”.
- Validación en cliente (`js/app.js`) y validaciones básicas en servidor.
- Las solicitudes se guardan en la tabla `turnos` mediante `php/turno.php`.

### Galería e imágenes
- El carrusel utiliza `img/foto1.jpg`, `img/foto2.jpg` y `img/foto3.jpg`.
- El logo del sitio es `img/logo.jpeg`.
- Para actualizar la galería, se pueden reemplazar las imágenes manteniendo los mismos nombres y ubicación.

## Base de datos
Base: **`zampedribs`**

Tablas principales:
- **`usuarios`**: `id`, `usuario`, `contraseña`, `clase` (`admin` o `usuario`).
- **`stock`**: `id`, `Nombre`, `Valor`, `img` (repuestos/precios administrables).
- **`turnos`**: datos del solicitante, moto, servicio solicitado, fecha preferida, comentarios y fecha de registro.

## Datos del negocio
- **Taller:** Servicio de mecánica de motos en general – De Carlos Zampedri
- **Dirección:** Av. Francisco Ramírez 2158 – Los Charrúas
- **Facebook:** https://www.facebook.com/carlos.zampedri
- **Instagram:** https://www.instagram.com/zampedri
- **TikTok:** https://www.tiktok.com/@carloszampedri
- **Marcas atendidas:** Zanella, Gilera, Honda, Yamaha, Rouser, Guerrero, Cerro

## Notas
- `php/base_de_datos.php` es un script de inicialización/carga; se recomienda no dejarlo expuesto en entornos productivos una vez configurada la base de datos.
- Las contraseñas se manejan según la implementación actual del proyecto; para un entorno de producción se recomienda aplicar hashing seguro (`password_hash`/`password_verify`), HTTPS y endurecimiento adicional.
- Los precios y la disponibilidad pueden variar y se administran desde la base de datos/interfaz de administración.
