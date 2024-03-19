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
                start: row.Time_arrangement,
                end: row.Time_arrangement,
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
        eventClick: function (info) {
            // var _details = $("#event-details-modal");
            var id = info.event.id;
            if (!!timeArrangementDetails_client[id]) {
                var utl_of_this;
                var id_oftble = timeArrangementDetails_client[id].id;
                var cnf = timeArrangementDetails_client[id].confirm;
                var trp = timeArrangementDetails_client[id].Transfer;
                var dateOfSchedule =
                    timeArrangementDetails_client[id].Time_arrangement;
                var dayofnow = new Date();
                var formattedDate = dayofnow.toISOString().slice(0, 10);
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
                        <td>${trp == 0 ? "No" : "Yes"}
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
                                <button id="rejectBtn" class="swal2-confirm btn btn-primary btn-sm">Reject</button>
                            </td>
                        </tr>
                    </table>
                    </center>
                    <hr/>`,
                    showDenyButton: true,
                    showCancelButton: true,
                    denyButtonText: `Don't save`,
                    confirmButtonText: "Save", // Rename cancel button to "Close"
                }).then((result) => {
                    // This is triggered when the dialog is closed, but not by custom buttons
                    if (result.isConfirmed) {
                        // This case may not be reached with custom buttons unless you trigger `Swal.clickConfirm()`
                        Swal.fire("Saved!", "", "success");
                    } else if (result.isDenied) {
                        // This case may not be reached with custom buttons
                        Swal.fire("Changes are not saved", "", "info");
                    }
                });

                // Now, attach event listeners to custom buttons
                document
                    .getElementById("transferBtn")
                    .addEventListener("click", function () {
                        console.log("Transfer details clicked");
                        // Handle the action for transferring details
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

                        // alert(sevenDaysBefore);
                        if (
                            dateOfSchedule >= sevenDaysBefore &&
                            dateOfSchedule <= sevenDaysAfter
                        ) {
                            alert("valid");
                        } else {
                            alert("not valid");
                        }
                    });

                document
                    .getElementById("confirmBtn")
                    .addEventListener("click", function () {
                        // Handle the confirmation action
                        if (
                            formattedDate > dateOfSchedule ||
                            formattedDate < dateOfSchedule
                        ) {
                            Swal.fire(
                                "Cannot do this!.because You can confirmed this schedule for only relevant day",
                                "",
                                "error"
                            );
                        } else {
                            utl_of_this =
                                "/administrativehub/edit/confirmedByAdmin/schedule/";

                            if (cnf == 1) {
                                Swal.fire(
                                    "Cannot do this!.because previously confirmed this",
                                    "",
                                    "error"
                                );
                            } else {
                                dataProcessWithDatabase(utl_of_this, id_oftble);
                            }
                        }
                        //  // Example action
                    });

                document
                    .getElementById("rejectBtn")
                    .addEventListener("click", function () {
                        // alert(formattedDate + " " + dateOfSchedule);
                        if (formattedDate > dateOfSchedule) {
                            Swal.fire(
                                "Cannot do this!.because < 24H",
                                "",
                                "error"
                            );
                        } else {
                            utl_of_this =
                                "/administrativehub/edit/rejectByAdmin/schedule/";

                            if (trp == 0 && cnf == 0) {
                                Swal.fire(
                                    "Cannot do this!.because No Yet confirmed this",
                                    "",
                                    "error"
                                );
                            } else {
                                dataProcessWithDatabase(utl_of_this, id_oftble);
                            }
                        }
                        // Example action
                    });
            } else {
                alert("Event is undefined");
            }
            // console.log(_details);
        },

        // eventClick: function(info) {

        //   // Check if the event color is red or the event is for weekends
        //   if (info.event.backgroundColor === '#fc1303' || ['Saturday', 'Sunday'].includes(info.event.title)) {
        //     alert(`Event: ${info.event.title} on ${info.event.start.toLocaleDateString()}`);
        //   }

        // }
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
            Swal.fire("Your Job Completed", "", "success");
            location.reload();
        },
    });
}
