var studentList,
    perPage = 8,
    options = { 
        valueNames: ["avatar", "no_control", "curp", "student_name", "student_first_name", "student_last_name", "phone", "center_name"], 
        page: perPage, 
        pagination: {
            item: '<li><a class="page" href="#capacitandos"></a></li>'
        },
        plugins: [ListPagination({ left: 2, right: 2 })] 
    };
    document.getElementById("studentList") && (studentList = new List("studentList", options).on("updated", function (e) {
        0 == e.matchingItems.length ? (document.getElementsByClassName("noresult")[0].style.display = "block") : (document.getElementsByClassName("noresult")[0].style.display = "none");
        var t = 1 == e.i, a = e.i > e.matchingItems.length - e.page;
        document.querySelector(".pagination-prev.disabled") && document.querySelector(".pagination-prev.disabled").classList.remove("disabled"),
        document.querySelector(".pagination-next.disabled") && document.querySelector(".pagination-next.disabled").classList.remove("disabled"),
        t && document.querySelector(".pagination-prev").classList.add("disabled"),
        a && document.querySelector(".pagination-next").classList.add("disabled"),
        e.matchingItems.length <= perPage ? (document.querySelector(".pagination-wrap").style.display = "none") : (document.querySelector(".pagination-wrap").style.display = "flex"),
        e.matchingItems.length == perPage && document.querySelector(".pagination.listjs-pagination").firstElementChild.children[0].click(),
        0 < e.matchingItems.length ? (document.getElementsByClassName("noresult")[0].style.display = "none") : (document.getElementsByClassName("noresult")[0].style.display = "block");
    }));

var userList,
    perPage = 8,
    options = { 
        valueNames: ["avatar", "user_name", "user_email", "user_center", "user_rol", "actions"], 
        page: perPage, 
        pagination: {
            item: '<li><a class="page" href="#usuarios"></a></li>'
        },
        plugins: [ListPagination({ left: 2, right: 2 })] 
    };
    document.getElementById("userList") && (userList = new List("userList", options).on("updated", function (e) {
        0 == e.matchingItems.length ? (document.getElementsByClassName("noresult")[0].style.display = "block") : (document.getElementsByClassName("noresult")[0].style.display = "none");
        var t = 1 == e.i, a = e.i > e.matchingItems.length - e.page;
        document.querySelector(".pagination-prev.disabled") && document.querySelector(".pagination-prev.disabled").classList.remove("disabled"),
        document.querySelector(".pagination-next.disabled") && document.querySelector(".pagination-next.disabled").classList.remove("disabled"),
        t && document.querySelector(".pagination-prev").classList.add("disabled"),
        a && document.querySelector(".pagination-next").classList.add("disabled"),
        e.matchingItems.length <= perPage ? (document.querySelector(".pagination-wrap").style.display = "none") : (document.querySelector(".pagination-wrap").style.display = "flex"),
        e.matchingItems.length == perPage && document.querySelector(".pagination.listjs-pagination").firstElementChild.children[0].click(),
        0 < e.matchingItems.length ? (document.getElementsByClassName("noresult")[0].style.display = "none") : (document.getElementsByClassName("noresult")[0].style.display = "block");
    }));

var placeList,
    perPage = 8,
    options = { 
        valueNames: ["avatar", "place_key", "place_name", "place_telephone_number", "place_address", "place_center", "actions"], 
        page: perPage, 
        pagination: {
            item: '<li><a class="page" href="#lugares"></a></li>'
        },
        plugins: [ListPagination({ left: 2, right: 2 })] 
    };
    document.getElementById("placeList") && (placeList = new List("placeList", options).on("updated", function (e) {
        0 == e.matchingItems.length ? (document.getElementsByClassName("noresult")[0].style.display = "block") : (document.getElementsByClassName("noresult")[0].style.display = "none");
        var t = 1 == e.i, a = e.i > e.matchingItems.length - e.page;
        document.querySelector(".pagination-prev.disabled") && document.querySelector(".pagination-prev.disabled").classList.remove("disabled"),
        document.querySelector(".pagination-next.disabled") && document.querySelector(".pagination-next.disabled").classList.remove("disabled"),
        t && document.querySelector(".pagination-prev").classList.add("disabled"),
        a && document.querySelector(".pagination-next").classList.add("disabled"),
        e.matchingItems.length <= perPage ? (document.querySelector(".pagination-wrap").style.display = "none") : (document.querySelector(".pagination-wrap").style.display = "flex"),
        e.matchingItems.length == perPage && document.querySelector(".pagination.listjs-pagination").firstElementChild.children[0].click(),
        0 < e.matchingItems.length ? (document.getElementsByClassName("noresult")[0].style.display = "none") : (document.getElementsByClassName("noresult")[0].style.display = "block");
    }));

