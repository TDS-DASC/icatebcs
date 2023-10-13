<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Instructor PDF</title>
    <style>
        /*------------------------------*/
        /*      ELEMENTOS GENERALES     */
        /*------------------------------*/
        @page {
            margin: 0cm 0cm;
            font-family: Arial;
        }

        body { 
            margin: 2.6cm 1.2cm 2cm; 
            line-height: 1;
        }

        h1, h2, h3 {
            margin: 0;
            padding: 0;
        }

        h1 { 
            font-size: 12pt; 
            margin-top: 4px;
        }

        h2{ 
            font-size: 9.5pt; 
            padding-left: 0.5cm;
            margin-top: 8px; 
        }
        
        h3 {
            font-size: 9pt;
            font-weight: normal;
            margin: 8px 0;
        }

        h4 {
            font-size: 7pt;
            margin: 8px 0; 
            font-weight: normal;
        }

        p {
            font-size: 6pt;
            text-align: justify;
            line-height: 1.5;
        }

        /*------------------------------*/
        /*            HEADER            */
        /*------------------------------*/
        header {
            position: fixed;
            top: 0cm;
            left: 0cm;
            right: 0cm;
            height: 45px;
            margin: 0.5cm 1.2cm 0 2cm;
        }

        #headerLogo {
            float: right;
        }

        #headerLogo img { 
            width: 200px; 
            height: 40px; 
        }

        #headerTitle {
            margin: 46px auto 0 auto;
        }

        #headerTitle h1 {
            width: 100%;
            text-align: center;
        }

        /*------------------------------*/
        /*             MAIN             */
        /*------------------------------*/
        main {
            color: #333;
        }

        .divSection {
            border: 3px solid #eeeeee;
            border-left: 5px solid #0b0b0a;
            border-radius: 5px;
            margin-bottom: 4px;
        }

        .sectionBorder {
            border: 2px solid #eeeeee;
            border-radius: 5px;
            margin-bottom: 4px !important;
        }

        #datosGenerales {
            border-left: 5px solid #1B809E !important;
        }

        #datosGenerales h2 {
            color: #1B809E;
        }

        table {
            width: 100%;
            padding-left: 1cm;
            margin-bottom: 8px;
            border-spacing: 0;
        }

        table th, table td {
            font-size: 9pt;
        }

        table th {
            padding-top: 8px;
            text-align: left;
            font-weight: normal;
        }

        table td {
            font-weight: bold;
        }

        #documentosRecibidos table {
            margin-top: 8px; 
            padding-left: 0.5cm;
            border-spacing: 20px 0 !important;
        }

        #documentosRecibidos table td {
            font-weight: normal;
            padding: 4px;
        }

        #documentosRecibidos td {
            border: 2px solid #eeeeee !important;
        }

        #documentosRecibidos table tr:first-child td:first-child, #documentosRecibidos table tr:first-child td:last-child{
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
        }

        #documentosRecibidos table tr:last-child td:first-child, #documentosRecibidos table tr:last-child td:last-child{
            border-bottom-left-radius: 5px;
            border-bottom-right-radius: 5px;
        }

        .borderTable {
            border-bottom-left-radius: 5px;
            border-bottom-right-radius: 5px;
        }

        #documentosRecibidos table p {
            background-color: #777777;
            color: white;
            float: right;
            border-radius: 2px;
            font-size: 7.5pt;
            width: 20px;
            text-align: center;
            margin: -1px 0 0 0;
            padding: 1px;
            line-height: 1.2;
        }

        #observaciones, #avisoPrivacidad, #fechas {
            width: 95%;
            margin: 0 auto;
            padding: 0 1.5%;
        }

        #observaciones h4, #avisoPrivacidad h4 {
            padding-bottom: 3px;
            border-bottom: 2px solid #eeeeee;
            text-align: justify;
        }

        #observaciones h3 {
            text-align: justify;
        }

        #observaciones h4 {
            width: 12%;
        }

        #avisoPrivacidad h4 {
            width: 16%;
        }

        #fechas table {
            padding: 0;
            border-collapse: collapse;
        }

        #fechas table td {
            border: 2px solid #eeeeee;
        }

        #firmas table td {
            font-weight: normal;
            text-align: center;
            width: 50%;
        }

        /*------------------------------*/
        /*            FOOTER            */
        /*------------------------------*/
        footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
            margin: 0 1.2cm;
        }

        footer table {
            width: 100%;
            padding: 0;
            margin-top: 20px;
        }

        footer table td {
            width: 50%;
            letter-spacing: 2px;
            font-size: 7pt;
        }

    </style>
