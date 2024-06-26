function toggleView() {
    var originalTable = document.getElementById('originalTable');
    var transposedTable = document.getElementById('transposedTable');
    var btnPivot = document.getElementById('btn-pivot');
    if (originalTable.style.display === 'none') {
        originalTable.style.display = 'block';
        transposedTable.style.display = 'none';
        btnPivot.textContent = 'Pivot';
    } else {
        originalTable.style.display = 'none';
        transposedTable.style.display = 'block';
        btnPivot.textContent = 'Unpivot';
    }
}