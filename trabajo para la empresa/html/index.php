<?php
session_start();
include("../php/conexion.php");

if (!isset($_SESSION['id']) || !isset($_SESSION['usuario']) || !isset($_SESSION['clase'])) {
    header("Location: login.html");
    exit();
}

$esAdmin = ($_SESSION['clase'] === 'admin');
$sqlStock = "SELECT id, Nombre, Valor FROM stock ORDER BY id ASC";
$resStock = $conn->query($sqlStock);
$productos = [];
if ($resStock && $resStock->num_rows > 0) {
    while ($r = $resStock->fetch_assoc()) { $productos[] = $r; }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taller de Motos Carlos Zampedri | Servicio técnico y repuestos</title>
    <meta name="description" content="Taller de Motos Carlos Zampedri en Los Charrúas. Servicio de mecánica integral, mantenimiento, repuestos y solicitud de turnos para tu moto.">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&family=Oswald:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/estilos.css">
</head>
<body>
    <header class="zampedri-header" id="inicio">
        <nav class="navbar navbar-expand-lg navbar-dark zampedri-navbar fixed-top">
            <div class="container">
                <a class="navbar-brand zampedri-brand" href="#inicio">
                    <img src="../img/logo.jpeg" alt="Logo Taller de Motos Carlos Zampedri" class="zampedri-brand-logo">
                    <span class="zampedri-brand-text">
                        <span class="zampedri-brand-top">TALLER DE MOTOS</span>
                        <span class="zampedri-brand-bottom">CARLOS ZAMPEDRI</span>
                    </span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuZampedri" aria-controls="menuZampedri" aria-expanded="false" aria-label="Alternar navegación">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="menuZampedri">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0 zampedri-nav-list align-items-lg-center">
                        <li class="nav-item"><a class="nav-link zampedri-nav-link" href="#inicio">Inicio</a></li>
                        <li class="nav-item"><a class="nav-link zampedri-nav-link" href="#servicios">Servicios</a></li>
                        <li class="nav-item"><a class="nav-link zampedri-nav-link" href="#precios">Repuestos y Precios</a></li>
                        <li class="nav-item"><a class="nav-link zampedri-nav-link" href="#turno">Solicitar Turno</a></li>
                        <li class="nav-item"><a class="nav-link zampedri-nav-link" href="#ubicacion">Ubicación</a></li>
                        <li class="nav-item"><span class="nav-link zampedri-user-pill">Hola, <?php echo htmlspecialchars($_SESSION['usuario']); ?><?php echo $esAdmin ? ' (Admin)' : ''; ?></span></li>
                        <li class="nav-item"><a class="nav-link zampedri-nav-link" href="../php/cerrar_sesion.php">Cerrar sesión</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="zampedri-hero">
            <div class="container h-100">
                <div class="row h-100 align-items-center">
                    <div class="col-lg-7">
                        <span class="zampedri-hero-badge">Mecánica integral · Repuestos · Atención personalizada</span>
                        <h1 class="zampedri-hero-title">Tu taller de confianza para mantener la moto siempre a punto</h1>
                        <p class="zampedri-hero-text">En el Taller de Motos Carlos Zampedri realizamos diagnóstico, mantenimiento, reparación y puesta a punto con experiencia, prolijidad y compromiso en cada trabajo.</p>
                        <div class="zampedri-hero-actions">
                            <a class="btn zampedri-btn-primary" href="#turno">SOLICITAR TURNO</a>
                            <a class="btn zampedri-btn-outline" href="#precios">VER REPUESTOS Y PRECIOS</a>
                        </div>
                        <div class="zampedri-hero-highlights">
                            <div class="zampedri-highlight"><strong>Servicio técnico</strong><span>Carburación, motor, frenos y eléctrico</span></div>
                            <div class="zampedri-highlight"><strong>Repuestos</strong><span>Insumos y accesorios para tu moto</span></div>
                            <div class="zampedri-highlight"><strong>Ubicación</strong><span>Av. Francisco Ramírez 2158, Los Charrúas</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main>
        <section class="zampedri-strip">
            <div class="container">
                <div class="row g-3 text-center text-md-start align-items-center">
                    <div class="col-md-4"><div class="zampedri-strip-item"><span class="zampedri-strip-title">Atención especializada</span><span class="zampedri-strip-text">Trabajos realizados con criterio técnico y dedicación.</span></div></div>
                    <div class="col-md-4"><div class="zampedri-strip-item"><span class="zampedri-strip-title">Múltiples marcas</span><span class="zampedri-strip-text">Zanella, Gilera, Honda, Yamaha, Rouser, Guerrero y Cerro.</span></div></div>
                    <div class="col-md-4"><div class="zampedri-strip-item"><span class="zampedri-strip-title">Turnos coordinados</span><span class="zampedri-strip-text">Solicitá tu turno online y organizá tu visita al taller.</span></div></div>
                </div>
            </div>
        </section>

        <section class="zampedri-section" id="servicios">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2 class="zampedri-section-title">Servicios del Taller</h2>
                        <p class="zampedri-section-subtitle">Soluciones de mecánica, mantenimiento y seguridad para el uso diario y exigente</p>
                    </div>
                </div>
                <div class="row g-4 mt-2">
                    <div class="col-lg-4 col-md-6">
                        <div class="zampedri-card-service h-100">
                            <div class="zampedri-card-service-icon">⚙</div>
                            <h3 class="zampedri-card-service-title">Mecánica General</h3>
                            <ul class="zampedri-list">
                                <li>Carburación, transmisión, horquilla y dirección</li>
                                <li>Rectificación de motor, mejoras y optimización</li>
                                <li>Instalación de accesorios y modificaciones</li>
                                <li>Revisión general y ajustes preventivos</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="zampedri-card-service h-100">
                            <div class="zampedri-card-service-icon">🔧</div>
                            <h3 class="zampedri-card-service-title">Puesta a Punto</h3>
                            <ul class="zampedri-list">
                                <li>Regulación de válvulas y control de componentes</li>
                                <li>Limpieza y puesta a punto del carburador</li>
                                <li>Revisión y limpieza de filtro de aire</li>
                                <li>Cambio de aceite y filtro</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="zampedri-card-service h-100">
                            <div class="zampedri-card-service-icon">🛡</div>
                            <h3 class="zampedri-card-service-title">Seguridad y Eléctrico</h3>
                            <ul class="zampedri-list">
                                <li>Revisión de frenos y cambio de pastillas</li>
                                <li>Revisión y carga de batería</li>
                                <li>Control de ajustes para una conducción segura</li>
                                <li>Asesoramiento técnico según cada necesidad</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="zampedri-section zampedri-section-alt" id="marcas">
            <div class="container">
                <div class="row align-items-center g-4">
                    <div class="col-lg-5">
                        <h2 class="zampedri-section-title">Marcas que atendemos</h2>
                        <p class="zampedri-section-subtitle">Experiencia en motos de las principales marcas del mercado, con diagnóstico y mantenimiento adaptado a cada modelo.</p>
                        <div class="zampedri-info-box mt-3">
                            <h3 class="zampedri-info-title">¿Por qué elegirnos?</h3>
                            <ul class="zampedri-list mb-0">
                                <li>Atención directa y trato personalizado</li>
                                <li>Enfoque en durabilidad, rendimiento y seguridad</li>
                                <li>Repuestos e insumos con precios claros</li>
                                <li>Gestión de turnos desde la web</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="zampedri-brands-wrap">
                            <div class="zampedri-brand-pill">Zanella</div>
                            <div class="zampedri-brand-pill">Gilera</div>
                            <div class="zampedri-brand-pill">Honda</div>
                            <div class="zampedri-brand-pill">Yamaha</div>
                            <div class="zampedri-brand-pill">Rouser</div>
                            <div class="zampedri-brand-pill">Guerrero</div>
                            <div class="zampedri-brand-pill">Cerro</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="zampedri-section" id="precios">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2 class="zampedri-section-title">Repuestos y Precios</h2>
                        <p class="zampedri-section-subtitle">Productos e insumos disponibles. Los valores pueden actualizarse según stock y disponibilidad.</p>
                    </div>
                </div>

                <?php if ($esAdmin): ?>
                <div class="row mt-4 justify-content-center">
                    <div class="col-lg-10">
                        <div class="zampedri-form-wrap">
                            <h3 class="zampedri-section-title text-center" style="font-size:1.5rem; letter-spacing:3px;">Administrar Repuestos y Precios</h3>
                            <p class="text-center zampedri-note mb-3">Como administrador podés agregar, modificar o eliminar productos desde esta sección.</p>
                            <form action="../php/stock_acciones.php" method="post" class="row g-3 mt-1">
                                <input type="hidden" name="accion" value="agregar">
                                <div class="col-md-6">
                                    <label class="form-label zampedri-label">Nombre del producto / servicio</label>
                                    <input type="text" class="form-control zampedri-input" name="nombre" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label zampedri-label">Precio</label>
                                    <input type="number" class="form-control zampedri-input" name="valor" required>
                                </div>
                                <div class="col-md-2 d-flex align-items-end">
                                    <button type="submit" class="btn zampedri-btn-primary w-100" style="padding:0.8rem 1rem;">AGREGAR</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center mt-4">
                    <div class="col-lg-10">
                        <div class="table-responsive zampedri-table-wrap">
                            <table class="table table-dark table-striped align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th>Producto / Servicio</th>
                                        <th class="text-end">Precio</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (count($productos) > 0): foreach ($productos as $row): ?>
                                    <tr>
                                        <form action="../php/stock_acciones.php" method="post">
                                            <input type="hidden" name="accion" value="editar">
                                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                            <td><input type="text" class="form-control zampedri-input" name="nombre" value="<?php echo htmlspecialchars($row['Nombre']); ?>" required></td>
                                            <td class="text-end"><input type="number" class="form-control zampedri-input text-end" name="valor" value="<?php echo htmlspecialchars($row['Valor']); ?>" required></td>
                                            <td class="text-center">
                                                <div class="d-flex flex-column flex-md-row gap-2 justify-content-center">
                                                    <button type="submit" class="btn btn-warning btn-sm">GUARDAR</button>
                                        </form>
                                        <form action="../php/stock_acciones.php" method="post" onsubmit="return confirm('¿Eliminar este item?');">
                                            <input type="hidden" name="accion" value="eliminar">
                                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                            <button type="submit" class="btn btn-danger btn-sm">ELIMINAR</button>
                                        </form>
                                                </div>
                                            </td>
                                    </tr>
                                    <?php endforeach; else: ?>
                                    <tr><td colspan="3" class="text-center py-4">No hay precios cargados en este momento.</td></tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <?php else: ?>
                <div class="row g-4 mt-2">
                    <?php if (count($productos) > 0): foreach ($productos as $row): ?>
                    <div class="col-lg-4 col-md-6">
                        <article class="zampedri-card-product h-100">
                            <div class="zampedri-card-product-body">
                                <span class="zampedri-card-product-tag">Repuesto / Insumo</span>
                                <h3 class="zampedri-card-product-title"><?php echo htmlspecialchars($row['Nombre']); ?></h3>
                                <div class="zampedri-card-product-price">$ <?php echo number_format((int)$row['Valor'], 0, ',', '.'); ?></div>
                                <p class="zampedri-card-product-note">Consultá disponibilidad y coordiná tu turno para colocación o retiro.</p>
                                <a href="#turno" class="btn zampedri-btn-outline mt-auto">Solicitar turno</a>
                            </div>
                        </article>
                    </div>
                    <?php endforeach; else: ?>
                    <div class="col-12 text-center"><p class="zampedri-note">No hay precios cargados en este momento.</p></div>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>
        </section>

        <section class="zampedri-section zampedri-section-alt" id="galeria">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2 class="zampedri-section-title">Trabajos y Taller</h2>
                        <p class="zampedri-section-subtitle">Un espacio orientado al servicio técnico, la prolijidad y la confianza</p>
                    </div>
                </div>
                <div class="row mt-2 justify-content-center">
                    <div class="col-lg-10">
                        <div id="zampedriCarousel" class="carousel slide zampedri-carousel" data-bs-ride="carousel">
                            <div class="carousel-indicators">
                                <button type="button" data-bs-target="#zampedriCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Foto 1"></button>
                                <button type="button" data-bs-target="#zampedriCarousel" data-bs-slide-to="1" aria-label="Foto 2"></button>
                                <button type="button" data-bs-target="#zampedriCarousel" data-bs-slide-to="2" aria-label="Foto 3"></button>
                            </div>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="../img/foto1.jpg" class="d-block w-100 zampedri-carousel-img" alt="Taller de Motos Carlos Zampedri - Trabajo realizado" loading="lazy" decoding="async">
                                    <div class="carousel-caption d-none d-md-block zampedri-carousel-caption"><p>Servicio técnico y mantenimiento integral</p></div>
                                </div>
                                <div class="carousel-item">
                                    <img src="../img/foto2.jpg" class="d-block w-100 zampedri-carousel-img" alt="Mantenimiento y reparación de motos" loading="lazy" decoding="async">
                                    <div class="carousel-caption d-none d-md-block zampedri-carousel-caption"><p>Puesta a punto, ajustes y reparación</p></div>
                                </div>
                                <div class="carousel-item">
                                    <img src="../img/foto3.jpg" class="d-block w-100 zampedri-carousel-img" alt="Atención a distintas marcas de motos" loading="lazy" decoding="async">
                                    <div class="carousel-caption d-none d-md-block zampedri-carousel-caption"><p>Atención para múltiples marcas y modelos</p></div>
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#zampedriCarousel" data-bs-slide="prev"><span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="visually-hidden">Anterior</span></button>
                            <button class="carousel-control-next" type="button" data-bs-target="#zampedriCarousel" data-bs-slide="next"><span class="carousel-control-next-icon" aria-hidden="true"></span><span class="visually-hidden">Siguiente</span></button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="zampedri-section" id="turno">
            <div class="container">
                <div class="row g-4 align-items-start">
                    <div class="col-lg-5">
                        <h2 class="zampedri-section-title">Solicitá tu turno</h2>
                        <p class="zampedri-section-subtitle">Completá el formulario y coordinamos la atención de tu moto en el taller.</p>
                        <div class="zampedri-info-box mt-3">
                            <h3 class="zampedri-info-title">Antes de tu visita</h3>
                            <ul class="zampedri-list mb-0">
                                <li>Indicá la marca, modelo y el servicio que necesitás.</li>
                                <li>Podés detallar fallas, ruidos o trabajos previos en comentarios.</li>
                                <li>Te contactaremos para confirmar día y horario.</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="zampedri-form-wrap">
                            <form id="formTurno" class="zampedri-form" action="../php/turno.php" method="post" novalidate>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="nombre" class="form-label zampedri-label">Nombre y Apellido *</label>
                                        <input type="text" class="form-control zampedri-input" id="nombre" name="nombre" required>
                                        <div class="invalid-feedback">Ingresá tu nombre y apellido.</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="telefono" class="form-label zampedri-label">Teléfono / Celular *</label>
                                        <input type="tel" class="form-control zampedri-input" id="telefono" name="telefono" required>
                                        <div class="invalid-feedback">Ingresá un teléfono de contacto válido.</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email" class="form-label zampedri-label">Correo Electrónico</label>
                                        <input type="email" class="form-control zampedri-input" id="email" name="email">
                                        <div class="invalid-feedback">Ingresá un correo electrónico válido.</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="marcaMoto" class="form-label zampedri-label">Marca de la Moto *</label>
                                        <select class="form-select zampedri-input" id="marcaMoto" name="marcaMoto" required>
                                            <option value="" selected disabled>Seleccionar marca</option>
                                            <option value="Zanella">Zanella</option>
                                            <option value="Gilera">Gilera</option>
                                            <option value="Honda">Honda</option>
                                            <option value="Yamaha">Yamaha</option>
                                            <option value="Rouser">Rouser</option>
                                            <option value="Guerrero">Guerrero</option>
                                            <option value="Cerro">Cerro</option>
                                            <option value="Otra">Otra</option>
                                        </select>
                                        <div class="invalid-feedback">Seleccioná la marca de tu moto.</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="modeloMoto" class="form-label zampedri-label">Modelo / Cilindrada *</label>
                                        <input type="text" class="form-control zampedri-input" id="modeloMoto" name="modeloMoto" required>
                                        <div class="invalid-feedback">Ingresá el modelo o cilindrada.</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="servicioSolicitado" class="form-label zampedri-label">Servicio a Solicitar *</label>
                                        <select class="form-select zampedri-input" id="servicioSolicitado" name="servicioSolicitado" required>
                                            <option value="" selected disabled>Seleccionar servicio</option>
                                            <option value="Carburación / Transmisión / Horquilla y Dirección">Carburación / Transmisión / Horquilla y Dirección</option>
                                            <option value="Rectificación de motor / Mejoras y optimización">Rectificación de motor / Mejoras y optimización</option>
                                            <option value="Accesorios / Modificaciones">Accesorios / Modificaciones</option>
                                            <option value="Regulación de válvulas">Regulación de válvulas</option>
                                            <option value="Limpieza y puesta a punto del carburador">Limpieza y puesta a punto del carburador</option>
                                            <option value="Cambio de aceite y filtro">Cambio de aceite y filtro</option>
                                            <option value="Revisión / Limpieza de filtro de aire">Revisión / Limpieza de filtro de aire</option>
                                            <option value="Revisión de frenos / Cambio de pastillas">Revisión de frenos / Cambio de pastillas</option>
                                            <option value="Revisión y carga de batería">Revisión y carga de batería</option>
                                            <option value="Revisión general y ajustes">Revisión general y ajustes</option>
                                            <option value="Otro">Otro (especificar en comentarios)</option>
                                        </select>
                                        <div class="invalid-feedback">Seleccioná el servicio que necesitás.</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="fechaPreferida" class="form-label zampedri-label">Fecha preferida</label>
                                        <input type="date" class="form-control zampedri-input" id="fechaPreferida" name="fechaPreferida">
                                    </div>
                                    <div class="col-12">
                                        <label for="comentarios" class="form-label zampedri-label">Comentarios / Detalles del trabajo</label>
                                        <textarea class="form-control zampedri-textarea" id="comentarios" name="comentarios" rows="4" placeholder="Contanos brevemente qué necesitás revisar o reparar."></textarea>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1" id="acepto" required>
                                            <label class="form-check-label zampedri-check" for="acepto">Confirmo que los datos ingresados son correctos para coordinar el turno. *</label>
                                            <div class="invalid-feedback">Debés confirmar para poder enviar el formulario.</div>
                                        </div>
                                    </div>
                                    <div class="col-12 text-center text-lg-start">
                                        <button type="submit" class="btn zampedri-btn-primary zampedri-btn-form">ENVIAR SOLICITUD DE TURNO</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="zampedri-section zampedri-section-alt" id="ubicacion">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2 class="zampedri-section-title">Ubicación y Contacto</h2>
                        <p class="zampedri-section-subtitle">Encontranos en Los Charrúas y seguinos en nuestras redes</p>
                    </div>
                </div>
                <div class="row g-4 mt-2 align-items-stretch">
                    <div class="col-lg-5">
                        <div class="zampedri-info-box h-100">
                            <h3 class="zampedri-info-title">Taller de Motos Carlos Zampedri</h3>
                            <p class="zampedri-info-text"><strong>Actividad:</strong> Servicio de mecánica de motos en general</p>
                            <p class="zampedri-info-text"><strong>Dirección:</strong> Av. Francisco Ramírez 2158 – Los Charrúas</p>
                            <div class="zampedri-redes mt-2">
                                <a class="zampedri-red-link" href="https://www.facebook.com/carlos.zampedri" target="_blank" rel="noopener noreferrer">Facebook</a>
                                <a class="zampedri-red-link" href="https://www.instagram.com/zampedri" target="_blank" rel="noopener noreferrer">Instagram</a>
                                <a class="zampedri-red-link" href="https://www.tiktok.com/@carloszampedri" target="_blank" rel="noopener noreferrer">TikTok</a>
                            </div>
                            <a class="btn zampedri-btn-primary mt-3" href="https://maps.google.com/?q=Av%20Francisco%20Ramirez%202158%20Los%20Charruas" target="_blank" rel="noopener noreferrer">CÓMO LLEGAR</a>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="zampedri-map-wrap h-100">
                            <iframe class="zampedri-map" src="https://www.google.com/maps?q=Av%20Francisco%20Ramirez%202158%20Los%20Charruas&output=embed" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="Ubicación del Taller de Motos Carlos Zampedri"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="zampedri-footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p class="zampedri-footer-brand">TALLER DE MOTOS - CARLOS ZAMPEDRI</p>
                    <p class="zampedri-footer-text">Servicio técnico, mantenimiento y repuestos para tu moto | Av. Francisco Ramírez 2158 – Los Charrúas</p>
                    <p class="zampedri-footer-copy">&copy; <span id="anioFooter"></span> Taller de Motos Carlos Zampedri. Todos los derechos reservados.</p>
                </div>
            </div>
        </div>
        <a href="#inicio" class="zampedri-back-top" id="btnVolverArriba" aria-label="Volver arriba">↑</a>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/app.js"></script>
</body>
</html>
<?php $conn->close(); ?>