var placeStudentsList,
    perPage = 8,
    options = { 
        valueNames: ["avatar", "placeStudent_noControl", "placeStudent_name", "placeStudent_firstName", "placeStudent_lastName", "placeStudent_academicLevel", "placeStudent_email" ], 
        page: perPage, 
        pagination: {
            item: '<li><a class="page" href="#estudiantes"></a></li>'
        },
        plugins: [ListPagination({ left: 2, right: 2 })] 
    };
    document.getElementById("placeStudentsList") && (placeStudentsList = new List("placeStudentsList", options).on("updated", function (e) {
        0 == e.matchingItems.length ? (document.getElementsByClassName("noresult")[1].style.display = "block") : (document.getElementsByClassName("noresult")[1].style.display = "none");
        var t = 1 == e.i, a = e.i > e.matchingItems.length - e.page;
        document.querySelector(".pagination-prev.disabled") && document.querySelector(".pagination-prev.disabled").classList.remove("disabled"),
        document.querySelector(".pagination-next.disabled") && document.querySelector(".pagination-next.disabled").classList.remove("disabled"),
        t && document.querySelector(".pagination-prev").classList.add("disabled"),
        a && document.querySelector(".pagination-next").classList.add("disabled"),
        e.matchingItems.length <= perPage ? (document.querySelector(".pagination-wrap").style.display = "none") : (document.querySelector(".pagination-wrap").style.display = "flex"),
        e.matchingItems.length == perPage && document.querySelector(".pagination.listjs-pagination").firstElementChild.children[0].click(),
        0 < e.matchingItems.length ? (document.getElementsByClassName("noresult")[1].style.display = "none") : (document.getElementsByClassName("noresult")[1].style.display = "block");
    }));

var placeGroupsList,
    perPage = 8,
    options = { 
        valueNames: ["group_key", "group_course", "group_date_start", "group_date_end", "actions"], 
        page: perPage, 
        pagination: {
            item: '<li><a class="page" href="#grupos"></a></li>'
        },
        plugins: [ListPagination({ left: 2, right: 2 })] 
    };
    document.getElementById("placeGroupsList") && (placeGroupsList = new List("placeGroupsList", options).on("updated", function (e) {
        0 == e.matchingItems.length ? (document.getElementsByClassName("noresult")[0].style.display = "block") : (document.getElementsByClassName("noresult")[0].style.display = "none");
        var t = 1 == e.i, a = e.i > e.matchingItems.length - e.page;
        document.querySelector(".pagination-prev.disabled") && document.querySelector(".pagination-prev.disabled").classList.remove("disabled"),
        document.querySelector(".pagination-next.disabled") && document.querySelector(".pagination-next.disabled").classList.remove("disabled"),
        t && document.querySelector(".pagination-prev").classList.add("disabled"),
        a && document.querySelector(".pagination-next").classList.add("disabled"),
        e.matchingItems.length <= perPage ? (document.querySelector(".pagination-wrap").style.display = "none") : (document.querySelector(".pagination-wrap").style.display = "flex"),
        e.matchingItems.length == perPage && document.querySelector(".pagination.listjs-pagination").firstElementChild.children[0].click(),
        0 < e.matchingItems.length ? (document.getElementsByClassName("noresult")[0].style.display = "none") : (document.getElementsByClassName("noresult")[0].style.display = "block");
    }));

var instructorList,
    perPage = 8,
    options = { 
        valueNames: ["avatar", "instructor_key", "instructor_center", "instructor_name", "instructor_curp", "instructor_rfc", "instructor_email", "instructor_birth_place", "instructor_birthdate", "instructor_phone_number", "actions"], 
        page: perPage, 
        pagination: {
            item: '<li><a class="page" href="#instructores"></a></li>'
        },
        plugins: [ListPagination({ left: 2, right: 2 })] 
    };
    document.getElementById("instructorList") && (instructorList = new List("instructorList", options).on("updated", function (e) {
        0 == e.matchingItems.length ? (document.getElementsByClassName("noresult")[0].style.display = "block") : (document.getElementsByClassName("noresult")[0].style.display = "none");
        var t = 1 == e.i, a = e.i > e.matchingItems.length - e.page;
        document.querySelector(".pagination-prev.disabled") && document.querySelector(".pagination-prev.disabled").classList.remove("disabled"),
        document.querySelector(".pagination-next.disabled") && document.querySelector(".pagination-next.disabled").classList.remove("disabled"),
        t && document.querySelector(".pagination-prev").classList.add("disabled"),
        a && document.querySelector(".pagination-next").classList.add("disabled"),
        e.matchingItems.length <= perPage ? (document.querySelector(".pagination-wrap").style.display = "none") : (document.querySelector(".pagination-wrap").style.display = "flex"),
        e.matchingItems.length == perPage && document.querySelector(".pagination.listjs-pagination").firstElementChild.children[0].click(),
        0 < e.matchingItems.length ? (document.getElementsByClassName("noresult")[0].style.display = "none") : (document.getElementsByClassName("noresult")[0].style.display = "block");
    }));

