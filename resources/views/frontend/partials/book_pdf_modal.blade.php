<!-- Sample PDF Modal -->
<div class="pdf-modal" id="bookPdfModal" role="dialog" aria-modal="true" aria-hidden="true">
    <div class="pdf-modal__dialog">
        <div class="pdf-modal__head">
            <h5 id="bookPdfModalTitle">Sample Preview</h5>
            <button type="button" class="pdf-modal__close" id="bookPdfModalClose" aria-label="Close">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="pdf-modal__body">
            <div class="pdf-modal__loading" id="bookPdfModalLoading">
                <i class="fas fa-spinner fa-spin"></i> Loading preview…
            </div>
            <iframe id="bookPdfModalFrame" src="" title="Book sample preview"></iframe>
        </div>
    </div>
</div>

<script>
(function () {
    var modal = document.getElementById('bookPdfModal');
    var frame = document.getElementById('bookPdfModalFrame');
    var titleEl = document.getElementById('bookPdfModalTitle');
    var closeBtn = document.getElementById('bookPdfModalClose');
    var loading = document.getElementById('bookPdfModalLoading');

    function openModal(url, title) {
        loading.style.display = 'flex';
        frame.src = url;
        titleEl.textContent = title ? title + ' — Sample Preview' : 'Sample Preview';
        modal.classList.add('is-open');
        modal.setAttribute('aria-hidden', 'false');
        document.body.classList.add('pdf-modal-open');
    }

    function closeModal() {
        modal.classList.remove('is-open');
        modal.setAttribute('aria-hidden', 'true');
        document.body.classList.remove('pdf-modal-open');
        frame.src = '';
    }

    document.addEventListener('click', function (e) {
        var trigger = e.target.closest('.js-open-pdf-modal');
        if (trigger) {
            e.preventDefault();
            openModal(trigger.getAttribute('data-pdf-url'), trigger.getAttribute('data-pdf-title'));
        }
    });

    frame.addEventListener('load', function () {
        if (frame.src) {
            loading.style.display = 'none';
        }
    });

    closeBtn.addEventListener('click', closeModal);

    modal.addEventListener('click', function (e) {
        if (e.target === modal) {
            closeModal();
        }
    });

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && modal.classList.contains('is-open')) {
            closeModal();
        }
    });
})();
</script>