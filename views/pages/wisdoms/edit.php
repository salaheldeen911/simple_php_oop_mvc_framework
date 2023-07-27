<div class="content update">
    <h2>Edit A Wisdom</h2>

    <form action="/wisdoms/<?= $wisdom->id ?>" method="post">
        <?= method("put") ?>
        <input name="user_id" type="hidden" value="<?php echo user()->id ?>">
        <textarea class="<?= isset($errors['content']) ? "error" : ''  ?> wisdom-input" autofocus name="content" placeholder="Tell a wisdom!!" cols="30" maxlength=254 rows="5"><?= $wisdom->content ?></textarea>
        <input type="submit" value="Update">
    </form>
    <?php if (isset($msg)) : ?>
        <p><?= $msg ?></p>
    <?php endif; ?>
</div>