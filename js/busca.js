document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.querySelector('#live-search');
    const resultsContainer = document.querySelector('#live-search-results');

    let timeout;

    searchInput.addEventListener('keyup', function () {
        clearTimeout(timeout);

        const query = this.value.trim();

        if (query.length < 2) {
            resultsContainer.innerHTML = '';
            return;
        }

        timeout = setTimeout(() => {

            fetch(`${buscaAjax.restUrl}?s=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(data => {
                    resultsContainer.innerHTML = '';

                    if (data.length) {
                        data.forEach(item => {
                            const result = document.createElement('div');
                            result.className = 'busca-ajax-item';
                            result.innerHTML = `
                                <a href="${item.link}" class="d-flex align-items-center gap-2 p-2 border-bottom">
                                    <img src="${item.img}" alt="${item.title}" style="width: 40px; height: 40px; object-fit: cover;">
                                    <span>${item.title}</span>
                                </a>`;
                            resultsContainer.appendChild(result);
                        });
                    } else {
                        resultsContainer.innerHTML = '<p class="p-2 text-muted">Nenhum produto encontrado.</p>';
                    }
                });
        }, 200);
    });
});
