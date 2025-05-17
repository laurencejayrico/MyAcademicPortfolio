document.addEventListener('DOMContentLoaded', () => {
    // Simulated data for demonstration purposes
    const stats = {
        alkaline: { count: 10, ph: 7.5, tds: 120 },
        mineral: { count: 15, ph: 7.2, tds: 130 },
        tap: { count: 5, ph: 6.8, tds: 200 },
    };

    const records = [
        { type: 'Alkaline', ph: 7.5, tds: 120, turbidity: 0.1, recordedAt: '2023-05-01' },
        { type: 'Mineral', ph: 7.2, tds: 130, turbidity: 0.2, recordedAt: '2023-05-02' },
    ];

    // Populate statistics
    document.getElementById('alkaline-count').textContent = stats.alkaline.count;
    document.getElementById('alkaline-ph').textContent = stats.alkaline.ph.toFixed(1);
    document.getElementById('alkaline-tds').textContent = stats.alkaline.tds;

    document.getElementById('mineral-count').textContent = stats.mineral.count;
    document.getElementById('mineral-ph').textContent = stats.mineral.ph.toFixed(1);
    document.getElementById('mineral-tds').textContent = stats.mineral.tds;

    document.getElementById('tap-count').textContent = stats.tap.count;
    document.getElementById('tap-ph').textContent = stats.tap.ph.toFixed(1);
    document.getElementById('tap-tds').textContent = stats.tap.tds;

    // Populate records table
    const recordTable = document.getElementById('record-table');
    records.forEach(record => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${record.type}</td>
            <td>${record.ph.toFixed(1)}</td>
            <td>${record.tds}</td>
            <td>${record.turbidity}</td>
            <td>${record.recordedAt}</td>
            <td><button>Delete</button></td>
        `;
        recordTable.appendChild(row);
    });
});
