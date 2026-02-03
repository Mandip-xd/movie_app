(function () {
    var searchInput = document.getElementById('search-input');
    var tableBody = document.querySelector('#movie-list .movie-table tbody');
    var advancedBtn = document.getElementById('search-advanced-btn');
    var clearBtn = document.getElementById('search-clear-btn');
    var genreInput = document.getElementById('search-genre');
    var yearMinInput = document.getElementById('search-year-min');
    var yearMaxInput = document.getElementById('search-year-max');
    var ratingMinInput = document.getElementById('search-rating-min');
    var ratingMaxInput = document.getElementById('search-rating-max');

    if (!searchInput || !tableBody) return;

    var debounceTimer;
    var DEBOUNCE_MS = 300;

    function escapeHtml(text) {
        var div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }

    function renderRows(movies) {
        var isAdmin = document.body.getAttribute('data-admin') === '1';
        var html = '';
        for (var i = 0; i < movies.length; i++) {
            var m = movies[i];
            html += '<tr>';
            html += '<td>' + escapeHtml(m.title) + '</td>';
            html += '<td>' + escapeHtml(m.genre) + '</td>';
            html += '<td>' + parseInt(m.release_year, 10) + '</td>';
            html += '<td>' + escapeHtml(String(m.rating)) + '</td>';
            html += '<td>' + escapeHtml(m.actors) + '</td>';
            if (isAdmin) {
                var meta = document.querySelector('meta[name="csrf-token"]');
                var token = meta ? meta.getAttribute('content') : '';
                html += '<td class="actions">';
                html += '<a href="edit.php?id=' + parseInt(m.id, 10) + '">Edit</a> ';
                html += '<form method="post" action="delete.php" class="form-delete-inline" onsubmit="return confirm(\'Delete this movie?\');">';
                html += '<input type="hidden" name="csrf_token" value="' + escapeHtml(token) + '">';
                html += '<input type="hidden" name="id" value="' + parseInt(m.id, 10) + '">';
                html += '<button type="submit" class="link-delete-btn">Delete</button>';
                html += '</form>';
                html += '</td>';
            }
            html += '</tr>';
        }
        tableBody.innerHTML = html;
    }

    function getSearchParams() {
        var params = [];
        var q = searchInput.value.trim();
        if (q) params.push('q=' + encodeURIComponent(q));
        if (genreInput && genreInput.value.trim()) params.push('genre=' + encodeURIComponent(genreInput.value.trim()));
        if (yearMinInput && yearMinInput.value) params.push('year_min=' + encodeURIComponent(yearMinInput.value));
        if (yearMaxInput && yearMaxInput.value) params.push('year_max=' + encodeURIComponent(yearMaxInput.value));
        if (ratingMinInput && ratingMinInput.value) params.push('rating_min=' + encodeURIComponent(ratingMinInput.value));
        if (ratingMaxInput && ratingMaxInput.value) params.push('rating_max=' + encodeURIComponent(ratingMaxInput.value));
        return params.length ? 'search.php?' + params.join('&') : 'search.php';
    }

    function runSearch() {
        var url = getSearchParams();
        fetch(url)
            .then(function (res) { return res.json(); })
            .then(function (movies) {
                renderRows(movies);
            })
            .catch(function () {
                var cols = document.body.getAttribute('data-admin') === '1' ? 6 : 5;
                tableBody.innerHTML = '<tr><td colspan="' + cols + '">Search failed.</td></tr>';
            });
    }

    function debouncedSearch() {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(runSearch, DEBOUNCE_MS);
    }

    searchInput.addEventListener('input', debouncedSearch);

    if (advancedBtn) {
        advancedBtn.addEventListener('click', function () {
            runSearch();
        });
    }

    if (clearBtn) {
        clearBtn.addEventListener('click', function () {
            searchInput.value = '';
            if (genreInput) genreInput.value = '';
            if (yearMinInput) yearMinInput.value = '';
            if (yearMaxInput) yearMaxInput.value = '';
            if (ratingMinInput) ratingMinInput.value = '';
            if (ratingMaxInput) ratingMaxInput.value = '';
            runSearch();
        });
    }

    if (genreInput) genreInput.addEventListener('change', runSearch);
    if (yearMinInput) yearMinInput.addEventListener('change', runSearch);
    if (yearMaxInput) yearMaxInput.addEventListener('change', runSearch);
    if (ratingMinInput) ratingMinInput.addEventListener('change', runSearch);
    if (ratingMaxInput) ratingMaxInput.addEventListener('change', runSearch);
})();
