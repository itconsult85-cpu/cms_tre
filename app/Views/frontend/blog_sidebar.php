<div class="col-lg-4 sidebar">
    <div class="widgets-container">
        <div class="search-widget widget-item">
            <h3 class="widget-title">Cari</h3>
            <form action="<?= base_url('blog') ?>" method="get">
                <input type="text" name="search" value="<?= set_value('search') ?>">
                <button type="submit" title="Search"><i class="bi bi-search"></i></button>
            </form>
        </div>

        <div class="recent-posts-widget widget-item">
            <h3 class="widget-title">Postingan Terbaru</h3>
            <?php foreach ($recent_posts as $rp): ?>
                <div class="post-item">
                    <img src="<?= base_url((string)$rp['featured_image']) ?>" alt="" class="flex-shrink-0" style="width: 50px; height: 50px; object-fit: cover;">
                    <div>
                        <h4><a href="<?= base_url('blog/' . $rp['slug']) ?>"><?= esc($rp['title']) ?></a></h4>
                        <time><?= date('M d, Y', strtotime($rp['created_at'])) ?></time>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>