</head>
<body>
    <header>
        <div id="headerLogo">
            <img src="https://i.imgur.com/DrnHF7I.png" />
        </div>
        <div id="headerTitle">
            <h1>REGISTRO DE INSTRUCTOR {{ $data->key }}</h1>
        </div>
    </header>

    <main>
        
        <!-- DATOS GENERALES -->
        <div id="datosGenerales" class="divSection">
            <h2>DATOS GENERALES</h2>
            <table>
                <tr><!-- Títulos -->
                    <th>NOMBRE COMPLETO:</th>
                    <th>CURP:</th>
                </tr>
                <tr><!-- Contenido -->
                    <td>{{ mb_strtoupper($data->name) }} {{ mb_strtoupper($data->first_name) }} {{ mb_strtoupper($data->last_name) }}</td>
                    <td>{{ $data->curp ? mb_strtoupper($data->curp) : "-" }}</td>
                </tr>
                <tr><!-- Títulos -->
                    <th>RFC:</th>
                    <th>FECHA DE NACIMIENTO:</th>
                </tr>
                <tr><!-- Contenido -->
                    <td>{{ $data->rfc ? mb_strtoupper($data->rfc) : "-" }}</td>
                    <td>{{ $data->birthdate ? $data->birthdate : "-" }}</td>
                </tr>
            </table>

        </div> 

        <!-- DOMICILIO -->
        <div class="divSection">
            <h2>DOMICILIO</h2>
            <h3 style="padding-left: 1cm;">{{ $data->address->calle ? mb_strtoupper($data->address->calle) : "CALLE DESCONOCIDA" }} {{ $data->address->numero ? mb_strtoupper("#".$data->address->numero.", ") : "," }} {{ $data->address->colonia ? mb_strtoupper("Colonia ".$data->address->colonia.", ") : "COLONIA DESCONOCIDA, " }} {{ $data->address->codigo_postal ? "C.P. ".$data->address->codigo_postal.", " : "C.P. DESCONOCIDO, " }} {{ $data->address->city->name ? mb_strtoupper($data->address->city->name.", ") : "" }} {{ $data->address->city->state->name ? mb_strtoupper($data->address->city->state->name) : "" }} </h3>
        </div>

        <!-- DATOS DE CONTACTO -->
        <div class="divSection">
            <h2>DATOS DE CONTACTO</h2>
            <table>
                <tr><!-- Títulos -->
                    <th>TELÉFONO FIJO:</th>
                    <th>TELÉFONO CELULAR:</th>
                    <th>CORREO ELECTRÓNICO:</th>
                </tr>
                <tr><!-- Contenido -->
                    <td>{{ $data->phone_number ? $data->phone_number : "-" }}</td>
                    <td>{{ $data->telephone_number ? $data->telephone_number : "-" }}</td>
                    <td>{{ $data->email ? mb_strtoupper($data->email) : "-" }}</td>
                </tr>
            </table>
        </div>

        <!-- ESTUDIOS -->
        <div class="divSection">
            <h2>ESTUDIOS</h2>
            <table>
                <tr><!-- Títulos -->
                    <th>ÚLTIMO GRADO CONCLUIDO:</th>
                    <th>GRADO ADQUIRIDO:</th>
                </tr>
                <tr><!-- Contenido -->
                    <td>
                        @switch($data->last_grade)
                            @case(1)
                                {{ "PREESCOLAR" }}
                                @break
                            @case(2)
                                {{ "PRIMARIA" }}
                                @break
                            @case(3)
                                {{ "SECUNDARIA" }}
                                @break
                            @case(4)
                                {{ "PREPARATORIA / BACHILLERATO" }}
                                @break
                            @case(5)
                                {{ "LICENCIATURA / INGENIERÍA" }}
                                @break
                            @case(6)
                                {{ "MAESTRÍA / DOCTORADO" }}
                                @break
                            @default
                                {{ "-" }}
                        @endswitch
                    </td>
                    <td>{{ $data->acquired_grade ? mb_strtoupper($data->acquired_grade) : "-" }}</td>
                </tr>
            </table>
        </div>

        <!-- DATOS BANCARIOS -->
        <div class="divSection">
            <h2>DATOS BANCARIOS</h2>
            <table>
                <tr><!-- Títulos -->
                    <th>BANCO:</th>
                    <th>CLABE INTERBANCARIA:</th>
                    <th>NÚM. CUENTA BANCARÍA:</th>
                </tr>
                <tr><!-- Contenido -->
                    <td>{{ $data->bank->marca ? mb_strtoupper($data->bank->marca) : "-" }}</td>
                    <td>{{ $data->interbank_key ? $data->interbank_key : "-" }}</td>
                    <td>{{ $data->bank_account ? $data->bank_account : "-" }}</td>
                </tr>
            </table>
        </div>

        <!-- DOCUMENTOS RECIBIDOS -->
        <div id="documentosRecibidos" class="divSection">
            <h2>DOCUMENTOS RECIBIDOS</h2>
            <table>
                <tr>
                    <td>COMPROBANTE CURP <p>{{ $data->document_curp ? "SI" : "NO" }}</p></td>
                    <td>CERTIFICADO MÉDICO <p>{{ $data->document_certificate_medical ? "SI" : "NO" }}</p></td>
                </tr>
                <tr>
                    <td>RFC <p>{{ $data->document_rfc ? "SI" : "NO" }}</p></td>
                    <td>COMPROBANTE DE ESTUDIOS <p>{{ $data->document_study ? "SI" : "NO" }}</p></td>
                </tr>
                <tr>
                    <td>COMPROBANTE DE DOMICILIO <p>{{ $data->document_address ? "SI" : "NO" }}</p></td>
                    <td>CERTIFICADOS VIGENTES (EC0217.01 Y/O EC0301) <p>{{ (($data->alineacion_217)||($data->alineacion_301)) ? "SI" : "NO" }}</p></td>
                </tr>
                <tr>
                    <td>IDENTIFICACIÓN OFICIAL <p>{{ $data->document_official_ine ? "SI" : "NO" }}</p></td>
                    <td>CERTIFICACIONES PROPIAS <p>{{ $data->own_certifications ? "SI" : "NO" }}</p></td>
                </tr>
                <tr>
                    <td>CURRÍCULUM VITAE INSTITUCIONAL <p>{{ $data->curriculum ? "SI" : "NO" }}</p></td>
                    <td>CURRÍCULUM VITAE<p>{{ $data->curriculum_vitae ? "SI" : "NO" }}</p></td>
                    {{-- <td class="borderTable">PERFIL INSTRUCTOR <p>{{ $data->perfil_instructor ? "SI" : "NO" }}</p></td> --}}
                </tr>
            </table>
        </div>

        <!-- OBSERVACIONES -->
        <div id="observaciones" class="sectionBorder">
            <h4>OBSERVACIONES</h4>
            <h3>{{ $data->observations ? mb_strtoupper($data->observations) : "NINGUNA." }}</h3>
        </div>

        <!-- AVISO DE PRIVACIDAD -->
        <div id="avisoPrivacidad" class="sectionBorder">
            <h4>AVISO DE PRIVACIDAD</h4>
            <P>
                LOS DATOS PERSONALES RECABADOS EN EL REGISTRO SERÁN PROTEGIDOS, INCORPORADOS Y TRATADOS POR LAS ÁREAS DE NORMATIVIDAD ACADÉMICA Y CERTIFICACIÓN, CAPACITACIÓN Y VINCULACIÓN, PLANEACIÓN, ADMINISTRACIÓN Y DIRECCIÓN GENERAL (INCLUYENDO JEFES DE ÁREA), DE CANDIDATOS A INSTRUCTORES DEL INSTITUTO DE CAPACITACIÓN PARA LOS TRABAJADORES DEL ESTADO DE BAJA CALIFORNIA SUR, EL CUÁL TIENE SU FUNDAMENTO EN EL ARTÍCULO 5 DE LA LEY DEL INSTITUTO DE CAPACITACIÓN PARA LOS TRABAJADORES DEL ESTADO DE BAJA CALIFORNIA SUR Y DEMÁS DISPOSICIONES APLICABLES, CUYAS FINALIDADES SON: REALIZAR EL REGISTRO DE LOS INSTRUCTORES EN LAS ACCIONES DE CAPACITACIÓN; ELABORAR INFORMES; CUMPLIR CON LO SOLICITADO EN LAS LEYES APLICABLES A LOS ORGANISMOS DESCENTRALIZADOS, LLEVAR ESTADÍSTICAS Y, EN SU CASO, ESTABLECER COMUNICACIÓN CON LOS PARTICIPANTES PARA ACLARAR DUDAS SOBRE SUS DATOS. LA UNIDAD ADMINISTRATIVA RESPONSABLE DE RECABAR LA INFORMACIÓN ES LA DIRECCIÓN DE CAPACITACIÓN Y VINCULACIÓN, EL DOMICILIO EN EL QUE EL INTERESADO(A) PODRÁ EJERCER LOS DERECHOS DE ACCESO Y CORRECCIÓN DE SUS DATOS ES: MADERO #312, COL. CENTRO, MUNICIPIO DE LA PAZ, C.P. 23000, LA PAZ, BAJA CALIFORNIA SUR, O BIEN, AL TELÉFONO 6121250170, 6121250171 Y 6121250172. LO ANTERIOR, SE INFORMA EN CUMPLIMIENTO DEL DECIMOSÉPTIMO DE LOS LINEAMIENTOS DE PROTECCIÓN DE DATOS PERSONALES, PUBLICADOS EN EL DIARIO OFICIAL DE LA FEDERACIÓN, EL 30 DE SEPTIEMBRE DE 2005.
            </P>
        </div>

        <!-- FECHAS -->
        <div id="fechas">
            <table>
                <tr>
                    <td>FECHA DE ALTA:</td>
                    <td style="text-align: center">{{ $data->created_at ? substr($data->created_at, 0,  10) : "Desconocida" }}</td>
                    <td>FECHA ÚLTIMA ACTUALIZACIÓN:</td>
                    <td style="text-align: center">{{ $data->updated_at ? substr($data->updated_at, 0,  10) : "Desconocida" }}</td>
                </tr>
            </table>
        </div>

        <!-- FIRMAS -->
        <div id="firmas">
            <table style="margin-bottom: 45px;">
                <tr>
                    <td>Firma</td>
                    <td>Firma</td>
                </tr>
            </table>
            <table>
                <tr>
                    <td>Firma</td>
                    <td>Firma</td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">MARÍA DEL ROSARIO GARCIA ROMAN</td>
                    <td style="font-weight: bold;">ALMA DELIA RICO RAYGOZA</td>
                </tr>
                <tr>
                    <td>RESPONSABLE DE CAPTURA DE INFORMACIÓN</td>
                </tr>
            </table>
        </div>
    </main>

    <footer>
        <table>
            <tr>
                <td style="font-weight: normal">SCE</td>
                <td style="text-align: right">EMITE MARIA NOELIA FELIZ ORTIZ</td>
            </tr>
        </table>
    </footer>
</body>
</html>