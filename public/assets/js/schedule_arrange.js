document.addEventListener("DOMContentLoaded", function () {
    // Assuming initializeCalendar is an async function you've defined elsewhere
    initializeCalendar()
        .then(() => {
            console.log("Calendar initialized");

            // Add event listener to the 'Generate_schedule' button
            $("#Generate_shedule").click(function (e) {
                var startSelectDateValue = $("#Start_titile_datetime").val();
                var endSelectDateValue = $("#End_titile_datetime").val();
                var starttime = $("#starttime").val();
                var endtime = $("#endtime").val();

                var subject = document.getElementById("subject");
                var subjectVal = $("#subject").val();

                var TeacherName = document.getElementById("TeacherName");
                var TeacherNameVal = $("#TeacherName").val();

                var className = document.getElementById("className");
                var classNameVal = $("#className").val();

                var selectedclassName =
                    className.options[className.selectedIndex];
                var selectedTeacherName =
                    TeacherName.options[TeacherName.selectedIndex];
                var selectedsubject = subject.options[subject.selectedIndex];

                var selectedClassValue = selectedclassName.getAttribute("data");
                var selectedTeacherNamev =
                    selectedTeacherName.getAttribute("data");
                var selectedsubjectv = selectedsubject.getAttribute("data");

                // var subject = document.getElementById('subject');
                // var TeacherName = document.getElementById('TeacherName');
                // Make sure the dates are not empty
                if (!startSelectDateValue || !endSelectDateValue) {
                    Swal.fire(
                        "Please ensure both start and end dates are selected.",
                        "",
                        "error"
                    );
                    alert();
                    return;
                }

                const startSelectDate = new Date(startSelectDateValue);
                const endSelectDate = new Date(endSelectDateValue);

                // Ensure that the start date is before the end date
                if (startSelectDate > endSelectDate) {
                    Swal.fire(
                        "Start date must be before end date.",
                        "",
                        "error"
                    );
                    return;
                }

                const weekdays = calculateWeekdaysFromDate(
                    startSelectDate,
                    endSelectDate
                );
                $("#schedule_gen_tb").empty();
                // Generate and insert new rows for each weekday
                var idOfTime = 1;
                weekdays.forEach(function (date) {
                    // Increment idOfTime only once for use in this iteration.
                    const currentIdOfTime = idOfTime++;

                    const newRow = `
                    <tr id="idOfshedule${currentIdOfTime}">
                        <td>${currentIdOfTime}</td>
                        <td data="${TeacherNameVal}">${selectedTeacherNamev}</td>
                        <td><strong>${date}</strong></td>
                        <td>${starttime}</td>
                        <td>${endtime}</td>
                        <td data="${classNameVal}">${selectedClassValue}</td>
                        <td data="${subjectVal}">${selectedsubjectv}</td>
                        <td data="">0</td>
                        <td>
                        <button class="btn btn-danger btn-sm" value="${currentIdOfTime}" id="deleteOfGenShedule" data-toggle="tooltip" data-placement="bottom"
                                            title="Delete system generated time arrangement"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>
                `;
                    $("#schedule_gen_tb").append(newRow);
                });

                // console.log(
                //     weekdays
                //     ); // Here you can use these dates as needed, e.g., display them or add to a calendar
            });
        })
        .catch((error) => {
            console.error("Failed to initialize the calendar", error);
        });

    $(document).on("click", "#deleteOfGenShedule", function () {
        var id = $(this).val();
        //alert(id);
        var dateText = $(this).closest("tr").find("td:eq(2)").text();
        addDeleteDataFromTimeArrangement(dateText);
        $("#idOfshedule" + id).remove();
    });

    // Enhanced modal interaction
    const modal = $("#transportModal");
    const closeButton = $(".close-button");

    // Function to hide the modal
    function hideModal() {
        modal.hide();
    }

    // Opens the modal and sets up the save functionality
    $("#schedule_gen_tb").on("click", 'td:contains("0")', function () {
        const currentTd = $(this); // Store the current TD to update later
        modal.show(); // Show the modal

        $("#saveTransport")
            .off("click")
            .on("click", function () {
                // Setup Save button click event
                const selectedTransport = $("#transportSelect").val(); // Get the selected transport value
                const selectedTransportText = $(
                    "#transportSelect option:selected"
                ).text(); // Correct way to get the selected transport text
                currentTd.attr("data", selectedTransport); // Update the TD's data attribute with the selected transport value
                currentTd.text(selectedTransportText); // Update the TD text with the selected transport text
                hideModal(); // Hide the modal
            });
    });

    // Close the modal when the close button is clicked
    closeButton.on("click", function () {
        hideModal();
    });

    // Close the modal when clicking outside of it
    $(window).on("click", function (event) {
        if ($(event.target).is(modal)) {
            hideModal();
        }
    });

    // Save all time table values in database
    $("#get_and_save_time_schedule").click(function (e) {
        e.preventDefault();
        // Check if the table is empty
        // Check if the table is empty
        var rowCount = $("#schedule_details_ofTb").length;

        if (rowCount === 0) {
            Swal.fire(
                "The schedule table is empty. Please add some data before saving.",
                "",
                "error"
            );

            return;
        }

        var timeArrangement_array = []; // Initialize the array to hold data
        $("#schedule_details_ofTb")
            .find("tr")
            .each(function () {
                var $columns = $(this).find("td");
                var getTeacher_idV = $columns.eq(1).attr("data")?.trim(); // Use optional chaining with trim()
                var date_text_val = $columns.eq(2).text().trim();
                var starttime_text_val = $columns.eq(3).text().trim();
                var endtime_text_val = $columns.eq(4).text().trim();
                var classNameVal_data = $columns.eq(5).attr("data")?.trim();
                var subjectVal_data = $columns.eq(6).attr("data")?.trim();
                var transport_data = $columns.eq(7).attr("data")?.trim();

                // Check if any of the required values are empty
                if (
                    getTeacher_idV &&
                    date_text_val &&
                    starttime_text_val &&
                    endtime_text_val &&
                    classNameVal_data &&
                    subjectVal_data
                ) {
                    // Only add the entry if all values are non-empty
                    timeArrangement_array.push({
                        getTeacher_idV: getTeacher_idV,
                        date_text_val: date_text_val,
                        starttime_text_val: starttime_text_val,
                        endtime_text_val: endtime_text_val,
                        classNameVal_data: classNameVal_data,
                        subjectVal_data: subjectVal_data,
                        transport_data: transport_data,
                    });
                }
            });

        // Assuming you want to do something with timeArrangement_array here, like an AJAX call to save the data
        // save process
        console.log(timeArrangement_array);
        $.ajax({
            type: "POST",
            url: "/input/timeArrangement_save", // Replace with the actual PHP script URL
            data: {
                timeArrangement_array: timeArrangement_array,
            },
            beforeSend: function (xhr) {
                xhr.setRequestHeader(
                    "X-CSRF-TOKEN",
                    $("meta[name='csrf-token']").attr("content")
                );
            },
            // dataType:'json',
            success: function (response) {
                //msgbxInstance.okCompleted();
                success();
                location.reload();
            },
            error: function (error) {
                Swal.fire(error, "", "error");
            },
        });
    });
});