var instructorCoursesList,
    perPage = 8,
    options = { 
        valueNames: ["instructor_course_key", "instructor_course_name", "instructor_course_type", "instructor_course_modality", "actions"], 
        page: perPage, 
        pagination: {
            item: '<li><a class="page" href="#instructores"></a></li>'
        },
        plugins: [ListPagination({ left: 2, right: 2 })] 
    };
    document.getElementById("instructorCoursesList") && (instructorCoursesList = new List("instructorCoursesList", options).on("updated", function (e) {
        0 == e.matchingItems.length ? (document.getElementsByClassName("noresult")[0].style.display = "block") : (document.getElementsByClassName("noresult")[0].style.display = "none");
        var t = 1 == e.i, a = e.i > e.matchingItems.length - e.page;
        document.querySelector(".pagination-prev.disabled") && document.querySelector(".pagination-prev.disabled").classList.remove("disabled"),
        document.querySelector(".pagination-next.disabled") && document.querySelector(".pagination-next.disabled").classList.remove("disabled"),
        t && document.querySelector(".pagination-prev").classList.add("disabled"),
        a && document.querySelector(".pagination-next").classList.add("disabled"),
        e.matchingItems.length <= perPage ? (document.querySelector(".pagination-wrap").style.display = "none") : (document.querySelector(".pagination-wrap").style.display = "flex"),
        e.matchingItems.length == perPage && document.querySelector(".pagination.listjs-pagination").firstElementChild.children[0].click(),
        0 < e.matchingItems.length ? (document.getElementsByClassName("noresult")[0].style.display = "none") : (document.getElementsByClassName("noresult")[0].style.display = "block");
    }));

var instructorGroupsList,
    perPage = 8,
    options = { 
        valueNames: ["instructor_group_key", "instructor_group_name", "instructor_group_place", "instructor_group_date_start", "instructor_group_date_end", "actions"], 
        page: perPage, 
        pagination: {
            item: '<li><a class="page" href="#grupos"></a></li>'
        },
        plugins: [ListPagination({ left: 2, right: 2 })] 
    };
    document.getElementById("instructorGroupsList") && (instructorGroupsList = new List("instructorGroupsList", options).on("updated", function (e) {
        0 == e.matchingItems.length ? (document.getElementsByClassName("noresult")[1].style.display = "block") : (document.getElementsByClassName("noresult")[1].style.display = "none");
        var t = 1 == e.i, a = e.i > e.matchingItems.length - e.page;
        document.querySelector(".pagination-prev.disabled") && document.querySelector(".pagination-prev.disabled").classList.remove("disabled"),
        document.querySelector(".pagination-next.disabled") && document.querySelector(".pagination-next.disabled").classList.remove("disabled"),
        t && document.querySelector(".pagination-prev").classList.add("disabled"),
        a && document.querySelector(".pagination-next").classList.add("disabled"),
        e.matchingItems.length <= perPage ? (document.querySelector(".pagination-wrap").style.display = "none") : (document.querySelector(".pagination-wrap").style.display = "flex"),
        e.matchingItems.length == perPage && document.querySelector(".pagination.listjs-pagination").firstElementChild.children[1].click(),
        0 < e.matchingItems.length ? (document.getElementsByClassName("noresult")[1].style.display = "none") : (document.getElementsByClassName("noresult")[1].style.display = "block");
    }));

