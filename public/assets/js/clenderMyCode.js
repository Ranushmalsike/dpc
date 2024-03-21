// Calender
/*async function fetchHolidays() {
    const apiKey = "AWgN7Nz8cbWBk3hrYpQoqywJf4UILlIq";
    const country = "LK"; // ISO Country Code for Sri Lanka
    const year = new Date().getFullYear(); // Current year, or specify the year you want

    const response = await fetch(
        `https://calendarific.com/api/v2/holidays?&api_key=${apiKey}&country=${country}&year=${year}`
    );
    const data = await response.json();

    // List of specific holidays to include
    const specificHolidayNames = [
        "Poya",
        "Pongal",
        "National Day",
        "Mahasivarathri Day",
        "Good Friday",
        "Eid al-Fitr",
        "New Year",
        "May Day",
        "Hadji",
        "Mawlid",
        "Christmas Day",
    ];

    // Filter for holidays that match any name in the specificHolidayNames list
    const specificHolidays = data.response.holidays
        .filter((holiday) =>
            specificHolidayNames.some((specificName) =>
                holiday.name.includes(specificName)
            )
        )
        .map((holiday) => {
            return {
                title: holiday.name,
                date: holiday.date.iso,
                // Optionally, assign a color or other property based on the holiday type
                color: "#fc1303", // Example color, you might choose to customize this further
            };
        });

    return specificHolidays;
}*/

//schedule_arrange.js
const model_trp = $("#TeacherModal");
const EditModal = $("#EditModal");
const closeButton = $(".close-button");

function hideModal() {
    model_trp.hide();
    EditModal.hide();
}
// Close the modal when the close button is clicked
closeButton.on("click", function () {
    hideModal();
});

// Close the modal when clicking outside of it
$(window).on("click", function (event) {
    if ($(event.target).is(model_trp)) {
        hideModal();
    }
    if ($(event.target).is(EditModal)) {
        hideModal();
    }
});

function generateWeekendEvents(startYear, endYear) {
    let weekendEvents = [];
    for (let year = startYear; year <= endYear; year++) {
        for (let month = 0; month < 12; month++) {
            let date = new Date(year, month, 1);
            while (date.getMonth() === month) {
                if (date.getDay() === 0 || date.getDay() === 6) {
                    // 0 = Sunday, 6 = Saturday
                    weekendEvents.push({
                        title: "Weekend",
                        start: new Date(date),
                        end: new Date(date),
                        color: "#add8e6", // Light blue color for weekends
                    });
                }
                date.setDate(date.getDate() + 1);
            }
        }
    }
    return weekendEvents;
}

