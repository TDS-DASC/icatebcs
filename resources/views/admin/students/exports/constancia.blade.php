<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Constancia</title>
</head>
<style>
    /*------------------------------*/
    /*      ELEMENTOS GENERALES     */
    /*------------------------------*/
    @page {
        margin: 0cm 0cm;
        font-family: Arial;
    }
    body {
        margin: 0px;
        line-height: 1;
    }
    h1, h2, h3 {
        margin: 0;
        padding: 0;
    }

    /*------------------------------*/
    /*            PAGE #1           */
    /*------------------------------*/
    #bg-page-1 {
        /* background-image: url({{ public_path('images/constancia-actualizada-page1.png') }}); */
        height: 100%;
        background-position: center;
        background-repeat: no-repeat;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
        height: 100%;
    }

    /* CENTER DIV AND STUDENT DIV */
    .center, .student {
        position: fixed;
        left: 50%;
        transform: translateX(-50%);
        width: 80%;
    }

    /* CENTER DIV */
    .center {
        top: 31%;
        overflow: auto
    }
    .center h1 {
        width: 50%;
        float: left;
        text-align: center;
        font-size: 12pt;
        font-weight: normal;
    }

    /* STUDENT DIV */
    .student {
        top: 47%;
        text-align: center;
    }
    .student p { font-size: 12pt; }

    /* STUDENT NAME */
    .student-name { margin-bottom: 24pt; }
    .student-name p { margin-bottom: 14pt; }
    .student-name p.name { font-size: 18pt; font-weight: bold; }
    .student-name p.curp { margin: 14pt 0 0; }
    .student-name p.curp b { font-size: 14pt; }

    /* STUDENT COURSE */
    .student-course { margin-bottom: 12pt; }
    .student-course p.text { margin: 0 0 24pt; }
    .student-course h2 { font-size: 16pt; font-weight: bold; }

    /* STUDENT COURSE TIME AND TYPE */
    .student-course-time-type { margin-bottom: 24px; }
    .student-course-time-type p.text:first-child { margin-bottom: 5pt; }
    .student-course-time-type p.text:last-child { margin-top: 0; margin-bottom: 0; }

    /* STUDENT COURSE LOCATION AND DATE */
    .student-location-date { margin-bottom: 24px; }
    .student-location-date p.text:first-child { margin-bottom: 5pt; }
    .student-location-date p.text:last-child { margin-top: 0; margin-bottom: 0; }

    /* STUDENT GENERAL DIRECTOR */
    .student-general-director { margin-bottom: 0; }
    .student-general-director p.text:first-child { margin-bottom: 8pt; }
    .student-general-director p.text:last-child { margin-top: 0; margin-bottom: 0; }

    /* FOLIO */
    .code {
        position: absolute;
        bottom: 28.3%;
        left: -2.2%;
        transform: rotate(-90deg);
        letter-spacing: 4px;
    }

    /*------------------------------*/
    /*            PAGE #2           */
    /*------------------------------*/
    #bg-page-2 {
        /* background-image: url({{ public_path('images/constancia-actualizada-page2.png') }}); */
        height: 100%;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }
    /* THEMES */
    .content {
        position: absolute;
        top: 8%;
        left: 10%;
        width: 68%;
    }
    .content p {
        margin: 0 0 10px;
    }
    /* HOURS */
    .hours, .hours-total {
        position: absolute;
        right: 7.5%;
        width: 10%;
    }
    .hours {
        top: 8%;
    }
    .hours p, .hours-total p, .no-control p {
        text-align: center;
        padding: 0;
        margin: 0;
    }
    .hours-total {
        top: 80%;
    }
    .no-control {
        position: absolute;
        bottom: 8.9%;
        left: 27%;
    }

</style>