var instructorTrainingFieldList,
    perPage = 8,
    options = { 
        valueNames: ["instructor_training_field_key", "instructor_training_field_name", "instructor_training_field_status", "actions"], 
        page: perPage, 
        pagination: {
            item: '<li><a class="page" href="#campos_de_formacion"></a></li>'
        },
        plugins: [ListPagination({ left: 2, right: 2 })] 
    };
    document.getElementById("instructorTrainingFieldList") && (instructorTrainingFieldList = new List("instructorTrainingFieldList", options).on("updated", function (e) {
        0 == e.matchingItems.length ? (document.getElementsByClassName("noresult")[2].style.display = "block") : (document.getElementsByClassName("noresult")[2].style.display = "none");
        var t = 1 == e.i, a = e.i > e.matchingItems.length - e.page;
        document.querySelector(".pagination-prev.disabled") && document.querySelector(".pagination-prev.disabled").classList.remove("disabled"),
        document.querySelector(".pagination-next.disabled") && document.querySelector(".pagination-next.disabled").classList.remove("disabled"),
        t && document.querySelector(".pagination-prev").classList.add("disabled"),
        a && document.querySelector(".pagination-next").classList.add("disabled"),
        e.matchingItems.length <= perPage ? (document.querySelector(".pagination-wrap").style.display = "none") : (document.querySelector(".pagination-wrap").style.display = "flex"),
        e.matchingItems.length == perPage && document.querySelector(".pagination.listjs-pagination").firstElementChild.children[2].click(),
        0 < e.matchingItems.length ? (document.getElementsByClassName("noresult")[2].style.display = "none") : (document.getElementsByClassName("noresult")[2].style.display = "block");
    }));

var courseList,
    perPage = 8,
    options = { 
        valueNames: ["course_key", "course_name", "course_type", "course_modality", "course_constancy", "course_duration", "actions"], 
        page: perPage, 
        pagination: {
            item: '<li><a class="page" href="#cursos"></a></li>'
        }, 
        plugins: [ListPagination({ left: 2, right: 2 })] 
    };
    document.getElementById("courseList") && (courseList = new List("courseList", options).on("updated", function (e) {
        0 == e.matchingItems.length ? (document.getElementsByClassName("noresult")[0].style.display = "block") : (document.getElementsByClassName("noresult")[0].style.display = "none");
        var t = 1 == e.i, a = e.i > e.matchingItems.length - e.page;
        document.querySelector(".pagination-prev.disabled") && document.querySelector(".pagination-prev.disabled").classList.remove("disabled"),
        document.querySelector(".pagination-next.disabled") && document.querySelector(".pagination-next.disabled").classList.remove("disabled"),
        t && document.querySelector(".pagination-prev").classList.add("disabled"),
        a && document.querySelector(".pagination-next").classList.add("disabled"),
        e.matchingItems.length <= perPage ? (document.querySelector(".pagination-wrap").style.display = "none") : (document.querySelector(".pagination-wrap").style.display = "flex"),
        e.matchingItems.length == perPage && document.querySelector(".pagination.listjs-pagination").firstElementChild.children[0].click(),
        0 < e.matchingItems.length ? (document.getElementsByClassName("noresult")[0].style.display = "none") : (document.getElementsByClassName("noresult")[0].style.display = "block");
    }));

var groupList,
    perPage = 8,
    options = { 
        valueNames: ["group_key", "group_course", "group_date_start", "group_date_end", "group_place", "group_instructor", "actions"], 
        page: perPage, 
        pagination: {
            item: '<li><a class="page" href="#grupos"></a></li>'
        },
        plugins: [ListPagination({ left: 2, right: 2 })] 
    };
    document.getElementById("groupList") && (groupList = new List("groupList", options).on("updated", function (e) {
        0 == e.matchingItems.length ? (document.getElementsByClassName("noresult")[0].style.display = "block") : (document.getElementsByClassName("noresult")[0].style.display = "none");
        var t = 1 == e.i, a = e.i > e.matchingItems.length - e.page;
        document.querySelector(".pagination-prev.disabled") && document.querySelector(".pagination-prev.disabled").classList.remove("disabled"),
        document.querySelector(".pagination-next.disabled") && document.querySelector(".pagination-next.disabled").classList.remove("disabled"),
        t && document.querySelector(".pagination-prev").classList.add("disabled"),
        a && document.querySelector(".pagination-next").classList.add("disabled"),
        e.matchingItems.length <= perPage ? (document.querySelector(".pagination-wrap").style.display = "none") : (document.querySelector(".pagination-wrap").style.display = "flex"),
        e.matchingItems.length == perPage && document.querySelector(".pagination.listjs-pagination").firstElementChild.children[0].click(),
        0 < e.matchingItems.length ? (document.getElementsByClassName("noresult")[0].style.display = "none") : (document.getElementsByClassName("noresult")[0].style.display = "block");
    }));

