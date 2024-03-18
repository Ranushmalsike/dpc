//schedule_arrange.js

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
                    alert(
                        "Please ensure both start and end dates are selected."
                    );
                    return;
                }

                const startSelectDate = new Date(startSelectDateValue);
                const endSelectDate = new Date(endSelectDateValue);

                // Ensure that the start date is before the end date
                if (startSelectDate > endSelectDate) {
                    alert("Start date must be before end date.");
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
                        <td>Transport</td>
                        <td>
                        <button class="btn btn-danger btn-sm" value="${currentIdOfTime}" id="deleteOfGenShedule" ><i class="bi bi-trash"></i></button>
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
        fetchHolidayData(dateText);
        $("#idOfshedule" + id).remove();
    });

    // New code to handle Transport TD clicks
    $("#schedule_gen_tb").on("click", 'td:contains("Transport")', function () {
        const currentTd = $(this); // Store the current TD to update it later
        $("#transportModal").show(); // Show the modal

        $("#saveTransport")
            .off("click")
            .on("click", function () {
                // Remove any old click handlers and add a new one
                const selectedTransport = $("#transportSelect").val(); // Get the selected transport option
                currentTd.text(selectedTransport); // Update the TD text with the selected option
                $("#transportModal").hide(); // Hide the modal
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
function fetchHolidayData(dateText) {
    const apiKey = "p86SLqsywONmkkdv3nnLHpZ1dcqU6Zt7";
    const dateParts = dateText.split("/");
    const year = dateParts[2]; // Extract year from dateText
    const url = `https://calendarific.com/api/v2/holidays?&api_key=${apiKey}&country=LK&year=${year}&type=national`;

    fetch(url)
        .then((response) => response.json())
        .then((data) => {
            processHolidayData(data, dateText);
        })
        .catch((error) => console.error("Error fetching holiday data:", error));
}

function processHolidayData(data, dateText) {
    const dateParts = dateText.split("/");
    const month = parseInt(dateParts[0], 10);
    const day = parseInt(dateParts[1], 10);
    const year = parseInt(dateParts[2], 10);

    let matchingHoliday = null;

    if (data.response && data.response.holidays) {
        matchingHoliday = data.response.holidays.find((holiday) => {
            const holidayDate = new Date(holiday.date.iso);
            return (
                holidayDate.getDate() === day &&
                holidayDate.getMonth() + 1 === month && // Months are 0-indexed in JavaScript Date
                holidayDate.getFullYear() === year
            );
        });
    }

    if (matchingHoliday) {
        // If a matching holiday is found, prepare and send data to your server
        addDeleteDataFromTimeArrangement({
            dateText: dateText,
            holidayName: matchingHoliday.name,
        });
    } else {
        console.log("No matching holiday found for the given date.");
    }
}

function addDeleteDataFromTimeArrangement(processedData) {
    $.ajax({
        type: "POST",
        url: "/input/Add_DeleteData_from_timeArrangement",
        data: processedData,
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
