<nav class="sections-nav-container">
    <ul id="sections-nav" class="nav sections-nav sections-nav-animated">
        <li class="sections-nav-item">
            <a href="#section-01" class="nav-link sections-nav-link goto-section active">
                <span class="sections-nav-counter">01</span>
                Początek
            </a>
        </li>
        <li class="sections-nav-item">
            <a href="#section-02" class="nav-link sections-nav-link goto-section">
                <span class="sections-nav-counter">02</span>
                <?= get_field('about_header', 10) ?>
            </a>
        </li>
        <li class="sections-nav-item">
            <a href="#section-03" class="nav-link sections-nav-link goto-section">
                <span class="sections-nav-counter">03</span>
                <?= get_field('services_header', 10) ?>
            </a>
        </li>
        <li class="sections-nav-item">
            <a href="#section-04" class="nav-link sections-nav-link goto-section">
                <span class="sections-nav-counter">04</span>
                <?= get_field('history_header', 10) ?>
            </a>
        </li>
        <li class="sections-nav-item">
            <a href="#section-05" class="nav-link sections-nav-link goto-section">
                <span class="sections-nav-counter">05</span>
                <?= get_field('projects_header', 10) ?>
            </a>
        </li>
        <li class="sections-nav-item">
            <a href="#section-06" class="nav-link sections-nav-link goto-section">
                <span class="sections-nav-counter">06</span>
                <?= get_field('testimonials_header', 10) ?>
            </a>
        </li>
        <li class="sections-nav-item">
            <a href="#section-07" class="nav-link sections-nav-link goto-section">
                <span class="sections-nav-counter">07</span>
                <?= get_field('contact_header', 10) ?>
            </a>
        </li>
        <li class="sections-nav-item">
            <div class="sections-nav-info">
                <a href="mailto:<?= get_field('contact_email', 10) ?>"><?= get_field('contact_email', 10) ?></a><br>
                <a href="tel:<?= get_field('contact_phone', 10) ?>"><?= get_field('contact_phone', 10) ?></a>
            </div>
        </li>
    </ul>
</nav>