var groupInstructorList,
    perPage = 8,
    options = { 
        valueNames: ["key", "instructor_curp", "instructor_name", "instructor_first_name", "instructor_last_name", "actions"], 
        page: perPage, 
        pagination: {
            item: '<li><a class="page" href="#instructor"></a></li>'
        },
        plugins: [ListPagination({ left: 2, right: 2 })] 
    };
    document.getElementById("groupInstructorList") && (groupInstructorList = new List("groupInstructorList", options).on("updated", function (e) {
        0 == e.matchingItems.length ? (document.getElementsByClassName("noresult")[0].style.display = "block") : (document.getElementsByClassName("noresult")[0].style.display = "none");
        var t = 1 == e.i, a = e.i > e.matchingItems.length - e.page;
        document.querySelector(".pagination-prev.disabled") && document.querySelector(".pagination-prev.disabled").classList.remove("disabled"),
        document.querySelector(".pagination-next.disabled") && document.querySelector(".pagination-next.disabled").classList.remove("disabled"),
        t && document.querySelector(".pagination-prev").classList.add("disabled"),
        a && document.querySelector(".pagination-next").classList.add("disabled"),
        e.matchingItems.length <= perPage ? (document.querySelector(".pagination-wrap").style.display = "none") : (document.querySelector(".pagination-wrap").style.display = "flex"),
        e.matchingItems.length == perPage && document.querySelector(".pagination.listjs-pagination").firstElementChild.children[0].click(),
        0 < e.matchingItems.length ? (document.getElementsByClassName("noresult")[0].style.display = "none") : (document.getElementsByClassName("noresult")[0].style.display = "block");
    }));

var groupStudentsList,
    perPage = 8,
    options = { 
        valueNames: ["group_student_key", "group_student_curp", "group_student_name", "group_student_first_name", "group_student_last_name", "group_student_estatus", "actions"], 
        page: perPage, 
        pagination: {
            item: '<li><a class="page" href="#estudiantes"></a></li>'
        },
        plugins: [ListPagination({ left: 2, right: 2 })] 
    };
    document.getElementById("groupStudentsList") && (groupStudentsList = new List("groupStudentsList", options).on("updated", function (e) {
        0 == e.matchingItems.length ? (document.getElementsByClassName("noresult")[1].style.display = "block") : (document.getElementsByClassName("noresult")[1].style.display = "none");
        var t = 1 == e.i, a = e.i > e.matchingItems.length - e.page;
        document.querySelector(".pagination-prev.disabled") && document.querySelector(".pagination-prev.disabled").classList.remove("disabled"),
        document.querySelector(".pagination-next.disabled") && document.querySelector(".pagination-next.disabled").classList.remove("disabled"),
        t && document.querySelector(".pagination-prev").classList.add("disabled"),
        a && document.querySelector(".pagination-next").classList.add("disabled"),
        e.matchingItems.length <= perPage ? (document.querySelector(".pagination-wrap").style.display = "none") : (document.querySelector(".pagination-wrap").style.display = "flex"),
        e.matchingItems.length == perPage && document.querySelector(".pagination.listjs-pagination").firstElementChild.children[0].click(),
        0 < e.matchingItems.length ? (document.getElementsByClassName("noresult")[1].style.display = "none") : (document.getElementsByClassName("noresult")[1].style.display = "block");
    }));

var courseGroupList,
    perPage = 8,
    options = { 
        valueNames: ["course_group_key", "course_group_place", "course_group_center", "actions"], 
        page: perPage, 
        pagination: {
            item: '<li><a class="page" href="#grupos"></a></li>'
        },
        plugins: [ListPagination({ left: 2, right: 2 })] 
    };
    document.getElementById("courseGroupList") && (courseGroupList = new List("courseGroupList", options).on("updated", function (e) {
        0 == e.matchingItems.length ? (document.getElementsByClassName("noresult")[1].style.display = "block") : (document.getElementsByClassName("noresult")[1].style.display = "none");
        var t = 1 == e.i, a = e.i > e.matchingItems.length - e.page;
        document.querySelector(".pagination-prev.disabled") && document.querySelector(".pagination-prev.disabled").classList.remove("disabled"),
        document.querySelector(".pagination-next.disabled") && document.querySelector(".pagination-next.disabled").classList.remove("disabled"),
        t && document.querySelector(".pagination-prev").classList.add("disabled"),
        a && document.querySelector(".pagination-next").classList.add("disabled"),
        e.matchingItems.length <= perPage ? (document.querySelector(".pagination-wrap").style.display = "none") : (document.querySelector(".pagination-wrap").style.display = "flex"),
        e.matchingItems.length == perPage && document.querySelector(".pagination.listjs-pagination").firstElementChild.children[0].click(),
        0 < e.matchingItems.length ? (document.getElementsByClassName("noresult")[1].style.display = "none") : (document.getElementsByClassName("noresult")[1].style.display = "block");
    }));

