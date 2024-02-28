<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Politicas de privacidad - Tu Repuesto Ya</title>
    <link rel="shortcut icon" href="{{ asset('img/logo tu repuesto ya/icono_pagina.webp') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/privacy-policy-styles.css') }}">
</head>

<body>
    <nav id="nav" class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid" style="max-width: 2080px;">
            <a title="Inicio" class="navbar-brand" href="{{ asset(route('servicios')) }}"><img decoding="async"
                    id="logo" src="{{ asset('img/logo-tu-repuesto.webp') }}" alt="Logo TuRepuestoYa"></a>
            <button class="navbar-toggler btn" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon ico-btn"></span>
            </button>
            <div class="collapse navbar-collapse container-op" id="navbarNavDropdown">
                <ul class="navbar-nav ml-auto flex-end-cel"
                    style="align-items: center;box-sizing: border-box; font-size: 120%;">

                    <li class="nav-item">
                        <div class="container_nav" id="Cnav1">
                            <a class="nav-link active" href="{{ route('servicios') }}" id="nav_e"
                                aria-current="page">Inicio</a>
                            <div
                                class="animate__animated animate__fadeInUp animate__delay-0s animate__faster nav_active">
                            </div>
                        </div>
                    </li>

                    <li class="nav-item">
                        <div class="container_nav" id="Cnav2">
                            <a class="nav-link nav_e1" href="{{route('servicios')}}#solicitud-de-repuestos">¿Cómo
                                funciona?</a>
                        </div>
                    </li>

                    <li class="nav-item">
                        <div class="container_nav" id="Cnav3">
                            <a class="nav-link nav_e1" href="{{route('servicios')}}#contacto">Contacto</a>
                        </div>
                    </li>

                    @guest
                        <li id="container_user" class="nav-item dropdown no-arrow">
                            <div class="container_nav container_flex container_flex_user">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: white;">
                                    <span class="nav_e1" class="mr-2 d-none d-lg-inline text-gray-600 small">¿Eres
                                        proveedor?</span>
                                </a>
                                <!-- Dropdown - User Information -->
                                <div class="dropdown-menu end-0 dropdown-menu-right shadow animated--grow-in"
                                    aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="{{ route('login') }}">
                                        <span class="fas fa-sign-in-alt fa-sm fa-fw mr-2 text-gray-400"></span>
                                        Iniciar sesión
                                    </a>
                                    <a class="dropdown-item" href="{{ route('register') }}">
                                        <span class="fas fa-user-plus fa-sm fa-fw mr-2 text-gray-400"></span>
                                        Registrarse
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">
                                        <span class="fas fa-info-circle fa-sm fa-fw mr-2 text-gray-400"></span>
                                        Saber cómo funciona
                                    </a>
                                </div>
                            </div>
                        </li>
                    @else
                        <li id="container_user" class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: white;">
                                <i class="fas fa-user" style="color: #b3b3b3 !important;"></i>
                                <span class="nav_e1"
                                    class="mr-2 d-none d-lg-inline text-gray-600 small">{{ $name }}</span>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu end-0 dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{ route('dashboard') }}">
                                    <i class="fas fa-home fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Administrador
                                </a>
                                <a class="dropdown-item" href="{{ route('profile') }}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Perfil
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Configuraciones
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Cerrar sesión
                                </a>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-body">
        <div class="container-flex-col">
            <main>
                <section>
                    <div class="padding">
                        <div class="container-flex-col">
                            <h1>Política de Privacidad</h1>

                            <div class="container">
                                <div class="padding">
                                    Apreciados Clientes, proveedores y suscriptores de Milano Rent a Car S.A.S. <br>
                                    <br>

                                    En virtud de la entrada en vigencia de la Ley Estatutaria 1581 del 2012 mediante la
                                    cual se dictan las disposiciones generales para la protección de datos personales, y
                                    su Decreto Reglamentario 1377 de 2013, Milano Rent a Car S.A.S, identificada con el
                                    Nit. 900.561.689, considerada como responsable y/o encargada del tratamiento de
                                    datos personales, requerimos su autorización para continuar con el tratamiento de
                                    sus datos personales almacenados en nuestras bases de datos, las cuales incluyen
                                    información que ustedes nos han reportado en desarrollo de las diferentes
                                    actividades realizadas por nuestra compañía, en particular los siguientes: nombres,
                                    número de documento de identificación, dirección, teléfono fijo y móvil,
                                    direcciones, correo electrónico, profesión. <br> <br>

                                    Finalidad:
                                    <ul>
                                        <li>El cumplimiento de obligaciones ofrecidas en nuestro programa de cliente
                                            fiel.</li>
                                        <li>Informar sobre nuestros productos y/o servicios y los cambios en los mismos.
                                        </li>
                                        <li>Adelantar procesos de evaluación sobre la calidad de nuestros productos y
                                            servicios</li>
                                        <li>Proveer productos y prestación de servicios de entretenimiento.</li>
                                        <li>Información comercial, publicitaria o promocional sobre los productos y/o
                                            servicios, eventos y/o promociones de tipo comercial o no de estas, con el
                                            fin de impulsar, invitar, dirigir, ejecutar, informar y de manera general,
                                            llevar a cabo campañas, promociones o concursos de carácter comercial o
                                            publicitario.</li>
                                        <li>Transferencia y transmisión de sus datos personales a terceros. La
                                            información y datos personales suministrados a Milano Rent a Car, podrán ser
                                            procesados, recolectados, almacenados, usados, circulados, suprimidos,
                                            compartidos, actualizados, las actividades mencionadas las podremos realizar
                                            a través de diferentes medios tales como correo físico, electrónico, celular
                                            o dispositivo móvil, vía mensajes de texto (1\1 S y/o MMS), o a través de
                                            cualquier medio análogo y/o digital de comunicación, conocido o por conocer.
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="w-100">
                                <h2>CAPITULO I</h2>
                            </div>
                            <div class="container">
                                <div class="padding">
                                    <h3><strong>DISPOSICIONES GENERALES</strong></h3> <br>
                                    <strong>Artículo 1.</strong> <br> <br>

                                    Identificación. <br> <br>

                                    El presente manual fue elaborado por Milano Rent a Car. (en adelante “Milano”),
                                    domiciliada en Barranquilla, Carrera 46 No. 85 - 61 Piso 2 Local 4 | Oficina
                                    principal.
                                    <br> <br>

                                    <strong>Artículo 2.</strong> <br> <br>

                                    Ley Aplicable. <br> <br>

                                    El presente manual se elaboró de conformidad con los artículos 15 y 20 de la
                                    Constitución Política de la Republica de Colombia y lo establecido en la Ley 1581 de
                                    2012 y el Decreto Reglamentario 1377 de 2013. <br> <br>

                                    <strong>Artículo 3.</strong> <br> <br>

                                    Ámbito de Aplicación. <br> <br>

                                    El presente Manual se aplica al tratamiento de los datos de carácter personal que
                                    recoja y maneje la Empresa Milano. <br> <br>

                                    <strong>Artículo 4.</strong> <br> <br>

                                    Objeto. <br> <br>

                                    Por medio del presente manual se da cumplimiento a lo establecido en el literal k)
                                    del artículo 17 de la Ley 1581 de 2012, que regula los deberes a los que están
                                    sometidos los responsables del tratamiento de los datos personales, dentro de las
                                    cuales se ordena adoptar un manual interno de políticas y procedimientos para
                                    garantizar el adecuado cumplimiento de mencionada Ley y en especial para la atención
                                    de consultas y reclamos. Así mismo tiene la finalidad de regular los procedimientos
                                    de recolección, manejo y tratamiento de los datos de carácter personal que realiza
                                    Milano, a fin de garantizar y proteger el derecho fundamental de habeas data en el
                                    marco de lo establecido en la misma ley. <br> <br>

                                    <strong>Artículo 5.</strong> <br> <br>

                                    Definiciones. <br> <br>

                                    Para efectos de facilitar la comprensión del presente manual, se hace la
                                    transcripción de las definiciones incluidas en el artículo 3 de la Ley 1581 de 2013
                                    y del Decreto 1377 de 2013: <br> <br>

                                    i. Autorización: Consentimiento previo, expreso e informado del Titular para llevar
                                    a cabo el Tratamiento de datos personales; <br><br>

                                    ii. Base de Datos: Conjunto organizado de datos personales que sea objeto de
                                    Tratamiento; <br><br>

                                    iii. Dato personal: Cualquier información vinculada o que pueda asociarse a una o
                                    varias personas naturales determinadas o determinables; <br><br>

                                    iv. Encargado del Tratamiento: Persona natural o jurídica, pública o privada, que
                                    por sí misma o en asocio con otros, realice el Tratamiento de datos personales por
                                    cuenta del Responsable del Tratamiento;<br><br>

                                    v. Responsable del Tratamiento: Persona natural o jurídica, pública o privada, que
                                    por sí misma o en asocio con otros, decida sobre la base de datos y/o el Tratamiento
                                    de los datos;<br><br>

                                    vi. Titular: Persona natural cuyos datos personales sean objeto de
                                    Tratamiento;<br><br>

                                    vii. Tratamiento: Cualquier operación o conjunto de operaciones sobre datos
                                    personales, tales como la recolección, almacenamiento, uso, circulación o
                                    supresión.<br><br>

                                    viii. Aviso de privacidad: Comunicación verbal o escrita generada por el
                                    Responsable, dirigida al Titular para el Tratamiento de sus datos personales,
                                    mediante la cual se le informa acerca de la existencia de las políticas de
                                    Tratamiento de información que le serán aplicables, la forma de acceder a las mismas
                                    y las finalidades del Tratamiento que se pretende dar a los datos
                                    personales.<br><br>

                                    ix. Dato público: Es el dato que no sea semiprivado, privado o sensible. Son
                                    considerados datos públicos, entre otros, los datos relativos al estado civil de las
                                    personas, a su profesión u oficio y a su calidad de comerciante o de servidor
                                    público. Por su naturaleza, los datos públicos pueden estar contenidos, entre otros,
                                    en registros públicos, documentos públicos, gacetas y boletines oficiales y
                                    sentencias judiciales debidamente ejecutoriadas que no estén sometidas a
                                    reserva.<br><br>

                                    x. Datos sensibles: Se entiende por datos sensibles aquellos que afectan la
                                    intimidad del Titular o cuyo uso indebido puede generar su discriminación, tales
                                    como aquellos que revelen el origen racial o étnico, la orientación política, las
                                    convicciones religiosas o filosóficas, la pertenencia a sindicatos, organizaciones
                                    sociales, de derechos humanos o que promueva intereses de cualquier partido político
                                    o que garanticen los derechos y garantías de partidos políticos de oposición, así
                                    como los datos relativos a la salud, a la vida sexual, y los datos
                                    biométricos.<br><br>

                                    xi. Transferencia: La transferencia de datos tiene lugar cuando el Responsable y/o
                                    Encargado del Tratamiento de datos personales, ubicado en Colombia, envía la
                                    información o los datos personales a un receptor, que a su vez es Responsable del
                                    Tratamiento y se encuentra dentro o fuera del país.<br><br>

                                    xii. Transmisión: Tratamiento de datos personales que implica la comunicación de los
                                    mismos dentro o fuera del territorio de la República de Colombia cuando tenga por
                                    objeto la realización de un Tratamiento por el Encargado por cuenta del Responsable.
                                    <br><br>

                                    <strong>Artículo 6.</strong> <br> <br>

                                    Principios. <br> <br>

                                    Los principios que se relacionan a continuación son los lineamientos que deben ser
                                    respetados por Milano en los procesos de recolección, almacenamiento, uso y
                                    tratamiento de datos personales. <br> <br>

                                    i. Principio de legalidad en materia de Tratamiento de datos: El Tratamiento a que
                                    se refiere la presente ley es una actividad reglada que debe sujetarse a lo
                                    establecido en ella y en las demás disposiciones que la desarrollen;<br><br>

                                    ii. Principio de finalidad: El Tratamiento debe obedecer a una finalidad legítima de
                                    acuerdo con la Constitución y la Ley, la cual debe ser informada al Titular;<br><br>

                                    iii. Principio de libertad: El Tratamiento sólo puede ejercerse con el
                                    consentimiento, previo, expreso e informado del Titular. Los datos personales no
                                    podrán ser obtenidos o divulgados sin previa autorización, o en ausencia de mandato
                                    legal o judicial que releve el consentimiento;<br><br>

                                    iv. Principio de veracidad o calidad: La información sujeta a Tratamiento debe ser
                                    veraz, completa, exacta, actualizada, comprobable y comprensible. Se prohíbe el
                                    Tratamiento de datos parciales, incompletos, fraccionados o que induzcan a
                                    error;<br><br>

                                    v. Principio de transparencia: En el Tratamiento debe garantizarse el derecho del
                                    Titular a obtener del Responsable del Tratamiento o del Encargado del Tratamiento,
                                    en cualquier momento y sin restricciones, información acerca de la existencia de
                                    datos que le conciernan;<br><br>

                                    vi. Principio de acceso y circulación restringida: El Tratamiento se sujeta a los
                                    límites que se derivan de la naturaleza de los datos personales, de las
                                    disposiciones de la presente ley y la Constitución. En este sentido, el Tratamiento
                                    sólo podrá hacerse por personas autorizadas por el Titular y/o por las personas
                                    previstas en la presente ley; Los datos personales, salvo la información pública, no
                                    podrán estar disponibles en Internet u otros medios de divulgación o comunicación
                                    masiva, salvo que el acceso sea técnicamente controlable para brindar un
                                    conocimiento restringido sólo a los Titulares o terceros autorizados conforme a la
                                    presente ley;
                                    <br><br>
                                    vii. Principio de seguridad: La información sujeta a Tratamiento por el Responsable
                                    del Tratamiento o Encargado del Tratamiento a que se refiere la presente ley, se
                                    deberá manejar con las medidas técnicas, humanas y administrativas que sean
                                    necesarias para otorgar seguridad a los registros evitando su adulteración, pérdida,
                                    consulta, uso o acceso no autorizado o fraudulento;<br><br>

                                    viii. Principio de confidencialidad: Todas las personas que intervengan en el
                                    Tratamiento de datos personales que no tengan la naturaleza de públicos están
                                    obligadas a garantizar la reserva de la información, inclusive después de finalizada
                                    su relación con alguna de las labores que comprende el Tratamiento, pudiendo sólo
                                    realizar suministro o comunicación de datos personales cuando ello corresponda al
                                    desarrollo de las actividades autorizadas en la presente ley y en los términos de la
                                    misma.
                                </div>
                            </div>

                            <div class="w-100">
                                <h2>CAPITULO II</h2>
                            </div>
                            <div class="container">
                                <div class="padding">
                                    <h3><strong>AUTORIZACIÓN</strong></h3> <br>

                                    <strong>Artículo 7.</strong> <br> <br>

                                    Autorización. <br> <br>

                                    El tratamiento de datos personales por parte de Milano requiere consentimiento,
                                    libre, previo, expreso e informado del titular de los mismos. Milano en su condición
                                    de responsable del tratamiento de los datos personales, ha dispuesto de los
                                    mecanismos necesarios para obtener la autorización de los titulares garantizando en
                                    todo caso que sea posible el otorgamiento de dicha autorización. <br> <br>

                                    <strong>Artículo 8.</strong> <br> <br>

                                    Forma y Mecanismo para Otorgar la Autorización. <br> <br>

                                    La autorización puede constar en cualquier mecanismo que permita garantizar su
                                    posterior consulta, la autorización podrá constar: <br> <br>

                                    i. por escrito, <br> <br>
                                    ii. de forma oral, <br> <br>
                                    iii. mediante conducta inequívocas del titular que permitan concluir de forma
                                    razonable que se otorgó la autorización; en ningún caso el silencio podrá asimilarse
                                    a una conducta inequívoca. Con el procedimiento de autorización consentida se
                                    garantiza que se ha puesto en conocimiento del titular de los datos personales,
                                    tanto el hecho de que su información personal será recogida y utilizada para los
                                    fines determinados y conocidos, así mismo que se le ha informado que cuenta con la
                                    opción de conocer cualquier alteración o modificación de la información y el uso
                                    específico que se le ha dado a los mismos. Lo anterior con el fin de que el titular
                                    de la información adopte decisiones informadas en relación con sus datos personales
                                    y controle el uso de la información personal. <br> <br>

                                    La autorización contendrá lo siguiente: <br> <br>

                                    a. Quién recopila (responsable o encargado) <br> <br>
                                    b. Qué recopila (datos que se recaban) <br><br>
                                    c. Para qué recoge los datos (las finalidades del tratamiento) <br><br>
                                    d. Cómo ejercer derechos de acceso, corrección, actualización o supresión de los
                                    datos personales suministrados <br><br>
                                    e. Si se recopilan datos sensibles, y la posibilidad de no darlos a conocer. <br>
                                    <br>

                                    <strong>Artículo 9.</strong> <br> <br>

                                    Prueba de Autorización. <br> <br>

                                    Milano, adoptará todas las mecanismos idóneos y necesarios con el fin de mantener el
                                    registro de cuando y como se obtuvo la autorización por parte de los titulares de
                                    los datos personales para el tratamiento de los mismos. <br> <br>

                                    <strong>Artículo 10.</strong> <br> <br>

                                    Aviso de Privacidad. <br> <br>

                                    El aviso de privacidad es el documento físico o electrónico que se pondrá a
                                    disposición del titular en el cual se pone en conocimiento de este, la existencia de
                                    las políticas de tratamiento de la información que serán aplicadas a sus datos
                                    personales, la forma de acceder a las mismas y el tipo de tratamiento que se llevara
                                    a cabo. El aviso de privacidad contendrá la siguiente información: <br> <br>

                                    a. Nombre o razón social y datos de contacto del responsable del tratamiento.
                                    <br><br>
                                    b. El Tratamiento al cual serán sometidos los datos y la finalidad del
                                    mismo.<br><br>
                                    c. Los derechos que le asisten al titular.<br><br>
                                    d. Los mecanismos dispuestos por el responsable para que el titular conozca la
                                    política de Tratamiento de la información y los cambios sustanciales que se
                                    produzcan en ella o en el Aviso de Privacidad correspondiente. En todos los casos,
                                    se informará al Titular de cómo acceder o consultar la política de Tratamiento de
                                    información. <br> <br>

                                </div>
                            </div>

                            <div class="w-100">
                                <h2>CAPITULO III</h2>
                            </div>
                            <div class="container">
                                <div class="padding">
                                    <h3><strong>DERECHOS Y DEBERES</strong></h3> <br>

                                    <strong>Artículo 11.</strong> <br> <br>

                                    Derechos de los Titulares de la Información. <br> <br>

                                    De conformidad con lo establecido en el artículo 8 de la Ley 1581 de 2012, el
                                    titular de la información tendrá los siguientes derechos: <br> <br>

                                    a. Conocer, actualizar y rectificar sus datos personales frente a los Responsables
                                    del Tratamiento o Encargados del Tratamiento. Este derecho se podrá ejercer, entre
                                    otros frente a datos parciales, inexactos, incompletos, fraccionados, que induzcan a
                                    error, o aquellos cuyo Tratamiento esté expresamente prohibido o no haya sido
                                    autorizado; <br><br>

                                    b. Solicitar prueba de la autorización otorgada al Responsable del Tratamiento salvo
                                    cuando expresamente se exceptúe como requisito para el Tratamiento, de conformidad
                                    con lo previsto en el artículo 10 de la presente ley; <br><br>

                                    c. Ser informado por el Responsable del Tratamiento o el Encargado del Tratamiento,
                                    previa solicitud, respecto del uso que le ha dado a sus datos personales; <br><br>

                                    d. Presentar ante la Superintendencia de Industria y Comercio quejas por
                                    infracciones a lo dispuesto en la presente ley y las demás normas que la modifiquen,
                                    adicionen o complementen; <br><br>

                                    e. Revocar la autorización y/o solicitar la supresión del dato cuando en el
                                    Tratamiento no se respeten los principios, derechos y garantías constitucionales y
                                    legales. La revocatoria y/o supresión procederá cuando la Superintendencia de
                                    Industria y Comercio haya determinado que en el Tratamiento el Responsable o
                                    Encargado han incurrido en conductas contrarias a esta ley y a la Constitución;
                                    <br><br>

                                    f. Acceder en forma gratuita a sus datos personales que hayan sido objeto de
                                    Tratamiento. <br> <br><br>

                                    <strong>Artículo 12.</strong> <br> <br>

                                    Deberes de Milano en Relación con el Tratamiento de los Datos Personales. <br> <br>

                                    Milano dará estricto cumplimiento, en su condición de responsable de la información,
                                    a las obligaciones contenidas en el artículo 17 de la Ley 1581 de 2012; así mismo es
                                    consciente de la importancia de observar las políticas y protocolos tendientes a
                                    proteger los datos personales de los titulares ya que es conocedor que los datos son
                                    propiedad de los titulares y solo estos últimos pueden decidir sobre los mismos.
                                    Consecuentemente Milano se obliga a cumplir con los siguientes deberes en relación
                                    con el tratamiento de datos personales:<br> <br>

                                    a. Garantizar al Titular, en todo tiempo, el pleno y efectivo ejercicio del derecho
                                    de hábeas data.<br><br>

                                    b. Solicitar y conservar, en las condiciones previstas en la ley, copia de la
                                    respectiva autorización otorgada por el Titular;<br><br>

                                    c. Informar debidamente al Titular sobre la finalidad de la recolección y los
                                    derechos que le asisten en virtud de la autorización otorgada;<br><br>

                                    d. Conservar la información bajo las condiciones de seguridad necesarias para
                                    impedir su adulteración, pérdida, consulta, uso o acceso no autorizado o
                                    fraudulento;<br><br>

                                    e. Garantizar que la información que se suministre al Encargado del Tratamiento sea
                                    veraz, completa, exacta, actualizada, comprobable y comprensible;<br><br>

                                    f. Actualizar la información, comunicando de forma oportuna al Encargado del
                                    Tratamiento, todas las novedades respecto de los datos que previamente le haya
                                    suministrado y adoptar las demás medidas necesarias para que la información
                                    suministrada a este se mantenga actualizada;<br><br>

                                    g. Rectificar la información cuando sea incorrecta y comunicar lo pertinente al
                                    Encargado del Tratamiento;<br><br>

                                    h. Suministrar al Encargado del Tratamiento, según el caso, únicamente datos cuyo
                                    Tratamiento esté previamente autorizado de conformidad con lo previsto en la
                                    ley;<br><br>

                                    i. Exigir al Encargado del Tratamiento, en todo momento, el respeto a las
                                    condiciones de seguridad y privacidad de la información del Titular;<br><br>

                                    j. Tramitar las consultas y reclamos formulados en los términos señalados en la
                                    ley;<br><br>

                                    k. Informar al Encargado del Tratamiento cuando determinada información se encuentra
                                    en discusión por parte del Titular, una vez se haya presentado la reclamación y no
                                    haya finalizado el trámite respectivo; <br><br>

                                    l. Informar a solicitud del Titular sobre el uso dado a sus datos; <br><br>

                                    m. Informar a la autoridad de protección de datos cuando se presenten violaciones a
                                    los códigos de seguridad y existan riesgos en la administración de la información de
                                    los Titulares.<br><br>

                                    n. Cumplir las instrucciones y requerimientos que imparta la Superintendencia de
                                    Industria y Comercio.

                                </div>
                            </div>

                            <div class="w-100">
                                <h2>
                                    CAPITULO IV
                                </h2>
                            </div>
                            <div class="container">
                                <div class="padding">
                                    <h3><strong>TRATAMIENTO AL CUAL SERÁN SOMETIDOS LOS DATOS Y FINALIDAD DEL
                                            MISMO</strong></h3> <br>

                                    <strong>Artículo 13.</strong>

                                    Tratamiento y Finalidad de los Datos. <br> <br>

                                    El tratamiento de los datos personales, entendiendo la misma como recolección,
                                    almacenamiento, uso, circulación o supresión se realizará para el cumplimiento del
                                    objeto social de Milano, incluyendo pero sin limitarse a: <br> <br>

                                    <ul>
                                        <li>Informar sobre nuestras promociones, ofertas, novedades, productos y
                                            servicios, alianzas, concursos, contenidos actuales y futuros relacionados
                                            con los eventos, concursos, actividades de promoción y otras finalidades
                                            comerciales directa o indirectamente relacionadas con nuestra actividad</li>
                                        <li>
                                            Informar sobre nuevos productos o servicios que estén relacionados con el o
                                            los contratado(s) o adquirido(s) o cambios en los mismos;
                                        </li>

                                        <li>Dar cumplimiento a obligaciones contraídas con nuestros clientes,
                                            proveedores, y empleados Titulares de Información;</li>

                                        <li>Evaluar la calidad del servicio;</li>

                                        <li>Realizar estudios internos sobre hábitos de consumo y estudios estadísticos
                                            que permitan diseñar mejoras en los productos y/o en los servicios
                                            prestados;</li>

                                        <li>
                                            Facilitar la correcta ejecución de las compras y prestación de los servicios
                                            contratados;
                                        </li>

                                        <li>
                                            Gestionar tareas básicas de administración.
                                        </li>
                                    </ul> <br>

                                    La base de datos busca tener actualizada la información con el fin de que la
                                    relación con clientes, proveedores, contratantes o contratistas se desarrolle de
                                    manera adecuada. El tratamiento de los datos personales no se limita a los eventos
                                    antes descritos, si no que el tratamiento de los mismos, se realizará en forma
                                    general para el desarrollo del objeto social de Milano y para cumplir las
                                    obligaciones legales.
                                </div>
                            </div>

                            <div class="w-100">
                                <h2>
                                    CAPITULO V
                                </h2>
                            </div>
                            <div class="container">
                                <div class="padding">
                                    <h3><strong>PERSONA O ÁREA RESPONSABLE DE LA ATENCIÓN DE LAS PETICIONES, CONSULTAS Y
                                            RECLAMOS</strong></h3> <br>

                                    <strong>Artículo 14.</strong> <br> <br>

                                    Persona o área responsable de la atención de peticiones, consultas y reclamos. <br>
                                    <br>

                                    Milano ha designado como área responsable de velar por el cumplimiento de esta
                                    política Servicio Al Cliente con el apoyo de Coordinador Call Center. Esta
                                    dependencia estará atenta para resolver peticiones, consultas y reclamos por parte
                                    de los titulares y para realizar cualquier actualización, rectificación y supresión
                                    de datos personales, a través del correo electrónico reservas@milanocar.com
                                    alfredo.aragon@milanocar.com <br> <br>

                                    <strong>Artículo 15.</strong> <br> <br>

                                    Datos de Contacto de Persona o Área Responsable del Tratamiento de la Información.
                                    <br> <br>
                                    Milano Rent a Car <br> <br>
                                    <ul>
                                        <li>Dirección correspondiente: Carrera 46 No. 85 - 61 Piso 2 Local 4
                                            Barranquilla, Atlantico</li>
                                        <li>Correo electrónico reservas@milanocar.com, jose.diaz@milanocar.com</li>
                                    </ul>
                                </div>
                            </div>

                            <div class="w-100">
                                <h2>CAPITULO VI</h2>
                            </div>
                            <div class="container">
                                <div class="padding">
                                    <h3><strong>PROCEDIMIENTO PARA LA ATENCIÓN DE CONSULTAS, RECLAMOS Y
                                            PETICIONES</strong></h3> <br>

                                    <strong>Artículo 16.</strong> <br> <br>

                                    Consultas. <br> <br>
                                    En aplicación de lo dispuesto en el artículo 14 de la Ley 1581 de 2012, los
                                    titulares o sus causahabientes podrán consultar la información personal del titular
                                    que repose en bases de datos administradas por Milano. El titular de la información
                                    podrá solicitar la consulta de su información por escrito o por medio electrónico al
                                    mail reservas@milanocar.com alfredo.aragon@milanocar.com, en estos casos, con el fin
                                    de proteger los datos personales, deberá adjuntar copia de los documentos de
                                    identidad vigentes. Cuando la información quiera ser consultada por los
                                    causahabientes, deberá formular su solicitud por medio escrito o electrónico,
                                    adjuntar documento que demuestre el parentesco y documento de identidad. Si revisado
                                    los documentos aportados y el nombre del Titular, se encuentra que hay conformidad
                                    en los mismos, se procederá a dar respuesta en un término de diez (10) días hábiles.
                                    En el evento en que Milano considere que requiere de un mayor tiempo para dar
                                    respuesta a la consulta, informará al Titular de tal situación y dará respuesta en
                                    un término que no excederá de cinco (5) días hábiles siguientes al vencimiento del
                                    término. <br> <br>

                                    <strong>Artículo 17.</strong> <br> <br>

                                    Reclamos. <br> <br>

                                    De conformidad con lo preceptuado en el artículo 15 de la Ley 1581 de 2012, el
                                    titular o los causahabientes que consideren que la información contenida en una base
                                    de datos debe ser objeto de corrección, actualización o supresión, o cuando advierta
                                    el presunto incumplimiento de cualquier deber contenido en la Ley, podrá presentar
                                    un reclamo ante Milano el cual será tramitado bajo el siguiente procedimiento: <br>
                                    <br>

                                    <ol>
                                        <li>El reclamo se formulará a Milano o al Encargado del Tratamiento, con la
                                            identificación del Titular, la descripción de los hechos que dan lugar al
                                            reclamo, la dirección, y acompañando los documentos que se quiera hacer
                                            valer.</li>
                                        <li>Si el reclamo resulta incompleto, se requerirá al interesado dentro de los
                                            cinco (5) días siguientes a la recepción del reclamo para que subsane las
                                            fallas.</li>

                                        <li>Transcurridos dos (2) meses desde la fecha del requerimiento, sin que el
                                            solicitante presente la información requerida, se entenderá que ha desistido
                                            del reclamo.</li>

                                        <li>En caso de que quien reciba el reclamo no sea competente para resolverlo,
                                            dará traslado a quien corresponda en un término máximo de dos (2) días
                                            hábiles e informará de la situación al interesado.</li>

                                        <li>Una vez recibido el reclamo completo, se incluirá en la base de datos una
                                            leyenda que diga “reclamo en trámite” y el motivo del mismo, en un término
                                            no mayor a dos (2) días hábiles. Dicha leyenda deberá mantenerse hasta que
                                            el reclamo sea decidido.</li>

                                        <li>El término máximo para atender el reclamo será de quince (15) días hábiles
                                            contados a partir del día siguiente a la fecha de su recibo. Cuando no fuere
                                            posible atender el reclamo dentro de dicho término, se informará al
                                            interesado los motivos de la demora y la fecha en que se atenderá su
                                            reclamo, la cual en ningún caso podrá superar los ocho (8) días hábiles
                                            siguientes al vencimiento del primer término.</li>
                                    </ol> <br>

                                    <strong>Artículo 18.</strong> <br> <br>

                                    Petición de Actualización, Rectificación y Supresión de Datos. <br> <br>

                                    Milano Rent a Car rectificará y actualizará, a solicitud del titular, la información
                                    de éste que resulte ser incompleta o inexacta, de conformidad con el procedimiento y
                                    los términos antes señalados, para lo cual el titular podrá formular su solicitud
                                    por escrito o por medio electrónico al mail reservas@milanocar.com,
                                    jose.diaz@milanocar.com, indicando la actualización, rectificación del dato y
                                    adjuntara la documentación que soporte su petición necesaria y valedera. <br> <br>

                                    <strong>Artículo 19.</strong> <br> <br>

                                    Revocatoria de La Autorización y/o Supresión del Dato. <br> <br>

                                    Los titulares de los datos personales pueden revocar el consentimiento al
                                    tratamiento de sus datos personales en cualquier momento, siempre y cuando no lo
                                    impida una disposición legal o contractual, para ello el titular podrá realizar la
                                    revocatoria por medio escrito o por medio electrónico al mail reservas@milanocar.com
                                    alfredo.aragon@milanocar.com. Si vencido el término legal respectivo, Milano, según
                                    fuera el caso, no hubieran suprimido los datos personales, el Titular tendrá derecho
                                    a solicitar a la Superintendencia de Industria y Comercio que ordene la revocatoria
                                    de la autorización y/o la supresión de los datos personales. Para estos efectos se
                                    aplicará el procedimiento descrito en el artículo 22 de la Ley 1581 de 2012. <br>
                                    <br>

                                    <strong>Artículo 20.</strong> <br> <br>

                                    Milano recaudará los datos que sean estrictamente necesarios para llevar a cabo las
                                    finalidades perseguidas y los conservará para alcanzar la necesidad con que se han
                                    registrado, así mismo respetará la libertad que tiene el Titular para autorizar o no
                                    el uso de sus datos personales, y en consecuencia, los mecanismos que utilice para
                                    obtener el consentimiento le permitirán al Titular manifestar de manera inequívoca
                                    que otorga tal autorización.

                                </div>
                            </div>

                            <div class="w-100">
                                <h2>CAPITULO VII</h2>
                            </div>
                            <div class="container">
                                <div class="padding">
                                    <h3><strong>SEGURIDAD DE LA INFORMACIÓN</strong></h3> <br>

                                    <strong>Artículo 21.</strong> <br> <br>

                                    Medidas de Seguridad. <br> <br>

                                    Milano adoptará las medidas técnicas, humanas y administrativas necesarias para
                                    garantizar la seguridad de los datos personales objeto de tratamiento, evitando su
                                    consulta o acceso no autorizada, adulteración o uso fraudulento.

                                </div>
                            </div>

                            <div class="w-100">
                                <h2>CAPITULO VIII</h2>
                            </div>
                            <div class="container">
                                <div class="padding">
                                    <h3><strong>FECHA DE ENTRADA EN VIGENCIA DE LA POLÍTICA DE TRATAMIENTO</strong></h3>
                                    <br>

                                    <strong>Artículo 22.</strong> <br> <br>

                                    Este Manual Interno de Políticas y Procedimientos para la Protección de Datos
                                    Personales de la Información, fue informado a nuestro equipo de trabajo en sus
                                    aspectos sustanciales y el cumplimiento obligatorio de todos y cada uno de los
                                    aspectos que componen el mismo, en consonancia con lo anterior, el presente manual
                                    empezará a regir dentro del marco establecido por la ley.
                                </div>
                            </div>
                        </div>
                    </div>

                </section>
            </main>

            <div class="container-footer">
                <div class="footer w-100">
                    <div class="container-flex">
                        <div class="container-items">
                            <a class="item" href="#">Terminos y condiciones</a>
                            <span class="item">|</span>
                            <a class="item" href="{{ route('privacy-policy') }}">Política de privacidad</a>
                            <span class="item">|</span>
                            <a class="item" href="#">Acerca de...</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cerrar sesión</h5>
                    <button class="close btn-close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body">Seguro que deseas cerrar esta sesión?
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <form id="logoutForm" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">Cerrar sesión</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('js/demo/chart-pie-demo.js') }}"></script>
    <script src="{{ asset('https://code.jquery.com/jquery-3.6.0.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>

</body>

</html>
