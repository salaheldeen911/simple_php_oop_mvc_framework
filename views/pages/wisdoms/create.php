<div class="content update">
    <h2>Create A Wisdom</h2>

    <form action="/wisdoms" method="post">
        <input name="user_id" type="hidden" value="<?php echo user()->id ?>">
        <textarea class="<?= isset($errors['content']) ? "error" : ''  ?> wisdom-input" autofocus name="content" placeholder="Tell a wisdom!!" cols="30" maxlength=254 rows="5"></textarea>

        <input type="submit" value="Create">
    </form>
</div>