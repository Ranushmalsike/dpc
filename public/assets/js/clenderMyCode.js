// Calender
async function fetchHolidays() {
  const apiKey = 'p86SLqsywONmkkdv3nnLHpZ1dcqU6Zt7';
  const country = 'LK'; // ISO Country Code for Sri Lanka
  const year = new Date().getFullYear(); // Current year, or specify the year you want

  const response = await fetch(`https://calendarific.com/api/v2/holidays?&api_key=${apiKey}&country=${country}&year=${year}`);
  const data = await response.json();

  // List of specific holidays to include
  const specificHolidayNames = [
    "Poya", "Pongal", "National Day", "Mahasivarathri Day", "Good Friday", 
    "Eid al-Fitr", "New Year", "May Day", "Hadji", "Mawlid", "Christmas Day"
  ];

  // Filter for holidays that match any name in the specificHolidayNames list
  const specificHolidays = data.response.holidays.filter(holiday =>
    specificHolidayNames.some(specificName => holiday.name.includes(specificName))
  ).map(holiday => {
    return {
      title: holiday.name,
      date: holiday.date.iso,
      // Optionally, assign a color or other property based on the holiday type
      color: '#fc1303' // Example color, you might choose to customize this further
    };
  });

  return specificHolidays;
}

function generateWeekendEvents(startYear, endYear) {
  let weekendEvents = [];
  for (let year = startYear; year <= endYear; year++) {
    for (let month = 0; month < 12; month++) {
      let date = new Date(year, month, 1);
      while (date.getMonth() === month) {
        if (date.getDay() === 0 || date.getDay() === 6) { // 0 = Sunday, 6 = Saturday
          weekendEvents.push({
            title: 'Weekend',
            start: new Date(date),
            end: new Date(date),
            color: '#add8e6', // Light blue color for weekends
          });
        }
        date.setDate(date.getDate() + 1);
      }
    }
  }
  return weekendEvents;
}

async function initializeCalendar() {
  const holidays = await fetchHolidays(); // Fetch specific holidays from the API
  const myPrivateEvents = [
    { title: 'My Birthday', date: '2024-03-16', color: '#13fc03' }, // Example private event
    // Add more private events here
  ];

  const currentYear = new Date().getFullYear();
  const weekendEvents = generateWeekendEvents(currentYear, currentYear); // Adjust the years as needed

  var calendarEl = document.getElementById('calendar');
  var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth',
    nowIndicator: true,
    headerToolbar: {
      left: 'prev,next today',
      center: 'title',
      right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
    },
    navLinks: true,
    editable: true,
    selectable: true,
    selectMirror: true,
    dayMaxEvents: true,
    events: [...holidays, ...myPrivateEvents, ...weekendEvents],
    
    // eventClick: function(info) {

    //   // Check if the event color is red or the event is for weekends
    //   if (info.event.backgroundColor === '#fc1303' || ['Saturday', 'Sunday'].includes(info.event.title)) {
    //     alert(`Event: ${info.event.title} on ${info.event.start.toLocaleDateString()}`);
    //   }

    // }
    
  });

  calendar.render();
}

document.addEventListener('DOMContentLoaded', async function() {
  await initializeCalendar();
});