function getRandomColor() {
    const letters = "0123456789ABCDEF";
    let color = "#";
    for (let i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}

async function initializeCalendar() {
    // php event
    const events_ofphp = [];
    if (!!timeArrangementDetails_client) {
        Object.keys(timeArrangementDetails_client).map((k) => {
            var row = timeArrangementDetails_client[k];
            // alert(row.first_name);
            events_ofphp.push({
                id: row.id,
                title: row.first_name,
                start: row.Time_arrangement + " " + row.start_time,
                end: row.Time_arrangement + " " + row.end_time,
                color: getRandomColor(),
            });
        });
    }

    // const holidays = await fetchHolidays(); // Fetch specific holidays from the API

    const currentYear = new Date().getFullYear();
    const weekendEvents = generateWeekendEvents(currentYear, currentYear); // Adjust the years as needed

    var calendarEl = document.getElementById("calendar");
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: "dayGridMonth",
        nowIndicator: true,
        headerToolbar: {
            left: "prev,next today",
            center: "title",
            right: "dayGridMonth,timeGridWeek,timeGridDay,listWeek",
        },
        navLinks: true,
        editable: true,
        selectable: true,
        // themeSystem: "bootstrap",...holidays,
        selectMirror: true,
        dayMaxEvents: true,
        events: [...weekendEvents, ...events_ofphp],
        /**
         * Alert Process section
         */
        eventClick: function (info) {
            // var _details = $("#event-details-modal");
            var id = info.event.id;
            if (!!timeArrangementDetails_client[id]) {
                var utl_of_this;
                var id_oftble = timeArrangementDetails_client[id].id;
                var cnf = timeArrangementDetails_client[id].confirm;
                var trp = timeArrangementDetails_client[id].Transfer;
                var Trp_confirmed =
                    timeArrangementDetails_client[id].Trp_confirmed;
                var dateOfSchedule =
                    timeArrangementDetails_client[id].Time_arrangement;
                var dayofnow = new Date();
                var current_date_today = dayofnow.toISOString().slice(0, 10);
                var sevenDaysBefore = new Date(
                    dayofnow.getTime() - 7 * 24 * 60 * 60 * 1000
                )
                    .toISOString()
                    .slice(0, 10);

                var sevenDaysAfter = new Date(
                    dayofnow.getTime() + 7 * 24 * 60 * 60 * 1000
                )
                    .toISOString()
                    .slice(0, 10);
                var oneDaysAfter = new Date(
                    dayofnow.getTime() + 0 * 24 * 60 * 60 * 1000
                )
                    .toISOString()
                    .slice(0, 10);
                Swal.fire({
                    title: "Scheduled Time",
                    html: `<hr/>
                    <h3 class="text-primary">Schedule Date: <b>${dateOfSchedule}</b></h3>
                    <h3 class="text-info">Name: <b>${
                        timeArrangementDetails_client[id].first_name
                    } ${timeArrangementDetails_client[id].second_name}</b></h3>
                    <table border="0" style="width:100%; margin-top:20px;">
                        <tr>
                            <th>Start Time</th>
                            <th>End Time</th>
                        </tr>
                        <tr>
                            <td>${
                                timeArrangementDetails_client[id].start_time
                            }</td>
                            <td>${
                                timeArrangementDetails_client[id].end_time
                            }</td>
                        </tr>
                    </table>
                    <table border="0" style="width:100%; margin-top:20px;">
                        <tr>
                            <th>Class</th>
                            <th>Subject</th>
                        </tr>
                        <tr>
                            <td>${
                                timeArrangementDetails_client[id].dpcclass
                            }</td>
                            <td>${
                                timeArrangementDetails_client[id].subject
                            }</td>
                        </tr>
                    </table>
                    <hr/>
                    <table border="0" style="width:100%; margin-top:20px;">
                        <tr>
                            <th>Confirmed</th>
                            <th>Transferred</th>
                        </tr>
                        <tr>
                        <td>${cnf == 0 ? "No" : "Yes"}</td>
                        <td>${
                            trp == 0
                                ? "No"
                                : "Yes  <button id='look' class='swal2-confirm btn btn-primary btn-sm'>Look</button>"
                        }</td>
                        </tr>
                    </table>
                    <hr/>
                    <center>
                    <table border="0" style="width:60%;">
                        <tr>
                            <td>
                                <button id="transferBtn" class="swal2-confirm btn btn-secondary btn-sm">Transfer details</button>
                            </td>
                            <td>
                                <button id="confirmBtn" class="swal2-confirm btn btn-success btn-sm">Confirm</button>
                            </td>
                            <td>
                                <button id="resetBtn" class="swal2-confirm btn btn-primary btn-sm">Reset</button>
                            </td>
                        </tr>
                    </table>
                    </center>
                    <hr/>`,
                    showDenyButton: true,
                    showCancelButton: true,
                    denyButtonText: `Delete`,
                    confirmButtonText: "Edit", // Rename cancel button to "Close"
                }).then((result) => {
                    // This is triggered when the dialog is closed, but not by custom buttons
                    if (result.isConfirmed) {
                        if (cnf == 1 || Trp_confirmed == 1 || trp == 1) {
                            Swal.fire(
                                "Cannot do this!.because previously confirmed",
                                "",
                                "error"
                            );
                        } else {
                            $("#get_tb_id").val(id_oftble);
                            EditModal.show();

                            let timerInterval;
                            Swal.fire({
                                title: "Auto Load Data!",
                                html: "Detecting Data <b></b> milliseconds.",
                                timer: 2000,
                                timerProgressBar: true,
                                didOpen: () => {
                                    Swal.showLoading();
                                    const timer =
                                        Swal.getPopup().querySelector("b");
                                    timerInterval = setInterval(() => {
                                        timer.textContent = `${Swal.getTimerLeft()}`;
                                    }, 100);
                                },
                                willClose: () => {
                                    clearInterval(timerInterval);
                                },
                            }).then((result) => {
                                /* Read more about handling dismissals below */
                                if (
                                    result.dismiss === Swal.DismissReason.timer
                                ) {
                                    console.log("I was closed by the timer");
                                }
                            });
                        }
                        // Swal.fire("Saved!", "", "success");
                    } else if (result.isDenied) {
                        // This case may not be reached with custom buttons
                        if (cnf == 1 || Trp_confirmed == 1 || trp == 1) {
                            Swal.fire(
                                "Cannot do this!.because previously confirmed",
                                "",
                                "error"
                            );
                        } else {
                            Swal.fire({
                                title: "Are you sure?",
                                text: "You won't be able to revert this!",
                                icon: "warning",
                                showCancelButton: true,
                                confirmButtonColor: "#3085d6",
                                cancelButtonColor: "#d33",
                                confirmButtonText: "Yes, delete it!",
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    utl_of_this =
                                        "/administrativehub/delete_TimeArrangement.delete/";
                                    dataProcessWithDatabase(
                                        utl_of_this,
                                        id_oftble
                                    );
                                }
                            });
                        }
                    }
                });

                /**
                 * Transfer section Process
                 */
                document
                    .getElementById("transferBtn")
                    .addEventListener("click", function () {
                        if (
                            dateOfSchedule >= oneDaysAfter &&
                            dateOfSchedule <= sevenDaysAfter
                        ) {
                            if (cnf == 1 || Trp_confirmed == 1 || trp == 1) {
                                Swal.fire(
                                    "Cannot do this!.because previously confirmed this",
                                    "",
                                    "error"
                                );
                            } else {
                                $("#id_tb").val(id_oftble);
                                $("#Data_of_this").val(dateOfSchedule);
                                model_trp.show();
                                let timerInterval;
                                Swal.fire({
                                    title: "Auto Load Data!",
                                    html: "Detecting Data <b></b> milliseconds.",
                                    timer: 2000,
                                    timerProgressBar: true,
                                    didOpen: () => {
                                        Swal.showLoading();
                                        const timer =
                                            Swal.getPopup().querySelector("b");
                                        timerInterval = setInterval(() => {
                                            timer.textContent = `${Swal.getTimerLeft()}`;
                                        }, 100);
                                    },
                                    willClose: () => {
                                        clearInterval(timerInterval);
                                    },
                                }).then((result) => {
                                    /* Read more about handling dismissals below */
                                    if (
                                        result.dismiss ===
                                        Swal.DismissReason.timer
                                    ) {
                                        console.log(
                                            "I was closed by the timer"
                                        );
                                    }
                                });
                            }
                        } else {
                            Swal.fire(
                                "Cannot do this! because cannot be system rule violate",
                                "",
                                "error"
                            );
                        }
                    });
                /**
                 * Confirmed section
                 */
                document
                    .getElementById("confirmBtn")
                    .addEventListener("click", function () {
                        // Handle the confirmation action
                        if (
                            current_date_today > dateOfSchedule ||
                            current_date_today < dateOfSchedule
                        ) {
                            Swal.fire(
                                "Cannot do this!.because You can confirmed this schedule in for only relevant day",
                                "",
                                "error"
                            );
                        } else {
                            if (cnf == 1) {
                                Swal.fire(
                                    "Cannot do this!.because previously confirmed this",
                                    "",
                                    "error"
                                );
                            } else {
                                utl_of_this =
                                    "/administrativehub/edit/confirmedByAdmin/schedule/";
                                dataProcessWithDatabase(utl_of_this, id_oftble);
                            }
                        }
                        //  // Example action
                    });
                /**
                 * Reset section
                 */
                document
                    .getElementById("resetBtn")
                    .addEventListener("click", function () {
                        // Only current date with forward 7 days
                        if (
                            dateOfSchedule >= oneDaysAfter &&
                            dateOfSchedule <= sevenDaysAfter
                        ) {
                            if (cnf == 0 && trp == 0) {
                                Swal.fire(
                                    "Cannot do this! because Nothing to reset",
                                    "",
                                    "error"
                                );
                            }
                            // Must be Add if else statment if: trp == 1 and trp.confirmed == 1
                            else if (trp == 1 && Trp_confirmed == 1) {
                                Swal.fire(
                                    "Cannot do this! because cannot system rule violate",
                                    "",
                                    "error"
                                );
                            } else {
                                utl_of_this =
                                    "/administrativehub/edit/resetByAdmin/schedule/";
                                dataProcessWithDatabase(utl_of_this, id_oftble);
                            }
                        } else {
                            Swal.fire(
                                "Cannot do this! because cannot system rule violate",
                                "",
                                "error"
                            );
                        }
                    });
                /**
                 * Transfer section Details
                 */
                document
                    .getElementById("look")
                    .addEventListener("click", function () {
                        // Only current date with forward 7 days Trp_confirmed
                        Swal.fire({
                            title: "Session Transfer Details",
                            html: `<hr/>
                    <h3 class="text-primary">Schedule Date: <b>${dateOfSchedule}</b></h3>
                    <h3 class="text-info">Name: <b>${
                        timeArrangementDetails_client[id].first_name_second_name
                    }</b></h3>
                        <hr/>
                        <li>Confirmed : ${
                            Trp_confirmed == 0 ? "No" : "Yes"
                        }</li>
                        <hr/>`,
                            showDenyButton: false,
                            showCancelButton: true,
                            confirmButtonText: "Confirmed",
                        }).then((result) => {
                            /* Read more about isConfirmed, isDenied below */
                            if (result.isConfirmed) {
                                if (
                                    current_date_today > dateOfSchedule ||
                                    current_date_today < dateOfSchedule
                                ) {
                                    Swal.fire(
                                        "Cannot do this!.because You can confirmed this schedule in for only relevant day",
                                        "",
                                        "error"
                                    );
                                } else {
                                    if (Trp_confirmed == 1) {
                                        Swal.fire(
                                            "Cannot do this!.because previously confirmed this",
                                            "",
                                            "error"
                                        );
                                    } else {
                                        utl_of_this =
                                            "/administrativehub/edit/trp_schedule_Up/schedule/";
                                        dataProcessWithDatabase(
                                            utl_of_this,
                                            id_oftble
                                        );
                                    }
                                }
                            } else if (result.isDenied) {
                                Swal.fire("Changes are not saved", "", "info");
                            }
                        });
                    });
            } else {
                Swal.fire("Weekend", "", "error");
            }
        },
    });

    calendar.render();
}

