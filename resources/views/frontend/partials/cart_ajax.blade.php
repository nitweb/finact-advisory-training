<style>
    .cart-toast-wrap {
        position: fixed;
        top: 24px;
        right: 24px;
        z-index: 100000;
        display: flex;
        flex-direction: column;
        gap: 10px;
        pointer-events: none;
    }

    .cart-toast {
        pointer-events: auto;
        display: flex;
        align-items: center;
        gap: 14px;
        min-width: 280px;
        max-width: 380px;
        padding: 14px 16px;
        background: #fff;
        border-left: 5px solid #b89867;
        border-radius: 12px;
        box-shadow: 0 16px 40px rgba(14, 34, 64, .22);
        transform: translateX(120%);
        opacity: 0;
        transition: transform .4s cubic-bezier(.22, 1, .36, 1), opacity .3s ease;
    }

    .cart-toast.show {
        transform: translateX(0);
        opacity: 1;
    }

    .cart-toast--error {
        border-left-color: #e05555;
    }

    .cart-toast__icon {
        flex: 0 0 34px;
        width: 34px;
        height: 34px;
        border-radius: 50%;
        background: #163355;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
    }

    .cart-toast--error .cart-toast__icon {
        background: #e05555;
    }

    .cart-toast__text {
        flex: 1;
        font-size: 13.5px;
        font-weight: 600;
        line-height: 1.4;
        color: #163355;
    }

    .cart-toast__link {
        display: inline-block;
        margin-top: 3px;
        font-size: 12px;
        font-weight: 700;
        color: #9a7d4e;
        text-decoration: none;
    }

    .cart-toast__link:hover {
        text-decoration: underline;
        color: #9a7d4e;
    }

    .js-add-to-cart button[type="submit"].is-loading {
        opacity: .65;
        pointer-events: none;
    }

    .book-cart-btn__badge.bump {
        animation: headerCartBump .6s cubic-bezier(.36, 1.6, .5, 1);
    }

    @media (max-width: 575px) {
        .cart-toast-wrap {
            left: 12px;
            right: 12px;
            top: 12px;
        }

        .cart-toast {
            min-width: 0;
            max-width: none;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var cartUrl = @json(route('frontend.book.cart'));
        var csrfToken = @json(csrf_token());

        // ── Toast ──
        var wrap = document.createElement('div');
        wrap.className = 'cart-toast-wrap';
        document.body.appendChild(wrap);

        function toast(message, isError) {
            var el = document.createElement('div');
            el.className = 'cart-toast' + (isError ? ' cart-toast--error' : '');

            var icon = document.createElement('span');
            icon.className = 'cart-toast__icon';
            icon.innerHTML = '<i class="fas ' + (isError ? 'fa-exclamation' : 'fa-check') + '"></i>';

            var text = document.createElement('div');
            text.className = 'cart-toast__text';
            var msg = document.createElement('span');
            msg.textContent = message;
            text.appendChild(msg);

            if (!isError) {
                var link = document.createElement('a');
                link.className = 'cart-toast__link';
                link.href = cartUrl;
                link.innerHTML = 'View Cart <i class="fas fa-arrow-right"></i>';
                text.appendChild(document.createElement('br'));
                text.appendChild(link);
            }

            el.appendChild(icon);
            el.appendChild(text);
            wrap.appendChild(el);

            requestAnimationFrame(function() {
                requestAnimationFrame(function() {
                    el.classList.add('show');
                });
            });

            setTimeout(function() {
                el.classList.remove('show');
                setTimeout(function() {
                    el.remove();
                }, 450);
            }, 3400);
        }

        // ── Header cart icon (desktop + sticky clone + mobile) ──
        function bump(el) {
            el.classList.remove('bump');
            void el.offsetWidth;
            el.classList.add('bump');
        }

        function ensureHeaderCart(count) {
            // Desktop / tablet: right side box (original + sticky clone)
            document.querySelectorAll('.main-menu-three__right').forEach(function(right) {
                if (right.querySelector('.header-cart-box')) return;
                var box = document.createElement('div');
                box.className = 'main-menu-three__cart-box header-cart-box';
                box.innerHTML = '<a href="' + cartUrl + '" class="header-cart-icon" aria-label="View cart">' +
                    '<i class="fa fa-shopping-cart"></i>' +
                    '<span class="header-cart-count">' + count + '</span></a>';
                var btnBox = right.querySelector('.main-menu-three__btn-box');
                right.insertBefore(box, btnBox || null);
            });

            // Mobile: next to the hamburger toggler
            document.querySelectorAll('.main-menu-three__main-menu-box').forEach(function(menuBox) {
                if (menuBox.querySelector('.header-cart-mobile')) return;
                var toggler = menuBox.querySelector('.mobile-nav__toggler');
                if (!toggler) return;
                var a = document.createElement('a');
                a.href = cartUrl;
                a.className = 'header-cart-mobile';
                a.setAttribute('aria-label', 'View cart');
                a.innerHTML = '<i class="fa fa-shopping-cart"></i><span class="header-cart-count">' + count + '</span>';
                menuBox.insertBefore(a, toggler);
            });
        }

        function updateCartUI(count) {
            ensureHeaderCart(count);

            document.querySelectorAll('.header-cart-count').forEach(function(el) {
                el.textContent = count;
                bump(el);
            });
            document.querySelectorAll('.header-cart-icon').forEach(bump);

            // "View Cart" button on the book list toolbar
            document.querySelectorAll('.book-cart-btn').forEach(function(btn) {
                var badge = btn.querySelector('.book-cart-btn__badge');
                if (!badge) {
                    badge = document.createElement('span');
                    badge.className = 'book-cart-btn__badge';
                    btn.appendChild(badge);
                }
                badge.textContent = count;
                badge.style.display = '';
                bump(badge);
            });
        }

        // ── AJAX add to cart ──
        document.addEventListener('submit', function(e) {
            var form = e.target.closest ? e.target.closest('form.js-add-to-cart') : null;
            if (!form) return;

            e.preventDefault();

            var btn = form.querySelector('button[type="submit"]');
            if (btn) btn.classList.add('is-loading');

            fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: new FormData(form)
                })
                .then(function(res) {
                    return res.json().then(function(data) {
                        return {
                            ok: res.ok,
                            data: data
                        };
                    });
                })
                .then(function(result) {
                    if (!result.ok || !result.data.success) {
                        toast(result.data.message || 'Could not add to cart.', true);
                        return;
                    }
                    updateCartUI(result.data.cart_count);
                    toast(result.data.message, false);
                })
                .catch(function() {
                    toast('Something went wrong. Please try again.', true);
                })
                .finally(function() {
                    if (btn) btn.classList.remove('is-loading');
                });
        });
    });
</script>
