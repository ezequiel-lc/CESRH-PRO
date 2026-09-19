<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
<style>
    body { font-family: 'Open Sans', sans-serif; font-size: 14px; margin: 0; padding: 20px; background: #f4f4f4; }
    .header { text-align: center; }
    .logo { width: 100%; max-height: 150px; object-fit: contain; }
    .profile-container { text-align: center; margin: 20px 0; }
    .profile { width: 120px; height: 120px; border-radius: 50%; border: 3px solid #ccc; }
    .title { text-align: center; font-size: 22px; font-weight: bold; margin: 20px 0; }
    .section-title { font-size: 22px; font-weight: bold; margin: 20px 0; }
    
    .grid-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        gap: 15px;
    }

    .card {
        width: calc(33.33% - 10px); /* Se asegura de que entren 3 tarjetas por fila */
        background: white;
        border-radius: 10px;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        padding: 15px;
        text-align: center;
        box-sizing: border-box; /* Evita que el padding afecte el ancho total */
    }

    /* Ajustes para pantallas más pequeñas */
    @media (max-width: 992px) {
        .card {
            width: calc(50% - 10px); /* 2 tarjetas por fila en pantallas medianas */
        }
    }

    @media (max-width: 600px) {
        .card {
            width: 100%; /* 1 tarjeta por fila en móviles */
        }
    }



    .card img { width: 100%; height: auto; border-top-left-radius: 10px; border-top-right-radius: 10px; }
    .status { padding: 5px 10px; border-radius: 5px; color: white; display: inline-block; }
    .status-aprobada { background-color: rgb(34, 197, 94); }
    .status-pendiente { background-color: rgb(234, 179, 8); }
    .status-rechazada { background-color: rgb(239, 68, 68); }
    .table { width: 100%; border-collapse: collapse; margin-top: 10px; }
    .table th, .table td { padding: 10px; border: 1px solid #ddd; text-align: left; }
    .table th { background: #000099; color: white; }
</style>

<div>
    <h1 class="title">INFORME DE TRABAJADOR</h1>
    
    <div class="profile-container">
        <img class="profile" src="{{ $usuario->profile_photo_path ? asset('storage/' . $usuario->profile_photo_path) : asset('img/user.png') }}" alt="Perfil">
    </div>
    
    <h2 class="section-title">Datos Personales</h2>
    <table class="table">
        <tr>
            <th>Nombre</th><td>{{ $usuario->name ?? 'Sin Nombre' }}</td>
            <th>Clave de Trabajador</th><td> {{ $trabajador->clave_trabajador }}</td>
        </tr>
        <tr>
            <th>NSS</th><td> +52 | {{ $trabajador->numero_seguridad_social }}</td>
            <th>Fecha de nacimiento</th><td>{{ $trabajador->fecha_nacimiento }}</td>
        </tr>
        <tr>
            <th>Estado</th><td>{{ $trabajador->estado }}</td>
            <th>Lugar de nacimiento</th><td>{{ $trabajador->lugar_nacimiento }}</td> 
        </tr>
        <tr>
            <th>Colonia</th><td>{{ $trabajador->colonia }}</td>
            <th>Código Postal</th><td>{{ $trabajador->codigo_postal }}</td>
        </tr>
        <tr>
            <th>Calle</th><td>{{ $trabajador->calle }}</td>
            <th>Número</th><td>{{ $trabajador->numero }}</td>
        </tr>
        <tr>
            <th>Sexo</th><td>{{ $trabajador->sexo }}</td>
            <th>CURP</th><td>{{ $trabajador->curp }}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td><span class="status {{ $trabajador->status === 'Activo' ? 'status-aprobada' : 'status-rechazada' }}">
                {{ $trabajador->status }}</span>
            </td>
            <th>Número de celular</th><td>+52 | {{ $trabajador->numero_celular }}</td>
        </tr>
        <tr>
            <th>Fecha de ingreso</th><td>{{ $trabajador->fecha_ingreso }}</td>
            <th>Edad</th><td>{{ $trabajador->edad }}</td>
        </tr>
        <tr>
            <th>Estado Civil</th><td>{{ $trabajador->estado_civil }}</td>
            <th>Nivel de estudios</th><td>{{ $trabajador->estudios }}</td>
        </tr>
    </table>
    
    <h2 class="section-title">Información Laboral</h2>
    <table class="table">
        <tr>
            <th>Registro Patronal</th><td>{{ $registro_patronal->registro_patronal ?? 'Sin Registro' }}</td>
            <th>Empresa</th><td>{{ $empresa->nombre ?? 'Sin Empresa' }}</td>
        </tr>
        <tr>
            <th>Sucursal</th><td>{{ $sucursal->nombre_sucursal ?? 'Sin Sucursal' }}</td>
            <th>Departamento</th><td>{{ $departamento->nombre_departamento ?? 'Sin Departamento' }}</td>
        </tr>
        <tr>
            <th>Puesto</th><td>{{ $puesto->nombre_puesto ?? 'Sin Puesto' }}</td>
            <th>Tipo de personal</th><td>{{ $trabajador->tipo_personal}}</td>
        </tr>
        <tr>
            <th>Ocupación</th><td>{{ $trabajador->ocupacion }}</td>
            <th>Tipo de puesto</th><td>{{ $trabajador->tipo_puest }}</td>
        </tr>
        <tr>
            <th>Contratación</th><td>{{ $trabajador->contratacion }}</td>
            <th>Tipo de personal</th><td>{{ $trabajador->tipo_personal}}</td>
        </tr>
        <tr>
            <th>Jornada de trabajo</th><td>{{ $trabajador->jornada_trabajo }}</td>
            <th>Rotación de turno</th><td>{{ $trabajador->rotacion}}</td>
        </tr>
        <tr>
            <th>Experiencia</th><td>{{ $trabajador->experiencia }}</td>
            <th>Tiempo en el puesto</th><td>{{ $trabajador->tiempo_puesto}}</td>
        </tr>
        <tr>
            <th>Contratación</th><td>{{ $trabajador->contratacion }}</td>
        </tr>
    </table>

    <h2 class="section-title">Incapacidades</h2>
    <div class="grid-container">
        @foreach ($incapacidades as $incapacidad)
            <div class="card">
                <img src="{{ asset('img/cesrh.jpeg') }}" alt="Background">
                <p><strong>Usuario:</strong> {{ $incapacidad->users->first() ? $incapacidad->users->first()->name : 'Sin asignar' }}</p>
                <p><strong>Tipo de incapacidad:</strong> {{ $incapacidad->tipo }}</p>
                <p><strong>Motivo:</strong> {{ $incapacidad->motivo }}</p>
                <p class="my-2">
                    <strong>Status:</strong> 
                    <span class="status {{ $incapacidad->status === 'Pendiente' ? 'status-pendiente' : 
                       ($incapacidad->status === 'Aprobada' ? 'status-aprobada' : 'status-rechazada') }}">
                        {{ $incapacidad->status }}
                    </span>
                </p>                                             
                <p><strong>Fecha inicio:</strong> {{ $incapacidad->fecha_inicio }}</p>
                <p><strong>Fecha final:</strong> {{ $incapacidad->fecha_final }}</p>
            </div> <br>
        @endforeach
    </div>

    <h2 class="section-title">Incidencias</h2>

    <div class="grid-container">
        @foreach ($incidencias as $incidencia)
            <div class="card">
                <img src="{{ asset('img/cesrh.jpeg') }}" alt="Background">
                <p><strong>Usuario:</strong> {{ $incidencia->users->first() ? $incidencia->users->first()->name : 'Sin asignar' }}</p>
                <p><strong>Tipo de incidencia:</strong> {{ $incidencia->tipo_incidencia }}</p>
                <p><strong>Fecha inicio:</strong> {{ $incidencia->fecha_inicio }}</p>
                <p><strong>Fecha final:</strong> {{ $incidencia->fecha_final }}</p>
            </div> <br>
        @endforeach
    </div>

    
</div>