document.addEventListener("DOMContentLoaded", async function () {
    await initializeCalendar();
});

// modify section in database
function dataProcessWithDatabase(utl_of_this, id_oftble) {
    $.ajax({
        type: "GET",
        url: utl_of_this + id_oftble,
        data: {
            id_oftble: id_oftble,
        },
        beforeSend: function (xhr) {
            xhr.setRequestHeader(
                "X-CSRF-TOKEN",
                $("meta[name='csrf-token']").attr("content")
            );
        },
        // dataType: "dataType",
        success: function (response) {
            success();
            location.reload();
        },
    });
}

// Transfer Process
$("#saveTeacher")
    .off("click")
    .on("click", function () {
        var trp_tb_id = $("#id_tb").val();
        var Teacher_id_ofTRp = $(
            "#Teachers_selection_for_transfer_section"
        ).val();
        // alert(trp_tb_id);
        $.ajax({
            type: "Get",
            url:
                "/administrativehub/edit/transferSessionByAdmin/schedule/" +
                trp_tb_id +
                "/" +
                Teacher_id_ofTRp,
            data: {
                trp_tb_id: trp_tb_id,
                Teacher_id_ofTRp: Teacher_id_ofTRp,
            },
            beforeSend: function (xhr) {
                xhr.setRequestHeader(
                    "X-CSRF-TOKEN",
                    $("meta[name='csrf-token']").attr("content")
                );
            },
            success: function (response) {
                success();
                location.reload();
            },
        });

        hideModal(); // Hide the modal
    });

// Edit Section
$("#Edit_saveTeacher").click(function (e) {
    e.preventDefault();
    var edit_TB_id = $("#get_tb_id").val();
    // alert(edit_TB_id);
    var edit_start_time = $("#edit_starttime").val();
    var edit_end_time = $("#edit_endtime").val();
    var edit_class = $("#edit_className").val();
    var edit_subject = $("#Edit_subject").val();
    var edit_trp = $("#Edit_transportSelect").val();
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to edit this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, Edit it!",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "POST",
                url: "/administrativehub/edit/schedule_edit/schedule/",
                data: {
                    edit_TB_id: edit_TB_id,
                    edit_start_time: edit_start_time,
                    edit_end_time: edit_end_time,
                    edit_class: edit_class,
                    edit_subject: edit_subject,
                    edit_trp: edit_trp,
                },
                beforeSend: function (xhr) {
                    xhr.setRequestHeader(
                        "X-CSRF-TOKEN",
                        $("meta[name='csrf-token']").attr("content")
                    );
                },
                success: function (response) {
                    success();
                    location.reload();
                },
            });
        }
    });
    hideModal();
});
