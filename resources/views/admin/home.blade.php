<x-guest-layout>

    <x-slot name="head">
    </x-slot>

    <div class="page-content" v-cloak>
        <div class="container-fluid">

            <div class="row">
                {{--  WIDGETS --}}
                <div class="col-xxl-3 col-sm-6">

                    <!-- card -->
                    <div class="card card-animate" style="background-color: rgb(76, 102, 186);">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <p class="text-uppercase fw-medium text-white-50 mb-0">Cantidad de capacitandos</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4 text-white"> @{{ widgets[0].total_students }} </h4>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-soft-light rounded fs-3 shadow">
                                        <i class="ri-folder-user-fill"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                    
                </div>

                <div class="col-xxl-3 col-sm-6">

                    <!-- card -->
                    <div class="card card-animate" style="background-color: rgb(76, 102, 186);">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <p class="text-uppercase fw-medium text-white-50 mb-0">Cantidad de instructores</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4 text-white"> @{{ widgets[1].total_instructors }} </h4>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-soft-light rounded fs-3 shadow">
                                        <i class="ri-user-2-fill"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                    
                </div>

                <div class="col-xxl-3 col-sm-6">

                    <!-- card -->
                    <div class="card card-animate" style="background-color: rgb(76, 102, 186);">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <p class="text-uppercase fw-medium text-white-50 mb-0">Cantidad de cursos</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4 text-white"> @{{ widgets[2].total_courses }} </h4>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-soft-light rounded fs-3 shadow">
                                        <i class="ri-book-2-fill "></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                    
                </div>

                <div class="col-xxl-3 col-sm-6">

                    <!-- card -->
                    <div class="card card-animate" style="background-color: rgb(76, 102, 186);">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <p class="text-uppercase fw-medium text-white-50 mb-0">Cantidad de campos de formación</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4 text-white"> @{{ widgets[3].total_training_fields }} </h4>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-soft-light rounded fs-3 shadow">
                                        <i class="ri-briefcase-4-fill"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                    
                </div>
            </div>

            {{-- CHART - TOP 10 TRAINING FIELDS WITH MORE COURSES --}}
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header border-0 align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Cursos por campos de formación</h4>
                        </div><!-- end card header -->

                        <div class="card-header p-0 border-0 bg-soft-light">
                            <div class="row g-0 text-center">
                                <div class="col-sm-6">
                                    <div class="p-3 border border-dashed border-start-0">
                                        @php 
                                            $maxCourses = 0;
                                            foreach ($trainig_field_graph_data as $element) {
                                                $maxCourses += (int) $element->course_amount;
                                            }
                                        @endphp
                                        <h5 class="mb-1">{{ $maxCourses }}</span></h5>
                                        <p class="text-muted mb-0">Cursos totales entre los campos</p>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-sm-6">
                                    <div class="p-3 border border-dashed border-start-0">
                                        @php
                                            $trainingfieldMoreCourses = $trainig_field_graph_data[0]->name;
                                            $trainingfieldAuxiliar = $trainig_field_graph_data[0]->course_amount;
                                            foreach ($trainig_field_graph_data as $element) {
                                                if($trainingfieldAuxiliar<$element->course_amount) {
                                                    $trainingfieldMoreCourses = $element->name;
                                                    $trainingfieldAuxiliar = $element->course_amount;
                                                }
                                            }
                                        @endphp
                                        <h5 class="mb-1">{{ $trainingfieldMoreCourses }}</h5>
                                        <p class="text-muted mb-0">Campo con más cursos</p>
                                    </div>
                                </div>
                                <!--end col-->
                            </div>
                        </div><!-- end card header -->
                        <div class="card-body p-0 pb-2">
                            <div>
                                <div id="projects-overview-chart" data-colors='["--vz-primary", "--vz-warning", "--vz-success"]' class="apex-charts" dir="ltr"></div>
                            </div>
                        </div><!-- end card body -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-slot name="scripts">
        <script src="{{asset('libs/apexcharts/apexcharts.min.js') }}"></script>
        {{-- <script src="{{ asset('js/pages/dashboard-projects.init.js') }}"></script> --}}

        <script>
            const { createApp } = Vue
            createApp({
                data() {
                    return {
                        widgets: @json($widgets),
                        trainig_field_graph_data: @json($trainig_field_graph_data),
                        trainingfieldAmountCourses: 0,

                    }
                },
                methods:{
                    
                },
                mounted(){
                    /* CHART */
                    function getChartColorsArray(e) {
                        if (null !== document.getElementById(e)) {
                            var t = document.getElementById(e).getAttribute("data-colors");
                            if (t)
                            return (t = JSON.parse(t)).map(function (e) {
                                var t = e.replace(" ", "");
                                return -1 === t.indexOf(",")
                                ? getComputedStyle(document.documentElement).getPropertyValue(t) || t
                                : 2 == (e = e.split(",")).length
                                ? "rgba(" +
                                    getComputedStyle(document.documentElement).getPropertyValue(e[0]) +
                                    "," +
                                    e[1] +
                                    ")"
                                : t;
                            });
                            console.warn("data-colors Attribute not found on:", e);
                        }
                    }
                    var options,
                    chart,
                    linechartcustomerColors = getChartColorsArray("projects-overview-chart"),
                    isApexSeriesData =
                        (linechartcustomerColors &&
                        ((options = {
                            series: [
                                {
                                    name: "Cantidad de cursos:",
                                    type: "bar",
                                    data:   [
                                        this.trainig_field_graph_data[0].course_amount, 
                                        this.trainig_field_graph_data[1].course_amount,
                                        this.trainig_field_graph_data[2].course_amount,
                                        this.trainig_field_graph_data[3].course_amount,
                                        this.trainig_field_graph_data[4].course_amount,
                                        this.trainig_field_graph_data[5].course_amount,
                                        this.trainig_field_graph_data[6].course_amount,
                                        this.trainig_field_graph_data[7].course_amount,
                                        this.trainig_field_graph_data[8].course_amount,
                                        this.trainig_field_graph_data[9].course_amount,
                                    ],
                                },
                            ],
                            chart: { height: 374, type: "line", toolbar: { show: !1 } },
                            stroke: { curve: "smooth", dashArray: [0, 3, 0], width: [0, 1, 0] },
                            fill: { opacity: [1, 0.1, 1] },
                            markers: { size: [0, 4, 0], strokeWidth: 2, hover: { size: 4 } },
                            xaxis: {
                                labels: {
                                    rotate: -45,
                                },
                                categories: [ 
                                    this.trainig_field_graph_data[0].name, 
                                    this.trainig_field_graph_data[1].name,
                                    this.trainig_field_graph_data[2].name,
                                    this.trainig_field_graph_data[3].name,
                                    this.trainig_field_graph_data[4].name,
                                    this.trainig_field_graph_data[5].name,
                                    this.trainig_field_graph_data[6].name,
                                    this.trainig_field_graph_data[7].name,
                                    this.trainig_field_graph_data[8].name,
                                    this.trainig_field_graph_data[9].name,
                                ],
                                axisTicks: { show: !1 },
                                axisBorder: { show: !1 },
                                tickPlacement: 'on',
                            },
                            grid: {
                                show: !0,
                                xaxis: { lines: { show: !0 } },
                                yaxis: { lines: { show: !1 } },
                                padding: { top: 0, right: -2, bottom: 15, left: 10 },
                            },
                            legend: {
                                show: !0,
                                horizontalAlign: "center",
                                offsetX: 0,
                                offsetY: -5,
                                markers: { width: 9, height: 9, radius: 6 },
                                itemMargin: { horizontal: 10, vertical: 0 },
                            },
                            plotOptions: { bar: { columnWidth: "30%", barHeight: "70%" } },
                            colors: linechartcustomerColors,
                            tooltip: {
                                shared: !0,
                                y: [
                                    {
                                        formatter: function (e) {
                                            return void 0 !== e ? e.toFixed(0) : e;
                                        },
                                    },
                                    {
                                        formatter: function (e) {
                                            return void 0 !== e ? "$" + e.toFixed(2) + "k" : e;
                                        },
                                    },
                                    {
                                        formatter: function (e) {
                                            return void 0 !== e ? e.toFixed(0) : e;
                                        },
                                    },
                                ],
                            },
                        }),
                        (chart = new ApexCharts(
                            document.querySelector("#projects-overview-chart"),
                            options
                        )).render()),
                        {}),
                    isApexSeries = document.querySelectorAll("[data-chart-series]"),
                    donutchartProjectsStatusColors =
                        (isApexSeries &&
                        Array.from(isApexSeries).forEach(function (e) {
                            var t,
                            e = e.attributes;
                            e["data-chart-series"] &&
                            ((isApexSeriesData.series = e["data-chart-series"].value.toString()),
                            (t = getChartColorsArray(e.id.value.toString())),
                            (t = {
                                series: [isApexSeriesData.series],
                                chart: {
                                type: "radialBar",
                                width: 36,
                                height: 36,
                                sparkline: { enabled: !0 },
                                },
                                dataLabels: { enabled: !1 },
                                plotOptions: {
                                radialBar: {
                                    hollow: { margin: 0, size: "50%" },
                                    track: { margin: 1 },
                                    dataLabels: { show: !1 },
                                },
                                },
                                colors: t,
                            }),
                            new ApexCharts(
                                document.querySelector("#" + e.id.value.toString()),
                                t
                            ).render());
                        }),
                        getChartColorsArray("prjects-status")),
                    currentChatId =
                        (donutchartProjectsStatusColors &&
                        ((options = {
                            series: [125, 42, 58, 89],
                            labels: ["Completed", "In Progress", "Yet to Start", "Cancelled"],
                            chart: { type: "donut", height: 230 },
                            plotOptions: {
                                pie: {
                                    size: 100,
                                    offsetX: 0,
                                    offsetY: 0,
                                    donut: { size: "90%", labels: { show: !1 } },
                                },
                            },
                            dataLabels: { enabled: !1 },
                            legend: { show: !1 },
                            stroke: { lineCap: "round", width: 0 },
                            colors: donutchartProjectsStatusColors,
                        }),
                        (chart = new ApexCharts(
                            document.querySelector("#prjects-status"),
                            options
                        )).render()),
                        "users-chat");
                    function scrollToBottom(r) {
                    setTimeout(function () {
                        var e = document
                            .getElementById(r)
                            .querySelector("#chat-conversation .simplebar-content-wrapper")
                            ? document
                                .getElementById(r)
                                .querySelector("#chat-conversation .simplebar-content-wrapper")
                            : "",
                        t = document.getElementsByClassName("chat-conversation-list")[0]
                            ? document
                                .getElementById(r)
                                .getElementsByClassName("chat-conversation-list")[0].scrollHeight -
                            window.innerHeight +
                            600
                            : 0;
                        t && e.scrollTo({ top: t, behavior: "smooth" });
                    }, 100);
                    }
                    scrollToBottom(currentChatId);
                }
            }).mount('#app')
        </script>
    </x-slot>

</x-guest-layout>