function calculateWeekdaysFromDate(startDate, endDate) {
    let weekdays = [];
    let currentDate = new Date(startDate.getTime());

    while (currentDate <= endDate) {
        // Exclude Saturdays (6) and Sundays (0)
        if (currentDate.getDay() !== 6 && currentDate.getDay() !== 0) {
            weekdays.push(
                currentDate.toLocaleDateString("en-US", {
                    month: "2-digit",
                    day: "2-digit",
                    year: "numeric",
                })
            );
        }
        currentDate.setDate(currentDate.getDate() + 1);
    }

    return weekdays; // Now returns all days excluding weekends
}

// Seve and gather information delete date by staff
// function fetchHolidayData(dateText) {
//     const apiKey = "p86SLqsywONmkkdv3nnLHpZ1dcqU6Zt7";
//     const dateParts = dateText.split("/");
//     const year = dateParts[2]; // Extract year from dateText
//     const url = `https://calendarific.com/api/v2/holidays?&api_key=${apiKey}&country=LK&year=${year}&type=national`;

//     fetch(url)
//         .then((response) => response.json())
//         .then((data) => {
//             processHolidayData(data, dateText);
//         })
//         .catch((error) => console.error("Error fetching holiday data:", error));
// }

// function processHolidayData(data, dateText) {
//     const dateParts = dateText.split("/");
//     const month = parseInt(dateParts[0], 10);
//     const day = parseInt(dateParts[1], 10);
//     const year = parseInt(dateParts[2], 10);

//     let matchingHoliday = null;

//     if (data.response && data.response.holidays) {
//         matchingHoliday = data.response.holidays.find((holiday) => {
//             const holidayDate = new Date(holiday.date.iso);
//             return (
//                 holidayDate.getDate() === day &&
//                 holidayDate.getMonth() + 1 === month && // Months are 0-indexed in JavaScript Date
//                 holidayDate.getFullYear() === year
//             );
//         });
//     }

//     if (matchingHoliday) {
//         // If a matching holiday is found, prepare and send data to your server
//         addDeleteDataFromTimeArrangement({
//             dateText: dateText,
//         });
//     } else {
//         Swal.fire("No matching holiday found for the given date.", "", "error");
//     }
// }

function addDeleteDataFromTimeArrangement(dateText) {
    $.ajax({
        type: "POST",
        url: "/input/Add_DeleteData_from_timeArrangement",
        data: { dateText: dateText },
        beforeSend: function (xhr) {
            xhr.setRequestHeader(
                "X-CSRF-TOKEN",
                $("meta[name='csrf-token']").attr("content")
            );
        },
        success: function (response) {
            console.log("Data successfully sent to the server:", response);
        },
        error: function (error) {
            console.error("Error sending data to the server:", error);
        },
    });
}