var trainingList,
    perPage = 8,
    options = { 
        valueNames: ["training_key", "training_name", "training_status", "training_type", "training_amount_courses", "actions"], 
        page: perPage, 
        pagination: {
            item: '<li><a class="page" href="#campos_de_entrenamiento"></a></li>'
        },
        plugins: [ListPagination({ left: 2, right: 2 })] 
    };
    document.getElementById("trainingList") && (trainingList = new List("trainingList", options).on("updated", function (e) {
        0 == e.matchingItems.length ? (document.getElementsByClassName("noresult")[0].style.display = "block") : (document.getElementsByClassName("noresult")[0].style.display = "none");
        var t = 1 == e.i, a = e.i > e.matchingItems.length - e.page;
        document.querySelector(".pagination-prev.disabled") && document.querySelector(".pagination-prev.disabled").classList.remove("disabled"),
        document.querySelector(".pagination-next.disabled") && document.querySelector(".pagination-next.disabled").classList.remove("disabled"),
        t && document.querySelector(".pagination-prev").classList.add("disabled"),
        a && document.querySelector(".pagination-next").classList.add("disabled"),
        e.matchingItems.length <= perPage ? (document.querySelector(".pagination-wrap").style.display = "none") : (document.querySelector(".pagination-wrap").style.display = "flex"),
        e.matchingItems.length == perPage && document.querySelector(".pagination.listjs-pagination").firstElementChild.children[0].click(),
        0 < e.matchingItems.length ? (document.getElementsByClassName("noresult")[0].style.display = "none") : (document.getElementsByClassName("noresult")[0].style.display = "block");
    }));

var trainingFieldCoursesList,
    perPage = 8,
    options = { 
        valueNames: ["trainingField_course_key", "trainingField_course_name", "actions"], 
        page: perPage, 
        pagination: {
            item: '<li><a class="page" href="#cursos_asociados"></a></li>'
        },
        plugins: [ListPagination({ left: 2, right: 2 })] 
    };
    document.getElementById("trainingFieldCoursesList") && (trainingFieldCoursesList = new List("trainingFieldCoursesList", options).on("updated", function (e) {
        0 == e.matchingItems.length ? (document.getElementsByClassName("noresult")[0].style.display = "block") : (document.getElementsByClassName("noresult")[0].style.display = "none");
        var t = 1 == e.i, a = e.i > e.matchingItems.length - e.page;
        document.querySelector(".pagination-prev.disabled") && document.querySelector(".pagination-prev.disabled").classList.remove("disabled"),
        document.querySelector(".pagination-next.disabled") && document.querySelector(".pagination-next.disabled").classList.remove("disabled"),
        t && document.querySelector(".pagination-prev").classList.add("disabled"),
        a && document.querySelector(".pagination-next").classList.add("disabled"),
        e.matchingItems.length <= perPage ? (document.querySelector(".pagination-wrap").style.display = "none") : (document.querySelector(".pagination-wrap").style.display = "flex"),
        e.matchingItems.length == perPage && document.querySelector(".pagination.listjs-pagination").firstElementChild.children[0].click(),
        0 < e.matchingItems.length ? (document.getElementsByClassName("noresult")[0].style.display = "none") : (document.getElementsByClassName("noresult")[0].style.display = "block");
    }));

document.querySelector(".pagination-next") && document.querySelector(".pagination-next").addEventListener("click", function () {
    !document.querySelector(".pagination.listjs-pagination") || (document.querySelector(".pagination.listjs-pagination").querySelector(".active") && document.querySelector(".pagination.listjs-pagination").querySelector(".active").nextElementSibling.children[0].click());
}),
document.querySelector(".pagination-prev") && document.querySelector(".pagination-prev").addEventListener("click", function () {
    !document.querySelector(".pagination.listjs-pagination") || (document.querySelector(".pagination.listjs-pagination").querySelector(".active") && document.querySelector(".pagination.listjs-pagination").querySelector(".active").previousSibling.children[0].click());
});