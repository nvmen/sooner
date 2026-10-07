<?php
function sooner_resource_library_shortcode() {

    ob_start();
?>
<div class="resource-container">

    <!-- CATEGORY -->
    <div class="resource-categories" id="resource-categories">
        <a href="#" data-slug="" class="cat-item active">All</a>

        <?php
        $terms = get_terms([
            'taxonomy' => 'tai-lieu-category',
            'hide_empty' => true,
        ]);

        foreach ($terms as $term): ?>
            <a href="#" data-slug="<?php echo $term->slug; ?>" class="cat-item">
                <?php echo $term->name; ?>
            </a>
        <?php endforeach; ?>
    </div>

    <!-- DATA -->
    <div id="resource-data"></div>

</div>

<script>
document.addEventListener("DOMContentLoaded", function () {

    function loadData(slug = '', page = 1) {

        const formData = new FormData();
        formData.append('action', 'load_tai_lieu_ajax');
        formData.append('slug', slug);
        formData.append('page', page);

        fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
            method: 'POST',
            body: formData
        })
        .then(res => res.text())
        .then(html => {
            document.getElementById('resource-data').innerHTML = html;
        });
    }

    // load lần đầu
    loadData();

    // click category
    document.querySelectorAll('#resource-categories .cat-item').forEach(el => {
        el.addEventListener('click', function(e) {
            e.preventDefault();

            document.querySelectorAll('.cat-item').forEach(i => i.classList.remove('active'));
            this.classList.add('active');

            const slug = this.dataset.slug;
            loadData(slug, 1);
        });
    });

    // pagination ajax
    document.addEventListener('click', function(e) {
        if (e.target.closest('.ajax-page')) {
            e.preventDefault();

            const page = e.target.dataset.page;
            const active = document.querySelector('.cat-item.active');
            const slug = active ? active.dataset.slug : '';

            loadData(slug, page);
        }
    });

});
</script>

<?php
    return ob_get_clean();
}
add_shortcode('danh_sach_tai_lieu', 'sooner_resource_library_shortcode');