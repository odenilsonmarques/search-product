# Plugin: Buscar Produtos para WooCommerce

Este plugin adiciona uma funcionalidade de **busca AJAX com carregamento dinâmico (live search)** de produtos no WooCommerce, melhorando a experiência do usuário ao procurar produtos.

---

## 📦 Requisitos

- WordPress 5.0+
- WooCommerce 4.0+
- Tema compatível com WooCommerce (ex: Storefront)

---

## 🚀 Funcionalidades

- Integração via REST API personalizada
- Busca em tempo real sem recarregar a página
- Retorno com imagem, nome e link do produto
- Exibição de resultados com `spinner` (pode ser personalizado)
- 100% responsivo

---

## 🛠️ Instalação

1. Clone ou baixe os arquivos do plugin.
2. Coloque a pasta do plugin em:  
   `wp-content/plugins/buscar-produtos-woocommerce`
3. Ative o plugin no painel do WordPress.

---

```
<form role="search" method="get" class="d-flex flex-grow-1 mx-3 pt-3" action="<?php echo esc_url(home_url('/')); ?>">
    <div class="input-group">
        <input type="search" class="form-control custom-busca-borda" id="live-search" placeholder="Buscar produtos..." value="<?php echo get_search_query(); ?>" name="s" />

        <!-- div para exibir o resultado da busca -->
        <div id="live-search-results"></div>

        <button class="btn btn-outline-secondary btn-custom-buscar" type="submit">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.397h-.001l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85zm-5.242 1.156a5 5 0 1 1 0-10 5 5 0 0 1 0 10z" />
            </svg>
        </button>
    </div>
<input type="hidden" name="post_type" value="product" />
</form>
```
