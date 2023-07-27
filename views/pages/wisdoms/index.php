<div class="content read">
    <h2>Read wisdoms</h2>
    <a href="wisdoms/create" class="create-contact">Create Wisdom</a>

    <?php if (!count($wisdoms)) : ?>

        <div class="no-wisdoms">
            <p>Add the First wisdom</p>

        </div>
        <?php else : foreach ($wisdoms as $wisdom) : ?>
            <div class="card">
                <div class="card-title">
                    <span><?= $wisdom->name ?></span>
                    <span><?= date('M-d', strtotime($wisdom->created_at)) ?></span>
                </div>
                <div class="wisdom-content">
                    <div class="actions">
                        <a href="/wisdoms/<?= $wisdom->id ?>/edit">
                            <i style="color:green" class="fas fa-pencil-alt"></i>
                        </a>
                        <i onclick="deleteWisdom(this)" style="color:red" class="fas fa-trash-alt"></i>
                        <form action="/wisdoms/<?= $wisdom->id ?>" method="POST">
                            <?= method("delete") ?>
                        </form>
                    </div>
                    <span><?= $wisdom->content ?></span>
                </div>
            </div>
    <?php
        endforeach;
    endif;
    ?>

    <div class="pagination">
        <div class="pagination">
            <?php if ($page > 1) : ?>
                <a href="wisdoms?page=<?= $page - 1 ?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
            <?php endif; ?>
            <?php if ($page * $records_per_page < $num_records) : ?>
                <a href="wisdoms?page=<?= $page + 1 ?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
            <?php endif; ?>
        </div>
    </div>