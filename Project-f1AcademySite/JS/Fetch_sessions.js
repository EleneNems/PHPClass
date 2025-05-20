document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('race_select').addEventListener('change', function () {
        const raceId = this.value;
        const sessionsSection = document.getElementById('sessions_section');
        const sessionList = document.querySelector('.session-list');

        if (!raceId) {
            sessionsSection.classList.add('hidden');
            sessionList.innerHTML = '';
            return;
        }

        fetch('../Admin/Commands/get_sessions.php?event_id=' + raceId)
            .then(response => response.json())
            .then(data => {
                sessionList.innerHTML = '';

                let eventDatesDiv = document.getElementById('event_dates');
                if (!eventDatesDiv) {
                    eventDatesDiv = document.createElement('div');
                    eventDatesDiv.id = 'event_dates';
                    eventDatesDiv.className = 'event-dates';
                    sessionsSection.insertBefore(eventDatesDiv, sessionList);
                }

                if (data.eventDates) {
                    const { start_date, end_date } = data.eventDates;
                    eventDatesDiv.innerHTML = `
                        <p><strong>Start Date:</strong> ${new Date(start_date).toLocaleString()}</p>
                        <p><strong>End Date:</strong> ${new Date(end_date).toLocaleString()}</p>
                    `;
                } else {
                    eventDatesDiv.innerHTML = '';
                }

                data.sessions.forEach(session => {
                    const card = document.createElement('div');
                    card.className = 'session-card';

                    let uploadButton = '';
                    if (!session.result_json || session.result_json.trim() === '') {
                        uploadButton = `<button onclick="uploadResults(${session.id})">Upload Results</button>`;
                    }

                    card.innerHTML = `
                        <h4>${session.type} - Session ${session.session_number}</h4>
                        <p>${session.date_time}</p>
                        ${uploadButton}
                        <button onclick="openDeleteSessionModal(${session.id})">Delete</button>
                    `;
                    sessionList.appendChild(card);
                });

                sessionsSection.classList.remove('hidden');
            })
            .catch(err => {
                console.error('Fetch error:', err);
            });
    });
});
