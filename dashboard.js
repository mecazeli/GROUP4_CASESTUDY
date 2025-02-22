document.addEventListener('DOMContentLoaded', function () {
    const calendarBody = document.getElementById('calendarBody');
    const currentMonthYear = document.getElementById('currentMonthYear');
    const prevMonthButton = document.getElementById('prevMonth');
    const nextMonthButton = document.getElementById('nextMonth');

    let currentDate = new Date();
    let currentMonth = currentDate.getMonth();
    let currentYear = currentDate.getFullYear();

    // Function to generate the calendar
    function generateCalendar(month, year) {
        // Clear the calendar body
        calendarBody.innerHTML = '';

        // Set the current month and year in the header
        const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        currentMonthYear.textContent = `${monthNames[month]} ${year}`;

        // Get the first day of the month
        const firstDay = new Date(year, month, 1);
        const startingDay = firstDay.getDay(); // 0 (Sunday) to 6 (Saturday)

        // Get the number of days in the month
        const totalDays = new Date(year, month + 1, 0).getDate();

        // Generate the calendar grid
        let date = 1;
        for (let i = 0; i < 6; i++) { // 6 rows max
            const row = document.createElement('tr');
            for (let j = 0; j < 7; j++) { // 7 days in a week
                const cell = document.createElement('td');
                if (i === 0 && j < startingDay) {
                    // Empty cells before the first day
                    cell.textContent = '';
                } else if (date > totalDays) {
                    // Empty cells after the last day
                    cell.textContent = '';
                } else {
                    // Add the date
                    cell.textContent = date;
                    cell.addEventListener('click', () => markDate(cell));
                    date++;
                }
                row.appendChild(cell);
            }
            calendarBody.appendChild(row);
            if (date > totalDays) break; // Stop if all dates are added
        }
    }

    // Function to mark a date
    function markDate(cell) {
        cell.classList.toggle('marked'); // Toggle the "marked" class
    }

    // Event listeners for month navigation
    prevMonthButton.addEventListener('click', () => {
        currentMonth--;
        if (currentMonth < 0) {
            currentMonth = 11;
            currentYear--;
        }
        generateCalendar(currentMonth, currentYear);
    });

    nextMonthButton.addEventListener('click', () => {
        currentMonth++;
        if (currentMonth > 11) {
            currentMonth = 0;
            currentYear++;
        }
        generateCalendar(currentMonth, currentYear);
    });

    // Generate the initial calendar
    generateCalendar(currentMonth, currentYear);
});