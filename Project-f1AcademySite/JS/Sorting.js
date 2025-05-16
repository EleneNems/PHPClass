function sortTable(columnIndex, type = 'text') {
    const table = document.querySelector('.team-table tbody');
    const rows = Array.from(table.querySelectorAll('tr'));

    const sortedRows = rows.sort((a, b) => {
        let aText = a.children[columnIndex].textContent.trim();
        let bText = b.children[columnIndex].textContent.trim();

        if (type === 'num') {
            return parseFloat(bText) - parseFloat(aText); 
        } else {
            return aText.localeCompare(bText); 
        }
    });

    sortedRows.forEach(row => table.appendChild(row));
}
