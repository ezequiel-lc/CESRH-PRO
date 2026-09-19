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
    <h1 class="title">INFORME DE INSTRUCTOR</h1>
    
    <div class="profile-container">
        <img class="profile" src="{{ $usuario->profile_photo_path ? asset('storage/' . $usuario->profile_photo_path) : asset('img/user.png') }}" alt="Perfil">
    </div>
    
    <h2 class="section-title">Datos Personales</h2>
    <table class="table">
        <tr>
            <th>Nombre</th><td>{{ $usuario->name ?? 'Sin Nombre' }}</td>
            <th>Contacto</th><td> + 52 | {{ $instructor->telefono1 ?? 'No disponible' }}</td>
        </tr>
        <tr>
            <th>Contacto adicional</th><td> +52 | {{ $instructor->telefono2 }}</td>
            <th>Registro STPS</th><td>{{ $instructor->registroStps }}</td>
        </tr>
        <tr>
            <th>RFC</th><td>{{ $instructor->rfc }}</td>
            <th>Regimen</th><td>{{ $instructor->regimen }}</td>
        </tr>
        <tr>
            <th>Estado</th><td>{{ $instructor->estado }}</td>
            <th>Municipio</th><td>{{ $instructor->municipio }}</td>
        </tr>
        <tr>
            <th>Colonia</th><td>{{ $instructor->colonia }}</td>
            <th>Calle</th><td>{{ $instructor->calle }}</td>
        </tr>
        <tr>
            <th>Número de Calle</th><td>{{ $instructor->numero}}</td>
            <th>Código Postal</th><td>{{ $instructor->codigopostal }}</td>
        </tr>
        <tr>
            <th>Honorarios</th><td>{{ $instructor->honorarios }}</td>
            <th>Status</th>
            <td><span class="status {{ $instructor->status === 'Activo' ? 'status-aprobada' : 'status-rechazada' }}">{{ $instructor->status }}</span></td>
        </tr>
        <tr>
            <th>DC5</th><td>{{ $instructor->dc5 }}</td>
            <th>Cuenta Bancaria</th><td>{{ $instructor->cuentabancaria }}</td>
        </tr>
        <tr>
            <th>INE</th><td>{{ $instructor->ine }}</td>
            <th>CURP</th><td>{{ $instructor->curp }}</td>
        </tr>
        <tr>
            <th>SAT</th><td>{{ $instructor->sat}}</td>
            <th>Domicilio</th><td>{{ $instructor->domicilio }}</td>
        </tr>
        <tr>
            <th>Tipo Instructor</th><td>{{ $instructor->tipoinstructor}}</td>
            <th>Código Postal</th><td>{{ $instructor->codigopostal }}</td>
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
            <th>Regimen de la empresa</th><td>{{ $instructor->regimen_empre}}</td>
        </tr>
        <tr>
            <th>Nombre de la empresa</th><td>{{ $instructor->nombre_empresa}}</td>
            <th>RFC de la empresa</th><td>{{ $instructor->rfc_empre }}</td>
        </tr>
        <tr>
            <th>Estado de la empresa</th><td>{{ $instructor->estado_empre}}</td>
            <th>Municipio de la empresa</th><td>{{ $instructor->municipio_empre }}</td>
        </tr>
        <tr>
            <th>Colonia de la empresa</th><td>{{ $instructor->colonia_empre}}</td>
            <th>Código Postal</th><td>{{ $instructor->postal_empre }}</td>
        </tr>
        <tr>
            <th>Calle de la empresa</th><td>{{ $instructor->calle_empre}}</td>
            <th>Num de Calle</th><td>{{ $instructor->numero_empre }}</td>
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