<body>
    <!-- PAGE #1 -->
    <div id="bg-page-1">
        <!-- CENTER INFO -->
        <div class="center">
            <h1>{{ mb_strtoupper($group->center->name) }}</h1>
            <h1>Con CCT: 03EIC0001G</h1>
        </div>
        <!-- STUDENT NAME -->
        <div class="student">
            <div class="student-name">
                <h1 class="name">{{ $student->name }} {{ $student->first_name }} {{ $student->last_name }}</h1>
                <p class="curp">con Clave Única de Registro de Población: <b>{{ $student->curp }}</b></p>
            </div>
            <div class="student-course">
                <p class="text">En virtud de que acreditó conocimientos, habilidades, destrezas y actitudes del curso</p>
                <h2>{{ $group->course->name }}</h2>
            </div>
            <div class="student-course-time-type">
                <p class="text">Impartido en <b>{{ $group->course->duration_course }} horas,</b> correspondiente al programa de <b>{{ mb_strtoupper($group->course->type_course) }}</b> de acuerdo a</p>
                <p class="text">la información académica que obra en los archivos del Centro Educativo.</p>
            </div>
            <div class="student-location-date">
                <p class="text">El presente se expide en {{$group->center->address->city->name}}, {{$group->center->address->city->state->name}},</p>
                <p class="text">
                    a los 
                    @switch($day-1)
                        @case(1)
                            {{'uno'}}
                            @break;
                        @case(2)
                            {{'dos'}}
                            @break;
                        @case(3)
                            {{'tres'}}
                            @break;
                        @case(4)
                            {{'cuatro'}}
                            @break;  
                        @case(5)
                            {{'cinco'}}
                            @break;  
                        @case(6)
                            {{'seis'}}
                            @break;  
                        @case(7)
                            {{'siete'}}
                            @break;  
                        @case(8)
                            {{'ocho'}}
                            @break; 
                        @case(9)
                            {{'nueve'}}
                            @break;
                        @case(10)
                            {{'diez'}}
                            @break;
                        @case(11)
                            {{'once'}}
                            @break;
                        @case(12)
                            {{'doce'}}
                            @break;
                        @case(13)
                            {{'trece'}}
                            @break;
                        @case(14)
                            {{'catorce'}}
                            @break;
                        @case(15)
                            {{'quince'}}
                            @break;
                        @case(16)
                            {{'dieciséis'}}
                            @break;
                        @case(17)
                            {{'diecisiete'}}
                            @break;
                        @case(18)
                            {{'dieciocho'}}
                            @break;
                        @case(19)
                            {{'diecinueve'}}
                            @break;
                        @case(20)
                            {{'veinte'}}
                            @break;
                        @case(21)
                            {{'veintiuno'}}
                            @break;
                        @case(22)
                            {{'veintidós'}}
                            @break;
                        @case(23)
                            {{'veintitrés'}}
                            @break;
                        @case(24)
                            {{'veinticuatro'}}
                            @break;
                        @case(25)
                            {{'veinticinco'}}
                            @break;
                        @case(26)
                            {{'veintiséis'}}
                            @break;
                        @case(27)
                            {{'veintisiete'}}
                            @break;
                        @case(28)
                            {{'veintiocho'}}
                            @break;
                        @case(29)
                            {{'veintinueve'}}
                            @break;
                        @case(30)
                            {{'treinta'}}
                            @break;
                        @case(31)
                            {{'treinta y uno'}}
                            @break;     
                        @default
                            {{'-'}}
                    @endswitch
                    días del mes de 
                    @switch($month)
                        @case(1)
                            {{'enero'}}
                            @break;
                        @case(2)
                            {{'febreo'}}
                            @break;
                        @case(3)
                            {{'marzo'}}
                            @break;
                        @case(4)
                            {{'abril'}}
                            @break;  
                        @case(5)
                            {{'mayo'}}
                            @break;  
                        @case(6)
                            {{'junio'}}
                            @break;  
                        @case(7)
                            {{'julio'}}
                            @break;  
                        @case(8)
                            {{'agosto'}}
                            @break; 
                        @case(9)
                            {{'septiembre'}}
                            @break;
                        @case(10)
                            {{'octubre'}}
                            @break;
                        @case(11)
                            {{'noviembre'}}
                            @break;
                        @case(12)
                            {{'diciembre'}}
                            @break;
                        @default
                            {{'-'}}
                    @endswitch
                    del 
                    @switch($year)
                        @case(2023)
                            {{'dos mil veintitrés.'}}
                            @break;
                        @case(2024)
                            {{'dos mil veinticuatro.'}}
                            @break;
                        @case(2025)
                            {{'dos mil veinticinco.'}}
                            @break;
                        @case(2026)
                            {{'dos mil veintiséis.'}}
                            @break;
                        @case(2027)
                            {{'dos mil veintisiete.'}}
                            @break;
                        @case(2028)
                            {{'dos mil veintiocho.'}}
                            @break;
                        @case(2029)
                            {{'dos mil veintinueve.'}}
                            @break;
                        @case(2030)
                            {{'dos mil treinta.'}}
                            @break;
                        @case(2031)
                            {{'dos mil treinta y uno.'}}
                            @break;
                        @case(2032)
                            {{'dos mil treinta y dos.'}}
                            @break;
                        @case(2033)
                            {{'dos mil treinta y tres.'}}
                            @break;
                        @case(2034)
                            {{'dos mil treinta y cuatro.'}}
                            @break;
                        @case(2035)
                            {{'dos mil treinta y cinco.'}}
                            @break;
                        @case(2036)
                            {{'dos mil treinta y seis.'}}
                            @break;
                        @case(2037)
                            {{'dos mil treinta y siete.'}}
                            @break;
                        @case(2038)
                            {{'dos mil treinta y ocho.'}}
                            @break;
                        @case(2039)
                            {{'dos mil treinta y nueve.'}}
                            @break;
                        @case(2040)
                            {{'dos mil cuarenta.'}}
                            @break;
                        @default
                            {{'-'}}
                    @endswitch
                </p>
            </div>
            <div class="student-general-director">
                <p class="text">Lic. Cinthya Fátima Montufas Chávez</p>
                <p class="text">Directora General</p>
            </div>
        </div>
        <!-- CODE / FOLIO -->
        {{-- <h1 class="code">
            00014003
        </h1> --}}
    </div>
    <!-- PAGE #2 -->
    <div id="bg-page-2">
        <div class="content">
            @foreach ($group->course->themes as $theme)
                <p> {{$theme->name}} </p>
            @endforeach
        </div>
        <div class="hours">
            <p> {{$group->course->duration_course}} </p>
        </div>
        <div class="hours-total">
            <p> {{$group->course->duration_course}} </p>
        </div>
        <div class="no-control">
            <p> {{$student->no_control}} </p>
        </div>
    </div>
</body>

</html>
