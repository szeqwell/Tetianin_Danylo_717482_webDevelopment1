<?php

if (!empty($users)) {
    foreach ($users as $user) { ?>
        <div>
            <h2>
                <a href="/user/<?= htmlspecialchars($user->id); ?>">
                    <?= htmlspecialchars($user->username); ?>
                </a>
            </h2>
        </div>
    <?php } ?>
<?php } ?>