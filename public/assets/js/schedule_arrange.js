//schedule_arrange.js

document.addEventListener('DOMContentLoaded', function () {
    // Assuming initializeCalendar is an async function you've defined elsewhere
    initializeCalendar().then(() => {
        console.log('Calendar initialized');

        // Add event listener to the 'Generate_schedule' button
        $('#Generate_shedule').click(function (e) {
            var startSelectDateValue = $('#Start_titile_datetime').val();
            var endSelectDateValue = $('#End_titile_datetime').val();
            var starttime = $('#starttime').val();
            var endtime = $('#endtime').val();
            var className = $('#className').val();
            var subject = $('#subject').val();
            var TeacherName = $('#TeacherName').val();
            // Make sure the dates are not empty
            if (!startSelectDateValue || !endSelectDateValue) {
                alert('Please ensure both start and end dates are selected.');
                return;
            }

            const startSelectDate = new Date(startSelectDateValue);
            const endSelectDate = new Date(endSelectDateValue);

            // Ensure that the start date is before the end date
            if (startSelectDate > endSelectDate) {
                alert('Start date must be before end date.');
                return;
            }

            const weekdays = calculateWeekdaysFromDate(startSelectDate, endSelectDate);
            $('#schedule_gen_tb').empty();
            // Generate and insert new rows for each weekday
            var idOfTime = 1;
            weekdays.forEach(function(date) {
                const newRow = `
                    <tr id="idOfshedule${idOfTime++}">
                        <td>${ idOfTime++ }</td>
                        <td data="{}">${TeacherName}</td>
                        <td><strong>${date}</strong></td>
                        <td>${starttime}</td>
                        <td>${endtime}</td>
                        <td data="{}">${className}</td>
                        <td data="{}">${subject}</td>
                        <td>Transport</td>
                        <td>
                        <button class="btn btn-danger btn-sm" value="${idOfTime++}" id="deleteOfGenShedule"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>
                `;
                $('#schedule_gen_tb').append(newRow);
            });

            // console.log(
            //     weekdays
            //     ); // Here you can use these dates as needed, e.g., display them or add to a calendar
        });
    }).catch(error => {
        console.error('Failed to initialize the calendar', error);
    });
});

function calculateWeekdaysFromDate(startDate, endDate) {
    let weekdays = [];
    let currentDate = new Date(startDate.getTime());

    while (currentDate <= endDate) {
        // Exclude Saturdays (6) and Sundays (0)
        if (currentDate.getDay() !== 6 && currentDate.getDay() !== 0) {
            weekdays.push(currentDate.toLocaleDateString('en-US', {
                month: '2-digit',
                day: '2-digit',
                year: 'numeric'
            }));
        }
        currentDate.setDate(currentDate.getDate() + 1);
    }

    return weekdays; // Now returns all days excluding weekends
}
