const articles = document.getElementById('table_artigos');

if (articles) {
    articles.addEventListener('click', e => {
        if (e.target.className === 'btn btn-danger delete_artigo') {
            if (confirm('Tem certeza que deseja deletar esse arquivo?')) {
                const id = e.target.getAttribute('data-id');

                fetch(`/artigo/delete/${id}`, {
                    method: 'DELETE'
                }).then(res => window.location.reload());
            }
        }
    });
}