<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Historial de Instructor</title>
    <style>
        /*------------------------------*/
        /*      ELEMENTOS GENERALES     */
        /*------------------------------*/
        @page {
            margin: 0cm 0cm;
            font-family: Arial;
        }
        body { 
            margin: 2.6cm 1.5cm 2cm; 
            line-height: 1;
        }
        h1, h2, h3 {
            margin: 0;
            padding: 0;
        }
        h1 { 
            font-size: 13pt; 
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
        table {
            width: 100%;
            margin-bottom: 8px;
        }
        table th, table td {
            font-size: 9pt;
        }

        /* DATOS GENERALES */
        #datosGenerales {
            margin-top: 20px;
        }
        #datosGenerales table {
            border-spacing: 0;
            margin-bottom: 25px;
        }
        #datosGenerales table th {
            text-align: left;
        }

        /* CURSOS AUTORIZADOS Y CURSOS IMPARTIDOS */
        #cursosAutorizados h2, #gruposImpartidos h2 {
            font-size: 10.5pt;
            width: 100%;
            text-align: center;
            margin: 20px 0;
        }
        #cursosAutorizados h2 {
            margin-top: 10px;
        }
        #cursosAutorizados table, #gruposImpartidos table {
            border-collapse: collapse;
        }
        #cursosAutorizados table th, #gruposImpartidos table th,
        #cursosAutorizados table td, #gruposImpartidos table td {
            border: 1px solid #000000;
            text-align: center !important;
            padding-top: 6px;
            padding-bottom: 6px; 
        }
        #cursosAutorizados h3, #gruposImpartidos h3 {
            font-size: 8pt;
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
        footer h2 {
            position: absolute;
            left: 0;
            letter-spacing: 2px;
        }
        footer h3 {
            width: 100%;
            text-align: center;
        }
        .pagenum::after {
            content: counter(page);
        }

    </style>
</head>
<body>
    <header>
        <div id="headerLogo">
            <img src="https://i.imgur.com/DrnHF7I.png" />
        </div>
        <div id="headerTitle">
            <h1>HISTORIAL DE INSTRUCTOR </h1>
        </div>
    </header>

    <main>
        <!-- DATOS GENERALES -->
        <div id="datosGenerales">
            <!-- NOMBRE Y CURP -->
            <table>
                <tr>
                    <th>NOMBRE:</th>
                    <td>{{ mb_strtoupper($data['instructor']->name) }} {{ mb_strtoupper($data['instructor']->first_name) }} {{ mb_strtoupper($data['instructor']->last_name) }}</td>
                    <th>CURP:</th>
                    <td>{{$data['instructor']->curp}}</td>
                </tr>
            </table>
            <!-- DOMICILIO -->
            <table>
                <tr>
                    <th>DOMICILIO:</th>
                    <td>
                        {{ $data['instructor']->address->calle ? mb_strtoupper($data['instructor']->address->calle) : "CALLE DESCONOCIDA" }} 
                        {{ $data['instructor']->address->numero ? mb_strtoupper("#".$data['instructor']->address->numero.", ") : "," }} 
                        {{ $data['instructor']->address->colonia ? mb_strtoupper("Colonia ".$data['instructor']->address->colonia.", ") : "COLONIA DESCONOCIDA, " }} 
                        {{ $data['instructor']->address->codigo_postal ? "C.P. ".$data['instructor']->address->codigo_postal.", " : "C.P. DESCONOCIDO, " }} 
                        {{ $data['instructor']->address->city->name ? mb_strtoupper($data['instructor']->address->city->name.", ") : "" }} 
                        {{ $data['instructor']->address->city->state->name ? mb_strtoupper($data['instructor']->address->city->state->name) : "" }}
                    </td>
                </tr>
            </table>
            <!-- RFC, CELULAR Y CORREO ELECTRÓNICO -->
            <table>
                <tr>
                    <th>RFC:</th>
                    <td>{{ mb_strtoupper($data['instructor']->rfc) }}</td>
                    <th>TEL. CELULAR:</th>
                    <td>{{ mb_strtoupper($data['instructor']->phone_number) }}</td>
                    <th>CORREO ELECTRÓNICO:</th>
                    <td>{{ mb_strtoupper($data['instructor']->email) }}</td>
                </tr>
            </table>
        </div> 

        <!-- CURSOS AUTORIZADOS PARA IMPARTIR -->
        <div id="cursosAutorizados">
            <h2>CURSOS AUTORIZADOS PARA IMPARTIR</h2>
            <table>
                <tr>
                    <th>NOMBRE</th>
                    <th>CLAVE</th>
                    <th>DURACIÓN HORAS</th>
                </tr>
                <tr>
                    <td>{{ count($data['instructor']->courses)>0 ? mb_strtoupper($data['instructor']->courses[0]->name) : "" }}</td>
                    <td>{{ count($data['instructor']->courses)>0 ? mb_strtoupper($data['instructor']->courses[0]->key) : "" }}</td>
                    <td>{{ count($data['instructor']->courses)>0 ? mb_strtoupper($data['instructor']->courses[0]->duration_course) : "" }}</td>
                </tr>
            </table>
            <h3>UN TOTAL DE {{ count($data['instructor']->courses)>=0 ? count($data['instructor']->courses) : "" }} CURSOS AUTORIZADOS A IMPARTIR</h3>
        </div>

        <!-- GRUPOS IMPARTIDOS -->
        <div id="gruposImpartidos">
            <h2>GRUPOS IMPARTIDOS</h2>
            <table>
                <tr>
                    <th>CLAVE</th>
                    <th>NOMBRE CURSO</th>
                    <th>DURACIÓN HORAS</th>
                    <th>FECHA</th>
                    <th>INSCRITOS</th>
                </tr>
                @foreach ($data['instructor']->groups as $group)
                    <tr>
                        <td>{{ mb_strtoupper($group->key) }}</td>
                        <td>{{ mb_strtoupper($group->course->name) }}</td>
                        <td>{{ mb_strtoupper($group->course->duration_course) }}</td>
                        <td>{{ $group->date_start ? substr($group->date_start, 0,  10) : "Desconocida" }} A {{ $group->date_end ? substr($group->date_end, 0,  10) : "Desconocida" }}</td>
                        <td>{{ $group->students_count }}</td>
                    </tr>
                @endforeach
            </table>
            <h3>UN TOTAL DE {{count($data['instructor']->groups)}} GRUPOS IMPARTIDOS</h3>
        </div>
    </main>

    <footer>
        <h2>SCE</h2>
        <h3>PÁGINA <span class="pagenum"></span></h3>       
    </footer>
</body>
</html>